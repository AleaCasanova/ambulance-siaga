<x-guest-layout>
    <!-- Header Form -->
    <div class="mb-6 text-center">
        <h2 class="text-xl font-extrabold text-slate-800">Daftar Akun Masyarakat</h2>
        <p class="text-xs font-semibold text-slate-500 mt-1">
            Buat akun baru untuk melacak riwayat pesanan ambulans dan memberikan ulasan pelayanan.
        </p>
    </div>

    <!-- Pending Emergency Order Alert -->
    @if(session('pending_order_code'))
        <div class="mb-5 p-4 rounded-2xl bg-sky-50 border border-sky-200 text-sky-900 text-left flex items-start gap-3 shadow-sm">
            <div class="w-7 h-7 rounded-lg bg-sky-600 text-white flex items-center justify-center font-bold flex-shrink-0 text-xs mt-0.5">
                !
            </div>
            <div>
                <h4 class="font-extrabold text-sm">Pesanan #{{ session('pending_order_code') }} Telah Terkirim!</h4>
                <p class="text-xs mt-0.5 text-sky-700 leading-relaxed font-medium">
                    Silakan daftar akun baru di bawah ini agar Anda dapat melengkapi formulir kebutuhan medis pasien.
                </p>
            </div>
        </div>
    @endif

    <form method="POST" action="{{ route('register') }}" class="space-y-4">
        @csrf

        <!-- Name -->
        <div>
            <label for="name" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">
                Nama Lengkap
            </label>
            <input id="name" type="text" name="name" :value="old('name')" required autofocus autocomplete="name"
                   placeholder="contoh: Budi Santoso"
                   class="w-full px-4 py-3 rounded-xl border border-slate-300 bg-slate-50/50 text-sm font-semibold text-slate-800 focus:bg-white focus:border-sky-500 focus:ring-2 focus:ring-sky-200 transition-all">
            <x-input-error :messages="$errors->get('name')" class="mt-1" />
        </div>

        <!-- Email Address -->
        <div>
            <label for="email" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">
                Alamat Email
            </label>
            <input id="email" type="email" name="email" :value="old('email')" required autocomplete="username"
                   placeholder="contoh: budi@gmail.com"
                   class="w-full px-4 py-3 rounded-xl border border-slate-300 bg-slate-50/50 text-sm font-semibold text-slate-800 focus:bg-white focus:border-sky-500 focus:ring-2 focus:ring-sky-200 transition-all">
            <x-input-error :messages="$errors->get('email')" class="mt-1" />
        </div>

        <!-- Password -->
        <div>
            <label for="password" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">
                Kata Sandi (Password)
            </label>
            <input id="password" type="password" name="password" required autocomplete="new-password"
                   placeholder="Minimal 8 karakter"
                   class="w-full px-4 py-3 rounded-xl border border-slate-300 bg-slate-50/50 text-sm font-semibold text-slate-800 focus:bg-white focus:border-sky-500 focus:ring-2 focus:ring-sky-200 transition-all">
            <x-input-error :messages="$errors->get('password')" class="mt-1" />
        </div>

        <!-- Confirm Password -->
        <div>
            <label for="password_confirmation" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">
                Konfirmasi Kata Sandi
            </label>
            <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password"
                   placeholder="Ulangi kata sandi"
                   class="w-full px-4 py-3 rounded-xl border border-slate-300 bg-slate-50/50 text-sm font-semibold text-slate-800 focus:bg-white focus:border-sky-500 focus:ring-2 focus:ring-sky-200 transition-all">
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1" />
        </div>

        <!-- Submit Button -->
        <div class="pt-2">
            <button type="submit"
                    class="w-full py-3.5 px-6 rounded-xl bg-sky-600 hover:bg-sky-700 text-white font-extrabold text-sm shadow-lg shadow-sky-600/30 transition-all transform active:scale-[0.98]">
                DAFTAR AKUN SEKARANG &rarr;
            </button>
        </div>
    </form>

    <!-- Login Link -->
    <div class="mt-6 pt-6 border-t border-slate-100 text-center">
        <p class="text-xs font-medium text-slate-500">
            Sudah memiliki akun?
            <a href="{{ route('login') }}" class="font-extrabold text-sky-600 hover:underline ms-1">
                Masuk di Sini
            </a>
        </p>
    </div>
</x-guest-layout>
