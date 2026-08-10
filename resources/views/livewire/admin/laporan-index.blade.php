<div>
    <!-- Header Page -->
    <div class="mb-8 flex flex-col lg:flex-row lg:items-end lg:justify-between gap-6 print:hidden">
        <div class="flex-1">
            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-extrabold bg-white/20 text-white uppercase tracking-wider mb-2.5 shadow-sm border border-white/20 backdrop-blur-md">
                Audit Operasional Medis
            </span>
            <h1 class="text-2xl sm:text-[32px] font-extrabold text-white tracking-tight drop-shadow-md leading-tight">
                Laporan Pemesanan & Evakuasi
            </h1>
            <p class="text-white/90 text-[15px] sm:text-base mt-2 font-medium leading-relaxed drop-shadow-sm max-w-2xl">
                Rekapitulasi riwayat pesanan ambulans berdasarkan rentang tanggal dan status.
            </p>
        </div>

        <div class="flex flex-wrap items-center gap-2">
            <button type="button" wire:click="resetFilters"
                    class="px-4 py-2.5 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-bold transition-colors">
                Reset Filter
            </button>

            {{-- Tombol Cetak Browser (Print) --}}
            <button type="button" onclick="window.print()"
                    class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-slate-700 hover:bg-slate-800 text-white font-bold text-xs shadow-md transition-all">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/>
                </svg>
                <span>Print</span>
            </button>

            {{-- Tombol Download PDF --}}
            <a href="{{ route('admin.laporan.export.pdf', ['start' => $startDate, 'end' => $endDate, 'status' => $statusFilter]) }}"
               target="_blank"
               id="btn-export-pdf"
               class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-red-600 hover:bg-red-700 text-white font-bold text-xs shadow-md transition-all">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
                <span>Download PDF</span>
            </a>

            {{-- Tombol Download Excel --}}
            <a href="{{ route('admin.laporan.export.excel', ['start' => $startDate, 'end' => $endDate, 'status' => $statusFilter]) }}"
               id="btn-export-excel"
               class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs shadow-md transition-all">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
                <span>Export Excel</span>
            </a>
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
                <select wire:model.live="statusFilter"
                        class="w-full px-4 py-2 rounded-xl border border-slate-300 text-sm font-semibold">
                    <option value="">-- Semua Status --</option>
                    <option value="selesai">Selesai (Sukses)</option>
                    <option value="dibatalkan">Dibatalkan</option>
                    <option value="menunggu">Menunggu</option>
                    <option value="diproses">Ditugaskan</option>
                </select>
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
                    <tr class="bg-slate-50/80 border-b border-slate-200 text-[11px] font-bold text-slate-500 uppercase tracking-wider">
                        <th class="py-4 px-6">Kode & Tanggal</th>
                        <th class="py-4 px-6">Pasien & Alamat</th>
                        <th class="py-4 px-6">RS Rujukan</th>
                        <th class="py-4 px-6">Armada & Supir</th>
                        <th class="py-4 px-6">Status</th>
                        <th class="py-4 px-6">Rating</th>
                        <th class="py-4 px-6 text-right print:hidden">Aksi</th>
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
                                <span class="inline-block px-2.5 py-0.5 rounded-full text-[11px] font-bold
                                    {{ $row->status === 'selesai' ? 'bg-emerald-100 text-emerald-700' : 'bg-slate-100 text-slate-600' }}">
                                    {{ $row->status_label }}
                                </span>
                            </td>
                            <td class="py-4 px-6 font-bold text-amber-500 text-xs">
                                @if($row->rating)
                                    ★ {{ $row->rating->skor }}/5
                                @else
                                    <span class="text-slate-300">-</span>
                                @endif
                            </td>
                            <td class="py-4 px-6 text-right print:hidden">
                                <button type="button" wire:click="deleteReport({{ $row->id }})"
                                        wire:confirm="Yakin ingin menghapus data laporan pesanan ini dari database?"
                                        class="px-3 py-1 rounded-xl bg-red-50 hover:bg-red-100 text-red-600 font-bold text-xs transition-colors">
                                    Hapus
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="py-12 text-center text-slate-400">
                                <p class="text-sm font-semibold">Tidak ada data laporan pada periode yang dipilih</p>
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
