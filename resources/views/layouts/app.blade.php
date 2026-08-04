<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Ambulance Siaga') }} - Platform Layanan Ambulans Darurat & Mitra</title>

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
        <div class="min-h-screen flex flex-col" x-data="{ mobileMenuOpen: false }">

            <!-- Top Header Navbar -->
            @include('layouts.header')

            <!-- Main Application Area -->
            <div class="pt-20 flex-1 flex flex-col w-full transition-all duration-300 ease-in-out">
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
                    {{ $slot }}
                </main>

                <!-- Footer -->
                <footer class="bg-white border-t border-slate-200/80 mt-12 py-6 px-4 sm:px-6 lg:px-8 text-center text-xs text-slate-500">
                    <div class="max-w-7xl mx-auto flex flex-col sm:flex-row items-center justify-between gap-4">
                        <div class="flex items-center gap-2.5 font-bold text-slate-700">
                            <img src="{{ asset('images/logo_ambulansiaga.png') }}" alt="Logo Ambulance Siaga" class="w-6 h-6 object-contain">
                            <span>{{ $namaGsc ?? 'Ambulance Siaga' }} • Platform Kolaborasi Layanan Ambulans & Medis</span>
                        </div>
                        <p class="font-medium">
                            &copy; {{ date('Y') }} Ambulance Siaga. Platform Layanan Darurat untuk Masyarakat & Berbagai Mitra. Dikembangkan oleh GSC.
                        </p>
                    </div>
                </footer>
            </div>

        </div>

        @livewireScripts
        @stack('scripts')
    </body>
</html>
