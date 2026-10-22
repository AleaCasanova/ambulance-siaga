<div>
    <!-- Header -->
    <div class="mb-8 flex flex-col lg:flex-row lg:items-end lg:justify-between gap-6">
        <div class="flex-1">
            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[11px] font-bold bg-slate-100 text-slate-500 uppercase tracking-wider mb-2.5">
                Manajemen Fasilitas Kesehatan
            </span>
            <h1 class="text-2xl sm:text-[28px] font-bold text-slate-900 tracking-tight leading-tight">
                Kelola Rumah Sakit Rujukan
            </h1>
            <p class="text-slate-500 text-[14px] mt-1.5 font-medium max-w-2xl">
                Daftar rumah sakit dan fasilitas kesehatan mitra Ambulans Siaga.
            </p>
        </div>

        <div class="flex flex-wrap items-center gap-3">
            <input type="text" wire:model.live.debounce.300ms="search"
                   placeholder="Cari nama RS atau alamat..."
                   class="px-4 py-2.5 rounded-lg border border-slate-300 bg-white text-sm font-medium focus:border-sky-500 focus:ring-2 focus:ring-sky-200 shadow-xs">

            <button type="button" wire:click="openCreateModal"
                    class="inline-flex items-center gap-2 px-5 py-2.5 rounded-lg bg-sky-600 hover:bg-sky-700 text-white font-bold text-sm shadow-md transition-all">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/>
                </svg>
                <span>Tambah Rumah Sakit</span>
            </button>
        </div>
    </div>

    <!-- Table Rumah Sakit -->
    <div class="bg-white rounded-xl border border-slate-200/80 shadow-xs overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-200 text-[11px] font-bold text-slate-500 uppercase tracking-wider">
                        <th class="py-3 px-4 sm:px-5 whitespace-nowrap">Nama Rumah Sakit</th>
                        <th class="py-3 px-4 sm:px-5 whitespace-nowrap">Alamat</th>
                        <th class="py-3 px-4 sm:px-5 whitespace-nowrap">Telepon / Hotline</th>
                        <th class="py-3 px-4 sm:px-5 whitespace-nowrap">Koordinat Peta</th>
                        <th class="py-3 px-4 sm:px-5 whitespace-nowrap">Kapasitas / Layanan</th>
                        <th class="py-3 px-4 sm:px-5 whitespace-nowrap text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-xs">
                    @forelse($rumahSakits as $rs)
                        <tr class="hover:bg-slate-50/50 transition-colors">
                            <td class="py-3 px-4 sm:px-5">
                                <span class="font-bold text-slate-800 text-xs block leading-snug">{{ $rs->nama }}</span>
                                <span class="inline-block px-2 py-0.5 rounded text-[10px] font-bold bg-emerald-50 text-emerald-700 border border-emerald-100 mt-1">MITRA KESEHATAN</span>
                            </td>
                            <td class="py-3 px-4 sm:px-5 max-w-sm">
                                <p class="text-xs text-slate-600 font-normal leading-relaxed">{{ $rs->alamat }}</p>
                            </td>
                            <td class="py-3 px-4 sm:px-5 font-semibold text-slate-700 text-xs whitespace-nowrap">{{ $rs->telepon ?: '-' }}</td>
                            <td class="py-3 px-4 sm:px-5 text-xs whitespace-nowrap">
                                <a href="https://www.google.com/maps?q={{ $rs->lat }},{{ $rs->lng }}" target="_blank"
                                   class="inline-flex items-center gap-1 font-bold text-sky-600 hover:underline">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    </svg>
                                    <span class="font-mono text-xs">{{ number_format($rs->lat, 4) }}, {{ number_format($rs->lng, 4) }}</span>
                                </a>
                            </td>
                            <td class="py-3 px-4 sm:px-5 whitespace-nowrap">
                                <span class="px-2.5 py-1 rounded-full text-[11px] font-medium bg-slate-100 text-slate-700">
                                    {{ $rs->kapasitas_igd }}
                                </span>
                            </td>
                            <td class="py-3 px-4 sm:px-5 text-right whitespace-nowrap">
                                <div class="flex items-center justify-end gap-1.5">
                                    <button type="button" wire:click="openEditModal({{ $rs->id }})"
                                            title="Edit Rumah Sakit"
                                            class="w-8 h-8 rounded-lg bg-white text-slate-600 hover:text-amber-600 hover:bg-amber-50 border border-slate-200 transition-all flex items-center justify-center shadow-xs">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                        </svg>
                                    </button>
                                    <button type="button" wire:click="deleteRs({{ $rs->id }})"
                                            wire:confirm="Yakin ingin menghapus rumah sakit ini?"
                                            title="Hapus Rumah Sakit"
                                            class="w-8 h-8 rounded-lg bg-white text-slate-600 hover:text-rose-600 hover:bg-rose-50 border border-slate-200 transition-all flex items-center justify-center shadow-xs">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                        </svg>
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
        <div class="fixed inset-0 z-50 bg-slate-900/60 backdrop-blur-xs flex items-center justify-center p-3 sm:p-6 overflow-hidden">
            <div class="relative bg-white rounded-xl max-w-2xl w-full shadow-2xl border border-slate-200 flex flex-col max-h-[90vh] overflow-hidden animate-in fade-in zoom-in-95 duration-200">
                <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between shrink-0 bg-white">
                    <h3 class="text-base font-bold text-slate-900">
                        {{ $isEdit ? 'Edit Rumah Sakit Rujukan' : 'Tambah Rumah Sakit Rujukan' }}
                    </h3>
                    <button wire:click="$set('showModal', false)" class="p-1.5 rounded-lg text-slate-400 hover:text-slate-600 hover:bg-slate-100 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>

                <form wire:submit="saveRs" class="flex flex-col grow overflow-hidden">
                    <div class="px-6 py-5 overflow-y-auto space-y-4 grow">
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1">Nama Rumah Sakit</label>
                            <input type="text" wire:model="nama" required
                                   placeholder="Contoh: RSUD Cilacap"
                                   class="w-full px-3.5 py-2 rounded-lg border border-slate-200 text-xs font-bold focus:border-primary-500 focus:ring-2 focus:ring-primary-100 bg-white">
                            @error('nama') <p class="text-[11px] text-red-600 mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1">Alamat Lengkap</label>
                            <input type="text" wire:model="alamat" required
                                   placeholder="Contoh: Jl. Gatot Subroto No. 28, Sidanegara, Cilacap"
                                   class="w-full px-3.5 py-2 rounded-lg border border-slate-200 text-xs font-medium focus:border-primary-500 focus:ring-2 focus:ring-primary-100 bg-white">
                            @error('alamat') <p class="text-[11px] text-red-600 mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div class="grid grid-cols-2 gap-3.5">
                            <div>
                                <label class="block text-xs font-semibold text-slate-700 mb-1">Telepon / IGD Hotline</label>
                                <input type="text" wire:model="telepon"
                                       placeholder="Contoh: (0282) 533010"
                                       class="w-full px-3.5 py-2 rounded-lg border border-slate-200 text-xs font-medium focus:border-primary-500 focus:ring-2 focus:ring-primary-100 bg-white">
                                @error('telepon') <p class="text-[11px] text-red-600 mt-1">{{ $message }}</p> @enderror
                            </div>

                            <div>
                                <label class="block text-xs font-semibold text-slate-700 mb-1">Layanan / Kapasitas IGD</label>
                                <input type="text" wire:model="kapasitas_igd"
                                       placeholder="Contoh: IGD 24 Jam - Tersedia"
                                       class="w-full px-3.5 py-2 rounded-lg border border-slate-200 text-xs font-medium focus:border-primary-500 focus:ring-2 focus:ring-primary-100 bg-white">
                                @error('kapasitas_igd') <p class="text-[11px] text-red-600 mt-1">{{ $message }}</p> @enderror
                            </div>
                        </div>

                        <!-- Koordinat GPS (Klik Peta) -->
                        <div class="pt-1">
                            <label class="block text-xs font-semibold text-slate-700 mb-2 flex items-center justify-between">
                                <span>Tentukan Koordinat Lokasi RS (Klik / Geser Pin di Peta)</span>
                                <span class="text-primary-700 font-bold font-mono text-[11px] bg-primary-50 px-2 py-0.5 rounded-md border border-primary-100">{{ number_format($lat, 5) }}, {{ number_format($lng, 5) }}</span>
                            </label>

                            <div class="w-full h-56 rounded-lg border border-slate-200 overflow-hidden shadow-2xs"
                                 x-data="rsPickerMap({{ $lat }}, {{ $lng }})"
                                 x-init="initMap()">
                                <div id="rs-picker-map" class="w-full h-full"></div>
                            </div>
                        </div>
                    </div>

                    <div class="px-6 py-3.5 border-t border-slate-100 flex items-center justify-end gap-2.5 shrink-0 bg-slate-50/80">
                        <button type="button" wire:click="$set('showModal', false)"
                                class="px-4 py-2 rounded-lg border border-slate-200 bg-white hover:bg-slate-100 text-slate-600 font-semibold text-xs transition-colors shadow-xs">
                            Batal
                        </button>
                        <button type="submit"
                                class="inline-flex items-center gap-1.5 px-5 py-2 rounded-lg bg-primary-600 hover:bg-primary-700 text-white font-bold text-xs shadow-xs transition-all">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                            <span>{{ $isEdit ? 'Simpan Perubahan' : 'Tambah Rumah Sakit' }}</span>
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
                        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
                        maxZoom: 19
                    }).addTo(this.map);

                    const rsIcon = typeof window.getHospital3DIcon === 'function' 
                        ? window.getHospital3DIcon({ size: 48 }) 
                        : undefined;

                    this.marker = L.marker([initialLat, initialLng], { 
                        draggable: true,
                        icon: rsIcon
                    }).addTo(this.map);

                    this.marker.bindPopup('<div class="font-bold text-xs text-slate-800">Rumah Sakit Rujukan</div><div class="text-[11px] text-slate-500">Geser atau klik peta untuk atur lokasi</div>');

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
