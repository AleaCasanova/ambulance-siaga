<div wire:poll.10s
     x-data="driverDispatchConsole(
        {{ $driverLat }},
        {{ $driverLng }},
        {{ $initialOrder ? ($initialOrder->jemput_lat ?: -7.7188) : -7.7188 }},
        {{ $initialOrder ? ($initialOrder->jemput_lng ?: 109.0159) : 109.0159 }},
        {{ $initialOrder ? ($initialOrder->tujuan_lat ?: ($initialOrder->rumahSakit?->lat ?? 0)) : 0 }},
        {{ $initialOrder ? ($initialOrder->tujuan_lng ?: ($initialOrder->rumahSakit?->lng ?? 0)) : 0 }},
        '{{ $initialOrder ? addslashes($initialOrder->nama_pasien) : '' }}',
        '{{ $initialOrder ? addslashes($initialOrder->lokasi_jemput) : '' }}',
        '{{ $initialOrder ? addslashes($initialOrder->tujuan_lokasi ?? $initialOrder->rumahSakit?->nama ?? '') : '' }}'
     )"
     x-init="initMap()"
     class="space-y-6 mb-8 -mt-4 sm:-mt-6">

    <!-- 1. Header Dispatch & Status Siaga (Clean Operational Bar) -->
    <div class="bg-white rounded-xl border border-slate-200 p-5 sm:p-6 shadow-xs flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <div class="flex flex-wrap items-center gap-2 mb-1">
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider
                    {{ $isOnline ? 'bg-emerald-50 text-emerald-700 border border-emerald-200' : 'bg-slate-100 text-slate-600 border border-slate-200' }}">
                    <span class="w-2 h-2 rounded-full {{ $isOnline ? 'bg-emerald-500 animate-ping' : 'bg-slate-400' }}"></span>
                    <span>{{ $isOnline ? '● SIAGA — ONLINE' : '○ OFFLINE — ISTIRAHAT' }}</span>
                </span>

                @if($totalPendingCount > 0)
                    <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-xs font-bold bg-amber-50 text-amber-800 border border-amber-200">
                        <span>{{ $totalPendingCount }} Tugas Masuk</span>
                    </span>
                @endif
            </div>

            <h1 class="text-xl sm:text-2xl font-bold text-slate-900 tracking-tight">
                Tugas Ambulans & Antrean Dispatch
            </h1>
            <p class="text-xs text-slate-500 mt-1">
                Driver: <strong class="text-slate-700">{{ auth()->user()?->name ?? 'Driver' }}</strong> • Armada: <strong class="text-slate-700">{{ $supir?->ambulans?->kode_ambulans ?? 'Unit Ambulans' }} ({{ $supir?->plat_nomor ?? $supir?->ambulans?->plat_nomor ?? '-' }})</strong>
            </p>
        </div>

        <div class="flex items-center gap-2.5 shrink-0">
            <button type="button" wire:click="toggleStatusOnline"
                    class="px-5 py-2.5 rounded-lg font-bold text-xs shadow-xs transition-colors flex items-center gap-2
                    {{ $isOnline ? 'bg-slate-100 hover:bg-slate-200 text-slate-800 border border-slate-300' : 'bg-emerald-600 hover:bg-emerald-700 text-white' }}">
                <span>{{ $isOnline ? 'Ubah ke Offline (Istirahat)' : 'Siaga Sekarang (Online)' }}</span>
            </button>
        </div>
    </div>

    <!-- Flash Messages -->
    @if(session()->has('success'))
        <div x-data="{ show: true }" x-show="show" class="p-3.5 rounded-lg bg-emerald-50 border border-emerald-200 text-emerald-900 text-xs font-medium flex items-center justify-between">
            <div class="flex items-center gap-2">
                <svg class="w-4 h-4 text-emerald-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                <span>{{ session('success') }}</span>
            </div>
            <button @click="show = false" class="text-emerald-700 font-bold">&times;</button>
        </div>
    @endif

    @if(session()->has('warning'))
        <div x-data="{ show: true }" x-show="show" class="p-3.5 rounded-lg bg-amber-50 border border-amber-200 text-amber-900 text-xs font-medium flex items-center justify-between">
            <div class="flex items-center gap-2">
                <svg class="w-4 h-4 text-amber-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                <span>{{ session('warning') }}</span>
            </div>
            <button @click="show = false" class="text-amber-700 font-bold">&times;</button>
        </div>
    @endif

    <!-- 2. Tugas Aktif Sedang Berjalan (Jika Ada) -->
    @if($activeTrip)
        <div class="p-5 rounded-xl bg-white border border-primary-300 shadow-xs flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div class="space-y-1.5">
                <div class="flex items-center gap-2">
                    <span class="px-2.5 py-0.5 rounded-full text-[11px] font-bold bg-primary-50 text-primary-700 border border-primary-200">
                        DALAM PENUGASAN AKTIF
                    </span>
                    <span class="font-mono text-xs text-slate-500 font-semibold">#{{ $activeTrip->kode_order }}</span>
                </div>
                <h3 class="text-base font-bold text-slate-900">{{ $activeTrip->nama_pasien }}</h3>
                <p class="text-xs text-slate-600">
                    {{ $activeTrip->lokasi_jemput }} &rarr; <span class="font-semibold text-slate-800">{{ $activeTrip->tujuan_lokasi ?? $activeTrip->rumahSakit?->nama ?? 'RS Rujukan' }}</span>
                </p>
            </div>

            <a href="{{ route('supir.orders.show', $activeTrip->id) }}"
               class="px-5 py-2.5 rounded-lg bg-primary-700 hover:bg-primary-800 text-white font-bold text-xs shadow-xs transition-colors flex items-center justify-center gap-2 shrink-0">
                <span>Buka Navigasi & Tindakan</span>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
            </a>
        </div>
    @endif

    <!-- 3. Dispatch Tasks Console (2 Kolom) -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start">

        <!-- Left Column: Antrean Tugas (7 Cols) -->
        <div class="lg:col-span-7 space-y-4">
            <div class="flex items-center justify-between px-4 py-2.5 rounded-xl bg-teal-800/90 text-white border border-teal-600/40 shadow-xs backdrop-blur-xs">
                <h2 class="text-sm font-bold text-white flex items-center gap-2">
                    <span>Antrean Tugas Darurat</span>
                    <span class="px-2.5 py-0.5 rounded-full text-xs font-extrabold bg-white/20 text-white border border-white/25">
                        {{ $totalPendingCount }}
                    </span>
                </h2>
                <span class="text-xs text-teal-100 font-medium">
                    Klik &ldquo;Peta Rute&rdquo; untuk melihat jalur di peta
                </span>
            </div>

            <!-- A. Penugasan Khusus Operator -->
            @foreach($assignedOrders as $ao)
                <div class="bg-white rounded-xl border border-slate-200 hover:border-amber-400 p-5 shadow-xs transition-all space-y-3">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-2">
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-[11px] font-bold bg-amber-50 text-amber-800 border border-amber-200">
                                <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>
                                <span>PENUGASAN OPERATOR</span>
                            </span>
                            <span class="text-xs text-slate-400 font-medium">{{ $ao->created_at ? $ao->created_at->diffForHumans() : '-' }}</span>
                        </div>
                        <span class="font-mono text-xs text-slate-400 font-semibold">#{{ $ao->kode_order }}</span>
                    </div>

                    <div>
                        <h3 class="text-base font-bold text-slate-900">{{ $ao->nama_pasien }} <span class="text-xs text-slate-500 font-normal">({{ $ao->usia_pasien ?? '-' }} Thn)</span></h3>
                    </div>

                    <!-- Rute Jemput -> Tujuan -->
                    <div class="p-3 rounded-lg bg-slate-50 border border-slate-100 text-xs space-y-2">
                        <div class="flex items-start gap-2">
                            <svg class="w-3.5 h-3.5 text-sky-600 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/></svg>
                            <div>
                                <span class="text-slate-400 text-[10px] uppercase font-bold block">Penjemputan</span>
                                <span class="font-semibold text-slate-800">{{ $ao->lokasi_jemput }}</span>
                            </div>
                        </div>
                        <div class="flex items-start gap-2 pt-1 border-t border-slate-100">
                            <svg class="w-3.5 h-3.5 text-emerald-600 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                            <div>
                                <span class="text-slate-400 text-[10px] uppercase font-bold block">Tujuan Rumah Sakit</span>
                                <span class="font-semibold text-slate-800">{{ $ao->tujuan_lokasi ?? $ao->rumahSakit?->nama ?? 'Ditentukan Operator' }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Info Operasional & Aksi -->
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 pt-2">
                        <div class="flex items-center gap-2 text-xs text-slate-600">
                            <span class="px-2 py-0.5 rounded bg-slate-100 text-slate-700 font-semibold">{{ $ao->keperluan_penggunaan ?: 'IGD Darurat' }}</span>
                            <span class="font-bold text-slate-800">{{ $ao->distance_text }}</span>
                        </div>

                        <div class="flex items-center gap-2">
                            <button type="button" @click="selectOrder({
                                        id: {{ $ao->id }},
                                        jemputLat: {{ $ao->jemput_lat }},
                                        jemputLng: {{ $ao->jemput_lng }},
                                        tujuanLat: {{ $ao->tujuan_lat ?: ($ao->rumahSakit?->lat ?? 0) }},
                                        tujuanLng: {{ $ao->tujuan_lng ?: ($ao->rumahSakit?->lng ?? 0) }},
                                        nama: '{{ addslashes($ao->nama_pasien) }}',
                                        jemput: '{{ addslashes($ao->lokasi_jemput) }}',
                                        tujuan: '{{ addslashes($ao->tujuan_lokasi ?? $ao->rumahSakit?->nama ?? '') }}'
                                    })"
                                    class="px-3 py-2 rounded-lg text-xs font-semibold text-slate-700 bg-slate-100 hover:bg-slate-200 transition-colors">
                                Peta Rute
                            </button>
                            <button type="button" wire:click="openDetailModal({{ $ao->id }})"
                               class="px-3 py-2 rounded-lg text-xs font-semibold text-slate-700 border border-slate-200 hover:bg-slate-50 transition-colors">
                                Detail
                            </button>
                            <button type="button" wire:click="acceptOrder({{ $ao->id }})"
                                    class="px-4 py-2 rounded-lg text-xs font-bold bg-emerald-600 hover:bg-emerald-700 text-white shadow-xs transition-colors flex items-center gap-1.5">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                                <span>Terima Tugas</span>
                            </button>
                            <button type="button" wire:click="rejectOrder({{ $ao->id }})" wire:confirm="Yakin ingin menolak penugasan ini?"
                                    class="px-2.5 py-2 rounded-lg text-xs font-semibold text-red-600 hover:bg-red-50 transition-colors">
                                Tolak
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach

            <!-- B. Permintaan Darurat Terbuka (Belum Diambil) -->
            @foreach($openOrders as $op)
                <div class="bg-white rounded-xl border border-slate-200 hover:border-teal-400 p-5 shadow-xs transition-all space-y-3">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-2">
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-[11px] font-bold {{ $op->prioritas_badge_classes }}">
                                <span class="w-1.5 h-1.5 rounded-full {{ $op->prioritas_dot_classes }}"></span>
                                <span>PRIORITAS {{ strtoupper($op->prioritas) }}</span>
                            </span>
                            <span class="text-xs text-slate-400 font-medium">{{ $op->created_at ? $op->created_at->diffForHumans() : '-' }}</span>
                        </div>
                        <span class="font-mono text-xs text-slate-400 font-semibold">#{{ $op->kode_order }}</span>
                    </div>

                    <div>
                        <h3 class="text-base font-bold text-slate-900">{{ $op->nama_pasien }} <span class="text-xs text-slate-500 font-normal">({{ $op->usia_pasien ?? '-' }} Thn)</span></h3>
                    </div>

                    <!-- Rute Jemput -> Tujuan -->
                    <div class="p-3 rounded-lg bg-slate-50 border border-slate-100 text-xs space-y-2">
                        <div class="flex items-start gap-2">
                            <svg class="w-3.5 h-3.5 text-sky-600 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/></svg>
                            <div>
                                <span class="text-slate-400 text-[10px] uppercase font-bold block">Penjemputan</span>
                                <span class="font-semibold text-slate-800">{{ $op->lokasi_jemput }}</span>
                            </div>
                        </div>
                        <div class="flex items-start gap-2 pt-1 border-t border-slate-100">
                            <svg class="w-3.5 h-3.5 text-emerald-600 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                            <div>
                                <span class="text-slate-400 text-[10px] uppercase font-bold block">Tujuan Rumah Sakit</span>
                                <span class="font-semibold text-slate-800">{{ $op->tujuan_lokasi ?? $op->rumahSakit?->nama ?? 'Ditentukan Operator' }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Info Operasional & Aksi -->
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 pt-2">
                        <div class="flex items-center gap-2 text-xs text-slate-600">
                            <span class="px-2 py-0.5 rounded bg-slate-100 text-slate-700 font-semibold">{{ $op->keperluan_penggunaan ?: 'IGD Darurat' }}</span>
                            <span class="font-bold text-slate-800">{{ $op->distance_text }}</span>
                        </div>

                        <div class="flex items-center gap-2">
                            <button type="button" @click="selectOrder({
                                        id: {{ $op->id }},
                                        jemputLat: {{ $op->jemput_lat }},
                                        jemputLng: {{ $op->jemput_lng }},
                                        tujuanLat: {{ $op->tujuan_lat ?: ($op->rumahSakit?->lat ?? 0) }},
                                        tujuanLng: {{ $op->tujuan_lng ?: ($op->rumahSakit?->lng ?? 0) }},
                                        nama: '{{ addslashes($op->nama_pasien) }}',
                                        jemput: '{{ addslashes($op->lokasi_jemput) }}',
                                        tujuan: '{{ addslashes($op->tujuan_lokasi ?? $op->rumahSakit?->nama ?? '') }}'
                                    })"
                                    class="px-3 py-2 rounded-lg text-xs font-semibold text-slate-700 bg-slate-100 hover:bg-slate-200 transition-colors">
                                Peta Rute
                            </button>
                            <button type="button" wire:click="openDetailModal({{ $op->id }})"
                               class="px-3 py-2 rounded-lg text-xs font-semibold text-slate-700 border border-slate-200 hover:bg-slate-50 transition-colors">
                                Detail
                            </button>
                            <button type="button" wire:click="takeOrder({{ $op->id }})"
                                    class="px-5 py-2 rounded-lg text-xs font-bold bg-teal-700 hover:bg-teal-800 text-white shadow-xs transition-colors flex items-center gap-1.5">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                                <span>Ambil Tugas</span>
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach

            <!-- Empty State -->
            @if(count($assignedOrders) === 0 && count($openOrders) === 0)
                <div class="bg-white rounded-xl border border-slate-200 p-8 text-center space-y-3">
                    <div class="w-12 h-12 rounded-xl bg-slate-100 text-slate-400 flex items-center justify-center mx-auto">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                    </div>
                    <div class="space-y-1">
                        <h4 class="text-sm font-bold text-slate-800">Tidak Ada Antrean Tugas</h4>
                        <p class="text-xs text-slate-500 max-w-sm mx-auto">
                            Semua permintaan ambulans darurat telah tertangani. Sistem akan otomatis memunculkan tugas baru saat ada panggilan evakuasi.
                        </p>
                    </div>
                </div>
            @endif

        </div>

        <!-- Right Column: Interactive Dispatch Map (5 Cols) -->
        <div class="lg:col-span-5 flex flex-col lg:sticky lg:top-24 self-start" wire:ignore>
            <div class="bg-white rounded-xl border border-slate-200 p-4 sm:p-5 shadow-xs flex-1 flex flex-col min-h-[500px]">
                
                <div class="flex items-center justify-between mb-3 pb-2 border-b border-slate-100">
                    <div>
                        <h3 class="text-sm font-bold text-slate-900">Peta Rute Tugas Terpilih</h3>
                        <p class="text-[11px] text-slate-500" x-text="selectedOrderName ? 'Pasien: ' + selectedOrderName : 'Pilih tugas untuk melihat estimasi rute'"></p>
                    </div>
                    <button type="button" @click="fitMarkers()"
                            class="px-2.5 py-1 rounded-lg text-xs font-semibold bg-slate-100 hover:bg-slate-200 text-slate-700 transition-colors">
                        Fokus Peta
                    </button>
                </div>

                <div class="relative w-full h-full min-h-[400px] rounded-2xl border border-slate-200/90 shadow-xs overflow-hidden z-10">
                    <div id="driver-dispatch-map" class="w-full h-full min-h-[400px]"></div>

                    <div x-show="routeSummary" x-transition:enter="transition ease-out duration-300"
                         class="absolute top-3 left-3 right-3 sm:right-auto sm:max-w-xs z-[1000] bg-white/95 backdrop-blur-md p-3 rounded-2xl border border-slate-100 shadow-xl">
                        <div class="flex items-center gap-1.5 sm:gap-2">
                            <span class="text-xs sm:text-sm font-extrabold text-slate-900" x-text="routeEta"></span>
                            <span class="text-[10px] sm:text-xs font-bold text-primary-800 bg-primary-100 px-2 py-0.5 rounded-full" x-text="routeDistance"></span>
                        </div>
                        <p class="text-[10px] sm:text-[11px] text-slate-500 font-medium truncate mt-0.5" x-text="routeSummary"></p>
                    </div>
                </div>

                <!-- Legend & Panduan Simbol (Standardized with Masyarakat) -->
                <div class="mt-3 p-3 rounded-xl bg-slate-50 border border-slate-100 flex flex-wrap items-center justify-between gap-2.5 text-[11px]">
                    <div class="flex items-center gap-3 flex-wrap">
                        <div class="flex items-center gap-1.5 font-bold text-slate-700">
                            <span class="w-2.5 h-2.5 rounded-full bg-[#0891B2] inline-block flex-shrink-0"></span>
                            <span>Ambulans Siaga</span>
                        </div>
                        <div class="flex items-center gap-1.5 font-bold text-slate-700">
                            <span class="w-2.5 h-2.5 rounded-full bg-[#EF4444] inline-block flex-shrink-0 animate-pulse"></span>
                            <span>Titik Jemput Pasien</span>
                        </div>
                        <div class="flex items-center gap-1.5 font-bold text-slate-700">
                            <span class="w-2.5 h-2.5 rounded-full bg-[#10B981] inline-block flex-shrink-0 animate-pulse"></span>
                            <span>Rumah Sakit</span>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>

    <!-- Modal Detail Pesanan & Foto Verifikasi Pasien -->
    @if($showDetailModal && $selectedDetailOrder)
        <div class="fixed inset-0 z-[100] overflow-y-auto bg-slate-900/80 backdrop-blur-sm p-3 sm:p-6 flex items-center justify-center min-h-screen py-8 sm:py-12 animate-fade-in"
             x-data="{ showLightbox: false }">
            <div class="bg-white rounded-3xl max-w-2xl w-full shadow-2xl border border-slate-100 overflow-hidden relative z-[101] my-auto max-h-[88vh] flex flex-col"
                 @click.outside="$wire.closeDetailModal()">
                
                <!-- Modal Header -->
                <div class="px-5 sm:px-6 py-4 border-b border-slate-100 bg-slate-50/90 flex items-center justify-between gap-3 shrink-0">
                    <div class="flex items-center gap-2.5 min-w-0">
                        <span class="w-2.5 h-2.5 rounded-full bg-teal-600 animate-pulse shrink-0"></span>
                        <div class="min-w-0">
                            <span class="text-[11px] font-bold text-slate-500 uppercase tracking-wider block">Verifikasi & Detail Pasien</span>
                            <h3 class="font-extrabold text-slate-800 text-base sm:text-lg leading-tight font-mono truncate">
                                #{{ $selectedDetailOrder->kode_order }}
                            </h3>
                        </div>
                    </div>
                    <div class="flex items-center gap-2 shrink-0">
                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-extrabold {{ $selectedDetailOrder->prioritas_badge_classes }}">
                            PRIORITAS {{ strtoupper($selectedDetailOrder->prioritas) }}
                        </span>
                        <button type="button" wire:click="closeDetailModal"
                                class="w-8 h-8 rounded-full bg-slate-200/80 hover:bg-slate-300 text-slate-600 flex items-center justify-center transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                        </button>
                    </div>
                </div>

                <!-- Modal Body (Scrollable) -->
                <div class="p-5 sm:p-6 space-y-5 overflow-y-auto text-xs text-slate-700">
                    
                    <!-- Foto Verifikasi / Bukti Darurat -->
                    <div>
                        <span class="text-[11px] font-extrabold text-slate-500 uppercase tracking-wider block mb-2">
                            📸 Foto Kondisi Pasien / Lokasi Penjemputan (Autentikasi GPS)
                        </span>
                        
                        @if($selectedDetailOrder->photo_path)
                            <div class="relative rounded-2xl overflow-hidden border border-slate-200 bg-slate-900 group cursor-pointer shadow-inner"
                                 @click="showLightbox = true"
                                 x-data="{ imgLoaded: false, imgError: false }">
                                
                                <!-- Loading skeleton -->
                                <div x-show="!imgLoaded && !imgError" class="w-full h-56 sm:h-64 bg-slate-800 animate-pulse flex items-center justify-center text-slate-400 text-xs">
                                    <div class="flex items-center gap-2">
                                        <svg class="w-5 h-5 animate-spin text-teal-400" fill="none" viewBox="0 0 24 24">
                                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path>
                                        </svg>
                                        <span>Memuat foto pasien...</span>
                                    </div>
                                </div>

                                <img src="{{ $selectedDetailOrder->photo_url ?? asset('storage/' . $selectedDetailOrder->photo_path) }}" 
                                     alt="Foto Pasien & Lokasi" 
                                     class="w-full h-56 sm:h-64 object-cover object-center group-hover:scale-105 transition-transform duration-300"
                                     x-show="!imgError"
                                     x-on:load="imgLoaded = true"
                                     x-on:error="imgError = true; imgLoaded = false">
                                
                                <!-- Fallback jika gambar error/tidak ditemukan -->
                                <div x-show="imgError" class="w-full h-56 sm:h-64 bg-slate-800 flex flex-col items-center justify-center p-4 text-center text-slate-300 space-y-2">
                                    <span class="text-2xl">⚠️</span>
                                    <p class="font-bold text-xs">Berkas Foto Tidak Ditemukan</p>
                                    <p class="text-[11px] text-slate-400 font-mono">{{ $selectedDetailOrder->photo_path }}</p>
                                </div>
                                
                                <div class="absolute inset-0 bg-gradient-to-t from-slate-950/85 via-slate-950/20 to-transparent flex items-end justify-between p-3.5 text-white pointer-events-none">
                                    <div class="space-y-0.5">
                                        <div class="flex items-center gap-1.5 text-[11px] font-bold">
                                            <svg class="w-3.5 h-3.5 text-emerald-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                            <span class="text-emerald-300">Foto Terverifikasi Geotagging</span>
                                        </div>
                                        <p class="text-[10px] text-slate-200 truncate max-w-[280px] sm:max-w-md">
                                            {{ $selectedDetailOrder->photo_address ?: $selectedDetailOrder->lokasi_jemput }}
                                        </p>
                                    </div>
                                    <span class="px-2.5 py-1 rounded-lg bg-black/40 backdrop-blur-md text-[10px] font-bold border border-white/30 flex items-center gap-1 shrink-0 text-white pointer-events-auto">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"/></svg>
                                        <span>Perbesar</span>
                                    </span>
                                </div>
                            </div>
                        @else
                            <div class="rounded-2xl border-2 border-dashed border-slate-200 bg-slate-50 p-6 text-center space-y-1.5">
                                <div class="w-10 h-10 rounded-full bg-slate-100 text-slate-400 flex items-center justify-center mx-auto text-lg">
                                    📷
                                </div>
                                <p class="font-bold text-slate-600">Foto Tidak Dilampirkan</p>
                                <p class="text-[11px] text-slate-400">Pemesan membuat pesanan tanpa unggahan kamera langsung.</p>
                            </div>
                        @endif
                    </div>

                    <!-- Informasi Pasien -->
                    <div class="bg-slate-50 rounded-2xl p-4 border border-slate-100 space-y-3">
                        <div class="grid grid-cols-2 sm:grid-cols-4 gap-3">
                            <div>
                                <span class="text-slate-400 text-[10px] uppercase font-bold block">Nama Pasien</span>
                                <span class="font-bold text-slate-800 text-sm">{{ $selectedDetailOrder->nama_pasien }}</span>
                            </div>
                            <div>
                                <span class="text-slate-400 text-[10px] uppercase font-bold block">Usia Pasien</span>
                                <span class="font-bold text-slate-800 text-sm">{{ $selectedDetailOrder->usia_pasien ?? '-' }} Thn</span>
                            </div>
                            <div>
                                <span class="text-slate-400 text-[10px] uppercase font-bold block">No. Kontak / WA</span>
                                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $selectedDetailOrder->no_hp_kontak) }}" target="_blank"
                                   class="font-bold text-emerald-600 hover:underline flex items-center gap-1">
                                    <span>{{ $selectedDetailOrder->no_hp_kontak }}</span>
                                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981z"/></svg>
                                </a>
                            </div>
                            <div>
                                <span class="text-slate-400 text-[10px] uppercase font-bold block">Pendamping</span>
                                <span class="font-bold text-slate-800 text-sm">{{ $selectedDetailOrder->jumlah_pendamping ?? 1 }} Orang</span>
                            </div>
                        </div>

                        <!-- Kondisi & Keperluan Medis -->
                        <div class="pt-2 border-t border-slate-200/60 space-y-1.5">
                            <span class="text-slate-400 text-[10px] uppercase font-bold block">Keperluan & Kondisi Medis Pasien</span>
                            <div class="p-3 rounded-xl bg-red-50 border border-red-100 text-red-900 font-semibold leading-relaxed">
                                <span class="inline-block px-2 py-0.5 rounded bg-red-200 text-red-800 font-extrabold text-[10px] mr-1.5 uppercase">
                                    {{ $selectedDetailOrder->keperluan_penggunaan ?: 'IGD Darurat' }}
                                </span>
                                {{ $selectedDetailOrder->kondisi_pasien ?: ($selectedDetailOrder->diagnosa_medis ?: 'Pasien memerlukan tindakan evakuasi medis darurat segera.') }}
                            </div>
                        </div>

                        @if($selectedDetailOrder->catatan_tambahan)
                            <div class="pt-1">
                                <span class="text-slate-400 text-[10px] uppercase font-bold block">Catatan Khusus Pemesan</span>
                                <p class="text-slate-700 italic bg-white p-2.5 rounded-lg border border-slate-200 mt-1">
                                    &ldquo;{{ $selectedDetailOrder->catatan_tambahan }}&rdquo;
                                </p>
                            </div>
                        @endif
                    </div>

                    <!-- Rute Titik Jemput & RS -->
                    <div class="space-y-2">
                        <span class="text-[11px] font-extrabold text-slate-500 uppercase tracking-wider block">
                            📍 Rencana Jalur Evakuasi
                        </span>
                        <div class="p-3.5 rounded-2xl bg-white border border-slate-200 space-y-3 shadow-xs">
                            <div class="flex items-start gap-2.5">
                                <div class="w-6 h-6 rounded-full bg-sky-100 text-sky-700 flex items-center justify-center font-bold text-xs shrink-0 mt-0.5">
                                    📍
                                </div>
                                <div>
                                    <span class="text-slate-400 text-[10px] uppercase font-bold block">Alamat Titik Penjemputan</span>
                                    <span class="font-bold text-slate-800">{{ $selectedDetailOrder->lokasi_jemput }}</span>
                                </div>
                            </div>
                            <div class="flex items-start gap-2.5 pt-2 border-t border-slate-100">
                                <div class="w-6 h-6 rounded-full bg-emerald-100 text-emerald-700 flex items-center justify-center font-bold text-xs shrink-0 mt-0.5">
                                    🏥
                                </div>
                                <div>
                                    <span class="text-slate-400 text-[10px] uppercase font-bold block">Rumah Sakit Rujukan / Tujuan</span>
                                    <span class="font-bold text-emerald-800">{{ $selectedDetailOrder->tujuan_lokasi ?? $selectedDetailOrder->rumahSakit?->nama ?? 'Ditentukan Operator' }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- Modal Footer -->
                <div class="px-5 sm:px-6 py-4 border-t border-slate-100 bg-slate-50/90 flex items-center justify-end gap-3 shrink-0">
                    <button type="button" wire:click="closeDetailModal"
                            class="px-5 py-2.5 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold text-xs transition-colors">
                        Tutup
                    </button>

                    @if($selectedDetailOrder->status === 'menunggu' && !$selectedDetailOrder->supir_id)
                        <button type="button" wire:click="takeOrder({{ $selectedDetailOrder->id }})"
                                class="px-6 py-2.5 rounded-xl bg-teal-700 hover:bg-teal-800 text-white font-extrabold text-xs shadow-md shadow-teal-700/20 transition-all flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                            <span>✓ Ambil Tugas Penjemputan Ini</span>
                        </button>
                    @elseif($selectedDetailOrder->status === 'menunggu_konfirmasi_supir')
                        <button type="button" wire:click="rejectOrder({{ $selectedDetailOrder->id }})" wire:confirm="Yakin ingin menolak penugasan ini?"
                                class="px-4 py-2.5 rounded-xl text-xs font-bold text-red-600 hover:bg-red-50 transition-colors">
                            Tolak
                        </button>
                        <button type="button" wire:click="acceptOrder({{ $selectedDetailOrder->id }})"
                                class="px-6 py-2.5 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-extrabold text-xs shadow-md shadow-emerald-600/20 transition-all flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                            <span>✓ Terima Tugas</span>
                        </button>
                    @endif
                </div>

            </div>

            <!-- Lightbox Zoom Modal -->
            @if($selectedDetailOrder->photo_path)
                <div x-show="showLightbox" 
                     x-transition:enter="transition ease-out duration-200"
                     x-transition:enter-start="opacity-0"
                     x-transition:enter-end="opacity-100"
                     x-transition:leave="transition ease-in duration-150"
                     x-transition:leave-start="opacity-100"
                     x-transition:leave-end="opacity-0"
                     class="fixed inset-0 z-[20000] bg-black/95 backdrop-blur-md flex items-center justify-center p-4"
                     @click="showLightbox = false"
                     style="display: none;">
                    <button type="button" @click="showLightbox = false"
                            class="absolute top-5 right-5 text-white bg-white/20 hover:bg-white/30 rounded-full p-2.5 transition-colors z-10">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                    <div class="max-w-4xl max-h-[90vh] flex flex-col items-center">
                        <img src="{{ $selectedDetailOrder->photo_url ?? asset('storage/' . $selectedDetailOrder->photo_path) }}" 
                             alt="Foto Pembesaran Pasien" 
                             class="max-w-full max-h-[82vh] rounded-2xl object-contain shadow-2xl border border-white/10"
                             @click.stop="">
                        @if($selectedDetailOrder->photo_address)
                            <div class="mt-2.5 px-4 py-1.5 rounded-full bg-white/10 backdrop-blur-md border border-white/20 text-white text-xs text-center truncate max-w-lg">
                                📍 {{ $selectedDetailOrder->photo_address }}
                            </div>
                        @endif
                    </div>
                </div>
            @endif
        </div>
    @endif

    <!-- Leaflet Script for Driver Dispatch Console -->
    <script>
        function driverDispatchConsole(driverLat, driverLng, initJemputLat, initJemputLng, initRsLat, initRsLng, initNama, initJemput, initTujuan) {
            return {
                map: null,
                driverMarker: null,
                jemputMarker: null,
                rsMarker: null,
                routePolyline: null,
                selectedOrderName: initNama || '',
                routeDistance: '',
                routeEta: '',
                routeSummary: '',

                initMap() {
                    this.$nextTick(() => {
                        const defaultLat = driverLat || -7.7188;
                        const defaultLng = driverLng || 109.0159;

                        this.map = L.map('driver-dispatch-map', {
                            zoomControl: true,
                            attributionControl: false
                        }).setView([defaultLat, defaultLng], 13);

                        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
                            maxZoom: 19
                        }).addTo(this.map);

                        const ambIcon = L.divIcon({
                            className: 'custom-driver-amb-icon',
                            html: `<div style="background:#0F2742; width:30px; height:30px; border-radius:50%; border:2px solid white; box-shadow:0 2px 6px rgba(0,0,0,0.3); display:flex; align-items:center; justify-content:center; color:white; font-weight:bold; font-size:12px;">🚑</div>`,
                            iconSize: [30, 30],
                            iconAnchor: [15, 15]
                        });

                        if (typeof window.createLeafletAmbulance3DMarker === 'function') {
                            this.driverMarker = window.createLeafletAmbulance3DMarker(this.map, defaultLat, defaultLng, {
                                size: 58,
                                autoSpin: false,
                                destLat: initJemputLat || null,
                                destLng: initJemputLng || null
                            }).bindPopup('<b>Posisi Ambulans Anda</b><br>Terpantau GPS Realtime');
                        } else {
                            this.driverMarker = L.marker([defaultLat, defaultLng], {
                                icon: ambIcon,
                                title: 'Posisi Anda'
                            }).addTo(this.map).bindPopup('<b>Posisi Ambulans Anda</b>');
                        }

                        if (initJemputLat && initJemputLng && initJemputLat !== 0) {
                            this.selectOrder({
                                id: 0,
                                jemputLat: initJemputLat,
                                jemputLng: initJemputLng,
                                tujuanLat: initRsLat,
                                tujuanLng: initRsLng,
                                nama: initNama,
                                jemput: initJemput,
                                tujuan: initTujuan
                            });
                        }
                    });
                },

                async selectOrder(orderData) {
                    this.selectedOrderName = orderData.nama;

                    if (this.jemputMarker) {
                        this.map.removeLayer(this.jemputMarker);
                        this.jemputMarker = null;
                    }
                    if (this.rsMarker) {
                        this.map.removeLayer(this.rsMarker);
                        this.rsMarker = null;
                    }
                    if (this.routePolyline) {
                        this.map.removeLayer(this.routePolyline);
                        this.routePolyline = null;
                    }

                    const jemputIcon = (typeof window.getPatientPin3DIcon === 'function')
                        ? window.getPatientPin3DIcon({ size: 28 })
                        : L.divIcon({
                            className: 'custom-jemput-icon',
                            html: `<div style="background:#EF4444; width:28px; height:28px; border-radius:50%; border:2px solid white; box-shadow:0 2px 6px rgba(239,68,68,0.4); display:flex; align-items:center; justify-content:center; color:white; font-size:12px;">📍</div>`,
                            iconSize: [28, 28],
                            iconAnchor: [14, 28]
                        });

                    this.jemputMarker = L.marker([orderData.jemputLat, orderData.jemputLng], {
                        icon: jemputIcon,
                        zIndexOffset: 1000
                    }).addTo(this.map).bindPopup(`<b>Titik Jemput: ${orderData.nama}</b><br><span style="font-size:11px;">${orderData.jemput}</span>`).openPopup();

                    if (orderData.tujuanLat && orderData.tujuanLng && orderData.tujuanLat !== 0) {
                        const rsIcon = (typeof window.getHospital3DIcon === 'function')
                            ? window.getHospital3DIcon({ size: 50 })
                            : L.divIcon({
                                className: 'custom-rs-icon',
                                html: `<div style="background:#16A36A; width:28px; height:28px; border-radius:50%; border:2px solid white; box-shadow:0 2px 6px rgba(22,163,106,0.4); display:flex; align-items:center; justify-content:center; color:white; font-size:12px;">🏥</div>`,
                                iconSize: [28, 28],
                                iconAnchor: [14, 28]
                            });

                        this.rsMarker = L.marker([orderData.tujuanLat, orderData.tujuanLng], {
                            icon: rsIcon,
                            zIndexOffset: 950
                        }).addTo(this.map).bindPopup(`<b>Tujuan: ${orderData.tujuan}</b>`);
                    }

                    try {
                        const start = this.driverMarker ? this.driverMarker.getLatLng() : { lat: orderData.jemputLat, lng: orderData.jemputLng };
                        const url = `https://router.project-osrm.org/route/v1/driving/${start.lng},${start.lat};${orderData.jemputLng},${orderData.jemputLat}?overview=full&geometries=geojson&steps=true`;
                        const res = await fetch(url);
                        const data = await res.json();

                        if (data.code === 'Ok' && data.routes && data.routes.length > 0) {
                            const route = data.routes[0];
                            const coords = route.geometry.coordinates.map(c => [c[1], c[0]]);

                            this.routePolyline = L.polyline(coords, {
                                color: '#0891B2',
                                weight: 5.5,
                                opacity: 0.95,
                                lineCap: 'round',
                                lineJoin: 'round'
                            }).addTo(this.map);

                            this.routeDistance = (route.distance / 1000).toFixed(1) + ' km';
                            this.routeEta = Math.max(1, Math.ceil(route.duration / 60)) + ' Menit';
                            this.routeSummary = (route.legs && route.legs[0] && route.legs[0].summary) ? route.legs[0].summary : 'Jalan Utama';

                            // Arahkan moncong ambulans 3D persis menyusuri rute jalan!
                            if (coords && coords.length >= 2) {
                                const alignCar = () => {
                                    if (this.driverMarker && this.driverMarker.engine3D) {
                                        this.driverMarker.engine3D.setHeadingAlongRoad(
                                            coords[0][0], coords[0][1],
                                            coords[1][0], coords[1][1]
                                        );
                                    }
                                };
                                alignCar();
                                setTimeout(alignCar, 150);
                            }
                        }
                    } catch (e) {
                        this.routePolyline = L.polyline([
                            this.driverMarker ? this.driverMarker.getLatLng() : [orderData.jemputLat, orderData.jemputLng],
                            [orderData.jemputLat, orderData.jemputLng]
                        ], {
                            color: '#00838F',
                            weight: 3.5,
                            dashArray: '6, 6'
                        }).addTo(this.map);
                    }

                    this.fitMarkers();
                },

                fitMarkers() {
                    const bounds = L.latLngBounds([]);
                    if (this.driverMarker) bounds.extend(this.driverMarker.getLatLng());
                    if (this.jemputMarker) bounds.extend(this.jemputMarker.getLatLng());
                    if (this.rsMarker) bounds.extend(this.rsMarker.getLatLng());

                    if (bounds.isValid()) {
                        this.map.fitBounds(bounds, { padding: [40, 40], maxZoom: 15 });
                    }
                }
            }
        }
    </script>
</div>
