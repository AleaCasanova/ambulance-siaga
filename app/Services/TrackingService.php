<?php

namespace App\Services;

use App\Models\Pemesanan;
use App\Models\Supir;
use App\Models\TrackingGps;

class TrackingService
{
    public function recordLocation(int $orderId, int $supirId, float $lat, float $lng, int $kecepatan = 35, int $heading = 0): TrackingGps
    {
        // Update lokasi terakhir pada profil supir juga
        Supir::where('id', $supirId)->update([
            'lokasi_terakhir_lat' => $lat,
            'lokasi_terakhir_lng' => $lng,
        ]);

        return TrackingGps::create([
            'pemesanan_id' => $orderId,
            'supir_id' => $supirId,
            'lat' => $lat,
            'lng' => $lng,
            'kecepatan' => $kecepatan,
            'heading' => $heading,
            'recorded_at' => now(),
        ]);
    }

    /**
     * Memajukan koordinat ambulans sedikit ke arah tujuan (Jemput/RS) agar simulasi terlihat bergerak nyata di Peta Leaflet.
     */
    public function simulateMovement(int $orderId): ?TrackingGps
    {
        $order = Pemesanan::with(['latestTracking', 'supir', 'rumahSakit'])->find($orderId);
        if (!$order || !$order->supir_id) {
            return null;
        }

        $lastGps = $order->latestTracking;
        $currentLat = $lastGps ? (float) $lastGps->lat : ($order->supir->lokasi_terakhir_lat ?? -7.7188);
        $currentLng = $lastGps ? (float) $lastGps->lng : ($order->supir->lokasi_terakhir_lng ?? 109.0159);

        // Tentukan target pergerakan berdasarkan status order
        if ($order->status === 'menuju_lokasi') {
            $targetLat = (float) $order->jemput_lat;
            $targetLng = (float) $order->jemput_lng;
        } elseif ($order->status === 'membawa_pasien') {
            $targetLat = $order->tujuan_lat ? (float) $order->tujuan_lat : ($order->rumahSakit?->lat ?? -7.7289);
            $targetLng = $order->tujuan_lng ? (float) $order->tujuan_lng : ($order->rumahSakit?->lng ?? 109.0094);
        } else {
            return null;
        }

        // Hitung selisih dan gerakkan 15% menuju target di setiap klik/simulasi
        $diffLat = $targetLat - $currentLat;
        $diffLng = $targetLng - $currentLng;

        $newLat = $currentLat + ($diffLat * 0.18);
        $newLng = $currentLng + ($diffLng * 0.18);

        // Hitung sudut heading estimasi
        $heading = round(rad2deg(atan2($diffLng, $diffLat)));
        if ($heading < 0) {
            $heading += 360;
        }

        return $this->recordLocation(
            $orderId,
            $order->supir_id,
            round($newLat, 7),
            round($newLng, 7),
            rand(35, 60),
            $heading
        );
    }
}
