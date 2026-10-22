<div>
    <!-- Header Page -->
    <div class="mb-8 flex flex-col lg:flex-row lg:items-end lg:justify-between gap-6">
        <div class="flex-1">
            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[11px] font-bold bg-slate-100 text-slate-500 uppercase tracking-wider mb-2.5">
                Konfigurasi Aplikasi
            </span>
            <h1 class="text-2xl sm:text-[28px] font-bold text-slate-900 tracking-tight leading-tight">
                Pengaturan Sistem Ambulans Siaga
            </h1>
            <p class="text-slate-500 text-[14px] mt-1.5 font-medium max-w-2xl">
                Sesuaikan informasi profil instansi, kontak darurat 24 jam, serta titik acuan peta operasional Cilacap.
            </p>
        </div>
    </div>

    <!-- Feedback Alerts -->
    @if (session()->has('success'))
        <div class="mb-6 p-4 rounded-xl bg-emerald-50 border border-emerald-200 flex items-center justify-between text-emerald-800 text-xs font-semibold shadow-xs">
            <div class="flex items-center gap-2.5">
                <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                <span>{{ session('success') }}</span>
            </div>
            <span class="text-[11px] text-emerald-600 uppercase font-bold">Tersimpan</span>
        </div>
    @endif

    @if (session()->has('info'))
        <div class="mb-6 p-4 rounded-xl bg-sky-50 border border-sky-200 flex items-center justify-between text-sky-800 text-xs font-semibold shadow-xs">
            <div class="flex items-center gap-2.5">
                <span class="w-2 h-2 rounded-full bg-sky-500"></span>
                <span>{{ session('info') }}</span>
            </div>
            <span class="text-[11px] text-sky-600 uppercase font-bold">Informasi</span>
        </div>
    @endif

    <!-- Main Content Layout (Simetris 2-Kolom) -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start">
        
        <!-- Kolom Kiri: Form Konfigurasi (8 Kolom) -->
        <div class="lg:col-span-8 space-y-6">
            <form wire:submit="saveSettings" class="space-y-6">

                <!-- Section 1: Identitas & Kontak Resmi -->
                <div class="bg-white rounded-xl border border-slate-200/80 shadow-xs overflow-hidden">
                    <div class="px-6 py-4 border-b border-slate-100 bg-slate-50/50 flex items-center justify-between">
                        <div>
                            <h2 class="text-sm font-bold text-slate-800">Identitas Instansi & Kontak Darurat</h2>
                            <p class="text-xs text-slate-500 mt-0.5">Informasi resmi yang tertera pada layanan dan dokumen operasional</p>
                        </div>
                    </div>

                    <div class="p-6 space-y-5">
                        <!-- Nama Organisasi -->
                        <div>
                            <label class="block text-xs font-bold text-slate-600 uppercase tracking-wider mb-1.5">
                                Nama Organisasi / Yayasan
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                                </div>
                                <input type="text" wire:model.live="nama_organisasi" required
                                       placeholder="Contoh: Ambulans Siaga"
                                       class="w-full pl-9 pr-4 py-2.5 rounded-lg border border-slate-300 text-xs font-semibold text-slate-800 focus:border-cyan-500 focus:ring-1 focus:ring-cyan-500 transition-all shadow-2xs">
                            </div>
                            @error('nama_organisasi') <p class="text-xs text-rose-600 mt-1">{{ $message }}</p> @enderror
                        </div>

                        <!-- Hotline & Email Grid -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-bold text-slate-600 uppercase tracking-wider mb-1.5">
                                    Telepon / Hotline Darurat 24 Jam
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                                    </div>
                                    <input type="text" wire:model.live="telepon_darurat" required
                                           placeholder="Contoh: 0812-3456-7890"
                                           class="w-full pl-9 pr-4 py-2.5 rounded-lg border border-slate-300 text-xs font-bold text-slate-800 focus:border-cyan-500 focus:ring-1 focus:ring-cyan-500 transition-all shadow-2xs font-mono">
                                </div>
                                @error('telepon_darurat') <p class="text-xs text-rose-600 mt-1">{{ $message }}</p> @enderror
                            </div>

                            <div>
                                <label class="block text-xs font-bold text-slate-600 uppercase tracking-wider mb-1.5">
                                    Alamat Email Resmi
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                                    </div>
                                    <input type="email" wire:model.live="email_organisasi" required
                                           placeholder="info@ambulansiaga.org"
                                           class="w-full pl-9 pr-4 py-2.5 rounded-lg border border-slate-300 text-xs font-semibold text-slate-800 focus:border-cyan-500 focus:ring-1 focus:ring-cyan-500 transition-all shadow-2xs">
                                </div>
                                @error('email_organisasi') <p class="text-xs text-rose-600 mt-1">{{ $message }}</p> @enderror
                            </div>
                        </div>

                        <!-- Alamat Kantor -->
                        <div>
                            <label class="block text-xs font-bold text-slate-600 uppercase tracking-wider mb-1.5">
                                Alamat Pusat Koordinasi / Sekretariat
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                </div>
                                <input type="text" wire:model.live="alamat_kantor" required
                                       placeholder="Alamat kantor lengkap"
                                       class="w-full pl-9 pr-4 py-2.5 rounded-lg border border-slate-300 text-xs font-medium text-slate-800 focus:border-cyan-500 focus:ring-1 focus:ring-cyan-500 transition-all shadow-2xs">
                            </div>
                            @error('alamat_kantor') <p class="text-xs text-rose-600 mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>
                </div>

                <!-- Section 2: Titik Koordinat Peta (Dengan Modal Popup Map Picker) -->
                <div class="bg-white rounded-xl border border-slate-200/80 shadow-xs overflow-hidden"
                     x-data="settingMapPicker()">
                    <div class="px-6 py-4 border-b border-slate-100 bg-slate-50/50 flex flex-col sm:flex-row sm:items-center justify-between gap-2.5">
                        <div>
                            <h2 class="text-sm font-bold text-slate-800">Koordinat Default Peta Operasional</h2>
                            <p class="text-xs text-slate-500 mt-0.5">Titik acuan tengah peta monitoring untuk wilayah Kabupaten Cilacap</p>
                        </div>
                        <div class="flex items-center gap-2 shrink-0">
                            <!-- Tombol Buka Modal Peta -->
                            <button type="button" @click="openPicker()"
                                    class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-bold text-white bg-cyan-600 hover:bg-cyan-700 transition-colors shadow-xs">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                <span>Pilih Titik di Peta</span>
                            </button>

                            <!-- Tombol Reset Default -->
                            <button type="button" wire:click="resetCilacapCoords"
                                    class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-[11px] font-bold text-slate-600 bg-white hover:bg-slate-100 border border-slate-200 transition-colors shadow-2xs">
                                <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
                                <span>Reset Titik Cilacap</span>
                            </button>
                        </div>
                    </div>

                    <div class="p-6 space-y-3">
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-bold text-slate-600 uppercase tracking-wider mb-1.5 flex items-center justify-between">
                                    <span>Default Latitude (Garis Lintang)</span>
                                    <span class="text-[10px] text-slate-400 font-normal">Otomatis dari peta</span>
                                </label>
                                <input type="text" wire:model.live="default_lat" required
                                       class="w-full px-3.5 py-2.5 rounded-lg border border-slate-300 text-xs font-mono font-semibold text-slate-800 focus:border-cyan-500 focus:ring-1 focus:ring-cyan-500 transition-all shadow-2xs">
                                @error('default_lat') <p class="text-xs text-rose-600 mt-1">{{ $message }}</p> @enderror
                            </div>

                            <div>
                                <label class="block text-xs font-bold text-slate-600 uppercase tracking-wider mb-1.5 flex items-center justify-between">
                                    <span>Default Longitude (Garis Bujur)</span>
                                    <span class="text-[10px] text-slate-400 font-normal">Otomatis dari peta</span>
                                </label>
                                <input type="text" wire:model.live="default_lng" required
                                       class="w-full px-3.5 py-2.5 rounded-lg border border-slate-300 text-xs font-mono font-semibold text-slate-800 focus:border-cyan-500 focus:ring-1 focus:ring-cyan-500 transition-all shadow-2xs">
                                @error('default_lng') <p class="text-xs text-rose-600 mt-1">{{ $message }}</p> @enderror
                            </div>
                        </div>

                        <div class="p-3 rounded-lg bg-slate-50 border border-slate-200/60 flex items-center justify-between text-xs text-slate-500">
                            <div class="flex items-center gap-2">
                                <span class="w-1.5 h-1.5 rounded-full bg-cyan-500"></span>
                                <span>Klik tombol <strong>"Pilih Titik di Peta"</strong> di atas untuk menentukan lokasi koordinat secara visual tanpa perlu memasukkan angka manual.</span>
                            </div>
                        </div>
                    </div>

                    <!-- MODAL POPUP MAP PICKER -->
                    <div x-show="showModal"
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0"
                         x-transition:enter-end="opacity-100"
                         x-transition:leave="transition ease-in duration-150"
                         x-transition:leave-start="opacity-100"
                         x-transition:leave-end="opacity-0"
                         class="fixed inset-0 z-50 bg-slate-900/60 backdrop-blur-xs flex items-center justify-center p-4 sm:p-6"
                         style="display: none;"
                         @keydown.escape.window="showModal = false">
                        
                        <div @click.outside="showModal = false"
                             x-transition:enter="transition ease-out duration-200"
                             x-transition:enter-start="opacity-0 scale-95"
                             x-transition:enter-end="opacity-100 scale-100"
                             class="bg-white rounded-2xl max-w-2xl w-full shadow-2xl border border-slate-200 overflow-hidden flex flex-col max-h-[90vh]">
                            
                            <!-- Header Modal -->
                            <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between bg-slate-50/80">
                                <div>
                                    <h3 class="text-sm font-bold text-slate-900 flex items-center gap-2">
                                        <span>Tentukan Titik Acuan Pusat Peta</span>
                                    </h3>
                                    <p class="text-xs text-slate-500 mt-0.5">Klik pada peta atau geser pin merah ke lokasi yang diinginkan</p>
                                </div>
                                <button type="button" @click="showModal = false"
                                        class="w-8 h-8 rounded-lg bg-white border border-slate-200 text-slate-400 hover:text-slate-600 hover:bg-slate-100 transition-colors flex items-center justify-center shadow-2xs">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                                </button>
                            </div>

                            <!-- Control Tools Bar -->
                            <div class="px-6 py-2.5 bg-slate-100/70 border-b border-slate-200/60 flex flex-wrap items-center justify-between gap-3 text-xs">
                                <div class="flex items-center gap-2">
                                    <button type="button" @click="detectMyLocation()"
                                            class="px-2.5 py-1.5 rounded-md bg-white hover:bg-slate-50 border border-slate-200 text-slate-700 text-[11px] font-semibold flex items-center gap-1.5 shadow-2xs transition-colors">
                                        <svg class="w-3.5 h-3.5 text-cyan-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-2.21 0-4 1.79-4 4s1.79 4 4 4 4-1.79 4-4-1.79-4-4-4zm8.94 3A8.994 8.994 0 0013 3.06V1h-2v2.06A8.994 8.994 0 003.06 11H1v2h2.06A8.994 8.994 0 0011 20.94V23h2v-2.06A8.994 8.994 0 0020.94 13H23v-2h-2.06z"/></svg>
                                        <span>Lokasi Saya (GPS)</span>
                                    </button>
                                    <button type="button" @click="centerCilacap()"
                                            class="px-2.5 py-1.5 rounded-md bg-white hover:bg-slate-50 border border-slate-200 text-slate-700 text-[11px] font-semibold flex items-center gap-1.5 shadow-2xs transition-colors">
                                        <span>Pusat Cilacap</span>
                                    </button>
                                </div>
                                <div class="text-[11px] font-mono text-slate-600 bg-white px-2.5 py-1 rounded border border-slate-200 shadow-2xs">
                                    Lat: <strong class="text-slate-800" x-text="tempLat"></strong> | Lng: <strong class="text-slate-800" x-text="tempLng"></strong>
                                </div>
                            </div>

                            <!-- Map Container -->
                            <div class="relative w-full h-[360px] bg-slate-100">
                                <div id="setting-modal-map" class="w-full h-full"></div>
                            </div>

                            <!-- Footer Modal -->
                            <div class="px-6 py-3.5 border-t border-slate-100 bg-slate-50/80 flex items-center justify-between">
                                <span class="text-[11px] text-slate-400">
                                    *Titik koordinat ini akan digunakan sebagai posisi awal peta monitoring
                                </span>
                                <div class="flex items-center gap-2">
                                    <button type="button" @click="showModal = false"
                                            class="px-4 py-2 rounded-lg border border-slate-200 bg-white hover:bg-slate-100 text-slate-600 text-xs font-semibold transition-colors">
                                        Batal
                                    </button>
                                    <button type="button" @click="applyCoordinates()"
                                            class="px-5 py-2 rounded-lg bg-cyan-600 hover:bg-cyan-700 text-white text-xs font-bold shadow-xs transition-colors flex items-center gap-1.5">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                        <span>Gunakan Titik Ini</span>
                                    </button>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <!-- Section 3: Tentang Platform -->
                <div class="bg-white rounded-xl border border-slate-200/80 shadow-xs overflow-hidden">
                    <div class="px-6 py-4 border-b border-slate-100 bg-slate-50/50">
                        <h2 class="text-sm font-bold text-slate-800">Deskripsi / Tentang Sistem</h2>
                        <p class="text-xs text-slate-500 mt-0.5">Penjelasan profil layanan yang ditampilkan pada portal informasi masyarakat</p>
                    </div>

                    <div class="p-6">
                        <textarea wire:model.live="tentang_gsc" rows="4"
                                  placeholder="Tuliskan deskripsi singkat profil layanan..."
                                  class="w-full px-3.5 py-2.5 rounded-lg border border-slate-300 text-xs font-medium text-slate-800 focus:border-cyan-500 focus:ring-1 focus:ring-cyan-500 transition-all shadow-2xs leading-relaxed"></textarea>
                        @error('tentang_gsc') <p class="text-xs text-rose-600 mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>

                <!-- Action Bar -->
                <div class="flex items-center justify-between pt-2">
                    <div class="text-xs text-slate-400">
                        *Perubahan kontak darurat akan langsung terupdate ke seluruh aplikasi
                    </div>
                    <button type="submit"
                            wire:loading.attr="disabled"
                            class="inline-flex items-center gap-2 px-6 py-2.5 rounded-lg bg-cyan-600 hover:bg-cyan-700 text-white font-bold text-xs shadow-md transition-all">
                        <span wire:loading.remove wire:target="saveSettings">Simpan Perubahan</span>
                        <span wire:loading wire:target="saveSettings">Menyimpan...</span>
                        <svg wire:loading.remove wire:target="saveSettings" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                    </button>
                </div>

            </form>
        </div>

        <!-- Kolom Kanan: Pratinjau Tampilan Publik (4 Kolom Simetris) -->
        <div class="lg:col-span-4 space-y-6">
            
            <!-- Card Mockup Live Preview -->
            <div class="bg-white rounded-xl border border-slate-200/80 shadow-xs overflow-hidden">
                <div class="px-5 py-3.5 border-b border-slate-100 bg-slate-50/50 flex items-center justify-between">
                    <span class="text-[11px] font-bold text-slate-500 uppercase tracking-wider">Pratinjau Publik</span>
                    <span class="inline-flex items-center gap-1.5 px-2 py-0.5 rounded-full text-[10px] font-bold bg-emerald-50 text-emerald-700">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> Live
                    </span>
                </div>

                <div class="p-5 space-y-4">
                    <!-- Organisasi Badge -->
                    <div class="flex items-center gap-3 pb-3 border-b border-slate-100">
                        <div class="w-10 h-10 rounded-lg bg-cyan-600 text-white flex items-center justify-center font-black text-sm shrink-0 shadow-xs">
                            AS
                        </div>
                        <div class="min-w-0">
                            <h3 class="text-xs font-bold text-slate-800 truncate">{{ $nama_organisasi ?: 'Nama Organisasi' }}</h3>
                            <p class="text-[11px] text-slate-400">Siaga 24 Jam • Cilacap</p>
                        </div>
                    </div>

                    <!-- Hotline Darurat Box -->
                    <div class="p-3.5 rounded-lg bg-rose-50/60 border border-rose-100 flex items-center justify-between gap-2">
                        <div>
                            <span class="text-[10px] font-bold text-rose-600 uppercase block tracking-wider">Hotline Darurat</span>
                            <span class="text-xs font-bold text-slate-900 font-mono block mt-0.5">
                                {{ $telepon_darurat ?: '-' }}
                            </span>
                        </div>
                        <div class="w-7 h-7 rounded-full bg-rose-600 text-white flex items-center justify-center shrink-0">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                        </div>
                    </div>

                    <!-- Info Kontak List -->
                    <div class="space-y-2.5 text-xs text-slate-600 pt-1">
                        <div class="flex items-start gap-2">
                            <svg class="w-3.5 h-3.5 text-slate-400 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                            <span class="text-[11px] text-slate-700 truncate">{{ $email_organisasi ?: 'email@ambulansiaga.org' }}</span>
                        </div>
                        <div class="flex items-start gap-2">
                            <svg class="w-3.5 h-3.5 text-slate-400 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            <span class="text-[11px] text-slate-600 leading-snug">{{ $alamat_kantor ?: 'Alamat kantor...' }}</span>
                        </div>
                    </div>

                    <!-- Mini Koordinat Card -->
                    <div class="p-3 rounded-lg bg-slate-50 border border-slate-200/80 text-[11px] space-y-1">
                        <div class="flex items-center justify-between text-slate-500 font-medium">
                            <span>Titik Acuan Peta</span>
                            <span class="font-bold text-slate-700">Cilacap</span>
                        </div>
                        <div class="font-mono text-slate-600 text-[10px]">
                            Lat: <strong class="text-slate-800">{{ $default_lat ?: '-7.7188' }}</strong> | 
                            Lng: <strong class="text-slate-800">{{ $default_lng ?: '109.0159' }}</strong>
                        </div>
                    </div>

                    <!-- Deskripsi Singkat -->
                    @if($tentang_gsc)
                        <div class="pt-2 border-t border-slate-100">
                            <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block mb-1">Kutipan Profil</span>
                            <p class="text-[11px] text-slate-600 line-clamp-3 leading-relaxed">
                                {{ $tentang_gsc }}
                            </p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Card Informasi Tambahan / Bantuan -->
            <div class="p-5 rounded-xl bg-slate-50/80 border border-slate-200/80 text-xs space-y-2">
                <div class="flex items-center gap-2 font-bold text-slate-800">
                    <svg class="w-4 h-4 text-cyan-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    <span>Petunjuk Konfigurasi</span>
                </div>
                <p class="text-[11px] text-slate-500 leading-relaxed">
                    Pastikan nomor hotline yang dimasukkan dapat menerima panggilan telepon langsung maupun WhatsApp untuk kelancaran respon evakuasi medis darurat.
                </p>
            </div>

        </div>

    </div>

    <!-- Map Picker Modal JavaScript Engine -->
    <script>
        function settingMapPicker() {
            return {
                showModal: false,
                tempLat: '-7.7188',
                tempLng: '109.0159',
                map: null,
                marker: null,

                openPicker() {
                    this.tempLat = (@this.default_lat || '-7.7188');
                    this.tempLng = (@this.default_lng || '109.0159');
                    this.showModal = true;

                    setTimeout(() => {
                        this.initMap();
                    }, 150);
                },

                initMap() {
                    const latNum = parseFloat(this.tempLat) || -7.7188;
                    const lngNum = parseFloat(this.tempLng) || 109.0159;

                    const container = document.getElementById('setting-modal-map');
                    if (!container) return;

                    if (!this.map) {
                        this.map = L.map('setting-modal-map', {
                            zoomControl: true
                        }).setView([latNum, lngNum], 14);

                        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                            attribution: '&copy; OpenStreetMap contributors',
                            maxZoom: 19
                        }).addTo(this.map);

                        this.marker = L.marker([latNum, lngNum], {
                            draggable: true
                        }).addTo(this.map);

                        this.marker.bindPopup('<div class="font-bold text-xs text-slate-800">Titik Acuan Peta</div><div class="text-[11px] text-slate-500">Klik peta atau geser pin ini</div>').openPopup();

                        this.map.on('click', (e) => {
                            this.setCoords(e.latlng.lat, e.latlng.lng);
                        });

                        this.marker.on('dragend', (e) => {
                            const pos = e.target.getLatLng();
                            this.setCoords(pos.lat, pos.lng);
                        });
                    } else {
                        this.map.setView([latNum, lngNum], 14);
                        this.marker.setLatLng([latNum, lngNum]);
                    }

                    setTimeout(() => {
                        if (this.map) {
                            this.map.invalidateSize();
                        }
                    }, 250);
                },

                setCoords(lat, lng) {
                    this.tempLat = parseFloat(lat).toFixed(6);
                    this.tempLng = parseFloat(lng).toFixed(6);
                    if (this.marker) {
                        this.marker.setLatLng([lat, lng]);
                    }
                },

                centerCilacap() {
                    this.setCoords(-7.7188, 109.0159);
                    if (this.map) {
                        this.map.flyTo([-7.7188, 109.0159], 14, { animate: true, duration: 0.8 });
                    }
                },

                detectMyLocation() {
                    if (navigator.geolocation) {
                        navigator.geolocation.getCurrentPosition((pos) => {
                            const lat = pos.coords.latitude;
                            const lng = pos.coords.longitude;
                            this.setCoords(lat, lng);
                            if (this.map) {
                                this.map.flyTo([lat, lng], 15, { animate: true, duration: 1 });
                            }
                        }, (err) => {
                            alert('Gagal mendeteksi lokasi GPS: ' + err.message);
                        });
                    } else {
                        alert('Browser Anda tidak mendukung fitur deteksi geolokasi.');
                    }
                },

                applyCoordinates() {
                    @this.call('updateCoordinates', this.tempLat, this.tempLng);
                    this.showModal = false;
                }
            }
        }
    </script>
</div>
