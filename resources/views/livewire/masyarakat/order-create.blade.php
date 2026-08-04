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
        <div class="lg:col-span-6 bg-white rounded-3xl border border-slate-200/80 p-6 sm:p-8 shadow-xs">
            <form wire:submit="submitOrder" class="space-y-6">

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

                <!-- Kondisi Pasien / Situasi Darurat -->
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1.5">
                        Kondisi Pasien / Situasi Darurat <span class="text-red-500">*</span>
                    </label>
                    <textarea wire:model="kondisi_pasien" rows="3"
                              placeholder="Contoh: Sesak nafas berat, butuh bantuan tabung oksigen dan evakuasi segera ke IGD..."
                              class="w-full px-4 py-2.5 rounded-xl border border-slate-200 bg-slate-50/50 focus:bg-white focus:border-sky-500 focus:ring-4 focus:ring-sky-500/10 text-sm font-medium transition-all"></textarea>
                    @error('kondisi_pasien') <p class="text-xs text-red-600 font-medium mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- Alamat / Patokan Penjemputan -->
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1.5">
                        Alamat / Patokan Penjemputan <span class="text-red-500">*</span>
                    </label>
                    <input type="text" wire:model="lokasi_jemput"
                           placeholder="Contoh: Jl. Gatot Subroto No. 45 (Depan Gerbang Merah / Samping Masjid)"
                           class="w-full px-4 py-2.5 rounded-xl border border-slate-200 bg-slate-50/50 focus:bg-white focus:border-sky-500 focus:ring-4 focus:ring-sky-500/10 text-sm font-medium transition-all">
                    @error('lokasi_jemput') <p class="text-xs text-red-600 font-medium mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- Koordinat GPS -->
                <div class="grid grid-cols-2 gap-3 p-3.5 rounded-xl bg-slate-50 border border-slate-200/80 text-xs">
                    <div>
                        <span class="text-slate-400 block font-semibold text-[10px] tracking-wider uppercase">LATITUDE</span>
                        <span class="font-bold text-slate-800 text-sm" x-text="lat.toFixed(6)"></span>
                    </div>
                    <div>
                        <span class="text-slate-400 block font-semibold text-[10px] tracking-wider uppercase">LONGITUDE</span>
                        <span class="font-bold text-slate-800 text-sm" x-text="lng.toFixed(6)"></span>
                    </div>
                </div>

                <!-- Pilih Rumah Sakit Rujukan (Opsional) -->
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1.5">
                        Pilih Rumah Sakit Rujukan (Opsional)
                    </label>
                    <select wire:model.live="rumah_sakit_id"
                            @change="updateHospitalMarker($event.target.value)"
                            class="w-full px-4 py-2.5 rounded-xl border border-slate-200 bg-slate-50/50 focus:bg-white focus:border-sky-500 focus:ring-4 focus:ring-sky-500/10 text-sm font-medium transition-all">
                        <option value="">-- Pilih RS Rujukan (Atau Biarkan Dispatcher Menentukan) --</option>
                        @foreach($rumahSakits as $rs)
                            <option value="{{ $rs->id }}" data-lat="{{ $rs->lat }}" data-lng="{{ $rs->lng }}" data-nama="{{ $rs->nama }}">
                                {{ $rs->nama }} - {{ $rs->kapasitas_igd }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Catatan Tambahan untuk Supir -->
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1.5">
                        Catatan Tambahan untuk Supir
                    </label>
                    <input type="text" wire:model="catatan_tambahan"
                           placeholder="Contoh: Bawa kursi roda / gerbang rumah samping masjid"
                           class="w-full px-4 py-2.5 rounded-xl border border-slate-200 bg-slate-50/50 focus:bg-white focus:border-sky-500 focus:ring-4 focus:ring-sky-500/10 text-sm font-medium transition-all">
                </div>

                <!-- Submit Button -->
                <div class="pt-4">
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
                        Pesanan langsung masuk ke Pusat Kendali GSC SIAGA Cilacap.
                    </p>
                </div>

            </form>
        </div>

        <!-- Right Column: Leaflet Map (Sticky on Desktop) -->
        <div class="lg:col-span-6 flex flex-col lg:sticky lg:top-24 self-start">
            <div class="bg-white rounded-3xl border border-slate-200/80 p-5 sm:p-6 shadow-xs flex flex-col">
                <div class="flex items-center justify-between gap-3 mb-4">
                    <div>
                        <h2 class="font-bold text-slate-800 text-sm sm:text-base flex items-center gap-2">
                            <span class="w-2.5 h-2.5 rounded-full bg-sky-600"></span>
                            <span>Peta Penentuan Titik Jemput (Cilacap)</span>
                        </h2>
                        <p class="text-xs text-slate-500 mt-0.5">Klik di mana saja pada peta untuk menentukan koordinat penjemputan.</p>
                    </div>
                    <button type="button" @click="resetToDefault()"
                            class="px-3.5 py-2 rounded-xl text-xs font-bold bg-slate-100 hover:bg-sky-50 hover:text-sky-600 text-slate-700 transition-all flex items-center gap-1.5 flex-shrink-0 border border-slate-200/60 shadow-2xs">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        <span>Pusat Cilacap</span>
                    </button>
                </div>

                <!-- Leaflet Container dengan wire:ignore agar tidak terhapus saat Livewire re-render -->
                <div wire:ignore class="w-full rounded-2xl border border-slate-200 shadow-inner overflow-hidden z-10" style="height: 450px; min-height: 450px; width: 100%;">
                    <div id="booking-map" class="w-full h-full" style="height: 450px; min-height: 450px; width: 100%;"></div>
                </div>

                <!-- Info Box Koordinat Terpilih di bawah peta -->
                <div class="mt-4 pt-3.5 border-t border-slate-100 flex items-center justify-between text-xs text-slate-600">
                    <div class="flex items-center gap-2">
                        <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                        <span class="font-semibold text-slate-700">Koordinat Aktif:</span>
                    </div>
                    <div class="font-mono font-bold text-slate-800 bg-slate-100 px-2.5 py-1 rounded-lg">
                        <span x-text="lat.toFixed(6)"></span>, <span x-text="lng.toFixed(6)"></span>
                    </div>
                </div>
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

                    window.addEventListener('resize', () => {
                        if (this.map) {
                            this.map.invalidateSize();
                        }
                    });
                },

                setMarkerPosition(newLat, newLng) {
                    this.lat = newLat;
                    this.lng = newLng;
                    if (this.marker) {
                        this.marker.setLatLng([newLat, newLng]);
                    }
                    if (this.map) {
                        this.map.panTo([newLat, newLng]);
                    }

                    @this.call('updateCoordinates', newLat, newLng);
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

                    const selectEl = document.querySelector('select[wire\\:model\\.live="rumah_sakit_id"]') || document.querySelector('select[wire\\:model="rumah_sakit_id"]');
                    if (!selectEl || selectEl.selectedIndex < 0) return;

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
