<!-- Top Navigation -->
<nav class="absolute top-0 left-0 w-full z-50 py-5 px-6 lg:px-12 flex justify-between items-center border-b border-white/10 bg-[#009CA6]/10 backdrop-blur-md">
    <div class="flex items-center gap-3">
        <div class="w-12 h-12 bg-white rounded-full p-1.5 flex items-center justify-center shadow-lg">
            <img src="{{ asset('images/logo_ambulansiaga.png') }}" alt="Logo" class="w-full h-full object-contain">
        </div>
        <div>
            <span class="text-white font-black text-xl tracking-tight hidden sm:block leading-none">{{ $namaOrg ?? 'Ambulance Siaga' }}</span>
            <span class="text-sky-100 text-[10px] font-bold tracking-widest uppercase hidden sm:block">LAZ GSC Cilacap</span>
        </div>
    </div>
    <div class="flex items-center gap-6">
        <a href="{{ route('home') }}" class="text-white font-bold hover:text-sky-200 transition text-sm hidden md:block">Beranda</a>
        <a href="{{ route('masyarakat.info') }}" class="text-white font-bold hover:text-sky-200 transition text-sm hidden md:block">Tentang Kami</a>
        <a href="{{ route('masyarakat.order.create') }}" class="text-white font-bold hover:text-sky-200 transition text-sm hidden md:block">Layanan Kami</a>
        
        <div class="h-6 w-px bg-white/30 hidden md:block"></div>

        @if (Route::has('login'))
            @auth
                @if(auth()->user()->hasRole('masyarakat'))
                    <a href="{{ route('masyarakat.orders.index') }}" class="text-white font-bold hover:text-sky-200 transition text-sm hidden md:block">Riwayat Pesanan</a>
                @endif
                <div x-data="{ open: false }" class="relative inline-block text-left">
                    <button @click="open = !open" type="button" class="flex items-center gap-2 bg-white/10 hover:bg-white/20 border border-white/20 text-white px-4 py-2 rounded-full font-bold transition shadow-sm text-sm">
                        <div class="w-6 h-6 rounded-full bg-white text-[#009CA6] flex items-center justify-center font-black text-xs uppercase">
                            {{ substr(auth()->user()->name, 0, 1) }}
                        </div>
                        <span class="hidden sm:block">{{ explode(' ', auth()->user()->name)[0] }}</span>
                        <svg class="w-4 h-4 opacity-70" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </button>

                    <div x-show="open" @click.away="open = false" x-transition class="absolute right-0 mt-2 w-48 rounded-xl shadow-lg bg-white ring-1 ring-black ring-opacity-5 divide-y divide-slate-100 focus:outline-none overflow-hidden" style="display: none;">
                        @if(auth()->user()->hasRole('masyarakat'))
                            <a href="{{ route('masyarakat.orders.index') }}" class="block px-4 py-3 text-sm text-slate-700 hover:bg-slate-50 hover:text-primary-600 font-bold transition">Dasbor Saya</a>
                        @else
                            <a href="{{ url('/dashboard') }}" class="block px-4 py-3 text-sm text-slate-700 hover:bg-slate-50 hover:text-primary-600 font-bold transition">Dasbor Petugas</a>
                        @endif
                        <a href="{{ route('profile.edit') }}" class="block px-4 py-3 text-sm text-slate-700 hover:bg-slate-50 hover:text-primary-600 font-bold transition">Profil Saya</a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="block w-full text-left px-4 py-3 text-sm text-red-600 hover:bg-red-50 font-bold transition">
                                Keluar (Logout)
                            </button>
                        </form>
                    </div>
                </div>
            @else
                <a href="{{ route('login') }}" class="text-white font-bold hover:text-sky-200 transition text-sm">Login</a>
                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="bg-white text-[#009CA6] px-6 py-2.5 rounded-full font-black hover:bg-sky-50 transition shadow-lg text-sm">Daftar Akun</a>
                @endif
            @endauth
        @endif
    </div>
</nav>
