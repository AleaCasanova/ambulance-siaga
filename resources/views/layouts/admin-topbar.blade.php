@php
    $user = auth()->user();
    $avatarUrl = $user?->avatar_url ?? 'https://ui-avatars.com/api/?name=' . urlencode($user?->name ?? 'Admin') . '&color=2563EB&background=EFF6FF&bold=true';
    $userName = $user?->name ?? 'Administrator';
    $userRole = $user?->role_label ?? 'Admin Ambulance';
@endphp

<!-- Topbar (Fixed) -->
<header class="h-16 bg-white border-b border-slate-200 flex items-center justify-between px-4 sm:px-6 fixed top-0 right-0 z-40 transition-all duration-300"
        :class="sidebarCollapsed ? 'left-0 lg:left-20' : 'left-0 lg:left-[260px]'">
    
    <div class="flex items-center gap-4">
        <!-- Hamburger (Desktop toggle) -->
        <button @click="sidebarCollapsed = !sidebarCollapsed" class="hidden lg:flex p-2 rounded-lg text-slate-500 hover:bg-slate-100 transition-colors focus:outline-none">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
        </button>

        <!-- Hamburger (Mobile toggle) -->
        <button @click="sidebarOpen = true" class="lg:hidden p-2 -ml-2 rounded-lg text-slate-500 hover:bg-slate-100 transition-colors focus:outline-none">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
        </button>
    </div>

    <!-- Right Side: Search, Notification, Profile -->
    <div class="flex items-center gap-3 sm:gap-5">
        
        <!-- Livewire Global Search -->
        @livewire('admin.global-search')

        <!-- Help Icon -->
        <button class="p-2 text-slate-400 hover:text-slate-600 hover:bg-slate-100 rounded-full transition-colors hidden sm:block" title="Bantuan">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        </button>

        <!-- Notification -->
        @if($user)
            @livewire('notification-dropdown', ['isDark' => false])
        @endif

        <div class="h-6 w-px bg-slate-200"></div>

        <!-- Profile Dropdown -->
        <div class="relative" x-data="{ open: false }">
            <button @click="open = !open" @click.outside="open = false" class="flex items-center gap-3 focus:outline-none hover:bg-slate-50 p-1 rounded-lg transition-colors">
                <img src="{{ $avatarUrl }}" alt="{{ $userName }}" class="w-8 h-8 rounded-full object-cover">
                <div class="hidden md:flex flex-col items-start text-left">
                    <span class="text-sm font-bold text-slate-800 leading-tight max-w-[120px] truncate">{{ $userName }}</span>
                    <span class="text-[11px] text-slate-500 font-medium">{{ $userRole }}</span>
                </div>
                <svg class="w-4 h-4 text-slate-400 hidden md:block" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
            </button>

            <!-- Dropdown Menu -->
            <div x-show="open" x-transition.opacity.duration.200ms
                 class="absolute right-0 mt-2 w-56 bg-white rounded-xl shadow-lg border border-slate-100 py-2 z-50"
                 style="display: none;">
                
                <div class="px-4 py-2 border-b border-slate-100 md:hidden">
                    <p class="text-sm font-bold text-slate-800">{{ $userName }}</p>
                    <p class="text-xs text-slate-500">{{ $userRole }}</p>
                </div>

                <a href="{{ route('profile.edit') }}" class="flex items-center gap-2 px-4 py-2 text-sm text-slate-700 hover:bg-slate-50 hover:text-[#2563EB] font-medium transition-colors">
                    <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                    <span>Profil Saya</span>
                </a>
                
                <a href="{{ route('admin.settings.index') }}" class="flex items-center gap-2 px-4 py-2 text-sm text-slate-700 hover:bg-slate-50 hover:text-[#2563EB] font-medium transition-colors">
                    <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    <span>Pengaturan</span>
                </a>

                <div class="border-t border-slate-100 my-1"></div>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full text-left flex items-center gap-2 px-4 py-2 text-sm text-[#DC2626] hover:bg-red-50 font-medium transition-colors">
                        <svg class="w-4 h-4 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                        <span>Keluar Sistem</span>
                    </button>
                </form>
            </div>
        </div>
    </div>
</header>
