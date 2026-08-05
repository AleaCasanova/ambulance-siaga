<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Ambulance Siaga') }} - Layanan Darurat Terpercaya</title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('images/logo_ambulansiaga.png') }}">

    <!-- Google Fonts: Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- CSS / Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="antialiased text-slate-800 bg-slate-50 selection:bg-[#009CA6] selection:text-white">

    <!-- Top Navigation -->
    <nav class="absolute top-0 left-0 w-full z-50 py-5 px-6 lg:px-12 flex justify-between items-center border-b border-white/10 bg-[#009CA6]/10 backdrop-blur-md">
        <div class="flex items-center gap-3">
            <div class="w-12 h-12 bg-white rounded-full p-1.5 flex items-center justify-center shadow-lg">
                <img src="{{ asset('images/logo_ambulansiaga.png') }}" alt="Logo" class="w-full h-full object-contain">
            </div>
            <div>
                <span class="text-white font-black text-xl tracking-tight hidden sm:block leading-none">Ambulance Siaga</span>
                <span class="text-sky-100 text-[10px] font-bold tracking-widest uppercase hidden sm:block">LAZ GSC Cilacap</span>
            </div>
        </div>
        <div class="flex items-center gap-6">
            <a href="#layanan" class="text-white font-semibold hover:text-sky-200 transition text-sm hidden md:block">Layanan Kami</a>
            <a href="#tentang" class="text-white font-semibold hover:text-sky-200 transition text-sm hidden md:block">Tentang GSC</a>
            
            <div class="h-6 w-px bg-white/30 hidden md:block"></div>

            @if (Route::has('login'))
                @auth
                    <a href="{{ url('/dashboard') }}" class="bg-white text-[#009CA6] px-6 py-2.5 rounded-full font-bold hover:bg-sky-50 transition shadow-lg text-sm">Masuk Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="text-white font-semibold hover:text-sky-200 transition text-sm">Login</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="bg-white text-[#009CA6] px-6 py-2.5 rounded-full font-bold hover:bg-sky-50 transition shadow-lg text-sm">Daftar Akun</a>
                    @endif
                @endauth
            @endif
        </div>
    </nav>

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
                    <a href="#tentang" class="inline-flex justify-center items-center gap-2 bg-transparent border-2 border-white/50 text-white px-8 py-4 rounded-full font-bold text-lg hover:bg-white/10 hover:border-white transition-all">
                        Tentang Layanan
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
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                </div>
                <h3 class="text-4xl font-black text-slate-800 mb-1">100<span class="text-[#009CA6]">+</span></h3>
                <p class="text-sm font-bold text-slate-400 uppercase tracking-wider">Armada Siaga</p>
            </div>
            
            <div class="w-px h-20 bg-slate-100 hidden md:block"></div>

            <div class="text-center flex-1 min-w-[150px] group">
                <div class="w-16 h-16 mx-auto bg-sky-50 rounded-2xl text-[#009CA6] mb-4 flex items-center justify-center group-hover:-translate-y-2 transition-transform duration-300">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                </div>
                <h3 class="text-4xl font-black text-slate-800 mb-1">2.665<span class="text-[#009CA6]">+</span></h3>
                <p class="text-sm font-bold text-slate-400 uppercase tracking-wider">Penerima Manfaat</p>
            </div>

            <div class="w-px h-20 bg-slate-100 hidden md:block"></div>

            <div class="text-center flex-1 min-w-[150px] group">
                <div class="w-16 h-16 mx-auto bg-sky-50 rounded-2xl text-[#009CA6] mb-4 flex items-center justify-center group-hover:-translate-y-2 transition-transform duration-300">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                </div>
                <h3 class="text-4xl font-black text-slate-800 mb-1">150<span class="text-[#009CA6]">+</span></h3>
                <p class="text-sm font-bold text-slate-400 uppercase tracking-wider">Relawan Aktif</p>
            </div>

            <div class="w-px h-20 bg-slate-100 hidden md:block"></div>

            <div class="text-center flex-1 min-w-[150px] group">
                <div class="w-16 h-16 mx-auto bg-sky-50 rounded-2xl text-[#009CA6] mb-4 flex items-center justify-center group-hover:-translate-y-2 transition-transform duration-300">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                </div>
                <h3 class="text-4xl font-black text-slate-800 mb-1">24<span class="text-[#009CA6]"></span></h3>
                <p class="text-sm font-bold text-slate-400 uppercase tracking-wider">Kecamatan</p>
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
                    GSC (Gerak Sedekah Cilacap) adalah lembaga filantrophy yang bergerak di bidang sosial, kemanusiaan, dan keagamaan. Kami berkomitmen untuk menjadi jembatan antara para dermawan dan masyarakat yang membutuhkan, termasuk menghadirkan layanan armada ambulans darurat.
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

    <!-- Partners Section -->
    <section class="py-16 px-6 bg-slate-50 border-t border-slate-200">
        <div class="max-w-6xl mx-auto flex flex-col md:flex-row items-center justify-center gap-8 md:gap-16">
            <span class="text-slate-400 font-black uppercase tracking-widest text-sm text-center shrink-0">Didukung Oleh Mitra Kebaikan</span>
            <div class="flex flex-wrap justify-center items-center gap-8 lg:gap-16 opacity-60 grayscale hover:grayscale-0 transition duration-500">
                <!-- Using generic text styling for logos to simulate the real ones -->
                <div class="text-2xl font-black text-green-700 tracking-tighter">BAZNAS</div>
                <div class="text-2xl font-black text-orange-500 flex items-center gap-2"><svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24"><path d="M12 3L1 11.4l1.2 1.6L4 11.6V21h16v-9.4l1.8 1.4 1.2-1.6L12 3zm-2 15h-4v-4h4v4zm6 0h-4v-4h4v4z"></path></svg> <span class="tracking-tighter">Rumah Zakat</span></div>
                <div class="text-2xl font-black text-orange-400 tracking-tighter">lazis<span class="text-orange-600">mu</span></div>
                <div class="text-2xl font-black text-green-600 tracking-tighter flex items-center gap-1"><span class="w-6 h-6 bg-green-600 rounded-sm inline-block"></span> DOMPET<br>DHUAFA</div>
                <div class="text-2xl font-black text-blue-500 tracking-tighter">kitabisa</div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-slate-900 text-slate-400 pt-16 pb-8 px-6 border-t border-slate-800">
        <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-4 gap-12 mb-12">
            <div class="md:col-span-2">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-12 h-12 bg-white rounded-full p-1.5 flex items-center justify-center">
                        <img src="{{ asset('images/logo_ambulansiaga.png') }}" alt="Logo" class="w-full h-full object-contain">
                    </div>
                    <div>
                        <span class="text-white font-black text-2xl tracking-tight block leading-none">Ambulance Siaga</span>
                    </div>
                </div>
                <p class="max-w-md leading-relaxed mb-6 font-medium">Platform layanan antar jemput pasien dan penanganan gawat darurat medis berbasis relawan dan donasi umat di Kabupaten Cilacap.</p>
                <div class="flex gap-4">
                    <a href="#" class="w-10 h-10 rounded-full bg-slate-800 flex items-center justify-center hover:bg-[#009CA6] hover:text-white transition"><svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/></svg></a>
                    <a href="#" class="w-10 h-10 rounded-full bg-slate-800 flex items-center justify-center hover:bg-[#009CA6] hover:text-white transition"><svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg></a>
                </div>
            </div>
            <div>
                <h4 class="text-white font-bold mb-4 uppercase tracking-wider text-sm">Tautan Berguna</h4>
                <ul class="space-y-3 font-medium">
                    <li><a href="#" class="hover:text-white transition">Beranda</a></li>
                    <li><a href="#layanan" class="hover:text-white transition">Layanan</a></li>
                    <li><a href="#tentang" class="hover:text-white transition">Tentang Kami</a></li>
                    <li><a href="#" class="hover:text-white transition">Daftar Relawan</a></li>
                </ul>
            </div>
            <div>
                <h4 class="text-white font-bold mb-4 uppercase tracking-wider text-sm">Hubungi Kami</h4>
                <ul class="space-y-3 font-medium">
                    <li class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-[#009CA6] shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        <span>Jl. Kemanusiaan No. 99, Kabupaten Cilacap, Jawa Tengah</span>
                    </li>
                    <li class="flex items-center gap-3">
                        <svg class="w-5 h-5 text-[#009CA6] shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                        <span>0812-3456-7890 (Darurat)</span>
                    </li>
                </ul>
            </div>
        </div>
        <div class="text-center pt-8 border-t border-slate-800 font-medium text-sm">
            <p>&copy; {{ date('Y') }} LAZ Gerak Sedekah Cilacap. All rights reserved.</p>
        </div>
    </footer>

</body>
</html>
