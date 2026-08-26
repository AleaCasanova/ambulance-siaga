<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Ambulans Siaga') }} - Platform Layanan Ambulans Darurat & Mitra</title>

        <!-- Favicon / Website Icon -->
        <link rel="icon" type="image/png" href="{{ asset('images/logo_ambulansiaga.png') }}">
        <link rel="shortcut icon" href="{{ asset('images/logo_ambulansiaga.png') }}">

        <!-- Fonts: Plus Jakarta Sans -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet" />

        <!-- Leaflet.js CSS (Peta & Monitoring) -->
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Chart.js & Leaflet.js -->
        <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

        @livewireStyles
        <style>
            body { font-family: 'Plus Jakarta Sans', sans-serif; }
            /* Custom Leaflet Blue Marker Style */
            .custom-blue-icon {
                filter: hue-rotate(200deg) saturate(3);
            }
        </style>
    </head>
    <body class="font-sans antialiased bg-slate-50 text-slate-800">
        <div class="min-h-screen flex flex-col relative" x-data="{ mobileMenuOpen: false }">

            <!-- Global Teal Background -->
            <div class="absolute top-0 left-0 w-full h-80 bg-gradient-to-br from-primary-600 to-primary-700 -z-10">
                <div class="absolute inset-0 opacity-10" style="background-image: radial-gradient(circle at 2px 2px, white 1px, transparent 0); background-size: 32px 32px;"></div>
            </div>

            <!-- Top Header Navbar -->
            @include('layouts.header')

            <!-- Main Application Area -->
            <div class="pt-32 flex-1 flex flex-col w-full transition-all duration-300 ease-in-out z-10">
                <main class="flex-1 p-4 sm:p-6 lg:p-8 max-w-7xl w-full mx-auto">
                    <!-- Flash Message Toast Alert -->
                    @if(session('success'))
                        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)"
                             class="mb-6 p-4 rounded-2xl bg-emerald-600 text-white shadow-lg flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <svg class="w-6 h-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                <span class="text-sm font-semibold">{{ session('success') }}</span>
                            </div>
                            <button @click="show = false" class="text-emerald-200 hover:text-white">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                            </button>
                        </div>
                    @endif

                    @if(session('error'))
                        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 6000)"
                             class="mb-6 p-4 rounded-2xl bg-red-600 text-white shadow-lg flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <svg class="w-6 h-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                <span class="text-sm font-semibold">{{ session('error') }}</span>
                            </div>
                            <button @click="show = false" class="text-red-200 hover:text-white">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                            </button>
                        </div>
                    @endif

                    <!-- Page Slot Content -->
                    <div class="pb-16 lg:pb-0">
                        {{ $slot }}
                    </div>
                </main>

                <!-- Footer -->
                <div class="pb-16 lg:pb-0">
                    <x-landing-footer />
                </div>
            </div>

            <!-- Mobile Bottom Navigation Bar -->
            @include('layouts.bottom-nav')

        </div>

        @livewireScripts
        @stack('scripts')
    </body>
</html>
