<div>
    <!-- Header -->
    <div class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-slate-200 text-slate-700 uppercase tracking-wider mb-2">
                Manajemen Fasilitas Kesehatan
            </span>
            <h1 class="text-2xl sm:text-3xl font-extrabold text-slate-800 tracking-tight">Kelola Rumah Sakit Rujukan</h1>
            <p class="text-slate-500 text-sm mt-1">Daftar rumah sakit mitra GSC SIAGA di wilayah Kabupaten Cilacap dan sekitarnya.</p>
        </div>

        <div class="flex flex-wrap items-center gap-3">
            <input type="text" wire:model.live.debounce.300ms="search"
                   placeholder="Cari nama RS atau alamat..."
                   class="px-4 py-2.5 rounded-xl border border-slate-300 bg-white text-sm font-medium focus:border-sky-500 focus:ring-2 focus:ring-sky-200 shadow-xs">

            <button type="button" wire:click="openCreateModal"
                    class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-sky-600 hover:bg-sky-700 text-white font-bold text-sm shadow-md transition-all">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/>
                </svg>
                <span>Tambah Rumah Sakit</span>
            </button>
        </div>
    </div>

    <!-- Table Rumah Sakit -->
    <div class="bg-white rounded-3xl border border-slate-200/80 shadow-xs overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50/80 border-b border-slate-200 text-[11px] font-bold text-slate-500 uppercase tracking-wider">
                        <th class="py-4 px-6">Nama Rumah Sakit</th>
                        <th class="py-4 px-6">Alamat</th>
                        <th class="py-4 px-6">Telepon / Hotline</th>
                        <th class="py-4 px-6">Koordinat Peta</th>
                        <th class="py-4 px-6">Kapasitas / Layanan</th>
                        <th class="py-4 px-6 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-sm">
                    @forelse($rumahSakits as $rs)
                        <tr class="hover:bg-slate-50/50 transition-colors">
                            <td class="py-4 px-6">
                                <span class="font-extrabold text-slate-800 block">{{ $rs->nama }}</span>
                                <span class="inline-block px-2 py-0.5 rounded text-[10px] font-bold bg-emerald-100 text-emerald-700 mt-1">MITRA RESMI GSC</span>
                            </td>
                            <td class="py-4 px-6 max-w-xs">
                                <p class="text-xs text-slate-600 font-medium">{{ $rs->alamat }}</p>
                            </td>
                            <td class="py-4 px-6 font-bold text-slate-700 text-xs">{{ $rs->telepon ?: '-' }}</td>
                            <td class="py-4 px-6 text-xs">
                                <a href="https://www.google.com/maps?q={{ $rs->lat }},{{ $rs->lng }}" target="_blank"
                                   class="inline-flex items-center gap-1 font-bold text-sky-600 hover:underline">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    </svg>
                                    <span>{{ number_format($rs->lat, 4) }}, {{ number_format($rs->lng, 4) }}</span>
                                </a>
                            </td>
                            <td class="py-4 px-6">
                                <span class="px-2.5 py-1 rounded-full text-xs font-semibold bg-slate-100 text-slate-700">
                                    {{ $rs->kapasitas_igd }}
                                </span>
                            </td>
                            <td class="py-4 px-6 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <button type="button" wire:click="openEditModal({{ $rs->id }})"
                                            class="px-3 py-1.5 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold text-xs transition-colors">
                                        Edit
                                    </button>
                                    <button type="button" wire:click="deleteRs({{ $rs->id }})"
                                            wire:confirm="Yakin ingin menghapus rumah sakit ini?"
                                            class="px-3 py-1.5 rounded-xl bg-red-50 hover:bg-red-100 text-red-600 font-bold text-xs transition-colors">
                                        Hapus
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="py-12 text-center text-slate-400">
                                <p class="text-sm font-semibold">Tidak ada data rumah sakit rujukan</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="px-6 py-4 border-t border-slate-100">
            {{ $rumahSakits->links() }}
        </div>
    </div>

    <!-- Modal Form Create / Edit dengan Peta Leaflet -->
    @if($showModal)
        <div class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/70 backdrop-blur-xs">
            <div class="bg-white rounded-3xl max-w-2xl w-full p-6 sm:p-8 shadow-2xl border border-slate-200 max-h-[90vh] overflow-y-auto">
                <div class="flex items-center justify-between mb-6 pb-4 border-b border-slate-100">
                    <h3 class="text-lg font-extrabold text-slate-800">
                        {{ $isEdit ? 'Edit Rumah Sakit Rujukan' : 'Tambah Rumah Sakit Rujukan' }}
                    </h3>
                    <button wire:click="$set('showModal', false)" class="text-slate-400 hover:text-slate-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>

                <form wire:submit="saveRs" class="space-y-4">
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Nama Rumah Sakit</label>
                        <input type="text" wire:model="nama" required
                               placeholder="Contoh: RSUD Cilacap"
                               class="w-full px-4 py-2.5 rounded-xl border border-slate-300 text-sm font-bold focus:border-sky-500 focus:ring-2 focus:ring-sky-200">
                        @error('nama') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Alamat Lengkap</label>
                        <input type="text" wire:model="alamat" required
                               placeholder="Contoh: Jl. Gatot Subroto No. 28, Sidanegara, Cilacap"
                               class="w-full px-4 py-2.5 rounded-xl border border-slate-300 text-sm font-medium focus:border-sky-500 focus:ring-2 focus:ring-sky-200">
                        @error('alamat') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1">Telepon / IGD Hotline</label>
                            <input type="text" wire:model="telepon"
                                   placeholder="Contoh: (0282) 533010"
                                   class="w-full px-4 py-2.5 rounded-xl border border-slate-300 text-sm font-medium focus:border-sky-500 focus:ring-2 focus:ring-sky-200">
                        @error('telepon') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1">Layanan / Kapasitas IGD</label>
                            <input type="text" wire:model="kapasitas_igd"
                                   placeholder="Contoh: IGD 24 Jam - Tersedia"
                                   class="w-full px-4 py-2.5 rounded-xl border border-slate-300 text-sm font-medium focus:border-sky-500 focus:ring-2 focus:ring-sky-200">
                        @error('kapasitas_igd') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <!-- Koordinat GPS (Klik Peta) -->
                    <div class="pt-2">
                        <label class="block text-xs font-bold text-slate-700 mb-2 flex items-center justify-between">
                            <span>Tentukan Koordinat Lokasi RS (Klik Peta di Bawah)</span>
                            <span class="text-sky-600 font-extrabold">{{ number_format($lat, 5) }}, {{ number_format($lng, 5) }}</span>
                        </label>

                        <div class="w-full h-60 rounded-xl border border-slate-300 overflow-hidden"
                             x-data="rsPickerMap({{ $lat }}, {{ $lng }})"
                             x-init="initMap()">
                            <div id="rs-picker-map" class="w-full h-full"></div>
                        </div>
                    </div>

                    <div class="flex gap-3 pt-4 border-t border-slate-100">
                        <button type="submit"
                                class="flex-1 py-3.5 rounded-xl bg-sky-600 hover:bg-sky-700 text-white font-extrabold text-sm shadow-lg shadow-sky-600/30 transition-all">
                            SIMPAN DATA RS
                        </button>
                        <button type="button" wire:click="$set('showModal', false)"
                                class="px-5 py-3.5 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-600 font-bold text-sm transition-colors">
                            Batal
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endif

    <!-- Leaflet Picker Map Script -->
    <script>
        function rsPickerMap(initialLat, initialLng) {
            return {
                map: null,
                marker: null,

                initMap() {
                    this.map = L.map('rs-picker-map').setView([initialLat, initialLng], 14);

                    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                        attribution: '&copy; OpenStreetMap contributors',
                        maxZoom: 19
                    }).addTo(this.map);

                    this.marker = L.marker([initialLat, initialLng], { draggable: true }).addTo(this.map);

                    this.map.on('click', (e) => {
                        this.setPos(e.latlng.lat, e.latlng.lng);
                    });

                    this.marker.on('dragend', (e) => {
                        const pos = e.target.getLatLng();
                        this.setPos(pos.lat, pos.lng);
                    });

                    setTimeout(() => {
                        this.map.invalidateSize();
                    }, 300);
                },

                setPos(lat, lng) {
                    this.marker.setLatLng([lat, lng]);
                    @this.call('updateCoordinates', lat, lng);
                }
            }
        }
    </script>
</div>
