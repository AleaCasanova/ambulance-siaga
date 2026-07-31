<div wire:poll.4s>
    <!-- Top Bar -->
    <div class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <div class="flex items-center gap-3 mb-1">
                <span class="text-xs font-bold text-slate-500 uppercase tracking-wider">TRACKING REALTIME</span>
                <span class="inline-flex items-center gap-1.5 px-3 py-0.5 rounded-full text-xs font-extrabold
                    @if($order->status === 'menunggu') bg-amber-100 text-amber-700
                    @elseif(in_array($order->status, ['diproses', 'menuju_lokasi', 'membawa_pasien'])) bg-blue-100 text-blue-700 animate-pulse
                    @elseif($order->status === 'selesai') bg-emerald-100 text-emerald-700
                    @else bg-slate-100 text-slate-600 @endif">
                    <span class="w-2 h-2 rounded-full @if(in_array($order->status, ['diproses', 'menuju_lokasi', 'membawa_pasien'])) bg-blue-600 animate-ping @else bg-current @endif"></span>
                    <span>{{ $order->status_label }}</span>
                </span>
            </div>
            <h1 class="text-2xl sm:text-3xl font-extrabold text-slate-800 tracking-tight">Order #{{ $order->kode_order }}</h1>
            <p class="text-slate-500 text-sm mt-0.5">Pasien: <strong class="text-slate-700">{{ $order->nama_pasien }}</strong> • Dibuat: {{ $order->waktu_pesan ? $order->waktu_pesan->translatedFormat('d M Y, H:i:s') : '-' }}</p>
        </div>

        <div class="flex items-center gap-3">
            @if(in_array($order->status, ['menuju_lokasi', 'membawa_pasien']))
                <button type="button" wire:click="simulateGpsStep"
                        class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-slate-900 hover:bg-slate-800 text-white font-bold text-xs shadow-md transition-all">
                    <svg class="w-4 h-4 text-sky-400 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <span>Simulasikan Pergerakan GPS</span>
                </button>
            @endif

            <a href="{{ route('masyarakat.orders.index') }}"
               class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-white border border-slate-300 text-slate-700 text-xs font-bold hover:bg-slate-50 transition-colors">
                <span>&larr; Kembali ke Daftar</span>
            </a>
        </div>
    </div>

    <!-- Stepper Status Perjalanan -->
    <div class="bg-white rounded-3xl border border-slate-200/80 p-6 mb-8 shadow-xs overflow-x-auto">
        @php
            $steps = [
                ['key' => 'menunggu', 'label' => 'Menunggu Dispatcher', 'icon' => '1'],
                ['key' => 'diproses', 'label' => 'Ambulans Ditugaskan', 'icon' => '2'],
                ['key' => 'menuju_lokasi', 'label' => 'Menuju Lokasi Jemput', 'icon' => '3'],
                ['key' => 'membawa_pasien', 'label' => 'Menuju Rumah Sakit', 'icon' => '4'],
                ['key' => 'selesai', 'label' => 'Selesai di RS', 'icon' => '5'],
            ];
            $currentIdx = 0;
            foreach ($steps as $idx => $st) {
                if ($order->status === $st['key']) {
                    $currentIdx = $idx;
                }
            }
            if ($order->status === 'selesai') $currentIdx = 4;
        @endphp

        <div class="flex items-center justify-between min-w-[500px]">
            @foreach($steps as $idx => $step)
                <div class="flex flex-col items-center flex-1 relative">
                    <!-- Connector line -->
                    @if($idx < 4)
                        <div class="absolute top-5 left-1/2 w-full h-1 {{ $idx < $currentIdx ? 'bg-sky-600' : 'bg-slate-200' }} -z-0"></div>
                    @endif

                    <!-- Step Circle -->
                    <div class="w-10 h-10 rounded-full flex items-center justify-center font-bold text-sm z-10 transition-colors
                        {{ $idx <= $currentIdx ? 'bg-sky-600 text-white shadow-lg shadow-sky-600/30' : 'bg-slate-200 text-slate-500' }}">
                        @if($idx < $currentIdx)
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                            </svg>
                        @else
                            {{ $step['icon'] }}
                        @endif
                    </div>
                    <span class="text-xs font-bold mt-2 {{ $idx <= $currentIdx ? 'text-slate-800' : 'text-slate-400' }} text-center">
                        {{ $step['label'] }}
                    </span>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Main Grid: Driver Info (Left) & Realtime Map (Right) -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8"
         x-data="trackingMapComponent({{ $currentLat }}, {{ $currentLng }}, {{ $order->jemput_lat }}, {{ $order->jemput_lng }}, {{ $order->tujuan_lat ?? 0 }}, {{ $order->tujuan_lng ?? 0 }})"
         x-init="initMap()"
         @gps-updated.window="updateAmbulancePos({{ $currentLat }}, {{ $currentLng }})">

        <!-- Left Column: Informasi Armada & Log Timeline -->
        <div class="lg:col-span-5 space-y-6">

            <!-- Card Armada & Supir -->
            @if($order->supir && $order->ambulans)
                <div class="bg-white rounded-3xl border border-slate-200/80 p-6 shadow-xs">
                    <div class="flex items-center gap-4 mb-4 pb-4 border-b border-slate-100">
                        <div class="w-14 h-14 rounded-2xl bg-sky-50 border border-sky-100 flex items-center justify-center text-sky-600 font-extrabold text-xl shadow-inner">
                            AMB
                        </div>
                        <div>
                            <span class="inline-block px-2 py-0.5 rounded text-[11px] font-bold bg-sky-100 text-sky-700 mb-0.5">
                                {{ $order->ambulans->kode_ambulans }}
                            </span>
                            <h3 class="font-bold text-slate-800 text-lg leading-tight">{{ $order->supir->user->name }}</h3>
                            <p class="text-xs text-slate-500">Plat Nomor: <strong class="text-slate-700">{{ $order->ambulans->plat_nomor }}</strong></p>
                        </div>
                    </div>

                    <div class="space-y-2.5 text-xs">
                        <div class="flex justify-between py-1 border-b border-slate-50">
                            <span class="text-slate-500">Nomor Telepon Supir:</span>
                            <a href="tel:{{ $order->supir->user->phone }}" class="font-bold text-sky-600 hover:underline">
                                {{ $order->supir->user->phone }}
                            </a>
                        </div>
                        <div class="flex justify-between py-1 border-b border-slate-50">
                            <span class="text-slate-500">Jenis Armada:</span>
                            <span class="font-bold text-slate-800">{{ $order->ambulans->jenis_ambulans }}</span>
                        </div>
                        <div class="py-1">
                            <span class="text-slate-500 block mb-1">Perlengkapan Medis:</span>
                            <p class="font-medium text-slate-700 bg-slate-50 p-2.5 rounded-xl border border-slate-100 leading-relaxed">
                                {{ $order->ambulans->perlengkapan_medis }}
                            </p>
                        </div>
                    </div>
                </div>
            @else
                <div class="bg-amber-50 rounded-3xl border border-amber-200 p-6 text-center">
                    <p class="text-sm font-bold text-amber-800 mb-1">Ambulans Belum Ditugaskan</p>
                    <p class="text-xs text-amber-700">Dispatcher sedang memproses dan mencarikan armada ambulans GSC terdekat untuk penjemputan.</p>
                </div>
            @endif

            <!-- Riwayat Status Perjalanan -->
            <div class="bg-white rounded-3xl border border-slate-200/80 p-6 shadow-xs">
                <h3 class="font-bold text-slate-800 text-base mb-4 flex items-center gap-2">
                    <span class="w-2.5 h-2.5 rounded-full bg-sky-600"></span>
                    <span>Log Aktivitas Perjalanan</span>
                </h3>

                <div class="space-y-4">
                    @foreach($order->statusPerjalanan->sortByDesc('created_at') as $statusItem)
                        <div class="flex items-start gap-3 text-xs">
                            <div class="w-2 h-2 rounded-full bg-sky-600 mt-1.5 flex-shrink-0"></div>
                            <div class="flex-1">
                                <div class="flex items-center justify-between">
                                    <span class="font-extrabold text-slate-800 uppercase tracking-wide">{{ str_replace('_', ' ', $statusItem->status) }}</span>
                                    <span class="text-[11px] text-slate-400 font-medium">{{ $statusItem->created_at->format('H:i:s') }}</span>
                                </div>
                                <p class="text-slate-600 mt-0.5 leading-normal">{{ $statusItem->keterangan }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Rating Card jika sudah selesai -->
            @if($order->rating)
                <div class="bg-emerald-50 rounded-3xl border border-emerald-200 p-6">
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-xs font-bold text-emerald-800 uppercase tracking-wider">Ulasan Anda</span>
                        <div class="flex text-amber-400">
                            @for($i=1; $i<=5; $i++)
                                <svg class="w-4 h-4 {{ $i <= $order->rating->skor ? 'fill-current' : 'text-slate-300' }}" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                </svg>
                            @endfor
                        </div>
                    </div>
                    <p class="text-xs text-emerald-900 leading-relaxed font-medium">"{{ $order->rating->ulasan ?: 'Pelayanan sangat baik dan cepat.' }}"</p>
                </div>
            @endif

        </div>

        <!-- Right Column: Leaflet Map -->
        <div class="lg:col-span-7 flex flex-col">
            <div class="bg-white rounded-3xl border border-slate-200/80 p-5 shadow-xs flex-1 flex flex-col min-h-[520px]">
                <div class="flex items-center justify-between mb-4">
                    <div>
                        <h2 class="font-bold text-slate-800 text-base flex items-center gap-2">
                            <span class="w-2.5 h-2.5 rounded-full bg-sky-600 animate-ping"></span>
                            <span>Peta Satelit Live Monitoring Ambulans</span>
                        </h2>
                        <p class="text-xs text-slate-500">Koordinat otomatis diperbarui secara realtime dari GPS ambulans.</p>
                    </div>
                    <button type="button" @click="fitAllMarkers()"
                            class="px-3 py-1.5 rounded-xl text-xs font-semibold bg-slate-100 hover:bg-slate-200 text-slate-700 transition-colors">
                        Fokus Seluruh Jalur
                    </button>
                </div>

                <!-- Map Container -->
                <div id="tracking-map" class="w-full h-full min-h-[460px] rounded-2xl border border-slate-200/80 z-10"></div>
            </div>
        </div>

    </div>

    <!-- Rating Modal -->
    @if($showRatingModal)
        <div class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/70 backdrop-blur-xs">
            <div class="bg-white rounded-3xl max-w-md w-full p-6 sm:p-8 shadow-2xl border border-slate-200">
                <div class="text-center mb-6">
                    <div class="w-16 h-16 rounded-full bg-emerald-50 text-emerald-600 flex items-center justify-center mx-auto mb-4 border border-emerald-100">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-extrabold text-slate-800">Perjalanan Selesai!</h3>
                    <p class="text-slate-500 text-xs mt-1">Bagaimana pengalaman pelayanan ambulans GSC SIAGA?</p>
                </div>

                <form wire:submit="submitRating" class="space-y-4">
                    <div>
                        <label class="block text-xs font-bold text-slate-600 uppercase tracking-wider text-center mb-2">Skor Bintang (1 - 5)</label>
                        <div class="flex justify-center gap-2">
                            @for($s=1; $s<=5; $s++)
                                <button type="button" wire:click="$set('skor', {{ $s }})"
                                        class="p-2 rounded-xl border {{ $skor >= $s ? 'bg-amber-400 text-white border-amber-500' : 'bg-slate-100 text-slate-400 border-slate-200' }} transition-colors">
                                    <svg class="w-6 h-6 fill-current" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                    </svg>
                                </button>
                            @endfor
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1.5">Ulasan / Testimoni Anda</label>
                        <textarea wire:model="ulasan" rows="3"
                                  placeholder="Tulis ulasan tentang kecepatan, keramahtamahan supir, dll..."
                                  class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:border-sky-500 focus:ring-2 focus:ring-sky-200 text-sm font-medium"></textarea>
                    </div>

                    <div class="flex gap-3 pt-2">
                        <button type="submit"
                                class="flex-1 py-3.5 rounded-xl bg-sky-600 hover:bg-sky-700 text-white font-extrabold text-sm shadow-lg shadow-sky-600/30 transition-all">
                            KIRIM ULASAN
                        </button>
                        <button type="button" wire:click="$set('showRatingModal', false)"
                                class="px-4 py-3.5 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-600 font-bold text-sm transition-colors">
                            Lewati
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endif

    <!-- Leaflet JS Script -->
    <script>
        function trackingMapComponent(ambLat, ambLng, jemputLat, jemputLng, rsLat, rsLng) {
            return {
                map: null,
                ambMarker: null,
                jemputMarker: null,
                rsMarker: null,
                polyline: null,

                initMap() {
                    this.map = L.map('tracking-map').setView([ambLat, ambLng], 14);

                    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                        attribution: '&copy; OpenStreetMap contributors',
                        maxZoom: 19
                    }).addTo(this.map);

                    // Ambulance Marker
                    this.ambMarker = L.marker([ambLat, ambLng], {
                        title: 'Posisi Ambulans Saat Ini'
                    }).addTo(this.map)
                    .bindPopup('<b>Posisi Ambulans GSC</b><br>Secara realtime dari GPS')
                    .openPopup();

                    // Pickup Marker (Blue)
                    if (jemputLat && jemputLng) {
                        this.jemputMarker = L.marker([jemputLat, jemputLng]).addTo(this.map)
                        .bindPopup('<b>Titik Penjemputan Pasien</b>');
                    }

                    // Hospital Marker (Green)
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
                            color: '#0284C7',
                            weight: 4,
                            opacity: 0.8,
                            dashArray: '8, 8'
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
