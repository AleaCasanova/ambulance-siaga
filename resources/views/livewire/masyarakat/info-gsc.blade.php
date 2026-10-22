<div>
    <!-- Dedicated Hero Section: Tentang Kami (Profil & Dedikasi Kemanusiaan) -->
    <section class="relative pt-20 overflow-hidden bg-[#002b2f]">
        <!-- Background Image (Armada Ambulans Siaga & Relawan) -->
        <div class="absolute inset-0 z-0 bg-cover bg-center"
             style="background-image: url('{{ asset('images/dokumgsc (26).JPG') }}');">
            <!-- Overlay Transparan untuk Mempertajam Teks (Terang & Jernih) -->
            <div class="absolute inset-0 bg-black/20"></div>
            <div class="absolute inset-0 bg-gradient-to-r from-black/65 via-black/25 to-transparent"></div>
        </div>

        <!-- Hero Content -->
        <div class="max-w-7xl mx-auto px-6 lg:px-12 min-h-[460px] sm:min-h-[500px] lg:min-h-[540px] flex items-center relative z-20 py-14 sm:py-16">
            <div class="max-w-3xl text-left text-white pr-4 lg:pr-12">
                <!-- Badge -->
                <div class="mb-4 sm:mb-5">
                    <span class="inline-flex items-center gap-2 bg-black/45 backdrop-blur-md text-white border border-white/20 px-4 py-1.5 rounded-full text-[10px] sm:text-xs font-bold tracking-widest uppercase shadow-md">
                        <span class="w-2 h-2 rounded-full bg-primary-400 animate-pulse"></span>
                        <span>PROFIL & DEDIKASI KEMANUSIAAN</span>
                    </span>
                </div>

                <!-- Big Headline -->
                <h1 class="text-3xl sm:text-4xl lg:text-5xl font-black leading-tight sm:leading-[1.15] mb-4 text-white drop-shadow-[0_3px_6px_rgba(0,0,0,0.85)] tracking-tight">
                    Mengenal Dedikasi & Perjalanan Ambulans Siaga
                </h1>

                <!-- Subtitle -->
                <p class="text-xs sm:text-base lg:text-lg text-slate-100 mb-8 max-w-2xl leading-relaxed font-medium drop-shadow-[0_2px_4px_rgba(0,0,0,0.8)]">
                    Ekosistem digital tanggap darurat medis terpadu 24 jam yang menghubungkan armada ambulans lintas-mitra secara cepat, profesional, dan 100% bebas biaya bagi masyarakat yang membutuhkan.
                </p>

                <!-- Action Buttons -->
                <div class="flex flex-wrap items-center gap-3 sm:gap-4">
                    <a href="#cerita-kami" 
                       class="inline-flex items-center justify-center gap-2 border-2 border-white text-white hover:bg-white hover:text-primary-600 px-6 sm:px-8 py-3 sm:py-3.5 rounded-lg font-bold text-xs sm:text-sm uppercase tracking-wider transition-all shadow-[0_4px_15px_rgba(0,0,0,0.4)] hover:shadow-xl active:scale-95 bg-black/25 backdrop-blur-xs">
                        <span class="w-2 h-2 rounded-full bg-primary-400 animate-pulse"></span>
                        <span>Baca Cerita Kami</span>
                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 14l-7 7m0 0l-7-7m7 7V3"/></svg>
                    </a>

                    <a href="tel:{{ preg_replace('/[^0-9]/', '', $telepon ?? '081234567890') }}" 
                       class="inline-flex items-center justify-center gap-2 bg-primary-600 hover:bg-primary-700 text-white px-5 sm:px-7 py-3 sm:py-3.5 rounded-lg font-bold text-xs sm:text-sm uppercase tracking-wider transition-all shadow-[0_4px_15px_rgba(0,156,166,0.4)] hover:shadow-lg active:scale-95">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                        <span>Hotline: {{ $telepon ?? '0812-3456-7890' }}</span>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Main Content Container with soft contrast backdrop so white cards pop ("timbul") -->
    <div class="bg-slate-100/60 border-t border-slate-200/80">
        <main class="py-12 sm:py-16 px-4 sm:px-6 lg:px-12 max-w-7xl mx-auto">
            <div class="space-y-12 sm:space-y-16">
                
                <!-- ========================================== -->
                <!-- BAGIAN 1: SEKILAS TENTANG AMBULANS SIAGA -->
                <!-- ========================================== -->
                <div id="cerita-kami" class="scroll-mt-24 bg-white rounded-3xl border border-slate-200/90 p-6 sm:p-10 lg:p-12 shadow-[0_12px_36px_-6px_rgba(15,23,42,0.09),0_4px_14px_-2px_rgba(15,23,42,0.04)] hover:shadow-[0_20px_45px_-10px_rgba(15,23,42,0.13)] transition-all duration-300 relative overflow-hidden">
                    <div class="relative z-10 grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-center">
                        <!-- Image Column -->
                        <div class="lg:col-span-6 relative">
                            <div class="relative w-full aspect-[4/3] sm:aspect-square rounded-2xl sm:rounded-3xl overflow-hidden shadow-lg border-4 border-white group">
                                <img src="{{ asset('images/dokumgsc (26).JPG') }}" alt="Armada & Relawan Ambulans Siaga" class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-700">
                                <div class="absolute inset-0 bg-gradient-to-t from-slate-900/80 via-slate-900/20 to-transparent"></div>
                                <div class="absolute bottom-4 sm:bottom-6 left-4 sm:left-6 right-4 sm:right-6">
                                    <span class="inline-block px-3 py-1 rounded-full bg-primary-600 text-white font-extrabold text-[10px] sm:text-[11px] uppercase tracking-wider mb-2 shadow-sm">
                                        Layanan Medis Bebas Biaya
                                    </span>
                                    <h4 class="text-sm sm:text-lg font-bold text-white leading-snug">
                                        Jaringan Armada Medis & Relawan Terintegrasi di Seluruh Indonesia
                                    </h4>
                                </div>
                            </div>
                        </div>

                        <!-- Content Column -->
                        <div class="lg:col-span-6 space-y-4 sm:space-y-6 text-left">
                            <div>
                                <span class="inline-block bg-sky-50 text-primary-600 border border-primary-200/80 shadow-xs font-black tracking-widest text-[10px] sm:text-xs px-3.5 py-1.5 rounded-full mb-3 uppercase">
                                    Cerita & Komitmen
                                </span>
                                <h2 class="text-2xl sm:text-3xl lg:text-4xl font-black text-slate-900 tracking-tight leading-tight">
                                    Sekilas Tentang Ambulans Siaga
                                </h2>
                            </div>
                            
                            <div class="space-y-3 sm:space-y-4 text-slate-600 text-xs sm:text-base leading-relaxed font-normal">
                                <p>
                                    <strong class="text-slate-900 font-bold">Ambulans Siaga</strong> adalah ekosistem digital layanan darurat medis dan transportasi ambulans bebas biaya di Indonesia. Misi utama Ambulans Siaga adalah <span class="text-primary-600 font-bold">"mendorong kemajuan pertolongan darurat"</span> dengan menawarkan infrastruktur dan solusi teknologi yang membantu semua orang mengakses penanganan darurat medis secara cepat dan transparan.
                                </p>
                                <p>
                                    Ekosistem ini menyediakan pemesanan ambulans darurat gratis, penugasan supir & tim medis profesional, pelacakan armada real-time, koordinasi antar rumah sakit rujukan terdekat, serta kolaborasi multi-mitra bagi masyarakat yang membutuhkan pertolongan cepat tanpa beban biaya sepeser pun.
                                </p>
                            </div>

                            <!-- 3 Key Point Cards -->
                            <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 pt-2">
                                <div class="p-3.5 rounded-xl bg-white border border-slate-200/80 shadow-xs hover:border-primary-300 hover:shadow-sm flex items-center gap-3 transition-all">
                                    <div class="w-9 h-9 rounded-lg bg-primary-50 text-primary-600 flex items-center justify-center shrink-0 border border-primary-100">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                    </div>
                                    <div>
                                        <span class="block text-xs font-black text-slate-900">24 Jam Penuh</span>
                                        <span class="block text-[10px] text-slate-500 font-medium">Siaga Kedaruratan</span>
                                    </div>
                                </div>
                                <div class="p-3.5 rounded-xl bg-white border border-slate-200/80 shadow-xs hover:border-primary-300 hover:shadow-sm flex items-center gap-3 transition-all">
                                    <div class="w-9 h-9 rounded-lg bg-primary-50 text-primary-600 flex items-center justify-center shrink-0 border border-primary-100">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                                    </div>
                                    <div>
                                        <span class="block text-xs font-black text-slate-900">100% Gratis</span>
                                        <span class="block text-[10px] text-slate-500 font-medium">Bebas Biaya Tarif</span>
                                    </div>
                                </div>
                                <div class="p-3.5 rounded-xl bg-white border border-slate-200/80 shadow-xs hover:border-primary-300 hover:shadow-sm flex items-center gap-3 transition-all">
                                    <div class="w-9 h-9 rounded-lg bg-primary-50 text-primary-600 flex items-center justify-center shrink-0 border border-primary-100">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                                    </div>
                                    <div>
                                        <span class="block text-xs font-black text-slate-900">Multi-Mitra</span>
                                        <span class="block text-[10px] text-slate-500 font-medium">Jaringan Faskes</span>
                                    </div>
                                </div>
                            </div>

                            <div class="pt-2">
                                <a href="#visi-misi" class="inline-flex items-center gap-2 px-6 py-3.5 rounded-lg bg-primary-600 hover:bg-primary-700 text-white font-bold text-xs sm:text-sm uppercase tracking-wider transition-all shadow-[0_8px_25px_rgba(0,156,166,0.3)] hover:-translate-y-0.5">
                                    <span>Pelajari Visi & Misi</span>
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ========================================== -->
                <!-- BAGIAN 2: VISI & MISI -->
                <!-- ========================================== -->
                <div id="visi-misi" class="scroll-mt-24 pt-4 sm:pt-6">
                    <div class="text-left mb-6 sm:mb-8">
                        <span class="inline-block bg-sky-50 text-primary-600 border border-primary-200/80 shadow-xs font-black tracking-widest text-[10px] sm:text-xs px-4 py-1.5 rounded-full mb-2 uppercase">
                            Arah & Tujuan
                        </span>
                        <h2 class="text-2xl sm:text-3xl lg:text-4xl font-black text-slate-900 tracking-tight">
                            Visi & Misi Kami
                        </h2>
                    </div>

                    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 lg:gap-8">
                        <!-- Kiri: VISI (Card Elegan Timbul) -->
                        <div class="lg:col-span-5">
                            <div class="h-full p-6 sm:p-9 rounded-3xl bg-white border border-slate-200/90 shadow-[0_12px_36px_-6px_rgba(15,23,42,0.09),0_4px_14px_-2px_rgba(15,23,42,0.04)] hover:shadow-[0_20px_45px_-10px_rgba(15,23,42,0.13)] transition-all duration-300 flex flex-col justify-between relative overflow-hidden group">
                                <!-- Ambient Glow Decor -->
                                <div class="absolute -right-16 -top-16 w-48 h-48 bg-primary-100/40 rounded-full blur-3xl pointer-events-none group-hover:scale-125 transition-transform duration-700"></div>

                                <div class="relative z-10 flex flex-col h-full">
                                    <div class="w-12 h-12 sm:w-14 sm:h-14 rounded-2xl bg-primary-50 text-primary-600 flex items-center justify-center mb-5 sm:mb-6 border border-primary-100 shadow-xs">
                                        <svg class="w-6 h-6 sm:w-7 sm:h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                    </div>
                                    <span class="text-xs font-black text-primary-600 uppercase tracking-widest block mb-2">Visi Utama</span>
                                    <h3 class="text-xl sm:text-2xl font-black text-slate-900 tracking-tight mb-4">Visi Kami</h3>
                                    <p class="text-sm sm:text-base lg:text-lg font-bold text-slate-800 leading-relaxed mb-6">
                                        "Menjadi platform integrasi layanan darurat medis dan transportasi ambulans bebas biaya terdepan di Indonesia yang handal, cepat, dan inklusif."
                                    </p>
                                    <div class="mt-auto pt-5 border-t border-slate-100">
                                        <p class="text-xs sm:text-sm text-slate-500 leading-relaxed font-medium">
                                            Memperkuat ketahanan aksesibilitas kesehatan, memastikan ketersediaan armada, serta mendorong keberlanjutan pertolongan darurat berskala nasional.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Kanan: MISI (List Cards Elegan Timbul) -->
                        <div class="lg:col-span-7 bg-white rounded-3xl border border-slate-200/90 p-6 sm:p-9 shadow-[0_12px_36px_-6px_rgba(15,23,42,0.09),0_4px_14px_-2px_rgba(15,23,42,0.04)] hover:shadow-[0_20px_45px_-10px_rgba(15,23,42,0.13)] transition-all duration-300 flex flex-col justify-between">
                            <div class="mb-6">
                                <span class="inline-block px-3 py-1 rounded-full bg-slate-100 text-primary-600 font-extrabold text-[10px] sm:text-[11px] uppercase tracking-wider mb-2">Misi Kami</span>
                                <h3 class="text-xl sm:text-2xl font-black text-slate-900 tracking-tight">Menghadirkan Solusi Inovatif</h3>
                                <p class="text-slate-500 mt-1.5 text-xs sm:text-sm leading-relaxed font-medium">Memberi nilai tambah melalui efisiensi koordinasi lapangan dan transparansi tanpa membebankan tarif kepada masyarakat.</p>
                            </div>

                            <!-- Stacked Mission List -->
                            <div class="space-y-3 sm:space-y-3.5">
                                <!-- Point 1 -->
                                <div class="group flex gap-3.5 sm:gap-4 p-4 rounded-2xl bg-white border border-slate-200/80 shadow-xs hover:border-primary-300 hover:shadow-md transition-all duration-300">
                                    <div class="w-10 h-10 sm:w-11 sm:h-11 rounded-xl bg-primary-50/60 shadow-xs border border-primary-100 flex items-center justify-center shrink-0 group-hover:scale-105 group-hover:bg-primary-600 group-hover:text-white transition-all text-primary-600">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                                    </div>
                                    <div>
                                        <h4 class="font-bold text-sm sm:text-base text-slate-900 group-hover:text-primary-600 transition-colors">Konektivitas Real-Time</h4>
                                        <p class="text-xs sm:text-sm text-slate-500 mt-0.5 leading-relaxed">Menghubungkan masyarakat dengan jaringan armada ambulans dari berbagai mitra secara otomatis dan cepat.</p>
                                    </div>
                                </div>
                                <!-- Point 2 -->
                                <div class="group flex gap-3.5 sm:gap-4 p-4 rounded-2xl bg-white border border-slate-200/80 shadow-xs hover:border-primary-300 hover:shadow-md transition-all duration-300">
                                    <div class="w-10 h-10 sm:w-11 sm:h-11 rounded-xl bg-primary-50/60 shadow-xs border border-primary-100 flex items-center justify-center shrink-0 group-hover:scale-105 group-hover:bg-primary-600 group-hover:text-white transition-all text-primary-600">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                    </div>
                                    <div>
                                        <h4 class="font-bold text-sm sm:text-base text-slate-900 group-hover:text-primary-600 transition-colors">Efisiensi Respon Darurat</h4>
                                        <p class="text-xs sm:text-sm text-slate-500 mt-0.5 leading-relaxed">Mengoptimalkan kecepatan penanganan melalui manajemen alokasi supir, tim medis, dan RS rujukan terdekat.</p>
                                    </div>
                                </div>
                                <!-- Point 3 -->
                                <div class="group flex gap-3.5 sm:gap-4 p-4 rounded-2xl bg-white border border-slate-200/80 shadow-xs hover:border-primary-300 hover:shadow-md transition-all duration-300">
                                    <div class="w-10 h-10 sm:w-11 sm:h-11 rounded-xl bg-primary-50/60 shadow-xs border border-primary-100 flex items-center justify-center shrink-0 group-hover:scale-105 group-hover:bg-primary-600 group-hover:text-white transition-all text-primary-600">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                                    </div>
                                    <div>
                                        <h4 class="font-bold text-sm sm:text-base text-slate-900 group-hover:text-primary-600 transition-colors">Transparansi Layanan Bebas Biaya</h4>
                                        <p class="text-xs sm:text-sm text-slate-500 mt-0.5 leading-relaxed">Menjamin kepastian layanan evakuasi tanpa memungut tarif bagi seluruh lapisan masyarakat yang membutuhkan.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ========================================== -->
                <!-- BAGIAN 3: MAKNA LOGO -->
                <!-- ========================================== -->
                <div id="makna-logo" class="scroll-mt-24 pt-4 sm:pt-6"
                     x-data="{
                         activeModal: null,
                         items: [
                             {
                                 id: 'teal',
                                 title: 'Cyan / Teal',
                                 category: 'Warna Identitas',
                                 desc: 'Melambangkan keandalan, dapat dipercaya, profesionalisme, serta inovasi teknologi digital dalam merespon kedaruratan secara tanggap dan tepat.',
                                 colorBg: 'bg-primary-50',
                                 type: 'color',
                                 colorClass: 'bg-primary-600 shadow-md shadow-primary-600/30'
                             },
                             {
                                 id: 'white',
                                 title: 'Putih Bersih',
                                 category: 'Nilai Kemanusiaan',
                                 desc: 'Mencerminkan kemurnian niat, ketulusan pengabdian seluruh relawan, higienitas standar medis, serta komitmen ketegasan layanan tanpa pungutan biaya apapun.',
                                 colorBg: 'bg-slate-100',
                                 type: 'color',
                                 colorClass: 'bg-white border-2 border-slate-300 shadow-sm'
                             },
                             {
                                 id: 'plus',
                                 title: 'Cross / Plus (+)',
                                 category: 'Simbol Medis',
                                 desc: 'Simbol palang medis melambangkan pertolongan tanggap darurat kesehatan yang terintegrasi dan selalu berpusat pada keselamatan serta pemulihan masyarakat.',
                                 colorBg: 'bg-primary-50',
                                 type: 'icon',
                                 icon: '+'
                             },
                             {
                                 id: 'ambulance',
                                 title: 'Ilustrasi Kendaraan',
                                 category: 'Kesiapsiagaan 24 Jam',
                                 desc: 'Menggambarkan kesiapsiagaan armada ambulans 24 jam penuh, mobilitas tingkat tinggi untuk evakuasi rujukan, serta pelindung darurat bagi sesama.',
                                 colorBg: 'bg-primary-50',
                                 type: 'vehicle'
                             }
                         ]
                     }">
                    <div class="text-left mb-6 sm:mb-8">
                        <span class="inline-block bg-sky-50 text-primary-600 border border-primary-200/80 shadow-xs font-black tracking-widest text-[10px] sm:text-xs px-4 py-1.5 rounded-full mb-2 uppercase">
                            Identitas Visual
                        </span>
                        <h2 class="text-2xl sm:text-3xl lg:text-4xl font-black text-slate-900 tracking-tight">
                            Makna Logo & Simbol
                        </h2>
                    </div>

                    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 lg:gap-8 items-center bg-white rounded-3xl border border-slate-200/90 p-6 sm:p-10 shadow-[0_12px_36px_-6px_rgba(15,23,42,0.09),0_4px_14px_-2px_rgba(15,23,42,0.04)] hover:shadow-[0_20px_45px_-10px_rgba(15,23,42,0.13)] transition-all duration-300">
                        <!-- Kiri: Logo Display -->
                        <div class="lg:col-span-5">
                            <div class="relative w-full aspect-square rounded-2xl bg-gradient-to-br from-white to-slate-50/80 shadow-inner border border-slate-200/90 flex flex-col items-center justify-center p-8 overflow-hidden group">
                                <div class="absolute inset-0 bg-[radial-gradient(circle_at_center,rgba(0,156,166,0.08)_0%,transparent_70%)] opacity-0 group-hover:opacity-100 transition-opacity duration-700"></div>
                                <img src="{{ asset('images/logo_ambulansiaga.png') }}" alt="Logo Resmi Ambulans Siaga" class="relative z-10 w-3/4 max-w-[200px] h-auto object-contain drop-shadow-xl group-hover:scale-105 transition-transform duration-500">
                                
                                <div class="relative z-10 mt-6 text-center">
                                    <span class="block text-xl font-black text-slate-900 tracking-wider uppercase">Ambulans Siaga</span>
                                    <span class="block text-[11px] font-bold text-primary-600 uppercase tracking-widest mt-1">Layanan Darurat • Multi-Mitra</span>
                                </div>
                            </div>
                        </div>

                        <!-- Kanan: 4 Kartu Makna Simbol -->
                        <div class="lg:col-span-7 space-y-6">
                            <p class="text-slate-500 text-xs sm:text-base leading-relaxed font-normal">
                                Setiap elemen visual dan warna dirancang dengan penuh pertimbangan untuk merepresentasikan nilai kepedulian, keikhlasan relawan, dan profesionalisme pelayanan darurat medis.
                            </p>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <!-- Warna Cyan / Teal -->
                                <div class="p-5 rounded-2xl bg-white border border-slate-200/80 shadow-xs hover:border-primary-300 hover:shadow-md transition-all">
                                    <div class="flex items-center gap-3 mb-2.5">
                                        <span class="w-5 h-5 rounded-full bg-primary-600 shadow-sm border-2 border-white shrink-0"></span>
                                        <h4 class="font-bold text-slate-900 text-sm">Cyan / Teal</h4>
                                    </div>
                                    <p class="text-xs text-slate-500 leading-relaxed font-normal">Keandalan, dapat dipercaya, profesionalisme, serta inovasi teknologi digital dalam merespon kedaruratan.</p>
                                </div>
                                
                                <!-- Warna Putih -->
                                <div class="p-5 rounded-2xl bg-white border border-slate-200/80 shadow-xs hover:border-slate-300 hover:shadow-md transition-all">
                                    <div class="flex items-center gap-3 mb-2.5">
                                        <span class="w-5 h-5 rounded-full bg-white shadow-xs border-2 border-slate-300 shrink-0"></span>
                                        <h4 class="font-bold text-slate-900 text-sm">Putih Bersih</h4>
                                    </div>
                                    <p class="text-xs text-slate-500 leading-relaxed font-normal">Kemurnian niat, ketulusan pengabdian relawan, higienitas medis, dan ketegasan layanan tanpa pungutan biaya.</p>
                                </div>

                                <!-- Simbol Plus -->
                                <div class="p-5 rounded-2xl bg-white border border-slate-200/80 shadow-xs hover:border-primary-300 hover:shadow-md transition-all">
                                    <div class="flex items-center gap-3 mb-2.5">
                                        <div class="w-6 h-6 rounded bg-primary-50 text-primary-600 flex items-center justify-center font-black text-base border border-primary-100 shrink-0">+</div>
                                        <h4 class="font-bold text-slate-900 text-sm">Cross / Plus</h4>
                                    </div>
                                    <p class="text-xs text-slate-500 leading-relaxed font-normal">Melambangkan pertolongan medis darurat terintegrasi yang sepenuhnya berpusat pada keselamatan masyarakat.</p>
                                </div>

                                <!-- Simbol Ambulans -->
                                <div class="p-5 rounded-2xl bg-white border border-slate-200/80 shadow-xs hover:border-primary-300 hover:shadow-md transition-all">
                                    <div class="flex items-center gap-3 mb-2.5">
                                        <div class="w-6 h-6 rounded bg-primary-50 text-primary-600 flex items-center justify-center border border-primary-100 shrink-0">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 17h2c.6 0 1-.4 1-1v-3c0-.9-.7-1.7-1.5-1.9C18.7 10.6 16 10 16 10s-1.3-1.4-2.2-2.3c-.5-.4-1.1-.7-1.8-.7H5c-.6 0-1 .4-1 1v10c0 .6.4 1 1 1h2m0 0a2 2 0 104 0m-4 0a2 2 0 114 0m6 0a2 2 0 104 0m-4 0a2 2 0 114 0"/></svg>
                                        </div>
                                        <h4 class="font-bold text-slate-900 text-sm">Armada Kendaraan</h4>
                                    </div>
                                    <p class="text-xs text-slate-500 leading-relaxed font-normal">Kesiapsiagaan armada ambulans 24 jam penuh, mobilitas tinggi untuk rujukan, dan pelindung darurat sesama.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ========================================== -->
                <!-- BAGIAN 4: PUSAT KOORDINASI & SEKRETARIAT -->
                <!-- ========================================== -->
                <div id="koordinasi" class="scroll-mt-24 pt-4 sm:pt-6 pb-6 sm:pb-8">
                    <div class="bg-white rounded-3xl border border-slate-200/90 p-6 sm:p-10 lg:p-12 shadow-[0_12px_36px_-6px_rgba(15,23,42,0.09),0_4px_14px_-2px_rgba(15,23,42,0.04)] hover:shadow-[0_20px_45px_-10px_rgba(15,23,42,0.13)] transition-all duration-300 relative overflow-hidden">
                        <div class="relative z-10">
                            <!-- Header Bar -->
                            <div class="flex flex-col lg:flex-row gap-4 sm:gap-6 lg:items-center lg:justify-between pb-6 sm:pb-8 mb-6 sm:mb-8 border-b border-slate-100">
                                <div>
                                    <span class="inline-block px-3.5 py-1.5 rounded-full bg-sky-50 text-primary-600 border border-primary-200/80 shadow-xs font-black text-[10px] sm:text-xs uppercase tracking-widest mb-2">
                                        Layanan Resmi & Sekretariat
                                    </span>
                                    <h2 class="text-2xl sm:text-3xl lg:text-4xl font-black text-slate-900 tracking-tight">
                                        Pusat Koordinasi & Sekretariat
                                    </h2>
                                    <p class="text-slate-500 text-xs sm:text-base mt-1.5 font-normal leading-relaxed max-w-2xl">
                                        Hubungi pusat komando kami untuk informasi kemitraan, layanan evakuasi medis darurat, atau koordinasi rujukan 24 jam non-stop.
                                    </p>
                                </div>
                                <div class="shrink-0">
                                    <a href="tel:{{ preg_replace('/[^0-9]/', '', $telepon) }}" class="inline-flex items-center gap-2 px-6 py-3.5 rounded-lg bg-primary-600 hover:bg-primary-700 text-white font-bold text-xs sm:text-sm uppercase tracking-wider transition-all shadow-[0_8px_25px_rgba(0,156,166,0.3)] hover:-translate-y-0.5">
                                        <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                                        <span>Hubungi Hotline</span>
                                    </a>
                                </div>
                            </div>

                            <!-- 3 Cards -->
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                <!-- Card 1: Alamat -->
                                <div class="p-6 sm:p-7 rounded-2xl bg-white border border-slate-200/80 shadow-xs hover:border-primary-300 hover:shadow-md transition-all duration-300 flex flex-col justify-between group">
                                    <div>
                                        <div class="w-12 h-12 rounded-xl bg-primary-50/60 shadow-xs border border-primary-100 flex items-center justify-center text-primary-600 mb-5 group-hover:scale-105 group-hover:bg-primary-600 group-hover:text-white transition-all">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                        </div>
                                        <span class="text-[11px] font-bold text-slate-400 uppercase tracking-wider block mb-1.5">Alamat Kantor Pusat</span>
                                        <p class="text-sm sm:text-base font-bold text-slate-900 leading-relaxed">{{ $alamat }}</p>
                                    </div>
                                <div class="mt-6 pt-4 border-t border-slate-200/60 flex items-center text-xs font-semibold text-slate-500">
                                    <span class="flex items-center gap-1.5 text-slate-600">
                                        <svg class="w-4 h-4 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                                        Kantor Pengendali Operasional
                                    </span>
                                </div>
                            </div>

                            <!-- Card 2: Telepon & Darurat -->
                            <div class="p-6 sm:p-7 rounded-2xl bg-white border border-slate-200/80 shadow-xs hover:border-primary-300 hover:shadow-md transition-all duration-300 flex flex-col justify-between group">
                                <div>
                                    <div class="w-12 h-12 rounded-xl bg-primary-50/60 shadow-xs border border-primary-100 flex items-center justify-center text-primary-600 mb-5 group-hover:scale-105 group-hover:bg-primary-600 group-hover:text-white transition-all">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                                    </div>
                                    <span class="text-[11px] font-bold text-slate-400 uppercase tracking-wider block mb-1.5">Telepon & Darurat (24 Jam)</span>
                                    <a href="tel:{{ preg_replace('/[^0-9]/', '', $telepon) }}" class="text-sm sm:text-base font-bold text-slate-900 hover:text-primary-600 transition-colors block leading-relaxed">
                                        {{ $telepon }}
                                    </a>
                                </div>
                                <div class="mt-6 pt-4 border-t border-slate-200/60 flex items-center text-xs font-semibold text-slate-500">
                                    <span class="flex items-center gap-1.5 text-slate-600">
                                        <svg class="w-4 h-4 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                                        Panggilan Darurat Siaga 24 Jam
                                    </span>
                                </div>
                            </div>

                            <!-- Card 3: Email -->
                            <div class="p-6 sm:p-7 rounded-2xl bg-white border border-slate-200/80 shadow-xs hover:border-primary-300 hover:shadow-md transition-all duration-300 flex flex-col justify-between group">
                                <div>
                                    <div class="w-12 h-12 rounded-xl bg-primary-50/60 shadow-xs border border-primary-100 flex items-center justify-center text-primary-600 mb-5 group-hover:scale-105 group-hover:bg-primary-600 group-hover:text-white transition-all">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                                    </div>
                                    <span class="text-[11px] font-bold text-slate-400 uppercase tracking-wider block mb-1.5">Alamat Email Resmi</span>
                                    <a href="mailto:{{ $email }}" class="text-sm sm:text-base font-bold text-slate-900 hover:text-primary-600 transition-colors block break-all leading-relaxed">
                                        {{ $email }}
                                    </a>
                                </div>
                                <div class="mt-6 pt-4 border-t border-slate-200/60 flex items-center text-xs font-semibold text-slate-500">
                                    <span class="flex items-center gap-1.5 text-slate-600">
                                        <svg class="w-4 h-4 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                        Respon Surat 1x24 Jam
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </main>
</div>

    <x-floating-donasi />
    <x-landing-footer />
</div>
