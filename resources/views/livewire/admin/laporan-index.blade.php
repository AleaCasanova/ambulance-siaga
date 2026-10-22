<div class="print-area">
    <style>
        @media print {
            @page { size: landscape; margin: 15mm; }
            body { background: white; -webkit-print-color-adjust: exact; print-color-adjust: exact; color: black; }
            body * { visibility: hidden; }
            .print-area, .print-area * { visibility: visible; }
            .print-area { position: absolute; left: 0; top: 0; width: 100%; padding: 0; margin: 0; }
            .print\:hidden { display: none !important; }
            
            /* Jadikan tabel biasa saja untuk print */
            .print-area table { border-collapse: collapse !important; width: 100% !important; border: 1px solid #000 !important; }
            .print-area th, .print-area td { border: 1px solid #000 !important; padding: 6px 8px !important; color: #000 !important; font-size: 11px !important; }
            .print-area th { background-color: #f1f5f9 !important; font-weight: bold !important; text-align: left !important; }
            
            /* Hapus desain web (rounded, shadow, border bawaan) */
            .print-area .rounded-xl { border-radius: 0 !important; border: none !important; box-shadow: none !important; }
            .print-area .bg-white { background: transparent !important; }
            
            /* Rapikan teks agar tidak terlalu tebal atau berwarna */
            .print-area .text-slate-800, .print-area .text-slate-500, .print-area .text-slate-400 { color: #000 !important; }
            .print-area .text-emerald-600 { color: #000 !important; }
            .print-area .font-extrabold { font-weight: bold !important; }
            .print-area .w-1\.5 { display: none !important; } /* Sembunyikan bulatan status */
        }
    </style>

    <!-- Kop Cetak Khusus Print Browser -->
    <div class="hidden print:block mb-6 border-b-2 border-slate-900 pb-3">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-base font-black text-slate-900 uppercase tracking-wide">🚑 AMBULANS SIAGA — UNIT TANGGAP DARURAT</h2>
                <p class="text-xs text-slate-600 font-medium">Sistem Informasi Pelayanan Evakuasi Medis & Ambulans Siaga Real-Time</p>
                <p class="text-[10px] text-slate-500">Jl. Pemuda No. 123, Kabupaten Cilacap, Jawa Tengah | Hotline: (0282) 119-000</p>
            </div>
            <div class="text-right text-xs text-slate-700">
                <p class="font-bold text-slate-900">LAPORAN OPERASIONAL RESMI</p>
                <p class="font-mono text-sky-600 font-bold text-[11px]">No: LAP-OPS/AS/{{ date('m/Y') }}/{{ str_pad($rekap['total'] ?? 1, 3, '0', STR_PAD_LEFT) }}</p>
                <p class="text-[10px] text-slate-500">Periode: {{ \Carbon\Carbon::parse($startDate)->format('d/m/Y') }} — {{ \Carbon\Carbon::parse($endDate)->format('d/m/Y') }}</p>
            </div>
        </div>
    </div>

    <!-- Header Page -->
    <div class="mb-8 flex flex-col lg:flex-row lg:items-end lg:justify-between gap-6 print:hidden">
        <div class="flex-1">
            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[11px] font-bold bg-slate-100 text-slate-500 uppercase tracking-wider mb-2.5">
                Audit Operasional Medis
            </span>
            <h1 class="text-2xl sm:text-[28px] font-bold text-slate-900 tracking-tight leading-tight">
                Laporan Pemesanan & Evakuasi
            </h1>
            <p class="text-slate-500 text-[14px] mt-1.5 font-medium max-w-2xl">
                Rekapitulasi riwayat pesanan ambulans berdasarkan rentang tanggal dan status.
            </p>
        </div>

        <div class="flex flex-wrap items-center gap-2">
            <button type="button" wire:click="resetFilters"
                    class="px-4 py-2.5 rounded-lg bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-bold transition-colors">
                Reset Filter
            </button>

            {{-- Tombol Cetak Browser (Print) --}}
            <button type="button" onclick="window.print()"
                    class="inline-flex items-center gap-2 px-4 py-2.5 rounded-lg bg-slate-700 hover:bg-slate-800 text-white font-bold text-xs shadow-md transition-all">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/>
                </svg>
                <span>Print</span>
            </button>

            {{-- Tombol Download PDF --}}
            <a href="{{ route('admin.laporan.export.pdf', ['start' => $startDate, 'end' => $endDate, 'status' => $statusFilter]) }}"
               target="_blank"
               id="btn-export-pdf"
               class="inline-flex items-center gap-2 px-4 py-2.5 rounded-lg bg-red-600 hover:bg-red-700 text-white font-bold text-xs shadow-md transition-all">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
                <span>Download PDF</span>
            </a>

            {{-- Tombol Download Excel --}}
            <a href="{{ route('admin.laporan.export.excel', ['start' => $startDate, 'end' => $endDate, 'status' => $statusFilter]) }}"
               id="btn-export-excel"
               class="inline-flex items-center gap-2 px-4 py-2.5 rounded-lg bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs shadow-md transition-all">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
                <span>Export Excel</span>
            </a>
        </div>
    </div>

    <!-- Filter Card -->
    <div class="bg-white rounded-xl border border-slate-200/80 p-5 mb-6 shadow-xs print:hidden">
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
            <div>
                <label class="block text-xs font-bold text-slate-500 mb-1">DARI TANGGAL</label>
                <input type="date" wire:model.live="startDate"
                       class="w-full px-4 py-2 rounded-lg border border-slate-300 text-sm font-semibold">
            </div>
            <div>
                <label class="block text-xs font-bold text-slate-500 mb-1">SAMPAI TANGGAL</label>
                <input type="date" wire:model.live="endDate"
                       class="w-full px-4 py-2 rounded-lg border border-slate-300 text-sm font-semibold">
            </div>
            <div>
                <label class="block text-xs font-bold text-slate-500 mb-1">FILTER STATUS ORDER</label>
                <div class="relative" x-data="{ open: false }">
                    <button type="button" @click="open = !open" @click.outside="open = false"
                            class="w-full flex items-center justify-between px-4 py-2 rounded-lg border border-slate-300 bg-white text-sm font-semibold text-slate-700 shadow-xs hover:border-slate-400 focus:outline-none focus:ring-2 focus:ring-sky-100 transition-all">
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
                         class="absolute left-0 top-full mt-1.5 w-full bg-white rounded-lg shadow-xl border border-slate-200 py-1.5 z-50 overflow-hidden"
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

    <!-- 5 Ringkasan Operasional (Clean & Professional) -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-3.5 mb-6 print:hidden">
        <!-- 1. Total Layanan -->
        <div class="p-4 rounded-xl bg-white border border-slate-200/80 shadow-xs flex flex-col justify-between hover:border-slate-300 transition-colors">
            <div>
                <span class="text-[11px] font-bold text-slate-400 block uppercase tracking-wider">Total Layanan</span>
                <div class="text-xl font-bold text-slate-800 mt-1">
                    {{ $rekap['total'] }} <span class="text-xs font-normal text-slate-400">Order</span>
                </div>
            </div>
            <div class="mt-3 pt-2.5 border-t border-slate-100 flex items-center justify-between text-[11px] text-slate-500">
                <span>Tingkat Selesai:</span>
                <span class="font-semibold text-slate-700">{{ $rekap['success_rate'] }}%</span>
            </div>
        </div>

        <!-- 2. Evakuasi Selesai -->
        <div class="p-4 rounded-xl bg-white border border-slate-200/80 shadow-xs flex flex-col justify-between hover:border-slate-300 transition-colors">
            <div>
                <span class="text-[11px] font-bold text-slate-400 block uppercase tracking-wider">Evakuasi Selesai</span>
                <div class="text-xl font-bold text-slate-800 mt-1">
                    {{ $rekap['selesai'] }} <span class="text-xs font-normal text-slate-400">Pasien</span>
                </div>
            </div>
            <div class="mt-3 pt-2.5 border-t border-slate-100 flex items-center justify-between text-[11px] text-slate-500">
                <span>Order Batal:</span>
                <span class="font-semibold text-slate-700">{{ $rekap['batal'] }} Order</span>
            </div>
        </div>

        <!-- 3. Rata-rata Waktu Respon -->
        <div class="p-4 rounded-xl bg-white border border-slate-200/80 shadow-xs flex flex-col justify-between hover:border-slate-300 transition-colors">
            <div>
                <span class="text-[11px] font-bold text-slate-400 block uppercase tracking-wider">Rata-rata Respon</span>
                <div class="text-xl font-bold text-slate-800 mt-1">
                    @if($rekap['avg_response'] > 0) ~{{ $rekap['avg_response'] }} @else < 5 @endif <span class="text-xs font-normal text-slate-400">Menit</span>
                </div>
            </div>
            <div class="mt-3 pt-2.5 border-t border-slate-100 text-[11px] text-slate-500 truncate">
                Waktu konfirmasi supir
            </div>
        </div>

        <!-- 4. Kepuasan Pengguna -->
        <div class="p-4 rounded-xl bg-white border border-slate-200/80 shadow-xs flex flex-col justify-between hover:border-slate-300 transition-colors">
            <div>
                <span class="text-[11px] font-bold text-slate-400 block uppercase tracking-wider">Kepuasan Pengguna</span>
                <div class="text-xl font-bold text-slate-800 mt-1">
                    ★ {{ $rekap['avg_rating'] ? number_format($rekap['avg_rating'], 1) : '5.0' }} <span class="text-xs font-normal text-slate-400">/ 5.0</span>
                </div>
            </div>
            <div class="mt-3 pt-2.5 border-t border-slate-100 flex items-center justify-between text-[11px] text-slate-500">
                <span>Total Ulasan:</span>
                <span class="font-semibold text-slate-700">{{ $rekap['rating_count'] }} Pasien</span>
            </div>
        </div>

        <!-- 5. RS Rujukan Terbanyak -->
        <div class="p-4 rounded-xl bg-white border border-slate-200/80 shadow-xs flex flex-col justify-between hover:border-slate-300 transition-colors">
            <div>
                <span class="text-[11px] font-bold text-slate-400 block uppercase tracking-wider">Rujukan Terbanyak</span>
                <div class="text-[14px] font-bold text-slate-800 mt-1.5 truncate" title="{{ $rekap['top_rs'] }}">
                    {{ Str::limit($rekap['top_rs'], 18) }}
                </div>
            </div>
            <div class="mt-3 pt-2.5 border-t border-slate-100 text-[11px] text-slate-500 truncate">
                {{ $rekap['darurat_count'] }} Darurat, {{ $rekap['non_darurat_count'] }} Rutin
            </div>
        </div>
    </div>

    <!-- Table Laporan -->
    <div class="bg-white rounded-xl border border-slate-200/80 shadow-xs overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-200 text-[11px] font-bold text-slate-500 uppercase tracking-wider">
                        <th class="py-3 px-4 sm:px-5 whitespace-nowrap">Kode & Tanggal</th>
                        <th class="py-3 px-4 sm:px-5 whitespace-nowrap">Pasien & Alamat</th>
                        <th class="py-3 px-4 sm:px-5 whitespace-nowrap">RS Rujukan</th>
                        <th class="py-3 px-4 sm:px-5 whitespace-nowrap">Armada & Supir</th>
                        <th class="py-3 px-4 sm:px-5 whitespace-nowrap">Status</th>
                        <th class="py-3 px-4 sm:px-5 whitespace-nowrap">Rating</th>
                        <th class="py-3 px-4 sm:px-5 whitespace-nowrap text-right print:hidden">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-xs">
                    @forelse($laporan as $row)
                        <tr class="hover:bg-slate-50/50 transition-colors">
                            <td class="py-3 px-4 sm:px-5 whitespace-nowrap">
                                <span class="font-bold text-slate-800 font-mono text-xs block">{{ $row->kode_order }}</span>
                                <span class="text-[11px] text-slate-400 block mt-0.5">{{ $row->created_at->format('d/m/Y H:i') }} WIB</span>
                            </td>
                            <td class="py-3 px-4 sm:px-5">
                                <span class="font-bold text-slate-800 text-xs block truncate max-w-[180px]">{{ $row->nama_pasien }}</span>
                                <span class="text-[11px] text-slate-500 block truncate max-w-[200px]" title="{{ $row->lokasi_jemput }}">{{ $row->lokasi_jemput }}</span>
                            </td>
                            <td class="py-3 px-4 sm:px-5">
                                <span class="font-medium text-slate-700 text-xs block line-clamp-2 max-w-[220px] leading-relaxed" title="{{ $row->tujuan_lokasi ?? $row->rumahSakit?->nama }}">
                                    {{ $row->tujuan_lokasi ?? $row->rumahSakit?->nama ?? '-' }}
                                </span>
                            </td>
                            <td class="py-3 px-4 sm:px-5 whitespace-nowrap">
                                <span class="font-bold text-slate-800 text-xs block">{{ $row->ambulans?->kode_ambulans ?? '-' }}</span>
                                <span class="text-[11px] text-slate-500 block">{{ $row->supir?->user->name ?? '-' }}</span>
                            </td>
                            <td class="py-3 px-4 sm:px-5 whitespace-nowrap">
                                <div class="inline-flex items-center gap-1.5 font-bold text-xs
                                    {{ $row->status === 'selesai' ? 'text-emerald-600' : 'text-slate-600' }}">
                                    <span class="w-1.5 h-1.5 rounded-full {{ $row->status === 'selesai' ? 'bg-emerald-500' : 'bg-slate-500' }}"></span>
                                    <span>{{ $row->status_label }}</span>
                                </div>
                            </td>
                            <td class="py-3 px-4 sm:px-5 font-bold text-amber-500 text-xs whitespace-nowrap">
                                @if($row->rating)
                                    ★ {{ $row->rating->skor }}/5
                                @else
                                    <span class="text-slate-300">-</span>
                                @endif
                            </td>
                            <td class="py-3 px-4 sm:px-5 text-right print:hidden whitespace-nowrap">
                                <div class="flex items-center justify-end">
                                    <button type="button" wire:click="deleteReport({{ $row->id }})"
                                            wire:confirm="Yakin ingin menghapus data laporan pesanan ini dari database?"
                                            title="Hapus Laporan"
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

    <!-- Lembar Pengesahan Khusus Cetak Browser (Print Mode) -->
    <div class="hidden print:block mt-8 pt-4">
        <div class="grid grid-cols-2 gap-8 text-xs">
            <div>
                <p class="text-slate-600">Dibuat & Diverifikasi Oleh:</p>
                <p class="font-bold text-slate-800">Petugas Administrator / Operator Medis</p>
                <div class="h-16"></div>
                <p class="font-bold underline text-slate-900">( {{ auth()->user()->name ?? 'Administrator Siaga' }} )</p>
                <p class="text-[11px] text-slate-500">Operator Tanggap Darurat</p>
            </div>
            <div class="text-right">
                <p class="text-slate-600">Cilacap, {{ now()->translatedFormat('d F Y') }}</p>
                <p class="text-slate-600">Mengetahui & Menyetujui:</p>
                <p class="font-bold text-slate-800">Kepala Operasional / Pimpinan Yayasan</p>
                <div class="h-16"></div>
                <p class="font-bold underline text-slate-900">( ................................................................ )</p>
                <p class="text-[11px] text-slate-500">Penanggung Jawab Operasional</p>
            </div>
        </div>
        <div class="mt-8 pt-2 border-t border-slate-300 text-[10px] text-slate-400 flex justify-between">
            <span>© {{ date('Y') }} Ambulans Siaga — Dokumen Audit & Laporan Resmi Sistem Pelayanan Darurat</span>
            <span>Dicetak pada {{ now()->format('d/m/Y H:i:s') }} WIB</span>
        </div>
    </div>
</div>
