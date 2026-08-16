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
                Driver: <strong class="text-slate-700">{{ auth()->user()->name }}</strong> • Armada: <strong class="text-slate-700">{{ $supir?->ambulans?->kode_ambulans ?? 'Unit Ambulans' }} ({{ $supir?->plat_nomor ?? $supir?->ambulans?->plat_nomor ?? '-' }})</strong>
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
                            <a href="{{ route('supir.tugas.detail', $ao->id) }}"
                               class="px-3 py-2 rounded-lg text-xs font-semibold text-slate-700 border border-slate-200 hover:bg-slate-50 transition-colors">
                                Detail
                            </a>
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
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-[11px] font-bold bg-red-50 text-red-700 border border-red-200">
                                <span class="w-1.5 h-1.5 rounded-full bg-red-600"></span>
                                <span>PRIORITAS TINGGI</span>
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
                            <a href="{{ route('supir.tugas.detail', $op->id) }}"
                               class="px-3 py-2 rounded-lg text-xs font-semibold text-slate-700 border border-slate-200 hover:bg-slate-50 transition-colors">
                                Detail
                            </a>
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

                <div class="relative w-full h-full min-h-[400px] rounded-lg border border-slate-200 overflow-hidden z-10">
                    <div id="driver-dispatch-map" class="w-full h-full min-h-[400px]"></div>

                    <div x-show="routeSummary" x-transition
                         class="absolute top-3 left-3 right-3 sm:right-auto sm:max-w-xs z-[1000] bg-white/95 backdrop-blur-xs p-3 rounded-lg border border-slate-200 shadow-md">
                        <div class="flex items-center gap-1.5">
                            <span class="text-xs font-bold text-slate-900" x-text="routeEta"></span>
                            <span class="text-[10px] font-bold text-teal-700 bg-teal-50 px-2 py-0.5 rounded-full border border-teal-100" x-text="routeDistance"></span>
                        </div>
                        <p class="text-[11px] text-slate-500 truncate mt-0.5" x-text="routeSummary"></p>
                    </div>
                </div>

            </div>
        </div>

    </div>

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
                            maxZoom: 19
                        }).addTo(this.map);

                        const ambIcon = L.divIcon({
                            className: 'custom-driver-amb-icon',
                            html: `<div style="background:#0F2742; width:30px; height:30px; border-radius:50%; border:2px solid white; box-shadow:0 2px 6px rgba(0,0,0,0.3); display:flex; align-items:center; justify-content:center; color:white; font-weight:bold; font-size:12px;">🚑</div>`,
                            iconSize: [30, 30],
                            iconAnchor: [15, 15]
                        });

                        this.driverMarker = L.marker([defaultLat, defaultLng], {
                            icon: ambIcon,
                            title: 'Posisi Anda'
                        }).addTo(this.map).bindPopup('<b>Posisi Ambulans Anda</b>');

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

                    const jemputIcon = L.divIcon({
                        className: 'custom-jemput-icon',
                        html: `<div style="background:#0284C7; width:28px; height:28px; border-radius:50%; border:2px solid white; box-shadow:0 2px 6px rgba(2,132,199,0.4); display:flex; align-items:center; justify-content:center; color:white; font-size:12px;">📍</div>`,
                        iconSize: [28, 28],
                        iconAnchor: [14, 28]
                    });

                    this.jemputMarker = L.marker([orderData.jemputLat, orderData.jemputLng], {
                        icon: jemputIcon
                    }).addTo(this.map).bindPopup(`<b>Titik Jemput: ${orderData.nama}</b><br><span style="font-size:11px;">${orderData.jemput}</span>`).openPopup();

                    if (orderData.tujuanLat && orderData.tujuanLng && orderData.tujuanLat !== 0) {
                        const rsIcon = L.divIcon({
                            className: 'custom-rs-icon',
                            html: `<div style="background:#16A36A; width:28px; height:28px; border-radius:50%; border:2px solid white; box-shadow:0 2px 6px rgba(22,163,106,0.4); display:flex; align-items:center; justify-content:center; color:white; font-size:12px;">🏥</div>`,
                            iconSize: [28, 28],
                            iconAnchor: [14, 28]
                        });

                        this.rsMarker = L.marker([orderData.tujuanLat, orderData.tujuanLng], {
                            icon: rsIcon
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
                                color: '#00838F',
                                weight: 4.5,
                                opacity: 0.9,
                                lineCap: 'round',
                                lineJoin: 'round'
                            }).addTo(this.map);

                            this.routeDistance = (route.distance / 1000).toFixed(1) + ' km';
                            this.routeEta = Math.max(1, Math.ceil(route.duration / 60)) + ' Menit';
                            this.routeSummary = (route.legs && route.legs[0] && route.legs[0].summary) ? route.legs[0].summary : 'Jalan Utama';
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
