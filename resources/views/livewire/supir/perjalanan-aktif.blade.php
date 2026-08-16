<div class="max-w-2xl mx-auto py-8">
    <div class="p-8 sm:p-10 rounded-xl bg-white border border-slate-200 shadow-xs text-center space-y-4">
        <div class="w-14 h-14 bg-slate-100 text-slate-500 rounded-xl flex items-center justify-center mx-auto">
            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"/>
            </svg>
        </div>

        <div class="space-y-1">
            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-slate-100 text-slate-600 uppercase tracking-wider">
                <span class="w-2 h-2 rounded-full bg-slate-400"></span>
                <span>Tidak Ada Perjalanan Aktif</span>
            </span>
            <h2 class="text-xl font-bold text-slate-900 pt-2">Belum Ada Misi Berjalan</h2>
            <p class="text-xs text-slate-500 max-w-md mx-auto leading-relaxed">
                Anda saat ini tidak sedang menjalankan evakuasi medis. Buka halaman Tugas untuk memeriksa permintaan ambulans darurat yang masuk atau menunggu konfirmasi.
            </p>
        </div>

        <div class="pt-3 flex items-center justify-center gap-3">
            <a href="{{ route('supir.tugas.index') }}"
               class="px-5 py-2.5 rounded-lg bg-teal-700 hover:bg-teal-800 text-white font-bold text-xs shadow-xs transition-colors flex items-center gap-1.5">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                <span>Lihat Tugas Ambulans</span>
            </a>
            <a href="{{ route('supir.dashboard') }}"
               class="px-4 py-2.5 rounded-lg bg-slate-100 hover:bg-slate-200 text-slate-700 font-semibold text-xs transition-colors">
                Kembali ke Dashboard
            </a>
        </div>
    </div>
</div>
