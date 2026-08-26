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
<<<<<<< HEAD
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
=======
            <!-- Left Text Content -->
            <div class="lg:w-[55%] text-white z-10 text-center lg:text-left">
                <!-- Top Badge matching Beranda -->
                <div class="inline-flex items-center gap-2 mb-4 sm:mb-6 bg-white/10 backdrop-blur px-3.5 py-1.5 sm:px-4 sm:py-2 rounded-full border border-white/20 shadow-xl">
                    <svg class="w-4 h-4 sm:w-5 sm:h-5 text-yellow-300" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                    <span class="font-bold tracking-wider text-[10px] sm:text-xs uppercase text-white">Pendaftaran Mitra Terbuka</span>
                </div>
                
                <h1 class="text-2xl sm:text-4xl lg:text-6xl font-black leading-tight sm:leading-[1.15] mb-4 sm:mb-6 drop-shadow-lg text-white">
                    Menjadi Pengemudi <br class="hidden lg:block">
                    <span class="text-teal-200">Siaga Ambulans</span>
                </h1>
                
                <p class="text-xs sm:text-base lg:text-lg text-sky-100 mb-6 sm:mb-10 max-w-2xl mx-auto lg:mx-0 leading-relaxed font-medium">
                    Bergabung menjadi bagian dari jaringan layanan ambulans yang membantu masyarakat mendapatkan pertolongan dengan lebih cepat dan aman.
                </p>
                
                <div class="flex flex-col sm:flex-row gap-3 sm:gap-4 justify-center lg:justify-start">
                    <a href="{{ route('register.supir') }}" class="group relative inline-flex justify-center items-center gap-2 bg-white text-primary-600 px-6 sm:px-8 py-3 sm:py-4 rounded-full font-bold text-xs sm:text-base hover:bg-slate-50 transition-all shadow-[0_8px_30px_rgb(0,0,0,0.2)] hover:scale-105">
                        Daftar Sebagai Pengemudi
                        <svg class="w-4 h-4 sm:w-6 sm:h-6 text-primary-600 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
