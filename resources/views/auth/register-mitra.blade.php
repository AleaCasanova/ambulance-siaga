<x-guest-layout>
    <div class="w-full max-w-[460px] sm:max-w-[500px] lg:max-w-[520px] my-auto">
        <!-- Card Container Panel Kanan (Ultra Compact Fit 100vh) -->
        <div class="bg-white rounded-2xl sm:rounded-3xl p-4 sm:p-5 lg:p-6 shadow-[0_12px_35px_-8px_rgba(14,138,205,0.12)] border border-slate-100/90">
            
            <!-- Header Form -->
            <div class="mb-3 text-center">
                <h2 class="text-xl sm:text-2xl font-black text-[#0F2747] tracking-tight">Daftar Mitra Armada</h2>
                <p class="text-[11px] sm:text-xs font-semibold text-slate-500 mt-0.5 leading-relaxed max-w-sm mx-auto">
                    Daftarkan armada ambulans Anda untuk bergabung bersama jaringan Ambulans Siaga.
                </p>
            </div>

            <form method="POST" action="{{ route('register.mitra') }}" class="space-y-2">
                @csrf

                <!-- Field 1: Nama Lembaga / Mitra -->
                <div>
                    <label for="nama_lembaga" class="block text-[10px] font-extrabold text-slate-700 uppercase tracking-wider mb-0.5">
                        Nama Lembaga / Mitra
                    </label>
                    <input id="nama_lembaga" type="text" name="nama_lembaga" :value="old('nama_lembaga')" required autofocus
                           placeholder="contoh: RS Kasih Ibu / PMI Cabang"
                           class="w-full px-3 py-1.5 sm:py-2 rounded-lg border border-slate-200 bg-slate-50/60 text-xs font-semibold text-[#0F2747] placeholder:text-slate-400 focus:bg-white focus:border-[#1E9DE5] focus:ring-2 focus:ring-[#1E9DE5]/20 transition-all outline-none">
                    <x-input-error :messages="$errors->get('nama_lembaga')" class="mt-0.5 text-[11px]" />
                </div>

                <!-- Field 2: Nama Penanggung Jawab (User Name) -->
                <div>
                    <label for="name" class="block text-[10px] font-extrabold text-slate-700 uppercase tracking-wider mb-0.5">
                        Nama Penanggung Jawab
                    </label>
                    <input id="name" type="text" name="name" :value="old('name')" required autocomplete="name"
                           placeholder="contoh: Budi Santoso"
                           class="w-full px-3 py-1.5 sm:py-2 rounded-lg border border-slate-200 bg-slate-50/60 text-xs font-semibold text-[#0F2747] placeholder:text-slate-400 focus:bg-white focus:border-[#1E9DE5] focus:ring-2 focus:ring-[#1E9DE5]/20 transition-all outline-none">
                    <x-input-error :messages="$errors->get('name')" class="mt-0.5 text-[11px]" />
                </div>

                <div class="grid grid-cols-2 gap-2">
                    <!-- Field 3: Alamat Email -->
                    <div>
                        <label for="email" class="block text-[10px] font-extrabold text-slate-700 uppercase tracking-wider mb-0.5">
                            Email Lembaga
                        </label>
                        <input id="email" type="email" name="email" :value="old('email')" required autocomplete="username"
                               placeholder="nama@email.com"
                               class="w-full px-3 py-1.5 sm:py-2 rounded-lg border border-slate-200 bg-slate-50/60 text-xs font-semibold text-[#0F2747] placeholder:text-slate-400 focus:bg-white focus:border-[#1E9DE5] focus:ring-2 focus:ring-[#1E9DE5]/20 transition-all outline-none">
                        <x-input-error :messages="$errors->get('email')" class="mt-0.5 text-[11px]" />
                    </div>

                    <!-- Field 4: Nomor Telepon / WA -->
                    <div>
                        <label for="phone" class="block text-[10px] font-extrabold text-slate-700 uppercase tracking-wider mb-0.5">
                            Nomor HP / WA
                        </label>
                        <input id="phone" type="text" name="phone" :value="old('phone')" required
                               placeholder="08123456789"
                               class="w-full px-3 py-1.5 sm:py-2 rounded-lg border border-slate-200 bg-slate-50/60 text-xs font-semibold text-[#0F2747] placeholder:text-slate-400 focus:bg-white focus:border-[#1E9DE5] focus:ring-2 focus:ring-[#1E9DE5]/20 transition-all outline-none">
                        <x-input-error :messages="$errors->get('phone')" class="mt-0.5 text-[11px]" />
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-2">
                    <!-- Field 5: Kata Sandi (Password) with Eye Icon Toggle -->
                    <div x-data="{ showPassword: false }">
                        <div class="mb-0.5">
                            <label for="password" class="block text-[10px] font-extrabold text-slate-700 uppercase tracking-wider">
                                Kata Sandi
                            </label>
                        </div>
                        <div class="relative">
                            <input id="password" :type="showPassword ? 'text' : 'password'" type="password" name="password" required autocomplete="new-password"
                                   placeholder="••••••••"
                                   class="w-full px-3 py-1.5 sm:py-2 pr-10 rounded-lg border border-slate-200 bg-slate-50/60 text-xs font-semibold text-[#0F2747] placeholder:text-slate-400 focus:bg-white focus:border-[#1E9DE5] focus:ring-2 focus:ring-[#1E9DE5]/20 transition-all outline-none">
                            
                            <button type="button" @click="showPassword = !showPassword" onclick="togglePasswordFallback('password', 'eye-icon-register-1')"
                                    class="absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 hover:text-slate-600 focus:outline-none transition-colors p-1 flex items-center justify-center cursor-pointer"
                                    title="Tampilkan/Sembunyikan Kata Sandi">
                                <svg id="eye-icon-register-1" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858-5.908a10.035 10.035 0 014.286-.963c4.478 0 8.268 2.943 9.542 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21M3 3l18 18"/>
                                </svg>
                            </button>
                        </div>
                        <x-input-error :messages="$errors->get('password')" class="mt-0.5 text-[11px]" />
                    </div>

                    <!-- Field 6: Konfirmasi Kata Sandi with Eye Icon Toggle -->
                    <div x-data="{ showConfirmPassword: false }">
                        <div class="mb-0.5">
                            <label for="password_confirmation" class="block text-[10px] font-extrabold text-slate-700 uppercase tracking-wider">
                                Ulangi Sandi
                            </label>
                        </div>
                        <div class="relative">
                            <input id="password_confirmation" :type="showConfirmPassword ? 'text' : 'password'" type="password" name="password_confirmation" required autocomplete="new-password"
                                   placeholder="••••••••"
                                   class="w-full px-3 py-1.5 sm:py-2 pr-10 rounded-lg border border-slate-200 bg-slate-50/60 text-xs font-semibold text-[#0F2747] placeholder:text-slate-400 focus:bg-white focus:border-[#1E9DE5] focus:ring-2 focus:ring-[#1E9DE5]/20 transition-all outline-none">
                            
                            <button type="button" @click="showConfirmPassword = !showConfirmPassword" onclick="togglePasswordFallback('password_confirmation', 'eye-icon-register-2')"
                                    class="absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 hover:text-slate-600 focus:outline-none transition-colors p-1 flex items-center justify-center cursor-pointer"
                                    title="Tampilkan/Sembunyikan Konfirmasi Kata Sandi">
                                <svg id="eye-icon-register-2" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858-5.908a10.035 10.035 0 014.286-.963c4.478 0 8.268 2.943 9.542 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21M3 3l18 18"/>
                                </svg>
                            </button>
                        </div>
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-0.5 text-[11px]" />
                    </div>
                </div>

                <!-- Tombol Tindakan Utama: DAFTAR -->
                <div class="pt-3 flex justify-center">
                    <button type="submit"
                            class="w-full py-2.5 px-5 rounded-lg bg-primary-600 hover:bg-primary-700 text-white font-extrabold text-xs sm:text-sm shadow-md shadow-[#009CA6]/20 transition-all duration-200 transform active:scale-[0.99] flex items-center justify-center tracking-wider uppercase cursor-pointer">
                        DAFTARKAN ARMADA
                    </button>
                </div>
            </form>

            <!-- Navigasi Alternatif -->
            <div class="mt-3 text-center flex flex-col gap-2">
                <p class="text-[11px] sm:text-xs font-medium text-slate-600">
                    Hanya ingin mendaftar sebagai pengemudi?
                    <a href="{{ route('register.supir') }}" class="font-extrabold text-primary-600 hover:text-[#007b83] hover:underline ms-1">
                        Daftar sebagai Pengemudi
                    </a>
                </p>
                <p class="text-[11px] sm:text-xs font-medium text-slate-600">
                    Sudah memiliki akun mitra?
                    <a href="{{ route('login') }}" class="font-extrabold text-primary-600 hover:text-[#007b83] hover:underline ms-1">
                        Kembali ke Login
                    </a>
                </p>
            </div>
        </div>

        <!-- Tautan Kembali ke Beranda -->
        <div class="mt-2.5 text-center">
            <a href="{{ route('home') }}" 
               class="inline-flex items-center justify-center gap-1.5 text-[11px] sm:text-xs font-bold text-slate-600 hover:text-primary-600 transition-colors group">
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
