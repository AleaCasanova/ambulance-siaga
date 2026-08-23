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
    public bool $ratingDismissed = false;

    public function mount($id)
    {
        $this->orderId = $id;
        $order = Pemesanan::with('rating')->find($id);

        if ($order && $order->status === 'selesai' && !$order->rating) {
            $this->showRatingModal = true;
        }
    }

    public function dismissRating()
    {
        $this->showRatingModal = false;
        $this->ratingDismissed = true;
    }

    /**
     * Helper uji coba: Simulasikan pergerakan ambulans 1 langkah mendekati titik jemput/RS
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
                'status' => $order->status,
                'arrived' => $arrived,
            ]);
        } else {
            $this->dispatch('gps-updated', ['arrived' => true]);
        }
    }

    public function submitRating(RatingService $service)
    {
        $this->validate([
            'skor' => 'required|integer|min:1|max:5',
            'ulasan' => 'nullable|string|max:500',
        ]);

        $service->submitRating($this->orderId, auth()->id(), $this->skor, $this->ulasan);

        $this->showRatingModal = false;
        $this->ratingDismissed = true;
        session()->flash('success', 'Terima kasih atas ulasan dan rating Anda untuk pelayanan Ambulans Siaga!');
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

        // Otomatis buka pop-up ulasan & bintang saat supir menyelesaikan tugas
        if ($order->status === 'selesai' && !$order->rating && !$this->ratingDismissed) {
            $this->showRatingModal = true;
        }

        $poskoLat = -7.7050;
        $poskoLng = 108.9950;

        if ($order->latestTracking) {
            $currentLat = (float) $order->latestTracking->lat;
            $currentLng = (float) $order->latestTracking->lng;
        } else {
            if (in_array($order->status, ['diproses', 'menuju_lokasi'])) {
                // Di tahap menuju lokasi, ambulans mulai dari Posko Siaga
                $currentLat = $poskoLat;
                $currentLng = $poskoLng;
            } elseif ($order->status === 'membawa_pasien') {
                // Di tahap membawa pasien, ambulans mulai dari titik jemput
                $currentLat = (float) ($order->jemput_lat ?: $poskoLat);
                $currentLng = (float) ($order->jemput_lng ?: $poskoLng);
            } else {
                $currentLat = $poskoLat;
                $currentLng = $poskoLng;
            }
        }

        // Dispatch event agar peta Leaflet otomatis update saat polling
        if (in_array($order->status, ['diproses', 'menuju_lokasi', 'membawa_pasien', 'selesai'])) {
            $this->dispatch('gps-updated', [
                'lat' => $currentLat,
                'lng' => $currentLng,
                'status' => $order->status,
            ]);
        }

        return view('livewire.masyarakat.order-tracking', [
            'order' => $order,
            'currentLat' => $currentLat,
            'currentLng' => $currentLng,
        ])->layout('layouts.blank');
    }
}
