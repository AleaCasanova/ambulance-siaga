<?php

namespace App\Services;

use App\Models\Pemesanan;
use App\Models\Supir;
use App\Models\TrackingGps;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

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
     * Mengambil daftar titik koordinat jalan raya dari OSRM untuk simulasi gerakan yang presisi menyusuri aspal jalan.
     */
    private function getRoadWaypoints(float $startLat, float $startLng, float $targetLat, float $targetLng): array
    {
        $cacheKey = 'osrm_waypoints_' . md5("{$startLat}_{$startLng}_{$targetLat}_{$targetLng}");
        return Cache::remember($cacheKey, 3600, function () use ($startLat, $startLng, $targetLat, $targetLng) {
            try {
                $url = "https://router.project-osrm.org/route/v1/driving/{$startLng},{$startLat};{$targetLng},{$targetLat}?overview=full&geometries=geojson";
                $response = Http::timeout(4)->get($url);
                if ($response->successful()) {
                    $coordinates = $response->json('routes.0.geometry.coordinates');
                    if (is_array($coordinates) && count($coordinates) > 1) {
                        return array_map(function ($point) {
                            return ['lat' => (float)$point[1], 'lng' => (float)$point[0]];
                        }, $coordinates);
                    }
                }
            } catch (\Throwable $e) {
                // Ignore fallback to linear
            }
            return [];
        });
    }

    /**
     * Memajukan koordinat ambulans menyusuri jalur aspal jalan OSRM secara mulus dan presisi.
     */
    public function simulateMovement(int $orderId): ?TrackingGps
    {
        $order = Pemesanan::with(['latestTracking', 'supir', 'rumahSakit'])->find($orderId);
        if (!$order || !$order->supir_id) {
            return null;
        }

        $poskoLat = -7.7050;
        $poskoLng = 108.9950;
        $lastGps = $order->latestTracking;

        if ($lastGps) {
            $currentLat = (float) $lastGps->lat;
            $currentLng = (float) $lastGps->lng;
        } else {
            if (in_array($order->status, ['menuju_lokasi', 'diproses'])) {
                $currentLat = $poskoLat; // Posko Siaga Cilacap
                $currentLng = $poskoLng;
            } else {
                $currentLat = (float) ($order->jemput_lat ?: $poskoLat);
                $currentLng = (float) ($order->jemput_lng ?: $poskoLng);
            }
        }

        // Tentukan titik awal rute dan target pergerakan berdasarkan status order
        if (in_array($order->status, ['menuju_lokasi', 'diproses'])) {
            $startLat = $poskoLat;
            $startLng = $poskoLng;
            $targetLat = (float) ($order->jemput_lat ?: -7.7188);
            $targetLng = (float) ($order->jemput_lng ?: 109.0159);
        } elseif ($order->status === 'membawa_pasien') {
            $startLat = (float) ($order->jemput_lat ?: $poskoLat);
            $startLng = (float) ($order->jemput_lng ?: $poskoLng);
            $targetLat = $order->tujuan_lat ? (float) $order->tujuan_lat : ($order->rumahSakit?->lat ?? -7.7289);
            $targetLng = $order->tujuan_lng ? (float) $order->tujuan_lng : ($order->rumahSakit?->lng ?? 109.0094);
        } else {
            return null;
        }

        // Ambil daftar titik koordinat rute jalan raya OSRM
        $waypoints = $this->getRoadWaypoints($startLat, $startLng, $targetLat, $targetLng);

        if (!empty($waypoints)) {
            // Cari index titik terdekat dari posisi saat ini
            $closestIndex = 0;
            $minDist = PHP_FLOAT_MAX;
            foreach ($waypoints as $idx => $pt) {
                $dist = hypot($pt['lat'] - $currentLat, $pt['lng'] - $currentLng);
                if ($dist < $minDist) {
                    $minDist = $dist;
                    $closestIndex = $idx;
                }
            }

            // Majukan ~10% dari total titik rute (minimal 3 waypoint per step)
            $stepSize = max(3, (int) ceil(count($waypoints) * 0.10));
            $nextIndex = $closestIndex + $stepSize;

            if ($nextIndex >= count($waypoints) - 1) {
                $newLat = $targetLat;
                $newLng = $targetLng;
            } else {
                $newLat = $waypoints[$nextIndex]['lat'];
                $newLng = $waypoints[$nextIndex]['lng'];
            }
        } else {
            // Fallback interpolasi linear jika koneksi OSRM lambat
            $diffLat = $targetLat - $currentLat;
            $diffLng = $targetLng - $currentLng;

            if (abs($diffLat) < 0.0004 && abs($diffLng) < 0.0004) {
                $newLat = $targetLat;
                $newLng = $targetLng;
            } else {
                $newLat = $currentLat + ($diffLat * 0.20);
                $newLng = $currentLng + ($diffLng * 0.20);
            }
        }

        $diffLat = $newLat - $currentLat;
        $diffLng = $newLng - $currentLng;

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
