<x-guest-layout>
    <div class="w-full max-w-[460px] sm:max-w-[500px] lg:max-w-[520px] my-auto">
        <!-- Card Container -->
        <div class="bg-white rounded-2xl sm:rounded-3xl p-4 sm:p-5 lg:p-6 shadow-[0_12px_35px_-8px_rgba(0,156,166,0.12)] border border-slate-100/90">
            
            <!-- Header -->
            <div class="mb-4 text-center">
                <div class="w-12 h-12 bg-sky-50 rounded-full flex items-center justify-center mx-auto mb-3 text-[#009CA6]">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                    </svg>
                </div>
                <h2 class="text-xl sm:text-2xl font-black text-[#0F2747] tracking-tight">Lupa Kata Sandi?</h2>
                <p class="text-[11px] sm:text-xs font-semibold text-slate-500 mt-2 leading-relaxed max-w-sm mx-auto">
                    {{ __('Tidak masalah. Cukup beri tahu kami alamat email Anda dan kami akan mengirimkan tautan untuk mereset kata sandi Anda.') }}
                </p>
            </div>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4 text-center text-xs font-bold text-emerald-600 bg-emerald-50 p-2 rounded-lg" :status="session('status')" />

            <form method="POST" action="{{ route('password.email') }}" class="space-y-4">
                @csrf

                <!-- Email Address -->
                <div>
                    <label for="email" class="block text-[10px] font-extrabold text-slate-700 uppercase tracking-wider mb-1">
                        Alamat Email
                    </label>
                    <input id="email" type="email" name="email" :value="old('email')" required autofocus
                           placeholder="Masukkan email Anda"
                           class="w-full px-3 py-2 rounded-lg border border-slate-200 bg-slate-50/60 text-sm font-semibold text-[#0F2747] placeholder:text-slate-400 focus:bg-white focus:border-[#009CA6] focus:ring-2 focus:ring-[#009CA6]/20 transition-all outline-none">
                    <x-input-error :messages="$errors->get('email')" class="mt-1 text-xs" />
                </div>

                <div class="pt-2">
                    <button type="submit"
                            class="w-full py-3 px-5 rounded-lg bg-[#009CA6] hover:bg-[#007b83] text-white font-extrabold text-xs sm:text-sm shadow-md shadow-[#009CA6]/20 transition-all duration-200 transform active:scale-[0.99] flex items-center justify-center tracking-wider uppercase cursor-pointer">
                        {{ __('Kirim Tautan Reset Sandi') }}
                    </button>
                </div>
            </form>
        </div>

        <!-- Tautan Kembali ke Login -->
        <div class="mt-4 text-center">
            <a href="{{ route('login') }}" 
               class="inline-flex items-center justify-center gap-1.5 text-[11px] sm:text-xs font-bold text-slate-600 hover:text-[#009CA6] transition-colors group">
                <svg class="w-3.5 h-3.5 text-slate-500 group-hover:text-[#009CA6] transform group-hover:-translate-x-1 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                <span>Kembali ke Halaman Login</span>
            </a>
        </div>
    </div>
</x-guest-layout>
