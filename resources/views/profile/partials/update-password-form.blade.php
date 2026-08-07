<section class="space-y-6">
    <header>
        <div class="flex items-center gap-2 mb-2">
            <span class="px-2.5 py-1 rounded-full text-xs font-extrabold bg-primary-100 text-primary-700 uppercase tracking-wider">
                Keamanan Akun
            </span>
        </div>
        <h2 class="text-xl font-extrabold text-slate-800">
            Perbarui Kata Sandi
        </h2>

        <p class="mt-1 text-sm text-slate-500">
            Pastikan akun Anda menggunakan kata sandi yang kuat dan aman untuk melindungi data pribadi dan riwayat pemesanan ambulans.
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-5">
        @csrf
        @method('put')

        <div>
            <label for="update_password_current_password" class="block text-sm font-bold text-slate-700 mb-1.5">
                Kata Sandi Saat Ini
            </label>
            <input id="update_password_current_password" name="current_password" type="password"
                   class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:border-primary-500 focus:ring-2 focus:ring-primary-200 text-sm font-medium transition-all"
                   autocomplete="current-password" />
            @error('current_password', 'updatePassword')
                <p class="mt-1.5 text-xs font-semibold text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="update_password_password" class="block text-sm font-bold text-slate-700 mb-1.5">
                Kata Sandi Baru
            </label>
            <input id="update_password_password" name="password" type="password"
                   class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:border-primary-500 focus:ring-2 focus:ring-primary-200 text-sm font-medium transition-all"
                   autocomplete="new-password" />
            @error('password', 'updatePassword')
                <p class="mt-1.5 text-xs font-semibold text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="update_password_password_confirmation" class="block text-sm font-bold text-slate-700 mb-1.5">
                Konfirmasi Kata Sandi Baru
            </label>
            <input id="update_password_password_confirmation" name="password_confirmation" type="password"
                   class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:border-primary-500 focus:ring-2 focus:ring-primary-200 text-sm font-medium transition-all"
                   autocomplete="new-password" />
            @error('password_confirmation', 'updatePassword')
                <p class="mt-1.5 text-xs font-semibold text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex items-center gap-4 pt-4 border-t border-slate-100">
            <button type="submit"
                    class="px-6 py-3 rounded-xl bg-primary-600 hover:bg-primary-700 text-white font-extrabold text-sm shadow-md shadow-primary-600/30 transition-all">
                PERBARUI KATA SANDI
            </button>

            @if (session('status') === 'password-updated')
                <p x-data="{ show: true }"
                   x-show="show"
                   x-transition
                   x-init="setTimeout(() => show = false, 4000)"
                   class="flex items-center gap-1.5 text-sm font-bold text-emerald-600">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    <span>Kata sandi berhasil diperbarui.</span>
                </p>
            @endif
        </div>
    </form>
</section>
