<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\SendOtpMail;
use App\Models\OtpVerification;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'phone' => ['nullable', 'string', 'max:20'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $masyarakatRole = \App\Models\Role::where('name', 'masyarakat')->first();
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'role_id' => $masyarakatRole?->id,
            'email_verified_at' => null,
        ]);

        event(new Registered($user));

        // Buat kode OTP 6-digit dan kirimkan via email
        $otpData = OtpVerification::generateForUser($user, 5);

        try {
            Mail::to($user->email)->send(new SendOtpMail($user, $otpData['plain_otp'], 5));
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error("Gagal mengirimkan email OTP registrasi: " . $e->getMessage());
        }

        // Simpan email di session untuk halaman OTP
        session(['verification_email' => $user->email]);

        return redirect()->route('verification.otp.show')->with('status', 'Pendaftaran akun berhasil! Silakan periksa email Anda dan masukkan kode OTP 6-digit untuk mengaktifkan akun.');
    }
}
