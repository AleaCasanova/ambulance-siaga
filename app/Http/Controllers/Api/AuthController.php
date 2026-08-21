<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Masyarakat;
use App\Models\Role;
use App\Models\Supir;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    /**
     * Handle user login for Mobile App (Masyarakat & Supir)
     */
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'login' => 'required|string', // can be email or phone
            'password' => 'required|string',
            'device_name' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors()
            ], 422);
        }

        $loginInput = $request->input('login');
        
        // Find user by email or phone
        $user = User::with(['role', 'masyarakat', 'supir.mitra'])
            ->where('email', $loginInput)
            ->orWhere('phone', $loginInput)
            ->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'success' => false,
                'message' => 'Email / Nomor HP atau password salah.'
            ], 401);
        }

        if (!$user->is_active) {
            return response()->json([
                'success' => false,
                'message' => 'Akun Anda sedang dinonaktifkan oleh administrator.'
            ], 403);
        }

        // Revoke old tokens if device_name provided
        $deviceName = $request->device_name ?? 'FlutterApp';
        $token = $user->createToken($deviceName)->plainTextToken;

        return response()->json([
            'success' => true,
            'message' => 'Login berhasil',
            'data' => [
                'token' => $token,
                'user' => $this->formatUserData($user),
            ]
        ]);
    }

    /**
     * Register new Masyarakat user
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:100',
            'email' => 'required|string|email|max:150|unique:users,email',
            'phone' => 'required|string|max:20|unique:users,phone',
            'password' => 'required|string|min:6|confirmed',
            'nik' => 'nullable|string|size:16|unique:masyarakat,nik',
            'alamat' => 'nullable|string|max:255',
            'tanggal_lahir' => 'nullable|date',
            'jenis_kelamin' => 'nullable|in:L,P',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi pendaftaran gagal',
                'errors' => $validator->errors()
            ], 422);
        }

        $roleMasyarakat = Role::where('name', 'masyarakat')->first();
        $roleId = $roleMasyarakat ? $roleMasyarakat->id : 4;

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'role_id' => $roleId,
            'is_active' => true,
            'email_verified_at' => now(), // auto-verify for mobile registration
        ]);

        Masyarakat::create([
            'user_id' => $user->id,
            'nik' => $request->nik,
            'alamat' => $request->alamat,
            'tanggal_lahir' => $request->tanggal_lahir,
            'jenis_kelamin' => $request->jenis_kelamin ?? 'L',
        ]);

        $user->load(['role', 'masyarakat']);
        $token = $user->createToken('FlutterApp')->plainTextToken;

        return response()->json([
            'success' => true,
            'message' => 'Pendaftaran akun berhasil!',
            'data' => [
                'token' => $token,
                'user' => $this->formatUserData($user),
            ]
        ], 201);
    }

    /**
     * Get authenticated user profile data
     */
    public function me(Request $request)
    {
        $user = $request->user();
        $user->load(['role', 'masyarakat', 'supir.mitra']);

        return response()->json([
            'success' => true,
            'data' => [
                'user' => $this->formatUserData($user),
            ]
        ]);
    }

    /**
     * Update user profile
     */
    public function updateProfile(Request $request)
    {
        $user = $request->user();

        $validator = Validator::make($request->all(), [
            'name' => 'sometimes|required|string|max:100',
            'phone' => 'sometimes|required|string|max:20|unique:users,phone,' . $user->id,
            'password' => 'nullable|string|min:6',
            'nik' => 'nullable|string|max:20',
            'alamat' => 'nullable|string|max:255',
            'tanggal_lahir' => 'nullable|date',
            'jenis_kelamin' => 'nullable|in:L,P',
            'kontak_darurat' => 'nullable|string|max:20',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi data gagal',
                'errors' => $validator->errors()
            ], 422);
        }

        if ($request->filled('name')) $user->name = $request->name;
        if ($request->filled('phone')) $user->phone = $request->phone;
        if ($request->filled('password')) $user->password = Hash::make($request->password);
        $user->save();

        if ($user->hasRole('masyarakat')) {
            $masyarakat = $user->masyarakat ?? new Masyarakat(['user_id' => $user->id]);
            if ($request->has('nik')) $masyarakat->nik = $request->nik;
            if ($request->has('alamat')) $masyarakat->alamat = $request->alamat;
            if ($request->has('tanggal_lahir')) $masyarakat->tanggal_lahir = $request->tanggal_lahir;
            if ($request->has('jenis_kelamin')) $masyarakat->jenis_kelamin = $request->jenis_kelamin;
            if ($request->has('kontak_darurat')) $masyarakat->kontak_darurat = $request->kontak_darurat;
            $masyarakat->save();
        }

        $user->load(['role', 'masyarakat', 'supir.mitra']);

        return response()->json([
            'success' => true,
            'message' => 'Profil berhasil diperbarui',
            'data' => [
                'user' => $this->formatUserData($user),
            ]
        ]);
    }

    /**
     * Logout and revoke tokens
     */
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'success' => true,
            'message' => 'Logout berhasil'
        ]);
    }

    /**
     * Helper to format User model response
     */
    private function formatUserData(User $user): array
    {
        $roleName = $user->role ? $user->role->name : 'masyarakat';

        $data = [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'phone' => $user->phone,
            'role' => $roleName,
            'role_label' => $user->role_label,
            'avatar_url' => $user->avatar_url,
            'is_active' => (bool) $user->is_active,
        ];

        if ($roleName === 'masyarakat' && $user->masyarakat) {
            $data['masyarakat'] = [
                'nik' => $user->masyarakat->nik,
                'alamat' => $user->masyarakat->alamat,
                'tanggal_lahir' => $user->masyarakat->tanggal_lahir?->format('Y-m-d'),
                'jenis_kelamin' => $user->masyarakat->jenis_kelamin,
                'kontak_darurat' => $user->masyarakat->kontak_darurat,
            ];
        } elseif ($roleName === 'supir' && $user->supir) {
            $data['supir'] = [
                'id' => $user->supir->id,
                'status_online' => (bool) $user->supir->status_online,
                'plat_nomor' => $user->supir->plat_nomor,
                'merk_kendaraan' => $user->supir->merk_kendaraan,
                'nomor_sim' => $user->supir->nomor_sim,
                'rating_rata_rata' => (float) $user->supir->rating_rata_rata,
                'total_perjalanan' => (int) $user->supir->total_perjalanan,
                'lokasi_terakhir_lat' => $user->supir->lokasi_terakhir_lat ? (float) $user->supir->lokasi_terakhir_lat : null,
                'lokasi_terakhir_lng' => $user->supir->lokasi_terakhir_lng ? (float) $user->supir->lokasi_terakhir_lng : null,
                'ambulans' => $user->supir->ambulans ? [
                    'id' => $user->supir->ambulans->id,
                    'kode_ambulans' => $user->supir->ambulans->kode_ambulans,
                    'plat_nomor' => $user->supir->ambulans->plat_nomor,
                    'jenis_ambulans' => $user->supir->ambulans->jenis_ambulans,
                    'status' => $user->supir->ambulans->status,
                ] : null,
            ];
        }

        return $data;
    }
}
