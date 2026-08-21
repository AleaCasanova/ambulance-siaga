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
                            <td class="py-4 px-6 text-right whitespace-nowrap">
                                <div class="flex items-center justify-end gap-2">
                                    <button type="button" wire:click="openEditModal({{ $amb->id }})"
                                            class="px-3 py-1.5 rounded-lg border border-slate-200 bg-white hover:bg-slate-50 text-slate-600 font-semibold text-[11px] transition-colors shadow-sm">
                                        Edit
                                    </button>
                                    <button type="button" wire:click="deleteAmbulans({{ $amb->id }})"
                                            wire:confirm="Yakin ingin menghapus armada ambulans ini?"
                                            class="px-3 py-1.5 rounded-lg border border-red-200 bg-red-50 hover:bg-red-100 text-red-600 font-semibold text-[11px] transition-colors shadow-sm">
                                        Hapus
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
        <div class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/70 backdrop-blur-xs">
            <div class="bg-white rounded-3xl max-w-lg w-full p-6 sm:p-8 shadow-2xl border border-slate-200">
                <div class="flex items-center justify-between mb-6 pb-4 border-b border-slate-100">
                    <h3 class="text-lg font-extrabold text-slate-800">
                        {{ $isEdit ? 'Edit Armada Ambulans' : 'Tambah Armada Ambulans Baru' }}
                    </h3>
                    <button wire:click="$set('showModal', false)" class="text-slate-400 hover:text-slate-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>

                <form wire:submit="saveAmbulans" class="space-y-4">
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1">Kode Armada (Cth: AMB-01)</label>
                            <input type="text" wire:model="kode_ambulans" required
                                   class="w-full px-4 py-2.5 rounded-xl border border-slate-300 text-sm font-bold uppercase focus:border-sky-500 focus:ring-2 focus:ring-sky-200">
                            @error('kode_ambulans') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1">Plat Nomor (Cth: R 9988 SC)</label>
                            <input type="text" wire:model="plat_nomor" required
                                   class="w-full px-4 py-2.5 rounded-xl border border-slate-300 text-sm font-bold uppercase focus:border-sky-500 focus:ring-2 focus:ring-sky-200">
                            @error('plat_nomor') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Jenis Armada / Layanan</label>
                        <div class="relative" x-data="{ open: false }">
                            <button type="button" @click="open = !open" @click.outside="open = false"
                                    class="w-full flex items-center justify-between px-4 py-2.5 rounded-xl border border-slate-300 bg-white text-sm font-semibold text-slate-700 focus:outline-none focus:ring-2 focus:ring-sky-200">
                                <span>{{ $jenis_ambulans ?: 'Ambulans Gawat Darurat (AGD)' }}</span>
                                <svg class="w-4 h-4 text-slate-400 transition-transform duration-200" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                            </button>

                            <div x-show="open" x-transition.opacity.duration.150ms
                                 class="absolute left-0 top-full mt-1.5 w-full bg-white rounded-xl shadow-xl border border-slate-200 py-1.5 z-50 overflow-hidden"
                                 style="display: none;">
                                @foreach([
                                    'Ambulans Gawat Darurat (AGD)',
                                    'Ambulans Transport Medis',
                                    'Ambulans Jenazah gratis'
                                ] as $jns)
                                    <button type="button" @click="$wire.set('jenis_ambulans', '{{ $jns }}'); open = false"
                                            class="w-full text-left px-4 py-2.5 text-xs font-semibold flex items-center justify-between hover:bg-sky-50 hover:text-sky-600 transition-colors {{ $jenis_ambulans === $jns ? 'text-sky-600 bg-sky-50/50' : 'text-slate-700' }}">
                                        <span>{{ $jns }}</span>
                                        @if($jenis_ambulans === $jns) <svg class="w-3.5 h-3.5 text-sky-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg> @endif
                                    </button>
                                @endforeach
                            </div>
                        </div>
                        @error('jenis_ambulans') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Status Operasional</label>
                        <div class="relative" x-data="{ open: false }">
                            <button type="button" @click="open = !open" @click.outside="open = false"
                                    class="w-full flex items-center justify-between px-4 py-2.5 rounded-xl border border-slate-300 bg-white text-sm font-semibold text-slate-700 focus:outline-none focus:ring-2 focus:ring-sky-200">
                                <span>{{ $status ? $status : 'Tersedia' }}</span>
                                <svg class="w-4 h-4 text-slate-400 transition-transform duration-200" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                            </button>

                            <div x-show="open" x-transition.opacity.duration.150ms
                                 class="absolute left-0 top-full mt-1.5 w-full bg-white rounded-xl shadow-xl border border-slate-200 py-1.5 z-50 overflow-hidden"
                                 style="display: none;">
                                @foreach([
                                    'Tersedia' => 'Tersedia (Siaga Menerima Tugas)',
                                    'Ditugaskan' => 'Sedang Ditugaskan',
                                    'Perawatan' => 'Perawatan / Service',
                                    'Tidak Aktif' => 'Tidak Aktif'
                                ] as $val => $lbl)
                                    <button type="button" @click="$wire.set('status', '{{ $val }}'); open = false"
                                            class="w-full text-left px-4 py-2.5 text-xs font-semibold flex items-center justify-between hover:bg-sky-50 hover:text-sky-600 transition-colors {{ $status === $val ? 'text-sky-600 bg-sky-50/50' : 'text-slate-700' }}">
                                        <span>{{ $lbl }}</span>
                                        @if($status === $val) <svg class="w-3.5 h-3.5 text-sky-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg> @endif
                                    </button>
                                @endforeach
                            </div>
                        </div>
                        @error('status') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Daftar Perlengkapan Medis</label>
                        <textarea wire:model="perlengkapan_medis" rows="3"
                                  placeholder="Contoh: Tabung Oksigen, Stretcher, P3K Kit, Tensi Meter..."
                                  class="w-full px-4 py-2.5 rounded-xl border border-slate-300 text-sm font-medium focus:border-sky-500 focus:ring-2 focus:ring-sky-200"></textarea>
                        @error('perlengkapan_medis') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
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
