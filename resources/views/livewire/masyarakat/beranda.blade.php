<div>


    <!-- Hero Section -->
    <section class="relative pt-36 sm:pt-40 pb-28 sm:pb-36 px-6 lg:px-12 overflow-hidden bg-primary-600" style="background-image: url('{{ asset('images/beranda_utama_bg.jpg') }}'); background-size: cover; background-position: center; background-repeat: no-repeat;">
        <!-- Gradient Overlay: Rich Teal/Cyan & Primary (Matching Donasi Hero) -->
        <div class="absolute inset-0 bg-gradient-to-r from-primary-700 via-[#009CA6]/85 to-primary-600/75 mix-blend-multiply"></div>
        <div class="absolute inset-0 bg-gradient-to-r from-primary-700/90 via-[#009CA6]/80 to-primary-800/75"></div>
        
        <!-- Gradasi Halus ke Bawah Menuju Section Berikutnya -->
        <div class="absolute inset-x-0 bottom-0 h-28 sm:h-36 bg-gradient-to-t from-white via-white/40 to-transparent pointer-events-none z-10"></div>

        <div class="max-w-7xl mx-auto flex flex-col lg:flex-row items-center gap-12 relative z-10">
            <!-- Left Text -->
            <div class="lg:w-[55%] text-white z-10 text-left">
                <div class="text-center lg:text-left mb-4 sm:mb-6">
                    <div class="inline-flex items-center gap-2 bg-white/15 backdrop-blur text-white border border-white/20 shadow-sm font-black tracking-widest text-[10px] sm:text-xs px-4 py-1.5 sm:px-5 sm:py-2 rounded-full uppercase">
                        <svg class="w-4 h-4 sm:w-5 sm:h-5 text-yellow-300" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                        <span>JARINGAN AMBULANS TANGGAP DARURAT</span>
                    </div>
                </div>
                <h1 class="text-2xl sm:text-4xl lg:text-[3.5rem] font-black leading-tight sm:leading-[1.15] mb-4 sm:mb-6 drop-shadow-lg text-left">
                    Kecepatan & Kepedulian dalam Menyelamatkan Nyawa
                </h1>
                <p class="text-xs sm:text-base lg:text-lg text-sky-100 mb-6 sm:mb-10 max-w-2xl leading-relaxed font-medium text-left">
                    Ambulans Siaga adalah platform tanggap darurat terpadu 24 jam yang menghubungkan armada ambulans lintas-mitra untuk melayani evakuasi medis, rujukan, dan gawat darurat secara cepat dan transparan.
                </p>
                <div class="flex flex-col sm:flex-row gap-3 sm:gap-4 justify-start">
                    <a href="{{ route('masyarakat.order.create') }}" class="group relative inline-flex justify-center items-center gap-2 bg-white text-primary-600 px-6 sm:px-8 py-3 sm:py-4 rounded-full font-bold text-xs sm:text-base hover:bg-slate-50 transition-all shadow-[0_8px_30px_rgb(0,0,0,0.2)] hover:scale-105">
                        <span class="absolute -top-1 -right-1 flex h-3.5 w-3.5 sm:h-4 sm:w-4">
                          <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-400 opacity-75"></span>
                          <span class="relative inline-flex rounded-full h-3.5 w-3.5 sm:h-4 sm:w-4 bg-red-500"></span>
                        </span>
                        <svg class="w-4 h-4 sm:w-5 sm:h-5 text-red-500 group-hover:animate-bounce" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                        Pesan Darurat Sekarang
                    </a>
                    <a href="tel:{{ str_replace('-', '', $telepon ?? '081234567890') }}" class="inline-flex justify-center items-center gap-2 bg-transparent border-2 border-white/50 text-white px-6 sm:px-8 py-3 sm:py-4 rounded-full font-bold text-xs sm:text-base hover:bg-white/10 hover:border-white transition-all">
                        Hotline: {{ $telepon ?? '0812-3456-7890' }}
                    </a>
                </div>
            </div>
            
            <!-- Right Images (Creative Layout) -->
            <div class="lg:w-[45%] relative h-[450px] w-full hidden md:block">
                <!-- Decorative background blob -->
                <div class="absolute right-0 top-1/2 -translate-y-1/2 w-[400px] h-[400px] bg-white/20 rounded-full blur-3xl"></div>
                
                <!-- Image 1 -->
                <img src="{{ asset('images/dokumgsc (27).JPG') }}" class="absolute top-0 right-12 w-[280px] h-[280px] rounded-[3rem] shadow-2xl border-4 border-white/30 z-10 hover:-translate-y-2 transition-transform duration-500" style="object-fit: cover; object-position: center;" alt="Armada Ambulans Siaga">
                
                <!-- Image 2 -->
                <img src="{{ asset('images/dokumgsc (28).JPG') }}" class="absolute bottom-4 right-48 w-[220px] h-[220px] rounded-[2.5rem] shadow-2xl border-4 border-white/30 z-20 hover:-translate-y-2 transition-transform duration-500" style="object-fit: cover; object-position: center;" alt="Operasional Ambulans Siaga">
                
                <!-- Floating badge -->
                <div class="absolute bottom-20 right-0 bg-white p-4 rounded-2xl shadow-2xl z-30 flex items-center gap-4 w-60 border border-slate-100 animate-pulse">
                    <div class="w-14 h-14 bg-emerald-100 rounded-full flex items-center justify-center shrink-0">
                        <svg class="w-7 h-7 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <div>
                        <p class="text-base font-black text-slate-800">Siaga 24 Jam</p>
                        <p class="text-xs font-semibold text-slate-500">Respon Sangat Cepat</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Floating Stats Card -->
    <section class="max-w-6xl mx-auto px-6 -mt-20 sm:-mt-24 relative z-20">
        <div class="bg-white rounded-2xl sm:rounded-[2.5rem] shadow-[0_20px_50px_rgba(15,23,42,0.12)] border border-slate-100 p-5 sm:p-8 md:p-10 grid grid-cols-2 lg:flex lg:flex-nowrap justify-between items-center gap-4 sm:gap-8">
            <div class="text-center w-full group">
                <div class="w-11 h-11 sm:w-14 sm:h-14 md:w-16 md:h-16 mx-auto bg-sky-50 rounded-xl sm:rounded-2xl text-primary-600 mb-2 sm:mb-4 flex items-center justify-center group-hover:-translate-y-2 transition-transform duration-300">
                    <svg class="w-5 h-5 sm:w-7 sm:h-7 md:w-8 md:h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                </div>
                <h3 class="text-2xl sm:text-3xl md:text-4xl font-black text-slate-800 mb-0.5 sm:mb-1">{{ number_format($totalAmbulans ?? 8) }}</h3>
                <p class="text-[9px] sm:text-xs md:text-sm font-bold text-slate-400 uppercase tracking-wider">Armada Siaga</p>
            </div>
            
            <div class="w-px h-20 bg-slate-100 hidden lg:block"></div>

            <div class="text-center w-full group">
                <div class="w-11 h-11 sm:w-14 sm:h-14 md:w-16 md:h-16 mx-auto bg-sky-50 rounded-xl sm:rounded-2xl text-primary-600 mb-2 sm:mb-4 flex items-center justify-center group-hover:-translate-y-2 transition-transform duration-300">
                    <svg class="w-5 h-5 sm:w-7 sm:h-7 md:w-8 md:h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                </div>
                <h3 class="text-2xl sm:text-3xl md:text-4xl font-black text-slate-800 mb-0.5 sm:mb-1">{{ number_format($totalTerbantu ?? 2665) }}<span class="text-primary-600">+</span></h3>
                <p class="text-[9px] sm:text-xs md:text-sm font-bold text-slate-400 uppercase tracking-wider">Penerima Manfaat</p>
            </div>

            <div class="w-px h-20 bg-slate-100 hidden lg:block"></div>

            <div class="text-center w-full group">
                <div class="w-11 h-11 sm:w-14 sm:h-14 md:w-16 md:h-16 mx-auto bg-sky-50 rounded-xl sm:rounded-2xl text-primary-600 mb-2 sm:mb-4 flex items-center justify-center group-hover:-translate-y-2 transition-transform duration-300">
                    <svg class="w-5 h-5 sm:w-7 sm:h-7 md:w-8 md:h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                </div>
                <h3 class="text-2xl sm:text-3xl md:text-4xl font-black text-slate-800 mb-0.5 sm:mb-1">{{ number_format($totalRelawan ?? 150) }}<span class="text-primary-600">+</span></h3>
                <p class="text-[9px] sm:text-xs md:text-sm font-bold text-slate-400 uppercase tracking-wider">Relawan Aktif</p>
            </div>

            <div class="w-px h-20 bg-slate-100 hidden lg:block"></div>

            <div class="text-center w-full group">
                <div class="w-11 h-11 sm:w-14 sm:h-14 md:w-16 md:h-16 mx-auto bg-sky-50 rounded-xl sm:rounded-2xl text-primary-600 mb-2 sm:mb-4 flex items-center justify-center group-hover:-translate-y-2 transition-transform duration-300">
                    <svg class="w-5 h-5 sm:w-7 sm:h-7 md:w-8 md:h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path></svg>
                </div>
                <h3 class="text-2xl sm:text-3xl md:text-4xl font-black text-slate-800 mb-0.5 sm:mb-1">{{ number_format($totalRumahSakit ?? 4) }}<span class="text-primary-600"></span></h3>
                <p class="text-[9px] sm:text-xs md:text-sm font-bold text-slate-400 uppercase tracking-wider">Mitra Faskes</p>
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
                
                <h2 class="text-xl sm:text-2xl md:text-4xl font-black text-slate-900 mb-3 sm:mb-6 leading-tight">
                    Platform Terpadu Tanggap Darurat & Evakuasi Medis Bebas Biaya
                </h2>
                
                <p class="text-slate-600 mb-5 sm:mb-8 leading-relaxed text-xs sm:text-base lg:text-lg font-medium">
                    {{ $tentang ?? 'Ambulans Siaga adalah platform tanggap darurat terpadu 24 jam yang menghubungkan armada ambulans lintas-mitra untuk melayani evakuasi medis, rujukan, dan gawat darurat secara cepat dan transparan.' }}
                </p>
                
                <!-- Desktop View: 2-Column Grid (Hidden on Mobile) -->
                <div class="hidden sm:grid sm:grid-cols-2 gap-4 mb-10">
                    <div class="flex items-center gap-3 bg-slate-50 px-4 py-3 rounded-2xl border border-slate-100 shadow-xs">
                        <div class="w-7 h-7 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center flex-shrink-0">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                        </div>
                        <p class="text-slate-800 font-bold text-sm">Pelayanan Cepat Tanggap</p>
                    </div>
                    <div class="flex items-center gap-3 bg-slate-50 px-4 py-3 rounded-2xl border border-slate-100 shadow-xs">
                        <div class="w-7 h-7 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center flex-shrink-0">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                        </div>
                        <p class="text-slate-800 font-bold text-sm">Terpercaya & Transparan</p>
                    </div>
                    <div class="flex items-center gap-3 bg-slate-50 px-4 py-3 rounded-2xl border border-slate-100 shadow-xs">
                        <div class="w-7 h-7 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center flex-shrink-0">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                        </div>
                        <p class="text-slate-800 font-bold text-sm">Jaringan Lintas Mitra</p>
                    </div>
                    <div class="flex items-center gap-3 bg-slate-50 px-4 py-3 rounded-2xl border border-slate-100 shadow-xs">
                        <div class="w-7 h-7 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center flex-shrink-0">
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
                                <div class="w-6 h-6 rounded-lg bg-emerald-50 text-emerald-600 flex items-center justify-center flex-shrink-0">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                                </div>
                                <span class="text-slate-800 font-bold text-xs whitespace-nowrap">Pelayanan Cepat Tanggap</span>
                            </div>
                            <div class="flex items-center gap-2.5 bg-slate-50 px-3.5 py-2.5 rounded-xl border border-slate-100 shadow-xs">
                                <div class="w-6 h-6 rounded-lg bg-emerald-50 text-emerald-600 flex items-center justify-center flex-shrink-0">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                                </div>
                                <span class="text-slate-800 font-bold text-xs whitespace-nowrap">Terpercaya & Transparan</span>
                            </div>
                            <div class="flex items-center gap-2.5 bg-slate-50 px-3.5 py-2.5 rounded-xl border border-slate-100 shadow-xs">
                                <div class="w-6 h-6 rounded-lg bg-emerald-50 text-emerald-600 flex items-center justify-center flex-shrink-0">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                                </div>
                                <span class="text-slate-800 font-bold text-xs whitespace-nowrap">Jaringan Lintas Mitra</span>
                            </div>
                            <div class="flex items-center gap-2.5 bg-slate-50 px-3.5 py-2.5 rounded-xl border border-slate-100 shadow-xs">
                                <div class="w-6 h-6 rounded-lg bg-emerald-50 text-emerald-600 flex items-center justify-center flex-shrink-0">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                                </div>
                                <span class="text-slate-800 font-bold text-xs whitespace-nowrap">Layanan Bebas Biaya</span>
                            </div>
                        </div>

                        <!-- Set 2 (Duplicate for Infinite Loop) -->
                        <div class="animate-marquee-infinite flex gap-2.5 flex-shrink-0 pr-2.5" aria-hidden="true">
                            <div class="flex items-center gap-2.5 bg-slate-50 px-3.5 py-2.5 rounded-xl border border-slate-100 shadow-xs">
                                <div class="w-6 h-6 rounded-lg bg-emerald-50 text-emerald-600 flex items-center justify-center flex-shrink-0">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                                </div>
                                <span class="text-slate-800 font-bold text-xs whitespace-nowrap">Pelayanan Cepat Tanggap</span>
                            </div>
                            <div class="flex items-center gap-2.5 bg-slate-50 px-3.5 py-2.5 rounded-xl border border-slate-100 shadow-xs">
                                <div class="w-6 h-6 rounded-lg bg-emerald-50 text-emerald-600 flex items-center justify-center flex-shrink-0">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                                </div>
                                <span class="text-slate-800 font-bold text-xs whitespace-nowrap">Terpercaya & Transparan</span>
                            </div>
                            <div class="flex items-center gap-2.5 bg-slate-50 px-3.5 py-2.5 rounded-xl border border-slate-100 shadow-xs">
                                <div class="w-6 h-6 rounded-lg bg-emerald-50 text-emerald-600 flex items-center justify-center flex-shrink-0">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                                </div>
                                <span class="text-slate-800 font-bold text-xs whitespace-nowrap">Jaringan Lintas Mitra</span>
                            </div>
                            <div class="flex items-center gap-2.5 bg-slate-50 px-3.5 py-2.5 rounded-xl border border-slate-100 shadow-xs">
                                <div class="w-6 h-6 rounded-lg bg-emerald-50 text-emerald-600 flex items-center justify-center flex-shrink-0">
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
                    <a href="{{ route('masyarakat.info') }}" class="inline-flex items-center justify-center px-8 py-4 text-base font-bold rounded-xl text-white bg-primary-600 hover:bg-primary-700 transition-colors shadow-lg hover:shadow-xl">
                        Kenali Lebih Jauh
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Services / Programs (Program Kami - Pudar / Slate-50) -->
    <section id="layanan" class="py-14 sm:py-20 lg:py-24 px-5 sm:px-6 lg:px-12 bg-slate-50 relative overflow-hidden border-t border-slate-100">
        <!-- Decorative Animated Assets -->
        <div class="absolute top-20 right-10 opacity-40 animate-[spin_12s_linear_infinite] pointer-events-none z-0">
            <svg class="w-32 h-32 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
        </div>
        <div class="absolute bottom-40 left-8 opacity-40 animate-bounce pointer-events-none z-0" style="animation-duration: 4s;">
            <svg class="w-24 h-24 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
        </div>
        <div class="absolute top-1/3 left-1/2 -translate-x-1/2 w-8 h-8 bg-yellow-400 rounded-full opacity-80 animate-ping pointer-events-none z-0" style="animation-duration: 3s;"></div>
        
        <!-- Subtle Grid Pattern -->
        <div class="absolute inset-0 opacity-[0.03] pointer-events-none z-0" style="background-image: radial-gradient(currentColor 2px, transparent 2px); background-size: 30px 30px;"></div>

        <div class="max-w-7xl mx-auto flex flex-col lg:flex-row gap-10 lg:gap-16 relative z-10">
            <!-- Left Header -->
            <div class="lg:w-1/3 text-left">
                <div class="text-center lg:text-left mb-3 sm:mb-5">
                    <span class="inline-block bg-white text-primary-600 border border-primary-100 shadow-sm font-black tracking-widest text-[10px] sm:text-xs px-4 py-1.5 sm:px-5 sm:py-2 rounded-full uppercase">
                        Program Kami
                    </span>
                </div>
                <h2 class="text-xl sm:text-2xl md:text-[2.5rem] font-black text-slate-900 mb-3 sm:mb-6 leading-tight text-left">Wujudkan Kebaikan dalam Berbagai Layanan</h2>
                <p class="text-slate-500 mb-5 sm:mb-8 leading-relaxed font-medium text-xs sm:text-base lg:text-lg text-left">
                    Ambulans Siaga fokus mengintegrasikan layanan kemanusiaan tanggap darurat yang berdampak langsung bagi masyarakat, mulai dari evakuasi gawat darurat hingga koordinasi rujukan medis.
                </p>
                <!-- Desktop Button (Hidden on Mobile) -->
                <div class="hidden lg:flex justify-start">
                    <a href="#" class="inline-flex items-center gap-2 sm:gap-3 bg-primary-600 text-white px-6 sm:px-8 py-2.5 sm:py-4 rounded-full font-bold hover:bg-[#007f87] transition shadow-lg hover:shadow-xl text-xs sm:text-base">
                        Lihat Semua Program
                        <svg class="w-3.5 h-3.5 sm:w-5 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
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
        <!-- Decorative Floating Elements -->
        <div class="absolute top-1/4 right-20 w-48 h-48 border-8 border-primary-300/80 rounded-full animate-[spin_10s_linear_infinite] pointer-events-none z-0" style="border-top-color: transparent;"></div>
        <div class="absolute bottom-20 left-20 w-32 h-32 border-[6px] border-emerald-300/80 rounded-lg animate-[spin_15s_linear_infinite] transform rotate-45 pointer-events-none z-0"></div>
        <div class="absolute top-1/2 left-10 w-8 h-8 bg-primary-500 rounded-full animate-bounce opacity-80 pointer-events-none z-0" style="animation-duration: 2.5s;"></div>
        <div class="absolute bottom-1/3 right-10 w-10 h-10 bg-yellow-400 rounded-full animate-pulse opacity-70 pointer-events-none z-0" style="animation-duration: 2s;"></div>

        <!-- Decorative bg -->
        <div class="absolute top-0 left-1/2 -translate-x-1/2 w-[800px] h-[400px] bg-primary-600/5 rounded-full blur-3xl z-0 pointer-events-none"></div>
        
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

            <!-- Desktop View: 4 Columns Grid (Hidden on Mobile) -->
            <div class="hidden lg:grid lg:grid-cols-4 gap-12 lg:gap-8 relative">
                <!-- Connecting Line for LG screens -->
                <div class="hidden lg:block absolute top-12 left-[12%] right-[12%] h-1 bg-slate-100 rounded-full z-0">
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
                    <p class="text-sm text-slate-500 leading-relaxed font-medium px-2">Tim relawan kami tiba di lokasi untuk melakukan evakuasi medis darurat tanpa dipungut biaya apapun.</p>
                </div>
            </div>

            <!-- Mobile View: Gojek-Style Step Slider (lg:hidden) -->
            <div class="lg:hidden w-full relative px-1 sm:px-2"
                 x-data="{
                     current: 0,
                     total: 4,
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
                            <span class="text-[10px] font-black text-primary-600 uppercase tracking-widest mb-1">Langkah 1 dari 4</span>
                            <h3 class="text-lg sm:text-xl font-black text-slate-800 mb-2">Pesan Darurat</h3>
                            <p class="text-xs sm:text-sm text-slate-500 leading-relaxed font-medium">Buka website, isi titik lokasi dan informasi ringkas pasien, lalu tekan tombol minta bantuan darurat.</p>
                        </div>

                        <!-- Step 2 Slide -->
                        <div class="w-full flex-shrink-0 flex flex-col items-center text-center p-6 sm:p-8">
                            <div class="w-16 h-16 sm:w-20 sm:h-20 rounded-full bg-slate-50 border-4 sm:border-[5px] border-white shadow-xl flex items-center justify-center relative mb-4">
                                <span class="absolute -top-1 -right-1 w-5 h-5 sm:w-6 sm:h-6 rounded-full bg-yellow-400 text-slate-900 font-black flex items-center justify-center text-[10px] sm:text-xs shadow-sm ring-2 ring-white z-20">2</span>
                                <svg class="w-7 h-7 sm:w-8 sm:h-8 text-primary-600 relative z-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
                            </div>
                            <span class="text-[10px] font-black text-primary-600 uppercase tracking-widest mb-1">Langkah 2 dari 4</span>
                            <h3 class="text-lg sm:text-xl font-black text-slate-800 mb-2">Verifikasi Cepat</h3>
                            <p class="text-xs sm:text-sm text-slate-500 leading-relaxed font-medium">Pusat panggilan (Operator) akan segera merespon dan memverifikasi pesanan masuk Anda.</p>
                        </div>

                        <!-- Step 3 Slide -->
                        <div class="w-full flex-shrink-0 flex flex-col items-center text-center p-6 sm:p-8">
                            <div class="w-16 h-16 sm:w-20 sm:h-20 rounded-full bg-slate-50 border-4 sm:border-[5px] border-white shadow-xl flex items-center justify-center relative mb-4">
                                <span class="absolute -top-1 -right-1 w-5 h-5 sm:w-6 sm:h-6 rounded-full bg-yellow-400 text-slate-900 font-black flex items-center justify-center text-[10px] sm:text-xs shadow-sm ring-2 ring-white z-20">3</span>
                                <svg class="w-7 h-7 sm:w-8 sm:h-8 text-primary-600 relative z-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"></path></svg>
                            </div>
                            <span class="text-[10px] font-black text-primary-600 uppercase tracking-widest mb-1">Langkah 3 dari 4</span>
                            <h3 class="text-lg sm:text-xl font-black text-slate-800 mb-2">Armada Meluncur</h3>
                            <p class="text-xs sm:text-sm text-slate-500 leading-relaxed font-medium">Ambulans terdekat akan ditugaskan. Anda dapat melacak posisi ambulans secara <i>real-time</i> dari HP.</p>
                        </div>

                        <!-- Step 4 Slide -->
                        <div class="w-full flex-shrink-0 flex flex-col items-center text-center p-6 sm:p-8">
                            <div class="w-16 h-16 sm:w-20 sm:h-20 rounded-full bg-slate-50 border-4 sm:border-[5px] border-white shadow-xl flex items-center justify-center relative mb-4">
                                <span class="absolute -top-1 -right-1 w-5 h-5 sm:w-6 sm:h-6 rounded-full bg-yellow-400 text-slate-900 font-black flex items-center justify-center text-[10px] sm:text-xs shadow-sm ring-2 ring-white z-20">4</span>
                                <svg class="w-7 h-7 sm:w-8 sm:h-8 text-primary-600 relative z-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                            </div>
                            <span class="text-[10px] font-black text-primary-600 uppercase tracking-widest mb-1">Langkah 4 dari 4</span>
                            <h3 class="text-lg sm:text-xl font-black text-slate-800 mb-2">Pertolongan Tiba</h3>
                            <p class="text-xs sm:text-sm text-slate-500 leading-relaxed font-medium">Tim relawan kami tiba di lokasi untuk melakukan evakuasi medis darurat tanpa dipungut biaya apapun.</p>
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
            
            <div class="mt-8 sm:mt-16 lg:mt-20 text-center">
                <a href="{{ route('masyarakat.order.create') }}" class="inline-flex items-center gap-2 sm:gap-3 bg-primary-600 text-white px-6 sm:px-10 py-3 sm:py-5 rounded-full font-black text-xs sm:text-base lg:text-lg hover:bg-primary-700 hover:shadow-[0_10px_40px_rgba(0,156,166,0.4)] transition-all hover:-translate-y-1 group">
                    Coba Pesan Ambulans Sekarang
                    <svg class="w-4 h-4 sm:w-6 sm:h-6 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
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
                         this.timer = setInterval(() => { this.next(); }, 4000);
                     },
                     stopAuto() {
                         if (this.timer) clearInterval(this.timer);
                     },
                     init() {
                         this.startAuto();
                     }
                 }"
                 @touchstart="handleTouchStart($event)"
                 @touchend="handleTouchEnd($event)">
                
                <!-- Soft Halo -->
                <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-56 h-56 md:w-[380px] md:h-[380px] bg-sky-300/30 rounded-full blur-[60px] animate-pulse pointer-events-none z-0"></div>
                
                <!-- Slides Container -->
                <template x-for="(slide, i) in slides" :key="i">
                    <div class="absolute w-[260px] sm:w-[320px] md:w-[440px] aspect-[4/3] rounded-2xl md:rounded-3xl overflow-hidden transition-all duration-500 ease-out cursor-pointer shadow-xl md:shadow-2xl border-4 border-white origin-center"
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

                <!-- Floating Navigation Arrow Buttons (Prev / Next) -->
                <button @click="prev(); startAuto()" type="button" aria-label="Foto Sebelumnya"
                        class="absolute left-1 sm:left-4 md:left-8 top-1/2 -translate-y-1/2 w-9 h-9 sm:w-10 sm:h-10 rounded-full bg-white text-slate-700 shadow-xl border border-slate-100 flex items-center justify-center hover:bg-slate-50 active:scale-95 transition-all z-40 hover:scale-105">
                    <svg class="w-4 h-4 sm:w-5 sm:h-5 text-slate-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/></svg>
                </button>
                <button @click="next(); startAuto()" type="button" aria-label="Foto Berikutnya"
                        class="absolute right-1 sm:right-4 md:right-8 top-1/2 -translate-y-1/2 w-9 h-9 sm:w-10 sm:h-10 rounded-full bg-white text-slate-700 shadow-xl border border-slate-100 flex items-center justify-center hover:bg-slate-50 active:scale-95 transition-all z-40 hover:scale-105">
                    <svg class="w-4 h-4 sm:w-5 sm:h-5 text-slate-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
                </button>
                
                <!-- Carousel Dots Indicator -->
                <div class="absolute -bottom-8 left-0 right-0 flex justify-center gap-2 z-40">
                    <template x-for="(slide, i) in slides" :key="'dot-'+i">
                        <button @click="active = i; startAuto()" 
                                class="h-2 rounded-full transition-all duration-300"
                                :class="active === i ? 'bg-primary-600 w-6' : 'bg-primary-200 w-2 hover:bg-primary-400'"></button>
                    </template>
                </div>
            </div>

            <!-- Desktop View: 3 Steps Visual Grid (Hidden on Mobile) -->
            <div class="hidden md:grid md:grid-cols-3 gap-5 md:gap-6 w-full max-w-4xl mx-auto relative mb-14 mt-6">
                <!-- Connecting Line (Desktop) -->
                <div class="hidden md:block absolute top-9 sm:top-10 left-[18%] right-[18%] h-[2px] bg-slate-200 z-0"></div>

                <!-- Step 1 -->
                <div class="relative z-10 flex flex-col items-center text-center bg-white p-6 sm:p-7 rounded-2xl md:rounded-3xl border border-slate-100 shadow-sm hover:shadow-xl transition-all duration-300 hover:-translate-y-1 group">
                    <div class="w-12 h-12 sm:w-14 sm:h-14 rounded-full bg-sky-50 text-primary-600 flex items-center justify-center font-black text-lg sm:text-xl mb-4 ring-4 ring-slate-50 group-hover:bg-primary-600 group-hover:text-white transition-colors duration-300">
                        1
                    </div>
                    <h3 class="font-bold text-slate-800 text-base sm:text-lg mb-2">DAFTAR</h3>
                    <p class="text-xs sm:text-sm text-slate-500 leading-relaxed font-medium">Lengkapi data pendaftaran Anda secara detail melalui formulir pendaftaran.</p>
                </div>

                <!-- Step 2 -->
                <div class="relative z-10 flex flex-col items-center text-center bg-white p-6 sm:p-7 rounded-2xl md:rounded-3xl border border-slate-100 shadow-sm hover:shadow-xl transition-all duration-300 hover:-translate-y-1 group">
                    <div class="w-12 h-12 sm:w-14 sm:h-14 rounded-full bg-amber-50 text-amber-600 flex items-center justify-center font-black text-lg sm:text-xl mb-4 ring-4 ring-slate-50 group-hover:bg-amber-500 group-hover:text-white transition-colors duration-300">
                        2
                    </div>
                    <h3 class="font-bold text-slate-800 text-base sm:text-lg mb-2">VERIFIKASI</h3>
                    <p class="text-xs sm:text-sm text-slate-500 leading-relaxed font-medium">Tim kami akan melakukan pengecekan dan validasi atas data yang dikirim.</p>
                </div>

                <!-- Step 3 -->
                <div class="relative z-10 flex flex-col items-center text-center bg-white p-6 sm:p-7 rounded-2xl md:rounded-3xl border border-slate-100 shadow-sm hover:shadow-xl transition-all duration-300 hover:-translate-y-1 group">
                    <div class="w-12 h-12 sm:w-14 sm:h-14 rounded-full bg-emerald-50 text-emerald-600 flex items-center justify-center font-black text-lg sm:text-xl mb-4 ring-4 ring-slate-50 group-hover:bg-emerald-500 group-hover:text-white transition-colors duration-300">
                        3
                    </div>
                    <h3 class="font-bold text-slate-800 text-base sm:text-lg mb-2">SIAP BERGABUNG</h3>
                    <p class="text-xs sm:text-sm text-slate-500 leading-relaxed font-medium">Selamat! Anda resmi menjadi bagian dari jaringan relawan Ambulans Siaga.</p>
                </div>
            </div>

            <!-- Mobile View: Gojek-Style Step Slider (md:hidden) -->
            <div class="md:hidden w-full relative mb-10 mt-4 px-1 sm:px-2"
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
                
                <div class="relative overflow-hidden rounded-2xl shadow-lg bg-white border border-slate-100">
                    <div class="flex transition-transform duration-500 ease-out"
                         :style="'transform: translateX(-' + (current * 100) + '%)'">
                        
                        <!-- Step 1 -->
                        <div class="w-full flex-shrink-0 flex flex-col items-center text-center p-6">
                            <div class="w-14 h-14 rounded-full bg-sky-50 text-primary-600 flex items-center justify-center font-black text-xl mb-3 ring-4 ring-slate-50">
                                1
                            </div>
                            <span class="text-[10px] font-black text-primary-600 uppercase tracking-widest mb-1">Tahap 1 dari 3</span>
                            <h3 class="font-bold text-slate-800 text-base sm:text-lg mb-1.5">DAFTAR</h3>
                            <p class="text-xs sm:text-sm text-slate-500 leading-relaxed font-medium">Lengkapi data pendaftaran Anda secara detail melalui formulir pendaftaran.</p>
                        </div>

                        <!-- Step 2 -->
                        <div class="w-full flex-shrink-0 flex flex-col items-center text-center p-6">
                            <div class="w-14 h-14 rounded-full bg-amber-50 text-amber-600 flex items-center justify-center font-black text-xl mb-3 ring-4 ring-slate-50">
                                2
                            </div>
                            <span class="text-[10px] font-black text-amber-600 uppercase tracking-widest mb-1">Tahap 2 dari 3</span>
                            <h3 class="font-bold text-slate-800 text-base sm:text-lg mb-1.5">VERIFIKASI</h3>
                            <p class="text-xs sm:text-sm text-slate-500 leading-relaxed font-medium">Tim kami akan melakukan pengecekan dan validasi atas data yang dikirim.</p>
                        </div>

                        <!-- Step 3 -->
                        <div class="w-full flex-shrink-0 flex flex-col items-center text-center p-6">
                            <div class="w-14 h-14 rounded-full bg-emerald-50 text-emerald-600 flex items-center justify-center font-black text-xl mb-3 ring-4 ring-slate-50">
                                3
                            </div>
                            <span class="text-[10px] font-black text-emerald-600 uppercase tracking-widest mb-1">Tahap 3 dari 3</span>
                            <h3 class="font-bold text-slate-800 text-base sm:text-lg mb-1.5">SIAP BERGABUNG</h3>
                            <p class="text-xs sm:text-sm text-slate-500 leading-relaxed font-medium">Selamat! Anda resmi menjadi bagian dari jaringan relawan Ambulans Siaga.</p>
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

            <!-- CTA Button -->
            <a href="{{ route('register.supir') }}" class="group relative inline-flex items-center justify-center gap-2 sm:gap-3 bg-primary-600 text-white px-6 sm:px-9 py-3 sm:py-4 rounded-full font-extrabold text-xs sm:text-base md:text-lg hover:bg-primary-700 transition-all duration-300 shadow-[0_8px_25px_rgba(0,156,166,0.3)] hover:-translate-y-0.5 hover:shadow-[0_12px_30px_rgba(0,156,166,0.4)]">
                Daftar sebagai Pengemudi Ambulans
                <svg class="w-4 h-4 sm:w-5 sm:h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                </svg>
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
                <h2 class="text-xl sm:text-2xl md:text-3xl font-black text-slate-900 mb-2 sm:mb-4 text-left lg:text-center">Mitra Fasilitas Kesehatan</h2>
                <p class="text-slate-500 font-medium text-xs sm:text-base text-left lg:text-center">Jaringan Rumah Sakit rujukan darurat 24 Jam yang terhubung dalam ekosistem Ambulans Siaga.</p>
            </div>

            <!-- Desktop View: Grid (Hidden on Mobile) -->
            <div class="hidden md:grid md:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($rumahSakits as $rs)
                    <div class="bg-slate-50 hover:bg-white p-6 rounded-2xl border border-slate-100 shadow-sm hover:shadow-lg transition-all group flex flex-col h-full">
                        <div class="flex items-center justify-between mb-4">
                            <span class="inline-flex items-center px-2 py-1 rounded bg-sky-50 text-[10px] font-black text-sky-600 tracking-wider">
                                IGD 24 JAM
                            </span>
                        </div>
                        <h3 class="font-bold text-slate-800 text-lg mb-2">{{ $rs->nama }}</h3>
                        <p class="text-sm text-slate-500 leading-relaxed mb-4 flex-1">{{ $rs->alamat }}</p>
                        <div class="pt-4 border-t border-slate-100 flex items-center justify-between">
                            <span class="text-xs font-bold text-slate-400">{{ $rs->telepon }}</span>
                            <a href="https://www.google.com/maps?q={{ $rs->lat }},{{ $rs->lng }}" target="_blank" class="w-8 h-8 rounded-full bg-white flex items-center justify-center text-sky-600 group-hover:bg-sky-600 group-hover:text-white shadow-xs transition">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"></path></svg>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Mobile View: Gojek-Style Hospital Slider (md:hidden) -->
            @if($rumahSakits->count() > 0)
            <div class="md:hidden w-full relative px-1 sm:px-2"
                 x-data="{
                     current: 0,
                     total: {{ $rumahSakits->count() }},
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
                
                <!-- Hospital Card Container with clean rounded-2xl radius & proper clipping -->
                <div class="relative overflow-hidden rounded-2xl shadow-lg bg-white border border-slate-100">
                    <div class="flex transition-transform duration-500 ease-out"
                         :style="'transform: translateX(-' + (current * 100) + '%)'">
                        @foreach($rumahSakits as $index => $rs)
                            <div class="w-full flex-shrink-0 flex flex-col p-5 sm:p-6">
                                <div class="flex items-center justify-between mb-3">
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-lg bg-sky-50 text-[10px] font-black text-sky-600 tracking-wider">
                                        IGD 24 JAM
                                    </span>
                                    <span class="text-[11px] font-bold text-slate-400">
                                        {{ $index + 1 }} / {{ $rumahSakits->count() }}
                                    </span>
                                </div>
                                <h3 class="font-bold text-slate-800 text-base sm:text-lg mb-1.5 leading-snug">{{ $rs->nama }}</h3>
                                <p class="text-xs sm:text-sm text-slate-500 leading-relaxed mb-4 min-h-[40px] font-medium">{{ $rs->alamat }}</p>
                                <div class="pt-3 border-t border-slate-100 flex items-center justify-between">
                                    <span class="text-xs font-bold text-slate-600">{{ $rs->telepon }}</span>
                                    <a href="https://www.google.com/maps?q={{ $rs->lat }},{{ $rs->lng }}" target="_blank" class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-xl bg-sky-50 text-sky-600 text-xs font-bold hover:bg-sky-600 hover:text-white transition-colors shadow-2xs">
                                        <span>Lihat Peta</span>
                                        <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"></path></svg>
                                    </a>
                                </div>
                            </div>
                        @endforeach
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
