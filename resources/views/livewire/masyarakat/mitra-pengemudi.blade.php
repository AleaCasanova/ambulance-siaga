<div x-data="{ 
    showTypeModal: false 
}" class="min-h-screen bg-slate-50/50 font-sans text-slate-800 selection:bg-primary-600 selection:text-white">

    <!-- Section 1: Hero Banner (Perorangan / Pengemudi Ambulans) -->
    <section class="relative pt-36 sm:pt-40 pb-24 sm:pb-28 px-6 lg:px-12 overflow-hidden bg-primary-600" style="background-image: url('{{ asset('images/beranda_utama_bg.jpg') }}'); background-size: cover; background-position: center; background-repeat: no-repeat;">
        <!-- Gradient Overlay: Rich Teal/Cyan & Primary (Matching Beranda & Donasi) -->
        <div class="absolute inset-0 bg-gradient-to-r from-primary-700 via-[#009CA6]/85 to-primary-600/75 mix-blend-multiply"></div>
        <div class="absolute inset-0 bg-gradient-to-r from-primary-700/90 via-[#009CA6]/80 to-primary-800/75"></div>
        
        <!-- Bottom Fade to Slate/White -->
        <div class="absolute inset-x-0 bottom-0 h-28 bg-gradient-to-t from-slate-50 via-slate-50/40 to-transparent pointer-events-none z-10"></div>

        <div class="max-w-7xl mx-auto flex flex-col lg:flex-row items-center gap-12 relative z-10">
            <!-- Left: Hero Text Content -->
            <div class="lg:w-[55%] text-white z-10 text-center lg:text-left space-y-6">
                
                <!-- Category Switcher Pill (Perorangan Active -> Switch to Perusahaan) -->
                <div class="inline-flex items-center p-1 bg-black/25 backdrop-blur-md rounded-full border border-white/20 shadow-lg">
                    <a href="{{ route('mitra.pengemudi') }}" 
                       class="px-5 py-2 rounded-full text-xs sm:text-sm bg-white text-primary-700 font-black shadow-md transition-all">
                        Perorangan (Pengemudi)
                    </a>
                    <a href="{{ route('mitra.armada') }}" 
                       class="px-5 py-2 rounded-full text-xs sm:text-sm text-white/80 hover:text-white font-semibold transition-all">
                        Perusahaan / Lembaga
                    </a>
                </div>

                <!-- Main Headline -->
                <h1 class="text-3xl sm:text-5xl lg:text-6xl font-black leading-[1.15] drop-shadow-lg text-white">
                    Menjadi <span class="text-teal-200">Pengemudi Siaga</span> <br class="hidden sm:block">
                    Ambulans
                </h1>

                <!-- Subtitle -->
                <p class="text-lg sm:text-xl text-sky-100 max-w-xl mx-auto lg:mx-0 leading-relaxed font-medium">
                    Bergabung menjadi pahlawan kemanusiaan dalam jaringan layanan ambulans yang membantu masyarakat mendapatkan pertolongan medis dengan lebih cepat, aman, dan terkoordinasi.
                </p>

                <!-- CTA Group -->
                <div class="flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-4 pt-2">
                    <a href="{{ route('register.supir') }}" 
                       class="w-full sm:w-auto group relative inline-flex justify-center items-center gap-2 bg-white text-primary-700 px-8 py-4 rounded-full font-black text-lg hover:bg-slate-50 transition-all shadow-[0_8px_30px_rgb(0,0,0,0.2)] hover:scale-105">
                        <span>Daftar Sebagai Pengemudi</span>
                        <svg class="w-5 h-5 text-primary-600 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </a>
                    
                    <a href="{{ route('login') }}" 
                       class="w-full sm:w-auto inline-flex justify-center items-center gap-2 bg-white/10 backdrop-blur-sm border-2 border-white/40 text-white px-7 py-4 rounded-full font-bold text-base hover:bg-white/20 hover:border-white transition-all">
                        <span>Masuk ke Web Portal</span>
                    </a>
                </div>
            </div>

            <!-- Right Content Visual -->
            <div class="lg:w-[45%] relative h-[420px] w-full hidden md:block">
                <!-- Floating top badge -->
                <div class="absolute top-2 right-4 bg-white/20 backdrop-blur-md p-4 rounded-2xl shadow-2xl z-30 flex items-center gap-4 w-64 border border-white/30">
                    <div class="w-12 h-12 bg-white rounded-full flex items-center justify-center shrink-0 shadow-inner text-emerald-600">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                    </div>
                    <div>
                        <p class="text-xs font-medium text-white/80">Pahlawan Relawan</p>
                        <p class="text-sm font-black text-white">Tanggap Darurat</p>
                    </div>
                </div>

                <div class="relative bg-white/10 backdrop-blur-sm p-3 rounded-3xl border border-white/20 shadow-2xl mt-8">
                    <img src="{{ asset('images/mitra.JPG') }}" 
                         alt="Pengemudi Ambulans Siaga" 
                         class="w-full h-80 object-cover rounded-2xl shadow-lg">
                </div>

                <!-- Floating bottom badge -->
                <div class="absolute bottom-2 left-2 bg-white p-4 rounded-2xl shadow-2xl z-30 flex items-center gap-4 w-64 border border-slate-100 animate-pulse">
                    <div class="w-12 h-12 bg-primary-600/10 text-primary-600 rounded-full flex items-center justify-center shrink-0">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                    </div>
                    <div>
                        <p class="text-sm font-black text-slate-800">Sistem Pintar</p>
                        <p class="text-xs font-semibold text-slate-500">Navigasi Rute Cepat</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Section 2: Keunggulan Pengemudi (Curved Primary Banner) -->
    <section class="py-12 md:py-16 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            <!-- Curved Primary Teal Container -->
            <div class="relative bg-gradient-to-br from-primary-700 via-[#009CA6] to-[#0F2747] rounded-[2.5rem] sm:rounded-[3.5rem] p-8 sm:p-12 md:p-16 text-white shadow-2xl overflow-hidden">
                
                <!-- Background Pattern Curves -->
                <div class="absolute -right-20 -top-20 w-80 h-80 bg-white/10 rounded-full blur-3xl pointer-events-none"></div>
                <div class="absolute -left-20 -bottom-20 w-80 h-80 bg-black/10 rounded-full blur-3xl pointer-events-none"></div>

                <div class="relative z-10">
                    <!-- Title -->
                    <h2 class="text-2xl sm:text-3xl md:text-4xl font-black text-center text-white tracking-tight mb-10 md:mb-14">
                        Keuntungan Bergabung Menjadi Pengemudi Siaga
                    </h2>

                    <!-- 3 Feature White Cards -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 lg:gap-8 mb-10">
                        
                        <!-- Card 1: Waktu Fleksibel -->
                        <div class="bg-white rounded-3xl p-6 sm:p-8 text-slate-800 shadow-xl border border-white/40 flex flex-col items-start hover:-translate-y-1.5 transition-all duration-300">
                            <h3 class="text-xl font-black text-[#0F2747] mb-2.5">Waktu Fleksibel</h3>
                            <p class="text-slate-600 text-sm font-medium leading-relaxed">
                                Anda dapat menerima penugasan darurat kapan pun Anda memiliki waktu luang dan mengaktifkan status "Siaga Online".
                            </p>
                        </div>

                        <!-- Card 2: Sistem Penugasan Pintar -->
                        <div class="bg-white rounded-3xl p-6 sm:p-8 text-slate-800 shadow-xl border border-white/40 flex flex-col items-start hover:-translate-y-1.5 transition-all duration-300">
                            <h3 class="text-xl font-black text-[#0F2747] mb-2.5">Sistem Pintar</h3>
                            <p class="text-slate-600 text-sm font-medium leading-relaxed">
                                Tidak perlu bingung mencari jalan. Aplikasi memandu Anda menuju lokasi jemput pasien dan rumah sakit tujuan dengan akurat.
                            </p>
                        </div>

                        <!-- Card 3: Pahlawan Kemanusiaan -->
                        <div class="bg-white rounded-3xl p-6 sm:p-8 text-slate-800 shadow-xl border border-white/40 flex flex-col items-start hover:-translate-y-1.5 transition-all duration-300">
                            <h3 class="text-xl font-black text-[#0F2747] mb-2.5">Aksi Kemanusiaan</h3>
                            <p class="text-slate-600 text-sm font-medium leading-relaxed">
                                Waktu dan tenaga yang Anda berikan berdampak langsung dalam menyelamatkan nyawa seseorang di saat paling kritis.
                            </p>
                        </div>

                    </div>

                    <!-- Bottom Note -->
                    <div class="flex items-center justify-center gap-3 max-w-3xl mx-auto text-center text-xs sm:text-sm font-medium text-white/90 bg-white/10 backdrop-blur-md px-6 py-3.5 rounded-2xl border border-white/20">
                        <svg class="w-4 h-4 text-teal-300 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        <span>Ambulans Siaga memastikan seluruh pengemudi terverifikasi secara resmi demi menjamin keselamatan dan kenyamanan pasien selama perjalanan.</span>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <!-- Section 3: Data dan Dokumen yang Dibutuhkan (Driver / Perorangan) -->
    <section id="data-dokumen" class="py-12 md:py-20 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            
            <!-- Section Header with Category Switcher -->
            <div class="text-center max-w-3xl mx-auto mb-12 md:mb-16 space-y-4">
                <h2 class="text-3xl sm:text-4xl md:text-5xl font-black text-[#0F2747] tracking-tight">
                    Data dan dokumen yang <span class="text-primary-600">dibutuhkan</span>
                </h2>
                <p class="text-sm sm:text-base font-semibold text-slate-600">
                    Persyaratan pendaftaran: <span class="font-black text-primary-700 uppercase">Pengemudi Ambulans (Perorangan)</span>
                </p>
                
                <div class="inline-flex items-center p-1 bg-slate-100 rounded-full border border-slate-200 shadow-xs">
                    <a href="{{ route('mitra.pengemudi') }}" 
                       class="px-5 py-1.5 rounded-full text-xs sm:text-sm bg-primary-600 text-white font-bold shadow-sm transition-all">
                        Perorangan (Pengemudi)
                    </a>
                    <a href="{{ route('mitra.armada') }}" 
                       class="px-5 py-1.5 rounded-full text-xs sm:text-sm text-slate-600 hover:text-primary-700 font-semibold transition-all">
                        Perusahaan / Lembaga
                    </a>
                </div>
            </div>

            <!-- Milestone Card Container (White container with soft pattern) -->
            <div class="relative bg-white rounded-[2.5rem] border border-slate-200/80 p-8 sm:p-12 md:p-16 shadow-xl shadow-slate-200/50 overflow-hidden">
                
                <!-- Background soft ambient circles -->
                <div class="absolute -top-24 -left-24 w-72 h-72 bg-primary-50/60 rounded-full blur-2xl pointer-events-none"></div>
                <div class="absolute -bottom-24 -right-24 w-72 h-72 bg-teal-50/60 rounded-full blur-2xl pointer-events-none"></div>

                <!-- 3 Steps Timeline Grid -->
                <div class="relative z-10 grid grid-cols-1 md:grid-cols-3 gap-10 md:gap-8">
                    
                    <!-- Connector line behind badges (desktop only) -->
                    <div class="hidden md:block absolute top-[22px] left-[15%] right-[15%] h-0.5 bg-slate-200 -z-0"></div>

                    <!-- STEP 1: Identitas Pribadi -->
                    <div class="flex flex-col items-center text-center">
                        <div class="w-11 h-11 rounded-2xl bg-primary-600 text-white font-black text-sm flex items-center justify-center mb-5 shadow-md shadow-primary-600/20 relative z-10">
                            01
                        </div>

                        <h3 class="text-xl font-black text-[#0F2747] mb-4">
                            Identitas Driver
                        </h3>

                        <ul class="text-left space-y-3 text-xs sm:text-sm text-slate-600 font-medium max-w-xs">
                            <li class="flex items-start gap-2.5">
                                <svg class="w-4 h-4 text-emerald-600 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                                <span>Kartu Tanda Penduduk (KTP) Asli</span>
                            </li>
                            <li class="flex items-start gap-2.5">
                                <svg class="w-4 h-4 text-emerald-600 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                                <span>Nomor HP / WhatsApp aktif</span>
                            </li>
                            <li class="flex items-start gap-2.5">
                                <svg class="w-4 h-4 text-emerald-600 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                                <span>Alamat email aktif untuk akun login</span>
                            </li>
                            <li class="flex items-start gap-2.5">
                                <svg class="w-4 h-4 text-emerald-600 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                                <span>Pas foto terbaru (tampilan rapi)</span>
                            </li>
                        </ul>
                    </div>

                    <!-- STEP 2: SIM & Kendaraan -->
                    <div class="flex flex-col items-center text-center">
                        <div class="w-11 h-11 rounded-2xl bg-primary-600 text-white font-black text-sm flex items-center justify-center mb-5 shadow-md shadow-primary-600/20 relative z-10">
                            02
                        </div>

                        <h3 class="text-xl font-black text-[#0F2747] mb-4">
                            SIM & Kendaraan
                        </h3>

                        <ul class="text-left space-y-3 text-xs sm:text-sm text-slate-600 font-medium max-w-xs">
                            <li class="flex items-start gap-2.5">
                                <svg class="w-4 h-4 text-emerald-600 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                                <span>SIM A / B1 yang masih aktif & sah</span>
                            </li>
                            <li class="flex items-start gap-2.5">
                                <svg class="w-4 h-4 text-emerald-600 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                                <span>Foto lembar STNK & pajak aktif</span>
                            </li>
                            <li class="flex items-start gap-2.5">
                                <svg class="w-4 h-4 text-emerald-600 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                                <span>Data plat nomor & tipe kendaraan</span>
                            </li>
                        </ul>
                    </div>

                    <!-- STEP 3: Dokumen Keamanan (SKCK) -->
                    <div class="flex flex-col items-center text-center">
                        <div class="w-11 h-11 rounded-2xl bg-primary-600 text-white font-black text-sm flex items-center justify-center mb-5 shadow-md shadow-primary-600/20 relative z-10">
                            03
                        </div>

                        <h3 class="text-xl font-black text-[#0F2747] mb-4">
                            Dokumen SKCK
                        </h3>

                        <ul class="text-left space-y-3 text-xs sm:text-sm text-slate-600 font-medium max-w-xs">
                            <li class="flex items-start gap-2.5">
                                <svg class="w-4 h-4 text-emerald-600 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                                <span>SKCK resmi aktif dari Kepolisian (Wajib)</span>
                            </li>
                            <li class="flex items-start gap-2.5">
                                <svg class="w-4 h-4 text-emerald-600 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                                <span>Foto fisik lembar SKCK asli & masih berlaku</span>
                            </li>
                        </ul>
                    </div>

                </div>

            </div>
        </div>
    </section>

    <!-- Section 4: Warning & CTA Banner Bawah -->
    <section class="py-6 md:py-10 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto space-y-8">
            
            <!-- Warning Box -->
            <div class="bg-amber-50/80 border border-amber-200/80 rounded-3xl p-6 sm:p-8 flex items-start gap-4 shadow-sm">
                <div class="w-10 h-10 rounded-2xl bg-amber-500 text-white flex items-center justify-center shrink-0 font-black text-base shadow-sm">
                    !
                </div>
                <div class="space-y-1">
                    <h4 class="text-base sm:text-lg font-black text-amber-950 uppercase tracking-tight">
                        PENTING!
                    </h4>
                    <p class="text-xs sm:text-sm font-semibold text-amber-900/90 leading-relaxed">
                        Pastikan seluruh data SIM dan dokumen identitas Anda masih berlaku untuk mempercepat proses persetujuan verifikasi akun Pengemudi Siaga.
                    </p>
                </div>
            </div>

            <!-- Call to Action Banner (Opsi C: 3 Langkah Cepat + Watermark Logo Emboss) -->
            <div class="relative bg-gradient-to-br from-primary-700 via-[#009CA6] to-[#0F2747] rounded-[2.5rem] sm:rounded-[3.5rem] p-8 sm:p-12 md:p-14 text-white shadow-2xl overflow-hidden">
                
                <!-- Ambient Glow & Watermark Logo Emboss -->
                <div class="absolute -right-16 -bottom-16 w-96 h-96 bg-white/10 rounded-full blur-3xl pointer-events-none"></div>
                <div class="absolute -right-8 -top-8 w-64 h-64 bg-teal-400/10 rounded-full blur-2xl pointer-events-none"></div>
                <img src="{{ asset('images/logo_ambulansiaga.png') }}" alt="" class="absolute -right-10 -bottom-10 w-72 h-72 object-contain opacity-5 pointer-events-none -rotate-12 select-none">

                <div class="relative z-10 flex flex-col lg:flex-row items-center justify-between gap-10">
                    
                    <!-- Left: Headline, Hashtag, Button -->
                    <div class="space-y-6 text-center lg:text-left max-w-xl">
                        <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-white/15 backdrop-blur-md border border-white/25 text-xs font-bold text-teal-100">
                            <span class="w-2 h-2 rounded-full bg-emerald-400 animate-ping"></span>
                            <span>Pendaftaran Driver Terbuka</span>
                        </div>
                        <h3 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-black text-white leading-[1.2] tracking-tight">
                            Siaga mengantarkan harapan, yuk gabung jadi Pengemudi sekarang! <br>
                            <span class="text-teal-200">#PahlawanKemanusiaan</span>
                        </h3>
                        
                        <div class="pt-2">
                            <a href="{{ route('register.supir') }}" 
                               class="inline-flex items-center justify-center gap-3 px-8 py-4 rounded-full bg-white hover:bg-slate-50 text-primary-700 font-black text-base shadow-xl hover:shadow-2xl transition-all transform active:scale-95">
                                <span>Daftar Sebagai Pengemudi</span>
                                <svg class="w-5 h-5 text-primary-600" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"/></svg>
                            </a>
                        </div>
                    </div>

                    <!-- Right: Quick 3-Step Journey Card -->
                    <div class="w-full lg:w-80 shrink-0">
                        <div class="bg-white/10 backdrop-blur-md rounded-3xl p-6 border border-white/20 shadow-xl space-y-4">
                            <div class="flex items-center justify-between border-b border-white/15 pb-3">
                                <span class="text-[11px] font-black uppercase tracking-wider text-teal-200">Alur Bergabung</span>
                                <span class="text-[10px] font-bold text-white/80 px-2 py-0.5 rounded-full bg-white/10">3 Langkah Cepat</span>
                            </div>

                            <div class="space-y-3.5 text-left">
                                <!-- Step 1 -->
                                <div class="flex items-start gap-3">
                                    <div class="w-7 h-7 rounded-lg bg-teal-400/20 border border-teal-300/40 text-teal-200 font-black text-xs flex items-center justify-center shrink-0 mt-0.5">
                                        1
                                    </div>
                                    <div>
                                        <p class="text-xs font-black text-white">Isi Formulir Online</p>
                                        <p class="text-[11px] text-sky-100/80 font-medium">Unggah SIM, e-KTP & berkas pendukung</p>
                                    </div>
                                </div>

                                <!-- Step 2 -->
                                <div class="flex items-start gap-3">
                                    <div class="w-7 h-7 rounded-lg bg-teal-400/20 border border-teal-300/40 text-teal-200 font-black text-xs flex items-center justify-center shrink-0 mt-0.5">
                                        2
                                    </div>
                                    <div>
                                        <p class="text-xs font-black text-white">Verifikasi Dokumen</p>
                                        <p class="text-[11px] text-sky-100/80 font-medium">Validasi cepat data oleh tim Siaga</p>
                                    </div>
                                </div>

                                <!-- Step 3 -->
                                <div class="flex items-start gap-3">
                                    <div class="w-7 h-7 rounded-lg bg-teal-400/20 border border-teal-300/40 text-teal-200 font-black text-xs flex items-center justify-center shrink-0 mt-0.5">
                                        3
                                    </div>
                                    <div>
                                        <p class="text-xs font-black text-white">Aktif & Siap Bertugas</p>
                                        <p class="text-[11px] text-sky-100/80 font-medium">Mulai terima penugasan darurat</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </section>

    <!-- Section 5: Modal Pemilihan Jenis Kemitraan -->
    <div x-show="showTypeModal" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 z-50 overflow-y-auto flex items-center justify-center p-4 sm:p-6 bg-slate-900/60 backdrop-blur-sm"
         style="display: none;">

        <div @click.outside="showTypeModal = false"
             x-show="showTypeModal"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 scale-95 translate-y-4"
             x-transition:enter-end="opacity-100 scale-100 translate-y-0"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100 scale-100 translate-y-0"
             x-transition:leave-end="opacity-0 scale-95 translate-y-4"
             class="relative bg-white rounded-[2.5rem] max-w-4xl w-full p-6 sm:p-10 md:p-12 shadow-2xl border border-slate-100 overflow-hidden">
            
            <button type="button" 
                    @click="showTypeModal = false" 
                    class="absolute top-6 right-6 w-10 h-10 rounded-full bg-slate-100 hover:bg-slate-200 text-slate-500 hover:text-slate-800 flex items-center justify-center transition-colors cursor-pointer"
                    title="Tutup">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>

            <div class="text-center mb-8 sm:mb-10">
                <h3 class="text-2xl sm:text-3xl md:text-4xl font-black text-[#0F2747] tracking-tight">
                    Pilih jenis kemitraan Anda
                </h3>
                <p class="text-xs sm:text-sm font-semibold text-slate-500 mt-1.5">
                    Pendaftaran gratis tidak dipungut biaya
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 sm:gap-8">
                
                <!-- Card 1: Perorangan (Pengemudi) -->
                <div class="bg-sky-50/70 hover:bg-sky-50 border border-sky-200/80 rounded-3xl p-6 sm:p-8 flex flex-col justify-between relative overflow-hidden transition-all group shadow-sm">
                    <div class="space-y-4">
                        <div class="inline-block px-3 py-1 rounded-full bg-primary-600/10 text-primary-700 text-[11px] font-black uppercase">
                            Pengemudi Relawan
                        </div>
                        <h4 class="text-2xl font-black text-[#0F2747]">Perorangan (Pengemudi)</h4>
                        <p class="text-xs sm:text-sm font-medium text-slate-700 leading-relaxed">
                            Pendaftaran hanya lima menit. Siapkan KTP, SIM A/B1, dan ikuti proses verifikasi pengemudi secara online.
                        </p>
                    </div>

                    <div class="mt-8 space-y-3">
                        <a href="{{ route('register.supir') }}" 
                           class="w-full inline-flex items-center justify-center gap-2 py-3 px-6 rounded-full bg-primary-600 hover:bg-primary-700 text-white font-extrabold text-sm shadow-md hover:shadow-lg shadow-primary-600/20 transition-all">
                            <span>Daftar Pengemudi</span>
                            <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
                        </a>
                        
                        <a href="{{ route('mitra.pengemudi') }}" 
                           class="block w-full text-center text-xs font-bold text-slate-700 hover:text-primary-700 py-1">
                            Pelajari lebih lanjut &gt;
                        </a>
                    </div>

                    <div class="absolute bottom-2 right-2 opacity-5 pointer-events-none">
                        <svg class="w-28 h-28" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/></svg>
                    </div>
                </div>

                <!-- Card 2: Perusahaan / Lembaga (Mitra Armada) -->
                <div class="bg-amber-50/70 hover:bg-amber-50 border border-amber-200/80 rounded-3xl p-6 sm:p-8 flex flex-col justify-between relative overflow-hidden transition-all group shadow-sm">
                    <div class="space-y-4">
                        <div class="inline-block px-3 py-1 rounded-full bg-amber-600/15 text-amber-900 text-[11px] font-black uppercase">
                            Badan Hukum / Yayasan
                        </div>
                        <h4 class="text-2xl font-black text-[#0F2747]">Perusahaan / Lembaga</h4>
                        <p class="text-xs sm:text-sm font-medium text-slate-700 leading-relaxed">
                            Untuk mitra berbadan hukum, RS, Klinik, Yayasan, atau Ormas. Daftarkan armada ambulans Anda untuk bergabung dalam jaringan Siaga.
                        </p>
                    </div>

                    <div class="mt-8 space-y-3">
                        <a href="{{ route('register.mitra') }}" 
                           class="w-full inline-flex items-center justify-center gap-2 py-3 px-6 rounded-full bg-[#0F2747] hover:bg-[#1a3a66] text-white font-extrabold text-sm shadow-md hover:shadow-lg transition-all">
                            <span>Daftar Mitra Armada</span>
                            <svg class="w-4 h-4 text-slate-300 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
                        </a>
                        
                        <a href="{{ route('mitra.armada') }}" 
                           class="block w-full text-center text-xs font-bold text-slate-700 hover:text-amber-900 py-1">
                            Pelajari lebih lanjut &gt;
                        </a>
                    </div>

                    <div class="absolute bottom-2 right-2 opacity-5 pointer-events-none">
                        <svg class="w-28 h-28" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M4 4a2 2 0 012-2h8a2 2 0 012 2v12a1 1 0 110 2h-3a1 1 0 01-1-1v-2a1 1 0 00-1-1H9a1 1 0 00-1 1v2a1 1 0 01-1 1H4a1 1 0 110-2V4zm3 1h2v2H7V5zm2 4H7v2h2V9zm2-4h2v2h-2V5zm2 4h-2v2h2V9z" clip-rule="evenodd"/></svg>
                    </div>
                </div>

            </div>

        </div>
    </div>

    <!-- Footer Landing -->
    <x-landing-footer />
</div>

