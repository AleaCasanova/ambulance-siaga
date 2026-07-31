<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'GSC SIAGA') }} - Login & Registrasi</title>

        <!-- Google Fonts: Plus Jakarta Sans -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <style>
            body { font-family: 'Plus Jakarta Sans', sans-serif; }
        </style>
    </head>
    <body class="font-sans text-slate-800 antialiased bg-slate-50">
        <div class="min-h-screen flex flex-col sm:justify-center items-center p-4 sm:p-6 bg-gradient-to-br from-slate-100 via-white to-sky-50/40">

            <!-- Brand Logo & Header -->
            <div class="mb-6 text-center">
                <a href="{{ route('home') }}" class="inline-flex items-center gap-3 group">
                    <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-sky-600 via-cyan-600 to-blue-700 flex items-center justify-center text-white font-black text-2xl shadow-xl shadow-sky-600/30 group-hover:scale-105 transition-transform">
                        GSC
                    </div>
                    <div class="text-left">
                        <span class="text-2xl font-black text-slate-900 tracking-tight block">GSC SIAGA</span>
                        <span class="text-xs font-bold text-sky-600 uppercase tracking-widest block">Ambulans Darurat Cilacap</span>
                    </div>
                </a>
            </div>

            <!-- Form Container Card -->
            <div class="w-full sm:max-w-md px-8 py-8 bg-white shadow-xl shadow-slate-200/60 border border-slate-200/80 rounded-3xl">
                {{ $slot }}
            </div>

            <!-- Back to Home / Order Darurat -->
            <div class="mt-8 text-center">
                <a href="{{ route('home') }}" 
                   class="inline-flex items-center gap-2 text-xs font-bold text-slate-500 hover:text-sky-600 transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    <span>Kembali ke Beranda GSC SIAGA</span>
                </a>
            </div>

            <!-- Copyright -->
            <p class="mt-6 text-[11px] font-semibold text-slate-400">
                &copy; {{ date('Y') }} Yayasan Gerak Sedekah Cilacap (GSC). Layanan Medis Kemanusiaan 24 Jam.
            </p>
        </div>
    </body>
</html>
