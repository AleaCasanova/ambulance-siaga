@php
    $user = auth()->user();
    $avatarUrl = $user?->avatar_url ?? 'https://ui-avatars.com/api/?name=Tamu&color=0284C7&background=E0F2FE&bold=true';
    $userName = $user?->name ?? 'Tamu / Masyarakat';
@endphp

<header class="h-20 bg-white/95 backdrop-blur-md border-b border-slate-200/80 px-4 sm:px-6 lg:px-8 flex items-center justify-between fixed top-0 right-0 left-0 z-50 shadow-xs transition-all duration-300">
    <!-- Left side: Logo & Brand Title -->
    <div class="flex items-center gap-4">
        <a href="{{ route('home') }}" class="flex items-center gap-3 group">
            <div class="w-11 h-11 rounded-2xl bg-gradient-to-br from-sky-600 via-cyan-600 to-blue-700 flex items-center justify-center text-white font-extrabold text-xl shadow-md shadow-sky-600/30 group-hover:scale-105 transition-all">
                AS
            </div>
            <div class="flex flex-col">
                <span class="font-extrabold text-slate-900 tracking-tight text-lg leading-tight group-hover:text-sky-600 transition-colors">Ambulance Siaga</span>
                <span class="text-[11px] font-bold text-sky-600 tracking-wider uppercase">Layanan Darurat • Multi-Mitra</span>
            </div>
        </a>
    </div>

    <!-- Center/Right: Desktop Navigation Bar -->
    <nav class="hidden lg:flex items-center gap-2 xl:gap-3">
        <!-- Beranda -->
        <a href="{{ route('home') }}"
           class="px-3.5 py-2 rounded-xl text-sm font-semibold transition-all {{ request()->routeIs('home') || request()->routeIs('dashboard') ? 'text-sky-600 font-extrabold bg-sky-50' : 'text-slate-600 hover:text-sky-600 hover:bg-slate-50' }}">
            Beranda
        </a>

        <!-- Tentang Kami / Informasi GSC -->
        <a href="{{ route('masyarakat.info') }}"
           class="px-3.5 py-2 rounded-xl text-sm font-semibold transition-all {{ request()->routeIs('masyarakat.info') ? 'text-sky-600 font-extrabold bg-sky-50' : 'text-slate-600 hover:text-sky-600 hover:bg-slate-50' }}">
            Tentang Kami
        </a>

        <!-- Layanan Kami (Pesan Ambulans) -->
        <a href="{{ route('masyarakat.order.create') }}"
           class="px-3.5 py-2 rounded-xl text-sm font-semibold transition-all {{ request()->routeIs('masyarakat.order.create') ? 'text-sky-600 font-extrabold bg-sky-50' : 'text-slate-600 hover:text-sky-600 hover:bg-slate-50' }}">
            Layanan Kami
        </a>

        @if($user)
            <!-- Riwayat Pesanan Saya -->
            <a href="{{ route('masyarakat.orders.index') }}"
               class="px-3.5 py-2 rounded-xl text-sm font-semibold transition-all {{ request()->routeIs('masyarakat.orders.*') || request()->routeIs('masyarakat.tracking') ? 'text-sky-600 font-extrabold bg-sky-50' : 'text-slate-600 hover:text-sky-600 hover:bg-slate-50' }}">
                Riwayat & Tracking
            </a>

            @if($user->isSuperAdmin() || $user->isAdminOperasional())
                <!-- Dropdown Operasional -->
                <div class="relative" x-data="{ dropOps: false }">
                    <button @click="dropOps = !dropOps" @click.outside="dropOps = false"
                            class="flex items-center gap-1.5 px-3.5 py-2 rounded-xl text-sm font-semibold text-slate-600 hover:text-sky-600 hover:bg-slate-50 transition-all {{ request()->routeIs('admin.orders.*') || request()->routeIs('admin.ambulans.*') || request()->routeIs('admin.supir.*') || request()->routeIs('admin.rumahsakit.*') || request()->routeIs('admin.jadwal.*') ? 'text-sky-600 font-extrabold bg-sky-50' : '' }}">
                        <span>Operasional</span>
                        <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    <div x-show="dropOps"
                         x-transition:enter="transition ease-out duration-100"
                         x-transition:enter-start="opacity-0 scale-95"
                         x-transition:enter-end="opacity-100 scale-100"
                         x-transition:leave="transition ease-in duration-75"
                         x-transition:leave-start="opacity-100 scale-100"
                         x-transition:leave-end="opacity-0 scale-95"
                         class="absolute left-0 mt-2 w-52 bg-white rounded-2xl shadow-xl border border-slate-200/80 py-2 z-50"
                         style="display: none;">
                        <a href="{{ route('admin.orders.index') }}" class="block px-4 py-2 text-sm text-slate-700 hover:bg-sky-50 hover:text-sky-600 font-medium">Semua Order</a>
                        <a href="{{ route('admin.ambulans.index') }}" class="block px-4 py-2 text-sm text-slate-700 hover:bg-sky-50 hover:text-sky-600 font-medium">Armada Ambulans</a>
                        <a href="{{ route('admin.supir.index') }}" class="block px-4 py-2 text-sm text-slate-700 hover:bg-sky-50 hover:text-sky-600 font-medium">Supir Ambulans</a>
                        <a href="{{ route('admin.rumahsakit.index') }}" class="block px-4 py-2 text-sm text-slate-700 hover:bg-sky-50 hover:text-sky-600 font-medium">Rumah Sakit</a>
                        <a href="{{ route('admin.jadwal.index') }}" class="block px-4 py-2 text-sm text-slate-700 hover:bg-sky-50 hover:text-sky-600 font-medium">Jadwal Supir</a>
                    </div>
                </div>

                <!-- Dropdown Manajemen -->
                <div class="relative" x-data="{ dropMgmt: false }">
                    <button @click="dropMgmt = !dropMgmt" @click.outside="dropMgmt = false"
                            class="flex items-center gap-1.5 px-3.5 py-2 rounded-xl text-sm font-semibold text-slate-600 hover:text-sky-600 hover:bg-slate-50 transition-all {{ request()->routeIs('admin.users.*') || request()->routeIs('admin.laporan.*') || request()->routeIs('admin.audit.*') || request()->routeIs('admin.settings.*') ? 'text-sky-600 font-extrabold bg-sky-50' : '' }}">
                        <span>Manajemen</span>
                        <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    <div x-show="dropMgmt"
                         x-transition:enter="transition ease-out duration-100"
                         x-transition:enter-start="opacity-0 scale-95"
                         x-transition:enter-end="opacity-100 scale-100"
                         x-transition:leave="transition ease-in duration-75"
                         x-transition:leave-start="opacity-100 scale-100"
                         x-transition:leave-end="opacity-0 scale-95"
                         class="absolute left-0 mt-2 w-52 bg-white rounded-2xl shadow-xl border border-slate-200/80 py-2 z-50"
                         style="display: none;">
                        <a href="{{ route('admin.users.index') }}" class="block px-4 py-2 text-sm text-slate-700 hover:bg-sky-50 hover:text-sky-600 font-medium">Kelola Pengguna</a>
                        <a href="{{ route('admin.laporan.index') }}" class="block px-4 py-2 text-sm text-slate-700 hover:bg-sky-50 hover:text-sky-600 font-medium">Laporan & Rekap</a>
                        <a href="{{ route('admin.audit.index') }}" class="block px-4 py-2 text-sm text-slate-700 hover:bg-sky-50 hover:text-sky-600 font-medium">Log Aktivitas</a>
                        <a href="{{ route('admin.settings.index') }}" class="block px-4 py-2 text-sm text-slate-700 hover:bg-sky-50 hover:text-sky-600 font-medium">Pengaturan Sistem</a>
                    </div>
                </div>
            @endif

            @if($user->isDispatcher())
                <!-- Dispatcher Links -->
                <a href="{{ route('dispatcher.orders.index') }}"
                   class="px-3.5 py-2 rounded-xl text-sm font-semibold transition-all {{ request()->routeIs('dispatcher.orders.*') ? 'text-sky-600 font-extrabold bg-sky-50' : 'text-slate-600 hover:text-sky-600 hover:bg-slate-50' }}">
                    Order Masuk
                </a>
                <a href="{{ route('dispatcher.monitoring') }}"
                   class="px-3.5 py-2 rounded-xl text-sm font-semibold transition-all {{ request()->routeIs('dispatcher.monitoring') ? 'text-sky-600 font-extrabold bg-sky-50' : 'text-slate-600 hover:text-sky-600 hover:bg-slate-50' }}">
                    Live Monitoring
                </a>
            @endif

            @if($user->isSupir())
                <!-- Supir Links -->
                <a href="{{ route('supir.tugas.index') }}"
                   class="px-3.5 py-2 rounded-xl text-sm font-semibold transition-all {{ request()->routeIs('supir.tugas.*') ? 'text-sky-600 font-extrabold bg-sky-50' : 'text-slate-600 hover:text-sky-600 hover:bg-slate-50' }}">
                    Daftar Tugas
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
                        class="flex items-center gap-2 text-sm font-medium text-slate-700 hover:text-slate-900 focus:outline-none">
                    <img src="{{ $avatarUrl }}" alt="{{ $userName }}" class="w-9 h-9 rounded-full object-cover border-2 border-sky-500/30">
                    <span class="hidden md:inline-block max-w-[130px] truncate font-bold">{{ $userName }}</span>
                    <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
            <a href="{{ route('login') }}"
               class="inline-flex items-center gap-2 px-4 sm:px-5 py-2.5 rounded-xl bg-sky-600 hover:bg-sky-700 text-white text-sm font-extrabold shadow-md shadow-sky-600/30 transition-all">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l-4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
                </svg>
                <span>Login Akun</span>
            </a>
        @endif

        <!-- Hamburger Toggle (Mobile < lg) -->
        <button @click="mobileMenuOpen = !mobileMenuOpen"
                class="lg:hidden p-2 text-slate-600 hover:text-sky-600 hover:bg-slate-100 rounded-xl focus:outline-none transition-colors"
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

        <a href="{{ route('home') }}" @click="mobileMenuOpen = false"
           class="block px-4 py-3 rounded-xl font-bold text-sm {{ request()->routeIs('home') || request()->routeIs('dashboard') ? 'bg-sky-50 text-sky-600' : 'text-slate-700 hover:bg-slate-50' }}">
            Beranda
        </a>

        <a href="{{ route('masyarakat.info') }}" @click="mobileMenuOpen = false"
           class="block px-4 py-3 rounded-xl font-bold text-sm {{ request()->routeIs('masyarakat.info') ? 'bg-sky-50 text-sky-600' : 'text-slate-700 hover:bg-slate-50' }}">
            Tentang Kami
        </a>

        <a href="{{ route('masyarakat.order.create') }}" @click="mobileMenuOpen = false"
           class="block px-4 py-3 rounded-xl font-bold text-sm {{ request()->routeIs('masyarakat.order.create') ? 'bg-sky-50 text-sky-600' : 'text-slate-700 hover:bg-slate-50' }}">
            Layanan Kami (Pesan Ambulans)
        </a>

        @if($user)
            <a href="{{ route('masyarakat.orders.index') }}" @click="mobileMenuOpen = false"
               class="block px-4 py-3 rounded-xl font-bold text-sm {{ request()->routeIs('masyarakat.orders.*') || request()->routeIs('masyarakat.tracking') ? 'bg-sky-50 text-sky-600' : 'text-slate-700 hover:bg-slate-50' }}">
                Riwayat & Tracking
            </a>

            @if($user->isSuperAdmin() || $user->isAdminOperasional())
                <div class="pt-3 pb-1 px-4 text-xs font-black text-slate-400 uppercase tracking-wider">Operasional</div>
                <a href="{{ route('admin.orders.index') }}" class="block px-4 py-2 text-sm text-slate-700 hover:bg-sky-50 font-medium">Semua Order</a>
                <a href="{{ route('admin.ambulans.index') }}" class="block px-4 py-2 text-sm text-slate-700 hover:bg-sky-50 font-medium">Armada Ambulans</a>
                <a href="{{ route('admin.supir.index') }}" class="block px-4 py-2 text-sm text-slate-700 hover:bg-sky-50 font-medium">Supir Ambulans</a>
                <a href="{{ route('admin.rumahsakit.index') }}" class="block px-4 py-2 text-sm text-slate-700 hover:bg-sky-50 font-medium">Rumah Sakit</a>
                <a href="{{ route('admin.jadwal.index') }}" class="block px-4 py-2 text-sm text-slate-700 hover:bg-sky-50 font-medium">Jadwal Supir</a>

                <div class="pt-3 pb-1 px-4 text-xs font-black text-slate-400 uppercase tracking-wider">Manajemen</div>
                <a href="{{ route('admin.users.index') }}" class="block px-4 py-2 text-sm text-slate-700 hover:bg-sky-50 font-medium">Kelola Pengguna</a>
                <a href="{{ route('admin.laporan.index') }}" class="block px-4 py-2 text-sm text-slate-700 hover:bg-sky-50 font-medium">Laporan & Rekap</a>
                <a href="{{ route('admin.audit.index') }}" class="block px-4 py-2 text-sm text-slate-700 hover:bg-sky-50 font-medium">Log Aktivitas</a>
                <a href="{{ route('admin.settings.index') }}" class="block px-4 py-2 text-sm text-slate-700 hover:bg-sky-50 font-medium">Pengaturan Sistem</a>
            @endif

            @if($user->isDispatcher())
                <div class="pt-3 pb-1 px-4 text-xs font-black text-slate-400 uppercase tracking-wider">Pusat Kendali</div>
                <a href="{{ route('dispatcher.orders.index') }}" class="block px-4 py-2 text-sm text-slate-700 hover:bg-sky-50 font-medium">Order Masuk</a>
                <a href="{{ route('dispatcher.monitoring') }}" class="block px-4 py-2 text-sm text-slate-700 hover:bg-sky-50 font-medium">Live Monitoring</a>
            @endif

            @if($user->isSupir())
                <div class="pt-3 pb-1 px-4 text-xs font-black text-slate-400 uppercase tracking-wider">Tugas</div>
                <a href="{{ route('supir.tugas.index') }}" class="block px-4 py-2 text-sm text-slate-700 hover:bg-sky-50 font-medium">Daftar Tugas</a>
            @endif

            <div class="border-t border-slate-100 my-3"></div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                        class="w-full text-left px-4 py-3 rounded-xl font-bold text-sm text-red-600 hover:bg-red-50">
                    Keluar Akun
                </button>
            </form>
        @else
            <div class="border-t border-slate-100 my-3"></div>
            <a href="{{ route('login') }}"
               class="block text-center w-full py-3 rounded-xl bg-sky-600 text-white font-extrabold text-sm shadow-md">
                Login Akun
            </a>
        @endif
    </div>
</header>
