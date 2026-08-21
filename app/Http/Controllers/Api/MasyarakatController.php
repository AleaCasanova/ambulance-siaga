<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Donasi;
use App\Models\Pemesanan;
use App\Models\Rating;
use App\Models\RumahSakit;
use App\Models\StatusPerjalanan;
use App\Services\AuditLogService;
use App\Services\PemesananService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class MasyarakatController extends Controller
{
    /**
     * Create new emergency order or ambulance booking
     */
    public function createOrder(Request $request, PemesananService $service)
    {
        $validator = Validator::make($request->all(), [
            'nama_pasien' => 'required|string|max:100',
            'usia_pasien' => 'nullable|string|max:30',
            'nik_pasien' => 'nullable|string|max:20',
            'no_hp_kontak' => 'nullable|string|max:20',
            'jumlah_pendamping' => 'nullable|integer|min:0|max:10',
            'keperluan_penggunaan' => 'nullable|string|max:100',
            'kondisi_pasien' => 'required|string|max:255',
            'diagnosa_medis' => 'nullable|string|max:255',
            'lokasi_jemput' => 'required|string|max:255',
            'jemput_lat' => 'required|numeric',
            'jemput_lng' => 'required|numeric',
            'tujuan_lokasi' => 'nullable|string|max:255',
            'tujuan_lat' => 'nullable|numeric',
            'tujuan_lng' => 'nullable|numeric',
            'rumah_sakit_id' => 'nullable|exists:rumah_sakit,id',
            'catatan_tambahan' => 'nullable|string|max:255',
            // Verification photo
            'photo' => 'nullable|image|max:10240', // File upload
            'photo_base64' => 'nullable|string', // Base64 alternative
            'photo_latitude' => 'nullable|numeric',
            'photo_longitude' => 'nullable|numeric',
            'photo_address' => 'nullable|string|max:255',
            'photo_district' => 'nullable|string|max:100',
            'photo_city' => 'nullable|string|max:100',
            'photo_province' => 'nullable|string|max:100',
            'photo_country' => 'nullable|string|max:100',
            'photo_taken_at' => 'nullable|date',
            'photo_accuracy' => 'nullable|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi pembuatan pesanan gagal.',
                'errors' => $validator->errors()
            ], 422);
        }

        $userId = $request->user() ? $request->user()->id : null;
        $photoPath = null;

        // Process file upload if present
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('order-verification', 'public');
        } elseif ($request->filled('photo_base64')) {
            $base64 = $request->photo_base64;
            if (str_contains($base64, ';base64,')) {
                $parts = explode(';base64,', $base64);
                $imageData = base64_decode($parts[1]);
            } else {
                $imageData = base64_decode($base64);
            }
            $fileName = 'ORDER_' . date('Ymd_His') . '_' . uniqid() . '.jpg';
            $filePath = 'order-verification/' . $fileName;
            Storage::disk('public')->put($filePath, $imageData);
            $photoPath = $filePath;
        }

        $orderData = $request->all();
        $orderData['photo_path'] = $photoPath;

        try {
            $order = $service->createOrder($orderData, $userId);

            // Update photo fields if provided
            $order->update([
                'photo_path' => $photoPath,
                'photo_latitude' => $request->photo_latitude ?? $request->jemput_lat,
                'photo_longitude' => $request->photo_longitude ?? $request->jemput_lng,
                'photo_address' => $request->photo_address ?? $request->lokasi_jemput,
                'photo_district' => $request->photo_district,
                'photo_city' => $request->photo_city,
                'photo_province' => $request->photo_province,
                'photo_country' => $request->photo_country,
                'photo_taken_at' => $request->photo_taken_at ? now()->parse($request->photo_taken_at) : now(),
                'photo_accuracy' => $request->photo_accuracy,
            ]);

            $order->load(['ambulans', 'supir.user', 'rumahSakit', 'statusPerjalanan']);

            return response()->json([
                'success' => true,
                'message' => 'Pesanan darurat ambulans berhasil dikirim! Menunggu konfirmasi dispatcher/armada.',
                'data' => [
                    'order' => $this->formatOrder($order),
                ]
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal membuat pesanan: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get active order for current user
     */
    public function getActiveOrder(Request $request)
    {
        $user = $request->user();

        $activeOrder = Pemesanan::with([
            'ambulans',
            'supir.user',
            'rumahSakit',
            'statusPerjalanan',
            'latestTracking'
        ])
            ->where('user_id', $user->id)
            ->whereNotIn('status', ['selesai', 'dibatalkan'])
            ->latest()
            ->first();

        return response()->json([
            'success' => true,
            'data' => [
                'has_active_order' => $activeOrder !== null,
                'order' => $activeOrder ? $this->formatOrder($activeOrder) : null,
            ]
        ]);
    }

    /**
     * Get order history of current user
     */
    public function getOrders(Request $request)
    {
        $user = $request->user();
        $status = $request->query('status'); // all, active, selesai, dibatalkan

        $query = Pemesanan::with(['ambulans', 'supir.user', 'rumahSakit', 'rating'])
            ->where('user_id', $user->id);

        if ($status === 'active') {
            $query->whereNotIn('status', ['selesai', 'dibatalkan']);
        } elseif ($status === 'completed' || $status === 'selesai') {
            $query->where('status', 'selesai');
        } elseif ($status === 'cancelled' || $status === 'dibatalkan') {
            $query->where('status', 'dibatalkan');
        }

        $orders = $query->latest()->paginate(15);

        return response()->json([
            'success' => true,
            'data' => [
                'orders' => $orders->map(fn($o) => $this->formatOrder($o)),
                'current_page' => $orders->currentPage(),
                'last_page' => $orders->lastPage(),
                'total' => $orders->total(),
            ]
        ]);
    }

    /**
     * Get single order detail with full status timeline and GPS tracking history
     */
    public function getOrderDetail(Request $request, $id)
    {
        $user = $request->user();

        $order = Pemesanan::with([
            'ambulans',
            'supir.user',
            'rumahSakit',
            'statusPerjalanan.user',
            'trackingGps' => fn($q) => $q->latest('recorded_at')->limit(50),
            'latestTracking',
            'rating'
        ])
            ->where('id', $id)
            ->first();

        if (!$order) {
            return response()->json([
                'success' => false,
                'message' => 'Pesanan tidak ditemukan.'
            ], 404);
        }

        // Check authorization (allow user themselves or dispatcher/admin/supir assigned)
        if ($order->user_id && $order->user_id !== $user->id && !$user->hasRole(['admin', 'operator', 'supir'])) {
            return response()->json([
                'success' => false,
                'message' => 'Anda tidak memiliki akses ke pesanan ini.'
            ], 403);
        }

        return response()->json([
            'success' => true,
            'data' => [
                'order' => $this->formatOrder($order, true),
            ]
        ]);
    }

    /**
     * Complete patient medical details form
     */
    public function completeForm(Request $request, $id)
    {
        $user = $request->user();
        $order = Pemesanan::where('id', $id)->where('user_id', $user->id)->first();

        if (!$order) {
            return response()->json([
                'success' => false,
                'message' => 'Pesanan tidak ditemukan.'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'nik_pasien' => 'required|string|max:20',
            'usia_pasien' => 'required|string|max:30',
            'no_hp_kontak' => 'required|string|max:20',
            'diagnosa_medis' => 'nullable|string|max:255',
            'jumlah_pendamping' => 'nullable|integer|min:0|max:10',
            'keperluan_penggunaan' => 'nullable|string|max:100',
            'catatan_tambahan' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors()
            ], 422);
        }

        $order->update([
            'nik_pasien' => $request->nik_pasien,
            'usia_pasien' => $request->usia_pasien,
            'no_hp_kontak' => $request->no_hp_kontak,
            'diagnosa_medis' => $request->diagnosa_medis ?? $order->diagnosa_medis,
            'jumlah_pendamping' => $request->jumlah_pendamping ?? $order->jumlah_pendamping,
            'keperluan_penggunaan' => $request->keperluan_penggunaan ?? $order->keperluan_penggunaan,
            'catatan_tambahan' => $request->catatan_tambahan ?? $order->catatan_tambahan,
            'is_form_complete' => true,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Formulir data medis pasien berhasil dilengkapi.',
            'data' => [
                'order' => $this->formatOrder($order),
            ]
        ]);
    }

    /**
     * Submit rating & review for the driver
     */
    public function submitRating(Request $request, $id)
    {
        $user = $request->user();
        $order = Pemesanan::where('id', $id)->where('user_id', $user->id)->first();

        if (!$order) {
            return response()->json([
                'success' => false,
                'message' => 'Pesanan tidak ditemukan.'
            ], 404);
        }

        if ($order->status !== 'selesai') {
            return response()->json([
                'success' => false,
                'message' => 'Hanya pesanan yang sudah selesai yang dapat diberikan penilaian.'
            ], 400);
        }

        $validator = Validator::make($request->all(), [
            'skor' => 'required|integer|min:1|max:5',
            'ulasan' => 'nullable|string|max:500',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi rating gagal',
                'errors' => $validator->errors()
            ], 422);
        }

        $rating = Rating::updateOrCreate(
            ['pemesanan_id' => $order->id],
            [
                'user_id' => $user->id,
                'supir_id' => $order->supir_id,
                'skor' => $request->skor,
                'ulasan' => $request->ulasan,
            ]
        );

        // Update driver average rating
        if ($order->supir) {
            $avgScore = Rating::where('supir_id', $order->supir_id)->avg('skor');
            $order->supir->update([
                'rating_rata_rata' => round($avgScore, 2)
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Terima kasih atas penilaian Anda!',
            'data' => [
                'rating' => $rating,
            ]
        ]);
    }

    /**
     * Cancel an order if it has not departed yet
     */
    public function cancelOrder(Request $request, $id, PemesananService $service)
    {
        $user = $request->user();
        $order = Pemesanan::where('id', $id)->where('user_id', $user->id)->first();

        if (!$order) {
            return response()->json([
                'success' => false,
                'message' => 'Pesanan tidak ditemukan.'
            ], 404);
        }

        if (in_array($order->status, ['menuju_lokasi', 'membawa_pasien', 'selesai'])) {
            return response()->json([
                'success' => false,
                'message' => 'Pesanan tidak dapat dibatalkan karena ambulans sudah dalam perjalanan atau selesai.'
            ], 400);
        }

        $service->updateStatus($order->id, 'dibatalkan', 'Dibatalkan oleh pemesan: ' . ($request->alasan ?? 'Permintaan pengguna'), $user->id);

        return response()->json([
            'success' => true,
            'message' => 'Pesanan ambulans berhasil dibatalkan.'
        ]);
    }

    /**
     * Get list of referral hospitals
     */
    public function getRumahSakit()
    {
        $hospitals = RumahSakit::all();

        return response()->json([
            'success' => true,
            'data' => [
                'rumah_sakit' => $hospitals->map(function ($rs) {
                    return [
                        'id' => $rs->id,
                        'nama' => $rs->nama,
                        'alamat' => $rs->alamat,
                        'telepon' => $rs->telepon,
                        'lat' => (float) $rs->lat,
                        'lng' => (float) $rs->lng,
                        'kapasitas_igd' => $rs->kapasitas_igd,
                    ];
                })
            ]
        ]);
    }

    /**
     * Get donation programs & history
     */
    public function getDonasi(Request $request)
    {
        $user = $request->user();
        $userDonations = Donasi::where('user_id', $user->id)->latest()->get();

        $totalTerkumpul = Donasi::where('status_pembayaran', 'paid')->sum('nominal');

        return response()->json([
            'success' => true,
            'data' => [
                'total_donasi_terkumpul' => (int) $totalTerkumpul,
                'riwayat_donasi_saya' => $userDonations,
                'rekening_donasi' => [
                    [
                        'bank' => 'BSI (Bank Syariah Indonesia)',
                        'nomor_rekening' => '7144445551',
                        'atas_nama' => 'Ambulans Siaga',
                    ],
                    [
                        'bank' => 'BRI (Bank Rakyat Indonesia)',
                        'nomor_rekening' => '010601002345508',
                        'atas_nama' => 'Ambulans Siaga Operasional',
                    ]
                ]
            ]
        ]);
    }

    /**
     * Helper to format order JSON
     */
    private function formatOrder(Pemesanan $order, bool $includeFullDetails = false): array
    {
        $driverData = null;
        if ($order->supir) {
            $driverUser = $order->supir->user;
            $driverData = [
                'id' => $order->supir->id,
                'nama' => $driverUser ? $driverUser->name : 'Supir Ambulans',
                'no_wa' => $order->supir->no_wa ?: ($driverUser ? $driverUser->phone : ''),
                'foto_url' => $driverUser ? $driverUser->avatar_url : null,
                'plat_nomor' => $order->supir->plat_nomor,
                'merk_kendaraan' => $order->supir->merk_kendaraan,
                'rating_rata_rata' => (float) $order->supir->rating_rata_rata,
                'lokasi_terakhir' => $order->supir->lokasi_terakhir_lat ? [
                    'lat' => (float) $order->supir->lokasi_terakhir_lat,
                    'lng' => (float) $order->supir->lokasi_terakhir_lng,
                ] : null,
            ];
        }

        $ambulanceData = null;
        if ($order->ambulans) {
            $ambulanceData = [
                'id' => $order->ambulans->id,
                'kode_ambulans' => $order->ambulans->kode_ambulans,
                'plat_nomor' => $order->ambulans->plat_nomor,
                'jenis_ambulans' => $order->ambulans->jenis_ambulans,
                'perlengkapan_medis' => $order->ambulans->perlengkapan_medis,
            ];
        }

        $hospitalData = null;
        if ($order->rumahSakit) {
            $hospitalData = [
                'id' => $order->rumahSakit->id,
                'nama' => $order->rumahSakit->nama,
                'alamat' => $order->rumahSakit->alamat,
                'telepon' => $order->rumahSakit->telepon,
                'lat' => (float) $order->rumahSakit->lat,
                'lng' => (float) $order->rumahSakit->lng,
            ];
        }

        $res = [
            'id' => $order->id,
            'kode_order' => $order->kode_order,
            'status' => $order->status,
            'status_label' => $order->status_label,
            'status_color' => $order->status_color,
            'prioritas' => $order->prioritas ?? 'tinggi',
            'is_form_complete' => (bool) $order->is_form_complete,
            'needs_form_completion' => $order->needsFormCompletion(),
            'nama_pasien' => $order->nama_pasien,
            'nik_pasien' => $order->nik_pasien,
            'usia_pasien' => $order->usia_pasien,
            'no_hp_kontak' => $order->no_hp_kontak,
            'kondisi_pasien' => $order->kondisi_pasien,
            'diagnosa_medis' => $order->diagnosa_medis,
            'keperluan_penggunaan' => $order->keperluan_penggunaan,
            'jumlah_pendamping' => (int) $order->jumlah_pendamping,
            'lokasi_jemput' => $order->lokasi_jemput,
            'jemput_lat' => (float) $order->jemput_lat,
            'jemput_lng' => (float) $order->jemput_lng,
            'tujuan_lokasi' => $order->tujuan_lokasi,
            'tujuan_lat' => $order->tujuan_lat ? (float) $order->tujuan_lat : null,
            'tujuan_lng' => $order->tujuan_lng ? (float) $order->tujuan_lng : null,
            'catatan_tambahan' => $order->catatan_tambahan,
            'waktu_pesan' => $order->waktu_pesan?->toIso8601String() ?? $order->created_at?->toIso8601String(),
            'waktu_respon' => $order->waktu_respon?->toIso8601String(),
            'waktu_jemput' => $order->waktu_jemput?->toIso8601String(),
            'waktu_selesai' => $order->waktu_selesai?->toIso8601String(),
            'photo_url' => $order->photo_path ? asset('storage/' . $order->photo_path) : null,
            'supir' => $driverData,
            'ambulans' => $ambulanceData,
            'rumah_sakit' => $hospitalData,
            'rating' => $order->rating ? [
                'skor' => $order->rating->skor,
                'ulasan' => $order->rating->ulasan,
            ] : null,
            'latest_tracking' => $order->latestTracking ? [
                'lat' => (float) $order->latestTracking->lat,
                'lng' => (float) $order->latestTracking->lng,
                'kecepatan' => (int) $order->latestTracking->kecepatan,
                'heading' => (int) $order->latestTracking->heading,
                'recorded_at' => $order->latestTracking->recorded_at?->toIso8601String(),
            ] : null,
        ];

        if ($includeFullDetails) {
            $res['status_timeline'] = $order->statusPerjalanan->map(function ($st) {
                return [
                    'id' => $st->id,
                    'status' => $st->status,
                    'keterangan' => $st->keterangan,
                    'created_at' => $st->created_at?->toIso8601String(),
                    'created_by_name' => $st->user?->name ?? 'Sistem',
                ];
            });

            $res['tracking_history'] = $order->trackingGps->map(function ($tr) {
                return [
                    'lat' => (float) $tr->lat,
                    'lng' => (float) $tr->lng,
                    'kecepatan' => (int) $tr->kecepatan,
                    'heading' => (int) $tr->heading,
                    'recorded_at' => $tr->recorded_at?->toIso8601String(),
                ];
            });
        }

        return $res;
    }
}
