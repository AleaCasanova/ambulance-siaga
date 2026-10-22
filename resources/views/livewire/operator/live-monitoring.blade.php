<div wire:poll.3s 
     class="relative -m-4 sm:-m-6 lg:-m-8 h-[calc(100vh-64px)] overflow-hidden"
     x-data="fullScreenMonitoringComponent(@js($markers))"
     x-init="initMap()"
     @map-markers-updated.window="updateMarkers($event.detail.markers)">

    <!-- Top Unified Floating Navigation & Stats Bar -->
    <div class="absolute top-3 left-3 right-3 sm:top-4 sm:left-4 sm:right-4 z-20 flex items-center justify-between gap-2 pointer-events-none">
        <!-- Left: Back Button & Live Status -->
        <div class="flex items-center gap-2 pointer-events-auto min-w-0">
            <a href="{{ route('operator.dashboard') }}"
               class="inline-flex items-center gap-1.5 px-3 py-2 rounded-lg bg-slate-900/95 hover:bg-slate-900 text-white font-medium text-xs shadow-md backdrop-blur-sm transition-colors shrink-0">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                <span class="hidden sm:inline">Kembali</span>
            </a>

            <div class="bg-white/95 backdrop-blur-md px-3 sm:px-4 py-2 rounded-lg border border-slate-200/90 shadow-md flex items-center gap-2 sm:gap-3 text-xs shrink min-w-0">
                <div class="flex items-center gap-1.5 shrink-0">
                    <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                    <span class="font-bold text-slate-800 text-xs hidden md:inline">Monitoring Satelit</span>
                </div>
                <div class="hidden md:block h-3.5 w-px bg-slate-200"></div>
                <div class="flex items-center gap-2 text-[11px] sm:text-xs font-semibold truncate">
                    <span class="text-amber-700 bg-amber-50 sm:bg-transparent px-1.5 sm:px-0 py-0.5 sm:py-0 rounded font-bold sm:font-semibold">
                        {{ $activeOrdersCount }} Darurat
                    </span>
                    <span class="text-slate-300 hidden sm:inline">•</span>
                    <span class="text-cyan-700 bg-cyan-50 sm:bg-transparent px-1.5 sm:px-0 py-0.5 sm:py-0 rounded font-bold sm:font-semibold">
                        {{ $onlineSupirsCount }} Supir
                    </span>
                </div>
            </div>
        </div>

        <!-- Right: Actions (Fokus & Toggle Legenda) -->
        <div class="flex items-center gap-1.5 pointer-events-auto shrink-0">
            <button type="button" 
                    @click="fitAll()"
                    title="Fokuskan Semua Armada & Order"
                    class="px-2.5 sm:px-3 py-2 rounded-lg bg-white/95 hover:bg-slate-50 border border-slate-200/90 text-slate-700 text-xs font-semibold shadow-md transition-colors flex items-center gap-1">
                <svg class="w-3.5 h-3.5 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                </svg>
                <span class="hidden sm:inline">Fokus</span>
            </button>
            <button type="button" 
                    @click="showLegend = !showLegend"
                    class="px-2.5 sm:px-3 py-2 rounded-lg bg-white/95 hover:bg-slate-50 border border-slate-200/90 text-slate-700 text-xs font-semibold shadow-md transition-colors flex items-center gap-1">
                <span>Legenda</span>
                <svg class="w-3 h-3 text-slate-400 transition-transform duration-200" :class="{ 'rotate-180': showLegend }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                </svg>
            </button>
        </div>
    </div>

    <!-- Fullscreen Map Container -->
    <div id="fullscreen-monitoring-map"
         wire:ignore
         class="w-full h-full z-10"></div>

    <!-- Floating Legend (Responsive & Dismissible) -->
    <div x-show="showLegend"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 translate-y-2"
         x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100 translate-y-0"
         x-transition:leave-end="opacity-0 translate-y-2"
         class="absolute bottom-4 left-3 right-3 sm:right-auto sm:left-4 z-20 bg-white/95 backdrop-blur-md p-3.5 rounded-xl border border-slate-200/90 shadow-lg sm:max-w-xs text-xs pointer-events-auto">
        <div class="flex items-center justify-between border-b border-slate-100 pb-2 mb-2">
            <span class="font-bold text-slate-800 text-[11px] uppercase tracking-wider text-slate-400">Legenda Peta</span>
            <button type="button" @click="showLegend = false" class="text-slate-400 hover:text-slate-600 p-0.5">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
        <div class="space-y-2">
            <div class="flex items-center gap-2.5">
                <span class="w-2.5 h-2.5 rounded-full bg-rose-500 shrink-0"></span>
                <span class="text-slate-700 font-medium text-xs">Titik Jemput Pasien</span>
            </div>
            <div class="flex items-center gap-2.5">
                <span class="w-2.5 h-2.5 rounded-full bg-cyan-600 shrink-0"></span>
                <span class="text-slate-700 font-medium text-xs">Posisi Ambulans Siaga / Mitra</span>
            </div>
            <div class="flex items-center gap-2.5">
                <span class="w-2.5 h-2.5 rounded-full bg-emerald-600 shrink-0"></span>
                <span class="text-slate-700 font-medium text-xs">Rumah Sakit Rujukan</span>
            </div>
        </div>
    </div>

    <!-- Leaflet Fullscreen Script -->
    <script>
        function fullScreenMonitoringComponent(initialMarkers) {
            return {
                map: null,
                markersLayer: null,
                markersData: initialMarkers,
                showLegend: window.innerWidth >= 768,

                initMap() {
                    if (this.map) return;

                    // Nonaktifkan zoomControl bawaan topleft agar tidak tertimpa navbar
                    this.map = L.map('fullscreen-monitoring-map', {
                        zoomControl: false,
                        scrollWheelZoom: true
                    }).setView([-7.7188, 109.0159], 13);

                    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
                        maxZoom: 19
                    }).addTo(this.map);

                    // Pindahkan zoom control ke bottomright agar aman dari header dan legenda
                    L.control.zoom({ position: 'bottomright' }).addTo(this.map);

                    this.markersLayer = L.layerGroup().addTo(this.map);
                    this.renderMarkers();

                    // Pastikan invalidateSize terpanggil setelah render DOM selesai
                    setTimeout(() => {
                        if (this.map) {
                            this.map.invalidateSize();
                            this.fitAll();
                        }
                    }, 400);
                },

                renderMarkers() {
                    if (!this.markersLayer) return;
                    this.markersLayer.clearLayers();

                    this.markersData.forEach((item) => {
                        if (!item.lat || !item.lng) return;

                        let title = '';
                        let popup = '';
                        let iconHtml = '';

                        if (item.type === 'ambulans') {
                            title = `Ambulans: ${item.kode}`;
                            popup = `
                                <div class="font-sans min-w-[180px] p-0.5">
                                    <div class="border-b border-slate-100 pb-1 mb-1.5 flex items-center justify-between">
                                        <b class="text-xs text-slate-900">${item.kode}</b>
                                        <span class="text-[10px] font-bold ${item.status_online ? 'text-emerald-700 bg-emerald-50' : 'text-slate-500 bg-slate-100'} px-1.5 py-0.5 rounded">
                                            ${item.status_online ? 'ONLINE' : 'OFFLINE'}
                                        </span>
                                    </div>
                                    <div class="text-[11px] text-slate-600 space-y-0.5">
                                        <p>Supir: <span class="font-semibold text-slate-800">${item.supir}</span></p>
                                        <p>Telp: <span>${item.phone || '-'}</span></p>
                                    </div>
                                </div>
                            `;
                            iconHtml = `<div style="background: linear-gradient(135deg, #0284C7, #0369A1); width: 30px; height: 30px; border-radius: 50%; border: 2.5px solid white; box-shadow: 0 3px 8px rgba(2,132,199,0.5); display: flex; align-items: center; justify-content: center; font-size: 14px;">🚑</div>`;
                        } else if (item.type === 'darurat') {
                            title = `Darurat: ${item.pasien}`;
                            popup = `
                                <div class="font-sans min-w-[180px] p-0.5">
                                    <div class="border-b border-slate-100 pb-1 mb-1.5 flex items-center justify-between">
                                        <b class="text-xs text-rose-700 font-bold">${item.kode}</b>
                                        <span class="text-[10px] font-bold text-rose-700 bg-rose-50 px-1.5 py-0.5 rounded">Darurat</span>
                                    </div>
                                    <div class="text-[11px] text-slate-600 space-y-0.5">
                                        <p>Pasien: <span class="font-bold text-slate-800">${item.pasien}</span></p>
                                        ${item.kondisi ? `<p class="truncate">Kondisi: <span>${item.kondisi}</span></p>` : ''}
                                    </div>
                                </div>
                            `;
                            iconHtml = `<div style="background: linear-gradient(135deg, #F59E0B, #D97706); width: 30px; height: 30px; border-radius: 50%; border: 2.5px solid white; box-shadow: 0 3px 8px rgba(245,158,11,0.5); display: flex; align-items: center; justify-content: center; font-size: 14px;">🚨</div>`;
                        } else if (item.type === 'rumahsakit') {
                            title = `RS: ${item.nama}`;
                            popup = `
                                <div class="font-sans min-w-[190px] p-0.5">
                                    <b class="text-xs text-slate-900 block mb-1">${item.nama}</b>
                                    <span class="text-[11px] text-slate-500 block mb-1.5 line-clamp-2">${item.alamat}</span>
                                    <div class="flex items-center justify-between pt-1 border-t border-slate-100 text-[11px]">
                                        <span class="text-slate-600">Telp: ${item.telepon || '-'}</span>
                                        <span class="font-bold text-emerald-700 bg-emerald-50 px-1.5 py-0.5 rounded">IGD: ${item.kapasitas}</span>
                                    </div>
                                </div>
                            `;
                            iconHtml = `<div style="background: linear-gradient(135deg, #10B981, #059669); width: 26px; height: 26px; border-radius: 50%; border: 2px solid white; box-shadow: 0 2px 6px rgba(16,185,129,0.4); display: flex; align-items: center; justify-content: center; font-size: 12px;">🏥</div>`;
                        }

                        let marker;
                        if (item.type === 'ambulans' && typeof window.createLeafletAmbulance3DMarker === 'function') {
                            marker = window.createLeafletAmbulance3DMarker(this.markersLayer, item.lat, item.lng, {
                                size: 42,
                                autoSpin: false
                            }).bindPopup(popup);
                        } else if (item.type === 'darurat' && typeof window.getPatientPin3DIcon === 'function') {
                            const customIcon = window.getPatientPin3DIcon({ size: 28 });
                            marker = L.marker([item.lat, item.lng], { title, icon: customIcon, zIndexOffset: 1000 }).addTo(this.markersLayer)
                                .bindPopup(popup);
                        } else if (item.type === 'rumahsakit' && typeof window.getHospital3DIcon === 'function') {
                            // Menggunakan ukuran proporsional (32px) agar tidak menumpuk saling menimpa
                            const customIcon = window.getHospital3DIcon({ size: 32 });
                            marker = L.marker([item.lat, item.lng], { title, icon: customIcon, zIndexOffset: 800 }).addTo(this.markersLayer)
                                .bindPopup(popup);
                        } else {
                            const customIcon = L.divIcon({
                                className: 'custom-monitoring-icon',
                                html: iconHtml,
                                iconSize: [28, 28],
                                iconAnchor: [14, 14]
                            });

                            marker = L.marker([item.lat, item.lng], { title, icon: customIcon }).addTo(this.markersLayer)
                                .bindPopup(popup);
                        }
                    });
                },

                fitAll() {
                    if (!this.map || !this.markersData || this.markersData.length === 0) return;

                    const bounds = L.latLngBounds([]);
                    // Utamakan armada ambulans dan darurat untuk fokus jika ada
                    const priorityMarkers = this.markersData.filter(m => m.type === 'ambulans' || m.type === 'darurat');
                    const targetList = priorityMarkers.length > 0 ? priorityMarkers : this.markersData;

                    targetList.forEach((item) => {
                        if (item.lat && item.lng) {
                            bounds.extend([item.lat, item.lng]);
                        }
                    });

                    if (bounds.isValid()) {
                        const isMobile = window.innerWidth < 640;
                        const pad = isMobile ? [25, 25] : [50, 50];
                        this.map.fitBounds(bounds, { padding: pad, maxZoom: 14 });
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
