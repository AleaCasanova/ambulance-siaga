<section class="space-y-6">
    <header class="pb-3 border-b border-slate-100">
        <h2 class="text-base font-bold text-slate-800">
            Ubah Password
        </h2>
        <p class="mt-1 text-xs text-slate-500">
            Pastikan akun Anda menggunakan kata sandi yang aman untuk melindungi data pribadi dan pesanan Anda.
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="space-y-4 max-w-lg">
        @csrf
        @method('put')

        <div>
            <label for="update_password_current_password" class="block text-xs font-semibold text-slate-700 mb-1">
                Kata Sandi Saat Ini
            </label>
            <input id="update_password_current_password" name="current_password" type="password"
                   class="w-full px-3.5 py-2.5 rounded-lg border border-slate-300 focus:border-primary-600 focus:ring-1 focus:ring-primary-600 text-sm transition-all"
                   autocomplete="current-password" />
            @error('current_password', 'updatePassword')
                <p class="mt-1 text-xs text-rose-600 font-medium">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="update_password_password" class="block text-xs font-semibold text-slate-700 mb-1">
                Kata Sandi Baru
            </label>
            <input id="update_password_password" name="password" type="password"
                   class="w-full px-3.5 py-2.5 rounded-lg border border-slate-300 focus:border-primary-600 focus:ring-1 focus:ring-primary-600 text-sm transition-all"
                   autocomplete="new-password" />
            @error('password', 'updatePassword')
                <p class="mt-1 text-xs text-rose-600 font-medium">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="update_password_password_confirmation" class="block text-xs font-semibold text-slate-700 mb-1">
                Konfirmasi Kata Sandi Baru
            </label>
            <input id="update_password_password_confirmation" name="password_confirmation" type="password"
                   class="w-full px-3.5 py-2.5 rounded-lg border border-slate-300 focus:border-primary-600 focus:ring-1 focus:ring-primary-600 text-sm transition-all"
                   autocomplete="new-password" />
            @error('password_confirmation', 'updatePassword')
                <p class="mt-1 text-xs text-rose-600 font-medium">{{ $message }}</p>
            @enderror
        </div>

        <div class="pt-2 flex items-center gap-3">
            <button type="submit"
                    class="px-6 py-2.5 rounded-lg bg-primary-600 hover:bg-primary-700 text-white font-bold text-xs uppercase tracking-wider transition-colors shadow-xs">
                Simpan Password
            </button>

            @if (session('status') === 'password-updated')
                <span x-data="{ show: true }"
                      x-show="show"
                      x-transition
                      x-init="setTimeout(() => show = false, 4000)"
                      class="text-xs font-semibold text-emerald-600">
                    Kata sandi berhasil diperbarui.
                </span>
            @endif
        </div>
    </form>
</section>
