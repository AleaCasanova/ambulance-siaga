<div>
    <!-- Header -->
    <div class="mb-7 flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
        <div>
            <h1 class="text-xl sm:text-2xl font-bold text-slate-900 tracking-tight">
                {{ $isSupirPage ? 'Kelola Supir' : 'Kelola Pengguna & Role' }}
            </h1>
            <p class="text-slate-500 text-xs sm:text-sm mt-1">
                {{ $isSupirPage ? 'Daftar pengemudi ambulans mitra beserta status SIM dan kesiapan bertugas.' : 'Manajemen data akun seluruh pengguna sistem Ambulans Siaga.' }}
            </p>
        </div>

        <div class="flex items-center gap-3 shrink-0">
            <input type="text" wire:model.live.debounce.300ms="search"
                   placeholder="Cari nama, email, SIM..."
                   class="w-44 sm:w-60 px-3.5 py-2 rounded-xl border border-slate-200 bg-white text-xs font-medium focus:border-slate-400 focus:ring-2 focus:ring-slate-100 shadow-xs transition-all">

            <button type="button" wire:click="openCreateModal"
                    class="inline-flex items-center gap-1.5 px-4 py-2 rounded-xl bg-primary-600 hover:bg-primary-700 text-white font-semibold text-xs shadow-xs transition-all whitespace-nowrap">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/>
                </svg>
                <span>{{ $isSupirPage ? 'Tambah Supir' : 'Tambah Pengguna' }}</span>
            </button>
        </div>
    </div>

    @if(!$isSupirPage)
        <!-- Role Filter Tabs (Clean & Elegant Segmented Control) -->
        <div class="mb-5 flex items-center justify-between border-b border-slate-200/80 pb-3">
            <div class="flex items-center gap-1.5 overflow-x-auto scrollbar-none py-0.5">
                <!-- Tab: Semua -->
                <button type="button" 
                        wire:click="setRoleFilter('')"
                        class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-lg text-xs font-semibold transition-all whitespace-nowrap {{ $roleFilter === '' ? 'bg-slate-900 text-white shadow-xs' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-100' }}">
                    <span>Semua Role</span>
                    @if($totalUnverified > 0)
                        <span class="px-1.5 py-0.5 rounded-full text-[10px] font-bold leading-none {{ $roleFilter === '' ? 'bg-rose-500 text-white' : 'bg-rose-100 text-rose-600' }}">
                            {{ $totalUnverified }}
                        </span>
                    @endif
                </button>

                @foreach($roles as $rl)
                    @php
                        $isCurrentRole = (string)$roleFilter === (string)$rl->id;
                        $unverifiedCount = $unverifiedCounts[$rl->id] ?? 0;
                        $displayLabel = match($rl->name) {
                            'supir' => 'Driver',
                            'mitra' => 'Mitra',
                            'masyarakat' => 'Masyarakat',
                            'operator' => 'Operator',
                            'admin' => 'Admin',
                            default => ($rl->label ?? ucfirst($rl->name)),
                        };
                    @endphp

                    <button type="button" 
                            wire:click="setRoleFilter('{{ $rl->id }}')"
                            class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-lg text-xs font-semibold transition-all whitespace-nowrap {{ $isCurrentRole ? 'bg-slate-900 text-white shadow-xs' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-100' }}">
                        <span>{{ $displayLabel }}</span>
                        @if($unverifiedCount > 0)
                            <span class="px-1.5 py-0.5 rounded-full text-[10px] font-bold leading-none {{ $isCurrentRole ? 'bg-rose-500 text-white' : 'bg-rose-100 text-rose-600' }}">
                                {{ $unverifiedCount }}
                            </span>
                        @endif
                    </button>
                @endforeach
            </div>

            <div class="hidden sm:block text-xs font-medium text-slate-400 shrink-0">
                Total {{ $users->total() }} akun
            </div>
        </div>
    @endif

    <!-- Table Users (DGV) -->
    <div class="bg-white rounded-2xl border border-slate-200/80 shadow-xs overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50/75 border-b border-slate-200 text-[11px] font-semibold text-slate-500 uppercase tracking-wider">
                        <th class="py-3 px-5 whitespace-nowrap">Pengguna</th>
                        <th class="py-3 px-5 whitespace-nowrap">Role</th>
                        <th class="py-3 px-5 whitespace-nowrap">Kontak</th>
                        <th class="py-3 px-5 whitespace-nowrap">Info Khusus</th>
                        <th class="py-3 px-5 whitespace-nowrap">Status</th>
                        <th class="py-3 px-5 whitespace-nowrap text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-sm">
                    @forelse($users as $user)
                        <tr class="hover:bg-slate-50/60 transition-colors">
                            <td class="py-3 px-5">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-full bg-slate-100 border border-slate-200/80 text-slate-600 font-bold text-xs flex items-center justify-center shrink-0">
                                        {{ strtoupper(substr($user->name, 0, 2)) }}
                                    </div>
                                    <div class="min-w-0">
                                        <span class="font-bold text-slate-900 text-xs sm:text-sm block truncate">{{ $user->name }}</span>
                                        <span class="text-[11px] text-slate-400 block truncate">{{ $user->email }}</span>
                                    </div>
                                </div>
                            </td>
                            <td class="py-3 px-5 whitespace-nowrap">
                                <span class="text-xs font-medium text-slate-700">{{ $user->role_label }}</span>
                            </td>
                            <td class="py-3 px-5 whitespace-nowrap">
                                <span class="text-xs text-slate-600 font-medium">{{ $user->phone ?: '-' }}</span>
                            </td>
                            <td class="py-3 px-5">
                                @if($user->isSupir())
                                    <div class="text-xs space-y-0.5">
                                        <span class="font-medium text-slate-700 block">SIM: {{ $user->supir?->nomor_sim ?: '-' }}</span>
                                        <span class="text-[11px] text-slate-400 block">Plat: {{ $user->supir?->plat_nomor ?: '-' }}</span>
                                    </div>
                                @elseif($user->isMitra())
                                    <div class="text-xs space-y-0.5">
                                        <span class="font-medium text-slate-700 block">{{ $user->mitra?->nama_mitra ?: 'Mitra Lembaga' }}</span>
                                        <span class="text-[11px] text-slate-400 block">Plat: {{ $user->mitra?->plat_nomor_unit ?: '-' }}</span>
                                    </div>
                                @elseif($user->hasRole('masyarakat'))
                                    <div class="text-xs space-y-0.5">
                                        <span class="font-medium text-slate-700 block">NIK: {{ $user->masyarakat?->nik ?: '-' }}</span>
                                        <span class="text-[11px] text-slate-400 truncate max-w-xs block">{{ $user->masyarakat?->alamat ?: '-' }}</span>
                                    </div>
                                @else
                                    <span class="text-xs text-slate-400 font-medium">-</span>
                                @endif
                            </td>
                            <td class="py-3 px-5 whitespace-nowrap">
                                @if($user->is_active)
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-[11px] font-medium bg-emerald-50 text-emerald-700 border border-emerald-200/50">
                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                        <span>Aktif</span>
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-[11px] font-medium bg-amber-50 text-amber-700 border border-amber-200/60">
                                        <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>
                                        <span>Perlu Verifikasi</span>
                                    </span>
                                @endif
                            </td>
                            <td class="py-3 px-5 text-right whitespace-nowrap">
                                <div class="flex items-center justify-end gap-1.5">
                                    @if(!$user->is_active && $user->id !== auth()->id())
                                        <!-- Verifikasi (Checkmark) -->
                                        <button type="button" wire:click="toggleActive({{ $user->id }})"
                                                wire:confirm="Verifikasi dan aktifkan akun '{{ $user->name }}' sekarang?"
                                                title="Verifikasi & Aktifkan Akun"
                                                class="w-8 h-8 rounded-lg bg-emerald-50 text-emerald-600 hover:bg-emerald-600 hover:text-white border border-emerald-200/80 transition-all flex items-center justify-center shadow-xs">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M5 13l4 4L19 7"/>
                                            </svg>
                                        </button>

                                        <!-- Review Dokumen (Eye / Mata) -->
                                        <button type="button" wire:click="openEditModal({{ $user->id }})"
                                                title="Review Dokumen Pendaftaran"
                                                class="w-8 h-8 rounded-lg bg-white text-slate-600 hover:text-sky-600 hover:bg-sky-50 border border-slate-200 transition-all flex items-center justify-center shadow-xs">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                            </svg>
                                        </button>
                                    @else
                                        <!-- Edit (Pencil / Pena) -->
                                        <button type="button" wire:click="openEditModal({{ $user->id }})"
                                                title="Edit Pengguna"
                                                class="w-8 h-8 rounded-lg bg-white text-slate-600 hover:text-amber-600 hover:bg-amber-50 border border-slate-200 transition-all flex items-center justify-center shadow-xs">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                            </svg>
                                        </button>
                                    @endif

                                    @if($user->id !== auth()->id())
                                        <!-- Hapus (Trash / Tempat Sampah) -->
                                        <button type="button" wire:click="deleteUser({{ $user->id }})"
                                                wire:confirm="Yakin ingin menghapus pengguna ini?"
                                                title="Hapus Pengguna"
                                                class="w-8 h-8 rounded-lg bg-white text-slate-600 hover:text-rose-600 hover:bg-rose-50 border border-slate-200 transition-all flex items-center justify-center shadow-xs">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                            </svg>
                                        </button>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="py-12 text-center text-slate-400">
                                <p class="text-xs font-medium">Tidak ada data pengguna ditemukan</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="px-5 py-3.5 border-t border-slate-100">
            {{ $users->links() }}
        </div>
    </div>

    <!-- Modal Form Create / Edit (Spacious, Elegant & No Top Clip) -->
    @if($showModal)
        <div class="fixed inset-0 z-50 bg-slate-900/60 backdrop-blur-xs flex items-center justify-center p-3 sm:p-6 overflow-hidden">
            <div class="relative bg-white rounded-2xl max-w-3xl lg:max-w-4xl w-full shadow-2xl border border-slate-200 flex flex-col max-h-[90vh] overflow-hidden animate-in fade-in zoom-in-95 duration-200">
                
                <!-- Fixed Header (Never Cut Off) -->
                <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between shrink-0 bg-white">
                    <div class="flex items-center gap-3">
                        <div class="w-9 h-9 rounded-xl {{ $isEdit && !$is_active ? 'bg-amber-50 text-amber-600' : 'bg-primary-50 text-primary-600' }} flex items-center justify-center font-bold shrink-0">
                            @if($isEdit && !$is_active)
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                            @elseif($isEdit)
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                            @else
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/></svg>
                            @endif
                        </div>
                        <div>
                            <h3 class="text-sm sm:text-base font-bold text-slate-900">
                                {{ $isEdit ? ($is_active ? 'Edit Data Pengguna' : 'Review & Verifikasi Dokumen Pendaftaran') : 'Tambah Pengguna Baru' }}
                            </h3>
                            <p class="text-xs text-slate-500">
                                {{ $isEdit ? 'Periksa informasi akun, berkas dokumen pendaftaran, dan peran pengguna.' : 'Lengkapi data formulir di bawah ini untuk membuat akun baru.' }}
                            </p>
                        </div>
                    </div>
                    <button type="button" wire:click="$set('showModal', false)" 
                            class="p-1.5 rounded-lg text-slate-400 hover:text-slate-600 hover:bg-slate-100 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                </div>

                <!-- Scrollable Form Body -->
                <form wire:submit="saveUser" id="userForm" class="flex flex-col grow overflow-hidden">
                    <div class="px-6 py-5 overflow-y-auto space-y-5 grow">
                        
                        <!-- Alert Banner for Pending Accounts -->
                        @if($isEdit && !$is_active)
                            <div class="p-3.5 rounded-xl bg-amber-50 border border-amber-200/90 flex flex-col sm:flex-row sm:items-center justify-between gap-3 shadow-2xs">
                                <div class="flex items-center gap-2.5 min-w-0">
                                    <span class="w-8 h-8 rounded-lg bg-amber-100 text-amber-800 flex items-center justify-center shrink-0">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                                    </span>
                                    <div class="min-w-0">
                                        <p class="text-xs font-bold text-amber-900">Menunggu Verifikasi & Persetujuan Admin</p>
                                        <p class="text-[11px] text-amber-700">Periksa kesesuaian dokumen pendaftaran di bawah sebelum menyetujui akun.</p>
                                    </div>
                                </div>
                                <button type="button" wire:click="toggleActive({{ $userId }})"
                                        wire:confirm="Verifikasi dan aktifkan akun '{{ $name }}' sekarang?"
                                        class="inline-flex items-center justify-center gap-1.5 px-3.5 py-1.5 rounded-lg bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs shadow-xs transition-colors shrink-0 whitespace-nowrap">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                                    <span>Verifikasi & Aktifkan</span>
                                </button>
                            </div>
                        @endif

                        <!-- SECTION 1: INFORMASI AKUN DASAR (2 Columns Grid) -->
                        <div>
                            <h4 class="text-xs font-bold text-slate-800 uppercase tracking-wider mb-3 flex items-center gap-1.5">
                                <span class="w-1.5 h-1.5 rounded-full bg-primary-600"></span>
                                Informasi Akun Dasar
                            </h4>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3.5">
                                <!-- Nama Lengkap -->
                                <div>
                                    <label class="block text-xs font-semibold text-slate-700 mb-1">Nama Lengkap</label>
                                    <input type="text" wire:model="name" required placeholder="Contoh: Budi Santoso"
                                           class="w-full px-3.5 py-2 rounded-xl border border-slate-200 text-xs font-medium focus:border-primary-500 focus:ring-2 focus:ring-primary-100 bg-white">
                                    @error('name') <p class="text-[11px] text-red-600 mt-1">{{ $message }}</p> @enderror
                                </div>

                                <!-- Email -->
                                <div>
                                    <label class="block text-xs font-semibold text-slate-700 mb-1">Alamat Email</label>
                                    <input type="email" wire:model="email" required placeholder="email@contoh.com"
                                           class="w-full px-3.5 py-2 rounded-xl border border-slate-200 text-xs font-medium focus:border-primary-500 focus:ring-2 focus:ring-primary-100 bg-white">
                                    @error('email') <p class="text-[11px] text-red-600 mt-1">{{ $message }}</p> @enderror
                                </div>

                                <!-- Telepon -->
                                <div>
                                    <label class="block text-xs font-semibold text-slate-700 mb-1">Nomor Telepon / WhatsApp</label>
                                    <input type="text" wire:model="phone" placeholder="Contoh: 081234567890"
                                           class="w-full px-3.5 py-2 rounded-xl border border-slate-200 text-xs font-medium focus:border-primary-500 focus:ring-2 focus:ring-primary-100 bg-white">
                                    @error('phone') <p class="text-[11px] text-red-600 mt-1">{{ $message }}</p> @enderror
                                </div>

                                <!-- Role Selector -->
                                <div>
                                    <label class="block text-xs font-semibold text-slate-700 mb-1">Role / Hak Akses</label>
                                    <select wire:model.live="role_id" class="w-full px-3.5 py-2 rounded-xl border border-slate-200 text-xs font-semibold text-slate-800 focus:border-primary-500 focus:ring-2 focus:ring-primary-100 bg-white">
                                        <option value="">-- Pilih Role --</option>
                                        @foreach($roles as $rl)
                                            <option value="{{ $rl->id }}">{{ $rl->label ?? ucfirst($rl->name) }}</option>
                                        @endforeach
                                    </select>
                                    @error('role_id') <p class="text-[11px] text-red-600 mt-1">{{ $message }}</p> @enderror
                                </div>
                            </div>
                        </div>

                        <!-- SECTION 2: INFORMASI KHUSUS SESUAI PERAN -->
                        @php
                            $selectedRole = $roles->firstWhere('id', $role_id);
                        @endphp

                        @if($selectedRole && $selectedRole->name === 'supir')
                            <!-- Role Supir (Driver) Data & Documents -->
                            <div class="p-4 rounded-xl bg-slate-50/80 border border-slate-200 space-y-3.5">
                                <div class="flex items-center justify-between">
                                    <h4 class="text-xs font-bold text-slate-800 uppercase tracking-wider flex items-center gap-1.5">
                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                        Informasi Lembaga & Kendaraan Driver
                                    </h4>
                                    <label class="inline-flex items-center gap-1.5 cursor-pointer normal-case text-xs font-semibold text-slate-700">
                                        <input type="checkbox" wire:model="status_online" class="rounded border-slate-300 text-emerald-600 focus:ring-emerald-500">
                                        <span>Status Online (Siaga)</span>
                                    </label>
                                </div>

                                <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                                    <div>
                                        <label class="block text-[11px] font-medium text-slate-600 mb-1">Nama Lembaga / Mitra</label>
                                        <input type="text" wire:model="nama_lembaga" placeholder="PMI Cilacap / RS Mitra"
                                               class="w-full px-3 py-1.5 rounded-lg border border-slate-200 text-xs bg-white focus:border-primary-500">
                                    </div>
                                    <div>
                                        <label class="block text-[11px] font-medium text-slate-600 mb-1">Nama Penanggung Jawab</label>
                                        <input type="text" wire:model="nama_penanggung_jawab" placeholder="Nama Koordinator"
                                               class="w-full px-3 py-1.5 rounded-lg border border-slate-200 text-xs bg-white focus:border-primary-500">
                                    </div>
                                    <div>
                                        <label class="block text-[11px] font-medium text-slate-600 mb-1">Alamat Pos / Unit</label>
                                        <input type="text" wire:model="alamat_unit" placeholder="Alamat pangkalan armada"
                                               class="w-full px-3 py-1.5 rounded-lg border border-slate-200 text-xs bg-white focus:border-primary-500">
                                    </div>
                                </div>

                                <div class="grid grid-cols-2 sm:grid-cols-4 gap-3">
                                    <div>
                                        <label class="block text-[11px] font-medium text-slate-600 mb-1">Plat Nomor Mobil</label>
                                        <input type="text" wire:model="plat_nomor" placeholder="R 1234 XY"
                                               class="w-full px-3 py-1.5 rounded-lg border border-slate-200 text-xs font-mono uppercase bg-white focus:border-primary-500">
                                    </div>
                                    <div>
                                        <label class="block text-[11px] font-medium text-slate-600 mb-1">Merk / Tipe Mobil</label>
                                        <input type="text" wire:model="merk_kendaraan" placeholder="APV / HiAce"
                                               class="w-full px-3 py-1.5 rounded-lg border border-slate-200 text-xs bg-white focus:border-primary-500">
                                    </div>
                                    <div>
                                        <label class="block text-[11px] font-medium text-slate-600 mb-1">Nomor SIM</label>
                                        <input type="text" wire:model="nomor_sim" placeholder="SIM A / B1"
                                               class="w-full px-3 py-1.5 rounded-lg border border-slate-200 text-xs bg-white focus:border-primary-500">
                                    </div>
                                    <div>
                                        <label class="block text-[11px] font-medium text-slate-600 mb-1">NIK Driver</label>
                                        <input type="text" wire:model="nik" placeholder="16 digit NIK"
                                               class="w-full px-3 py-1.5 rounded-lg border border-slate-200 text-xs bg-white focus:border-primary-500">
                                    </div>
                                </div>

                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                    <div>
                                        <label class="block text-[11px] font-medium text-slate-600 mb-1">Nomor STNK</label>
                                        <input type="text" wire:model="nomor_stnk" placeholder="Nomor STNK kendaraan"
                                               class="w-full px-3 py-1.5 rounded-lg border border-slate-200 text-xs bg-white focus:border-primary-500">
                                    </div>
                                    <div>
                                        <label class="block text-[11px] font-medium text-slate-600 mb-1">Nomor SKCK Kepolisian</label>
                                        <input type="text" wire:model="nomor_skck" placeholder="Nomor SKCK"
                                               class="w-full px-3 py-1.5 rounded-lg border border-slate-200 text-xs bg-white focus:border-primary-500">
                                    </div>
                                </div>

                                <!-- Lampiran Foto Dokumen Supir (4 Columns Gallery) -->
                                <div class="pt-2 border-t border-slate-200">
                                    <label class="block text-[11px] font-bold text-slate-700 uppercase tracking-wider mb-2">
                                        Lampiran Dokumen Pendaftaran:
                                    </label>
                                    <div class="grid grid-cols-2 sm:grid-cols-4 gap-2.5">
                                        <!-- e-KTP -->
                                        <div class="p-2 rounded-lg border border-slate-200 bg-white text-center shadow-2xs">
                                            <span class="text-[10px] font-semibold text-slate-500 block mb-1">Foto e-KTP</span>
                                            @if($foto_ktp)
                                                <a href="{{ asset('storage/' . $foto_ktp) }}" target="_blank" class="block group">
                                                    <img src="{{ asset('storage/' . $foto_ktp) }}" class="w-full h-14 object-cover rounded border border-slate-100 group-hover:opacity-80 transition-opacity">
                                                    <span class="text-[10px] font-bold text-primary-600 group-hover:underline mt-1 block">Lihat Foto &nearr;</span>
                                                </a>
                                            @else
                                                <div class="h-14 rounded bg-slate-50 border border-dashed border-slate-200 flex items-center justify-center text-[10px] text-slate-400">Belum Ada</div>
                                            @endif
                                        </div>

                                        <!-- SIM -->
                                        <div class="p-2 rounded-lg border border-slate-200 bg-white text-center shadow-2xs">
                                            <span class="text-[10px] font-semibold text-slate-500 block mb-1">Foto SIM</span>
                                            @if($foto_sim)
                                                <a href="{{ asset('storage/' . $foto_sim) }}" target="_blank" class="block group">
                                                    <img src="{{ asset('storage/' . $foto_sim) }}" class="w-full h-14 object-cover rounded border border-slate-100 group-hover:opacity-80 transition-opacity">
                                                    <span class="text-[10px] font-bold text-primary-600 group-hover:underline mt-1 block">Lihat Foto &nearr;</span>
                                                </a>
                                            @else
                                                <div class="h-14 rounded bg-slate-50 border border-dashed border-slate-200 flex items-center justify-center text-[10px] text-slate-400">Belum Ada</div>
                                            @endif
                                        </div>

                                        <!-- STNK -->
                                        <div class="p-2 rounded-lg border border-slate-200 bg-white text-center shadow-2xs">
                                            <span class="text-[10px] font-semibold text-slate-500 block mb-1">Foto STNK</span>
                                            @if($foto_stnk)
                                                <a href="{{ asset('storage/' . $foto_stnk) }}" target="_blank" class="block group">
                                                    <img src="{{ asset('storage/' . $foto_stnk) }}" class="w-full h-14 object-cover rounded border border-slate-100 group-hover:opacity-80 transition-opacity">
                                                    <span class="text-[10px] font-bold text-primary-600 group-hover:underline mt-1 block">Lihat Foto &nearr;</span>
                                                </a>
                                            @else
                                                <div class="h-14 rounded bg-slate-50 border border-dashed border-slate-200 flex items-center justify-center text-[10px] text-slate-400">Belum Ada</div>
                                            @endif
                                        </div>

                                        <!-- SKCK -->
                                        <div class="p-2 rounded-lg border border-slate-200 bg-white text-center shadow-2xs">
                                            <span class="text-[10px] font-semibold text-slate-500 block mb-1">Foto SKCK</span>
                                            @if($foto_skck)
                                                <a href="{{ asset('storage/' . $foto_skck) }}" target="_blank" class="block group">
                                                    <img src="{{ asset('storage/' . $foto_skck) }}" class="w-full h-14 object-cover rounded border border-slate-100 group-hover:opacity-80 transition-opacity">
                                                    <span class="text-[10px] font-bold text-primary-600 group-hover:underline mt-1 block">Lihat Foto &nearr;</span>
                                                </a>
                                            @else
                                                <div class="h-14 rounded bg-slate-50 border border-dashed border-slate-200 flex items-center justify-center text-[10px] text-slate-400">Belum Ada</div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @elseif($selectedRole && $selectedRole->name === 'mitra')
                            <!-- Role Mitra Lembaga Data & Documents -->
                            <div class="p-4 rounded-xl bg-slate-50/80 border border-slate-200 space-y-3.5">
                                <h4 class="text-xs font-bold text-slate-800 uppercase tracking-wider flex items-center gap-1.5">
                                    <span class="w-1.5 h-1.5 rounded-full bg-teal-500"></span>
                                    Informasi Mitra Lembaga & Legalitas
                                </h4>

                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                    <div>
                                        <label class="block text-[11px] font-medium text-slate-600 mb-1">Nama Lembaga / Yayasan</label>
                                        <input type="text" wire:model="nama_lembaga" placeholder="Contoh: Klinik Medika Siaga"
                                               class="w-full px-3 py-1.5 rounded-lg border border-slate-200 text-xs bg-white focus:border-primary-500">
                                    </div>
                                    <div>
                                        <label class="block text-[11px] font-medium text-slate-600 mb-1">Nama Penanggung Jawab</label>
                                        <input type="text" wire:model="nama_penanggung_jawab" placeholder="Nama Koordinator PJ"
                                               class="w-full px-3 py-1.5 rounded-lg border border-slate-200 text-xs bg-white focus:border-primary-500">
                                    </div>
                                    <div>
                                        <label class="block text-[11px] font-medium text-slate-600 mb-1">Nomor Izin / Legalitas</label>
                                        <input type="text" wire:model="nomor_legalitas" placeholder="NIB / Akta Notaris"
                                               class="w-full px-3 py-1.5 rounded-lg border border-slate-200 text-xs bg-white focus:border-primary-500">
                                    </div>
                                    <div>
                                        <label class="block text-[11px] font-medium text-slate-600 mb-1">Plat Nomor Armada Utama</label>
                                        <input type="text" wire:model="plat_nomor" placeholder="Plat nomor unit"
                                               class="w-full px-3 py-1.5 rounded-lg border border-slate-200 text-xs uppercase font-mono bg-white focus:border-primary-500">
                                    </div>
                                </div>

                                <!-- Galeri Dokumen Legalitas Mitra (3 Columns) -->
                                <div class="pt-2 border-t border-slate-200">
                                    <label class="block text-[11px] font-bold text-slate-700 uppercase tracking-wider mb-2">
                                        Dokumen Fisik & Legalitas Lembaga:
                                    </label>
                                    <div class="grid grid-cols-3 gap-2.5">
                                        <!-- KTP PJ -->
                                        <div class="p-2 rounded-lg border border-slate-200 bg-white text-center shadow-2xs">
                                            <span class="text-[10px] font-semibold text-slate-500 block mb-1">KTP Penanggung Jawab</span>
                                            @if($foto_ktp_pj)
                                                <a href="{{ asset('storage/' . $foto_ktp_pj) }}" target="_blank" class="block group">
                                                    <img src="{{ asset('storage/' . $foto_ktp_pj) }}" class="w-full h-14 object-cover rounded border border-slate-100 group-hover:opacity-80 transition-opacity">
                                                    <span class="text-[10px] font-bold text-primary-600 group-hover:underline mt-1 block">Lihat KTP &nearr;</span>
                                                </a>
                                            @else
                                                <div class="h-14 rounded bg-slate-50 border border-dashed border-slate-200 flex items-center justify-center text-[10px] text-slate-400">Belum Ada</div>
                                            @endif
                                        </div>

                                        <!-- Legalitas -->
                                        <div class="p-2 rounded-lg border border-slate-200 bg-white text-center shadow-2xs">
                                            <span class="text-[10px] font-semibold text-slate-500 block mb-1">Surat Izin / Legalitas</span>
                                            @if($foto_legalitas)
                                                <a href="{{ asset('storage/' . $foto_legalitas) }}" target="_blank" class="block group">
                                                    <img src="{{ asset('storage/' . $foto_legalitas) }}" class="w-full h-14 object-cover rounded border border-slate-100 group-hover:opacity-80 transition-opacity">
                                                    <span class="text-[10px] font-bold text-primary-600 group-hover:underline mt-1 block">Lihat Izin &nearr;</span>
                                                </a>
                                            @else
                                                <div class="h-14 rounded bg-slate-50 border border-dashed border-slate-200 flex items-center justify-center text-[10px] text-slate-400">Belum Ada</div>
                                            @endif
                                        </div>

                                        <!-- Foto Ambulans -->
                                        <div class="p-2 rounded-lg border border-slate-200 bg-white text-center shadow-2xs">
                                            <span class="text-[10px] font-semibold text-slate-500 block mb-1">Unit Ambulans / STNK</span>
                                            @if($foto_ambulans)
                                                <a href="{{ asset('storage/' . $foto_ambulans) }}" target="_blank" class="block group">
                                                    <img src="{{ asset('storage/' . $foto_ambulans) }}" class="w-full h-14 object-cover rounded border border-slate-100 group-hover:opacity-80 transition-opacity">
                                                    <span class="text-[10px] font-bold text-primary-600 group-hover:underline mt-1 block">Lihat Unit &nearr;</span>
                                                </a>
                                            @else
                                                <div class="h-14 rounded bg-slate-50 border border-dashed border-slate-200 flex items-center justify-center text-[10px] text-slate-400">Belum Ada</div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @elseif($selectedRole && $selectedRole->name === 'masyarakat')
                            <!-- Role Masyarakat Data -->
                            <div class="p-4 rounded-xl bg-slate-50/80 border border-slate-200 space-y-3">
                                <h4 class="text-xs font-bold text-slate-800 uppercase tracking-wider flex items-center gap-1.5">
                                    <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>
                                    Informasi Warga / Masyarakat
                                </h4>
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                    <div>
                                        <label class="block text-[11px] font-medium text-slate-600 mb-1">Nomor KTP (NIK)</label>
                                        <input type="text" wire:model="nik" placeholder="16 Digit NIK KTP"
                                               class="w-full px-3 py-1.5 rounded-lg border border-slate-200 text-xs bg-white focus:border-primary-500">
                                    </div>
                                    <div>
                                        <label class="block text-[11px] font-medium text-slate-600 mb-1">Kontak Darurat</label>
                                        <input type="text" wire:model="kontak_darurat" placeholder="Nomor kontak darurat"
                                               class="w-full px-3 py-1.5 rounded-lg border border-slate-200 text-xs bg-white focus:border-primary-500">
                                    </div>
                                </div>
                                <div>
                                    <label class="block text-[11px] font-medium text-slate-600 mb-1">Alamat Tempat Tinggal</label>
                                    <input type="text" wire:model="alamat" placeholder="Jl. Raya Cilacap No. 10..."
                                           class="w-full px-3 py-1.5 rounded-lg border border-slate-200 text-xs bg-white focus:border-primary-500">
                                </div>
                            </div>
                        @endif

                        <!-- SECTION 3: KEAMANAN & STATUS AKUN (2 Columns) -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3.5 pt-1">
                            <!-- Password -->
                            <div>
                                <label class="block text-xs font-semibold text-slate-700 mb-1">
                                    Kata Sandi {{ $isEdit ? '(Kosongkan jika tetap)' : '' }}
                                </label>
                                <input type="password" wire:model="password" {{ $isEdit ? '' : 'required' }} placeholder="••••••••"
                                       class="w-full px-3.5 py-2 rounded-xl border border-slate-200 text-xs font-medium focus:border-primary-500 focus:ring-2 focus:ring-primary-100 bg-white">
                                @error('password') <p class="text-[11px] text-red-600 mt-1">{{ $message }}</p> @enderror
                            </div>

                            <!-- Is Active Checkbox in neat card -->
                            <div>
                                <label class="block text-xs font-semibold text-slate-700 mb-1">Status Login Akun</label>
                                <label class="flex items-center gap-2.5 px-3.5 py-2 rounded-xl border border-slate-200 bg-slate-50/70 hover:bg-slate-100/70 cursor-pointer transition-colors">
                                    <input type="checkbox" wire:model="is_active" class="rounded border-slate-300 text-primary-600 focus:ring-primary-500">
                                    <div class="text-xs">
                                        <span class="font-bold text-slate-800 block">Akun Aktif & Terverifikasi</span>
                                    </div>
                                </label>
                            </div>
                        </div>
                    </div>

                    <!-- Fixed Footer (Always Visible at Bottom) -->
                    <div class="px-6 py-3.5 border-t border-slate-100 flex items-center justify-end gap-2.5 shrink-0 bg-slate-50/80">
                        <button type="button" wire:click="$set('showModal', false)"
                                class="px-4 py-2 rounded-xl border border-slate-200 bg-white hover:bg-slate-100 text-slate-600 font-semibold text-xs transition-colors shadow-xs">
                            Batal
                        </button>
                        <button type="submit"
                                class="inline-flex items-center gap-1.5 px-5 py-2 rounded-xl bg-primary-600 hover:bg-primary-700 text-white font-bold text-xs shadow-xs transition-all">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            <span>{{ $isEdit ? 'Simpan Perubahan' : 'Tambah Pengguna' }}</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endif
</div>
