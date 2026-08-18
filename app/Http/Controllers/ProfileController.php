<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
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
            $supirData = [
                'no_wa' => $request->input('no_wa') ?: $user->phone,
                'merk_kendaraan' => $request->input('merk_kendaraan') ?: '-',
                'plat_nomor' => $request->input('plat_nomor') ?: '-',
                'nomor_sim' => $request->input('nomor_sim') ?: 'SIM-' . $user->id,
                'nomor_stnk' => $request->input('nomor_stnk') ?: '-',
            ];

            if ($request->hasFile('foto_sim')) {
                if ($user->supir && $user->supir->foto_sim) {
                    Storage::disk('public')->delete($user->supir->foto_sim);
                }
                $supirData['foto_sim'] = $request->file('foto_sim')->store('supir_documents', 'public');
            }

            if ($request->hasFile('foto_stnk')) {
                if ($user->supir && $user->supir->foto_stnk) {
                    Storage::disk('public')->delete($user->supir->foto_stnk);
                }
                $supirData['foto_stnk'] = $request->file('foto_stnk')->store('supir_documents', 'public');
            }

            $supir = $user->supir()->updateOrCreate(
                ['user_id' => $user->id],
                $supirData
            );

            // Update related Mitra if exists
            if ($supir->mitra) {
                $supir->mitra->update([
                    'nama_mitra' => $request->input('nama_lembaga') ?: $supir->mitra->nama_mitra,
                    'penanggung_jawab' => $request->input('nama_penanggung_jawab') ?: $supir->mitra->penanggung_jawab,
                    'alamat' => $request->input('alamat_unit') ?: $supir->mitra->alamat,
                ]);
            }
        } elseif (!$user->isSupir() && !$user->isOperator() && !$user->isAdmin()) {
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
