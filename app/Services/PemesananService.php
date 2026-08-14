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
    public function createOrder(array $data, ?int $userId = null): Pemesanan
    {
        return DB::transaction(function () use ($data, $userId) {
            $user = User::find($userId);
            $masyarakat = $user?->masyarakat;

            $kodeOrder = 'AMB-ORD-' . date('Ymd') . '-' . str_pad(Pemesanan::whereDate('created_at', today())->count() + 1, 3, '0', STR_PAD_LEFT);

            $usiaPasien = $data['usia_pasien'] ?? '-';
            if (($usiaPasien === '-' || !$usiaPasien) && $masyarakat?->tanggal_lahir) {
                try {
                    $usiaPasien = Carbon::parse($masyarakat->tanggal_lahir)->age . ' Tahun';
                } catch (\Exception $e) {
                    $usiaPasien = '-';
                }
            }

            $order = Pemesanan::create([
                'kode_order' => $kodeOrder,
                'user_id' => $userId,
                'nama_pasien' => $data['nama_pasien'],
                'nik_pasien' => $data['nik_pasien'] ?? ($masyarakat?->nik ?: '-'),
                'usia_pasien' => $usiaPasien,
                'no_hp_kontak' => $data['no_hp_kontak'] ?? ($user?->phone ?: '-'),
                'jumlah_pendamping' => $data['jumlah_pendamping'] ?? 1,
                'keperluan_penggunaan' => $data['keperluan_penggunaan'] ?? 'IGD Darurat',
                'diagnosa_medis' => $data['diagnosa_medis'] ?? '-',
                'kondisi_pasien' => $data['kondisi_pasien'] ?? null,
                'tanggal_jemput' => $data['tanggal_jemput'] ?? today()->format('Y-m-d'),
                'jam_jemput' => $data['jam_jemput'] ?? now()->format('H:i'),
                'lokasi_jemput' => $data['lokasi_jemput'],
                'jemput_lat' => $data['jemput_lat'],
                'jemput_lng' => $data['jemput_lng'],
                'rumah_sakit_id' => $data['rumah_sakit_id'] ?? null,
                'tujuan_lokasi' => $data['tujuan_lokasi'] ?? 'Ditentukan Dispatcher (RS Rujukan Terdekat)',
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

            // Beritahu operator & admin bahwa ada order baru yang butuh di-assign
            $operators = User::whereHas('role', fn($q) => $q->whereIn('name', ['operator', 'admin']))->get();
            foreach ($operators as $operator) {
                Notifikasi::create([
                    'user_id' => $operator->id,
                    'title' => 'Order Ambulans Darurat Baru',
                    'message' => "Order #{$kodeOrder} atas nama {$data['nama_pasien']} menunggu penugasan armada.",
                    'type' => 'danger',
                    'url' => route('operator.orders.index'),
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

            // Validasi Supir
            if (!$supir->status_online) {
                throw new \Exception("Supir {$supir->user->name} sedang dalam status OFFLINE dan tidak bisa ditugaskan.");
            }

            $activeTrip = Pemesanan::where('supir_id', $supirId)
                ->whereIn('status', ['diproses', 'menuju_lokasi', 'membawa_pasien'])
                ->first();
                
            if ($activeTrip) {
                throw new \Exception("Supir {$supir->user->name} sedang bertugas pada Order #{$activeTrip->kode_order}.");
            }

            $order->update([
                'ambulans_id' => $ambulansId,
                'supir_id' => $supirId,
                'dispatcher_id' => $dispatcherId,
                'status' => 'menunggu_konfirmasi_supir',
                'waktu_respon' => now(),
            ]);

            $amb->update(['status' => 'Ditugaskan']);

            StatusPerjalanan::create([
                'pemesanan_id' => $order->id,
                'status' => 'menunggu_konfirmasi_supir',
                'keterangan' => "Dispatcher menugaskan armada {$amb->kode_ambulans} dengan supir {$supir->user->name}. Menunggu konfirmasi.",
                'created_by' => $dispatcherId,
            ]);

            AuditLogService::log('ASSIGN_ORDER', 'Pemesanan', "Menugaskan armada {$amb->kode_ambulans} untuk Order #{$order->kode_order}", $dispatcherId);

            // Notifikasi ke Masyarakat (Pemesan) jika pengguna terdaftar
            if ($order->user_id) {
                Notifikasi::create([
                    'user_id' => $order->user_id,
                    'title' => 'Ambulans Telah Ditugaskan',
                    'message' => "Ambulans {$amb->kode_ambulans} dan Supir {$supir->user->name} telah ditugaskan untuk penjemputan.",
                    'type' => 'success',
                    'url' => route('masyarakat.tracking', $order->id),
                ]);
            }

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

            // Notifikasi ke Masyarakat jika terdaftar
            if ($order->user_id) {
                Notifikasi::create([
                    'user_id' => $order->user_id,
                    'title' => 'Update Status Perjalanan Ambulans',
                    'message' => "Pesanan #{$order->kode_order} saat ini berstatus: " . $order->status_label,
                    'type' => 'info',
                    'url' => route('masyarakat.tracking', $order->id),
                ]);
            }

            return $order;
        });
    }
}
