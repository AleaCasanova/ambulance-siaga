@php
    $isAdminRole = auth()->user() && (auth()->user()->isAdmin() || auth()->user()->isOperator() || auth()->user()->isMitra());
@endphp

@if($isAdminRole)
    <x-admin-layout>
        <div class="mb-8 flex flex-col lg:flex-row lg:items-end lg:justify-between gap-6">
            <div class="flex-1">
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[11px] font-bold bg-slate-100 text-slate-500 uppercase tracking-wider mb-2.5">
                    Pengaturan Akun & Keamanan
                </span>
                <h1 class="text-2xl sm:text-[28px] font-bold text-slate-900 tracking-tight leading-tight">
                    Profil Pengguna
                </h1>
                <p class="text-slate-500 text-[14px] mt-1.5 font-medium max-w-2xl">
                    Kelola informasi data diri, kredensial login, dan pengaturan keamanan akun Anda.
                </p>
            </div>
        </div>

        <div class="space-y-8 max-w-5xl">
            <!-- Card 1: Update Profile Information -->
            <div class="p-6 sm:p-8 bg-white border border-slate-200/80 rounded-3xl shadow-xs">
                <div class="max-w-4xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <!-- Card 2: Update Password -->
            <div class="p-6 sm:p-8 bg-white border border-slate-200/80 rounded-3xl shadow-xs">
                <div class="max-w-2xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <!-- Card 3: Delete Account -->
            <div class="p-6 sm:p-8 bg-white border border-slate-200/80 rounded-3xl shadow-xs">
                <div class="max-w-2xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </x-admin-layout>
