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
                <a href="{{ url('/dashboard') }}" class="bg-white text-[#009CA6] px-6 py-2.5 rounded-full font-bold hover:bg-sky-50 transition shadow-lg text-sm">Masuk Dashboard</a>
            @else
                <a href="{{ route('login') }}" class="text-white font-bold hover:text-sky-200 transition text-sm">Login</a>
                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="bg-white text-[#009CA6] px-6 py-2.5 rounded-full font-black hover:bg-sky-50 transition shadow-lg text-sm">Daftar Akun</a>
                @endif
            @endauth
        @endif
    </div>
</nav>
