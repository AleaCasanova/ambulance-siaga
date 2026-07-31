<div>
    <!-- Header Page -->
    <div class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <span class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-full text-xs font-bold bg-sky-100 text-sky-700 uppercase tracking-wider mb-2">
                <span class="w-2 h-2 rounded-full bg-sky-600 animate-ping"></span>
                Siaga Darurat 24 Jam • GSC
            </span>
            <h1 class="text-2xl sm:text-3xl font-extrabold text-slate-800 tracking-tight">Pesan Ambulans Darurat</h1>
            <p class="text-slate-500 text-sm mt-1">Lengkapi form atau klik langsung pada Peta Interaktif di sebelah kanan untuk menentukan lokasi penjemputan.</p>
        </div>

        <a href="{{ route('masyarakat.info') }}"
           class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-white border border-slate-300 text-slate-700 text-sm font-semibold hover:bg-sky-50 hover:text-sky-600 transition-colors shadow-xs">
            <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <span>Panduan GSC</span>
        </a>
    </div>

    <!-- Main Grid: Form (Left) & Leaflet Map (Right) -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8"
         x-data="orderMapComponent({{ $jemput_lat }}, {{ $jemput_lng }})"
         x-init="initMap()">

        <!-- Left Column: Form Pemesanan -->
        <div class="lg:col-span-5 bg-white rounded-3xl border border-slate-200/80 p-6 sm:p-8 shadow-xs">
            <form wire:submit="submitOrder" class="space-y-5">

                <!-- Nama Pasien -->
                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-1.5">
                        Nama Pasien <span class="text-red-500">*</span>
                    </label>
                    <input type="text" wire:model="nama_pasien"
                           placeholder="Contoh: Bpk. Hartono / Ibu Halimah"
                           class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:border-sky-500 focus:ring-2 focus:ring-sky-200 text-sm font-medium transition-all">
                    @error('nama_pasien') <p class="text-xs text-red-600 font-medium mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- Kondisi Pasien / Darurat -->
                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-1.5">
                        Kondisi Pasien / Situasi Darurat <span class="text-red-500">*</span>
                    </label>
                    <textarea wire:model="kondisi_pasien" rows="3"
                              placeholder="Contoh: Sesak nafas berat, butuh bantuan tabung oksigen dan evakuasi segera ke IGD..."
                              class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:border-sky-500 focus:ring-2 focus:ring-sky-200 text-sm font-medium transition-all"></textarea>
                    @error('kondisi_pasien') <p class="text-xs text-red-600 font-medium mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- Alamat / Lokasi Penjemputan -->
                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-1.5">
                        Alamat / Patokan Penjemputan <span class="text-red-500">*</span>
                    </label>
                    <input type="text" wire:model="lokasi_jemput"
                           placeholder="Contoh: Jl. Gatot Subroto No. 45, Sidanegara (depan gerbang merah)"
                           class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:border-sky-500 focus:ring-2 focus:ring-sky-200 text-sm font-medium transition-all">
                    @error('lokasi_jemput') <p class="text-xs text-red-600 font-medium mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- Koordinat GPS -->
                <div class="grid grid-cols-2 gap-3 p-3 rounded-xl bg-slate-50 border border-slate-200/80 text-xs">
                    <div>
                        <span class="text-slate-400 block font-semibold">LATITUDE</span>
                        <span class="font-bold text-slate-700" x-text="lat.toFixed(6)"></span>
                    </div>
                    <div>
                        <span class="text-slate-400 block font-semibold">LONGITUDE</span>
                        <span class="font-bold text-slate-700" x-text="lng.toFixed(6)"></span>
                    </div>
                </div>

                <!-- Rumah Sakit Rujukan -->
                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-1.5">
                        Pilih Rumah Sakit Rujukan (Opsional)
                    </label>
                    <select wire:model="rumah_sakit_id"
                            @change="updateHospitalMarker($event.target.value)"
                            class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:border-sky-500 focus:ring-2 focus:ring-sky-200 text-sm font-medium transition-all">
                        <option value="">-- Pilih RS Rujukan (Atau Biarkan Dispatcher Menentukan) --</option>
                        @foreach($rumahSakits as $rs)
                            <option value="{{ $rs->id }}" data-lat="{{ $rs->lat }}" data-lng="{{ $rs->lng }}" data-nama="{{ $rs->nama }}">
                                {{ $rs->nama }} - {{ $rs->kapasitas_igd }}
                            </option>
                        @endforeach
                    </select>
                    @error('rumah_sakit_id') <p class="text-xs text-red-600 font-medium mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- Catatan Tambahan -->
                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-1.5">
                        Catatan Tambahan untuk Supir
                    </label>
                    <input type="text" wire:model="catatan_tambahan"
                           placeholder="Contoh: Bawa kursi roda / gerbang rumah samping masjid"
                           class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:border-sky-500 focus:ring-2 focus:ring-sky-200 text-sm font-medium transition-all">
                </div>

                <!-- Submit Button -->
                <div class="pt-2">
                    <button type="submit"
                            wire:loading.attr="disabled"
                            class="w-full py-4 rounded-2xl bg-sky-600 hover:bg-sky-700 text-white font-extrabold text-base shadow-lg shadow-sky-600/30 flex items-center justify-center gap-3 transition-all">
                        <span wire:loading.remove>KIRIM PESANAN DARURAT SEKARANG</span>
                        <span wire:loading class="flex items-center gap-2">
                            <svg class="w-5 h-5 animate-spin" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path>
                            </svg>
                            MENGIRIM KE DISPATCHER...
                        </span>
                    </button>
                    <p class="text-center text-xs text-slate-400 mt-3 font-medium">
                        Pesanan langsung masuk ke Pusat Kendali GSC SIAGA Cilacap.
                    </p>
                </div>

            </form>
        </div>

        <!-- Right Column: Leaflet Map -->
        <div class="lg:col-span-7 flex flex-col">
            <div class="bg-white rounded-3xl border border-slate-200/80 p-5 shadow-xs flex-1 flex flex-col min-h-[500px]">
                <div class="flex items-center justify-between mb-4">
                    <div>
                        <h2 class="font-bold text-slate-800 text-base flex items-center gap-2">
                            <span class="w-2.5 h-2.5 rounded-full bg-sky-600"></span>
                            <span>Peta Penentuan Titik Jemput (Cilacap)</span>
                        </h2>
                        <p class="text-xs text-slate-500">Klik di mana saja pada peta untuk mengatur koordinat penjemputan.</p>
                    </div>
                    <button type="button" @click="resetToDefault()"
                            class="px-3 py-1.5 rounded-xl text-xs font-semibold bg-slate-100 hover:bg-slate-200 text-slate-700 transition-colors">
                        Pusat Cilacap
                    </button>
                </div>

                <!-- Leaflet Container -->
                <div id="booking-map" class="w-full h-full min-h-[440px] rounded-2xl border border-slate-200/80 z-10"></div>
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
