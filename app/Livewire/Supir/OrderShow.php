<?php

namespace App\Livewire\Supir;

use App\Models\Pemesanan;
use App\Services\PemesananService;
use App\Services\TrackingService;
use Livewire\Component;

class OrderShow extends Component
{
    public int $orderId;

    public function mount($id)
    {
        $this->orderId = $id;
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

    public function simulateGpsStep(TrackingService $service)
    {
        $service->simulateMovement($this->orderId);
        $this->dispatch('gps-updated');
        session()->flash('success', 'Simulasi GPS: Posisi ambulans diperbarui 1 langkah ke arah tujuan.');
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

        $currentLat = $order->latestTracking ? (float) $order->latestTracking->lat : ($order->supir->lokasi_terakhir_lat ?? -7.7188);
        $currentLng = $order->latestTracking ? (float) $order->latestTracking->lng : ($order->supir->lokasi_terakhir_lng ?? 109.0159);

        return view('livewire.supir.order-show', [
            'order' => $order,
            'currentLat' => $currentLat,
            'currentLng' => $currentLng,
        ]);
    }
}
