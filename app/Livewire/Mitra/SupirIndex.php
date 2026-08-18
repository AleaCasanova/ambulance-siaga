<?php

namespace App\Livewire\Mitra;

use App\Models\Mitra;
use App\Models\Role;
use App\Models\Supir;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithPagination;

class SupirIndex extends Component
{
    use WithPagination;

    public $search = '';
    public $statusOnlineFilter = '';

    // Modal State
    public $isModalOpen = false;
    public $supirId = null;
    public $name = '';
    public $email = '';
    public $phone = '';
    public $password = '';
    public $nomor_sim = '';
    public $nomor_stnk = '';
    public $plat_nomor = '';
    public $merk_kendaraan = '';

    public function getMitraProperty()
    {
        $user = auth()->user();
        if (!$user) return null;

        $mitra = $user->mitra;
        if (!$mitra) {
            $mitra = Mitra::firstOrCreate(
                ['user_id' => $user->id],
                [
                    'nama_mitra' => $user->name,
                    'penanggung_jawab' => $user->name,
                    'no_telp' => $user->phone ?? '081234567890',
                    'alamat' => 'Cilacap, Jawa Tengah',
                    'is_active' => true,
                ]
            );
        }

        return $mitra;
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingStatusOnlineFilter()
    {
        $this->resetPage();
    }

    public function openCreateModal()
    {
        $this->reset(['supirId', 'name', 'email', 'phone', 'password', 'nomor_sim', 'nomor_stnk', 'plat_nomor', 'merk_kendaraan']);
        $this->isModalOpen = true;
    }

    public function openEditModal($id)
    {
        $mitra = $this->mitra;
        $supir = Supir::with('user')->where('mitra_id', $mitra ? $mitra->id : 0)->findOrFail($id);

        $this->supirId = $supir->id;
        $this->name = $supir->user?->name ?? '';
        $this->email = $supir->user?->email ?? '';
        $this->phone = $supir->no_wa ?? $supir->user?->phone ?? '';
        $this->nomor_sim = $supir->nomor_sim;
        $this->nomor_stnk = $supir->nomor_stnk;
        $this->plat_nomor = $supir->plat_nomor;
        $this->merk_kendaraan = $supir->merk_kendaraan;
        $this->password = '';
        $this->isModalOpen = true;
    }

    public function closeModal()
    {
        $this->isModalOpen = false;
    }

    public function save()
    {
        $mitra = $this->mitra;

        if ($this->supirId) {
            $this->validate([
                'name' => 'required|string|max:255',
                'phone' => 'nullable|string|max:20',
                'nomor_sim' => 'required|string|max:50',
                'nomor_stnk' => 'nullable|string|max:50',
            ]);

            $supir = Supir::where('mitra_id', $mitra ? $mitra->id : 0)->findOrFail($this->supirId);
            if ($supir->user) {
                $supir->user->update([
                    'name' => $this->name,
                    'phone' => $this->phone,
                ]);
            }

            $supir->update([
                'no_wa' => $this->phone,
                'nomor_sim' => $this->nomor_sim,
                'nomor_stnk' => $this->nomor_stnk,
                'plat_nomor' => $this->plat_nomor,
                'merk_kendaraan' => $this->merk_kendaraan,
            ]);

            session()->flash('message', 'Data supir lembaga berhasil diperbarui!');
        } else {
            $this->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|min:6',
                'phone' => 'nullable|string|max:20',
                'nomor_sim' => 'required|string|max:50',
            ]);

            $supirRole = Role::firstOrCreate(['name' => 'supir'], ['label' => 'Supir']);

            $newUser = User::create([
                'name' => $this->name,
                'email' => $this->email,
                'password' => Hash::make($this->password),
                'phone' => $this->phone,
                'role_id' => $supirRole->id,
                'email_verified_at' => now(),
            ]);

            Supir::create([
                'user_id' => $newUser->id,
                'mitra_id' => $mitra ? $mitra->id : null,
                'no_wa' => $this->phone,
                'nomor_sim' => $this->nomor_sim,
                'nomor_stnk' => $this->nomor_stnk,
                'plat_nomor' => $this->plat_nomor,
                'merk_kendaraan' => $this->merk_kendaraan,
                'status_online' => true,
            ]);

            session()->flash('message', 'Akun driver resmi lembaga berhasil didaftarkan!');
        }

        $this->closeModal();
    }

    public function toggleOnline($id)
    {
        $mitra = $this->mitra;
        $supir = Supir::where('mitra_id', $mitra ? $mitra->id : 0)->findOrFail($id);
        $supir->update(['status_online' => !$supir->status_online]);
        session()->flash('message', "Status piket {$supir->user?->name} berhasil diperbarui.");
    }

    public function render()
    {
        $mitra = $this->mitra;
        $mitraId = $mitra ? $mitra->id : 0;

        $supirs = Supir::with(['user', 'jadwal.ambulans'])
            ->where('mitra_id', $mitraId)
            ->when($this->search, function ($q) {
                $q->where(function ($sub) {
                    $sub->whereHas('user', function ($u) {
                        $u->where('name', 'like', '%' . $this->search . '%')
                          ->orWhere('email', 'like', '%' . $this->search . '%');
                    })->orWhere('nomor_sim', 'like', '%' . $this->search . '%')
                      ->orWhere('no_wa', 'like', '%' . $this->search . '%');
                });
            })
            ->when($this->statusOnlineFilter !== '', function ($q) {
                $q->where('status_online', $this->statusOnlineFilter === '1');
            })
            ->latest()
            ->paginate(6);

        return view('livewire.mitra.supir-index', [
            'supirs' => $supirs,
            'mitra' => $mitra,
        ])->layout('layouts.admin');
    }
}
