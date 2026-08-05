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
                <a href="{{ route('home') }}" class="inline-flex items-center gap-4 group">
                    <div class="w-20 h-20 rounded-full bg-white p-2 flex items-center justify-center shadow-xl shadow-sky-600/25 border-2 border-sky-100 group-hover:scale-105 transition-transform overflow-hidden">
                        <img src="{{ asset('images/logo_ambulansiaga.png') }}" alt="Logo Ambulance Siaga" class="w-full h-full object-contain">
                    </div>
                    <div class="text-left">
                        <span class="text-2xl font-black text-slate-900 tracking-tight block">Ambulance Siaga</span>
                        <span class="text-xs font-bold text-sky-600 uppercase tracking-widest block">Layanan Darurat • Multi-Mitra</span>
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
                    <span>Kembali ke Beranda Ambulance Siaga</span>
                </a>
            </div>

            <!-- Copyright -->
            <p class="mt-6 text-[11px] font-semibold text-slate-400 text-center">
                &copy; {{ date('Y') }} Ambulance Siaga. Platform Layanan Darurat untuk Berbagai Mitra. Dikembangkan oleh GSC.
            </p>
        </div>
    </body>
</html>
