<div wire:poll.5s>
    <!-- Header Page -->
    <div class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <div class="flex items-center gap-2 mb-1">
                <span class="text-xs font-bold text-slate-500 uppercase tracking-wider">PENUGASAN AKTIF SUPIR</span>
                <span class="inline-flex items-center gap-1.5 px-3 py-0.5 rounded-full text-xs font-extrabold bg-primary-100 text-primary-700">
                    <span class="w-2 h-2 rounded-full bg-primary-600 animate-ping"></span>
                    <span>{{ $order->status_label }}</span>
                </span>
            </div>
            <h1 class="text-2xl sm:text-3xl font-extrabold text-slate-800 tracking-tight">Tugas Evakuasi #{{ $order->kode_order }}</h1>
            <p class="text-slate-500 text-sm mt-0.5">Pasien: <strong class="text-slate-700">{{ $order->nama_pasien }}</strong> • Dibuat: {{ $order->waktu_pesan ? $order->waktu_pesan->translatedFormat('d M Y, H:i') : '-' }}</p>
        </div>

        <div class="flex items-center gap-3">
            <a href="{{ route('supir.dashboard') }}"
               class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-white border border-slate-300 text-slate-700 text-xs font-bold hover:bg-slate-50 transition-colors">
                <span>&larr; Dashboard Supir</span>
            </a>
        </div>
    </div>

    <!-- Main Grid: Kontrol Tugas (Left) & Peta Navigasi (Right) -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8"
         x-data="supirMapComponent({{ $currentLat }}, {{ $currentLng }}, {{ $order->jemput_lat }}, {{ $order->jemput_lng }}, {{ $order->tujuan_lat ?? 0 }}, {{ $order->tujuan_lng ?? 0 }})"
         x-init="initMap()"
         @gps-updated.window="updateAmbulancePos({{ $currentLat }}, {{ $currentLng }})">

        <!-- Left Column: Kontrol Status Operasional & Detail -->
        <div class="lg:col-span-5 space-y-6">

            <!-- Card: Kendali Status Evakuasi (3 Langkah Utama) -->
            <div class="bg-white rounded-3xl border border-slate-200/80 p-6 shadow-xs">
                <h2 class="font-bold text-slate-800 text-base mb-2 flex items-center gap-2">
                    <span class="w-2.5 h-2.5 rounded-full bg-red-600"></span>
                    <span>Tombol Tindakan Operasional Supir</span>
                </h2>
                <p class="text-xs text-slate-500 mb-6">Klik tombol sesuai perkembangan perjalanan evakuasi di lapangan.</p>

                <div class="space-y-4">
                    <!-- Langkah 1: Menuju Lokasi Jemput -->
                    <button type="button"
                            wire:click="updateStatus('menuju_lokasi')"
                            @if(in_array($order->status, ['menuju_lokasi', 'membawa_pasien', 'selesai'])) disabled @endif
                            class="w-full p-4 rounded-2xl flex items-center justify-between text-left transition-all
                            @if($order->status === 'diproses')
                                bg-red-600 hover:bg-red-700 text-white shadow-lg shadow-red-600/30 scale-102
                            @elseif(in_array($order->status, ['menuju_lokasi', 'membawa_pasien', 'selesai']))
                                bg-emerald-50 border border-emerald-200 text-emerald-800 opacity-80 cursor-not-allowed
                            @else
                                bg-slate-100 text-slate-400
                            @endif">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-xl bg-white/20 flex items-center justify-center font-black text-lg">
                                @if(in_array($order->status, ['menuju_lokasi', 'membawa_pasien', 'selesai'])) ✓ @else 1 @endif
                            </div>
                            <div>
                                <span class="text-xs font-bold opacity-80 uppercase tracking-wider block">Langkah 1</span>
                                <span class="font-extrabold text-sm">Mulai Menuju Lokasi Jemput</span>
                            </div>
                        </div>
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </button>

                    <!-- Langkah 2: Membawa Pasien ke RS -->
                    <button type="button"
                            wire:click="updateStatus('membawa_pasien')"
                            @if(in_array($order->status, ['membawa_pasien', 'selesai']) || $order->status === 'diproses') disabled @endif
                            class="w-full p-4 rounded-2xl flex items-center justify-between text-left transition-all
                            @if($order->status === 'menuju_lokasi')
                                bg-red-600 hover:bg-red-700 text-white shadow-lg shadow-red-600/30 scale-102
                            @elseif(in_array($order->status, ['membawa_pasien', 'selesai']))
                                bg-emerald-50 border border-emerald-200 text-emerald-800 opacity-80 cursor-not-allowed
                            @else
                                bg-slate-100 text-slate-400
                            @endif">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-xl bg-white/20 flex items-center justify-center font-black text-lg">
                                @if(in_array($order->status, ['membawa_pasien', 'selesai'])) ✓ @else 2 @endif
                            </div>
                            <div>
                                <span class="text-xs font-bold opacity-80 uppercase tracking-wider block">Langkah 2</span>
                                <span class="font-extrabold text-sm">Pasien Diangkut Menuju RS</span>
                            </div>
                        </div>
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </button>

                    <!-- Langkah 3: Evakuasi Selesai di RS -->
                    <button type="button"
                            wire:click="updateStatus('selesai')"
                            wire:confirm="Konfirmasi pasien telah tiba dengan aman di Rumah Sakit dan tugas evakuasi selesai?"
                            @if($order->status === 'selesai' || in_array($order->status, ['diproses', 'menuju_lokasi'])) disabled @endif
                            class="w-full p-4 rounded-2xl flex items-center justify-between text-left transition-all
                            @if($order->status === 'membawa_pasien')
                                bg-emerald-600 hover:bg-emerald-700 text-white shadow-lg shadow-emerald-600/30 scale-102
                            @elseif($order->status === 'selesai')
                                bg-emerald-100 border border-emerald-300 text-emerald-900 font-extrabold
                            @else
                                bg-slate-100 text-slate-400
                            @endif">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-xl bg-white/20 flex items-center justify-center font-black text-lg">
                                @if($order->status === 'selesai') ✓ @else 3 @endif
                            </div>
                            <div>
                                <span class="text-xs font-bold opacity-80 uppercase tracking-wider block">Langkah 3</span>
                                <span class="font-extrabold text-sm">Evakuasi Selesai di RS</span>
                            </div>
                        </div>
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                    </button>
                </div>

                <!-- GPS Tracking & Simulasi -->
                @if(in_array($order->status, ['menuju_lokasi', 'membawa_pasien', 'diproses']))
                    <div class="mt-6 pt-6 border-t border-slate-100 space-y-3"
                         x-data="gpsTracker(@this)">

                        {{-- Tombol GPS Nyata --}}
                        <div x-show="!gpsSupported" class="p-3 rounded-xl bg-amber-50 border border-amber-200 text-xs text-amber-800 font-semibold text-center">
                            ⚠️ Browser tidak mendukung GPS / tidak memiliki izin lokasi.
                        </div>

                        <button type="button"
                                x-show="gpsSupported"
                                @click="toggleGps()"
                                :class="gpsActive
                                    ? 'bg-emerald-600 hover:bg-emerald-700 shadow-emerald-600/30'
                                    : 'bg-sky-600 hover:bg-sky-700 shadow-sky-600/30'"
                                class="w-full py-3.5 rounded-xl text-white font-extrabold text-xs shadow-lg transition-all flex items-center justify-center gap-2">
                            <span x-show="!gpsActive">
                                <svg class="w-4 h-4 inline-block mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                                🛰️ AKTIFKAN GPS TRACKING NYATA
                            </span>
                            <span x-show="gpsActive" class="flex items-center gap-2">
                                <span class="w-2 h-2 rounded-full bg-white animate-ping"></span>
                                GPS AKTIF — Mengirim Koordinat Otomatis
                            </span>
                        </button>

                        <div x-show="gpsActive" class="text-center text-[11px] text-emerald-700 font-semibold bg-emerald-50 rounded-lg px-3 py-2 border border-emerald-200">
                            📍 Koordinat GPS dikirim otomatis setiap posisi berubah.
                            <span x-text="lastCoords ? '(' + lastCoords + ')' : ''"></span>
                        </div>

                        {{-- Tombol Simulasi (untuk demo/dev) --}}
                        <button type="button"
                                wire:click="simulateGpsStep"
                                class="w-full py-2.5 rounded-xl bg-slate-200 hover:bg-slate-300 text-slate-600 font-semibold text-xs transition-all flex items-center justify-center gap-2">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <span>Simulasi GPS (Mode Demo)</span>
                        </button>
                    </div>
                @endif
            </div>

            <!-- Detail Pasien & Alamat Evakuasi -->
            <div class="bg-white rounded-3xl border border-slate-200/80 p-6 shadow-xs space-y-4">
                <h3 class="font-bold text-slate-800 text-base border-b border-slate-100 pb-3">Detail Evakuasi Pasien</h3>

                <div class="space-y-3 text-xs">
                    <div class="grid grid-cols-2 gap-2 p-3 rounded-2xl bg-slate-50 border border-slate-100">
                        <div>
                            <span class="text-slate-400 font-semibold block text-[10px]">NAMA PASIEN</span>
                            <span class="text-sm font-extrabold text-slate-800">{{ $order->nama_pasien }}</span>
                        </div>
                        <div>
                            <span class="text-slate-400 font-semibold block text-[10px]">NIK PASIEN</span>
                            <span class="text-sm font-extrabold text-slate-800">{{ $order->nik_pasien ?: '-' }}</span>
                        </div>
                        <div class="mt-1">
                            <span class="text-slate-400 font-semibold block text-[10px]">USIA / PENDAMPING</span>
                            <span class="text-xs font-bold text-slate-800">{{ $order->usia_pasien ?: '-' }} ({{ $order->jumlah_pendamping ?: 1 }} Org)</span>
                        </div>
                        <div class="mt-1">
                            <span class="text-slate-400 font-semibold block text-[10px]">NO. HP KONTAK</span>
                            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $order->no_hp_kontak) }}" target="_blank" class="text-xs font-bold text-emerald-600 hover:underline">
                                {{ $order->no_hp_kontak ?: '-' }}
                            </a>
                        </div>
                    </div>

                    <div class="flex justify-between py-1 border-b border-slate-50">
                        <span class="text-slate-500 font-semibold">Keperluan Evakuasi:</span>
                        <span class="font-extrabold text-sky-600">{{ $order->keperluan_penggunaan ?: 'IGD Darurat' }}</span>
                    </div>

                    <div class="flex justify-between py-1 border-b border-slate-50">
                        <span class="text-slate-500 font-semibold">Jadwal Jemput:</span>
                        <span class="font-bold text-slate-800">{{ $order->tanggal_jemput ? $order->tanggal_jemput->format('d M Y') : '-' }} • {{ $order->jam_jemput ?: 'Segera' }}</span>
                    </div>

                    @if($order->diagnosa_medis)
                        <div class="py-1 border-b border-slate-50">
                            <span class="text-slate-400 font-semibold block">DIAGNOSA MEDIS</span>
                            <span class="font-bold text-slate-700">{{ $order->diagnosa_medis }}</span>
                        </div>
                    @endif

                    <div>
                        <span class="text-slate-400 font-semibold block">KONDISI MEDIS / DARURAT</span>
                        <p class="text-slate-700 font-medium bg-red-50/60 p-3 rounded-xl border border-red-200/60 mt-1">
                            {{ $order->kondisi_pasien }}
                        </p>
                    </div>

                    <div>
                        <span class="text-slate-400 font-semibold block">ALAMAT PENJEMPUTAN</span>
                        <p class="text-slate-800 font-bold text-sm">{{ $order->lokasi_jemput }}</p>
                    </div>

                    <div>
                        <span class="text-slate-400 font-semibold block">ALAMAT ANTAR / TUJUAN</span>
                        <p class="text-emerald-700 font-extrabold text-sm">{{ $order->tujuan_lokasi ?? $order->rumahSakit?->nama }}</p>
                    </div>

                    @if($order->catatan_tambahan)
                        <div>
                            <span class="text-slate-400 font-semibold block">CATATAN TAMBAHAN</span>
                            <p class="text-slate-700 italic">{{ $order->catatan_tambahan }}</p>
                        </div>
                    @endif
                </div>

                @if($order->user)
                    <div class="pt-4 border-t border-slate-100 flex items-center justify-between">
                        <div>
                            <span class="text-[11px] text-slate-400 block font-semibold">PEMESAN / PELAPOR</span>
                            <span class="font-bold text-slate-800 text-sm">{{ $order->user->name }}</span>
                        </div>
                        <a href="tel:{{ $order->user->phone }}"
                           class="px-4 py-2 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs shadow-md">
                            Hubungi Pelapor
                        </a>
                    </div>
                @endif
            </div>

        </div>

        <!-- Right Column: Leaflet Map Navigasi -->
        <div class="lg:col-span-7 flex flex-col lg:sticky lg:top-24 self-start" wire:ignore>
            <div class="bg-white rounded-3xl border border-slate-200/80 p-5 shadow-xs flex-1 flex flex-col min-h-[560px]">
                <div class="flex items-center justify-between mb-4">
                    <div>
                        <h2 class="font-bold text-slate-800 text-base flex items-center gap-2">
                            <span class="w-2.5 h-2.5 rounded-full bg-red-600 animate-ping"></span>
                            <span>Peta Navigasi Supir (GPS Satelit)</span>
                        </h2>
                        <p class="text-xs text-slate-500">Garis putus merah menunjukkan jalur penjemputan dan evakuasi.</p>
                    </div>
                    <button type="button" @click="fitAllMarkers()"
                            class="px-3 py-1.5 rounded-xl text-xs font-semibold bg-slate-100 hover:bg-slate-200 text-slate-700 transition-colors">
                        Fokus Jalur
                    </button>
                </div>

                <!-- Leaflet Container -->
                <div class="relative w-full h-full min-h-[500px] rounded-2xl border border-slate-200/80 overflow-hidden z-10">
                    <div id="supir-map" class="w-full h-full min-h-[500px]"></div>

                    <!-- Floating Turn-by-Turn Route Info Overlay (Grab / Google Maps style) -->
                    <div x-show="routeSummary" x-transition
                         class="absolute top-4 left-4 right-4 sm:right-auto sm:max-w-md z-[1000] bg-white/95 backdrop-blur-md p-3.5 rounded-2xl border border-slate-200/80 shadow-xl flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-red-600 text-white flex items-center justify-center text-lg font-black shrink-0 shadow-md shadow-red-600/30">
                            🧭
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="flex items-center gap-2">
                                <span class="text-sm font-extrabold text-slate-800" x-text="routeEta"></span>
                                <span class="text-xs font-bold text-red-700 bg-red-50 px-2.5 py-0.5 rounded-full border border-red-100" x-text="routeDistance"></span>
                            </div>
                            <p class="text-xs text-slate-500 font-medium truncate mt-0.5" x-text="'Melalui: ' + routeSummary"></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Leaflet Script for Supir Navigation Map -->
    <script>
        function supirMapComponent(ambLat, ambLng, jemputLat, jemputLng, rsLat, rsLng) {
            return {
                map: null,
                ambMarker: null,
                jemputMarker: null,
                rsMarker: null,
                polyline: null,
                polyline2: null,
                routeDistance: '',
                routeEta: '',
                routeSummary: '',

                initMap() {
                    const defaultLat = ambLat || jemputLat || -7.7188;
                    const defaultLng = ambLng || jemputLng || 109.0159;

                    this.map = L.map('supir-map', {
                        zoomControl: true,
                        attributionControl: true
                    }).setView([defaultLat, defaultLng], 14);

                    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                        attribution: '&copy; OpenStreetMap contributors',
                        maxZoom: 19
                    }).addTo(this.map);

                    // Expose instance ke window agar GPS tracker JS bisa update marker langsung
                    window.supirMapInstance = this;

                    const ambIcon = L.divIcon({
                        className: 'custom-amb-icon',
                        html: `<div style="background: linear-gradient(135deg, #DC2626, #991B1B); width: 38px; height: 38px; border-radius: 50%; border: 3px solid white; box-shadow: 0 4px 12px rgba(220,38,38,0.5); display: flex; align-items: center; justify-content: center; font-size: 18px;">🚑</div>`,
                        iconSize: [38, 38],
                        iconAnchor: [19, 19]
                    });

                    const jemputIcon = L.divIcon({
                        className: 'custom-jemput-icon',
                        html: `<div style="background: linear-gradient(135deg, #3B82F6, #2563EB); width: 34px; height: 34px; border-radius: 50%; border: 3px solid white; box-shadow: 0 4px 10px rgba(59,130,246,0.4); display: flex; align-items: center; justify-content: center; font-size: 16px;">📍</div>`,
                        iconSize: [34, 34],
                        iconAnchor: [17, 34]
                    });

                    const rsIcon = L.divIcon({
                        className: 'custom-rs-icon',
                        html: `<div style="background: linear-gradient(135deg, #10B981, #059669); width: 34px; height: 34px; border-radius: 50%; border: 3px solid white; box-shadow: 0 4px 10px rgba(16,185,129,0.4); display: flex; align-items: center; justify-content: center; font-size: 16px;">🏥</div>`,
                        iconSize: [34, 34],
                        iconAnchor: [17, 34]
                    });

                    // Driver Ambulance Marker
                    this.ambMarker = L.marker([defaultLat, defaultLng], {
                        icon: ambIcon,
                        title: 'Posisi Ambulans Saya'
                    }).addTo(this.map)
                    .bindPopup('<b>Posisi Ambulans Saya</b><br>Secara realtime dari satelit GPS')
                    .openPopup();

                    // Pickup Marker
                    if (jemputLat && jemputLng) {
                        this.jemputMarker = L.marker([jemputLat, jemputLng], {
                            icon: jemputIcon
                        }).addTo(this.map)
                        .bindPopup('<b>Titik Jemput Pasien</b>');
                    }

                    // Hospital Marker
                    if (rsLat && rsLng && rsLat !== 0) {
                        this.rsMarker = L.marker([rsLat, rsLng], {
                            icon: rsIcon
                        }).addTo(this.map)
                        .bindPopup('<b>Rumah Sakit Rujukan</b>');
                    }

                    this.drawPolyline();
                    this.fitAllMarkers();

                    setTimeout(() => {
                        if (this.map) {
                            this.map.invalidateSize();
                            this.fitAllMarkers();
                        }
                    }, 350);
                },

                updateAmbulancePos(newLat, newLng) {
                    if (this.ambMarker) {
                        this.ambMarker.setLatLng([newLat, newLng]);
                        this.map.panTo([newLat, newLng]);
                        this.drawPolyline();
                    }
                },

                async fetchOsrmRoute(startLatLng, endLatLng, color, weight, opacity, isPrimary = true) {
                    try {
                        const url = `https://router.project-osrm.org/route/v1/driving/${startLatLng.lng},${startLatLng.lat};${endLatLng.lng},${endLatLng.lat}?overview=full&geometries=geojson&steps=true`;
                        const response = await fetch(url);
                        const data = await response.json();

                        if (data.code === 'Ok' && data.routes && data.routes.length > 0) {
                            const route = data.routes[0];
                            const coords = route.geometry.coordinates.map(c => [c[1], c[0]]);

                            const routeLayer = L.polyline(coords, {
                                color: color,
                                weight: weight,
                                opacity: opacity,
                                lineCap: 'round',
                                lineJoin: 'round'
                            }).addTo(this.map);

                            if (isPrimary) {
                                const distKm = (route.distance / 1000).toFixed(1) + ' km';
                                const etaMin = Math.max(1, Math.ceil(route.duration / 60)) + ' Menit';
                                const summary = (route.legs && route.legs[0] && route.legs[0].summary) ? route.legs[0].summary : 'Jalan Raya Utama Cilacap';

                                this.routeDistance = distKm;
                                this.routeEta = etaMin;
                                this.routeSummary = summary;
                            }

                            return routeLayer;
                        }
                    } catch (e) {
                        console.warn('OSRM routing fallback to straight line:', e);
                    }

                    return L.polyline([startLatLng, endLatLng], {
                        color: color,
                        weight: weight,
                        opacity: opacity,
                        dashArray: '8, 8'
                    }).addTo(this.map);
                },

                async drawPolyline() {
                    if (this.polyline) {
                        this.map.removeLayer(this.polyline);
                        this.polyline = null;
                    }
                    if (this.polyline2) {
                        this.map.removeLayer(this.polyline2);
                        this.polyline2 = null;
                    }

                    if (this.ambMarker && this.jemputMarker) {
                        this.polyline = await this.fetchOsrmRoute(
                            this.ambMarker.getLatLng(),
                            this.jemputMarker.getLatLng(),
                            '#DC2626', 5.5, 0.95, true
                        );
                    }
                    if (this.jemputMarker && this.rsMarker) {
                        this.polyline2 = await this.fetchOsrmRoute(
                            this.jemputMarker.getLatLng(),
                            this.rsMarker.getLatLng(),
                            '#10B981', 4, 0.8, false
                        );
                    }
                },

                fitAllMarkers() {
                    const bounds = L.latLngBounds([]);
                    if (this.ambMarker) bounds.extend(this.ambMarker.getLatLng());
                    if (this.jemputMarker) bounds.extend(this.jemputMarker.getLatLng());
                    if (this.rsMarker) bounds.extend(this.rsMarker.getLatLng());

                    if (bounds.isValid()) {
                        this.map.fitBounds(bounds, { padding: [60, 60], maxZoom: 15 });
                    }
                }
            }
        }
    </script>

    {{-- ====== GPS TRACKING JAVASCRIPT ====== --}}
    <script>
        function gpsTracker(livewireComponent) {
            return {
                gpsActive: false,
                gpsSupported: 'geolocation' in navigator,
                watchId: null,
                lastCoords: null,

                toggleGps() {
                    if (this.gpsActive) {
                        this.stopGps();
                    } else {
                        this.startGps();
                    }
                },

                startGps() {
                    if (!this.gpsSupported) return;

                    const options = {
                        enableHighAccuracy: true,
                        timeout: 15000,
                        maximumAge: 5000
                    };

                    this.watchId = navigator.geolocation.watchPosition(
                        (position) => this.onPositionUpdate(position),
                        (error) => this.onPositionError(error),
                        options
                    );

                    this.gpsActive = true;
                    livewireComponent.call('toggleGpsTracking');
                },

                stopGps() {
                    if (this.watchId !== null) {
                        navigator.geolocation.clearWatch(this.watchId);
                        this.watchId = null;
                    }
                    this.gpsActive = false;
                    this.lastCoords = null;
                    livewireComponent.call('toggleGpsTracking');
                },

                onPositionUpdate(position) {
                    const lat = position.coords.latitude;
                    const lng = position.coords.longitude;
                    const speed = position.coords.speed ? Math.round(position.coords.speed * 3.6) : 0; // m/s -> km/h
                    const heading = position.coords.heading ? Math.round(position.coords.heading) : 0;

                    this.lastCoords = lat.toFixed(5) + ', ' + lng.toFixed(5);

                    // Kirim ke Livewire — update DB tracking_gps
                    livewireComponent.call('updateGpsLocation', lat, lng, speed, heading);

                    // Update marker di peta Leaflet secara langsung (tanpa nunggu Livewire)
                    if (window.supirMapInstance && window.supirMapInstance.ambMarker) {
                        window.supirMapInstance.ambMarker.setLatLng([lat, lng]);
                        window.supirMapInstance.map.panTo([lat, lng]);
                    }
                },

                onPositionError(error) {
                    console.warn('[GPS Error]', error.message);
                    if (error.code === error.PERMISSION_DENIED) {
                        alert('Izin lokasi ditolak. Aktifkan izin lokasi di pengaturan browser Anda.');
                        this.stopGps();
                    }
                }
            };
        }
    </script>
</div>
