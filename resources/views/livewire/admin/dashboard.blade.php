<div>
    <!-- Header Page -->
    <div class="mb-8 flex flex-col gap-1">
        <h1 class="text-[28px] font-bold text-slate-900 tracking-tight">Dashboard</h1>
        <p class="text-[15px] text-slate-500 font-medium">Selamat datang kembali. Pantau seluruh aktivitas Ambulans Siaga dari satu tempat.</p>
    </div>

    <!-- 5 KPI Summary Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4 mb-8">
        
        <!-- Ambulans Aktif -->
        <div class="bg-white p-5 rounded-xl border border-slate-200 shadow-sm flex flex-col justify-between">
            <div class="flex items-center justify-between mb-3">
                <span class="text-[13px] font-semibold text-slate-500">Total Ambulans</span>
                <div class="w-8 h-8 rounded-full bg-slate-50 text-slate-400 flex items-center justify-center">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                </div>
            </div>
            <div>
                <h3 class="text-2xl font-bold text-slate-800">{{ $stats['total_ambulans'] }}</h3>
                <p class="text-xs text-emerald-600 font-medium mt-1 flex items-center gap-1">
                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> Siap Beroperasi
                </p>
            </div>
        </div>

        <!-- Driver Aktif -->
        <div class="bg-white p-5 rounded-xl border border-slate-200 shadow-sm flex flex-col justify-between">
            <div class="flex items-center justify-between mb-3">
                <span class="text-[13px] font-semibold text-slate-500">Driver Aktif</span>
                <div class="w-8 h-8 rounded-full bg-emerald-50 text-emerald-600 flex items-center justify-center">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                </div>
            </div>
            <div>
                <h3 class="text-2xl font-bold text-slate-800">{{ $stats['supir_aktif'] }}</h3>
                <p class="text-xs text-emerald-600 font-medium mt-1 flex items-center gap-1">
                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span> Online saat ini
                </p>
            </div>
        </div>

        <!-- Permintaan Hari Ini -->
        <div class="bg-white p-5 rounded-xl border border-slate-200 shadow-sm flex flex-col justify-between">
            <div class="flex items-center justify-between mb-3">
                <span class="text-[13px] font-semibold text-slate-500">Total Permintaan</span>
                <div class="w-8 h-8 rounded-full bg-[#2563EB]/10 text-[#2563EB] flex items-center justify-center">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                </div>
            </div>
            <div>
                <h3 class="text-2xl font-bold text-slate-800">{{ $stats['total_order'] }}</h3>
                <p class="text-xs text-amber-600 font-medium mt-1 flex items-center gap-1">
                    {{ $stats['order_darurat'] }} menunggu respons
                </p>
            </div>
        </div>

        <!-- RS Mitra -->
        <div class="bg-white p-5 rounded-xl border border-slate-200 shadow-sm flex flex-col justify-between">
            <div class="flex items-center justify-between mb-3">
                <span class="text-[13px] font-semibold text-slate-500">RS Rujukan</span>
                <div class="w-8 h-8 rounded-full bg-rose-50 text-rose-600 flex items-center justify-center">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                </div>
            </div>
            <div>
                <h3 class="text-2xl font-bold text-slate-800">{{ $stats['total_rs'] }}</h3>
                <p class="text-xs text-slate-400 font-medium mt-1 flex items-center gap-1">
                    Wilayah kerja aktif
                </p>
            </div>
        </div>

        <!-- Donasi Masuk -->
        <div class="bg-white p-5 rounded-xl border border-slate-200 shadow-sm flex flex-col justify-between">
            <div class="flex items-center justify-between mb-3">
                <span class="text-[13px] font-semibold text-slate-500">Donasi Masuk</span>
                <div class="w-8 h-8 rounded-full bg-emerald-50 text-emerald-600 flex items-center justify-center">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
            </div>
            <div>
                <h3 class="text-xl font-bold text-slate-800">Rp {{ number_format($stats['total_donasi'], 0, ',', '.') }}</h3>
                <p class="text-xs text-slate-400 font-medium mt-1 flex items-center gap-1">
                    Total terhimpun
                </p>
            </div>
        </div>

    </div>

    <!-- Live Monitoring Map -->
    <div class="bg-white rounded-xl border border-slate-200 shadow-sm mb-8 relative z-10">
        <div class="px-6 py-3.5 border-b border-slate-100 flex flex-col md:flex-row md:items-center justify-between gap-3 relative z-20">
            <div class="flex items-center gap-3">
                <h2 class="text-[16px] font-bold text-slate-800 whitespace-nowrap">Monitoring Ambulans Real-Time</h2>
            </div>
            
            <div class="flex flex-wrap items-center gap-3">
                <!-- Search & Quick Focus Ambulans (Efisien & Minimalis) -->
                <div x-data="{
                    search: '',
                    open: false,
                    selectedId: null,
                    drivers: @js($activeDrivers),
                    get filteredDrivers() {
                        if (!this.search.trim()) return this.drivers;
                        const q = this.search.toLowerCase();
                        return this.drivers.filter(d => 
                            (d.plat_nomor && d.plat_nomor.toLowerCase().includes(q)) ||
                            (d.name && d.name.toLowerCase().includes(q)) ||
                            (d.status && d.status.toLowerCase().includes(q))
                        );
                    },
                    focusAmbulance(driver) {
                        this.selectedId = driver.id;
                        this.search = driver.plat_nomor + ' (' + driver.name + ')';
                        this.open = false;
                        if (window.liveAmbulanceMapFocus) {
                            window.liveAmbulanceMapFocus(driver.id);
                        }
                    },
                    resetView() {
                        this.selectedId = null;
                        this.search = '';
                        this.open = false;
                        if (window.liveAmbulanceMapReset) {
                            window.liveAmbulanceMapReset();
                        }
                    }
                }" class="relative flex items-center gap-1.5" @click.outside="open = false">
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-2.5 flex items-center pointer-events-none text-slate-400">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                        </div>
                        <input 
                            type="text" 
                            x-model="search" 
                            @focus="open = true" 
                            @input="open = true"
                            @keydown.escape="open = false"
                            placeholder="Cari plat / driver..." 
                            class="h-8.5 w-44 sm:w-56 pl-8 pr-7 text-xs bg-slate-50 hover:bg-white focus:bg-white border border-slate-200 rounded-lg focus:outline-none focus:ring-1 focus:ring-cyan-500 focus:border-cyan-500 text-slate-700 placeholder:text-slate-400 transition-all shadow-xs"
                        >
                        <!-- Clear button -->
                        <button 
                            type="button" 
                            x-show="search.length > 0" 
                            @click="resetView()" 
                            class="absolute inset-y-0 right-0 pr-2 flex items-center text-slate-400 hover:text-slate-600"
                            title="Hapus pencarian"
                            style="display: none;"
                        >
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                        </button>
                    </div>

                    <!-- Tombol Reset Tampilan Peta -->
                    <button 
                        type="button" 
                        @click="resetView()" 
                        title="Tampilkan semua ambulans"
                        class="h-8.5 px-2.5 bg-slate-50 hover:bg-slate-100 text-slate-600 hover:text-cyan-700 border border-slate-200 rounded-lg text-xs font-medium flex items-center gap-1.5 transition-colors shadow-xs"
                    >
                        <svg class="w-3.5 h-3.5 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4"/>
                        </svg>
                        <span class="hidden sm:inline">Reset</span>
                    </button>

                    <!-- Dropdown Results -->
                    <div 
                        x-show="open" 
                        x-transition:enter="transition ease-out duration-100"
                        x-transition:enter-start="opacity-0 scale-95"
                        x-transition:enter-end="opacity-100 scale-100"
                        x-transition:leave="transition ease-in duration-75"
                        x-transition:leave-start="opacity-100 scale-100"
                        x-transition:leave-end="opacity-0 scale-95"
                        class="absolute left-0 top-full mt-1.5 w-64 sm:w-72 bg-white border border-slate-200 rounded-lg shadow-xl z-50 overflow-hidden divide-y divide-slate-100 text-xs"
                        style="display: none;"
                    >
                        <div class="px-3 py-1.5 bg-slate-50 text-[11px] font-semibold text-slate-500 flex justify-between items-center">
                            <span>Fokus ke Unit Ambulans</span>
                            <span class="text-slate-400 font-normal" x-text="filteredDrivers.length + ' unit aktif'"></span>
                        </div>
                        <div class="max-h-56 overflow-y-auto divide-y divide-slate-50">
                            <template x-for="driver in filteredDrivers" :key="driver.id">
                                <button 
                                    type="button" 
                                    @click="focusAmbulance(driver)" 
                                    class="w-full text-left px-3 py-2 hover:bg-cyan-50/70 transition-colors flex items-center justify-between gap-2 group"
                                    :class="{ 'bg-cyan-50/50': selectedId === driver.id }"
                                >
                                    <div class="min-w-0 flex-1">
                                        <div class="flex items-center gap-1.5">
                                            <span class="font-bold text-slate-800 group-hover:text-cyan-700" x-text="driver.plat_nomor"></span>
                                            <span 
                                                class="inline-block w-2 h-2 rounded-full"
                                                :class="{
                                                    'bg-emerald-500': driver.status === 'Available',
                                                    'bg-amber-500': driver.status === 'On Duty',
                                                    'bg-rose-500': driver.status === 'Emergency',
                                                    'bg-slate-400': driver.status === 'Offline'
                                                }"
                                            ></span>
                                        </div>
                                        <div class="text-[11px] text-slate-500 truncate" x-text="'Driver: ' + driver.name"></div>
                                    </div>
                                    <div class="text-right shrink-0">
                                        <span 
                                            class="px-1.5 py-0.5 rounded text-[10px] font-bold"
                                            :class="{
                                                'bg-emerald-50 text-emerald-700': driver.status === 'Available',
                                                'bg-amber-50 text-amber-700': driver.status === 'On Duty',
                                                'bg-rose-50 text-rose-700': driver.status === 'Emergency',
                                                'bg-slate-100 text-slate-600': driver.status === 'Offline'
                                            }"
                                            x-text="driver.status"
                                        ></span>
                                    </div>
                                </button>
                            </template>
                            <template x-if="filteredDrivers.length === 0">
                                <div class="px-4 py-3 text-center text-slate-400 text-xs">
                                    Ambulans tidak ditemukan
                                </div>
                            </template>
                        </div>
                    </div>
                </div>

                <!-- Status Legend Pills -->
                <div class="hidden lg:flex items-center gap-3.5 text-xs font-medium pl-3 border-l border-slate-200">
                    <div class="flex items-center gap-1.5 text-emerald-600"><span class="w-2.5 h-2.5 rounded-full bg-emerald-500"></span> Available</div>
                    <div class="flex items-center gap-1.5 text-amber-600"><span class="w-2.5 h-2.5 rounded-full bg-amber-500"></span> On Duty</div>
                    <div class="flex items-center gap-1.5 text-red-600"><span class="w-2.5 h-2.5 rounded-full bg-red-500"></span> Emergency</div>
                    <div class="flex items-center gap-1.5 text-slate-400"><span class="w-2.5 h-2.5 rounded-full border-2 border-slate-400"></span> Offline</div>
                </div>
            </div>
        </div>

        <div class="relative h-[450px] w-full z-0 bg-slate-50 overflow-hidden" wire:ignore>
            <div id="liveAmbulanceMap" class="absolute inset-0"></div>
        </div>

        <!-- Legend Bar Standar -->
        <div class="border-t border-slate-100 bg-slate-50/80 p-3.5 px-6 flex flex-wrap items-center justify-between gap-3 text-xs text-slate-600 rounded-b-xl">
            <div class="flex flex-wrap items-center gap-5">
                <div class="flex items-center gap-2">
                    <span class="relative flex h-2.5 w-2.5">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-cyan-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-cyan-600"></span>
                    </span>
                    <span class="font-bold text-slate-800">Ambulans Siaga</span>
                </div>
                <div class="flex items-center gap-2">
                    <span class="w-2.5 h-2.5 rounded-full bg-emerald-500"></span>
                    <span class="font-bold text-slate-700">Tersedia (Ready)</span>
                </div>
                <div class="flex items-center gap-2">
                    <span class="w-2.5 h-2.5 rounded-full bg-amber-500"></span>
                    <span class="font-bold text-slate-700">Dalam Tugas (On Duty)</span>
                </div>
                <div class="flex items-center gap-2">
                    <span class="w-2.5 h-2.5 rounded-full bg-rose-500"></span>
                    <span class="font-bold text-slate-700">Panggilan Darurat</span>
                </div>
            </div>
            <div class="flex items-center gap-2 text-slate-500 font-medium">
                <span>🛰️ Satelit OSRM & GPS Realtime</span>
            </div>
        </div>
    </div>

    <!-- Recent Orders Table -->
    <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
        <div class="px-6 py-5 border-b border-slate-100 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <h2 class="text-[16px] font-bold text-slate-800">Permintaan Layanan Terbaru</h2>
            <div class="flex items-center gap-3">
                <input type="text" placeholder="Cari layanan..." class="px-3.5 py-2 border border-slate-200 rounded-lg text-sm focus:border-primary-500 focus:ring-1 focus:ring-primary-500 outline-none">
                <a href="{{ route('admin.orders.index') }}" class="px-4 py-2 border border-slate-200 rounded-lg text-sm font-semibold text-slate-600 hover:bg-slate-50 transition-colors">
                    Lihat Semua
                </a>
            </div>
        </div>
        
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50 text-slate-500 text-[11px] uppercase tracking-wider border-b border-slate-200">
                        <th class="px-5 py-3 font-semibold whitespace-nowrap">ID Layanan & Waktu</th>
                        <th class="px-5 py-3 font-semibold whitespace-nowrap">Nama Pengguna</th>
                        <th class="px-5 py-3 font-semibold whitespace-nowrap">Lokasi Jemput</th>
                        <th class="px-5 py-3 font-semibold whitespace-nowrap">Ambulans & Driver</th>
                        <th class="px-5 py-3 font-semibold whitespace-nowrap">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-xs">
                    @forelse($recentOrders as $order)
                        <tr class="hover:bg-slate-50/50 transition-colors">
                            <td class="px-5 py-3 whitespace-nowrap">
                                <span class="font-bold text-sky-600 font-mono text-xs block">{{ $order->kode_order }}</span>
                                <span class="text-[11px] text-slate-400 block mt-0.5">{{ $order->created_at->format('d M Y, H:i') }}</span>
                            </td>
                            <td class="px-5 py-3">
                                <span class="font-semibold text-slate-800 text-xs block truncate max-w-[160px]">{{ $order->nama_pasien }}</span>
                                <span class="block text-[11px] text-slate-400 mt-0.5">{{ $order->no_telp }}</span>
                            </td>
                            <td class="px-5 py-3">
                                <p class="text-slate-600 text-xs max-w-[200px] truncate" title="{{ $order->lokasi_jemput }}">{{ $order->lokasi_jemput }}</p>
                            </td>
                            <td class="px-5 py-3 whitespace-nowrap">
                                @if($order->ambulans)
                                    <span class="font-semibold text-slate-800 text-xs block">{{ $order->ambulans->kode_ambulans }}</span>
                                    <span class="text-[11px] text-slate-500 block mt-0.5">{{ $order->supir->user->name ?? 'Tanpa Driver' }}</span>
                                @else
                                    <span class="text-slate-400 italic text-[11px]">Belum ditugaskan</span>
                                @endif
                            </td>
                            <td class="px-5 py-3 whitespace-nowrap">
                                @if($order->status === 'menunggu')
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-md text-[11px] font-bold bg-[#F59E0B]/10 text-[#F59E0B]">Menunggu</span>
                                @elseif(in_array($order->status, ['diproses', 'menuju_lokasi', 'membawa_pasien', 'menunggu_konfirmasi_supir']))
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-md text-[11px] font-bold bg-[#2563EB]/10 text-[#2563EB]">Diproses</span>
                                @elseif($order->status === 'selesai')
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-md text-[11px] font-bold bg-[#16A34A]/10 text-[#16A34A]">Selesai</span>
                                @else
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-md text-[11px] font-bold bg-[#DC2626]/10 text-[#DC2626]">Dibatalkan</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center">
                                <p class="text-slate-500 text-sm">Belum ada permintaan layanan yang masuk.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @push('scripts')
    <script>
        document.addEventListener('livewire:initialized', () => {
            // Leaflet Map Initialization
            const map = L.map('liveAmbulanceMap', {
                zoomControl: false,
                scrollWheelZoom: true
            }).setView([-7.7188, 109.0156], 12); // Default Cilacap

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
                maxZoom: 19
            }).addTo(map);
            
            L.control.zoom({ position: 'bottomright' }).addTo(map);

            const driversData = @json($activeDrivers);
            const markers = [];
            window.driverMarkersMap = {};

            // Add markers with 3D Real Engine
            driversData.forEach(driver => {
                if (driver.lat && driver.lng) {
                    const statusBadgeClass = 
                        driver.status === 'Emergency' ? 'bg-rose-100 text-rose-800' : 
                        (driver.status === 'On Duty' ? 'bg-amber-100 text-amber-800' : 
                        (driver.status === 'Available' ? 'bg-emerald-100 text-emerald-800' : 'bg-slate-100 text-slate-700'));

                    const popupContent = `
                        <div class="font-sans min-w-[210px] p-0.5">
                            <div class="flex items-center justify-between gap-2 border-b border-slate-100 pb-1.5 mb-2">
                                <h4 class="font-bold text-slate-900 text-sm">Ambulans ${driver.plat_nomor}</h4>
                                <span class="px-2 py-0.5 rounded-full text-[10px] font-extrabold ${statusBadgeClass}">${driver.status}</span>
                            </div>
                            <div class="text-xs space-y-1.5 text-slate-600">
                                <p><span class="text-slate-400">Driver:</span> <span class="font-bold text-slate-800">${driver.name}</span></p>
                                <p><span class="text-slate-400">Tujuan:</span> <span class="font-medium text-slate-700 truncate block max-w-full" title="${driver.destination}">${driver.destination}</span></p>
                            </div>
                        </div>
                    `;

                    let marker;
                    if (typeof window.createLeafletAmbulance3DMarker === 'function') {
                        marker = window.createLeafletAmbulance3DMarker(map, driver.lat, driver.lng, {
                            size: 54,
                            autoSpin: false
                        });
                        marker.bindPopup(popupContent, {
                            className: 'enterprise-popup',
                            closeButton: false
                        });
                    } else {
                        marker = L.marker([driver.lat, driver.lng])
                            .addTo(map)
                            .bindPopup(popupContent, {
                                className: 'enterprise-popup',
                                closeButton: false
                            });
                    }
                    
                    markers.push(marker);
                    window.driverMarkersMap[driver.id] = marker;
                }
            });

            // Adjust view to fit all markers if any exist
            let allMarkersGroup = null;
            if (markers.length > 0) {
                allMarkersGroup = new L.featureGroup(markers);
                map.fitBounds(allMarkersGroup.getBounds().pad(0.1));
            }

            // Global focus function for search control
            window.liveAmbulanceMapFocus = function(driverId) {
                const driver = driversData.find(d => d.id === driverId);
                if (!driver || !map) return;

                map.flyTo([driver.lat, driver.lng], 16, {
                    animate: true,
                    duration: 1.0
                });

                setTimeout(() => {
                    const marker = window.driverMarkersMap[driverId];
                    if (marker && typeof marker.openPopup === 'function') {
                        marker.openPopup();
                    }
                }, 750);
            };

            // Global reset function
            window.liveAmbulanceMapReset = function() {
                if (!map) return;
                map.closePopup();
                if (markers.length > 0 && allMarkersGroup) {
                    map.fitBounds(allMarkersGroup.getBounds().pad(0.1), {
                        animate: true,
                        duration: 1.0
                    });
                } else {
                    map.flyTo([-7.7188, 109.0156], 12);
                }
            };
            
            // Re-render map tiles correctly if modal/div size changes
            setTimeout(() => { map.invalidateSize(); }, 500);
        });
    </script>
    <style>
        .enterprise-popup .leaflet-popup-content-wrapper {
            border-radius: 12px;
            box-shadow: 0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -4px rgb(0 0 0 / 0.1);
            padding: 4px;
        }
        .enterprise-popup .leaflet-popup-content { margin: 10px 12px; }
        .enterprise-popup .leaflet-popup-tip { box-shadow: none; }
    </style>
    @endpush
</div>
