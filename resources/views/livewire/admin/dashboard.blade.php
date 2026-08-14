<div>
    <!-- Header Page -->
    <div class="mb-8 flex flex-col gap-1">
        <h1 class="text-[28px] font-bold text-slate-900 tracking-tight">Dashboard</h1>
        <p class="text-[15px] text-slate-500 font-medium">Selamat datang kembali. Pantau seluruh aktivitas Ambulance Siaga dari satu tempat.</p>
    </div>

    <!-- 5 KPI Summary Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4 mb-8">
        
        <!-- Ambulans Aktif -->
        <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm flex flex-col justify-between">
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
        <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm flex flex-col justify-between">
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
        <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm flex flex-col justify-between">
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
        <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm flex flex-col justify-between">
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
        <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm flex flex-col justify-between">
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
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm mb-8 overflow-hidden">
        <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between">
            <h2 class="text-[16px] font-bold text-slate-800">Monitoring Ambulans Real-Time</h2>
            <div class="flex items-center gap-4 text-xs font-medium">
                <div class="flex items-center gap-1.5 text-emerald-600"><span class="w-2.5 h-2.5 rounded-full bg-emerald-500"></span> Available</div>
                <div class="flex items-center gap-1.5 text-amber-600"><span class="w-2.5 h-2.5 rounded-full bg-amber-500"></span> On Duty</div>
                <div class="flex items-center gap-1.5 text-red-600"><span class="w-2.5 h-2.5 rounded-full bg-red-500"></span> Emergency</div>
                <div class="flex items-center gap-1.5 text-slate-400"><span class="w-2.5 h-2.5 rounded-full border-2 border-slate-400"></span> Offline</div>
            </div>
        </div>
        <div class="relative h-[450px] w-full z-0 bg-slate-50" wire:ignore>
            <div id="liveAmbulanceMap" class="absolute inset-0"></div>
        </div>
    </div>

    <!-- Recent Orders Table -->
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
        <div class="px-6 py-5 border-b border-slate-100 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <h2 class="text-[16px] font-bold text-slate-800">Permintaan Layanan Terbaru</h2>
            <div class="flex items-center gap-3">
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-4 w-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    </div>
                    <input type="text" placeholder="Cari layanan..." class="pl-9 pr-4 py-2 border border-slate-200 rounded-lg text-sm focus:border-[#2563EB] focus:ring-1 focus:ring-[#2563EB] outline-none">
                </div>
                <a href="{{ route('admin.orders.index') }}" class="px-4 py-2 border border-slate-200 rounded-lg text-sm font-semibold text-slate-600 hover:bg-slate-50 transition-colors">
                    Lihat Semua
                </a>
            </div>
        </div>
        
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50 text-slate-500 text-[11px] uppercase tracking-wider border-b border-slate-200">
                        <th class="px-6 py-4 font-semibold">ID Layanan & Waktu</th>
                        <th class="px-6 py-4 font-semibold">Nama Pengguna</th>
                        <th class="px-6 py-4 font-semibold">Lokasi Jemput</th>
                        <th class="px-6 py-4 font-semibold">Ambulans & Driver</th>
                        <th class="px-6 py-4 font-semibold">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-sm">
                    @forelse($recentOrders as $order)
                        <tr class="hover:bg-slate-50/50 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="font-bold text-[#2563EB] block">{{ $order->kode_order }}</span>
                                <span class="text-xs text-slate-500">{{ $order->created_at->format('d M Y, H:i') }}</span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="font-semibold text-slate-800">{{ $order->nama_pasien }}</span>
                                <span class="block text-xs text-slate-500 mt-0.5">{{ $order->no_telp }}</span>
                            </td>
                            <td class="px-6 py-4">
                                <p class="text-slate-700 max-w-[200px] truncate" title="{{ $order->lokasi_jemput }}">{{ $order->lokasi_jemput }}</p>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($order->ambulans)
                                    <span class="font-semibold text-slate-800 block">{{ $order->ambulans->kode_ambulans }}</span>
                                    <span class="text-xs text-slate-500">{{ $order->supir->user->name ?? 'Tanpa Driver' }}</span>
                                @else
                                    <span class="text-slate-400 italic text-xs">Belum ditugaskan</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($order->status === 'menunggu')
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-md text-[11px] font-bold bg-[#F59E0B]/10 text-[#F59E0B]">Menunggu</span>
                                @elseif(in_array($order->status, ['diproses', 'menuju_lokasi', 'membawa_pasien', 'menunggu_konfirmasi_supir']))
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-md text-[11px] font-bold bg-[#2563EB]/10 text-[#2563EB]">Diproses</span>
                                @elseif($order->status === 'selesai')
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-md text-[11px] font-bold bg-[#16A34A]/10 text-[#16A34A]">Selesai</span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-md text-[11px] font-bold bg-[#DC2626]/10 text-[#DC2626]">Dibatalkan</span>
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
                scrollWheelZoom: false // Enterprise standard: map scroll is usually disabled to not interfere with page scroll
            }).setView([-7.7188, 109.0156], 12); // Default Cilacap

            L.tileLayer('https://{s}.basemaps.cartocdn.com/rastertiles/voyager/{z}/{x}/{y}{r}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OSM</a> contributors',
                maxZoom: 19
            }).addTo(map);
            
            L.control.zoom({ position: 'bottomright' }).addTo(map);

            const driversData = @json($activeDrivers);
            const markers = [];

            // Custom Icon Generation
            const getIcon = (status) => {
                let colorClass = 'custom-green-icon'; // Available
                if (status === 'Emergency') colorClass = 'custom-red-icon';
                if (status === 'On Duty') colorClass = 'custom-yellow-icon';
                if (status === 'Offline') colorClass = ''; // Default/grayish

                return L.icon({
                    iconUrl: 'https://unpkg.com/leaflet@1.9.4/dist/images/marker-icon.png',
                    shadowUrl: 'https://unpkg.com/leaflet@1.9.4/dist/images/marker-shadow.png',
                    iconSize: [25, 41],
                    iconAnchor: [12, 41],
                    popupAnchor: [1, -34],
                    className: colorClass
                });
            };

            // Add markers
            driversData.forEach(driver => {
                if (driver.lat && driver.lng) {
                    const statusColor = 
                        driver.status === 'Emergency' ? 'text-red-600 font-bold' : 
                        (driver.status === 'On Duty' ? 'text-amber-600 font-bold' : 
                        (driver.status === 'Available' ? 'text-emerald-600 font-bold' : 'text-slate-500'));

                    const popupContent = `
                        <div class="font-sans min-w-[200px]">
                            <h4 class="font-bold text-slate-800 text-sm border-b pb-1 mb-2">Ambulans ${driver.plat_nomor}</h4>
                            <div class="text-xs space-y-1.5">
                                <p><span class="text-slate-500">Driver:</span> <span class="font-semibold text-slate-700">${driver.name}</span></p>
                                <p><span class="text-slate-500">Status:</span> <span class="${statusColor}">${driver.status}</span></p>
                                <p><span class="text-slate-500">Tujuan:</span> <span class="font-medium text-slate-700 truncate block max-w-full" title="${driver.destination}">${driver.destination}</span></p>
                            </div>
                        </div>
                    `;

                    const marker = L.marker([driver.lat, driver.lng], { icon: getIcon(driver.status) })
                        .addTo(map)
                        .bindPopup(popupContent, {
                            className: 'enterprise-popup',
                            closeButton: false
                        });
                    
                    markers.push(marker);
                }
            });

            // Adjust view to fit all markers if any exist
            if (markers.length > 0) {
                const group = new L.featureGroup(markers);
                map.fitBounds(group.getBounds().pad(0.1));
            }
            
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
