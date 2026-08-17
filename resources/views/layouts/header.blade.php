@php
    $user = auth()->user();
    $avatarUrl = $user?->avatar_url ?? 'https://ui-avatars.com/api/?name=Tamu&color=0284C7&background=E0F2FE&bold=true';
    $userName = $user?->name ?? 'Tamu / Masyarakat';

    $pendingIncompleteOrder = null;
    if ($user && ($user->hasRole('masyarakat') || !$user->role_id)) {
        $pendingIncompleteOrder = \App\Models\Pemesanan::where('user_id', $user->id)
            ->whereNotIn('status', ['selesai', 'dibatalkan'])
            ->latest('id')
            ->get()
            ->first(function ($order) {
                return $order->needsFormCompletion();
            });
    }
@endphp

<header x-data="{ scrolled: false }" 
        @scroll.window="scrolled = (window.pageYOffset > 20)"
        :class="scrolled ? 'bg-primary-700/95 shadow-md border-white/10' : 'bg-transparent border-transparent'"
        class="h-20 backdrop-blur-md border-b px-4 sm:px-6 lg:px-8 flex items-center justify-between fixed top-0 right-0 left-0 z-50 transition-all duration-300">
    <!-- Left side: Logo & Brand Title -->
    <div class="flex items-center gap-4">
        <a href="{{ route('home') }}" class="flex items-center gap-3.5 group">
            <div class="w-10 h-10 sm:w-14 sm:h-14 rounded-full bg-white p-1 flex items-center justify-center shadow-lg group-hover:scale-105 transition-all overflow-hidden">
                <img src="{{ asset('images/logo_ambulansiaga.png') }}" alt="Logo Ambulance Siaga" class="w-full h-full object-contain">
            </div>
            <div class="flex flex-col">
                <span class="font-extrabold text-white font-black text-lg sm:text-xl tracking-tight leading-none group-hover:text-primary-100 transition-colors">Ambulance Siaga</span>
                <span class="text-primary-100 text-[8px] sm:text-[10px] font-bold tracking-widest uppercase mt-0.5">Layanan Darurat • Multi-Mitra</span>
            </div>
        </a>
    </div>

    <!-- Center/Right: Desktop Navigation Bar -->
    @php
        $navBase = "relative py-2 text-sm font-semibold transition-all after:absolute after:bottom-0 after:left-0 after:w-full after:h-[2px] after:bg-white after:transition-transform after:origin-left";
        $navActive = "text-white font-extrabold after:scale-x-100 group-hover:after:scale-x-0 hover:!after:scale-x-100";
        $navInactive = "text-white/80 hover:text-white after:scale-x-0 hover:after:scale-x-100";
    @endphp
    <nav class="hidden lg:flex items-center gap-3 xl:gap-4 group">
        @if(!$user)
            <!-- MENU GUEST -->
            <a href="{{ route('home') }}" class="{{ $navBase }} {{ request()->routeIs('home') ? $navActive : $navInactive }}">
                Beranda
            </a>
            <a href="{{ route('masyarakat.info') }}" class="{{ $navBase }} {{ request()->routeIs('masyarakat.info') ? $navActive : $navInactive }}">
                Tentang Kami
            </a>
            <a href="{{ route('masyarakat.order.create') }}" class="{{ $navBase }} {{ request()->routeIs('masyarakat.order.create') ? $navActive : $navInactive }}">
                Pesan Ambulans
            </a>
            <a href="{{ route('donasi') }}" class="{{ $navBase }} {{ request()->routeIs('donasi') ? $navActive : $navInactive }}">
                Donasi & Infaq
            </a>

            <!-- Dropdown Mitra (Guest) -->
            <div class="relative" x-data="{ dropMitra: false }">
                <button @click="dropMitra = !dropMitra" @click.outside="dropMitra = false" class="flex items-center gap-1 {{ $navBase }} {{ request()->routeIs('mitra.*') ? $navActive : $navInactive }}" :class="{ '!text-white !after:scale-x-100': dropMitra }">
                    <span>Kemitraan</span>
                    <svg class="w-3.5 h-3.5 transition-transform" :class="{ 'rotate-180': dropMitra }" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                </button>
                <div x-show="dropMitra" x-transition.opacity.duration.200ms class="absolute left-0 mt-3 w-64 bg-white rounded-2xl shadow-xl border border-slate-100 p-2 z-50" style="display: none;">
                    <a href="{{ route('mitra.pengemudi') }}" class="flex items-center gap-2.5 px-4 py-3 rounded-xl text-xs text-slate-700 hover:text-primary-600 hover:bg-sky-50 font-bold transition-all">
                        <svg class="w-4 h-4 text-primary-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                        <span>Pengemudi Ambulans</span>
                    </a>
                    <a href="{{ route('mitra.armada') }}" class="flex items-center gap-2.5 px-4 py-3 rounded-xl text-xs text-slate-700 hover:text-primary-600 hover:bg-sky-50 font-bold transition-all">
                        <svg class="w-4 h-4 text-primary-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h8m-8 4h8m-8 4h4m5-10H5a2 2 0 00-2 2v10a2 2 0 002 2h14a2 2 0 002-2V7a2 2 0 00-2-2z"/></svg>
                        <span>Mitra Ambulans / Pemilik Armada</span>
                    </a>
                </div>
            </div>
        @else
            @if($user->hasRole('masyarakat') || !$user->role_id)
                <!-- MENU MASYARAKAT -->
                <a href="{{ route('masyarakat.dashboard') }}" class="{{ $navBase }} {{ request()->routeIs('masyarakat.dashboard') ? $navActive : $navInactive }}">
                    Pusat Siaga
                </a>
                <a href="{{ route('masyarakat.order.create') }}" class="{{ $navBase }} {{ request()->routeIs('masyarakat.order.create') ? $navActive : $navInactive }}">
                    Pesan Ambulans
                </a>
                <a href="{{ route('masyarakat.orders.index') }}" class="{{ $navBase }} {{ request()->routeIs('masyarakat.orders.*') || request()->routeIs('masyarakat.tracking') ? $navActive : $navInactive }}">
                    Pesanan Saya
                </a>
                <a href="{{ route('donasi') }}" class="{{ $navBase }} {{ request()->routeIs('donasi') ? $navActive : $navInactive }}">
                    Donasi & Infaq
                </a>

                <!-- Dropdown Informasi & Layanan (Masyarakat) -->
                <div class="relative" x-data="{ dropInfoUser: false }">
                    <button @click="dropInfoUser = !dropInfoUser" @click.outside="dropInfoUser = false" class="flex items-center gap-1 {{ $navBase }} {{ request()->routeIs('mitra.*') || request()->routeIs('masyarakat.info') ? $navActive : $navInactive }}" :class="{ '!text-white !after:scale-x-100': dropInfoUser }">
                        <span>Informasi & Layanan</span>
                        <svg class="w-3.5 h-3.5 transition-transform" :class="{ 'rotate-180': dropInfoUser }" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </button>
                    <div x-show="dropInfoUser" x-transition.opacity.duration.200ms class="absolute left-0 mt-3 w-64 bg-white rounded-2xl shadow-xl border border-slate-100 p-2 z-50" style="display: none;">
                        <a href="{{ route('masyarakat.dashboard') }}#rumah-sakit" class="flex items-center gap-2.5 px-4 py-2.5 rounded-xl text-xs text-slate-700 hover:text-primary-600 hover:bg-sky-50 font-bold transition-all">
                            <svg class="w-4 h-4 text-emerald-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                            <span>Rumah Sakit & IGD 24 Jam</span>
                        </a>
                        <a href="{{ route('masyarakat.dashboard') }}#panduan-p3k" class="flex items-center gap-2.5 px-4 py-2.5 rounded-xl text-xs text-slate-700 hover:text-primary-600 hover:bg-sky-50 font-bold transition-all">
                            <svg class="w-4 h-4 text-red-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                            <span>Panduan P3K Darurat</span>
                        </a>
                        <div class="border-t border-slate-100 my-1"></div>
                        <a href="{{ route('mitra.pengemudi') }}" class="flex items-center gap-2.5 px-4 py-2.5 rounded-xl text-xs text-slate-700 hover:text-primary-600 hover:bg-sky-50 font-bold transition-all">
                            <svg class="w-4 h-4 text-primary-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                            <span>Gabung Pengemudi</span>
                        </a>
                        <a href="{{ route('mitra.armada') }}" class="flex items-center gap-2.5 px-4 py-2.5 rounded-xl text-xs text-slate-700 hover:text-primary-600 hover:bg-sky-50 font-bold transition-all">
                            <svg class="w-4 h-4 text-primary-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h8m-8 4h8m-8 4h4m5-10H5a2 2 0 00-2 2v10a2 2 0 002 2h14a2 2 0 002-2V7a2 2 0 00-2-2z"/></svg>
                            <span>Gabung Mitra Armada</span>
                        </a>
                        <div class="border-t border-slate-100 my-1"></div>
                        <a href="{{ route('masyarakat.info') }}" class="flex items-center gap-2.5 px-4 py-2.5 rounded-xl text-xs text-slate-700 hover:text-primary-600 hover:bg-sky-50 font-bold transition-all">
                            <svg class="w-4 h-4 text-slate-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            <span>Tentang Yayasan GSC</span>
                        </a>
                    </div>
                </div>
            @endif

            @if($user->isSupir())
                <!-- MENU SUPIR -->
                <a href="{{ route('supir.dashboard') }}" class="{{ $navBase }} {{ request()->routeIs('supir.dashboard') ? $navActive : $navInactive }}">
                    Dashboard
                </a>
                <a href="{{ route('supir.tugas.index') }}" class="{{ $navBase }} {{ request()->routeIs('supir.tugas.*') ? $navActive : $navInactive }}">
                    Tugas
                </a>
                <a href="{{ route('supir.perjalanan.aktif') }}" class="{{ $navBase }} {{ request()->routeIs('supir.perjalanan.aktif') || request()->routeIs('supir.orders.show') ? $navActive : $navInactive }}">
                    Perjalanan Aktif
                </a>
            @endif

            @if($user->isOperator() || $user->isAdmin())
                <!-- MENU OPERATOR & ADMIN -->
                <a href="{{ $user->isAdmin() ? route('admin.dashboard') : route('operator.dashboard') }}" class="{{ $navBase }} {{ request()->routeIs('admin.dashboard') || request()->routeIs('operator.dashboard') ? $navActive : $navInactive }}">
                    Dashboard
                </a>
            @endif

            @if($user->isOperator())
                <!-- Dropdown Operasional (Operator) -->
                <div class="relative" x-data="{ dropOps: false }">
                    <button @click="dropOps = !dropOps" @click.outside="dropOps = false" class="flex items-center gap-1.5 {{ $navBase }} {{ request()->routeIs('operator.orders.*') || request()->routeIs('operator.monitoring') ? $navActive : $navInactive }}" :class="{ '!text-white !after:scale-x-100': dropOps }">
                        <span>Operasional</span>
                        <svg class="w-4 h-4 text-white/60" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </button>
                    <div x-show="dropOps" x-transition class="absolute left-0 mt-2 w-52 bg-white rounded-2xl shadow-xl border border-slate-200 py-2 z-50" style="display: none;">
                        <a href="{{ route('operator.orders.index') }}" class="block px-4 py-2 text-sm text-slate-700 hover:bg-sky-50 font-medium">Permintaan Ambulance</a>
                        <a href="{{ route('operator.monitoring') }}" class="block px-4 py-2 text-sm text-slate-700 hover:bg-sky-50 font-medium">Tracking Aktif</a>
                    </div>
                </div>
            @endif

            @if($user->isAdmin())

                <!-- Dropdown Operasional -->
                <div class="relative" x-data="{ dropOps: false }">
                    <button @click="dropOps = !dropOps" @click.outside="dropOps = false" class="flex items-center gap-1.5 {{ $navBase }} {{ request()->routeIs('admin.orders.*') || request()->routeIs('admin.ambulans.*') || request()->routeIs('admin.supir.*') || request()->routeIs('admin.rumahsakit.*') || request()->routeIs('admin.jadwal.*') ? $navActive : $navInactive }}" :class="{ '!text-white !after:scale-x-100': dropOps }">
                        <span>Operasional</span>
                        <svg class="w-4 h-4 text-white/60" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </button>
                    <div x-show="dropOps" x-transition class="absolute left-0 mt-2 w-52 bg-white rounded-2xl shadow-xl border border-slate-200 py-2 z-50" style="display: none;">
                        <a href="{{ route('admin.orders.index') }}" class="block px-4 py-2 text-sm text-slate-700 hover:bg-sky-50 font-medium">Semua Order</a>
                        <a href="{{ route('admin.ambulans.index') }}" class="block px-4 py-2 text-sm text-slate-700 hover:bg-sky-50 font-medium">Armada Ambulans</a>
                        <a href="{{ route('admin.supir.index') }}" class="block px-4 py-2 text-sm text-slate-700 hover:bg-sky-50 font-medium">Supir Ambulans</a>
                        <a href="{{ route('admin.rumahsakit.index') }}" class="block px-4 py-2 text-sm text-slate-700 hover:bg-sky-50 font-medium">Rumah Sakit</a>
                        <a href="{{ route('admin.jadwal.index') }}" class="block px-4 py-2 text-sm text-slate-700 hover:bg-sky-50 font-medium">Jadwal Supir</a>
                    </div>
                </div>

                <!-- Dropdown Manajemen -->
                <div class="relative" x-data="{ dropMgmt: false }">
                    <button @click="dropMgmt = !dropMgmt" @click.outside="dropMgmt = false" class="flex items-center gap-1.5 {{ $navBase }} {{ request()->routeIs('admin.users.*') || request()->routeIs('admin.audit.*') || request()->routeIs('admin.settings.*') ? $navActive : $navInactive }}" :class="{ '!text-white !after:scale-x-100': dropMgmt }">
                        <span>Manajemen</span>
                        <svg class="w-4 h-4 text-white/60" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </button>
                    <div x-show="dropMgmt" x-transition class="absolute left-0 mt-2 w-52 bg-white rounded-2xl shadow-xl border border-slate-200 py-2 z-50" style="display: none;">
                        <a href="{{ route('admin.donasi.index') }}" class="block px-4 py-2 text-sm text-slate-700 hover:bg-sky-50 font-medium">Kelola Donasi</a>
                        <a href="{{ route('admin.users.index') }}" class="block px-4 py-2 text-sm text-slate-700 hover:bg-sky-50 font-medium">Kelola Pengguna</a>
                        <a href="{{ route('admin.audit.index') }}" class="block px-4 py-2 text-sm text-slate-700 hover:bg-sky-50 font-medium">Log Aktivitas</a>
                        <a href="{{ route('admin.settings.index') }}" class="block px-4 py-2 text-sm text-slate-700 hover:bg-sky-50 font-medium">Pengaturan Sistem</a>
                    </div>
                </div>

                <!-- Laporan -->
                <a href="{{ route('admin.laporan.index') }}" class="{{ $navBase }} {{ request()->routeIs('admin.laporan.*') ? $navActive : $navInactive }}">
                    Laporan
                </a>
            @endif
        @endif
    </nav>

    <!-- Right side: Notifikasi, User Profile / CTA -->
    <div class="flex items-center gap-2 sm:gap-3">

        @if($user && $user->isSupir() && $user->supir)
            <!-- Quick Status Online/Offline Badge untuk Supir -->
            <div class="flex items-center gap-1.5 px-3 py-1 rounded-full {{ $user->supir->status_online ? 'bg-emerald-500/20 text-white border border-emerald-300/40' : 'bg-slate-800 text-slate-300 border border-slate-700' }} text-xs font-bold">
                <span class="w-2 h-2 rounded-full {{ $user->supir->status_online ? 'bg-emerald-400 animate-ping' : 'bg-slate-400' }}"></span>
                <span>{{ $user->supir->status_online ? 'SIAGA ONLINE' : 'OFFLINE' }}</span>
            </div>
        @endif

        @if($user)
            <!-- Livewire Notification Dropdown -->
            @livewire('notification-dropdown')
        @endif

        <!-- User Dropdown OR Login CTA -->
        @if($user)
            <div class="relative" x-data="{ open: false }">
                <button @click="open = !open" @click.outside="open = false"
                        class="flex items-center gap-2 text-sm font-medium text-white/90 hover:text-white focus:outline-none">
                    <img src="{{ $avatarUrl }}" alt="{{ $userName }}" class="w-9 h-9 rounded-full object-cover border-2 border-white/30">
                    <span class="hidden md:inline-block max-w-[130px] truncate font-bold">{{ $userName }}</span>
                    <svg class="w-4 h-4 text-white/70" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>

                <!-- Dropdown Menu -->
                <div x-show="open"
                     x-transition:enter="transition ease-out duration-100"
                     x-transition:enter-start="transform opacity-0 scale-95"
                     x-transition:enter-end="transform opacity-100 scale-100"
                     x-transition:leave="transition ease-in duration-75"
                     x-transition:leave-start="transform opacity-100 scale-100"
                     x-transition:leave-end="transform opacity-0 scale-95"
                     class="absolute right-0 mt-2 w-56 bg-white rounded-2xl shadow-xl border border-slate-200/80 py-2 z-50"
                     style="display: none;">

                    <div class="px-4 py-2 border-b border-slate-100">
                        <p class="text-xs font-semibold text-slate-500">Login Sebagai</p>
                        <p class="text-sm font-bold text-slate-800 truncate">{{ $user->email }}</p>
                        <p class="text-xs text-sky-600 font-bold mt-0.5">{{ $user->role_label }}</p>
                    </div>

                    <a href="{{ route('profile.edit') }}"
                       class="flex items-center gap-2 px-4 py-2.5 text-sm text-slate-700 hover:bg-sky-50 hover:text-sky-600 font-medium transition-colors">
                        <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                        <span>Profil Saya</span>
                    </a>

                    <div class="border-t border-slate-100 my-1"></div>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                                class="w-full text-left flex items-center gap-2 px-4 py-2.5 text-sm text-red-600 hover:bg-red-50 font-semibold transition-colors">
                            <svg class="w-4 h-4 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                            </svg>
                            <span>Keluar Akun</span>
                        </button>
                    </form>

                </div>
            </div>
        @else
            <div class="hidden lg:flex items-center gap-4 sm:gap-5">
                <a href="{{ route('login') }}"
                   class="text-sm font-semibold text-white/90 hover:text-white transition-colors">
                    Login
                </a>
                
                <div class="hidden sm:block w-px h-5 bg-white/20"></div>

                <a href="{{ route('register') }}"
                   class="inline-flex items-center justify-center px-5 py-2 rounded-full bg-white hover:bg-slate-50 text-teal-600 text-sm font-bold shadow-sm hover:shadow-md transition-all">
                    Daftar Akun
                </a>
            </div>
        @endif

        <!-- Hamburger Toggle (Mobile < lg) -->
        <button @click="mobileMenuOpen = !mobileMenuOpen"
                class="lg:hidden p-2 text-white hover:text-primary-100 hover:bg-white/10 rounded-xl focus:outline-none transition-colors"
                title="Buka Menu Navigasi">
            <svg x-show="!mobileMenuOpen" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
            </svg>
            <svg x-show="mobileMenuOpen" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="display: none;">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>

    </div>

    <!-- Mobile Menu Drawer (< lg) -->
    <div x-show="mobileMenuOpen" @click.outside="mobileMenuOpen = false"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 -translate-y-4"
         x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100 translate-y-0"
         x-transition:leave-end="opacity-0 -translate-y-4"
         class="lg:hidden absolute top-20 left-0 right-0 bg-white border-b border-slate-200 shadow-2xl px-6 py-6 z-50 space-y-2"
         style="display: none;">

        @if(!$user)
            <a href="{{ route('home') }}" @click="mobileMenuOpen = false"
               class="block px-4 py-3 rounded-xl font-bold text-sm {{ request()->routeIs('home') ? 'bg-sky-50 text-sky-600' : 'text-slate-700 hover:bg-slate-50' }}">
                Beranda
            </a>
            <a href="{{ route('masyarakat.info') }}" @click="mobileMenuOpen = false"
               class="block px-4 py-3 rounded-xl font-bold text-sm {{ request()->routeIs('masyarakat.info') ? 'bg-sky-50 text-sky-600' : 'text-slate-700 hover:bg-slate-50' }}">
                Tentang Kami
            </a>
            <a href="{{ route('masyarakat.order.create') }}" @click="mobileMenuOpen = false"
               class="block px-4 py-3 rounded-xl font-bold text-sm {{ request()->routeIs('masyarakat.order.create') ? 'bg-sky-50 text-sky-600' : 'text-slate-700 hover:bg-slate-50' }}">
                Pesan Ambulans
            </a>
            <a href="{{ route('donasi') }}" @click="mobileMenuOpen = false"
               class="block px-4 py-3 rounded-xl font-bold text-sm {{ request()->routeIs('donasi') ? 'bg-sky-50 text-sky-600' : 'text-slate-700 hover:bg-slate-50' }}">
                Donasi & Infaq
            </a>

            <!-- Mobile Dropdown Mitra (Guest) -->
            <div x-data="{ openMitraMobile: false }" class="mb-2">
                <button @click="openMitraMobile = !openMitraMobile" class="w-full flex items-center justify-between px-4 py-3 rounded-xl font-bold text-sm text-slate-700 hover:bg-slate-50">
                    <span>Kemitraan</span>
                    <svg class="w-4 h-4 transition-transform" :class="{ 'rotate-180': openMitraMobile }" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                </button>
                <div x-show="openMitraMobile" x-collapse class="pl-4 pr-2 py-1 space-y-1">
                    <a href="{{ route('mitra.pengemudi') }}" @click="mobileMenuOpen = false" class="flex items-center gap-2 px-4 py-2.5 rounded-lg text-sm font-semibold {{ request()->routeIs('mitra.pengemudi') ? 'bg-sky-50 text-sky-600' : 'text-slate-600 hover:text-slate-800 hover:bg-slate-50' }}">
                        <svg class="w-4 h-4 text-primary-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                        <span>Pengemudi Ambulans</span>
                    </a>
                    <a href="{{ route('mitra.armada') }}" @click="mobileMenuOpen = false" class="flex items-center gap-2 px-4 py-2.5 rounded-lg text-sm font-semibold {{ request()->routeIs('mitra.armada') ? 'bg-sky-50 text-sky-600' : 'text-slate-600 hover:text-slate-800 hover:bg-slate-50' }}">
                        <svg class="w-4 h-4 text-primary-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h8m-8 4h8m-8 4h4m5-10H5a2 2 0 00-2 2v10a2 2 0 002 2h14a2 2 0 002-2V7a2 2 0 00-2-2z"/></svg>
                        <span>Mitra Ambulans / Pemilik Armada</span>
                    </a>
                </div>
            </div>
            <div class="border-t border-slate-100 my-3"></div>
            <a href="{{ route('login') }}" class="block text-center w-full py-3 rounded-xl bg-sky-600 text-white font-extrabold text-sm shadow-md mb-2">
                Login Akun
            </a>
            <a href="{{ route('register') }}" class="block text-center w-full py-3 rounded-xl border-2 border-sky-600 text-sky-600 font-extrabold text-sm shadow-sm">
                Daftar Akun
            </a>
        @else
            @if($user->hasRole('masyarakat') || !$user->role_id)
                <a href="{{ route('masyarakat.dashboard') }}" @click="mobileMenuOpen = false"
                   class="block px-4 py-3 rounded-xl font-bold text-sm {{ request()->routeIs('masyarakat.dashboard') ? 'bg-sky-50 text-sky-600' : 'text-slate-700 hover:bg-slate-50' }}">
                    Pusat Siaga
                </a>
                <a href="{{ route('masyarakat.order.create') }}" @click="mobileMenuOpen = false"
                   class="block px-4 py-3 rounded-xl font-bold text-sm {{ request()->routeIs('masyarakat.order.create') ? 'bg-sky-50 text-sky-600' : 'text-slate-700 hover:bg-slate-50' }}">
                    Pesan Ambulans
                </a>
                <a href="{{ route('masyarakat.orders.index') }}" @click="mobileMenuOpen = false"
                   class="block px-4 py-3 rounded-xl font-bold text-sm {{ request()->routeIs('masyarakat.orders.*') || request()->routeIs('masyarakat.tracking') ? 'bg-sky-50 text-sky-600' : 'text-slate-700 hover:bg-slate-50' }}">
                    Pesanan Saya
                </a>
                <a href="{{ route('donasi') }}" @click="mobileMenuOpen = false"
                   class="block px-4 py-3 rounded-xl font-bold text-sm {{ request()->routeIs('donasi') ? 'bg-sky-50 text-sky-600' : 'text-slate-700 hover:bg-slate-50' }}">
                    Donasi & Infaq
                </a>

                <!-- Mobile Dropdown Informasi & Layanan (Masyarakat) -->
                <div x-data="{ openInfoMobileUser: false }" class="mb-2">
                    <button @click="openInfoMobileUser = !openInfoMobileUser" class="w-full flex items-center justify-between px-4 py-3 rounded-xl font-bold text-sm text-slate-700 hover:bg-slate-50">
                        <span>Informasi & Layanan</span>
                        <svg class="w-4 h-4 transition-transform" :class="{ 'rotate-180': openInfoMobileUser }" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </button>
                    <div x-show="openInfoMobileUser" x-collapse class="pl-4 pr-2 py-1 space-y-1">
                        <a href="{{ route('masyarakat.dashboard') }}#rumah-sakit" @click="mobileMenuOpen = false" class="flex items-center gap-2 px-4 py-2.5 rounded-lg text-sm font-semibold text-slate-600 hover:text-sky-600 hover:bg-slate-50">
                            <svg class="w-4 h-4 text-emerald-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                            <span>Rumah Sakit & IGD 24 Jam</span>
                        </a>
                        <a href="{{ route('masyarakat.dashboard') }}#panduan-p3k" @click="mobileMenuOpen = false" class="flex items-center gap-2 px-4 py-2.5 rounded-lg text-sm font-semibold text-slate-600 hover:text-sky-600 hover:bg-slate-50">
                            <svg class="w-4 h-4 text-red-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                            <span>Panduan P3K Darurat</span>
                        </a>
                        <a href="{{ route('mitra.pengemudi') }}" @click="mobileMenuOpen = false" class="flex items-center gap-2 px-4 py-2.5 rounded-lg text-sm font-semibold {{ request()->routeIs('mitra.pengemudi') ? 'bg-sky-50 text-sky-600' : 'text-slate-500 hover:text-slate-700 hover:bg-slate-50' }}">
                            <svg class="w-4 h-4 text-primary-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                            <span>Gabung Pengemudi</span>
                        </a>
                        <a href="{{ route('mitra.armada') }}" @click="mobileMenuOpen = false" class="flex items-center gap-2 px-4 py-2.5 rounded-lg text-sm font-semibold {{ request()->routeIs('mitra.armada') ? 'bg-sky-50 text-sky-600' : 'text-slate-500 hover:text-slate-700 hover:bg-slate-50' }}">
                            <svg class="w-4 h-4 text-primary-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h8m-8 4h8m-8 4h4m5-10H5a2 2 0 00-2 2v10a2 2 0 002 2h14a2 2 0 002-2V7a2 2 0 00-2-2z"/></svg>
                            <span>Gabung Mitra Armada</span>
                        </a>
                        <a href="{{ route('masyarakat.info') }}" @click="mobileMenuOpen = false" class="flex items-center gap-2 px-4 py-2.5 rounded-lg text-sm font-semibold {{ request()->routeIs('masyarakat.info') ? 'bg-sky-50 text-sky-600' : 'text-slate-500 hover:text-slate-700 hover:bg-slate-50' }}">
                            <svg class="w-4 h-4 text-slate-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            <span>Tentang Yayasan GSC</span>
                        </a>
                    </div>
                </div>
            @endif

            @if($user->isSupir())
                <a href="{{ route('supir.dashboard') }}" @click="mobileMenuOpen = false" class="block px-4 py-3 rounded-xl font-bold text-sm {{ request()->routeIs('supir.dashboard') ? 'bg-sky-50 text-sky-600' : 'text-slate-700 hover:bg-slate-50' }}">
                    Dashboard
                </a>
                <a href="{{ route('supir.tugas.index') }}" @click="mobileMenuOpen = false" class="block px-4 py-3 rounded-xl font-bold text-sm {{ request()->routeIs('supir.tugas.*') ? 'bg-sky-50 text-sky-600' : 'text-slate-700 hover:bg-slate-50' }}">
                    Tugas
                </a>
            @endif

            @if($user->isOperator() || $user->isAdmin())
                <a href="{{ $user->isAdmin() ? route('admin.dashboard') : route('operator.dashboard') }}" @click="mobileMenuOpen = false" class="block px-4 py-3 rounded-xl font-bold text-sm text-slate-700 hover:bg-slate-50">
                    Dashboard
                </a>
                <div class="pt-3 pb-1 px-4 text-xs font-black text-slate-400 uppercase tracking-wider">Operasional</div>
                <a href="{{ route('operator.orders.index') }}" class="block px-4 py-2 text-sm text-slate-700 hover:bg-sky-50 font-medium">Permintaan Ambulance</a>
                <a href="{{ route('operator.monitoring') }}" class="block px-4 py-2 text-sm text-slate-700 hover:bg-sky-50 font-medium">Tracking Aktif</a>
            @endif

            @if($user->isAdmin())
                <div class="pt-3 pb-1 px-4 text-xs font-black text-slate-400 uppercase tracking-wider">Operasional</div>
                <a href="{{ route('admin.orders.index') }}" class="block px-4 py-2 text-sm text-slate-700 hover:bg-sky-50 font-medium">Semua Order</a>
                <a href="{{ route('admin.ambulans.index') }}" class="block px-4 py-2 text-sm text-slate-700 hover:bg-sky-50 font-medium">Armada Ambulans</a>
                <a href="{{ route('admin.supir.index') }}" class="block px-4 py-2 text-sm text-slate-700 hover:bg-sky-50 font-medium">Supir Ambulans</a>
                <a href="{{ route('admin.rumahsakit.index') }}" class="block px-4 py-2 text-sm text-slate-700 hover:bg-sky-50 font-medium">Rumah Sakit</a>
                <a href="{{ route('admin.jadwal.index') }}" class="block px-4 py-2 text-sm text-slate-700 hover:bg-sky-50 font-medium">Jadwal Supir</a>

                <div class="pt-3 pb-1 px-4 text-xs font-black text-slate-400 uppercase tracking-wider">Manajemen</div>
                <a href="{{ route('admin.donasi.index') }}" class="block px-4 py-2 text-sm text-slate-700 hover:bg-sky-50 font-medium">Kelola Donasi</a>
                <a href="{{ route('admin.users.index') }}" class="block px-4 py-2 text-sm text-slate-700 hover:bg-sky-50 font-medium">Kelola Pengguna</a>
                <a href="{{ route('admin.audit.index') }}" class="block px-4 py-2 text-sm text-slate-700 hover:bg-sky-50 font-medium">Log Aktivitas</a>
                <a href="{{ route('admin.settings.index') }}" class="block px-4 py-2 text-sm text-slate-700 hover:bg-sky-50 font-medium">Pengaturan Sistem</a>

                <div class="pt-3 pb-1 px-4 text-xs font-black text-slate-400 uppercase tracking-wider">Laporan</div>
                <a href="{{ route('admin.laporan.index') }}" class="block px-4 py-2 text-sm text-slate-700 hover:bg-sky-50 font-medium">Laporan Sistem</a>
            @endif

            <div class="border-t border-slate-100 my-3"></div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                        class="w-full text-left px-4 py-3 rounded-xl font-bold text-sm text-red-600 hover:bg-red-50">
                    Keluar Akun
                </button>
            </form>
        @endif
    </div>
