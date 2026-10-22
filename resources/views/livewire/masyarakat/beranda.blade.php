<div>


    <!-- Dedicated Hero Section: Beranda (Tanggap Darurat 24 Jam) -->
    <section class="relative pt-20 overflow-hidden bg-[#002b2f]">
        <!-- Background Image (Ambulans di depan IGD) -->
        <div class="absolute inset-0 z-0 bg-cover bg-center"
             style="background-image: url('{{ asset('images/ambulance_thumb2.JPG') }}');">
            <!-- Overlay Transparan untuk Mempertajam Teks (Terang & Jernih) -->
            <div class="absolute inset-0 bg-black/20"></div>
            <div class="absolute inset-0 bg-gradient-to-r from-black/65 via-black/25 to-transparent"></div>
        </div>

        <!-- Hero Content -->
        <div class="max-w-7xl mx-auto px-6 lg:px-12 min-h-[500px] sm:min-h-[560px] lg:min-h-[600px] flex items-center relative z-20 py-16 sm:py-20">
            <div class="max-w-3xl text-left text-white pr-4 lg:pr-12">
                <!-- Badge -->
                <div class="mb-4 sm:mb-5">
                    <span class="inline-flex items-center gap-2 bg-black/45 backdrop-blur-md text-white border border-white/20 px-4 py-1.5 rounded-full text-[10px] sm:text-xs font-bold tracking-widest uppercase shadow-md">
                        <span class="w-2 h-2 rounded-full bg-red-500 animate-pulse"></span>
                        <span>JARINGAN AMBULANS TANGGAP DARURAT 24 JAM</span>
                    </span>
                </div>

                <!-- Big Headline -->
                <h1 class="text-3xl sm:text-5xl lg:text-6xl font-black leading-tight sm:leading-[1.15] mb-4 sm:mb-6 text-white drop-shadow-[0_3px_6px_rgba(0,0,0,0.85)] tracking-tight">
                    Kecepatan & Kepedulian dalam Menyelamatkan Nyawa
                </h1>

                <!-- Subtitle -->
                <p class="text-xs sm:text-base lg:text-lg text-slate-100 mb-8 sm:mb-10 max-w-2xl leading-relaxed font-medium drop-shadow-[0_2px_4px_rgba(0,0,0,0.8)]">
                    Ambulans Siaga adalah platform tanggap darurat terpadu 24 jam yang menghubungkan armada ambulans lintas-mitra untuk melayani evakuasi medis darurat, rujukan rumah sakit, dan pertolongan pertama secara cepat, tepat, dan transparan.
                </p>

                <!-- Action Buttons -->
                <div class="flex flex-wrap items-center gap-3 sm:gap-4">
                    <a href="{{ route('masyarakat.order.create') }}" 
                       class="inline-flex items-center justify-center gap-2 border-2 border-white text-white hover:bg-white hover:text-primary-600 px-6 sm:px-8 py-3 sm:py-3.5 rounded-lg font-bold text-xs sm:text-sm uppercase tracking-wider transition-all shadow-[0_4px_15px_rgba(0,0,0,0.4)] hover:shadow-xl active:scale-95 bg-black/25 backdrop-blur-xs">
                        <span class="w-2 h-2 rounded-full bg-red-500 animate-ping"></span>
                        <span>Pesan Ambulans Sekarang</span>
                    </a>

                    <a href="tel:{{ str_replace('-', '', $telepon ?? '081234567890') }}" 
                       class="inline-flex items-center justify-center gap-2 bg-primary-600 hover:bg-primary-700 text-white px-5 sm:px-7 py-3 sm:py-3.5 rounded-lg font-bold text-xs sm:text-sm uppercase tracking-wider transition-all shadow-[0_4px_15px_rgba(0,156,166,0.4)] hover:shadow-lg active:scale-95">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                        <span>Hotline: {{ $telepon ?? '0812-3456-7890' }}</span>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Floating Stats Card (Dompet Dhuafa Clean Proportions) -->
    <section class="max-w-6xl mx-auto px-4 sm:px-6 -mt-10 sm:-mt-14 relative z-30">
        <div class="bg-white rounded-2xl shadow-[0_15px_45px_rgba(15,23,42,0.08)] border border-slate-100 p-5 sm:p-7 md:p-8 grid grid-cols-2 lg:flex lg:flex-nowrap justify-between items-center gap-4 sm:gap-6">
            <div class="text-center w-full group">
                <div class="w-11 h-11 sm:w-13 sm:h-13 mx-auto bg-primary-50 rounded-xl text-primary-600 mb-2 sm:mb-3 flex items-center justify-center group-hover:-translate-y-1 transition-transform duration-300">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                </div>
                <h3 class="text-2xl sm:text-3xl font-black text-slate-800 mb-0.5">{{ number_format($totalAmbulans ?? 8) }}</h3>
                <p class="text-[10px] sm:text-xs font-bold text-slate-400 uppercase tracking-wider">Armada Siaga</p>
            </div>
            
            <div class="w-px h-16 bg-slate-100 hidden lg:block"></div>

            <div class="text-center w-full group">
                <div class="w-11 h-11 sm:w-13 sm:h-13 mx-auto bg-primary-50 rounded-xl text-primary-600 mb-2 sm:mb-3 flex items-center justify-center group-hover:-translate-y-1 transition-transform duration-300">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                </div>
                <h3 class="text-2xl sm:text-3xl font-black text-slate-800 mb-0.5">{{ number_format($totalTerbantu ?? 2665) }}<span class="text-primary-600">+</span></h3>
                <p class="text-[10px] sm:text-xs font-bold text-slate-400 uppercase tracking-wider">Penerima Manfaat</p>
            </div>

            <div class="w-px h-16 bg-slate-100 hidden lg:block"></div>

            <div class="text-center w-full group">
                <div class="w-11 h-11 sm:w-13 sm:h-13 mx-auto bg-primary-50 rounded-xl text-primary-600 mb-2 sm:mb-3 flex items-center justify-center group-hover:-translate-y-1 transition-transform duration-300">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                </div>
                <h3 class="text-2xl sm:text-3xl font-black text-slate-800 mb-0.5">{{ number_format($totalRelawan ?? 150) }}<span class="text-primary-600">+</span></h3>
                <p class="text-[10px] sm:text-xs font-bold text-slate-400 uppercase tracking-wider">Relawan Aktif</p>
            </div>

            <div class="w-px h-16 bg-slate-100 hidden lg:block"></div>

            <div class="text-center w-full group">
                <div class="w-11 h-11 sm:w-13 sm:h-13 mx-auto bg-primary-50 rounded-xl text-primary-600 mb-2 sm:mb-3 flex items-center justify-center group-hover:-translate-y-1 transition-transform duration-300">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path></svg>
                </div>
                <h3 class="text-2xl sm:text-3xl font-black text-slate-800 mb-0.5">{{ number_format($totalRumahSakit ?? 4) }}</h3>
                <p class="text-[10px] sm:text-xs font-bold text-slate-400 uppercase tracking-wider">Mitra Faskes</p>
            </div>
        </div>
    </section>

    <!-- About Section (Tentang Ambulans Siaga - Putih / White) -->
    <section id="tentang" class="bg-white relative overflow-hidden pt-10 sm:pt-12 pb-16 sm:pb-24 px-5 sm:px-6 lg:px-12">
        <div class="max-w-7xl mx-auto flex flex-col lg:flex-row items-center gap-10 lg:gap-16 relative z-10">
            <!-- Image Side -->
            <div class="w-full lg:w-1/2">
                <div class="relative">
                    <img src="{{ asset('images/dokumgsc (6).JPG') }}" alt="Pusat Operasional & Armada Ambulans Siaga" class="w-full h-[260px] sm:h-[400px] md:h-[500px] object-cover rounded-2xl sm:rounded-3xl shadow-xl border-4 border-primary-200">
                    
                    <!-- Integrated Stat Box -->
                    <div class="absolute -bottom-6 -right-6 bg-white p-6 rounded-2xl shadow-xl border border-slate-100 flex items-center gap-4 hidden md:flex">
                        <div class="w-14 h-14 bg-sky-50 rounded-full flex items-center justify-center text-primary-600">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <div class="pr-4">
                            <p class="text-2xl font-black text-slate-800">24/7</p>
                            <p class="text-sm font-bold text-slate-500">Siaga Darurat</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Content Side -->
            <div class="w-full lg:w-1/2 flex flex-col justify-center">
                <div class="text-center lg:text-left mb-3 sm:mb-5">
                    <span class="inline-block bg-white text-primary-600 border border-primary-100 shadow-sm font-black tracking-widest text-[10px] sm:text-xs px-4 py-1.5 sm:px-5 sm:py-2 rounded-full uppercase">
                        Tentang Ambulans Siaga
                    </span>
                </div>
                
                <h2 class="text-xl sm:text-2xl md:text-[2.5rem] font-black text-slate-900 mb-3 sm:mb-6 leading-tight">
                    Platform Terpadu Tanggap Darurat & Evakuasi Medis Bebas Biaya
                </h2>
                
                <p class="text-slate-600 mb-5 sm:mb-8 leading-relaxed text-xs sm:text-base lg:text-lg font-medium">
                    {{ $tentang ?? 'Ambulans Siaga adalah platform tanggap darurat terpadu 24 jam yang menghubungkan armada ambulans lintas-mitra untuk melayani evakuasi medis, rujukan, dan gawat darurat secara cepat dan transparan.' }}
                </p>
                
                <!-- Desktop View: 2-Column Grid (Hidden on Mobile) -->
                <div class="hidden sm:grid sm:grid-cols-2 gap-4 mb-10">
                    <div class="flex items-center gap-3 bg-slate-50 px-4 py-3 rounded-2xl border border-slate-100 shadow-xs">
                        <div class="w-7 h-7 rounded-xl bg-primary-50 text-primary-600 flex items-center justify-center flex-shrink-0">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                        </div>
                        <p class="text-slate-800 font-bold text-sm">Pelayanan Cepat Tanggap</p>
                    </div>
                    <div class="flex items-center gap-3 bg-slate-50 px-4 py-3 rounded-2xl border border-slate-100 shadow-xs">
                        <div class="w-7 h-7 rounded-xl bg-primary-50 text-primary-600 flex items-center justify-center flex-shrink-0">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                        </div>
                        <p class="text-slate-800 font-bold text-sm">Terpercaya & Transparan</p>
                    </div>
                    <div class="flex items-center gap-3 bg-slate-50 px-4 py-3 rounded-2xl border border-slate-100 shadow-xs">
                        <div class="w-7 h-7 rounded-xl bg-primary-50 text-primary-600 flex items-center justify-center flex-shrink-0">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                        </div>
                        <p class="text-slate-800 font-bold text-sm">Jaringan Lintas Mitra</p>
                    </div>
                    <div class="flex items-center gap-3 bg-slate-50 px-4 py-3 rounded-2xl border border-slate-100 shadow-xs">
                        <div class="w-7 h-7 rounded-xl bg-primary-50 text-primary-600 flex items-center justify-center flex-shrink-0">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                        </div>
                        <p class="text-slate-800 font-bold text-sm">Layanan Bebas Biaya</p>
                    </div>
                </div>

                <!-- Mobile View: Infinite Auto-Scrolling Marquee Track (sm:hidden) -->
                <div class="sm:hidden mb-8 -mx-6 relative overflow-hidden py-1"
                     x-data="{
                         setSpeed(rate) {
                             $el.querySelectorAll('.animate-marquee-infinite').forEach(el => {
                                 el.getAnimations().forEach(anim => {
                                     anim.playbackRate = rate;
                                 });
                             });
                         }
                     }"
                     @mouseenter="setSpeed(0.4)"
                     @mouseleave="setSpeed(1.0)"
                     @pointerenter="setSpeed(0.4)"
                     @pointerleave="setSpeed(1.0)">
                    <!-- Left & Right Gradient Fade Masks -->
                    <div class="absolute left-0 top-0 bottom-0 w-6 bg-gradient-to-r from-white to-transparent z-10 pointer-events-none"></div>
                    <div class="absolute right-0 top-0 bottom-0 w-6 bg-gradient-to-l from-white to-transparent z-10 pointer-events-none"></div>

                    <!-- Marquee Wrapper (Seamless Double Loop) -->
                    <div class="flex overflow-hidden">
                        <!-- Set 1 -->
                        <div class="animate-marquee-infinite flex gap-2.5 flex-shrink-0 pr-2.5">
                            <div class="flex items-center gap-2.5 bg-slate-50 px-3.5 py-2.5 rounded-xl border border-slate-100 shadow-xs">
                                <div class="w-6 h-6 rounded-lg bg-primary-50 text-primary-600 flex items-center justify-center flex-shrink-0">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                                </div>
                                <span class="text-slate-800 font-bold text-xs whitespace-nowrap">Pelayanan Cepat Tanggap</span>
                            </div>
                            <div class="flex items-center gap-2.5 bg-slate-50 px-3.5 py-2.5 rounded-xl border border-slate-100 shadow-xs">
                                <div class="w-6 h-6 rounded-lg bg-primary-50 text-primary-600 flex items-center justify-center flex-shrink-0">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                                </div>
                                <span class="text-slate-800 font-bold text-xs whitespace-nowrap">Terpercaya & Transparan</span>
                            </div>
                            <div class="flex items-center gap-2.5 bg-slate-50 px-3.5 py-2.5 rounded-xl border border-slate-100 shadow-xs">
                                <div class="w-6 h-6 rounded-lg bg-primary-50 text-primary-600 flex items-center justify-center flex-shrink-0">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                                </div>
                                <span class="text-slate-800 font-bold text-xs whitespace-nowrap">Jaringan Lintas Mitra</span>
                            </div>
                            <div class="flex items-center gap-2.5 bg-slate-50 px-3.5 py-2.5 rounded-xl border border-slate-100 shadow-xs">
                                <div class="w-6 h-6 rounded-lg bg-primary-50 text-primary-600 flex items-center justify-center flex-shrink-0">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                                </div>
                                <span class="text-slate-800 font-bold text-xs whitespace-nowrap">Layanan Bebas Biaya</span>
                            </div>
                        </div>

                        <!-- Set 2 (Duplicate for Infinite Loop) -->
                        <div class="animate-marquee-infinite flex gap-2.5 flex-shrink-0 pr-2.5" aria-hidden="true">
                            <div class="flex items-center gap-2.5 bg-slate-50 px-3.5 py-2.5 rounded-xl border border-slate-100 shadow-xs">
                                <div class="w-6 h-6 rounded-lg bg-primary-50 text-primary-600 flex items-center justify-center flex-shrink-0">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                                </div>
                                <span class="text-slate-800 font-bold text-xs whitespace-nowrap">Pelayanan Cepat Tanggap</span>
                            </div>
                            <div class="flex items-center gap-2.5 bg-slate-50 px-3.5 py-2.5 rounded-xl border border-slate-100 shadow-xs">
                                <div class="w-6 h-6 rounded-lg bg-primary-50 text-primary-600 flex items-center justify-center flex-shrink-0">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                                </div>
                                <span class="text-slate-800 font-bold text-xs whitespace-nowrap">Terpercaya & Transparan</span>
                            </div>
                            <div class="flex items-center gap-2.5 bg-slate-50 px-3.5 py-2.5 rounded-xl border border-slate-100 shadow-xs">
                                <div class="w-6 h-6 rounded-lg bg-primary-50 text-primary-600 flex items-center justify-center flex-shrink-0">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                                </div>
                                <span class="text-slate-800 font-bold text-xs whitespace-nowrap">Jaringan Lintas Mitra</span>
                            </div>
                            <div class="flex items-center gap-2.5 bg-slate-50 px-3.5 py-2.5 rounded-xl border border-slate-100 shadow-xs">
                                <div class="w-6 h-6 rounded-lg bg-primary-50 text-primary-600 flex items-center justify-center flex-shrink-0">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                                </div>
                                <span class="text-slate-800 font-bold text-xs whitespace-nowrap">Layanan Bebas Biaya</span>
                            </div>
                        </div>
                    </div>
                </div>

                <style>
                    @keyframes marquee-scroll-horizontal {
                        0% { transform: translateX(0); }
                        100% { transform: translateX(-100%); }
                    }
                    .animate-marquee-infinite {
                        animation: marquee-scroll-horizontal 18s linear infinite;
                    }
                </style>
                
                <div>
                    <a href="{{ route('masyarakat.info') }}" class="inline-flex items-center gap-2 sm:gap-3 bg-primary-600 text-white px-6 sm:px-8 py-2.5 sm:py-3.5 rounded-lg font-bold hover:bg-primary-700 transition shadow-md hover:shadow-lg text-xs sm:text-sm uppercase tracking-wider">
                        <span>Kenali Lebih Jauh</span>
                        <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Services / Programs (LAYANAN KAMI - Gaya Dompet Dhuafa) -->
    <section id="layanan" class="py-14 sm:py-20 lg:py-24 px-5 sm:px-6 lg:px-12 bg-slate-50 relative overflow-hidden border-t border-slate-200/80">
        <div class="max-w-7xl mx-auto flex flex-col lg:flex-row gap-10 lg:gap-16 relative z-10">
            <!-- Left Header -->
            <div class="lg:w-1/3 text-left">
                <div class="mb-3 sm:mb-5">
                    <span class="inline-block bg-white text-primary-600 border border-primary-100 shadow-sm font-black tracking-widest text-[10px] sm:text-xs px-4 py-1.5 sm:px-5 sm:py-2 rounded-full uppercase">
                        Layanan Kami
                    </span>
                </div>
                <h2 class="text-xl sm:text-2xl md:text-[2.5rem] font-black text-slate-900 mb-3 sm:mb-6 leading-tight">
                    Wujudkan Kebaikan dalam Berbagai Layanan Medis
                </h2>
                <p class="text-slate-500 mb-6 sm:mb-8 leading-relaxed font-medium text-xs sm:text-base lg:text-lg text-left">
                    Ambulans Siaga fokus mengintegrasikan layanan kemanusiaan tanggap darurat yang berdampak langsung bagi masyarakat, mulai dari evakuasi gawat darurat hingga koordinasi rujukan medis.
                </p>
                <!-- Desktop Button (Hidden on Mobile) -->
                <div class="hidden lg:flex justify-start">
                    <a href="{{ route('masyarakat.order.create') }}" class="inline-flex items-center gap-2 sm:gap-3 bg-primary-600 text-white px-6 sm:px-8 py-2.5 sm:py-3.5 rounded-lg font-bold hover:bg-primary-700 transition shadow-md hover:shadow-lg text-xs sm:text-sm uppercase tracking-wider">
                        <span>Pesan Layanan</span>
                        <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </a>
                </div>
            </div>

            <!-- Desktop View: 3 Column Grid (Hidden on Mobile) -->
            <div class="lg:w-2/3 hidden lg:grid lg:grid-cols-3 gap-6">
                <!-- Card 1 -->
                <div class="bg-white rounded-[2rem] overflow-hidden shadow-lg shadow-slate-200/50 hover:shadow-2xl hover:-translate-y-2 transition-all duration-300 group border border-slate-100 flex flex-col">
                    <div class="h-48 overflow-hidden relative">
                        <img src="{{ asset('images/dokumgsc (3).jpg') }}" alt="Ambulans Gawat Darurat" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                        <div class="absolute -bottom-1 left-4 bg-white p-2 rounded-t-xl">
                            <div class="bg-red-50 text-red-600 w-12 h-12 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.477 2 2 6.477 2 12s4.477 10 10 10 10-4.477 10-10S17.523 2 12 2zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z"></path></svg>
                            </div>
                        </div>
                    </div>
                    <div class="p-6 pt-4 flex-1 flex flex-col">
                        <h3 class="text-xl font-black text-slate-800 mb-3">Ambulans Darurat</h3>
                        <p class="text-sm text-slate-500 leading-relaxed flex-1">Sigap membantu evakuasi korban kecelakaan, rujukan darurat, dan kondisi kritis secara gratis 24 jam.</p>
                    </div>
                </div>

                <!-- Card 2 -->
                <div class="bg-white rounded-[2rem] overflow-hidden shadow-lg shadow-slate-200/50 hover:shadow-2xl hover:-translate-y-2 transition-all duration-300 group border border-slate-100 flex flex-col">
                    <div class="h-48 overflow-hidden relative">
                        <img src="{{ asset('images/dokumgsc (14).jpg') }}" alt="Bantuan Tanggap Darurat" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                        <div class="absolute -bottom-1 left-4 bg-white p-2 rounded-t-xl">
                            <div class="bg-sky-50 text-sky-600 w-12 h-12 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-2 10h-4v4h-2v-4H7v-2h4V7h2v4h4v2z"></path></svg>
                            </div>
                        </div>
                    </div>
                    <div class="p-6 pt-4 flex-1 flex flex-col">
                        <h3 class="text-xl font-black text-slate-800 mb-3">Logistik Tanggap Darurat</h3>
                        <p class="text-sm text-slate-500 leading-relaxed flex-1">Penyaluran air bersih, bantuan medis cepat, dan suplai logistik di wilayah terdampak bencana.</p>
                    </div>
                </div>

                <!-- Card 3 -->
                <div class="bg-white rounded-[2rem] overflow-hidden shadow-lg shadow-slate-200/50 hover:shadow-2xl hover:-translate-y-2 transition-all duration-300 group border border-slate-100 flex flex-col">
                    <div class="h-48 overflow-hidden relative">
                        <img src="{{ asset('images/dokumgsc (5).JPG') }}" alt="Peduli Sosial Dhuafa" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                        <div class="absolute -bottom-1 left-4 bg-white p-2 rounded-t-xl">
                            <div class="bg-amber-50 text-amber-600 w-12 h-12 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M10 20v-6h4v6h5v-8h3L12 3 2 12h3v8z"></path></svg>
                            </div>
                        </div>
                    </div>
                    <div class="p-6 pt-4 flex-1 flex flex-col">
                        <h3 class="text-xl font-black text-slate-800 mb-3">Aksi Peduli Kemanusiaan</h3>
                        <p class="text-sm text-slate-500 leading-relaxed flex-1">Pemberian bantuan sandang, pangan, dan pendampingan sosial bagi keluarga prasejahtera.</p>
                    </div>
                </div>
            </div>

            <!-- Mobile View: Gojek-Style Interactive Carousel Slider (lg:hidden) -->
            <div class="lg:hidden w-full relative px-1 sm:px-2"
                 x-data="{
                     current: 0,
                     total: 3,
                     touchStartX: 0,
                     touchEndX: 0,
                     next() { this.current = (this.current + 1) % this.total; },
                     prev() { this.current = (this.current - 1 + this.total) % this.total; },
                     handleTouchStart(e) { this.touchStartX = e.changedTouches[0].screenX; },
                     handleTouchEnd(e) {
                         this.touchEndX = e.changedTouches[0].screenX;
                         if (this.touchStartX - this.touchEndX > 40) this.next();
                         if (this.touchEndX - this.touchStartX > 40) this.prev();
                     }
                 }"
                 @touchstart="handleTouchStart($event)"
                 @touchend="handleTouchEnd($event)">
                
                <!-- Card Slider Container -->
                <div class="relative overflow-hidden rounded-2xl shadow-lg bg-white border border-slate-100">
                    <div class="flex transition-transform duration-500 ease-out"
                         :style="'transform: translateX(-' + (current * 100) + '%)'">
                        
                        <!-- Slide 1 -->
                        <div class="w-full flex-shrink-0 flex flex-col">
                            <div class="h-48 overflow-hidden relative">
                                <img src="{{ asset('images/dokumgsc (3).jpg') }}" alt="Ambulans Gawat Darurat" class="w-full h-full object-cover">
                                <div class="absolute -bottom-1 left-4 bg-white p-2 rounded-t-xl">
                                    <div class="bg-red-50 text-red-600 w-11 h-11 rounded-lg flex items-center justify-center shadow-xs">
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.477 2 2 6.477 2 12s4.477 10 10 10 10-4.477 10-10S17.523 2 12 2zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z"></path></svg>
                                    </div>
                                </div>
                            </div>
                            <div class="p-5 sm:p-6 pt-3">
                                <h3 class="text-lg sm:text-xl font-black text-slate-800 mb-2">Ambulans Darurat</h3>
                                <p class="text-xs sm:text-sm text-slate-500 leading-relaxed font-medium">Sigap membantu evakuasi korban kecelakaan, rujukan darurat, dan kondisi kritis secara gratis 24 jam.</p>
                            </div>
                        </div>

                        <!-- Slide 2 -->
                        <div class="w-full flex-shrink-0 flex flex-col">
                            <div class="h-48 overflow-hidden relative">
                                <img src="{{ asset('images/dokumgsc (14).jpg') }}" alt="Bantuan Tanggap Darurat" class="w-full h-full object-cover">
                                <div class="absolute -bottom-1 left-4 bg-white p-2 rounded-t-xl">
                                    <div class="bg-sky-50 text-sky-600 w-11 h-11 rounded-lg flex items-center justify-center shadow-xs">
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-2 10h-4v4h-2v-4H7v-2h4V7h2v4h4v2z"></path></svg>
                                    </div>
                                </div>
                            </div>
                            <div class="p-5 sm:p-6 pt-3">
                                <h3 class="text-lg sm:text-xl font-black text-slate-800 mb-2">Logistik Tanggap Darurat</h3>
                                <p class="text-xs sm:text-sm text-slate-500 leading-relaxed font-medium">Penyaluran air bersih, bantuan medis cepat, dan suplai logistik di wilayah terdampak bencana.</p>
                            </div>
                        </div>

                        <!-- Slide 3 -->
                        <div class="w-full flex-shrink-0 flex flex-col">
                            <div class="h-48 overflow-hidden relative">
                                <img src="{{ asset('images/dokumgsc (5).JPG') }}" alt="Peduli Sosial Dhuafa" class="w-full h-full object-cover">
                                <div class="absolute -bottom-1 left-4 bg-white p-2 rounded-t-xl">
                                    <div class="bg-amber-50 text-amber-600 w-11 h-11 rounded-lg flex items-center justify-center shadow-xs">
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M10 20v-6h4v6h5v-8h3L12 3 2 12h3v8z"></path></svg>
                                    </div>
                                </div>
                            </div>
                            <div class="p-5 sm:p-6 pt-3">
                                <h3 class="text-lg sm:text-xl font-black text-slate-800 mb-2">Aksi Peduli Kemanusiaan</h3>
                                <p class="text-xs sm:text-sm text-slate-500 leading-relaxed font-medium">Pemberian bantuan sandang, pangan, dan pendampingan sosial bagi keluarga prasejahtera.</p>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- Floating Navigation Arrow Buttons (Gojek Style) -->
                <button @click="prev()" type="button" aria-label="Sebelumnya"
                        class="absolute -left-1 sm:-left-2 top-1/2 -translate-y-1/2 w-9 h-9 rounded-full bg-white text-slate-700 shadow-xl border border-slate-100 flex items-center justify-center hover:bg-slate-50 active:scale-95 transition-all z-20">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/></svg>
                </button>
                <button @click="next()" type="button" aria-label="Berikutnya"
                        class="absolute -right-1 sm:-right-2 top-1/2 -translate-y-1/2 w-9 h-9 rounded-full bg-white text-slate-700 shadow-xl border border-slate-100 flex items-center justify-center hover:bg-slate-50 active:scale-95 transition-all z-20">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
                </button>

                <!-- Dots Pagination Indicator (Gojek Style) -->
                <div class="flex justify-center items-center gap-1.5 mt-5 mb-5">
                    <template x-for="i in total" :key="i">
                        <button @click="current = i - 1"
                                class="h-2 rounded-full transition-all duration-300"
                                :class="current === (i - 1) ? 'w-6 bg-primary-600' : 'w-2 bg-slate-300 hover:bg-slate-400'"></button>
                    </template>
                </div>

                <!-- Mobile Button (Placed Below Card Gambar Program) -->
                <div class="flex justify-center pt-1">
                    <a href="#" class="inline-flex items-center justify-center gap-2 bg-primary-600 text-white px-6 py-2.5 rounded-full font-bold hover:bg-[#007f87] transition shadow-md hover:shadow-lg text-xs sm:text-sm">
                        <span>Lihat Semua Program</span>
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- How it Works / Alur Pemesanan (Alur Layanan - Putih / White) -->
    <section class="py-14 sm:py-20 lg:py-24 px-5 sm:px-6 lg:px-12 bg-white relative overflow-hidden border-t border-slate-100">
        <div class="max-w-7xl mx-auto relative z-10">
            <div class="text-left lg:text-center max-w-3xl lg:mx-auto mb-8 sm:mb-16">
                <div class="text-center mb-3 sm:mb-5">
                    <span class="inline-block bg-white text-primary-600 border border-primary-100 shadow-sm font-black tracking-widest text-[10px] sm:text-xs px-4 py-1.5 sm:px-5 sm:py-2 rounded-full uppercase">
                        Alur Layanan
                    </span>
                </div>
                <h2 class="text-xl sm:text-2xl md:text-[2.5rem] font-black text-slate-900 mb-3 sm:mb-6 leading-tight text-left lg:text-center">Bagaimana Cara Mendapatkan Bantuan Ambulans?</h2>
                <p class="text-slate-500 font-medium text-xs sm:text-base lg:text-lg leading-relaxed text-left lg:text-center">
                    Kami merancang sistem yang cepat dan terintegrasi untuk memastikan setiap keadaan darurat mendapatkan respon penanganan medis dengan segera.
                </p>
            </div>

            <!-- Desktop View: 5 Columns Grid (Hidden on Mobile) -->
            <div class="hidden lg:grid lg:grid-cols-5 gap-8 lg:gap-6 relative">
                <!-- Connecting Line for LG screens -->
                <div class="hidden lg:block absolute top-12 left-[10%] right-[10%] h-1 bg-slate-100 rounded-full z-0">
                    <div class="absolute top-0 left-0 h-full bg-primary-600/30 w-full rounded-full"></div>
                </div>

                <!-- Step 1 -->
                <div class="relative z-10 flex flex-col items-center text-center group cursor-default">
                    <div class="w-24 h-24 rounded-full bg-slate-50 border-[6px] border-white shadow-xl flex items-center justify-center relative mb-6 group-hover:scale-110 group-hover:border-primary-600/20 transition-all duration-300">
                        <div class="absolute inset-0 bg-gradient-to-br from-primary-600 to-primary-700 rounded-full scale-0 group-hover:scale-100 transition-transform duration-300 -z-10"></div>
                        <span class="absolute -top-2 -right-2 w-8 h-8 rounded-full bg-yellow-400 text-slate-900 font-black flex items-center justify-center text-sm shadow-md">1</span>
                        <svg class="w-10 h-10 text-primary-600 group-hover:text-white transition-colors duration-300 relative z-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
                    </div>
                    <h3 class="text-xl font-black text-slate-800 mb-3 group-hover:text-primary-600 transition-colors">Pesan Darurat</h3>
                    <p class="text-sm text-slate-500 leading-relaxed font-medium px-2">Buka website, isi titik lokasi dan informasi ringkas pasien, lalu tekan tombol minta bantuan darurat.</p>
                </div>

                <!-- Step 2 -->
                <div class="relative z-10 flex flex-col items-center text-center group cursor-default">
                    <div class="w-24 h-24 rounded-full bg-slate-50 border-[6px] border-white shadow-xl flex items-center justify-center relative mb-6 group-hover:scale-110 group-hover:border-primary-600/20 transition-all duration-300">
                        <div class="absolute inset-0 bg-gradient-to-br from-primary-600 to-primary-700 rounded-full scale-0 group-hover:scale-100 transition-transform duration-300 -z-10"></div>
                        <span class="absolute -top-2 -right-2 w-8 h-8 rounded-full bg-yellow-400 text-slate-900 font-black flex items-center justify-center text-sm shadow-md">2</span>
                        <svg class="w-10 h-10 text-primary-600 group-hover:text-white transition-colors duration-300 relative z-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
                    </div>
                    <h3 class="text-xl font-black text-slate-800 mb-3 group-hover:text-primary-600 transition-colors">Verifikasi Cepat</h3>
                    <p class="text-sm text-slate-500 leading-relaxed font-medium px-2">Pusat panggilan (Operator) akan segera merespon dan memverifikasi pesanan masuk Anda.</p>
                </div>

                <!-- Step 3 -->
                <div class="relative z-10 flex flex-col items-center text-center group cursor-default">
                    <div class="w-24 h-24 rounded-full bg-slate-50 border-[6px] border-white shadow-xl flex items-center justify-center relative mb-6 group-hover:scale-110 group-hover:border-primary-600/20 transition-all duration-300">
                        <div class="absolute inset-0 bg-gradient-to-br from-primary-600 to-primary-700 rounded-full scale-0 group-hover:scale-100 transition-transform duration-300 -z-10"></div>
                        <span class="absolute -top-2 -right-2 w-8 h-8 rounded-full bg-yellow-400 text-slate-900 font-black flex items-center justify-center text-sm shadow-md">3</span>
                        <svg class="w-10 h-10 text-primary-600 group-hover:text-white transition-colors duration-300 relative z-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"></path></svg>
                    </div>
                    <h3 class="text-xl font-black text-slate-800 mb-3 group-hover:text-primary-600 transition-colors">Armada Meluncur</h3>
                    <p class="text-sm text-slate-500 leading-relaxed font-medium px-2">Ambulans terdekat akan ditugaskan. Anda dapat melacak posisi ambulans secara <i>real-time</i> dari HP.</p>
                </div>

                <!-- Step 4 -->
                <div class="relative z-10 flex flex-col items-center text-center group cursor-default">
                    <div class="w-24 h-24 rounded-full bg-slate-50 border-[6px] border-white shadow-xl flex items-center justify-center relative mb-6 group-hover:scale-110 group-hover:border-primary-600/20 transition-all duration-300">
                        <div class="absolute inset-0 bg-gradient-to-br from-primary-600 to-primary-700 rounded-full scale-0 group-hover:scale-100 transition-transform duration-300 -z-10"></div>
                        <span class="absolute -top-2 -right-2 w-8 h-8 rounded-full bg-yellow-400 text-slate-900 font-black flex items-center justify-center text-sm shadow-md">4</span>
                        <svg class="w-10 h-10 text-primary-600 group-hover:text-white transition-colors duration-300 relative z-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                    </div>
                    <h3 class="text-xl font-black text-slate-800 mb-3 group-hover:text-primary-600 transition-colors">Pertolongan Tiba</h3>
                    <p class="text-sm text-slate-500 leading-relaxed font-medium px-2">Tim relawan dan medis tiba di lokasi untuk melakukan penanganan pertama dan evakuasi darurat.</p>
                </div>

                <!-- Step 5 -->
                <div class="relative z-10 flex flex-col items-center text-center group cursor-default">
                    <div class="w-24 h-24 rounded-full bg-slate-50 border-[6px] border-white shadow-xl flex items-center justify-center relative mb-6 group-hover:scale-110 group-hover:border-primary-600/20 transition-all duration-300">
                        <div class="absolute inset-0 bg-gradient-to-br from-primary-600 to-primary-700 rounded-full scale-0 group-hover:scale-100 transition-transform duration-300 -z-10"></div>
                        <span class="absolute -top-2 -right-2 w-8 h-8 rounded-full bg-yellow-400 text-slate-900 font-black flex items-center justify-center text-sm shadow-md">5</span>
                        <svg class="w-10 h-10 text-primary-600 group-hover:text-white transition-colors duration-300 relative z-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h6m-3-3v6m-2 11v-4a1 1 0 011-1h2a1 1 0 011 1v4h-4z"></path></svg>
                    </div>
                    <h3 class="text-xl font-black text-slate-800 mb-3 group-hover:text-primary-600 transition-colors">Rujukan ke RS</h3>
                    <p class="text-sm text-slate-500 leading-relaxed font-medium px-2">Pasien diantar dengan aman ke IGD Rumah Sakit rujukan mitra terdekat hingga penanganan tuntas.</p>
                </div>
            </div>

            <!-- Mobile View: Gojek-Style Step Slider (lg:hidden) -->
            <div class="lg:hidden w-full relative px-1 sm:px-2"
                 x-data="{
                     current: 0,
                     total: 5,
                     touchStartX: 0,
                     touchEndX: 0,
                     next() { this.current = (this.current + 1) % this.total; },
                     prev() { this.current = (this.current - 1 + this.total) % this.total; },
                     handleTouchStart(e) { this.touchStartX = e.changedTouches[0].screenX; },
                     handleTouchEnd(e) {
                         this.touchEndX = e.changedTouches[0].screenX;
                         if (this.touchStartX - this.touchEndX > 40) this.next();
                         if (this.touchEndX - this.touchStartX > 40) this.prev();
                     }
                 }"
                 @touchstart="handleTouchStart($event)"
                 @touchend="handleTouchEnd($event)">
                
                <div class="relative overflow-hidden rounded-2xl shadow-lg bg-white border border-slate-100">
                    <div class="flex transition-transform duration-500 ease-out"
                         :style="'transform: translateX(-' + (current * 100) + '%)'">
                        
                        <!-- Step 1 Slide -->
                        <div class="w-full flex-shrink-0 flex flex-col items-center text-center p-6 sm:p-8">
                            <div class="w-16 h-16 sm:w-20 sm:h-20 rounded-full bg-slate-50 border-4 sm:border-[5px] border-white shadow-xl flex items-center justify-center relative mb-4">
                                <span class="absolute -top-1 -right-1 w-5 h-5 sm:w-6 sm:h-6 rounded-full bg-yellow-400 text-slate-900 font-black flex items-center justify-center text-[10px] sm:text-xs shadow-sm ring-2 ring-white z-20">1</span>
                                <svg class="w-7 h-7 sm:w-8 sm:h-8 text-primary-600 relative z-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
                            </div>
                            <span class="text-[10px] font-black text-primary-600 uppercase tracking-widest mb-1">Langkah 1 dari 5</span>
                            <h3 class="text-lg sm:text-xl font-black text-slate-800 mb-2">Pesan Darurat</h3>
                            <p class="text-xs sm:text-sm text-slate-500 leading-relaxed font-medium">Buka website, isi titik lokasi dan informasi ringkas pasien, lalu tekan tombol minta bantuan darurat.</p>
                        </div>

                        <!-- Step 2 Slide -->
                        <div class="w-full flex-shrink-0 flex flex-col items-center text-center p-6 sm:p-8">
                            <div class="w-16 h-16 sm:w-20 sm:h-20 rounded-full bg-slate-50 border-4 sm:border-[5px] border-white shadow-xl flex items-center justify-center relative mb-4">
                                <span class="absolute -top-1 -right-1 w-5 h-5 sm:w-6 sm:h-6 rounded-full bg-yellow-400 text-slate-900 font-black flex items-center justify-center text-[10px] sm:text-xs shadow-sm ring-2 ring-white z-20">2</span>
                                <svg class="w-7 h-7 sm:w-8 sm:h-8 text-primary-600 relative z-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
                            </div>
                            <span class="text-[10px] font-black text-primary-600 uppercase tracking-widest mb-1">Langkah 2 dari 5</span>
                            <h3 class="text-lg sm:text-xl font-black text-slate-800 mb-2">Verifikasi Cepat</h3>
                            <p class="text-xs sm:text-sm text-slate-500 leading-relaxed font-medium">Pusat panggilan (Operator) akan segera merespon dan memverifikasi pesanan masuk Anda.</p>
                        </div>

                        <!-- Step 3 Slide -->
                        <div class="w-full flex-shrink-0 flex flex-col items-center text-center p-6 sm:p-8">
                            <div class="w-16 h-16 sm:w-20 sm:h-20 rounded-full bg-slate-50 border-4 sm:border-[5px] border-white shadow-xl flex items-center justify-center relative mb-4">
                                <span class="absolute -top-1 -right-1 w-5 h-5 sm:w-6 sm:h-6 rounded-full bg-yellow-400 text-slate-900 font-black flex items-center justify-center text-[10px] sm:text-xs shadow-sm ring-2 ring-white z-20">3</span>
                                <svg class="w-7 h-7 sm:w-8 sm:h-8 text-primary-600 relative z-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"></path></svg>
                            </div>
                            <span class="text-[10px] font-black text-primary-600 uppercase tracking-widest mb-1">Langkah 3 dari 5</span>
                            <h3 class="text-lg sm:text-xl font-black text-slate-800 mb-2">Armada Meluncur</h3>
                            <p class="text-xs sm:text-sm text-slate-500 leading-relaxed font-medium">Ambulans terdekat akan ditugaskan. Anda dapat melacak posisi ambulans secara <i>real-time</i> dari HP.</p>
                        </div>

                        <!-- Step 4 Slide -->
                        <div class="w-full flex-shrink-0 flex flex-col items-center text-center p-6 sm:p-8">
                            <div class="w-16 h-16 sm:w-20 sm:h-20 rounded-full bg-slate-50 border-4 sm:border-[5px] border-white shadow-xl flex items-center justify-center relative mb-4">
                                <span class="absolute -top-1 -right-1 w-5 h-5 sm:w-6 sm:h-6 rounded-full bg-yellow-400 text-slate-900 font-black flex items-center justify-center text-[10px] sm:text-xs shadow-sm ring-2 ring-white z-20">4</span>
                                <svg class="w-7 h-7 sm:w-8 sm:h-8 text-primary-600 relative z-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                            </div>
                            <span class="text-[10px] font-black text-primary-600 uppercase tracking-widest mb-1">Langkah 4 dari 5</span>
                            <h3 class="text-lg sm:text-xl font-black text-slate-800 mb-2">Pertolongan Tiba</h3>
                            <p class="text-xs sm:text-sm text-slate-500 leading-relaxed font-medium">Tim relawan dan medis tiba di lokasi untuk melakukan penanganan pertama dan evakuasi darurat.</p>
                        </div>

                        <!-- Step 5 Slide -->
                        <div class="w-full flex-shrink-0 flex flex-col items-center text-center p-6 sm:p-8">
                            <div class="w-16 h-16 sm:w-20 sm:h-20 rounded-full bg-slate-50 border-4 sm:border-[5px] border-white shadow-xl flex items-center justify-center relative mb-4">
                                <span class="absolute -top-1 -right-1 w-5 h-5 sm:w-6 sm:h-6 rounded-full bg-yellow-400 text-slate-900 font-black flex items-center justify-center text-[10px] sm:text-xs shadow-sm ring-2 ring-white z-20">5</span>
                                <svg class="w-7 h-7 sm:w-8 sm:h-8 text-primary-600 relative z-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h6m-3-3v6m-2 11v-4a1 1 0 011-1h2a1 1 0 011 1v4h-4z"></path></svg>
                            </div>
                            <span class="text-[10px] font-black text-primary-600 uppercase tracking-widest mb-1">Langkah 5 dari 5</span>
                            <h3 class="text-lg sm:text-xl font-black text-slate-800 mb-2">Rujukan ke RS</h3>
                            <p class="text-xs sm:text-sm text-slate-500 leading-relaxed font-medium">Pasien diantar dengan aman ke IGD Rumah Sakit rujukan mitra terdekat hingga penanganan tuntas.</p>
                        </div>

                    </div>
                </div>

                <!-- Floating Navigation Arrow Buttons (Gojek Style) -->
                <button @click="prev()" type="button" aria-label="Sebelumnya"
                        class="absolute -left-1 sm:-left-2 top-1/2 -translate-y-1/2 w-9 h-9 rounded-full bg-white text-slate-700 shadow-xl border border-slate-100 flex items-center justify-center hover:bg-slate-50 active:scale-95 transition-all z-20">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/></svg>
                </button>
                <button @click="next()" type="button" aria-label="Berikutnya"
                        class="absolute -right-1 sm:-right-2 top-1/2 -translate-y-1/2 w-9 h-9 rounded-full bg-white text-slate-700 shadow-xl border border-slate-100 flex items-center justify-center hover:bg-slate-50 active:scale-95 transition-all z-20">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
                </button>

                <!-- Dots Pagination Indicator (Gojek Style) -->
                <div class="flex justify-center items-center gap-1.5 mt-5">
                    <template x-for="i in total" :key="i">
                        <button @click="current = i - 1"
                                class="h-2 rounded-full transition-all duration-300"
                                :class="current === (i - 1) ? 'w-6 bg-primary-600' : 'w-2 bg-slate-300 hover:bg-slate-400'"></button>
                    </template>
                </div>
            </div>
            
            <div class="mt-8 sm:mt-12 lg:mt-14 text-center">
                <a href="{{ route('masyarakat.order.create') }}" class="inline-flex items-center gap-2 sm:gap-3 bg-primary-600 text-white px-6 sm:px-8 py-2.5 sm:py-3.5 rounded-lg font-bold hover:bg-primary-700 transition shadow-md hover:shadow-lg text-xs sm:text-sm uppercase tracking-wider">
                    <span>Coba Pesan Ambulans Sekarang</span>
                    <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                </a>
            </div>
        </div>
    </section>


    <!-- Bergabung Bersama Kami Section (Pudar / Slate-50) -->
    <section class="py-14 sm:py-20 lg:py-24 px-5 sm:px-6 lg:px-12 bg-slate-50 relative overflow-hidden border-t border-slate-100">
        <!-- Subtle Star of Life Watermark Background -->
        <div class="absolute top-[48%] left-1/2 -translate-x-1/2 -translate-y-1/2 w-[850px] h-[850px] sm:w-[1000px] sm:h-[1000px] md:w-[1100px] md:h-[1100px] pointer-events-none flex items-center justify-center z-0 opacity-40">
            <svg viewBox="0 0 100 100" class="w-full h-full text-primary-100 fill-current">
                <path d="M 40 10 L 60 10 L 60 40 L 90 40 L 90 60 L 60 60 L 60 90 L 40 90 L 40 60 L 10 60 L 10 40 L 40 40 Z" transform="rotate(45 50 50)"/>
                <path d="M 40 10 L 60 10 L 60 40 L 90 40 L 90 60 L 60 60 L 60 90 L 40 90 L 40 60 L 10 60 L 10 40 L 40 40 Z"/>
            </svg>
        </div>

        <!-- Subtle ECG Line Decoration -->
        <div class="absolute top-1/4 left-0 w-full h-24 opacity-10 pointer-events-none">
            <svg preserveAspectRatio="none" viewBox="0 0 100 24" class="w-full h-full stroke-primary-600" fill="none" stroke-width="0.2">
                <polyline points="0,12 20,12 22,5 24,19 26,12 100,12" />
            </svg>
        </div>

        <div class="max-w-7xl mx-auto relative z-20 text-center flex flex-col items-center">
            <span class="inline-block bg-white text-primary-600 border border-primary-100 shadow-sm font-black tracking-widest text-[10px] sm:text-xs px-4 py-1.5 sm:px-5 sm:py-2 rounded-full mb-3 sm:mb-6 uppercase relative z-30">
                Bergabung Bersama Kami
            </span>
            <h2 class="text-xl sm:text-2xl md:text-[2.5rem] font-black text-slate-900 mb-6 sm:mb-14 leading-tight">
                Jadilah Bagian dari Ambulans Siaga
            </h2>

            <!-- Focal Point: 3D Coverflow Slider (Mobile: Clean Single Image with Next/Prev; Desktop: 3D Coverflow) -->
            <div class="relative w-full max-w-4xl mx-auto mb-12 sm:mb-16 h-[230px] sm:h-[300px] md:h-[350px] flex justify-center items-center px-4" 
                 x-data="{ 
                     active: 0, 
                     slides: [
                        '{{ asset('images/dokumgsc (27).JPG') }}',
                        '{{ asset('images/dokumgsc (7).JPG') }}',
                        '{{ asset('images/mitra.JPG') }}',
                        '{{ asset('images/dokumgsc (28).JPG') }}'
                     ],
                     touchStartX: 0,
                     touchEndX: 0,
                     next() { this.active = (this.active + 1) % this.slides.length; },
                     prev() { this.active = (this.active - 1 + this.slides.length) % this.slides.length; },
                     handleTouchStart(e) { this.touchStartX = e.changedTouches[0].screenX; },
                     handleTouchEnd(e) {
                         this.touchEndX = e.changedTouches[0].screenX;
                         if (this.touchStartX - this.touchEndX > 40) { this.next(); this.startAuto(); }
                         if (this.touchEndX - this.touchStartX > 40) { this.prev(); this.startAuto(); }
                     },
                     getPos(i) {
                         if (i === this.active) return 'center';
                         if (i === (this.active + 1) % this.slides.length) return 'right';
                         if (i === (this.active - 1 + this.slides.length) % this.slides.length) return 'left';
                         return 'hidden';
                     },
                     timer: null,
                     startAuto() {
                         this.stopAuto();
                         this.timer = setInterval(() => { this.next(); }, 3500);
                     },
                     stopAuto() {
                         if (this.timer) {
                             clearInterval(this.timer);
                             this.timer = null;
                         }
                     },
                     init() {
                         this.startAuto();
                     }
                 }"
                 @mouseenter="stopAuto()"
                 @mouseleave="startAuto()"
                 @touchstart="handleTouchStart($event)"
                 @touchend="handleTouchEnd($event)">
                
                <!-- Soft Halo -->
                <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-56 h-56 md:w-[380px] md:h-[380px] bg-sky-300/30 rounded-full blur-[60px] animate-pulse pointer-events-none z-0"></div>
                
                <!-- Slides Container (Auto Slides Automatically) -->
                <template x-for="(slide, i) in slides" :key="i">
                    <div class="absolute w-[260px] sm:w-[320px] md:w-[440px] aspect-[4/3] rounded-2xl md:rounded-3xl overflow-hidden transition-all duration-700 ease-out cursor-pointer shadow-xl md:shadow-2xl border-4 border-white origin-center"
                         :class="{
                             'z-30 scale-100 translate-x-0 opacity-100': getPos(i) === 'center',
                             'z-20 md:scale-75 md:translate-x-[58%] md:opacity-60 max-md:opacity-0 max-md:pointer-events-none max-md:scale-90 max-md:translate-x-8': getPos(i) === 'right',
                             'z-20 md:scale-75 md:-translate-x-[58%] md:opacity-60 max-md:opacity-0 max-md:pointer-events-none max-md:scale-90 max-md:-translate-x-8': getPos(i) === 'left',
                             'opacity-0 scale-50 z-10 translate-x-0 pointer-events-none': getPos(i) === 'hidden'
                         }"
                         @click="if (getPos(i) === 'center') { next(); startAuto(); } else { active = i; startAuto(); }">
                         
                         <!-- Dark overlay for side images on desktop -->
                         <div class="hidden md:block absolute inset-0 bg-slate-900/30 transition-opacity duration-500" :class="getPos(i) === 'center' ? 'opacity-0' : 'opacity-100'"></div>
                         
                         <img :src="slide" alt="Galeri Mitra" class="w-full h-full object-cover">
                    </div>
                </template>
                
                <!-- Carousel Dots Indicator -->
                <div class="absolute -bottom-8 left-0 right-0 flex justify-center gap-2 z-40">
                    <template x-for="(slide, i) in slides" :key="'dot-'+i">
                        <button @click="active = i; startAuto()" 
                                class="h-2 rounded-full transition-all duration-300"
                                :class="active === i ? 'bg-primary-600 w-6' : 'bg-primary-200 w-2 hover:bg-primary-400'"></button>
                    </template>
                </div>
            </div>

            <!-- Alur Pendaftaran Pengemudi (5 Tahap Simple - Sesuai Gambar Referensi) -->
            <div class="w-full max-w-6xl mx-auto mb-12 sm:mb-14 px-4 sm:px-6 text-left">
                <!-- Simple Header -->
                <div class="mb-8 sm:mb-10">
                    <h3 class="text-xl sm:text-2xl font-black text-slate-900 tracking-tight">
                        ALUR PENDAFTARAN
                    </h3>
                </div>

                <!-- 5 Tahap Grid (Clean, Simple & Spacious) -->
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-6 sm:gap-7 lg:gap-8">
                    <!-- Tahap 1: Daftar -->
                    <div class="flex flex-col justify-between group">
                        <div>
                            <div class="flex items-center gap-2.5 mb-2">
                                <div class="relative w-12 h-10 flex items-center justify-center shrink-0">
                                    <span class="absolute inset-0 flex items-center justify-center font-black tracking-tighter select-none font-sans text-transparent pointer-events-none"
                                          style="font-size: 2.3rem; line-height: 1; -webkit-text-stroke: 1.4px rgba(0, 156, 166, 0.45);">
                                        01
                                    </span>
                                    <div class="relative z-10 text-primary-600 transition-transform duration-300 group-hover:scale-110">
                                        <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2"/>
                                            <rect x="9" y="3" width="6" height="4" rx="1"/>
                                            <path d="M9 12h6m-6 4h4"/>
                                        </svg>
                                    </div>
                                </div>
                                <h4 class="text-base sm:text-lg font-black text-slate-900 tracking-tight">Daftar</h4>
                            </div>
                            <p class="text-xs text-slate-500 leading-relaxed font-normal mb-3">
                                Isi formulir pendaftaran dan data diri pengemudi secara online.
                            </p>
                        </div>
                        <div>
                            <a href="{{ route('register.supir') }}" class="inline-flex items-center gap-1 text-primary-600 hover:text-primary-700 font-bold text-xs tracking-wide transition-all group-hover:translate-x-1">
                                Mulai Daftar <span class="text-sm leading-none">&raquo;</span>
                            </a>
                        </div>
                    </div>

                    <!-- Tahap 2: Berkas -->
                    <div class="flex flex-col justify-between group">
                        <div>
                            <div class="flex items-center gap-2.5 mb-2">
                                <div class="relative w-12 h-10 flex items-center justify-center shrink-0">
                                    <span class="absolute inset-0 flex items-center justify-center font-black tracking-tighter select-none font-sans text-transparent pointer-events-none"
                                          style="font-size: 2.3rem; line-height: 1; -webkit-text-stroke: 1.4px rgba(0, 156, 166, 0.45);">
                                        02
                                    </span>
                                    <div class="relative z-10 text-primary-600 transition-transform duration-300 group-hover:scale-110">
                                        <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                            <rect x="3" y="5" width="18" height="14" rx="2" fill="currentColor" fill-opacity="0.08"/>
                                            <circle cx="8" cy="10" r="2"/>
                                            <path d="M5.5 15a2.5 2.5 0 015 0"/>
                                            <path d="M14 9h4m-4 3h4m-4 3h2"/>
                                        </svg>
                                    </div>
                                </div>
                                <h4 class="text-base sm:text-lg font-black text-slate-900 tracking-tight">Berkas</h4>
                            </div>
                            <p class="text-xs text-slate-500 leading-relaxed font-normal mb-3">
                                Unggah kelengkapan KTP, SIM aktif, dan data pengemudi.
                            </p>
                        </div>
                        <div>
                            <a href="{{ route('mitra.pengemudi') }}" class="inline-flex items-center gap-1 text-primary-600 hover:text-primary-700 font-bold text-xs tracking-wide transition-all group-hover:translate-x-1">
                                Cek Syarat <span class="text-sm leading-none">&raquo;</span>
                            </a>
                        </div>
                    </div>

                    <!-- Tahap 3: Verifikasi -->
                    <div class="flex flex-col justify-between group">
                        <div>
                            <div class="flex items-center gap-2.5 mb-2">
                                <div class="relative w-12 h-10 flex items-center justify-center shrink-0">
                                    <span class="absolute inset-0 flex items-center justify-center font-black tracking-tighter select-none font-sans text-transparent pointer-events-none"
                                          style="font-size: 2.3rem; line-height: 1; -webkit-text-stroke: 1.4px rgba(0, 156, 166, 0.45);">
                                        03
                                    </span>
                                    <div class="relative z-10 text-primary-600 transition-transform duration-300 group-hover:scale-110">
                                        <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M12 3l8 3.5v6c0 5-3.5 8.5-8 10-4.5-1.5-8-5-8-10v-6L12 3z" fill="currentColor" fill-opacity="0.08"/>
                                            <path d="M9 12l2 2 4-4" stroke-width="2.2"/>
                                        </svg>
                                    </div>
                                </div>
                                <h4 class="text-base sm:text-lg font-black text-slate-900 tracking-tight">Verifikasi</h4>
                            </div>
                            <p class="text-xs text-slate-500 leading-relaxed font-normal mb-3">
                                Tim kami melakukan validasi keaslian dokumen dan data.
                            </p>
                        </div>
                        <div>
                            <a href="{{ route('mitra.pengemudi') }}" class="inline-flex items-center gap-1 text-primary-600 hover:text-primary-700 font-bold text-xs tracking-wide transition-all group-hover:translate-x-1">
                                Proses Cepat <span class="text-sm leading-none">&raquo;</span>
                            </a>
                        </div>
                    </div>

                    <!-- Tahap 4: Pelatihan -->
                    <div class="flex flex-col justify-between group">
                        <div>
                            <div class="flex items-center gap-2.5 mb-2">
                                <div class="relative w-12 h-10 flex items-center justify-center shrink-0">
                                    <span class="absolute inset-0 flex items-center justify-center font-black tracking-tighter select-none font-sans text-transparent pointer-events-none"
                                          style="font-size: 2.3rem; line-height: 1; -webkit-text-stroke: 1.4px rgba(0, 156, 166, 0.45);">
                                        04
                                    </span>
                                    <div class="relative z-10 text-primary-600 transition-transform duration-300 group-hover:scale-110">
                                        <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" fill="currentColor" fill-opacity="0.08"/>
                                        </svg>
                                    </div>
                                </div>
                                <h4 class="text-base sm:text-lg font-black text-slate-900 tracking-tight">Pelatihan</h4>
                            </div>
                            <p class="text-xs text-slate-500 leading-relaxed font-normal mb-3">
                                Briefing SOP tanggap darurat dan panduan penggunaan aplikasi.
                            </p>
                        </div>
                        <div>
                            <a href="{{ route('mitra.pengemudi') }}" class="inline-flex items-center gap-1 text-primary-600 hover:text-primary-700 font-bold text-xs tracking-wide transition-all group-hover:translate-x-1">
                                Pelajari SOP <span class="text-sm leading-none">&raquo;</span>
                            </a>
                        </div>
                    </div>

                    <!-- Tahap 5: Siaga -->
                    <div class="flex flex-col justify-between group">
                        <div>
                            <div class="flex items-center gap-2.5 mb-2">
                                <div class="relative w-12 h-10 flex items-center justify-center shrink-0">
                                    <span class="absolute inset-0 flex items-center justify-center font-black tracking-tighter select-none font-sans text-transparent pointer-events-none"
                                          style="font-size: 2.3rem; line-height: 1; -webkit-text-stroke: 1.4px rgba(0, 156, 166, 0.45);">
                                        05
                                    </span>
                                    <div class="relative z-10 text-primary-600 transition-transform duration-300 group-hover:scale-110">
                                        <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M3 8a1 1 0 011-1h10a1 1 0 011 1v8H3V8z" fill="currentColor" fill-opacity="0.08"/>
                                            <path d="M15 10h3.5l2.5 3v3H15v-6z"/>
                                            <circle cx="7" cy="17" r="2" fill="white" stroke-width="2"/>
                                            <circle cx="18" cy="17" r="2" fill="white" stroke-width="2"/>
                                            <path d="M8 10v4m-2-2h4" stroke-width="2"/>
                                            <path d="M8 5h2v2H8z" fill="currentColor"/>
                                        </svg>
                                    </div>
                                </div>
                                <h4 class="text-base sm:text-lg font-black text-slate-900 tracking-tight">Siap Siaga</h4>
                            </div>
                            <p class="text-xs text-slate-500 leading-relaxed font-normal mb-3">
                                Akun aktif dan Anda siap melayani panggilan darurat.
                            </p>
                        </div>
                        <div>
                            <a href="{{ route('login') }}" class="inline-flex items-center gap-1 text-primary-600 hover:text-primary-700 font-bold text-xs tracking-wide transition-all group-hover:translate-x-1">
                                Mulai Bertugas <span class="text-sm leading-none">&raquo;</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- CTA Button -->
            <a href="{{ route('register.supir') }}" class="inline-flex items-center justify-center gap-2 sm:gap-3 bg-primary-600 text-white px-6 sm:px-8 py-2.5 sm:py-3.5 rounded-lg font-bold hover:bg-primary-700 transition shadow-md hover:shadow-lg text-xs sm:text-sm uppercase tracking-wider">
                <span>Daftar sebagai Pengemudi Ambulans</span>
                <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
            </a>
        </div>
    </section>

    <!-- Rumah Sakit Rujukan Section (Putih / White) -->
    <section class="py-12 sm:py-20 lg:py-24 px-5 sm:px-6 lg:px-12 bg-white border-t border-slate-100">
        <div class="max-w-7xl mx-auto">
            <div class="text-left lg:text-center max-w-3xl lg:mx-auto mb-8 sm:mb-12">
                <div class="text-center mb-3 sm:mb-5">
                    <span class="inline-block bg-white text-primary-600 border border-primary-100 shadow-sm font-black tracking-widest text-[10px] sm:text-xs px-4 py-1.5 sm:px-5 sm:py-2 rounded-full uppercase">
                        Fasilitas Medis
                    </span>
                </div>
                <h2 class="text-xl sm:text-2xl md:text-[2.5rem] font-black text-slate-900 mb-3 sm:mb-6 leading-tight text-left lg:text-center">Mitra Fasilitas Kesehatan</h2>
                <p class="text-slate-500 font-medium text-xs sm:text-base lg:text-lg leading-relaxed text-left lg:text-center">Jaringan Rumah Sakit rujukan darurat 24 Jam yang terhubung dalam ekosistem Ambulans Siaga.</p>
            </div>

            @if($rumahSakits->count() > 0)
            <!-- Unified Responsive Horizontal Hospital Slider (Single Row, Manual Sliding, No Auto-Scroll) -->
            <div class="w-full relative px-1 sm:px-2"
                 x-data="{
                     scrollTrack: null,
                     init() {
                         this.scrollTrack = this.$refs.sliderTrack;
                     },
                     scrollNext() {
                         if (!this.scrollTrack) return;
                         const maxScroll = this.scrollTrack.scrollWidth - this.scrollTrack.clientWidth;
                         // Jika sudah di pojok kanan (hampir mentok atau mentok), kembali ke awal lagi
                         if (this.scrollTrack.scrollLeft >= maxScroll - 20) {
                             this.scrollTrack.scrollTo({ left: 0, behavior: 'smooth' });
                         } else {
                             const amount = this.scrollTrack.clientWidth * 0.85;
                             this.scrollTrack.scrollBy({ left: amount, behavior: 'smooth' });
                         }
                     },
                     scrollPrev() {
                         if (!this.scrollTrack) return;
                         const maxScroll = this.scrollTrack.scrollWidth - this.scrollTrack.clientWidth;
                         // Jika sudah di pojok kiri (hampir mentok di 0), lompat ke ujung kanan
                         if (this.scrollTrack.scrollLeft <= 20) {
                             this.scrollTrack.scrollTo({ left: maxScroll, behavior: 'smooth' });
                         } else {
                             const amount = this.scrollTrack.clientWidth * 0.85;
                             this.scrollTrack.scrollBy({ left: -amount, behavior: 'smooth' });
                         }
                     }
                 }">
                
                <!-- Floating Left Arrow Button (Prev) - Selalu aktif dan loop ke akhir jika di awal -->
                <button @click="scrollPrev()"
                        type="button"
                        aria-label="Geser ke Fasilitas Sebelumnya"
                        class="absolute -left-2 sm:-left-4 md:-left-6 top-1/2 -translate-y-1/2 w-10 h-10 sm:w-12 sm:h-12 rounded-full bg-white text-slate-700 shadow-xl border border-slate-200/90 flex items-center justify-center hover:bg-primary-600 hover:text-white hover:border-primary-600 active:scale-95 transition-all z-20 cursor-pointer backdrop-blur-xs">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/></svg>
                </button>

                <!-- Floating Right Arrow Button (Next) - Selalu aktif dan loop ke awal jika sudah di pojok -->
                <button @click="scrollNext()"
                        type="button"
                        aria-label="Geser ke Fasilitas Berikutnya"
                        class="absolute -right-2 sm:-right-4 md:-right-6 top-1/2 -translate-y-1/2 w-10 h-10 sm:w-12 sm:h-12 rounded-full bg-white text-slate-700 shadow-xl border border-slate-200/90 flex items-center justify-center hover:bg-primary-600 hover:text-white hover:border-primary-600 active:scale-95 transition-all z-20 cursor-pointer backdrop-blur-xs">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
                </button>

                <!-- Single Row Horizontal Slider Track (No auto-slide, scrollable & swipeable) -->
                <div x-ref="sliderTrack"
                     class="flex gap-4 sm:gap-6 overflow-x-auto scroll-smooth snap-x snap-mandatory py-4 px-1 [scrollbar-width:none] [-ms-overflow-style:none] [&::-webkit-scrollbar]:hidden">
                    @foreach($rumahSakits as $rs)
                        <div class="snap-start shrink-0 w-[85%] sm:w-[calc(50%-12px)] lg:w-[calc(25%-18px)] bg-slate-50 hover:bg-white p-5 sm:p-6 rounded-2xl border border-slate-200/80 hover:border-primary-200 shadow-xs hover:shadow-xl transition-all group flex flex-col justify-between h-[235px] sm:h-[245px]">
                            <div>
                                <div class="flex items-center mb-3">
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-lg bg-sky-50 text-[10px] font-black text-sky-600 tracking-wider uppercase">
                                        IGD 24 JAM
                                    </span>
                                </div>
                                <h3 class="font-bold text-slate-800 text-base sm:text-lg mb-1.5 leading-snug line-clamp-2 min-h-[44px] group-hover:text-primary-600 transition-colors" title="{{ $rs->nama }}">
                                    {{ $rs->nama }}
                                </h3>
                                <p class="text-xs sm:text-sm text-slate-500 leading-relaxed font-normal line-clamp-2 min-h-[36px]" title="{{ $rs->alamat }}">
                                    {{ $rs->alamat }}
                                </p>
                            </div>
                            <div class="pt-3.5 border-t border-slate-200/70 flex items-center justify-between mt-auto">
                                <span class="text-xs font-bold text-slate-600 flex items-center gap-1.5">
                                    <svg class="w-3.5 h-3.5 text-slate-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                                    <span>{{ $rs->telepon }}</span>
                                </span>
                                <a href="https://www.google.com/maps?q={{ $rs->lat }},{{ $rs->lng }}"
                                   target="_blank"
                                   rel="noopener noreferrer"
                                   title="Buka Peta Google Maps"
                                   class="w-8 h-8 rounded-full bg-white border border-slate-200/80 flex items-center justify-center text-sky-600 group-hover:bg-primary-600 group-hover:text-white group-hover:border-primary-600 shadow-2xs transition-all hover:scale-110">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"></path></svg>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>

            </div>
            @endif
        </div>
    </section>

    <!-- Partners Section (Pudar / Slate-50) -->
    <section class="py-16 sm:py-20 px-4 sm:px-6 bg-slate-50 border-t border-slate-200/80 overflow-hidden">
        <div class="max-w-7xl mx-auto flex flex-col items-center justify-center gap-8 sm:gap-10">
            <h4 class="text-slate-400 font-extrabold uppercase tracking-[0.2em] text-xs sm:text-sm text-center">
                Didukung Oleh Mitra Kebaikan
            </h4>
            
            <!-- Continuous Infinite Marquee Track -->
            <div class="relative w-full overflow-hidden py-3 select-none cursor-pointer group"
                 x-data="{
                     setPartnerSpeed(rate) {
                         $el.querySelectorAll('.animate-partner-marquee').forEach(el => {
                             el.getAnimations().forEach(anim => {
                                 anim.playbackRate = rate;
                             });
                         });
                     }
                 }"
                 @mouseenter="setPartnerSpeed(0.35)"
                 @mouseleave="setPartnerSpeed(1.0)"
                 @pointerenter="setPartnerSpeed(0.35)"
                 @pointerleave="setPartnerSpeed(1.0)">
                 
                <!-- Left & Right Gradient Fade Masks -->
                <div class="absolute left-0 top-0 bottom-0 w-16 sm:w-28 bg-gradient-to-r from-slate-50 to-transparent z-10 pointer-events-none"></div>
                <div class="absolute right-0 top-0 bottom-0 w-16 sm:w-28 bg-gradient-to-l from-slate-50 to-transparent z-10 pointer-events-none"></div>

                <!-- Marquee Wrapper (Seamless Double Loop) -->
                <div class="flex overflow-hidden">
                    <!-- Set 1 -->
                    <div class="animate-partner-marquee flex items-center gap-12 sm:gap-20 flex-shrink-0 pr-12 sm:pr-20">
                        <div class="flex items-center grayscale opacity-50 group-hover:opacity-100 group-hover:grayscale-0 hover:!scale-110 transition-all duration-300 flex-shrink-0">
                            <span class="text-2xl sm:text-3xl font-black text-green-700 tracking-tighter">BAZNAS</span>
                        </div>
                        <div class="flex items-center grayscale opacity-50 group-hover:opacity-100 group-hover:grayscale-0 hover:!scale-110 transition-all duration-300 flex-shrink-0">
                            <div class="text-2xl sm:text-3xl font-black text-orange-500 flex items-center gap-2.5">
                                <svg class="w-8 h-8 sm:w-9 sm:h-9" fill="currentColor" viewBox="0 0 24 24"><path d="M12 3L1 11.4l1.2 1.6L4 11.6V21h16v-9.4l1.8 1.4 1.2-1.6L12 3zm-2 15h-4v-4h4v4zm6 0h-4v-4h4v4z"></path></svg> 
                                <span class="tracking-tighter">Rumah Zakat</span>
                            </div>
                        </div>
                        <div class="flex items-center grayscale opacity-50 group-hover:opacity-100 group-hover:grayscale-0 hover:!scale-110 transition-all duration-300 flex-shrink-0">
                            <div class="text-2xl sm:text-3xl font-black text-orange-400 tracking-tighter">
                                lazis<span class="text-orange-600">mu</span>
                            </div>
                        </div>
                        <div class="flex items-center grayscale opacity-50 group-hover:opacity-100 group-hover:grayscale-0 hover:!scale-110 transition-all duration-300 flex-shrink-0">
                            <div class="text-2xl sm:text-3xl font-black text-green-600 tracking-tighter flex items-center gap-2 leading-none">
                                <span class="w-6 h-6 sm:w-7 sm:h-7 bg-green-600 rounded-sm inline-block flex-shrink-0"></span> 
                                <span class="text-xs sm:text-sm font-black leading-tight tracking-wider">DOMPET<br>DHUAFA</span>
                            </div>
                        </div>
                        <div class="flex items-center grayscale opacity-50 group-hover:opacity-100 group-hover:grayscale-0 hover:!scale-110 transition-all duration-300 flex-shrink-0">
                            <span class="text-2xl sm:text-3xl font-black text-sky-500 tracking-tighter">kitabisa</span>
                        </div>

                        <!-- Repeat 5 logos for dense seamless loop -->
                        <div class="flex items-center grayscale opacity-50 group-hover:opacity-100 group-hover:grayscale-0 hover:!scale-110 transition-all duration-300 flex-shrink-0">
                            <span class="text-2xl sm:text-3xl font-black text-green-700 tracking-tighter">BAZNAS</span>
                        </div>
                        <div class="flex items-center grayscale opacity-50 group-hover:opacity-100 group-hover:grayscale-0 hover:!scale-110 transition-all duration-300 flex-shrink-0">
                            <div class="text-2xl sm:text-3xl font-black text-orange-500 flex items-center gap-2.5">
                                <svg class="w-8 h-8 sm:w-9 sm:h-9" fill="currentColor" viewBox="0 0 24 24"><path d="M12 3L1 11.4l1.2 1.6L4 11.6V21h16v-9.4l1.8 1.4 1.2-1.6L12 3zm-2 15h-4v-4h4v4zm6 0h-4v-4h4v4z"></path></svg> 
                                <span class="tracking-tighter">Rumah Zakat</span>
                            </div>
                        </div>
                        <div class="flex items-center grayscale opacity-50 group-hover:opacity-100 group-hover:grayscale-0 hover:!scale-110 transition-all duration-300 flex-shrink-0">
                            <div class="text-2xl sm:text-3xl font-black text-orange-400 tracking-tighter">
                                lazis<span class="text-orange-600">mu</span>
                            </div>
                        </div>
                        <div class="flex items-center grayscale opacity-50 group-hover:opacity-100 group-hover:grayscale-0 hover:!scale-110 transition-all duration-300 flex-shrink-0">
                            <div class="text-2xl sm:text-3xl font-black text-green-600 tracking-tighter flex items-center gap-2 leading-none">
                                <span class="w-6 h-6 sm:w-7 sm:h-7 bg-green-600 rounded-sm inline-block flex-shrink-0"></span> 
                                <span class="text-xs sm:text-sm font-black leading-tight tracking-wider">DOMPET<br>DHUAFA</span>
                            </div>
                        </div>
                        <div class="flex items-center grayscale opacity-50 group-hover:opacity-100 group-hover:grayscale-0 hover:!scale-110 transition-all duration-300 flex-shrink-0">
                            <span class="text-2xl sm:text-3xl font-black text-sky-500 tracking-tighter">kitabisa</span>
                        </div>
                    </div>

                    <!-- Set 2 (Duplicate for Seamless Infinite Loop) -->
                    <div class="animate-partner-marquee flex items-center gap-12 sm:gap-20 flex-shrink-0 pr-12 sm:pr-20" aria-hidden="true">
                        <div class="flex items-center grayscale opacity-50 group-hover:opacity-100 group-hover:grayscale-0 hover:!scale-110 transition-all duration-300 flex-shrink-0">
                            <span class="text-2xl sm:text-3xl font-black text-green-700 tracking-tighter">BAZNAS</span>
                        </div>
                        <div class="flex items-center grayscale opacity-50 group-hover:opacity-100 group-hover:grayscale-0 hover:!scale-110 transition-all duration-300 flex-shrink-0">
                            <div class="text-2xl sm:text-3xl font-black text-orange-500 flex items-center gap-2.5">
                                <svg class="w-8 h-8 sm:w-9 sm:h-9" fill="currentColor" viewBox="0 0 24 24"><path d="M12 3L1 11.4l1.2 1.6L4 11.6V21h16v-9.4l1.8 1.4 1.2-1.6L12 3zm-2 15h-4v-4h4v4zm6 0h-4v-4h4v4z"></path></svg> 
                                <span class="tracking-tighter">Rumah Zakat</span>
                            </div>
                        </div>
                        <div class="flex items-center grayscale opacity-50 group-hover:opacity-100 group-hover:grayscale-0 hover:!scale-110 transition-all duration-300 flex-shrink-0">
                            <div class="text-2xl sm:text-3xl font-black text-orange-400 tracking-tighter">
                                lazis<span class="text-orange-600">mu</span>
                            </div>
                        </div>
                        <div class="flex items-center grayscale opacity-50 group-hover:opacity-100 group-hover:grayscale-0 hover:!scale-110 transition-all duration-300 flex-shrink-0">
                            <div class="text-2xl sm:text-3xl font-black text-green-600 tracking-tighter flex items-center gap-2 leading-none">
                                <span class="w-6 h-6 sm:w-7 sm:h-7 bg-green-600 rounded-sm inline-block flex-shrink-0"></span> 
                                <span class="text-xs sm:text-sm font-black leading-tight tracking-wider">DOMPET<br>DHUAFA</span>
                            </div>
                        </div>
                        <div class="flex items-center grayscale opacity-50 group-hover:opacity-100 group-hover:grayscale-0 hover:!scale-110 transition-all duration-300 flex-shrink-0">
                            <span class="text-2xl sm:text-3xl font-black text-sky-500 tracking-tighter">kitabisa</span>
                        </div>

                        <!-- Repeat 5 logos for dense seamless loop -->
                        <div class="flex items-center grayscale opacity-50 group-hover:opacity-100 group-hover:grayscale-0 hover:!scale-110 transition-all duration-300 flex-shrink-0">
                            <span class="text-2xl sm:text-3xl font-black text-green-700 tracking-tighter">BAZNAS</span>
                        </div>
                        <div class="flex items-center grayscale opacity-50 group-hover:opacity-100 group-hover:grayscale-0 hover:!scale-110 transition-all duration-300 flex-shrink-0">
                            <div class="text-2xl sm:text-3xl font-black text-orange-500 flex items-center gap-2.5">
                                <svg class="w-8 h-8 sm:w-9 sm:h-9" fill="currentColor" viewBox="0 0 24 24"><path d="M12 3L1 11.4l1.2 1.6L4 11.6V21h16v-9.4l1.8 1.4 1.2-1.6L12 3zm-2 15h-4v-4h4v4zm6 0h-4v-4h4v4z"></path></svg> 
                                <span class="tracking-tighter">Rumah Zakat</span>
                            </div>
                        </div>
                        <div class="flex items-center grayscale opacity-50 group-hover:opacity-100 group-hover:grayscale-0 hover:!scale-110 transition-all duration-300 flex-shrink-0">
                            <div class="text-2xl sm:text-3xl font-black text-orange-400 tracking-tighter">
                                lazis<span class="text-orange-600">mu</span>
                            </div>
                        </div>
                        <div class="flex items-center grayscale opacity-50 group-hover:opacity-100 group-hover:grayscale-0 hover:!scale-110 transition-all duration-300 flex-shrink-0">
                            <div class="text-2xl sm:text-3xl font-black text-green-600 tracking-tighter flex items-center gap-2 leading-none">
                                <span class="w-6 h-6 sm:w-7 sm:h-7 bg-green-600 rounded-sm inline-block flex-shrink-0"></span> 
                                <span class="text-xs sm:text-sm font-black leading-tight tracking-wider">DOMPET<br>DHUAFA</span>
                            </div>
                        </div>
                        <div class="flex items-center grayscale opacity-50 group-hover:opacity-100 group-hover:grayscale-0 hover:!scale-110 transition-all duration-300 flex-shrink-0">
                            <span class="text-2xl sm:text-3xl font-black text-sky-500 tracking-tighter">kitabisa</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <style>
            .layanan-stroke {
                color: transparent;
                -webkit-text-stroke: 2px #009CA6;
                font-weight: 900;
            }
            @supports not (-webkit-text-stroke: 1px black) {
                .layanan-stroke {
                    color: #009CA6;
                }
            }
            @keyframes partner-marquee-scroll {
                0% { transform: translateX(0); }
                100% { transform: translateX(-100%); }
            }
            .animate-partner-marquee {
                animation: partner-marquee-scroll 30s linear infinite;
            }
        </style>
    </section>

    <x-floating-donasi />
    <x-landing-footer />
</div>
