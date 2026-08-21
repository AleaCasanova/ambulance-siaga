<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Ambulans;
use App\Models\Pemesanan;
use App\Models\StatusPerjalanan;
use App\Models\Supir;
use App\Models\TrackingGps;
use App\Services\AuditLogService;
use App\Services\PemesananService;
use App\Services\TrackingService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class SupirController extends Controller
{
    /**
     * Get Driver Dashboard Summary & Active Status
     */
    public function dashboard(Request $request)
    {
        $user = $request->user();
        $supir = $user->supir;

        if (!$supir) {
            return response()->json([
                'success' => false,
                'message' => 'Akun Anda tidak terdaftar sebagai Supir Ambulans.'
            ], 403);
        }

        // Today's trips
        $todayTrips = Pemesanan::where('supir_id', $supir->id)
            ->whereDate('created_at', today())
            ->count();

        // Active task if any
        $activeTask = Pemesanan::with(['ambulans', 'rumahSakit', 'user', 'latestTracking'])
            ->where('supir_id', $supir->id)
            ->whereIn('status', ['diproses', 'menuju_lokasi', 'membawa_pasien'])
            ->first();

        // Pending confirmation task
        $pendingConfirmationTask = Pemesanan::with(['ambulans', 'rumahSakit', 'user'])
            ->where('supir_id', $supir->id)
            ->where('status', 'menunggu_konfirmasi_supir')
            ->first();

        return response()->json([
            'success' => true,
            'data' => [
                'supir' => [
                    'id' => $supir->id,
                    'nama' => $user->name,
                    'phone' => $user->phone,
                    'status_online' => (bool) $supir->status_online,
                    'plat_nomor' => $supir->plat_nomor,
                    'merk_kendaraan' => $supir->merk_kendaraan,
                    'nomor_sim' => $supir->nomor_sim,
                    'rating_rata_rata' => (float) $supir->rating_rata_rata,
                    'total_perjalanan' => (int) $supir->total_perjalanan,
                    'total_tugas_hari_ini' => $todayTrips,
                    'ambulans' => $supir->ambulans ? [
                        'id' => $supir->ambulans->id,
                        'kode_ambulans' => $supir->ambulans->kode_ambulans,
                        'plat_nomor' => $supir->ambulans->plat_nomor,
                        'jenis_ambulans' => $supir->ambulans->jenis_ambulans,
                        'status' => $supir->ambulans->status,
                    ] : null,
                ],
                'has_active_trip' => $activeTask !== null,
                'active_trip' => $activeTask ? $this->formatDriverOrder($activeTask) : null,
                'has_pending_confirmation' => $pendingConfirmationTask !== null,
                'pending_task' => $pendingConfirmationTask ? $this->formatDriverOrder($pendingConfirmationTask) : null,
            ]
        ]);
    }

    /**
     * Toggle Online / Offline driver status
     */
    public function toggleStatusOnline(Request $request)
    {
        $user = $request->user();
        $supir = $user->supir;

        if (!$supir) {
            return response()->json([
                'success' => false,
                'message' => 'Akun bukan supir.'
            ], 403);
        }

        $supir->status_online = !$supir->status_online;
        $supir->save();

        return response()->json([
            'success' => true,
            'message' => 'Status kesiapan Anda sekarang: ' . ($supir->status_online ? 'ONLINE (SIAGA BERTUGAS)' : 'OFFLINE (ISTIRAHAT)'),
            'data' => [
                'status_online' => (bool) $supir->status_online,
            ]
        ]);
    }

    /**
     * Get list of incoming tasks / pending assignments
     */
    public function getTasks(Request $request)
    {
        $user = $request->user();
        $supir = $user->supir;

        if (!$supir) {
            return response()->json([
                'success' => false,
                'message' => 'Akun bukan supir.'
            ], 403);
        }

        // Assigned to this driver awaiting confirmation or in progress
        $assignedTasks = Pemesanan::with(['ambulans', 'rumahSakit', 'user'])
            ->where('supir_id', $supir->id)
            ->whereIn('status', ['menunggu_konfirmasi_supir', 'diproses', 'menuju_lokasi', 'membawa_pasien'])
            ->latest()
            ->get();

        // Available emergency orders in queue (if allowed to self-pickup)
        $availableTasks = Pemesanan::with(['ambulans', 'rumahSakit', 'user'])
            ->whereNull('supir_id')
            ->where('status', 'menunggu')
            ->latest()
            ->take(10)
            ->get();

        return response()->json([
            'success' => true,
            'data' => [
                'assigned_tasks' => $assignedTasks->map(fn($t) => $this->formatDriverOrder($t)),
                'available_tasks' => $availableTasks->map(fn($t) => $this->formatDriverOrder($t)),
            ]
        ]);
    }

    /**
     * Accept assigned task
     */
    public function acceptTask(Request $request, $id, PemesananService $service)
    {
        $user = $request->user();
        $supir = $user->supir;

        if (!$supir) {
            return response()->json(['success' => false, 'message' => 'Bukan supir'], 403);
        }

        $order = Pemesanan::where('id', $id)
            ->where(function ($q) use ($supir) {
                $q->where('supir_id', $supir->id)
                  ->orWhereNull('supir_id');
            })
            ->first();

        if (!$order) {
            return response()->json(['success' => false, 'message' => 'Tugas tidak ditemukan.'], 404);
        }

        // If self taking from queue
        if (!$order->supir_id && $order->status === 'menunggu') {
            $amb = Ambulans::where('status', 'Tersedia')->first() ?? Ambulans::first();
            $order->update([
                'supir_id' => $supir->id,
                'ambulans_id' => $amb?->id,
                'status' => 'diproses',
                'waktu_respon' => now(),
            ]);

            if ($amb) {
                $amb->update(['status' => 'Ditugaskan']);
            }

            StatusPerjalanan::create([
                'pemesanan_id' => $order->id,
                'status' => 'diproses',
                'keterangan' => "Supir {$user->name} mengambil tugas penjemputan darurat ini",
                'created_by' => $user->id,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Tugas berhasil Anda ambil! Segera lakukan penjemputan.',
                'data' => [
                    'order' => $this->formatDriverOrder($order->fresh(['ambulans', 'rumahSakit', 'user'])),
                ]
            ]);
        }

        // If accepting assignment from dispatcher
        if ($order->status === 'menunggu_konfirmasi_supir') {
            $service->updateStatus($order->id, 'diproses', 'Supir menerima penugasan dan bersiap', $user->id);

            return response()->json([
                'success' => true,
                'message' => 'Tugas berhasil diterima! Silakan berangkat menuju lokasi penjemputan.',
                'data' => [
                    'order' => $this->formatDriverOrder($order->fresh(['ambulans', 'rumahSakit', 'user'])),
                ]
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Status tugas tidak sesuai untuk konfirmasi.'
        ], 400);
    }

    /**
     * Reject assigned task
     */
    public function rejectTask(Request $request, $id)
    {
        $user = $request->user();
        $supir = $user->supir;

        if (!$supir) {
            return response()->json(['success' => false, 'message' => 'Bukan supir'], 403);
        }

        $order = Pemesanan::where('id', $id)->where('supir_id', $supir->id)->first();

        if (!$order || $order->status !== 'menunggu_konfirmasi_supir') {
            return response()->json(['success' => false, 'message' => 'Tugas tidak ditemukan atau tidak dapat ditolak.'], 400);
        }

        $amb = $order->ambulans;
        $order->update([
            'supir_id' => null,
            'ambulans_id' => null,
            'status' => 'menunggu',
            'waktu_respon' => null,
        ]);

        if ($amb) {
            $amb->update(['status' => 'Tersedia']);
        }

        StatusPerjalanan::create([
            'pemesanan_id' => $order->id,
            'status' => 'menunggu',
            'keterangan' => 'Supir menolak penugasan: ' . ($request->alasan ?? 'Tidak dapat bertugas saat ini') . '. Pesanan dikembalikan ke antrean.',
            'created_by' => $user->id,
        ]);

        AuditLogService::log('REJECT_ORDER', 'Pemesanan', "Supir {$user->name} menolak tugas #{$order->kode_order}", $user->id);

        return response()->json([
            'success' => true,
            'message' => 'Tugas ditolak dan dikembalikan ke antrean dispatcher.'
        ]);
    }

    /**
     * Get Current Active Trip Detail
     */
    public function getActiveTrip(Request $request)
    {
        $user = $request->user();
        $supir = $user->supir;

        if (!$supir) {
            return response()->json(['success' => false, 'message' => 'Bukan supir'], 403);
        }

        $order = Pemesanan::with([
            'ambulans',
            'rumahSakit',
            'user',
            'statusPerjalanan',
            'latestTracking'
        ])
            ->where('supir_id', $supir->id)
            ->whereIn('status', ['diproses', 'menuju_lokasi', 'membawa_pasien'])
            ->first();

        return response()->json([
            'success' => true,
            'data' => [
                'has_active_trip' => $order !== null,
                'trip' => $order ? $this->formatDriverOrder($order, true) : null,
            ]
        ]);
    }

    /**
     * Update trip stage (menuju_lokasi -> membawa_pasien -> selesai)
     */
    public function updateTripStatus(Request $request, $id, PemesananService $service)
    {
        $user = $request->user();
        $supir = $user->supir;

        if (!$supir) {
            return response()->json(['success' => false, 'message' => 'Bukan supir'], 403);
        }

        $validator = Validator::make($request->all(), [
            'status' => 'required|in:menuju_lokasi,membawa_pasien,selesai',
            'keterangan' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => 'Status tidak valid', 'errors' => $validator->errors()], 422);
        }

        $order = Pemesanan::where('id', $id)->where('supir_id', $supir->id)->first();

        if (!$order) {
            return response()->json(['success' => false, 'message' => 'Tugas perjalanan tidak ditemukan.'], 404);
        }

        $newStatus = $request->status;
        $keterangan = $request->keterangan;

        if (!$keterangan) {
            if ($newStatus === 'menuju_lokasi') {
                $keterangan = 'Ambulans mulai bergerak dari pangkalan menuju titik jemput pasien.';
            } elseif ($newStatus === 'membawa_pasien') {
                $keterangan = 'Pasien telah dijemput dan sedang dievakuasi menuju Rumah Sakit rujukan.';
            } elseif ($newStatus === 'selesai') {
                $keterangan = 'Evakuasi selesai. Pasien telah diserahkan dengan aman ke pihak IGD / Rumah Sakit.';
            }
        }

        $service->updateStatus($order->id, $newStatus, $keterangan, $user->id);

        return response()->json([
            'success' => true,
            'message' => 'Status perjalanan berhasil diperbarui ke: ' . strtoupper(str_replace('_', ' ', $newStatus)),
            'data' => [
                'trip' => $this->formatDriverOrder($order->fresh(['ambulans', 'rumahSakit', 'user', 'statusPerjalanan'])),
            ]
        ]);
    }

    /**
     * Realtime GPS Location update from Driver Mobile App
     */
    public function updateLocation(Request $request, TrackingService $service)
    {
        $user = $request->user();
        $supir = $user->supir;

        if (!$supir) {
            return response()->json(['success' => false, 'message' => 'Bukan supir'], 403);
        }

        $validator = Validator::make($request->all(), [
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'kecepatan' => 'nullable|numeric',
            'heading' => 'nullable|numeric',
            'order_id' => 'nullable|exists:pemesanan,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => 'Data GPS tidak valid', 'errors' => $validator->errors()], 422);
        }

        $lat = (float) $request->latitude;
        $lng = (float) $request->longitude;
        $kecepatan = (int) ($request->kecepatan ?? 0);
        $heading = (int) ($request->heading ?? 0);

        // Update driver's last known location
        $supir->update([
            'lokasi_terakhir_lat' => round($lat, 7),
            'lokasi_terakhir_lng' => round($lng, 7),
        ]);

        // If driver has an active order or order_id is specified, record GPS trail
        $orderId = $request->order_id;
        if (!$orderId) {
            $activeOrder = Pemesanan::where('supir_id', $supir->id)
                ->whereIn('status', ['diproses', 'menuju_lokasi', 'membawa_pasien'])
                ->first();
            $orderId = $activeOrder?->id;
        }

        if ($orderId) {
            $service->recordLocation(
                $orderId,
                $supir->id,
                round($lat, 7),
                round($lng, 7),
                $kecepatan,
                $heading
            );
        }

        return response()->json([
            'success' => true,
            'message' => 'Koordinat GPS berhasil disinkronkan.',
            'data' => [
                'latitude' => $lat,
                'longitude' => $lng,
                'recorded_to_order_id' => $orderId,
            ]
        ]);
    }

    /**
     * Get Trip History of Driver
     */
    public function getTripHistory(Request $request)
    {
        $user = $request->user();
        $supir = $user->supir;

        if (!$supir) {
            return response()->json(['success' => false, 'message' => 'Bukan supir'], 403);
        }

        $trips = Pemesanan::with(['ambulans', 'rumahSakit', 'user', 'rating'])
            ->where('supir_id', $supir->id)
            ->whereIn('status', ['selesai', 'dibatalkan'])
            ->latest()
            ->paginate(15);

        return response()->json([
            'success' => true,
            'data' => [
                'trips' => $trips->map(fn($t) => $this->formatDriverOrder($t)),
                'current_page' => $trips->currentPage(),
                'last_page' => $trips->lastPage(),
                'total' => $trips->total(),
            ]
        ]);
    }

    /**
     * Helper to format Driver Order response
     */
    private function formatDriverOrder(Pemesanan $order, bool $includeFull = false): array
    {
        $userData = null;
        if ($order->user) {
            $userData = [
                'id' => $order->user->id,
                'name' => $order->user->name,
                'phone' => $order->user->phone,
                'avatar_url' => $order->user->avatar_url,
            ];
        }

        $res = [
            'id' => $order->id,
            'kode_order' => $order->kode_order,
            'status' => $order->status,
            'status_label' => $order->status_label,
            'status_color' => $order->status_color,
            'prioritas' => $order->prioritas ?? 'tinggi',
            'nama_pasien' => $order->nama_pasien,
            'nik_pasien' => $order->nik_pasien,
            'usia_pasien' => $order->usia_pasien,
            'no_hp_kontak' => $order->no_hp_kontak ?: ($userData['phone'] ?? '-'),
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
            'pemesan' => $userData,
            'ambulans' => $order->ambulans ? [
                'id' => $order->ambulans->id,
                'kode_ambulans' => $order->ambulans->kode_ambulans,
                'plat_nomor' => $order->ambulans->plat_nomor,
                'jenis_ambulans' => $order->ambulans->jenis_ambulans,
            ] : null,
            'rumah_sakit' => $order->rumahSakit ? [
                'id' => $order->rumahSakit->id,
                'nama' => $order->rumahSakit->nama,
                'alamat' => $order->rumahSakit->alamat,
                'telepon' => $order->rumahSakit->telepon,
                'lat' => (float) $order->rumahSakit->lat,
                'lng' => (float) $order->rumahSakit->lng,
            ] : null,
            'rating' => $order->rating ? [
                'skor' => $order->rating->skor,
                'ulasan' => $order->rating->ulasan,
            ] : null,
            'latest_tracking' => $order->latestTracking ? [
                'lat' => (float) $order->latestTracking->lat,
                'lng' => (float) $order->latestTracking->lng,
                'recorded_at' => $order->latestTracking->recorded_at?->toIso8601String(),
            ] : null,
        ];

        if ($includeFull && $order->statusPerjalanan) {
            $res['status_timeline'] = $order->statusPerjalanan->map(function ($st) {
                return [
                    'id' => $st->id,
                    'status' => $st->status,
                    'keterangan' => $st->keterangan,
                    'created_at' => $st->created_at?->toIso8601String(),
                ];
            });
        }

        return $res;
    }
}
