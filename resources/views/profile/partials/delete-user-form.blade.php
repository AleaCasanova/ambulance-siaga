<section class="space-y-6">
    <header>
        <div class="flex items-center gap-2 mb-2">
            <span class="px-2.5 py-1 rounded-full text-xs font-extrabold bg-rose-50 text-rose-700 border border-rose-200 uppercase tracking-wider">
                Area Berbahaya
            </span>
        </div>
        <h2 class="text-xl font-extrabold text-rose-600">
            Hapus Akun Permanen
        </h2>

        <p class="mt-1 text-sm text-slate-500">
            Setelah akun Anda dihapus, semua sumber daya, riwayat pemesanan, dan data profil akan dihapus secara permanen dari sistem GSC SIAGA Cilacap.
        </p>
    </header>

    <button type="button"
            x-data=""
            x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
            class="px-6 py-3 rounded-xl bg-red-600 hover:bg-red-700 text-white font-extrabold text-sm shadow-md shadow-red-600/20 transition-all">
        HAPUS AKUN SAYA
    </button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6 sm:p-8">
            @csrf
            @method('delete')

            <h2 class="text-xl font-extrabold text-slate-800">
                Apakah Anda yakin ingin menghapus akun Anda?
            </h2>

            <p class="mt-2 text-sm text-slate-500">
                Setelah akun Anda dihapus, semua riwayat pesanan darurat dan data profil akan dihapus secara permanen. Masukkan kata sandi Anda untuk mengonfirmasi tindakan ini.
            </p>

            <div class="mt-6">
                <label for="password" class="block text-sm font-bold text-slate-700 mb-1.5">Kata Sandi Anda</label>
                <input id="password" name="password" type="password"
                       class="w-full sm:w-3/4 px-4 py-3 rounded-xl border border-slate-300 focus:border-sky-500 focus:ring-2 focus:ring-sky-200 text-sm font-medium transition-all"
                       placeholder="Masukkan kata sandi untuk konfirmasi..." />

                @error('password', 'userDeletion')
                    <p class="mt-1.5 text-xs font-semibold text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="mt-8 flex justify-end gap-3">
                <button type="button"
                        x-on:click="$dispatch('close')"
                        class="px-5 py-2.5 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold text-sm transition-all">
                    Batal
                </button>

                <button type="submit"
                        class="px-5 py-2.5 rounded-xl bg-red-600 hover:bg-red-700 text-white font-bold text-sm shadow-md transition-all">
                    Ya, Hapus Akun Saya
                </button>
            </div>
        </form>
    </x-modal>
</section>
