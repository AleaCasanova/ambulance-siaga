<?php

namespace App\Livewire\Supir;

use App\Models\Pemesanan;
use App\Services\PemesananService;
use App\Services\TrackingService;
use Livewire\Component;

class OrderShow extends Component
{
    public int $orderId;

    /** Status GPS tracking aktif/nonaktif dari browser supir */
    public bool $gpsActive = false;

    public function mount($id)
    {
        $this->orderId = $id;
    }

    /**
     * Toggle GPS tracking aktif/nonaktif.
     * Saat diaktifkan, JavaScript di view akan mulai watchPosition().
     */
    public function toggleGpsTracking()
    {
        $this->gpsActive = !$this->gpsActive;

        if ($this->gpsActive) {
            $this->dispatch('gps-tracking-start');
            session()->flash('info', '🛰️ GPS Tracking diaktifkan. Posisi ambulans akan dikirim otomatis.');
        } else {
            $this->dispatch('gps-tracking-stop');
            session()->flash('info', 'GPS Tracking dinonaktifkan.');
        }
    }

    /**
     * Menerima koordinat GPS nyata dari browser supir (dipanggil oleh JS navigator.geolocation).
     * Koordinat langsung disimpan ke tabel tracking_gps dan update lokasi supir.
     */
    public function updateGpsLocation(TrackingService $service, float $lat, float $lng, float $kecepatan = 0, int $heading = 0)
    {
        $order = Pemesanan::with('supir')->find($this->orderId);

        if (!$order || !$order->supir_id) {
            return;
        }

        // Hanya record GPS jika order sedang berjalan
        if (!in_array($order->status, ['menuju_lokasi', 'membawa_pasien', 'diproses'])) {
            return;
        }

        $service->recordLocation(
            $this->orderId,
            $order->supir_id,
            round($lat, 7),
            round($lng, 7),
            (int) $kecepatan,
            $heading
        );

        // Broadcast ke client yang sedang melihat tracking order ini
        $this->dispatch('gps-updated', [
            'lat' => (float) $lat,
            'lng' => (float) $lng
        ]);
    }

    public function updateStatus(PemesananService $service, $newStatus)
    {
        $keterangan = '';
        if ($newStatus === 'menuju_lokasi') {
            $keterangan = 'Ambulans mulai bergerak dari pangkalan menuju titik jemput pasien.';
        } elseif ($newStatus === 'membawa_pasien') {
            $keterangan = 'Pasien telah dijemput dan sedang dalam perjalanan evakuasi ke Rumah Sakit.';
        } elseif ($newStatus === 'selesai') {
            $keterangan = 'Evakuasi selesai. Pasien telah tiba dengan aman di Rumah Sakit rujukan.';
        }

        $service->updateStatus($this->orderId, $newStatus, $keterangan, auth()->id());
        session()->flash('success', "Status tugas diperbarui ke: " . strtoupper(str_replace('_', ' ', $newStatus)));

        $order = Pemesanan::with('latestTracking')->find($this->orderId);
        $currentLat = $order->latestTracking ? (float)$order->latestTracking->lat : (float)($order->jemput_lat ?: -7.7188);
        $currentLng = $order->latestTracking ? (float)$order->latestTracking->lng : (float)($order->jemput_lng ?: 109.0159);

        $this->dispatch('status-changed', [
            'status' => $newStatus
        ]);

        $this->dispatch('gps-updated', [
            'lat' => $currentLat,
            'lng' => $currentLng,
            'status' => $newStatus,
        ]);
    }

    /**
     * Simulasi GPS — hanya untuk keperluan demo/testing.
     * Di production, gunakan GPS nyata via toggleGpsTracking().
     */
    public function simulateGpsStep(TrackingService $service)
    {
        $newGps = $service->simulateMovement($this->orderId);
        if ($newGps) {
            $order = Pemesanan::find($this->orderId);
            $targetLat = in_array($order->status, ['menuju_lokasi', 'diproses']) 
                ? (float) ($order->jemput_lat ?: -7.7188) 
                : ($order->tujuan_lat ? (float)$order->tujuan_lat : ($order->rumahSakit?->lat ?? -7.7289));
            $targetLng = in_array($order->status, ['menuju_lokasi', 'diproses']) 
                ? (float) ($order->jemput_lng ?: 109.0159) 
                : ($order->tujuan_lng ? (float)$order->tujuan_lng : ($order->rumahSakit?->lng ?? 109.0094));

            $arrived = (abs((float)$newGps->lat - $targetLat) < 0.0003 && abs((float)$newGps->lng - $targetLng) < 0.0003);

            $this->dispatch('gps-updated', [
                'lat' => (float) $newGps->lat,
                'lng' => (float) $newGps->lng,
                'arrived' => $arrived,
            ]);

            if ($arrived) {
                session()->flash('success', 'Ambulans telah tiba di lokasi tujuan!');
            }
        } else {
            $this->dispatch('gps-updated', ['arrived' => true]);
            session()->flash('info', 'Simulasi tidak berjalan (Status pesanan tidak sesuai).');
        }
    }

    public function render()
    {
        $order = Pemesanan::with([
            'user',
            'supir.user',
            'ambulans',
            'rumahSakit',
            'statusPerjalanan.creator',
            'latestTracking'
        ])->findOrFail($this->orderId);

        $latCandidate = $order->latestTracking ? (float) $order->latestTracking->lat : ($order->supir?->lokasi_terakhir_lat ?? null);
        $lngCandidate = $order->latestTracking ? (float) $order->latestTracking->lng : ($order->supir?->lokasi_terakhir_lng ?? null);

        // Jika pesanan baru (belum ada tracking GPS aktif) dan posisi supir sama/sangat dekat dengan titik jemput (< 300m),
        // tempatkan ambulans di Posko Siaga agar supir memulai perjalanan penjemputan dari pangkalan.
        if (!$order->latestTracking && in_array($order->status, ['diproses', 'menuju_lokasi'])) {
            if (!$latCandidate || !$lngCandidate || (abs($latCandidate - (float)$order->jemput_lat) < 0.003 && abs($lngCandidate - (float)$order->jemput_lng) < 0.003)) {
                $latCandidate = -7.7050; // Posko Siaga Cilacap
                $lngCandidate = 108.9950;
            }
        }

        // Validasi Cilacap bounds
        if (!$latCandidate || !$lngCandidate || $latCandidate > -7.5 || $latCandidate < -7.9 || $lngCandidate < 108.8 || $lngCandidate > 109.2) {
            $currentLat = -7.7050;
            $currentLng = 108.9950;
        } else {
            $currentLat = $latCandidate;
            $currentLng = $lngCandidate;
        }

        return view('livewire.supir.order-show', [
            'order'      => $order,
            'currentLat' => $currentLat,
            'currentLng' => $currentLng,
        ]);
    }
}
