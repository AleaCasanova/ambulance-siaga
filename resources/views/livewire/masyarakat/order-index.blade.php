<div>


    <div class="absolute top-0 left-0 w-full h-80 bg-primary-700 -z-10 overflow-hidden" style="background-image: url('{{ asset('images/beranda_utama_bg.jpg') }}'); background-size: cover; background-position: center; background-repeat: no-repeat;">
        <div class="absolute inset-0 bg-primary-700 mix-blend-multiply opacity-50"></div>
        <div class="absolute inset-0 bg-gradient-to-b from-primary-600/90 to-primary-800/90"></div>
    </div>

    <main class="pt-32 pb-24 px-6 lg:px-12 max-w-7xl mx-auto min-h-screen">
        <div class="relative z-10">
            <!-- Header -->
            <div class="mb-8 flex flex-col sm:flex-row sm:items-end sm:justify-between gap-6">
                <div>
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-white/20 text-white uppercase tracking-wider mb-3 backdrop-blur border border-white/20">
                        Riwayat & Monitoring
                    </span>
                    <h1 class="text-3xl sm:text-4xl font-black text-white tracking-tight drop-shadow-md">Daftar Pesanan Ambulans Saya</h1>
                    <p class="text-primary-100 text-sm sm:text-base mt-2 font-medium">Pantau perjalanan armada ambulans yang Anda pesan secara langsung via satelit.</p>
                </div>

                <div class="flex flex-col sm:flex-row items-center gap-3 w-full sm:w-auto">
                    <select wire:model.live="statusFilter"
                            class="w-full sm:w-auto px-4 py-3 rounded-xl border-0 bg-white/10 backdrop-blur text-white text-sm font-bold focus:ring-2 focus:ring-white/50 shadow-lg cursor-pointer">
                        <option value="" class="text-slate-800">Semua Status</option>
                        <option value="menunggu" class="text-slate-800">Menunggu Operator</option>
                        <option value="diproses" class="text-slate-800">Ditugaskan (Diproses)</option>
                        <option value="menuju_lokasi" class="text-slate-800">Menuju Lokasi Jemput</option>
                        <option value="membawa_pasien" class="text-slate-800">Membawa Pasien ke RS</option>
                        <option value="selesai" class="text-slate-800">Selesai</option>
                        <option value="dibatalkan" class="text-slate-800">Dibatalkan</option>
                    </select>
                    <a href="{{ route('masyarakat.order.create') }}"
                       class="w-full sm:w-auto inline-flex justify-center items-center gap-2 px-6 py-3 rounded-xl bg-white text-primary-600 font-black text-sm shadow-xl hover:bg-primary-50 transition-all hover:scale-105">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/>
                        </svg>
                        <span>Pesan Baru</span>
                    </a>
                </div>
            </div>

            <!-- Orders Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @forelse($orders as $order)
                    <div class="bg-white rounded-[2rem] border border-slate-100 p-6 sm:p-8 shadow-2xl shadow-black/10 hover:shadow-black/20 hover:-translate-y-1 transition-all flex flex-col justify-between group relative overflow-hidden">
                        
                        <!-- Accent Line Top -->
                        <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-sky-400 to-[#009CA6]"></div>

                        <div>
                            <!-- Top row: ID & Status Badge -->
                            <div class="flex items-center justify-between mb-5 pb-4 border-b border-slate-100">
                                <div>
                                    <span class="text-xs font-black text-slate-400 block uppercase tracking-widest">{{ $order->waktu_pesan ? $order->waktu_pesan->translatedFormat('d M Y, H:i') : '-' }}</span>
                                    <span class="text-base font-extrabold text-slate-800 tracking-wider">{{ $order->kode_order }}</span>
                                </div>
                                <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-[10px] font-black uppercase tracking-wider shadow-sm
                                    @if($order->status === 'menunggu') bg-amber-100 text-amber-700 border border-amber-200
                                    @elseif(in_array($order->status, ['diproses', 'menuju_lokasi', 'membawa_pasien'])) bg-primary-100 text-primary-700 border border-primary-200 animate-pulse
                                    @elseif($order->status === 'selesai') bg-emerald-100 text-emerald-700 border border-emerald-200
                                    @else bg-slate-100 text-slate-600 border border-slate-200 @endif">
                                    <span class="w-2 h-2 rounded-full @if(in_array($order->status, ['diproses', 'menuju_lokasi', 'membawa_pasien'])) bg-primary-600 animate-ping @else bg-current @endif"></span>
                                    <span>{{ $order->status_label }}</span>
                                </span>
                            </div>

                            <!-- Patient & Pickup Info -->
                            <div class="space-y-3 mb-5 text-sm">
                                <div class="flex items-start gap-3">
                                    <div class="w-8 h-8 rounded-full bg-primary-50 text-primary-500 flex items-center justify-center shrink-0">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                                    </div>
                                    <div>
                                        <span class="text-[10px] text-slate-400 font-extrabold block uppercase tracking-wider">PASIEN</span>
                                        <span class="font-black text-slate-800 text-base">{{ $order->nama_pasien }}</span>
                                        @if($order->kondisi_pasien)
                                            <p class="text-xs text-slate-500 mt-0.5 line-clamp-1 font-medium">{{ $order->kondisi_pasien }}</p>
                                        @endif
                                    </div>
                                </div>

                                <div class="flex items-start gap-3">
                                    <div class="w-8 h-8 rounded-full bg-primary-50 text-primary-500 flex items-center justify-center shrink-0">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/></svg>
                                    </div>
                                    <div>
                                        <span class="text-[10px] text-slate-400 font-extrabold block uppercase tracking-wider">LOKASI JEMPUT</span>
                                        <span class="font-bold text-slate-700 text-sm leading-snug">{{ $order->lokasi_jemput }}</span>
                                    </div>
                                </div>

                                @if($order->tujuan_lokasi || $order->rumahSakit)
                                    <div class="flex items-start gap-3">
                                        <div class="w-8 h-8 rounded-full bg-emerald-50 text-emerald-500 flex items-center justify-center shrink-0">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                                        </div>
                                        <div>
                                            <span class="text-[10px] text-slate-400 font-extrabold block uppercase tracking-wider">RS RUJUKAN</span>
                                            <span class="font-bold text-slate-700 text-sm">{{ $order->tujuan_lokasi ?? $order->rumahSakit->nama }}</span>
                                        </div>
                                    </div>
                                @endif

                                @if($order->ambulans && $order->supir)
                                    <div class="p-4 rounded-2xl bg-slate-50 border border-slate-100 mt-4 flex items-center justify-between text-xs font-semibold">
                                        <div>
                                            <span class="text-slate-400 block text-[10px] uppercase tracking-wider font-extrabold mb-0.5">Armada</span>
                                            <span class="text-slate-800 font-black text-sm">{{ $order->ambulans->kode_ambulans }}</span>
                                        </div>
                                        <div class="text-right">
                                            <span class="text-slate-400 block text-[10px] uppercase tracking-wider font-extrabold mb-0.5">Supir</span>
                                            <span class="text-slate-800 font-black text-sm">{{ $order->supir->user->name }}</span>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Footer Action Buttons -->
                        <div class="pt-5 mt-auto border-t border-slate-100 flex items-center justify-between gap-3">
                            <a href="{{ route('masyarakat.tracking', $order->id) }}"
                               class="flex-1 py-3 rounded-xl bg-slate-900 hover:bg-primary-600 text-white text-center font-black text-xs transition-colors shadow-md flex justify-center items-center gap-2 group/btn">
                               <svg class="w-4 h-4 group-hover/btn:animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"></path></svg>
                                PANTAU GPS REALTIME
                            </a>

                            @if($order->status === 'menunggu')
                                <button type="button" wire:click="cancelOrder({{ $order->id }})"
                                        wire:confirm="Yakin ingin membatalkan pesanan ambulans ini?"
                                        class="px-4 py-3 rounded-xl bg-white hover:bg-amber-50 text-amber-600 font-black text-xs transition-colors border-2 border-amber-100 hover:border-amber-200 shadow-sm">
                                    Batalkan
                                </button>
                            @elseif(in_array($order->status, ['dibatalkan', 'selesai']))
                                <button type="button" wire:click="deleteOrderHistory({{ $order->id }})"
                                        wire:confirm="Yakin ingin menghapus riwayat pesanan ini?"
                                        class="px-4 py-3 rounded-xl bg-white hover:bg-slate-50 text-slate-500 font-black text-xs transition-colors border-2 border-slate-100 shadow-sm">
                                    Hapus
                                </button>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="md:col-span-2 py-16 sm:py-24 text-center bg-white rounded-[2rem] border border-slate-100 p-8 shadow-xl shadow-slate-200/50">
                        <div class="w-20 h-20 rounded-full bg-slate-50 text-slate-400 flex items-center justify-center mx-auto mb-6 shadow-sm border border-slate-100">
                            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                            </svg>
                        </div>
                        <h3 class="font-black text-slate-800 text-2xl sm:text-3xl mb-3">Belum Ada Riwayat Pesanan</h3>
                        <p class="text-slate-500 text-base max-w-md mx-auto mb-8 font-medium leading-relaxed">Jika terjadi situasi darurat medis, jangan ragu untuk memesan ambulans dari jaringan Ambulance Siaga gratis 24 jam.</p>
                        <a href="{{ route('masyarakat.order.create') }}"
                           class="inline-flex items-center gap-2 px-8 py-4 rounded-full bg-primary-600 text-white hover:bg-primary-700 font-black text-sm shadow-lg shadow-primary-600/30 hover:shadow-xl hover:shadow-primary-600/40 hover:-translate-y-1 transition-all">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4"/></svg>
                            <span>PESAN AMBULANS SEKARANG</span>
                        </a>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            <div class="mt-10">
                <div class="bg-white/90 backdrop-blur rounded-2xl p-4 shadow-xl">
                    {{ $orders->links() }}
                </div>
            </div>
        </div>
    </main>

    <x-landing-footer />
</div>
