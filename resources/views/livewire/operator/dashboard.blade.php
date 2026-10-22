<div wire:poll.5s
     x-data="{
         soundEnabled: localStorage.getItem('operator_sound_enabled') !== 'false',
         playChime() {
             if (!this.soundEnabled) return;
             try {
                 const ctx = new (window.AudioContext || window.webkitAudioContext)();
                 const osc = ctx.createOscillator();
                 const gain = ctx.createGain();
                 osc.type = 'sine';
                 osc.frequency.setValueAtTime(880, ctx.currentTime);
                 osc.frequency.setValueAtTime(659.25, ctx.currentTime + 0.15);
                 gain.gain.setValueAtTime(0.18, ctx.currentTime);
                 gain.gain.exponentialRampToValueAtTime(0.001, ctx.currentTime + 0.5);
                 osc.connect(gain);
                 gain.connect(ctx.destination);
                 osc.start();
                 osc.stop(ctx.currentTime + 0.5);
             } catch(e) {}
         },
         toggleSound() {
             this.soundEnabled = !this.soundEnabled;
             localStorage.setItem('operator_sound_enabled', this.soundEnabled);
             if (this.soundEnabled) this.playChime();
         }
     }"
     x-init="$watch('$wire.stats.menunggu', (newVal, oldVal) => {
         if (newVal > oldVal) {
             playChime();
         }
     })">
    <!-- Header Page -->
    <div class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <div class="text-[11px] font-semibold text-slate-400 uppercase tracking-wider mb-1">
                Pusat Kendali Operasional
            </div>
            <h1 class="text-2xl sm:text-[26px] font-bold text-slate-900 tracking-tight leading-tight">Dashboard Operator</h1>
            <p class="text-slate-500 text-xs sm:text-sm mt-0.5">Pantau pesanan darurat masuk dan tugaskan armada ambulans secara terkoordinasi.</p>
        </div>

        <div class="flex items-center gap-2.5 shrink-0 flex-wrap">
            <button type="button" 
                    @click="toggleSound()" 
                    :title="soundEnabled ? 'Sirine Notifikasi Aktif' : 'Sirine Notifikasi Dimatikan'"
                    class="inline-flex items-center gap-1.5 px-3 py-2 rounded-lg border text-xs font-semibold transition-colors shadow-2xs"
                    :class="soundEnabled ? 'bg-emerald-50 border-emerald-200 text-emerald-800' : 'bg-slate-50 border-slate-200 text-slate-500'">
                <span class="w-2 h-2 rounded-full" :class="soundEnabled ? 'bg-emerald-500 animate-pulse' : 'bg-slate-300'"></span>
                <span x-text="soundEnabled ? 'Sirine: On' : 'Sirine: Off'"></span>
            </button>
            <a href="{{ route('operator.monitoring') }}"
               class="inline-flex items-center px-3.5 py-2 rounded-lg bg-slate-900 hover:bg-slate-800 text-white font-semibold text-xs shadow-xs transition-colors">
                Peta Layar Penuh
            </a>
            <a href="{{ route('operator.orders.index') }}"
               class="inline-flex items-center px-3.5 py-2 rounded-lg bg-white border border-slate-200 text-slate-700 text-xs font-semibold hover:bg-slate-50 transition-colors shadow-2xs">
                Semua Order
            </a>
        </div>
    </div>

    <!-- 4 Statistik Utama (Clean & Professional) -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
        <!-- 1. Menunggu Penugasan -->
        <div class="p-5 rounded-xl bg-white border border-slate-200/90 shadow-xs hover:border-slate-300 transition-colors">
            <p class="text-[11px] font-semibold tracking-wider text-slate-400 uppercase">Menunggu Penugasan</p>
            <div class="mt-3 flex items-baseline gap-1.5">
                <span class="text-3xl font-bold text-slate-900 tracking-tight">{{ $stats['menunggu'] }}</span>
                <span class="text-xs font-medium text-slate-500">pesanan</span>
            </div>
            <p class="text-xs text-slate-500 mt-2">Antrean pesanan baru masuk</p>
        </div>

        <!-- 2. Ambulans Bertugas -->
        <div class="p-5 rounded-xl bg-white border border-slate-200/90 shadow-xs hover:border-slate-300 transition-colors">
            <p class="text-[11px] font-semibold tracking-wider text-slate-400 uppercase">Ambulans Bertugas</p>
            <div class="mt-3 flex items-baseline gap-1.5">
                <span class="text-3xl font-bold text-slate-900 tracking-tight">{{ $stats['aktif'] }}</span>
                <span class="text-xs font-medium text-slate-500">armada</span>
            </div>
            <p class="text-xs text-slate-500 mt-2">Sedang dalam proses evakuasi</p>
        </div>

        <!-- 3. Ambulans Siaga -->
        <div class="p-5 rounded-xl bg-white border border-slate-200/90 shadow-xs hover:border-slate-300 transition-colors">
            <p class="text-[11px] font-semibold tracking-wider text-slate-400 uppercase">Ambulans Siaga</p>
            <div class="mt-3 flex items-baseline gap-1.5">
                <span class="text-3xl font-bold text-slate-900 tracking-tight">{{ $stats['amb_tersedia'] }}</span>
                <span class="text-xs font-medium text-slate-500">armada</span>
            </div>
            <p class="text-xs text-slate-500 mt-2">Siap menerima penugasan</p>
        </div>

        <!-- 4. Supir Online -->
        <div class="p-5 rounded-xl bg-white border border-slate-200/90 shadow-xs hover:border-slate-300 transition-colors">
            <p class="text-[11px] font-semibold tracking-wider text-slate-400 uppercase">Supir Online</p>
            <div class="mt-3 flex items-baseline gap-1.5">
                <span class="text-3xl font-bold text-slate-900 tracking-tight">{{ $stats['supir_online'] }}</span>
                <span class="text-xs font-medium text-slate-500">personel</span>
            </div>
            <p class="text-xs text-slate-500 mt-2">Aktif dan terhubung di lapangan</p>
        </div>
    </div>

    <!-- Main Grid: Pesanan Darurat Masuk (Left) & Live Map (Right) -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 mb-8"
         x-data="operatorDashboardMap(@js($mapMarkers))"
         x-init="initMap()"
         @map-markers-updated.window="updateMarkers($event.detail.markers)">

        <!-- Left Column: Pesanan Masuk & Order Aktif (5 Kolom) -->
        <div class="lg:col-span-5 space-y-6">

            <!-- Card: Order Darurat Menunggu Penugasan -->
            <div class="bg-white rounded-xl border border-slate-200/80 p-5 shadow-xs">
                <div class="flex items-center justify-between mb-4 pb-3 border-b border-slate-100">
                    <h2 class="font-bold text-slate-900 text-sm">Pesanan Darurat Masuk</h2>
                    <span class="px-2.5 py-0.5 rounded text-[11px] font-semibold bg-slate-100 text-slate-700">
                        {{ $ordersMenunggu->count() }} Menunggu
                    </span>
                </div>

                <div class="space-y-3.5 max-h-[380px] overflow-y-auto pr-0.5">
                    @forelse($ordersMenunggu as $om)
                        @php
                            $badgePriority = match($om->prioritas) {
                                'tinggi' => 'bg-rose-50 text-rose-700 border-rose-200',
                                'sedang' => 'bg-amber-50 text-amber-700 border-amber-200',
                                'rendah' => 'bg-emerald-50 text-emerald-700 border-emerald-200',
                                default => 'bg-slate-50 text-slate-700 border-slate-200'
                            };
                            $priorityLabel = match($om->prioritas) {
                                'tinggi' => 'Prioritas Tinggi',
                                'sedang' => 'Prioritas Sedang',
                                'rendah' => 'Prioritas Rendah',
                                default => 'Prioritas Biasa'
                            };
                        @endphp
                        <div class="p-3.5 rounded-lg border border-slate-200/80 bg-white hover:border-slate-300 transition-colors shadow-2xs">
                            <div class="flex items-center justify-between mb-1.5">
                                <span class="text-xs font-mono font-bold text-sky-700">{{ $om->kode_order }}</span>
                                <span class="px-2 py-0.5 rounded text-[10px] font-semibold border {{ $badgePriority }}">
                                    {{ $priorityLabel }}
                                </span>
                            </div>
                            
                            <h3 class="font-bold text-slate-900 text-xs mb-1">{{ $om->nama_pasien }}</h3>
                            
                            @if($om->kondisi_pasien)
                                <p class="text-xs text-slate-600 leading-relaxed mb-2 line-clamp-2">{{ $om->kondisi_pasien }}</p>
                            @endif

                            <div class="text-[11px] text-slate-500 leading-normal mb-3">
                                <span class="font-medium text-slate-600">Lokasi:</span> {{ $om->lokasi_jemput }}
                            </div>

                            <div class="flex items-center gap-2 pt-2 border-t border-slate-100">
                                <select wire:change="updatePriority({{ $om->id }}, $event.target.value)" 
                                        class="w-28 rounded-lg border border-slate-200 bg-slate-50 text-[11px] font-semibold px-2 py-1.5 focus:border-cyan-500 focus:ring-1 focus:ring-cyan-500 outline-none text-slate-700">
                                    <option value="tinggi" {{ $om->prioritas == 'tinggi' ? 'selected' : '' }}>Tinggi</option>
                                    <option value="sedang" {{ $om->prioritas == 'sedang' ? 'selected' : '' }}>Sedang</option>
                                    <option value="rendah" {{ $om->prioritas == 'rendah' ? 'selected' : '' }}>Rendah</option>
                                </select>
                                <button type="button" wire:click="openAssignModal({{ $om->id }})"
                                        class="flex-1 py-1.5 px-3 rounded-lg bg-cyan-600 hover:bg-cyan-700 text-white font-semibold text-xs shadow-xs transition-colors text-center">
                                    Tugaskan
                                </button>
                                <button type="button" wire:click="openCancelModal({{ $om->id }})"
                                        title="Batalkan Pesanan Ini"
                                        class="px-2.5 py-1.5 rounded-lg border border-slate-200 bg-white hover:bg-rose-50 hover:border-rose-200 hover:text-rose-700 text-slate-500 text-xs font-semibold transition-colors">
                                    Batal
                                </button>
                            </div>
                        </div>
                    @empty
                        <div class="py-8 text-center text-slate-400">
                            <p class="text-xs font-semibold text-slate-600">Tidak ada antrean pesanan darurat</p>
                            <p class="text-[11px] text-slate-400 mt-0.5">Semua permintaan saat ini telah tertangani</p>
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- Card: Order Aktif Sedang Bertugas -->
            <div class="bg-white rounded-xl border border-slate-200/80 p-5 shadow-xs">
                <div class="flex items-center justify-between mb-4 pb-3 border-b border-slate-100">
                    <h3 class="font-bold text-slate-900 text-sm">Ambulans Sedang Bertugas</h3>
                    <span class="text-xs font-medium text-slate-500">{{ $activeOrders->count() }} Armada Aktif</span>
                </div>

                <div class="space-y-2.5 max-h-[300px] overflow-y-auto pr-0.5">
                    @forelse($activeOrders as $ao)
                        <div class="p-3 rounded-lg bg-slate-50 border border-slate-200/70 flex items-center justify-between gap-3">
                            <div class="min-w-0 flex-1">
                                <div class="flex items-center gap-2 mb-0.5">
                                    <span class="text-xs font-bold text-slate-800">{{ $ao->ambulans?->kode_ambulans ?? 'AMB' }}</span>
                                    <span class="text-[11px] font-medium text-sky-700 bg-sky-50 px-1.5 py-0.5 rounded border border-sky-100">{{ $ao->status_label }}</span>
                                </div>
                                <p class="text-xs text-slate-700 truncate"><span class="text-slate-400">Pasien:</span> {{ $ao->nama_pasien }}</p>
                                <p class="text-[11px] text-slate-500"><span class="text-slate-400">Driver:</span> {{ $ao->supir?->user->name ?? '-' }}</p>
                            </div>
                            <a href="{{ route('masyarakat.tracking', $ao->id) }}" target="_blank"
                               class="px-3 py-1.5 rounded-lg bg-white border border-slate-200 text-slate-700 text-xs font-medium hover:bg-slate-50 transition-colors shrink-0 shadow-2xs">
                                Pantau
                            </a>
                        </div>
                    @empty
                        <p class="text-xs text-slate-400 text-center py-6">Tidak ada armada yang sedang bertugas saat ini</p>
                    @endforelse
                </div>
            </div>

        </div>

        <!-- Right Column: Peta Monitoring Realtime (7 Kolom) -->
        <div class="lg:col-span-7 flex flex-col">
            <div class="bg-white rounded-xl border border-slate-200/80 shadow-xs flex-1 flex flex-col overflow-hidden">
                <div class="px-5 py-3.5 border-b border-slate-100 flex items-center justify-between bg-slate-50/50">
                    <div>
                        <h2 class="font-bold text-slate-900 text-sm">Peta Monitoring Armada & Pasien</h2>
                        <p class="text-xs text-slate-500 mt-0.5">Pemantauan posisi armada ambulans dan titik jemput pasien secara real-time</p>
                    </div>
                    <button type="button" @click="fitAll()"
                            class="px-3 py-1.5 rounded-lg text-xs font-medium bg-white hover:bg-slate-50 border border-slate-200 text-slate-700 transition-colors shadow-2xs">
                        Fokus Semua
                    </button>
                </div>

                <!-- Leaflet Container -->
                <div wire:ignore class="relative w-full flex-1 min-h-[460px] bg-slate-100 z-0">
                    <div id="operator-map" class="absolute inset-0"></div>
                </div>

                <!-- Legend & Panduan Simbol -->
                <div class="border-t border-slate-100 bg-slate-50/80 p-3 px-5 flex flex-wrap items-center justify-between gap-3 text-xs text-slate-600">
                    <div class="flex items-center gap-5 flex-wrap">
                        <div class="flex items-center gap-1.5">
                            <span class="w-2.5 h-2.5 rounded-full bg-cyan-600 inline-block shrink-0"></span>
                            <span class="font-medium text-slate-700">Ambulans Siaga</span>
                        </div>
                        <div class="flex items-center gap-1.5">
                            <span class="w-2.5 h-2.5 rounded-full bg-rose-500 inline-block shrink-0"></span>
                            <span class="font-medium text-slate-700">Titik Jemput Pasien</span>
                        </div>
                    </div>
                    <div class="text-slate-400 text-[11px]">
                        Koordinat GPS & OSRM
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Assignment Modal (Clean Dialog) -->
    @if($showAssignModal)
        <div class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-xs">
            <div class="bg-white rounded-xl max-w-lg w-full p-6 shadow-2xl border border-slate-200 overflow-hidden">
                <div class="flex items-center justify-between mb-5 pb-3 border-b border-slate-100">
                    <div>
                        <h3 class="text-sm font-bold text-slate-900">Tugaskan Armada Ambulans</h3>
                        <p class="text-xs text-slate-500 mt-0.5">Pilih armada siaga dan supir untuk penjemputan</p>
                    </div>
                    <button wire:click="closeAssignModal" class="text-slate-400 hover:text-slate-600">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>

                <!-- Map Radar Penugasan -->
                @if($assignOrderData)
                <div x-data="assignMapAlpine(@js($assignOrderData), @js($assignDriversData))" 
                     @select-driver.window="$wire.set('selectedSupirId', $event.detail.supir); $wire.set('selectedAmbulansId', $event.detail.amb);"
                     class="mb-5">
                    <div class="flex items-center justify-between mb-1.5">
                        <span class="text-xs font-bold text-slate-700">Radar Jarak Armada Siaga</span>
                        <span class="text-[11px] text-slate-500">Klik armada untuk memilih</span>
                    </div>
                    <div class="border border-slate-200 rounded-lg overflow-hidden bg-slate-100 shadow-2xs">
                        <div x-ref="mapContainer" class="h-56 w-full z-0" wire:ignore></div>
                    </div>
                    <div class="flex items-center gap-3 text-[11px] text-slate-500 mt-1.5">
                        <span class="flex items-center gap-1"><span class="w-2 h-2 rounded-full bg-rose-500"></span> Lokasi Pasien</span>
                        <span>•</span>
                        <span class="flex items-center gap-1"><span class="w-2 h-2 rounded-full bg-cyan-600"></span> Supir / Armada Siaga</span>
                    </div>
                </div>
                @endif

                <!-- Flash Error -->
                @if(session('error'))
                    <div class="mb-4 p-3 rounded-lg bg-rose-50 border border-rose-200 text-rose-700 text-xs font-medium flex items-start gap-2 shadow-2xs">
                        <svg class="w-4 h-4 shrink-0 mt-0.5 text-rose-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                        <span>{{ session('error') }}</span>
                    </div>
                @endif

                <form wire:submit="assignOrder" class="space-y-4">
                    <!-- Pilih Armada Ambulans -->
                    <div>
                        <label class="block text-xs font-bold text-slate-600 uppercase tracking-wider mb-1.5">
                            Pilih Armada Ambulans (Tersedia: {{ $availableAmbulances->count() }})
                        </label>
                        <select wire:model="selectedAmbulansId"
                                class="w-full px-3.5 py-2.5 rounded-lg border border-slate-300 focus:border-cyan-500 focus:ring-1 focus:ring-cyan-500 text-xs font-semibold text-slate-800 bg-white">
                            <option value="">-- Pilih Ambulans yang Tersedia --</option>
                            @foreach($availableAmbulances as $amb)
                                <option value="{{ $amb->id }}">
                                    {{ $amb->kode_ambulans }} - {{ $amb->plat_nomor }} ({{ $amb->jenis_ambulans }})
                                </option>
                            @endforeach
                        </select>
                        @error('selectedAmbulansId') <p class="text-xs text-rose-600 font-medium mt-1">{{ $message }}</p> @enderror
                    </div>

                    <!-- Pilih Supir Online -->
                    <div>
                        <label class="block text-xs font-bold text-slate-600 uppercase tracking-wider mb-1.5">
                            Pilih Supir Ambulans (Online: {{ $onlineSupirs->count() }})
                        </label>
                        <select wire:model="selectedSupirId"
                                class="w-full px-3.5 py-2.5 rounded-lg border border-slate-300 focus:border-cyan-500 focus:ring-1 focus:ring-cyan-500 text-xs font-semibold text-slate-800 bg-white">
                            <option value="">-- Pilih Supir Siaga / Online --</option>
                            @foreach($onlineSupirs as $sp)
                                <option value="{{ $sp->id }}">
                                    {{ $sp->user->name }} - SIM: {{ $sp->nomor_sim }} (★ {{ $sp->rating_rata_rata }})
                                </option>
                            @endforeach
                        </select>
                        @error('selectedSupirId') <p class="text-xs text-rose-600 font-medium mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="flex gap-2.5 pt-3 border-t border-slate-100">
                        <button type="button" wire:click="closeAssignModal"
                                class="px-4 py-2.5 rounded-lg border border-slate-200 bg-white hover:bg-slate-100 text-slate-600 font-semibold text-xs transition-colors">
                            Batal
                        </button>
                        <button type="submit"
                                wire:loading.attr="disabled"
                                class="flex-1 py-2.5 rounded-lg bg-cyan-600 hover:bg-cyan-700 text-white font-bold text-xs shadow-xs transition-colors text-center">
                            <span wire:loading.remove wire:target="assignOrder">Konfirmasi Penugasan</span>
                            <span wire:loading wire:target="assignOrder">Memproses...</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endif

    <!-- Cancellation Modal (Dialog Pembatalan Resmi) -->
    @if($showCancelModal)
        <div class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-xs">
            <div class="bg-white rounded-xl max-w-md w-full p-6 shadow-2xl border border-slate-200">
                <div class="flex items-center justify-between mb-4 pb-3 border-b border-slate-100">
                    <div>
                        <h3 class="text-sm font-bold text-slate-900">Batalkan Pesanan Darurat</h3>
                        <p class="text-xs text-slate-500 mt-0.5">Pilih atau isi alasan pembatalan resmi</p>
                    </div>
                    <button wire:click="closeCancelModal" class="text-slate-400 hover:text-slate-600">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>

                <form wire:submit="confirmCancelOrder" class="space-y-4">
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1.5">Alasan Pembatalan</label>
                        <select wire:model="cancelReason" 
                                class="w-full px-3 py-2 rounded-lg border border-slate-300 text-xs font-medium text-slate-800 bg-white mb-2">
                            <option value="">-- Pilih Alasan Umum --</option>
                            <option value="Keluarga pasien berangkat mandiri menggunakan kendaraan pribadi">Keluarga berangkat mandiri</option>
                            <option value="Panggilan uji coba / salah pencet oleh pemesan">Uji coba / salah pencet</option>
                            <option value="Pasien sudah tertangani oleh ambulans / faskes lain di lokasi">Sudah tertangani pihak lain</option>
                            <option value="Titik penjemputan di luar jangkauan respon ambulans">Di luar jangkauan operasional</option>
                        </select>

                        <textarea wire:model="cancelReason" rows="3"
                                  placeholder="Atau ketikkan keterangan alasan spesifik..."
                                  class="w-full px-3 py-2 rounded-lg border border-slate-300 text-xs text-slate-800 focus:border-rose-500 focus:ring-1 focus:ring-rose-500 outline-none"></textarea>
                        @error('cancelReason') <p class="text-xs text-rose-600 font-medium mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="flex gap-2.5 pt-3 border-t border-slate-100">
                        <button type="button" wire:click="closeCancelModal"
                                class="px-4 py-2 rounded-lg border border-slate-200 bg-white hover:bg-slate-50 text-slate-700 font-medium text-xs transition-colors">
                            Kembali
                        </button>
                        <button type="submit" wire:loading.attr="disabled"
                                class="flex-1 py-2 rounded-lg bg-rose-600 hover:bg-rose-700 text-white font-semibold text-xs shadow-xs transition-colors text-center">
                            <span wire:loading.remove wire:target="confirmCancelOrder">Konfirmasi Batalkan</span>
                            <span wire:loading wire:target="confirmCancelOrder">Memproses...</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endif

    <!-- Leaflet Script for Operator Map -->
    <script>
        function operatorDashboardMap(initialMarkers) {
            return {
                map: null,
                markersData: initialMarkers,
                createdMarkers: [],

                initMap() {
                    if (this.map) return;

                    this.map = L.map('operator-map', {
                        zoomControl: false,
                        scrollWheelZoom: true
                    }).setView([-7.7188, 109.0159], 13);

                    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                        attribution: '&copy; OpenStreetMap contributors',
                        maxZoom: 19
                    }).addTo(this.map);

                    L.control.zoom({ position: 'bottomright' }).addTo(this.map);

                    this.renderMarkers();

                    setTimeout(() => {
                        this.map.invalidateSize();
                    }, 300);
                },

                renderMarkers() {
                    // Bersihkan marker lama
                    if (this.createdMarkers && this.createdMarkers.length > 0) {
                        this.createdMarkers.forEach(m => {
                            if (m && typeof m.remove === 'function') m.remove();
                        });
                    }
                    this.createdMarkers = [];

                    const bounds = L.latLngBounds([]);

                    this.markersData.forEach((item) => {
                        if (!item.lat || !item.lng) return;

                        let popup = '';
                        let marker = null;

                        if (item.type === 'ambulans') {
                            popup = `
                                <div class="font-sans min-w-[190px] p-0.5">
                                    <div class="border-b border-slate-100 pb-1 mb-1.5 flex items-center justify-between">
                                        <h4 class="font-bold text-slate-900 text-xs">Ambulans ${item.kode}</h4>
                                        <span class="text-[10px] font-bold text-cyan-700 bg-cyan-50 px-1.5 py-0.5 rounded">${item.status}</span>
                                    </div>
                                    <div class="text-[11px] text-slate-600 space-y-0.5">
                                        <p>Supir: <span class="font-semibold text-slate-800">${item.supir}</span></p>
                                        <p>Pasien: <span class="font-semibold text-slate-800">${item.pasien}</span></p>
                                    </div>
                                </div>
                            `;
                            
                            if (typeof window.createLeafletAmbulance3DMarker === 'function') {
                                marker = window.createLeafletAmbulance3DMarker(this.map, item.lat, item.lng, {
                                    size: 48,
                                    autoSpin: false
                                });
                                marker.bindPopup(popup, { className: 'enterprise-popup', closeButton: false });
                            } else {
                                const ambIcon = L.divIcon({
                                    className: 'custom-amb-icon',
                                    html: `<div style="background:#0891b2; width:30px; height:30px; border-radius:50%; border:2px solid white; box-shadow:0 2px 6px rgba(8,145,178,0.4); display:flex; align-items:center; justify-content:center; font-size:14px;">🚑</div>`,
                                    iconSize: [30, 30],
                                    iconAnchor: [15, 15]
                                });
                                marker = L.marker([item.lat, item.lng], { icon: ambIcon }).addTo(this.map).bindPopup(popup);
                            }
                        } else {
                            const isDarurat = (item.type === 'darurat');
                            popup = `
                                <div class="font-sans min-w-[200px] p-0.5">
                                    <div class="border-b border-slate-100 pb-1 mb-1.5 flex items-center justify-between">
                                        <h4 class="font-bold text-slate-900 text-xs">${isDarurat ? 'Panggilan Darurat' : 'Titik Jemput'}</h4>
                                        <span class="text-[10px] font-bold ${isDarurat ? 'text-rose-700 bg-rose-50' : 'text-sky-700 bg-sky-50'} px-1.5 py-0.5 rounded">Pasien</span>
                                    </div>
                                    <div class="text-[11px] text-slate-600 space-y-0.5">
                                        <p>Nama: <span class="font-bold text-slate-800">${item.pasien}</span></p>
                                        <p class="truncate" title="${item.lokasi}">Lokasi: <span>${item.lokasi}</span></p>
                                    </div>
                                </div>
                            `;

                            const patientIcon = (typeof window.getPatientPin3DIcon === 'function')
                                ? window.getPatientPin3DIcon({ size: 28 })
                                : L.divIcon({
                                    className: 'custom-jemput-icon',
                                    html: `<div style="background:#ef4444; width:26px; height:26px; border-radius:50%; border:2px solid white; box-shadow:0 2px 6px rgba(239,68,68,0.4); display:flex; align-items:center; justify-content:center; font-size:12px;">📍</div>`,
                                    iconSize: [26, 26],
                                    iconAnchor: [13, 26]
                                });

                            marker = L.marker([item.lat, item.lng], { icon: patientIcon, zIndexOffset: 1000 }).addTo(this.map).bindPopup(popup);
                        }

                        if (marker) {
                            this.createdMarkers.push(marker);
                        }
                        bounds.extend([item.lat, item.lng]);
                    });

                    if (bounds.isValid() && this.markersData.length > 0) {
                        this.map.fitBounds(bounds, { padding: [40, 40] });
                    }
                },

                fitAll() {
                    this.renderMarkers();
                },

                updateMarkers(newMarkers) {
                    this.markersData = newMarkers;
                    this.renderMarkers();
                }
            }
        }

        document.addEventListener('alpine:init', () => {
            Alpine.data('assignMapAlpine', (orderData, driversData) => ({
                map: null,
                init() {
                    setTimeout(() => {
                        if (!this.$refs.mapContainer) return;
                        
                        this.map = L.map(this.$refs.mapContainer, { zoomControl: false }).setView([orderData.lat, orderData.lng], 13);
                        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                            attribution: '&copy; OpenStreetMap contributors',
                            maxZoom: 19
                        }).addTo(this.map);

                        const bounds = L.latLngBounds([]);

                        // Titik Pasien 3D (Merah)
                        const patientIcon = (typeof window.getPatientPin3DIcon === 'function')
                            ? window.getPatientPin3DIcon({ size: 28 })
                            : L.divIcon({
                                className: 'custom-patient-icon',
                                html: `<div style="background:#ef4444; width:26px; height:26px; border-radius:50%; border:2px solid white; display:flex; align-items:center; justify-content:center; font-size:12px;">📍</div>`,
                                iconSize: [26, 26],
                                iconAnchor: [13, 26]
                            });

                        L.marker([orderData.lat, orderData.lng], { icon: patientIcon, zIndexOffset: 1000 })
                            .addTo(this.map)
                            .bindPopup(`<b class="text-xs">Lokasi Pasien:</b><br><span class="text-xs">${orderData.nama}</span>`)
                            .openPopup();

                        bounds.extend([orderData.lat, orderData.lng]);

                        // Titik Armada Siaga (Cyan)
                        driversData.forEach(d => {
                            if (!d.lat || !d.lng) return;

                            let ambMarker;
                            if (typeof window.createLeafletAmbulance3DMarker === 'function') {
                                ambMarker = window.createLeafletAmbulance3DMarker(this.map, d.lat, d.lng, { size: 44, autoSpin: false });
                            } else {
                                const driverIcon = L.divIcon({
                                    className: 'custom-driver-icon',
                                    html: `<div style="background:#0891b2; width:28px; height:28px; border-radius:50%; border:2px solid white; display:flex; align-items:center; justify-content:center; font-size:12px; cursor:pointer;">🚑</div>`,
                                    iconSize: [28, 28],
                                    iconAnchor: [14, 14]
                                });
                                ambMarker = L.marker([d.lat, d.lng], { icon: driverIcon }).addTo(this.map);
                            }

                            ambMarker.bindPopup(`
                                <div class="font-sans p-0.5 text-xs">
                                    <div class="font-bold text-slate-800">${d.nama}</div>
                                    <div class="text-[11px] text-slate-500">${d.kode_ambulans}</div>
                                    <button onclick="window.dispatchEvent(new CustomEvent('select-driver', { detail: { supir: ${d.id}, amb: ${d.ambulans_id || 'null'} } }))" 
                                            class="mt-2 w-full px-2 py-1 bg-cyan-600 text-white rounded text-[11px] font-bold">
                                        Pilih Supir Ini
                                    </button>
                                </div>
                            `);

                            bounds.extend([d.lat, d.lng]);
                        });

                        if (bounds.isValid()) {
                            this.map.fitBounds(bounds, { padding: [30, 30] });
                        }

                        setTimeout(() => { this.map.invalidateSize(); }, 250);
                    }, 200);
                }
            }));
        });
    </script>
</div>
