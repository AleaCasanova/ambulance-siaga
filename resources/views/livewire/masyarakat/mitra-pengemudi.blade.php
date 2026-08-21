<div>
    <!-- Section 1: Hero -->
    <section class="relative pt-40 pb-48 px-6 lg:px-12 overflow-hidden bg-primary-600" style="background-image: url('{{ asset('images/beranda_utama_bg.jpg') }}'); background-size: cover; background-position: center; background-repeat: no-repeat;">
        <!-- Gradient Overlay: Mix of Cyan and White -->
        <div class="absolute inset-0 bg-gradient-to-r from-primary-600 via-[#009CA6]/80 to-white/60 mix-blend-multiply"></div>
        <div class="absolute inset-0 bg-gradient-to-r from-primary-600 via-[#009CA6]/80 to-white/60"></div>
        
        <!-- Bottom Fade to White (since next section is bg-white) -->
        <div class="absolute inset-x-0 bottom-0 h-32 bg-gradient-to-t from-white to-transparent"></div>

        <div class="max-w-7xl mx-auto flex flex-col lg:flex-row items-center gap-12 relative z-10">
            <!-- Left Text Content -->
            <div class="lg:w-[55%] text-white z-10 text-center lg:text-left">
                <!-- Top Badge matching Beranda -->
                <div class="inline-flex items-center gap-2 mb-6 bg-white/10 backdrop-blur px-4 py-2 rounded-full border border-white/20 shadow-xl">
                    <svg class="w-5 h-5 text-yellow-300" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                    <span class="font-bold tracking-wider text-xs uppercase text-white">Pendaftaran Mitra Terbuka</span>
                </div>
                
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-black leading-[1.15] mb-6 drop-shadow-lg text-white">
                    Menjadi Pengemudi <br class="hidden lg:block">
                    <span class="text-teal-200">Siaga Ambulans</span>
                </h1>
                
                <p class="text-lg sm:text-xl text-sky-100 mb-10 max-w-2xl mx-auto lg:mx-0 leading-relaxed font-medium">
                    Bergabung menjadi bagian dari jaringan layanan ambulans yang membantu masyarakat mendapatkan pertolongan dengan lebih cepat dan aman.
                </p>
                
                <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start">
                    <a href="{{ route('register.supir') }}" class="group relative inline-flex justify-center items-center gap-2 bg-white text-primary-600 px-8 py-4 rounded-full font-bold text-lg hover:bg-slate-50 transition-all shadow-[0_8px_30px_rgb(0,0,0,0.2)] hover:scale-105">
                        Daftar Sebagai Pengemudi
                        <svg class="w-6 h-6 text-primary-600 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                    </a>
                </div>
            </div>
            
            <!-- Right Content -->
            <div class="lg:w-[45%] relative h-[450px] w-full hidden md:block">
                <!-- Floating badge matching user's glassmorphism screenshot -->
                <div class="absolute bottom-20 right-0 bg-white/20 backdrop-blur-md p-4 rounded-2xl shadow-2xl z-30 flex items-center gap-4 w-60 border border-white/30 animate-[bounce_4s_ease-in-out_infinite]">
                    <div class="w-14 h-14 bg-white rounded-full flex items-center justify-center shrink-0 shadow-inner">
                        <svg class="w-7 h-7 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-white/90">Jaringan</p>
                        <p class="text-lg font-black text-white">Ambulans Siaga</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Section 2: Kenapa Bergabung? -->
    <section class="py-24 px-6 lg:px-12 bg-white">
        <div class="max-w-7xl mx-auto">
            <div class="text-center max-w-3xl mx-auto mb-16 lg:mb-20">
                <h2 class="text-3xl md:text-4xl font-black text-[#0F2747] tracking-tight mb-6">
                    Kenapa Bergabung Bersama<br class="hidden sm:block"> Ambulans Siaga?
                </h2>
                <p class="text-lg text-slate-600 font-medium">
                    Menjadi bagian dari jaringan layanan ambulans terpadu yang berdedikasi membantu masyarakat dengan cepat dan tepat sasaran.
                </p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <!-- Card 1 -->
                <div class="bg-white p-8 rounded-3xl shadow-[0_4px_20px_-4px_rgba(0,0,0,0.05)] hover:shadow-[0_8px_30px_-4px_rgba(0,156,166,0.15)] hover:-translate-y-2 transition-all duration-300 border border-slate-100 group">
                    <div class="w-14 h-14 bg-primary-600/10 text-primary-600 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                    </div>
                    <h3 class="text-xl font-bold text-[#0F2747] mb-3">Pahlawan Kemanusiaan</h3>
                    <p class="text-slate-600 font-medium leading-relaxed">
                        Waktu dan tenaga yang Anda berikan berdampak langsung dalam menyelamatkan nyawa seseorang di saat paling kritis.
                    </p>
                </div>

                <!-- Card 2 -->
                <div class="bg-white p-8 rounded-3xl shadow-[0_4px_20px_-4px_rgba(0,0,0,0.05)] hover:shadow-[0_8px_30px_-4px_rgba(0,156,166,0.15)] hover:-translate-y-2 transition-all duration-300 border border-slate-100 group">
                    <div class="w-14 h-14 bg-primary-600/10 text-primary-600 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/></svg>
                    </div>
                    <h3 class="text-xl font-bold text-[#0F2747] mb-3">Sistem Penugasan Pintar</h3>
                    <p class="text-slate-600 font-medium leading-relaxed">
                        Tidak perlu bingung mencari rute. Aplikasi akan memandu Anda ke lokasi jemput pasien dan rumah sakit tujuan dengan akurat.
                    </p>
                </div>

                <!-- Card 3 -->
                <div class="bg-white p-8 rounded-3xl shadow-[0_4px_20px_-4px_rgba(0,0,0,0.05)] hover:shadow-[0_8px_30px_-4px_rgba(0,156,166,0.15)] hover:-translate-y-2 transition-all duration-300 border border-slate-100 group">
                    <div class="w-14 h-14 bg-primary-600/10 text-primary-600 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/></svg>
                    </div>
                    <h3 class="text-xl font-bold text-[#0F2747] mb-3">Keluarga Besar Relawan</h3>
                    <p class="text-slate-600 font-medium leading-relaxed">
                        Bergabung dan kembangkan jaringan solidaritas bersama ratusan relawan serta tenaga kesehatan profesional lainnya.
                    </p>
                </div>

                <!-- Card 4 -->
                <div class="bg-white p-8 rounded-3xl shadow-[0_4px_20px_-4px_rgba(0,0,0,0.05)] hover:shadow-[0_8px_30px_-4px_rgba(0,156,166,0.15)] hover:-translate-y-2 transition-all duration-300 border border-slate-100 group">
                    <div class="w-14 h-14 bg-primary-600/10 text-primary-600 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <h3 class="text-xl font-bold text-[#0F2747] mb-3">Waktu Fleksibel (Siaga)</h3>
                    <p class="text-slate-600 font-medium leading-relaxed">
                        Anda dapat menerima penugasan darurat kapan pun Anda memiliki waktu luang dan berada dalam status "Siaga".
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Section 3: Story / Human Impact -->
    <section class="py-24 px-6 lg:px-12 bg-slate-50 border-y border-slate-100">
        <div class="max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-20 items-center">
            <div class="order-2 lg:order-1 relative group">
                <!-- Decorative element -->
                <div class="absolute -inset-4 bg-[#0F2747]/5 rounded-[2.5rem] transform rotate-3 scale-105 transition-transform group-hover:rotate-1"></div>
                <!-- Carousel Container -->
                <div class="relative rounded-[2rem] overflow-hidden shadow-2xl h-[450px] md:h-[550px]" 
                     x-data="{ 
                        currentSlide: 0, 
                        slides: [
                            { image: '{{ asset('images/mitra.JPG') }}', quote: 'Melihat senyum lega keluarga pasien saat tiba di rumah sakit tepat waktu adalah bayaran yang tak ternilai.' },
                            { image: '{{ asset('images/dokumgsc (27).JPG') }}', quote: 'Tangan Anda adalah perpanjangan dari kepedulian sesama di saat paling kritis.' },
                            { image: '{{ asset('images/dokumgsc (7).JPG') }}', quote: 'Setiap putaran roda yang Anda kemudikan membawa harapan bagi kehidupan.' }
                        ] 
                     }" 
                     x-init="setInterval(() => currentSlide = (currentSlide + 1) % slides.length, 5000)">
                    
                    <template x-for="(slide, index) in slides" :key="index">
                        <div class="absolute inset-0 transition-opacity duration-1000 ease-in-out" 
                             x-show="currentSlide === index" 
                             x-transition:enter="transition-opacity duration-1000"
                             x-transition:enter-start="opacity-0"
                             x-transition:enter-end="opacity-100"
                             x-transition:leave="transition-opacity duration-1000"
                             x-transition:leave-start="opacity-100"
                             x-transition:leave-end="opacity-0">
                            <img :src="slide.image" alt="Pahlawan Kemanusiaan" class="w-full h-full object-cover">
                            <!-- overlay -->
                            <div class="absolute inset-0 bg-gradient-to-t from-[#0F2747]/90 via-[#0F2747]/20 to-transparent"></div>
                            <div class="absolute bottom-16 left-8 right-8 text-white">
                                <p class="font-medium text-lg md:text-xl opacity-95 italic leading-relaxed" x-text="`&quot;${slide.quote}&quot;`"></p>
                            </div>
                        </div>
                    </template>
                    
                    <!-- Carousel Indicators -->
                    <div class="absolute bottom-6 left-0 right-0 flex justify-center gap-3 z-10">
                        <template x-for="(slide, index) in slides" :key="index">
                            <button @click="currentSlide = index" 
                                    class="h-2 rounded-full transition-all duration-300"
                                    :class="currentSlide === index ? 'w-8 bg-primary-600' : 'w-2 bg-white/50 hover:bg-white/80'">
                            </button>
                        </template>
                    </div>
                </div>
            </div>
            
            <div class="order-1 lg:order-2 space-y-8">
                <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-primary-600/10 text-primary-600 font-bold text-sm uppercase tracking-wider">
                    Panggilan Kemanusiaan
                </div>
                <h2 class="text-3xl md:text-4xl lg:text-5xl font-black text-[#0F2747] leading-[1.2] tracking-tight">
                    Mengantarkan Harapan, Menyelamatkan Nyawa
                </h2>
                <div class="w-20 h-1.5 bg-primary-600 rounded-full"></div>
                <p class="text-lg md:text-xl text-slate-600 font-medium leading-relaxed">
                    Menjadi pengemudi Siaga Ambulans bukan sekadar memegang kemudi, melainkan hadir membawa ketenangan di momen genting. Anda adalah pahlawan yang memastikan pasien mendapatkan akses kesehatan tepat waktu.
                </p>
            </div>
        </div>
    </section>

    <!-- Section 4: Cara Bergabung -->
    <section class="py-24 px-6 lg:px-12 bg-slate-50 border-y border-slate-100 overflow-hidden">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-16 lg:mb-24">
                <h2 class="text-3xl md:text-4xl font-black text-[#0F2747] tracking-tight mb-4">
                    Bagaimana Cara Bergabung?
                </h2>
                <p class="text-lg text-slate-600 font-medium">Proses mudah dan cepat untuk mulai menjadi mitra.</p>
            </div>

            <!-- Timeline Container -->
            <div class="relative max-w-5xl mx-auto">
                <!-- Line background for desktop -->
                <div class="hidden lg:block absolute top-10 left-0 w-full h-1 bg-slate-200 z-0 rounded-full"></div>
                <!-- Line background for mobile -->
                <div class="lg:hidden absolute top-0 left-[2.35rem] w-1 h-full bg-slate-200 z-0 rounded-full"></div>

                <div class="grid grid-cols-1 lg:grid-cols-4 gap-12 lg:gap-8 relative z-10">
                    <!-- Step 1 -->
                    <div class="relative flex lg:flex-col gap-6 lg:gap-6 items-start lg:items-center text-left lg:text-center group">
                        <div class="w-20 h-20 shrink-0 bg-white border-4 border-slate-100 rounded-full flex items-center justify-center text-2xl font-black text-slate-400 shadow-sm group-hover:border-primary-600 group-hover:text-primary-600 transition-all duration-300">
                            01
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-[#0F2747] mb-3 lg:mt-2">Daftar</h3>
                            <p class="text-slate-600 font-medium leading-relaxed">Isi data diri dan informasi armada yang diperlukan secara online di platform kami.</p>
                        </div>
                    </div>

                    <!-- Step 2 -->
                    <div class="relative flex lg:flex-col gap-6 lg:gap-6 items-start lg:items-center text-left lg:text-center group">
                        <div class="w-20 h-20 shrink-0 bg-white border-4 border-slate-100 rounded-full flex items-center justify-center text-2xl font-black text-slate-400 shadow-sm group-hover:border-primary-600 group-hover:text-primary-600 transition-all duration-300">
                            02
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-[#0F2747] mb-3 lg:mt-2">Verifikasi</h3>
                            <p class="text-slate-600 font-medium leading-relaxed">Tim kami melakukan proses pemeriksaan dan verifikasi data yang telah Anda kirimkan.</p>
                        </div>
                    </div>

                    <!-- Step 3 -->
                    <div class="relative flex lg:flex-col gap-6 lg:gap-6 items-start lg:items-center text-left lg:text-center group">
                        <div class="w-20 h-20 shrink-0 bg-white border-4 border-slate-100 rounded-full flex items-center justify-center text-2xl font-black text-slate-400 shadow-sm group-hover:border-primary-600 group-hover:text-primary-600 transition-all duration-300">
                            03
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-[#0F2747] mb-3 lg:mt-2">Aktivasi</h3>
                            <p class="text-slate-600 font-medium leading-relaxed">Setelah proses verifikasi selesai dan disetujui, akun/kemitraan Anda diaktifkan.</p>
                        </div>
                    </div>

                    <!-- Step 4 -->
                    <div class="relative flex lg:flex-col gap-6 lg:gap-6 items-start lg:items-center text-left lg:text-center group">
                        <div class="w-20 h-20 shrink-0 bg-white border-4 border-slate-100 rounded-full flex items-center justify-center text-2xl font-black text-slate-400 shadow-sm group-hover:border-primary-600 group-hover:text-primary-600 transition-all duration-300">
                            04
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-[#0F2747] mb-3 lg:mt-2">Siap Bertugas</h3>
                            <p class="text-slate-600 font-medium leading-relaxed">Pengemudi siap menjadi bagian dari layanan Ambulans Siaga dan menerima tugas.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Section 5: Persyaratan -->
    <section class="py-24 px-6 lg:px-12 bg-white">
        <div class="max-w-6xl mx-auto">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-16 items-start">
                <!-- Left: Headline -->
                <div class="lg:col-span-5 sticky top-32">
                    <h2 class="text-3xl md:text-4xl font-black text-[#0F2747] tracking-tight mb-6">
                        Persyaratan Menjadi Pengemudi
                    </h2>
                    <p class="text-lg text-slate-600 font-medium mb-8 leading-relaxed">
                        Pastikan seluruh data dan dokumen yang dibutuhkan tersedia dan dapat diverifikasi agar proses pendaftaran berjalan lancar.
                    </p>
                    <div class="hidden lg:block w-48 h-48 bg-primary-600/5 rounded-full blur-3xl absolute -bottom-20 -left-20"></div>
                </div>

                <!-- Right: Checklist -->
                <div class="lg:col-span-7 bg-white border border-slate-200 p-8 md:p-12 rounded-3xl shadow-xl shadow-slate-200/40 relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-primary-600/5 rounded-bl-full"></div>
                    <ul class="space-y-6 relative z-10">
                        <li class="flex items-start gap-5">
                            <div class="mt-1 w-8 h-8 shrink-0 bg-emerald-100 text-emerald-600 rounded-full flex items-center justify-center shadow-sm">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                            </div>
                            <div>
                                <span class="text-lg text-[#0F2747] font-bold block mb-1">Identitas Pribadi</span>
                                <span class="text-slate-600 font-medium">KTP yang valid dan berlaku.</span>
                            </div>
                        </li>
                        <li class="flex items-start gap-5">
                            <div class="mt-1 w-8 h-8 shrink-0 bg-emerald-100 text-emerald-600 rounded-full flex items-center justify-center shadow-sm">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                            </div>
                            <div>
                                <span class="text-lg text-[#0F2747] font-bold block mb-1">Surat Izin Mengemudi (SIM)</span>
                                <span class="text-slate-600 font-medium">SIM A / B1 yang masih aktif dan sah.</span>
                            </div>
                        </li>
                        <li class="flex items-start gap-5">
                            <div class="mt-1 w-8 h-8 shrink-0 bg-emerald-100 text-emerald-600 rounded-full flex items-center justify-center shadow-sm">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                            </div>
                            <div>
                                <span class="text-lg text-[#0F2747] font-bold block mb-1">Surat Keterangan Sehat</span>
                                <span class="text-slate-600 font-medium">Bukti kelayakan fisik dan bebas buta warna dari faskes.</span>
                            </div>
                        </li>
                        <li class="flex items-start gap-5">
                            <div class="mt-1 w-8 h-8 shrink-0 bg-emerald-100 text-emerald-600 rounded-full flex items-center justify-center shadow-sm">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                            </div>
                            <div>
                                <span class="text-lg text-[#0F2747] font-bold block mb-1">SKCK (Catatan Kepolisian)</span>
                                <span class="text-slate-600 font-medium">Diperlukan untuk menjamin keamanan dan kenyamanan pasien.</span>
                            </div>
                        </li>
                        <li class="flex items-start gap-5">
                            <div class="mt-1 w-8 h-8 shrink-0 bg-emerald-100 text-emerald-600 rounded-full flex items-center justify-center shadow-sm">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                            </div>
                            <div>
                                <span class="text-lg text-[#0F2747] font-bold block mb-1">Sertifikat Pelatihan (Opsional)</span>
                                <span class="text-slate-600 font-medium">Sertifikat Basic Life Support (BLS) atau P3K dasar sebagai nilai tambah.</span>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Section 6: Final CTA (Floating Card Design) -->
    <section class="py-24 px-6 lg:px-12 bg-white relative z-20">
        <div class="max-w-5xl mx-auto relative">
            <!-- Background Glow behind the card -->
            <div class="absolute inset-0 bg-primary-600/20 blur-3xl rounded-full transform translate-y-10 scale-95 pointer-events-none"></div>
            
            <!-- Floating Card -->
            <div class="relative bg-gradient-to-br from-[#0F2747] to-[#1a3a66] rounded-[3rem] p-12 md:p-20 text-center shadow-[0_30px_60px_-15px_rgba(15,39,71,0.4)] overflow-hidden border border-white/10">
                <!-- Decorative Elements inside card -->
                <div class="absolute top-0 right-0 w-64 h-64 bg-primary-600/30 blur-[80px] rounded-full pointer-events-none -mt-10 -mr-10"></div>
                <div class="absolute bottom-0 left-0 w-64 h-64 bg-blue-500/20 blur-[80px] rounded-full pointer-events-none -mb-10 -ml-10"></div>
                
                <div class="relative z-10">
                    <h2 class="text-3xl md:text-5xl font-black text-white tracking-tight mb-6 leading-tight">
                        Siap Menjadi Pengemudi <span class="text-teal-300">Siaga?</span>
                    </h2>
                    <p class="text-lg md:text-xl text-sky-100/80 font-medium mb-10 max-w-2xl mx-auto leading-relaxed">
                        Bergabung bersama Ambulans Siaga dan menjadi bagian dari layanan yang membantu masyarakat mendapatkan pertolongan dengan lebih cepat.
                    </p>
                    <a href="{{ route('register.supir') }}" class="group relative inline-flex items-center justify-center gap-3 bg-primary-600 text-white px-10 py-5 rounded-full font-black text-xl hover:bg-teal-400 hover:text-slate-900 transition-all duration-300 shadow-xl hover:shadow-2xl hover:shadow-teal-400/30 hover:-translate-y-1">
                        Daftar Sebagai Pengemudi
                        <svg class="w-6 h-6 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <x-landing-footer />
</div>
