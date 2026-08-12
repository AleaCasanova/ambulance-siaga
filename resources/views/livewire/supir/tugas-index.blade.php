<div>
    <!-- Pesanan Masuk (Sistem Hybrid) -->
    @if(isset($openOrders) && $openOrders->count() > 0)
        <div class="mb-8 p-6 sm:p-8 rounded-3xl bg-gradient-to-r from-amber-500 to-amber-600 text-white shadow-2xl border-4 border-amber-300 animate-pulse">
            <div class="flex items-center gap-3 mb-4">
                <span class="text-2xl">🚨</span>
                <h2 class="text-xl sm:text-2xl font-black">Pesanan Darurat Masuk (Belum Ada Armada Ditugaskan)</h2>
            </div>
            <p class="text-amber-50 text-sm mb-5">
                Ada pesanan darurat medis dari masyarakat yang membutuhkan penjemputan segera. Klik tombol di bawah ini untuk mengambil tugas penjemputan.
            </p>
            <div class="space-y-3">
                @foreach($openOrders as $op)
                    <div class="p-4 rounded-2xl bg-white/10 backdrop-blur-md border border-white/20 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                        <div>
                            <span class="px-2.5 py-0.5 rounded text-xs font-black bg-white text-amber-700 uppercase tracking-wider">
                                #{{ $op->kode_order }}
                            </span>
                            <h3 class="text-lg font-black mt-1">Pasien: {{ $op->nama_pasien }} ({{ $op->usia_pasien ?? '-' }})</h3>
                            <p class="text-amber-100 text-xs mt-0.5 font-medium">📍 Jemput: {{ $op->lokasi_jemput }} &rarr; 🏥 Tujuan: {{ $op->tujuan_lokasi ?? '-' }}</p>
                            <p class="text-white text-xs mt-1 font-semibold">Diagnosa: <span class="underline">{{ $op->diagnosa_medis }}</span></p>
                        </div>
                        <button type="button" wire:click="takeOrder({{ $op->id }})"
                                class="w-full sm:w-auto px-6 py-3 rounded-xl bg-white text-amber-700 hover:bg-amber-50 font-extrabold text-sm shadow-lg transition-transform transform hover:scale-105 shrink-0">
                            🚀 AMBIL TUGAS INI SEKARANG
                        </button>
                    </div>
                @endforeach
            </div>
        </div>
    @else
        <!-- Status Kesiapan (Hanya muncul jika tidak ada pesanan masuk) -->
        <div class="mb-8 p-6 sm:p-8 rounded-3xl bg-slate-50 border border-slate-200 flex flex-col items-center justify-center text-center">
            @if($isOnline)
                <h2 class="text-lg font-bold text-emerald-700">Status Anda ONLINE (Siaga)</h2>
                <p class="text-slate-500 text-sm mt-1">Saat ini belum ada pesanan darurat medis yang masuk. Tetap bersiap sedia!</p>
            @else
                <h2 class="text-lg font-bold text-slate-700">Belum Ada Pesanan Masuk</h2>
                <p class="text-slate-500 text-sm mt-1">Pastikan status Anda ONLINE di halaman Dashboard agar Anda siap menerima pesanan.</p>
            @endif
        </div>
    @endif

    <!-- Daftar Riwayat Evakuasi Selesai -->
    <div class="bg-white rounded-3xl border border-slate-200/80 p-6 sm:p-8 shadow-xs">
        <h2 class="text-xl font-extrabold text-slate-800 mb-6 flex items-center gap-2">
            <span class="w-3 h-3 rounded-full bg-sky-600"></span>
            <span>Riwayat Evakuasi Terakhir Anda</span>
        </h2>

        <div class="space-y-4">
            @forelse($completedOrders as $co)
                <div class="p-4 rounded-2xl bg-slate-50 border border-slate-200/80 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                    <div>
                        <div class="flex items-center gap-2 mb-1">
                            <span class="text-xs font-black text-slate-400">{{ $co->kode_order }}</span>
                            <span class="px-2 py-0.5 rounded text-[10px] font-bold bg-emerald-100 text-emerald-700">SELESAI</span>
                            <span class="text-xs text-slate-400">{{ $co->updated_at->format('d M Y, H:i') }}</span>
                        </div>
                        <h3 class="font-bold text-slate-800 text-base">{{ $co->nama_pasien }}</h3>
                        <p class="text-xs text-slate-600 mt-0.5">{{ $co->lokasi_jemput }} &rarr; {{ $co->tujuan_lokasi ?? $co->rumahSakit?->nama }}</p>
                    </div>

                    @if($co->rating)
                        <div class="bg-white px-4 py-2 rounded-xl border border-slate-200/80 text-right">
                            <div class="flex items-center justify-end text-amber-500 text-sm font-bold">
                                <span>★ {{ $co->rating->skor }} / 5</span>
                            </div>
                            <p class="text-xs text-slate-600 italic mt-0.5 max-w-xs">"{{ $co->rating->ulasan }}"</p>
                        </div>
                    @else
                        <span class="text-xs text-slate-400 font-semibold">Belum ada ulasan</span>
                    @endif
                </div>
            @empty
                <div class="py-12 text-center text-slate-400">
                    <p class="text-sm font-semibold">Belum ada riwayat tugas selesai</p>
                </div>
            @endforelse
        </div>
    </div>
</div>
