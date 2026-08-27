<?php

namespace App\Livewire\Admin;

use App\Models\Masyarakat;
use App\Models\Mitra;
use App\Models\Role;
use App\Models\Supir;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithPagination;

class UsersIndex extends Component
{
    use WithPagination;

    public string $search = '';
    public string $roleFilter = '';

    public function updatingSearch() { $this->resetPage(); }
    public function updatingRoleFilter() { $this->resetPage(); }

    public function setRoleFilter(string $roleId = '')
    {
        $this->roleFilter = $roleId;
        $this->resetPage();
    }

    // Modal Form State
    public bool $showModal = false;
    public bool $isEdit = false;
    public ?int $userId = null;

    public string $name = '';
    public string $email = '';
    public string $phone = '';
    public ?int $role_id = null;
    public string $password = '';
    public bool $is_active = true;

    // Supir & Mitra Fields
    public string $nama_lembaga = '';
    public string $nama_penanggung_jawab = '';
    public string $no_wa = '';
    public string $alamat_unit = '';
    public string $merk_kendaraan = '';
    public string $plat_nomor = '';
    public string $nomor_sim = '';
    public string $nomor_stnk = '';
    public string $nomor_skck = '';
    public string $foto_ktp = '';
    public string $foto_sim = '';
    public string $foto_stnk = '';
    public string $foto_skck = '';
    public string $foto_ktp_pj = '';
    public string $foto_legalitas = '';
    public string $foto_ambulans = '';
    public string $nomor_legalitas = '';
    public string $plat_nomor_unit = '';
    public string $avatar_url = '';
    public bool $status_online = false;

    // Masyarakat Fields
    public string $nik = '';
    public string $alamat = '';
    public string $kontak_darurat = '';

