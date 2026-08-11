<div>
    <div class="absolute top-0 left-0 w-full h-80 bg-gradient-to-br from-primary-600 to-primary-700 -z-10"></div>

    <main class="pt-32 pb-24 px-6 lg:px-12 max-w-7xl mx-auto min-h-screen">
        <!-- Header Page -->
    <div class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div class="flex items-center gap-4">
            <div class="w-20 h-20 rounded-full bg-white p-2 flex items-center justify-center shadow-lg border-2 border-primary-100/80 flex-shrink-0 overflow-hidden">
                <img src="{{ asset('images/logo_ambulansiaga.png') }}" alt="Logo Ambulance Siaga" class="w-full h-full object-contain">
            </div>
            <div>
                <span class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-full text-xs font-bold bg-white/20 text-white uppercase tracking-wider mb-2 backdrop-blur-sm">
                    <span class="w-2 h-2 rounded-full bg-white animate-ping"></span>
                    Siaga Darurat 24 Jam • Ambulance Siaga
                </span>
                <h1 class="text-2xl sm:text-3xl font-extrabold text-white tracking-tight">Pesan Ambulans Darurat</h1>
                <p class="text-primary-100 text-sm mt-1">Lengkapi form atau klik langsung pada Peta Interaktif untuk menentukan lokasi penjemputan.</p>
            </div>
        </div>

        <a href="{{ route('masyarakat.info') }}"
           class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-white/10 border border-white/20 text-white text-sm font-semibold hover:bg-white hover:text-primary-600 transition-colors shadow-xs backdrop-blur-sm">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
        <div class="lg:col-span-6 bg-white/95 backdrop-blur-md rounded-3xl border border-white/60 p-6 sm:p-8 shadow-2xl shadow-slate-200/50 relative overflow-hidden">
            <!-- Decorative Blob -->
            <div class="absolute -top-24 -right-24 w-48 h-48 bg-primary-600/15 rounded-full blur-2xl pointer-events-none"></div>
            
            <form wire:submit="submitOrder" class="space-y-6 relative z-10">

                <!-- Nama Pasien -->
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1.5">
                        Nama Pasien <span class="text-red-500">*</span>
                    </label>
                    <input type="text" wire:model="nama_pasien"
                           placeholder="Contoh: Bpk. Hartono / Ibu Halimah"
                           class="w-full px-4 py-2.5 rounded-xl border border-slate-200 bg-slate-50/50 focus:bg-white focus:border-primary-600 focus:ring-4 focus:ring-primary-600/10 text-sm font-medium transition-all">
                    @error('nama_pasien') <p class="text-xs text-red-600 font-medium mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- Kondisi Pasien / Situasi Darurat -->
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1.5">
                        Kondisi Pasien / Situasi Darurat <span class="text-red-500">*</span>
                    </label>
                    <textarea wire:model="kondisi_pasien" rows="3"
                              placeholder="Contoh: Sesak nafas berat, butuh bantuan tabung oksigen dan evakuasi segera ke IGD..."
                              class="w-full px-4 py-2.5 rounded-xl border border-slate-200 bg-slate-50/50 focus:bg-white focus:border-primary-600 focus:ring-4 focus:ring-primary-600/10 text-sm font-medium transition-all"></textarea>
                    @error('kondisi_pasien') <p class="text-xs text-red-600 font-medium mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- Alamat / Patokan Penjemputan -->
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1.5">
                        Alamat / Patokan Penjemputan <span class="text-red-500">*</span>
                    </label>
                    <input type="text" wire:model="lokasi_jemput"
                           placeholder="Contoh: Jl. Gatot Subroto No. 45 (Depan Gerbang Merah / Samping Masjid)"
                           class="w-full px-4 py-2.5 rounded-xl border border-slate-200 bg-slate-50/50 focus:bg-white focus:border-primary-600 focus:ring-4 focus:ring-primary-600/10 text-sm font-medium transition-all">
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
                            class="w-full px-4 py-2.5 rounded-xl border border-slate-200 bg-slate-50/50 focus:bg-white focus:border-primary-600 focus:ring-4 focus:ring-primary-600/10 text-sm font-medium transition-all">
                        <option value="">-- Pilih RS Rujukan (Atau Biarkan Operator Menentukan) --</option>
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
                           class="w-full px-4 py-2.5 rounded-xl border border-slate-200 bg-slate-50/50 focus:bg-white focus:border-primary-600 focus:ring-4 focus:ring-primary-600/10 text-sm font-medium transition-all">
                </div>

                <!-- Camera Verification -->
                <div x-data="cameraVerificationComponent()" class="p-5 rounded-2xl border-2 border-slate-200 bg-slate-50/50">
                    <div class="flex items-center gap-3 mb-3">
                        <div class="w-10 h-10 rounded-full bg-primary-600/10 flex items-center justify-center text-primary-600">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-bold text-slate-800 text-sm">Foto Kondisi Pasien / Lokasi (Wajib) <span class="text-red-500">*</span></h3>
                            <p class="text-[11px] text-slate-500 mt-0.5 leading-snug">
                                Ambil foto langsung menggunakan kamera perangkat. GPS dan alamat akan tercatat otomatis pada foto sebagai bukti validasi pesanan.
                            </p>
                        </div>
                    </div>

                    @error('photo_base64') 
                        <div class="mb-3 p-3 rounded-lg bg-red-50 text-red-600 text-xs font-semibold border border-red-200 flex items-start gap-2">
                            <svg class="w-4 h-4 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                            <span>{{ $message }}</span>
                        </div>
                    @enderror

                    <!-- Error Alert -->
                    <div x-show="errorMsg" style="display: none;" class="mb-3 p-3 rounded-lg bg-red-50 text-red-600 text-xs font-semibold border border-red-200">
                        <span x-text="errorMsg"></span>
                    </div>

                    <!-- Camera & Preview Area -->
                    <div class="relative w-full aspect-video bg-black rounded-xl overflow-hidden shadow-inner flex items-center justify-center">
                        
                        <!-- Placeholder -->
                        <div x-show="!stream && !photoTaken && !isLoading" class="text-center p-4">
                            <svg class="w-12 h-12 text-slate-600 mx-auto mb-2 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            <p class="text-slate-400 text-xs font-medium">Kamera belum diaktifkan</p>
                        </div>

                        <!-- Loading -->
                        <div x-show="isLoading" style="display: none;" class="text-center p-4 absolute inset-0 bg-black/80 flex flex-col items-center justify-center z-20">
                            <svg class="w-8 h-8 text-white animate-spin mx-auto mb-2" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path>
                            </svg>
                            <p class="text-white text-xs font-bold" x-text="loadingText"></p>
                        </div>

                        <!-- Video Stream -->
                        <video x-ref="videoElement" x-show="stream && !photoTaken" class="w-full h-full object-cover" autoplay playsinline></video>

                        <!-- Photo Result Preview -->
                        <img x-show="photoTaken" :src="photoDataUrl" class="w-full h-full object-contain bg-slate-900" style="display: none;">
                    </div>

                    <!-- Action Buttons -->
                    <div class="mt-4 flex gap-2">
                        <button type="button" x-show="!stream && !photoTaken && !isLoading" @click="initCamera()"
                                class="flex-1 py-3 bg-slate-800 hover:bg-slate-900 text-white rounded-xl text-sm font-bold flex items-center justify-center gap-2 transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path></svg>
                            Buka Kamera
                        </button>

                        <button type="button" x-show="stream && !photoTaken" @click="takePhoto()" style="display: none;"
                                class="flex-1 py-3 bg-emerald-600 hover:bg-emerald-700 text-white rounded-xl text-sm font-bold flex items-center justify-center gap-2 transition-colors shadow-lg shadow-emerald-600/30">
                            <span class="w-3 h-3 rounded-full bg-white animate-pulse"></span>
                            Ambil Foto & Simpan Lokasi
                        </button>

                        <button type="button" x-show="photoTaken" @click="retakePhoto()" style="display: none;"
                                class="flex-1 py-3 bg-amber-500 hover:bg-amber-600 text-white rounded-xl text-sm font-bold flex items-center justify-center gap-2 transition-colors shadow-lg shadow-amber-500/30">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
                            Ambil Ulang Foto
                        </button>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="pt-4">
                    <button type="submit"
                            wire:loading.attr="disabled"
                            class="w-full py-4 rounded-2xl bg-primary-600 hover:bg-primary-700 text-white font-extrabold text-sm sm:text-base shadow-lg shadow-[#009CA6]/30 flex items-center justify-center gap-3 transition-all">
                        <span wire:loading.remove>KIRIM PESANAN DARURAT SEKARANG</span>
                        <span wire:loading class="flex items-center gap-2">
                            <svg class="w-5 h-5 animate-spin" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path>
                            </svg>
                            MENGIRIM KE OPERATOR...
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
            <div class="bg-white/95 backdrop-blur-md rounded-3xl border border-white/60 p-5 sm:p-6 shadow-2xl shadow-slate-200/50 flex flex-col relative overflow-hidden">
                <!-- Decorative Blob -->
                <div class="absolute -bottom-24 -left-24 w-48 h-48 bg-primary-600/15 rounded-full blur-2xl pointer-events-none"></div>
                
                <div class="flex items-center justify-between gap-3 mb-4 relative z-10">
                    <div>
                        <h2 class="font-bold text-slate-800 text-sm sm:text-base flex items-center gap-2">
                            <span class="w-2.5 h-2.5 rounded-full bg-primary-600"></span>
                            <span>Peta Penentuan Titik Jemput (Cilacap)</span>
                        </h2>
                        <p class="text-xs text-slate-500 mt-0.5">Klik di mana saja pada peta untuk menentukan koordinat penjemputan.</p>
                    </div>
                    <button type="button" @click="resetToDefault()"
                            class="px-3.5 py-2 rounded-xl text-xs font-bold bg-slate-100 hover:bg-primary-600/10 hover:text-primary-600 text-slate-700 transition-all flex items-center gap-1.5 flex-shrink-0 border border-slate-200/60 shadow-2xs">
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
    </main>
    <x-landing-footer />

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
                    this.map = L.map('booking-map', {
                        zoomControl: true
                    }).setView([this.lat, this.lng], 14);

                    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                        attribution: '&copy; OpenStreetMap contributors',
                        maxZoom: 19
                    }).addTo(this.map);

                    const jemputIcon = L.divIcon({
                        className: 'custom-jemput-icon',
                        html: `<div style="background: linear-gradient(135deg, #3B82F6, #1D4ED8); width: 38px; height: 38px; border-radius: 50%; border: 3px solid white; box-shadow: 0 4px 12px rgba(59,130,246,0.5); display: flex; align-items: center; justify-content: center; font-size: 18px; cursor: move;">📍</div>`,
                        iconSize: [38, 38],
                        iconAnchor: [19, 38]
                    });

                    // Create Draggable Marker
                    this.marker = L.marker([this.lat, this.lng], {
                        draggable: true,
                        icon: jemputIcon
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
                        if (this.map) {
                            this.map.invalidateSize();
                        }
                    }, 350);

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
                        const rsIcon = L.divIcon({
                            className: 'custom-rs-icon',
                            html: `<div style="background: linear-gradient(135deg, #10B981, #059669); width: 34px; height: 34px; border-radius: 50%; border: 3px solid white; box-shadow: 0 4px 10px rgba(16,185,129,0.4); display: flex; align-items: center; justify-content: center; font-size: 16px;">🏥</div>`,
                            iconSize: [34, 34],
                            iconAnchor: [17, 34]
                        });

                        this.hospitalMarker = L.marker([rsLat, rsLng], {
                            title: rsNama,
                            icon: rsIcon
                        }).addTo(this.map)
                        .bindPopup(`<b>Rumah Sakit Rujukan:</b><br>${rsNama}`)
                        .openPopup();

                        // Fit bounds between pickup and hospital
                        const bounds = L.latLngBounds([ [this.lat, this.lng], [rsLat, rsLng] ]);
                        this.map.fitBounds(bounds, { padding: [60, 60], maxZoom: 15 });
                    }
                }
            }
        }

        function cameraVerificationComponent() {
            return {
                stream: null,
                photoTaken: false,
                photoDataUrl: null,
                isLoading: false,
                loadingText: '',
                locationData: null,
                errorMsg: null,

                async initCamera() {
                    this.isLoading = true;
                    this.loadingText = 'Mengakses GPS...';
                    this.errorMsg = null;
                    
                    let finalLat, finalLng, finalAccuracy;
                    let isFallback = false;

                    try {
                        const position = await new Promise((resolve, reject) => {
                            navigator.geolocation.getCurrentPosition(resolve, reject, { 
                                enableHighAccuracy: true,
                                timeout: 8000,
                                maximumAge: 0
                            });
                        });
                        
                        finalLat = position.coords.latitude;
                        finalLng = position.coords.longitude;
                        finalAccuracy = position.coords.accuracy;

                        // Perkiraan batas Pulau Jawa (Lat: -9.0 sd -5.0, Lng: 105.0 sd 115.0)
                        const isInsideJava = (finalLat >= -9.0 && finalLat <= -5.0) && (finalLng >= 105.0 && finalLng <= 115.0);
                        const isAccuracyPoor = finalAccuracy > 1000; // Lebih dari 1 KM

                        if (!isInsideJava || isAccuracyPoor) {
                            console.warn("GPS terdeteksi di luar pulau Jawa atau akurasi buruk. Fallback ke Peta.");
                            isFallback = true;
                        }
                    } catch (err) {
                        console.warn('Gagal akses GPS, fallback ke titik peta', err);
                        isFallback = true;
                    }

                    if (isFallback) {
                        // Menggunakan data this.lat & this.lng dari parent komponen Alpine (orderMapComponent)
                        finalLat = this.lat;
                        finalLng = this.lng;
                        finalAccuracy = 0; // 0 menandakan dari peta (manual)
                    }
                    
                    try {
                        this.loadingText = 'Mencari detail alamat...';
                        let addressDetails = {
                            display_name: 'Lokasi ditentukan dari Peta',
                            address: {}
                        };

                        try {
                            const response = await fetch(`https://nominatim.openstreetmap.org/reverse?format=json&lat=${finalLat}&lon=${finalLng}&zoom=18&addressdetails=1`);
                            if (response.ok) {
                                addressDetails = await response.json();
                            }
                        } catch (e) {
                            console.error('Nominatim error', e);
                        }
                        
                        this.locationData = {
                            lat: finalLat,
                            lon: finalLng,
                            accuracy: finalAccuracy,
                            address: addressDetails.display_name,
                            district: addressDetails.address?.village || addressDetails.address?.suburb || addressDetails.address?.city_district || '-',
                            city: addressDetails.address?.city || addressDetails.address?.county || addressDetails.address?.town || '-',
                            province: addressDetails.address?.state || '-',
                            country: addressDetails.address?.country || '-',
                            timestamp: new Date().toISOString()
                        };

                        this.loadingText = 'Membuka kamera...';
                        this.stream = await navigator.mediaDevices.getUserMedia({
                            video: { facingMode: 'environment' },
                            audio: false
                        });
                        
                        this.$refs.videoElement.srcObject = this.stream;
                        
                    } catch (err) {
                        console.error(err);
                        this.errorMsg = 'Gagal membuka kamera. Pastikan browser memberi izin kamera dan diakses melalui koneksi aman (HTTPS/Localhost).';
                    } finally {
                        this.isLoading = false;
                    }
                },
                
                takePhoto() {
                    if (!this.locationData) return;
                    
                    const video = this.$refs.videoElement;
                    const canvas = document.createElement('canvas');
                    // Use a reasonable internal resolution
                    const targetWidth = 1280;
                    const scale = targetWidth / video.videoWidth;
                    canvas.width = targetWidth;
                    canvas.height = video.videoHeight * scale;
                    
                    const ctx = canvas.getContext('2d');
                    
                    // Draw video
                    ctx.drawImage(video, 0, 0, canvas.width, canvas.height);
                    
                    // Draw overlay background
                    const overlayHeight = 220;
                    ctx.fillStyle = 'rgba(0, 0, 0, 0.65)';
                    ctx.fillRect(0, canvas.height - overlayHeight, canvas.width, overlayHeight);
                    
                    // Draw Location Icon / Map Placeholder
                    ctx.fillStyle = 'rgba(255, 255, 255, 0.2)';
                    ctx.fillRect(20, canvas.height - overlayHeight + 20, 180, 180);
                    ctx.fillStyle = 'white';
                    ctx.font = '60px Arial';
                    ctx.textAlign = 'center';
                    ctx.fillText('📍', 110, canvas.height - overlayHeight + 130);
                    ctx.textAlign = 'left';
                    
                    // Draw Text
                    ctx.fillStyle = 'white';
                    ctx.font = 'bold 28px Arial';
                    const locTitle = `${this.locationData.district}, ${this.locationData.province}, ${this.locationData.country}`;
                    ctx.fillText(locTitle.substring(0, 50), 220, canvas.height - overlayHeight + 50);
                    
                    ctx.font = '22px Arial';
                    let addr = this.locationData.address;
                    if(addr.length > 80) addr = addr.substring(0, 80) + '...';
                    ctx.fillText(addr, 220, canvas.height - overlayHeight + 90);
                    
                    ctx.font = '20px Arial';
                    ctx.fillStyle = '#cbd5e1';
                    ctx.fillText(`Lat ${this.locationData.lat.toFixed(6)}° Long ${this.locationData.lon.toFixed(6)}°`, 220, canvas.height - overlayHeight + 130);
                    
                    const dateStr = new Date(this.locationData.timestamp).toLocaleString('id-ID', {
                        weekday: 'long', year: 'numeric', month: 'long', day: 'numeric',
                        hour: '2-digit', minute: '2-digit', second: '2-digit'
                    }) + ' GMT+07:00';
                    ctx.fillText(dateStr, 220, canvas.height - overlayHeight + 170);
                    
                    // Compress and convert to base64
                    this.photoDataUrl = canvas.toDataURL('image/jpeg', 0.6);
                    this.photoTaken = true;
                    
                    // Send to Livewire via $wire
                    @this.set('photo_base64', this.photoDataUrl);
                    @this.set('photo_latitude', this.locationData.lat);
                    @this.set('photo_longitude', this.locationData.lon);
                    @this.set('photo_address', this.locationData.address);
                    @this.set('photo_district', this.locationData.district);
                    @this.set('photo_city', this.locationData.city);
                    @this.set('photo_province', this.locationData.province);
                    @this.set('photo_country', this.locationData.country);
                    @this.set('photo_taken_at', this.locationData.timestamp.replace('T', ' ').substring(0, 19));
                    @this.set('photo_accuracy', this.locationData.accuracy);
                    
                    this.stopCamera();
                },
                
                retakePhoto() {
                    this.photoTaken = false;
                    this.photoDataUrl = null;
                    @this.set('photo_base64', null);
                    this.initCamera();
                },
                
                stopCamera() {
                    if (this.stream) {
                        this.stream.getTracks().forEach(track => track.stop());
                        this.stream = null;
                    }
                }
            }
        }
    </script>
</div>
