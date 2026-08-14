<div>
    <!-- Hero Section dengan Background Teal & Ambulance Photo seperti di Beranda & Pesanan Saya -->
    <section class="relative pt-36 pb-36 px-4 sm:px-6 lg:px-12 overflow-hidden bg-primary-700"
             style="background-image: url('{{ asset('images/beranda_utama_bg.jpg') }}'); background-size: cover; background-position: center; background-repeat: no-repeat;">
        
        <!-- Gradient Overlay GSC: Mix of Primary Teal, Cyan & Deep Gradient -->
        <div class="absolute inset-0 bg-gradient-to-r from-primary-700/95 via-[#009CA6]/85 to-primary-900/90 mix-blend-multiply"></div>
        <div class="absolute inset-0 bg-gradient-to-b from-primary-900/50 via-primary-800/40 to-primary-950/70"></div>
        
        <!-- Bottom Fade to Slate-50 Background -->
        <div class="absolute inset-x-0 bottom-0 h-32 bg-gradient-to-t from-slate-50 to-transparent"></div>

        <!-- Subtle Glow & Pattern -->
        <div class="absolute top-10 right-10 w-96 h-96 bg-cyan-400/20 rounded-full blur-3xl pointer-events-none"></div>

        <div class="max-w-7xl mx-auto relative z-10 space-y-8">
            <!-- Top Greeting & Emergency SOS Hero -->
            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">
                <div>
                    <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-white/20 backdrop-blur-md border border-white/30 text-white text-xs font-black uppercase tracking-wider mb-3 shadow-lg">
                        <span class="w-2.5 h-2.5 rounded-full bg-emerald-400 animate-ping"></span>
                        <span>Pusat Layanan & Siaga Medis Warga</span>
                    </div>
                    <h1 class="text-3xl sm:text-4xl lg:text-5xl font-black text-white tracking-tight drop-shadow-lg">
                        Halo, {{ $user?->name ?? 'Warga Siaga' }}! 👋
                    </h1>
                    <p class="text-sky-100 text-sm sm:text-base lg:text-lg mt-2 max-w-2xl font-medium leading-relaxed drop-shadow-sm">
                        Selamat datang di Portal Komando Ambulance Siaga. Anda dapat memanggil armada medis darurat, memantau satelit secara live, dan mengakses panduan darurat 24 jam.
                    </p>
                </div>

                <!-- Hotline & CTA Cepat -->
                <div class="flex flex-wrap items-center gap-3 shrink-0">
                    <a href="{{ route('masyarakat.order.create') }}"
                       class="group relative inline-flex items-center gap-3.5 px-8 py-4 rounded-2xl bg-gradient-to-r from-red-600 via-rose-600 to-red-600 hover:from-red-500 hover:to-rose-500 text-white font-black text-sm shadow-2xl shadow-red-600/50 border border-white/30 transition-all transform hover:scale-105 active:scale-95">
                        <span class="w-8 h-8 rounded-xl bg-white/20 flex items-center justify-center text-lg animate-pulse">🚨</span>
                        <div class="text-left">
                            <span class="block text-[10px] uppercase font-extrabold text-red-100 leading-none">Kejadian Kritis</span>
                            <span class="text-base tracking-wide font-black">PESAN AMBULANS SEKARANG</span>
                        </div>
                    </a>

                    <a href="tel:{{ preg_replace('/[^0-9]/', '', $teleponDarurat) }}"
                       class="inline-flex items-center gap-2.5 px-6 py-4 rounded-2xl bg-white/95 backdrop-blur-md text-slate-800 hover:bg-white font-extrabold text-sm shadow-xl border border-white/40 transition-all hover:scale-105">
                        <span class="w-8 h-8 rounded-xl bg-emerald-100 text-emerald-600 flex items-center justify-center font-black text-sm">📞</span>
                        <span>Hotline 24 Jam: <strong class="text-emerald-700">{{ $teleponDarurat }}</strong></span>
                    </a>
                </div>
            </div>

            <!-- Flash Message Notification -->
            @if(session()->has('success'))
                <div x-data="{ show: true }" x-show="show" class="p-4 rounded-2xl bg-emerald-500 text-white font-bold text-sm shadow-xl flex items-center justify-between border border-emerald-400">
                    <div class="flex items-center gap-3">
                        <span class="text-xl">✅</span>
                        <span>{{ session('success') }}</span>
                    </div>
                    <button @click="show = false" class="text-white/80 hover:text-white font-extrabold text-lg">&times;</button>
                </div>
            @endif

            <!-- 1. ACTIVE ORDER BANNER (Jika sedang ada pesanan berjalan) -->
            @if($activeOrder)
                <div class="relative overflow-hidden p-6 sm:p-8 rounded-3xl bg-gradient-to-r from-red-600 via-rose-600 to-amber-600 text-white shadow-2xl border-2 border-red-300 animate-pulse">
                    <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 relative z-10">
                        <div class="space-y-2">
                            <div class="flex items-center gap-2.5">
                                <span class="px-3 py-1 rounded-full bg-white text-red-700 font-black text-xs uppercase tracking-wider shadow">
                                    🚨 EVAKUASI SEDANG BERLANGSUNG
                                </span>
                                <span class="text-xs font-bold text-red-100">#{{ $activeOrder->kode_order }}</span>
                            </div>
                            <h2 class="text-2xl sm:text-3xl font-black">
                                Ambulans Sedang Menangani: {{ $activeOrder->nama_pasien }}
                            </h2>
                            <div class="flex flex-wrap items-center gap-4 text-xs sm:text-sm font-medium text-red-50">
                                <span>📍 <strong>Jemput:</strong> {{ $activeOrder->lokasi_jemput }}</span>
                                <span>•</span>
                                <span>🏥 <strong>Status:</strong> {{ $activeOrder->status_label }}</span>
                                @if($activeOrder->ambulans)
                                    <span>•</span>
                                    <span>🚑 <strong>Armada:</strong> {{ $activeOrder->ambulans->kode_ambulans }} ({{ $activeOrder->ambulans->plat_nomor }})</span>
                                @endif
                            </div>
                        </div>

                        <div class="flex flex-wrap items-center gap-3 shrink-0">
                            <a href="{{ route('masyarakat.tracking', $activeOrder->id) }}"
                               class="px-6 py-3.5 rounded-2xl bg-white text-red-700 hover:bg-red-50 font-black text-sm shadow-xl transition-all hover:scale-105 flex items-center gap-2">
                                <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"></path></svg>
                                <span>PANTAU SATELIT & RUTE LIVE</span>
                            </a>

                            @if($activeOrder->needsFormCompletion())
                                <a href="{{ route('masyarakat.order.complete', $activeOrder->id) }}"
                                   class="px-5 py-3.5 rounded-2xl bg-amber-500 hover:bg-amber-400 text-white font-extrabold text-xs shadow-lg transition-all">
                                    📝 Lengkapi Form Medis
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </section>

    <!-- Main Content below Hero with Floating Overlap -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-16 sm:-mt-20 relative z-20 space-y-8 pb-24">

        <!-- 3 Quick Info Metric Cards (Floating with soft shadow) -->
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
            <!-- Card 1: Armada Siaga -->
            <div class="p-6 rounded-3xl bg-white border border-slate-100 shadow-xl shadow-slate-200/50 flex items-center justify-between hover:shadow-2xl hover:-translate-y-1 transition-all">
                <div>
                    <span class="text-xs font-bold text-slate-400 uppercase tracking-wider block mb-1">Armada Ambulans Siaga</span>
                    <div class="flex items-baseline gap-2">
                        <span class="text-3xl font-black text-slate-800">{{ $ambulansTersedia }}</span>
                        <span class="text-xs font-bold text-emerald-600">Unit Tersedia / {{ $totalAmbulans }} Total</span>
                    </div>
                    <p class="text-[11px] text-slate-500 mt-1">Jaringan Multi-Mitra se-Kabupaten Cilacap</p>
                </div>
                <div class="w-14 h-14 rounded-2xl bg-emerald-50 text-emerald-600 flex items-center justify-center text-2xl shrink-0 shadow-inner">
                    🚑
                </div>
            </div>

            <!-- Card 2: Status Akun Medis -->
            <div class="p-6 rounded-3xl bg-white border border-slate-100 shadow-xl shadow-slate-200/50 flex items-center justify-between hover:shadow-2xl hover:-translate-y-1 transition-all">
                <div>
                    <span class="text-xs font-bold text-slate-400 uppercase tracking-wider block mb-1">Data Darurat Keluarga (ICE)</span>
                    <div class="flex items-center gap-2">
                        @if($user?->masyarakat?->nik && $user?->masyarakat?->alamat)
                            <span class="px-2.5 py-0.5 rounded-full text-xs font-extrabold bg-emerald-100 text-emerald-800">LENGKAP & SIAGA</span>
                        @else
                            <span class="px-2.5 py-0.5 rounded-full text-xs font-extrabold bg-amber-100 text-amber-800">BELUM LENGKAP</span>
                        @endif
                    </div>
                    <button type="button" wire:click="$set('showEditIceModal', true)" class="text-xs text-primary-600 hover:text-primary-700 font-bold mt-2 inline-block underline">
                        {{ $user?->masyarakat?->alamat ? 'Perbarui Data Medis ✏️' : '+ Lengkapi Data Sekarang' }}
                    </button>
                </div>
                <div class="w-14 h-14 rounded-2xl bg-sky-50 text-sky-600 flex items-center justify-center text-2xl shrink-0 shadow-inner">
                    🪪
                </div>
            </div>

            <!-- Card 3: Layanan Bebas Biaya -->
            <div class="p-6 rounded-3xl bg-white border border-slate-100 shadow-xl shadow-slate-200/50 flex items-center justify-between hover:shadow-2xl hover:-translate-y-1 transition-all">
                <div>
                    <span class="text-xs font-bold text-slate-400 uppercase tracking-wider block mb-1">Status Tarif Layanan</span>
                    <span class="text-2xl font-black text-emerald-600">100% GRATIS</span>
                    <p class="text-[11px] text-slate-500 mt-1">Didukung Gerak Sedekah Cilacap & Relawan</p>
                </div>
                <div class="w-14 h-14 rounded-2xl bg-teal-50 text-teal-600 flex items-center justify-center text-2xl shrink-0 shadow-inner">
                    🤝
                </div>
            </div>
        </div>

        <!-- Main Content Grid: 2 Columns -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">

            <!-- LEFT COLUMN: Panduan P3K Darurat & Direktori Rumah Sakit (8 Cols) -->
            <div class="lg:col-span-8 space-y-8">

                <!-- Modul 1: Panduan Cepat P3K (Pertolongan Pertama Sambil Menunggu Ambulans) -->
                <div id="panduan-p3k" class="bg-white rounded-3xl border border-slate-200/80 p-6 sm:p-8 shadow-xs" x-data="{ activeTab: 'cpr' }">
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
                        <div>
                            <span class="text-xs font-black uppercase tracking-wider text-red-600 bg-red-50 px-3 py-1 rounded-full border border-red-100">
                                🆘 Panduan Kritis Pra-Ambulans
                            </span>
                            <h2 class="text-xl sm:text-2xl font-black text-slate-800 mt-2">
                                Pertolongan Pertama Gawat Darurat (P3K)
                            </h2>
                            <p class="text-slate-500 text-xs sm:text-sm mt-0.5">
                                Langkah krusial yang dapat Anda lakukan untuk menyelamatkan nyawa pasien sebelum armada medis tiba.
                            </p>
                        </div>
                    </div>

                    <!-- Category Pills -->
                    <div class="flex items-center gap-2 overflow-x-auto pb-2 mb-6 border-b border-slate-100 no-scrollbar">
                        <button type="button" @click="activeTab = 'cpr'"
                                :class="activeTab === 'cpr' ? 'bg-red-600 text-white shadow-md' : 'bg-slate-100 text-slate-700 hover:bg-slate-200'"
                                class="px-4 py-2 rounded-xl text-xs font-extrabold whitespace-nowrap transition-all">
                            🫀 Henti Jantung (CPR)
                        </button>
                        <button type="button" @click="activeTab = 'sesak'"
                                :class="activeTab === 'sesak' ? 'bg-red-600 text-white shadow-md' : 'bg-slate-100 text-slate-700 hover:bg-slate-200'"
                                class="px-4 py-2 rounded-xl text-xs font-extrabold whitespace-nowrap transition-all">
                            🫁 Sesak & Tersedak
                        </button>
                        <button type="button" @click="activeTab = 'pingsan'"
                                :class="activeTab === 'pingsan' ? 'bg-red-600 text-white shadow-md' : 'bg-slate-100 text-slate-700 hover:bg-slate-200'"
                                class="px-4 py-2 rounded-xl text-xs font-extrabold whitespace-nowrap transition-all">
                            ⚡ Pingsan / Hilang Sadar
                        </button>
                        <button type="button" @click="activeTab = 'darah'"
                                :class="activeTab === 'darah' ? 'bg-red-600 text-white shadow-md' : 'bg-slate-100 text-slate-700 hover:bg-slate-200'"
                                class="px-4 py-2 rounded-xl text-xs font-extrabold whitespace-nowrap transition-all">
                            🩹 Pendarahan & Luka Bakar
                        </button>
                        <button type="button" @click="activeTab = 'tulang'"
                                :class="activeTab === 'tulang' ? 'bg-red-600 text-white shadow-md' : 'bg-slate-100 text-slate-700 hover:bg-slate-200'"
                                class="px-4 py-2 rounded-xl text-xs font-extrabold whitespace-nowrap transition-all">
                            🦴 Patah Tulang / Trauma
                        </button>
                    </div>

                    <!-- Tab Contents -->
                    <div class="space-y-4">
                        <!-- Tab 1: CPR -->
                        <div x-show="activeTab === 'cpr'" class="p-5 rounded-2xl bg-red-50/50 border border-red-100 text-xs sm:text-sm text-slate-700 space-y-3">
                            <h3 class="font-black text-red-700 text-base flex items-center gap-2">
                                <span>🫀 Langkah Resusitasi Jantung Paru (CPR / RJP):</span>
                            </h3>
                            <ol class="list-decimal list-inside space-y-2 font-medium">
                                <li><strong>Cek Respons & Nafas:</strong> Tepuk pundak pasien dan panggil dengan tegas. Cek apakah dada bergerak bernafas.</li>
                                <li><strong>Posisikan di Permukaan Rata:</strong> Baringkan korban terlentang di atas permukaan yang keras dan datar.</li>
                                <li><strong>Kompresi Dada Cepat:</strong> Letakkan tumit salah satu telapak tangan di tengah dada (tulang dada), kunci dengan tangan lain. Tekan sedalam 5-6 cm dengan kecepatan 100-120 kali per menit (sesuai irama lagu <em>"Stayin' Alive"</em>).</li>
                                <li><strong>Jangan Berhenti:</strong> Lanjutkan kompresi sampai tim medis ambulans datang mengambil alih.</li>
                            </ol>
                        </div>

                        <!-- Tab 2: Sesak -->
                        <div x-show="activeTab === 'sesak'" class="p-5 rounded-2xl bg-sky-50/50 border border-sky-100 text-xs sm:text-sm text-slate-700 space-y-3" style="display: none;">
                            <h3 class="font-black text-sky-800 text-base flex items-center gap-2">
                                <span>🫁 Penanganan Pasien Sesak Nafas & Tersedak (Choking):</span>
                            </h3>
                            <ol class="list-decimal list-inside space-y-2 font-medium">
                                <li><strong>Posisikan Setengah Duduk:</strong> Longgarkan pakaian ketat/kerah baju di sekitar leher dan dada. Posisikan pasien duduk nyaman bersandar.</li>
                                <li><strong>Pastikan Sirkulasi Udara Baik:</strong> Buka jendela dan jauhkan kerumunan orang di sekitar pasien.</li>
                                <li><strong>Jika Tersedak Benda Padat (Heimlich Maneuver):</strong> Berdiri di belakang korban, lingkarkan lengan di perutnya di atas pusar, dan lakukan hentakan kuat ke arah dalam dan atas.</li>
                            </ol>
                        </div>

                        <!-- Tab 3: Pingsan -->
                        <div x-show="activeTab === 'pingsan'" class="p-5 rounded-2xl bg-amber-50/50 border border-amber-100 text-xs sm:text-sm text-slate-700 space-y-3" style="display: none;">
                            <h3 class="font-black text-amber-800 text-base flex items-center gap-2">
                                <span>⚡ Penanganan Orang Pingsan (Sinkop):</span>
                            </h3>
                            <ol class="list-decimal list-inside space-y-2 font-medium">
                                <li><strong>Tinggikan Kaki:</strong> Baringkan pasien telentang, lalu angkat posisi kaki sekitar 30 cm lebih tinggi dari dada untuk mengalirkan darah ke otak.</li>
                                <li><strong>Longgarkan Pakaian:</strong> Buka kancing kerah, ikat pinggang, atau pakaian ketat.</li>
                                <li><strong>Jangan Beri Minum Saat Tidak Sadar:</strong> Hindari memasukkan makanan/minuman ke mulut korban pingsan karena berisiko tersedak masuk ke paru-paru.</li>
                            </ol>
                        </div>

                        <!-- Tab 4: Pendarahan & Luka Bakar -->
                        <div x-show="activeTab === 'darah'" class="p-5 rounded-2xl bg-rose-50/50 border border-rose-100 text-xs sm:text-sm text-slate-700 space-y-3" style="display: none;">
                            <h3 class="font-black text-rose-800 text-base flex items-center gap-2">
                                <span>🩹 Penanganan Pendarahan Hebat & Luka Bakar:</span>
                            </h3>
                            <ol class="list-decimal list-inside space-y-2 font-medium">
                                <li><strong>Tekan Langsung pada Luka:</strong> Gunakan kain bersih atau kassa, tekan luka pendarahan kuat-kuat tanpa melepasnya hingga tim medis tiba.</li>
                                <li><strong>Luka Bakar:</strong> Segera siram / aliri dengan air mengalir suhu ruang selama 10-15 menit. JANGAN oleskan pasta gigi, mentega, atau kecap!</li>
                            </ol>
                        </div>

                        <!-- Tab 5: Patah Tulang -->
                        <div x-show="activeTab === 'tulang'" class="p-5 rounded-2xl bg-purple-50/50 border border-purple-100 text-xs sm:text-sm text-slate-700 space-y-3" style="display: none;">
                            <h3 class="font-black text-purple-800 text-base flex items-center gap-2">
                                <span>🦴 Penanganan Patah Tulang & Cedera Tulang Belakang:</span>
                            </h3>
                            <ol class="list-decimal list-inside space-y-2 font-medium">
                                <li><strong>Jangan Gerakkan Korban:</strong> Jika dicurigai cedera leher atau punggung akibat kecelakaan, JANGAN ubah posisi kepala dan tubuh korban.</li>
                                <li><strong>Imobilisasi Anggota Tubuh:</strong> Biarkan bagian tubuh yang patah pada posisinya, jangan dipaksa diluruskan. Tunggu tandu & servikal collar dari tim ambulans.</li>
                            </ol>
                        </div>
                    </div>
                </div>

                <!-- Modul 2: Direktori Rumah Sakit & Hotline IGD 24 Jam di Cilacap -->
                <div id="rumah-sakit" class="bg-white rounded-3xl border border-slate-200/80 p-6 sm:p-8 shadow-xs">
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
                        <div>
                            <span class="text-xs font-black uppercase tracking-wider text-emerald-700 bg-emerald-50 px-3 py-1 rounded-full border border-emerald-100">
                                🏥 Jaringan Faskes Siaga
                            </span>
                            <h2 class="text-xl sm:text-2xl font-black text-slate-800 mt-2">
                                Rumah Sakit & Layanan IGD 24 Jam
                            </h2>
                            <p class="text-slate-500 text-xs sm:text-sm mt-0.5">
                                Hubungi langsung nomor instalasi gawat darurat rumah sakit rujukan terdekat dari lokasi Anda.
                            </p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        @forelse($rumahSakits as $rs)
                            <div class="p-5 rounded-2xl bg-slate-50 border border-slate-200/70 hover:bg-emerald-50/40 hover:border-emerald-200 transition-all flex flex-col justify-between group">
                                <div>
                                    <div class="flex items-start justify-between gap-3 mb-2">
                                        <h3 class="font-black text-slate-800 text-base group-hover:text-emerald-700 transition-colors">
                                            {{ $rs->nama }}
                                        </h3>
                                        <span class="px-2 py-0.5 rounded text-[10px] font-extrabold bg-emerald-100 text-emerald-700 shrink-0">
                                            IGD 24 JAM
                                        </span>
                                    </div>
                                    <p class="text-xs text-slate-500 mb-3 flex items-start gap-1.5">
                                        <span class="shrink-0 text-slate-400">📍</span>
                                        <span class="line-clamp-2 font-medium">{{ $rs->alamat }}</span>
                                    </p>
                                </div>

                                <div class="pt-3 border-t border-slate-200/60 flex items-center justify-between gap-2">
                                    <a href="tel:{{ preg_replace('/[^0-9]/', '', $rs->telepon) }}"
                                       class="inline-flex items-center gap-1.5 text-xs font-extrabold text-emerald-700 bg-white px-3 py-2 rounded-xl border border-slate-200 hover:bg-emerald-600 hover:text-white transition-all shadow-xs">
                                        <span>📞</span>
                                        <span>Telp IGD: {{ $rs->telepon }}</span>
                                    </a>

                                    <a href="https://www.google.com/maps/search/?api=1&query={{ urlencode($rs->nama . ' ' . $rs->alamat) }}"
                                       target="_blank"
                                       class="text-xs font-bold text-slate-500 hover:text-slate-800 p-2 rounded-xl hover:bg-white"
                                       title="Buka di Google Maps">
                                        Peta &rarr;
                                    </a>
                                </div>
                            </div>
                        @empty
                            <div class="col-span-2 py-8 text-center text-slate-400 text-sm font-semibold">
                                Belum ada data rumah sakit rujukan terdaftar.
                            </div>
                        @endforelse
                    </div>
                </div>

            </div>

            <!-- RIGHT COLUMN: Profil Darurat ICE & Program Sosial GSC (4 Cols) -->
            <div class="lg:col-span-4 space-y-6">

                <!-- Card ICE: Profil Medis Darurat Tersimpan -->
                <div class="bg-white rounded-3xl border border-slate-200/80 p-6 shadow-xs relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-24 h-24 bg-sky-500/10 rounded-full -mr-8 -mt-8 pointer-events-none"></div>

                    <div class="flex items-center justify-between mb-4">
                        <div class="flex items-center gap-2">
                            <span class="w-2.5 h-2.5 rounded-full bg-sky-500"></span>
                            <h3 class="font-extrabold text-slate-800 text-base">Profil Darurat Anda (ICE)</h3>
                        </div>
                        <button type="button" wire:click="$set('showEditIceModal', true)"
                                class="text-xs font-bold text-sky-600 hover:text-sky-700 hover:underline">
                            Edit Data ✏️
                        </button>
                    </div>

                    <p class="text-xs text-slate-500 mb-4">
                        Data ini digunakan untuk mengisi formulir pemesanan ambulans secara otomatis saat kondisi darurat.
                    </p>

                    <div class="space-y-2.5 text-xs">
                        <div class="p-3 rounded-xl bg-slate-50 border border-slate-100 flex justify-between items-center">
                            <span class="text-slate-400 font-semibold">Nama Lengkap:</span>
                            <span class="font-bold text-slate-800">{{ $user?->name }}</span>
                        </div>

                        <div class="p-3 rounded-xl bg-slate-50 border border-slate-100 flex justify-between items-center">
                            <span class="text-slate-400 font-semibold">Nomor WhatsApp:</span>
                            <span class="font-bold text-emerald-600">{{ $user?->phone ?: '-' }}</span>
                        </div>

                        <div class="p-3 rounded-xl bg-slate-50 border border-slate-100 flex justify-between items-center">
                            <span class="text-slate-400 font-semibold">NIK KTP:</span>
                            <span class="font-bold text-slate-800">{{ $user?->masyarakat?->nik ?: '-' }}</span>
                        </div>

                        <div class="p-3 rounded-xl bg-slate-50 border border-slate-100 flex justify-between items-center">
                            <span class="text-slate-400 font-semibold">Kontak Darurat Keluarga:</span>
                            <span class="font-bold text-red-600">{{ $user?->masyarakat?->kontak_darurat ?: 'Belum diisi' }}</span>
                        </div>

                        <div class="p-3 rounded-xl bg-slate-50 border border-slate-100">
                            <span class="text-slate-400 font-semibold block mb-1">Alamat Penjemputan Utama:</span>
                            <span class="font-bold text-slate-800 block">{{ $user?->masyarakat?->alamat ?: 'Belum mengatur alamat tempat tinggal' }}</span>
                        </div>
                    </div>

                    <button type="button" wire:click="$set('showEditIceModal', true)"
                            class="w-full mt-4 py-2.5 rounded-xl bg-sky-50 text-sky-700 hover:bg-sky-100 font-bold text-xs transition-colors">
                        ⚙️ Atur Alamat & Kontak Keluarga
                    </button>
                </div>

                <!-- Card Riwayat Terakhir -->
                <div class="bg-white rounded-3xl border border-slate-200/80 p-6 shadow-xs">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="font-extrabold text-slate-800 text-base flex items-center gap-2">
                            <span class="w-2.5 h-2.5 rounded-full bg-emerald-500"></span>
                            <span>Riwayat Pesanan Anda</span>
                        </h3>
                        <a href="{{ route('masyarakat.orders.index') }}" class="text-xs font-bold text-primary-600 hover:underline">
                            Lihat Semua &rarr;
                        </a>
                    </div>

                    <div class="space-y-3">
                        @forelse($recentOrders as $ro)
                            <div class="p-3.5 rounded-2xl bg-slate-50 border border-slate-100 hover:bg-slate-100/80 transition-colors">
                                <div class="flex items-center justify-between text-xs mb-1">
                                    <span class="font-black text-slate-700">#{{ $ro->kode_order }}</span>
                                    <span class="px-2 py-0.5 rounded text-[10px] font-bold
                                        @if($ro->status === 'selesai') bg-emerald-100 text-emerald-700
                                        @elseif($ro->status === 'dibatalkan') bg-slate-200 text-slate-600
                                        @else bg-primary-100 text-primary-700 @endif">
                                        {{ strtoupper($ro->status_label) }}
                                    </span>
                                </div>
                                <p class="text-xs font-bold text-slate-800 truncate">{{ $ro->nama_pasien }}</p>
                                <p class="text-[11px] text-slate-500 truncate mt-0.5">{{ $ro->lokasi_jemput }}</p>
                                <div class="mt-2 pt-2 border-t border-slate-200/60 flex items-center justify-between text-[11px]">
                                    <span class="text-slate-400">{{ $ro->waktu_pesan ? $ro->waktu_pesan->format('d M Y') : '-' }}</span>
                                    <a href="{{ route('masyarakat.tracking', $ro->id) }}" class="font-bold text-primary-600 hover:underline">
                                        Detail / Tracking &rarr;
                                    </a>
                                </div>
                            </div>
                        @empty
                            <div class="py-6 text-center text-slate-400 text-xs font-semibold">
                                Belum ada riwayat pesanan ambulans.
                            </div>
                        @endforelse
                    </div>
                </div>

                <!-- Card Donasi Kemanusiaan GSC -->
                <div class="bg-gradient-to-br from-teal-700 via-primary-700 to-slate-900 text-white rounded-3xl p-6 shadow-xl relative overflow-hidden">
                    <div class="w-10 h-10 rounded-2xl bg-white/20 flex items-center justify-center text-xl mb-3">
                        ❤️
                    </div>
                    <h3 class="text-lg font-black tracking-tight">Dukung Ambulans Gratis</h3>
                    <p class="text-xs text-teal-100 font-medium mt-1 mb-5 leading-relaxed">
                        Layanan evakuasi medis darurat ini beroperasi gratis 100% untuk warga dhuafa berkat sedekah dan infaq para dermawan.
                    </p>
                    <a href="{{ route('donasi') }}"
                       class="inline-block w-full py-3 rounded-xl bg-white hover:bg-slate-50 text-teal-800 font-black text-xs text-center shadow-lg transition-all transform hover:scale-102">
                        🌟 INFAQ & DONASI OPERASIONAL
                    </a>
                </div>

            </div>

        </div>

    </main>

    <!-- Modal Edit Profil Darurat (ICE) -->
    @if($showEditIceModal)
        <div class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-xs">
            <div class="bg-white rounded-3xl max-w-lg w-full p-6 sm:p-8 shadow-2xl border border-slate-100 animate-in fade-in zoom-in duration-200">
                <div class="flex items-center justify-between mb-4 pb-3 border-b border-slate-100">
                    <div>
                        <h3 class="text-lg font-black text-slate-800">Pengaturan Profil Darurat (ICE)</h3>
                        <p class="text-xs text-slate-500">Lengkapi data agar pemesanan darurat Anda lebih cepat.</p>
                    </div>
                    <button type="button" wire:click="$set('showEditIceModal', false)" class="text-slate-400 hover:text-slate-600 font-bold text-xl">&times;</button>
                </div>

                <form wire:submit.prevent="saveIceProfile" class="space-y-4 text-xs">
                    <div>
                        <label class="font-bold text-slate-700 block mb-1">Nomor Induk Kependudukan (NIK)</label>
                        <input type="text" wire:model="ice_nik" placeholder="16 digit NIK KTP..."
                               class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-xs font-semibold focus:ring-2 focus:ring-primary-500">
                    </div>

                    <div>
                        <label class="font-bold text-slate-700 block mb-1">Kontak Darurat Keluarga / Kerabat</label>
                        <input type="text" wire:model="ice_kontak_darurat" placeholder="Contoh: 081234567890 (Istri / Orang Tua)"
                               class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-xs font-semibold focus:ring-2 focus:ring-primary-500">
                    </div>

                    <div>
                        <label class="font-bold text-slate-700 block mb-1">Alamat Tempat Tinggal / Titik Jemput Utama</label>
                        <textarea wire:model="ice_alamat" rows="3" placeholder="Jl. Gatot Subroto No. ..., RT/RW, Kelurahan, Kecamatan..."
                                  class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-xs font-semibold focus:ring-2 focus:ring-primary-500"></textarea>
                    </div>

                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label class="font-bold text-slate-700 block mb-1">Tanggal Lahir</label>
                            <input type="date" wire:model="ice_tanggal_lahir"
                                   class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-xs font-semibold focus:ring-2 focus:ring-primary-500">
                        </div>
                        <div>
                            <label class="font-bold text-slate-700 block mb-1">Jenis Kelamin</label>
                            <select wire:model="ice_jenis_kelamin" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-xs font-semibold focus:ring-2 focus:ring-primary-500">
                                <option value="L">Laki-Laki</option>
                                <option value="P">Perempuan</option>
                            </select>
                        </div>
                    </div>

                    <div class="pt-4 flex items-center justify-end gap-3 border-t border-slate-100">
                        <button type="button" wire:click="$set('showEditIceModal', false)"
                                class="px-5 py-2.5 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold text-xs transition-colors">
                            Batal
                        </button>
                        <button type="submit"
                                class="px-6 py-2.5 rounded-xl bg-primary-600 hover:bg-primary-700 text-white font-extrabold text-xs shadow-md transition-colors">
                            Simpan Data Darurat
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endif

    <x-landing-footer />
</div>
