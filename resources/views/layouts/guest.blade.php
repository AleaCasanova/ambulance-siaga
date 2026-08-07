<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Ambulance Siaga') }} - Login & Registrasi</title>

        <!-- Favicon / Website Icon -->
        <link rel="icon" type="image/png" href="{{ asset('images/logo_ambulansiaga.png') }}">
        <link rel="shortcut icon" href="{{ asset('images/logo_ambulansiaga.png') }}">

        <!-- Google Fonts: Plus Jakarta Sans -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

        <!-- Scripts -->
        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <style>
            [x-cloak] { display: none !important; }
            input::-ms-reveal, input::-ms-clear { display: none !important; width: 0 !important; height: 0 !important; }
            body { font-family: 'Plus Jakarta Sans', sans-serif; }
        </style>
    </head>
    <body class="font-sans text-slate-800 antialiased bg-[#F4F7FA] min-h-screen lg:h-screen lg:overflow-hidden">
        <div class="min-h-screen lg:h-screen flex flex-col lg:flex-row">
            
            <!-- PANEL KIRI: AREA BRANDING (50% Lebar - Presisi Fit Viewport) -->
            <div class="relative w-full lg:w-1/2 bg-gradient-to-br from-[#009CA6] via-[#008f97] to-[#007b83] text-white flex flex-col justify-between p-6 sm:p-8 lg:p-10 overflow-hidden min-h-[480px] lg:h-full">
                
                <!-- ELEMEN DEKORATIF BACKGROUND -->
                <div class="absolute -right-12 top-1/4 w-[450px] h-[450px] opacity-[0.08] pointer-events-none select-none text-white">
                    <svg viewBox="0 0 100 100" fill="currentColor">
                        <path d="M43 5 h14 v28 h24 l-14 24 l24 14 l-7 12 l-24 -14 v28 h-14 v-28 l-24 14 l-7 -12 l24 -14 l-14 -24 h24 Z" />
                        <path d="M48 25 c0 0 4 10 4 20 c0 10 -4 15 -4 25 c0 5 4 8 4 8 s-2 5 -6 5 c-4 0 -6 -5 -6 -5 s4 -3 4 -8 c0 -10 -4 -15 -4 -25 c0 -10 4 -20 4 -20 Z" fill="none" stroke="currentColor" stroke-width="2" />
                    </svg>
                </div>

                <div class="absolute top-8 right-8 opacity-30 pointer-events-none text-white">
                    <svg width="80" height="80" viewBox="0 0 100 100" fill="none">
                        <pattern id="dot-grid" x="0" y="0" width="16" height="16" patternUnits="userSpaceOnUse">
                            <circle cx="3" cy="3" r="2" fill="currentColor" />
                        </pattern>
                        <rect width="100" height="100" fill="url(#dot-grid)" />
                    </svg>
                </div>
                <div class="absolute bottom-10 right-8 opacity-30 pointer-events-none text-white">
                    <svg width="100" height="80" viewBox="0 0 120 100" fill="none">
                        <rect width="120" height="100" fill="url(#dot-grid)" />
                    </svg>
                </div>

                <div class="absolute top-1/4 left-6 opacity-25 text-white pointer-events-none animate-pulse">
                    <svg class="w-7 h-7" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M19 11h-6V5a1 1 0 00-2 0v6H5a1 1 0 000 2h6v6a1 1 0 002 0v-6h6a1 1 0 000-2z"/>
                    </svg>
                </div>

                <div class="absolute -bottom-20 -left-20 w-80 h-80 bg-white/10 rounded-full blur-3xl pointer-events-none"></div>
                <div class="absolute top-1/3 right-0 w-72 h-72 bg-white/10 rounded-full blur-3xl pointer-events-none"></div>
                <svg class="absolute bottom-0 left-0 right-0 w-full h-36 opacity-10 pointer-events-none" viewBox="0 0 500 150" preserveAspectRatio="none">
                    <path d="M0,100 C150,180 350,0 500,100 L500,150 L0,150 Z" fill="white"></path>
                </svg>

                <div class="absolute bottom-0 left-0 right-0 h-24 opacity-15 pointer-events-none overflow-hidden">
                    <svg class="w-full h-full" viewBox="0 0 1000 120" preserveAspectRatio="none" fill="white">
                        <path d="M0,120 L0,80 L20,80 L20,95 L35,95 L35,60 L55,60 L55,90 L75,90 L75,40 L95,40 L95,85 L120,85 L120,70 L140,70 L140,100 L160,100 L160,50 L190,50 L190,110 L220,110 L220,30 L250,30 L250,90 L280,90 L280,75 L310,75 L310,120 Z M310,120 L310,70 L340,70 L340,95 L370,95 L370,45 L400,45 L400,80 L430,80 L430,25 L470,25 L470,100 L500,100 L500,60 L530,60 L530,90 L560,90 L560,35 L600,35 L600,110 L630,110 L630,75 L670,75 L670,120 Z M670,120 L670,55 L700,55 L700,90 L730,90 L730,40 L770,40 L770,85 L800,85 L800,65 L840,65 L840,100 L880,100 L880,30 L920,30 L920,80 L960,80 L960,50 L1000,50 L1000,120 Z" />
                    </svg>
                </div>

                <!-- CONTENT PANEL KIRI -->
                <!-- Top Brand Header -->
                <div class="relative z-10">
                    <a href="{{ route('home') }}" class="inline-flex items-center gap-4 group">
                        <div class="w-14 h-14 sm:w-16 sm:h-16 rounded-full bg-white p-1.5 flex items-center justify-center shadow-md shadow-black/10 border border-white/50 group-hover:scale-105 transition-transform overflow-hidden">
                            <img src="{{ asset('images/logo_ambulansiaga.png') }}" alt="Logo Ambulance Siaga" class="w-full h-full object-contain">
                        </div>
                        <div>
                            <span class="text-2xl sm:text-3xl font-extrabold text-white tracking-tight block leading-tight">Ambulance Siaga</span>
                            <span class="text-[10px] sm:text-xs font-bold text-sky-200 uppercase tracking-widest block mt-0.5">LAYANAN DARURAT • MULTI-MITRA</span>
                        </div>
                    </a>
                </div>

                <!-- Middle Banner Graphic & Text -->
                <div class="relative z-10 my-auto py-3 flex flex-col items-center justify-center text-left w-full">
                    <!-- Banner Promosi Ambulance Melayang -->
                    <div class="relative w-full max-w-[360px] sm:max-w-[400px] lg:max-w-[480px] mx-auto mb-6 group">
                        <div class="absolute inset-0 bg-white/20 blur-3xl rounded-full transform group-hover:scale-105 transition-transform"></div>
                        <img src="{{ asset('images/ambulance_van_banner.png?v=2') }}" alt="Banner Ambulance Siaga" class="relative z-10 w-full h-auto object-cover rounded-[2rem] border-4 border-white/20 shadow-2xl drop-shadow-[0_20px_30px_rgba(0,0,0,0.4)]">
                    </div>

                    <!-- Judul Besar & Deskripsi (Interactive Variant) -->
                    <div class="text-left w-full max-w-[360px] sm:max-w-[400px] lg:max-w-[480px] group cursor-default">
                        
                        <!-- Badge Interaktif -->
                        <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-white/10 border border-white/20 text-[10px] sm:text-xs font-bold text-sky-50 uppercase tracking-widest mb-4 backdrop-blur-md shadow-lg hover:bg-white/20 transition-all duration-300 transform group-hover:-translate-y-1">
                            <span class="relative flex h-2 w-2">
                                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-400 opacity-75"></span>
                                <span class="relative inline-flex rounded-full h-2 w-2 bg-red-500"></span>
                            </span>
                            Layanan Darurat 24 Jam
                        </div>

                        <!-- Variasi Tipografi Judul (Lebih Besar & Menonjol) -->
                        <h1 class="text-3xl sm:text-4xl lg:text-5xl font-black tracking-tight leading-[1.05] mb-6">
                            <span class="block text-white font-extrabold group-hover:text-sky-100 transition-colors duration-300">Sistem Pemesanan</span>
                            
                            <span class="block text-transparent bg-clip-text bg-gradient-to-r from-yellow-300 via-yellow-400 to-amber-500 my-2 drop-shadow-md group-hover:scale-[1.04] origin-left transition-transform duration-300 uppercase text-4xl sm:text-5xl lg:text-[4rem] leading-none" style="background-image: linear-gradient(to right, #fde047, #facc15, #f59e0b); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">AMBULANCE</span>
                            
                            <span class="inline-block bg-white px-4 py-1.5 rounded-xl mt-1 shadow-[0_10px_25px_rgba(0,0,0,0.3)] transform group-hover:-rotate-3 group-hover:scale-105 transition-all duration-300 uppercase tracking-wider text-xl sm:text-2xl" style="color: #009CA6;">TANPA TARIF</span>
                        </h1>
                        
                        <!-- Garis Dekoratif Interaktif -->
                        <div class="w-12 h-1.5 bg-gradient-to-r from-yellow-300 to-amber-500 rounded-full mb-4 group-hover:w-24 transition-all duration-500 ease-out"></div>
                        
                        <!-- Deskripsi dengan tipografi elegan & background glassmorphism -->
                        <p class="text-xs sm:text-sm text-sky-50 leading-relaxed font-medium bg-black/10 p-4 rounded-xl border border-white/5 backdrop-blur-sm shadow-inner group-hover:bg-black/20 group-hover:border-white/10 transition-all duration-300">
                            Platform terpadu yang membantu masyarakat mendapatkan layanan ambulans secara <strong class="text-white font-extrabold">cepat, tepat, dan tanpa biaya</strong>. Kami menghubungkan Anda dengan berbagai mitra agar bantuan tiba seketika.
                        </p>
                    </div>
                </div>

                <!-- Bottom Footer Tagline -->
                <div class="relative z-10 pt-2 flex items-center justify-between text-[10px] text-sky-200/80 font-medium border-t border-white/10">
                    <span>Siaga Darurat Medis 24/7</span>
                    <span>Bebas Biaya • Multi-Mitra</span>
                </div>
            </div>

            <!-- PANEL KANAN: AREA FORM & CONTENT (Fit 100vh Without Scroll) -->
            <div class="w-full lg:w-1/2 bg-[#F4F7FA] flex flex-col justify-between p-4 sm:p-6 lg:p-8 min-h-screen lg:h-full lg:overflow-y-auto">
                <div class="my-auto flex flex-col items-center justify-center w-full py-2">
                    {{ $slot }}
                </div>
            </div>

        </div>
    </body>
</html>





