<div>
    <!-- Header -->
    <div class="mb-8 flex flex-col lg:flex-row lg:items-end lg:justify-between gap-6">
        <div class="flex-1">
            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-extrabold bg-white/20 text-white uppercase tracking-wider mb-2.5 shadow-sm border border-white/20 backdrop-blur-md">
                Pusat Kendali Eksekutif
            </span>
            <h1 class="text-2xl sm:text-[32px] font-extrabold text-white tracking-tight drop-shadow-md leading-tight">
                Dashboard Eksekutif Ambulance Siaga
            </h1>
            <p class="text-white/90 text-[15px] sm:text-base mt-2 font-medium leading-relaxed drop-shadow-sm max-w-2xl">
                Pantau statistik evakuasi, efisiensi armada, dan aktivitas pengguna sistem secara real-time.
            </p>
        </div>

        <div class="flex items-center gap-3">
            <a href="{{ route('admin.laporan.index') }}"
               class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-sky-600 hover:bg-sky-700 text-white font-bold text-sm shadow-md transition-all">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
                <span>Unduh Laporan</span>
            </a>
        </div>
    </div>

    <!-- 4 Metrik Eksekutif -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Total Order -->
        <div class="p-6 rounded-3xl bg-white border border-slate-200/80 shadow-xs flex items-center justify-between">
            <div>
                <span class="text-xs font-bold text-slate-400 uppercase tracking-wider block mb-1">Total Pesanan</span>
                <span class="text-3xl font-black text-slate-800">{{ $stats['total_order'] }}</span>
                <span class="text-xs text-emerald-600 font-bold block mt-1">✓ {{ $stats['order_selesai'] }} evakuasi sukses</span>
            </div>
            <div class="w-14 h-14 rounded-2xl bg-sky-50 text-sky-600 flex items-center justify-center font-bold border border-sky-100">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                </svg>
            </div>
        </div>

        <!-- Armada Ambulans -->
        <div class="p-6 rounded-3xl bg-white border border-slate-200/80 shadow-xs flex items-center justify-between">
            <div>
                <span class="text-xs font-bold text-slate-400 uppercase tracking-wider block mb-1">Armada Ambulans</span>
                <span class="text-3xl font-black text-slate-800">{{ $stats['total_ambulans'] }}</span>
                <span class="text-xs text-primary-600 font-bold block mt-1">🚚 Siap siaga 24/7</span>
            </div>
            <div class="w-14 h-14 rounded-2xl bg-primary-50 text-primary-600 flex items-center justify-center font-bold border border-primary-100">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                </svg>
            </div>
        </div>

        <!-- Rumah Sakit Mitra -->
        <div class="p-6 rounded-3xl bg-white border border-slate-200/80 shadow-xs flex items-center justify-between">
            <div>
                <span class="text-xs font-bold text-slate-400 uppercase tracking-wider block mb-1">RS Mitra Rujukan</span>
                <span class="text-3xl font-black text-slate-800">{{ $stats['total_rs'] }}</span>
                <span class="text-xs text-slate-500 block mt-1">Wilayah Cilacap & Sekitar</span>
            </div>
            <div class="w-14 h-14 rounded-2xl bg-emerald-50 text-emerald-600 flex items-center justify-center font-bold border border-emerald-100">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                </svg>
            </div>
        </div>

        <!-- Total User -->
        <div class="p-6 rounded-3xl bg-white border border-slate-200/80 shadow-xs flex items-center justify-between">
            <div>
                <span class="text-xs font-bold text-slate-400 uppercase tracking-wider block mb-1">Pengguna Terdaftar</span>
                <span class="text-3xl font-black text-slate-800">{{ $stats['total_user'] }}</span>
                <span class="text-xs text-slate-500 block mt-1">{{ $stats['supir_aktif'] }} supir online sekarang</span>
            </div>
            <div class="w-14 h-14 rounded-2xl bg-slate-100 text-slate-600 flex items-center justify-center font-bold border border-slate-200">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                </svg>
            </div>
        </div>
    </div>

    <!-- Charts Section (Chart.js via Alpine) -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 mb-8">
        <!-- Monthly Chart (Left 8 Cols) -->
        <div class="lg:col-span-8 bg-white rounded-3xl border border-slate-200/80 p-6 sm:p-8 shadow-xs"
             x-data="chartMonthlyComponent(@js($months), @js($chartMonthly))"
             x-init="initChart()">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h2 class="font-bold text-slate-800 text-base">Grafik Pemesanan Ambulans Bulanan</h2>
                    <p class="text-xs text-slate-500">Tren jumlah layanan ambulans darurat dalam 6 bulan terakhir</p>
                </div>
                <span class="px-3 py-1 rounded-full text-xs font-bold bg-sky-50 text-sky-700">Tahun 2026</span>
            </div>
            <div class="h-64 sm:h-72">
                <canvas id="monthlyChart"></canvas>
            </div>
        </div>

        <!-- Doughnut Status Chart (Right 4 Cols) -->
        <div class="lg:col-span-4 bg-white rounded-3xl border border-slate-200/80 p-6 sm:p-8 shadow-xs flex flex-col justify-between"
             x-data="chartStatusComponent(@js(array_values($chartStatus)))"
             x-init="initChart()">
            <div>
                <h2 class="font-bold text-slate-800 text-base mb-1">Komposisi Status Pesanan</h2>
                <p class="text-xs text-slate-500 mb-6">Sebaran status penanganan order evakuasi</p>
            </div>
            <div class="h-56 flex items-center justify-center">
                <canvas id="statusChart"></canvas>
            </div>
            <div class="grid grid-cols-2 gap-2 mt-6 pt-4 border-t border-slate-100 text-xs font-semibold">
                <div class="flex items-center gap-1.5 text-amber-700">
                    <span class="w-2.5 h-2.5 rounded-full bg-amber-500"></span>
                    <span>Menunggu: {{ $chartStatus['Menunggu'] }}</span>
                </div>
                <div class="flex items-center gap-1.5 text-primary-700">
                    <span class="w-2.5 h-2.5 rounded-full bg-primary-600"></span>
                    <span>Diproses: {{ $chartStatus['Diproses'] }}</span>
                </div>
                <div class="flex items-center gap-1.5 text-emerald-700">
                    <span class="w-2.5 h-2.5 rounded-full bg-emerald-600"></span>
                    <span>Selesai: {{ $chartStatus['Selesai'] }}</span>
                </div>
                <div class="flex items-center gap-1.5 text-slate-600">
                    <span class="w-2.5 h-2.5 rounded-full bg-slate-400"></span>
                    <span>Batal: {{ $chartStatus['Dibatalkan'] }}</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Bottom Section: Recent Orders & Audit Logs -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
        <!-- Recent Orders (7 Cols) -->
        <div class="lg:col-span-7 bg-white rounded-3xl border border-slate-200/80 p-6 sm:p-8 shadow-xs">
            <div class="flex items-center justify-between mb-6">
                <h2 class="font-bold text-slate-800 text-base">Order Ambulans Terakhir</h2>
                <a href="{{ route('admin.orders.index') }}" class="text-xs font-bold text-sky-600 hover:underline">Lihat Semua &rarr;</a>
            </div>

            <div class="space-y-4">
                @foreach($recentOrders as $o)
                    <div class="p-3.5 rounded-2xl bg-slate-50 border border-slate-200/60 flex items-center justify-between text-xs">
                        <div>
                            <div class="flex items-center gap-2 mb-0.5">
                                <span class="font-black text-slate-800">{{ $o->kode_order }}</span>
                                <span class="px-2 py-0.5 rounded text-[10px] font-extrabold
                                    {{ $o->status === 'selesai' ? 'bg-emerald-100 text-emerald-700' : 'bg-primary-100 text-primary-700' }}">
                                    {{ $o->status_label }}
                                </span>
                            </div>
                            <span class="font-bold text-slate-700">{{ $o->nama_pasien }}</span>
                            <span class="text-slate-500 block text-[11px] mt-0.5">{{ $o->lokasi_jemput }}</span>
                        </div>
                        <div class="text-right">
                            <span class="text-slate-400 text-[11px] block">{{ $o->created_at->format('d M, H:i') }}</span>
                            <span class="font-bold text-slate-700">{{ $o->ambulans?->kode_ambulans ?? '-' }}</span>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Recent Logs (5 Cols) -->
        <div class="lg:col-span-5 bg-white rounded-3xl border border-slate-200/80 p-6 sm:p-8 shadow-xs">
            <div class="flex items-center justify-between mb-6">
                <h2 class="font-bold text-slate-800 text-base">Log Audit & Aktivitas</h2>
                <a href="{{ route('admin.audit.index') }}" class="text-xs font-bold text-sky-600 hover:underline">Semua Log &rarr;</a>
            </div>

            <div class="space-y-3.5">
                @foreach($recentLogs as $log)
                    <div class="flex items-start gap-3 text-xs pb-3 border-b border-slate-100 last:border-0 last:pb-0">
                        <div class="w-2 h-2 rounded-full bg-slate-400 mt-1.5 flex-shrink-0"></div>
                        <div class="flex-1 min-w-0">
                            <div class="flex items-center justify-between">
                                <span class="font-bold text-slate-800 truncate">{{ $log->action }}</span>
                                <span class="text-[10px] text-slate-400 flex-shrink-0">{{ $log->created_at->format('H:i:s') }}</span>
                            </div>
                            <p class="text-slate-600 text-[11px] truncate mt-0.5">{{ $log->description }}</p>
                            <span class="text-[10px] text-slate-400 block mt-0.5">Oleh: {{ $log->user?->name ?? 'System' }}</span>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Chart.js Scripts -->
    <script>
        function chartMonthlyComponent(labels, data) {
            return {
                initChart() {
                    const ctx = document.getElementById('monthlyChart').getContext('2d');
                    new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: labels,
                            datasets: [{
                                label: 'Jumlah Pemesanan',
                                data: data,
                                backgroundColor: 'rgba(2, 132, 199, 0.85)',
                                hoverBackgroundColor: '#0369a1',
                                borderRadius: 8,
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            plugins: { legend: { display: false } },
                            scales: {
                                y: { beginAtZero: true, grid: { color: '#F1F5F9' } },
                                x: { grid: { display: false } }
                            }
                        }
                    });
                }
            }
        }

        function chartStatusComponent(data) {
            return {
                initChart() {
                    const ctx = document.getElementById('statusChart').getContext('2d');
                    new Chart(ctx, {
                        type: 'doughnut',
                        data: {
                            labels: ['Menunggu', 'Diproses', 'Selesai', 'Dibatalkan'],
                            datasets: [{
                                data: data,
                                backgroundColor: ['#F59E0B', '#0284C7', '#10B981', '#94A3B8'],
                                borderWidth: 0
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            plugins: { legend: { display: false } },
                            cutout: '68%'
                        }
                    });
                }
            }
        }
    </script>
</div>
