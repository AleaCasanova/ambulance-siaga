<div>
    <!-- Header -->
    <div class="mb-8 flex flex-col lg:flex-row lg:items-end lg:justify-between gap-6">
        <div class="flex-1">
            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-extrabold bg-white/20 text-white uppercase tracking-wider mb-2.5 shadow-sm border border-white/20 backdrop-blur-md">
                Manajemen Armada Medis
            </span>
            <h1 class="text-2xl sm:text-[32px] font-extrabold text-white tracking-tight drop-shadow-md leading-tight">
                Kelola Armada Ambulans
            </h1>
            <p class="text-white/90 text-[15px] sm:text-base mt-2 font-medium leading-relaxed drop-shadow-sm max-w-2xl">
                Daftar armada ambulans mitra Ambulance Siaga, plat nomor, jenis unit, dan perlengkapan medis.
            </p>
        </div>

        <div class="flex flex-wrap items-center gap-3">
            <input type="text" wire:model.live.debounce.300ms="search"
                   placeholder="Cari kode atau plat..."
                   class="px-4 py-2.5 rounded-xl border border-slate-300 bg-white text-sm font-medium focus:border-sky-500 focus:ring-2 focus:ring-sky-200 shadow-xs">

            <select wire:model.live="statusFilter"
                    class="px-4 py-2.5 rounded-xl border border-slate-300 bg-white text-sm font-semibold focus:border-sky-500 focus:ring-2 focus:ring-sky-200 shadow-xs">
                <option value="">-- Semua Status --</option>
                <option value="Tersedia">Tersedia (Siaga)</option>
                <option value="Ditugaskan">Sedang Ditugaskan</option>
                <option value="Perawatan">Perawatan / Service</option>
                <option value="Tidak Aktif">Tidak Aktif</option>
            </select>

            <button type="button" wire:click="openCreateModal"
                    class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-sky-600 hover:bg-sky-700 text-white font-bold text-sm shadow-md transition-all">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/>
                </svg>
                <span>Tambah Armada Baru</span>
            </button>
        </div>
    </div>

    <!-- Table Ambulans -->
    <div class="bg-white rounded-3xl border border-slate-200/80 shadow-xs overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50/80 border-b border-slate-200 text-[11px] font-bold text-slate-500 uppercase tracking-wider">
                        <th class="py-4 px-6">Kode Armada</th>
                        <th class="py-4 px-6">Plat Nomor</th>
                        <th class="py-4 px-6">Jenis Ambulans</th>
                        <th class="py-4 px-6">Status Operasional</th>
                        <th class="py-4 px-6">Perlengkapan Medis</th>
                        <th class="py-4 px-6 text-right">Aksi</th>
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
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold
                                    @if($amb->status === 'Tersedia') bg-emerald-100 text-emerald-700
                                    @elseif($amb->status === 'Ditugaskan') bg-primary-100 text-primary-700
                                    @else bg-amber-100 text-amber-700 @endif">
                                    <span class="w-2 h-2 rounded-full @if($amb->status === 'Tersedia') bg-emerald-500 @elseif($amb->status === 'Ditugaskan') bg-primary-600 animate-ping @else bg-amber-500 @endif"></span>
                                    <span>{{ $amb->status }}</span>
                                </span>
                            </td>
                            <td class="py-4 px-6 max-w-xs">
                                <p class="text-xs text-slate-600 line-clamp-2">{{ $amb->perlengkapan_medis ?: '-' }}</p>
                            </td>
                            <td class="py-4 px-6 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <button type="button" wire:click="openEditModal({{ $amb->id }})"
                                            class="px-3 py-1.5 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold text-xs transition-colors">
                                        Edit
                                    </button>
                                    <button type="button" wire:click="deleteAmbulans({{ $amb->id }})"
                                            wire:confirm="Yakin ingin menghapus armada ambulans ini?"
                                            class="px-3 py-1.5 rounded-xl bg-red-50 hover:bg-red-100 text-red-600 font-bold text-xs transition-colors">
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
                        <select wire:model="jenis_ambulans" required
                                class="w-full px-4 py-2.5 rounded-xl border border-slate-300 text-sm font-semibold focus:border-sky-500 focus:ring-2 focus:ring-sky-200">
                            <option value="Ambulans Gawat Darurat (AGD)">Ambulans Gawat Darurat (AGD)</option>
                            <option value="Ambulans Transport Medis">Ambulans Transport Medis</option>
                            <option value="Ambulans Jenazah gratis">Ambulans Jenazah Gratis</option>
                        </select>
                        @error('jenis_ambulans') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Status Operasional</label>
                        <select wire:model="status" required
                                class="w-full px-4 py-2.5 rounded-xl border border-slate-300 text-sm font-semibold focus:border-sky-500 focus:ring-2 focus:ring-sky-200">
                            <option value="Tersedia">Tersedia (Siaga Menerima Tugas)</option>
                            <option value="Ditugaskan">Sedang Ditugaskan</option>
                            <option value="Perawatan">Perawatan / Service</option>
                            <option value="Tidak Aktif">Tidak Aktif</option>
                        </select>
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
