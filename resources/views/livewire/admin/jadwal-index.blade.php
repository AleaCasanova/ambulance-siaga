<div>
    <!-- Header -->
    <div class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-sky-100 text-sky-700 uppercase tracking-wider mb-2">
                Manajemen Operasional
            </span>
            <h1 class="text-2xl sm:text-3xl font-extrabold text-slate-800 tracking-tight">Jadwal Piket Supir & Ambulans</h1>
            <p class="text-slate-500 text-sm mt-1">Kelola jadwal penugasan harian supir dan unit armada mitra Ambulance Siaga.</p>
        </div>

        <div class="flex flex-wrap items-center gap-3">
            <input type="text" wire:model.live.debounce.300ms="search"
                   placeholder="Cari nama supir atau plat..."
                   class="px-4 py-2.5 rounded-xl border border-slate-300 bg-white text-sm font-medium focus:border-sky-500 focus:ring-2 focus:ring-sky-200 shadow-xs">

            <select wire:model.live="hariFilter"
                    class="px-4 py-2.5 rounded-xl border border-slate-300 bg-white text-sm font-semibold focus:border-sky-500 focus:ring-2 focus:ring-sky-200 shadow-xs">
                <option value="">-- Semua Hari --</option>
                <option value="Senin">Senin</option>
                <option value="Selasa">Selasa</option>
                <option value="Rabu">Rabu</option>
                <option value="Kamis">Kamis</option>
                <option value="Jumat">Jumat</option>
                <option value="Sabtu">Sabtu</option>
                <option value="Minggu">Minggu</option>
            </select>

            <button type="button" wire:click="openCreateModal"
                    class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-sky-600 hover:bg-sky-700 text-white font-bold text-sm shadow-md shadow-sky-600/30 transition-all">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/>
                </svg>
                <span>Tambahkan Jadwal</span>
            </button>
        </div>
    </div>

    <!-- Table Jadwal -->
    <div class="bg-white rounded-3xl border border-slate-200/80 shadow-xs overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50/80 border-b border-slate-200 text-[11px] font-bold text-slate-500 uppercase tracking-wider">
                        <th class="py-4 px-6">Supir Bertugas</th>
                        <th class="py-4 px-6">Unit Ambulans</th>
                        <th class="py-4 px-6">Hari Piket</th>
                        <th class="py-4 px-6">Jam Tugas</th>
                        <th class="py-4 px-6">Status</th>
                        <th class="py-4 px-6 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-sm">
                    @forelse($jadwalList as $jdw)
                        <tr class="hover:bg-slate-50/50 transition-colors">
                            <td class="py-4 px-6">
                                <div class="flex items-center gap-3">
                                    <img src="{{ $jdw->supir?->user?->avatar_url ?? 'https://ui-avatars.com/api/?name=Supir&color=0284C7&background=E0F2FE' }}" 
                                         alt="" class="w-10 h-10 rounded-full object-cover border border-slate-200">
                                    <div>
                                        <span class="font-extrabold text-slate-800 block">{{ $jdw->supir?->user?->name ?? 'Supir Dihapus' }}</span>
                                        <span class="text-xs text-slate-500 block">SIM: {{ $jdw->supir?->nomor_sim ?? '-' }}</span>
                                    </div>
                                </div>
                            </td>
                            <td class="py-4 px-6">
                                <span class="font-bold text-slate-800 block">{{ $jdw->ambulans?->kode_ambulans ?? '-' }}</span>
                                <span class="text-xs font-semibold text-sky-600 block">{{ $jdw->ambulans?->plat_nomor ?? '-' }}</span>
                            </td>
                            <td class="py-4 px-6">
                                <span class="inline-block px-3 py-1 rounded-full text-xs font-extrabold bg-sky-50 text-sky-700 border border-sky-100">
                                    {{ $jdw->hari }}
                                </span>
                            </td>
                            <td class="py-4 px-6 font-semibold text-slate-700">
                                {{ $jdw->jam_mulai }} - {{ $jdw->jam_selesai }} WIB
                            </td>
                            <td class="py-4 px-6">
                                <span class="inline-flex items-center gap-1.5 text-xs font-bold
                                    @if($jdw->status === 'Aktif') text-emerald-700 bg-emerald-50 px-2.5 py-1 rounded-full border border-emerald-200
                                    @elseif($jdw->status === 'Cadangan') text-amber-700 bg-amber-50 px-2.5 py-1 rounded-full border border-amber-200
                                    @else text-slate-600 bg-slate-100 px-2.5 py-1 rounded-full border border-slate-200 @endif">
                                    <span class="w-1.5 h-1.5 rounded-full @if($jdw->status === 'Aktif') bg-emerald-500 @elseif($jdw->status === 'Cadangan') bg-amber-500 @else bg-slate-400 @endif"></span>
                                    <span>{{ $jdw->status }}</span>
                                </span>
                            </td>
                            <td class="py-4 px-6 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <button type="button" wire:click="openEditModal({{ $jdw->id }})"
                                            class="px-3 py-1.5 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold text-xs transition-colors">
                                        Edit
                                    </button>
                                    <button type="button" wire:click="deleteJadwal({{ $jdw->id }})"
                                            wire:confirm="Yakin ingin menghapus jadwal piket supir ini?"
                                            class="px-3 py-1.5 rounded-xl bg-red-50 hover:bg-red-100 text-red-600 font-bold text-xs transition-colors">
                                        Hapus
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="py-12 text-center text-slate-400">
                                <p class="text-sm font-semibold">Belum ada jadwal piket supir ambulans</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="px-6 py-4 border-t border-slate-100">
            {{ $jadwalList->links() }}
        </div>
    </div>

    <!-- Modal Form Create / Edit -->
    @if($showModal)
        <div class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/70 backdrop-blur-xs">
            <div class="bg-white rounded-3xl max-w-lg w-full p-6 sm:p-8 shadow-2xl border border-slate-200">
                <div class="flex items-center justify-between mb-6 pb-4 border-b border-slate-100">
                    <h3 class="text-lg font-extrabold text-slate-800">
                        {{ $isEdit ? 'Edit Jadwal Piket Supir' : 'Tambahkan Jadwal Baru' }}
                    </h3>
                    <button wire:click="$set('showModal', false)" class="text-slate-400 hover:text-slate-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>

                <form wire:submit="saveJadwal" class="space-y-4">
                    <!-- Supir -->
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Pilih Supir Ambulans</label>
                        <select wire:model="supir_id" required
                                class="w-full px-4 py-2.5 rounded-xl border border-slate-300 text-sm font-semibold focus:border-sky-500 focus:ring-2 focus:ring-sky-200">
                            <option value="">-- Pilih Supir --</option>
                            @foreach($supirList as $spr)
                                <option value="{{ $spr->id }}">{{ $spr->user?->name ?? 'Supir ID ' . $spr->id }} (SIM: {{ $spr->nomor_sim ?? '-' }})</option>
                            @endforeach
                        </select>
                        @error('supir_id') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <!-- Ambulans -->
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Pilih Unit Ambulans</label>
                        <select wire:model="ambulans_id" required
                                class="w-full px-4 py-2.5 rounded-xl border border-slate-300 text-sm font-semibold focus:border-sky-500 focus:ring-2 focus:ring-sky-200">
                            <option value="">-- Pilih Ambulans --</option>
                            @foreach($ambulansList as $amb)
                                <option value="{{ $amb->id }}">{{ $amb->kode_ambulans }} - {{ $amb->plat_nomor }} ({{ $amb->jenis_ambulans }})</option>
                            @endforeach
                        </select>
                        @error('ambulans_id') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <!-- Hari Piket -->
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Hari Bertugas / Piket</label>
                        <select wire:model="hari" required
                                class="w-full px-4 py-2.5 rounded-xl border border-slate-300 text-sm font-semibold focus:border-sky-500 focus:ring-2 focus:ring-sky-200">
                            <option value="Senin">Senin</option>
                            <option value="Selasa">Selasa</option>
                            <option value="Rabu">Rabu</option>
                            <option value="Kamis">Kamis</option>
                            <option value="Jumat">Jumat</option>
                            <option value="Sabtu">Sabtu</option>
                            <option value="Minggu">Minggu</option>
                        </select>
                        @error('hari') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <!-- Jam Kerja -->
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1">Jam Mulai (WIB)</label>
                            <input type="time" wire:model="jam_mulai" required
                                   class="w-full px-4 py-2.5 rounded-xl border border-slate-300 text-sm font-medium focus:border-sky-500 focus:ring-2 focus:ring-sky-200">
                            @error('jam_mulai') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1">Jam Selesai (WIB)</label>
                            <input type="time" wire:model="jam_selesai" required
                                   class="w-full px-4 py-2.5 rounded-xl border border-slate-300 text-sm font-medium focus:border-sky-500 focus:ring-2 focus:ring-sky-200">
                            @error('jam_selesai') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <!-- Status -->
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Status Penugasan</label>
                        <select wire:model="status" required
                                class="w-full px-4 py-2.5 rounded-xl border border-slate-300 text-sm font-semibold focus:border-sky-500 focus:ring-2 focus:ring-sky-200">
                            <option value="Aktif">Aktif (Wajib Hadir)</option>
                            <option value="Cadangan">Cadangan (Standby)</option>
                            <option value="Libur">Libur / Istirahat</option>
                        </select>
                        @error('status') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="flex gap-3 pt-4 border-t border-slate-100">
                        <button type="submit"
                                class="flex-1 py-3.5 rounded-xl bg-sky-600 hover:bg-sky-700 text-white font-extrabold text-sm shadow-lg shadow-sky-600/30 transition-all">
                            SIMPAN JADWAL
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
