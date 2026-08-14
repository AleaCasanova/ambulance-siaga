<div>

    
    <div class="absolute top-0 left-0 w-full h-80 bg-gradient-to-br from-primary-600 to-primary-700 -z-10">
        <!-- Decorative Pattern -->
        <div class="absolute inset-0 opacity-10" style="background-image: radial-gradient(circle at 2px 2px, white 1px, transparent 0); background-size: 32px 32px;"></div>
    </div>
    
    <main class="pt-32 pb-24 px-6 lg:px-12 max-w-7xl mx-auto min-h-screen">
        <div class="relative z-10" wire:poll.4s>
            <!-- Top Bar -->
    <div class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div class="flex items-center gap-4">
            <div class="w-20 h-20 rounded-full bg-white p-2 flex items-center justify-center shadow-lg border-2 border-primary-100/80 flex-shrink-0 overflow-hidden">
                <img src="{{ asset('images/logo_ambulansiaga.png') }}" alt="Logo Ambulance Siaga" class="w-full h-full object-contain">
            </div>
            <div>
                <div class="flex items-center gap-3 mb-1">
                    <span class="text-xs font-bold text-primary-100 uppercase tracking-wider">TRACKING REALTIME</span>
                    <span class="inline-flex items-center gap-1.5 px-3 py-0.5 rounded-full text-xs font-extrabold
                        @if($order->status === 'menunggu') bg-amber-100 text-amber-700
                        @elseif(in_array($order->status, ['diproses', 'menuju_lokasi', 'membawa_pasien'])) bg-primary-100 text-primary-700 animate-pulse
                        @elseif($order->status === 'selesai') bg-emerald-100 text-emerald-700
                        @else bg-slate-100 text-slate-600 @endif">
                        <span class="w-2 h-2 rounded-full @if(in_array($order->status, ['diproses', 'menuju_lokasi', 'membawa_pasien'])) bg-primary-600 animate-ping @else bg-current @endif"></span>
                        <span>{{ $order->status_label }}</span>
                    </span>
                </div>
                <h1 class="text-2xl sm:text-3xl font-extrabold text-white tracking-tight drop-shadow-md">Order #{{ $order->kode_order }}</h1>
                <p class="text-primary-100 text-sm mt-0.5">Pasien: <strong class="text-white">{{ $order->nama_pasien }}</strong> • Dibuat: {{ $order->waktu_pesan ? $order->waktu_pesan->translatedFormat('d M Y, H:i:s') : '-' }}</p>
            </div>
        </div>

        <div class="flex items-center gap-3">
            @if(in_array($order->status, ['menuju_lokasi', 'membawa_pasien']))
                <button type="button" wire:click="simulateGpsStep"
                        class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-slate-900 hover:bg-slate-800 text-white font-bold text-xs shadow-md transition-all">
                    <svg class="w-4 h-4 text-primary-400 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <span>Simulasikan Pergerakan GPS</span>
                </button>
            @endif

            @if(auth()->check())
                <a href="{{ route('masyarakat.order.complete', $order->id) }}"
                   class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-primary-50 border border-primary-200 text-primary-700 hover:bg-primary-100 font-bold text-xs shadow-xs transition-all">
                    <svg class="w-4 h-4 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    <span>Lengkapi / Edit Formulir Medis</span>
                </a>
            @endif

            <a href="{{ route('masyarakat.orders.index') }}"
               class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-white border border-transparent text-primary-600 text-xs font-bold hover:bg-primary-50 transition-colors shadow-lg">
                <span>&larr; Kembali ke Daftar</span>
            </a>
        </div>
    </div>

    <!-- Stepper Status Perjalanan -->
    <div class="bg-white rounded-3xl border border-slate-200/80 p-6 mb-8 shadow-xs overflow-x-auto">
        @php
            $steps = [
                ['key' => 'menunggu', 'label' => 'Menunggu Operator', 'icon' => '1'],
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
                        <div class="absolute top-5 left-1/2 w-full h-1 {{ $idx < $currentIdx ? 'bg-primary-600' : 'bg-slate-200' }} -z-0"></div>
                    @endif

                    <!-- Step Circle -->
                    <div class="w-10 h-10 rounded-full flex items-center justify-center font-bold text-sm z-10 transition-colors
                        {{ $idx <= $currentIdx ? 'bg-primary-600 text-white shadow-lg shadow-primary-600/30' : 'bg-slate-200 text-slate-500' }}">
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
                        <div class="w-14 h-14 rounded-2xl bg-primary-50 border border-primary-100 flex items-center justify-center text-primary-600 font-extrabold text-xl shadow-inner">
                            AMB
                        </div>
                        <div>
                            <span class="inline-block px-2.5 py-0.5 rounded text-[11px] font-bold bg-primary-100 text-primary-700 mb-0.5">
                                {{ $order->ambulans->kode_ambulans }} • {{ $order->supir->nama_lembaga ?: 'Mitra Ambulance Siaga' }}
                            </span>
                            <h3 class="font-bold text-slate-800 text-lg leading-tight">{{ $order->supir->user->name }}</h3>
                            <p class="text-xs text-slate-500">PJ: <strong class="text-slate-700">{{ $order->supir->nama_penanggung_jawab ?: $order->supir->user->name }}</strong> • Plat: <strong class="text-slate-700">{{ $order->ambulans->plat_nomor ?? $order->supir->plat_nomor }}</strong></p>
                        </div>
                    </div>

                    <div class="space-y-2 text-xs">
                        <div class="flex justify-between py-1 border-b border-slate-50">
                            <span class="text-slate-500">No. WA / Telepon Supir:</span>
                            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $order->supir->no_wa ?: $order->supir->user->phone) }}" target="_blank" class="font-bold text-emerald-600 hover:underline">
                                {{ $order->supir->no_wa ?: $order->supir->user->phone }}
                            </a>
                        </div>
                        <div class="flex justify-between py-1 border-b border-slate-50">
                            <span class="text-slate-500">Merk Kendaraan:</span>
                            <span class="font-bold text-slate-800">{{ $order->supir->merk_kendaraan ?: $order->ambulans->jenis_ambulans }}</span>
                        </div>
                        <div class="flex justify-between py-1 border-b border-slate-50">
                            <span class="text-slate-500">Alamat Unit:</span>
                            <span class="font-medium text-slate-700 text-right max-w-[200px]">{{ $order->supir->alamat_unit ?: '-' }}</span>
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
                    <p class="text-xs text-amber-700">Operator sedang memproses dan mencarikan armada ambulans terdekat dari jaringan mitra Ambulance Siaga untuk penjemputan.</p>
                </div>
            @endif

            <!-- Card Informasi Pasien & Jadwal Evakuasi -->
            <div class="bg-white rounded-3xl border border-slate-200/80 p-6 shadow-xs">
                <h3 class="font-bold text-slate-800 text-base mb-4 flex items-center gap-2">
                    <span class="w-2.5 h-2.5 rounded-full bg-emerald-600"></span>
                    <span>Informasi Pasien & Jadwal Evakuasi</span>
                </h3>

                <div class="grid grid-cols-2 gap-3 text-xs mb-3">
                    <div class="p-2.5 rounded-xl bg-slate-50 border border-slate-100">
                        <span class="text-slate-400 block font-semibold">NAMA PASIEN</span>
                        <span class="font-bold text-slate-800">{{ $order->nama_pasien }}</span>
                    </div>
                    <div class="p-2.5 rounded-xl bg-slate-50 border border-slate-100">
                        <span class="text-slate-400 block font-semibold">NIK PASIEN</span>
                        <span class="font-bold text-slate-800">{{ $order->nik_pasien ?: '-' }}</span>
                    </div>
                    <div class="p-2.5 rounded-xl bg-slate-50 border border-slate-100">
                        <span class="text-slate-400 block font-semibold">USIA / PENDAMPING</span>
                        <span class="font-bold text-slate-800">{{ $order->usia_pasien ?: '-' }} ({{ $order->jumlah_pendamping ?: 1 }} Org)</span>
                    </div>
                    <div class="p-2.5 rounded-xl bg-slate-50 border border-slate-100">
                        <span class="text-slate-400 block font-semibold">NO. HP KONTAK</span>
                        <span class="font-bold text-slate-800">{{ $order->no_hp_kontak ?: '-' }}</span>
                    </div>
                </div>

                <div class="space-y-2 text-xs">
                    <div class="flex justify-between py-1 border-b border-slate-50">
                        <span class="text-slate-500">Keperluan:</span>
                        <span class="font-extrabold text-primary-600">{{ $order->keperluan_penggunaan ?: 'IGD Darurat' }}</span>
                    </div>
                    <div class="flex justify-between py-1 border-b border-slate-50">
                        <span class="text-slate-500">Hari / Tanggal Jemput:</span>
                        <span class="font-bold text-slate-800">{{ $order->tanggal_jemput ? $order->tanggal_jemput->format('d M Y') : '-' }} ({{ $order->jam_jemput ?: '-' }})</span>
                    </div>
                    <div class="py-1 border-b border-slate-50">
                        <span class="text-slate-500 block">Diagnosa Medis:</span>
                        <span class="font-medium text-slate-700">{{ $order->diagnosa_medis ?: '-' }}</span>
                    </div>
                    <div class="py-1 border-b border-slate-50">
                        <span class="text-slate-500 block">Kondisi Pasien:</span>
                        <span class="font-medium text-slate-700">{{ $order->kondisi_pasien }}</span>
                    </div>
                    <div class="py-1">
                        <span class="text-slate-500 block">Alamat Antar / Tujuan:</span>
                        <span class="font-bold text-slate-800">{{ $order->tujuan_lokasi ?: '-' }}</span>
                    </div>
                </div>
            </div>

            <!-- Riwayat Status Perjalanan -->
            <div class="bg-white rounded-3xl border border-slate-200/80 p-6 shadow-xs">
                <h3 class="font-bold text-slate-800 text-base mb-4 flex items-center gap-2">
                    <span class="w-2.5 h-2.5 rounded-full bg-primary-600"></span>
                    <span>Log Aktivitas Perjalanan</span>
                </h3>

                <div class="space-y-4">
                    @foreach($order->statusPerjalanan->sortByDesc('created_at') as $statusItem)
                        <div class="flex items-start gap-3 text-xs">
                            <div class="w-2 h-2 rounded-full bg-primary-600 mt-1.5 flex-shrink-0"></div>
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

            <!-- Live Chat Komunikasi Darurat -->
            @if(in_array($order->status, ['diproses', 'menuju_lokasi', 'membawa_pasien']))
                <div class="bg-white rounded-3xl border border-slate-200/80 p-6 shadow-xs h-[500px]">
                    <livewire:chat-box :pemesananId="$order->id" />
                </div>
            @endif

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
        @php
            $isAssigned = in_array($order->status, ['diproses', 'menuju_lokasi', 'membawa_pasien', 'selesai']) && ($order->ambulans_id || $order->supir_id || $order->latestTracking);
            $ambLatVal = $isAssigned ? ($order->latestTracking?->latitude ?? ($order->ambulans?->lat_terakhir ?? null)) : null;
            $ambLngVal = $isAssigned ? ($order->latestTracking?->longitude ?? ($order->ambulans?->lng_terakhir ?? null)) : null;
            $jemputLatVal = $order->jemput_lat ?: -7.7188;
            $jemputLngVal = $order->jemput_lng ?: 109.0159;
            $rsLatVal = $order->rumahSakit?->lat ?? ($order->tujuan_lat ?? null);
            $rsLngVal = $order->rumahSakit?->lng ?? ($order->tujuan_lng ?? null);
        @endphp
        <div class="lg:col-span-7 flex flex-col lg:sticky lg:top-24 self-start"
             wire:ignore
             x-data="trackingMapComponent({{ $ambLatVal ?: 'null' }}, {{ $ambLngVal ?: 'null' }}, {{ $jemputLatVal }}, {{ $jemputLngVal }}, {{ $rsLatVal ?: 'null' }}, {{ $rsLngVal ?: 'null' }}, '{{ $order->status }}')"
             x-init="$nextTick(() => initMap())">
            <div class="bg-white rounded-3xl border border-slate-200/80 p-5 shadow-xs flex-1 flex flex-col min-h-[520px]">
                <div class="flex items-center justify-between mb-4">
                    <div>
                        <h2 class="font-bold text-slate-800 text-base flex items-center gap-2">
                            <span class="w-2.5 h-2.5 rounded-full bg-primary-600 animate-ping"></span>
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
                <div class="relative w-full h-full min-h-[460px] rounded-2xl border border-slate-200/80 overflow-hidden z-10">
                    <div id="tracking-map" class="w-full h-full min-h-[460px]"></div>

                    <!-- Floating Route Info Overlay (Grab / Google Maps style) -->
                    <div x-show="routeSummary" x-transition
                         class="absolute top-4 left-4 right-4 sm:right-auto sm:max-w-md z-[1000] bg-white/95 backdrop-blur-md p-3.5 rounded-2xl border border-slate-200/80 shadow-xl flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-primary-600 text-white flex items-center justify-center text-lg font-black shrink-0 shadow-md shadow-primary-600/30">
                            🧭
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="flex items-center gap-2">
                                <span class="text-sm font-extrabold text-slate-800" x-text="routeEta"></span>
                                <span class="text-xs font-bold text-primary-700 bg-primary-50 px-2.5 py-0.5 rounded-full border border-primary-100" x-text="routeDistance"></span>
                            </div>
                            <p class="text-xs text-slate-500 font-medium truncate mt-0.5" x-text="'Melalui: ' + routeSummary"></p>
                        </div>
                    </div>
                </div>
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
                    <p class="text-slate-500 text-xs mt-1">Bagaimana pengalaman pelayanan Ambulance Siaga?</p>
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
                                  class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:border-primary-500 focus:ring-2 focus:ring-primary-200 text-sm font-medium"></textarea>
                    </div>

                    <div class="flex gap-3 pt-2">
                        <button type="submit"
                                class="flex-1 py-3.5 rounded-xl bg-primary-600 hover:bg-primary-700 text-white font-extrabold text-sm shadow-lg shadow-primary-600/30 transition-all">
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
        function trackingMapComponent(ambLat, ambLng, jemputLat, jemputLng, rsLat, rsLng, orderStatus) {
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

                    this.map = L.map('tracking-map', {
                        zoomControl: true,
                        attributionControl: true
                    }).setView([defaultLat, defaultLng], 14);

                    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                        attribution: '&copy; OpenStreetMap contributors',
                        maxZoom: 19
                    }).addTo(this.map);

                    // Custom Div Icons agar tidak error 404 gambar PNG marker default Leaflet
                    const ambIcon = L.divIcon({
                        className: 'custom-amb-icon',
                        html: `<div style="background: linear-gradient(135deg, #0284C7, #0369A1); width: 38px; height: 38px; border-radius: 50%; border: 3px solid white; box-shadow: 0 4px 12px rgba(2,132,199,0.5); display: flex; align-items: center; justify-content: center; font-size: 18px;">🚑</div>`,
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

                    // Ambulance Marker - HANYA ditambahkan jika ambulans sudah ditugaskan/tersedia
                    if (ambLat && ambLng && ambLat !== 0 && ambLng !== 0) {
                        this.ambMarker = L.marker([ambLat, ambLng], {
                            icon: ambIcon,
                            title: 'Posisi Ambulans Saat Ini'
                        }).addTo(this.map)
                        .bindPopup('<b>Posisi Ambulans</b><br>Secara realtime dari satelit GPS')
                        .openPopup();
                    }

                    // Pickup Marker (Blue)
                    if (jemputLat && jemputLng) {
                        this.jemputMarker = L.marker([jemputLat, jemputLng], {
                            icon: jemputIcon
                        }).addTo(this.map)
                        .bindPopup('<b>Titik Penjemputan Pasien</b>');
                    }

                    // Hospital Marker (Green)
                    if (rsLat && rsLng && rsLat !== 0) {
                        this.rsMarker = L.marker([rsLat, rsLng], {
                            icon: rsIcon
                        }).addTo(this.map)
                        .bindPopup('<b>Rumah Sakit Rujukan / Tujuan</b>');
                    }

                    this.drawPolyline(orderStatus);
                    this.fitAllMarkers();

                    setTimeout(() => {
                        if (this.map) {
                            this.map.invalidateSize();
                            this.fitAllMarkers();
                        }
                    }, 350);

                    setTimeout(() => {
                        if (this.map) {
                            this.map.invalidateSize();
                        }
                    }, 1000);
                },

                updateAmbulancePos(newLat, newLng) {
                    if (this.ambMarker) {
                        this.ambMarker.setLatLng([newLat, newLng]);
                        this.map.panTo([newLat, newLng]);
                        this.drawPolyline('menuju_lokasi');
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

                    // Fallback jika offline/error: gunakan L.polyline lurus biasa
                    return L.polyline([startLatLng, endLatLng], {
                        color: color,
                        weight: weight,
                        opacity: opacity,
                        dashArray: '8, 8'
                    }).addTo(this.map);
                },

                async drawPolyline(statusOrder) {
                    if (this.polyline) {
                        this.map.removeLayer(this.polyline);
                        this.polyline = null;
                    }
                    if (this.polyline2) {
                        this.map.removeLayer(this.polyline2);
                        this.polyline2 = null;
                    }

                    // Kasus 1: Ambulans belum ditugaskan (status 'menunggu' -> tidak ada ambMarker)
                    // Rute jalan nyata dari Titik Jemput ke Rumah Sakit (Rencana Rute Evakuasi)
                    if (!this.ambMarker && this.jemputMarker && this.rsMarker) {
                        this.polyline = await this.fetchOsrmRoute(
                            this.jemputMarker.getLatLng(),
                            this.rsMarker.getLatLng(),
                            '#10B981', 5, 0.9, true
                        );
                        return;
                    }

                    // Kasus 2: Ambulans sedang membawa pasien ke RS
                    if (statusOrder === 'membawa_pasien' && this.ambMarker && this.rsMarker) {
                        this.polyline = await this.fetchOsrmRoute(
                            this.ambMarker.getLatLng(),
                            this.rsMarker.getLatLng(),
                            '#0284C7', 5.5, 0.95, true
                        );
                        return;
                    }

                    // Kasus 3: Ambulans menuju lokasi jemput / diproses
                    if (this.ambMarker && this.jemputMarker) {
                        this.polyline = await this.fetchOsrmRoute(
                            this.ambMarker.getLatLng(),
                            this.jemputMarker.getLatLng(),
                            '#0284C7', 5.5, 0.95, true
                        );
                    }
                    if (this.jemputMarker && this.rsMarker) {
                        this.polyline2 = await this.fetchOsrmRoute(
                            this.jemputMarker.getLatLng(),
                            this.rsMarker.getLatLng(),
                            '#10B981', 4, 0.75, false
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
        </div>
    </main>
    
    <x-landing-footer />

    @if(!$order->is_form_complete)
        <!-- Pop-up Modal Peringatan Lengkapi Formulir -->
        <div x-data="{ showCompleteAlertModal: true }"
             x-show="showCompleteAlertModal"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 translate-y-10 scale-95"
             x-transition:enter-end="opacity-100 translate-y-0 scale-100"
             class="fixed bottom-6 right-6 z-50 max-w-sm w-full mx-4 sm:mx-0 bg-white rounded-3xl shadow-2xl border-2 border-amber-400/90 overflow-hidden">

            <!-- Header Pop-up -->
            <div class="bg-gradient-to-r from-amber-500 to-amber-600 px-5 py-3.5 text-white flex items-center justify-between shadow-xs">
                <div class="flex items-center gap-2.5">
                    <span class="w-7 h-7 rounded-full bg-white text-amber-600 font-black text-sm flex items-center justify-center shadow-md animate-bounce">!</span>
                    <span class="font-extrabold text-xs sm:text-sm tracking-wide uppercase">Tindakan Diperlukan!</span>
                </div>
                <button @click="showCompleteAlertModal = false" class="text-white/80 hover:text-white font-bold text-lg px-1" title="Tutup sebentar">&times;</button>
            </div>

            <!-- Body Pop-up -->
            <div class="p-5 space-y-3.5 bg-amber-50/40">
                <p class="text-xs font-bold text-slate-800 leading-relaxed">
                    Pesanan Ambulans Darurat <span class="text-amber-700 font-black px-1.5 py-0.5 rounded-lg bg-amber-100 border border-amber-200">#{{ $order->kode_order }}</span> membutuhkan kelengkapan formulir medis!
                </p>
                <p class="text-xs text-slate-600 font-medium leading-relaxed">
                    Agar tim medis & rumah sakit rujukan dapat mempersiapkan penanganan dengan cepat, silakan lengkapi formulir kebutuhan ambulans sekarang.
                </p>
                <div class="pt-1 flex items-center gap-2">
                    <a href="{{ route('masyarakat.order.complete', $order->id) }}"
                       class="flex-1 py-3 px-4 rounded-xl bg-amber-500 hover:bg-amber-600 text-white font-extrabold text-xs text-center shadow-lg shadow-amber-600/30 transition-all transform active:scale-95 flex items-center justify-center gap-2">
                        <span>LENGKAPI FORM SEKARANG</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    @endif
</div>
