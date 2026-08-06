<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class OtpVerification extends Model
{
    use HasFactory;

    protected $table = 'otp_verifications';

    protected $fillable = [
        'user_id',
        'email',
        'otp_code',
        'expires_at',
        'last_sent_at',
    ];

    protected function casts(): array
    {
        return [
            'expires_at' => 'datetime',
            'last_sent_at' => 'datetime',
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Cek apakah kode OTP sudah kedaluwarsa (lebih dari 5 menit).
     */
    public function isExpired(): bool
    {
        return Carbon::now()->greaterThan($this->expires_at);
    }

    /**
     * Cek apakah jeda waktu (cooldown) pengiriman ulang masih aktif.
     */
    public function isCooldownActive(int $cooldownSeconds = 60): bool
    {
        if (!$this->last_sent_at) {
            return false;
        }

        return Carbon::now()->diffInSeconds($this->last_sent_at) < $cooldownSeconds;
    }

    /**
     * Hitung sisa detik untuk cooldown kirim ulang.
     */
    public function secondsUntilResend(int $cooldownSeconds = 60): int
    {
        if (!$this->last_sent_at) {
            return 0;
        }

        $elapsed = Carbon::now()->diffInSeconds($this->last_sent_at);
        $remaining = $cooldownSeconds - $elapsed;

        return max(0, (int) $remaining);
    }

    /**
     * Hitung sisa detik hingga OTP kedaluwarsa.
     */
    public function secondsUntilExpire(): int
    {
        if ($this->isExpired()) {
            return 0;
        }

        return max(0, (int) Carbon::now()->diffInSeconds($this->expires_at));
    }

    /**
     * Verifikasi kecocokan kode OTP yang dimasukkan.
     */
    public function verifyCode(string $code): bool
    {
        return Hash::check(trim($code), $this->otp_code);
    }

    /**
     * Membuat atau memperbarui OTP untuk user.
     * Mengembalikan array berisi instance OtpVerification dan plain 6-digit OTP code untuk email.
     */
    public static function generateForUser(User $user, int $expiryMinutes = 5): array
    {
        $plainOtp = str_pad((string) random_int(0, 999999), 6, '0', STR_PAD_LEFT);
        $hashedOtp = Hash::make($plainOtp);
        $now = Carbon::now();

        $otpRecord = static::updateOrCreate(
            ['user_id' => $user->id],
            [
                'email' => $user->email,
                'otp_code' => $hashedOtp,
                'expires_at' => $now->copy()->addMinutes($expiryMinutes),
                'last_sent_at' => $now,
            ]
        );

        return [
            'record' => $otpRecord,
            'plain_otp' => $plainOtp,
        ];
    }
}
