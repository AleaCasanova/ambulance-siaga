<x-guest-layout>
    <div class="w-full max-w-md sm:max-w-[500px] mx-auto">
        <div class="bg-transparent sm:bg-white rounded-none sm:rounded-3xl p-0 sm:p-6 shadow-none sm:shadow-[0_15px_40px_-10px_rgba(0,156,166,0.15)] border-0 sm:border sm:border-slate-100">
            <h2 class="text-2xl font-black text-slate-900 mb-2">Verifikasi Email Anda</h2>
            <div class="mb-4 text-xs font-medium text-slate-500 leading-relaxed">
                {{ __('Terima kasih telah mendaftar! Sebelum memulai, silakan verifikasi alamat email Anda melalui tautan yang telah kami kirimkan ke email Anda.') }}
            </div>

            @if (session('status') == 'verification-link-sent')
                <div class="mb-4 font-semibold text-xs text-emerald-700 bg-emerald-50 border border-emerald-200 p-3 rounded-xl">
                    {{ __('Tautan verifikasi baru telah dikirimkan ke alamat email yang Anda daftarkan.') }}
                </div>
            @endif

            <div class="mt-4 flex flex-col sm:flex-row items-center justify-between gap-3">
                <form method="POST" action="{{ route('verification.send') }}" class="w-full sm:w-auto">
                    @csrf
                    <button type="submit" class="w-full sm:w-auto py-2.5 px-4 rounded-xl bg-primary-600 hover:bg-primary-700 text-white font-bold text-xs shadow-sm transition-all">
                        {{ __('Kirim Ulang Email Verifikasi') }}
                    </button>
                </form>

                <form method="POST" action="{{ route('logout') }}" class="w-full sm:w-auto">
                    @csrf
                    <button type="submit" class="w-full sm:w-auto py-2.5 px-4 rounded-xl border border-slate-200 bg-white hover:bg-slate-50 text-slate-600 font-bold text-xs transition-all">
                        {{ __('Keluar (Log Out)') }}
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>
