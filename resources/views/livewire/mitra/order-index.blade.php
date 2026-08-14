<div>
    <!-- Header Page -->
    <div class="mb-8 flex flex-col sm:flex-row sm:items-end sm:justify-between gap-6">
        <div>
            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[11px] font-bold bg-slate-100 text-slate-500 uppercase tracking-wider mb-2.5">
                Log Misi & Penjemputan Darurat
            </span>
            <h1 class="text-2xl sm:text-[28px] font-bold text-slate-900 tracking-tight leading-tight">
                Riwayat Penugasan Misi {{ $mitra->nama_mitra ?? 'Lembaga' }}
            </h1>
            <p class="text-slate-500 text-[14px] mt-1.5 font-medium">
                Daftar seluruh panggilan darurat dan rujukan medis yang ditugaskan ke armada & driver lembaga Anda.
            </p>
        </div>

        <div class="flex flex-wrap items-center gap-3">
            <!-- Search -->
            <input type="text" wire:model.live.debounce.300ms="search"
                   placeholder="Cari order, pasien, alamat..."
                   class="px-4 py-2.5 rounded-xl border border-slate-300 bg-white text-sm font-medium focus:border-sky-500 focus:ring-2 focus:ring-sky-200 shadow-xs">

            <!-- Filter Status Custom Dropdown -->
            <div class="relative" x-data="{ open: false }">
                <button type="button" @click="open = !open" @click.outside="open = false"
                        class="flex items-center justify-between gap-2 px-4 py-2.5 rounded-xl border border-slate-300 bg-white text-sm font-semibold text-slate-700 shadow-xs hover:border-slate-400 focus:outline-none focus:ring-2 focus:ring-sky-100 transition-all">
                    <span>
                        @if($statusFilter === 'selesai') Selesai (Sukses)
                        @elseif($statusFilter === 'diproses') Ditugaskan
                        @elseif($statusFilter === 'menuju_lokasi') Menuju Lokasi
                        @elseif($statusFilter === 'membawa_pasien') Ke RS Rujukan
                        @elseif($statusFilter === 'dibatalkan') Dibatalkan
                        @else Semua Status
                        @endif
                    </span>
                    <svg class="w-4 h-4 text-slate-400 transition-transform duration-200" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                </button>

                <div x-show="open" x-transition.opacity.duration.150ms
                     class="absolute right-0 top-full mt-1.5 w-52 bg-white rounded-xl shadow-xl border border-slate-200 py-1.5 z-50 overflow-hidden"
                     style="display: none;">
                    <button type="button" @click="$wire.set('statusFilter', ''); open = false"
                            class="w-full text-left px-3.5 py-2 text-xs font-semibold flex items-center justify-between hover:bg-sky-50 hover:text-sky-600 transition-colors {{ $statusFilter === '' ? 'text-sky-600 bg-sky-50/50' : 'text-slate-700' }}">
                        <span>Semua Status</span>
                        @if($statusFilter === '') <svg class="w-3.5 h-3.5 text-sky-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg> @endif
                    </button>
                    @foreach([
                        'selesai' => 'Selesai (Sukses)',
                        'membawa_pasien' => 'Ke RS Rujukan',
                        'menuju_lokasi' => 'Menuju Lokasi',
                        'diproses' => 'Ditugaskan',
                        'dibatalkan' => 'Dibatalkan'
                    ] as $val => $lbl)
                        <button type="button" @click="$wire.set('statusFilter', '{{ $val }}'); open = false"
                                class="w-full text-left px-3.5 py-2 text-xs font-semibold flex items-center justify-between hover:bg-sky-50 hover:text-sky-600 transition-colors {{ $statusFilter === $val ? 'text-sky-600 bg-sky-50/50' : 'text-slate-700' }}">
                            <span>{{ $lbl }}</span>
                            @if($statusFilter === $val) <svg class="w-3.5 h-3.5 text-sky-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg> @endif
                        </button>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <!-- Table Card -->
    <div class="bg-white border border-slate-200/80 rounded-3xl overflow-hidden shadow-xs">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b border-slate-100 bg-slate-50/75">
                        <th class="py-4 px-6 text-[11px] font-bold uppercase tracking-wider text-slate-500">Kode & Waktu</th>
                        <th class="py-4 px-6 text-[11px] font-bold uppercase tracking-wider text-slate-500">Data Pasien</th>
                        <th class="py-4 px-6 text-[11px] font-bold uppercase tracking-wider text-slate-500">Rute Jemput & Tujuan</th>
                        <th class="py-4 px-6 text-[11px] font-bold uppercase tracking-wider text-slate-500">Armada & Supir</th>
                        <th class="py-4 px-6 text-[11px] font-bold uppercase tracking-wider text-slate-500">Status Misi</th>
                        <th class="py-4 px-6 text-[11px] font-bold uppercase tracking-wider text-slate-500 text-right">Detail</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 font-medium text-slate-700 text-xs">
                    @forelse($orders as $ord)
                        <tr class="hover:bg-slate-50/50 transition-colors">
                            <td class="py-4 px-6">
                                <span class="font-bold text-slate-900 block text-sm">{{ $ord->kode_order }}</span>
                                <span class="text-[11px] text-slate-400">{{ $ord->waktu_pesan ? $ord->waktu_pesan->translatedFormat('d M Y, H:i') : '-' }}</span>
                            </td>
                            <td class="py-4 px-6">
                                <span class="font-bold text-slate-900 block">{{ $ord->nama_pasien }}</span>
                                <span class="text-[11px] text-slate-500 line-clamp-1">{{ $ord->kondisi_pasien ?? '-' }}</span>
                            </td>
                            <td class="py-4 px-6">
                                <span class="block text-slate-900 font-semibold truncate max-w-xs">📍 {{ $ord->lokasi_jemput }}</span>
                                <span class="text-[11px] text-slate-500 block truncate max-w-xs">🏥 {{ $ord->tujuan_lokasi ?? $ord->rumahSakit?->nama ?? 'RS Rujukan' }}</span>
                            </td>
                            <td class="py-4 px-6">
                                <span class="font-bold text-slate-900 block">{{ $ord->ambulans?->kode_ambulans ?? '-' }}</span>
                                <span class="text-[11px] text-slate-500 font-semibold">{{ $ord->supir?->user?->name ?? 'Belum Ditugaskan' }}</span>
                            </td>
                            <td class="py-4 px-6">
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[11px] font-bold
                                    @if($ord->status === 'selesai') bg-emerald-50 text-emerald-700 border border-emerald-200
                                    @elseif(in_array($ord->status, ['diproses', 'menuju_lokasi', 'membawa_pasien'])) bg-sky-50 text-sky-700 border border-sky-200 animate-pulse
                                    @elseif($ord->status === 'dibatalkan') bg-rose-50 text-rose-700 border border-rose-200
                                    @else bg-slate-100 text-slate-600 border border-slate-200 @endif">
                                    <span class="w-1.5 h-1.5 rounded-full bg-current"></span>
                                    <span>{{ $ord->status_label }}</span>
                                </span>
                            </td>
                            <td class="py-4 px-6 text-right">
                                <button type="button" wire:click="showDetail({{ $ord->id }})"
                                        class="px-3.5 py-1.5 rounded-xl bg-slate-100 hover:bg-sky-50 hover:text-sky-600 text-slate-700 font-bold text-xs transition-colors">
                                    Lihat Rincian
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="py-12 text-center text-slate-400">
                                <div class="w-16 h-16 rounded-full bg-slate-50 flex items-center justify-center mx-auto mb-3 text-2xl">📋</div>
                                <p class="font-bold text-slate-600">Belum ada riwayat penugasan</p>
                                <p class="text-xs text-slate-400 mt-1">Misi penjemputan yang didelegasikan ke unit lembaga Anda akan tampil di sini.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="p-4 border-t border-slate-100">
            {{ $orders->links() }}
        </div>
    </div>

    <!-- Modal Detail Penugasan -->
    @if($isDetailModalOpen && $selectedOrder)
        <div class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-xs">
            <div class="w-full max-w-xl bg-white rounded-3xl shadow-2xl border border-slate-200 p-6 sm:p-8 relative max-h-[90vh] overflow-y-auto">
                <button type="button" wire:click="closeDetailModal" class="absolute right-5 top-5 text-slate-400 hover:text-slate-600 text-xl font-bold">
                    &times;
                </button>

                <div class="flex items-center gap-3 mb-4">
                    <span class="px-3 py-1 rounded-full text-xs font-black uppercase tracking-wider bg-sky-50 text-sky-700 border border-sky-200">
                        {{ $selectedOrder->kode_order }}
                    </span>
                    <span class="text-xs text-slate-400 font-medium">
                        {{ $selectedOrder->waktu_pesan ? $selectedOrder->waktu_pesan->translatedFormat('d F Y, H:i') : '-' }}
                    </span>
                </div>

                <h3 class="text-xl font-black text-slate-900 mb-6">
                    Rincian Misi Penjemputan Pasien
                </h3>

                <div class="space-y-4 text-xs font-medium text-slate-700">
                    <!-- Pasien -->
                    <div class="p-4 rounded-2xl bg-slate-50 border border-slate-100 space-y-1.5">
                        <span class="text-[10px] font-extrabold text-slate-400 uppercase tracking-wider block">Informasi Pasien</span>
                        <div class="flex justify-between items-center">
                            <strong class="text-sm font-bold text-slate-900">{{ $selectedOrder->nama_pasien }}</strong>
                            <span class="text-slate-600">Kontak: {{ $selectedOrder->no_hp_pemesan ?? $selectedOrder->user?->phone ?? '-' }}</span>
                        </div>
                        <p class="text-slate-600">Kondisi: {{ $selectedOrder->kondisi_pasien ?: 'Penjemputan Medis Darurat' }}</p>
                    </div>

                    <!-- Rute -->
                    <div class="p-4 rounded-2xl bg-slate-50 border border-slate-100 space-y-2">
                        <span class="text-[10px] font-extrabold text-slate-400 uppercase tracking-wider block">Rute Perjalanan</span>
                        <div>
                            <span class="text-slate-400 block text-[11px]">Titik Penjemputan:</span>
                            <p class="font-bold text-slate-800 text-xs">📍 {{ $selectedOrder->lokasi_jemput }}</p>
                        </div>
                        <div>
                            <span class="text-slate-400 block text-[11px]">Rumah Sakit Rujukan:</span>
                            <p class="font-bold text-slate-800 text-xs">🏥 {{ $selectedOrder->tujuan_lokasi ?? $selectedOrder->rumahSakit?->nama ?? '-' }}</p>
                        </div>
                    </div>

                    <!-- Armada & Driver -->
                    <div class="p-4 rounded-2xl bg-slate-50 border border-slate-100 grid grid-cols-2 gap-4">
                        <div>
                            <span class="text-[10px] font-extrabold text-slate-400 uppercase tracking-wider block mb-0.5">Armada Lembaga</span>
                            <strong class="text-slate-900 block font-bold">{{ $selectedOrder->ambulans?->kode_ambulans ?? '-' }}</strong>
                            <span class="text-slate-500 font-mono">{{ $selectedOrder->ambulans?->plat_nomor ?? '-' }}</span>
                        </div>
                        <div>
                            <span class="text-[10px] font-extrabold text-slate-400 uppercase tracking-wider block mb-0.5">Driver Bertugas</span>
                            <strong class="text-slate-900 block font-bold">{{ $selectedOrder->supir?->user?->name ?? 'Belum Ditugaskan' }}</strong>
                            <span class="text-slate-500">SIM: {{ $selectedOrder->supir?->nomor_sim ?? '-' }}</span>
                        </div>
                    </div>
                </div>

                <div class="mt-6 pt-4 border-t border-slate-100">
                    <button type="button" wire:click="closeDetailModal"
                            class="w-full py-2.5 rounded-xl bg-slate-900 hover:bg-slate-800 text-white font-bold text-xs transition-colors">
                        Tutup Rincian
                    </button>
                </div>
            </div>
        </div>
    @endif
</div>