</header>

@if($pendingIncompleteOrder && !request()->routeIs('masyarakat.order.complete'))
    <!-- Action Reminder: Notifikasi Data Pesanan Belum Lengkap (Dengan Animasi Penarik Perhatian) -->
    <div x-data="{ showCompleteAlertModal: true }"
         x-show="showCompleteAlertModal"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 translate-y-6 scale-90"
         x-transition:enter-end="opacity-100 translate-y-0 scale-100"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100 translate-y-0 scale-100"
         x-transition:leave-end="opacity-0 translate-y-4 scale-95"
         class="fixed bottom-20 lg:bottom-5 right-5 z-50 w-80 max-w-[calc(100vw-2.5rem)] bg-white rounded-xl shadow-xl shadow-amber-500/15 border border-amber-300 ring-2 ring-amber-400/30 overflow-hidden transition-all hover:shadow-2xl hover:shadow-amber-500/20">

        <!-- Header Reminder -->
        <div class="px-3.5 py-2.5 bg-gradient-to-r from-amber-50/90 to-amber-100/60 border-b border-amber-200/80 flex items-center justify-between">
            <div class="flex items-center gap-2.5">
                <!-- Pulsing Beacon Radar -->
                <span class="relative flex h-2.5 w-2.5 shrink-0">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-amber-400 opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-amber-500"></span>
                </span>
                <span class="font-bold text-xs text-amber-900 tracking-tight">Data Pesanan Belum Lengkap</span>
            </div>
            <button @click="showCompleteAlertModal = false" class="text-amber-700/60 hover:text-amber-900 font-bold text-base leading-none p-0.5 rounded hover:bg-amber-200/50 transition-colors" title="Tutup Pengingat">&times;</button>
        </div>

        <!-- Body Reminder -->
        <div class="p-3.5 space-y-2.5">
            <div class="flex items-center justify-between">
                <span class="inline-block font-mono text-[11px] font-bold text-amber-900 bg-amber-50 px-2 py-0.5 rounded border border-amber-200">
                    #{{ $pendingIncompleteOrder->kode_order }}
                </span>
                <span class="text-[10px] font-extrabold text-amber-600 uppercase tracking-wider flex items-center gap-1 animate-pulse">
                    <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span> Tindakan Diperlukan
                </span>
            </div>
            <p class="text-xs text-slate-600 font-normal leading-relaxed">
                Lengkapi formulir medis agar tim ambulans dapat mempersiapkan penanganan pasien secara tepat.
            </p>
            <div class="pt-0.5">
                <a href="{{ route('masyarakat.order.complete', $pendingIncompleteOrder->id) }}"
                   class="group relative w-full py-2.5 px-3 rounded-lg bg-gradient-to-r from-amber-500 to-amber-600 hover:from-amber-600 hover:to-amber-700 text-white font-bold text-xs text-center shadow-md shadow-amber-500/30 transition-all transform active:scale-95 flex items-center justify-center gap-1.5">
                    <span>Lengkapi Data Medis</span>
                    <svg class="w-3.5 h-3.5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                </a>
            </div>
        </div>
    </div>
@endif
