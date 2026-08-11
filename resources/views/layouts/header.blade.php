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
            <div class="w-14 h-14 rounded-full bg-white p-1 flex items-center justify-center shadow-lg group-hover:scale-105 transition-all overflow-hidden">
                <img src="{{ asset('images/logo_ambulansiaga.png') }}" alt="Logo Ambulance Siaga" class="w-full h-full object-contain">
            </div>
            <div class="flex flex-col">
                <span class="font-extrabold text-white font-black text-xl tracking-tight leading-none group-hover:text-primary-100 transition-colors">Ambulance Siaga</span>
                <span class="text-primary-100 text-[10px] font-bold tracking-widest uppercase mt-0.5">Layanan Darurat • Multi-Mitra</span>
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
                Layanan Kami
            </a>
        @else
            @if($user->hasRole('masyarakat') || !$user->role_id)
                <!-- MENU MASYARAKAT -->
                <a href="{{ route('home') }}" class="{{ $navBase }} {{ request()->routeIs('home') ? $navActive : $navInactive }}">
                    Beranda
                </a>
                <a href="{{ route('masyarakat.order.create') }}" class="{{ $navBase }} {{ request()->routeIs('masyarakat.order.create') ? $navActive : $navInactive }}">
                    Pesan Ambulance
                </a>
                <a href="{{ route('masyarakat.orders.index') }}" class="{{ $navBase }} {{ request()->routeIs('masyarakat.orders.*') || request()->routeIs('masyarakat.tracking') ? $navActive : $navInactive }}">
                    Riwayat & Tracking
                </a>

                @if($pendingIncompleteOrder)
                    <a href="{{ route('masyarakat.order.complete', $pendingIncompleteOrder->id) }}" class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-amber-500 hover:bg-amber-600 text-white font-extrabold text-xs shadow-lg shadow-amber-500/40 animate-pulse transition-all border-2 border-white transform hover:scale-105 ml-3">
                        <span>⚠️ LENGKAPI FORM (#{{ $pendingIncompleteOrder->kode_order }})</span>
                    </a>
                @endif
            @endif

            @if($user->isSupir())
                <!-- MENU SUPIR -->
                <a href="{{ route('supir.dashboard') }}" class="{{ $navBase }} {{ request()->routeIs('supir.dashboard') ? $navActive : $navInactive }}">
                    Dashboard
                </a>
                <a href="{{ route('supir.tugas.index') }}" class="{{ $navBase }} {{ request()->routeIs('supir.tugas.*') ? $navActive : $navInactive }}">
                    Pesanan Saya
                </a>
                <a href="#" class="{{ $navBase }} {{ $navInactive }}">
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
            <div class="flex items-center gap-2 px-3 py-1.5 rounded-full {{ $user->supir->status_online ? 'bg-emerald-50 text-emerald-700 border border-emerald-200' : 'bg-slate-100 text-slate-600 border border-slate-200' }} text-xs font-bold">
                <span class="w-2 h-2 rounded-full {{ $user->supir->status_online ? 'bg-emerald-500 animate-ping' : 'bg-slate-400' }}"></span>
                <span>{{ $user->supir->status_online ? 'ONLINE (SIAGA)' : 'OFFLINE' }}</span>
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
            <div class="flex items-center gap-4 sm:gap-5">
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
                Layanan Kami
            </a>
            <div class="border-t border-slate-100 my-3"></div>
            <a href="{{ route('login') }}" class="block text-center w-full py-3 rounded-xl bg-sky-600 text-white font-extrabold text-sm shadow-md mb-2">
                Login Akun
            </a>
            <a href="{{ route('register') }}" class="block text-center w-full py-3 rounded-xl border-2 border-sky-600 text-sky-600 font-extrabold text-sm shadow-sm">
                Daftar Akun
            </a>
        @else
            @if($user->hasRole('masyarakat') || !$user->role_id)
                <a href="{{ route('home') }}" @click="mobileMenuOpen = false"
                   class="block px-4 py-3 rounded-xl font-bold text-sm {{ request()->routeIs('home') ? 'bg-sky-50 text-sky-600' : 'text-slate-700 hover:bg-slate-50' }}">
                    Beranda
                </a>
                <a href="{{ route('masyarakat.order.create') }}" @click="mobileMenuOpen = false"
                   class="block px-4 py-3 rounded-xl font-bold text-sm {{ request()->routeIs('masyarakat.order.create') ? 'bg-sky-50 text-sky-600' : 'text-slate-700 hover:bg-slate-50' }}">
                    Pesan Ambulance
                </a>
                <a href="{{ route('masyarakat.orders.index') }}" @click="mobileMenuOpen = false"
                   class="block px-4 py-3 rounded-xl font-bold text-sm {{ request()->routeIs('masyarakat.orders.*') || request()->routeIs('masyarakat.tracking') ? 'bg-sky-50 text-sky-600' : 'text-slate-700 hover:bg-slate-50' }}">
                    Riwayat & Tracking
                </a>
            @endif

            @if($user->isSupir())
                <a href="{{ route('supir.dashboard') }}" @click="mobileMenuOpen = false" class="block px-4 py-3 rounded-xl font-bold text-sm {{ request()->routeIs('supir.dashboard') ? 'bg-sky-50 text-sky-600' : 'text-slate-700 hover:bg-slate-50' }}">
                    Dashboard
                </a>
                <a href="{{ route('supir.tugas.index') }}" @click="mobileMenuOpen = false" class="block px-4 py-3 rounded-xl font-bold text-sm {{ request()->routeIs('supir.tugas.*') ? 'bg-sky-50 text-sky-600' : 'text-slate-700 hover:bg-slate-50' }}">
                    Pesanan Saya
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
    <!-- Pop-up Modal Peringatan Lengkapi Formulir -->
    <div x-data="{ showCompleteAlertModal: true }"
         x-show="showCompleteAlertModal"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 translate-y-10 scale-95"
         x-transition:enter-end="opacity-100 translate-y-0 scale-100"
         class="fixed bottom-6 right-6 z-50 max-w-sm w-full mx-4 sm:mx-0 bg-white rounded-3xl shadow-2xl border-2 border-amber-500/90 overflow-hidden">

        <!-- Header Pop-up -->
        <div class="bg-gradient-to-r from-amber-500 via-orange-500 to-amber-600 px-5 py-3.5 text-white flex items-center justify-between shadow-xs">
            <div class="flex items-center gap-2.5">
                <span class="w-7 h-7 rounded-full bg-white text-amber-600 font-black text-sm flex items-center justify-center shadow-md animate-bounce">!</span>
                <span class="font-extrabold text-xs sm:text-sm tracking-wide uppercase">Peringatan Penting!</span>
            </div>
            <button @click="showCompleteAlertModal = false" class="text-white/80 hover:text-white font-bold text-lg px-1" title="Tutup sebentar">&times;</button>
        </div>

        <!-- Body Pop-up -->
        <div class="p-5 space-y-3.5 bg-amber-50/40">
            <p class="text-xs font-bold text-slate-800 leading-relaxed">
                Pesanan Ambulans Darurat <span class="text-amber-700 font-black px-1.5 py-0.5 rounded-lg bg-amber-100 border border-amber-200">#{{ $pendingIncompleteOrder->kode_order }}</span> membutuhkan kelengkapan formulir medis!
            </p>
            <p class="text-xs text-slate-600 font-medium leading-relaxed">
                Agar tim medis & rumah sakit rujukan dapat mempersiapkan penanganan pasien dengan cepat, silakan lengkapi formulir kebutuhan ambulans sekarang.
            </p>
            <div class="pt-1 flex items-center gap-2">
                <a href="{{ route('masyarakat.order.complete', $pendingIncompleteOrder->id) }}"
                   class="flex-1 py-3 px-4 rounded-xl bg-amber-500 hover:bg-amber-600 text-white font-extrabold text-xs text-center shadow-lg shadow-amber-500/30 transition-all transform active:scale-95 flex items-center justify-center gap-2">
                    <span>LENGKAPI FORMULIR SEKARANG</span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                    </svg>
                </a>
            </div>
        </div>
    </div>
@endif
