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
    }

    /**
     * Simulasi GPS — hanya untuk keperluan demo/testing.
     * Di production, gunakan GPS nyata via toggleGpsTracking().
     */
    public function simulateGpsStep(TrackingService $service)
    {
        $newGps = $service->simulateMovement($this->orderId);
        if ($newGps) {
            $this->dispatch('gps-updated', [
                'lat' => (float) $newGps->lat,
                'lng' => (float) $newGps->lng
            ]);
            session()->flash('success', 'Simulasi GPS: Posisi ambulans diperbarui 1 langkah ke arah tujuan.');
        } else {
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

        $currentLat = $order->latestTracking ? (float) $order->latestTracking->lat : ($order->supir?->lokasi_terakhir_lat ?? -7.7188);
        $currentLng = $order->latestTracking ? (float) $order->latestTracking->lng : ($order->supir?->lokasi_terakhir_lng ?? 109.0159);

        return view('livewire.supir.order-show', [
            'order'      => $order,
            'currentLat' => $currentLat,
            'currentLng' => $currentLng,
        ]);
    }
}
