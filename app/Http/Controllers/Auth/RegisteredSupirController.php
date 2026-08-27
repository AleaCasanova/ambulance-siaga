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

class RegisteredSupirController extends Controller
{
    /**
     * Display the registration view for supir.
     */
    public function create(): View
    {
        return view('auth.register-supir');
    }

    /**
     * Handle an incoming registration request for supir.
     *
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'phone' => ['required', 'string', 'max:20'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'nomor_sim' => ['required', 'string', 'max:50'],
            'plat_nomor' => ['required', 'string', 'max:30'],
            'nik' => ['nullable', 'string', 'max:30'],
            'nomor_skck' => ['nullable', 'string', 'max:50'],
            'foto_ktp' => ['required', 'image', 'mimes:jpeg,png,jpg,webp', 'max:5120'],
            'foto_sim' => ['required', 'image', 'mimes:jpeg,png,jpg,webp', 'max:5120'],
            'foto_stnk' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:5120'],
            'foto_skck' => ['required', 'image', 'mimes:jpeg,png,jpg,webp', 'max:5120'],
            'avatar' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:5120'],
        ], [
            'foto_ktp.required' => 'Foto fisik e-KTP wajib diunggah.',
            'foto_sim.required' => 'Foto fisik SIM (A/B1) wajib diunggah.',
            'foto_skck.required' => 'Foto fisik surat SKCK wajib diunggah.',
            'nomor_sim.required' => 'Nomor SIM wajib diisi.',
            'plat_nomor.required' => 'Plat nomor kendaraan wajib diisi.',
        ]);

        $supirRole = Role::where('name', 'supir')->first();
        
        $avatarPath = null;
        if ($request->hasFile('avatar')) {
            $avatarPath = $request->file('avatar')->store('avatars', 'public');
        }

        $cleanPhone = preg_replace('/^(\+?62|0)+/', '', $request->phone);
        $formattedPhone = '0' . $cleanPhone;

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $formattedPhone,
            'avatar' => $avatarPath,
            'password' => Hash::make($request->password),
            'role_id' => $supirRole?->id,
            'is_active' => false, // Supir must be verified by admin
            'email_verified_at' => null,
        ]);

        // Upload Dokumen Pendukung Supir
        $fotoKtp = $request->hasFile('foto_ktp') ? $request->file('foto_ktp')->store('dokumen/ktp', 'public') : null;
        $fotoSim = $request->hasFile('foto_sim') ? $request->file('foto_sim')->store('dokumen/sim', 'public') : null;
        $fotoStnk = $request->hasFile('foto_stnk') ? $request->file('foto_stnk')->store('dokumen/stnk', 'public') : null;
        $fotoSkck = $request->hasFile('foto_skck') ? $request->file('foto_skck')->store('dokumen/skck', 'public') : null;

        // Create Supir profile
        Supir::create([
            'user_id' => $user->id,
            'nama_lembaga' => 'Mitra Pengemudi Perorangan',
            'nama_penanggung_jawab' => $user->name,
            'no_wa' => $user->phone,
            'nik' => $request->nik,
            'foto_ktp' => $fotoKtp,
            'merk_kendaraan' => $request->merk_kendaraan ?? 'Ambulans Siaga Unit',
            'plat_nomor' => $request->plat_nomor,
            'nomor_sim' => $request->nomor_sim,
            'foto_sim' => $fotoSim,
            'nomor_stnk' => $request->nomor_stnk ?? '-',
            'foto_stnk' => $fotoStnk,
            'nomor_skck' => $request->nomor_skck,
            'foto_skck' => $fotoSkck,
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
            \Illuminate\Support\Facades\Log::error("Gagal mengirimkan email OTP registrasi supir: " . $e->getMessage());
        }

        // Save email in session for OTP page
        session(['verification_email' => $user->email]);

        // Kirim notifikasi sistem & email ke Administrator
        \App\Services\AdminNotificationService::notifyNewSupirRegistered($user, [
            'nomor_sim' => $request->nomor_sim,
            'plat_nomor' => $request->plat_nomor,
        ]);

        return redirect()->route('verification.otp.show')->with('status', 'Pendaftaran pengemudi berhasil! Silakan periksa email Anda dan masukkan kode OTP 6-digit untuk verifikasi. Notifikasi telah dikirim ke Admin untuk proses verifikasi.');
    }
}
