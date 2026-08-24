<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\SendOtpMail;
use App\Models\Mitra;
use App\Models\OtpVerification;
use App\Models\Role;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class RegisteredMitraController extends Controller
{
    /**
     * Display the registration view for mitra.
     */
    public function create(): View
    {
        return view('auth.register-mitra');
    }

    /**
     * Handle an incoming registration request for mitra armada.
     *
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'nama_lembaga' => ['required', 'string', 'max:255'],
            'name' => ['required', 'string', 'max:255'], // Nama Penanggung Jawab
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'phone' => ['required', 'string', 'max:20'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $mitraRole = Role::where('name', 'mitra')->first();
        
        // User (sebagai penanggung jawab / pengelola)
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'role_id' => $mitraRole?->id,
            'is_active' => false, // Mitra armada harus diverifikasi oleh admin
            'email_verified_at' => null,
        ]);

        // Create Mitra profile untuk menyimpan info Lembaga
        Mitra::create([
            'user_id' => $user->id,
            'nama_mitra' => $request->nama_lembaga,
            'penanggung_jawab' => $user->name,
            'no_telp' => $user->phone,
            'alamat' => '-',
            'is_active' => true,
        ]);

        event(new Registered($user));

        // Generate 6-digit OTP code and send via email
        $otpData = OtpVerification::generateForUser($user, 5);

        try {
            Mail::to($user->email)->send(new SendOtpMail($user, $otpData['plain_otp'], 5));
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error("Gagal mengirimkan email OTP registrasi mitra armada: " . $e->getMessage());
        }

        // Save email in session for OTP page
        session(['verification_email' => $user->email]);

        // Kirim notifikasi sistem & email ke Administrator
        \App\Services\AdminNotificationService::notifyNewMitraRegistered($user, [
            'nama_lembaga' => $request->nama_lembaga,
        ]);

        return redirect()->route('verification.otp.show')->with('status', 'Pendaftaran mitra armada berhasil! Silakan periksa email Anda dan masukkan kode OTP 6-digit untuk verifikasi. Notifikasi telah dikirim ke Admin untuk proses verifikasi.');
    }
}
