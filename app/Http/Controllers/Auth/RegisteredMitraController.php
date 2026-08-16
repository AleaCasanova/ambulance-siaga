<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\SendOtpMail;
use App\Models\OtpVerification;
use App\Models\Role;
use App\Models\Supir;
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

        $supirRole = Role::where('name', 'supir')->first();
        
        // User (sebagai penanggung jawab / pengelola)
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'role_id' => $supirRole?->id, // Mitra armada juga menggunakan role supir (sebagai pemilik unit)
            'is_active' => false, // Mitra armada harus diverifikasi oleh admin
            'email_verified_at' => null,
        ]);

        // Create Supir profile untuk menyimpan info Lembaga
        Supir::create([
            'user_id' => $user->id,
            'nama_lembaga' => $request->nama_lembaga,
            'nama_penanggung_jawab' => $user->name,
            'no_wa' => $user->phone,
            'alamat_unit' => '-',
            'merk_kendaraan' => '-',
            'plat_nomor' => '-', // Default karena bisa saja lebih dari 1 armada
            'nomor_sim' => '-',
            'nomor_stnk' => '-',
            'status_online' => false,
            'lokasi_terakhir_lat' => -7.7188,
            'lokasi_terakhir_lng' => 109.0159,
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
