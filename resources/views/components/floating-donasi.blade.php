<div class="fixed bottom-4 right-4 sm:bottom-6 sm:right-6 z-50 animate-bounce-slow group">
    <!-- Outer glow / shadow effect behind the card -->
    <div class="absolute -inset-1.5 bg-gradient-to-r from-primary-600 to-sky-400 rounded-2xl blur opacity-25 group-hover:opacity-40 transition duration-500"></div>
    
    <div class="relative rounded-2xl p-2.5 sm:p-3 shadow-2xl border border-white/80 flex items-center gap-2.5 sm:gap-3 hover:scale-105 hover:-translate-y-1.5 transition-all duration-300 w-[calc(100vw-2.5rem)] max-w-[270px] sm:w-[270px] overflow-hidden bg-cover bg-center" style="background-image: url('{{ asset('images/donation (1).jpg') }}');">
        
        <!-- Gradient Overlay: Adjusted for clearer background image visibility & crisp text -->
        <div class="absolute inset-0 bg-gradient-to-r from-white/85 via-white/70 to-sky-100/50"></div>
        <div class="absolute inset-0 bg-gradient-to-t from-white/60 via-transparent to-white/40 pointer-events-none"></div>

        <!-- Thumbnail Image (donation (6).jpg with breathing/scale animation) -->
        <div class="w-11 h-11 sm:w-12 sm:h-12 rounded-xl overflow-hidden shrink-0 border-2 border-primary-400 shadow-sm relative z-10 animate-img-pulse bg-slate-100">
            <img src="{{ asset('images/donation (6).jpg') }}" alt="Donasi Ambulans Siaga" class="w-full h-full object-cover">
        </div>

        <!-- Text & Button -->
        <div class="flex-1 min-w-0 flex flex-col justify-center relative z-10">
            <div class="flex items-center gap-1.5 mb-0.5">
                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                <h4 class="text-slate-900 font-black text-[13px] sm:text-[14px] leading-tight truncate">Ayo Donasi!</h4>
            </div>
            <p class="text-slate-600 text-[10px] leading-tight mb-1.5 font-medium line-clamp-2">Bantu lebih banyak pasien dapatkan ambulans.</p>
            <a href="{{ route('donasi') }}" class="inline-flex items-center justify-center gap-1 bg-primary-600 hover:bg-primary-700 text-white px-2.5 py-1 rounded-lg font-bold text-[11px] shadow-sm shadow-primary-600/25 hover:shadow-md hover:shadow-primary-600/35 transition-all group/btn w-full">
                <span>Donasi Sekarang</span>
                <svg class="w-3 h-3 group-hover/btn:translate-x-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
            </a>
        </div>
    </div>
</div>

<style>
    @keyframes bounce-slow {
        0%, 100% {
            transform: translateY(0);
        }
        50% {
            transform: translateY(-6px);
        }
    }
    .animate-bounce-slow {
        animation: bounce-slow 3s ease-in-out infinite;
    }
    
    @keyframes img-pulse {
        0%, 100% {
            transform: scale(1);
            box-shadow: 0 3px 8px rgba(0, 156, 166, 0.15);
        }
        50% {
            transform: scale(1.1);
            box-shadow: 0 6px 14px rgba(0, 156, 166, 0.35);
        }
    }
    .animate-img-pulse {
        animation: img-pulse 2.2s ease-in-out infinite;
    }
</style>
