<x-guest-layout>
    <div class="w-full max-w-md sm:max-w-[500px] mx-auto">
        <div class="bg-transparent sm:bg-white rounded-none sm:rounded-3xl p-0 sm:p-6 shadow-none sm:shadow-[0_15px_40px_-10px_rgba(0,156,166,0.15)] border-0 sm:border sm:border-slate-100">
            <h2 class="text-2xl font-black text-slate-900 mb-2">Konfirmasi Kata Sandi</h2>
            <div class="mb-4 text-xs font-medium text-slate-500 leading-relaxed">
                {{ __('Area ini dilindungi keamanan. Silakan konfirmasi kata sandi Anda sebelum melanjutkan.') }}
            </div>

            <form method="POST" action="{{ route('password.confirm') }}" class="space-y-4">
                @csrf

                <!-- Password -->
                <div>
                    <label for="password" class="block text-xs font-bold text-slate-700 mb-1">Kata Sandi</label>
                    <input id="password" class="w-full px-4 py-3 sm:py-2.5 rounded-xl border border-slate-200 bg-slate-50/70 text-sm font-semibold text-slate-900 focus:bg-white focus:border-primary-600 focus:ring-4 focus:ring-primary-100 outline-none"
                           type="password"
                           name="password"
                           required autocomplete="current-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-1 text-xs" />
                </div>

                <div class="pt-2">
                    <button type="submit" class="w-full py-3.5 sm:py-2.5 px-5 rounded-xl bg-primary-600 hover:bg-primary-700 active:scale-[0.99] text-white font-bold text-sm shadow-md shadow-primary-600/25 transition-all">
                        {{ __('Konfirmasi') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
