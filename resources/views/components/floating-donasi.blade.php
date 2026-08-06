<div class="fixed bottom-6 right-6 z-50 animate-bounce-slow group">
    <!-- Outer glow / shadow effect behind the card -->
    <div class="absolute -inset-2 bg-gradient-to-r from-[#009CA6] to-sky-400 rounded-[2rem] blur opacity-30 group-hover:opacity-50 transition duration-500"></div>
    
    <div class="relative bg-white/90 backdrop-blur-sm border border-white/50 p-4 rounded-3xl shadow-2xl flex items-center gap-4 hover:scale-105 hover:-translate-y-2 transition-all duration-300 w-72 sm:w-80">
        
        <!-- Icon Container -->
        <div class="w-14 h-14 bg-gradient-to-br from-red-50 to-pink-50 rounded-2xl flex items-center justify-center shrink-0 border border-red-100 shadow-inner overflow-hidden relative">
            <div class="absolute inset-0 bg-red-400 opacity-20 animate-pulse"></div>
            <svg class="w-8 h-8 text-red-500 relative z-10 animate-heartbeat" fill="currentColor" viewBox="0 0 24 24"><path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/></svg>
        </div>

        <!-- Text & Button -->
        <div class="flex-1 flex flex-col justify-center">
            <h4 class="text-slate-800 font-black text-[15px] leading-tight mb-1">Ayo Donasi!</h4>
            <p class="text-slate-500 text-[11px] leading-snug mb-2 font-medium">Bersama kita bantu lebih banyak pasien mendapatkan layanan ambulans.</p>
            <a href="{{ route('donasi') }}" class="inline-flex items-center justify-center gap-1.5 bg-gradient-to-r from-[#009CA6] to-[#007b83] text-white px-3 py-1.5 rounded-xl font-bold text-xs hover:shadow-lg hover:shadow-[#009CA6]/30 transition-all group/btn w-full">
                Donasi Sekarang
                <svg class="w-3.5 h-3.5 group-hover/btn:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
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
            transform: translateY(-8px);
        }
    }
    .animate-bounce-slow {
        animation: bounce-slow 3s ease-in-out infinite;
    }
    
    @keyframes heartbeat {
        0%, 100% {
            transform: scale(1);
        }
        15% {
            transform: scale(1.15);
        }
        30% {
            transform: scale(1);
        }
        45% {
            transform: scale(1.15);
        }
        60% {
            transform: scale(1);
        }
    }
    .animate-heartbeat {
        animation: heartbeat 2s ease-in-out infinite;
    }
</style>
