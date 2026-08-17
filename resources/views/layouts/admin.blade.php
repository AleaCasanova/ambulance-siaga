<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Ambulance Siaga') }} - Enterprise Admin Panel</title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('images/logo_ambulansiaga.png') }}">
    <link rel="shortcut icon" href="{{ asset('images/logo_ambulansiaga.png') }}">

    <!-- Fonts: Inter for SaaS look -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet" />

    <!-- Leaflet.js CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Chart.js & Leaflet.js -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    @livewireStyles
    <style>
        body { 
            font-family: 'Inter', sans-serif;
            background-color: #F8FAFC; /* Slate 50 */
            color: #1E293B; /* Slate 800 */
        }
        /* Custom scrollbar for sleek look */
        ::-webkit-scrollbar { width: 6px; height: 6px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: #CBD5E1; border-radius: 10px; }
        ::-webkit-scrollbar-thumb:hover { background: #94A3B8; }
        
        .custom-blue-icon { filter: hue-rotate(200deg) saturate(3); }
        .custom-red-icon { filter: hue-rotate(150deg) saturate(2.5) contrast(1.5) brightness(0.8) sepia(1); }
        .custom-green-icon { filter: hue-rotate(270deg) saturate(3); }
        .custom-yellow-icon { filter: hue-rotate(40deg) saturate(3); }
    </style>
</head>
<body class="antialiased min-h-screen flex bg-slate-50 overflow-x-hidden" x-data="{ sidebarOpen: false, sidebarCollapsed: false }">

    <!-- Mobile Backdrop Overlay -->
    <div x-show="sidebarOpen" 
         @click="sidebarOpen = false" 
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 z-40 bg-slate-900/60 backdrop-blur-xs lg:hidden"
         style="display: none;">
    </div>

    <!-- Sidebar Left (Fixed) -->
    @include('layouts.sidebar')

    <!-- Main Wrapper -->
    <div class="flex-1 flex flex-col min-w-0 transition-all duration-300" 
         :class="sidebarCollapsed ? 'lg:pl-20' : 'lg:pl-[260px]'">
        
        <!-- Topbar -->
        @include('layouts.admin-topbar')

        <!-- Main Content Area -->
        <main class="flex-1 p-6 lg:p-8 w-full mt-16 max-w-[1600px] mx-auto">
            
            <!-- Toast Notifications -->
            @if(session('success'))
                <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)"
                     class="mb-6 p-4 rounded-xl bg-[#F0FDF4] border border-[#16A34A]/20 text-[#16A34A] flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        <span class="text-sm font-semibold">{{ session('success') }}</span>
                    </div>
                    <button @click="show = false" class="text-green-500 hover:text-green-700">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                </div>
            @endif

            @if(session('error'))
                <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 6000)"
                     class="mb-6 p-4 rounded-xl bg-[#FEF2F2] border border-[#DC2626]/20 text-[#DC2626] flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        <span class="text-sm font-semibold">{{ session('error') }}</span>
                    </div>
                    <button @click="show = false" class="text-red-500 hover:text-red-700">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                </div>
            @endif

            <!-- Page Content -->
            {{ $slot }}

        </main>
    </div>

    @livewireScripts
    @stack('scripts')
</body>
</html>
