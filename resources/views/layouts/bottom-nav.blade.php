@php
    $user = auth()->user();
    
    // Bottom navigation hanya aktif untuk Tamu/Guest, Masyarakat, dan Supir Ambulans
    $shouldShow = !$user || $user->hasRole('masyarakat') || !$user->role_id || $user->isSupir();
@endphp

@if($shouldShow)
<!-- Mobile Bottom Navigation Bar (Visible only on mobile/tablet < lg) -->
<nav class="fixed bottom-0 left-0 right-0 z-40 bg-white/95 backdrop-blur-md border-t border-slate-200/90 shadow-[0_-4px_25px_rgba(0,0,0,0.07)] lg:hidden pb-[max(env(safe-area-inset-bottom),0.35rem)]">
    <div class="max-w-md mx-auto px-2 sm:px-4 h-16 flex items-center justify-around relative">

        @if(!$user)
            <!-- ================= GUEST NAVIGATION ================= -->
            <!-- 1. Beranda -->
            <a href="{{ route('home') }}" 
               class="flex-1 flex flex-col items-center justify-center py-1 transition-all group {{ request()->routeIs('home') ? 'text-primary-600 font-extrabold' : 'text-slate-400 hover:text-slate-600' }}">
                <div class="relative flex items-center justify-center">
                    <svg class="w-5 h-5 transition-transform group-hover:scale-110" fill="{{ request()->routeIs('home') ? 'currentColor' : 'none' }}" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                    </svg>
                </div>
                <span class="text-[10px] mt-1 leading-none tracking-tight">Beranda</span>
            </a>

            <!-- 2. Tentang Kami -->
            <a href="{{ route('masyarakat.info') }}" 
               class="flex-1 flex flex-col items-center justify-center py-1 transition-all group {{ request()->routeIs('masyarakat.info') ? 'text-primary-600 font-extrabold' : 'text-slate-400 hover:text-slate-600' }}">
                <div class="relative flex items-center justify-center">
                    <svg class="w-5 h-5 transition-transform group-hover:scale-110" fill="{{ request()->routeIs('masyarakat.info') ? 'currentColor' : 'none' }}" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <span class="text-[10px] mt-1 leading-none tracking-tight">Tentang</span>
            </a>

            <!-- 3. Raised Center Button: Pesan Ambulans -->
            <div class="relative -top-4 flex flex-col items-center shrink-0 px-1">
                <a href="{{ route('masyarakat.order.create') }}" 
                   class="w-13 h-13 sm:w-14 sm:h-14 rounded-full bg-gradient-to-tr from-primary-600 to-primary-500 text-white flex items-center justify-center shadow-lg shadow-primary-600/40 ring-4 ring-white active:scale-95 transition-all">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M12 4v16m8-8H4"/>
                    </svg>
                </a>
                <span class="text-[9px] font-extrabold text-primary-700 mt-1 leading-none uppercase tracking-tighter">Pesan</span>
            </div>

            <!-- 4. Donasi -->
            <a href="{{ route('donasi') }}" 
               class="flex-1 flex flex-col items-center justify-center py-1 transition-all group {{ request()->routeIs('donasi') ? 'text-primary-600 font-extrabold' : 'text-slate-400 hover:text-slate-600' }}">
                <div class="relative flex items-center justify-center">
                    <svg class="w-5 h-5 transition-transform group-hover:scale-110" fill="{{ request()->routeIs('donasi') ? 'currentColor' : 'none' }}" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                    </svg>
                </div>
                <span class="text-[10px] mt-1 leading-none tracking-tight">Donasi</span>
            </a>

            <!-- 5. Login -->
            <a href="{{ route('login') }}" 
               class="flex-1 flex flex-col items-center justify-center py-1 transition-all group {{ request()->routeIs('login') ? 'text-primary-600 font-extrabold' : 'text-slate-400 hover:text-slate-600' }}">
                <div class="relative flex items-center justify-center">
                    <svg class="w-5 h-5 transition-transform group-hover:scale-110" fill="{{ request()->routeIs('login') ? 'currentColor' : 'none' }}" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
                    </svg>
                </div>
                <span class="text-[10px] mt-1 leading-none tracking-tight">Masuk</span>
            </a>

        @elseif($user->hasRole('masyarakat') || !$user->role_id)
            <!-- ================= MASYARAKAT NAVIGATION ================= -->
            <!-- 1. Beranda / Pusat Siaga -->
            <a href="{{ route('masyarakat.dashboard') }}" 
               class="flex-1 flex flex-col items-center justify-center py-1 transition-all group {{ request()->routeIs('masyarakat.dashboard') ? 'text-primary-600 font-extrabold' : 'text-slate-400 hover:text-slate-600' }}">
                <div class="relative flex items-center justify-center">
                    <svg class="w-5 h-5 transition-transform group-hover:scale-110" fill="{{ request()->routeIs('masyarakat.dashboard') ? 'currentColor' : 'none' }}" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                    </svg>
                </div>
                <span class="text-[10px] mt-1 leading-none tracking-tight">Beranda</span>
            </a>

            <!-- 2. Pesanan Saya -->
            <a href="{{ route('masyarakat.orders.index') }}" 
               class="flex-1 flex flex-col items-center justify-center py-1 transition-all group {{ request()->routeIs('masyarakat.orders.*') || request()->routeIs('masyarakat.order.index') || request()->routeIs('masyarakat.tracking') ? 'text-primary-600 font-extrabold' : 'text-slate-400 hover:text-slate-600' }}">
                <div class="relative flex items-center justify-center">
                    <svg class="w-5 h-5 transition-transform group-hover:scale-110" fill="{{ request()->routeIs('masyarakat.orders.*') || request()->routeIs('masyarakat.tracking') ? 'currentColor' : 'none' }}" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/>
                    </svg>
                </div>
                <span class="text-[10px] mt-1 leading-none tracking-tight">Pesanan</span>
            </a>

            <!-- 3. Raised Center Button: Pesan Darurat (SOS) -->
            <div class="relative -top-4 flex flex-col items-center shrink-0 px-1">
                <a href="{{ route('masyarakat.order.create') }}" 
                   class="w-13 h-13 sm:w-14 sm:h-14 rounded-full bg-gradient-to-tr from-primary-600 to-teal-500 text-white flex items-center justify-center shadow-lg shadow-primary-600/40 ring-4 ring-white active:scale-95 transition-all {{ request()->routeIs('masyarakat.order.create') ? 'ring-primary-200' : '' }}">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M12 4v16m8-8H4"/>
                    </svg>
                </a>
                <span class="text-[9px] font-extrabold text-primary-700 mt-1 leading-none uppercase tracking-tighter">Pesan</span>
            </div>

            <!-- 4. Donasi -->
            <a href="{{ route('donasi') }}" 
               class="flex-1 flex flex-col items-center justify-center py-1 transition-all group {{ request()->routeIs('donasi') ? 'text-primary-600 font-extrabold' : 'text-slate-400 hover:text-slate-600' }}">
                <div class="relative flex items-center justify-center">
                    <svg class="w-5 h-5 transition-transform group-hover:scale-110" fill="{{ request()->routeIs('donasi') ? 'currentColor' : 'none' }}" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                    </svg>
                </div>
                <span class="text-[10px] mt-1 leading-none tracking-tight">Donasi</span>
            </a>

            <!-- 5. Profil Akun -->
            <a href="{{ route('profile.edit') }}" 
               class="flex-1 flex flex-col items-center justify-center py-1 transition-all group {{ request()->routeIs('profile.edit') ? 'text-primary-600 font-extrabold' : 'text-slate-400 hover:text-slate-600' }}">
                <div class="relative flex items-center justify-center">
                    <svg class="w-5 h-5 transition-transform group-hover:scale-110" fill="{{ request()->routeIs('profile.edit') ? 'currentColor' : 'none' }}" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                </div>
                <span class="text-[10px] mt-1 leading-none tracking-tight">Profil</span>
            </a>

        @elseif($user->isSupir())
            <!-- ================= SUPIR NAVIGATION ================= -->
            <!-- 1. Dashboard -->
            <a href="{{ route('supir.dashboard') }}" 
               class="flex-1 flex flex-col items-center justify-center py-1 transition-all group {{ request()->routeIs('supir.dashboard') ? 'text-primary-600 font-extrabold' : 'text-slate-400 hover:text-slate-600' }}">
                <div class="relative flex items-center justify-center">
                    <svg class="w-5 h-5 transition-transform group-hover:scale-110" fill="{{ request()->routeIs('supir.dashboard') ? 'currentColor' : 'none' }}" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                    </svg>
                </div>
                <span class="text-[10px] mt-1 leading-none tracking-tight">Dashboard</span>
            </a>

            <!-- 2. Tugas Ambulans -->
            <a href="{{ route('supir.tugas.index') }}" 
               class="flex-1 flex flex-col items-center justify-center py-1 transition-all group {{ request()->routeIs('supir.tugas.*') ? 'text-primary-600 font-extrabold' : 'text-slate-400 hover:text-slate-600' }}">
                <div class="relative flex items-center justify-center">
                    <svg class="w-5 h-5 transition-transform group-hover:scale-110" fill="{{ request()->routeIs('supir.tugas.*') ? 'currentColor' : 'none' }}" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                    </svg>
                </div>
                <span class="text-[10px] mt-1 leading-none tracking-tight">Tugas</span>
            </a>

            <!-- 3. Raised Center Button: Perjalanan Aktif -->
            <div class="relative -top-4 flex flex-col items-center shrink-0 px-1">
                <a href="{{ route('supir.perjalanan.aktif') }}" 
                   class="w-13 h-13 sm:w-14 sm:h-14 rounded-full bg-gradient-to-tr from-sky-600 to-primary-600 text-white flex items-center justify-center shadow-lg shadow-sky-600/40 ring-4 ring-white active:scale-95 transition-all {{ request()->routeIs('supir.perjalanan.aktif') || request()->routeIs('supir.orders.show') ? 'ring-primary-200' : '' }}">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"/>
                    </svg>
                </a>
                <span class="text-[9px] font-extrabold text-primary-700 mt-1 leading-none uppercase tracking-tighter">Perjalanan</span>
            </div>

            <!-- 4. Riwayat Penugasan -->
            <a href="{{ route('supir.riwayat.index') }}" 
               class="flex-1 flex flex-col items-center justify-center py-1 transition-all group {{ request()->routeIs('supir.riwayat.*') ? 'text-primary-600 font-extrabold' : 'text-slate-400 hover:text-slate-600' }}">
                <div class="relative flex items-center justify-center">
                    <svg class="w-5 h-5 transition-transform group-hover:scale-110" fill="{{ request()->routeIs('supir.riwayat.*') ? 'currentColor' : 'none' }}" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <span class="text-[10px] mt-1 leading-none tracking-tight">Riwayat</span>
            </a>

            <!-- 5. Profil Supir -->
            <a href="{{ route('profile.edit') }}" 
               class="flex-1 flex flex-col items-center justify-center py-1 transition-all group {{ request()->routeIs('profile.edit') ? 'text-primary-600 font-extrabold' : 'text-slate-400 hover:text-slate-600' }}">
                <div class="relative flex items-center justify-center">
                    <svg class="w-5 h-5 transition-transform group-hover:scale-110" fill="{{ request()->routeIs('profile.edit') ? 'currentColor' : 'none' }}" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                </div>
                <span class="text-[10px] mt-1 leading-none tracking-tight">Profil</span>
            </a>
        @endif

    </div>
</nav>
@endif
