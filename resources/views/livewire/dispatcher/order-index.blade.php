<div>
    <!-- Header -->
    <div class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-slate-200 text-slate-700 uppercase tracking-wider mb-2">
                Pusat Kendali Operasional
            </span>
            <h1 class="text-2xl sm:text-3xl font-extrabold text-slate-800 tracking-tight">Manajemen Order Masuk</h1>
            <p class="text-slate-500 text-sm mt-1">Kelola seluruh pesanan darurat, tugaskan ambulans, dan ubah status operasional.</p>
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
                <span>+ Pesanan Baru (Hotline)</span>
            </button>
        </div>
    </div>

    <!-- Table Orders -->
    <div class="bg-white rounded-3xl border border-slate-200/80 shadow-xs overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50/80 border-b border-slate-200 text-[11px] font-bold text-slate-500 uppercase tracking-wider">
                        <th class="py-4 px-6">Kode & Waktu</th>
                        <th class="py-4 px-6">Pasien & Darurat</th>
                        <th class="py-4 px-6">Lokasi Jemput</th>
                        <th class="py-4 px-6">Armada & Supir</th>
                        <th class="py-4 px-6">Status</th>
                        <th class="py-4 px-6 text-right">Aksi Operasional</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-sm">
                    @forelse($orders as $order)
                        <tr class="hover:bg-slate-50/50 transition-colors">
                            <!-- Kode -->
                            <td class="py-4 px-6">
                                <span class="font-extrabold text-slate-800 block">{{ $order->kode_order }}</span>
                                <span class="text-xs text-slate-500 block">{{ $order->created_at->format('d M Y, H:i') }} WIB</span>
                            </td>

                            <!-- Pasien -->
                            <td class="py-4 px-6">
                                <span class="font-extrabold text-slate-800 block">{{ $order->nama_pasien }}</span>
                                <span class="text-xs text-slate-500 block line-clamp-1">{{ $order->kondisi_pasien ?: '-' }}</span>
                            </td>

                            <!-- Lokasi -->
                            <td class="py-4 px-6">
                                <span class="font-semibold text-slate-700 block text-xs max-w-xs truncate" title="{{ $order->lokasi_jemput }}">
                                    {{ $order->lokasi_jemput }}
                                </span>
                                @if($order->rumahSakit)
                                    <span class="text-[11px] font-bold text-sky-600 block mt-0.5">RS: {{ $order->rumahSakit->nama }}</span>
                                @endif
                            </td>

                            <!-- Armada & Supir -->
                            <td class="py-4 px-6">
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
                            <td class="py-4 px-6">
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
                            <td class="py-4 px-6 text-right">
                                <div class="flex items-center justify-end gap-1.5 flex-wrap">
                                    <!-- Link Tracking -->
                                    <a href="{{ route('masyarakat.tracking', $order->id) }}" target="_blank"
                                       class="p-2 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 transition-colors" title="Lihat Peta Realtime">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                        </svg>
                                    </a>

                                    <!-- Edit -->
                                    <button type="button" wire:click="openEditModal({{ $order->id }})"
                                            class="px-3 py-1.5 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold text-xs transition-colors">
                                        Edit
                                    </button>

                                    <!-- Tugaskan / Selesai -->
                                    @if($order->status === 'menunggu')
                                        <button type="button" wire:click="openAssignModal({{ $order->id }})"
                                                class="px-3.5 py-1.5 rounded-xl bg-sky-600 hover:bg-sky-700 text-white font-extrabold text-xs shadow-md shadow-sky-600/30 transition-all">
                                            Tugaskan
                                        </button>
                                    @elseif(in_array($order->status, ['diproses', 'menuju_lokasi', 'membawa_pasien']))
                                        <button type="button" wire:click="updateStatus({{ $order->id }}, 'selesai')"
                                                wire:confirm="Tandai pesanan ini selesai ditangani di RS?"
                                                class="px-3 py-1.5 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs transition-colors">
                                            Selesai
                                        </button>
                                    @endif

                                    <!-- Hapus -->
                                    <button type="button" wire:click="deleteOrder({{ $order->id }})"
                                            wire:confirm="Yakin ingin menghapus pesanan ini dari database?"
                                            class="px-3 py-1.5 rounded-xl bg-red-50 hover:bg-red-100 text-red-600 font-bold text-xs transition-colors">
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
</div>
