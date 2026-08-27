<x-guest-layout>
    <div class="w-full max-w-md sm:max-w-[500px] lg:max-w-[520px] mx-auto">
        <!-- Container Card (Borderless & Clean on Mobile, Floating Card on Desktop) -->
        <div class="bg-transparent sm:bg-white rounded-none sm:rounded-3xl p-0 sm:p-6 lg:p-7 shadow-none sm:shadow-[0_15px_40px_-10px_rgba(0,156,166,0.15)] border-0 sm:border sm:border-slate-100 transition-all">
            
            <!-- Mobile Top Bar Navigation (Pinterest Style) -->
            <div class="flex items-center justify-between pb-4 mb-5 border-b border-slate-100 sm:hidden">
                <a href="{{ route('login') }}" class="inline-flex items-center gap-2 text-xs font-bold text-slate-600 hover:text-primary-600 transition-colors p-1 -ml-1">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/>
                    </svg>
                    <span>Masuk</span>
                </a>
                <div class="flex items-center gap-2">
                    <img src="{{ asset('images/logo_ambulansiaga.png') }}" alt="Logo" class="w-6 h-6 object-contain">
                    <span class="text-xs font-black text-slate-800 tracking-tight">Ambulans Siaga</span>
                </div>
            </div>

            <!-- Header Form -->
            <div class="mb-5 sm:mb-6 text-left sm:text-center">
                <h2 class="text-2xl sm:text-2xl font-black text-slate-900 tracking-tight">Lupa Kata Sandi?</h2>
                <p class="text-xs font-semibold text-slate-500 mt-1 leading-relaxed">
                    Jangan khawatir. Masukkan alamat email akun Anda dan kami akan mengirimkan tautan reset kata sandi.
                </p>
            </div>

            <!-- Session Status Alert -->
            <x-auth-session-status class="mb-4 text-xs font-bold text-emerald-700 bg-emerald-50 border border-emerald-200 p-3 rounded-xl" :status="session('status')" />

            <form method="POST" action="{{ route('password.email') }}" class="space-y-4 sm:space-y-3.5">
                @csrf

                <!-- Email Address -->
                <div>
                    <label for="email" class="block text-xs font-bold text-slate-700 mb-1">
                        Alamat Email
                    </label>
                    <input id="email" type="email" name="email" :value="old('email')" required autofocus
                           placeholder="nama@email.com"
                           class="w-full px-4 py-3 sm:py-2.5 rounded-xl border border-slate-200 bg-slate-50/70 text-sm sm:text-xs font-semibold text-slate-900 placeholder:text-slate-400 focus:bg-white focus:border-primary-600 focus:ring-4 focus:ring-primary-100 transition-all outline-none">
                    <x-input-error :messages="$errors->get('email')" class="mt-1 text-xs" />
                </div>

                <div class="pt-2">
                    <button type="submit"
                            class="w-full py-3.5 sm:py-2.5 px-5 rounded-xl bg-primary-600 hover:bg-primary-700 active:scale-[0.99] text-white font-bold text-sm sm:text-xs shadow-md shadow-primary-600/25 transition-all duration-200 flex items-center justify-center tracking-wider uppercase cursor-pointer">
                        KIRIM TAUTAN RESET
                    </button>
                </div>
            </form>

            <!-- Tautan Kembali ke Login (Mobile friendly) -->
            <div class="mt-5 text-center">
                <a href="{{ route('login') }}" 
                   class="inline-flex items-center justify-center gap-1.5 text-xs font-bold text-slate-600 hover:text-primary-600 transition-colors group">
                    <svg class="w-4 h-4 text-slate-500 group-hover:text-primary-600 transform group-hover:-translate-x-1 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    <span>Kembali ke Halaman Login</span>
                </a>
            </div>
        </div>

        <!-- Desktop Footer Link -->
        <div class="hidden sm:block mt-4 text-center">
            <a href="{{ route('home') }}" 
               class="text-xs font-semibold text-slate-500 hover:text-primary-600 transition-colors">
                ← Kembali ke Beranda
            </a>
        </div>
    </div>
</x-guest-layout>
