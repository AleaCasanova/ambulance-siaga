<?php

namespace App\Livewire\Admin;

use App\Models\Masyarakat;
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

    // Supir Fields
    public string $nomor_sim = '';
    public bool $status_online = false;

    // Masyarakat Fields
    public string $nik = '';
    public string $alamat = '';
    public string $kontak_darurat = '';

    protected function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $this->userId,
            'phone' => 'nullable|string|max:20',
            'role_id' => 'required|exists:roles,id',
            'password' => $this->isEdit ? 'nullable|min:6' : 'required|min:6',
            'nomor_sim' => 'nullable|string|max:50',
            'nik' => 'nullable|string|max:30',
            'alamat' => 'nullable|string|max:255',
            'kontak_darurat' => 'nullable|string|max:30',
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
            'nomor_sim', 'status_online', 'nik', 'alamat', 'kontak_darurat'
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
        $user = User::with(['supir', 'masyarakat'])->findOrFail($id);
        $this->userId = $user->id;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->phone = (string) $user->phone;
        $this->role_id = $user->role_id;
        $this->is_active = (bool) $user->is_active;
        $this->password = '';

        // Load Supir profile
        $this->nomor_sim = (string) ($user->supir?->nomor_sim ?? '');
        $this->status_online = (bool) ($user->supir?->status_online ?? false);

        // Load Masyarakat profile
        $this->nik = (string) ($user->masyarakat?->nik ?? '');
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
            $user->update($data);
            session()->flash('success', 'Data pengguna berhasil diperbarui.');
        } else {
            $user = User::create($data);
            session()->flash('success', 'Pengguna baru berhasil ditambahkan.');
        }

        // Relational profile saving
        $role = Role::find($this->role_id);
        if ($role && $role->name === 'supir') {
            Supir::updateOrCreate(
                ['user_id' => $user->id],
                [
                    'nomor_sim' => $this->nomor_sim ?: 'SIM-' . $user->id,
                    'status_online' => $this->status_online,
                    'lokasi_terakhir_lat' => -7.7188,
                    'lokasi_terakhir_lng' => 109.0159,
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
        if ($user->masyarakat) {
            $user->masyarakat->delete();
        }
        $user->delete();

        session()->flash('success', 'Pengguna dan data relasi berhasil dihapus.');
    }

    public function render()
    {
        $query = User::with(['role', 'supir', 'masyarakat'])->orderBy('name', 'asc');

        if ($this->roleFilter) {
            $query->where('role_id', $this->roleFilter);
        }

        if ($this->search) {
            $query->where(function ($q) {
                $q->where('name', 'like', '%' . $this->search . '%')
                  ->orWhere('email', 'like', '%' . $this->search . '%')
                  ->orWhere('phone', 'like', '%' . $this->search . '%')
                  ->orWhereHas('supir', function ($s) {
                      $s->where('nomor_sim', 'like', '%' . $this->search . '%');
                  });
            });
        }

        $users = $query->paginate(10);
        $roles = Role::all();

        return view('livewire.admin.users-index', [
            'users' => $users,
            'roles' => $roles,
            'isSupirPage' => request()->routeIs('admin.supir.*'),
        ]);
    }
}
