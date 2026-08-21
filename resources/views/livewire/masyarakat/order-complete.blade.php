<div>

    
    <div class="absolute top-0 left-0 w-full h-80 bg-gradient-to-br from-primary-600 to-primary-700 -z-10">
        <!-- Decorative Pattern -->
        <div class="absolute inset-0 opacity-10" style="background-image: radial-gradient(circle at 2px 2px, white 1px, transparent 0); background-size: 32px 32px;"></div>
    </div>
    
    <main class="pt-32 pb-24 px-6 lg:px-12 max-w-4xl mx-auto min-h-screen">
        <div class="relative z-10">
            <!-- Top Bar Banner -->
            <div class="mb-8 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 text-white">
        <div class="flex items-center gap-4">
            <div class="w-14 h-14 rounded-full bg-white p-1.5 flex items-center justify-center shadow-md flex-shrink-0">
                <img src="{{ asset('images/logo_ambulansiaga.png') }}" alt="Logo Ambulans Siaga" class="w-full h-full object-contain">
            </div>
            <div>
                <div class="flex items-center gap-2 mb-1">
                    <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-[10px] font-extrabold bg-white/20 text-white uppercase tracking-wider">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse"></span>
                        Pesanan #{{ $order->kode_order }}
                    </span>
                    <span class="text-xs font-medium text-primary-100">
                        Status: <strong class="text-white underline">{{ $order->status_label }}</strong>
                    </span>
                </div>
                <h1 class="text-xl sm:text-2xl font-extrabold tracking-tight">Lengkapi Formulir Kebutuhan Ambulans</h1>
            </div>
        </div>
        <a href="{{ route('masyarakat.tracking', $order->id) }}"
           class="inline-flex items-center justify-center gap-2 px-4 py-2 rounded-xl bg-white/10 hover:bg-white/20 text-white text-xs font-bold transition-all border border-white/20 flex-shrink-0">
            <span>Lewati ke Tracking &rarr;</span>
        </a>
    </div>

    <!-- Alert Sukses / Info -->
    @if(session('success'))
        <div class="mb-6 p-4 rounded-2xl bg-emerald-50 border border-emerald-200 text-emerald-800 flex items-center gap-3 shadow-sm">
            <svg class="w-6 h-6 text-emerald-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
            </svg>
            <span class="text-sm font-bold">{{ session('success') }}</span>
        </div>
    @endif

    <!-- Main Structured Form -->
    <form wire:submit="saveCompleteOrder" class="space-y-6">

        <!-- CARD 1: DATA PASIEN & KONTAK PENDAMPING -->
        <div class="bg-white rounded-3xl border border-slate-200/80 shadow-xs overflow-hidden">
            <div class="px-6 py-4 bg-slate-50/80 border-b border-slate-100 flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <span class="w-7 h-7 rounded-xl bg-primary-600 text-white font-extrabold text-xs flex items-center justify-center shadow-sm">1</span>
                    <h2 class="text-sm font-extrabold text-slate-800 uppercase tracking-wider">DATA PASIEN & KONTAK PENDAMPING</h2>
                </div>
                <span class="text-[11px] font-bold text-slate-400 uppercase">Wajib Diisi</span>
            </div>

            <div class="p-6 space-y-4">
                <!-- Baris 1: Nama Pasien & NIK -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                            Nama Pasien <span class="text-red-500">*</span>
                        </label>
                        <input type="text" wire:model="nama_pasien"
                               placeholder="Contoh: Rifka / Bpk. Hartono"
                               class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 bg-white focus:border-primary-500 focus:ring-4 focus:ring-primary-500/15 text-sm font-semibold text-slate-800 transition-all shadow-2xs">
                        @error('nama_pasien') <p class="text-xs text-red-600 font-medium mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                            NIK Pasien <span class="text-red-500">*</span>
                        </label>
                        <input type="text" wire:model="nik_pasien"
                               placeholder="16 digit NIK sesuai KTP"
                               class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 bg-white focus:border-primary-500 focus:ring-4 focus:ring-primary-500/15 text-sm font-semibold text-slate-800 transition-all shadow-2xs">
                        @error('nik_pasien') <p class="text-xs text-red-600 font-medium mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>

                <!-- Baris 2: Usia (25%), No HP (50%), Jml Pendamping (25%) -->
                <div class="grid grid-cols-1 sm:grid-cols-12 gap-4">
                    <div class="sm:col-span-3">
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                            Usia <span class="text-red-500">*</span>
                        </label>
                        <input type="text" wire:model="usia_pasien"
                               placeholder="Contoh: 20 thn"
                               class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 bg-white focus:border-primary-500 focus:ring-4 focus:ring-primary-500/15 text-sm font-semibold text-slate-800 transition-all shadow-2xs">
                        @error('usia_pasien') <p class="text-xs text-red-600 font-medium mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="sm:col-span-6">
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                            No. HP Kontak <span class="text-red-500">*</span>
                        </label>
                        <input type="text" wire:model="no_hp_kontak"
                               placeholder="Contoh: 089535801008"
                               class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 bg-white focus:border-primary-500 focus:ring-4 focus:ring-primary-500/15 text-sm font-semibold text-slate-800 transition-all shadow-2xs">
                        @error('no_hp_kontak') <p class="text-xs text-red-600 font-medium mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="sm:col-span-3">
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                            Jml. Pendamping <span class="text-red-500">*</span>
                        </label>
                        <input type="number" wire:model="jumlah_pendamping" min="1" max="10"
                               placeholder="1"
                               class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 bg-white focus:border-primary-500 focus:ring-4 focus:ring-primary-500/15 text-sm font-semibold text-slate-800 transition-all shadow-2xs">
                        @error('jumlah_pendamping') <p class="text-xs text-red-600 font-medium mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>
            </div>
        </div>

        <!-- CARD 2: KONDISI & KEPERLUAN AMBULANS -->
        <div class="bg-white rounded-3xl border border-slate-200/80 shadow-xs overflow-hidden">
            <div class="px-6 py-4 bg-slate-50/80 border-b border-slate-100 flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <span class="w-7 h-7 rounded-xl bg-primary-600 text-white font-extrabold text-xs flex items-center justify-center shadow-sm">2</span>
                    <h2 class="text-sm font-extrabold text-slate-800 uppercase tracking-wider">KONDISI & KEPERLUAN AMBULANS</h2>
                </div>
                <span class="text-[11px] font-bold text-slate-400 uppercase">Medis</span>
            </div>

            <div class="p-6 space-y-4">
                <!-- Baris 1: Keperluan (5 col) & Diagnosa (7 col) -->
                <div class="grid grid-cols-1 sm:grid-cols-12 gap-4">
                    <div class="sm:col-span-5">
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                            Keperluan Penggunaan <span class="text-red-500">*</span>
                        </label>
                        <select wire:model.live="keperluan_penggunaan"
                                class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 bg-white focus:border-primary-500 focus:ring-4 focus:ring-primary-500/15 text-sm font-semibold text-slate-800 transition-all shadow-2xs">
                            <option value="Kontrol Rutin">Kontrol Rutin</option>
                            <option value="IGD">IGD</option>
                            <option value="Pulang Rawat Inap">Pulang Rawat Inap</option>
                            <option value="Lainnya">Lainnya</option>
                        </select>
                        @error('keperluan_penggunaan') <p class="text-xs text-red-600 font-medium mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="sm:col-span-7">
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                            Diagnosa Medis <span class="text-slate-400 normal-case font-medium">(Opsional)</span>
                        </label>
                        <input type="text" wire:model="diagnosa_medis"
                               placeholder="Contoh: Kontrol gigi / Demam tinggi / Patah tulang"
                               class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 bg-white focus:border-primary-500 focus:ring-4 focus:ring-primary-500/15 text-sm font-semibold text-slate-800 transition-all shadow-2xs">
                    </div>
                </div>

                <!-- Jika memilih Lainnya -->
                @if($keperluan_penggunaan === 'Lainnya')
                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                            Sebutkan Keperluan Lainnya <span class="text-red-500">*</span>
                        </label>
                        <input type="text" wire:model="keperluan_lainnya"
                               placeholder="Contoh: Antar jenazah / Kegiatan medis sosial..."
                               class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 bg-white focus:border-primary-500 focus:ring-4 focus:ring-primary-500/15 text-sm font-semibold text-slate-800 transition-all shadow-2xs">
                    </div>
                @endif

                <!-- Kondisi Pasien & Situasi Terkini -->
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                        Kondisi Pasien & Situasi Terkini <span class="text-red-500">*</span>
                    </label>
                    <textarea wire:model="kondisi_pasien" rows="2"
                              placeholder="Contoh: Sadar penuh / stabil / sesak nafas butuh oksigen"
                              class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 bg-white focus:border-primary-500 focus:ring-4 focus:ring-primary-500/15 text-sm font-semibold text-slate-800 transition-all shadow-2xs"></textarea>
                    @error('kondisi_pasien') <p class="text-xs text-red-600 font-medium mt-1">{{ $message }}</p> @enderror
                </div>
            </div>
        </div>

        <!-- CARD 3: JADWAL & ALAMAT PENJEMPUTAN / PENGANTARAN -->
        <div class="bg-white rounded-3xl border border-slate-200/80 shadow-xs overflow-hidden">
            <div class="px-6 py-4 bg-slate-50/80 border-b border-slate-100 flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <span class="w-7 h-7 rounded-xl bg-primary-600 text-white font-extrabold text-xs flex items-center justify-center shadow-sm">3</span>
                    <h2 class="text-sm font-extrabold text-slate-800 uppercase tracking-wider">JADWAL & ALAMAT PENJEMPUTAN / PENGANTARAN</h2>
                </div>
                <span class="text-[11px] font-bold text-slate-400 uppercase">Lokasi</span>
            </div>

            <div class="p-6 space-y-4">
                <!-- Baris 1: Hari & Tanggal Jemput, Jam Penjemputan -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                            Hari & Tanggal Jemput <span class="text-red-500">*</span>
                        </label>
                        <input type="date" wire:model="tanggal_jemput"
                               class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 bg-white focus:border-primary-500 focus:ring-4 focus:ring-primary-500/15 text-sm font-semibold text-slate-800 transition-all shadow-2xs">
                        @error('tanggal_jemput') <p class="text-xs text-red-600 font-medium mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                            Jam Penjemputan <span class="text-red-500">*</span>
                        </label>
                        <input type="time" wire:model="jam_jemput"
                               class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 bg-white focus:border-primary-500 focus:ring-4 focus:ring-primary-500/15 text-sm font-semibold text-slate-800 transition-all shadow-2xs">
                        @error('jam_jemput') <p class="text-xs text-red-600 font-medium mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>

                <!-- Alamat Lengkap Penjemputan -->
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                        Alamat Lengkap Penjemputan <span class="text-red-500">*</span>
                    </label>
                    <input type="text" wire:model="lokasi_jemput"
                           placeholder="Contoh: Jl. Gatot Subroto No. 45, Kabupaten Cilacap"
                           class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 bg-white focus:border-primary-500 focus:ring-4 focus:ring-primary-500/15 text-sm font-semibold text-slate-800 transition-all shadow-2xs">
                    @error('lokasi_jemput') <p class="text-xs text-red-600 font-medium mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- Koordinat GPS Badge -->
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2 p-3.5 rounded-2xl bg-primary-50/70 border border-primary-100 text-xs">
                    <div class="flex items-center gap-2.5">
                        <div class="w-8 h-8 rounded-xl bg-primary-600 text-white flex items-center justify-center flex-shrink-0 shadow-sm">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                        </div>
                        <div>
                            <span class="text-[11px] font-extrabold text-primary-900 block uppercase tracking-wide">TITIK KOORDINAT PENJEMPUTAN (GPS)</span>
                            <span class="text-xs font-medium text-primary-700">Terkunci otomatis dari titik lokasi darurat Anda</span>
                        </div>
                    </div>
                    <div class="flex items-center gap-3 font-mono font-bold text-slate-800 bg-white px-3.5 py-1.5 rounded-xl border border-primary-200/80 shadow-2xs self-start sm:self-auto">
                        <span>LAT: {{ number_format($jemput_lat, 6, '.', '') }}</span>
                        <span class="text-slate-300">|</span>
                        <span>LNG: {{ number_format($jemput_lng, 6, '.', '') }}</span>
                    </div>
                </div>

                <!-- Pilih RS Mitra / Rujukan Cepat (Opsional) -->
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                        Pilih RS Mitra / Rujukan Cepat <span class="text-slate-400 normal-case font-medium">(Opsional)</span>
                    </label>
                    <select wire:model.live="rumah_sakit_id"
                            class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 bg-white focus:border-primary-500 focus:ring-4 focus:ring-primary-500/15 text-sm font-semibold text-slate-800 transition-all shadow-2xs">
                        <option value="">-- Pilih RS Mitra (Atau Biarkan Operator Menentukan) --</option>
                        @foreach($rumahSakits as $rs)
                            <option value="{{ $rs->id }}">
                                {{ $rs->nama }} - {{ $rs->kapasitas_igd }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Alamat Antar / Tujuan -->
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                        Alamat Antar / Tujuan <span class="text-red-500">*</span>
                    </label>
                    <input type="text" wire:model="tujuan_lokasi"
                           placeholder="Contoh: RS Pertamina Cilacap - Jl. Setia Budi No.1..."
                           class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 bg-white focus:border-primary-500 focus:ring-4 focus:ring-primary-500/15 text-sm font-semibold text-slate-800 transition-all shadow-2xs">
                    @error('tujuan_lokasi') <p class="text-xs text-red-600 font-medium mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- Catatan Tambahan untuk Supir -->
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                        Catatan Tambahan untuk Supir
                    </label>
                    <input type="text" wire:model="catatan_tambahan"
                           placeholder="Contoh: Bawa kursi roda / gerbang samping masjid"
                           class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 bg-white focus:border-primary-500 focus:ring-4 focus:ring-primary-500/15 text-sm font-semibold text-slate-800 transition-all shadow-2xs">
                </div>
            </div>
        </div>

        <!-- ACTION BUTTON CARD -->
        <div class="bg-white rounded-3xl border border-slate-200/80 p-6 shadow-xs text-center">
            <button type="submit"
                    wire:loading.attr="disabled"
                    class="w-full py-4 px-6 rounded-2xl bg-primary-600 hover:bg-primary-700 text-white font-extrabold text-base shadow-lg shadow-primary-600/30 flex items-center justify-center gap-3 transition-all transform active:scale-[0.99]">
                <span wire:loading.remove>SIMPAN & LENGKAPI DATA PESANAN</span>
                <span wire:loading class="flex items-center gap-2">
                    <svg class="w-5 h-5 animate-spin" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path>
                    </svg>
                    MENYIMPAN DATA PASIEN...
                </span>
            </button>
            <p class="text-xs text-slate-400 font-semibold mt-3">
                Pesanan langsung terhubung ke Pusat Kendali & Jaringan Armada Mitra Ambulans Siaga.
            </p>
        </div>

    </form>
        </div>
    </main>
    
    <x-landing-footer />
</div>
