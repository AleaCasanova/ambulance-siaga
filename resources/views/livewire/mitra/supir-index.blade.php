<div>
    <!-- Header Page -->
    <div class="mb-8 flex flex-col lg:flex-row lg:items-end lg:justify-between gap-4">
        <div>
            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[11px] font-bold bg-slate-100 text-slate-500 uppercase tracking-wider mb-2.5">
                Personel & Petugas Medis
            </span>
            <h1 class="text-2xl sm:text-[28px] font-bold text-slate-900 tracking-tight leading-tight">
                Driver & Petugas {{ $mitra->nama_mitra ?? 'Lembaga' }}
            </h1>
            <p class="text-slate-500 text-[14px] mt-1 font-medium">
                Kelola data pengemudi resmi, nomor SIM, kontak darurat WhatsApp, dan status kesiapan piket online.
            </p>
        </div>

        <div class="flex items-center gap-2.5 shrink-0">
            <!-- Search -->
            <input type="text" wire:model.live.debounce.300ms="search"
                   placeholder="Cari nama, SIM..."
                   class="w-40 sm:w-52 px-3.5 py-2 rounded-xl border border-slate-300 bg-white text-xs font-medium focus:border-sky-500 focus:ring-2 focus:ring-sky-200 shadow-xs">

            <!-- Filter Status Online Custom Dropdown -->
            <div class="relative" x-data="{ open: false }">
                <button type="button" @click="open = !open" @click.outside="open = false"
                        class="flex items-center justify-between gap-2 px-3.5 py-2 rounded-xl border border-slate-300 bg-white text-xs font-semibold text-slate-700 shadow-xs hover:border-slate-400 focus:outline-none focus:ring-2 focus:ring-sky-100 transition-all whitespace-nowrap">
                    <span>
                        @if($statusOnlineFilter === '1') Online (Standby)
                        @elseif($statusOnlineFilter === '0') Offline
                        @else Semua Status
                        @endif
                    </span>
                    <svg class="w-3.5 h-3.5 text-slate-400 transition-transform duration-200" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                </button>

                <div x-show="open" x-transition.opacity.duration.150ms
                     class="absolute right-0 top-full mt-1.5 w-44 bg-white rounded-xl shadow-xl border border-slate-200 py-1.5 z-50 overflow-hidden"
                     style="display: none;">
                    <button type="button" @click="$wire.set('statusOnlineFilter', ''); open = false"
                            class="w-full text-left px-3.5 py-2 text-xs font-semibold flex items-center justify-between hover:bg-sky-50 hover:text-sky-600 transition-colors {{ $statusOnlineFilter === '' ? 'text-sky-600 bg-sky-50/50' : 'text-slate-700' }}">
                        <span>Semua Status</span>
                        @if($statusOnlineFilter === '') <svg class="w-3.5 h-3.5 text-sky-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg> @endif
                    </button>
                    <button type="button" @click="$wire.set('statusOnlineFilter', '1'); open = false"
                            class="w-full text-left px-3.5 py-2 text-xs font-semibold flex items-center justify-between hover:bg-sky-50 hover:text-sky-600 transition-colors {{ $statusOnlineFilter === '1' ? 'text-sky-600 bg-sky-50/50' : 'text-slate-700' }}">
                        <span>Online (Standby)</span>
                        @if($statusOnlineFilter === '1') <svg class="w-3.5 h-3.5 text-sky-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg> @endif
                    </button>
                    <button type="button" @click="$wire.set('statusOnlineFilter', '0'); open = false"
                            class="w-full text-left px-3.5 py-2 text-xs font-semibold flex items-center justify-between hover:bg-sky-50 hover:text-sky-600 transition-colors {{ $statusOnlineFilter === '0' ? 'text-sky-600 bg-sky-50/50' : 'text-slate-700' }}">
                        <span>Offline</span>
                        @if($statusOnlineFilter === '0') <svg class="w-3.5 h-3.5 text-sky-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg> @endif
                    </button>
                </div>
            </div>

            <!-- Tombol Tambah Driver -->
            <button type="button" wire:click="openCreateModal"
                    class="inline-flex items-center gap-1.5 px-4 py-2 rounded-xl bg-sky-600 hover:bg-sky-700 text-white font-bold text-xs shadow-md transition-all whitespace-nowrap">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/></svg>
                <span>Daftarkan Driver</span>
            </button>
        </div>
    </div>

    <!-- Alert Flash -->
    @if(session()->has('message'))
        <div class="mb-6 p-4 rounded-2xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-sm font-bold flex items-center justify-between shadow-xs">
            <span>✅ {{ session('message') }}</span>
            <button type="button" onclick="this.parentElement.remove()" class="text-emerald-500 hover:text-emerald-700">&times;</button>
        </div>
    @endif

    <!-- Table Card -->
    <div class="bg-white border border-slate-200/80 rounded-3xl overflow-hidden shadow-xs">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b border-slate-100 bg-slate-50/75">
                        <th class="py-4 px-6 text-[11px] font-bold uppercase tracking-wider text-slate-500">Profil Driver</th>
                        <th class="py-4 px-6 text-[11px] font-bold uppercase tracking-wider text-slate-500">Legalitas (SIM / STNK)</th>
                        <th class="py-4 px-6 text-[11px] font-bold uppercase tracking-wider text-slate-500">Kontak WhatsApp</th>
                        <th class="py-4 px-6 text-[11px] font-bold uppercase tracking-wider text-slate-500">Status Piket</th>
                        <th class="py-4 px-6 text-[11px] font-bold uppercase tracking-wider text-slate-500 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($supirs as $spr)
                        <tr class="hover:bg-slate-50/50 transition-colors">
                            <td class="py-4 px-6">
                                <div>
                                    <span class="font-bold text-slate-900 block text-sm">{{ $spr->user?->name ?? 'Driver ID ' . $spr->id }}</span>
                                    <span class="text-xs text-slate-400 font-medium">{{ $spr->user?->email ?? '-' }}</span>
                                </div>
                            </td>
                            <td class="py-4 px-6">
                                <div class="space-y-0.5">
                                    <span class="text-xs font-bold text-slate-700 block">SIM: <span class="font-mono text-slate-900">{{ $spr->nomor_sim ?? '-' }}</span></span>
                                    <span class="text-[11px] text-slate-500">STNK: {{ $spr->nomor_stnk ?? '-' }}</span>
                                </div>
                            </td>
                            <td class="py-4 px-6">
                                <span class="text-xs font-bold text-slate-800">
                                    📞 {{ $spr->no_wa ?? $spr->user?->phone ?? '-' }}
                                </span>
                            </td>
                            <td class="py-4 px-6">
                                <button type="button" wire:click="toggleOnline({{ $spr->id }})"
                                        class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold transition-all
                                        {{ $spr->status_online ? 'bg-emerald-50 text-emerald-700 border border-emerald-200 hover:bg-emerald-100' : 'bg-slate-100 text-slate-600 border border-slate-200 hover:bg-slate-200' }}">
                                    <span class="w-1.5 h-1.5 rounded-full {{ $spr->status_online ? 'bg-emerald-500 animate-ping' : 'bg-slate-400' }}"></span>
                                    <span>{{ $spr->status_online ? 'Online (Standby)' : 'Offline (Libur)' }}</span>
                                </button>
                            </td>
                            <td class="py-4 px-6 text-right">
                                <button type="button" wire:click="openEditModal({{ $spr->id }})"
                                        class="p-2 rounded-xl bg-slate-100 hover:bg-sky-50 hover:text-sky-600 text-slate-600 transition-colors"
                                        title="Edit Profil Driver">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/></svg>
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="py-12 text-center text-slate-400">
                                <div class="w-16 h-16 rounded-full bg-slate-50 flex items-center justify-center mx-auto mb-3 text-2xl">👨‍✈️</div>
                                <p class="font-bold text-slate-600">Belum ada driver terdaftar</p>
                                <p class="text-xs text-slate-400 mt-1">Daftarkan driver resmi lembaga Anda melalui tombol Daftarkan Driver.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="p-4 border-t border-slate-100">
            {{ $supirs->links() }}
        </div>
    </div>

    <!-- Modal Tambah / Edit Driver -->
    @if($isModalOpen)
        <div class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-xs">
            <div class="w-full max-w-lg bg-white rounded-3xl shadow-2xl border border-slate-200 p-6 sm:p-8 relative">
                <button type="button" wire:click="closeModal" class="absolute right-5 top-5 text-slate-400 hover:text-slate-600 text-xl font-bold">
                    &times;
                </button>

                <h3 class="text-lg font-bold text-slate-900 mb-1">
                    {{ $supirId ? 'Ubah Data Driver' : 'Daftarkan Driver Resmi Lembaga' }}
                </h3>
                <p class="text-xs text-slate-500 mb-6">Driver akan memiliki akun untuk login ke aplikasi driver dan navigasi GPS.</p>

                <form wire:submit.prevent="save" class="space-y-4">
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Nama Lengkap Driver</label>
                        <input type="text" wire:model="name" required placeholder="Nama Lengkap Petugas"
                               class="w-full px-4 py-2.5 rounded-xl border border-slate-300 text-sm font-semibold focus:border-sky-500 focus:ring-2 focus:ring-sky-200">
                        @error('name') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
                    </div>

                    @if(!$supirId)
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-bold text-slate-700 mb-1">Alamat Email</label>
                                <input type="email" wire:model="email" required placeholder="driver@lembaga.com"
                                       class="w-full px-4 py-2.5 rounded-xl border border-slate-300 text-sm font-medium focus:border-sky-500 focus:ring-2 focus:ring-sky-200">
                                @error('email') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-slate-700 mb-1">Password Akun</label>
                                <input type="password" wire:model="password" required placeholder="Minimal 6 karakter"
                                       class="w-full px-4 py-2.5 rounded-xl border border-slate-300 text-sm font-medium focus:border-sky-500 focus:ring-2 focus:ring-sky-200">
                                @error('password') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
                            </div>
                        </div>
                    @endif

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1">Nomor WhatsApp / HP</label>
                            <input type="text" wire:model="phone" placeholder="08123456789"
                                   class="w-full px-4 py-2.5 rounded-xl border border-slate-300 text-sm font-medium focus:border-sky-500 focus:ring-2 focus:ring-sky-200">
                            @error('phone') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1">Nomor SIM (Wajib Aktif)</label>
                            <input type="text" wire:model="nomor_sim" required placeholder="Cth: 1234-5678-9012"
                                   class="w-full px-4 py-2.5 rounded-xl border border-slate-300 text-sm font-semibold focus:border-sky-500 focus:ring-2 focus:ring-sky-200">
                            @error('nomor_sim') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <div class="flex gap-3 pt-4 border-t border-slate-100">
                        <button type="button" wire:click="closeModal"
                                class="flex-1 py-2.5 rounded-xl border border-slate-300 text-slate-700 text-sm font-bold hover:bg-slate-50 transition-colors">
                            Batal
                        </button>
                        <button type="submit"
                                class="flex-1 py-2.5 rounded-xl bg-sky-600 hover:bg-sky-700 text-white text-sm font-bold shadow-md shadow-sky-600/30 transition-all">
                            {{ $supirId ? 'Simpan Perubahan' : 'Daftarkan Driver' }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endif
</div>
