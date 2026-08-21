<div>
    <!-- Header -->
    <div class="mb-8 flex flex-col lg:flex-row lg:items-end lg:justify-between gap-6">
        <div class="flex-1">
            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[11px] font-bold bg-slate-100 text-slate-500 uppercase tracking-wider mb-2.5">
                Konfigurasi Aplikasi
            </span>
            <h1 class="text-2xl sm:text-[28px] font-bold text-slate-900 tracking-tight leading-tight">
                Pengaturan Sistem Ambulans Siaga
            </h1>
            <p class="text-slate-500 text-[14px] mt-1.5 font-medium max-w-2xl">
                Sesuaikan informasi organisasi, hotline darurat, serta koordinat pusat penjemputan Cilacap.
            </p>
        </div>
    </div>

    <!-- Main Card -->
    <div class="bg-white rounded-3xl border border-slate-200/80 p-6 sm:p-8 shadow-xs max-w-3xl">
        <form wire:submit="saveSettings" class="space-y-6">

            <!-- Organisasi -->
            <div>
                <label class="block text-sm font-bold text-slate-700 mb-1.5">Nama Organisasi / Yayasan</label>
                <input type="text" wire:model="nama_organisasi" required
                       class="w-full px-4 py-3 rounded-xl border border-slate-300 text-sm font-semibold focus:border-sky-500 focus:ring-2 focus:ring-sky-200">
                @error('nama_organisasi') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- Hotline & Email -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-1.5">Telepon / Hotline Darurat 24 Jam</label>
                    <input type="text" wire:model="telepon_darurat" required
                           class="w-full px-4 py-3 rounded-xl border border-slate-300 text-sm font-bold focus:border-sky-500 focus:ring-2 focus:ring-sky-200 text-sky-600">
                    @error('telepon_darurat') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-1.5">Alamat Email Resmi</label>
                    <input type="email" wire:model="email_organisasi" required
                           class="w-full px-4 py-3 rounded-xl border border-slate-300 text-sm font-semibold focus:border-sky-500 focus:ring-2 focus:ring-sky-200">
                    @error('email_organisasi') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <!-- Alamat Kantor -->
            <div>
                <label class="block text-sm font-bold text-slate-700 mb-1.5">Alamat Pusat Koordinasi / Sekretariat</label>
                <input type="text" wire:model="alamat_kantor" required
                       class="w-full px-4 py-3 rounded-xl border border-slate-300 text-sm font-medium focus:border-sky-500 focus:ring-2 focus:ring-sky-200">
                @error('alamat_kantor') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- Koordinat Default Peta Cilacap -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 p-4 rounded-2xl bg-slate-50 border border-slate-200/80">
                <div>
                    <label class="block text-xs font-bold text-slate-600 uppercase tracking-wider mb-1">Default Latitude Peta (Cilacap)</label>
                    <input type="text" wire:model="default_lat" required
                           class="w-full px-4 py-2.5 rounded-xl border border-slate-300 text-sm font-mono focus:border-sky-500 focus:ring-2 focus:ring-sky-200">
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-600 uppercase tracking-wider mb-1">Default Longitude Peta (Cilacap)</label>
                    <input type="text" wire:model="default_lng" required
                           class="w-full px-4 py-2.5 rounded-xl border border-slate-300 text-sm font-mono focus:border-sky-500 focus:ring-2 focus:ring-sky-200">
                </div>
            </div>

            <!-- Tentang Ambulans Siaga -->
            <div>
                <label class="block text-sm font-bold text-slate-700 mb-1.5">Deskripsi / Tentang Sistem Ambulans Siaga</label>
                <textarea wire:model="tentang_gsc" rows="4"
                          class="w-full px-4 py-3 rounded-xl border border-slate-300 text-sm font-medium focus:border-sky-500 focus:ring-2 focus:ring-sky-200"></textarea>
                @error('tentang_gsc') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- Submit Button -->
            <div class="pt-2">
                <button type="submit"
                        class="px-8 py-4 rounded-2xl bg-sky-600 hover:bg-sky-700 text-white font-extrabold text-sm shadow-lg shadow-sky-600/30 transition-all">
                    SIMPAN KONFIGURASI SISTEM
                </button>
            </div>

        </form>
    </div>
</div>