    protected function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $this->userId,
            'phone' => 'nullable|string|max:20',
            'role_id' => 'required|exists:roles,id',
            'password' => $this->isEdit ? 'nullable|min:6' : 'required|min:6',
            'is_active' => 'boolean',
            // Supir/Masyarakat/Mitra optional validations
            'nama_lembaga' => 'nullable|string|max:255',
            'nama_penanggung_jawab' => 'nullable|string|max:255',
            'no_wa' => 'nullable|string|max:30',
            'alamat_unit' => 'nullable|string|max:255',
            'merk_kendaraan' => 'nullable|string|max:100',
            'plat_nomor' => 'nullable|string|max:30',
            'nik' => 'nullable|string|max:30',
        ];
    }

    public function mount()
    {
        if (request()->routeIs('admin.supir.*')) {
            $supirRole = Role::where('name', 'supir')->first();
            if ($supirRole) {
                $this->roleFilter = (string) $supirRole->id;
            }
        }
    }

    public function openCreateModal()
    {
        $this->reset([
            'userId', 'name', 'email', 'phone', 'role_id', 'password', 'is_active',
            'nama_lembaga', 'nama_penanggung_jawab', 'no_wa', 'alamat_unit', 'merk_kendaraan', 'plat_nomor',
            'nomor_sim', 'nomor_stnk', 'nomor_skck', 'foto_ktp', 'foto_sim', 'foto_stnk', 'foto_skck',
            'foto_ktp_pj', 'foto_legalitas', 'foto_ambulans', 'nomor_legalitas', 'plat_nomor_unit', 'avatar_url',
            'status_online', 'nik', 'alamat', 'kontak_darurat'
        ]);
        $this->is_active = true;
        $this->isEdit = false;

        if (request()->routeIs('admin.supir.*')) {
            $supirRole = Role::where('name', 'supir')->first();
            if ($supirRole) {
                $this->role_id = $supirRole->id;
            }
        }

        $this->showModal = true;
    }

    public function openEditModal($id)
    {
        $user = User::with(['supir', 'masyarakat', 'mitra'])->findOrFail($id);
        $this->userId = $user->id;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->phone = (string) $user->phone;
        $this->role_id = $user->role_id;
        $this->is_active = (bool) $user->is_active;
        $this->password = '';
        $this->avatar_url = (string) ($user->avatar ?? '');

        // Load Supir profile
        $this->nama_lembaga = (string) ($user->mitra?->nama_mitra ?? $user->supir?->nama_lembaga ?? '');
        $this->nama_penanggung_jawab = (string) ($user->mitra?->penanggung_jawab ?? $user->supir?->nama_penanggung_jawab ?? '');
        $this->no_wa = (string) ($user->mitra?->no_telp ?? $user->supir?->no_wa ?? '');
        $this->alamat_unit = (string) ($user->mitra?->alamat ?? $user->supir?->alamat_unit ?? '');
        $this->merk_kendaraan = (string) ($user->mitra?->merk_kendaraan ?? $user->supir?->merk_kendaraan ?? '');
        $this->plat_nomor = (string) ($user->mitra?->plat_nomor_unit ?? $user->supir?->plat_nomor ?? '');
        $this->nomor_sim = (string) ($user->supir?->nomor_sim ?? '');
        $this->nomor_stnk = (string) ($user->supir?->nomor_stnk ?? '');
        $this->nomor_skck = (string) ($user->supir?->nomor_skck ?? '');
        $this->foto_ktp = (string) ($user->supir?->foto_ktp ?? '');
        $this->foto_sim = (string) ($user->supir?->foto_sim ?? '');
        $this->foto_stnk = (string) ($user->supir?->foto_stnk ?? '');
        $this->foto_skck = (string) ($user->supir?->foto_skck ?? '');
        $this->status_online = (bool) ($user->supir?->status_online ?? false);

        // Load Mitra Profile
        $this->foto_ktp_pj = (string) ($user->mitra?->foto_ktp_pj ?? '');
        $this->foto_legalitas = (string) ($user->mitra?->foto_legalitas ?? '');
        $this->foto_ambulans = (string) ($user->mitra?->foto_ambulans ?? '');
        $this->nomor_legalitas = (string) ($user->mitra?->nomor_legalitas ?? '');
        $this->plat_nomor_unit = (string) ($user->mitra?->plat_nomor_unit ?? '');

        // Load Masyarakat profile
        $this->nik = (string) ($user->masyarakat?->nik ?? $user->supir?->nik ?? $user->mitra?->nik_pj ?? '');
        $this->alamat = (string) ($user->masyarakat?->alamat ?? '');
        $this->kontak_darurat = (string) ($user->masyarakat?->kontak_darurat ?? '');

        $this->isEdit = true;
        $this->showModal = true;
    }

    public function saveUser()
    {
        $this->validate();

        $data = [
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'role_id' => $this->role_id,
            'is_active' => $this->is_active,
        ];

        if ($this->password) {
            $data['password'] = Hash::make($this->password);
        }

        if ($this->isEdit) {
            $user = User::findOrFail($this->userId);
            $wasInactive = !$user->is_active;
            $user->update($data);

            if ($wasInactive && $this->is_active) {
                \App\Services\AdminNotificationService::notifyAccountActivated($user);
            }

            session()->flash('success', 'Data pengguna berhasil diperbarui.');
        } else {
            $data['email_verified_at'] = now();
            $user = User::create($data);
            session()->flash('success', 'Pengguna baru berhasil ditambahkan.');
        }

        // Relational profile saving
        $role = Role::find($this->role_id);
        if ($role && $role->name === 'supir') {
            Supir::updateOrCreate(
                ['user_id' => $user->id],
                [
                    'nama_lembaga' => $this->nama_lembaga ?: 'Mitra Pengemudi Perorangan',
                    'nama_penanggung_jawab' => $this->nama_penanggung_jawab ?: $user->name,
                    'no_wa' => $this->no_wa ?: $user->phone,
                    'alamat_unit' => $this->alamat_unit ?: '-',
                    'merk_kendaraan' => $this->merk_kendaraan ?: '-',
                    'plat_nomor' => $this->plat_nomor ?: '-',
                    'nomor_sim' => $this->nomor_sim ?: 'SIM-' . $user->id,
                    'nomor_stnk' => $this->nomor_stnk ?: '-',
                    'status_online' => $this->status_online,
                    'lokasi_terakhir_lat' => -7.7188,
                    'lokasi_terakhir_lng' => 109.0159,
                ]
            );
        } elseif ($role && $role->name === 'mitra') {
            Mitra::updateOrCreate(
                ['user_id' => $user->id],
                [
                    'nama_mitra' => $this->nama_lembaga ?: 'Mitra Lembaga',
                    'penanggung_jawab' => $this->nama_penanggung_jawab ?: $user->name,
                    'nik_pj' => $this->nik ?: '-',
                    'no_telp' => $this->no_wa ?: $user->phone,
                    'alamat' => $this->alamat_unit ?: '-',
                    'nomor_legalitas' => $this->nomor_legalitas ?: '-',
                    'plat_nomor_unit' => $this->plat_nomor ?: '-',
                    'merk_kendaraan' => $this->merk_kendaraan ?: '-',
                    'is_active' => $this->is_active,
                ]
            );
        } elseif ($role && $role->name === 'masyarakat') {
            Masyarakat::updateOrCreate(
                ['user_id' => $user->id],
                [
                    'nik' => $this->nik ?: '-',
                    'alamat' => $this->alamat ?: '-',
                    'kontak_darurat' => $this->kontak_darurat ?: $this->phone,
                ]
            );
        }

        $this->showModal = false;
    }

    public function toggleActive($id)
    {
        $user = User::findOrFail($id);

        if ($user->id === auth()->id()) {
            session()->flash('error', 'Anda tidak dapat mengubah status akun Anda sendiri.');
            return;
        }

        $newStatus = !$user->is_active;
        $user->is_active = $newStatus;
        $user->save();

        if ($newStatus) {
            \App\Services\AdminNotificationService::notifyAccountActivated($user);
            session()->flash('success', "Akun '{$user->name}' berhasil diverifikasi dan diaktifkan.");
        } else {
            session()->flash('success', "Akun '{$user->name}' telah dinonaktifkan.");
        }
    }

    public function deleteUser($id)
    {
        if ($id == auth()->id()) {
            session()->flash('error', 'Anda tidak dapat menghapus akun Anda sendiri.');
            return;
        }

        $user = User::findOrFail($id);
        if ($user->supir) {
            $user->supir->delete();
        }
        if ($user->mitra) {
            $user->mitra->delete();
        }
        if ($user->masyarakat) {
            $user->masyarakat->delete();
        }
        $user->delete();

        session()->flash('success', 'Pengguna dan data relasi berhasil dihapus.');
    }

    public function render()
    {
        $query = User::with(['role', 'supir', 'masyarakat', 'mitra'])
            ->orderBy('is_active', 'asc') // Unverified (0) appears first
            ->orderBy('created_at', 'desc');

        if ($this->roleFilter) {
            $query->where('role_id', $this->roleFilter);
        }

        if ($this->search) {
            $query->where(function ($q) {
                $q->where('name', 'like', '%' . $this->search . '%')
                  ->orWhere('email', 'like', '%' . $this->search . '%')
                  ->orWhere('phone', 'like', '%' . $this->search . '%')
                  ->orWhereHas('supir', function ($s) {
                      $s->where('nomor_sim', 'like', '%' . $this->search . '%')
                        ->orWhere('plat_nomor', 'like', '%' . $this->search . '%')
                        ->orWhere('nama_lembaga', 'like', '%' . $this->search . '%');
                  })
                  ->orWhereHas('mitra', function ($m) {
                      $m->where('nama_mitra', 'like', '%' . $this->search . '%')
                        ->orWhere('plat_nomor_unit', 'like', '%' . $this->search . '%')
                        ->orWhere('nomor_legalitas', 'like', '%' . $this->search . '%');
                  })
                  ->orWhereHas('masyarakat', function ($ms) {
                      $ms->where('nik', 'like', '%' . $this->search . '%')
                         ->orWhere('alamat', 'like', '%' . $this->search . '%');
                  });
            });
        }

        $users = $query->paginate(10);

        // Sorting roles: Admin, Operator, Mitra, Supir (Driver), Masyarakat
        $roleOrder = ['admin' => 1, 'operator' => 2, 'mitra' => 3, 'supir' => 4, 'masyarakat' => 5];
        $roles = Role::all()->sortBy(function ($role) use ($roleOrder) {
            return $roleOrder[$role->name] ?? 99;
        });

        // Unverified counts per role
        $unverifiedCounts = User::where('is_active', false)
            ->selectRaw('role_id, count(*) as total')
            ->groupBy('role_id')
            ->pluck('total', 'role_id')
            ->toArray();

        $totalUnverified = User::where('is_active', false)->count();

        return view('livewire.admin.users-index', [
            'users' => $users,
            'roles' => $roles,
            'unverifiedCounts' => $unverifiedCounts,
            'totalUnverified' => $totalUnverified,
            'isSupirPage' => request()->routeIs('admin.supir.*'),
        ])->layout('layouts.admin');
    }
}
