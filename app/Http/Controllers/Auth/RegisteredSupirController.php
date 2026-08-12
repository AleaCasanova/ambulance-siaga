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
        ]);

        $supirRole = Role::where('name', 'supir')->first();
        
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'role_id' => $supirRole?->id,
            'is_active' => false, // Supir must be verified by admin
            'email_verified_at' => null,
        ]);

        // Create Supir profile
        Supir::create([
            'user_id' => $user->id,
            'nama_lembaga' => 'Mitra Ambulance Siaga',
            'nama_penanggung_jawab' => $user->name,
            'no_wa' => $user->phone,
            'alamat_unit' => '-',
            'merk_kendaraan' => '-',
            'plat_nomor' => $request->plat_nomor,
            'nomor_sim' => $request->nomor_sim,
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
            \Illuminate\Support\Facades\Log::error("Gagal mengirimkan email OTP registrasi supir: " . $e->getMessage());
        }

        // Save email in session for OTP page
        session(['verification_email' => $user->email]);

        return redirect()->route('verification.otp.show')->with('status', 'Pendaftaran pengemudi berhasil! Silakan periksa email Anda dan masukkan kode OTP 6-digit untuk verifikasi. Akun Anda selanjutnya akan diproses oleh admin.');
    }
}
