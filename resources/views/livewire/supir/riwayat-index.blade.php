<div class="-mt-4 sm:-mt-6">
    <!-- Header Page -->
    <div class="mb-8 flex flex-col lg:flex-row lg:items-end lg:justify-between gap-6 print:hidden">
        <div class="flex-1">
            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[11px] font-bold bg-white/20 text-white border border-white/20 uppercase tracking-wider mb-2.5 backdrop-blur-sm">
                Riwayat & Evaluasi
            </span>
            <h1 class="text-2xl sm:text-[28px] font-extrabold text-white tracking-tight leading-tight drop-shadow-md">
                Riwayat Perjalanan & Evakuasi
            </h1>
            <p class="text-primary-100 text-[14px] mt-1.5 font-medium max-w-2xl drop-shadow-sm">
                Rekapitulasi riwayat pesanan ambulans yang pernah Anda tangani berdasarkan rentang tanggal dan status.
            </p>
        </div>

        <div class="flex flex-wrap items-center gap-2">
            <button type="button" wire:click="resetFilters"
                    class="px-4 py-2.5 rounded-xl bg-white/10 hover:bg-white/20 border border-white/20 text-white text-xs font-bold transition-all shadow-lg backdrop-blur-sm">
                Reset Filter
            </button>
        </div>
    </div>

    <!-- Filter Card -->
    <div class="bg-white rounded-3xl border border-slate-200/80 p-5 mb-6 shadow-xs print:hidden">
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
            <div>
                <label class="block text-xs font-bold text-slate-500 mb-1">DARI TANGGAL</label>
                <input type="date" wire:model.live="startDate"
                       class="w-full px-4 py-2 rounded-xl border border-slate-300 text-sm font-semibold">
            </div>
            <div>
                <label class="block text-xs font-bold text-slate-500 mb-1">SAMPAI TANGGAL</label>
                <input type="date" wire:model.live="endDate"
                       class="w-full px-4 py-2 rounded-xl border border-slate-300 text-sm font-semibold">
            </div>
            <div>
                <label class="block text-xs font-bold text-slate-500 mb-1">FILTER STATUS ORDER</label>
                <div class="relative" x-data="{ open: false }">
                    <button type="button" @click="open = !open" @click.outside="open = false"
                            class="w-full flex items-center justify-between px-4 py-2 rounded-xl border border-slate-300 bg-white text-sm font-semibold text-slate-700 shadow-xs hover:border-slate-400 focus:outline-none focus:ring-2 focus:ring-sky-100 transition-all">
                        <span>
                            @if($statusFilter === 'selesai') Selesai (Sukses)
                            @elseif($statusFilter === 'dibatalkan') Dibatalkan
                            @elseif($statusFilter === 'menunggu') Menunggu
                            @elseif($statusFilter === 'diproses') Ditugaskan
                            @else Semua Status
                            @endif
                        </span>
                        <svg class="w-4 h-4 text-slate-400 transition-transform duration-200" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </button>

                    <div x-show="open" x-transition.opacity.duration.150ms
                         class="absolute left-0 top-full mt-1.5 w-full bg-white rounded-xl shadow-xl border border-slate-200 py-1.5 z-50 overflow-hidden"
                         style="display: none;">
                        <button type="button" @click="$wire.set('statusFilter', ''); open = false"
                                class="w-full text-left px-3.5 py-2 text-xs font-semibold flex items-center justify-between hover:bg-sky-50 hover:text-sky-600 transition-colors {{ $statusFilter === '' ? 'text-sky-600 bg-sky-50/50' : 'text-slate-700' }}">
                            <span>Semua Status</span>
                            @if($statusFilter === '') <svg class="w-3.5 h-3.5 text-sky-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg> @endif
                        </button>
                        <button type="button" @click="$wire.set('statusFilter', 'selesai'); open = false"
                                class="w-full text-left px-3.5 py-2 text-xs font-semibold flex items-center justify-between hover:bg-sky-50 hover:text-sky-600 transition-colors {{ $statusFilter === 'selesai' ? 'text-sky-600 bg-sky-50/50' : 'text-slate-700' }}">
                            <span>Selesai (Sukses)</span>
                            @if($statusFilter === 'selesai') <svg class="w-3.5 h-3.5 text-sky-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg> @endif
                        </button>
                        <button type="button" @click="$wire.set('statusFilter', 'dibatalkan'); open = false"
                                class="w-full text-left px-3.5 py-2 text-xs font-semibold flex items-center justify-between hover:bg-sky-50 hover:text-sky-600 transition-colors {{ $statusFilter === 'dibatalkan' ? 'text-sky-600 bg-sky-50/50' : 'text-slate-700' }}">
                            <span>Dibatalkan</span>
                            @if($statusFilter === 'dibatalkan') <svg class="w-3.5 h-3.5 text-sky-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg> @endif
                        </button>
                        <button type="button" @click="$wire.set('statusFilter', 'menunggu'); open = false"
                                class="w-full text-left px-3.5 py-2 text-xs font-semibold flex items-center justify-between hover:bg-sky-50 hover:text-sky-600 transition-colors {{ $statusFilter === 'menunggu' ? 'text-sky-600 bg-sky-50/50' : 'text-slate-700' }}">
                            <span>Menunggu</span>
                            @if($statusFilter === 'menunggu') <svg class="w-3.5 h-3.5 text-sky-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg> @endif
                        </button>
                        <button type="button" @click="$wire.set('statusFilter', 'diproses'); open = false"
                                class="w-full text-left px-3.5 py-2 text-xs font-semibold flex items-center justify-between hover:bg-sky-50 hover:text-sky-600 transition-colors {{ $statusFilter === 'diproses' ? 'text-sky-600 bg-sky-50/50' : 'text-slate-700' }}">
                            <span>Ditugaskan</span>
                            @if($statusFilter === 'diproses') <svg class="w-3.5 h-3.5 text-sky-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg> @endif
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- 3 Rekapitulasi Cepat -->
    <div class="grid grid-cols-3 gap-4 mb-6">
        <div class="p-5 rounded-2xl bg-white border border-slate-200/80 shadow-xs">
            <span class="text-xs font-bold text-slate-400 block uppercase">Total Layanan</span>
            <span class="text-2xl font-black text-slate-800">{{ $rekap['total'] }} <span class="text-xs font-normal">Order</span></span>
        </div>
        <div class="p-5 rounded-2xl bg-white border border-slate-200/80 shadow-xs">
            <span class="text-xs font-bold text-emerald-600 block uppercase">Evakuasi Selesai</span>
            <span class="text-2xl font-black text-emerald-700">{{ $rekap['selesai'] }} <span class="text-xs font-normal">Pasien</span></span>
        </div>
        <div class="p-5 rounded-2xl bg-white border border-slate-200/80 shadow-xs">
            <span class="text-xs font-bold text-red-600 block uppercase">Order Batal</span>
            <span class="text-2xl font-black text-red-700">{{ $rekap['batal'] }} <span class="text-xs font-normal">Order</span></span>
        </div>
    </div>

    <!-- Table Laporan -->
    <div class="bg-white rounded-3xl border border-slate-200/80 shadow-xs overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-200 text-[11px] font-bold text-slate-500 uppercase tracking-wider">
                        <th class="py-3 px-6 whitespace-nowrap">Kode & Tanggal</th>
                        <th class="py-3 px-6 whitespace-nowrap">Pasien & Alamat</th>
                        <th class="py-3 px-6 whitespace-nowrap">RS Rujukan</th>
                        <th class="py-3 px-6 whitespace-nowrap">Armada & Supir</th>
                        <th class="py-3 px-6 whitespace-nowrap">Status</th>
                        <th class="py-3 px-6 whitespace-nowrap">Rating</th>
                        <th class="py-3 px-6 whitespace-nowrap text-right print:hidden">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-sm">
                    @forelse($laporan as $row)
                        <tr class="hover:bg-slate-50/50 transition-colors">
                            <td class="py-4 px-6">
                                <span class="font-extrabold text-slate-800 block">{{ $row->kode_order }}</span>
                                <span class="text-xs text-slate-400">{{ $row->created_at->format('d/m/Y H:i') }}</span>
                            </td>
                            <td class="py-4 px-6">
                                <span class="font-bold text-slate-800 block">{{ $row->nama_pasien }}</span>
                                <span class="text-xs text-slate-500 block truncate max-w-xs">{{ $row->lokasi_jemput }}</span>
                            </td>
                            <td class="py-4 px-6 text-xs font-semibold text-slate-700">
                                {{ $row->tujuan_lokasi ?? $row->rumahSakit?->nama ?? '-' }}
                            </td>
                            <td class="py-4 px-6 text-xs">
                                <span class="font-bold text-slate-800 block">{{ $row->ambulans?->kode_ambulans ?? '-' }}</span>
                                <span class="text-slate-500">{{ $row->supir?->user->name ?? '-' }}</span>
                            </td>
                            <td class="py-4 px-6">
                                <div class="flex items-center gap-1.5 font-bold text-sm
                                    {{ $row->status === 'selesai' ? 'text-emerald-600' : 'text-slate-600' }}">
                                    <span class="w-1.5 h-1.5 rounded-full {{ $row->status === 'selesai' ? 'bg-emerald-500' : 'bg-slate-500' }}"></span>
                                    <span>{{ $row->status_label }}</span>
                                </div>
                            </td>
                            <td class="py-4 px-6 font-bold text-amber-500 text-xs">
                                @if($row->rating)
                                    ★ {{ $row->rating->skor }}/5
                                @else
                                    <span class="text-slate-300">-</span>
                                @endif
                            </td>
                            <td class="py-4 px-6 text-right print:hidden whitespace-nowrap">
                                <a href="{{ route('supir.orders.show', $row->id) }}"
                                   class="px-4 py-2 rounded-xl bg-slate-900 hover:bg-slate-800 text-white font-bold text-[11px] transition-colors shadow-sm">
                                    Detail
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="py-12 text-center text-slate-400">
                                <p class="text-sm font-semibold">Tidak ada data riwayat perjalanan pada periode yang dipilih</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="px-6 py-4 border-t border-slate-100 print:hidden">
            {{ $laporan->links() }}
        </div>
    </div>
</div>