@else
    <x-app-layout>
        <div class="-mt-6 sm:-mt-10 pb-12 sm:pb-16">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8"
                 x-data="{ activeTab: '{{ (isset($errors) && $errors->userDeletion->isNotEmpty()) ? 'delete' : ((isset($errors) && $errors->updatePassword->isNotEmpty()) ? 'password' : 'profile') }}' }">

                <!-- Page Title (Pure White & Teal Subtitle) -->
                <div class="mb-5 sm:mb-6">
                    <h1 class="text-2xl sm:text-4xl font-black text-white tracking-tight drop-shadow-md">
                        Pengaturan Profil
                    </h1>
                    <p class="text-primary-100 text-xs sm:text-sm mt-1.5 font-medium max-w-2xl">
                        Kelola data diri, kartu identitas darurat, dan informasi kredensial akun Anda.
                    </p>
                </div>

                <!-- 2-Column Grid: Left Sidebar & Right Settings Card -->
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 lg:gap-8 items-start">
                    
                    <!-- Left Sidebar (Dompet Dhuafa Style Card in Cyan Palette) -->
                    <aside class="lg:col-span-4 xl:col-span-3.5 bg-white rounded-2xl sm:rounded-3xl border border-slate-200/80 shadow-sm overflow-hidden">
                        <!-- Top Header with Cyan Gradient -->
                        <div class="relative bg-gradient-to-br from-primary-600 to-primary-700 p-5 sm:p-6 text-white overflow-hidden rounded-t-2xl sm:rounded-t-3xl">
                            <div class="absolute -right-6 -bottom-6 w-24 h-24 rounded-full bg-white/10 pointer-events-none"></div>
                            
                            <div class="flex items-center gap-4 relative z-10">
                                <!-- User Avatar Badge -->
                                <div class="w-14 h-14 rounded-full bg-white/20 border-2 border-white/60 overflow-hidden flex items-center justify-center shrink-0 shadow-md">
                                    @if(auth()->user()->avatar)
                                        <img src="{{ Storage::url(auth()->user()->avatar) }}" alt="{{ auth()->user()->name }}" class="w-full h-full object-cover">
                                    @else
                                        <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                                        </svg>
                                    @endif
                                </div>
                                <div class="min-w-0">
                                    <p class="text-xs font-medium text-primary-100">Selamat Datang,</p>
                                    <h2 class="text-base font-black text-white truncate tracking-tight mt-0.5">
                                        {{ auth()->user()->name }}
                                    </h2>
                                    @if(auth()->user()->isSupir())
                                        <div class="mt-1 flex flex-wrap items-center gap-1.5">
                                            <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-[10px] font-extrabold uppercase tracking-wider {{ auth()->user()->supir?->status_online ? 'bg-emerald-500/25 text-emerald-100 border border-emerald-400/30' : 'bg-white/20 text-white/90 border border-white/20' }}">
                                                <span class="w-1.5 h-1.5 rounded-full {{ auth()->user()->supir?->status_online ? 'bg-emerald-300 animate-pulse' : 'bg-slate-300' }}"></span>
                                                <span>{{ auth()->user()->supir?->status_online ? 'Siaga (Online)' : 'Offline' }}</span>
                                            </span>
                                            <span class="px-2 py-0.5 rounded-full bg-white/20 border border-white/20 text-white text-[10px] font-bold">
                                                Sopir
                                            </span>
                                        </div>
                                    @else
                                        <span class="inline-block mt-1 px-2 py-0.5 rounded-full bg-white/20 text-white text-[10px] font-bold tracking-wider uppercase">
                                            {{ auth()->user()->role_label }}
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        @if(auth()->user()->isSupir() && auth()->user()->supir)
                            <div class="px-5 py-3 bg-slate-50 border-b border-slate-100 flex items-center justify-between text-xs">
                                <div class="space-y-0.5 min-w-0">
                                    <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block">Armada Ambulans</span>
                                    <span class="font-extrabold text-slate-800 truncate block">{{ auth()->user()->supir->ambulans?->kode_ambulans ?? 'Unit Siaga' }} ({{ auth()->user()->supir->plat_nomor ?? auth()->user()->supir->ambulans?->plat_nomor ?? '-' }})</span>
                                </div>
                                <a href="{{ route('supir.tugas.index') }}" class="text-[11px] font-bold text-primary-700 hover:text-primary-800 hover:underline shrink-0 ml-2">
                                    Konsol Tugas →
                                </a>
                            </div>
                        @endif

                        <!-- Sidebar Menu Items -->
                        <nav class="divide-y divide-slate-100 py-2">
                            @if(auth()->user()->isSupir())
                                <!-- 1. Dashboard Sopir -->
                                <a href="{{ route('supir.dashboard') }}" 
                                   class="flex items-center gap-3.5 px-6 py-3.5 text-sm font-bold text-slate-600 hover:text-primary-600 hover:bg-slate-50 transition-colors group">
                                    <svg class="w-5 h-5 text-slate-400 group-hover:text-primary-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                                    </svg>
                                    <span>Dashboard Sopir</span>
                                </a>

                                <!-- 2. Tugas Ambulans (Antrean Dispatch) -->
                                <a href="{{ route('supir.tugas.index') }}" 
                                   class="flex items-center justify-between px-6 py-3.5 text-sm font-bold text-slate-600 hover:text-primary-600 hover:bg-slate-50 transition-colors group">
                                    <div class="flex items-center gap-3.5">
                                        <svg class="w-5 h-5 text-slate-400 group-hover:text-primary-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                                        </svg>
                                        <span>Tugas Ambulans</span>
                                    </div>
                                    @php
                                        $pendingOrderCount = \App\Models\Pemesanan::where('status', 'menunggu')->whereNull('supir_id')->count();
                                    @endphp
                                    @if($pendingOrderCount > 0)
                                        <span class="px-2 py-0.5 rounded-full text-[10px] font-extrabold bg-amber-50 text-amber-700 border border-amber-200">
                                            {{ $pendingOrderCount }} Masuk
                                        </span>
                                    @endif
                                </a>

                                <!-- 3. Perjalanan Aktif -->
                                <a href="{{ route('supir.perjalanan.aktif') }}" 
                                   class="flex items-center gap-3.5 px-6 py-3.5 text-sm font-bold text-slate-600 hover:text-primary-600 hover:bg-slate-50 transition-colors group">
                                    <svg class="w-5 h-5 text-slate-400 group-hover:text-primary-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"/>
                                    </svg>
                                    <span>Perjalanan Aktif</span>
                                </a>

                                <!-- 4. Riwayat Tugas -->
                                <a href="{{ route('supir.riwayat.index') }}" 
                                   class="flex items-center gap-3.5 px-6 py-3.5 text-sm font-bold text-slate-600 hover:text-primary-600 hover:bg-slate-50 transition-colors group">
                                    <svg class="w-5 h-5 text-slate-400 group-hover:text-primary-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    <span>Riwayat Tugas</span>
                                </a>
                            @else
                                <!-- 1. Beranda -->
                                <a href="{{ route('masyarakat.dashboard') }}" 
                                   class="flex items-center gap-3.5 px-6 py-3.5 text-sm font-bold text-slate-600 hover:text-primary-600 hover:bg-slate-50 transition-colors group">
                                    <svg class="w-5 h-5 text-slate-400 group-hover:text-primary-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                                    </svg>
                                    <span>Beranda</span>
                                </a>

                                <!-- 2. Pesanan -->
                                <a href="{{ route('masyarakat.orders.index') }}" 
                                   class="flex items-center gap-3.5 px-6 py-3.5 text-sm font-bold text-slate-600 hover:text-primary-600 hover:bg-slate-50 transition-colors group">
                                    <svg class="w-5 h-5 text-slate-400 group-hover:text-primary-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/>
                                    </svg>
                                    <span>Pesanan</span>
                                </a>

                                <!-- 3. Donasi -->
                                <a href="{{ route('donasi') }}" 
                                   class="flex items-center gap-3.5 px-6 py-3.5 text-sm font-bold text-slate-600 hover:text-primary-600 hover:bg-slate-50 transition-colors group">
                                    <svg class="w-5 h-5 text-slate-400 group-hover:text-primary-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                                    </svg>
                                    <span>Donasi</span>
                                </a>
                            @endif

                            <!-- Profil (Active) -->
                            <button type="button" @click="activeTab = 'profile'"
                               class="w-full text-left flex items-center gap-3.5 px-6 py-3.5 text-sm font-black text-primary-600 bg-primary-50/70 border-l-4 border-primary-600 transition-colors">
                                <svg class="w-5 h-5 text-primary-600" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                                </svg>
                                <span>Profil {{ auth()->user()->isSupir() ? 'Sopir' : 'Saya' }}</span>
                            </button>

                            <!-- Logout -->
                            <form method="POST" action="{{ route('logout') }}" class="w-full">
                                @csrf
                                <button type="submit" 
                                        class="w-full flex items-center gap-3.5 px-6 py-3.5 text-sm font-bold text-slate-500 hover:text-rose-600 hover:bg-rose-50/50 transition-colors group cursor-pointer">
                                    <svg class="w-5 h-5 text-slate-400 group-hover:text-rose-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                                    </svg>
                                    <span>Logout</span>
                                </button>
                            </form>
                        </nav>
                    </aside>

                    <!-- Right Main Settings Card -->
                    <section class="lg:col-span-8 xl:col-span-8.5 bg-white rounded-2xl sm:rounded-3xl border border-slate-200/80 shadow-sm p-6 sm:p-8">
                        
                        <!-- Top Navigation Tabs -->
                        <div class="flex items-center gap-6 sm:gap-8 border-b border-slate-200 mb-8 overflow-x-auto">
                            <!-- Ubah Profil Tab -->
                            <button type="button" @click="activeTab = 'profile'"
                                    class="pb-3 text-sm font-bold whitespace-nowrap transition-all border-b-2 cursor-pointer"
                                    :class="activeTab === 'profile' ? 'border-primary-600 text-primary-600' : 'border-transparent text-slate-500 hover:text-slate-800'">
                                Ubah Profil
                            </button>

                            <!-- Ubah Password Tab -->
                            <button type="button" @click="activeTab = 'password'"
                                    class="pb-3 text-sm font-bold whitespace-nowrap transition-all border-b-2 cursor-pointer"
                                    :class="activeTab === 'password' ? 'border-primary-600 text-primary-600' : 'border-transparent text-slate-500 hover:text-slate-800'">
                                Ubah Password
                            </button>

                            <!-- Hapus Akun Tab (Slide Terpisah) -->
                            <button type="button" @click="activeTab = 'delete'"
                                    class="pb-3 text-sm font-bold whitespace-nowrap transition-all border-b-2 cursor-pointer"
                                    :class="activeTab === 'delete' ? 'border-rose-600 text-rose-600' : 'border-transparent text-slate-500 hover:text-slate-800'">
                                Hapus Akun
                            </button>
                        </div>

                        <!-- Tab 1: Ubah Profil Form -->
                        <div x-show="activeTab === 'profile'" x-transition:enter="transition ease-out duration-150" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100">
                            @include('profile.partials.update-profile-information-form')
                        </div>

                        <!-- Tab 2: Ubah Password Form -->
                        <div x-show="activeTab === 'password'" x-transition:enter="transition ease-out duration-150" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" style="display: none;">
                            <div class="max-w-xl">
                                @include('profile.partials.update-password-form')
                            </div>
                        </div>

                        <!-- Tab 3: Hapus Akun Form (Slide Sendiri) -->
                        <div x-show="activeTab === 'delete'" x-transition:enter="transition ease-out duration-150" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" style="display: none;">
                            <div class="max-w-xl">
                                @include('profile.partials.delete-user-form')
                            </div>
                        </div>

                    </section>
                </div>
            </div>
        </div>
    </x-app-layout>
@endif
