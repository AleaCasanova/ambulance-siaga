<div>
    <div class="absolute top-0 left-0 w-full h-80 bg-gradient-to-br from-[#009CA6] to-[#007b83] -z-10"></div>
    <x-landing-navbar />
    
    <main class="pt-32 pb-24 px-6 lg:px-12 max-w-7xl mx-auto min-h-screen w-full">
        <div class="space-y-12">
            <!-- ========================================== -->
            <!-- BAGIAN 1: SEKILAS TENTANG AMBULANCE SIAGA -->
            <!-- ========================================== -->
            <div class="relative overflow-hidden rounded-3xl bg-gradient-to-br from-[#009CA6] to-[#007b83] text-white shadow-2xl border border-white/20">
                <!-- Decorative Pattern -->
                <div class="absolute inset-0 opacity-10" style="background-image: radial-gradient(circle at 2px 2px, white 1px, transparent 0); background-size: 32px 32px;"></div>

                <div class="relative z-10 border-b border-white/20 px-6 sm:px-10 py-4 flex items-center gap-8 text-xs sm:text-sm font-semibold text-sky-100 overflow-x-auto">
                    <a href="#sekilas" class="text-white border-b-2 border-white pb-1 whitespace-nowrap font-bold">Cerita Kami</a>
                    <a href="#visi-misi" class="hover:text-white transition-colors whitespace-nowrap">Visi & Misi</a>
                    <a href="#makna-logo" class="hover:text-white transition-colors whitespace-nowrap">Makna Logo</a>
                    <a href="#koordinasi" class="hover:text-white transition-colors whitespace-nowrap">Pusat Koordinasi</a>
                </div>

                <div class="relative z-10 grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 p-8 sm:p-12 lg:p-16 items-center">
                    <div class="lg:col-span-6 relative">
                        <div class="relative rounded-3xl overflow-hidden shadow-2xl border border-white/20 group bg-white/10">
                            <img src="{{ asset('images/gsc_community_photo.png') }}" alt="Armada & Relawan Ambulance Siaga" class="w-full h-[320px] sm:h-[400px] object-cover transform group-hover:scale-105 transition-transform duration-700">
                            <div class="absolute inset-0 bg-gradient-to-t from-slate-900/80 via-transparent to-transparent"></div>
                            <div class="absolute bottom-6 left-6 right-6">
                                <span class="inline-block px-3 py-1 rounded-full bg-yellow-300 text-slate-800 font-extrabold text-[11px] uppercase tracking-wider mb-2">Layanan Medis Gratis</span>
                                <h4 class="text-lg font-bold text-white leading-snug">Jaringan Armada Medis & Relawan Terintegrasi di Seluruh Indonesia</h4>
                            </div>
                        </div>
                    </div>

                    <div class="lg:col-span-6 space-y-6">
                        <h1 class="text-3xl sm:text-4xl lg:text-5xl font-black text-white tracking-tight leading-tight drop-shadow-lg">Sekilas Tentang Ambulance Siaga</h1>
                        <div class="space-y-4 text-sky-50 text-sm sm:text-base leading-relaxed font-medium">
                            <p><strong class="text-white font-bold">Ambulance Siaga</strong> adalah ekosistem digital layanan darurat medis dan transportasi ambulans bebas biaya di Indonesia. Misi Ambulance Siaga adalah untuk <em class="text-yellow-300 font-bold not-italic">"mendorong kemajuan pertolongan darurat"</em> dengan menawarkan infrastruktur dan solusi teknologi yang membantu semua orang untuk mengakses dan berkembang dalam penanganan darurat medis.</p>
                            <p>Ekosistem Ambulance Siaga menyediakan berbagai layanan, termasuk pemesanan ambulans darurat gratis, penugasan supir & tim medis, pelacakan posisi ambulans secara real-time, koordinasi antar rumah sakit rujukan, serta solusi teknologi integrasi jaringan multi-mitra bagi masyarakat yang membutuhkan pertolongan cepat tanpa beban biaya.</p>
                        </div>
                        <div class="pt-2">
                            <a href="#visi-misi" class="inline-flex items-center justify-center px-6 py-3 rounded-full border-2 border-white/50 text-white hover:bg-white hover:text-[#009CA6] font-bold text-sm transition-all duration-200 shadow-lg">Selengkapnya</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ========================================== -->
            <!-- BAGIAN 2: VISI & MISI -->
            <!-- ========================================== -->
            <div id="visi-misi" class="pt-8">
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12">
                    
                    <!-- Kiri: VISI (Card Solid) -->
                    <div class="lg:col-span-5">
                        <div class="relative h-full p-8 sm:p-10 rounded-[2.5rem] bg-gradient-to-br from-[#009CA6] to-[#007b83] text-white shadow-2xl border border-white/20 overflow-hidden group">
                            <!-- Background Decor -->
                            <div class="absolute -right-20 -top-20 w-64 h-64 bg-white/10 rounded-full blur-3xl group-hover:scale-110 transition-transform duration-700"></div>
                            <div class="absolute -left-10 -bottom-10 w-40 h-40 bg-yellow-300/20 rounded-full blur-2xl"></div>
                            
                            <div class="relative z-10 flex flex-col h-full">
                                <div class="w-14 h-14 rounded-2xl bg-white/20 flex items-center justify-center mb-8 backdrop-blur-sm border border-white/30">
                                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                </div>
                                <h2 class="text-3xl sm:text-4xl font-black mb-6 tracking-tight">Visi Kami</h2>
                                <p class="text-lg sm:text-xl font-bold leading-relaxed mb-6">
                                    Menjadi platform integrasi layanan darurat medis dan transportasi ambulans bebas biaya terdepan di Indonesia yang handal, cepat, dan inklusif.
                                </p>
                                <div class="mt-auto pt-6 border-t border-white/20">
                                    <p class="text-xs sm:text-sm text-sky-50 leading-relaxed font-medium">
                                        Memperkuat ketahanan aksesibilitas kesehatan, memastikan ketersediaan armada, serta mendorong keberlanjutan pertolongan darurat berskala nasional.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Kanan: MISI (List Cards) -->
                    <div class="lg:col-span-7 bg-white rounded-[2.5rem] border border-slate-200/80 p-8 sm:p-10 shadow-xs flex flex-col justify-center">
                        <div class="mb-8">
                            <span class="inline-block px-3 py-1 rounded-full bg-slate-100 text-[#009CA6] font-extrabold text-[11px] uppercase tracking-wider mb-3">Tujuan & Misi</span>
                            <h2 class="text-3xl sm:text-4xl font-extrabold text-slate-800 tracking-tight">Menghadirkan Solusi Inovatif</h2>
                            <p class="text-slate-500 mt-3 text-sm sm:text-base leading-relaxed">Memberi nilai tambah melalui efisiensi koordinasi lapangan dan transparansi tanpa membebankan tarif kepada masyarakat.</p>
                        </div>

                        <div class="space-y-4">
                            <!-- Point 1 -->
                            <div class="group flex gap-5 p-5 rounded-2xl bg-slate-50 border border-slate-100 hover:bg-white hover:border-[#009CA6]/30 hover:shadow-lg hover:shadow-[#009CA6]/5 transition-all duration-300">
                                <div class="w-12 h-12 rounded-xl bg-white shadow-sm border border-slate-200 flex items-center justify-center flex-shrink-0 group-hover:scale-110 group-hover:border-[#009CA6]/30 transition-transform duration-300">
                                    <svg class="w-6 h-6 text-[#009CA6]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                                </div>
                                <div>
                                    <h4 class="font-bold text-slate-800 group-hover:text-[#009CA6] transition-colors">Konektivitas Real-Time</h4>
                                    <p class="text-xs sm:text-sm text-slate-500 mt-1 leading-relaxed">Menghubungkan masyarakat dengan jaringan armada ambulans dari berbagai mitra secara otomatis dan cepat.</p>
                                </div>
                            </div>
                            <!-- Point 2 -->
                            <div class="group flex gap-5 p-5 rounded-2xl bg-slate-50 border border-slate-100 hover:bg-white hover:border-[#009CA6]/30 hover:shadow-lg hover:shadow-[#009CA6]/5 transition-all duration-300">
                                <div class="w-12 h-12 rounded-xl bg-white shadow-sm border border-slate-200 flex items-center justify-center flex-shrink-0 group-hover:scale-110 group-hover:border-[#009CA6]/30 transition-transform duration-300">
                                    <svg class="w-6 h-6 text-[#009CA6]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                </div>
                                <div>
                                    <h4 class="font-bold text-slate-800 group-hover:text-[#009CA6] transition-colors">Efisiensi Respon Darurat</h4>
                                    <p class="text-xs sm:text-sm text-slate-500 mt-1 leading-relaxed">Mengoptimalkan kecepatan penanganan melalui manajemen alokasi supir, tim medis, dan RS rujukan terdekat.</p>
                                </div>
                            </div>
                            <!-- Point 3 -->
                            <div class="group flex gap-5 p-5 rounded-2xl bg-slate-50 border border-slate-100 hover:bg-white hover:border-[#009CA6]/30 hover:shadow-lg hover:shadow-[#009CA6]/5 transition-all duration-300">
                                <div class="w-12 h-12 rounded-xl bg-white shadow-sm border border-slate-200 flex items-center justify-center flex-shrink-0 group-hover:scale-110 group-hover:border-[#009CA6]/30 transition-transform duration-300">
                                    <svg class="w-6 h-6 text-[#009CA6]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                                </div>
                                <div>
                                    <h4 class="font-bold text-slate-800 group-hover:text-[#009CA6] transition-colors">Transparansi Layanan Bebas Biaya</h4>
                                    <p class="text-xs sm:text-sm text-slate-500 mt-1 leading-relaxed">Menjamin kepastian layanan evakuasi tanpa memungut tarif bagi seluruh lapisan masyarakat yang membutuhkan.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <!-- ========================================== -->
            <!-- BAGIAN 3: MAKNA LOGO -->
            <!-- ========================================== -->
            <div id="makna-logo" class="pt-8">
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-center bg-white rounded-[2.5rem] border border-slate-200/80 p-6 sm:p-10 shadow-xs">
                    
                    <!-- Logo Display -->
                    <div class="lg:col-span-5 order-2 lg:order-1">
                        <div class="relative w-full aspect-square rounded-[2rem] bg-gradient-to-br from-slate-50 to-slate-100 shadow-inner border border-slate-200 flex flex-col items-center justify-center p-8 overflow-hidden group">
                            <div class="absolute inset-0 bg-[radial-gradient(circle_at_center,rgba(0,156,166,0.08)_0%,transparent_70%)] opacity-0 group-hover:opacity-100 transition-opacity duration-700"></div>
                            <img src="{{ asset('images/logo_ambulansiaga.png') }}" alt="Logo Resmi Ambulance Siaga" class="relative z-10 w-3/4 h-auto object-contain drop-shadow-xl group-hover:scale-105 transition-transform duration-500">
                            
                            <div class="relative z-10 mt-8 text-center">
                                <span class="block text-xl font-black text-slate-800 tracking-wider uppercase">Ambulance Siaga</span>
                                <span class="block text-[10px] font-bold text-[#009CA6] uppercase tracking-widest mt-1">Layanan Darurat • Multi-Mitra</span>
                            </div>
                        </div>
                    </div>

                    <!-- Penjelasan Logo -->
                    <div class="lg:col-span-7 order-1 lg:order-2 space-y-8">
                        <div>
                            <span class="inline-block px-3 py-1 rounded-full bg-sky-50 text-[#009CA6] font-extrabold text-[11px] uppercase tracking-wider mb-3">Identitas Visual</span>
                            <h2 class="text-3xl sm:text-4xl font-extrabold text-slate-800 tracking-tight">Makna Logo & Simbol</h2>
                            <p class="text-slate-500 mt-3 text-sm sm:text-base leading-relaxed">Setiap elemen dan warna dirancang dengan penuh pertimbangan untuk merepresentasikan nilai kepedulian, keikhlasan, dan profesionalisme pelayanan.</p>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                            <!-- Warna Teal -->
                            <div class="p-5 rounded-2xl bg-slate-50 border border-slate-100 hover:bg-white hover:border-[#009CA6]/30 hover:shadow-lg hover:shadow-[#009CA6]/5 transition-all">
                                <div class="flex items-center gap-3 mb-3">
                                    <span class="w-5 h-5 rounded-full bg-[#009CA6] shadow-sm shadow-[#009CA6]/40 border-2 border-white"></span>
                                    <h4 class="font-bold text-slate-800 text-sm">Cyan / Teal</h4>
                                </div>
                                <p class="text-xs text-slate-500 leading-relaxed">Keandalan, dapat dipercaya, profesionalisme, serta inovasi teknologi digital dalam merespon kedaruratan.</p>
                            </div>
                            
                            <!-- Warna Putih -->
                            <div class="p-5 rounded-2xl bg-slate-50 border border-slate-100 hover:bg-white hover:border-slate-300 hover:shadow-lg transition-all">
                                <div class="flex items-center gap-3 mb-3">
                                    <span class="w-5 h-5 rounded-full bg-white shadow-sm border-2 border-slate-200"></span>
                                    <h4 class="font-bold text-slate-800 text-sm">Putih Bersih</h4>
                                </div>
                                <p class="text-xs text-slate-500 leading-relaxed">Kemurnian niat, ketulusan pengabdian, higienitas medis, dan ketegasan layanan tanpa pungutan biaya.</p>
                            </div>

                            <!-- Simbol Plus -->
                            <div class="p-5 rounded-2xl bg-slate-50 border border-slate-100 hover:bg-white hover:border-[#009CA6]/30 hover:shadow-lg hover:shadow-[#009CA6]/5 transition-all">
                                <div class="flex items-center gap-3 mb-3">
                                    <div class="w-6 h-6 rounded bg-[#009CA6]/10 flex items-center justify-center text-[#009CA6] font-black text-lg">+</div>
                                    <h4 class="font-bold text-slate-800 text-sm">Cross / Plus</h4>
                                </div>
                                <p class="text-xs text-slate-500 leading-relaxed">Melambangkan pertolongan medis darurat yang sepenuhnya berpusat pada kesehatan masyarakat.</p>
                            </div>

                            <!-- Simbol Ambulans -->
                            <div class="p-5 rounded-2xl bg-slate-50 border border-slate-100 hover:bg-white hover:border-[#009CA6]/30 hover:shadow-lg hover:shadow-[#009CA6]/5 transition-all">
                                <div class="flex items-center gap-3 mb-3">
                                    <div class="w-6 h-6 rounded bg-[#009CA6]/10 flex items-center justify-center text-[#009CA6]">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 17h2c.6 0 1-.4 1-1v-3c0-.9-.7-1.7-1.5-1.9C18.7 10.6 16 10 16 10s-1.3-1.4-2.2-2.3c-.5-.4-1.1-.7-1.8-.7H5c-.6 0-1 .4-1 1v10c0 .6.4 1 1 1h2m0 0a2 2 0 104 0m-4 0a2 2 0 114 0m6 0a2 2 0 104 0m-4 0a2 2 0 114 0"></path></svg>
                                    </div>
                                    <h4 class="font-bold text-slate-800 text-sm">Ilustrasi Kendaraan</h4>
                                </div>
                                <p class="text-xs text-slate-500 leading-relaxed">Menggambarkan kesiapsiagaan 24 jam penuh, mobilitas tingkat tinggi, dan pelindung bagi umat.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ========================================== -->
            <!-- BAGIAN 4: PUSAT KOORDINASI & SEKRETARIAT -->
            <!-- ========================================== -->
            <div id="koordinasi" class="pt-8 pb-8">
                <div class="relative bg-[#0F2747] rounded-[2.5rem] p-8 sm:p-12 shadow-2xl overflow-hidden">
                    <!-- Background Graphics -->
                    <div class="absolute inset-0 opacity-20" style="background-image: radial-gradient(circle at 2px 2px, white 1px, transparent 0); background-size: 32px 32px;"></div>
                    <div class="absolute -right-20 -bottom-20 w-80 h-80 bg-[#009CA6]/40 rounded-full blur-3xl"></div>
                    
                    <div class="relative z-10 flex flex-col lg:flex-row gap-8 lg:items-center lg:justify-between mb-10">
                        <div>
                            <h3 class="text-2xl sm:text-3xl font-black text-white tracking-tight mb-2">Pusat Koordinasi & Sekretariat</h3>
                            <p class="text-sky-200 text-sm font-medium">Hubungi kami untuk informasi kemitraan, keluhan, atau layanan darurat 24 jam.</p>
                        </div>
                        <div class="flex-shrink-0">
                            <a href="tel:{{ preg_replace('/[^0-9]/', '', $telepon) }}" class="inline-flex items-center gap-3 px-6 py-3.5 rounded-full bg-white hover:bg-slate-50 text-[#0F2747] font-extrabold text-sm transition-all shadow-lg shadow-white/10 group">
                                <span class="relative flex h-3 w-3">
                                  <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-[#009CA6] opacity-75"></span>
                                  <span class="relative inline-flex rounded-full h-3 w-3 bg-[#009CA6]"></span>
                                </span>
                                Hubungi Hotline
                            </a>
                        </div>
                    </div>

                    <div class="relative z-10 grid grid-cols-1 md:grid-cols-3 gap-4 sm:gap-6">
                        <!-- Alamat -->
                        <div class="p-6 rounded-2xl bg-white/10 border border-white/20 backdrop-blur-md hover:bg-white/20 transition-all group">
                            <div class="w-10 h-10 rounded-xl bg-white/20 flex items-center justify-center text-white mb-4">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            </div>
                            <span class="text-[10px] font-extrabold text-sky-200 block uppercase tracking-wider mb-1.5">Alamat Kantor Pusat</span>
                            <p class="text-sm font-bold text-white leading-relaxed">{{ $alamat }}</p>
                        </div>
                        <!-- Telepon -->
                        <div class="p-6 rounded-2xl bg-white/10 border border-white/20 backdrop-blur-md hover:bg-white/20 transition-all group">
                            <div class="w-10 h-10 rounded-xl bg-[#009CA6] flex items-center justify-center text-white mb-4 shadow-lg shadow-[#009CA6]/30">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                            </div>
                            <span class="text-[10px] font-extrabold text-sky-200 block uppercase tracking-wider mb-1.5">Telepon & Darurat (24 Jam)</span>
                            <p class="text-lg font-black text-white">{{ $telepon }}</p>
                        </div>
                        <!-- Email -->
                        <div class="p-6 rounded-2xl bg-white/10 border border-white/20 backdrop-blur-md hover:bg-white/20 transition-all group">
                            <div class="w-10 h-10 rounded-xl bg-white/20 flex items-center justify-center text-white mb-4">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                            </div>
                            <span class="text-[10px] font-extrabold text-sky-200 block uppercase tracking-wider mb-1.5">Alamat Email Resmi</span>
                            <p class="text-sm font-bold text-white">{{ $email }}</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </main>

    <x-landing-footer />
</div>
