<div>
    <!-- Header -->
    <div class="mb-8 flex flex-col lg:flex-row lg:items-end lg:justify-between gap-6">
        <div class="flex-1">
            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[11px] font-bold bg-slate-100 text-slate-500 uppercase tracking-wider mb-2.5">
                {{ $isSupirPage ? 'Manajemen Armada & Supir' : 'Manajemen Sistem RBAC' }}
            </span>
            <h1 class="text-2xl sm:text-[28px] font-bold text-slate-900 tracking-tight leading-tight">
                {{ $isSupirPage ? 'Kelola Supir' : 'Kelola Pengguna & Role' }}
            </h1>
            <p class="text-slate-500 text-[14px] mt-1.5 font-medium max-w-2xl">
                {{ $isSupirPage ? 'Daftar pengemudi ambulans mitra Ambulance Siaga beserta status SIM dan kesiapan online.' : 'Daftar akun pengguna sistem Ambulance Siaga (Super Admin, Admin, Operator, Supir, Masyarakat).' }}
            </p>
        </div>

        <div class="flex items-center gap-2.5 shrink-0">
            <input type="text" wire:model.live.debounce.300ms="search"
                   placeholder="Cari nama, email, SIM..."
                   class="w-40 sm:w-52 px-3.5 py-2 rounded-xl border border-slate-300 bg-white text-xs font-medium focus:border-sky-500 focus:ring-2 focus:ring-sky-200 shadow-xs">

            @if(!$isSupirPage)
                <div class="relative" x-data="{ open: false }">
                    <button type="button" @click="open = !open" @click.outside="open = false"
                            class="flex items-center justify-between gap-2 px-3.5 py-2 rounded-xl border border-slate-300 bg-white text-xs font-semibold text-slate-700 shadow-xs hover:border-slate-400 focus:outline-none focus:ring-2 focus:ring-sky-100 transition-all whitespace-nowrap">
                        <span>
                            @php
                                $activeRole = $roles->firstWhere('id', $roleFilter);
                            @endphp
                            {{ $activeRole ? ($activeRole->label ?? $activeRole->name) : 'Semua Role' }}
                        </span>
                        <svg class="w-3.5 h-3.5 text-slate-400 transition-transform duration-200" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </button>

                    <div x-show="open" x-transition.opacity.duration.150ms
                         class="absolute right-0 top-full mt-1.5 w-44 bg-white rounded-xl shadow-xl border border-slate-200 py-1.5 z-50 overflow-hidden"
                         style="display: none;">
                        <button type="button" @click="$wire.set('roleFilter', ''); open = false"
                                class="w-full text-left px-3.5 py-2 text-xs font-semibold flex items-center justify-between hover:bg-sky-50 hover:text-sky-600 transition-colors {{ $roleFilter === '' ? 'text-sky-600 bg-sky-50/50' : 'text-slate-700' }}">
                            <span>Semua Role</span>
                            @if($roleFilter === '') <svg class="w-3.5 h-3.5 text-sky-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg> @endif
                        </button>
                        @foreach($roles as $rl)
                            <button type="button" @click="$wire.set('roleFilter', '{{ $rl->id }}'); open = false"
                                    class="w-full text-left px-3.5 py-2 text-xs font-semibold flex items-center justify-between hover:bg-sky-50 hover:text-sky-600 transition-colors {{ (string)$roleFilter === (string)$rl->id ? 'text-sky-600 bg-sky-50/50' : 'text-slate-700' }}">
                                <span>{{ $rl->label ?? $rl->name }}</span>
                                @if((string)$roleFilter === (string)$rl->id) <svg class="w-3.5 h-3.5 text-sky-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg> @endif
                            </button>
                        @endforeach
                    </div>
                </div>
            @endif

            <button type="button" wire:click="openCreateModal"
                    class="inline-flex items-center gap-1.5 px-4 py-2 rounded-xl bg-sky-600 hover:bg-sky-700 text-white font-bold text-xs shadow-md shadow-sky-600/30 transition-all whitespace-nowrap">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/>
                </svg>
                <span>{{ $isSupirPage ? 'Tambah Supir' : 'Tambah Pengguna' }}</span>
            </button>
        </div>
    </div>

    <!-- Table Users -->
    <div class="bg-white rounded-3xl border border-slate-200/80 shadow-xs overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-200 text-[11px] font-bold text-slate-500 uppercase tracking-wider">
                        <th class="py-3 px-6 whitespace-nowrap">Pengguna & Email</th>
                        <th class="py-3 px-6 whitespace-nowrap">Role / Hak Akses</th>
                        <th class="py-3 px-6 whitespace-nowrap">Kontak / Telepon</th>
                        <th class="py-3 px-6 whitespace-nowrap">Info Khusus (SIM / NIK)</th>
                        <th class="py-3 px-6 whitespace-nowrap">Status Akun</th>
                        <th class="py-3 px-6 whitespace-nowrap text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-sm">
                    @forelse($users as $user)
                        <tr class="hover:bg-slate-50/50 transition-colors">
                            <td class="py-4 px-6">
                                <span class="font-extrabold text-slate-800 block">{{ $user->name }}</span>
                                <span class="text-xs text-slate-500 block">{{ $user->email }}</span>
                            </td>
                            <td class="py-4 px-6">
                                <div class="flex items-center gap-1.5 font-bold text-sm
                                    @if($user->isAdmin()) text-sky-600
                                    @elseif($user->isOperator()) text-purple-600
                                    @elseif($user->isSupir()) text-emerald-600
                                    @else text-slate-600 @endif">
                                    <span class="w-1.5 h-1.5 rounded-full 
                                        @if($user->isAdmin()) bg-sky-500
                                        @elseif($user->isOperator()) bg-purple-500
                                        @elseif($user->isSupir()) bg-emerald-500
                                        @else bg-slate-500 @endif"></span>
                                    {{ $user->role_label }}
                                </div>
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
                            <td class="py-4 px-6 whitespace-nowrap">
                                @if($user->is_active)
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-bold bg-emerald-50 text-emerald-700 border border-emerald-200/60 shadow-xs">
                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                                        <span>Aktif</span>
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-bold bg-amber-50 text-amber-700 border border-amber-200/60 shadow-xs">
                                        <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>
                                        <span>Perlu Verifikasi</span>
                                    </span>
                                @endif
                            </td>
                            <td class="py-4 px-6 text-right whitespace-nowrap">
                                <div class="flex items-center justify-end gap-1.5">
                                    @if(!$user->is_active && $user->id !== auth()->id())
                                        <button type="button" wire:click="toggleActive({{ $user->id }})"
                                                wire:confirm="Verifikasi dan aktifkan akun '{{ $user->name }}' sekarang?"
                                                title="Verifikasi & Aktifkan Akun"
                                                class="inline-flex items-center gap-1 px-3 py-1.5 rounded-lg border border-emerald-300 bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-[11px] transition-all shadow-xs shadow-emerald-600/20">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                                            </svg>
                                            <span>Verifikasi</span>
                                        </button>
                                    @endif

                                    <button type="button" wire:click="openEditModal({{ $user->id }})"
                                            class="px-3 py-1.5 rounded-lg border border-slate-200 bg-white hover:bg-slate-50 text-slate-700 font-semibold text-[11px] transition-colors shadow-xs">
                                        Edit
                                    </button>

                                    @if($user->id !== auth()->id())
                                        <button type="button" wire:click="deleteUser({{ $user->id }})"
                                                wire:confirm="Yakin ingin menghapus pengguna ini beserta seluruh data relasinya?"
                                                class="px-3 py-1.5 rounded-lg border border-red-200 bg-red-50 hover:bg-red-100 text-red-600 font-semibold text-[11px] transition-colors shadow-xs">
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
                        <div class="relative" x-data="{ open: false }">
                            <button type="button" @click="open = !open" @click.outside="open = false"
                                    class="w-full flex items-center justify-between px-4 py-2.5 rounded-xl border border-slate-300 bg-white text-sm font-semibold text-slate-700 focus:outline-none focus:ring-2 focus:ring-sky-200">
                                <span>
                                    @php
                                        $selectedRoleObj = $roles->firstWhere('id', $role_id);
                                    @endphp
                                    {{ $selectedRoleObj ? ($selectedRoleObj->label ?? $selectedRoleObj->name) : '-- Pilih Role --' }}
                                </span>
                                <svg class="w-4 h-4 text-slate-400 transition-transform duration-200" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                            </button>

                            <div x-show="open" x-transition.opacity.duration.150ms
                                 class="absolute left-0 top-full mt-1.5 w-full bg-white rounded-xl shadow-xl border border-slate-200 py-1.5 z-50 overflow-hidden"
                                 style="display: none;">
                                @foreach($roles as $rl)
                                    <button type="button" @click="$wire.set('role_id', {{ $rl->id }}); open = false"
                                            class="w-full text-left px-4 py-2.5 text-xs font-semibold flex items-center justify-between hover:bg-sky-50 hover:text-sky-600 transition-colors {{ (int)$role_id === (int)$rl->id ? 'text-sky-600 bg-sky-50/50' : 'text-slate-700' }}">
                                        <span>{{ $rl->label ?? $rl->name }}</span>
                                        @if((int)$role_id === (int)$rl->id) <svg class="w-3.5 h-3.5 text-sky-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg> @endif
                                    </button>
                                @endforeach
                            </div>
                        </div>
                        @error('role_id') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <!-- PENGATURAN KHUSUS SUPIR -->
                    @php
                        $selectedRole = $roles->firstWhere('id', $role_id);
                    @endphp

                    @if($selectedRole && $selectedRole->name === 'supir')
                        <div class="p-4 rounded-2xl bg-sky-50/70 border border-sky-100 space-y-3">
                            <h4 class="text-xs font-extrabold text-sky-800 uppercase tracking-wider">Informasi Lembaga Mitra & Armada Supir</h4>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                <div>
                                    <label class="block text-xs font-bold text-slate-700 mb-1">Nama Lembaga / Organisasi</label>
                                    <input type="text" wire:model="nama_lembaga" placeholder="Contoh: PMI Cilacap / RS Mitra"
                                           class="w-full px-3.5 py-2 rounded-xl border border-slate-300 text-xs font-medium focus:border-sky-500 focus:ring-2 focus:ring-sky-200 bg-white">
                                    @error('nama_lembaga') <p class="text-[11px] text-red-600 mt-1">{{ $message }}</p> @enderror
                                </div>
                                <div>
                                    <label class="block text-xs font-bold text-slate-700 mb-1">Nama Penanggung Jawab</label>
                                    <input type="text" wire:model="nama_penanggung_jawab" placeholder="Nama PJ / Koordinator"
                                           class="w-full px-3.5 py-2 rounded-xl border border-slate-300 text-xs font-medium focus:border-sky-500 focus:ring-2 focus:ring-sky-200 bg-white">
                                    @error('nama_penanggung_jawab') <p class="text-[11px] text-red-600 mt-1">{{ $message }}</p> @enderror
                                </div>
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                <div>
                                    <label class="block text-xs font-bold text-slate-700 mb-1">No. WhatsApp (WA)</label>
                                    <input type="text" wire:model="no_wa" placeholder="081xxx (Aktif WA)"
                                           class="w-full px-3.5 py-2 rounded-xl border border-slate-300 text-xs font-medium focus:border-sky-500 focus:ring-2 focus:ring-sky-200 bg-white">
                                    @error('no_wa') <p class="text-[11px] text-red-600 mt-1">{{ $message }}</p> @enderror
                                </div>
                                <div>
                                    <label class="block text-xs font-bold text-slate-700 mb-1">Alamat Unit Ambulance</label>
                                    <input type="text" wire:model="alamat_unit" placeholder="Alamat pos/unit armada"
                                           class="w-full px-3.5 py-2 rounded-xl border border-slate-300 text-xs font-medium focus:border-sky-500 focus:ring-2 focus:ring-sky-200 bg-white">
                                    @error('alamat_unit') <p class="text-[11px] text-red-600 mt-1">{{ $message }}</p> @enderror
                                </div>
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                <div>
                                    <label class="block text-xs font-bold text-slate-700 mb-1">Merk Kendaraan</label>
                                    <input type="text" wire:model="merk_kendaraan" placeholder="Contoh: Toyota HiAce / APV"
                                           class="w-full px-3.5 py-2 rounded-xl border border-slate-300 text-xs font-medium focus:border-sky-500 focus:ring-2 focus:ring-sky-200 bg-white">
                                    @error('merk_kendaraan') <p class="text-[11px] text-red-600 mt-1">{{ $message }}</p> @enderror
                                </div>
                                <div>
                                    <label class="block text-xs font-bold text-slate-700 mb-1">Plat No. Kendaraan</label>
                                    <input type="text" wire:model="plat_nomor" placeholder="Contoh: R 9988 ZZ"
                                           class="w-full px-3.5 py-2 rounded-xl border border-slate-300 text-xs font-medium focus:border-sky-500 focus:ring-2 focus:ring-sky-200 bg-white">
                                    @error('plat_nomor') <p class="text-[11px] text-red-600 mt-1">{{ $message }}</p> @enderror
                                </div>
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                <div>
                                    <label class="block text-xs font-bold text-slate-700 mb-1">Nomor SIM Driver</label>
                                    <input type="text" wire:model="nomor_sim" placeholder="SIM A / B1 Umum"
                                           class="w-full px-3.5 py-2 rounded-xl border border-slate-300 text-xs font-medium focus:border-sky-500 focus:ring-2 focus:ring-sky-200 bg-white">
                                    @error('nomor_sim') <p class="text-[11px] text-red-600 mt-1">{{ $message }}</p> @enderror
                                </div>
                                <div>
                                    <label class="block text-xs font-bold text-slate-700 mb-1">STNK Kendaraan</label>
                                    <input type="text" wire:model="nomor_stnk" placeholder="Nomor STNK"
                                           class="w-full px-3.5 py-2 rounded-xl border border-slate-300 text-xs font-medium focus:border-sky-500 focus:ring-2 focus:ring-sky-200 bg-white">
                                    @error('nomor_stnk') <p class="text-[11px] text-red-600 mt-1">{{ $message }}</p> @enderror
                                </div>
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
