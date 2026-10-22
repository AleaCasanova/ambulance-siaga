<div wire:poll.5s>
    <!-- Dedicated Hero Section: Masyarakat Dashboard (Tanggap Darurat 24 Jam - Static & Senada Beranda) -->
    <section class="relative pt-20 overflow-hidden bg-[#002b2f]">
        <!-- Background Image (Ambulans HD Senada Beranda) -->
        <div class="absolute inset-0 z-0 bg-cover bg-center"
             style="background-image: url('{{ asset('images/ambulance_thumb2.JPG') }}');">
            <!-- Overlay Transparan untuk Mempertajam Teks (Terang & Jernih) -->
            <div class="absolute inset-0 bg-black/20"></div>
            <div class="absolute inset-0 bg-gradient-to-r from-black/65 via-black/25 to-transparent"></div>
        </div>

        <!-- Hero Content -->
        <div class="max-w-7xl mx-auto px-6 lg:px-12 min-h-[500px] sm:min-h-[560px] lg:min-h-[580px] flex items-center relative z-20 py-16 sm:py-20">
            <div class="max-w-3xl text-left text-white pr-4 lg:pr-12">
                <!-- Badge -->
                <div class="mb-4 sm:mb-5">
                    <span class="inline-flex items-center gap-2 bg-black/45 backdrop-blur-md text-white border border-white/20 px-4 py-1.5 rounded-full text-[10px] sm:text-xs font-bold tracking-widest uppercase shadow-md">
                        <span class="w-2 h-2 rounded-full {{ $activeOrder ? 'bg-amber-400' : 'bg-red-500' }} animate-pulse"></span>
                        <span>{{ $activeOrder ? 'STATUS: EVAKUASI AMBULANS SEDANG BERLANGSUNG' : 'PUSAT KENDALI AMBULANS MASYARAKAT 24 JAM' }}</span>
                    </span>
                </div>

                <!-- Big Headline (Meniru Teks Atas Foto: Plus Jakarta Sans Bold/Black) -->
                <h1 class="text-3xl sm:text-5xl lg:text-6xl font-black leading-tight sm:leading-[1.15] mb-4 sm:mb-6 text-white drop-shadow-[0_3px_6px_rgba(0,0,0,0.85)] tracking-tight">
                    Halo, {{ $user?->name ?? 'Warga Siaga' }}
                </h1>

                <!-- Subtitle (Meniru Teks Bawah Foto: Plus Jakarta Sans Medium/Clean) -->
                <p class="text-xs sm:text-base lg:text-lg text-slate-100 mb-8 sm:mb-10 max-w-2xl leading-relaxed font-medium drop-shadow-[0_2px_4px_rgba(0,0,0,0.8)]">
                    Pusat layanan tanggap darurat medis Kabupaten Cilacap terintegrasi 24 jam. Siaga merespon panggilan ambulans gawat darurat, penjemputan pasien, dan rujukan faskes secara 100% gratis.
                </p>

                <!-- Action Buttons (Senada Beranda Guest) -->
                <div class="flex flex-wrap items-center gap-3 sm:gap-4">
                    <a href="{{ route('masyarakat.order.create') }}" 
                       class="inline-flex items-center justify-center gap-2.5 bg-red-600 hover:bg-red-700 text-white px-6 sm:px-8 py-3.5 sm:py-4 rounded-xl font-black text-xs sm:text-sm uppercase tracking-wider transition-all shadow-[0_4px_20px_rgba(220,38,38,0.45)] hover:shadow-2xl active:scale-95 border border-red-500/50">
                        <span class="w-2 h-2 rounded-full bg-white animate-ping"></span>
                        <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                        <span>Pesan Ambulans Sekarang</span>
                    </a>

                    <a href="tel:{{ preg_replace('/[^0-9]/', '', $teleponDarurat) }}" 
                       class="inline-flex items-center justify-center gap-2 bg-primary-600 hover:bg-primary-700 text-white px-5 sm:px-7 py-3.5 sm:py-4 rounded-xl font-bold text-xs sm:text-sm uppercase tracking-wider transition-all shadow-[0_4px_15px_rgba(0,156,166,0.4)] hover:shadow-lg active:scale-95">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                        <span>Hotline: {{ $teleponDarurat }}</span>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Main Content below Hero (Floating Overlap Proportional Layout) -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-12 -mt-10 sm:-mt-14 relative z-30 space-y-8 pb-24">

        <!-- Flash Message Notification -->
        @if(session()->has('success'))
            <div x-data="{ show: true }" x-show="show" class="p-4 rounded-2xl bg-emerald-600 text-white font-medium text-sm shadow-lg flex items-center justify-between border border-emerald-500">
                <div class="flex items-center gap-3">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                    <span>{{ session('success') }}</span>
                </div>
                <button @click="show = false" class="text-white/80 hover:text-white font-bold text-lg leading-none">&times;</button>
            </div>
        @endif

        <!-- 1. ACTIVE ORDER BANNER (Jika sedang ada pesanan darurat berlangsung) -->
        @if($activeOrder)
            <div class="relative overflow-hidden p-6 sm:p-7 rounded-2xl bg-white shadow-[0_15px_45px_rgba(245,158,11,0.12)] border-l-[6px] border-l-amber-500 border-y border-r border-amber-200/70">
                <div class="absolute -left-10 top-1/2 -translate-y-1/2 w-32 h-32 bg-amber-500/10 blur-3xl rounded-full pointer-events-none"></div>

                <div class="flex flex-col md:flex-row md:items-center justify-between gap-5 relative z-10">
                    <div class="space-y-2">
                        <div class="flex items-center gap-2.5">
                            <span class="px-2.5 py-1 rounded-md bg-amber-50 text-amber-700 font-extrabold text-[10px] uppercase tracking-wider border border-amber-200/60 flex items-center gap-1.5 shadow-xs">
                                <span class="w-1.5 h-1.5 rounded-full bg-amber-500 animate-pulse"></span>
                                Evakuasi Sedang Berlangsung
                            </span>
                            <span class="text-xs font-mono font-bold text-slate-500 bg-slate-100 px-2 py-0.5 rounded">#{{ $activeOrder->kode_order }}</span>
                        </div>
                        <h2 class="text-xl sm:text-2xl font-black text-slate-800 tracking-tight">
                            Penanganan Pasien: {{ $activeOrder->nama_pasien }}
                        </h2>
                        <div class="flex flex-wrap items-center gap-3 text-xs sm:text-sm font-medium text-slate-600">
                            <span class="flex items-center gap-1.5">
                                <svg class="w-4 h-4 text-slate-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg> 
                                {{ $activeOrder->lokasi_jemput }}
                            </span>
                            <span class="text-slate-300">•</span>
                            <span class="text-amber-600 font-bold">{{ $activeOrder->status_label }}</span>
                            @if($activeOrder->ambulans)
                                <span class="text-slate-300">•</span>
                                <span class="flex items-center gap-1.5 font-mono text-slate-700">
                                    <svg class="w-4 h-4 text-slate-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17a2 2 0 11-4 0 2 2 0 014 0zM19 17a2 2 0 11-4 0 2 2 0 014 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1M5 17a2 2 0 104 0m-4 0a2 2 0 114 0m6 0a2 2 0 104 0m-4 0a2 2 0 114 0"/></svg> 
                                    {{ $activeOrder->ambulans->kode_ambulans }} ({{ $activeOrder->ambulans->plat_nomor }})
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="flex flex-wrap items-center gap-2.5 shrink-0 pt-2 md:pt-0 md:border-l md:border-slate-100 md:pl-5">
                        <a href="{{ route('masyarakat.tracking', $activeOrder->id) }}"
                           class="px-5 py-3 rounded-xl bg-amber-500 hover:bg-amber-600 text-white font-bold text-xs shadow-md shadow-amber-500/20 transition-all flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"></path></svg>
                            <span>Pantau Lokasi Live</span>
                        </a>

                        @if($activeOrder->needsFormCompletion())
                            <a href="{{ route('masyarakat.order.complete', $activeOrder->id) }}"
                               class="px-4 py-3 rounded-xl bg-white border border-slate-200 text-slate-700 hover:bg-slate-50 font-bold text-xs shadow-xs transition-all">
                                Lengkapi Data
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        @endif

        <!-- 2. TIGA FLOATING METRIC CARDS (Senada Beranda Guest) -->
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 sm:gap-6">
            <!-- Card 1: Kesiapan Armada -->
            <div class="p-6 rounded-2xl bg-white border border-slate-100 shadow-[0_15px_45px_rgba(15,23,42,0.08)] flex items-center justify-between transition-all hover:-translate-y-0.5 duration-300">
                <div>
                    <span class="text-[11px] font-bold text-slate-400 uppercase tracking-wider block mb-1">Kesiapan Armada</span>
                    <div class="flex items-baseline gap-2">
                        <span class="text-3xl font-black text-slate-900">{{ $ambulansTersedia }}</span>
                        <span class="text-xs font-bold text-emerald-700 bg-emerald-50 px-2.5 py-0.5 rounded-full border border-emerald-200">
                            Unit Siaga dari {{ $totalAmbulans }} Total
                        </span>
                    </div>
                    <p class="text-xs text-slate-500 mt-1.5 font-medium">Posko siaga & mitra faskes Cilacap</p>
                </div>
                <div class="w-13 h-13 rounded-2xl bg-primary-50 text-primary-600 flex items-center justify-center shrink-0 border border-primary-100 shadow-2xs">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M8 7h8m-8 4h8m-8 4h4m5-10H5a2 2 0 00-2 2v10a2 2 0 002 2h14a2 2 0 002-2V7a2 2 0 00-2-2z"/><circle cx="7.5" cy="16.5" r="1.5"/><circle cx="16.5" cy="16.5" r="1.5"/></svg>
                </div>
            </div>

            <!-- Card 2: Status Akun Medis (ICE) -->
            <div class="p-6 rounded-2xl bg-white border border-slate-100 shadow-[0_15px_45px_rgba(15,23,42,0.08)] flex items-center justify-between transition-all hover:-translate-y-0.5 duration-300">
                <div>
                    <span class="text-[11px] font-bold text-slate-400 uppercase tracking-wider block mb-1">Data Darurat Keluarga (ICE)</span>
                    <div class="flex items-center gap-2 mb-1.5">
                        @if($user?->masyarakat?->nik && $user?->masyarakat?->alamat)
                            <span class="px-2.5 py-0.5 rounded-full text-xs font-bold bg-emerald-50 text-emerald-700 border border-emerald-200 flex items-center gap-1.5">
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                Terisi Lengkap
                            </span>
                        @else
                            <span class="px-2.5 py-0.5 rounded-full text-xs font-bold bg-amber-50 text-amber-700 border border-amber-200 flex items-center gap-1.5">
                                <span class="w-1.5 h-1.5 rounded-full bg-amber-500 animate-pulse"></span>
                                Belum Lengkap
                            </span>
                        @endif
                    </div>
                    <button type="button" wire:click="$set('showEditIceModal', true)" class="text-xs text-primary-600 hover:text-primary-800 font-bold inline-flex items-center gap-1 transition-colors">
                        <span>{{ $user?->masyarakat?->alamat ? 'Perbarui Data ICE' : '+ Lengkapi Data Darurat' }}</span>
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
                    </button>
                </div>
                <div class="w-13 h-13 rounded-2xl bg-slate-50 text-slate-700 flex items-center justify-center shrink-0 border border-slate-200 shadow-2xs">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2"/></svg>
                </div>
            </div>

            <!-- Card 3: Layanan Bebas Biaya -->
            <div class="p-6 rounded-2xl bg-white border border-slate-100 shadow-[0_15px_45px_rgba(15,23,42,0.08)] flex items-center justify-between transition-all hover:-translate-y-0.5 duration-300">
                <div>
                    <span class="text-[11px] font-bold text-slate-400 uppercase tracking-wider block mb-1">Ketentuan Tarif</span>
                    <span class="text-2xl sm:text-3xl font-black text-emerald-600 block mb-1">100% Bebas Biaya</span>
                    <p class="text-xs text-slate-500 font-medium">Didanai donasi kemanusiaan & relawan mitra</p>
                </div>
                <div class="w-13 h-13 rounded-2xl bg-emerald-50 text-emerald-600 flex items-center justify-center shrink-0 border border-emerald-100 shadow-2xs">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                </div>
            </div>
        </div>

        <!-- 3. MAIN CONTENT GRID: 2 COLUMNS (8 Cols Kiri & 4 Cols Kanan) -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">

            <!-- LEFT COLUMN: Panduan P3K Darurat & Direktori Rumah Sakit (8 Cols) -->
            <div class="lg:col-span-8 space-y-8">

                <!-- Modul 1: Panduan Cepat P3K (Pertolongan Pertama Sambil Menunggu Ambulans) -->
                <div id="panduan-p3k" class="bg-white rounded-2xl border border-slate-200/90 p-6 sm:p-7 shadow-xs" x-data="{ activeTab: 'cpr' }">
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-5 pb-4 border-b border-slate-100">
                        <div>
                            <span class="text-xs font-bold uppercase tracking-wider text-red-700 bg-red-50 px-2.5 py-1 rounded-md border border-red-200">
                                Panduan Medis Darurat (P3K)
                            </span>
                            <h2 class="text-lg sm:text-xl font-extrabold text-slate-900 mt-2 tracking-tight">
                                Tindakan Pertama Sambil Menunggu Ambulans
                            </h2>
                            <p class="text-slate-500 text-xs sm:text-sm mt-0.5 font-medium">
                                Langkah awal yang dapat Anda lakukan secara aman untuk menstabilkan kondisi pasien.
                            </p>
                        </div>
                    </div>

                    <!-- Category Tabs -->
                    <div class="flex items-center gap-2 overflow-x-auto pb-2 mb-5 border-b border-slate-100 no-scrollbar">
                        <button type="button" @click="activeTab = 'cpr'"
                                :class="activeTab === 'cpr' ? 'bg-primary-600 text-white shadow-xs' : 'bg-slate-100 text-slate-700 hover:bg-slate-200'"
                                class="px-3.5 py-2 rounded-lg text-xs font-bold whitespace-nowrap transition-all flex items-center gap-1.5">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                            <span>Henti Jantung (CPR)</span>
                        </button>
                        <button type="button" @click="activeTab = 'sesak'"
                                :class="activeTab === 'sesak' ? 'bg-primary-600 text-white shadow-xs' : 'bg-slate-100 text-slate-700 hover:bg-slate-200'"
                                class="px-3.5 py-2 rounded-lg text-xs font-bold whitespace-nowrap transition-all flex items-center gap-1.5">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                            <span>Sesak & Tersedak</span>
                        </button>
                        <button type="button" @click="activeTab = 'pingsan'"
                                :class="activeTab === 'pingsan' ? 'bg-primary-600 text-white shadow-xs' : 'bg-slate-100 text-slate-700 hover:bg-slate-200'"
                                class="px-3.5 py-2 rounded-lg text-xs font-bold whitespace-nowrap transition-all flex items-center gap-1.5">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            <span>Pingsan / Hilang Sadar</span>
                        </button>
                        <button type="button" @click="activeTab = 'darah'"
                                :class="activeTab === 'darah' ? 'bg-primary-600 text-white shadow-xs' : 'bg-slate-100 text-slate-700 hover:bg-slate-200'"
                                class="px-3.5 py-2 rounded-lg text-xs font-bold whitespace-nowrap transition-all flex items-center gap-1.5">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/></svg>
                            <span>Pendarahan & Luka</span>
                        </button>
                        <button type="button" @click="activeTab = 'tulang'"
                                :class="activeTab === 'tulang' ? 'bg-primary-600 text-white shadow-xs' : 'bg-slate-100 text-slate-700 hover:bg-slate-200'"
                                class="px-3.5 py-2 rounded-lg text-xs font-bold whitespace-nowrap transition-all flex items-center gap-1.5">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            <span>Cedera & Patah Tulang</span>
                        </button>
                    </div>

                    <!-- Tab Contents -->
                    <div class="space-y-4">
                        <!-- Tab 1: CPR -->
                        <div x-show="activeTab === 'cpr'" class="p-4 rounded-xl bg-slate-50 border border-slate-200/80 text-xs sm:text-sm text-slate-700 space-y-2.5">
                            <h3 class="font-bold text-slate-900 text-sm flex items-center gap-2">
                                <span class="w-2 h-2 rounded-full bg-red-600"></span>
                                <span>Langkah Resusitasi Jantung Paru (CPR / RJP):</span>
                            </h3>
                            <ol class="list-decimal list-inside space-y-1.5 text-slate-600 font-normal leading-relaxed">
                                <li><strong>Cek Respons & Pernapasan:</strong> Tepuk pundak pasien dan panggil dengan suara jelas. Amati apakah dada bergerak bernapas.</li>
                                <li><strong>Posisikan di Permukaan Datar:</strong> Baringkan korban terlentang di atas permukaan yang keras dan rata.</li>
                                <li><strong>Kompresi Dada Cepat:</strong> Letakkan tumit salah satu telapak tangan di tengah dada (tulang dada), kunci dengan tangan lain. Tekan sedalam 5-6 cm dengan kecepatan 100-120 kali per menit.</li>
                                <li><strong>Lakukan Terus:</strong> Lanjutkan kompresi sampai tim medis ambulans tiba untuk mengambil alih.</li>
                            </ol>
                        </div>

                        <!-- Tab 2: Sesak -->
                        <div x-show="activeTab === 'sesak'" class="p-4 rounded-xl bg-slate-50 border border-slate-200/80 text-xs sm:text-sm text-slate-700 space-y-2.5" style="display: none;">
                            <h3 class="font-bold text-slate-900 text-sm flex items-center gap-2">
                                <span class="w-2 h-2 rounded-full bg-sky-600"></span>
                                <span>Penanganan Sesak Napas & Tersedak (Choking):</span>
                            </h3>
                            <ol class="list-decimal list-inside space-y-1.5 text-slate-600 font-normal leading-relaxed">
                                <li><strong>Posisikan Setengah Duduk:</strong> Longgarkan kerah baju atau pakaian ketat di sekitar leher dan dada. Posisikan pasien duduk nyaman bersandar.</li>
                                <li><strong>Pastikan Sirkulasi Udara Bebas:</strong> Buka jendela dan jauhkan kerumunan orang dari sekitar pasien.</li>
                                <li><strong>Jika Tersedak Benda Padat:</strong> Berdiri di belakang korban, lingkarkan lengan di perut bagian atas pusar, lalu lakukan hentakan cepat ke arah dalam dan atas (<i>Heimlich maneuver</i>).</li>
                            </ol>
                        </div>

                        <!-- Tab 3: Pingsan -->
                        <div x-show="activeTab === 'pingsan'" class="p-4 rounded-xl bg-slate-50 border border-slate-200/80 text-xs sm:text-sm text-slate-700 space-y-2.5" style="display: none;">
                            <h3 class="font-bold text-slate-900 text-sm flex items-center gap-2">
                                <span class="w-2 h-2 rounded-full bg-amber-600"></span>
                                <span>Penanganan Pasien Pingsan (Sinkop):</span>
                            </h3>
                            <ol class="list-decimal list-inside space-y-1.5 text-slate-600 font-normal leading-relaxed">
                                <li><strong>Tinggikan Posisi Kaki:</strong> Baringkan pasien telentang, lalu angkat posisi kaki sekitar 30 cm lebih tinggi dari dada untuk mengalirkan darah ke otak.</li>
                                <li><strong>Longgarkan Pakaian:</strong> Buka kancing kerah atau pakaian ketat agar jalan napas tidak terhambat.</li>
                                <li><strong>Jangan Beri Minum Saat Tidak Sadar:</strong> Hindari memasukkan air atau obat ke mulut korban yang belum sadar penuh karena berisiko tersedak ke paru-paru.</li>
                            </ol>
                        </div>

                        <!-- Tab 4: Pendarahan & Luka Bakar -->
                        <div x-show="activeTab === 'darah'" class="p-4 rounded-xl bg-slate-50 border border-slate-200/80 text-xs sm:text-sm text-slate-700 space-y-2.5" style="display: none;">
                            <h3 class="font-bold text-slate-900 text-sm flex items-center gap-2">
                                <span class="w-2 h-2 rounded-full bg-rose-600"></span>
                                <span>Penanganan Pendarahan & Luka Bakar:</span>
                            </h3>
                            <ol class="list-decimal list-inside space-y-1.5 text-slate-600 font-normal leading-relaxed">
                                <li><strong>Tekan Langsung Titik Pendarahan:</strong> Gunakan kain bersih atau kassa steril, tekan luka secara stabil tanpa sering membukanya hingga bantuan medis tiba.</li>
                                <li><strong>Penanganan Luka Bakar:</strong> Aliri segera dengan air mengalir suhu ruang selama 10-15 menit. Jangan mengoleskan pasta gigi, minyak, mentega, atau bahan kimia lain.</li>
                            </ol>
                        </div>

                        <!-- Tab 5: Patah Tulang -->
                        <div x-show="activeTab === 'tulang'" class="p-4 rounded-xl bg-slate-50 border border-slate-200/80 text-xs sm:text-sm text-slate-700 space-y-2.5" style="display: none;">
                            <h3 class="font-bold text-slate-900 text-sm flex items-center gap-2">
                                <span class="w-2 h-2 rounded-full bg-purple-600"></span>
                                <span>Penanganan Patah Tulang & Cedera Tulang Belakang:</span>
                            </h3>
                            <ol class="list-decimal list-inside space-y-1.5 text-slate-600 font-normal leading-relaxed">
                                <li><strong>Hindari Menggerakkan Korban:</strong> Jika terdapat kecurigaan cedera leher atau punggung akibat benturan keras/kecelakaan, jangan ubah posisi kepala dan tubuh korban.</li>
                                <li><strong>Imobilisasi:</strong> Biarkan bagian tubuh yang dicurigai patah pada posisinya, jangan dipaksa diluruskan. Tunggu tandu khusus dari tim medis ambulans.</li>
                            </ol>
                        </div>
                    </div>
                </div>

                <!-- Modul 2: Direktori Rumah Sakit & Layanan IGD 24 Jam di Cilacap (Auto-Slider 2 Cards) -->
                <div id="rumah-sakit" 
                     class="bg-white rounded-2xl border border-slate-200/90 p-5 sm:p-7 shadow-xs relative overflow-hidden"
                     x-data="{
                         track: null,
                         timer: null,
                         init() {
                             this.track = this.$refs.sliderTrack;
                             this.startAutoSlide();
                         },
                         startAutoSlide() {
                             this.stopAutoSlide();
                             // Geser otomatis setiap 5 detik (santai & nyaman dibaca)
                             this.timer = setInterval(() => {
                                 this.next();
                             }, 5000);
                         },
                         stopAutoSlide() {
                             if (this.timer) {
                                 clearInterval(this.timer);
                                 this.timer = null;
                             }
                         },
                         next() {
                             if (!this.track) return;
                             const maxScroll = this.track.scrollWidth - this.track.clientWidth;
                             // Jika sudah di ujung kanan, kembali ke awal
                             if (this.track.scrollLeft >= maxScroll - 20) {
                                 this.track.scrollTo({ left: 0, behavior: 'smooth' });
                             } else {
                                 const step = this.track.clientWidth;
                                 this.track.scrollBy({ left: step, behavior: 'smooth' });
                             }
                         },
                         prev() {
                             if (!this.track) return;
                             const maxScroll = this.track.scrollWidth - this.track.clientWidth;
                             if (this.track.scrollLeft <= 20) {
                                 this.track.scrollTo({ left: maxScroll, behavior: 'smooth' });
                             } else {
                                 const step = this.track.clientWidth;
                                 this.track.scrollBy({ left: -step, behavior: 'smooth' });
                             }
                         }
                     }"
                     @mouseenter="stopAutoSlide()"
                     @mouseleave="startAutoSlide()"
                     @touchstart="stopAutoSlide()"
                     @touchend="startAutoSlide()">

                    <!-- Header Section with Prev/Next Controls -->
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-5 pb-4 border-b border-slate-100">
                        <div>
                            <div class="flex items-center gap-2">
                                <span class="text-xs font-bold uppercase tracking-wider text-emerald-800 bg-emerald-50 px-2.5 py-1 rounded-md border border-emerald-200">
                                    Jaringan Faskes Rujukan
                                </span>
                                <span class="text-xs text-slate-400 font-medium hidden sm:inline">• 30 Faskes Siaga</span>
                            </div>
                            <h2 class="text-lg sm:text-xl font-extrabold text-slate-900 mt-2 tracking-tight">
                                Rumah Sakit & Layanan IGD 24 Jam
                            </h2>
                            <p class="text-slate-500 text-xs sm:text-sm mt-0.5 font-medium">
                                Kontak langsung instalasi gawat darurat rumah sakit di wilayah Kabupaten Cilacap.
                            </p>
                        </div>

                        <!-- Navigation Controls -->
                        <div class="flex items-center gap-2 shrink-0 self-end sm:self-center">
                            <button @click="prev()"
                                    type="button"
                                    aria-label="Faskes Sebelumnya"
                                    class="w-8 h-8 sm:w-9 sm:h-9 rounded-xl border border-slate-200 bg-slate-50 hover:bg-primary-600 hover:text-white hover:border-primary-600 text-slate-600 flex items-center justify-center transition-all cursor-pointer shadow-2xs active:scale-95">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/></svg>
                            </button>
                            <button @click="next()"
                                    type="button"
                                    aria-label="Faskes Berikutnya"
                                    class="w-8 h-8 sm:w-9 sm:h-9 rounded-xl border border-slate-200 bg-slate-50 hover:bg-primary-600 hover:text-white hover:border-primary-600 text-slate-600 flex items-center justify-center transition-all cursor-pointer shadow-2xs active:scale-95">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
                            </button>
                        </div>
                    </div>

                    <!-- 2-Card Visible Slider Track -->
                    <div x-ref="sliderTrack"
                         class="flex gap-4 overflow-x-auto scroll-smooth snap-x snap-mandatory py-1 [scrollbar-width:none] [-ms-overflow-style:none] [&::-webkit-scrollbar]:hidden">
                        @forelse($rumahSakits as $rs)
                            <div class="snap-start shrink-0 w-full sm:w-[calc(50%-8px)] p-4 sm:p-5 rounded-xl bg-slate-50 border border-slate-200/80 hover:bg-white hover:border-primary-200 hover:shadow-sm transition-all flex flex-col justify-between min-h-[175px]">
                                <div>
                                    <div class="flex items-start justify-between gap-2 mb-1.5">
                                        <h3 class="font-bold text-slate-900 text-sm truncate" title="{{ $rs->nama }}">
                                            {{ $rs->nama }}
                                        </h3>
                                        <span class="px-2 py-0.5 rounded text-[10px] font-bold bg-emerald-100 text-emerald-800 shrink-0">
                                            IGD 24 JAM
                                        </span>
                                    </div>
                                    <p class="text-xs text-slate-500 mb-3 flex items-start gap-1.5">
                                        <svg class="w-3.5 h-3.5 text-slate-400 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                        <span class="line-clamp-2 font-normal" title="{{ $rs->alamat }}">{{ $rs->alamat }}</span>
                                    </p>
                                </div>

                                <div class="pt-3 border-t border-slate-200/60 flex items-center justify-between gap-2">
                                    <a href="tel:{{ preg_replace('/[^0-9]/', '', $rs->telepon) }}"
                                       class="inline-flex items-center gap-1.5 text-xs font-bold text-slate-700 bg-white px-3 py-1.5 rounded-lg border border-slate-200 hover:bg-slate-100 transition-all">
                                        <svg class="w-3.5 h-3.5 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                                        <span>IGD: {{ $rs->telepon }}</span>
                                    </a>

                                    <a href="https://www.google.com/maps/search/?api=1&query={{ urlencode($rs->nama . ' ' . $rs->alamat) }}"
                                       target="_blank"
                                       class="text-xs font-semibold text-primary-600 hover:text-primary-800 p-1.5 hover:underline flex items-center gap-1"
                                       title="Buka di Google Maps">
                                        <span>Peta</span>
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                                    </a>
                                </div>
                            </div>
                        @empty
                            <div class="w-full py-8 text-center text-slate-400 text-xs font-medium">
                                Belum ada data rumah sakit rujukan terdaftar.
                            </div>
                        @endforelse
                    </div>
                </div>

            </div>

            <!-- RIGHT COLUMN: Profil Darurat ICE & Program Sosial Ambulans Siaga (4 Cols) -->
            <div class="lg:col-span-4 space-y-6">

                <!-- Card ICE: Profil Medis Darurat Tersimpan -->
                <div class="bg-white rounded-2xl border border-slate-200/90 p-5 sm:p-6 shadow-xs">
                    <div class="flex items-center justify-between mb-3 pb-3 border-b border-slate-100">
                        <div class="flex items-center gap-2">
                            <span class="w-2.5 h-2.5 rounded-full bg-primary-600"></span>
                            <h3 class="font-bold text-slate-900 text-sm tracking-tight">Profil Darurat Anda (ICE)</h3>
                        </div>
                        <button type="button" wire:click="$set('showEditIceModal', true)"
                                class="text-xs font-bold text-primary-600 hover:text-primary-800 hover:underline">
                            Edit Data
                        </button>
                    </div>

                    <p class="text-xs text-slate-500 mb-4 font-normal leading-relaxed">
                        Data ini digunakan untuk mengisi formulir pemesanan ambulans secara otomatis saat kondisi darurat.
                    </p>

                    <div class="space-y-2 text-xs">
                        <div class="p-2.5 rounded-lg bg-slate-50 border border-slate-100 flex justify-between items-center">
                            <span class="text-slate-500 font-medium">Nama Lengkap:</span>
                            <span class="font-bold text-slate-800">{{ $user?->name }}</span>
                        </div>

                        <div class="p-2.5 rounded-lg bg-slate-50 border border-slate-100 flex justify-between items-center">
                            <span class="text-slate-500 font-medium">Nomor WhatsApp:</span>
                            <span class="font-bold text-slate-800">{{ $user?->phone ?: '-' }}</span>
                        </div>

                        <div class="p-2.5 rounded-lg bg-slate-50 border border-slate-100 flex justify-between items-center">
                            <span class="text-slate-500 font-medium">NIK KTP:</span>
                            <span class="font-bold text-slate-800 font-mono">{{ $user?->masyarakat?->nik ?: '-' }}</span>
                        </div>

                        <div class="p-2.5 rounded-lg bg-slate-50 border border-slate-100 flex justify-between items-center">
                            <span class="text-slate-500 font-medium">Kontak Darurat Keluarga:</span>
                            <span class="font-bold {{ $user?->masyarakat?->kontak_darurat ? 'text-slate-800' : 'text-amber-600' }}">
                                {{ $user?->masyarakat?->kontak_darurat ?: 'Belum diisi' }}
                            </span>
                        </div>

                        <div class="p-2.5 rounded-lg bg-slate-50 border border-slate-100">
                            <span class="text-slate-500 font-medium block mb-0.5">Alamat Penjemputan Utama:</span>
                            <span class="font-bold text-slate-800 block leading-snug">{{ $user?->masyarakat?->alamat ?: 'Belum mengatur alamat tempat tinggal' }}</span>
                        </div>
                    </div>

                    <button type="button" wire:click="$set('showEditIceModal', true)"
                            class="w-full mt-3.5 py-2.5 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold text-xs transition-colors">
                        Atur Alamat & Kontak Keluarga
                    </button>
                </div>

                <!-- Card Riwayat Terakhir -->
                <div class="bg-white rounded-2xl border border-slate-200/90 p-5 sm:p-6 shadow-xs">
                    <div class="flex items-center justify-between mb-3 pb-3 border-b border-slate-100">
                        <h3 class="font-bold text-slate-900 text-sm flex items-center gap-2 tracking-tight">
                            <span class="w-2.5 h-2.5 rounded-full bg-emerald-500"></span>
                            <span>Riwayat Pesanan Anda</span>
                        </h3>
                        <a href="{{ route('masyarakat.orders.index') }}" class="text-xs font-bold text-primary-600 hover:underline">
                            Lihat Semua &rarr;
                        </a>
                    </div>

                    <div class="space-y-2.5">
                        @forelse($recentOrders as $ro)
                            <div class="p-3 rounded-xl bg-slate-50 border border-slate-100 hover:bg-slate-100/70 transition-colors">
                                <div class="flex items-center justify-between text-xs mb-1">
                                    <span class="font-mono font-bold text-slate-800">#{{ $ro->kode_order }}</span>
                                    <span class="px-2 py-0.5 rounded text-[10px] font-bold
                                        @if($ro->status === 'selesai') bg-emerald-100 text-emerald-800
                                        @elseif($ro->status === 'dibatalkan') bg-slate-200 text-slate-600
                                        @else bg-primary-100 text-primary-800 @endif">
                                        {{ strtoupper($ro->status_label) }}
                                    </span>
                                </div>
                                <p class="text-xs font-semibold text-slate-800 truncate">{{ $ro->nama_pasien }}</p>
                                <p class="text-[11px] text-slate-500 truncate mt-0.5">{{ $ro->lokasi_jemput }}</p>
                                <div class="mt-2 pt-2 border-t border-slate-200/60 flex items-center justify-between text-[11px]">
                                    <span class="text-slate-400 font-medium">{{ $ro->waktu_pesan ? $ro->waktu_pesan->format('d M Y') : '-' }}</span>
                                    <a href="{{ route('masyarakat.tracking', $ro->id) }}" class="font-bold text-primary-600 hover:underline">
                                        Detail Rute &rarr;
                                    </a>
                                </div>
                            </div>
                        @empty
                            <div class="py-6 text-center text-slate-400 text-xs font-medium">
                                Belum ada riwayat pesanan ambulans.
                            </div>
                        @endforelse
                    </div>
                </div>

                <!-- Card Donasi Kemanusiaan Ambulans Siaga -->
                <div class="bg-gradient-to-br from-primary-800 to-slate-900 text-white rounded-2xl p-5 sm:p-6 shadow-md border border-primary-700/50">
                    <div class="flex items-center gap-2.5 mb-2">
                        <div class="w-8 h-8 rounded-lg bg-white/10 flex items-center justify-center text-white shrink-0">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                        </div>
                        <h3 class="text-sm font-bold tracking-tight">Dukungan Operasional Ambulans</h3>
                    </div>
                    <p class="text-xs text-sky-100 font-normal mt-1 mb-4 leading-relaxed">
                        Layanan evakuasi medis darurat ini beroperasi gratis 100% untuk masyarakat berkat infaq dan donasi kemanusiaan para dermawan.
                    </p>
                    <a href="{{ route('donasi') }}"
                       class="inline-flex items-center justify-center gap-2 w-full py-2.5 rounded-xl bg-white hover:bg-slate-100 text-slate-900 font-bold text-xs text-center shadow-xs transition-all">
                        <span>Salurkan Donasi Operasional</span>
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </a>
                </div>

            </div>

        </div>

    </main>

    <!-- Modal Edit Profil Darurat (ICE) -->
    @if($showEditIceModal)
        <div class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-xs">
            <div class="bg-white rounded-2xl max-w-lg w-full p-6 sm:p-7 shadow-xl border border-slate-200 animate-in fade-in zoom-in duration-150">
                <div class="flex items-center justify-between mb-4 pb-3 border-b border-slate-100">
                    <div>
                        <h3 class="text-base font-bold text-slate-900 tracking-tight">Pengaturan Data Darurat (ICE)</h3>
                        <p class="text-xs text-slate-500 font-medium">Lengkapi data untuk mempercepat proses pemanggilan ambulans.</p>
                    </div>
                    <button type="button" wire:click="$set('showEditIceModal', false)" class="text-slate-400 hover:text-slate-600 font-bold text-xl leading-none">&times;</button>
                </div>

                <form wire:submit.prevent="saveIceProfile" class="space-y-3.5 text-xs">
                    <div>
                        <label class="font-bold text-slate-700 block mb-1">Nomor Induk Kependudukan (NIK)</label>
                        <input type="text" wire:model="ice_nik" placeholder="16 digit NIK KTP..."
                               class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-xs font-medium focus:ring-2 focus:ring-primary-500">
                    </div>

                    <div>
                        <label class="font-bold text-slate-700 block mb-1">Kontak Darurat Keluarga / Kerabat</label>
                        <input type="text" wire:model="ice_kontak_darurat" placeholder="Contoh: 081234567890 (Istri / Kerabat)"
                               class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-xs font-medium focus:ring-2 focus:ring-primary-500">
                    </div>

                    <div>
                        <label class="font-bold text-slate-700 block mb-1">Alamat Tempat Tinggal / Titik Jemput Utama</label>
                        <textarea wire:model="ice_alamat" rows="3" placeholder="Jl. Gatot Subroto No. ..., RT/RW, Kelurahan, Kecamatan..."
                                  class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-xs font-medium focus:ring-2 focus:ring-primary-500"></textarea>
                    </div>

                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label class="font-bold text-slate-700 block mb-1">Tanggal Lahir</label>
                            <input type="date" wire:model="ice_tanggal_lahir"
                                   class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-xs font-medium focus:ring-2 focus:ring-primary-500">
                        </div>
                        <div>
                            <label class="font-bold text-slate-700 block mb-1">Jenis Kelamin</label>
                            <select wire:model="ice_jenis_kelamin" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-xs font-medium focus:ring-2 focus:ring-primary-500">
                                <option value="L">Laki-Laki</option>
                                <option value="P">Perempuan</option>
                            </select>
                        </div>
                    </div>

                    <div class="pt-4 flex items-center justify-end gap-2.5 border-t border-slate-100">
                        <button type="button" wire:click="$set('showEditIceModal', false)"
                                class="px-4 py-2.5 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold text-xs transition-colors">
                            Batal
                        </button>
                        <button type="submit"
                                class="px-5 py-2.5 rounded-xl bg-primary-600 hover:bg-primary-700 text-white font-bold text-xs shadow-xs transition-colors">
                            Simpan Data
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endif

    <x-floating-donasi />
    <x-landing-footer />
</div>
