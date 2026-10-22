@php
    $user = auth()->user();
    $avatarUrl = $user?->avatar_url ?? 'https://ui-avatars.com/api/?name=Tamu&color=009CA6&background=f0fdfa&bold=true';
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

    // Bottom navigation aktif untuk Masyarakat & Supir, sehingga search & hamburger tidak perlu tampil di header mobile
    $hasBottomNav = $user && ($user->hasRole('masyarakat') || !$user->role_id || $user->isSupir());
@endphp

<header x-data="{ 
            scrolled: false, 
            mobileMenuOpen: false, 
            searchQuery: '',
            handleSearch() {
                const q = this.searchQuery.toLowerCase().trim();
                if (!q) return;
                if (q.includes('rumah') || q.includes('sakit') || q.includes('rs') || q.includes('igd') || q.includes('faskes')) {
                    const el = document.getElementById('rumah-sakit');
                    if (el) { el.scrollIntoView({ behavior: 'smooth' }); } 
                    else { window.location.href = '{{ route('home') }}#rumah-sakit'; }
                } else if (q.includes('donasi') || q.includes('infaq') || q.includes('bantu') || q.includes('sedekah')) {
                    window.location.href = '{{ route('donasi') }}';
                } else if (q.includes('pesan') || q.includes('order') || q.includes('darurat') || q.includes('ambulan')) {
                    window.location.href = '{{ route('masyarakat.order.create') }}';
                } else if (q.includes('tentang') || q.includes('info') || q.includes('profil')) {
                    window.location.href = '{{ route('masyarakat.info') }}';
                } else if (q.includes('mitra') || q.includes('driver') || q.includes('supir')) {
                    window.location.href = '{{ route('mitra.pengemudi') }}';
                } else {
                    const el = document.getElementById('layanan');
                    if (el) { el.scrollIntoView({ behavior: 'smooth' }); } 
                    else { window.location.href = '{{ route('home') }}#layanan'; }
                }
            }
        }" 
        @scroll.window="scrolled = (window.pageYOffset > 10)"
        @keydown.escape.window="mobileMenuOpen = false"
        x-effect="document.body.style.overflow = mobileMenuOpen ? 'hidden' : ''"
        :class="scrolled ? 'bg-white/95 shadow-md border-slate-200' : 'bg-white border-slate-100 shadow-xs'"
        class="h-20 backdrop-blur-md border-b px-4 sm:px-6 lg:px-8 flex items-center justify-between fixed top-0 right-0 left-0 z-50 transition-all duration-300">
    
    <!-- Left side: Brand Logo & Dompet Dhuafa Style Search Bar -->
    <div class="flex items-center gap-3 sm:gap-4 lg:gap-5">
        <a href="{{ route('home') }}" class="flex items-center gap-2.5 sm:gap-3 group shrink-0">
            <div class="w-10 h-10 sm:w-11 sm:h-11 rounded-full bg-primary-50 border border-primary-100 p-1 flex items-center justify-center shadow-xs group-hover:scale-105 transition-all overflow-hidden">
                <img src="{{ asset('images/logo_ambulansiaga.png') }}" alt="Logo Ambulans Siaga" class="w-full h-full object-contain">
            </div>
            <div class="flex flex-col">
                <span class="font-black text-slate-800 text-base sm:text-lg lg:text-xl tracking-tight leading-none group-hover:text-primary-600 transition-colors">Ambulans Siaga</span>
                <span class="text-primary-600 text-[8px] sm:text-[9px] font-extrabold tracking-widest uppercase mt-0.5">Layanan Darurat • Multi-Mitra</span>
            </div>
        </a>

        <!-- Dompet Dhuafa Style Search Bar (Next to Logo) -->
        <div class="hidden md:block ml-6 sm:ml-10 lg:ml-14">
            <form @submit.prevent="handleSearch()" class="relative">
                <div class="flex items-center gap-2 bg-[#f2f4f7] hover:bg-[#e9ecf0] focus-within:bg-white focus-within:ring-2 focus-within:ring-primary-500/20 focus-within:border-primary-500 border border-slate-200/60 rounded-lg px-3 py-1.5 transition-all w-44 lg:w-48 xl:w-60">
                    <svg class="w-4 h-4 text-slate-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                    <input x-model="searchQuery" 
                           type="text" 
                           placeholder="Cari Program / Layanan" 
                           class="bg-transparent border-0 p-0 text-xs xl:text-sm text-slate-700 placeholder:text-slate-400 focus:ring-0 focus:outline-none w-full font-medium">
                </div>
            </form>
        </div>
    </div>

    <!-- Center/Right: Desktop Navigation Bar (Dompet Dhuafa Typography & Spacing) -->
    @php
        $navBase = "relative py-2 text-xs xl:text-sm font-semibold transition-all";
        $navActive = "text-primary-600 font-extrabold after:absolute after:bottom-0 after:left-0 after:w-full after:h-[2px] after:bg-primary-600";
        $navInactive = "text-slate-700 hover:text-primary-600 after:absolute after:bottom-0 after:left-0 after:w-full after:h-[2px] after:bg-primary-600 after:scale-x-0 hover:after:scale-x-100 after:transition-transform after:origin-left";
    @endphp
    <nav class="hidden lg:flex items-center gap-4 xl:gap-6">
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

            <!-- Dropdown Kemitraan (Guest) -->
            <div class="relative" x-data="{ dropMitra: false }">
                <button @click="dropMitra = !dropMitra" @click.outside="dropMitra = false" class="flex items-center gap-1 {{ $navBase }} {{ request()->routeIs('mitra.*') ? $navActive : $navInactive }}" :class="{ '!text-primary-600': dropMitra }">
                    <span>Kemitraan</span>
                    <svg class="w-3.5 h-3.5 transition-transform text-slate-500" :class="{ 'rotate-180 !text-primary-600': dropMitra }" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                </button>
                <div x-show="dropMitra" x-transition.opacity.duration.200ms class="absolute left-0 mt-3 w-52 bg-white rounded-2xl shadow-xl border border-slate-100 p-1.5 z-50" style="display: none;">
                    <a href="{{ route('mitra.pengemudi') }}" class="block px-4 py-2.5 rounded-xl text-xs text-slate-700 hover:text-primary-600 hover:bg-primary-50 font-bold transition-all">
                        Mitra Driver
                    </a>
                    <a href="{{ route('mitra.armada') }}" class="block px-4 py-2.5 rounded-xl text-xs text-slate-700 hover:text-primary-600 hover:bg-primary-50 font-bold transition-all">
                        Mitra Lembaga
                    </a>
                </div>
            </div>
        @else
            @if($user->hasRole('masyarakat') || !$user->role_id)
                <!-- MENU MASYARAKAT -->
                <a href="{{ route('masyarakat.dashboard') }}" class="{{ $navBase }} {{ request()->routeIs('masyarakat.dashboard') ? $navActive : $navInactive }}">
                    Beranda
                </a>
                <a href="{{ route('masyarakat.order.create') }}" class="{{ $navBase }} {{ request()->routeIs('masyarakat.order.create') ? $navActive : $navInactive }}">
                    Pesan Ambulans
                </a>
                <a href="{{ route('masyarakat.orders.index') }}" class="{{ $navBase }} {{ request()->routeIs('masyarakat.orders.*') || request()->routeIs('masyarakat.tracking') ? $navActive : $navInactive }}">
                    Pesanan
                </a>
                <a href="{{ route('donasi') }}" class="{{ $navBase }} {{ request()->routeIs('donasi') ? $navActive : $navInactive }}">
                    Donasi
                </a>

                <!-- Dropdown Informasi & Layanan (Masyarakat) -->
                <div class="relative" x-data="{ dropInfoUser: false }">
                    <button @click="dropInfoUser = !dropInfoUser" @click.outside="dropInfoUser = false" class="flex items-center gap-1 {{ $navBase }} {{ request()->routeIs('mitra.*') || request()->routeIs('masyarakat.info') ? $navActive : $navInactive }}" :class="{ '!text-primary-600': dropInfoUser }">
                        <span>Informasi & Layanan</span>
                        <svg class="w-3.5 h-3.5 transition-transform text-slate-500" :class="{ 'rotate-180 !text-primary-600': dropInfoUser }" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </button>
                    <div x-show="dropInfoUser" x-transition.opacity.duration.200ms class="absolute left-0 mt-3 w-60 bg-white rounded-2xl shadow-xl border border-slate-100 p-2 z-50" style="display: none;">
                        <a href="{{ route('masyarakat.dashboard') }}#rumah-sakit" class="block px-4 py-2.5 rounded-xl text-xs text-slate-700 hover:text-primary-600 hover:bg-primary-50 font-bold transition-all">
                            Rumah Sakit & IGD 24 Jam
                        </a>
                        <a href="{{ route('masyarakat.dashboard') }}#panduan-p3k" class="block px-4 py-2.5 rounded-xl text-xs text-slate-700 hover:text-primary-600 hover:bg-primary-50 font-bold transition-all">
                            Panduan P3K Darurat
                        </a>
                        <div class="border-t border-slate-100 my-1"></div>
                        <a href="{{ route('mitra.pengemudi') }}" class="block px-4 py-2.5 rounded-xl text-xs text-slate-700 hover:text-primary-600 hover:bg-primary-50 font-bold transition-all">
                            Gabung Pengemudi
                        </a>
                        <a href="{{ route('mitra.armada') }}" class="block px-4 py-2.5 rounded-xl text-xs text-slate-700 hover:text-primary-600 hover:bg-primary-50 font-bold transition-all">
                            Gabung Mitra Armada
                        </a>
                        <div class="border-t border-slate-100 my-1"></div>
                        <a href="{{ route('masyarakat.info') }}" class="block px-4 py-2.5 rounded-xl text-xs text-slate-700 hover:text-primary-600 hover:bg-primary-50 font-bold transition-all">
                            Tentang Ambulans Siaga
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
                    Perjalanan
                </a>
                <a href="{{ route('supir.riwayat.index') }}" class="{{ $navBase }} {{ request()->routeIs('supir.riwayat.*') ? $navActive : $navInactive }}">
                    Riwayat
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
                    <button @click="dropOps = !dropOps" @click.outside="dropOps = false" class="flex items-center gap-1.5 {{ $navBase }} {{ request()->routeIs('operator.orders.*') || request()->routeIs('operator.monitoring') ? $navActive : $navInactive }}" :class="{ '!text-primary-600': dropOps }">
                        <span>Operasional</span>
                        <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </button>
                    <div x-show="dropOps" x-transition class="absolute left-0 mt-2 w-52 bg-white rounded-2xl shadow-xl border border-slate-100 py-2 z-50" style="display: none;">
                        <a href="{{ route('operator.orders.index') }}" class="block px-4 py-2 text-xs font-bold text-slate-700 hover:bg-primary-50 hover:text-primary-600">Permintaan Ambulans</a>
                        <a href="{{ route('operator.monitoring') }}" class="block px-4 py-2 text-xs font-bold text-slate-700 hover:bg-primary-50 hover:text-primary-600">Tracking Aktif</a>
                    </div>
                </div>
            @endif

            @if($user->isAdmin())
                <!-- Dropdown Operasional -->
                <div class="relative" x-data="{ dropOps: false }">
                    <button @click="dropOps = !dropOps" @click.outside="dropOps = false" class="flex items-center gap-1.5 {{ $navBase }} {{ request()->routeIs('admin.orders.*') || request()->routeIs('admin.ambulans.*') || request()->routeIs('admin.supir.*') || request()->routeIs('admin.rumahsakit.*') || request()->routeIs('admin.jadwal.*') ? $navActive : $navInactive }}" :class="{ '!text-primary-600': dropOps }">
                        <span>Operasional</span>
                        <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </button>
                    <div x-show="dropOps" x-transition class="absolute left-0 mt-2 w-52 bg-white rounded-2xl shadow-xl border border-slate-100 py-2 z-50" style="display: none;">
                        <a href="{{ route('admin.orders.index') }}" class="block px-4 py-2 text-xs font-bold text-slate-700 hover:bg-primary-50 hover:text-primary-600">Semua Order</a>
                        <a href="{{ route('admin.ambulans.index') }}" class="block px-4 py-2 text-xs font-bold text-slate-700 hover:bg-primary-50 hover:text-primary-600">Armada Ambulans</a>
                        <a href="{{ route('admin.supir.index') }}" class="block px-4 py-2 text-xs font-bold text-slate-700 hover:bg-primary-50 hover:text-primary-600">Supir Ambulans</a>
                        <a href="{{ route('admin.rumahsakit.index') }}" class="block px-4 py-2 text-xs font-bold text-slate-700 hover:bg-primary-50 hover:text-primary-600">Rumah Sakit</a>
                        <a href="{{ route('admin.jadwal.index') }}" class="block px-4 py-2 text-xs font-bold text-slate-700 hover:bg-primary-50 hover:text-primary-600">Jadwal Supir</a>
                    </div>
                </div>

                <!-- Dropdown Manajemen -->
                <div class="relative" x-data="{ dropMgmt: false }">
                    <button @click="dropMgmt = !dropMgmt" @click.outside="dropMgmt = false" class="flex items-center gap-1.5 {{ $navBase }} {{ request()->routeIs('admin.users.*') || request()->routeIs('admin.audit.*') || request()->routeIs('admin.settings.*') ? $navActive : $navInactive }}" :class="{ '!text-primary-600': dropMgmt }">
                        <span>Manajemen</span>
                        <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </button>
                    <div x-show="dropMgmt" x-transition class="absolute left-0 mt-2 w-52 bg-white rounded-2xl shadow-xl border border-slate-100 py-2 z-50" style="display: none;">
                        <a href="{{ route('admin.donasi.index') }}" class="block px-4 py-2 text-xs font-bold text-slate-700 hover:bg-primary-50 hover:text-primary-600">Kelola Donasi</a>
                        <a href="{{ route('admin.users.index') }}" class="block px-4 py-2 text-xs font-bold text-slate-700 hover:bg-primary-50 hover:text-primary-600">Kelola Pengguna</a>
                        <a href="{{ route('admin.audit.index') }}" class="block px-4 py-2 text-xs font-bold text-slate-700 hover:bg-primary-50 hover:text-primary-600">Log Aktivitas</a>
                        <a href="{{ route('admin.settings.index') }}" class="block px-4 py-2 text-xs font-bold text-slate-700 hover:bg-primary-50 hover:text-primary-600">Pengaturan Sistem</a>
                    </div>
                </div>

                <!-- Laporan -->
                <a href="{{ route('admin.laporan.index') }}" class="{{ $navBase }} {{ request()->routeIs('admin.laporan.*') ? $navActive : $navInactive }}">
                    Laporan
                </a>
            @endif
        @endif
    </nav>

    <!-- Right side: Dompet Dhuafa Style Auth Buttons (MASUK & DAFTAR) or User Profile -->
    <div class="flex items-center gap-2 sm:gap-3 xl:gap-4">

        @if($user && $user->isSupir() && $user->supir)
            <!-- Quick Status Online/Offline Badge untuk Supir -->
            <div class="flex items-center gap-1.5 px-3 py-1 rounded-full {{ $user->supir->status_online ? 'bg-primary-50 text-primary-700 border border-primary-200' : 'bg-slate-100 text-slate-600 border border-slate-200' }} text-xs font-bold">
                <span class="w-2 h-2 rounded-full {{ $user->supir->status_online ? 'bg-primary-500 animate-ping' : 'bg-slate-400' }}"></span>
                <span>{{ $user->supir->status_online ? 'SIAGA ONLINE' : 'OFFLINE' }}</span>
            </div>
        @endif

        @if($user)
            <!-- Livewire Notification Dropdown (Light Styled) -->
            @livewire('notification-dropdown', ['isDark' => false])
        @endif

        <!-- User Dropdown OR Dompet Dhuafa Auth Buttons -->
        @if($user)
            <div class="relative" x-data="{ open: false }">
                <button @click="open = !open" @click.outside="open = false"
                        class="flex items-center gap-2 text-sm font-medium text-slate-700 hover:text-primary-600 focus:outline-none p-1 rounded-xl hover:bg-slate-50 transition-colors">
                    <img src="{{ $avatarUrl }}" alt="{{ $userName }}" class="w-9 h-9 rounded-full object-cover border-2 border-primary-500/30">
                    <span class="hidden md:inline-block max-w-[130px] truncate font-bold text-xs xl:text-sm text-slate-800">{{ $userName }}</span>
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
                     class="absolute right-0 mt-2 w-56 bg-white rounded-2xl shadow-xl border border-slate-100 py-2 z-50"
                     style="display: none;">

                    <div class="px-4 py-2 border-b border-slate-100">
                        <p class="text-[10px] font-bold uppercase tracking-wider text-slate-400">Masuk Sebagai</p>
                        <p class="text-xs font-bold text-slate-800 truncate">{{ $user->email }}</p>
                        <span class="inline-block px-2 py-0.5 mt-1 rounded bg-primary-50 text-primary-700 text-[10px] font-black uppercase">
                            {{ $user->role_label }}
                        </span>
                    </div>

                    <a href="{{ route('profile.edit') }}"
                       class="flex items-center gap-2 px-4 py-2.5 text-xs text-slate-700 hover:bg-primary-50 hover:text-primary-600 font-bold transition-colors">
                        <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                        <span>Profil Saya</span>
                    </a>

                    <div class="border-t border-slate-100 my-1"></div>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                                class="w-full text-left flex items-center gap-2 px-4 py-2.5 text-xs text-red-600 hover:bg-red-50 font-bold transition-colors">
                            <svg class="w-4 h-4 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                            </svg>
                            <span>Keluar Akun</span>
                        </button>
                    </form>
                </div>
            </div>
        @else
            <!-- DOMPET DHUAFA AUTH BUTTONS: OUTLINE MASUK & SOLID DAFTAR (CYAN BRAND) -->
            <div class="hidden lg:flex items-center gap-2.5 xl:gap-3">
                <a href="{{ route('login') }}"
                   class="inline-flex items-center justify-center px-4 xl:px-5 py-2 rounded-lg border-2 border-primary-600 text-primary-600 hover:bg-primary-50 text-xs font-bold uppercase tracking-wider transition-all">
                    Masuk
                </a>
                
                <a href="{{ route('register') }}"
                   class="inline-flex items-center justify-center px-4 xl:px-5 py-2 rounded-lg bg-primary-600 hover:bg-primary-700 text-white text-xs font-bold uppercase tracking-wider shadow-xs hover:shadow transition-all">
                    Daftar
                </a>
            </div>
        @endif

        @if(!$hasBottomNav)
            <!-- Mobile Search Button (< md) - Hanya tampil untuk Tamu/Guest tanpa bottom nav -->
            <button @click="mobileMenuOpen = true"
                    type="button"
                    class="md:hidden p-2 text-slate-500 hover:text-primary-600 hover:bg-slate-100 rounded-lg focus:outline-none transition-colors"
                    aria-label="Cari Layanan">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
            </button>

            <!-- Hamburger Toggle (Mobile < lg) - Hanya tampil untuk Tamu/Guest tanpa bottom nav -->
            <button @click="mobileMenuOpen = true"
                    type="button"
                    class="lg:hidden p-2 text-slate-700 hover:text-primary-600 hover:bg-slate-100 rounded-lg focus:outline-none transition-colors"
                    aria-label="Buka Menu Navigasi">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5"/>
                </svg>
            </button>
        @endif
    </div>

    @if(!$hasBottomNav)
    <!-- ========================================================================= -->
    <!-- DOMPET DHUAFA STYLE MOBILE NAVIGATION DRAWER (< lg)                        -->
    <!-- ========================================================================= -->
    <template x-teleport="body">
        <div x-show="mobileMenuOpen"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 translate-x-full"
             x-transition:enter-end="opacity-100 translate-x-0"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100 translate-x-0"
             x-transition:leave-end="opacity-0 translate-x-full"
             class="fixed inset-0 z-[99999] w-full h-full min-h-screen bg-white text-slate-800 flex flex-col justify-between overflow-y-auto"
             style="display: none;">

            <!-- Top Header inside Drawer (Logo + Close X) -->
            <div class="px-6 py-4 flex items-center justify-between border-b border-slate-100 shrink-0 bg-white sticky top-0 z-10">
                <a href="{{ route('home') }}" @click="mobileMenuOpen = false" class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full bg-primary-50 border border-primary-100 p-1 flex items-center justify-center shadow-xs overflow-hidden">
                        <img src="{{ asset('images/logo_ambulansiaga.png') }}" alt="Logo Ambulans Siaga" class="w-full h-full object-contain">
                    </div>
                    <div class="flex flex-col">
                        <span class="font-black text-slate-800 text-base tracking-tight leading-none">Ambulans Siaga</span>
                        <span class="text-primary-600 text-[9px] font-bold tracking-widest uppercase mt-0.5">Layanan Darurat</span>
                    </div>
                </a>

                <!-- Close Button X -->
                <button @click="mobileMenuOpen = false" 
                        type="button"
                        class="p-2 text-slate-500 hover:text-slate-800 hover:bg-slate-100 rounded-full focus:outline-none transition-colors"
                        aria-label="Tutup Menu">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>

            <!-- Mobile Search Input inside Drawer -->
            <div class="px-6 pt-4 pb-2">
                <form @submit.prevent="handleSearch(); mobileMenuOpen = false;" class="relative">
                    <div class="flex items-center gap-2.5 bg-slate-100 focus-within:bg-white focus-within:ring-2 focus-within:ring-primary-500/20 focus-within:border-primary-500 border border-slate-200 rounded-xl px-3.5 py-2.5 transition-all w-full">
                        <svg class="w-4 h-4 text-slate-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                        <input x-model="searchQuery" 
                               type="text" 
                               placeholder="Cari Program / Layanan..." 
                               class="bg-transparent border-0 p-0 text-sm text-slate-700 placeholder:text-slate-400 focus:ring-0 focus:outline-none w-full font-medium">
                    </div>
                </form>
            </div>

            <!-- Main Navigation Links -->
            <div class="px-6 py-4 flex-1 space-y-1 overflow-y-auto divide-y divide-slate-100">
                
                <div class="space-y-1 pb-3">
                    <!-- 1. Beranda -->
                    <a href="{{ route('home') }}" @click="mobileMenuOpen = false"
                       class="block py-3 text-base font-bold transition-colors {{ request()->routeIs('home') ? 'text-primary-600' : 'text-slate-700 hover:text-primary-600' }}">
                        Beranda
                    </a>

                    <!-- 2. Tentang Kami -->
                    <a href="{{ route('masyarakat.info') }}" @click="mobileMenuOpen = false"
                       class="block py-3 text-base font-bold transition-colors {{ request()->routeIs('masyarakat.info') ? 'text-primary-600' : 'text-slate-700 hover:text-primary-600' }}">
                        Tentang Kami
                    </a>

                    <!-- 3. Pesan Ambulans -->
                    <a href="{{ route('masyarakat.order.create') }}" @click="mobileMenuOpen = false"
                       class="block py-3 text-base font-bold transition-colors {{ request()->routeIs('masyarakat.order.create') ? 'text-primary-600' : 'text-slate-700 hover:text-primary-600' }}">
                        Pesan Ambulans
                    </a>

                    <!-- 4. Donasi & Infaq -->
                    <a href="{{ route('donasi') }}" @click="mobileMenuOpen = false"
                       class="block py-3 text-base font-bold transition-colors {{ request()->routeIs('donasi') ? 'text-primary-600' : 'text-slate-700 hover:text-primary-600' }}">
                        Donasi & Infaq
                    </a>

                    <!-- 5. Kemitraan (Accordion Dropdown) -->
                    <div x-data="{ openKemitraan: {{ request()->routeIs('mitra.*') ? 'true' : 'false' }} }" class="py-1">
                        <button @click="openKemitraan = !openKemitraan" 
                                type="button" 
                                class="w-full flex items-center justify-between py-2 text-base font-bold text-slate-700 hover:text-primary-600 transition-colors">
                            <span class="{{ request()->routeIs('mitra.*') ? 'text-primary-600' : '' }}">Kemitraan</span>
                            <svg class="w-5 h-5 transition-transform duration-200 text-slate-400" :class="{ 'rotate-180 text-primary-600': openKemitraan }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>
                        <div x-show="openKemitraan" x-collapse class="pl-4 pr-2 py-1 space-y-1.5 border-l-2 border-primary-500/40 ml-2">
                            <a href="{{ route('mitra.pengemudi') }}" @click="mobileMenuOpen = false" 
                                class="flex items-center gap-2.5 py-1.5 text-sm font-semibold {{ request()->routeIs('mitra.pengemudi') ? 'text-primary-600' : 'text-slate-600 hover:text-primary-600' }} transition-colors">
                                <span class="w-1.5 h-1.5 rounded-full bg-primary-500"></span>
                                <span>Mitra Driver</span>
                            </a>
                            <a href="{{ route('mitra.armada') }}" @click="mobileMenuOpen = false" 
                                class="flex items-center gap-2.5 py-1.5 text-sm font-semibold {{ request()->routeIs('mitra.armada') ? 'text-primary-600' : 'text-slate-600 hover:text-primary-600' }} transition-colors">
                                <span class="w-1.5 h-1.5 rounded-full bg-primary-500"></span>
                                <span>Mitra Lembaga</span>
                            </a>
                        </div>
                    </div>
                </div>

                @if($user)
                    <!-- User Specific Links inside Mobile Menu -->
                    <div class="pt-3 space-y-1">
                        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-2">Panel Pengguna</p>
                        @if($user->hasRole('masyarakat') || !$user->role_id)
                            <a href="{{ route('masyarakat.dashboard') }}" @click="mobileMenuOpen = false"
                               class="block py-2 text-sm font-bold {{ request()->routeIs('masyarakat.dashboard') ? 'text-primary-600' : 'text-slate-700 hover:text-primary-600' }}">
                                Beranda
                            </a>
                            <a href="{{ route('masyarakat.orders.index') }}" @click="mobileMenuOpen = false"
                               class="block py-2 text-sm font-bold {{ request()->routeIs('masyarakat.orders.*') || request()->routeIs('masyarakat.tracking') ? 'text-primary-600' : 'text-slate-700 hover:text-primary-600' }}">
                                Pesanan
                            </a>
                        @endif

                        @if($user->isSupir())
                            <a href="{{ route('supir.dashboard') }}" @click="mobileMenuOpen = false"
                               class="block py-2 text-sm font-bold {{ request()->routeIs('supir.dashboard') ? 'text-primary-600' : 'text-slate-700 hover:text-primary-600' }}">
                                Dashboard Supir
                            </a>
                            <a href="{{ route('supir.tugas.index') }}" @click="mobileMenuOpen = false"
                               class="block py-2 text-sm font-bold {{ request()->routeIs('supir.tugas.*') ? 'text-primary-600' : 'text-slate-700 hover:text-primary-600' }}">
                                Tugas Ambulans
                            </a>
                            <a href="{{ route('supir.perjalanan.aktif') }}" @click="mobileMenuOpen = false"
                               class="block py-2 text-sm font-bold {{ request()->routeIs('supir.perjalanan.aktif') || request()->routeIs('supir.orders.show') ? 'text-primary-600' : 'text-slate-700 hover:text-primary-600' }}">
                                Perjalanan Aktif
                            </a>
                            <a href="{{ route('supir.riwayat.index') }}" @click="mobileMenuOpen = false"
                               class="block py-2 text-sm font-bold {{ request()->routeIs('supir.riwayat.*') ? 'text-primary-600' : 'text-slate-700 hover:text-primary-600' }}">
                                Riwayat Tugas
                            </a>
                        @endif

                        @if($user->isOperator() || $user->isAdmin())
                            <a href="{{ $user->isAdmin() ? route('admin.dashboard') : route('operator.dashboard') }}" @click="mobileMenuOpen = false"
                               class="block py-2 text-sm font-bold text-slate-700 hover:text-primary-600">
                                Dashboard Admin / Operator
                            </a>
                            <a href="{{ route('operator.orders.index') }}" @click="mobileMenuOpen = false"
                               class="block py-2 text-sm font-bold text-slate-700 hover:text-primary-600">
                                Operasional Ambulans
                            </a>
                        @endif

                        <a href="{{ route('profile.edit') }}" @click="mobileMenuOpen = false"
                           class="block py-2 text-sm font-bold text-slate-700 hover:text-primary-600">
                            Profil Saya
                        </a>
                    </div>
                @endif
            </div>

            <!-- Bottom Action Section inside Drawer -->
            <div class="p-6 border-t border-slate-100 bg-slate-50 shrink-0 space-y-3">
                @if($user)
                    <div class="flex items-center justify-between mb-2">
                        <div class="flex items-center gap-3">
                            <img src="{{ $avatarUrl }}" alt="{{ $userName }}" class="w-10 h-10 rounded-full object-cover border-2 border-primary-500/30">
                            <div>
                                <p class="text-sm font-bold text-slate-800 truncate max-w-[180px]">{{ $userName }}</p>
                                <p class="text-[11px] text-primary-600 font-semibold">{{ $user->role_label }}</p>
                            </div>
                        </div>
                    </div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                                class="w-full py-3 px-4 rounded-xl bg-red-50 text-red-600 hover:bg-red-100 border border-red-200 font-bold text-xs text-center transition-all">
                            Keluar Akun
                        </button>
                    </form>
                @else
                    <div class="grid grid-cols-2 gap-3">
                        <a href="{{ route('login') }}" 
                           class="py-3 px-4 rounded-lg border-2 border-primary-600 text-primary-600 hover:bg-primary-50 font-bold text-xs text-center uppercase tracking-wider transition-all">
                            Masuk
                        </a>
                        <a href="{{ route('register') }}" 
                           class="py-3 px-4 rounded-lg bg-primary-600 hover:bg-primary-700 text-white font-bold text-xs text-center uppercase tracking-wider shadow-sm transition-all">
                            Daftar
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </template>
    @endif
</header>

@if($pendingIncompleteOrder && !request()->routeIs('masyarakat.order.complete'))
    <!-- Action Reminder: Notifikasi Data Pesanan Belum Lengkap -->
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
