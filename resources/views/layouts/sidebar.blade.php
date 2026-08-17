@php
    $user = auth()->user();
    // Default style for sidebar links
    $navClass = "flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-all group overflow-hidden whitespace-nowrap";
    $inactiveClass = "text-white/70 hover:text-white hover:bg-white/10";
    $activeClass = "bg-white/20 text-white font-bold shadow-sm";
    $iconClass = "w-5 h-5 flex-shrink-0 transition-colors";
@endphp

<!-- Sidebar (Fixed) -->
<aside class="fixed inset-y-0 left-0 z-50 bg-primary-700 border-r border-primary-800 transition-all duration-300 flex flex-col transform shadow-2xl lg:shadow-none"
       :class="{
           '-translate-x-full lg:translate-x-0': !sidebarOpen,
           'translate-x-0': sidebarOpen,
           'w-20': sidebarCollapsed,
           'w-[260px]': !sidebarCollapsed
       }">
    
    <!-- Brand Header -->
    <div class="h-16 flex items-center justify-between px-4 sm:px-5 bg-primary-800 border-b border-primary-900/50 flex-shrink-0">
        <a href="{{ $user && $user->isAdmin() ? route('admin.dashboard') : ($user && $user->isMitra() ? route('mitra.dashboard') : ($user && $user->isOperator() ? route('operator.dashboard') : route('dashboard'))) }}" class="flex items-center gap-3 overflow-hidden">
            <div class="w-10 h-10 flex items-center justify-center flex-shrink-0 bg-white rounded-full p-0.5 shadow-sm overflow-hidden">
                <img src="{{ asset('images/logo_ambulansiaga.png') }}" alt="Logo" class="w-full h-full object-contain">
            </div>
            <div class="flex flex-col transition-opacity duration-300" :class="sidebarCollapsed ? 'opacity-0 w-0' : 'opacity-100 w-auto'">
                <span class="text-white font-bold tracking-wide text-sm whitespace-nowrap">AMBULANCE SIAGA</span>
                <span class="text-white/80 font-bold text-[10px] uppercase tracking-wider whitespace-nowrap">
                    {{ $user && $user->isMitra() ? 'Portal Mitra' : ($user && $user->isOperator() ? 'Operator Panel' : 'Admin Panel') }}
                </span>
            </div>
        </a>

        <!-- Mobile Close Button (X) -->
        <button @click="sidebarOpen = false" 
                class="lg:hidden p-1.5 rounded-lg text-white/70 hover:text-white hover:bg-white/10 transition-colors focus:outline-none"
                title="Tutup Menu Sidebar">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>
    </div>

    <!-- Navigation Scrollable Area -->
    <nav class="flex-1 overflow-y-auto overflow-x-hidden py-6 px-3 space-y-6">

        @if($user && ($user->isAdmin() || $user->isOperator()))
            <!-- SECTION: UTAMA -->
            <div>
                <p class="px-3 mb-2 text-[10px] font-bold text-white/60 uppercase tracking-wider transition-opacity duration-300" :class="sidebarCollapsed ? 'opacity-0' : 'opacity-100'">
                    Utama
                </p>
                <div class="space-y-1">
                    <a href="{{ $user->isAdmin() ? route('admin.dashboard') : route('operator.dashboard') }}" 
                       class="{{ $navClass }} {{ request()->routeIs('*.dashboard') ? $activeClass : $inactiveClass }}" title="Dashboard">
                        <svg class="{{ $iconClass }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/></svg>
                        <span class="transition-opacity duration-300" :class="sidebarCollapsed ? 'opacity-0' : 'opacity-100'">Dashboard</span>
                    </a>
                    
                    @if($user->isOperator())
                        <a href="{{ route('operator.monitoring') }}" 
                           class="{{ $navClass }} {{ request()->routeIs('operator.monitoring') ? $activeClass : $inactiveClass }}" title="Monitoring Ambulans">
                            <svg class="{{ $iconClass }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"/></svg>
                            <span class="transition-opacity duration-300" :class="sidebarCollapsed ? 'opacity-0' : 'opacity-100'">Monitoring Ambulans</span>
                        </a>
                    @endif
                </div>
            </div>

            <!-- SECTION: OPERASIONAL -->
            <div>
                <p class="px-3 mb-2 text-[10px] font-bold text-white/60 uppercase tracking-wider transition-opacity duration-300" :class="sidebarCollapsed ? 'opacity-0' : 'opacity-100'">
                    Operasional
                </p>
                <div class="space-y-1">
                    <a href="{{ $user->isAdmin() ? route('admin.orders.index') : route('operator.orders.index') }}" 
                       class="{{ $navClass }} {{ request()->routeIs('*.orders.*') ? $activeClass : $inactiveClass }}" title="Permintaan Layanan">
                        <svg class="{{ $iconClass }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/></svg>
                        <span class="transition-opacity duration-300" :class="sidebarCollapsed ? 'opacity-0' : 'opacity-100'">Permintaan Layanan</span>
                    </a>

                    @if($user->isAdmin())
                        <a href="{{ route('admin.ambulans.index') }}" 
                            class="{{ $navClass }} {{ request()->routeIs('admin.ambulans.*') ? $activeClass : $inactiveClass }}" title="Data Ambulans">
                            <svg class="{{ $iconClass }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                            <span class="transition-opacity duration-300" :class="sidebarCollapsed ? 'opacity-0' : 'opacity-100'">Data Ambulans</span>
                        </a>
                        <a href="{{ route('admin.supir.index') }}" 
                            class="{{ $navClass }} {{ request()->routeIs('admin.supir.*') ? $activeClass : $inactiveClass }}" title="Data Driver">
                            <svg class="{{ $iconClass }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                            <span class="transition-opacity duration-300" :class="sidebarCollapsed ? 'opacity-0' : 'opacity-100'">Data Driver</span>
                        </a>
                        <a href="{{ route('admin.jadwal.index') }}" 
                            class="{{ $navClass }} {{ request()->routeIs('admin.jadwal.*') ? $activeClass : $inactiveClass }}" title="Jadwal & Penugasan">
                            <svg class="{{ $iconClass }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2-2v12a2 2 0 002 2z"/></svg>
                            <span class="transition-opacity duration-300" :class="sidebarCollapsed ? 'opacity-0' : 'opacity-100'">Jadwal & Penugasan</span>
                        </a>
                        <a href="{{ route('admin.rumahsakit.index') }}" 
                            class="{{ $navClass }} {{ request()->routeIs('admin.rumahsakit.*') ? $activeClass : $inactiveClass }}" title="Rumah Sakit">
                            <svg class="{{ $iconClass }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                            <span class="transition-opacity duration-300" :class="sidebarCollapsed ? 'opacity-0' : 'opacity-100'">Rumah Sakit Mitra</span>
                        </a>
                    @endif
                </div>
            </div>

            @if($user->isAdmin())
                <!-- SECTION: DONASI & KEUANGAN -->
                <div>
                    <p class="px-3 mb-2 text-[10px] font-bold text-white/60 uppercase tracking-wider transition-opacity duration-300" :class="sidebarCollapsed ? 'opacity-0' : 'opacity-100'">
                        Keuangan
                    </p>
                    <div class="space-y-1">
                        <a href="{{ route('admin.donasi.index') }}" 
                            class="{{ $navClass }} {{ request()->routeIs('admin.donasi.*') ? $activeClass : $inactiveClass }}" title="Transaksi Donasi">
                            <svg class="{{ $iconClass }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            <span class="transition-opacity duration-300" :class="sidebarCollapsed ? 'opacity-0' : 'opacity-100'">Transaksi Donasi</span>
                        </a>
                        <a href="{{ route('admin.laporan.index') }}" 
                            class="{{ $navClass }} {{ request()->routeIs('admin.laporan.*') ? $activeClass : $inactiveClass }}" title="Laporan Keuangan">
                            <svg class="{{ $iconClass }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                            <span class="transition-opacity duration-300" :class="sidebarCollapsed ? 'opacity-0' : 'opacity-100'">Laporan & Rekap</span>
                        </a>
                    </div>
                </div>

                <!-- SECTION: SISTEM -->
                <div>
                    <p class="px-3 mb-2 text-[10px] font-bold text-white/60 uppercase tracking-wider transition-opacity duration-300" :class="sidebarCollapsed ? 'opacity-0' : 'opacity-100'">
                        Sistem
                    </p>
                    <div class="space-y-1">
                        <a href="{{ route('admin.users.index') }}" 
                            class="{{ $navClass }} {{ request()->routeIs('admin.users.*') ? $activeClass : $inactiveClass }}" title="Data Pengguna">
                            <svg class="{{ $iconClass }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                            <span class="transition-opacity duration-300" :class="sidebarCollapsed ? 'opacity-0' : 'opacity-100'">Data Pengguna</span>
                        </a>
                        <a href="{{ route('admin.audit.index') }}" 
                            class="{{ $navClass }} {{ request()->routeIs('admin.audit.*') ? $activeClass : $inactiveClass }}" title="Log Aktivitas">
                            <svg class="{{ $iconClass }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            <span class="transition-opacity duration-300" :class="sidebarCollapsed ? 'opacity-0' : 'opacity-100'">Log Aktivitas</span>
                        </a>
                        <a href="{{ route('admin.settings.index') }}" 
                            class="{{ $navClass }} {{ request()->routeIs('admin.settings.*') ? $activeClass : $inactiveClass }}" title="Pengaturan Sistem">
                            <svg class="{{ $iconClass }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            <span class="transition-opacity duration-300" :class="sidebarCollapsed ? 'opacity-0' : 'opacity-100'">Pengaturan Sistem</span>
                        </a>
                    </div>
                </div>
            @endif

        @elseif($user && $user->isMitra())
            <!-- SECTION: UTAMA (MITRA) -->
            <div>
                <p class="px-3 mb-2 text-[10px] font-bold text-white/60 uppercase tracking-wider transition-opacity duration-300" :class="sidebarCollapsed ? 'opacity-0' : 'opacity-100'">
                    Utama
                </p>
                <div class="space-y-1">
                    <a href="{{ route('mitra.dashboard') }}" 
                       class="{{ $navClass }} {{ request()->routeIs('mitra.dashboard') ? $activeClass : $inactiveClass }}" title="Dashboard Mitra">
                        <svg class="{{ $iconClass }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/></svg>
                        <span class="transition-opacity duration-300" :class="sidebarCollapsed ? 'opacity-0' : 'opacity-100'">Dashboard Mitra</span>
                    </a>
                </div>
            </div>

            <!-- SECTION: ARMADA & PETUGAS (MITRA) -->
            <div>
                <p class="px-3 mb-2 text-[10px] font-bold text-white/60 uppercase tracking-wider transition-opacity duration-300" :class="sidebarCollapsed ? 'opacity-0' : 'opacity-100'">
                    Armada & Driver
                </p>
                <div class="space-y-1">
                    <a href="{{ route('mitra.ambulans.index') }}" 
                       class="{{ $navClass }} {{ request()->routeIs('mitra.ambulans.*') ? $activeClass : $inactiveClass }}" title="Armada Lembaga">
                        <svg class="{{ $iconClass }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                        <span class="transition-opacity duration-300" :class="sidebarCollapsed ? 'opacity-0' : 'opacity-100'">Armada Lembaga</span>
                    </a>
                    <a href="{{ route('mitra.supir.index') }}" 
                       class="{{ $navClass }} {{ request()->routeIs('mitra.supir.*') ? $activeClass : $inactiveClass }}" title="Driver Lembaga">
                        <svg class="{{ $iconClass }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                        <span class="transition-opacity duration-300" :class="sidebarCollapsed ? 'opacity-0' : 'opacity-100'">Driver Lembaga</span>
                    </a>
                </div>
            </div>

            <!-- SECTION: MISI & OPERASIONAL (MITRA) -->
            <div>
                <p class="px-3 mb-2 text-[10px] font-bold text-white/60 uppercase tracking-wider transition-opacity duration-300" :class="sidebarCollapsed ? 'opacity-0' : 'opacity-100'">
                    Misi & Operasional
                </p>
                <div class="space-y-1">
                    <a href="{{ route('mitra.orders.index') }}" 
                       class="{{ $navClass }} {{ request()->routeIs('mitra.orders.*') ? $activeClass : $inactiveClass }}" title="Riwayat Penugasan">
                        <svg class="{{ $iconClass }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/></svg>
                        <span class="transition-opacity duration-300" :class="sidebarCollapsed ? 'opacity-0' : 'opacity-100'">Riwayat Penugasan</span>
                    </a>
                </div>
            </div>

        @else
            <!-- Non Admin/Operator/Mitra links back to public view if they somehow get here -->
            <a href="{{ route('home') }}" class="{{ $navClass }} {{ $inactiveClass }}">
                <svg class="{{ $iconClass }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                <span class="transition-opacity duration-300" :class="sidebarCollapsed ? 'opacity-0' : 'opacity-100'">Kembali ke Beranda</span>
            </a>
        @endif

    </nav>
</aside>
