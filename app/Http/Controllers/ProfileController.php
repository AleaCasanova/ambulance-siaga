<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();

        $user->fill($request->only('name', 'email', 'phone'));

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        if ($user->isSupir()) {
            $user->supir()->updateOrCreate(
                ['user_id' => $user->id],
                [
                    'nama_lembaga' => $request->input('nama_lembaga') ?: 'Mitra Ambulance Siaga',
                    'nama_penanggung_jawab' => $request->input('nama_penanggung_jawab') ?: $user->name,
                    'no_wa' => $request->input('no_wa') ?: $user->phone,
                    'alamat_unit' => $request->input('alamat_unit') ?: '-',
                    'merk_kendaraan' => $request->input('merk_kendaraan') ?: '-',
                    'plat_nomor' => $request->input('plat_nomor') ?: '-',
                    'nomor_sim' => $request->input('nomor_sim') ?: 'SIM-' . $user->id,
                    'nomor_stnk' => $request->input('nomor_stnk') ?: '-',
                ]
            );
        } elseif ($user->hasRole('masyarakat')) {
            $user->masyarakat()->updateOrCreate(
                ['user_id' => $user->id],
                [
                    'nik' => $request->input('nik') ?: '-',
                    'alamat' => $request->input('alamat') ?: '-',
                    'tanggal_lahir' => $request->input('tanggal_lahir'),
                    'jenis_kelamin' => $request->input('jenis_kelamin'),
                    'kontak_darurat' => $request->input('kontak_darurat') ?: $user->phone,
                ]
            );
        }

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
