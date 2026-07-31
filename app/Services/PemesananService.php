<?php

namespace App\Services;

use App\Models\Ambulans;
use App\Models\Notifikasi;
use App\Models\Pemesanan;
use App\Models\StatusPerjalanan;
use App\Models\Supir;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class PemesananService
{
    public function createOrder(array $data, int $userId): Pemesanan
    {
        return DB::transaction(function () use ($data, $userId) {
            $kodeOrder = 'GSC-ORD-' . date('Ymd') . '-' . str_pad(Pemesanan::whereDate('created_at', today())->count() + 1, 3, '0', STR_PAD_LEFT);

            $order = Pemesanan::create([
                'kode_order' => $kodeOrder,
                'user_id' => $userId,
                'nama_pasien' => $data['nama_pasien'],
                'kondisi_pasien' => $data['kondisi_pasien'] ?? null,
                'lokasi_jemput' => $data['lokasi_jemput'],
                'jemput_lat' => $data['jemput_lat'],
                'jemput_lng' => $data['jemput_lng'],
                'rumah_sakit_id' => $data['rumah_sakit_id'] ?? null,
                'tujuan_lokasi' => $data['tujuan_lokasi'] ?? null,
                'tujuan_lat' => $data['tujuan_lat'] ?? null,
                'tujuan_lng' => $data['tujuan_lng'] ?? null,
                'catatan_tambahan' => $data['catatan_tambahan'] ?? null,
                'status' => 'menunggu',
                'waktu_pesan' => now(),
            ]);

            StatusPerjalanan::create([
                'pemesanan_id' => $order->id,
                'status' => 'menunggu',
                'keterangan' => 'Pesanan ambulans baru dikirim dan menunggu verifikasi Dispatcher',
                'created_by' => $userId,
            ]);

            AuditLogService::log('CREATE_ORDER', 'Pemesanan', "Membuat pesanan ambulans baru: {$kodeOrder}", $userId);

            // Kirim notifikasi ke semua Dispatcher dan Admin
            $dispatchers = User::whereHas('role', fn($q) => $q->whereIn('name', ['dispatcher', 'admin_operasional', 'superadmin']))->get();
            foreach ($dispatchers as $dsp) {
                Notifikasi::create([
                    'user_id' => $dsp->id,
                    'title' => 'Order Ambulans Darurat Baru',
                    'message' => "Order #{$kodeOrder} atas nama {$data['nama_pasien']} menunggu penugasan armada.",
                    'type' => 'danger',
                    'url' => route('dispatcher.order.index'),
                ]);
            }

            return $order;
        });
    }

    public function assignAmbulanceAndDriver(int $orderId, int $ambulansId, int $supirId, int $dispatcherId): Pemesanan
    {
        return DB::transaction(function () use ($orderId, $ambulansId, $supirId, $dispatcherId) {
            $order = Pemesanan::findOrFail($orderId);
            $amb = Ambulans::findOrFail($ambulansId);
            $supir = Supir::findOrFail($supirId);

            $order->update([
                'ambulans_id' => $ambulansId,
                'supir_id' => $supirId,
                'dispatcher_id' => $dispatcherId,
                'status' => 'diproses',
                'waktu_respon' => now(),
            ]);

            $amb->update(['status' => 'Ditugaskan']);

            StatusPerjalanan::create([
                'pemesanan_id' => $order->id,
                'status' => 'diproses',
                'keterangan' => "Dispatcher menugaskan armada {$amb->kode_ambulans} dengan supir {$supir->user->name}",
                'created_by' => $dispatcherId,
            ]);

            AuditLogService::log('ASSIGN_ORDER', 'Pemesanan', "Menugaskan armada {$amb->kode_ambulans} untuk Order #{$order->kode_order}", $dispatcherId);

            // Notifikasi ke Masyarakat (Pemesan)
            Notifikasi::create([
                'user_id' => $order->user_id,
                'title' => 'Ambulans Telah Ditugaskan',
                'message' => "Ambulans {$amb->kode_ambulans} dan Supir {$supir->user->name} telah ditugaskan untuk penjemputan.",
                'type' => 'success',
                'url' => route('masyarakat.tracking', $order->id),
            ]);

            // Notifikasi ke Supir
            Notifikasi::create([
                'user_id' => $supir->user_id,
                'title' => 'Tugas Darurat Baru Masuk',
                'message' => "Anda ditugaskan menjemput pasien {$order->nama_pasien} (#{$order->kode_order}).",
                'type' => 'warning',
                'url' => route('supir.tugas.detail', $order->id),
            ]);

            return $order;
        });
    }

    public function updateStatus(int $orderId, string $newStatus, ?string $keterangan = null, ?int $userId = null): Pemesanan
    {
        return DB::transaction(function () use ($orderId, $newStatus, $keterangan, $userId) {
            $order = Pemesanan::findOrFail($orderId);
            $oldStatus = $order->status;
            $order->status = $newStatus;

            if ($newStatus === 'menuju_lokasi' && !$order->waktu_respon) {
                $order->waktu_respon = now();
            } elseif ($newStatus === 'membawa_pasien' && !$order->waktu_jemput) {
                $order->waktu_jemput = now();
            } elseif (in_array($newStatus, ['selesai', 'dibatalkan'])) {
                $order->waktu_selesai = now();

                // Kembalikan status ambulans ke Tersedia
                if ($order->ambulans) {
                    $order->ambulans->update(['status' => 'Tersedia']);
                }

                // Tambahkan total perjalanan supir jika selesai
                if ($newStatus === 'selesai' && $order->supir) {
                    $order->supir->increment('total_perjalanan');
                }
            }

            $order->save();

            StatusPerjalanan::create([
                'pemesanan_id' => $order->id,
                'status' => $newStatus,
                'keterangan' => $keterangan ?? "Status pesanan diubah dari {$oldStatus} ke {$newStatus}",
                'created_by' => $userId,
            ]);

            AuditLogService::log('UPDATE_STATUS', 'Pemesanan', "Mengubah status Order #{$order->kode_order} menjadi {$newStatus}", $userId);

            // Notifikasi ke Masyarakat
            Notifikasi::create([
                'user_id' => $order->user_id,
                'title' => 'Update Status Perjalanan Ambulans',
                'message' => "Pesanan #{$order->kode_order} saat ini berstatus: " . $order->status_label,
                'type' => 'info',
                'url' => route('masyarakat.tracking', $order->id),
            ]);

            return $order;
        });
    }
}
