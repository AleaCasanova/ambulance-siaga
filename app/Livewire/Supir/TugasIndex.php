<?php

namespace App\Livewire\Supir;

use App\Models\Ambulans;
use App\Models\Pemesanan;
use App\Models\StatusPerjalanan;
use App\Models\Supir;
use Livewire\Component;

class TugasIndex extends Component
{
    public function toggleStatusOnline()
    {
        $user = auth()->user();
        $supir = $user?->supir;
        if ($supir) {
            $supir->status_online = !$supir->status_online;
            $supir->save();
            session()->flash('success', 'Status kesiapan Anda berhasil diubah menjadi: ' . ($supir->status_online ? 'ONLINE (SIAGA)' : 'OFFLINE'));
        }
    }

    public function takeOrder($orderId)
    {
        $user = auth()->user();
        $supir = $user?->supir;
        if (!$supir) {
            return;
        }

        $order = Pemesanan::where('id', $orderId)
            ->where('status', 'menunggu')
            ->whereNull('supir_id')
            ->first();

        if ($order) {
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
                'keterangan' => "Supir mengambil tugas penjemputan darurat ini",
                'created_by' => $user->id,
            ]);

            session()->flash('success', "Tugas pesanan #{$order->kode_order} berhasil Anda ambil! Segera lakukan penjemputan.");
            $this->redirectRoute('supir.perjalanan.aktif');
            return;
        }
    }

    public function acceptOrder($orderId, \App\Services\PemesananService $service)
    {
        $order = Pemesanan::where('id', $orderId)->where('supir_id', auth()->user()->supir?->id)->first();
        if ($order && $order->status === 'menunggu_konfirmasi_supir') {
            $service->updateStatus($order->id, 'diproses', 'Supir menerima penugasan', auth()->id());
            session()->flash('success', 'Tugas berhasil diterima. Harap segera menuju lokasi!');
            $this->redirectRoute('supir.perjalanan.aktif');
            return;
        }
    }

    public function rejectOrder($orderId)
    {
        $order = Pemesanan::where('id', $orderId)->where('supir_id', auth()->user()->supir?->id)->first();
        if ($order && $order->status === 'menunggu_konfirmasi_supir') {
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
                'keterangan' => 'Supir menolak penugasan. Pesanan kembali antre.',
                'created_by' => auth()->id(),
            ]);

            \App\Services\AuditLogService::log('REJECT_ORDER', 'Pemesanan', "Supir menolak tugas #{$order->kode_order}", auth()->id());
            session()->flash('warning', 'Tugas berhasil ditolak.');
        }
    }

    private function calculateDistanceKm(?float $lat1, ?float $lng1, ?float $lat2, ?float $lng2): ?float
    {
        if (!$lat1 || !$lng1 || !$lat2 || !$lng2) {
            return null;
        }

        $earthRadius = 6371; // km
        $dLat = deg2rad($lat2 - $lat1);
        $dLng = deg2rad($lng2 - $lng1);

        $a = sin($dLat / 2) * sin($dLat / 2) +
             cos(deg2rad($lat1)) * cos(deg2rad($lat2)) *
             sin($dLng / 2) * sin($dLng / 2);

        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
        return round($earthRadius * $c, 1);
    }

    public function render()
    {
        $user = auth()->user();
        $supir = $user?->supir;

        // Pastikan record supir tersedia jika user ber-role supir
        if (!$supir && $user && $user->isSupir()) {
            $supir = Supir::firstOrCreate(['user_id' => $user->id], [
                'no_wa' => $user->phone ?? '',
                'status_online' => true,
                'lokasi_terakhir_lat' => -7.7188,
                'lokasi_terakhir_lng' => 109.0159,
            ]);
        }

        $driverLat = $supir?->lokasi_terakhir_lat ?? -7.7188;
        $driverLng = $supir?->lokasi_terakhir_lng ?? 109.0159;

        // 1. Tugas Aktif yang sedang dijalankan supir ini
        $activeTrip = null;
        if ($supir) {
            $activeTrip = Pemesanan::with(['user', 'ambulans', 'rumahSakit', 'latestTracking'])
                ->where('supir_id', $supir->id)
                ->whereIn('status', ['diproses', 'menuju_lokasi', 'membawa_pasien'])
                ->latest()
                ->first();
        }

        // 2. Pesanan khusus yang ditugaskan ke supir ini tapi belum dikonfirmasi
        $assignedOrders = collect();
        if ($supir) {
            $assignedOrders = Pemesanan::with(['user', 'rumahSakit'])
                ->where('supir_id', $supir->id)
                ->where('status', 'menunggu_konfirmasi_supir')
                ->latest()
                ->get()
                ->map(function ($order) use ($driverLat, $driverLng) {
                    $dist = $this->calculateDistanceKm($driverLat, $driverLng, (float) $order->jemput_lat, (float) $order->jemput_lng);
                    $order->distance_km = $dist;
                    $order->distance_text = $dist ? "{$dist} km · ±" . max(3, ceil($dist * 2.5)) . " mnt" : "Kabupaten Cilacap";
                    return $order;
                });
        }

        // 3. Pesanan darurat terbuka yang belum ada armadanya (unassigned)
        $openOrders = Pemesanan::with(['user', 'rumahSakit'])
            ->where('status', 'menunggu')
            ->whereNull('supir_id')
            ->latest()
            ->get()
            ->map(function ($order) use ($driverLat, $driverLng) {
                $dist = $this->calculateDistanceKm($driverLat, $driverLng, (float) $order->jemput_lat, (float) $order->jemput_lng);
                $order->distance_km = $dist;
                $order->distance_text = $dist ? "{$dist} km · ±" . max(3, ceil($dist * 2.5)) . " mnt" : "Kabupaten Cilacap";
                return $order;
            });

        // 4. Riwayat tugas evakuasi selesai
        $completedOrders = collect();
        if ($supir) {
            $completedOrders = Pemesanan::with(['user', 'rumahSakit', 'rating'])
                ->where('supir_id', $supir->id)
                ->where('status', 'selesai')
                ->orderBy('updated_at', 'desc')
                ->take(10)
                ->get();
        }

        $isOnline = $supir ? (bool) $supir->status_online : false;
        $totalPendingCount = count($assignedOrders) + count($openOrders);

        // Default item for map initialization
        $initialOrder = $assignedOrders->first() ?? $openOrders->first() ?? $activeTrip;

        return view('livewire.supir.tugas-index', [
            'supir' => $supir,
            'isOnline' => $isOnline,
            'activeTrip' => $activeTrip,
            'assignedOrders' => $assignedOrders,
            'openOrders' => $openOrders,
            'completedOrders' => $completedOrders,
            'totalPendingCount' => $totalPendingCount,
            'driverLat' => $driverLat,
            'driverLng' => $driverLng,
            'initialOrder' => $initialOrder,
        ])->layout('layouts.app');
    }
}
