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
            'alamat' => ['nullable', 'string', 'max:500'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'nik_pj' => ['nullable', 'string', 'max:30'],
            'nomor_legalitas' => ['nullable', 'string', 'max:100'],
            'plat_nomor_unit' => ['required', 'string', 'max:30'],
            'merk_kendaraan' => ['nullable', 'string', 'max:100'],
            'foto_ktp_pj' => ['required', 'image', 'mimes:jpeg,png,jpg,webp', 'max:5120'],
            'foto_legalitas' => ['required', 'image', 'mimes:jpeg,png,jpg,webp', 'max:5120'],
            'foto_ambulans' => ['required', 'image', 'mimes:jpeg,png,jpg,webp', 'max:5120'],
        ], [
            'nama_lembaga.required' => 'Nama resmi lembaga/instansi/yayasan wajib diisi.',
            'name.required' => 'Nama penanggung jawab wajib diisi.',
            'foto_ktp_pj.required' => 'Foto fisik e-KTP penanggung jawab wajib diunggah.',
            'foto_legalitas.required' => 'Foto fisik dokumen legalitas/izin operasional wajib diunggah.',
            'foto_ambulans.required' => 'Foto fisik unit ambulans/STNK wajib diunggah.',
            'plat_nomor_unit.required' => 'Plat nomor unit ambulans wajib diisi.',
        ]);

        $mitraRole = Role::where('name', 'mitra')->first();
        
        // User (sebagai penanggung jawab / akun pengelola lembaga)
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'role_id' => $mitraRole?->id,
            'is_active' => false, // Mitra armada harus diverifikasi oleh admin
            'email_verified_at' => null,
        ]);

        // Upload Dokumen Pendukung Mitra Lembaga
        $fotoKtpPj = $request->hasFile('foto_ktp_pj') ? $request->file('foto_ktp_pj')->store('dokumen/mitra/ktp', 'public') : null;
        $fotoLegalitas = $request->hasFile('foto_legalitas') ? $request->file('foto_legalitas')->store('dokumen/mitra/legalitas', 'public') : null;
        $fotoAmbulans = $request->hasFile('foto_ambulans') ? $request->file('foto_ambulans')->store('dokumen/mitra/ambulans', 'public') : null;

        // Create Mitra profile untuk menyimpan info Lembaga & Dokumen
        Mitra::create([
            'user_id' => $user->id,
            'nama_mitra' => $request->nama_lembaga,
            'penanggung_jawab' => $user->name,
            'nik_pj' => $request->nik_pj,
            'foto_ktp_pj' => $fotoKtpPj,
            'no_telp' => $user->phone,
            'alamat' => $request->alamat ?? 'Wilayah Layanan Mitra',
            'nomor_legalitas' => $request->nomor_legalitas,
            'foto_legalitas' => $fotoLegalitas,
            'plat_nomor_unit' => $request->plat_nomor_unit,
            'merk_kendaraan' => $request->merk_kendaraan ?? 'Ambulans Siaga',
            'foto_ambulans' => $fotoAmbulans,
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
