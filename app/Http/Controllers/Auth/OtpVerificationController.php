<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\SendOtpMail;
use App\Models\OtpVerification;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

class OtpVerificationController extends Controller
{
    /**
     * Tampilkan halaman formulir masukan kode OTP.
     */
    public function show(Request $request): View|RedirectResponse
    {
        $email = $request->query('email')
            ?? session('verification_email')
            ?? session('unverified_email')
            ?? Auth::user()?->email;

        if (!$email) {
            return redirect()->route('login')->with('error', 'Silakan masuk atau daftar terlebih dahulu.');
        }

        $user = User::where('email', $email)->first();

        if (!$user) {
            return redirect()->route('login')->with('error', 'Akun tidak ditemukan.');
        }

        // Jika user sudah terverifikasi, langsung alihkan ke dashboard / login
        if ($user->hasVerifiedEmail()) {
            if (Auth::check()) {
                return redirect()->route('dashboard')->with('status', 'Email Anda sudah terverifikasi.');
            }
            return redirect()->route('login')->with('status', 'Email Anda sudah terverifikasi. Silakan login.');
        }

        $otpRecord = OtpVerification::where('user_id', $user->id)->first();
        $expireSeconds = $otpRecord ? $otpRecord->secondsUntilExpire() : 0;
        $resendSeconds = $otpRecord ? $otpRecord->secondsUntilResend(15) : 0;

        // Simpan email ke session agar perpindahan halaman tetap mengingat target
        session(['verification_email' => $user->email]);

        return view('auth.verify-otp', [
            'user' => $user,
            'email' => $user->email,
            'otpRecord' => $otpRecord,
            'expireSeconds' => $expireSeconds,
            'resendSeconds' => $resendSeconds,
        ]);
    }

    /**
     * Memproses verifikasi kode OTP yang diinputkan pengguna.
     */
    public function verify(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => ['required', 'email'],
            'otp_code' => ['required'],
        ]);

        $otpInput = $request->otp_code;
        if (is_array($otpInput)) {
            $otpInput = implode('', $otpInput);
        }
        $otpCode = trim((string) $otpInput);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return redirect()->route('login')->with('error', 'Pengguna tidak ditemukan.');
        }

        if ($user->hasVerifiedEmail()) {
            Auth::login($user);
            return redirect()->route('dashboard')->with('status', 'Email Anda sudah terverifikasi.');
        }

        $otpRecord = OtpVerification::where('user_id', $user->id)->first();

        if (!$otpRecord) {
            return back()->withInput()->with('error', 'Kode OTP tidak ditemukan. Silakan minta kode OTP baru.');
        }

        if ($otpRecord->isExpired()) {
            return back()->withInput()->with('error', 'Kode OTP telah kedaluwarsa. Silakan klik Kirim Ulang OTP.');
        }

        if (!$otpRecord->verifyCode($otpCode)) {
            return back()->withInput()->with('error', 'Kode OTP yang Anda masukkan tidak valid. Silakan periksa kembali.');
        }

        // Verifikasi Sukses
        $user->markEmailAsVerified();
        $user->save();

        // Hapus record OTP (single use)
        $otpRecord->delete();

        // Bersihkan session penampung email
        session()->forget(['verification_email', 'unverified_email']);

        // Loginkan pengguna secara otomatis
        Auth::login($user);

        return redirect()->route('dashboard')->with('status', 'Email Anda berhasil terverifikasi! Selamat datang di Ambulance Siaga.');
    }

    /**
     * Mengirim ulang kode OTP ke email pengguna.
     */
    public function resend(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => ['required', 'email'],
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return redirect()->route('login')->with('error', 'Pengguna tidak ditemukan.');
        }

        if ($user->hasVerifiedEmail()) {
            return redirect()->route('login')->with('status', 'Email Anda sudah terverifikasi.');
        }

        $otpRecord = OtpVerification::where('user_id', $user->id)->first();

        if ($otpRecord && $otpRecord->isCooldownActive(15)) {
            $remaining = $otpRecord->secondsUntilResend(15);
            return back()->with('error', "Silakan tunggu {$remaining} detik lagi sebelum meminta kode OTP baru.");
        }

        // Buat OTP baru dan kirim email
        $otpData = OtpVerification::generateForUser($user, 5);

        try {
            Mail::to($user->email)->send(new SendOtpMail($user, $otpData['plain_otp'], 5));
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error("Gagal mengirim email OTP ke {$user->email}: " . $e->getMessage());
            return back()->with('error', 'Gagal mengirim email OTP. Silakan pastikan pengirim mail SMTP telah dikonfigurasi.');
        }

        session(['verification_email' => $user->email]);

        return back()->with('status', 'Kode OTP baru telah berhasil dikirimkan ke email Anda. Silakan cek Inbox atau Spam.');
    }
}
