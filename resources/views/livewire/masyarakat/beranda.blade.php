<div>


    <!-- Hero Section -->
    <section class="relative pt-36 sm:pt-40 pb-36 sm:pb-44 px-6 lg:px-12 overflow-hidden bg-primary-600" style="background-image: url('{{ asset('images/beranda_utama_bg.jpg') }}'); background-size: cover; background-position: center; background-repeat: no-repeat;">
        <!-- Gradient Overlay: Mix of Cyan and White -->
        <div class="absolute inset-0 bg-gradient-to-r from-primary-600 via-[#009CA6]/80 to-white/60 mix-blend-multiply"></div>
        <div class="absolute inset-0 bg-gradient-to-r from-primary-600 via-[#009CA6]/80 to-white/60"></div>
        
        <!-- Gradasi Halus & Samar-samar dari Cyan ke Putih -->
        <div class="absolute inset-x-0 bottom-0 h-44 sm:h-64 bg-gradient-to-t from-white via-white/60 via-white/15 to-transparent pointer-events-none z-10"></div>

        <div class="max-w-7xl mx-auto flex flex-col lg:flex-row items-center gap-12 relative z-10">
            <!-- Left Text -->
            <div class="lg:w-[55%] text-white z-10 text-center lg:text-left">
                <div class="inline-flex items-center gap-2 mb-6 bg-white/10 backdrop-blur px-4 py-2 rounded-full border border-white/20 shadow-xl">
                    <svg class="w-5 h-5 text-yellow-300" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                    <span class="font-bold tracking-wider text-xs uppercase">JARINGAN AMBULANS TANGGAP DARURAT</span>
                </div>
                <h1 class="text-3xl sm:text-5xl lg:text-[3.5rem] font-black leading-[1.15] mb-6 drop-shadow-lg">
                    Kecepatan & Kepedulian dalam Menyelamatkan Nyawa
                </h1>
                <p class="text-lg sm:text-xl text-sky-100 mb-10 max-w-2xl mx-auto lg:mx-0 leading-relaxed font-medium">
                    Ambulans Siaga adalah platform tanggap darurat terpadu 24 jam yang menghubungkan armada ambulans lintas-mitra untuk melayani evakuasi medis, rujukan, dan gawat darurat secara cepat dan transparan.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start">
                    <a href="{{ route('masyarakat.order.create') }}" class="group relative inline-flex justify-center items-center gap-2 bg-white text-primary-600 px-8 py-4 rounded-full font-bold text-lg hover:bg-slate-50 transition-all shadow-[0_8px_30px_rgb(0,0,0,0.2)] hover:scale-105">
                        <span class="absolute -top-1 -right-1 flex h-4 w-4">
                          <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-400 opacity-75"></span>
                          <span class="relative inline-flex rounded-full h-4 w-4 bg-red-500"></span>
                        </span>
                        <svg class="w-6 h-6 text-red-500 group-hover:animate-bounce" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                        Pesan Darurat Sekarang
                    </a>
                    <a href="tel:{{ str_replace('-', '', $telepon ?? '081234567890') }}" class="inline-flex justify-center items-center gap-2 bg-transparent border-2 border-white/50 text-white px-8 py-4 rounded-full font-bold text-lg hover:bg-white/10 hover:border-white transition-all">
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
        <div class="bg-white rounded-[2.5rem] shadow-[0_20px_50px_rgba(15,23,42,0.12)] border border-slate-100 p-6 sm:p-8 md:p-10 grid grid-cols-2 lg:flex lg:flex-nowrap justify-between items-center gap-6 sm:gap-8">
            <div class="text-center w-full group">
                <div class="w-14 h-14 md:w-16 md:h-16 mx-auto bg-sky-50 rounded-2xl text-primary-600 mb-4 flex items-center justify-center group-hover:-translate-y-2 transition-transform duration-300">
                    <svg class="w-7 h-7 md:w-8 md:h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                </div>
                <h3 class="text-3xl md:text-4xl font-black text-slate-800 mb-1">{{ number_format($totalAmbulans ?? 8) }}</h3>
                <p class="text-[10px] md:text-sm font-bold text-slate-400 uppercase tracking-wider">Armada Siaga</p>
            </div>
            
            <div class="w-px h-20 bg-slate-100 hidden lg:block"></div>

            <div class="text-center w-full group">
                <div class="w-14 h-14 md:w-16 md:h-16 mx-auto bg-sky-50 rounded-2xl text-primary-600 mb-4 flex items-center justify-center group-hover:-translate-y-2 transition-transform duration-300">
                    <svg class="w-7 h-7 md:w-8 md:h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                </div>
                <h3 class="text-3xl md:text-4xl font-black text-slate-800 mb-1">{{ number_format($totalTerbantu ?? 2665) }}<span class="text-primary-600">+</span></h3>
                <p class="text-[10px] md:text-sm font-bold text-slate-400 uppercase tracking-wider">Penerima Manfaat</p>
            </div>

            <div class="w-px h-20 bg-slate-100 hidden lg:block"></div>

            <div class="text-center w-full group">
                <div class="w-14 h-14 md:w-16 md:h-16 mx-auto bg-sky-50 rounded-2xl text-primary-600 mb-4 flex items-center justify-center group-hover:-translate-y-2 transition-transform duration-300">
                    <svg class="w-7 h-7 md:w-8 md:h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                </div>
                <h3 class="text-3xl md:text-4xl font-black text-slate-800 mb-1">{{ number_format($totalRelawan ?? 150) }}<span class="text-primary-600">+</span></h3>
                <p class="text-[10px] md:text-sm font-bold text-slate-400 uppercase tracking-wider">Relawan Aktif</p>
            </div>

            <div class="w-px h-20 bg-slate-100 hidden lg:block"></div>

            <div class="text-center w-full group">
                <div class="w-14 h-14 md:w-16 md:h-16 mx-auto bg-sky-50 rounded-2xl text-primary-600 mb-4 flex items-center justify-center group-hover:-translate-y-2 transition-transform duration-300">
                    <svg class="w-7 h-7 md:w-8 md:h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path></svg>
                </div>
                <h3 class="text-3xl md:text-4xl font-black text-slate-800 mb-1">{{ number_format($totalRumahSakit ?? 4) }}<span class="text-primary-600"></span></h3>
                <p class="text-[10px] md:text-sm font-bold text-slate-400 uppercase tracking-wider">Mitra Faskes</p>
            </div>
        </div>
    </section>

    <!-- About Section (Tentang Ambulans Siaga - Putih / White) -->
    <section id="tentang" class="bg-white relative overflow-hidden pt-12 pb-24 px-6 lg:px-12">
        <div class="max-w-7xl mx-auto flex flex-col lg:flex-row items-center gap-16 relative z-10">
            <!-- Image Side -->
            <div class="w-full lg:w-1/2">
                <div class="relative">
                    <img src="{{ asset('images/dokumgsc (6).JPG') }}" alt="Pusat Operasional & Armada Ambulans Siaga" class="w-full h-[400px] md:h-[500px] object-cover rounded-3xl shadow-lg border border-slate-100">
                    
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
                <div class="mb-3">
                    <span class="text-primary-600 font-black tracking-wider text-sm uppercase">Tentang Ambulans Siaga</span>
                </div>
                
                <h2 class="text-3xl md:text-4xl font-black text-slate-900 mb-6 leading-tight">
                    Platform Terpadu Tanggap Darurat & Evakuasi Medis Bebas Biaya
                </h2>
                
                <p class="text-slate-600 mb-8 leading-relaxed text-lg font-medium">
                    {{ $tentang ?? 'Ambulans Siaga adalah platform tanggap darurat terpadu 24 jam yang menghubungkan armada ambulans lintas-mitra untuk melayani evakuasi medis, rujukan, dan gawat darurat secara cepat dan transparan.' }}
                </p>
                
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-10">
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
                
                <div>
                    <a href="{{ route('masyarakat.info') }}" class="inline-flex items-center justify-center px-8 py-4 text-base font-bold rounded-xl text-white bg-primary-600 hover:bg-primary-700 transition-colors shadow-lg hover:shadow-xl">
                        Kenali Lebih Jauh
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Services / Programs (Program Kami - Pudar / Slate-50) -->
    <section id="layanan" class="py-24 px-6 lg:px-12 bg-slate-50 relative overflow-hidden border-t border-slate-100">
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

        <div class="max-w-7xl mx-auto flex flex-col lg:flex-row gap-16 relative z-10">
            <!-- Left Header -->
            <div class="lg:w-1/3">
                <span class="text-primary-600 font-black tracking-widest text-sm mb-3 block uppercase">Program Kami</span>
                <h2 class="text-3xl md:text-[2.5rem] font-black text-slate-900 mb-6 leading-tight">Wujudkan Kebaikan dalam Berbagai Layanan</h2>
                <p class="text-slate-500 mb-8 leading-relaxed font-medium text-lg">
                    Ambulans Siaga fokus mengintegrasikan layanan kemanusiaan tanggap darurat yang berdampak langsung bagi masyarakat, mulai dari evakuasi gawat darurat hingga koordinasi rujukan medis.
                </p>
                <a href="#" class="inline-flex items-center gap-3 bg-primary-600 text-white px-8 py-4 rounded-full font-bold hover:bg-[#007f87] transition shadow-lg hover:shadow-xl">
                    Lihat Semua Program
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                </a>
            </div>

            <!-- Right Cards -->
            <div class="lg:w-2/3 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Card 1 -->
                <div class="bg-white rounded-[2rem] overflow-hidden shadow-lg shadow-slate-200/50 hover:shadow-2xl hover:-translate-y-2 transition-all duration-300 group border border-slate-100 flex flex-col">
                    <div class="h-48 overflow-hidden relative">
                        <img src="{{ asset('images/dokumgsc (27).JPG') }}" alt="Ambulans Gawat Darurat" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
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
                        <img src="{{ asset('images/dokumgsc (3).JPG') }}" alt="Bantuan Tanggap Darurat" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
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
        </div>
    </section>

    <!-- How it Works / Alur Pemesanan (Alur Layanan - Putih / White) -->
    <section class="py-24 px-6 lg:px-12 bg-white relative overflow-hidden border-t border-slate-100">
        <!-- Decorative Floating Elements -->
        <div class="absolute top-1/4 right-20 w-48 h-48 border-8 border-primary-300/80 rounded-full animate-[spin_10s_linear_infinite] pointer-events-none z-0" style="border-top-color: transparent;"></div>
        <div class="absolute bottom-20 left-20 w-32 h-32 border-[6px] border-emerald-300/80 rounded-lg animate-[spin_15s_linear_infinite] transform rotate-45 pointer-events-none z-0"></div>
        <div class="absolute top-1/2 left-10 w-8 h-8 bg-primary-500 rounded-full animate-bounce opacity-80 pointer-events-none z-0" style="animation-duration: 2.5s;"></div>
        <div class="absolute bottom-1/3 right-10 w-10 h-10 bg-yellow-400 rounded-full animate-pulse opacity-70 pointer-events-none z-0" style="animation-duration: 2s;"></div>

        <!-- Decorative bg -->
        <div class="absolute top-0 left-1/2 -translate-x-1/2 w-[800px] h-[400px] bg-primary-600/5 rounded-full blur-3xl z-0 pointer-events-none"></div>
        
        <div class="max-w-7xl mx-auto relative z-10">
            <div class="text-center max-w-3xl mx-auto mb-16">
                <span class="text-primary-600 font-black tracking-widest text-sm mb-3 block uppercase">Alur Layanan</span>
                <h2 class="text-3xl md:text-[2.5rem] font-black text-slate-900 mb-6 leading-tight">Bagaimana Cara Mendapatkan Bantuan Ambulans?</h2>
                <p class="text-slate-500 font-medium text-lg leading-relaxed">
                    Kami merancang sistem yang cepat dan terintegrasi untuk memastikan setiap keadaan darurat mendapatkan respon penanganan medis dengan segera.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 lg:gap-8 relative">
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
            
            <div class="mt-20 text-center">
                <a href="{{ route('masyarakat.order.create') }}" class="inline-flex items-center gap-3 bg-primary-600 text-white px-10 py-5 rounded-full font-black text-lg hover:bg-primary-700 hover:shadow-[0_10px_40px_rgba(0,156,166,0.4)] transition-all hover:-translate-y-1 group">
                    Coba Pesan Ambulans Sekarang
                    <svg class="w-6 h-6 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                </a>
            </div>
        </div>
    </section>

    <!-- SECTION VIDEO TESTIMONI & ULASAN MASYARAKAT (Beranda) -->
    <section class="py-24 px-6 lg:px-12 bg-slate-900 text-white relative overflow-hidden">
        <!-- Glow accents -->
        <div class="absolute -top-24 -left-24 w-96 h-96 bg-primary-500/15 rounded-full blur-[100px] pointer-events-none"></div>
        <div class="absolute -bottom-24 -right-24 w-96 h-96 bg-sky-500/15 rounded-full blur-[100px] pointer-events-none"></div>

        <div class="max-w-7xl mx-auto relative z-10" x-data="{ currentVid: 1 }">
            <div class="text-center max-w-3xl mx-auto mb-14">
                <span class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-white/10 border border-white/20 text-yellow-300 text-xs font-bold uppercase tracking-wider mb-3">
                    <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20"><path d="M2 6a2 2 0 012-2h6a2 2 0 012 2v8a2 2 0 01-2 2H4a2 2 0 01-2-2V6zM14.553 7.106A1 1 0 0014 8v4a1 1 0 00.553.894l2 1A1 1 0 0018 13V7a1 1 0 00-1.447-.894l-2 1z"></path></svg>
                    Kisah Nyata Lapangan
                </span>
                <h2 class="text-3xl md:text-[2.5rem] font-black text-white mb-4 leading-tight">
                    Suara Hati & Bukti Pelayanan Ambulans Siaga
                </h2>
                <p class="text-slate-300 text-sm sm:text-base font-normal leading-relaxed">
                    Mendengar langsung kelegaan keluarga pasien dan masyarakat yang terbantu evakuasi medis darurat tanpa dipungut biaya sepeserpun.
                </p>
            </div>

            <!-- Video Player & Switcher -->
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-center mb-16">
                <div class="lg:col-span-8">
                    <div class="relative bg-slate-800/90 rounded-[2.5rem] p-3 sm:p-4 border border-white/15 shadow-2xl overflow-hidden">
                        <div class="relative aspect-video rounded-[2rem] overflow-hidden bg-black flex items-center justify-center">
                            <video x-show="currentVid === 1" controls class="w-full h-full object-contain" poster="{{ asset('images/dokumgsc (27).JPG') }}">
                                <source src="{{ asset('images/videogsc (1).mp4') }}" type="video/mp4">
                            </video>
                            <video x-show="currentVid === 2" controls class="w-full h-full object-contain" poster="{{ asset('images/dokumgsc (28).JPG') }}" x-cloak>
                                <source src="{{ asset('images/videogsc (2).mp4') }}" type="video/mp4">
                            </video>
                        </div>
                    </div>
                </div>

                <div class="lg:col-span-4 space-y-4">
                    <h3 class="text-base font-bold text-slate-200">Pilih Rekaman Testimoni:</h3>
                    
                    <div @click="currentVid = 1" class="cursor-pointer p-4 rounded-2xl transition-all duration-300 flex items-start gap-4 border" :class="currentVid === 1 ? 'bg-white/15 border-primary-400 shadow-lg ring-2 ring-primary-400/40' : 'bg-white/5 border-white/10 hover:bg-white/10'">
                        <div class="w-12 h-12 rounded-xl bg-primary-600/30 border border-primary-400/30 flex items-center justify-center shrink-0 mt-0.5 text-primary-300">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                        </div>
                        <div class="min-w-0">
                            <span class="inline-block px-2 py-0.5 rounded text-[10px] font-extrabold uppercase bg-yellow-400/20 text-yellow-300 mb-1">Dokumentasi 1</span>
                            <h4 class="font-bold text-white text-sm leading-snug">Evakuasi Medis Cepat & Sigap</h4>
                            <p class="text-xs text-slate-400 mt-1 line-clamp-2">Keluarga pasien menceritakan pertolongan ambulans yang tiba tepat waktu saat kondisi darurat.</p>
                        </div>
                    </div>

                    <div @click="currentVid = 2" class="cursor-pointer p-4 rounded-2xl transition-all duration-300 flex items-start gap-4 border" :class="currentVid === 2 ? 'bg-white/15 border-primary-400 shadow-lg ring-2 ring-primary-400/40' : 'bg-white/5 border-white/10 hover:bg-white/10'">
                        <div class="w-12 h-12 rounded-xl bg-sky-600/30 border border-sky-400/30 flex items-center justify-center shrink-0 mt-0.5 text-sky-300">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                        </div>
                        <div class="min-w-0">
                            <span class="inline-block px-2 py-0.5 rounded text-[10px] font-extrabold uppercase bg-sky-400/20 text-sky-300 mb-1">Dokumentasi 2</span>
                            <h4 class="font-bold text-white text-sm leading-snug">Pelayanan Ramah & Penuh Keikhlasan</h4>
                            <p class="text-xs text-slate-400 mt-1 line-clamp-2">Umpan balik warga atas keramahan paramedis dan supir ambulans selama perjalanan rujukan.</p>
                        </div>
                    </div>

                    <div class="pt-2">
                        <a href="{{ route('donasi') }}" class="w-full py-3.5 px-4 rounded-xl bg-primary-600 hover:bg-primary-500 text-white font-extrabold text-xs uppercase tracking-wider transition shadow-lg flex items-center justify-center gap-2 text-center">
                            Dukung Operasional Ambulans
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Real Patient Reviews (Dynamic Database) -->
            @if(isset($ratings) && count($ratings) > 0)
            <div class="pt-8 border-t border-white/10">
                <div class="text-center mb-8">
                    <h3 class="text-xl font-bold text-white">Ulasan Terbaru Dari Masyarakat & Keluarga Pasien</h3>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @foreach($ratings as $r)
                    <div class="bg-white/5 border border-white/10 rounded-2xl p-6 backdrop-blur-xs flex flex-col justify-between hover:bg-white/10 transition">
                        <div>
                            <div class="flex text-yellow-400 mb-3 items-center gap-1">
                                @for($i = 1; $i <= ($r->skor ?: 5); $i++)
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                @endfor
                            </div>
                            <p class="text-slate-300 text-xs sm:text-sm leading-relaxed mb-4 italic font-normal">"{!! e($r->ulasan) !!}"</p>
                        </div>
                        <div class="pt-3 border-t border-white/10">
                            <p class="font-bold text-white text-xs">{{ $r->nama_tampil }}</p>
                            <p class="text-[11px] text-primary-300">{{ $r->peran_tampil }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif
        </div>
    </section>

    <!-- Bergabung Bersama Kami Section (Pudar / Slate-50) -->
    <section class="py-24 px-6 lg:px-12 bg-slate-50 relative overflow-hidden border-t border-slate-100">
        <!-- Subtle Star of Life Watermark Background -->
        <div class="absolute top-[48%] left-1/2 -translate-x-1/2 -translate-y-1/2 w-[1400px] h-[1400px] pointer-events-none flex items-center justify-center z-0 opacity-40">
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
            <span class="inline-block bg-white text-primary-600 border border-primary-100 shadow-sm font-black tracking-widest text-xs px-5 py-2 rounded-full mb-6 uppercase relative z-30">
                Bergabung Bersama Kami
            </span>
            <h2 class="text-3xl md:text-[2.5rem] font-black text-slate-900 mb-14 leading-tight">
                Jadilah Bagian dari Ambulans Siaga
            </h2>

            <!-- Focal Point: 3D Coverflow Slider -->
            <div class="relative w-full max-w-4xl mx-auto mb-20 h-[280px] md:h-[400px] flex justify-center items-center" 
                 x-data="{ 
                     active: 0, 
                     slides: [
                        '{{ asset('images/dokumgsc (27).JPG') }}',
                        '{{ asset('images/dokumgsc (7).JPG') }}',
                        '{{ asset('images/mitra.JPG') }}',
                        '{{ asset('images/dokumgsc (28).JPG') }}'
                     ],
                     getPos(i) {
                         if (i === this.active) return 'center';
                         if (i === (this.active + 1) % this.slides.length) return 'right';
                         if (i === (this.active - 1 + this.slides.length) % this.slides.length) return 'left';
                         return 'hidden';
                     },
                     init() {
                         setInterval(() => {
                             this.active = (this.active + 1) % this.slides.length;
                         }, 4000);
                     }
                 }">
                
                <!-- Soft Halo -->
                <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-64 h-64 md:w-[500px] md:h-[500px] bg-sky-300/30 rounded-full blur-[80px] animate-pulse pointer-events-none z-0"></div>
                
                <template x-for="(slide, i) in slides" :key="i">
                    <div class="absolute w-[280px] md:w-[500px] aspect-[4/3] rounded-3xl overflow-hidden transition-all duration-700 ease-in-out cursor-pointer shadow-2xl border-[5px] border-white origin-center"
                         :class="{
                             'z-30 scale-100 translate-x-0 opacity-100': getPos(i) === 'center',
                             'z-20 scale-75 translate-x-[60%] md:translate-x-[65%] opacity-60': getPos(i) === 'right',
                             'z-20 scale-75 -translate-x-[60%] md:-translate-x-[65%] opacity-60': getPos(i) === 'left',
                             'opacity-0 scale-50 z-10 translate-x-0': getPos(i) === 'hidden'
                         }"
                         @click="active = i">
                         
                         <!-- Dark overlay for side images -->
                         <div class="absolute inset-0 bg-slate-900/30 transition-opacity duration-700" :class="getPos(i) === 'center' ? 'opacity-0' : 'opacity-100'"></div>
                         
                         <img :src="slide" alt="Galeri Mitra" class="w-full h-full object-cover">
                    </div>
                </template>
                
                <!-- Carousel Navigation -->
                <div class="absolute -bottom-12 left-0 right-0 flex justify-center gap-3 z-40">
                    <template x-for="(slide, i) in slides" :key="'dot-'+i">
                        <button @click="active = i" 
                                class="h-2.5 rounded-full transition-all duration-500"
                                :class="active === i ? 'bg-primary-600 w-8' : 'bg-primary-200 w-2.5 hover:bg-primary-400'"></button>
                    </template>
                </div>
            </div>

            <!-- 3 Steps Visual -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 md:gap-8 w-full max-w-4xl mx-auto relative mb-16 mt-8">
                <!-- Connecting Line (Desktop) -->
                <div class="hidden md:block absolute top-10 left-[20%] right-[20%] h-[2px] bg-slate-200 z-0"></div>

                <!-- Step 1 -->
                <div class="relative z-10 flex flex-col items-center text-center bg-white p-8 rounded-3xl border border-slate-100 shadow-sm hover:shadow-xl transition-all duration-300 hover:-translate-y-1 group">
                    <div class="w-16 h-16 rounded-full bg-sky-50 text-primary-600 flex items-center justify-center font-black text-2xl mb-5 ring-4 ring-slate-50 group-hover:bg-primary-600 group-hover:text-white transition-colors duration-300">
                        1
                    </div>
                    <h3 class="font-bold text-slate-800 text-lg mb-2">DAFTAR</h3>
                    <p class="text-sm text-slate-500 leading-relaxed">Lengkapi data pendaftaran Anda secara detail melalui formulir pendaftaran.</p>
                </div>

                <!-- Step 2 -->
                <div class="relative z-10 flex flex-col items-center text-center bg-white p-8 rounded-3xl border border-slate-100 shadow-sm hover:shadow-xl transition-all duration-300 hover:-translate-y-1 group">
                    <div class="w-16 h-16 rounded-full bg-amber-50 text-amber-600 flex items-center justify-center font-black text-2xl mb-5 ring-4 ring-slate-50 group-hover:bg-amber-500 group-hover:text-white transition-colors duration-300">
                        2
                    </div>
                    <h3 class="font-bold text-slate-800 text-lg mb-2">VERIFIKASI</h3>
                    <p class="text-sm text-slate-500 leading-relaxed">Tim kami akan melakukan pengecekan dan validasi atas data yang dikirim.</p>
                </div>

                <!-- Step 3 -->
                <div class="relative z-10 flex flex-col items-center text-center bg-white p-8 rounded-3xl border border-slate-100 shadow-sm hover:shadow-xl transition-all duration-300 hover:-translate-y-1 group">
                    <div class="w-16 h-16 rounded-full bg-emerald-50 text-emerald-600 flex items-center justify-center font-black text-2xl mb-5 ring-4 ring-slate-50 group-hover:bg-emerald-500 group-hover:text-white transition-colors duration-300">
                        3
                    </div>
                    <h3 class="font-bold text-slate-800 text-lg mb-2">SIAP BERGABUNG</h3>
                    <p class="text-sm text-slate-500 leading-relaxed">Selamat! Anda resmi menjadi bagian dari jaringan relawan Ambulans Siaga.</p>
                </div>
            </div>

            <!-- CTA Button -->
            <a href="{{ route('register.supir') }}" class="group relative inline-flex items-center justify-center gap-3 bg-primary-600 text-white px-10 py-5 rounded-full font-black text-lg hover:bg-primary-700 transition-all duration-300 shadow-[0_10px_30px_rgba(0,156,166,0.3)] hover:-translate-y-1 hover:shadow-[0_15px_40px_rgba(0,156,166,0.4)]">
                Daftar sebagai Pengemudi Ambulans
                <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                </svg>
            </a>
        </div>
    </section>

    <!-- Rumah Sakit Rujukan Section (Putih / White) -->
    <section class="py-24 px-6 bg-white border-t border-slate-100">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-black text-slate-900 mb-4">Mitra Fasilitas Kesehatan</h2>
                <p class="text-slate-500 font-medium">Jaringan Rumah Sakit rujukan darurat 24 Jam yang terhubung dalam ekosistem Ambulans Siaga.</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
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
        </div>
    </section>

    <!-- Partners Section (Pudar / Slate-50) -->
    <section class="py-20 px-6 bg-slate-50 border-t border-slate-200/80">
        <div class="max-w-7xl mx-auto flex flex-col items-center justify-center gap-10">
            <h4 class="text-slate-400 font-extrabold uppercase tracking-[0.2em] text-sm text-center">
                Didukung Oleh Mitra Kebaikan
            </h4>
            <div class="flex flex-wrap justify-center items-center gap-10 md:gap-16 lg:gap-20 opacity-60 hover:opacity-100 grayscale hover:grayscale-0 transition-all duration-500">
                <div class="text-3xl font-black text-green-700 tracking-tighter hover:scale-105 transition-transform cursor-pointer">BAZNAS</div>
                <div class="text-3xl font-black text-orange-500 flex items-center gap-3 hover:scale-105 transition-transform cursor-pointer">
                    <svg class="w-10 h-10" fill="currentColor" viewBox="0 0 24 24"><path d="M12 3L1 11.4l1.2 1.6L4 11.6V21h16v-9.4l1.8 1.4 1.2-1.6L12 3zm-2 15h-4v-4h4v4zm6 0h-4v-4h4v4z"></path></svg> 
                    <span class="tracking-tighter">Rumah Zakat</span>
                </div>
                <div class="text-3xl font-black text-orange-400 tracking-tighter hover:scale-105 transition-transform cursor-pointer">
                    lazis<span class="text-orange-600">mu</span>
                </div>
                <div class="text-3xl font-black text-green-600 tracking-tighter flex items-center gap-2 hover:scale-105 transition-transform leading-none cursor-pointer">
                    <span class="w-7 h-7 bg-green-600 rounded-sm inline-block"></span> 
                    <span>DOMPET<br>DHUAFA</span>
                </div>
                <div class="text-3xl font-black text-primary-500 tracking-tighter hover:scale-105 transition-transform cursor-pointer">kitabisa</div>
            </div>
        </div>
    </section>

    <x-floating-donasi />
    <x-landing-footer />
</div>
