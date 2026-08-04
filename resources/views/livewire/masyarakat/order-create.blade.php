<div>
    <!-- Header Page -->
    <div class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <span class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-full text-xs font-bold bg-sky-100 text-sky-700 uppercase tracking-wider mb-2">
                <span class="w-2 h-2 rounded-full bg-sky-600 animate-ping"></span>
                Siaga Darurat 24 Jam • Ambulance Siaga
            </span>
            <h1 class="text-2xl sm:text-3xl font-extrabold text-slate-800 tracking-tight">Pesan Ambulans Darurat</h1>
            <p class="text-slate-500 text-sm mt-1">Lengkapi form atau klik langsung pada Peta Interaktif di sebelah kanan untuk menentukan lokasi penjemputan.</p>
        </div>

        <a href="{{ route('masyarakat.info') }}"
           class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-white border border-slate-300 text-slate-700 text-sm font-semibold hover:bg-sky-50 hover:text-sky-600 transition-colors shadow-xs">
            <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <span>Panduan Ambulance Siaga</span>
        </a>
    </div>

    <!-- Main Grid: Form (Left) & Leaflet Map (Right) -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8"
         x-data="orderMapComponent({{ $jemput_lat }}, {{ $jemput_lng }})"
         x-init="initMap()">

        <!-- Left Column: Form Pemesanan -->
        <div class="lg:col-span-7 bg-white rounded-3xl border border-slate-200/80 p-6 sm:p-8 shadow-xs">
            <form wire:submit="submitOrder" class="space-y-6">

                <!-- BAGIAN 1: DATA PASIEN & KONTAK -->
                <div class="space-y-4">
                    <div class="flex items-center gap-2.5 pb-3 border-b border-slate-100">
                        <span class="w-6 h-6 rounded-lg bg-sky-50 text-sky-600 flex items-center justify-center font-black text-xs">1</span>
                        <h3 class="text-xs font-black uppercase tracking-wider text-slate-800">DATA PASIEN & KONTAK PENDAMPING</h3>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <!-- Nama Pasien -->
                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1.5">
                                Nama Pasien <span class="text-red-500">*</span>
                            </label>
                            <input type="text" wire:model="nama_pasien"
                                   placeholder="Contoh: Bpk. Hartono / Ibu Halimah"
                                   class="w-full px-4 py-2.5 rounded-xl border border-slate-200 bg-slate-50/50 focus:bg-white focus:border-sky-500 focus:ring-4 focus:ring-sky-500/10 text-sm font-medium transition-all">
                            @error('nama_pasien') <p class="text-xs text-red-600 font-medium mt-1">{{ $message }}</p> @enderror
                        </div>

                        <!-- NIK Pasien -->
                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1.5">
                                NIK Pasien <span class="text-red-500">*</span>
                            </label>
                            <input type="text" wire:model="nik_pasien"
                                   placeholder="16 Digit NIK KTP"
                                   class="w-full px-4 py-2.5 rounded-xl border border-slate-200 bg-slate-50/50 focus:bg-white focus:border-sky-500 focus:ring-4 focus:ring-sky-500/10 text-sm font-medium transition-all">
                            @error('nik_pasien') <p class="text-xs text-red-600 font-medium mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                        <!-- Usia Pasien -->
                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1.5">
                                Usia <span class="text-red-500">*</span>
                            </label>
                            <input type="text" wire:model="usia_pasien"
                                   placeholder="Contoh: 65 Tahun"
                                   class="w-full px-4 py-2.5 rounded-xl border border-slate-200 bg-slate-50/50 focus:bg-white focus:border-sky-500 focus:ring-4 focus:ring-sky-500/10 text-sm font-medium transition-all">
                            @error('usia_pasien') <p class="text-xs text-red-600 font-medium mt-1">{{ $message }}</p> @enderror
                        </div>

                        <!-- No HP Pasien / Pendamping -->
                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1.5">
                                No. HP Kontak <span class="text-red-500">*</span>
                            </label>
                            <input type="text" wire:model="no_hp_kontak"
                                   placeholder="081xxx (Aktif WA)"
                                   class="w-full px-4 py-2.5 rounded-xl border border-slate-200 bg-slate-50/50 focus:bg-white focus:border-sky-500 focus:ring-4 focus:ring-sky-500/10 text-sm font-medium transition-all">
                            @error('no_hp_kontak') <p class="text-xs text-red-600 font-medium mt-1">{{ $message }}</p> @enderror
                        </div>

                        <!-- Jumlah Pendamping -->
                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1.5">
                                Jml. Pendamping <span class="text-red-500">*</span>
                            </label>
                            <input type="number" wire:model="jumlah_pendamping" min="0" max="10"
                                   class="w-full px-4 py-2.5 rounded-xl border border-slate-200 bg-slate-50/50 focus:bg-white focus:border-sky-500 focus:ring-4 focus:ring-sky-500/10 text-sm font-medium transition-all">
                            @error('jumlah_pendamping') <p class="text-xs text-red-600 font-medium mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>
                </div>

                <!-- BAGIAN 2: MEDIS & KEPERLUAN -->
                <div class="space-y-4 pt-2">
                    <div class="flex items-center gap-2.5 pb-3 border-b border-slate-100">
                        <span class="w-6 h-6 rounded-lg bg-sky-50 text-sky-600 flex items-center justify-center font-black text-xs">2</span>
                        <h3 class="text-xs font-black uppercase tracking-wider text-slate-800">KONDISI & KEPERLUAN AMBULANS</h3>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <!-- Keperluan Penggunaan Ambulance -->
                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1.5">
                                Keperluan Penggunaan <span class="text-red-500">*</span>
                            </label>
                            <select wire:model="keperluan_penggunaan"
                                    class="w-full px-4 py-2.5 rounded-xl border border-slate-200 bg-slate-50/50 focus:bg-white focus:border-sky-500 focus:ring-4 focus:ring-sky-500/10 text-sm font-medium transition-all">
                                <option value="IGD Darurat">IGD Darurat</option>
                                <option value="Kontrol Rutin">Kontrol Rutin</option>
                                <option value="Pulang Rawat Inap">Pulang Rawat Inap</option>
                                <option value="Lainnya">Lainnya</option>
                            </select>
                            @error('keperluan_penggunaan') <p class="text-xs text-red-600 font-medium mt-1">{{ $message }}</p> @enderror
                        </div>

                        <!-- Diagnosa Medis -->
                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1.5">
                                Diagnosa Medis (Opsional)
                            </label>
                            <input type="text" wire:model="diagnosa_medis"
                                   placeholder="Contoh: Sesak Napas / Hipertensi / Pasca Op"
                                   class="w-full px-4 py-2.5 rounded-xl border border-slate-200 bg-slate-50/50 focus:bg-white focus:border-sky-500 focus:ring-4 focus:ring-sky-500/10 text-sm font-medium transition-all">
                            @error('diagnosa_medis') <p class="text-xs text-red-600 font-medium mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <!-- Kondisi Pasien / Situasi Darurat -->
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1.5">
                            Kondisi Pasien & Situasi Terkini <span class="text-red-500">*</span>
                        </label>
                        <textarea wire:model="kondisi_pasien" rows="2"
                                  placeholder="Jelaskan kondisi pasien secara singkat (butuh tabung oksigen, tandu lipat, kursi roda, dll)..."
                                  class="w-full px-4 py-2.5 rounded-xl border border-slate-200 bg-slate-50/50 focus:bg-white focus:border-sky-500 focus:ring-4 focus:ring-sky-500/10 text-sm font-medium transition-all"></textarea>
                        @error('kondisi_pasien') <p class="text-xs text-red-600 font-medium mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>

                <!-- BAGIAN 3: JADWAL & LOKASI -->
                <div class="space-y-4 pt-2">
                    <div class="flex items-center gap-2.5 pb-3 border-b border-slate-100">
                        <span class="w-6 h-6 rounded-lg bg-sky-50 text-sky-600 flex items-center justify-center font-black text-xs">3</span>
                        <h3 class="text-xs font-black uppercase tracking-wider text-slate-800">JADWAL & ALAMAT PENJEMPUTAN / PENGANTARAN</h3>
                    </div>

                    <!-- Hari & Tanggal Jemput, Jam Penjemputan -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1.5">
                                Hari & Tanggal Jemput <span class="text-red-500">*</span>
                            </label>
                            <input type="date" wire:model="tanggal_jemput"
                                   class="w-full px-4 py-2.5 rounded-xl border border-slate-200 bg-slate-50/50 focus:bg-white focus:border-sky-500 focus:ring-4 focus:ring-sky-500/10 text-sm font-medium transition-all">
                            @error('tanggal_jemput') <p class="text-xs text-red-600 font-medium mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1.5">
                                Jam Penjemputan <span class="text-red-500">*</span>
                            </label>
                            <input type="time" wire:model="jam_jemput"
                                   class="w-full px-4 py-2.5 rounded-xl border border-slate-200 bg-slate-50/50 focus:bg-white focus:border-sky-500 focus:ring-4 focus:ring-sky-500/10 text-sm font-medium transition-all">
                            @error('jam_jemput') <p class="text-xs text-red-600 font-medium mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <!-- Alamat lengkap Penjemputan -->
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1.5">
                            Alamat Lengkap Penjemputan <span class="text-red-500">*</span>
                        </label>
                        <input type="text" wire:model="lokasi_jemput"
                               placeholder="Contoh: Jl. Gatot Subroto No. 45, Sidanegara (depan gerbang merah)"
                               class="w-full px-4 py-2.5 rounded-xl border border-slate-200 bg-slate-50/50 focus:bg-white focus:border-sky-500 focus:ring-4 focus:ring-sky-500/10 text-sm font-medium transition-all">
                        @error('lokasi_jemput') <p class="text-xs text-red-600 font-medium mt-1">{{ $message }}</p> @enderror
                    </div>

                    <!-- Koordinat GPS -->
                    <div class="grid grid-cols-2 gap-3 p-3 rounded-xl bg-slate-50 border border-slate-200/80 text-xs">
                        <div>
                            <span class="text-slate-400 block font-semibold text-[10px]">LATITUDE (TITIK PENJEMPUTAN)</span>
                            <span class="font-bold text-slate-800" x-text="lat.toFixed(6)"></span>
                        </div>
                        <div>
                            <span class="text-slate-400 block font-semibold text-[10px]">LONGITUDE (TITIK PENJEMPUTAN)</span>
                            <span class="font-bold text-slate-800" x-text="lng.toFixed(6)"></span>
                        </div>
                    </div>

                    <!-- RS Rujukan Mitra -->
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1.5">
                            Pilih RS Mitra / Rujukan Cepat (Opsional)
                        </label>
                        <select wire:model.live="rumah_sakit_id"
                                @change="updateHospitalMarker($event.target.value)"
                                class="w-full px-4 py-2.5 rounded-xl border border-slate-200 bg-slate-50/50 focus:bg-white focus:border-sky-500 focus:ring-4 focus:ring-sky-500/10 text-sm font-medium transition-all">
                            <option value="">-- Pilih RS Mitra (Atau Isi Alamat Antar Secara Manual) --</option>
                            @foreach($rumahSakits as $rs)
                                <option value="{{ $rs->id }}" data-lat="{{ $rs->lat }}" data-lng="{{ $rs->lng }}" data-nama="{{ $rs->nama }}">
                                    {{ $rs->nama }} - {{ $rs->kapasitas_igd }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Alamat Antar / Tujuan -->
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1.5">
                            Alamat Antar / Tujuan <span class="text-red-500">*</span>
                        </label>
                        <input type="text" wire:model="tujuan_lokasi"
                               placeholder="Contoh: RSUD Cilacap / Alamat Rumah Pulang Rawat Inap..."
                               class="w-full px-4 py-2.5 rounded-xl border border-slate-200 bg-slate-50/50 focus:bg-white focus:border-sky-500 focus:ring-4 focus:ring-sky-500/10 text-sm font-medium transition-all">
                        @error('tujuan_lokasi') <p class="text-xs text-red-600 font-medium mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>

                <!-- Catatan Tambahan -->
                <div class="pt-2">
                    <label class="block text-xs font-bold text-slate-700 mb-1.5">
                        Catatan Tambahan untuk Supir
                    </label>
                    <input type="text" wire:model="catatan_tambahan"
                           placeholder="Contoh: Bawa kursi roda / gerbang rumah samping masjid"
                           class="w-full px-4 py-2.5 rounded-xl border border-slate-200 bg-slate-50/50 focus:bg-white focus:border-sky-500 focus:ring-4 focus:ring-sky-500/10 text-sm font-medium transition-all">
                </div>

                <!-- Submit Button -->
                <div class="pt-4 border-t border-slate-100">
                    <button type="submit"
                            wire:loading.attr="disabled"
                            class="w-full py-4 rounded-2xl bg-sky-600 hover:bg-sky-700 text-white font-extrabold text-sm sm:text-base shadow-lg shadow-sky-600/30 flex items-center justify-center gap-3 transition-all">
                        <span wire:loading.remove>KIRIM PESANAN DARURAT SEKARANG</span>
                        <span wire:loading class="flex items-center gap-2">
                            <svg class="w-5 h-5 animate-spin" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path>
                            </svg>
                            MENGIRIM KE DISPATCHER...
                        </span>
                    </button>
                    <p class="text-center text-xs text-slate-400 mt-2.5 font-medium">
                        Pesanan langsung terhubung ke Pusat Kendali & Jaringan Armada Mitra Ambulance Siaga.
                    </p>
                </div>

            </form>
        </div>

        <!-- Right Column: Leaflet Map (Sticky on Desktop) -->
        <div class="lg:col-span-5 flex flex-col lg:sticky lg:top-24 self-start">
            <div class="bg-white rounded-3xl border border-slate-200/80 p-5 shadow-xs flex-1 flex flex-col min-h-[500px]">
                <div class="flex items-center justify-between mb-4">
                    <div>
                        <h2 class="font-bold text-slate-800 text-sm sm:text-base flex items-center gap-2">
                            <span class="w-2.5 h-2.5 rounded-full bg-sky-600"></span>
                            <span>Peta Penentuan Titik Jemput (Cilacap)</span>
                        </h2>
                        <p class="text-xs text-slate-500 mt-0.5">Klik di mana saja pada peta untuk mengatur koordinat penjemputan.</p>
                    </div>
                    <button type="button" @click="resetToDefault()"
                            class="px-3 py-1.5 rounded-xl text-xs font-semibold bg-slate-100 hover:bg-slate-200 text-slate-700 transition-colors flex-shrink-0">
                        Pusat Cilacap
                    </button>
                </div>

                <!-- Leaflet Container -->
                <div id="booking-map" class="w-full h-full min-h-[460px] rounded-2xl border border-slate-200/80 z-10"></div>
            </div>
        </div>

    </div>

    <!-- Alpine Script for Leaflet Integration -->
    <script>
        function orderMapComponent(defaultLat, defaultLng) {
            return {
                map: null,
                marker: null,
                hospitalMarker: null,
                lat: defaultLat,
                lng: defaultLng,

                initMap() {
                    // Initialize Leaflet
                    this.map = L.map('booking-map').setView([this.lat, this.lng], 14);

                    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                        attribution: '&copy; OpenStreetMap contributors',
                        maxZoom: 19
                    }).addTo(this.map);

                    // Create Draggable Marker
                    this.marker = L.marker([this.lat, this.lng], {
                        draggable: true
                    }).addTo(this.map)
                    .bindPopup('<b>Titik Penjemputan Pasien</b><br>Geser atau klik peta untuk ubah')
                    .openPopup();

                    // Map Click Listener
                    this.map.on('click', (e) => {
                        this.setMarkerPosition(e.latlng.lat, e.latlng.lng);
                    });

                    // Marker Drag End Listener
                    this.marker.on('dragend', (e) => {
                        const pos = e.target.getLatLng();
                        this.setMarkerPosition(pos.lat, pos.lng);
                    });

                    setTimeout(() => {
                        this.map.invalidateSize();
                    }, 300);
                },

                setMarkerPosition(newLat, newLng) {
                    this.lat = newLat;
                    this.lng = newLng;
                    this.marker.setLatLng([newLat, newLng]);
                    this.map.panTo([newLat, newLng]);

                    // Update Livewire State
                    @this.set('jemput_lat', newLat);
                    @this.set('jemput_lng', newLng);
                },

                resetToDefault() {
                    this.setMarkerPosition(-7.7188, 109.0159);
                },

                updateHospitalMarker(rsId) {
                    if (this.hospitalMarker) {
                        this.map.removeLayer(this.hospitalMarker);
                        this.hospitalMarker = null;
                    }

                    if (!rsId) return;

                    const selectEl = document.querySelector('select[wire\\:model="rumah_sakit_id"]');
                    const selectedOpt = selectEl.options[selectEl.selectedIndex];

                    const rsLat = parseFloat(selectedOpt.getAttribute('data-lat'));
                    const rsLng = parseFloat(selectedOpt.getAttribute('data-lng'));
                    const rsNama = selectedOpt.getAttribute('data-nama');

                    if (rsLat && rsLng) {
                        this.hospitalMarker = L.marker([rsLat, rsLng], {
                            title: rsNama
                        }).addTo(this.map)
                        .bindPopup(`<b>Rumah Sakit Rujukan:</b><br>${rsNama}`)
                        .openPopup();

                        // Fit bounds between pickup and hospital
                        const bounds = L.latLngBounds([ [this.lat, this.lng], [rsLat, rsLng] ]);
                        this.map.fitBounds(bounds, { padding: [50, 50] });
                    }
                }
            }
        }
    </script>
</div>
