<div>
    <!-- Header -->
    <div class="mb-8 flex flex-col lg:flex-row lg:items-end lg:justify-between gap-6">
        <div class="flex-1">
            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-extrabold bg-white/20 text-white uppercase tracking-wider mb-2.5 shadow-sm border border-white/20 backdrop-blur-md">
                Pusat Kendali Operasional
            </span>
            <h1 class="text-2xl sm:text-[32px] font-extrabold text-white tracking-tight drop-shadow-md leading-tight">
                Manajemen Order Masuk
            </h1>
            <p class="text-white/90 text-[15px] sm:text-base mt-2 font-medium leading-relaxed drop-shadow-sm max-w-2xl">
                Kelola seluruh pesanan darurat, tugaskan ambulans, dan ubah status operasional.
            </p>
        </div>

        <div class="flex flex-wrap items-center gap-3">
            <!-- Search -->
            <input type="text" wire:model.live.debounce.300ms="search"
                   placeholder="Cari order, pasien, lokasi..."
                   class="px-4 py-2.5 rounded-xl border border-slate-300 bg-white text-sm font-medium focus:border-sky-500 focus:ring-2 focus:ring-sky-200 shadow-xs">

            <!-- Filter Status -->
            <select wire:model.live="statusFilter"
                    class="px-4 py-2.5 rounded-xl border border-slate-300 bg-white text-sm font-semibold focus:border-sky-500 focus:ring-2 focus:ring-sky-200 shadow-xs">
                <option value="">-- Semua Status --</option>
                <option value="menunggu">Menunggu Penugasan</option>
                <option value="diproses">Ditugaskan (Diproses)</option>
                <option value="menuju_lokasi">Menuju Lokasi Jemput</option>
                <option value="membawa_pasien">Membawa Pasien ke RS</option>
                <option value="selesai">Selesai</option>
                <option value="dibatalkan">Dibatalkan</option>
            </select>

            <!-- Tombol Tambah Order (Hotline Manual) -->
            <button type="button" wire:click="openCreateModal"
                    class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-sky-600 hover:bg-sky-700 text-white font-bold text-sm shadow-md shadow-sky-600/30 transition-all">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/>
                </svg>
                <span>Pesanan Baru (Hotline)</span>
            </button>
        </div>
    </div>

    <!-- Table Orders -->
    <div class="bg-white rounded-3xl border border-slate-200/80 shadow-xs overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50/80 border-b border-slate-200 text-[11px] font-bold text-slate-500 uppercase tracking-wider">
                        <th class="py-3 px-4">Kode & Waktu</th>
                        <th class="py-3 px-4">Pasien & Darurat</th>
                        <th class="py-3 px-4">Lokasi Jemput</th>
                        <th class="py-3 px-4">Armada & Supir</th>
                        <th class="py-3 px-4">Status</th>
                        <th class="py-3 px-4 text-right" style="white-space: nowrap;">Aksi Operasional</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-sm">
                    @forelse($orders as $order)
                        <tr class="hover:bg-slate-50/50 transition-colors">
                            <!-- Kode -->
                            <td class="py-3 px-4">
                                <span class="font-extrabold text-slate-800 block">{{ $order->kode_order }}</span>
                                <span class="text-xs text-slate-500 block">{{ $order->created_at->format('d M Y, H:i') }} WIB</span>
                            </td>

                            <!-- Pasien -->
                            <td class="py-3 px-4">
                                <span class="font-extrabold text-slate-800 block">{{ $order->nama_pasien }}</span>
                                <span class="text-xs text-slate-500 block line-clamp-1">{{ $order->kondisi_pasien ?: '-' }}</span>
                            </td>

                            <!-- Lokasi -->
                            <td class="py-3 px-4">
                                <span class="font-semibold text-slate-700 block text-xs max-w-xs truncate" title="{{ $order->lokasi_jemput }}">
                                    {{ $order->lokasi_jemput }}
                                </span>
                                @if($order->rumahSakit)
                                    <span class="text-[11px] font-bold text-sky-600 block mt-0.5">RS: {{ $order->rumahSakit->nama }}</span>
                                @endif
                            </td>

                            <!-- Armada & Supir -->
                            <td class="py-3 px-4">
                                @if($order->ambulans && $order->supir)
                                    <div class="text-xs">
                                        <span class="font-bold text-slate-800 block">{{ $order->ambulans->kode_ambulans }} ({{ $order->ambulans->plat_nomor }})</span>
                                        <span class="text-slate-500 block">Supir: {{ $order->supir->user->name ?? '-' }}</span>
                                    </div>
                                @else
                                    <span class="inline-block px-2.5 py-1 rounded-lg text-xs font-bold bg-amber-50 text-amber-700 border border-amber-200">
                                        Belum Ditugaskan
                                    </span>
                                @endif
                            </td>

                            <!-- Status -->
                            <td class="py-3 px-4">
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-extrabold
                                    @if($order->status === 'menunggu') bg-amber-100 text-amber-800 border border-amber-300
                                    @elseif(in_array($order->status, ['diproses', 'menuju_lokasi', 'membawa_pasien'])) bg-sky-100 text-sky-700 border border-sky-200 animate-pulse
                                    @elseif($order->status === 'selesai') bg-emerald-100 text-emerald-700 border border-emerald-200
                                    @else bg-slate-100 text-slate-600 border border-slate-200 @endif">
                                    <span class="w-2 h-2 rounded-full @if(in_array($order->status, ['diproses', 'menuju_lokasi', 'membawa_pasien'])) bg-sky-600 animate-ping @else bg-current @endif"></span>
                                    <span>{{ $order->status_label }}</span>
                                </span>
                            </td>

                            <!-- Aksi -->
                            <td class="py-3 px-4 text-right" style="white-space: nowrap;">
                                <div class="flex items-center justify-end gap-1.5" style="flex-wrap: nowrap;">
                                    <!-- Link Tracking -->
                                    <a href="{{ route('masyarakat.tracking', $order->id) }}" target="_blank"
                                       class="p-1.5 rounded-lg bg-slate-100 hover:bg-slate-200 text-slate-600 transition-colors border border-slate-200" title="Lihat Peta Realtime" style="flex-shrink: 0;">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                        </svg>
                                    </a>

                                    <!-- Detail -->
                                    <button type="button" wire:click="openDetailModal({{ $order->id }})"
                                            class="px-2.5 py-1 rounded-lg bg-white border border-slate-200 hover:bg-slate-50 text-slate-600 font-semibold text-[11px] transition-colors" style="flex-shrink: 0;">
                                        Detail
                                    </button>

                                    <!-- Edit -->
                                    <button type="button" wire:click="openEditModal({{ $order->id }})"
                                            class="px-2.5 py-1 rounded-lg bg-white border border-slate-200 hover:bg-slate-50 text-slate-600 font-semibold text-[11px] transition-colors" style="flex-shrink: 0;">
                                        Edit
                                    </button>

                                    <!-- Tugaskan / Selesai -->
                                    @if($order->status === 'menunggu')
                                        <button type="button" wire:click="openAssignModal({{ $order->id }})"
                                                class="px-2.5 py-1 rounded-lg bg-sky-600 hover:bg-sky-700 text-white font-bold text-[11px] shadow-sm transition-colors" style="flex-shrink: 0;">
                                            Tugaskan
                                        </button>
                                    @elseif(in_array($order->status, ['diproses', 'menuju_lokasi', 'membawa_pasien']))
                                        <button type="button" wire:click="updateStatus({{ $order->id }}, 'selesai')"
                                                wire:confirm="Tandai pesanan ini selesai ditangani di RS?"
                                                class="px-2.5 py-1 rounded-lg bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-[11px] shadow-sm transition-colors" style="flex-shrink: 0;">
                                            Selesai
                                        </button>
                                    @endif

                                    <!-- Hapus -->
                                    <button type="button" wire:click="deleteOrder({{ $order->id }})"
                                            wire:confirm="Yakin ingin menghapus pesanan ini dari database?"
                                            class="px-2.5 py-1 rounded-lg bg-red-50 hover:bg-red-100 text-red-600 font-semibold text-[11px] transition-colors" style="flex-shrink: 0;">
                                        Hapus
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="py-12 text-center text-slate-400">
                                <p class="text-sm font-semibold">Belum ada data order</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="px-6 py-4 border-t border-slate-100">
            {{ $orders->links() }}
        </div>
    </div>

    <!-- MODAL 1: ASSIGN ARMADA & SUPIR -->
    @if($showAssignModal)
        <div class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/70 backdrop-blur-xs">
            <div class="bg-white rounded-3xl max-w-lg w-full p-6 sm:p-8 shadow-2xl border border-slate-200">
                <div class="flex items-center justify-between mb-6 pb-4 border-b border-slate-100">
                    <h3 class="text-lg font-extrabold text-slate-800">Tugaskan Armada Ambulans</h3>
                    <button wire:click="closeAssignModal" class="text-slate-400 hover:text-slate-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>

                <!-- Map Radar Penugasan -->
                @if($assignOrderData)
                <div x-data="assignMapAlpine(@js($assignOrderData), @js($assignDriversData))" 
                     @select-driver.window="$wire.set('selectedSupirId', $event.detail.supir); $wire.set('selectedAmbulansId', $event.detail.amb);"
                     class="mb-6">
                    <p class="text-sm font-bold text-slate-700 mb-2">Peta Radar Armada Siaga</p>
                    <div class="p-1 border-2 border-slate-200 rounded-2xl bg-white shadow-sm">
                        <div x-ref="mapContainer" class="h-64 w-full rounded-xl z-0" wire:ignore></div>
                    </div>
                    <p class="text-xs text-slate-500 mt-2 flex items-center gap-2">
                        <span>📍 Merah: Pasien</span>
                        <span>|</span>
                        <span>🚑 Hijau: Ambulans Siaga (Klik untuk tugaskan)</span>
                    </p>
                </div>
                @endif

                <form wire:submit="assignOrder" class="space-y-5">
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-2">Pilih Unit Ambulans Siaga</label>
                        <select wire:model="selectedAmbulansId" required
                                class="w-full px-4 py-3 rounded-xl border border-slate-300 text-sm font-semibold focus:border-sky-500 focus:ring-2 focus:ring-sky-200">
                            <option value="">-- Pilih Ambulans --</option>
                            @foreach($availableAmbulances as $amb)
                                <option value="{{ $amb->id }}">{{ $amb->kode_ambulans }} - {{ $amb->plat_nomor }} ({{ $amb->jenis_ambulans }})</option>
                            @endforeach
                        </select>
                        @error('selectedAmbulansId') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-2">Pilih Supir Ambulans</label>
                        <select wire:model="selectedSupirId" required
                                class="w-full px-4 py-3 rounded-xl border border-slate-300 text-sm font-semibold focus:border-sky-500 focus:ring-2 focus:ring-sky-200">
                            <option value="">-- Pilih Supir --</option>
                            @foreach($onlineSupirs as $spr)
                                <option value="{{ $spr->id }}">{{ $spr->user->name ?? 'Supir ID ' . $spr->id }} (SIM: {{ $spr->nomor_sim ?? '-' }})</option>
                            @endforeach
                        </select>
                        @error('selectedSupirId') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="flex gap-3 pt-4 border-t border-slate-100">
                        <button type="submit"
                                class="flex-1 py-3.5 rounded-xl bg-sky-600 hover:bg-sky-700 text-white font-extrabold text-sm shadow-lg shadow-sky-600/30 transition-all">
                            TUGASKAN SEKARANG
                        </button>
                        <button type="button" wire:click="closeAssignModal"
                                class="px-5 py-3.5 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-600 font-bold text-sm transition-colors">
                            Batal
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endif

    <!-- MODAL 2: CREATE MANUAL ORDER (HOTLINE) -->
    @if($showCreateModal)
        <div class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/70 backdrop-blur-xs overflow-y-auto">
            <div class="bg-white rounded-3xl max-w-lg w-full p-6 sm:p-8 shadow-2xl border border-slate-200 my-8">
                <div class="flex items-center justify-between mb-6 pb-4 border-b border-slate-100">
                    <h3 class="text-lg font-extrabold text-slate-800">Buat Pesanan Darurat (Hotline Manual)</h3>
                    <button wire:click="$set('showCreateModal', false)" class="text-slate-400 hover:text-slate-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>

                <form wire:submit="saveManualOrder" class="space-y-4">
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Nama Pasien / Pemanggil</label>
                        <input type="text" wire:model="nama_pasien" required placeholder="Contoh: Bpk. Ahmad"
                               class="w-full px-4 py-2.5 rounded-xl border border-slate-300 text-sm font-medium focus:border-sky-500 focus:ring-2 focus:ring-sky-200">
                        @error('nama_pasien') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Kondisi Darurat / Kejadian</label>
                        <input type="text" wire:model="kondisi_pasien" required placeholder="Contoh: Sesak nafas akut mendadak"
                               class="w-full px-4 py-2.5 rounded-xl border border-slate-300 text-sm font-medium focus:border-sky-500 focus:ring-2 focus:ring-sky-200">
                        @error('kondisi_pasien') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Alamat / Lokasi Penjemputan</label>
                        <input type="text" wire:model="lokasi_jemput" required placeholder="Jl. Gatot Subroto No. 45, Cilacap..."
                               class="w-full px-4 py-2.5 rounded-xl border border-slate-300 text-sm font-medium focus:border-sky-500 focus:ring-2 focus:ring-sky-200">
                        @error('lokasi_jemput') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Pilih Rumah Sakit Tujuan (Rujukan)</label>
                        <select wire:model="rumah_sakit_id"
                                class="w-full px-4 py-2.5 rounded-xl border border-slate-300 text-sm font-semibold focus:border-sky-500 focus:ring-2 focus:ring-sky-200">
                            <option value="">-- Pilihlah RS Rujukan (Opsional) --</option>
                            @foreach($rumahSakits as $rs)
                                <option value="{{ $rs->id }}">{{ $rs->nama }}</option>
                            @endforeach
                        </select>
                        @error('rumah_sakit_id') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="flex gap-3 pt-4 border-t border-slate-100">
                        <button type="submit"
                                class="flex-1 py-3.5 rounded-xl bg-sky-600 hover:bg-sky-700 text-white font-extrabold text-sm shadow-lg shadow-sky-600/30 transition-all">
                            BUAT PESANAN DARURAT
                        </button>
                        <button type="button" wire:click="$set('showCreateModal', false)"
                                class="px-5 py-3.5 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-600 font-bold text-sm transition-colors">
                            Batal
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endif

    <!-- MODAL 3: EDIT ORDER -->
    @if($showEditModal)
        <div class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/70 backdrop-blur-xs overflow-y-auto">
            <div class="bg-white rounded-3xl max-w-lg w-full p-6 sm:p-8 shadow-2xl border border-slate-200 my-8">
                <div class="flex items-center justify-between mb-6 pb-4 border-b border-slate-100">
                    <h3 class="text-lg font-extrabold text-slate-800">Edit Detail Pesanan</h3>
                    <button wire:click="$set('showEditModal', false)" class="text-slate-400 hover:text-slate-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>

                <form wire:submit="saveEditOrder" class="space-y-4">
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Nama Pasien</label>
                        <input type="text" wire:model="edit_nama_pasien" required
                               class="w-full px-4 py-2.5 rounded-xl border border-slate-300 text-sm font-medium focus:border-sky-500 focus:ring-2 focus:ring-sky-200">
                        @error('edit_nama_pasien') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Kondisi Pasien / Darurat</label>
                        <input type="text" wire:model="edit_kondisi_pasien" required
                               class="w-full px-4 py-2.5 rounded-xl border border-slate-300 text-sm font-medium focus:border-sky-500 focus:ring-2 focus:ring-sky-200">
                        @error('edit_kondisi_pasien') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Alamat Penjemputan</label>
                        <input type="text" wire:model="edit_lokasi_jemput" required
                               class="w-full px-4 py-2.5 rounded-xl border border-slate-300 text-sm font-medium focus:border-sky-500 focus:ring-2 focus:ring-sky-200">
                        @error('edit_lokasi_jemput') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Rumah Sakit Tujuan</label>
                        <select wire:model="edit_rumah_sakit_id"
                                class="w-full px-4 py-2.5 rounded-xl border border-slate-300 text-sm font-semibold focus:border-sky-500 focus:ring-2 focus:ring-sky-200">
                            <option value="">-- Pilihlah RS Rujukan --</option>
                            @foreach($rumahSakits as $rs)
                                <option value="{{ $rs->id }}">{{ $rs->nama }}</option>
                            @endforeach
                        </select>
                        @error('edit_rumah_sakit_id') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Status Pesanan</label>
                        <select wire:model="edit_status" required
                                class="w-full px-4 py-2.5 rounded-xl border border-slate-300 text-sm font-semibold focus:border-sky-500 focus:ring-2 focus:ring-sky-200">
                            <option value="menunggu">Menunggu Penugasan</option>
                            <option value="diproses">Ditugaskan (Diproses)</option>
                            <option value="menuju_lokasi">Menuju Lokasi Jemput</option>
                            <option value="membawa_pasien">Membawa Pasien ke RS</option>
                            <option value="selesai">Selesai</option>
                            <option value="dibatalkan">Dibatalkan</option>
                        </select>
                        @error('edit_status') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="flex gap-3 pt-4 border-t border-slate-100">
                        <button type="submit"
                                class="flex-1 py-3.5 rounded-xl bg-sky-600 hover:bg-sky-700 text-white font-extrabold text-sm shadow-lg shadow-sky-600/30 transition-all">
                            SIMPAN PERUBAHAN
                        </button>
                        <button type="button" wire:click="$set('showEditModal', false)"
                                class="px-5 py-3.5 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-600 font-bold text-sm transition-colors">
                            Batal
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endif

    <!-- MODAL 4: DETAIL ORDER & FOTO VERIFIKASI -->
    @if($showDetailModal && $detailOrder)
        <div class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/80 backdrop-blur-sm overflow-y-auto" x-data="{ zoomPhoto: false }">
            <div class="bg-white rounded-3xl max-w-4xl w-full shadow-2xl border border-slate-200 my-8 flex flex-col max-h-[90vh]">
                
                <!-- Modal Header -->
                <div class="flex items-center justify-between p-6 border-b border-slate-100 bg-slate-50/50 rounded-t-3xl shrink-0">
                    <div>
                        <h3 class="text-xl font-extrabold text-slate-800">Detail Pesanan #{{ $detailOrder->kode_order }}</h3>
                        <p class="text-xs font-semibold text-slate-500 mt-1">Dibuat pada: {{ $detailOrder->created_at->format('d M Y, H:i') }} WIB</p>
                    </div>
                    <button wire:click="closeDetailModal" class="p-2 rounded-xl hover:bg-slate-200 text-slate-400 hover:text-slate-600 transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>

                <!-- Modal Body -->
                <div class="p-6 overflow-y-auto space-y-8">
                    
                    <!-- Section: Info Darurat -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <h4 class="text-sm font-bold text-slate-800 mb-3 flex items-center gap-2">
                                <span class="w-1.5 h-4 bg-sky-500 rounded-full"></span> Info Darurat & Pasien
                            </h4>
                            <div class="bg-slate-50 rounded-2xl p-4 border border-slate-100 space-y-3">
                                <div>
                                    <span class="block text-[10px] font-bold text-slate-400 uppercase tracking-wider">Nama Pasien</span>
                                    <span class="block text-sm font-bold text-slate-800">{{ $detailOrder->nama_pasien }}</span>
                                </div>
                                <div>
                                    <span class="block text-[10px] font-bold text-slate-400 uppercase tracking-wider">Kondisi Darurat</span>
                                    <span class="block text-sm font-semibold text-slate-700">{{ $detailOrder->kondisi_pasien ?: '-' }}</span>
                                </div>
                                <div>
                                    <span class="block text-[10px] font-bold text-slate-400 uppercase tracking-wider">Catatan Tambahan</span>
                                    <span class="block text-sm font-semibold text-slate-700">{{ $detailOrder->catatan_tambahan ?: 'Tidak ada' }}</span>
                                </div>
                            </div>
                        </div>

                        <div>
                            <h4 class="text-sm font-bold text-slate-800 mb-3 flex items-center gap-2">
                                <span class="w-1.5 h-4 bg-emerald-500 rounded-full"></span> Status & Penugasan
                            </h4>
                            <div class="bg-slate-50 rounded-2xl p-4 border border-slate-100 space-y-3">
                                <div>
                                    <span class="block text-[10px] font-bold text-slate-400 uppercase tracking-wider">Status Operasional</span>
                                    <span class="inline-block mt-1 px-3 py-1 rounded-lg text-xs font-bold bg-slate-200 text-slate-800">{{ $detailOrder->status_label }}</span>
                                </div>
                                <div>
                                    <span class="block text-[10px] font-bold text-slate-400 uppercase tracking-wider">Armada Ambulans</span>
                                    <span class="block text-sm font-bold text-slate-800">{{ $detailOrder->ambulans ? $detailOrder->ambulans->kode_ambulans . ' (' . $detailOrder->ambulans->plat_nomor . ')' : 'Belum ditugaskan' }}</span>
                                </div>
                                <div>
                                    <span class="block text-[10px] font-bold text-slate-400 uppercase tracking-wider">RS Tujuan Rujukan</span>
                                    <span class="block text-sm font-bold text-sky-700">{{ $detailOrder->tujuan_lokasi ?: 'Ditentukan Operator' }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Section: Verifikasi Lokasi & Foto -->
                    <div>
                        <h4 class="text-sm font-bold text-slate-800 mb-3 flex items-center gap-2">
                            <span class="w-1.5 h-4 bg-amber-500 rounded-full"></span> Verifikasi Lokasi Pemesan (GPS Camera)
                        </h4>
                        
                        <div class="bg-white rounded-2xl border border-slate-200 overflow-hidden">
                            @if($detailOrder->photo_path)
                                <div class="grid grid-cols-1 md:grid-cols-5 divide-y md:divide-y-0 md:divide-x divide-slate-100">
                                    
                                    <!-- Foto Section (Col 1-3) -->
                                    <div class="md:col-span-3 p-4 bg-slate-50 flex flex-col items-center justify-center">
                                        <div class="relative rounded-xl overflow-hidden shadow-md cursor-pointer group" @click="zoomPhoto = true">
                                            <img src="{{ asset('storage/' . $detailOrder->photo_path) }}" alt="Foto Verifikasi" class="w-full max-h-[400px] object-contain bg-slate-900">
                                            <div class="absolute inset-0 bg-black/40 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                                                <span class="px-4 py-2 bg-white/20 backdrop-blur-md rounded-lg text-white font-bold text-sm flex items-center gap-2 border border-white/30">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"></path></svg>
                                                    Perbesar Foto
                                                </span>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Info Meta Section (Col 4-5) -->
                                    <div class="md:col-span-2 p-5 space-y-4">
                                        <div>
                                            <span class="block text-[10px] font-bold text-slate-400 uppercase tracking-wider">Status Verifikasi</span>
                                            <span class="inline-flex items-center gap-1 mt-1 px-2.5 py-1 rounded-md text-[11px] font-bold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                                Terverifikasi Otomatis
                                            </span>
                                        </div>

                                        <div>
                                            <span class="block text-[10px] font-bold text-slate-400 uppercase tracking-wider">Waktu Pengambilan</span>
                                            <span class="block text-sm font-semibold text-slate-800">{{ $detailOrder->photo_taken_at ? \Carbon\Carbon::parse($detailOrder->photo_taken_at)->format('d F Y, H:i:s') : '-' }}</span>
                                        </div>

                                        <div>
                                            <span class="block text-[10px] font-bold text-slate-400 uppercase tracking-wider">Akurasi GPS</span>
                                            <span class="block text-sm font-semibold text-slate-800">{{ $detailOrder->photo_accuracy ? $detailOrder->photo_accuracy . ' Meter' : 'Tidak diketahui' }}</span>
                                        </div>

                                        <div>
                                            <span class="block text-[10px] font-bold text-slate-400 uppercase tracking-wider">Koordinat (Lat, Lng)</span>
                                            <a href="https://maps.google.com/?q={{ $detailOrder->photo_latitude }},{{ $detailOrder->photo_longitude }}" target="_blank"
                                               class="inline-flex items-center gap-1 mt-1 text-sm font-bold text-sky-600 hover:text-sky-700 hover:underline">
                                                {{ $detailOrder->photo_latitude }}, {{ $detailOrder->photo_longitude }}
                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                                            </a>
                                        </div>

                                        <div>
                                            <span class="block text-[10px] font-bold text-slate-400 uppercase tracking-wider">Alamat Lengkap (Reverse Geocoding)</span>
                                            <span class="block text-sm font-semibold text-slate-700 leading-snug">{{ $detailOrder->photo_address ?: '-' }}</span>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="p-8 text-center bg-slate-50">
                                    <div class="w-12 h-12 bg-slate-200 rounded-full flex items-center justify-center mx-auto mb-3 text-slate-400">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    </div>
                                    <p class="text-sm font-bold text-slate-600">Foto Verifikasi Tidak Tersedia</p>
                                    <p class="text-xs text-slate-500 mt-1">Pesanan ini mungkin dibuat sebelum fitur verifikasi foto diaktifkan, atau dibuat secara manual oleh operator.</p>
                                </div>
                            @endif
                        </div>
                    </div>

                </div>
                
                <!-- Modal Footer -->
                <div class="p-5 border-t border-slate-100 bg-slate-50 rounded-b-3xl flex justify-end shrink-0">
                    <button type="button" wire:click="closeDetailModal" class="px-6 py-2.5 rounded-xl bg-slate-800 hover:bg-slate-900 text-white font-bold text-sm shadow-md transition-colors">
                        Tutup Detail
                    </button>
                </div>
            </div>

            <!-- Fullscreen Image Zoom (Alpine.js) -->
            <div x-show="zoomPhoto" style="display: none;" 
                 class="fixed inset-0 z-[60] bg-black/95 flex items-center justify-center p-4 cursor-zoom-out backdrop-blur-md"
                 @click="zoomPhoto = false"
                 @keydown.escape.window="zoomPhoto = false">
                @if($detailOrder->photo_path)
                    <img src="{{ asset('storage/' . $detailOrder->photo_path) }}" class="max-w-full max-h-full object-contain shadow-2xl rounded-lg" @click.stop="">
                @endif
                <button type="button" class="absolute top-6 right-6 p-3 bg-white/10 hover:bg-white/20 text-white rounded-full transition-colors backdrop-blur-md border border-white/20" @click="zoomPhoto = false">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>
        </div>
    @endif

    <!-- Leaflet Script for Assign Map -->
    <script>
        document.addEventListener('alpine:init', () => {
            if (!Alpine.data('assignMapAlpine')) {
                Alpine.data('assignMapAlpine', (orderData, driversData) => ({
                    map: null,
                    init() {
                        setTimeout(() => {
                            if (!this.$refs.mapContainer) return;
                            
                            this.map = L.map(this.$refs.mapContainer).setView([orderData.lat, orderData.lng], 13);
                            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                                attribution: '&copy; OpenStreetMap',
                                maxZoom: 19
                            }).addTo(this.map);

                            const bounds = L.latLngBounds([]);

                            // Titik Pasien (Merah)
                            const patientIcon = L.divIcon({
                                className: 'custom-div-icon',
                                html: `<div style="font-size: 24px; text-shadow: 2px 2px 4px rgba(0,0,0,0.5); text-align: center; margin-top:-10px;">📍</div>`,
                                iconSize: [30, 30],
                                iconAnchor: [15, 30]
                            });
                            L.marker([orderData.lat, orderData.lng], {icon: patientIcon}).addTo(this.map)
                                .bindPopup(`<b>📍 Lokasi Pasien</b><br>${orderData.nama}`);
                            bounds.extend([orderData.lat, orderData.lng]);

                            // Titik Armada (Hijau)
                            driversData.forEach(d => {
                                const driverIcon = L.divIcon({
                                    className: 'custom-div-icon',
                                    html: `<div style="background-color: #10b981; width: 20px; height: 20px; border-radius: 50%; border: 3px solid white; box-shadow: 0 0 10px rgba(0,0,0,0.5); display: flex; align-items: center; justify-content: center; color: white; font-size: 10px; font-weight: bold;"></div>`,
                                    iconSize: [20, 20],
                                    iconAnchor: [10, 10]
                                });
                                
                                const marker = L.marker([d.lat, d.lng], {icon: driverIcon}).addTo(this.map);
                                marker.bindPopup(`
                                    <div class="text-center">
                                        <b class="text-slate-800">${d.nama}</b><br>
                                        <span class="text-xs text-slate-500">${d.kode_ambulans}</span><br>
                                        <button type="button" class="mt-2 w-full text-xs font-bold bg-sky-600 text-white px-3 py-1.5 rounded-lg shadow hover:bg-sky-700" 
                                                onclick="window.dispatchEvent(new CustomEvent('select-driver', {detail: {supir: ${d.id}, amb: ${d.ambulans_id || 'null'}}}))">
                                            Pilih Supir Ini
                                        </button>
                                    </div>
                                `);
                                bounds.extend([d.lat, d.lng]);
                            });

                            if (bounds.isValid()) {
                                this.map.fitBounds(bounds, { padding: [30, 30] });
                            }
                        }, 200);
                    }
                }));
            }
        });
    </script>
</div>
