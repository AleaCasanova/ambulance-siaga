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
                <h2 class="text-2xl sm:text-2xl font-black text-slate-900 tracking-tight">Buat Akun Baru</h2>
                <p class="text-xs font-semibold text-slate-500 mt-1 leading-relaxed">
                    Daftar untuk mengakses layanan pemesanan ambulans dan bantuan medis darurat.
                </p>
            </div>

            <!-- Pending Emergency Order Alert -->
            @if(session('pending_order_code'))
                <div class="mb-4 p-3 rounded-2xl bg-sky-50 border border-sky-200 text-sky-900 text-left flex items-start gap-3 shadow-xs">
                    <div class="w-6 h-6 rounded-lg bg-primary-600 text-white flex items-center justify-center font-black flex-shrink-0 text-xs mt-0.5 shadow-xs">
                        !
                    </div>
                    <div>
                        <h4 class="font-extrabold text-xs text-slate-900">Pesanan #{{ session('pending_order_code') }} Telah Terkirim!</h4>
                        <p class="text-[11px] mt-0.5 text-sky-800 leading-relaxed font-medium">
                            Silakan selesaikan pendaftaran akun masyarakat agar Anda dapat memantau status ambulans.
                        </p>
                    </div>
                </div>
            @endif

            <form method="POST" action="{{ route('register') }}" class="space-y-3.5 sm:space-y-3">
                @csrf

                <!-- Field 1: Nama Lengkap -->
                <div>
                    <label for="name" class="block text-xs font-bold text-slate-700 mb-1">
                        Nama Lengkap
                    </label>
                    <input id="name" type="text" name="name" :value="old('name')" required autofocus autocomplete="name"
                           placeholder="Contoh: Budi Santoso"
                           class="w-full px-4 py-3 sm:py-2.5 rounded-xl border border-slate-200 bg-slate-50/70 text-sm sm:text-xs font-semibold text-slate-900 placeholder:text-slate-400 focus:bg-white focus:border-primary-600 focus:ring-4 focus:ring-primary-100 transition-all outline-none">
                    <x-input-error :messages="$errors->get('name')" class="mt-1 text-xs" />
                </div>

                <!-- Field 2: Alamat Email -->
                <div>
                    <label for="email" class="block text-xs font-bold text-slate-700 mb-1">
                        Alamat Email
                    </label>
                    <input id="email" type="email" name="email" :value="old('email')" required autocomplete="username"
                           placeholder="nama@email.com"
                           class="w-full px-4 py-3 sm:py-2.5 rounded-xl border border-slate-200 bg-slate-50/70 text-sm sm:text-xs font-semibold text-slate-900 placeholder:text-slate-400 focus:bg-white focus:border-primary-600 focus:ring-4 focus:ring-primary-100 transition-all outline-none">
                    <x-input-error :messages="$errors->get('email')" class="mt-1 text-xs" />
                </div>

                <!-- Field 3: Kata Sandi with Eye Toggle -->
                <div x-data="{ showPassword: false }">
                    <label for="password" class="block text-xs font-bold text-slate-700 mb-1">
                        Kata Sandi
                    </label>
                    <div class="relative">
                        <input id="password" :type="showPassword ? 'text' : 'password'" type="password" name="password" required autocomplete="new-password"
                               placeholder="Minimal 8 karakter"
                               class="w-full px-4 py-3 sm:py-2.5 pr-11 rounded-xl border border-slate-200 bg-slate-50/70 text-sm sm:text-xs font-semibold text-slate-900 placeholder:text-slate-400 focus:bg-white focus:border-primary-600 focus:ring-4 focus:ring-primary-100 transition-all outline-none">
                        
                        <button type="button" @click="showPassword = !showPassword" onclick="togglePasswordFallback('password', 'eye-icon-register-1')"
                                class="absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 hover:text-slate-600 focus:outline-none transition-colors p-1.5 flex items-center justify-center cursor-pointer"
                                title="Tampilkan/Sembunyikan Kata Sandi">
                            <svg id="eye-icon-register-1" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858-5.908a10.035 10.035 0 014.286-.963c4.478 0 8.268 2.943 9.542 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21M3 3l18 18"/>
                            </svg>
                        </button>
                    </div>
                    <x-input-error :messages="$errors->get('password')" class="mt-1 text-xs" />
                </div>

                <!-- Field 4: Konfirmasi Kata Sandi with Eye Toggle -->
                <div x-data="{ showConfirmPassword: false }">
                    <label for="password_confirmation" class="block text-xs font-bold text-slate-700 mb-1">
                        Konfirmasi Kata Sandi
                    </label>
                    <div class="relative">
                        <input id="password_confirmation" :type="showConfirmPassword ? 'text' : 'password'" type="password" name="password_confirmation" required autocomplete="new-password"
                               placeholder="Ulangi kata sandi"
                               class="w-full px-4 py-3 sm:py-2.5 pr-11 rounded-xl border border-slate-200 bg-slate-50/70 text-sm sm:text-xs font-semibold text-slate-900 placeholder:text-slate-400 focus:bg-white focus:border-primary-600 focus:ring-4 focus:ring-primary-100 transition-all outline-none">
                        
                        <button type="button" @click="showConfirmPassword = !showConfirmPassword" onclick="togglePasswordFallback('password_confirmation', 'eye-icon-register-2')"
                                class="absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 hover:text-slate-600 focus:outline-none transition-colors p-1.5 flex items-center justify-center cursor-pointer"
                                title="Tampilkan/Sembunyikan Konfirmasi Kata Sandi">
                            <svg id="eye-icon-register-2" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858-5.908a10.035 10.035 0 014.286-.963c4.478 0 8.268 2.943 9.542 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21M3 3l18 18"/>
                            </svg>
                        </button>
                    </div>
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1 text-xs" />
                </div>

                <!-- Submit Button: DAFTAR -->
                <div class="pt-2">
                    <button type="submit"
                            class="w-full py-3.5 sm:py-2.5 px-5 rounded-xl bg-primary-600 hover:bg-primary-700 active:scale-[0.99] text-white font-bold text-sm sm:text-xs shadow-md shadow-primary-600/25 transition-all duration-200 flex items-center justify-center tracking-wider uppercase cursor-pointer">
                        DAFTAR AKUN SEKARANG
                    </button>
                </div>
            </form>

            <!-- Navigasi Alternatif -->
            <div class="mt-5 text-center">
                <p class="text-xs font-medium text-slate-600">
                    Sudah memiliki akun?
                    <a href="{{ route('login') }}" class="font-extrabold text-primary-600 hover:text-primary-700 hover:underline ms-1">
                        Masuk ke Akun
                    </a>
                </p>
            </div>
        </div>

        <!-- Tautan Kembali ke Beranda (Desktop only view since mobile has top bar) -->
        <div class="hidden sm:block mt-4 text-center">
            <a href="{{ route('home') }}" 
               class="inline-flex items-center justify-center gap-1.5 text-xs font-bold text-slate-600 hover:text-primary-600 transition-colors group">
                <svg class="w-3.5 h-3.5 text-slate-500 group-hover:text-primary-600 transform group-hover:-translate-x-1 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                <span>Kembali ke Beranda Ambulans Siaga</span>
            </a>
        </div>

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
