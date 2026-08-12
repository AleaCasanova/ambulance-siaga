<div>
    <div class="mb-8 p-12 rounded-3xl bg-slate-50 border border-slate-200 flex flex-col items-center justify-center text-center shadow-sm">
        <div class="w-24 h-24 bg-sky-100 text-sky-500 rounded-full flex items-center justify-center mb-6">
            <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
        </div>
        <h2 class="text-2xl font-black text-slate-800 mb-2">Belum Ada Perjalanan Aktif</h2>
        <p class="text-slate-500 max-w-md">
            Anda saat ini tidak sedang dalam penugasan evakuasi darurat. Silakan cek menu <strong>Pesanan Saya</strong> untuk mengambil pesanan darurat terbaru, atau pastikan status Anda <strong>ONLINE</strong> di Dashboard.
        </p>
        
        <a href="{{ route('supir.tugas.index') }}" class="mt-8 px-6 py-3 bg-sky-600 hover:bg-sky-700 text-white rounded-full font-bold shadow-lg transition-transform hover:scale-105">
            Lihat Pesanan Darurat &rarr;
        </a>
    </div>
</div>
