<div>
    <!-- Header -->
    <div class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-sky-100 text-sky-700 uppercase tracking-wider mb-2">
                {{ $isSupirPage ? 'Manajemen Armada & Supir' : 'Manajemen Sistem RBAC' }}
            </span>
            <h1 class="text-2xl sm:text-3xl font-extrabold text-slate-800 tracking-tight">
                {{ $isSupirPage ? 'Kelola Supir Ambulans' : 'Kelola Pengguna & Role' }}
            </h1>
            <p class="text-slate-500 text-sm mt-1">
                {{ $isSupirPage ? 'Daftar pengemudi ambulans siaga GSC Cilacap beserta status SIM dan kesiapan online.' : 'Daftar akun pengguna sistem GSC (Super Admin, Admin, Dispatcher, Supir, Masyarakat).' }}
            </p>
        </div>

        <div class="flex flex-wrap items-center gap-3">
            <input type="text" wire:model.live.debounce.300ms="search"
                   placeholder="Cari nama, email, atau no. SIM..."
                   class="px-4 py-2.5 rounded-xl border border-slate-300 bg-white text-sm font-medium focus:border-sky-500 focus:ring-2 focus:ring-sky-200 shadow-xs">

            @if(!$isSupirPage)
                <select wire:model.live="roleFilter"
                        class="px-4 py-2.5 rounded-xl border border-slate-300 bg-white text-sm font-semibold focus:border-sky-500 focus:ring-2 focus:ring-sky-200 shadow-xs">
                    <option value="">-- Semua Role --</option>
                    @foreach($roles as $rl)
                        <option value="{{ $rl->id }}">{{ $rl->label ?? $rl->name }}</option>
                    @endforeach
                </select>
            @endif

            <button type="button" wire:click="openCreateModal"
                    class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-sky-600 hover:bg-sky-700 text-white font-bold text-sm shadow-md shadow-sky-600/30 transition-all">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/>
                </svg>
                <span>{{ $isSupirPage ? 'Tambahkan Supir Baru' : 'Tambahkan Pengguna' }}</span>
            </button>
        </div>
    </div>

    <!-- Table Users -->
    <div class="bg-white rounded-3xl border border-slate-200/80 shadow-xs overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50/80 border-b border-slate-200 text-[11px] font-bold text-slate-500 uppercase tracking-wider">
                        <th class="py-4 px-6">Pengguna & Email</th>
                        <th class="py-4 px-6">Role / Hak Akses</th>
                        <th class="py-4 px-6">Kontak / Telepon</th>
                        <th class="py-4 px-6">Info Khusus (SIM / NIK)</th>
                        <th class="py-4 px-6">Status Akun</th>
                        <th class="py-4 px-6 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-sm">
                    @forelse($users as $user)
                        <tr class="hover:bg-slate-50/50 transition-colors">
                            <td class="py-4 px-6">
                                <div class="flex items-center gap-3">
                                    <img src="{{ $user->avatar_url }}" alt="" class="w-10 h-10 rounded-full object-cover border border-slate-200">
                                    <div>
                                        <span class="font-extrabold text-slate-800 block">{{ $user->name }}</span>
                                        <span class="text-xs text-slate-500 block">{{ $user->email }}</span>
                                    </div>
                                </div>
                            </td>
                            <td class="py-4 px-6">
                                <span class="inline-block px-3 py-1 rounded-full text-xs font-bold
                                    @if($user->isSuperAdmin()) bg-sky-100 text-sky-700
                                    @elseif($user->isAdminOperasional()) bg-blue-100 text-blue-700
                                    @elseif($user->isDispatcher()) bg-purple-100 text-purple-700
                                    @elseif($user->isSupir()) bg-emerald-100 text-emerald-700
                                    @else bg-slate-100 text-slate-700 @endif">
                                    {{ $user->role_label }}
                                </span>
                            </td>
                            <td class="py-4 px-6">
                                <span class="font-semibold text-slate-700 text-xs">{{ $user->phone ?: '-' }}</span>
                            </td>
                            <td class="py-4 px-6">
                                @if($user->isSupir())
                                    <div class="text-xs">
                                        <span class="font-bold text-slate-700 block">SIM: {{ $user->supir?->nomor_sim ?: 'Belum Ada' }}</span>
                                        <span class="inline-flex items-center gap-1 font-extrabold {{ $user->supir?->status_online ? 'text-emerald-600' : 'text-slate-400' }}">
                                            <span class="w-1.5 h-1.5 rounded-full {{ $user->supir?->status_online ? 'bg-emerald-500' : 'bg-slate-300' }}"></span>
                                            {{ $user->supir?->status_online ? 'Online' : 'Offline' }}
                                        </span>
                                    </div>
                                @elseif($user->hasRole('masyarakat'))
                                    <div class="text-xs">
                                        <span class="font-bold text-slate-700 block">NIK: {{ $user->masyarakat?->nik ?: '-' }}</span>
                                        <span class="text-slate-500 truncate max-w-xs block">{{ $user->masyarakat?->alamat ?: '-' }}</span>
                                    </div>
                                @else
                                    <span class="text-xs text-slate-400 font-medium">-</span>
                                @endif
                            </td>
                            <td class="py-4 px-6">
                                <span class="inline-flex items-center gap-1.5 text-xs font-bold {{ $user->is_active ? 'text-emerald-700' : 'text-slate-400' }}">
                                    <span class="w-2 h-2 rounded-full {{ $user->is_active ? 'bg-emerald-500' : 'bg-slate-300' }}"></span>
                                    <span>{{ $user->is_active ? 'Aktif' : 'Non-Aktif' }}</span>
                                </span>
                            </td>
                            <td class="py-4 px-6 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <button type="button" wire:click="openEditModal({{ $user->id }})"
                                            class="px-3 py-1.5 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold text-xs transition-colors">
                                        Edit
                                    </button>
                                    @if($user->id !== auth()->id())
                                        <button type="button" wire:click="deleteUser({{ $user->id }})"
                                                wire:confirm="Yakin ingin menghapus pengguna ini beserta seluruh data relasinya?"
                                                class="px-3 py-1.5 rounded-xl bg-red-50 hover:bg-red-100 text-red-600 font-bold text-xs transition-colors">
                                            Hapus
                                        </button>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="py-12 text-center text-slate-400">
                                <p class="text-sm font-semibold">Tidak ditemukan pengguna dengan kriteria pencarian</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="px-6 py-4 border-t border-slate-100">
            {{ $users->links() }}
        </div>
    </div>

    <!-- Modal Form Create / Edit -->
    @if($showModal)
        <div class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/70 backdrop-blur-xs overflow-y-auto">
            <div class="bg-white rounded-3xl max-w-lg w-full p-6 sm:p-8 shadow-2xl border border-slate-200 my-8">
                <div class="flex items-center justify-between mb-6 pb-4 border-b border-slate-100">
                    <h3 class="text-lg font-extrabold text-slate-800">
                        {{ $isEdit ? 'Edit Data Pengguna' : 'Tambahkan Pengguna Baru' }}
                    </h3>
                    <button wire:click="$set('showModal', false)" class="text-slate-400 hover:text-slate-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>

                <form wire:submit="saveUser" class="space-y-4">
                    <!-- Nama -->
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Nama Lengkap</label>
                        <input type="text" wire:model="name" required placeholder="Contoh: Budi Santoso"
                               class="w-full px-4 py-2.5 rounded-xl border border-slate-300 text-sm font-medium focus:border-sky-500 focus:ring-2 focus:ring-sky-200">
                        @error('name') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <!-- Email -->
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Alamat Email</label>
                        <input type="email" wire:model="email" required placeholder="email@contoh.com"
                               class="w-full px-4 py-2.5 rounded-xl border border-slate-300 text-sm font-medium focus:border-sky-500 focus:ring-2 focus:ring-sky-200">
                        @error('email') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <!-- Telepon -->
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Nomor Telepon / WhatsApp</label>
                        <input type="text" wire:model="phone" placeholder="Contoh: 081234567890"
                               class="w-full px-4 py-2.5 rounded-xl border border-slate-300 text-sm font-medium focus:border-sky-500 focus:ring-2 focus:ring-sky-200">
                        @error('phone') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <!-- Role -->
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Role / Hak Akses</label>
                        <select wire:model.live="role_id" required
                                class="w-full px-4 py-2.5 rounded-xl border border-slate-300 text-sm font-semibold focus:border-sky-500 focus:ring-2 focus:ring-sky-200">
                            <option value="">-- Pilih Role --</option>
                            @foreach($roles as $rl)
                                <option value="{{ $rl->id }}">{{ $rl->label ?? $rl->name }}</option>
                            @endforeach
                        </select>
                        @error('role_id') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <!-- PENGATURAN KHUSUS SUPIR -->
                    @php
                        $selectedRole = $roles->firstWhere('id', $role_id);
                    @endphp

                    @if($selectedRole && $selectedRole->name === 'supir')
                        <div class="p-4 rounded-2xl bg-sky-50/70 border border-sky-100 space-y-3">
                            <h4 class="text-xs font-extrabold text-sky-800 uppercase tracking-wider">Informasi Khusus Supir</h4>
                            <div>
                                <label class="block text-xs font-bold text-slate-700 mb-1">Nomor SIM (A / B1 Umum)</label>
                                <input type="text" wire:model="nomor_sim" placeholder="Contoh: 1234-5678-000001"
                                       class="w-full px-4 py-2 rounded-xl border border-slate-300 text-sm font-medium focus:border-sky-500 focus:ring-2 focus:ring-sky-200 bg-white">
                                @error('nomor_sim') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
                            </div>
                            <div class="flex items-center gap-2 pt-1">
                                <input type="checkbox" wire:model="status_online" id="status_online" class="rounded border-slate-300 text-sky-600 focus:ring-sky-500">
                                <label for="status_online" class="text-xs font-bold text-slate-700">Supir Sedang Online (Siaga Bertugas)</label>
                            </div>
                        </div>
                    @elseif($selectedRole && $selectedRole->name === 'masyarakat')
                        <div class="p-4 rounded-2xl bg-slate-50 border border-slate-200 space-y-3">
                            <h4 class="text-xs font-extrabold text-slate-800 uppercase tracking-wider">Informasi Warga / Masyarakat</h4>
                            <div>
                                <label class="block text-xs font-bold text-slate-700 mb-1">Nomor KTP (NIK)</label>
                                <input type="text" wire:model="nik" placeholder="16 Digit NIK KTP"
                                       class="w-full px-4 py-2 rounded-xl border border-slate-300 text-sm font-medium focus:border-sky-500 focus:ring-2 focus:ring-sky-200 bg-white">
                                @error('nik') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-slate-700 mb-1">Alamat Tempat Tinggal</label>
                                <input type="text" wire:model="alamat" placeholder="Jl. Raya Cilacap No. 10..."
                                       class="w-full px-4 py-2 rounded-xl border border-slate-300 text-sm font-medium focus:border-sky-500 focus:ring-2 focus:ring-sky-200 bg-white">
                                @error('alamat') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
                            </div>
                        </div>
                    @endif

                    <!-- Password -->
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">
                            Kata Sandi {{ $isEdit ? '(Kosongkan jika tidak diubah)' : '' }}
                        </label>
                        <input type="password" wire:model="password" {{ $isEdit ? '' : 'required' }}
                               class="w-full px-4 py-2.5 rounded-xl border border-slate-300 text-sm font-medium focus:border-sky-500 focus:ring-2 focus:ring-sky-200">
                        @error('password') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <!-- Is Active -->
                    <div class="flex items-center gap-2 pt-1">
                        <input type="checkbox" wire:model="is_active" id="is_active" class="rounded border-slate-300 text-sky-600 focus:ring-sky-500">
                        <label for="is_active" class="text-xs font-bold text-slate-700">Akun Aktif & Dapat Login</label>
                    </div>

                    <div class="flex gap-3 pt-4 border-t border-slate-100">
                        <button type="submit"
                                class="flex-1 py-3.5 rounded-xl bg-sky-600 hover:bg-sky-700 text-white font-extrabold text-sm shadow-lg shadow-sky-600/30 transition-all">
                            SIMPAN DATA
                        </button>
                        <button type="button" wire:click="$set('showModal', false)"
                                class="px-5 py-3.5 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-600 font-bold text-sm transition-colors">
                            Batal
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endif
</div>
