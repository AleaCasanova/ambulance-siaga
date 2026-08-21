<div>

    
    <div class="absolute top-0 left-0 w-full h-80 bg-gradient-to-br from-primary-600 to-primary-700 -z-10">
        <!-- Decorative Pattern -->
        <div class="absolute inset-0 opacity-10" style="background-image: radial-gradient(circle at 2px 2px, white 1px, transparent 0); background-size: 32px 32px;"></div>
    </div>
    
    <main class="pt-32 pb-24 px-6 lg:px-12 max-w-7xl mx-auto min-h-screen">
        <div class="relative z-10" wire:poll.2500ms>
            <!-- Top Bar -->
    <div class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div class="flex items-center gap-4">
            <div class="w-20 h-20 rounded-full bg-white p-2 flex items-center justify-center shadow-lg border-2 border-primary-100/80 flex-shrink-0 overflow-hidden">
                <img src="{{ asset('images/logo_ambulansiaga.png') }}" alt="Logo Ambulans Siaga" class="w-full h-full object-contain">
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
                <div x-data="{ autoDriving: false, autoDriveInterval: null }"
                     x-init="
                        $watch('autoDriving', val => {
                            if (val) {
                                $wire.simulateGpsStep();
                                autoDriveInterval = setInterval(() => {
                                    if (!autoDriving) { clearInterval(autoDriveInterval); return; }
                                    $wire.simulateGpsStep();
                                }, 2000);
                            } else {
                                if (autoDriveInterval) { clearInterval(autoDriveInterval); autoDriveInterval = null; }
                            }
                        })
                     "
                     @gps-updated.window="if ($event.detail?.arrived) { autoDriving = false; }">
                    <button type="button"
                            @click="autoDriving = !autoDriving"
                            :class="autoDriving ? 'bg-amber-500 hover:bg-amber-600 text-white ring-2 ring-amber-300' : 'bg-slate-900 hover:bg-slate-800 text-white'"
                            class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl font-extrabold text-xs shadow-md transition-all cursor-pointer active:scale-95">
                        <template x-if="!autoDriving">
                            <span class="flex items-center gap-1.5">
                                <svg class="w-3.5 h-3.5 fill-current text-primary-400" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                                <span>▶ Simulasi Otomatis</span>
                            </span>
                        </template>
                        <template x-if="autoDriving">
                            <span class="flex items-center gap-1.5">
                                <span class="w-2 h-2 rounded-full bg-white animate-ping"></span>
                                <svg class="w-3.5 h-3.5 fill-current text-white" viewBox="0 0 24 24"><path d="M6 19h4V5H6v14zm8-14v14h4V5h-4z"/></svg>
                                <span>⏸ Jeda Simulasi</span>
                            </span>
                        </template>
                    </button>
                </div>
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

    @php
        $isAssigned = in_array($order->status, ['diproses', 'menuju_lokasi', 'membawa_pasien', 'selesai']) && ($order->ambulans_id || $order->supir_id || $order->latestTracking);
        $ambLatVal = $isAssigned ? ($order->latestTracking ? (float)$order->latestTracking->lat : (float)$currentLat) : null;
        $ambLngVal = $isAssigned ? ($order->latestTracking ? (float)$order->latestTracking->lng : (float)$currentLng) : null;
        $jemputLatVal = $order->jemput_lat ?: -7.7188;
        $jemputLngVal = $order->jemput_lng ?: 109.0159;
        $rsLatVal = $order->tujuan_lat ? (float)$order->tujuan_lat : ($order->rumahSakit?->lat ?? -7.7289);
        $rsLngVal = $order->tujuan_lng ? (float)$order->tujuan_lng : ($order->rumahSakit?->lng ?? 109.0094);
    @endphp

    <!-- Main Grid: Driver Info (Left) & Realtime Map (Right) -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8"
         x-data="trackingMapComponent(
             {{ $ambLatVal !== null ? (float)$ambLatVal : 'null' }}, 
             {{ $ambLngVal !== null ? (float)$ambLngVal : 'null' }}, 
             {{ (float)$jemputLatVal }}, 
             {{ (float)$jemputLngVal }}, 
             {{ (float)$rsLatVal }}, 
             {{ (float)$rsLngVal }}, 
             '{{ $order->status }}'
         )"
         x-init="initMap()"
         @gps-updated.window="
            let payload = ($event.detail && typeof $event.detail === 'object' && 'lat' in $event.detail) 
                ? $event.detail 
                : (Array.isArray($event.detail) && $event.detail[0] ? $event.detail[0] : ($event.detail || {}));
            let lat = payload?.lat;
            let lng = payload?.lng;
            let status = payload?.status;
            if (lat && lng) {
                updateAmbulancePos(lat, lng, status);
            }
         "
         @status-changed.window="
            let payload = ($event.detail && typeof $event.detail === 'object' && 'status' in $event.detail) 
                ? $event.detail 
                : (Array.isArray($event.detail) && $event.detail[0] ? $event.detail[0] : ($event.detail || {}));
            if (payload?.status) {
                onStatusChanged(payload.status);
            }
         ">

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
                                {{ $order->ambulans->kode_ambulans }} • {{ $order->supir->nama_lembaga ?: 'Mitra Ambulans Siaga' }}
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
                    <p class="text-xs text-amber-700">Operator sedang memproses dan mencarikan armada ambulans terdekat dari jaringan mitra Ambulans Siaga untuk penjemputan.</p>
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

        <!-- Right Column: Realtime Leaflet Map (7 Cols) -->
        <div class="lg:col-span-7 space-y-4">
            <div class="bg-white rounded-3xl border border-slate-200/80 p-4 sm:p-6 shadow-xs space-y-4">
                
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2">
                    <div>
                        <div class="flex items-center gap-2">
                            <span class="w-2.5 h-2.5 rounded-full bg-primary-500 animate-ping"></span>
                            <h2 class="font-bold text-slate-800 text-base">Peta Satelit Live Monitoring Ambulans</h2>
                        </div>
                        <p class="text-xs text-slate-400 mt-0.5">Koordinat otomatis diperbarui secara realtime dari GPS ambulans.</p>
                    </div>
                    <button type="button" @click="fitAllMarkers()"
                            class="self-start sm:self-auto px-3 py-1.5 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-bold transition-colors">
                        Fokus Seluruh Jalur
                    </button>
                </div>

                <!-- Map Container -->
                <div class="relative w-full h-[520px] rounded-2xl overflow-hidden border border-slate-200 shadow-inner" wire:ignore>
                    <div id="tracking-map" class="w-full h-full z-0"></div>

                    <!-- Floating ETA Badge -->
                    <div x-show="routeDistance"
                         class="absolute top-4 left-4 z-[400] bg-white/95 backdrop-blur-md rounded-2xl p-3.5 shadow-xl border border-slate-100 flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-primary-700 flex items-center justify-center text-white shadow-md">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"/></svg>
                        </div>
                        <div>
                            <div class="flex items-center gap-2">
                                <span class="text-sm font-extrabold text-slate-900" x-text="routeEta"></span>
                                <span class="text-xs font-bold text-primary-800 bg-primary-100 px-2 py-0.5 rounded-full" x-text="routeDistance"></span>
                            </div>
                            <p class="text-[11px] text-slate-500 font-medium truncate max-w-[200px]" x-text="routeSummary"></p>
                        </div>
                    </div>
                </div>

                <!-- Legend & Panduan Simbol -->
                <div class="p-3.5 rounded-2xl bg-slate-50 border border-slate-100 flex flex-wrap items-center justify-between gap-3 text-xs">
                    <div class="flex items-center gap-4 flex-wrap">
                        <div class="flex items-center gap-1.5 font-bold text-slate-700">
                            <span class="w-3 h-3 rounded-full bg-[#0284C7] inline-block"></span>
                            <span>Ambulans Siaga (Bergerak)</span>
                        </div>
                        <div class="flex items-center gap-1.5 font-bold text-slate-700" x-show="!['membawa_pasien', 'selesai'].includes(orderStatus)">
                            <span class="w-3 h-3 rounded-full bg-[#3B82F6] inline-block"></span>
                            <span>Titik Jemput Pasien</span>
                        </div>
                        <div class="flex items-center gap-1.5 font-bold text-slate-700" x-show="['membawa_pasien', 'selesai'].includes(orderStatus)">
                            <span class="w-3 h-3 rounded-full bg-[#10B981] inline-block"></span>
                            <span>Rumah Sakit Rujukan</span>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>

    <!-- Rating & Review Modal (Setelah Pesanan Selesai) -->
    @if($showRatingModal)
        <div class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/70 backdrop-blur-xs animate-fade-in">
            <div class="bg-white rounded-3xl p-6 sm:p-8 max-w-md w-full shadow-2xl border border-slate-100 text-center relative"
                 @click.outside="$wire.showRatingModal = false">
                
                <div class="w-16 h-16 rounded-full bg-emerald-100 text-emerald-600 flex items-center justify-center mx-auto mb-4 shadow-inner">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                    </svg>
                </div>
                <h3 class="text-xl font-extrabold text-slate-800">Evakuasi Medis Selesai!</h3>
                <p class="text-slate-500 text-xs mt-1">Pasien telah tiba dengan selamat di Rumah Sakit. Berikan penilaian Anda untuk supir & pelayanan Ambulans Siaga.</p>

                <form wire:submit.prevent="submitRating" class="space-y-4 pt-2">
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-2 text-center">Beri Rating Pelayanan</label>
                        <div class="flex justify-center gap-2">
                            @for($i = 1; $i <= 5; $i++)
                                <button type="button" wire:click="$set('skor', {{ $i }})"
                                        class="text-3xl transition-transform hover:scale-110 focus:outline-hidden {{ $skor >= $i ? 'text-amber-400' : 'text-slate-200' }}">
                                    ★
                                </button>
                            @endfor
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Ulasan / Masukan (Opsional)</label>
                        <textarea wire:model="ulasan" rows="3" placeholder="Tuliskan pengalaman pelayanan ambulans..."
                                  class="w-full text-xs rounded-xl border border-slate-200 p-3 focus:ring-2 focus:ring-primary-500 focus:border-primary-500"></textarea>
                    </div>

                    <div class="flex gap-2">
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
                routeLayerGroup: null,
                routeReqId: 0,
                routeDistance: '',
                routeEta: '',
                routeSummary: '',
                ambLat: ambLat,
                ambLng: ambLng,
                jemputLat: jemputLat,
                jemputLng: jemputLng,
                rsLat: rsLat,
                rsLng: rsLng,
                orderStatus: orderStatus,

                initMap() {
                    window.trackingMapInstance = this;
                    const defaultLat = this.ambLat || this.jemputLat || -7.7188;
                    const defaultLng = this.ambLng || this.jemputLng || 109.0159;

                    this.map = L.map('tracking-map', {
                        zoomControl: true,
                        attributionControl: true
                    }).setView([defaultLat, defaultLng], 14);

                    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                        attribution: '&copy; OpenStreetMap contributors',
                        maxZoom: 19
                    }).addTo(this.map);

                    this.routeLayerGroup = L.layerGroup().addTo(this.map);

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

                    // Ambulance Marker
                    if (this.ambLat && this.ambLng && this.ambLat !== 0 && this.ambLng !== 0) {
                        this.ambMarker = L.marker([this.ambLat, this.ambLng], {
                            icon: ambIcon,
                            title: 'Posisi Ambulans Saat Ini'
                        }).addTo(this.map)
                        .bindPopup('<b>Posisi Ambulans</b><br>Secara realtime dari satelit GPS')
                        .openPopup();
                    }

                    // Pickup Marker (Blue) - Hanya ditampilkan saat tahap penjemputan
                    if (this.jemputLat && this.jemputLng && !['membawa_pasien', 'selesai'].includes(this.orderStatus)) {
                        this.jemputMarker = L.marker([this.jemputLat, this.jemputLng], {
                            icon: jemputIcon
                        }).addTo(this.map)
                        .bindPopup('<b>Titik Penjemputan Pasien</b>');
                    }

                    // Hospital Marker (Green) - Hanya ditampilkan saat tahap membawa pasien / selesai
                    if (this.rsLat && this.rsLng && this.rsLat !== 0 && ['membawa_pasien', 'selesai'].includes(this.orderStatus)) {
                        this.rsMarker = L.marker([this.rsLat, this.rsLng], {
                            icon: rsIcon
                        }).addTo(this.map)
                        .bindPopup('<b>Rumah Sakit Rujukan / Tujuan</b>');
                    }

                    this.drawPolyline(this.orderStatus);
                    this.fitAllMarkers();

                    setTimeout(() => {
                        if (this.map) {
                            this.map.invalidateSize();
                            this.fitAllMarkers();
                        }
                    }, 350);
                },

                onStatusChanged(newStatus) {
                    if (!newStatus) return;
                    this.orderStatus = newStatus;
                    this.drawPolyline(newStatus);
                    this.fitAllMarkers();
                },

                updateAmbulancePos(newLat, newLng, updatedStatus) {
                    let statusChanged = false;
                    if (updatedStatus && updatedStatus !== this.orderStatus) {
                        this.orderStatus = updatedStatus;
                        statusChanged = true;
                    }

                    if (newLat && newLng) {
                        this.ambLat = newLat;
                        this.ambLng = newLng;
                        if (this.ambMarker) {
                            this.ambMarker.setLatLng([newLat, newLng]);
                        } else {
                            const ambIcon = L.divIcon({
                                className: 'custom-amb-icon',
                                html: `<div style="background: linear-gradient(135deg, #0284C7, #0369A1); width: 38px; height: 38px; border-radius: 50%; border: 3px solid white; box-shadow: 0 4px 12px rgba(2,132,199,0.5); display: flex; align-items: center; justify-content: center; font-size: 18px;">🚑</div>`,
                                iconSize: [38, 38],
                                iconAnchor: [19, 19]
                            });
                            this.ambMarker = L.marker([newLat, newLng], {
                                icon: ambIcon,
                                title: 'Posisi Ambulans Saat Ini'
                            }).addTo(this.map)
                            .bindPopup('<b>Posisi Ambulans</b><br>Secara realtime dari satelit GPS');
                        }
                    }

                    this.drawPolyline(this.orderStatus);
                    if (statusChanged) {
                        this.fitAllMarkers();
                    }
                },

                async fetchOsrmRoute(startLatLng, endLatLng, color, weight, opacity, reqId) {
                    let routeCoords = [[startLatLng.lat, startLatLng.lng], [endLatLng.lat, endLatLng.lng]];
                    let distKm = '';
                    let etaMin = '';
                    let summary = 'Jalan Raya Utama';

                    try {
                        const url = `https://router.project-osrm.org/route/v1/driving/${startLatLng.lng},${startLatLng.lat};${endLatLng.lng},${endLatLng.lat}?overview=full&geometries=geojson&steps=true`;
                        const response = await fetch(url);
                        const data = await response.json();

                        if (data.code === 'Ok' && data.routes && data.routes.length > 0) {
                            const route = data.routes[0];
                            routeCoords = route.geometry.coordinates.map(c => [c[1], c[0]]);
                            distKm = (route.distance / 1000).toFixed(1) + ' km';
                            etaMin = Math.max(1, Math.ceil(route.duration / 60)) + ' Menit';
                            summary = (route.legs && route.legs[0] && route.legs[0].summary) ? route.legs[0].summary : 'Jalan Raya Utama';
                        }
                    } catch (e) {
                        console.warn('OSRM routing fallback:', e);
                    }

                    if (reqId !== this.routeReqId) {
                        return; // Abaikan respons tertunda
                    }

                    if (this.routeLayerGroup) {
                        this.routeLayerGroup.clearLayers();
                        const routeLayer = L.polyline(routeCoords, {
                            color: color,
                            weight: weight,
                            opacity: opacity,
                            lineCap: 'round',
                            lineJoin: 'round'
                        });
                        this.routeLayerGroup.addLayer(routeLayer);
                    }

                    if (distKm) {
                        this.routeDistance = distKm;
                        this.routeEta = etaMin;
                        this.routeSummary = summary;
                    }
                },

                async drawPolyline(statusOrder) {
                    const activeStatus = statusOrder || this.orderStatus;
                    this.orderStatus = activeStatus;
                    this.routeReqId = (this.routeReqId || 0) + 1;
                    const currentReq = this.routeReqId;

                    // Kasus 1: Ambulans sedang membawa pasien ke RS (Tahap 2)
                    if (activeStatus === 'membawa_pasien' || activeStatus === 'selesai') {
                        if (this.jemputMarker) {
                            this.map.removeLayer(this.jemputMarker);
                            this.jemputMarker = null;
                        }
                        if (!this.rsMarker && this.rsLat && this.rsLng) {
                            const rsIcon = L.divIcon({
                                className: 'custom-rs-icon',
                                html: `<div style="background: linear-gradient(135deg, #10B981, #059669); width: 34px; height: 34px; border-radius: 50%; border: 3px solid white; box-shadow: 0 4px 10px rgba(16,185,129,0.4); display: flex; align-items: center; justify-content: center; font-size: 16px;">🏥</div>`,
                                iconSize: [34, 34],
                                iconAnchor: [17, 34]
                            });
                            this.rsMarker = L.marker([this.rsLat, this.rsLng], { icon: rsIcon }).addTo(this.map).bindPopup('<b>Rumah Sakit Rujukan / Tujuan</b>');
                        }

                        if (this.ambMarker && this.rsMarker) {
                            await this.fetchOsrmRoute(
                                this.ambMarker.getLatLng(),
                                this.rsMarker.getLatLng(),
                                '#0284C7', 5.5, 0.95, currentReq
                            );
                        }
                        return;
                    }

                    // Kasus 2: Ambulans menuju lokasi jemput / diproses (Tahap 1)
                    if (this.rsMarker) {
                        this.map.removeLayer(this.rsMarker);
                        this.rsMarker = null;
                    }

                    if (!this.jemputMarker && this.jemputLat && this.jemputLng) {
                        const jemputIcon = L.divIcon({
                            className: 'custom-jemput-icon',
                            html: `<div style="background: linear-gradient(135deg, #3B82F6, #2563EB); width: 34px; height: 34px; border-radius: 50%; border: 3px solid white; box-shadow: 0 4px 10px rgba(59,130,246,0.4); display: flex; align-items: center; justify-content: center; font-size: 16px;">📍</div>`,
                            iconSize: [34, 34],
                            iconAnchor: [17, 34]
                        });
                        this.jemputMarker = L.marker([this.jemputLat, this.jemputLng], { icon: jemputIcon }).addTo(this.map).bindPopup('<b>Titik Penjemputan Pasien</b>');
                    }

                    if (this.ambMarker && this.jemputMarker) {
                        await this.fetchOsrmRoute(
                            this.ambMarker.getLatLng(),
                            this.jemputMarker.getLatLng(),
                            '#0284C7', 5.5, 0.95, currentReq
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
</div>
