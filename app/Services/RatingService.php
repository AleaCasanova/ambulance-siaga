<?php

namespace App\Services;

use App\Models\Pemesanan;
use App\Models\Rating;
use App\Models\Supir;
use Illuminate\Support\Facades\DB;

class RatingService
{
    public function submitRating(int $pemesananId, int $userId, int $skor, ?string $ulasan = null): Rating
    {
        return DB::transaction(function () use ($pemesananId, $userId, $skor, $ulasan) {
            $order = Pemesanan::findOrFail($pemesananId);
            $supirId = $order->supir_id;

            $rating = Rating::updateOrCreate(
                ['pemesanan_id' => $pemesananId],
                [
                    'user_id' => $userId,
                    'supir_id' => $supirId,
                    'skor' => max(1, min(5, $skor)),
                    'ulasan' => $ulasan,
                ]
            );

            if ($supirId) {
                $avgScore = Rating::where('supir_id', $supirId)->avg('skor');
                Supir::where('id', $supirId)->update([
                    'rating_rata_rata' => round($avgScore ?? 5.0, 2),
                ]);
            }

            AuditLogService::log('SUBMIT_RATING', 'Rating', "Masyarakat memberi rating {$skor} bintang untuk Order #{$order->kode_order}", $userId);

            return $rating;
        });
    }
}
