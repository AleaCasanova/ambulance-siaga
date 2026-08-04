<?php

namespace App\Livewire\Masyarakat;

use App\Models\Pemesanan;
use App\Models\Rating;
use App\Services\RatingService;
use App\Services\TrackingService;
use Livewire\Component;

class OrderTracking extends Component
{
    public int $orderId;
    public int $skor = 5;
    public string $ulasan = '';
    public bool $showRatingModal = false;

    public function mount($id)
    {
        $this->orderId = $id;
        $order = Pemesanan::with('rating')->find($id);

        if ($order && $order->status === 'selesai' && !$order->rating) {
            $this->showRatingModal = true;
        }
    }

    /**
     * Helper uji coba: Simulasikan pergerakan ambulans 1 langkah mendekati titik jemput/RS
     */
    public function simulateGpsStep(TrackingService $service)
    {
        $service->simulateMovement($this->orderId);
        $this->dispatch('gps-updated');
    }

    public function submitRating(RatingService $service)
    {
        $this->validate([
            'skor' => 'required|integer|min:1|max:5',
            'ulasan' => 'nullable|string|max:500',
        ]);

        $service->submitRating($this->orderId, auth()->id(), $this->skor, $this->ulasan);

        $this->showRatingModal = false;
        session()->flash('success', 'Terima kasih atas ulasan dan rating Anda untuk pelayanan Ambulance Siaga!');
    }

    public function render()
    {
        $order = Pemesanan::with([
            'supir.user',
            'ambulans',
            'rumahSakit',
            'statusPerjalanan.creator',
            'latestTracking',
            'rating'
        ])->findOrFail($this->orderId);

        // Ambil koordinat saat ini untuk update JS Leaflet
        $currentLat = $order->latestTracking ? (float) $order->latestTracking->lat : ($order->supir->lokasi_terakhir_lat ?? -7.7188);
        $currentLng = $order->latestTracking ? (float) $order->latestTracking->lng : ($order->supir->lokasi_terakhir_lng ?? 109.0159);

        return view('livewire.masyarakat.order-tracking', [
            'order' => $order,
            'currentLat' => $currentLat,
            'currentLng' => $currentLng,
        ]);
    }
}