>>>>>>> e00563d75a35805f971880b2f6a486b92e0fc414
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
    <!-- Section 2: Kenapa Bergabung? -->
    <section class="py-14 sm:py-24 px-6 lg:px-12 bg-white">
        <div class="max-w-7xl mx-auto">
            <div class="text-center max-w-3xl mx-auto mb-10 sm:mb-16 lg:mb-20">
                <h2 class="text-xl sm:text-3xl md:text-4xl font-black text-[#0F2747] tracking-tight mb-3 sm:mb-6">
                    Kenapa Bergabung Bersama<br class="hidden sm:block"> Ambulans Siaga?
                </h2>
                <p class="text-xs sm:text-base lg:text-lg text-slate-600 font-medium leading-relaxed">
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
                            <div class="w-14 h-14 rounded-2xl bg-emerald-50 text-emerald-600 flex items-center justify-center mb-6 shadow-sm">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <h3 class="text-xl sm:text-2xl font-black text-[#0F2747] mb-2">Waktu Fleksibel</h3>
                            <p class="text-slate-600 text-sm font-medium leading-relaxed">
                                Anda dapat menerima penugasan darurat kapan pun Anda memiliki waktu luang dan mengaktifkan status "Siaga Online".
                            </p>
                        </div>

                        <!-- Card 2: Sistem Penugasan Pintar -->
                        <div class="bg-white rounded-3xl p-6 sm:p-8 text-slate-800 shadow-xl border border-white/40 flex flex-col items-start hover:-translate-y-1.5 transition-all duration-300">
                            <div class="w-14 h-14 rounded-2xl bg-amber-50 text-amber-600 flex items-center justify-center mb-6 shadow-sm">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"/>
                                </svg>
                            </div>
                            <h3 class="text-xl sm:text-2xl font-black text-[#0F2747] mb-2">Sistem Pintar</h3>
                            <p class="text-slate-600 text-sm font-medium leading-relaxed">
                                Tidak perlu bingung mencari jalan. Aplikasi memandu Anda menuju lokasi jemput pasien dan rumah sakit tujuan dengan akurat.
                            </p>
                        </div>

                        <!-- Card 3: Pahlawan Kemanusiaan -->
                        <div class="bg-white rounded-3xl p-6 sm:p-8 text-slate-800 shadow-xl border border-white/40 flex flex-col items-start hover:-translate-y-1.5 transition-all duration-300">
                            <div class="w-14 h-14 rounded-2xl bg-primary-50 text-primary-600 flex items-center justify-center mb-6 shadow-sm">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                                </svg>
                            </div>
                            <h3 class="text-xl sm:text-2xl font-black text-[#0F2747] mb-2">Aksi Kemanusiaan</h3>
                            <p class="text-slate-600 text-sm font-medium leading-relaxed">
                                Waktu dan tenaga yang Anda berikan berdampak langsung dalam menyelamatkan nyawa seseorang di saat paling kritis.
                            </p>
                        </div>

                    </div>

                    <!-- Bottom Bulb Note -->
                    <div class="flex items-center justify-center gap-3 max-w-3xl mx-auto text-center text-xs sm:text-sm font-medium text-white/90 bg-white/10 backdrop-blur-md px-6 py-3 rounded-2xl border border-white/20">
                        <span class="text-lg">💡</span>
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
                    <div class="hidden md:block absolute top-[118px] left-[15%] right-[15%] h-0.5 bg-slate-200 -z-0"></div>

                    <!-- STEP 1: Identitas Pribadi -->
                    <div class="flex flex-col items-center text-center">
                        <div class="h-20 flex items-center justify-center mb-4">
                            <div class="w-16 h-12 rounded-xl bg-sky-100 border-2 border-sky-300 flex items-center justify-center shadow-sm relative">
                                <svg class="w-7 h-7 text-sky-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2"/></svg>
                                <div class="absolute -bottom-1.5 -right-1.5 w-5 h-5 rounded-full bg-emerald-500 text-white flex items-center justify-center text-[10px] font-black">✓</div>
                            </div>
                        </div>

                        <div class="w-10 h-10 rounded-full bg-primary-50 border-2 border-primary-600 text-primary-600 font-black text-sm flex items-center justify-center mb-5 shadow-sm relative z-10">
                            1
                        </div>

                        <h3 class="text-xl font-black text-[#0F2747] mb-4">
                            Identitas Driver
                        </h3>

                        <ul class="text-left space-y-2.5 text-xs sm:text-sm text-slate-600 font-medium max-w-xs">
                            <li class="flex items-start gap-2">
                                <span class="text-primary-600 font-black">•</span>
                                <span>Kartu Tanda Penduduk (KTP) Asli</span>
                            </li>
                            <li class="flex items-start gap-2">
                                <span class="text-primary-600 font-black">•</span>
                                <span>Nomor HP / WhatsApp aktif</span>
                            </li>
                            <li class="flex items-start gap-2">
                                <span class="text-primary-600 font-black">•</span>
                                <span>Alamat email aktif untuk akun login</span>
                            </li>
                            <li class="flex items-start gap-2">
                                <span class="text-primary-600 font-black">•</span>
                                <span>Pas foto terbaru (tampilan rapi)</span>
                            </li>
                        </ul>
                    </div>

                    <!-- STEP 2: Kualifikasi Mengemudi -->
                    <div class="flex flex-col items-center text-center">
                        <div class="h-20 flex items-center justify-center mb-4">
                            <div class="w-16 h-14 rounded-2xl bg-teal-50 border-2 border-teal-200 flex items-center justify-center shadow-sm">
                                <svg class="w-8 h-8 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                            </div>
                        </div>

                        <div class="w-10 h-10 rounded-full bg-primary-50 border-2 border-primary-600 text-primary-600 font-black text-sm flex items-center justify-center mb-5 shadow-sm relative z-10">
                            2
                        </div>

                        <h3 class="text-xl font-black text-[#0F2747] mb-4">
                            Kualifikasi Berkendara
                        </h3>

                        <ul class="text-left space-y-2.5 text-xs sm:text-sm text-slate-600 font-medium max-w-xs">
                            <li class="flex items-start gap-2">
                                <span class="text-primary-600 font-black">•</span>
                                <span>SIM A / B1 yang masih aktif & sah</span>
                            </li>
                            <li class="flex items-start gap-2">
                                <span class="text-primary-600 font-black">•</span>
                                <span>Surat Keterangan Sehat dari faskes</span>
                            </li>
                            <li class="flex items-start gap-2">
                                <span class="text-primary-600 font-black">•</span>
                                <span>SKCK (Surat Catatan Kepolisian)</span>
                            </li>
                            <li class="flex items-start gap-2">
                                <span class="text-primary-600 font-black">•</span>
                                <span>Sertifikat P3K / BLS (nilai tambah)</span>
                            </li>
                        </ul>
                    </div>

                    <!-- STEP 3: Dokumen Keamanan (SKCK) -->
                    <div class="flex flex-col items-center text-center">
                        <div class="h-20 flex items-center justify-center mb-4">
                            <div class="w-16 h-12 rounded-xl bg-amber-100 border-2 border-amber-300 flex items-center justify-center shadow-sm">
                                <svg class="w-8 h-8 text-amber-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                            </div>
                        </div>

                        <div class="w-10 h-10 rounded-full bg-primary-50 border-2 border-primary-600 text-primary-600 font-black text-sm flex items-center justify-center mb-5 shadow-sm relative z-10">
                            3
                        </div>

                        <h3 class="text-xl font-black text-[#0F2747] mb-4">
                            Dokumen SKCK
                        </h3>

                        <ul class="text-left space-y-2.5 text-xs sm:text-sm text-slate-600 font-medium max-w-xs">
                            <li class="flex items-start gap-2">
                                <span class="text-primary-600 font-black">•</span>
                                <span>SKCK resmi aktif dari Kepolisian (Wajib)</span>
                            </li>
                            <li class="flex items-start gap-2">
                                <span class="text-primary-600 font-black">•</span>
                                <span>Surat Keterangan Sehat dari faskes</span>
                            </li>
                            <li class="flex items-start gap-2">
                                <span class="text-primary-600 font-black">•</span>
                                <span>Sertifikat P3K / BLS (nilai tambah)</span>
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
            <div class="bg-[#fef3c7] border border-[#fde68a] rounded-3xl p-6 sm:p-8 flex items-start gap-4 shadow-sm">
                <div class="w-10 h-10 rounded-full bg-amber-500 text-white flex items-center justify-center shrink-0 font-black text-lg shadow-sm">
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

            <!-- Call to Action Banner -->
            <div class="relative bg-gradient-to-r from-primary-700 via-primary-600 to-[#0F2747] rounded-[2.5rem] sm:rounded-[3.5rem] p-8 sm:p-12 md:p-16 text-white shadow-2xl overflow-hidden">
                <div class="absolute -right-16 -bottom-16 w-80 h-80 bg-white/10 rounded-full blur-2xl pointer-events-none"></div>

                <div class="relative z-10 flex flex-col lg:flex-row items-center justify-between gap-8">
                    <div class="space-y-6 text-center lg:text-left max-w-2xl">
                        <h3 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-black text-white leading-tight tracking-tight">
                            Siaga mengantarkan harapan, yuk gabung jadi Pengemudi sekarang! <br>
                            <span class="text-teal-200">#PahlawanKemanusiaan</span>
                        </h3>
                        
                        <div>
                            <a href="{{ route('register.supir') }}" 
                               class="inline-flex items-center justify-center gap-3 px-8 py-4 rounded-full bg-white hover:bg-slate-50 text-primary-700 font-black text-base shadow-xl hover:shadow-2xl transition-all transform active:scale-95">
                                <span>Daftar Sebagai Pengemudi</span>
                                <svg class="w-5 h-5 text-primary-600" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"/></svg>
                            </a>
                        </div>
                    </div>

                    <div class="relative shrink-0 hidden sm:block">
                        <div class="w-44 h-44 sm:w-56 sm:h-56 rounded-full bg-white/10 p-3 flex items-center justify-center border-4 border-white/20">
                            <div class="w-full h-full rounded-full bg-white flex flex-col items-center justify-center p-4 shadow-inner text-center">
                                <svg class="w-16 h-16 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                                <span class="text-xs font-black text-slate-800 mt-2">Pengemudi Siaga</span>
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

