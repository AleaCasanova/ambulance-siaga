<div class="fixed {{ auth()->check() ? 'bottom-20 lg:bottom-5' : 'bottom-4 sm:bottom-5' }} right-3 sm:right-5 z-50 animate-bounce-slow group">
    
    <!-- Outer glow / shadow effect behind the card -->
    <div class="absolute -inset-1 bg-gradient-to-r from-primary-600 to-sky-400 rounded-2xl blur-xs opacity-20 group-hover:opacity-35 transition duration-500"></div>
    
    <div class="relative rounded-2xl p-2 sm:p-2.5 lg:p-3 shadow-xl border border-white/90 flex items-center gap-2 sm:gap-2.5 lg:gap-3 hover:scale-105 hover:-translate-y-1 transition-all duration-300 w-[190px] sm:w-[220px] lg:w-[240px] overflow-hidden bg-cover bg-center" style="background-image: url('{{ asset('images/donation (1).jpg') }}');">
        
        <!-- Gradient Overlay -->
        <div class="absolute inset-0 bg-gradient-to-r from-white/95 via-white/85 to-sky-100/70"></div>
        <div class="absolute inset-0 bg-gradient-to-t from-white/60 via-transparent to-white/40 pointer-events-none"></div>

        <!-- Thumbnail Image -->
        <div class="w-8 h-8 sm:w-9 sm:h-9 lg:w-10 lg:h-10 rounded-xl overflow-hidden shrink-0 border border-primary-400/80 shadow-xs relative z-10 animate-img-pulse bg-slate-100">
            <img src="{{ asset('images/donation (6).jpg') }}" alt="Donasi Ambulans Siaga" class="w-full h-full object-cover">
        </div>

        <!-- Text & Button -->
        <div class="flex-1 min-w-0 flex flex-col justify-center relative z-10">
            <div class="flex items-center gap-1 mb-0.5">
                <span class="w-1.5 h-1.5 rounded-full bg-primary-500 animate-pulse shrink-0"></span>
                <h4 class="text-slate-900 font-black text-[11px] sm:text-xs lg:text-sm leading-tight truncate">Ayo Donasi!</h4>
            </div>
            <p class="text-slate-600 text-[8.5px] sm:text-[9.5px] lg:text-[10px] leading-tight mb-1 font-medium truncate">Bantu pasien darurat</p>
            <a href="{{ route('donasi') }}" class="inline-flex items-center justify-center gap-1 bg-primary-600 hover:bg-primary-700 text-white px-2 py-0.5 sm:py-1 rounded-md font-bold text-[9.5px] sm:text-[10px] lg:text-[11px] shadow-xs shadow-primary-600/25 hover:shadow-sm transition-all group/btn w-full">
                <span>Donasi Sekarang</span>
                <svg class="w-2.5 h-2.5 group-hover/btn:translate-x-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
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
            transform: translateY(-5px);
        }
    }
    .animate-bounce-slow {
        animation: bounce-slow 3s ease-in-out infinite;
    }
    
    @keyframes img-pulse {
        0%, 100% {
            transform: scale(1);
            box-shadow: 0 2px 6px rgba(0, 156, 166, 0.15);
        }
        50% {
            transform: scale(1.08);
            box-shadow: 0 4px 10px rgba(0, 156, 166, 0.3);
        }
    }
    .animate-img-pulse {
        animation: img-pulse 2.2s ease-in-out infinite;
    }
</style>
