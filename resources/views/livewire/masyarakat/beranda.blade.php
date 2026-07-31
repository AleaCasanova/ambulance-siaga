<div>
    <!-- Hero Banner (GSC Company Profile Blue Theme) -->
    <div class="relative overflow-hidden rounded-3xl bg-gradient-to-br from-sky-600 via-cyan-600 to-blue-700 text-white p-8 sm:p-12 mb-10 shadow-xl">
        <div class="relative z-10 max-w-3xl">
            <span class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full text-xs font-bold bg-white/15 border border-white/20 uppercase tracking-widest mb-4 backdrop-blur-xs">
                <span class="w-2 h-2 rounded-full bg-sky-300 animate-pulse"></span>
                LAZ Gerak Sedekah Cilacap • Layanan Ambulans 24 Jam
            </span>
            <h1 class="text-3xl sm:text-5xl font-extrabold tracking-tight mb-5 leading-tight">
                Menjadi lembaga filantropi profesional dalam mensejahterakan masyarakat di Kabupaten Cilacap
            </h1>
            <p class="text-sky-100 text-sm sm:text-base mb-8 leading-relaxed max-w-2xl font-medium">
                LAZ Gerak Sedekah Cilacap (GSC) adalah lembaga amil zakat yang bergerak dalam penghimpunan dan penyaluran dana zakat, infak, sedekah, serta program sosial kemanusiaan termasuk pelayanan ambulans darurat gratis untuk masyarakat yang membutuhkan.
            </p>
            <div class="flex flex-wrap items-center gap-4">
                <a href="{{ route('masyarakat.order.create') }}"
                   class="inline-flex items-center gap-3 px-7 py-4 rounded-2xl bg-white text-sky-600 font-extrabold shadow-lg hover:bg-sky-50 hover:scale-105 transition-all text-sm">
                    <svg class="w-6 h-6 text-sky-600 animate-bounce" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <span>PESAN AMBULANS DARURAT</span>
                </a>
                <a href="tel:{{ str_replace('-', '', $telepon) }}"
                   class="inline-flex items-center gap-2 px-6 py-4 rounded-2xl bg-white/10 border border-white/30 text-white font-bold hover:bg-white/20 transition-all text-sm backdrop-blur-xs">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                    </svg>
                    <span>Hotline: {{ $telepon }}</span>
                </a>
            </div>
        </div>

        <div class="absolute -right-10 -bottom-10 w-96 h-96 bg-sky-400/20 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute right-20 top-10 w-72 h-72 bg-blue-500/20 rounded-full blur-2xl pointer-events-none"></div>
    </div>

    <!-- Floating Statistics Cards -->
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6 mb-12 -mt-6 relative z-20">
        <!-- Stat 1: Penerima Manfaat -->
        <div class="bg-white rounded-3xl border border-slate-200/80 p-6 shadow-md hover:shadow-lg transition-all flex flex-col items-center text-center">
            <div class="w-12 h-12 rounded-2xl bg-sky-50 text-sky-600 flex items-center justify-center mb-3 border border-sky-100">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                </svg>
            </div>
            <span class="text-2xl sm:text-3xl font-extrabold text-sky-600">{{ number_format($totalTerbantu ?? 2665) }}+</span>
            <span class="text-xs font-bold text-slate-500 uppercase tracking-wider mt-1">Penerima Manfaat</span>
        </div>

        <!-- Stat 2: Relawan -->
        <div class="bg-white rounded-3xl border border-slate-200/80 p-6 shadow-md hover:shadow-lg transition-all flex flex-col items-center text-center">
            <div class="w-12 h-12 rounded-2xl bg-sky-50 text-sky-600 flex items-center justify-center mb-3 border border-sky-100">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                </svg>
            </div>
            <span class="text-2xl sm:text-3xl font-extrabold text-sky-600">{{ number_format($totalRelawan ?? 150) }}+</span>
            <span class="text-xs font-bold text-slate-500 uppercase tracking-wider mt-1">Relawan & Supir</span>
        </div>

        <!-- Stat 3: Armada Ambulans -->
        <div class="bg-white rounded-3xl border border-slate-200/80 p-6 shadow-md hover:shadow-lg transition-all flex flex-col items-center text-center">
            <div class="w-12 h-12 rounded-2xl bg-sky-50 text-sky-600 flex items-center justify-center mb-3 border border-sky-100">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                </svg>
            </div>
            <span class="text-2xl sm:text-3xl font-extrabold text-sky-600">{{ number_format($totalAmbulans ?? 8) }} Unit</span>
            <span class="text-xs font-bold text-slate-500 uppercase tracking-wider mt-1">Armada Siaga</span>
        </div>

        <!-- Stat 4: Mitra Rumah Sakit -->
        <div class="bg-white rounded-3xl border border-slate-200/80 p-6 shadow-md hover:shadow-lg transition-all flex flex-col items-center text-center">
            <div class="w-12 h-12 rounded-2xl bg-sky-50 text-sky-600 flex items-center justify-center mb-3 border border-sky-100">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                </svg>
            </div>
            <span class="text-2xl sm:text-3xl font-extrabold text-sky-600">{{ number_format($totalRumahSakit ?? 4) }} RS</span>
            <span class="text-xs font-bold text-slate-500 uppercase tracking-wider mt-1">RS Mitra Rujukan</span>
        </div>
    </div>

    <!-- 3 Langkah Mudah Memesan Ambulans -->
    <div class="mb-12">
        <h2 class="text-xl font-bold text-slate-800 mb-6 flex items-center gap-2">
            <span class="w-3 h-3 rounded-full bg-sky-600"></span>
            <span>Panduan Memesan Ambulans Darurat GSC</span>
        </h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Step 1 -->
            <div class="p-6 rounded-2xl bg-white border border-slate-200/80 shadow-xs hover:shadow-md transition-shadow">
                <div class="w-12 h-12 rounded-2xl bg-sky-50 text-sky-600 flex items-center justify-center font-black text-xl mb-4 border border-sky-100">
                    1
                </div>
                <h3 class="font-bold text-slate-800 text-lg mb-2">Isi Data & Titik Jemput</h3>
                <p class="text-slate-600 text-sm leading-relaxed">
                    Pilih lokasi penjemputan secara akurat pada Peta Interaktif dan masukkan kondisi pasien yang membutuhkan evakuasi.
                </p>
            </div>
            <!-- Step 2 -->
            <div class="p-6 rounded-2xl bg-white border border-slate-200/80 shadow-xs hover:shadow-md transition-shadow">
                <div class="w-12 h-12 rounded-2xl bg-sky-50 text-sky-600 flex items-center justify-center font-black text-xl mb-4 border border-sky-100">
                    2
                </div>
                <h3 class="font-bold text-slate-800 text-lg mb-2">Konfirmasi Dispatcher</h3>
                <p class="text-slate-600 text-sm leading-relaxed">
                    Pusat kendali GSC akan langsung menugaskan armada ambulans terdekat beserta supir profesional untuk menuju lokasi.
                </p>
            </div>
            <!-- Step 3 -->
            <div class="p-6 rounded-2xl bg-white border border-slate-200/80 shadow-xs hover:shadow-md transition-shadow">
                <div class="w-12 h-12 rounded-2xl bg-sky-50 text-sky-600 flex items-center justify-center font-black text-xl mb-4 border border-sky-100">
                    3
                </div>
                <h3 class="font-bold text-slate-800 text-lg mb-2">Tracking Realtime</h3>
                <p class="text-slate-600 text-sm leading-relaxed">
                    Pantau perjalanan ambulans secara langsung melalui peta GPS hingga tiba di rumah sakit rujukan.
                </p>
            </div>
        </div>
    </div>

    <!-- Rumah Sakit Rujukan di Cilacap -->
    <div class="bg-white rounded-3xl border border-slate-200/80 p-6 sm:p-8 shadow-xs">
        <h2 class="text-xl font-bold text-slate-800 mb-2">Rumah Sakit Rujukan Cilacap</h2>
        <p class="text-slate-500 text-sm mb-6">Daftar fasilitas kesehatan rujukan penanganan darurat mitra GSC SIAGA.</p>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
            @foreach($rumahSakits as $rs)
                <div class="p-4 rounded-xl bg-slate-50 border border-slate-200/60 hover:border-sky-300 transition-colors flex flex-col justify-between">
                    <div>
                        <div class="flex items-center justify-between mb-2">
                            <span class="inline-flex items-center px-2 py-0.5 rounded text-[11px] font-bold bg-sky-100 text-sky-700">
                                IGD 24 JAM
                            </span>
                            <span class="text-xs text-slate-500">{{ $rs->telepon }}</span>
                        </div>
                        <h3 class="font-bold text-slate-800 text-base mb-1">{{ $rs->nama }}</h3>
                        <p class="text-xs text-slate-600 leading-normal mb-3">{{ $rs->alamat }}</p>
                    </div>
                    <div class="pt-3 border-t border-slate-200/60 flex items-center justify-between text-xs font-semibold text-slate-700">
                        <span>Kapasitas: {{ $rs->kapasitas_igd }}</span>
                        <a href="https://www.google.com/maps?q={{ $rs->lat }},{{ $rs->lng }}" target="_blank"
                           class="text-sky-600 hover:underline font-bold">Lihat Peta</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
