<div wire:poll.5s>
    <!-- Header Page -->
    <div class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <div class="flex items-center gap-2 mb-1">
                <span class="text-xs font-bold text-slate-500 uppercase tracking-wider">PENUGASAN AKTIF SUPIR</span>
                <span class="inline-flex items-center gap-1.5 px-3 py-0.5 rounded-full text-xs font-extrabold bg-blue-100 text-blue-700">
                    <span class="w-2 h-2 rounded-full bg-blue-600 animate-ping"></span>
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

                <!-- Tombol Simulasi GPS (Uji Coba & Demo) -->
                @if(in_array($order->status, ['menuju_lokasi', 'membawa_pasien']))
                    <div class="mt-6 pt-6 border-t border-slate-100">
                        <button type="button"
                                wire:click="simulateGpsStep"
                                class="w-full py-3.5 rounded-xl bg-slate-900 hover:bg-slate-800 text-white font-bold text-xs shadow-md transition-all flex items-center justify-center gap-2">
                            <svg class="w-4 h-4 text-red-500 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <span>SIMULASIKAN PERGERAKAN GPS (18% JALUR)</span>
                        </button>
                        <p class="text-center text-[11px] text-slate-400 mt-2">
                            Klik tombol di atas untuk menyimulasikan ambulans bergerak menuju tujuan pada peta satelit.
                        </p>
                    </div>
                @endif
            </div>

            <!-- Detail Pasien & Alamat Evakuasi -->
            <div class="bg-white rounded-3xl border border-slate-200/80 p-6 shadow-xs space-y-4">
                <h3 class="font-bold text-slate-800 text-base border-b border-slate-100 pb-3">Detail Evakuasi Pasien</h3>

                <div class="space-y-3 text-xs">
                    <div>
                        <span class="text-slate-400 font-semibold block">NAMA PASIEN</span>
                        <span class="text-sm font-extrabold text-slate-800">{{ $order->nama_pasien }}</span>
                    </div>

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

                    @if($order->tujuan_lokasi || $order->rumahSakit)
                        <div>
                            <span class="text-slate-400 font-semibold block">RUMAH SAKIT RUJUKAN</span>
                            <p class="text-emerald-700 font-extrabold text-sm">{{ $order->tujuan_lokasi ?? $order->rumahSakit->nama }}</p>
                        </div>
                    @endif

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
        <div class="lg:col-span-7 flex flex-col">
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
                <div id="supir-map" class="w-full h-full min-h-[500px] rounded-2xl border border-slate-200/80 z-10"></div>
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

                initMap() {
                    this.map = L.map('supir-map').setView([ambLat, ambLng], 14);

                    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                        attribution: '&copy; OpenStreetMap contributors',
                        maxZoom: 19
                    }).addTo(this.map);

                    // Driver Ambulance Marker
                    this.ambMarker = L.marker([ambLat, ambLng], {
                        title: 'Posisi Ambulans Saya'
                    }).addTo(this.map)
                    .bindPopup('<b>Posisi Ambulans Saya</b><br>Secara realtime dari GPS')
                    .openPopup();

                    // Pickup Marker
                    if (jemputLat && jemputLng) {
                        this.jemputMarker = L.marker([jemputLat, jemputLng]).addTo(this.map)
                        .bindPopup('<b>Titik Jemput Pasien</b>');
                    }

                    // Hospital Marker
                    if (rsLat && rsLng && rsLat !== 0) {
                        this.rsMarker = L.marker([rsLat, rsLng]).addTo(this.map)
                        .bindPopup('<b>Rumah Sakit Rujukan</b>');
                    }

                    this.drawPolyline();
                    this.fitAllMarkers();

                    setTimeout(() => {
                        this.map.invalidateSize();
                    }, 300);
                },

                updateAmbulancePos(newLat, newLng) {
                    if (this.ambMarker) {
                        this.ambMarker.setLatLng([newLat, newLng]);
                        this.map.panTo([newLat, newLng]);
                        this.drawPolyline();
                    }
                },

                drawPolyline() {
                    if (this.polyline) {
                        this.map.removeLayer(this.polyline);
                    }

                    const points = [];
                    if (this.ambMarker) points.push(this.ambMarker.getLatLng());
                    if (this.jemputMarker) points.push(this.jemputMarker.getLatLng());
                    if (this.rsMarker) points.push(this.rsMarker.getLatLng());

                    if (points.length > 1) {
                        this.polyline = L.polyline(points, {
                            color: '#DC2626',
                            weight: 4,
                            opacity: 0.85,
                            dashArray: '10, 8'
                        }).addTo(this.map);
                    }
                },

                fitAllMarkers() {
                    const bounds = L.latLngBounds([]);
                    if (this.ambMarker) bounds.extend(this.ambMarker.getLatLng());
                    if (this.jemputMarker) bounds.extend(this.jemputMarker.getLatLng());
                    if (this.rsMarker) bounds.extend(this.rsMarker.getLatLng());

                    if (bounds.isValid()) {
                        this.map.fitBounds(bounds, { padding: [50, 50] });
                    }
                }
            }
        }
    </script>
</div>
