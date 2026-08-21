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

        // Ambil koordinat saat ini untuk update JS Leaflet
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
