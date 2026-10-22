<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Ambulans Siaga') }} - Layanan Darurat Terpercaya</title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('images/logo_ambulansiaga.png') }}">

    <!-- Google Fonts: Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- CSS / Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles

    <!-- Leaflet.js CSS & JS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <script src="{{ asset('js/ambulance-3d-engine.js') }}"></script>
    
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }

        /* Subtle 5px Border-Radius Design System for Role User (Anti-AI Slop) */
        .sharp-theme,
        .sharp-theme *,
        .sharp-theme *::before,
        .sharp-theme *::after {
            border-radius: 5px !important;
        }

        /* Pastikan tombol teks panjang / CTA (bukan icon bulat atau tab pill) tetap menggunakan sudut halus 5px */
        .sharp-theme a[class*="px-"]:not([class*=" w-"]):not([class^="w-"]):not([class*=" h-"]):not([class^="h-"]):not([class*="rounded-full"]),
        .sharp-theme button[class*="px-"]:not([class*=" w-"]):not([class^="w-"]):not([class*=" h-"]):not([class^="h-"]):not([class*="rounded-full"]),
        .sharp-theme a[class*="py-"]:not([class*=" w-"]):not([class^="w-"]):not([class*=" h-"]):not([class^="h-"]):not([class*="rounded-full"]),
        .sharp-theme button[class*="py-"]:not([class*=" w-"]):not([class^="w-"]):not([class*=" h-"]):not([class^="h-"]):not([class*="rounded-full"]),
        .sharp-theme input,
        .sharp-theme select,
        .sharp-theme textarea {
            border-radius: 5px !important;
        }

        /* Kembalikan semua icon, avatar, logo, status indicator, toggle, tab switcher, dan elemen bulat (.rounded-full) agar tetap bulat sempurna */
        .sharp-theme .rounded-full,
        .sharp-theme [class*="rounded-full"],
        .sharp-theme [class*="rounded-full"] *,
        .sharp-theme .rounded-full::before,
        .sharp-theme .rounded-full::after,
        .sharp-theme [class*="rounded-full"]::before,
        .sharp-theme [class*="rounded-full"]::after,
        .sharp-theme [class*="after:rounded-full"]::after,
        .sharp-theme a.rounded-full,
        .sharp-theme button.rounded-full,
        .sharp-theme a[class*="rounded-full"],
        .sharp-theme button[class*="rounded-full"],
        .sharp-theme div.rounded-full,
        .sharp-theme div[class*="rounded-full"],
        .sharp-theme .leaflet-marker-icon,
        .sharp-theme .leaflet-marker-icon *,
        .sharp-theme .leaflet-marker-icon div,
        .sharp-theme .custom-marker,
        .sharp-theme .custom-marker * {
            border-radius: 9999px !important;
        }

        /* Jika di dalam tombol teks ada icon / dot bulat, pastikan dot/icon tersebut tetap bulat */
        .sharp-theme a[class*="px-"] [class*="rounded-full"],
        .sharp-theme button[class*="px-"] [class*="rounded-full"],
        .sharp-theme a[class*="px-"] .rounded-full,
        .sharp-theme button[class*="px-"] .rounded-full {
            border-radius: 9999px !important;
        }
    </style>
</head>
<body class="antialiased text-slate-800 bg-white selection:bg-primary-600 selection:text-white sharp-theme">

    @include('layouts.header')
    
    <main class="{{ auth()->check() ? 'pb-16 lg:pb-0' : '' }}">
        {{ $slot }}
    </main>

    <!-- Mobile Bottom Navigation Bar -->
    @include('layouts.bottom-nav')

    @livewireScripts
    @stack('scripts')
</body>
</html>
