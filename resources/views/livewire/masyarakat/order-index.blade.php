<div>
    <!-- Header -->
    <div class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-slate-200 text-slate-700 uppercase tracking-wider mb-2">
                Riwayat & Monitoring
            </span>
            <h1 class="text-2xl sm:text-3xl font-extrabold text-slate-800 tracking-tight">Daftar Pesanan Ambulans Saya</h1>
            <p class="text-slate-500 text-sm mt-1">Pantau perjalanan armada ambulans yang Anda pesan secara langsung via satelit.</p>
        </div>

        <div class="flex items-center gap-3">
            <select wire:model.live="statusFilter"
                    class="px-4 py-2.5 rounded-xl border border-slate-300 bg-white text-slate-700 text-sm font-semibold focus:border-sky-500 focus:ring-2 focus:ring-sky-200 shadow-xs">
                <option value="">-- Semua Status --</option>
                <option value="menunggu">Menunggu Dispatcher</option>
                <option value="diproses">Ditugaskan (Diproses)</option>
                <option value="menuju_lokasi">Menuju Lokasi Jemput</option>
                <option value="membawa_pasien">Membawa Pasien ke RS</option>
                <option value="selesai">Selesai</option>
                <option value="dibatalkan">Dibatalkan</option>
            </select>
            <a href="{{ route('masyarakat.order.create') }}"
               class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-sky-600 hover:bg-sky-700 text-white font-bold text-sm shadow-md transition-all">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                <span>Pesan Baru</span>
            </a>
        </div>
    </div>

    <!-- Orders Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        @forelse($orders as $order)
            <div class="bg-white rounded-3xl border border-slate-200/80 p-6 shadow-xs hover:shadow-md transition-shadow flex flex-col justify-between">
                <div>
                    <!-- Top row: ID & Status Badge -->
                    <div class="flex items-center justify-between mb-4 pb-3 border-b border-slate-100">
                        <div>
                            <span class="text-xs font-black text-slate-400 block">{{ $order->waktu_pesan ? $order->waktu_pesan->translatedFormat('d M Y, H:i') : '-' }}</span>
                            <span class="text-sm font-extrabold text-slate-800 tracking-wider">{{ $order->kode_order }}</span>
                        </div>
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold
                            @if($order->status === 'menunggu') bg-amber-100 text-amber-700 border border-amber-200
                            @elseif(in_array($order->status, ['diproses', 'menuju_lokasi', 'membawa_pasien'])) bg-blue-100 text-blue-700 border border-blue-200 animate-pulse
                            @elseif($order->status === 'selesai') bg-emerald-100 text-emerald-700 border border-emerald-200
                            @else bg-slate-100 text-slate-600 border border-slate-200 @endif">
                            <span class="w-2 h-2 rounded-full @if(in_array($order->status, ['diproses', 'menuju_lokasi', 'membawa_pasien'])) bg-blue-600 animate-ping @else bg-current @endif"></span>
                            <span>{{ $order->status_label }}</span>
                        </span>
                    </div>

                    <!-- Patient & Pickup Info -->
                    <div class="space-y-2 mb-4 text-sm">
                        <div class="flex items-start gap-2">
                            <svg class="w-5 h-5 text-sky-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                            <div>
                                <span class="text-xs text-slate-400 font-semibold block">PASIEN</span>
                                <span class="font-bold text-slate-800">{{ $order->nama_pasien }}</span>
                                @if($order->kondisi_pasien)
                                    <p class="text-xs text-slate-600 mt-0.5 line-clamp-1">{{ $order->kondisi_pasien }}</p>
                                @endif
                            </div>
                        </div>

                        <div class="flex items-start gap-2">
                            <svg class="w-5 h-5 text-blue-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            </svg>
                            <div>
                                <span class="text-xs text-slate-400 font-semibold block">LOKASI JEMPUT</span>
                                <span class="font-bold text-slate-700 text-xs">{{ $order->lokasi_jemput }}</span>
                            </div>
                        </div>

                        @if($order->tujuan_lokasi || $order->rumahSakit)
                            <div class="flex items-start gap-2">
                                <svg class="w-5 h-5 text-emerald-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                </svg>
                                <div>
                                    <span class="text-xs text-slate-400 font-semibold block">RS RUJUKAN</span>
                                    <span class="font-bold text-slate-700 text-xs">{{ $order->tujuan_lokasi ?? $order->rumahSakit->nama }}</span>
                                </div>
                            </div>
                        @endif

                        @if($order->ambulans && $order->supir)
                            <div class="p-3 rounded-xl bg-slate-50 border border-slate-200/80 mt-3 flex items-center justify-between text-xs font-semibold">
                                <div>
                                    <span class="text-slate-500">Armada: </span>
                                    <span class="text-slate-800 font-bold">{{ $order->ambulans->kode_ambulans }}</span>
                                </div>
                                <div>
                                    <span class="text-slate-500">Supir: </span>
                                    <span class="text-slate-800 font-bold">{{ $order->supir->user->name }}</span>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Footer Action Buttons -->
                <div class="pt-4 border-t border-slate-100 flex items-center justify-between gap-3">
                    <a href="{{ route('masyarakat.tracking', $order->id) }}"
                       class="flex-1 py-2.5 rounded-xl bg-slate-900 hover:bg-sky-600 text-white text-center font-bold text-xs transition-colors shadow-xs">
                        PANTAU GPS REALTIME
                    </a>

                    @if($order->status === 'menunggu')
                        <button type="button" wire:click="cancelOrder({{ $order->id }})"
                                wire:confirm="Yakin ingin membatalkan pesanan ambulans ini?"
                                class="px-3.5 py-2.5 rounded-xl bg-amber-50 hover:bg-amber-100 text-amber-700 font-bold text-xs transition-colors border border-amber-200">
                            Batalkan
                        </button>
                    @elseif(in_array($order->status, ['dibatalkan', 'selesai']))
                        <button type="button" wire:click="deleteOrderHistory({{ $order->id }})"
                                wire:confirm="Yakin ingin menghapus riwayat pesanan ini?"
                                class="px-3.5 py-2.5 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-600 font-bold text-xs transition-colors">
                            Hapus
                        </button>
                    @endif
                </div>
            </div>
        @empty
            <div class="md:col-span-2 py-16 text-center bg-white rounded-3xl border border-slate-200/80 p-8">
                <div class="w-16 h-16 rounded-full bg-sky-50 text-sky-600 flex items-center justify-center mx-auto mb-4 border border-sky-100">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                    </svg>
                </div>
                <h3 class="font-bold text-slate-800 text-lg mb-1">Belum Ada Riwayat Pesanan</h3>
                <p class="text-slate-500 text-sm max-w-sm mx-auto mb-6">Jika terjadi situasi darurat medis, jangan ragu untuk memesan ambulans GSC gratis 24 jam.</p>
                <a href="{{ route('masyarakat.order.create') }}"
                   class="inline-flex items-center gap-2 px-6 py-3 rounded-2xl bg-sky-600 hover:bg-sky-700 text-white font-extrabold text-sm shadow-md transition-all">
                    <span>PESAN AMBULANS SEKARANG</span>
                </a>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    <div class="mt-8">
        {{ $orders->links() }}
    </div>
</div>
