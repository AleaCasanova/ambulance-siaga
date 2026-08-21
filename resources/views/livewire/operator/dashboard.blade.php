<div wire:poll.5s>
    <!-- Header Page -->
    <div class="mb-8 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-sky-100 text-sky-700 uppercase tracking-wider mb-2">
                <span class="w-2 h-2 rounded-full bg-sky-600 animate-ping"></span>
                Pusat Kendali Ambulans Siaga
            </span>
            <h1 class="text-2xl sm:text-3xl font-extrabold text-slate-800 tracking-tight">Dashboard Operator</h1>
            <p class="text-slate-500 text-sm mt-1">Pantau pesanan darurat masuk dan tugaskan armada ambulans tercepat di wilayah Cilacap.</p>
        </div>

        <div class="flex items-center gap-3">
            <a href="{{ route('operator.monitoring') }}"
               class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-slate-900 hover:bg-sky-600 text-white font-bold text-sm shadow-md transition-all">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"/>
                </svg>
                <span>Peta Layar Penuh</span>
            </a>
            <a href="{{ route('operator.orders.index') }}"
               class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-white border border-slate-300 text-slate-700 text-sm font-semibold hover:bg-slate-50 transition-colors">
                <span>Semua Order</span>
            </a>
        </div>
    </div>

    <!-- 4 Statistik Utama -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- 1. Menunggu -->
        <div class="p-6 rounded-3xl bg-white border border-slate-200/80 shadow-xs flex items-center justify-between">
            <div>
                <span class="text-xs font-bold text-amber-600 uppercase tracking-wider block mb-1">Menunggu Penugasan</span>
                <span class="text-3xl font-black text-slate-800">{{ $stats['menunggu'] }}</span>
                <span class="text-xs text-slate-400 block mt-1">Pesanan baru masuk</span>
            </div>
            <div class="w-14 h-14 rounded-2xl bg-amber-50 text-amber-600 flex items-center justify-center font-bold border border-amber-100">
                <svg class="w-7 h-7 animate-bounce" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                </svg>
            </div>
        </div>

        <!-- 2. Order Aktif -->
        <div class="p-6 rounded-3xl bg-white border border-slate-200/80 shadow-xs flex items-center justify-between">
            <div>
                <span class="text-xs font-bold text-sky-600 uppercase tracking-wider block mb-1">Ambulans Bertugas</span>
                <span class="text-3xl font-black text-slate-800">{{ $stats['aktif'] }}</span>
                <span class="text-xs text-slate-400 block mt-1">Sedang dalam evakuasi</span>
            </div>
            <div class="w-14 h-14 rounded-2xl bg-sky-50 text-sky-600 flex items-center justify-center font-bold border border-sky-100">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                </svg>
            </div>
        </div>

        <!-- 3. Ambulans Tersedia -->
        <div class="p-6 rounded-3xl bg-white border border-slate-200/80 shadow-xs flex items-center justify-between">
            <div>
                <span class="text-xs font-bold text-emerald-600 uppercase tracking-wider block mb-1">Ambulans Siaga</span>
                <span class="text-3xl font-black text-slate-800">{{ $stats['amb_tersedia'] }}</span>
                <span class="text-xs text-slate-400 block mt-1">Armada siap ditugaskan</span>
            </div>
            <div class="w-14 h-14 rounded-2xl bg-emerald-50 text-emerald-600 flex items-center justify-center font-bold border border-emerald-100">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
        </div>

        <!-- 4. Supir Online -->
        <div class="p-6 rounded-3xl bg-white border border-slate-200/80 shadow-xs flex items-center justify-between">
            <div>
                <span class="text-xs font-bold text-primary-600 uppercase tracking-wider block mb-1">Supir Online</span>
                <span class="text-3xl font-black text-slate-800">{{ $stats['supir_online'] }}</span>
                <span class="text-xs text-slate-400 block mt-1">Supir aktif di lapangan</span>
            </div>
            <div class="w-14 h-14 rounded-2xl bg-primary-50 text-primary-600 flex items-center justify-center font-bold border border-primary-100">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                </svg>
            </div>
        </div>
    </div>

    <!-- Main Grid: Pesanan Darurat Masuk (Left) & Live Map (Right) -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 mb-8"
         x-data="operatorDashboardMap(@js($mapMarkers))"
         x-init="initMap()"
         @map-markers-updated.window="updateMarkers($event.detail.markers)">

        <!-- Left Column: Pesanan Masuk & Order Aktif -->
        <div class="lg:col-span-5 space-y-6">

            <!-- Card: Order Darurat Menunggu Penugasan -->
            <div class="bg-white rounded-3xl border border-slate-200/80 p-6 shadow-xs">
                <div class="flex items-center justify-between mb-4 pb-3 border-b border-slate-100">
                    <div class="flex items-center gap-2">
                        <span class="w-2.5 h-2.5 rounded-full bg-amber-500 animate-ping"></span>
                        <h2 class="font-bold text-slate-800 text-base">Pesanan Darurat Masuk</h2>
                    </div>
                    <span class="px-2.5 py-0.5 rounded-full text-xs font-extrabold bg-amber-100 text-amber-800">
                        {{ $ordersMenunggu->count() }} Menunggu
                    </span>
                </div>

                <div class="space-y-4 max-h-[360px] overflow-y-auto">
                    @forelse($ordersMenunggu as $om)
                        @php
                            $cardColor = match($om->prioritas) {
                                'tinggi' => 'bg-red-50/80 border-red-200 hover:bg-red-50',
                                'sedang' => 'bg-amber-50/80 border-amber-200 hover:bg-amber-50',
                                'rendah' => 'bg-emerald-50/80 border-emerald-200 hover:bg-emerald-50',
                                default => 'bg-slate-50/80 border-slate-200 hover:bg-slate-50'
                            };
                            $textKodeColor = match($om->prioritas) {
                                'tinggi' => 'text-red-800',
                                'sedang' => 'text-amber-800',
                                'rendah' => 'text-emerald-800',
                                default => 'text-slate-800'
                            };
                            $iconColor = match($om->prioritas) {
                                'tinggi' => 'text-red-600',
                                'sedang' => 'text-amber-600',
                                'rendah' => 'text-emerald-600',
                                default => 'text-slate-600'
                            };
                        @endphp
                        <div class="p-4 rounded-2xl border transition-all {{ $cardColor }}">
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-xs font-black {{ $textKodeColor }}">{{ $om->kode_order }}</span>
                                <span class="text-[11px] text-slate-500">{{ $om->waktu_pesan ? $om->waktu_pesan->diffForHumans() : '-' }}</span>
                            </div>
                            <h3 class="font-bold text-slate-800 text-sm mb-1">{{ $om->nama_pasien }}</h3>
                            <p class="text-xs text-slate-600 leading-normal mb-2">{{ $om->kondisi_pasien }}</p>
                            <div class="flex items-center gap-1.5 text-xs text-slate-600 font-semibold mb-3">
                                <svg class="w-4 h-4 {{ $iconColor }} flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                </svg>
                                <span class="truncate">{{ $om->lokasi_jemput }}</span>
                            </div>

                            <div class="flex flex-col sm:flex-row gap-2 mt-1">
                                <select wire:change="updatePriority({{ $om->id }}, $event.target.value)" 
                                        class="flex-1 rounded-xl border border-white/60 bg-white/80 text-xs font-bold px-3 py-2 focus:ring-2 focus:ring-sky-200 outline-none shadow-xs text-slate-700">
                                    <option value="tinggi" {{ $om->prioritas == 'tinggi' ? 'selected' : '' }}>🚨 Tinggi</option>
                                    <option value="sedang" {{ $om->prioritas == 'sedang' ? 'selected' : '' }}>⚠️ Sedang</option>
                                    <option value="rendah" {{ $om->prioritas == 'rendah' ? 'selected' : '' }}>✅ Rendah</option>
                                </select>
                                <button type="button" wire:click="openAssignModal({{ $om->id }})"
                                        class="flex-1 py-2.5 rounded-xl bg-sky-600 hover:bg-sky-700 text-white font-extrabold text-xs shadow-md shadow-sky-600/30 transition-all text-center">
                                    TUGASKAN
                                </button>
                            </div>
                        </div>
                    @empty
                        <div class="py-10 text-center text-slate-400">
                            <svg class="w-10 h-10 mx-auto text-slate-300 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <p class="text-xs font-semibold">Semua pesanan darurat telah ditangani</p>
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- Card: Order Aktif Sedang Bertugas -->
            <div class="bg-white rounded-3xl border border-slate-200/80 p-6 shadow-xs">
                <h3 class="font-bold text-slate-800 text-base mb-4 flex items-center justify-between">
                    <span>Ambulans Sedang Bertugas</span>
                    <span class="text-xs font-semibold text-slate-500">{{ $activeOrders->count() }} Armada</span>
                </h3>

                <div class="space-y-3 max-h-[300px] overflow-y-auto">
                    @forelse($activeOrders as $ao)
                        <div class="p-3.5 rounded-xl bg-slate-50 border border-slate-200/80 flex items-center justify-between">
                            <div class="min-w-0 flex-1 pr-2">
                                <div class="flex items-center gap-2 mb-0.5">
                                    <span class="text-xs font-extrabold text-slate-800">{{ $ao->ambulans?->kode_ambulans ?? 'AMB' }}</span>
                                    <span class="inline-block w-1.5 h-1.5 rounded-full bg-sky-600 animate-ping"></span>
                                    <span class="text-[11px] font-semibold text-sky-600">{{ $ao->status_label }}</span>
                                </div>
                                <p class="text-xs font-bold text-slate-700 truncate">Pasien: {{ $ao->nama_pasien }}</p>
                                <p class="text-[11px] text-slate-500">Supir: {{ $ao->supir?->user->name ?? '-' }}</p>
                            </div>
                            <a href="{{ route('masyarakat.tracking', $ao->id) }}" target="_blank"
                               class="px-3 py-1.5 rounded-lg bg-slate-900 text-white text-xs font-bold hover:bg-sky-600 transition-colors flex-shrink-0">
                                Pantau
                            </a>
                        </div>
                    @empty
                        <p class="text-xs text-slate-400 text-center py-6">Tidak ada armada yang sedang bertugas</p>
                    @endforelse
                </div>
            </div>

        </div>

        <!-- Right Column: Peta Monitoring Realtime -->
        <div class="lg:col-span-7 flex flex-col">
            <div class="bg-white rounded-3xl border border-slate-200/80 p-5 shadow-xs flex-1 flex flex-col min-h-[580px]">
                <div class="flex items-center justify-between mb-4">
                    <div>
                        <h2 class="font-bold text-slate-800 text-base flex items-center gap-2">
                            <span class="w-2.5 h-2.5 rounded-full bg-sky-600 animate-ping"></span>
                            <span>Peta Monitoring Semua Armada & Order</span>
                        </h2>
                        <p class="text-xs text-slate-500">Titik kuning = Darurat masuk | Titik biru = Ambulans aktif</p>
                    </div>
                    <button type="button" @click="fitAll()"
                            class="px-3 py-1.5 rounded-xl text-xs font-semibold bg-slate-100 hover:bg-slate-200 text-slate-700 transition-colors">
                        Fokus Semua
                    </button>
                </div>

                <!-- Leaflet Container (wire:ignore prevents map destruction on poll) -->
                <div wire:ignore class="w-full h-full min-h-[520px] rounded-2xl border border-slate-200/80 z-10 overflow-hidden">
                    <div id="operator-map" class="w-full h-full min-h-[520px]"></div>
                </div>
            </div>
        </div>

    </div>

    <!-- Assignment Modal -->
    @if($showAssignModal)
        <div class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/70 backdrop-blur-xs">
            <div class="bg-white rounded-3xl max-w-lg w-full p-6 sm:p-8 shadow-2xl border border-slate-200">
                <div class="flex items-center justify-between mb-6 pb-4 border-b border-slate-100">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-sky-50 text-sky-600 flex items-center justify-center font-bold">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-extrabold text-slate-800">Tugaskan Armada Ambulans</h3>
                            <p class="text-xs text-slate-500">Pilih ambulans siaga dan supir online untuk penjemputan</p>
                        </div>
                    </div>
                    <button wire:click="closeAssignModal" class="text-slate-400 hover:text-slate-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>

                <!-- Map Radar Penugasan -->
                @if($assignOrderData)
                <div x-data="assignMapAlpine(@js($assignOrderData), @js($assignDriversData))" 
                     @select-driver.window="$wire.set('selectedSupirId', $event.detail.supir); $wire.set('selectedAmbulansId', $event.detail.amb);"
                     class="mb-6">
                    <p class="text-sm font-bold text-slate-700 mb-2">Peta Radar Armada Siaga</p>
                    <div class="p-1 border-2 border-slate-200 rounded-2xl bg-white shadow-sm">
                        <div x-ref="mapContainer" class="h-64 w-full rounded-xl z-0" wire:ignore></div>
                    </div>
                    <p class="text-xs text-slate-500 mt-2 flex items-center gap-2">
                        <span>📍 Merah: Pasien</span>
                        <span>|</span>
                        <span>🚑 Hijau: Ambulans Siaga (Klik untuk tugaskan)</span>
                    </p>
                </div>
                @endif

                <!-- Tampilkan Error Jika Ada Kegagalan Penugasan (misal supir sedang sibuk) -->
                @if(session('error'))
                    <div class="mb-4 p-4 rounded-xl bg-red-50 border border-red-200 text-red-600 flex items-start gap-3 shadow-sm">
                        <svg class="w-5 h-5 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                        <span class="text-sm font-bold">{{ session('error') }}</span>
                    </div>
                @endif

                <form wire:submit="assignOrder" class="space-y-5">
                    <!-- Pilih Armada Ambulans -->
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">
                            Pilih Armada Ambulans (Tersedia: {{ $availableAmbulances->count() }})
                        </label>
                        <select wire:model="selectedAmbulansId"
                                class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:border-sky-500 focus:ring-2 focus:ring-sky-200 text-sm font-medium">
                            <option value="">-- Pilih Ambulans yang Tersedia --</option>
                            @foreach($availableAmbulances as $amb)
                                <option value="{{ $amb->id }}">
                                    {{ $amb->kode_ambulans }} - {{ $amb->plat_nomor }} ({{ $amb->jenis_ambulans }})
                                </option>
                            @endforeach
                        </select>
                        @error('selectedAmbulansId') <p class="text-xs text-red-600 font-medium mt-1">{{ $message }}</p> @enderror
                    </div>

                    <!-- Pilih Supir Online -->
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">
                            Pilih Supir Ambulans (Online: {{ $onlineSupirs->count() }})
                        </label>
                        <select wire:model="selectedSupirId"
                                class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:border-sky-500 focus:ring-2 focus:ring-sky-200 text-sm font-medium">
                            <option value="">-- Pilih Supir Siaga / Online --</option>
                            @foreach($onlineSupirs as $sp)
                                <option value="{{ $sp->id }}">
                                    {{ $sp->user->name }} - SIM: {{ $sp->nomor_sim }} (★ {{ $sp->rating_rata_rata }})
                                </option>
                            @endforeach
                        </select>
                        @error('selectedSupirId') <p class="text-xs text-red-600 font-medium mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="flex gap-3 pt-3 border-t border-slate-100">
                        <button type="submit"
                                wire:loading.attr="disabled"
                                class="flex-1 py-3.5 rounded-xl bg-sky-600 hover:bg-sky-700 text-white font-extrabold text-sm shadow-lg shadow-sky-600/30 transition-all">
                            KONFIRMASI PENUGASAN
                        </button>
                        <button type="button" wire:click="closeAssignModal"
                                class="px-5 py-3.5 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-600 font-bold text-sm transition-colors">
                            Batal
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endif

    <!-- Leaflet Script for Operator Map -->
    <script>
        function operatorDashboardMap(initialMarkers) {
            return {
                map: null,
                markersLayer: null,
                markersData: initialMarkers,

                initMap() {
                    if (this.map) return; // Mencegah error 'Map container is already initialized'

                    this.map = L.map('operator-map').setView([-7.7188, 109.0159], 13);

                    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                        attribution: '&copy; OpenStreetMap contributors',
                        maxZoom: 19
                    }).addTo(this.map);

                    this.markersLayer = L.layerGroup().addTo(this.map);
                    this.renderMarkers();

                    setTimeout(() => {
                        this.map.invalidateSize();
                    }, 300);
                },

                renderMarkers() {
                    this.markersLayer.clearLayers();
                    const bounds = L.latLngBounds([]);

                    this.markersData.forEach((item) => {
                        if (!item.lat || !item.lng) return;

                        let title = '';
                        let popup = '';

                        if (item.type === 'ambulans') {
                            title = `Ambulans ${item.kode}`;
                            popup = `<b>Ambulans: ${item.kode}</b><br>Supir: ${item.supir}<br>Pasien: ${item.pasien}<br>Status: ${item.status}`;
                        } else if (item.type === 'darurat') {
                            title = `DARURAT: ${item.pasien}`;
                            popup = `<b>DARURAT MASUK!</b><br>Order: ${item.kode}<br>Pasien: ${item.pasien}<br>Lokasi: ${item.lokasi}`;
                        } else {
                            title = `Jemput: ${item.pasien}`;
                            popup = `<b>Titik Jemput: ${item.pasien}</b><br>Lokasi: ${item.lokasi}`;
                        }

                        const marker = L.marker([item.lat, item.lng], { title }).addTo(this.markersLayer)
                            .bindPopup(popup);

                        bounds.extend([item.lat, item.lng]);
                    });

                    if (bounds.isValid() && this.markersData.length > 0) {
                        this.map.fitBounds(bounds, { padding: [50, 50] });
                    }
                },

                fitAll() {
                    this.renderMarkers();
                },

                updateMarkers(newMarkers) {
                    this.markersData = newMarkers;
                    this.renderMarkers();
                }
            }
        }

        document.addEventListener('alpine:init', () => {
            Alpine.data('assignMapAlpine', (orderData, driversData) => ({
                map: null,
                init() {
                    setTimeout(() => {
                        if (!this.$refs.mapContainer) return;
                        
                        this.map = L.map(this.$refs.mapContainer).setView([orderData.lat, orderData.lng], 13);
                        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                            attribution: '&copy; OpenStreetMap',
                            maxZoom: 19
                        }).addTo(this.map);

                        const bounds = L.latLngBounds([]);

                        // Titik Pasien (Merah)
                        const patientIcon = L.divIcon({
                            className: 'custom-div-icon',
                            html: `<div style="font-size: 24px; text-shadow: 2px 2px 4px rgba(0,0,0,0.5); text-align: center; margin-top:-10px;">📍</div>`,
                            iconSize: [30, 30],
                            iconAnchor: [15, 30]
                        });
                        L.marker([orderData.lat, orderData.lng], {icon: patientIcon}).addTo(this.map)
                            .bindPopup(`<b>📍 Lokasi Pasien</b><br>${orderData.nama}`);
                        bounds.extend([orderData.lat, orderData.lng]);

                        // Titik Armada (Hijau)
                        driversData.forEach(d => {
                            const driverIcon = L.divIcon({
                                className: 'custom-div-icon',
                                html: `<div style="background-color: #10b981; width: 20px; height: 20px; border-radius: 50%; border: 3px solid white; box-shadow: 0 0 10px rgba(0,0,0,0.5); display: flex; align-items: center; justify-content: center; color: white; font-size: 10px; font-weight: bold;"></div>`,
                                iconSize: [20, 20],
                                iconAnchor: [10, 10]
                            });
                            
                            const marker = L.marker([d.lat, d.lng], {icon: driverIcon}).addTo(this.map);
                            marker.bindPopup(`
                                <div class="text-center">
                                    <b class="text-slate-800">${d.nama}</b><br>
                                    <span class="text-xs text-slate-500">${d.kode_ambulans}</span><br>
                                    <button type="button" class="mt-2 w-full text-xs font-bold bg-sky-600 text-white px-3 py-1.5 rounded-lg shadow hover:bg-sky-700" 
                                            onclick="window.dispatchEvent(new CustomEvent('select-driver', {detail: {supir: ${d.id}, amb: ${d.ambulans_id || 'null'}}}))">
                                        Pilih Supir Ini
                                    </button>
                                </div>
                            `);
                            bounds.extend([d.lat, d.lng]);
                        });

                        if (bounds.isValid()) {
                            this.map.fitBounds(bounds, { padding: [30, 30] });
                        }
                    }, 200); // Tunggu modal render
                }
            }));
        });
    </script>
</div>
