<div>
    <!-- Header -->
    <div class="mb-8 flex flex-col lg:flex-row lg:items-end lg:justify-between gap-6">
        <div class="flex-1">
            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[11px] font-bold bg-slate-100 text-slate-500 uppercase tracking-wider mb-2.5">
                Manajemen Armada Medis
            </span>
            <h1 class="text-2xl sm:text-[28px] font-bold text-slate-900 tracking-tight leading-tight">
                Kelola Armada Ambulans
            </h1>
            <p class="text-slate-500 text-[14px] mt-1.5 font-medium max-w-2xl">
                Daftar armada ambulans mitra Ambulans Siaga, plat nomor, jenis unit, dan perlengkapan medis.
            </p>
        </div>

        <div class="flex items-center gap-2.5 shrink-0">
            <input type="text" wire:model.live.debounce.300ms="search"
                   placeholder="Cari kode atau plat..."
                   class="w-40 sm:w-52 px-3.5 py-2 rounded-xl border border-slate-300 bg-white text-xs font-medium focus:border-sky-500 focus:ring-2 focus:ring-sky-200 shadow-xs">

            <div class="relative" x-data="{ open: false }">
                <button type="button" @click="open = !open" @click.outside="open = false"
                        class="flex items-center justify-between gap-2 px-3.5 py-2 rounded-xl border border-slate-300 bg-white text-xs font-semibold text-slate-700 shadow-xs hover:border-slate-400 focus:outline-none focus:ring-2 focus:ring-sky-100 transition-all whitespace-nowrap">
                    <span>{{ $statusFilter ? $statusFilter : 'Semua Status' }}</span>
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

            <button type="button" wire:click="openCreateModal"
                    class="inline-flex items-center gap-1.5 px-4 py-2 rounded-xl bg-sky-600 hover:bg-sky-700 text-white font-bold text-xs shadow-md transition-all whitespace-nowrap">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/>
                </svg>
                <span>Tambah Armada</span>
            </button>
        </div>
    </div>

    <!-- Table Ambulans -->
    <div class="bg-white rounded-3xl border border-slate-200/80 shadow-xs overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-200 text-[11px] font-bold text-slate-500 uppercase tracking-wider">
                        <th class="py-3 px-6 whitespace-nowrap">Kode Armada</th>
                        <th class="py-3 px-6 whitespace-nowrap">Plat Nomor</th>
                        <th class="py-3 px-6 whitespace-nowrap">Jenis Ambulans</th>
                        <th class="py-3 px-6 whitespace-nowrap">Status Operasional</th>
                        <th class="py-3 px-6 whitespace-nowrap">Perlengkapan Medis</th>
                        <th class="py-3 px-6 whitespace-nowrap text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-sm">
                    @forelse($ambulansList as $amb)
                        <tr class="hover:bg-slate-50/50 transition-colors">
                            <td class="py-4 px-6 font-extrabold text-slate-800">
                                <span class="inline-block px-2.5 py-1 rounded-lg bg-sky-50 text-sky-700 font-black border border-sky-200">
                                    {{ $amb->kode_ambulans }}
                                </span>
                            </td>
                            <td class="py-4 px-6 font-bold text-slate-800">{{ $amb->plat_nomor }}</td>
                            <td class="py-4 px-6 text-slate-700">{{ $amb->jenis_ambulans }}</td>
                            <td class="py-4 px-6">
                                <div class="flex items-center gap-1.5 font-bold text-sm
                                    @if($amb->status === 'Tersedia') text-emerald-600
                                    @elseif($amb->status === 'Ditugaskan') text-sky-600
                                    @else text-amber-600 @endif">
                                    <span class="w-1.5 h-1.5 rounded-full @if($amb->status === 'Tersedia') bg-emerald-500 @elseif($amb->status === 'Ditugaskan') bg-sky-500 animate-ping @else bg-amber-500 @endif"></span>
                                    <span>{{ $amb->status }}</span>
                                </div>
                            </td>
                            <td class="py-4 px-6 max-w-xs">
                                <p class="text-xs text-slate-600 line-clamp-2">{{ $amb->perlengkapan_medis ?: '-' }}</p>
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
                            <td colspan="6" class="py-12 text-center text-slate-400">
                                <p class="text-sm font-semibold">Tidak ada armada ambulans yang sesuai</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="px-6 py-4 border-t border-slate-100">
            {{ $ambulansList->links() }}
        </div>
    </div>

    <!-- Modal Form Create / Edit -->
    @if($showModal)
        <div class="fixed inset-0 z-50 bg-slate-900/60 backdrop-blur-xs flex items-center justify-center p-3 sm:p-6 overflow-hidden">
            <div class="relative bg-white rounded-2xl max-w-lg w-full shadow-2xl border border-slate-200 flex flex-col max-h-[90vh] overflow-hidden animate-in fade-in zoom-in-95 duration-200">
                <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between shrink-0 bg-white">
                    <h3 class="text-base font-bold text-slate-900">
                        {{ $isEdit ? 'Edit Armada Ambulans' : 'Tambah Armada Ambulans Baru' }}
                    </h3>
                    <button wire:click="$set('showModal', false)" class="p-1.5 rounded-lg text-slate-400 hover:text-slate-600 hover:bg-slate-100 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>

                <form wire:submit="saveAmbulans" class="flex flex-col grow overflow-hidden">
                    <div class="px-6 py-5 overflow-y-auto space-y-4 grow">
                        <div class="grid grid-cols-2 gap-3.5">
                            <div>
                                <label class="block text-xs font-semibold text-slate-700 mb-1">Kode Armada</label>
                                <input type="text" wire:model="kode_ambulans" required placeholder="Cth: AMB-01"
                                       class="w-full px-3.5 py-2 rounded-xl border border-slate-200 text-xs font-bold uppercase focus:border-primary-500 focus:ring-2 focus:ring-primary-100 bg-white">
                                @error('kode_ambulans') <p class="text-[11px] text-red-600 mt-1">{{ $message }}</p> @enderror
                            </div>
                            <div>
                                <label class="block text-xs font-semibold text-slate-700 mb-1">Plat Nomor</label>
                                <input type="text" wire:model="plat_nomor" required placeholder="Cth: R 9988 SC"
                                       class="w-full px-3.5 py-2 rounded-xl border border-slate-200 text-xs font-bold uppercase focus:border-primary-500 focus:ring-2 focus:ring-primary-100 bg-white">
                                @error('plat_nomor') <p class="text-[11px] text-red-600 mt-1">{{ $message }}</p> @enderror
                            </div>
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1">Jenis Armada / Layanan</label>
                            <select wire:model="jenis_ambulans" class="w-full px-3.5 py-2 rounded-xl border border-slate-200 text-xs font-semibold text-slate-800 focus:border-primary-500 focus:ring-2 focus:ring-primary-100 bg-white">
                                <option value="Ambulans Gawat Darurat (AGD)">Ambulans Gawat Darurat (AGD)</option>
                                <option value="Ambulans Transport Medis">Ambulans Transport Medis</option>
                                <option value="Ambulans Jenazah gratis">Ambulans Jenazah gratis</option>
                            </select>
                            @error('jenis_ambulans') <p class="text-[11px] text-red-600 mt-1">{{ $message }}</p> @enderror
                        </div>

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
                            <textarea wire:model="perlengkapan_medis" rows="3"
                                      placeholder="Contoh: Tabung Oksigen, Stretcher, P3K Kit, Tensi Meter..."
                                      class="w-full px-3.5 py-2 rounded-xl border border-slate-200 text-xs font-medium focus:border-primary-500 focus:ring-2 focus:ring-primary-100 bg-white"></textarea>
                            @error('perlengkapan_medis') <p class="text-[11px] text-red-600 mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <div class="px-6 py-3.5 border-t border-slate-100 flex items-center justify-end gap-2.5 shrink-0 bg-slate-50/80">
                        <button type="button" wire:click="$set('showModal', false)"
                                class="px-4 py-2 rounded-xl border border-slate-200 bg-white hover:bg-slate-100 text-slate-600 font-semibold text-xs transition-colors shadow-xs">
                            Batal
                        </button>
                        <button type="submit"
                                class="inline-flex items-center gap-1.5 px-5 py-2 rounded-xl bg-primary-600 hover:bg-primary-700 text-white font-bold text-xs shadow-xs transition-all">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                            <span>{{ $isEdit ? 'Simpan Perubahan' : 'Tambah Armada' }}</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endif
</div>
