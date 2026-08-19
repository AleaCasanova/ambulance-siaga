<div wire:poll.5s>


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
                    <div class="relative w-full sm:w-auto" x-data="{ open: false }">
                        <button type="button" @click="open = !open" @click.outside="open = false"
                                class="w-full sm:w-auto flex items-center justify-between gap-3 px-4 py-3 rounded-xl border border-white/20 bg-white/10 backdrop-blur text-white text-sm font-bold shadow-lg hover:bg-white/20 transition-all">
                            <span>
                                @if($statusFilter === 'menunggu') Menunggu Operator
                                @elseif($statusFilter === 'diproses') Ditugaskan (Diproses)
                                @elseif($statusFilter === 'menuju_lokasi') Menuju Lokasi Jemput
                                @elseif($statusFilter === 'membawa_pasien') Membawa Pasien ke RS
                                @elseif($statusFilter === 'selesai') Selesai
                                @elseif($statusFilter === 'dibatalkan') Dibatalkan
                                @else Semua Status
                                @endif
                            </span>
                            <svg class="w-4 h-4 text-white/70 transition-transform duration-200" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                        </button>

                        <div x-show="open" x-transition.opacity.duration.150ms
                             class="absolute right-0 top-full mt-2 w-56 bg-white rounded-2xl shadow-2xl border border-slate-100 py-2 z-50 overflow-hidden text-slate-800"
                             style="display: none;">
                            <button type="button" @click="$wire.set('statusFilter', ''); open = false"
                                    class="w-full text-left px-4 py-2.5 text-xs font-bold flex items-center justify-between hover:bg-primary-50 hover:text-primary-600 transition-colors {{ $statusFilter === '' ? 'text-primary-600 bg-primary-50/50' : 'text-slate-700' }}">
                                <span>Semua Status</span>
                                @if($statusFilter === '') <svg class="w-4 h-4 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg> @endif
                            </button>
                            @foreach([
                                'menunggu' => 'Menunggu Operator',
                                'diproses' => 'Ditugaskan (Diproses)',
                                'menuju_lokasi' => 'Menuju Lokasi Jemput',
                                'membawa_pasien' => 'Membawa Pasien ke RS',
                                'selesai' => 'Selesai',
                                'dibatalkan' => 'Dibatalkan',
                            ] as $val => $lbl)
                                <button type="button" @click="$wire.set('statusFilter', '{{ $val }}'); open = false"
                                        class="w-full text-left px-4 py-2.5 text-xs font-bold flex items-center justify-between hover:bg-primary-50 hover:text-primary-600 transition-colors {{ $statusFilter === $val ? 'text-primary-600 bg-primary-50/50' : 'text-slate-700' }}">
                                    <span>{{ $lbl }}</span>
                                    @if($statusFilter === $val) <svg class="w-4 h-4 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg> @endif
                                </button>
                            @endforeach
                        </div>
                    </div>
                    <a href="{{ route('masyarakat.order.create') }}"
                       class="w-full sm:w-auto inline-flex justify-center items-center gap-2 px-6 py-3 rounded-xl bg-white text-primary-600 font-black text-sm shadow-xl hover:bg-primary-50 transition-all hover:scale-105">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/>
                        </svg>
                        <span>Pesan Baru</span>
                    </a>
                </div>
            </div>

            @if($activeOrders->count() == 0 && $historyOrders->count() == 0)
                <!-- Empty State -->
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
            @else
                <!-- Active Orders -->
                @if($activeOrders->count() > 0)
                    <div class="mb-12">
                        <h2 class="text-xl sm:text-2xl font-extrabold text-white mb-5 flex items-center gap-3 drop-shadow-md">
                            <span class="w-3 h-3 rounded-full bg-emerald-400 animate-pulse border border-white"></span>
                            Pesanan Aktif Sedang Berjalan
                        </h2>
                        <div class="grid grid-cols-1 gap-6 {{ $activeOrders->count() === 1 ? 'max-w-xl mx-auto' : 'md:grid-cols-2' }}">
                            @foreach($activeOrders as $order)
                                <div class="bg-white rounded-[2rem] border border-slate-100 p-5 sm:p-6 shadow-2xl shadow-black/10 hover:shadow-black/20 hover:-translate-y-1 transition-all flex flex-col justify-between group relative overflow-hidden">
                                    
                                    <!-- Accent Line Top -->
                                    <div class="absolute top-0 left-0 w-full h-1.5 bg-gradient-to-r from-sky-400 to-[#009CA6]"></div>

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
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- History Orders -->
                @if($historyOrders->count() > 0)
                    <div>
                        <div class="bg-white rounded-[2rem] border border-slate-100 shadow-2xl shadow-black/10 overflow-hidden">
                            <div class="px-6 py-5 sm:px-8 sm:py-6 border-b border-slate-100 bg-white">
                                <h2 class="text-xl sm:text-2xl font-extrabold text-slate-800 flex items-center gap-3">
                                    <span class="w-3 h-3 rounded-full bg-slate-300"></span>
                                    Riwayat Pesanan Terdahulu
                                </h2>
                            </div>
                            <div class="overflow-x-auto">
                                <table class="w-full text-left text-sm whitespace-nowrap">
                                    <thead class="bg-slate-50 border-b border-slate-100 text-slate-500 text-[10px] uppercase tracking-wider">
                                        <tr>
                                            <th class="px-6 py-4 font-extrabold rounded-tl-[2rem]">ID / Tanggal</th>
                                            <th class="px-6 py-4 font-extrabold">Jemput & Rujukan</th>
                                            <th class="px-6 py-4 font-extrabold">Armada & Supir</th>
                                            <th class="px-6 py-4 font-extrabold text-center">Status</th>
                                            <th class="px-6 py-4 font-extrabold rounded-tr-[2rem] text-right">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-slate-100 text-slate-700">
                                        @foreach($historyOrders as $order)
                                        <tr class="hover:bg-slate-50/50 transition-colors">
                                            <td class="px-6 py-4">
                                                <div class="font-bold text-slate-800">{{ $order->kode_order }}</div>
                                                <div class="text-xs text-slate-400">{{ $order->waktu_pesan ? $order->waktu_pesan->translatedFormat('d M Y, H:i') : '-' }}</div>
                                            </td>
                                            <td class="px-6 py-4">
                                                <div class="font-bold truncate max-w-[200px]" title="{{ $order->lokasi_jemput }}">{{ $order->lokasi_jemput }}</div>
                                                <div class="text-xs text-slate-500 truncate max-w-[200px]" title="{{ $order->tujuan_lokasi ?? ($order->rumahSakit->nama ?? '-') }}">
                                                    Ke: {{ $order->tujuan_lokasi ?? ($order->rumahSakit->nama ?? '-') }}
                                                </div>
                                            </td>
                                            <td class="px-6 py-4">
                                                @if($order->ambulans)
                                                    <div class="font-bold text-slate-800">{{ $order->ambulans->kode_ambulans }}</div>
                                                    <div class="text-xs text-slate-500">{{ $order->supir->user->name ?? '-' }}</div>
                                                @else
                                                    <span class="text-xs text-slate-400 font-medium italic">Tidak ada armada</span>
                                                @endif
                                            </td>
                                            <td class="px-6 py-4 text-center">
                                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[10px] font-black uppercase tracking-wider border
                                                    @if($order->status === 'selesai') bg-emerald-50 text-emerald-600 border-emerald-200
                                                    @else bg-rose-50 text-rose-600 border-rose-200 @endif">
                                                    {{ $order->status_label }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 text-right">
                                                <div class="flex items-center justify-end gap-2">
                                                    <a href="{{ route('masyarakat.tracking', $order->id) }}" class="p-2 rounded-xl bg-slate-100 text-slate-600 hover:bg-primary-600 hover:text-white transition-colors border border-slate-200 hover:border-primary-600" title="Lihat Detail">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                                                    </a>
                                                    <button type="button" wire:click="deleteOrderHistory({{ $order->id }})" wire:confirm="Yakin ingin menghapus riwayat ini secara permanen?" class="p-2 rounded-xl bg-slate-100 text-slate-600 hover:bg-rose-600 hover:text-white transition-colors border border-slate-200 hover:border-rose-600" title="Hapus Riwayat">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- Pagination -->
                        <div class="mt-6">
                            <div class="bg-white/90 backdrop-blur rounded-2xl p-4 shadow-xl">
                                {{ $historyOrders->links() }}
                            </div>
                        </div>
                    </div>
                @endif
            @endif
        </div>
    </main>

    <x-landing-footer />
</div>
