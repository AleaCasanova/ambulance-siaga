<x-guest-layout>
    <div class="w-full max-w-[460px] sm:max-w-[500px] lg:max-w-[520px] my-auto">
        <!-- Card Container Panel Kanan (Ultra Compact Fit 100vh) -->
        <div class="bg-white rounded-2xl sm:rounded-3xl p-4 sm:p-5 lg:p-6 shadow-[0_12px_35px_-8px_rgba(14,138,205,0.12)] border border-slate-100/90">
            
            <!-- Header Form -->
            <div class="mb-3.5 text-center">
                <h2 class="text-xl sm:text-2xl font-black text-[#0F2747] tracking-tight">Masuk ke Ambulance Siaga</h2>
                <p class="text-[11px] sm:text-xs font-semibold text-slate-500 mt-1 leading-relaxed max-w-sm mx-auto">
                    Kelola operasional ambulans, penugasan medis, atau pantau pesanan Anda.
                </p>
            </div>

            <!-- Pending Emergency Order Alert -->
            @if(session('pending_order_code'))
                <div class="mb-3 p-2.5 rounded-lg bg-sky-50 border border-sky-200 text-sky-900 text-left flex items-start gap-2.5 shadow-xs">
                    <div class="w-5 h-5 rounded-md bg-primary-600 text-white flex items-center justify-center font-bold flex-shrink-0 text-[10px] mt-0.5 shadow-xs">
                        !
                    </div>
                    <div>
                        <h4 class="font-extrabold text-xs text-[#0F2747]">Pesanan #{{ session('pending_order_code') }} Telah Terkirim!</h4>
                        <p class="text-[10px] mt-0.5 text-sky-800 leading-relaxed font-medium">
                            Silakan masuk atau daftar akun di bawah ini agar Anda dapat melengkapi formulir medis pasien.
                        </p>
                    </div>
                </div>
            @endif

            <!-- Session Status -->
            <x-auth-session-status class="mb-3" :status="session('status')" />

            <!-- Unverified Account Prompt Alert -->
            @if(session('unverified_email'))
                <div class="mb-3 p-3 rounded-xl bg-amber-50 border border-amber-200 text-amber-900 text-left flex items-start gap-2.5 shadow-xs">
                    <div class="w-6 h-6 rounded-md bg-amber-500 text-white flex items-center justify-center font-bold flex-shrink-0 text-xs mt-0.5 shadow-xs">
                        ⚠️
                    </div>
                    <div class="flex-1">
                        <h4 class="font-extrabold text-xs text-amber-950">Akun Belum Terverifikasi</h4>
                        <p class="text-[11px] mt-0.5 text-amber-800 leading-relaxed font-semibold">
                            Akun Anda dengan email <strong>{{ session('unverified_email') }}</strong> belum diverifikasi. Silakan masukkan kode OTP.
                        </p>
                        <a href="{{ route('verification.otp.show', ['email' => session('unverified_email')]) }}"
                           class="mt-2 inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-primary-600 hover:bg-primary-700 text-white font-extrabold text-[10px] tracking-wider uppercase transition-all shadow-xs">
                            <span>Verifikasi OTP Sekarang</span>
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                            </svg>
                        </a>
                    </div>
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}" class="space-y-2.5">
                @csrf

                <!-- Email Address -->
                <div>
                    <label for="email" class="block text-[10px] font-extrabold text-slate-700 uppercase tracking-wider mb-0.5">
                        Alamat Email
                    </label>
                    <input id="email" type="email" name="email" :value="old('email')" required autofocus autocomplete="username"
                           placeholder="contoh: admin@ambulancesiaga.org"
                           class="w-full px-3 py-1.5 sm:py-2 rounded-lg border border-slate-200 bg-slate-50/60 text-xs font-semibold text-[#0F2747] placeholder:text-slate-400 focus:bg-white focus:border-[#1E9DE5] focus:ring-2 focus:ring-[#1E9DE5]/20 transition-all outline-none">
                    <x-input-error :messages="$errors->get('email')" class="mt-0.5 text-[11px]" />
                </div>

                <!-- Password with Show/Hide Eye Toggle -->
                <div x-data="{ showPassword: false }">
                    <div class="flex items-center justify-between mb-0.5">
                        <label for="password" class="block text-[10px] font-extrabold text-slate-700 uppercase tracking-wider">
                            Kata Sandi (Password)
                        </label>
                        @if (Route::has('password.request'))
                            <a class="text-[10px] font-bold text-primary-600 hover:text-[#007b83] hover:underline transition-colors" href="{{ route('password.request') }}">
                                Lupa sandi?
                            </a>
                        @endif
                    </div>
                    <div class="relative">
                        <input id="password" :type="showPassword ? 'text' : 'password'" type="password" name="password" required autocomplete="current-password"
                               placeholder="••••••••"
                               class="w-full px-3 py-1.5 sm:py-2 pr-10 rounded-lg border border-slate-200 bg-slate-50/60 text-xs font-semibold text-[#0F2747] placeholder:text-slate-400 focus:bg-white focus:border-[#1E9DE5] focus:ring-2 focus:ring-[#1E9DE5]/20 transition-all outline-none">
                        
                        <!-- Eye Icon Button -->
                        <button type="button" @click="showPassword = !showPassword" onclick="togglePasswordFallback('password', 'eye-icon-login')"
                                class="absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 hover:text-slate-600 focus:outline-none transition-colors p-1 flex items-center justify-center cursor-pointer"
                                title="Tampilkan/Sembunyikan Kata Sandi">
                            <svg id="eye-icon-login" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858-5.908a10.035 10.035 0 014.286-.963c4.478 0 8.268 2.943 9.542 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21M3 3l18 18"/>
                            </svg>
                        </button>
                    </div>
                    <x-input-error :messages="$errors->get('password')" class="mt-0.5 text-[11px]" />
                </div>

                <!-- Remember Me -->
                <div class="flex items-center justify-between pt-0.5">
                    <label for="remember_me" class="inline-flex items-center cursor-pointer select-none">
                        <input id="remember_me" type="checkbox" name="remember"
                               class="w-3.5 h-3.5 rounded border-slate-300 text-primary-600 focus:ring-[#009CA6]">
                        <span class="ms-1.5 text-xs font-semibold text-slate-600">Ingat sesi saya</span>
                    </label>
                </div>

                <!-- Submit Button: LOGIN -->
                <div class="pt-1.5 flex justify-center">
                    <button type="submit"
                            class="w-full py-2.5 px-5 rounded-lg bg-primary-600 hover:bg-primary-700 text-white font-extrabold text-xs sm:text-sm shadow-md shadow-[#009CA6]/20 transition-all duration-200 transform active:scale-[0.99] flex items-center justify-center tracking-wider uppercase cursor-pointer">
                        LOGIN
                    </button>
                </div>
            </form>

            <!-- Teks Registrasi -->
            <div class="mt-4 text-center">
                <p class="text-[11px] sm:text-xs font-medium text-slate-600 mb-4">
                    Belum memiliki akun?
                    <a href="{{ route('register') }}" class="font-extrabold text-primary-600 hover:text-[#007b83] hover:underline ms-1">
                        Daftar Akun
                    </a>
                </p>

                <!-- Separator -->
                <div class="relative flex items-center justify-center my-4">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-slate-200"></div>
                    </div>
                    <div class="relative bg-white px-3 text-[10px] font-semibold text-slate-400 uppercase tracking-wider">
                        atau
                    </div>
                </div>

                <!-- Driver Registration CTA -->
                <div class="mt-4 flex flex-col items-center gap-1.5">
                    <p class="text-[11px] font-semibold text-slate-600">
                        Ingin bergabung sebagai Pengemudi Ambulans?
                    </p>
                    <a href="{{ route('register.supir') }}" class="inline-flex items-center gap-1.5 px-4 py-2 mt-1 rounded-lg border border-sky-200 bg-sky-50 hover:bg-sky-100 text-primary-600 font-extrabold text-[11px] uppercase tracking-wider transition-colors shadow-sm">
                        <span>🚑</span>
                        Daftar sebagai Pengemudi
                    </a>
                </div>
            </div>
        </div>

        <!-- Tautan Kembali ke Beranda -->
        <div class="mt-3 text-center">
            <a href="{{ route('home') }}" 
               class="inline-flex items-center justify-center gap-1.5 text-[11px] sm:text-xs font-bold text-slate-600 hover:text-primary-600 transition-colors group">
                <svg class="w-3.5 h-3.5 text-slate-500 group-hover:text-primary-600 transform group-hover:-translate-x-1 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                <span>Kembali ke Beranda Ambulance Siaga</span>
            </a>
        </div>

        <!-- Copyright Global -->
        <p class="mt-1.5 text-[10px] font-semibold text-slate-400 text-center">
            &copy; {{ date('Y') }} Ambulance Siaga. Platform Layanan Darurat untuk Berbagai Mitra. Dikembangkan oleh GSC.
        </p>
    </div>

    <script>
        function togglePasswordFallback(inputId, iconId) {
            const input = document.getElementById(inputId);
            const icon = document.getElementById(iconId);
            if (!input || !icon) return;

            if (input.type === 'password') {
                input.type = 'text';
                icon.innerHTML = `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>`;
            } else {
                input.type = 'password';
                icon.innerHTML = `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858-5.908a10.035 10.035 0 014.286-.963c4.478 0 8.268 2.943 9.542 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21M3 3l18 18"/>`;
            }
        }
    </script>
</x-guest-layout>
