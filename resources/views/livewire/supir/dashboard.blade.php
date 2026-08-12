<div wire:poll.10s>
    <!-- Top Status & Hero Toggle -->
    <div class="mb-8 p-6 sm:p-8 rounded-3xl {{ $isOnline ? 'bg-gradient-to-r from-emerald-600 to-slate-900' : 'bg-gradient-to-r from-slate-800 to-slate-900' }} text-white shadow-xl flex flex-col md:flex-row items-center justify-between gap-6 transition-colors">
        <div>
            <div class="flex items-center gap-2 mb-2">
                <span class="w-3 h-3 rounded-full {{ $isOnline ? 'bg-emerald-400 animate-ping' : 'bg-slate-500' }}"></span>
                <span class="text-xs font-black uppercase tracking-widest text-emerald-300">
                    {{ $isOnline ? 'STATUS ANDA: SIAGA TUGAS (ONLINE)' : 'STATUS ANDA: ISTIRAHAT (OFFLINE)' }}
                </span>
            </div>
            <h1 class="text-2xl sm:text-3xl font-extrabold tracking-tight">Halo, {{ auth()->user()->name }}!</h1>
            <p class="text-slate-200 text-sm mt-1 max-w-xl">
                {{ $isOnline ? 'Anda siap menerima penugasan evakuasi medis darurat dari Operator Ambulance Siaga.' : 'Aktifkan status Anda menjadi ONLINE untuk mulai menerima pesanan ambulans.' }}
            </p>
        </div>

        <button type="button" wire:click="toggleOnline"
                class="px-8 py-4 rounded-2xl font-extrabold text-base shadow-xl transition-all flex items-center gap-3
                {{ $isOnline ? 'bg-red-600 hover:bg-red-700 text-white' : 'bg-emerald-500 hover:bg-emerald-600 text-slate-900' }}">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 10V3L4 14h7v7l9-11h-7z"/>
            </svg>
            <span>{{ $isOnline ? 'UBAH KE OFFLINE (ISTIRAHAT)' : 'SIAGA SEKARANG (ONLINE)' }}</span>
        </button>
    </div>

    <!-- Peringatan Tugas Aktif (Jika Ada) -->
    @if($activeOrder)
        <div class="mb-8 p-6 rounded-3xl bg-red-600 text-white shadow-2xl border-4 border-red-400 animate-pulse flex flex-col md:flex-row items-center justify-between gap-6">
            <div class="flex items-center gap-4">
                <div class="w-16 h-16 rounded-2xl bg-white/20 flex items-center justify-center text-white font-extrabold text-2xl flex-shrink-0">
                    🚨
                </div>
                <div>
                    <span class="px-2.5 py-0.5 rounded text-xs font-black bg-white text-red-700 uppercase tracking-wider">
                        TUGAS DARURAT AKTIF #{{ $activeOrder->kode_order }}
                    </span>
                    <h2 class="text-xl sm:text-2xl font-black mt-1">Pasien: {{ $activeOrder->nama_pasien }}</h2>
                    <p class="text-red-100 text-sm font-medium mt-0.5">Lokasi: {{ $activeOrder->lokasi_jemput }}</p>
                </div>
            </div>

            <a href="{{ route('supir.orders.show', $activeOrder->id) }}"
               class="px-8 py-4 rounded-2xl bg-white text-red-700 font-extrabold text-base shadow-xl hover:scale-105 transition-all text-center">
                BUKA TUGAS & PETA RUTE SEKARANG &rarr;
            </a>
        </div>
    @endif



    <!-- 3 Statistik Supir -->
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 mb-8">
        <!-- SIM -->
        <div class="p-6 rounded-3xl bg-white border border-slate-200/80 shadow-xs">
            <span class="text-xs font-bold text-slate-400 uppercase tracking-wider block mb-1">Nomor SIM / Lisensi</span>
            <span class="text-2xl font-black text-slate-800">{{ $supir?->nomor_sim ?: '-' }}</span>
            <span class="text-xs text-slate-500 block mt-1">Supir Mitra Ambulance Siaga</span>
        </div>

        <!-- Rating -->
        <div class="p-6 rounded-3xl bg-white border border-slate-200/80 shadow-xs">
            <span class="text-xs font-bold text-slate-400 uppercase tracking-wider block mb-1">Rating Kepuasan</span>
            <div class="flex items-center gap-2">
                <span class="text-2xl font-black text-slate-800">{{ number_format($supir?->rating_rata_rata ?? 5.0, 1) }}</span>
                <span class="text-amber-500 text-xl font-bold">★</span>
            </div>
            <span class="text-xs text-slate-500 block mt-1">Berdasarkan ulasan masyarakat</span>
        </div>

        <!-- Armada Default -->
        <div class="p-6 rounded-3xl bg-white border border-slate-200/80 shadow-xs">
            <span class="text-xs font-bold text-slate-400 uppercase tracking-wider block mb-1">Armada Utama</span>
            <span class="text-2xl font-black text-slate-800">{{ $supir?->ambulans?->kode_ambulans ?? 'Tanpa Armada' }}</span>
            <span class="text-xs text-slate-500 block mt-1">{{ $supir?->plat_nomor ?? $supir?->ambulans?->plat_nomor ?? '-' }}</span>
        </div>
    </div>

    <!-- Profil Lembaga Mitra & Kendaraan -->
    <div class="bg-white rounded-3xl border border-slate-200/80 p-6 sm:p-8 shadow-xs mb-8">
        <h2 class="text-xl font-extrabold text-slate-800 mb-6 flex items-center gap-2">
            <span class="w-3 h-3 rounded-full bg-emerald-600"></span>
            <span>Profil Lembaga Mitra & Spesifikasi Kendaraan</span>
        </h2>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-sm">
            <div class="p-5 rounded-2xl bg-slate-50 border border-slate-200/80 space-y-3">
                <h3 class="text-xs font-black uppercase tracking-wider text-sky-600">Informasi Lembaga / Organisasi</h3>
                <div class="flex justify-between py-1.5 border-b border-slate-200/60">
                    <span class="text-slate-500 font-medium">Nama Lembaga / Organisasi:</span>
                    <span class="font-extrabold text-slate-800">{{ $supir?->nama_lembaga ?: 'Mitra Ambulance Siaga' }}</span>
                </div>
                <div class="flex justify-between py-1.5 border-b border-slate-200/60">
                    <span class="text-slate-500 font-medium">Penanggung Jawab:</span>
                    <span class="font-bold text-slate-800">{{ $supir?->nama_penanggung_jawab ?: auth()->user()->name }}</span>
                </div>
                <div class="flex justify-between py-1.5 border-b border-slate-200/60">
                    <span class="text-slate-500 font-medium">No. WhatsApp (WA):</span>
                    <span class="font-bold text-emerald-600">{{ $supir?->no_wa ?: auth()->user()->phone }}</span>
                </div>
                <div class="py-1.5">
                    <span class="text-slate-500 font-medium block mb-1">Alamat Unit Ambulance:</span>
                    <span class="font-bold text-slate-800">{{ $supir?->alamat_unit ?: 'Cilacap' }}</span>
                </div>
            </div>

            <div class="p-5 rounded-2xl bg-slate-50 border border-slate-200/80 space-y-3">
                <h3 class="text-xs font-black uppercase tracking-wider text-sky-600">Dokumen & Kendaraan</h3>
                <div class="flex justify-between py-1.5 border-b border-slate-200/60">
                    <span class="text-slate-500 font-medium">Merk Kendaraan:</span>
                    <span class="font-extrabold text-slate-800">{{ $supir?->merk_kendaraan ?: '-' }}</span>
                </div>
                <div class="flex justify-between py-1.5 border-b border-slate-200/60">
                    <span class="text-slate-500 font-medium">Plat Nomor:</span>
                    <span class="font-bold text-slate-800">{{ $supir?->plat_nomor ?: ($supir?->ambulans?->plat_nomor ?? '-') }}</span>
                </div>
                <div class="flex justify-between py-1.5 border-b border-slate-200/60">
                    <span class="text-slate-500 font-medium">Nomor SIM:</span>
                    <span class="font-bold text-slate-800">{{ $supir?->nomor_sim ?: '-' }}</span>
                </div>
                <div class="flex justify-between py-1.5">
                    <span class="text-slate-500 font-medium">Nomor STNK:</span>
                    <span class="font-bold text-slate-800">{{ $supir?->nomor_stnk ?: '-' }}</span>
                </div>
            </div>
        </div>
    </div>


</div>
