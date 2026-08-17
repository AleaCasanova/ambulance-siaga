<div wire:poll.5s class="space-y-6 mb-8 -mt-4 sm:-mt-6">

    <!-- 1. Header Operasional Misi (Clean, No AI Gradient) -->
    <div class="bg-white rounded-xl border border-slate-200 p-5 sm:p-6 shadow-xs flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <div class="flex flex-wrap items-center gap-2 mb-1.5">
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider
                    @if($order->status === 'selesai') bg-emerald-50 text-emerald-700 border border-emerald-200
                    @elseif(in_array($order->status, ['menuju_lokasi', 'membawa_pasien', 'diproses'])) bg-sky-50 text-sky-700 border border-sky-200
                    @else bg-slate-100 text-slate-700 border border-slate-200 @endif">
                    <span class="w-2 h-2 rounded-full @if($order->status !== 'selesai') bg-sky-600 animate-ping @else bg-emerald-600 @endif"></span>
                    <span>
                        @if($order->status === 'diproses') TUGAS DITERIMA
                        @elseif($order->status === 'menuju_lokasi') MENUJU PENJEMPUTAN
                        @elseif($order->status === 'membawa_pasien') MENUJU RUMAH SAKIT
                        @elseif($order->status === 'selesai') TUGAS SELESAI
                        @else {{ strtoupper(str_replace('_', ' ', $order->status)) }} @endif
                    </span>
                </span>

                <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-xs font-bold bg-red-50 text-red-700 border border-red-200">
                    <span class="w-1.5 h-1.5 rounded-full bg-red-600"></span>
                    <span>PRIORITAS TINGGI</span>
                </span>

                <span class="font-mono text-xs text-slate-500 font-semibold">#{{ $order->kode_order }}</span>
            </div>

            <h1 class="text-xl sm:text-2xl font-bold text-slate-900 tracking-tight">
                {{ $order->nama_pasien }} <span class="text-sm font-normal text-slate-500">({{ $order->usia_pasien ?? '-' }} Thn)</span>
            </h1>
            <p class="text-xs text-slate-500 mt-1">
                Dibuat: {{ $order->waktu_pesan ? $order->waktu_pesan->translatedFormat('d M Y, H:i') : '-' }} • Keperluan: <strong class="text-slate-700">{{ $order->keperluan_penggunaan ?: 'IGD Darurat' }}</strong>
            </p>
        </div>

        <div class="flex items-center gap-2.5 shrink-0">
            <a href="{{ route('supir.dashboard') }}"
               class="px-4 py-2 rounded-lg bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-semibold transition-colors flex items-center gap-1.5">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                <span>Dashboard</span>
            </a>
            <a href="{{ route('supir.tugas.index') }}"
               class="px-4 py-2 rounded-lg bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-semibold transition-colors flex items-center gap-1.5">
                <span>Daftar Tugas</span>
            </a>
        </div>
    </div>

    <!-- 2. State Machine Action Console (1 Primary Action Berdasarkan Tahapan Misi) -->
    <div class="bg-white rounded-xl border border-slate-200 p-5 sm:p-6 shadow-xs space-y-5">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 pb-4 border-b border-slate-100">
            <div>
                <span class="text-xs font-bold text-slate-400 uppercase tracking-wider block mb-1">Tahap Operasional Sekarang</span>
                <h2 class="text-lg font-bold text-slate-900">
                    @if($order->status === 'diproses')
                        Tugas Diterima — Siap Meluncur ke Lokasi Jemput
                    @elseif($order->status === 'menuju_lokasi')
                        Ambulans Sedang Bergerak Menuju Titik Jemput
                    @elseif($order->status === 'membawa_pasien')
                        Pasien di Dalam Ambulans — Menuju Rumah Sakit
                    @elseif($order->status === 'selesai')
                        Evakuasi Medis Telah Selesai
                    @endif
                </h2>
            </div>

            <!-- Primary Action Button Berdasarkan State -->
            <div class="flex flex-wrap items-center gap-3">
                @php
                    $targetNavLat = ($order->status === 'membawa_pasien') ? ($order->tujuan_lat ?: ($order->rumahSakit?->lat ?? '')) : $order->jemput_lat;
                    $targetNavLng = ($order->status === 'membawa_pasien') ? ($order->tujuan_lng ?: ($order->rumahSakit?->lng ?? '')) : $order->jemput_lng;
                    $targetNavLabel = ($order->status === 'membawa_pasien') ? 'Navigasi RS Tujuan' : 'Navigasi Titik Jemput';
                @endphp

                @if($targetNavLat && $targetNavLng && $order->status !== 'selesai')
                    <a href="https://www.google.com/maps/dir/?api=1&destination={{ $targetNavLat }},{{ $targetNavLng }}"
                       target="_blank"
                       class="px-5 py-3 rounded-lg bg-sky-600 hover:bg-sky-700 text-white font-bold text-xs shadow-xs transition-all flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                        <span>{{ $targetNavLabel }} (Google Maps)</span>
                    </a>
                @endif

                @if($order->status === 'diproses')
                    <button type="button"
                            wire:click="updateStatus('menuju_lokasi')"
                            class="px-6 py-3 rounded-lg bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs shadow-xs transition-all flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                        <span>Mulai Menuju Penjemputan</span>
                    </button>
                @elseif($order->status === 'menuju_lokasi')
                    <button type="button"
                            wire:click="updateStatus('membawa_pasien')"
                            class="px-6 py-3 rounded-lg bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs shadow-xs transition-all flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        <span>Konfirmasi Tiba & Angkut Pasien ke RS</span>
                    </button>
                @elseif($order->status === 'membawa_pasien')
                    <button type="button"
                            wire:click="updateStatus('selesai')"
                            wire:confirm="Konfirmasi pasien telah tiba dengan aman di Rumah Sakit dan tugas evakuasi selesai?"
                            class="px-6 py-3 rounded-lg bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs shadow-xs transition-all flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        <span>Selesaikan Tugas di Rumah Sakit</span>
                    </button>
                @elseif($order->status === 'selesai')
                    <span class="inline-flex items-center gap-1.5 px-4 py-2.5 rounded-lg bg-emerald-50 text-emerald-800 text-xs font-bold border border-emerald-200">
                        <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        <span>Misi Evakuasi Selesai</span>
                    </span>
                @endif
            </div>
        </div>

        <!-- Stepper Progress Bar (Minimalist Line & Dot Track - Perfectly Centered & Symmetrical) -->
        @php
            $stepList = [
                [
                    'num' => 1,
                    'title' => 'Tugas Diterima',
                    'desc' => 'Penugasan terkonfirmasi',
                ],
                [
                    'num' => 2,
                    'title' => 'Menuju Lokasi Jemput',
                    'desc' => 'Ambulans meluncur ke titik jemput',
                ],
                [
                    'num' => 3,
                    'title' => 'Evakuasi Menuju RS',
                    'desc' => 'Membawa pasien menuju IGD',
                ],
                [
                    'num' => 4,
                    'title' => 'Selesai di IGD RS',
                    'desc' => 'Serah terima medis selesai',
                ],
            ];

            $currentStep = match($order->status) {
                'diproses' => 1,
                'menuju_lokasi' => 2,
                'membawa_pasien' => 3,
                'selesai' => 4,
                default => 1,
            };
        @endphp

        <div class="pt-2 pb-1 px-1 sm:px-2">
            <div class="flex items-start justify-between w-full">
                @foreach($stepList as $idx => $step)
                    @php
                        $isCompleted = $order->status === 'selesai' || $step['num'] < $currentStep;
                        $isActive = $order->status !== 'selesai' && $step['num'] === $currentStep;
                        $isUpcoming = $step['num'] > $currentStep && $order->status !== 'selesai';
                        
                        // Status garis penghubung ke titik berikutnya
                        $isLineActive = $order->status === 'selesai' || $step['num'] < $currentStep;
                    @endphp

                    <div class="flex-1 flex flex-col items-center relative text-center">
                        <!-- Connector Line to Next Step -->
                        @if($idx < count($stepList) - 1)
                            <div class="absolute top-3 sm:top-3.5 left-1/2 w-full h-[3px] -translate-y-1/2 bg-slate-200 z-0 overflow-hidden">
                                <div class="h-full bg-primary-600 transition-all duration-500 {{ $isLineActive ? 'w-full' : 'w-0' }}"></div>
                            </div>
                        @endif

                        <!-- Step Dot (Centered) -->
                        <div class="relative z-10 flex items-center justify-center mb-2.5">
                            @if($isCompleted)
                                <!-- Completed: Solid teal circle with checkmark -->
                                <div class="w-6 h-6 sm:w-7 sm:h-7 rounded-full bg-primary-600 text-white flex items-center justify-center shadow-xs ring-4 ring-white transition-all">
                                    <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.8" d="M5 13l4 4L19 7"/>
                                    </svg>
                                </div>
                            @elseif($isActive)
                                <!-- Active: Pulsing teal circle -->
                                <div class="relative flex items-center justify-center">
                                    <span class="absolute w-7 h-7 sm:w-8 sm:h-8 rounded-full bg-primary-400/30 animate-ping"></span>
                                    <div class="w-6 h-6 sm:w-7 sm:h-7 rounded-full bg-primary-600 text-white flex items-center justify-center shadow-md ring-4 ring-primary-100 transition-all">
                                        <div class="w-2 h-2 sm:w-2.5 sm:h-2.5 rounded-full bg-white"></div>
                                    </div>
                                </div>
                            @else
                                <!-- Upcoming: Inactive gray dot -->
                                <div class="w-4 h-4 sm:w-5 sm:h-5 rounded-full bg-slate-200 border-2 border-white ring-4 ring-white flex items-center justify-center transition-all">
                                    <div class="w-1.5 h-1.5 rounded-full bg-slate-300"></div>
                                </div>
                            @endif
                        </div>

                        <!-- Step Text Explanation (Simetris & Presisi di Tengah Titik) -->
                        <div class="px-1 max-w-[160px] sm:max-w-[200px]">
                            <h4 class="text-xs sm:text-sm font-extrabold leading-tight
                                @if($isActive) text-primary-900 font-black
                                @elseif($isCompleted) text-slate-800
                                @else text-slate-400 @endif">
                                {{ $step['title'] }}
                            </h4>
                            <p class="text-[10px] sm:text-[11px] mt-1 leading-snug hidden sm:block
                                @if($isActive) text-primary-700 font-medium
                                @elseif($isCompleted) text-slate-500
                                @else text-slate-400 @endif">
                                {{ $step['desc'] }}
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- 3. Main Grid: Detail Operasional & Peta Navigasi -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start"
         x-data="supirMapComponent({{ $currentLat }}, {{ $currentLng }}, {{ $order->jemput_lat }}, {{ $order->jemput_lng }}, {{ $order->tujuan_lat ?? 0 }}, {{ $order->tujuan_lng ?? 0 }})"
         x-init="initMap()"
         @gps-updated.window="updateAmbulancePos({{ $currentLat }}, {{ $currentLng }})">

        <!-- Left Column: Informasi Rute, Pasien, & Safety Center (5 Cols) -->
        <div class="lg:col-span-5 space-y-6">

            <!-- Card: Alur Rute Penjemputan & Tujuan -->
            <div class="bg-white rounded-xl border border-slate-200 p-5 shadow-xs space-y-3.5">
                <h3 class="text-sm font-bold text-slate-900 pb-2 border-b border-slate-100">Alur Rute Perjalanan</h3>

                <div class="space-y-2 text-xs">
                    <div class="p-3 rounded-lg bg-slate-50 border border-slate-100 space-y-1">
                        <div class="flex items-center gap-1.5 text-sky-700 font-bold">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/></svg>
                            <span class="uppercase text-[10px]">Titik Penjemputan Pasien</span>
                        </div>
                        <p class="font-bold text-slate-900 text-sm pl-5">{{ $order->lokasi_jemput }}</p>
                    </div>

                    <div class="p-3 rounded-lg bg-slate-50 border border-slate-100 space-y-1">
                        <div class="flex items-center gap-1.5 text-emerald-700 font-bold">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                            <span class="uppercase text-[10px]">Tujuan Rumah Sakit / IGD</span>
                        </div>
                        <p class="font-bold text-slate-900 text-sm pl-5">{{ $order->tujuan_lokasi ?? $order->rumahSakit?->nama ?? 'RSUD Cilacap' }}</p>
                    </div>
                </div>

                @if($order->kondisi_pasien)
                    <div class="p-3 rounded-lg bg-red-50 border border-red-200 text-xs">
                        <span class="text-red-700 font-bold block text-[10px] uppercase">Kondisi Pasien</span>
                        <p class="text-slate-800 font-medium mt-0.5">{{ $order->kondisi_pasien }}</p>
                    </div>
                @endif
            </div>

            <!-- Card: Safety Center (Pusat Keselamatan Driver) 🛡 -->
            <div class="bg-white rounded-xl border border-slate-200 p-5 shadow-xs space-y-3">
                <div class="flex items-center justify-between pb-2 border-b border-slate-100">
                    <div class="flex items-center gap-1.5">
                        <svg class="w-4 h-4 text-primary-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                        </svg>
                        <h3 class="text-sm font-bold text-slate-900">Pusat Keselamatan Driver</h3>
                    </div>
                    <span class="text-[10px] font-bold text-slate-400 uppercase">Emergency Protocol</span>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-2 text-xs">
                    <a href="https://wa.me/6281234560002?text=Halo%20Dispatcher%20GSC,%20saya%20driver%20tugas%20%23{{ $order->kode_order }}%20membutuhkan%20koordinasi."
                       target="_blank"
                       class="p-2.5 rounded-lg bg-slate-50 hover:bg-slate-100 border border-slate-200 text-slate-800 font-semibold transition-colors flex items-center gap-2">
                        <svg class="w-4 h-4 text-emerald-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                        <span>Hubungi Dispatcher</span>
                    </a>

                    @if($order->no_hp_kontak)
                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $order->no_hp_kontak) }}"
                           target="_blank"
                           class="p-2.5 rounded-lg bg-slate-50 hover:bg-slate-100 border border-slate-200 text-slate-800 font-semibold transition-colors flex items-center gap-2">
                            <svg class="w-4 h-4 text-sky-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
                            <span>Kontak Pelapor</span>
                        </a>
                    @endif
                </div>
            </div>

            <!-- Card: Detail Kontak & Medis Pasien -->
            <div class="bg-white rounded-xl border border-slate-200 p-5 shadow-xs space-y-3">
                <h3 class="text-sm font-bold text-slate-900 pb-2 border-b border-slate-100">Data Pelapor & Pasien</h3>

                <div class="space-y-2 text-xs">
                    <div class="flex justify-between py-1 border-b border-slate-50">
                        <span class="text-slate-500">Nama Pelapor:</span>
                        <span class="font-bold text-slate-800">{{ $order->user?->name ?? $order->nama_pasien }}</span>
                    </div>
                    <div class="flex justify-between py-1 border-b border-slate-50">
                        <span class="text-slate-500">No. WhatsApp Pelapor:</span>
                        <span class="font-bold text-emerald-600">{{ $order->no_hp_kontak ?: '-' }}</span>
                    </div>
                    <div class="flex justify-between py-1 border-b border-slate-50">
                        <span class="text-slate-500">NIK Pasien:</span>
                        <span class="font-mono text-slate-700">{{ $order->nik_pasien ?: '-' }}</span>
                    </div>
                    @if($order->diagnosa_medis)
                        <div class="py-1">
                            <span class="text-slate-500 block">Diagnosa Medis:</span>
                            <span class="font-semibold text-slate-800">{{ $order->diagnosa_medis }}</span>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Live Chat Komunikasi Darurat -->
            @if(in_array($order->status, ['diproses', 'menuju_lokasi', 'membawa_pasien']))
                <div class="bg-white rounded-xl border border-slate-200 p-5 shadow-xs h-[420px]">
                    <livewire:chat-box :pemesananId="$order->id" />
                </div>
            @endif

        </div>

        <!-- Right Column: Leaflet Map & GPS Broadcast (7 Cols) -->
        <div class="lg:col-span-7 flex flex-col lg:sticky lg:top-24 self-start" wire:ignore>
            <div class="bg-white rounded-xl border border-slate-200 p-4 sm:p-5 shadow-xs flex-1 flex flex-col min-h-[540px]">
                
                <div class="flex items-center justify-between mb-3 pb-2 border-b border-slate-100">
                    <div>
                        <h3 class="text-sm font-bold text-slate-900 flex items-center gap-2">
                            <span class="w-2 h-2 rounded-full bg-emerald-500 animate-ping"></span>
                            <span>Peta Navigasi & Satelit GPS</span>
                        </h3>
                        <p class="text-[11px] text-slate-500">Rute tercepat terhubung dengan satelit OSRM.</p>
                    </div>

                    <div class="flex items-center gap-2">
                        @if($targetNavLat && $targetNavLng)
                            <a href="https://www.google.com/maps/dir/?api=1&destination={{ $targetNavLat }},{{ $targetNavLng }}"
                               target="_blank"
                               class="px-3 py-1.5 rounded-lg text-xs font-bold bg-sky-50 text-sky-700 border border-sky-200 hover:bg-sky-100 transition-colors flex items-center gap-1">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                                <span>Google Maps</span>
                            </a>
                        @endif
                        <button type="button" @click="fitAllMarkers()"
                                class="px-3 py-1.5 rounded-lg text-xs font-semibold bg-slate-100 hover:bg-slate-200 text-slate-700 transition-colors">
                            Fokus Rute
                        </button>
                    </div>
                </div>

                <!-- Leaflet Map Box -->
                <div class="relative w-full h-full min-h-[440px] rounded-lg border border-slate-200 overflow-hidden z-10">
                    <div id="supir-map" class="w-full h-full min-h-[440px]"></div>

                    <!-- Turn-by-turn ETA bar -->
                    <div x-show="routeSummary" x-transition
                         class="absolute top-3 left-3 right-3 sm:right-auto sm:max-w-xs z-[1000] bg-white/95 backdrop-blur-xs p-3 rounded-lg border border-slate-200 shadow-md flex items-center gap-3">
                        <div class="w-8 h-8 rounded-lg bg-primary-700 text-white flex items-center justify-center shrink-0">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"/></svg>
                        </div>
                        <div class="min-w-0">
                            <div class="flex items-center gap-1.5">
                                <span class="text-xs font-bold text-slate-900" x-text="routeEta"></span>
                                <span class="text-[10px] font-bold text-primary-700 bg-primary-50 px-2 py-0.5 rounded-full border border-primary-100" x-text="routeDistance"></span>
                            </div>
                            <p class="text-[11px] text-slate-500 truncate" x-text="routeSummary"></p>
                        </div>
                    </div>
                </div>

                <!-- GPS Controller Footer -->
                @if(in_array($order->status, ['menuju_lokasi', 'membawa_pasien', 'diproses']))
                    <div class="mt-4 pt-3 border-t border-slate-100 flex flex-col sm:flex-row items-center justify-between gap-3"
                         x-data="gpsTracker(@this)">
                        
                        <div class="flex items-center gap-2">
                            <button type="button"
                                    x-show="gpsSupported"
                                    @click="toggleGps()"
                                    :class="gpsActive ? 'bg-emerald-600 text-white' : 'bg-slate-100 text-slate-700 hover:bg-slate-200'"
                                    class="px-4 py-2 rounded-lg text-xs font-bold transition-colors flex items-center gap-1.5">
                                <span class="w-2 h-2 rounded-full" :class="gpsActive ? 'bg-white animate-ping' : 'bg-slate-400'"></span>
                                <span x-text="gpsActive ? 'GPS Broadcast: ON' : 'Aktifkan GPS Realtime'"></span>
                            </button>

                            <button type="button"
                                    wire:click="simulateGpsStep"
                                    class="px-3 py-2 rounded-lg bg-slate-50 hover:bg-slate-100 text-slate-600 border border-slate-200 text-xs font-semibold transition-colors">
                                Simulasi Step
                            </button>
                        </div>

                        <span x-show="gpsActive" class="text-[11px] text-emerald-700 font-medium" x-text="'Koordinat: ' + (lastCoords || 'Menghubungkan...')"></span>
                    </div>
                @endif

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
                        attributionControl: false
                    }).setView([defaultLat, defaultLng], 14);

                    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                        maxZoom: 19
                    }).addTo(this.map);

                    window.supirMapInstance = this;

                    const ambIcon = L.divIcon({
                        className: 'custom-amb-icon',
                        html: `<div style="background:#0F2742; width:32px; height:32px; border-radius:50%; border:2px solid white; box-shadow:0 2px 8px rgba(0,0,0,0.3); display:flex; align-items:center; justify-content:center; color:white; font-weight:bold; font-size:13px;">🚑</div>`,
                        iconSize: [32, 32],
                        iconAnchor: [16, 16]
                    });

                    const jemputIcon = L.divIcon({
                        className: 'custom-jemput-icon',
                        html: `<div style="background:#0284C7; width:28px; height:28px; border-radius:50%; border:2px solid white; box-shadow:0 2px 6px rgba(2,132,199,0.4); display:flex; align-items:center; justify-content:center; color:white; font-size:12px;">📍</div>`,
                        iconSize: [28, 28],
                        iconAnchor: [14, 28]
                    });

                    const rsIcon = L.divIcon({
                        className: 'custom-rs-icon',
                        html: `<div style="background:#16A36A; width:28px; height:28px; border-radius:50%; border:2px solid white; box-shadow:0 2px 6px rgba(22,163,106,0.4); display:flex; align-items:center; justify-content:center; color:white; font-size:12px;">🏥</div>`,
                        iconSize: [28, 28],
                        iconAnchor: [14, 28]
                    });

                    this.ambMarker = L.marker([defaultLat, defaultLng], {
                        icon: ambIcon,
                        title: 'Posisi Ambulans'
                    }).addTo(this.map).bindPopup('<b>Posisi Ambulans</b>');

                    if (jemputLat && jemputLng) {
                        this.jemputMarker = L.marker([jemputLat, jemputLng], {
                            icon: jemputIcon
                        }).addTo(this.map).bindPopup('<b>Titik Jemput Pasien</b>');
                    }

                    if (rsLat && rsLng && rsLat !== 0) {
                        this.rsMarker = L.marker([rsLat, rsLng], {
                            icon: rsIcon
                        }).addTo(this.map).bindPopup('<b>Rumah Sakit Rujukan</b>');
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
                                const summary = (route.legs && route.legs[0] && route.legs[0].summary) ? route.legs[0].summary : 'Jalan Utama';

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
                        dashArray: '6, 6'
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
                            '#0284C7', 4.5, 0.9, true
                        );
                    }
                    if (this.jemputMarker && this.rsMarker) {
                        this.polyline2 = await this.fetchOsrmRoute(
                            this.jemputMarker.getLatLng(),
                            this.rsMarker.getLatLng(),
                            '#16A36A', 3.5, 0.8, false
                        );
                    }
                },

                fitAllMarkers() {
                    const bounds = L.latLngBounds([]);
                    if (this.ambMarker) bounds.extend(this.ambMarker.getLatLng());
                    if (this.jemputMarker) bounds.extend(this.jemputMarker.getLatLng());
                    if (this.rsMarker) bounds.extend(this.rsMarker.getLatLng());

                    if (bounds.isValid()) {
                        this.map.fitBounds(bounds, { padding: [50, 50], maxZoom: 15 });
                    }
                }
            }
        }
    </script>

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
                    const speed = position.coords.speed ? Math.round(position.coords.speed * 3.6) : 0;
                    const heading = position.coords.heading ? Math.round(position.coords.heading) : 0;

                    this.lastCoords = lat.toFixed(5) + ', ' + lng.toFixed(5);

                    livewireComponent.call('updateGpsLocation', lat, lng, speed, heading);

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
