<div>
    <!-- Header Page -->
    <div class="mb-8 flex flex-col lg:flex-row lg:items-end lg:justify-between gap-4">
        <div>
            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[11px] font-bold bg-slate-100 text-slate-500 uppercase tracking-wider mb-2.5">
                Inventaris & Kesiapan Medis
            </span>
            <h1 class="text-2xl sm:text-[28px] font-bold text-slate-900 tracking-tight leading-tight">
                Armada Ambulans {{ $mitra->nama_mitra ?? 'Lembaga' }}
            </h1>
            <p class="text-slate-500 text-[14px] mt-1 font-medium">
                Kelola unit ambulans, plat nomor, perlengkapan medis darurat, dan status operasional.
            </p>
        </div>

        <div class="flex items-center gap-2.5 shrink-0">
            <!-- Search -->
            <input type="text" wire:model.live.debounce.300ms="search"
                   placeholder="Cari kode, plat..."
                   class="w-40 sm:w-52 px-3.5 py-2 rounded-xl border border-slate-300 bg-white text-xs font-medium focus:border-sky-500 focus:ring-2 focus:ring-sky-200 shadow-xs">

            <!-- Custom Filter Status Dropdown -->
            <div class="relative" x-data="{ open: false }">
                <button type="button" @click="open = !open" @click.outside="open = false"
                        class="flex items-center justify-between gap-2 px-3.5 py-2 rounded-xl border border-slate-300 bg-white text-xs font-semibold text-slate-700 shadow-xs hover:border-slate-400 focus:outline-none focus:ring-2 focus:ring-sky-100 transition-all whitespace-nowrap">
                    <span>{{ $statusFilter ?: 'Semua Status' }}</span>
                    <svg class="w-3.5 h-3.5 text-slate-400 transition-transform duration-200" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                </button>

                <div x-show="open" x-transition.opacity.duration.150ms
                     class="absolute right-0 top-full mt-1.5 w-44 bg-white rounded-xl shadow-xl border border-slate-200 py-1.5 z-50 overflow-hidden"
                     style="display: none;">
                    <button type="button" @click="$wire.set('statusFilter', ''); open = false"
                            class="w-full text-left px-3.5 py-2 text-xs font-semibold flex items-center justify-between hover:bg-sky-50 hover:text-sky-600 transition-colors {{ $statusFilter === '' ? 'text-sky-600 bg-sky-50/50' : 'text-slate-700' }}">
                        <span>Semua Status</span>
                        @if($statusFilter === '') <svg class="w-3.5 h-3.5 text-sky-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg> @endif
                    </button>
                    @foreach(['Tersedia' => 'Tersedia (Siaga)', 'Ditugaskan' => 'Sedang Ditugaskan', 'Perawatan' => 'Perawatan / Service', 'Tidak Aktif' => 'Tidak Aktif'] as $val => $lbl)
                        <button type="button" @click="$wire.set('statusFilter', '{{ $val }}'); open = false"
                                class="w-full text-left px-3.5 py-2 text-xs font-semibold flex items-center justify-between hover:bg-sky-50 hover:text-sky-600 transition-colors {{ $statusFilter === $val ? 'text-sky-600 bg-sky-50/50' : 'text-slate-700' }}">
                            <span>{{ $lbl }}</span>
                            @if($statusFilter === $val) <svg class="w-3.5 h-3.5 text-sky-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg> @endif
                        </button>
                    @endforeach
                </div>
            </div>

            <!-- Tombol Tambah -->
            <button type="button" wire:click="openCreateModal"
                    class="inline-flex items-center gap-1.5 px-4 py-2 rounded-xl bg-sky-600 hover:bg-sky-700 text-white font-bold text-xs shadow-md transition-all whitespace-nowrap">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/></svg>
                <span>Tambah Armada</span>
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
                        <th class="py-4 px-6 text-[11px] font-bold uppercase tracking-wider text-slate-500">Unit & Layanan</th>
                        <th class="py-4 px-6 text-[11px] font-bold uppercase tracking-wider text-slate-500">Plat Nomor</th>
                        <th class="py-4 px-6 text-[11px] font-bold uppercase tracking-wider text-slate-500">Perlengkapan Medis</th>
                        <th class="py-4 px-6 text-[11px] font-bold uppercase tracking-wider text-slate-500">Status Kesiapan</th>
                        <th class="py-4 px-6 text-[11px] font-bold uppercase tracking-wider text-slate-500 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($ambulans as $amb)
                        <tr class="hover:bg-slate-50/50 transition-colors">
                            <td class="py-4 px-6">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-2xl bg-sky-50 text-sky-600 flex items-center justify-center font-black text-sm shrink-0">
                                        🚑
                                    </div>
                                    <div>
                                        <span class="font-bold text-slate-900 block text-sm">{{ $amb->kode_ambulans }}</span>
                                        <span class="text-xs text-slate-500 font-medium">{{ $amb->jenis_ambulans }}</span>
                                    </div>
                                </div>
                            </td>
                            <td class="py-4 px-6">
                                <span class="px-3 py-1 rounded-xl bg-slate-100 font-mono font-bold text-xs text-slate-800 border border-slate-200 uppercase">
                                    {{ $amb->plat_nomor }}
                                </span>
                            </td>
                            <td class="py-4 px-6">
                                <p class="text-xs text-slate-600 max-w-xs truncate font-medium">
                                    {{ $amb->perlengkapan_medis ?: 'Tabung Oksigen, Stretcher, P3K Kit' }}
                                </p>
                            </td>
                            <td class="py-4 px-6">
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold
                                    @if($amb->status === 'Tersedia') bg-emerald-50 text-emerald-700 border border-emerald-200
                                    @elseif($amb->status === 'Ditugaskan') bg-sky-50 text-sky-700 border border-sky-200
                                    @elseif($amb->status === 'Perawatan') bg-amber-50 text-amber-700 border border-amber-200
                                    @else bg-slate-200 text-slate-700 border border-slate-300 @endif">
                                    <span class="w-1.5 h-1.5 rounded-full bg-current"></span>
                                    <span>{{ $amb->status }}</span>
                                </span>
                            </td>
                            <td class="py-3 px-6 text-right whitespace-nowrap">
                                <div class="flex items-center justify-end gap-1.5">
                                    <button type="button" wire:click="openEditModal({{ $amb->id }})"
                                            title="Edit Armada Ambulans"
                                            class="w-8 h-8 rounded-lg bg-white text-slate-600 hover:text-amber-600 hover:bg-amber-50 border border-slate-200 transition-all flex items-center justify-center shadow-xs">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                        </svg>
                                    </button>
                                    <button type="button" wire:click="deleteAmbulans({{ $amb->id }})"
                                            wire:confirm="Yakin ingin menghapus armada ambulans ini?"
                                            title="Hapus Armada"
                                            class="w-8 h-8 rounded-lg bg-white text-slate-600 hover:text-rose-600 hover:bg-rose-50 border border-slate-200 transition-all flex items-center justify-center shadow-xs">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                        </svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="py-12 text-center text-slate-400">
                                <div class="w-16 h-16 rounded-full bg-slate-50 flex items-center justify-center mx-auto mb-3 text-2xl">🚑</div>
                                <p class="font-bold text-slate-600">Belum ada data ambulans</p>
                                <p class="text-xs text-slate-400 mt-1">Daftarkan unit ambulans milik lembaga Anda melalui tombol Tambah Armada.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="p-4 border-t border-slate-100">
            {{ $ambulans->links() }}
        </div>
        <!-- Modal Tambah / Edit Armada -->
    @if($isModalOpen)
        <div class="fixed inset-0 z-50 bg-slate-900/60 backdrop-blur-xs flex items-center justify-center p-3 sm:p-6 overflow-hidden">
            <div class="relative bg-white rounded-2xl max-w-lg w-full shadow-2xl border border-slate-200 flex flex-col max-h-[90vh] overflow-hidden animate-in fade-in zoom-in-95 duration-200">
                <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between shrink-0 bg-white">
                    <div>
                        <h3 class="text-base font-bold text-slate-900">
                            {{ $ambulansId ? 'Ubah Data Armada' : 'Tambah Armada Baru Lembaga' }}
                        </h3>
                        <p class="text-xs text-slate-500">Pastikan data armada sesuai dengan STNK & standar dinas.</p>
                    </div>
                    <button type="button" wire:click="closeModal" class="p-1.5 rounded-lg text-slate-400 hover:text-slate-600 hover:bg-slate-100 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                </div>

                <form wire:submit.prevent="save" class="flex flex-col grow overflow-hidden">
                    <div class="px-6 py-5 overflow-y-auto space-y-4 grow">
                        <div class="grid grid-cols-2 gap-3.5">
                            <div>
                                <label class="block text-xs font-semibold text-slate-700 mb-1">Kode Armada</label>
                                <input type="text" wire:model="kode_ambulans" required placeholder="Cth: AMB-PMI-01"
                                       class="w-full px-3.5 py-2 rounded-xl border border-slate-200 text-xs font-semibold focus:border-primary-500 focus:ring-2 focus:ring-primary-100 bg-white">
                                @error('kode_ambulans') <p class="text-[11px] text-red-600 mt-1">{{ $message }}</p> @enderror
                            </div>
                            <div>
                                <label class="block text-xs font-semibold text-slate-700 mb-1">Plat Nomor</label>
                                <input type="text" wire:model="plat_nomor" required placeholder="Cth: R 1234 SC"
                                       class="w-full px-3.5 py-2 rounded-xl border border-slate-200 text-xs font-bold uppercase focus:border-primary-500 focus:ring-2 focus:ring-primary-100 bg-white">
                                @error('plat_nomor') <p class="text-[11px] text-red-600 mt-1">{{ $message }}</p> @enderror
                            </div>
                        </div>

                        <!-- Jenis Layanan -->
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1">Jenis Layanan / Armada</label>
                            <select wire:model="jenis_ambulans" class="w-full px-3.5 py-2 rounded-xl border border-slate-200 text-xs font-semibold text-slate-800 focus:border-primary-500 focus:ring-2 focus:ring-primary-100 bg-white">
                                <option value="Ambulans Gawat Darurat (AGD)">Ambulans Gawat Darurat (AGD)</option>
                                <option value="Ambulans Transport Medis">Ambulans Transport Medis</option>
                                <option value="Ambulans Jenazah gratis">Ambulans Jenazah gratis</option>
                            </select>
                            @error('jenis_ambulans') <p class="text-[11px] text-red-600 mt-1">{{ $message }}</p> @enderror
                        </div>

                        <!-- Status Operasional -->
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1">Status Operasional</label>
                            <select wire:model="status" class="w-full px-3.5 py-2 rounded-xl border border-slate-200 text-xs font-semibold text-slate-800 focus:border-primary-500 focus:ring-2 focus:ring-primary-100 bg-white">
                                <option value="Tersedia">Tersedia (Siaga Menerima Tugas)</option>
                                <option value="Ditugaskan">Sedang Ditugaskan</option>
                                <option value="Perawatan">Perawatan / Service</option>
                                <option value="Tidak Aktif">Tidak Aktif</option>
                            </select>
                            @error('status') <p class="text-[11px] text-red-600 mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1">Daftar Perlengkapan Medis</label>
                            <textarea wire:model="perlengkapan_medis" rows="2"
                                      placeholder="Tabung Oksigen, Stretcher, P3K Kit, Tensi Meter..."
                                      class="w-full px-3.5 py-2 rounded-xl border border-slate-200 text-xs font-medium focus:border-primary-500 focus:ring-2 focus:ring-primary-100 bg-white"></textarea>
                        </div>
                    </div>

                    <div class="px-6 py-3.5 border-t border-slate-100 flex items-center justify-end gap-2.5 shrink-0 bg-slate-50/80">
                        <button type="button" wire:click="closeModal"
                                class="px-4 py-2 rounded-xl border border-slate-200 bg-white hover:bg-slate-100 text-slate-600 font-semibold text-xs transition-colors shadow-xs">
                            Batal
                        </button>
                        <button type="submit"
                                class="inline-flex items-center gap-1.5 px-5 py-2 rounded-xl bg-primary-600 hover:bg-primary-700 text-white font-bold text-xs shadow-xs transition-all">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                            <span>{{ $ambulansId ? 'Simpan Perubahan' : 'Tambah Armada' }}</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endif
</div>

