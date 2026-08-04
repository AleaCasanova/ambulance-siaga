<div wire:poll.3s class="relative -m-4 sm:-m-6 lg:-m-8">
    <!-- Floating Header Stats Bar -->
    <div class="absolute top-4 left-4 right-4 z-20 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 pointer-events-none">
        <div class="bg-white/90 backdrop-blur-md px-5 py-3 rounded-2xl border border-slate-200/80 shadow-lg pointer-events-auto flex items-center gap-4">
            <div class="flex items-center gap-2">
                <span class="w-3 h-3 rounded-full bg-sky-600 animate-ping"></span>
                <span class="font-extrabold text-slate-800 text-sm">Pusat Monitoring Satelit Cilacap</span>
            </div>
            <div class="h-4 w-px bg-slate-200"></div>
            <div class="flex items-center gap-3 text-xs font-bold">
                <span class="text-amber-700">{{ $activeOrdersCount }} Order Darurat</span>
                <span class="text-sky-700">{{ $onlineSupirsCount }} Supir Online</span>
            </div>
        </div>

        <div class="flex items-center gap-2 pointer-events-auto">
            <a href="{{ route('dispatcher.dashboard') }}"
               class="px-4 py-2.5 rounded-xl bg-slate-900 hover:bg-sky-600 text-white font-bold text-xs shadow-lg transition-all flex items-center gap-2">
                <span>&larr; Kembali ke Dashboard</span>
            </a>
        </div>
    </div>

    <!-- Fullscreen Map Container -->
    <div id="fullscreen-monitoring-map"
         class="w-full h-[calc(100vh-64px)] z-10"
         x-data="fullScreenMonitoringComponent(@js($markers))"
         x-init="initMap()"
         @map-markers-updated.window="updateMarkers($event.detail.markers)"></div>

    <!-- Floating Legend Bar at Bottom Left -->
    <div class="absolute bottom-6 left-6 z-20 bg-white/95 backdrop-blur-md p-4 rounded-2xl border border-slate-200/80 shadow-xl max-w-xs text-xs space-y-2 pointer-events-auto">
        <span class="font-bold text-slate-800 block border-b border-slate-100 pb-1.5">Legenda Marker Peta</span>
        <div class="flex items-center gap-2">
            <span class="w-3 h-3 rounded-full bg-amber-500"></span>
            <span class="text-slate-700 font-semibold">Titik Penjemputan Darurat Pasien</span>
        </div>
        <div class="flex items-center gap-2">
            <span class="w-3 h-3 rounded-full bg-sky-600"></span>
            <span class="text-slate-700 font-semibold">Posisi Armada Ambulans Mitra</span>
        </div>
        <div class="flex items-center gap-2">
            <span class="w-3 h-3 rounded-full bg-emerald-600"></span>
            <span class="text-slate-700 font-semibold">Rumah Sakit Rujukan Cilacap</span>
        </div>
    </div>

    <!-- Leaflet Fullscreen Script -->
    <script>
        function fullScreenMonitoringComponent(initialMarkers) {
            return {
                map: null,
                markersLayer: null,
                markersData: initialMarkers,

                initMap() {
                    this.map = L.map('fullscreen-monitoring-map').setView([-7.7188, 109.0159], 13);

                    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                        attribution: '&copy; OpenStreetMap contributors',
                        maxZoom: 19
                    }).addTo(this.map);

                    this.markersLayer = L.layerGroup().addTo(this.map);
                    this.renderMarkers();

                    setTimeout(() => {
                        this.map.invalidateSize();
                    }, 300);
                },

                renderMarkers() {
                    this.markersLayer.clearLayers();
                    const bounds = L.latLngBounds([]);

                    this.markersData.forEach((item) => {
                        if (!item.lat || !item.lng) return;

                        let title = '';
                        let popup = '';

                        if (item.type === 'ambulans') {
                            title = `Ambulans: ${item.kode}`;
                            popup = `<b>Armada: ${item.kode}</b><br>Supir: ${item.supir}<br>Telp: ${item.phone}<br>Status: ${item.status_online ? 'ONLINE' : 'OFFLINE'}`;
                        } else if (item.type === 'darurat') {
                            title = `Darurat: ${item.pasien}`;
                            popup = `<b>DARURAT: ${item.kode}</b><br>Pasien: ${item.pasien}<br>Kondisi: ${item.kondisi}<br>Status: ${item.status}`;
                        } else if (item.type === 'rumahsakit') {
                            title = `RS: ${item.nama}`;
                            popup = `<b>Rumah Sakit:</b><br>${item.nama}<br>${item.alamat}<br>IGD: ${item.kapasitas}`;
                        }

                        const marker = L.marker([item.lat, item.lng], { title }).addTo(this.markersLayer)
                            .bindPopup(popup);

                        bounds.extend([item.lat, item.lng]);
                    });

                    if (bounds.isValid() && this.markersData.length > 0) {
                        this.map.fitBounds(bounds, { padding: [60, 60] });
                    }
                },

                updateMarkers(newMarkers) {
                    this.markersData = newMarkers;
                    this.renderMarkers();
                }
            }
        }
    </script>
</div>
