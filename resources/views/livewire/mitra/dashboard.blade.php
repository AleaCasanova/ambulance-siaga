<div>
    <!-- Header Banner Mitra -->
    <div class="mb-8 p-6 sm:p-8 rounded-3xl bg-gradient-to-r from-primary-700 via-primary-800 to-slate-900 text-white shadow-xl relative overflow-hidden">
        <div class="absolute right-0 top-0 translate-x-10 -translate-y-10 w-80 h-80 bg-white/5 rounded-full blur-3xl pointer-events-none"></div>
        
        <div class="relative z-10 flex flex-col md:flex-row md:items-center md:justify-between gap-6">
            <div class="flex items-center gap-5">
                <div class="w-16 h-16 rounded-2xl bg-white/10 backdrop-blur border border-white/20 flex items-center justify-center text-white text-2xl font-black shrink-0 shadow-inner">
                    🏛️
                </div>
                <div>
                    <div class="flex items-center gap-2 mb-1">
                        <span class="px-2.5 py-0.5 rounded-full text-[10px] font-extrabold uppercase tracking-wider bg-emerald-500/20 text-emerald-300 border border-emerald-500/30">
                            Mitra Resmi Terverifikasi
                        </span>
                        <span class="text-xs text-white/60 font-medium">• Siaga 24 Jam</span>
                    </div>
                    <h1 class="text-2xl sm:text-3xl font-black tracking-tight text-white">
                        {{ $mitra ? $mitra->nama_mitra : 'Portal Mitra Ambulans' }}
                    </h1>
                    <p class="text-xs sm:text-sm text-primary-100/90 mt-1 font-medium flex items-center gap-3">
                        <span>👤 PJ: <strong class="text-white">{{ $mitra->penanggung_jawab ?? '-' }}</strong></span>
                        <span>📞 Telp: <strong class="text-white">{{ $mitra->no_telp ?? '-' }}</strong></span>
                    </p>
                </div>
            </div>

            <div class="flex items-center gap-3">
                <a href="{{ route('mitra.ambulans.index') }}" 
                   class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-white text-primary-800 font-bold text-sm shadow-lg hover:bg-primary-50 transition-all hover:scale-105">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/></svg>
                    <span>Tambah Armada</span>
                </a>
                <a href="{{ route('mitra.supir.index') }}" 
                   class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-white/10 backdrop-blur border border-white/20 text-white font-bold text-sm hover:bg-white/20 transition-all">
                    <span>Kelola Driver</span>
                </a>
            </div>
        </div>
    </div>

    <!-- 4 Top Metric Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 mb-8">
        <!-- Card 1: Total Armada -->
        <div class="p-6 rounded-3xl bg-white border border-slate-200/80 shadow-xs flex items-center justify-between group hover:border-primary-300 transition-all">
            <div>
                <span class="text-xs font-bold text-slate-400 uppercase tracking-wider block mb-1">Armada Lembaga</span>
                <div class="flex items-baseline gap-2">
                    <span class="text-3xl font-black text-slate-900">{{ $totalAmbulans }}</span>
                    <span class="text-xs font-semibold text-emerald-600">({{ $ambulansTersedia }} Siaga)</span>
                </div>
                <span class="text-[11px] text-slate-500 mt-1 block">{{ $ambulansBertugas }} bertugas, {{ $ambulansPerawatan }} servis</span>
            </div>
            <div class="w-12 h-12 rounded-2xl bg-sky-50 text-sky-600 flex items-center justify-center shrink-0 group-hover:scale-110 transition-transform">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
            </div>
        </div>

        <!-- Card 2: Driver Lembaga -->
        <div class="p-6 rounded-3xl bg-white border border-slate-200/80 shadow-xs flex items-center justify-between group hover:border-primary-300 transition-all">
            <div>
                <span class="text-xs font-bold text-slate-400 uppercase tracking-wider block mb-1">Driver Resmi</span>
                <div class="flex items-baseline gap-2">
                    <span class="text-3xl font-black text-slate-900">{{ $totalSupir }}</span>
                    <span class="text-xs font-semibold text-emerald-600">({{ $supirOnline }} Online)</span>
                </div>
                <span class="text-[11px] text-slate-500 mt-1 block">Tersertifikasi & Siap Bertugas</span>
            </div>
            <div class="w-12 h-12 rounded-2xl bg-emerald-50 text-emerald-600 flex items-center justify-center shrink-0 group-hover:scale-110 transition-transform">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
            </div>
        </div>

        <!-- Card 3: Misi Bulan Ini -->
        <div class="p-6 rounded-3xl bg-white border border-slate-200/80 shadow-xs flex items-center justify-between group hover:border-primary-300 transition-all">
            <div>
                <span class="text-xs font-bold text-slate-400 uppercase tracking-wider block mb-1">Misi Bulan Ini</span>
                <div class="flex items-baseline gap-2">
                    <span class="text-3xl font-black text-slate-900">{{ $misiBulanIni }}</span>
                    <span class="text-xs font-bold text-primary-600">Pasien</span>
                </div>
                <span class="text-[11px] text-slate-500 mt-1 block">Bulan {{ now()->translatedFormat('F Y') }}</span>
            </div>
            <div class="w-12 h-12 rounded-2xl bg-amber-50 text-amber-600 flex items-center justify-center shrink-0 group-hover:scale-110 transition-transform">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
        </div>

        <!-- Card 4: Total Misi Selesai -->
        <div class="p-6 rounded-3xl bg-white border border-slate-200/80 shadow-xs flex items-center justify-between group hover:border-primary-300 transition-all">
            <div>
                <span class="text-xs font-bold text-slate-400 uppercase tracking-wider block mb-1">Total Misi Selesai</span>
                <div class="flex items-baseline gap-2">
                    <span class="text-3xl font-black text-slate-900">{{ $totalMisi }}</span>
                    <span class="text-xs font-bold text-slate-500">Semua Waktu</span>
                </div>
                <span class="text-[11px] text-slate-500 mt-1 block">Pasien Berhasil Ditolong</span>
            </div>
            <div class="w-12 h-12 rounded-2xl bg-indigo-50 text-indigo-600 flex items-center justify-center shrink-0 group-hover:scale-110 transition-transform">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/></svg>
            </div>
        </div>
    </div>

    <!-- Main Grid: Peta & Tabel Kiri, Status Kanan -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Kolom Kiri (2 Kolom) -->
        <div class="lg:col-span-2 space-y-8">
            <!-- Radar Peta Armada Lembaga -->
            <div class="p-6 rounded-3xl bg-white border border-slate-200/80 shadow-xs">
                <div class="flex items-center justify-between mb-4">
                    <div>
                        <h2 class="text-base font-bold text-slate-900">Live Radar Posisi Armada Lembaga</h2>
                        <p class="text-xs text-slate-500">Pemantauan satelit GPS unit ambulans milik {{ $mitra->nama_mitra ?? 'Lembaga' }}</p>
                    </div>
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-emerald-50 text-emerald-700 border border-emerald-200">
                        <span class="w-2 h-2 rounded-full bg-emerald-500 animate-ping"></span>
                        GPS Aktif
                    </span>
                </div>

                <!-- Leaflet Map Container & Standar Legend -->
                <div class="relative rounded-2xl border border-slate-200/90 shadow-xs overflow-hidden bg-slate-100">
                    <div wire:ignore id="mitraMap" class="w-full h-80 z-10"></div>
                </div>

                <!-- Legend Bar Standar -->
                <div class="mt-3 flex flex-wrap items-center justify-between gap-3 rounded-xl sm:rounded-2xl bg-slate-50 border border-slate-100 p-3 sm:p-3.5 text-xs text-slate-600">
                    <div class="flex items-center gap-2">
                        <span class="relative flex h-2.5 w-2.5">
                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-cyan-400 opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-cyan-600"></span>
                        </span>
                        <span class="font-bold text-slate-800">Ambulans Lembaga</span>
                    </div>
                    <div class="flex items-center gap-2 text-slate-500 font-medium">
                        <span>🛰️ Satelit GPS Realtime</span>
                    </div>
                </div>
            </div>

            <!-- Tabel Riwayat Misi Terbaru -->
            <div class="p-6 rounded-3xl bg-white border border-slate-200/80 shadow-xs">
                <div class="flex items-center justify-between mb-4">
                    <div>
                        <h2 class="text-base font-bold text-slate-900">Misi & Penugasan Terkini</h2>
                        <p class="text-xs text-slate-500">5 panggilan darurat terakhir yang didelegasikan ke armada lembaga Anda</p>
                    </div>
                    <a href="{{ route('mitra.orders.index') }}" class="text-xs font-bold text-sky-600 hover:text-sky-700">
                        Lihat Semua Misi &rarr;
                    </a>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left text-xs">
                        <thead>
                            <tr class="text-slate-400 font-bold uppercase tracking-wider border-b border-slate-100 pb-2">
                                <th class="pb-3">Kode & Waktu</th>
                                <th class="pb-3">Pasien</th>
                                <th class="pb-3">Lokasi & Tujuan</th>
                                <th class="pb-3">Armada & Supir</th>
                                <th class="pb-3">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 font-medium text-slate-700">
                            @forelse($recentOrders as $order)
                                <tr>
                                    <td class="py-3">
                                        <span class="font-bold text-slate-900 block">{{ $order->kode_order }}</span>
                                        <span class="text-[11px] text-slate-400">{{ $order->waktu_pesan ? $order->waktu_pesan->translatedFormat('d M, H:i') : '-' }}</span>
                                    </td>
                                    <td class="py-3">
                                        <span class="font-bold text-slate-800 block">{{ $order->nama_pasien }}</span>
                                        <span class="text-[11px] text-slate-400">{{ $order->kondisi_pasien ?? '-' }}</span>
                                    </td>
                                    <td class="py-3">
                                        <span class="block text-slate-800 truncate max-w-[150px] font-semibold">📍 {{ $order->lokasi_jemput }}</span>
                                        <span class="text-[11px] text-slate-500 block truncate max-w-[150px]">🏥 {{ $order->tujuan_lokasi ?? $order->rumahSakit?->nama ?? '-' }}</span>
                                    </td>
                                    <td class="py-3">
                                        <span class="font-bold text-slate-900 block">{{ $order->ambulans?->kode_ambulans ?? '-' }}</span>
                                        <span class="text-[11px] text-slate-500">{{ $order->supir?->user?->name ?? 'Belum Ditugaskan' }}</span>
                                    </td>
                                    <td class="py-3">
                                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[11px] font-bold
                                            @if($order->status === 'selesai') bg-emerald-50 text-emerald-700 border border-emerald-200
                                            @elseif($order->status === 'diproses') bg-sky-50 text-sky-700 border border-sky-200
                                            @elseif($order->status === 'menuju_lokasi') bg-amber-50 text-amber-700 border border-amber-200
                                            @elseif($order->status === 'membawa_pasien') bg-purple-50 text-purple-700 border border-purple-200
                                            @else bg-slate-100 text-slate-600 border border-slate-200 @endif">
                                            <span class="w-1.5 h-1.5 rounded-full bg-current"></span>
                                            <span>{{ $order->status_label }}</span>
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="py-8 text-center text-slate-400">
                                        Belum ada riwayat misi penugasan untuk armada lembaga ini.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Kolom Kanan (1 Kolom): Status Kesiapan & Driver List -->
        <div class="space-y-8">
            <!-- Kesiapan Unit Armada -->
            <div class="p-6 rounded-3xl bg-white border border-slate-200/80 shadow-xs">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-base font-bold text-slate-900">Kesiapan Armada</h2>
                    <a href="{{ route('mitra.ambulans.index') }}" class="text-xs font-bold text-sky-600 hover:text-sky-700">Kelola</a>
                </div>

                <div class="space-y-3">
                    @forelse($fleetList as $fleet)
                        <div class="p-3.5 rounded-2xl bg-slate-50 border border-slate-100 flex items-center justify-between">
                            <div>
                                <span class="text-xs font-black text-slate-800 block">{{ $fleet->kode_ambulans }}</span>
                                <span class="text-[11px] text-slate-500 font-semibold uppercase">{{ $fleet->plat_nomor }} • {{ $fleet->jenis_ambulans }}</span>
                            </div>
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[11px] font-bold
                                @if($fleet->status === 'Tersedia') bg-emerald-50 text-emerald-700 border border-emerald-200
                                @elseif($fleet->status === 'Ditugaskan') bg-sky-50 text-sky-700 border border-sky-200
                                @elseif($fleet->status === 'Perawatan') bg-amber-50 text-amber-700 border border-amber-200
                                @else bg-slate-200 text-slate-700 border border-slate-300 @endif">
                                <span class="w-1.5 h-1.5 rounded-full bg-current"></span>
                                <span>{{ $fleet->status }}</span>
                            </span>
                        </div>
                    @empty
                        <p class="text-xs text-slate-400 py-4 text-center">Belum ada armada yang didaftarkan.</p>
                    @endforelse
                </div>
            </div>

            <!-- Driver Roster -->
            <div class="p-6 rounded-3xl bg-white border border-slate-200/80 shadow-xs">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-base font-bold text-slate-900">Driver Lembaga</h2>
                    <a href="{{ route('mitra.supir.index') }}" class="text-xs font-bold text-sky-600 hover:text-sky-700">Semua</a>
                </div>

                <div class="space-y-3">
                    @forelse($driverList as $driver)
                        <div class="p-3.5 rounded-2xl bg-slate-50 border border-slate-100 flex items-center justify-between">
                            <div>
                                <span class="text-xs font-bold text-slate-800 block">{{ $driver->user?->name ?? 'Driver' }}</span>
                                <span class="text-[11px] text-slate-500">SIM: {{ $driver->nomor_sim ?? '-' }} • 📞 {{ $driver->no_wa ?? $driver->user?->phone ?? '-' }}</span>
                            </div>
                            <span class="px-2 py-0.5 rounded-full text-[10px] font-extrabold uppercase {{ $driver->status_online ? 'bg-emerald-100 text-emerald-700' : 'bg-slate-200 text-slate-600' }}">
                                {{ $driver->status_online ? 'Online' : 'Offline' }}
                            </span>
                        </div>
                    @empty
                        <p class="text-xs text-slate-400 py-4 text-center">Belum ada driver terdaftar.</p>
                    @endforelse
                </div>
            </div>

            <!-- Hotline Dispatcher Card -->
            <div class="p-6 rounded-3xl bg-slate-900 text-white shadow-xl relative overflow-hidden">
                <span class="text-[10px] font-extrabold uppercase tracking-widest text-primary-400 block mb-1">Koordinasi Pusat</span>
                <h3 class="text-base font-bold text-white mb-2">Dispatcher Ambulans Siaga</h3>
                <p class="text-xs text-slate-300 mb-4 leading-relaxed">Hubungi pusat kendali 24/7 jika ada kendala armada, perubahan jadwal darurat, atau konfirmasi rujukan RS.</p>
                <a href="https://wa.me/6281234567890" target="_blank"
                   class="inline-flex items-center justify-center gap-2 w-full py-2.5 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs shadow-md transition-all">
                    <span>💬 Hubungi Hotline Pusat (WhatsApp)</span>
                </a>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const defaultLat = -7.7279;
        const defaultLng = 109.0059;

        const map = L.map('mitraMap', {
            zoomControl: true,
            scrollWheelZoom: true
        }).setView([defaultLat, defaultLng], 12);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
            maxZoom: 19
        }).addTo(map);

        const markersBounds = [];

        // Ambulans Markers 3D
        @foreach($fleetList as $idx => $flt)
            @php
                $lat = -7.7279 + (($idx - 1) * 0.015);
                $lng = 109.0059 + (($idx - 1) * 0.012);
            @endphp
            (function() {
                const lat = {{ $lat }};
                const lng = {{ $lng }};
                markersBounds.push([lat, lng]);

                const popupContent = `
                    <div class="p-1 min-w-[160px] text-slate-800">
                        <div class="font-bold text-sm text-slate-900 leading-snug mb-0.5">{{ $flt->kode_ambulans }}</div>
                        <div class="text-[11px] text-slate-500 font-semibold mb-2">Plat: {{ $flt->plat_nomor }} • {{ $flt->jenis_ambulans }}</div>
                        <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold
                            @if($flt->status === 'Tersedia') bg-emerald-100 text-emerald-800
                            @elseif($flt->status === 'Ditugaskan') bg-sky-100 text-sky-800
                            @elseif($flt->status === 'Perawatan') bg-amber-100 text-amber-800
                            @else bg-slate-100 text-slate-700 @endif">
                            {{ $flt->status }}
                        </span>
                    </div>
                `;

                if (typeof window.createLeafletAmbulance3DMarker === 'function') {
                    const ambMarker = window.createLeafletAmbulance3DMarker(map, lat, lng, {
                        size: 54,
                        autoSpin: false
                    });
                    ambMarker.bindPopup(popupContent);
                } else {
                    L.marker([lat, lng]).addTo(map).bindPopup(popupContent);
                }
            })();
        @endforeach

        if (markersBounds.length > 0) {
            map.fitBounds(markersBounds, { padding: [50, 50], maxZoom: 15 });
        }
    });
</script>
@endpush
