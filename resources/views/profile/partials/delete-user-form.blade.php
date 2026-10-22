<div class="space-y-4">
    <div class="p-5 rounded-xl border border-slate-200 bg-slate-50/60">
        <h3 class="text-sm font-bold text-slate-800">
            Hapus Akun
        </h3>
        <p class="mt-1 text-xs text-slate-500 leading-relaxed max-w-xl">
            Setelah akun Anda dihapus, semua data profil dan riwayat pemesanan akan dihapus secara permanen dari sistem Ambulans Siaga.
        </p>

        <div class="mt-4">
            <button type="button"
                    x-data=""
                    x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
                    class="px-4 py-2 rounded-lg border border-rose-300 bg-white hover:bg-rose-50 text-rose-600 font-bold text-xs transition-colors shadow-2xs cursor-pointer">
                Hapus Akun
            </button>
        </div>
    </div>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
            @csrf
            @method('delete')

            <h3 class="text-base font-bold text-slate-800">
                Konfirmasi Hapus Akun
            </h3>

            <p class="mt-2 text-xs text-slate-600 leading-relaxed">
                Apakah Anda yakin ingin menghapus akun ini secara permanen? Masukkan kata sandi akun Anda untuk mengonfirmasi.
            </p>

            <div class="mt-4">
                <label for="password" class="block text-xs font-semibold text-slate-700 mb-1">Kata Sandi Anda</label>
                <input id="password" name="password" type="password"
                       class="w-full sm:w-3/4 px-3.5 py-2 rounded-lg border border-slate-300 focus:border-rose-500 focus:ring-1 focus:ring-rose-500 text-sm"
                       placeholder="Masukkan kata sandi..." />

                @error('password', 'userDeletion')
                    <p class="mt-1 text-xs text-rose-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="mt-6 flex justify-end gap-2.5">
                <button type="button"
                        x-on:click="$dispatch('close')"
                        class="px-4 py-2 rounded-lg border border-slate-300 bg-white hover:bg-slate-50 text-slate-700 font-semibold text-xs transition-colors">
                    Batal
                </button>

                <button type="submit"
                        class="px-4 py-2 rounded-lg bg-rose-600 hover:bg-rose-700 text-white font-bold text-xs transition-colors shadow-xs">
                    Ya, Hapus Akun
                </button>
            </div>
        </form>
    </x-modal>
</div>
