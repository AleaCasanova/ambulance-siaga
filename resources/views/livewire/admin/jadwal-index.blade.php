<div>
    <!-- Header -->
    <div class="mb-8 flex flex-col lg:flex-row lg:items-end lg:justify-between gap-6">
        <div class="flex-1">
            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[11px] font-bold bg-slate-100 text-slate-500 uppercase tracking-wider mb-2.5">
                Manajemen Operasional
            </span>
            <h1 class="text-2xl sm:text-[28px] font-bold text-slate-900 tracking-tight leading-tight">
                Jadwal Piket Supir & Ambulans
            </h1>
            <p class="text-slate-500 text-[14px] mt-1.5 font-medium max-w-2xl">
                Kelola jadwal penugasan harian supir dan unit armada mitra Ambulans Siaga.
            </p>
        </div>

        <div class="flex items-center gap-2.5 shrink-0">
            <input type="text" wire:model.live.debounce.300ms="search"
                   placeholder="Cari supir, plat..."
                   class="w-40 sm:w-52 px-3.5 py-2 rounded-xl border border-slate-300 bg-white text-xs font-medium focus:border-sky-500 focus:ring-2 focus:ring-sky-200 shadow-xs">

            <div class="relative" x-data="{ open: false }">
                <button type="button" @click="open = !open" @click.outside="open = false"
                        class="flex items-center justify-between gap-2 px-3.5 py-2 rounded-xl border border-slate-300 bg-white text-xs font-semibold text-slate-700 shadow-xs hover:border-slate-400 focus:outline-none focus:ring-2 focus:ring-sky-100 transition-all whitespace-nowrap">
                    <span>{{ $hariFilter ? 'Hari: ' . $hariFilter : 'Semua Hari' }}</span>
                    <svg class="w-3.5 h-3.5 text-slate-400 transition-transform duration-200" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                </button>

                <div x-show="open" x-transition.opacity.duration.150ms
                     class="absolute right-0 top-full mt-1.5 w-44 bg-white rounded-xl shadow-xl border border-slate-200 py-1.5 z-50 overflow-hidden"
                     style="display: none;">
                    <button type="button" @click="$wire.set('hariFilter', ''); open = false"
                            class="w-full text-left px-3.5 py-2 text-xs font-semibold flex items-center justify-between hover:bg-sky-50 hover:text-sky-600 transition-colors {{ $hariFilter === '' ? 'text-sky-600 bg-sky-50/50' : 'text-slate-700' }}">
                        <span>Semua Hari</span>
                        @if($hariFilter === '') <svg class="w-3.5 h-3.5 text-sky-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg> @endif
                    </button>
                    @foreach(['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'] as $h)
                        <button type="button" @click="$wire.set('hariFilter', '{{ $h }}'); open = false"
                                class="w-full text-left px-3.5 py-2 text-xs font-semibold flex items-center justify-between hover:bg-sky-50 hover:text-sky-600 transition-colors {{ $hariFilter === $h ? 'text-sky-600 bg-sky-50/50' : 'text-slate-700' }}">
                            <span>{{ $h }}</span>
                            @if($hariFilter === $h) <svg class="w-3.5 h-3.5 text-sky-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg> @endif
                        </button>
                    @endforeach
                </div>
            </div>

            <button type="button" wire:click="openCreateModal"
                    class="inline-flex items-center gap-1.5 px-4 py-2 rounded-xl bg-sky-600 hover:bg-sky-700 text-white font-bold text-xs shadow-md shadow-sky-600/30 transition-all whitespace-nowrap">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/>
                </svg>
                <span>Tambah Jadwal</span>
            </button>
        </div>
    </div>

    <!-- Table Jadwal -->
    <div class="bg-white rounded-3xl border border-slate-200/80 shadow-xs overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-200 text-[11px] font-bold text-slate-500 uppercase tracking-wider">
                        <th class="py-3 px-6 whitespace-nowrap">Supir Bertugas</th>
                        <th class="py-3 px-6 whitespace-nowrap">Unit Ambulans</th>
                        <th class="py-3 px-6 whitespace-nowrap">Hari Piket</th>
                        <th class="py-3 px-6 whitespace-nowrap">Jam Tugas</th>
                        <th class="py-3 px-6 whitespace-nowrap">Status</th>
                        <th class="py-3 px-6 whitespace-nowrap text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-sm">
                    @forelse($jadwalList as $jdw)
                        <tr class="hover:bg-slate-50/50 transition-colors">
                            <td class="py-4 px-6">
                                <span class="font-extrabold text-slate-800 block">{{ $jdw->supir?->user?->name ?? 'Supir Dihapus' }}</span>
                                <span class="text-xs text-slate-500 block">SIM: {{ $jdw->supir?->nomor_sim ?? '-' }}</span>
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
                                <div class="flex items-center gap-1.5 font-bold text-sm
                                    @if($jdw->status === 'Aktif') text-emerald-600
                                    @elseif($jdw->status === 'Cadangan') text-amber-600
                                    @else text-slate-600 @endif">
                                    <span class="w-1.5 h-1.5 rounded-full @if($jdw->status === 'Aktif') bg-emerald-500 @elseif($jdw->status === 'Cadangan') bg-amber-500 @else bg-slate-400 @endif"></span>
                                    <span>{{ $jdw->status }}</span>
                                </div>
                            </td>
                            <td class="py-4 px-6 text-right whitespace-nowrap">
                                <div class="flex items-center justify-end gap-2">
                                    <button type="button" wire:click="openEditModal({{ $jdw->id }})"
                                            class="px-3 py-1.5 rounded-lg border border-slate-200 bg-white hover:bg-slate-50 text-slate-600 font-semibold text-[11px] transition-colors shadow-sm">
                                        Edit
                                    </button>
                                    <button type="button" wire:click="deleteJadwal({{ $jdw->id }})"
                                            wire:confirm="Yakin ingin menghapus jadwal piket supir ini?"
                                            class="px-3 py-1.5 rounded-lg border border-red-200 bg-red-50 hover:bg-red-100 text-red-600 font-semibold text-[11px] transition-colors shadow-sm">
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
                        <div class="relative" x-data="{ open: false }">
                            <button type="button" @click="open = !open" @click.outside="open = false"
                                    class="w-full flex items-center justify-between px-4 py-2.5 rounded-xl border border-slate-300 bg-white text-sm font-semibold text-slate-700 focus:outline-none focus:ring-2 focus:ring-sky-200">
                                <span>
                                    @php $selSpr = $supirList->firstWhere('id', $supir_id); @endphp
                                    {{ $selSpr ? ($selSpr->user?->name ?? 'Supir ID ' . $selSpr->id) . ' (SIM: ' . ($selSpr->nomor_sim ?? '-') . ')' : '-- Pilih Supir --' }}
                                </span>
                                <svg class="w-4 h-4 text-slate-400 transition-transform duration-200" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                            </button>

                            <div x-show="open" x-transition.opacity.duration.150ms
                                 class="absolute left-0 top-full mt-1.5 w-full max-h-56 overflow-y-auto bg-white rounded-xl shadow-xl border border-slate-200 py-1.5 z-50"
                                 style="display: none;">
                                @foreach($supirList as $spr)
                                    <button type="button" @click="$wire.set('supir_id', {{ $spr->id }}); open = false"
                                            class="w-full text-left px-4 py-2.5 text-xs font-semibold flex items-center justify-between hover:bg-sky-50 hover:text-sky-600 transition-colors {{ (int)$supir_id === (int)$spr->id ? 'text-sky-600 bg-sky-50/50' : 'text-slate-700' }}">
                                        <span>{{ $spr->user?->name ?? 'Supir ID ' . $spr->id }} (SIM: {{ $spr->nomor_sim ?? '-' }})</span>
                                        @if((int)$supir_id === (int)$spr->id) <svg class="w-3.5 h-3.5 text-sky-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg> @endif
                                    </button>
                                @endforeach
                            </div>
                        </div>
                        @error('supir_id') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <!-- Ambulans -->
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Pilih Unit Ambulans</label>
                        <div class="relative" x-data="{ open: false }">
                            <button type="button" @click="open = !open" @click.outside="open = false"
                                    class="w-full flex items-center justify-between px-4 py-2.5 rounded-xl border border-slate-300 bg-white text-sm font-semibold text-slate-700 focus:outline-none focus:ring-2 focus:ring-sky-200">
                                <span>
                                    @php $selAmb = $ambulansList->firstWhere('id', $ambulans_id); @endphp
                                    {{ $selAmb ? $selAmb->kode_ambulans . ' - ' . $selAmb->plat_nomor : '-- Pilih Ambulans --' }}
                                </span>
                                <svg class="w-4 h-4 text-slate-400 transition-transform duration-200" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                            </button>

                            <div x-show="open" x-transition.opacity.duration.150ms
                                 class="absolute left-0 top-full mt-1.5 w-full max-h-56 overflow-y-auto bg-white rounded-xl shadow-xl border border-slate-200 py-1.5 z-50"
                                 style="display: none;">
                                @foreach($ambulansList as $amb)
                                    <button type="button" @click="$wire.set('ambulans_id', {{ $amb->id }}); open = false"
                                            class="w-full text-left px-4 py-2.5 text-xs font-semibold flex items-center justify-between hover:bg-sky-50 hover:text-sky-600 transition-colors {{ (int)$ambulans_id === (int)$amb->id ? 'text-sky-600 bg-sky-50/50' : 'text-slate-700' }}">
                                        <span>{{ $amb->kode_ambulans }} - {{ $amb->plat_nomor }} ({{ $amb->jenis_ambulans }})</span>
                                        @if((int)$ambulans_id === (int)$amb->id) <svg class="w-3.5 h-3.5 text-sky-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg> @endif
                                    </button>
                                @endforeach
                            </div>
                        </div>
                        @error('ambulans_id') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <!-- Hari Piket -->
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Hari Bertugas / Piket</label>
                        <div class="relative" x-data="{ open: false }">
                            <button type="button" @click="open = !open" @click.outside="open = false"
                                    class="w-full flex items-center justify-between px-4 py-2.5 rounded-xl border border-slate-300 bg-white text-sm font-semibold text-slate-700 focus:outline-none focus:ring-2 focus:ring-sky-200">
                                <span>{{ $hari ?: 'Senin' }}</span>
                                <svg class="w-4 h-4 text-slate-400 transition-transform duration-200" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                            </button>

                            <div x-show="open" x-transition.opacity.duration.150ms
                                 class="absolute left-0 top-full mt-1.5 w-full bg-white rounded-xl shadow-xl border border-slate-200 py-1.5 z-50 overflow-hidden"
                                 style="display: none;">
                                @foreach(['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'] as $h)
                                    <button type="button" @click="$wire.set('hari', '{{ $h }}'); open = false"
                                            class="w-full text-left px-4 py-2 text-xs font-semibold flex items-center justify-between hover:bg-sky-50 hover:text-sky-600 transition-colors {{ $hari === $h ? 'text-sky-600 bg-sky-50/50' : 'text-slate-700' }}">
                                        <span>{{ $h }}</span>
                                        @if($hari === $h) <svg class="w-3.5 h-3.5 text-sky-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg> @endif
                                    </button>
                                @endforeach
                            </div>
                        </div>
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
                        <div class="relative" x-data="{ open: false }">
                            <button type="button" @click="open = !open" @click.outside="open = false"
                                    class="w-full flex items-center justify-between px-4 py-2.5 rounded-xl border border-slate-300 bg-white text-sm font-semibold text-slate-700 focus:outline-none focus:ring-2 focus:ring-sky-200">
                                <span>{{ $status ? $status : 'Aktif' }}</span>
                                <svg class="w-4 h-4 text-slate-400 transition-transform duration-200" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                            </button>

                            <div x-show="open" x-transition.opacity.duration.150ms
                                 class="absolute left-0 top-full mt-1.5 w-full bg-white rounded-xl shadow-xl border border-slate-200 py-1.5 z-50 overflow-hidden"
                                 style="display: none;">
                                @foreach(['Aktif' => 'Aktif (Wajib Hadir)', 'Cadangan' => 'Cadangan (Standby)', 'Libur' => 'Libur / Istirahat'] as $val => $lbl)
                                    <button type="button" @click="$wire.set('status', '{{ $val }}'); open = false"
                                            class="w-full text-left px-4 py-2 text-xs font-semibold flex items-center justify-between hover:bg-sky-50 hover:text-sky-600 transition-colors {{ $status === $val ? 'text-sky-600 bg-sky-50/50' : 'text-slate-700' }}">
                                        <span>{{ $lbl }}</span>
                                        @if($status === $val) <svg class="w-3.5 h-3.5 text-sky-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg> @endif
                                    </button>
                                @endforeach
                            </div>
                        </div>
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
