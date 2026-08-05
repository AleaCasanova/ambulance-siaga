<div>
    <x-landing-navbar />

    <!-- Hero Section -->
    <section class="relative bg-gradient-to-br from-[#009CA6] to-[#007b83] pt-40 pb-48 px-6 lg:px-12 overflow-hidden">
        <!-- Decorative Pattern -->
        <div class="absolute inset-0 opacity-10" style="background-image: radial-gradient(circle at 2px 2px, white 1px, transparent 0); background-size: 32px 32px;"></div>

        <div class="max-w-7xl mx-auto flex flex-col lg:flex-row items-center gap-12 relative z-10">
            <!-- Left Text -->
            <div class="lg:w-[55%] text-white z-10 text-center lg:text-left">
                <div class="inline-flex items-center gap-2 mb-6 bg-white/10 backdrop-blur px-4 py-2 rounded-full border border-white/20 shadow-xl">
                    <svg class="w-5 h-5 text-yellow-300" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                    <span class="font-bold tracking-wider text-xs uppercase">LAZ Gerak Sedekah Cilacap (GSC)</span>
                </div>
                <h1 class="text-4xl sm:text-5xl lg:text-[3.5rem] font-black leading-[1.15] mb-6 drop-shadow-lg">
                    Kecepatan & Kepedulian dalam Menyelamatkan Nyawa
                </h1>
                <p class="text-lg sm:text-xl text-sky-100 mb-10 max-w-2xl mx-auto lg:mx-0 leading-relaxed font-medium">
                    Ambulance Siaga GSC adalah layanan darurat 24 jam yang sigap melayani antar jemput pasien, gawat darurat, dan evakuasi medis di wilayah Kabupaten Cilacap dan sekitarnya.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start">
                    <a href="{{ route('masyarakat.order.create') }}" class="group relative inline-flex justify-center items-center gap-2 bg-white text-[#009CA6] px-8 py-4 rounded-full font-bold text-lg hover:bg-slate-50 transition-all shadow-[0_8px_30px_rgb(0,0,0,0.2)] hover:scale-105">
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
                <img src="https://images.unsplash.com/photo-1516574187841-cb9cc2ca948b?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" class="absolute top-0 right-12 w-[280px] h-[280px] object-cover rounded-[3rem] shadow-2xl border-4 border-white/30 z-10 hover:-translate-y-2 transition-transform duration-500" alt="Medis 1">
                
                <!-- Image 2 -->
                <img src="https://images.unsplash.com/photo-1583324113626-70df0f4deaab?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80" class="absolute bottom-4 right-48 w-[220px] h-[220px] object-cover rounded-[2.5rem] shadow-2xl border-4 border-white/30 z-20 hover:-translate-y-2 transition-transform duration-500" alt="Ambulans">
                
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
    <section class="max-w-6xl mx-auto px-6 -mt-24 relative z-40">
        <div class="bg-white rounded-[2.5rem] shadow-[0_20px_50px_rgb(0,0,0,0.1)] border border-slate-100 p-8 md:p-10 flex flex-wrap justify-between items-center gap-8">
            <div class="text-center flex-1 min-w-[150px] group">
                <div class="w-16 h-16 mx-auto bg-sky-50 rounded-2xl text-[#009CA6] mb-4 flex items-center justify-center group-hover:-translate-y-2 transition-transform duration-300">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                </div>
                <h3 class="text-4xl font-black text-slate-800 mb-1">{{ number_format($totalAmbulans ?? 8) }}</h3>
                <p class="text-sm font-bold text-slate-400 uppercase tracking-wider">Armada Siaga</p>
            </div>
            
            <div class="w-px h-20 bg-slate-100 hidden md:block"></div>

            <div class="text-center flex-1 min-w-[150px] group">
                <div class="w-16 h-16 mx-auto bg-sky-50 rounded-2xl text-[#009CA6] mb-4 flex items-center justify-center group-hover:-translate-y-2 transition-transform duration-300">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                </div>
                <h3 class="text-4xl font-black text-slate-800 mb-1">{{ number_format($totalTerbantu ?? 2665) }}<span class="text-[#009CA6]">+</span></h3>
                <p class="text-sm font-bold text-slate-400 uppercase tracking-wider">Penerima Manfaat</p>
            </div>

            <div class="w-px h-20 bg-slate-100 hidden md:block"></div>

            <div class="text-center flex-1 min-w-[150px] group">
                <div class="w-16 h-16 mx-auto bg-sky-50 rounded-2xl text-[#009CA6] mb-4 flex items-center justify-center group-hover:-translate-y-2 transition-transform duration-300">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                </div>
                <h3 class="text-4xl font-black text-slate-800 mb-1">{{ number_format($totalRelawan ?? 150) }}<span class="text-[#009CA6]">+</span></h3>
                <p class="text-sm font-bold text-slate-400 uppercase tracking-wider">Relawan Aktif</p>
            </div>

            <div class="w-px h-20 bg-slate-100 hidden md:block"></div>

            <div class="text-center flex-1 min-w-[150px] group">
                <div class="w-16 h-16 mx-auto bg-sky-50 rounded-2xl text-[#009CA6] mb-4 flex items-center justify-center group-hover:-translate-y-2 transition-transform duration-300">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path></svg>
                </div>
                <h3 class="text-4xl font-black text-slate-800 mb-1">{{ number_format($totalRumahSakit ?? 4) }}<span class="text-[#009CA6]"></span></h3>
                <p class="text-sm font-bold text-slate-400 uppercase tracking-wider">Mitra Faskes</p>
            </div>
        </div>
    </section>

    <!-- Services / Programs -->
    <section id="layanan" class="pt-32 pb-24 px-6 lg:px-12 bg-slate-50">
        <div class="max-w-7xl mx-auto flex flex-col lg:flex-row gap-16">
            <!-- Left Header -->
            <div class="lg:w-1/3">
                <span class="text-[#009CA6] font-black tracking-widest text-sm mb-3 block uppercase">Program Kami</span>
                <h2 class="text-3xl md:text-[2.5rem] font-black text-slate-900 mb-6 leading-tight">Wujudkan Kebaikan dalam Berbagai Layanan</h2>
                <p class="text-slate-500 mb-8 leading-relaxed font-medium text-lg">
                    GSC fokus pada program kemanusiaan yang berdampak langsung bagi masyarakat yang membutuhkan, dari penanganan bencana hingga bantuan kesehatan gawat darurat.
                </p>
                <a href="#" class="inline-flex items-center gap-3 bg-[#009CA6] text-white px-8 py-4 rounded-full font-bold hover:bg-[#007f87] transition shadow-lg hover:shadow-xl">
                    Lihat Semua Program
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                </a>
            </div>

            <!-- Right Cards -->
            <div class="lg:w-2/3 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Card 1 -->
                <div class="bg-white rounded-[2rem] overflow-hidden shadow-lg shadow-slate-200/50 hover:shadow-2xl hover:-translate-y-2 transition-all duration-300 group border border-slate-100 flex flex-col">
                    <div class="h-48 overflow-hidden relative">
                        <img src="https://images.unsplash.com/photo-1599839619722-39751411ea63?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80" alt="Ambulans Gawat Darurat" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                        <div class="absolute -bottom-1 left-4 bg-white p-2 rounded-t-xl">
                            <div class="bg-red-50 text-red-600 w-12 h-12 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.477 2 2 6.477 2 12s4.477 10 10 10 10-4.477 10-10S17.523 2 12 2zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z"></path></svg>
                            </div>
                        </div>
                    </div>
                    <div class="p-6 pt-4 flex-1 flex flex-col">
                        <h3 class="text-xl font-black text-slate-800 mb-3">Ambulans Darurat</h3>
                        <p class="text-sm text-slate-500 leading-relaxed flex-1">Sigap membantu evakuasi korban kecelakaan, bencana alam, dan kondisi kritis secara gratis.</p>
                    </div>
                </div>

                <!-- Card 2 -->
                <div class="bg-white rounded-[2rem] overflow-hidden shadow-lg shadow-slate-200/50 hover:shadow-2xl hover:-translate-y-2 transition-all duration-300 group border border-slate-100 flex flex-col">
                    <div class="h-48 overflow-hidden relative">
                        <img src="https://images.unsplash.com/photo-1519494026892-80bbd2d6fd0d?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80" alt="Bantuan Kesehatan" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                        <div class="absolute -bottom-1 left-4 bg-white p-2 rounded-t-xl">
                            <div class="bg-sky-50 text-sky-600 w-12 h-12 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-2 10h-4v4h-2v-4H7v-2h4V7h2v4h4v2z"></path></svg>
                            </div>
                        </div>
                    </div>
                    <div class="p-6 pt-4 flex-1 flex flex-col">
                        <h3 class="text-xl font-black text-slate-800 mb-3">Bantuan Kesehatan</h3>
                        <p class="text-sm text-slate-500 leading-relaxed flex-1">Membantu biaya pengobatan dan kebutuhan kesehatan mendasar bagi masyarakat kurang mampu.</p>
                    </div>
                </div>

                <!-- Card 3 -->
                <div class="bg-white rounded-[2rem] overflow-hidden shadow-lg shadow-slate-200/50 hover:shadow-2xl hover:-translate-y-2 transition-all duration-300 group border border-slate-100 flex flex-col">
                    <div class="h-48 overflow-hidden relative">
                        <img src="https://images.unsplash.com/photo-1582213782179-e0d53f98f2ca?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80" alt="Benah Rumah" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                        <div class="absolute -bottom-1 left-4 bg-white p-2 rounded-t-xl">
                            <div class="bg-amber-50 text-amber-600 w-12 h-12 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M10 20v-6h4v6h5v-8h3L12 3 2 12h3v8z"></path></svg>
                            </div>
                        </div>
                    </div>
                    <div class="p-6 pt-4 flex-1 flex flex-col">
                        <h3 class="text-xl font-black text-slate-800 mb-3">Benah Rumah</h3>
                        <p class="text-sm text-slate-500 leading-relaxed flex-1">Membangun kembali dan merenovasi rumah tidak layak huni bagi keluarga dhuafa.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="tentang" class="py-24 px-6 lg:px-12 bg-white">
        <div class="max-w-7xl mx-auto bg-[#009CA6] rounded-[3rem] overflow-hidden shadow-2xl flex flex-col md:flex-row relative">
            <!-- Pattern -->
            <div class="absolute inset-0 opacity-10" style="background-image: repeating-linear-gradient(45deg, transparent, transparent 10px, white 10px, white 20px);"></div>
            
            <div class="md:w-1/2 h-80 md:h-auto relative z-10 p-6 md:p-8">
                <img src="https://images.unsplash.com/photo-1584982751601-97d8cb0f66fc?ixlib=rb-4.0.3&auto=format&fit=crop&w=1000&q=80" alt="Tentang GSC" class="w-full h-full object-cover rounded-[2rem] shadow-xl">
            </div>
            <div class="md:w-1/2 p-10 lg:p-16 text-white flex flex-col justify-center z-10">
                <span class="text-yellow-300 font-black tracking-widest text-sm mb-3 block uppercase">Tentang GSC</span>
                <h2 class="text-3xl md:text-4xl font-black mb-6 leading-[1.2]">Lembaga Filantrophy Profesional untuk Kesejahteraan Masyarakat</h2>
                <p class="text-sky-50 mb-8 leading-relaxed text-lg font-medium">
                    {{ $tentang ?? 'GSC (Gerak Sedekah Cilacap) adalah lembaga filantrophy yang bergerak di bidang sosial, kemanusiaan, dan keagamaan. Kami berkomitmen untuk menjadi jembatan antara para dermawan dan masyarakat yang membutuhkan, termasuk menghadirkan layanan armada ambulans darurat.' }}
                </p>
                <div>
                    <a href="#" class="inline-flex items-center gap-2 bg-white text-[#009CA6] px-8 py-4 rounded-full font-bold hover:bg-sky-50 transition hover:scale-105 shadow-lg">
                        Kenali Lebih Jauh
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Rumah Sakit Rujukan Section -->
    <section class="py-24 px-6 bg-slate-50 border-t border-slate-200">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-black text-slate-900 mb-4">Mitra Fasilitas Kesehatan</h2>
                <p class="text-slate-500 font-medium">Jaringan Rumah Sakit rujukan darurat 24 Jam yang terhubung dalam ekosistem Ambulance Siaga.</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($rumahSakits as $rs)
                    <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm hover:shadow-lg transition-shadow group flex flex-col h-full">
                        <div class="flex items-center justify-between mb-4">
                            <span class="inline-flex items-center px-2 py-1 rounded bg-sky-50 text-[10px] font-black text-sky-600 tracking-wider">
                                IGD 24 JAM
                            </span>
                        </div>
                        <h3 class="font-bold text-slate-800 text-lg mb-2">{{ $rs->nama }}</h3>
                        <p class="text-sm text-slate-500 leading-relaxed mb-4 flex-1">{{ $rs->alamat }}</p>
                        <div class="pt-4 border-t border-slate-100 flex items-center justify-between">
                            <span class="text-xs font-bold text-slate-400">{{ $rs->telepon }}</span>
                            <a href="https://www.google.com/maps?q={{ $rs->lat }},{{ $rs->lng }}" target="_blank" class="w-8 h-8 rounded-full bg-slate-50 flex items-center justify-center text-sky-600 group-hover:bg-sky-600 group-hover:text-white transition">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"></path></svg>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Partners Section -->
    <section class="py-16 px-6 bg-white border-t border-slate-200">
        <div class="max-w-6xl mx-auto flex flex-col md:flex-row items-center justify-center gap-8 md:gap-16">
            <span class="text-slate-400 font-black uppercase tracking-widest text-sm text-center shrink-0">Didukung Oleh Mitra Kebaikan</span>
            <div class="flex flex-wrap justify-center items-center gap-8 lg:gap-16 opacity-60 grayscale hover:grayscale-0 transition duration-500">
                <div class="text-2xl font-black text-green-700 tracking-tighter">BAZNAS</div>
                <div class="text-2xl font-black text-orange-500 flex items-center gap-2"><svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24"><path d="M12 3L1 11.4l1.2 1.6L4 11.6V21h16v-9.4l1.8 1.4 1.2-1.6L12 3zm-2 15h-4v-4h4v4zm6 0h-4v-4h4v4z"></path></svg> <span class="tracking-tighter">Rumah Zakat</span></div>
                <div class="text-2xl font-black text-orange-400 tracking-tighter">lazis<span class="text-orange-600">mu</span></div>
                <div class="text-2xl font-black text-green-600 tracking-tighter flex items-center gap-1"><span class="w-6 h-6 bg-green-600 rounded-sm inline-block"></span> DOMPET<br>DHUAFA</div>
                <div class="text-2xl font-black text-blue-500 tracking-tighter">kitabisa</div>
            </div>
        </div>
    </section>

    <x-landing-footer />
</div>
