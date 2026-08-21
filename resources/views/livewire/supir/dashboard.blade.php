<div wire:poll.10s class="space-y-6 mb-8 -mt-4 sm:-mt-6">

    <!-- 1. Row 1: Status Siaga Driver (Clean Operational Bar, Radius 12px) -->
    <div class="bg-white rounded-xl border border-slate-200 p-5 sm:p-6 shadow-xs flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <div class="flex flex-wrap items-center gap-2 mb-1.5">
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider
                    {{ $isOnline ? 'bg-emerald-50 text-emerald-700 border border-emerald-200' : 'bg-slate-100 text-slate-600 border border-slate-200' }}">
                    <span class="w-2 h-2 rounded-full {{ $isOnline ? 'bg-emerald-500 animate-ping' : 'bg-slate-400' }}"></span>
                    <span>{{ $isOnline ? '● SIAGA — ONLINE' : '○ OFFLINE — ISTIRAHAT' }}</span>
                </span>

                @if($pendingOrdersCount > 0)
                    <a href="{{ route('supir.tugas.index') }}" class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-xs font-bold bg-amber-50 text-amber-800 border border-amber-200 hover:bg-amber-100 transition-colors">
                        <span>{{ $pendingOrdersCount }} Tugas Baru</span>
                    </a>
                @endif
            </div>

            <h1 class="text-xl sm:text-2xl font-bold text-slate-900 tracking-tight">
                Selamat bertugas, {{ auth()->user()->name }}
            </h1>
            <p class="text-xs text-slate-500 mt-1">
                {{ $isOnline ? 'Anda siap menerima penugasan evakuasi medis darurat dari Dispatcher Ambulans Siaga.' : 'Status Anda saat ini sedang istirahat. Aktifkan status siaga untuk menerima panggilan ambulans.' }}
            </p>
        </div>

        <div class="flex items-center gap-2.5 shrink-0">
            <button type="button" wire:click="toggleOnline"
                    class="px-5 py-2.5 rounded-lg font-bold text-xs shadow-xs transition-colors flex items-center gap-2
                    {{ $isOnline ? 'bg-slate-100 hover:bg-slate-200 text-slate-800 border border-slate-300' : 'bg-emerald-600 hover:bg-emerald-700 text-white' }}">
                <span>{{ $isOnline ? 'Ubah ke Offline (Istirahat)' : 'Aktifkan Siaga (Online)' }}</span>
            </button>
        </div>
    </div>

    <!-- Alert Misi Aktif Sedang Berjalan (Jika Ada) -->
    @if($activeOrder)
        <div class="bg-white rounded-xl border border-primary-300 p-5 shadow-xs flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div class="space-y-1">
                <div class="flex items-center gap-2">
                    <span class="px-2.5 py-0.5 rounded-full text-[11px] font-bold bg-primary-50 text-primary-700 border border-primary-200">
                        PENUGASAN AKTIF SEDANG BERJALAN
                    </span>
                    <span class="font-mono text-xs text-slate-500 font-semibold">#{{ $activeOrder->kode_order }}</span>
                </div>
                <h3 class="text-base font-bold text-slate-900">{{ $activeOrder->nama_pasien }}</h3>
                <p class="text-xs text-slate-600">
                    Penjemputan: {{ $activeOrder->lokasi_jemput }} &rarr; <span class="font-semibold text-slate-800">{{ $activeOrder->tujuan_lokasi ?? $activeOrder->rumahSakit?->nama ?? 'RS Rujukan' }}</span>
                </p>
            </div>

            <a href="{{ route('supir.orders.show', $activeOrder->id) }}"
               class="px-5 py-2.5 rounded-lg bg-primary-700 hover:bg-primary-800 text-white font-bold text-xs shadow-xs transition-colors flex items-center justify-center gap-2 shrink-0">
                <span>Buka Navigasi Misi</span>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
            </a>
        </div>
    @endif

    <!-- 2. Row 2: 4 Kartu Metrik Operasional Harian (12px Card, Clean Borders) -->
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
        <!-- Metrik 1: Tugas Hari Ini -->
        <div class="p-4 sm:p-5 rounded-xl bg-white border border-slate-200 shadow-xs space-y-1">
            <span class="text-xs font-semibold text-slate-400 uppercase tracking-wider block">Tugas Hari Ini</span>
            <div class="flex items-baseline gap-2">
                <span class="text-2xl sm:text-3xl font-bold text-slate-900">{{ $todayCompletedCount }}</span>
                <span class="text-xs text-slate-500 font-medium">Evakuasi</span>
            </div>
        </div>

        <!-- Metrik 2: Total Perjalanan -->
        <div class="p-4 sm:p-5 rounded-xl bg-white border border-slate-200 shadow-xs space-y-1">
            <span class="text-xs font-semibold text-slate-400 uppercase tracking-wider block">Total Perjalanan</span>
            <div class="flex items-baseline gap-2">
                <span class="text-2xl sm:text-3xl font-bold text-slate-900">{{ $totalCompletedCount }}</span>
                <span class="text-xs text-slate-500 font-medium">Selesai</span>
            </div>
        </div>

        <!-- Metrik 3: Rating Kepuasan -->
        <div class="p-4 sm:p-5 rounded-xl bg-white border border-slate-200 shadow-xs space-y-1">
            <span class="text-xs font-semibold text-slate-400 uppercase tracking-wider block">Rating Kepuasan</span>
            <div class="flex items-center gap-2">
                <span class="text-2xl sm:text-3xl font-bold text-slate-900">{{ number_format($supir?->rating_rata_rata ?? 5.0, 1) }}</span>
                <span class="text-amber-500 font-bold text-sm">★</span>
                <span class="text-[11px] text-slate-400">Ulasan</span>
            </div>
        </div>

        <!-- Metrik 4: Armada Bertugas -->
        <div class="p-4 sm:p-5 rounded-xl bg-white border border-slate-200 shadow-xs space-y-1">
            <span class="text-xs font-semibold text-slate-400 uppercase tracking-wider block">Armada Utama</span>
            <div class="min-w-0">
                <span class="text-lg sm:text-xl font-bold text-slate-900 block truncate">{{ $supir?->ambulans?->kode_ambulans ?? 'Unit Ambulans' }}</span>
                <span class="text-xs text-slate-500 font-medium truncate block">{{ $supir?->plat_nomor ?? $supir?->ambulans?->plat_nomor ?? '-' }}</span>
            </div>
        </div>
    </div>

    <!-- 3. Row 3: 3 Quick Action Cards (Aksi Cepat Driver) -->
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
        <!-- Aksi 1: Tugas Masuk -->
        <a href="{{ route('supir.tugas.index') }}"
           class="p-4 sm:p-5 rounded-xl bg-white border border-slate-200 hover:border-teal-500 hover:shadow-xs transition-all flex items-center justify-between group">
            <div class="flex items-center gap-3.5">
                <div class="w-10 h-10 rounded-lg bg-teal-50 text-teal-700 flex items-center justify-center group-hover:bg-teal-600 group-hover:text-white transition-colors shrink-0">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
                    </svg>
                </div>
                <div>
                    <h3 class="text-sm font-bold text-slate-900 group-hover:text-teal-700 transition-colors">Tugas Masuk</h3>
                    <p class="text-xs text-slate-500">{{ $pendingOrdersCount > 0 ? $pendingOrdersCount . ' tugas menunggu' : 'Tidak ada antrean' }}</p>
                </div>
            </div>
            <span class="text-xs font-semibold text-teal-700 group-hover:translate-x-0.5 transition-transform">Lihat →</span>
        </a>

        <!-- Aksi 2: Navigasi Peta -->
        <a href="{{ route('supir.perjalanan.aktif') }}"
           class="p-4 sm:p-5 rounded-xl bg-white border border-slate-200 hover:border-sky-500 hover:shadow-xs transition-all flex items-center justify-between group">
            <div class="flex items-center gap-3.5">
                <div class="w-10 h-10 rounded-lg bg-sky-50 text-sky-700 flex items-center justify-center group-hover:bg-sky-600 group-hover:text-white transition-colors shrink-0">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"/>
                    </svg>
                </div>
                <div>
                    <h3 class="text-sm font-bold text-slate-900 group-hover:text-sky-700 transition-colors">Navigasi Peta</h3>
                    <p class="text-xs text-slate-500">Buka peta rute rujukan</p>
                </div>
            </div>
            <span class="text-xs font-semibold text-sky-700 group-hover:translate-x-0.5 transition-transform">Buka →</span>
        </a>

        <!-- Aksi 3: Dispatcher Siaga -->
        <a href="https://wa.me/6281234560002" target="_blank"
           class="p-4 sm:p-5 rounded-xl bg-white border border-slate-200 hover:border-slate-400 hover:shadow-xs transition-all flex items-center justify-between group">
            <div class="flex items-center gap-3.5">
                <div class="w-10 h-10 rounded-lg bg-slate-100 text-slate-700 flex items-center justify-center group-hover:bg-slate-800 group-hover:text-white transition-colors shrink-0">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                    </svg>
                </div>
                <div>
                    <h3 class="text-sm font-bold text-slate-900 group-hover:text-slate-700 transition-colors">Dispatcher Siaga</h3>
                    <p class="text-xs text-slate-500">Operator Pusat Siaga</p>
                </div>
            </div>
            <span class="text-xs font-semibold text-slate-700 group-hover:translate-x-0.5 transition-transform">Kontak →</span>
        </a>
    </div>

    <!-- 4. Row 4: Riwayat Tugas Terakhir & Spesifikasi Driver (2 Kolom) -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start">

        <!-- Kolom Kiri: Riwayat Tugas Terakhir (7 Kolom) -->
        <div class="lg:col-span-7 bg-white rounded-xl border border-slate-200 p-5 shadow-xs space-y-4">
            <div class="flex items-center justify-between pb-3 border-b border-slate-100">
                <div>
                    <h2 class="text-sm font-bold text-slate-900">Riwayat Tugas</h2>
                    <p class="text-xs text-slate-500">Misi evakuasi yang telah berhasil diselesaikan.</p>
                </div>
                <a href="{{ route('supir.riwayat.index') }}" class="text-xs font-semibold text-teal-700 hover:underline">
                    Lihat semua →
                </a>
            </div>

            <div class="space-y-2.5">
                @forelse($recentCompletedOrders as $ro)
                    <div class="p-3.5 rounded-lg bg-slate-50 border border-slate-100 hover:bg-slate-100/60 transition-colors flex flex-col sm:flex-row sm:items-center justify-between gap-3 text-xs">
                        <div class="space-y-0.5">
                            <div class="flex items-center gap-2">
                                <span class="font-mono font-bold text-slate-700">#{{ $ro->kode_order }}</span>
                                <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-emerald-50 text-emerald-700 border border-emerald-200">SELESAI</span>
                                <span class="text-slate-400 text-[11px]">{{ $ro->updated_at ? $ro->updated_at->format('d M, H:i') : '-' }}</span>
                            </div>
                            <h4 class="font-bold text-slate-900 text-sm">{{ $ro->nama_pasien }}</h4>
                            <p class="text-slate-500">
                                {{ $ro->lokasi_jemput }} &rarr; <span class="font-medium text-slate-700">{{ $ro->tujuan_lokasi ?? $ro->rumahSakit?->nama ?? 'RS Rujukan' }}</span>
                            </p>
                        </div>

                        @if($ro->rating)
                            <div class="shrink-0 text-right">
                                <span class="text-amber-500 font-bold">★ {{ $ro->rating->skor }}</span>
                            </div>
                        @endif
                    </div>
                @empty
                    <div class="py-8 text-center text-slate-400 text-xs font-medium">
                        Belum ada riwayat tugas evakuasi yang terselesaikan.
                    </div>
                @endforelse
            </div>
        </div>

        <!-- Kolom Kanan: Spesifikasi Armada & Dokumen (5 Kolom) -->
        <div class="lg:col-span-5 bg-white rounded-xl border border-slate-200 p-5 shadow-xs space-y-4">
            <div class="flex items-center justify-between pb-3 border-b border-slate-100">
                <h3 class="text-sm font-bold text-slate-900">Kendaraan & Dokumen Driver</h3>
                <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-emerald-50 text-emerald-700 border border-emerald-200">
                    Terverifikasi
                </span>
            </div>

            <div class="space-y-2 text-xs">
                <div class="flex justify-between py-1 border-b border-slate-50">
                    <span class="text-slate-500">Nomor SIM Driver:</span>
                    <span class="font-mono font-bold text-slate-800">{{ $supir?->nomor_sim ?: '-' }}</span>
                </div>
                <div class="flex justify-between py-1 border-b border-slate-50">
                    <span class="text-slate-500">Plat Nomor Armada:</span>
                    <span class="font-mono font-bold text-slate-800">{{ $supir?->plat_nomor ?: ($supir?->ambulans?->plat_nomor ?? '-') }}</span>
                </div>
                <div class="flex justify-between py-1 border-b border-slate-50">
                    <span class="text-slate-500">Lembaga / Mitra:</span>
                    <span class="font-medium text-slate-800 text-right">{{ $supir?->nama_lembaga ?: 'Mitra Ambulans Siaga' }}</span>
                </div>
                <div class="flex justify-between py-1">
                    <span class="text-slate-500">Alamat Pangkalan:</span>
                    <span class="font-medium text-slate-800 text-right">{{ $supir?->alamat_unit ?: 'Kabupaten Cilacap' }}</span>
                </div>
            </div>

            <div class="pt-2 border-t border-slate-100">
                <a href="{{ route('profile.edit') }}"
                   class="w-full py-2 rounded-lg bg-slate-100 hover:bg-slate-200 text-slate-700 font-semibold text-xs transition-colors flex items-center justify-center gap-1.5">
                    <svg class="w-3.5 h-3.5 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/></svg>
                    <span>Pengaturan Akun & Dokumen</span>
                </a>
            </div>
        </div>

    </div>

</div>
