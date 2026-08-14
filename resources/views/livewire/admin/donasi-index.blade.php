<div class="space-y-6">
    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-slate-900 tracking-tight">Daftar Transaksi</h1>
            <p class="text-sm text-slate-500 mt-1">Kelola dan pantau aliran dana donasi masuk.</p>
        </div>
        <div class="flex items-center gap-3">
            <button wire:click="exportCsv" wire:loading.attr="disabled"
                    class="inline-flex items-center gap-2 px-4 py-2 bg-white border border-slate-200 rounded-lg text-sm font-semibold text-slate-700 hover:bg-slate-50 transition-colors shadow-sm disabled:opacity-50">
                <span wire:loading.remove wire:target="exportCsv" class="flex items-center gap-2">
                    <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                    Ekspor CSV
                </span>
                <span wire:loading wire:target="exportCsv" class="flex items-center gap-2">
                    <svg class="animate-spin h-4 w-4 text-slate-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    Mengunduh...
                </span>
            </button>
        </div>
    </div>

    <!-- Table Container -->
    <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
        
        <!-- Table Toolbar -->
        <div class="p-4 border-b border-slate-200 bg-white flex flex-col lg:flex-row lg:items-center justify-between gap-4">
            
            <!-- Left: Search & Filter -->
            <div class="flex flex-col sm:flex-row items-center gap-3 w-full lg:w-auto">
                
                <!-- Search Input with Custom Field Selector -->
                <div class="relative flex items-center w-full sm:w-80">
                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                        <svg class="h-4 w-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    </div>
                    <input wire:model.live.debounce.300ms="search" type="text" placeholder="Masukkan kata kunci..." 
                           class="w-full pl-10 pr-32 py-2.5 rounded-xl border border-slate-200 bg-white text-sm text-slate-800 placeholder-slate-400 focus:border-sky-500 focus:ring-2 focus:ring-sky-100 shadow-xs transition-all outline-none">
                    
                    <!-- Custom Field Dropdown -->
                    <div class="absolute inset-y-1 right-1 flex items-center" x-data="{ open: false }">
                        <button type="button" @click="open = !open" @click.outside="open = false" 
                                class="inline-flex items-center gap-1 text-xs font-bold text-slate-700 bg-slate-100 hover:bg-slate-200/80 px-2.5 py-1.5 rounded-lg transition-colors">
                            <span>
                                @if($searchField === 'email') Email
                                @elseif($searchField === 'id') ID Order
                                @else Nama
                                @endif
                            </span>
                            <svg class="w-3 h-3 text-slate-500 transition-transform duration-200" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                        </button>
                        
                        <!-- Floating Menu -->
                        <div x-show="open" x-transition.opacity.duration.150ms
                             class="absolute right-0 top-full mt-1.5 w-36 bg-white rounded-xl shadow-xl border border-slate-200 py-1.5 z-50 overflow-hidden"
                             style="display: none;">
                            <button type="button" @click="$wire.set('searchField', 'nama'); open = false" 
                                    class="w-full text-left px-3.5 py-2 text-xs font-semibold flex items-center justify-between hover:bg-sky-50 hover:text-sky-600 transition-colors {{ $searchField === 'nama' ? 'text-sky-600 bg-sky-50/50' : 'text-slate-700' }}">
                                <span>Nama Donatur</span>
                                @if($searchField === 'nama') <svg class="w-3.5 h-3.5 text-sky-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg> @endif
                            </button>
                            <button type="button" @click="$wire.set('searchField', 'email'); open = false" 
                                    class="w-full text-left px-3.5 py-2 text-xs font-semibold flex items-center justify-between hover:bg-sky-50 hover:text-sky-600 transition-colors {{ $searchField === 'email' ? 'text-sky-600 bg-sky-50/50' : 'text-slate-700' }}">
                                <span>Email</span>
                                @if($searchField === 'email') <svg class="w-3.5 h-3.5 text-sky-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg> @endif
                            </button>
                            <button type="button" @click="$wire.set('searchField', 'id'); open = false" 
                                    class="w-full text-left px-3.5 py-2 text-xs font-semibold flex items-center justify-between hover:bg-sky-50 hover:text-sky-600 transition-colors {{ $searchField === 'id' ? 'text-sky-600 bg-sky-50/50' : 'text-slate-700' }}">
                                <span>ID Order</span>
                                @if($searchField === 'id') <svg class="w-3.5 h-3.5 text-sky-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg> @endif
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Custom Status Filter Dropdown -->
                <div class="relative w-full sm:w-48" x-data="{ open: false }">
                    <button type="button" @click="open = !open" @click.outside="open = false"
                            class="w-full flex items-center justify-between py-2.5 px-3.5 rounded-xl border border-slate-200 bg-white text-sm font-medium text-slate-700 shadow-xs hover:border-slate-300 focus:outline-none focus:ring-2 focus:ring-sky-100 transition-all">
                        <span class="truncate">
                            @if($statusFilter === 'berhasil') Berhasil (Settlement)
                            @elseif($statusFilter === 'pending') Menunggu (Pending)
                            @elseif($statusFilter === 'gagal') Gagal / Batal
                            @else Semua Status
                            @endif
                        </span>
                        <svg class="w-4 h-4 text-slate-400 ml-2 flex-shrink-0 transition-transform duration-200" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </button>

                    <!-- Floating Menu -->
                    <div x-show="open" x-transition.opacity.duration.150ms
                         class="absolute left-0 top-full mt-1.5 w-full bg-white rounded-xl shadow-xl border border-slate-200 py-1.5 z-50 overflow-hidden"
                         style="display: none;">
                        <button type="button" @click="$wire.set('statusFilter', ''); open = false"
                                class="w-full text-left px-3.5 py-2 text-xs font-semibold flex items-center justify-between hover:bg-sky-50 hover:text-sky-600 transition-colors {{ $statusFilter === '' ? 'text-sky-600 bg-sky-50/50' : 'text-slate-700' }}">
                            <span>Semua Status</span>
                            @if($statusFilter === '') <svg class="w-3.5 h-3.5 text-sky-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg> @endif
                        </button>
                        <button type="button" @click="$wire.set('statusFilter', 'berhasil'); open = false"
                                class="w-full text-left px-3.5 py-2 text-xs font-semibold flex items-center justify-between hover:bg-sky-50 hover:text-sky-600 transition-colors {{ $statusFilter === 'berhasil' ? 'text-sky-600 bg-sky-50/50' : 'text-slate-700' }}">
                            <span>Berhasil (Settlement)</span>
                            @if($statusFilter === 'berhasil') <svg class="w-3.5 h-3.5 text-sky-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg> @endif
                        </button>
                        <button type="button" @click="$wire.set('statusFilter', 'pending'); open = false"
                                class="w-full text-left px-3.5 py-2 text-xs font-semibold flex items-center justify-between hover:bg-sky-50 hover:text-sky-600 transition-colors {{ $statusFilter === 'pending' ? 'text-sky-600 bg-sky-50/50' : 'text-slate-700' }}">
                            <span>Menunggu (Pending)</span>
                            @if($statusFilter === 'pending') <svg class="w-3.5 h-3.5 text-sky-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg> @endif
                        </button>
                        <button type="button" @click="$wire.set('statusFilter', 'gagal'); open = false"
                                class="w-full text-left px-3.5 py-2 text-xs font-semibold flex items-center justify-between hover:bg-sky-50 hover:text-sky-600 transition-colors {{ $statusFilter === 'gagal' ? 'text-sky-600 bg-sky-50/50' : 'text-slate-700' }}">
                            <span>Gagal / Batal</span>
                            @if($statusFilter === 'gagal') <svg class="w-3.5 h-3.5 text-sky-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg> @endif
                        </button>
                    </div>
                </div>

                <!-- Custom Date Filter Dropdown -->
                <div class="relative w-full sm:w-48" x-data="{ open: false }">
                    <button type="button" @click="open = !open" @click.outside="open = false"
                            class="w-full flex items-center justify-between py-2.5 px-3.5 rounded-xl border border-slate-200 bg-white text-sm font-medium text-slate-700 shadow-xs hover:border-slate-300 focus:outline-none focus:ring-2 focus:ring-sky-100 transition-all">
                        <span class="truncate">
                            @if($dateFilter === 'today') Hari Ini
                            @elseif($dateFilter === '7days') 7 Hari Terakhir
                            @elseif($dateFilter === '30days') 30 Hari Terakhir
                            @elseif($dateFilter === 'this_month') Bulan Ini
                            @elseif($dateFilter === 'this_year') Tahun Ini
                            @else Semua Waktu
                            @endif
                        </span>
                        <svg class="w-4 h-4 text-slate-400 ml-2 flex-shrink-0 transition-transform duration-200" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </button>

                    <!-- Floating Menu -->
                    <div x-show="open" x-transition.opacity.duration.150ms
                         class="absolute left-0 top-full mt-1.5 w-full bg-white rounded-xl shadow-xl border border-slate-200 py-1.5 z-50 overflow-hidden"
                         style="display: none;">
                        <button type="button" @click="$wire.set('dateFilter', ''); open = false"
                                class="w-full text-left px-3.5 py-2 text-xs font-semibold flex items-center justify-between hover:bg-sky-50 hover:text-sky-600 transition-colors {{ $dateFilter === '' ? 'text-sky-600 bg-sky-50/50' : 'text-slate-700' }}">
                            <span>Semua Waktu</span>
                            @if($dateFilter === '') <svg class="w-3.5 h-3.5 text-sky-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg> @endif
                        </button>
                        <button type="button" @click="$wire.set('dateFilter', 'today'); open = false"
                                class="w-full text-left px-3.5 py-2 text-xs font-semibold flex items-center justify-between hover:bg-sky-50 hover:text-sky-600 transition-colors {{ $dateFilter === 'today' ? 'text-sky-600 bg-sky-50/50' : 'text-slate-700' }}">
                            <span>Hari Ini</span>
                            @if($dateFilter === 'today') <svg class="w-3.5 h-3.5 text-sky-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg> @endif
                        </button>
                        <button type="button" @click="$wire.set('dateFilter', '7days'); open = false"
                                class="w-full text-left px-3.5 py-2 text-xs font-semibold flex items-center justify-between hover:bg-sky-50 hover:text-sky-600 transition-colors {{ $dateFilter === '7days' ? 'text-sky-600 bg-sky-50/50' : 'text-slate-700' }}">
                            <span>7 Hari Terakhir</span>
                            @if($dateFilter === '7days') <svg class="w-3.5 h-3.5 text-sky-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg> @endif
                        </button>
                        <button type="button" @click="$wire.set('dateFilter', '30days'); open = false"
                                class="w-full text-left px-3.5 py-2 text-xs font-semibold flex items-center justify-between hover:bg-sky-50 hover:text-sky-600 transition-colors {{ $dateFilter === '30days' ? 'text-sky-600 bg-sky-50/50' : 'text-slate-700' }}">
                            <span>30 Hari Terakhir</span>
                            @if($dateFilter === '30days') <svg class="w-3.5 h-3.5 text-sky-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg> @endif
                        </button>
                        <button type="button" @click="$wire.set('dateFilter', 'this_month'); open = false"
                                class="w-full text-left px-3.5 py-2 text-xs font-semibold flex items-center justify-between hover:bg-sky-50 hover:text-sky-600 transition-colors {{ $dateFilter === 'this_month' ? 'text-sky-600 bg-sky-50/50' : 'text-slate-700' }}">
                            <span>Bulan Ini</span>
                            @if($dateFilter === 'this_month') <svg class="w-3.5 h-3.5 text-sky-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg> @endif
                        </button>
                        <button type="button" @click="$wire.set('dateFilter', 'this_year'); open = false"
                                class="w-full text-left px-3.5 py-2 text-xs font-semibold flex items-center justify-between hover:bg-sky-50 hover:text-sky-600 transition-colors {{ $dateFilter === 'this_year' ? 'text-sky-600 bg-sky-50/50' : 'text-slate-700' }}">
                            <span>Tahun Ini</span>
                            @if($dateFilter === 'this_year') <svg class="w-3.5 h-3.5 text-sky-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg> @endif
                        </button>
                    </div>
                </div>
            </div>

            <!-- Right: Filter Actions -->
            <div class="flex items-center gap-2 self-end sm:self-auto">
                <button wire:click="toggleAdvancedFilter"
                        class="px-4 py-2 text-sm font-semibold rounded-lg border transition-colors {{ $showAdvancedFilter ? 'bg-sky-50 border-sky-500 text-sky-700' : 'text-sky-600 bg-white border-sky-300 hover:bg-sky-50' }}">
                    {{ $showAdvancedFilter ? 'Tutup Filter' : 'Filter Lainnya' }}
                </button>
                <button wire:click="applyFilter"
                        class="px-4 py-2 text-sm font-semibold text-white bg-slate-800 rounded-lg hover:bg-slate-700 transition-colors shadow-sm">
                    Terapkan
                </button>
            </div>
        </div>

        <!-- Advanced Filter Panel (Collapsible) -->
        @if($showAdvancedFilter)
            <div class="p-4 bg-slate-50 border-b border-slate-200 transition-all">
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-slate-600 mb-1">Dari Tanggal</label>
                        <input type="date" wire:model.live="startDate" class="w-full px-3 py-2 text-xs rounded-lg border border-slate-300 bg-white focus:border-sky-500 focus:ring-sky-500">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-600 mb-1">Sampai Tanggal</label>
                        <input type="date" wire:model.live="endDate" class="w-full px-3 py-2 text-xs rounded-lg border border-slate-300 bg-white focus:border-sky-500 focus:ring-sky-500">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-600 mb-1">Nominal Min (Rp)</label>
                        <input type="number" wire:model.live.debounce.300ms="minNominal" placeholder="Contoh: 10000" class="w-full px-3 py-2 text-xs rounded-lg border border-slate-300 bg-white focus:border-sky-500 focus:ring-sky-500">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-600 mb-1">Nominal Max (Rp)</label>
                        <input type="number" wire:model.live.debounce.300ms="maxNominal" placeholder="Contoh: 1000000" class="w-full px-3 py-2 text-xs rounded-lg border border-slate-300 bg-white focus:border-sky-500 focus:ring-sky-500">
                    </div>
                </div>
            </div>
        @endif

        <!-- Table Active Filters Indication -->
        <div class="px-4 py-3 bg-slate-50/50 border-b border-slate-200 text-sm text-slate-600 flex items-center justify-between">
            <div class="flex items-center gap-4">
                <span>Menampilkan <span class="font-bold text-sky-600">{{ $donasis->total() }} hasil</span></span>
                <div class="h-4 w-px bg-slate-300"></div>
                <button wire:click="resetFilters" class="text-sky-600 hover:text-sky-700 font-semibold text-xs hover:underline">
                    Reset filter
                </button>
            </div>

            <!-- Total Nominal Info for Filtered Results -->
            <div class="text-xs text-slate-500 font-medium">
                Total Donasi Terkumpul: <span class="font-bold text-emerald-600">Rp{{ number_format($stats['totalDana'], 0, ',', '.') }}</span>
            </div>
        </div>

        <!-- The Table -->
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50 text-slate-500 text-[11px] font-bold uppercase tracking-wider border-b border-slate-200">
                        <th class="px-4 py-3 whitespace-nowrap">Tanggal & Waktu</th>
                        <th class="px-4 py-3 whitespace-nowrap">Order ID</th>
                        <th class="px-4 py-3 whitespace-nowrap">Donatur</th>
                        <th class="px-4 py-3 whitespace-nowrap">Channel Pembayaran</th>
                        <th class="px-4 py-3 whitespace-nowrap">Status</th>
                        <th class="px-4 py-3 whitespace-nowrap">Nilai Donasi</th>
                        <th class="px-4 py-3 whitespace-nowrap">E-mail</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-[13px] text-slate-700">
                    @forelse($donasis as $donasi)
                        <tr class="hover:bg-slate-50/70 transition-colors">
                            <td class="px-4 py-4 whitespace-nowrap text-slate-500 text-xs font-medium">
                                {{ $donasi->created_at ? $donasi->created_at->format('d M Y, H:i') : '-' }}
                            </td>
                            <td class="px-4 py-4 whitespace-nowrap font-semibold text-slate-800">
                                ORD-{{ $donasi->created_at ? $donasi->created_at->format('Ymd') : 'DON' }}-{{ strtoupper(substr(md5($donasi->id), 0, 6)) }}
                            </td>
                            <td class="px-4 py-4 whitespace-nowrap">
                                <span class="font-bold text-slate-900 block">{{ $donasi->is_anonim ? 'Hamba Allah' : ($donasi->nama ?: 'Hamba Allah') }}</span>
                                @if($donasi->pesan)
                                    <span class="text-[11px] text-slate-500 italic block truncate max-w-[200px]" title="{{ $donasi->pesan }}">"{{ $donasi->pesan }}"</span>
                                @endif
                            </td>
                            <td class="px-4 py-4 whitespace-nowrap text-xs text-slate-600">
                                Midtrans (QRIS / Bank / E-Wallet)
                            </td>
                            <td class="px-4 py-4 whitespace-nowrap">
                                @if(in_array($donasi->status, ['settlement', 'success']))
                                    <div class="flex items-center gap-1.5 font-bold text-xs text-emerald-600">
                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                        <span>Settlement</span>
                                    </div>
                                @elseif($donasi->status == 'pending')
                                    <div class="flex items-center gap-1.5 font-bold text-xs text-amber-600">
                                        <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>
                                        <span>Pending</span>
                                    </div>
                                @else
                                    <div class="flex items-center gap-1.5 font-bold text-xs text-rose-600">
                                        <span class="w-1.5 h-1.5 rounded-full bg-rose-500"></span>
                                        <span>Cancelled</span>
                                    </div>
                                @endif
                            </td>
                            <td class="px-4 py-4 whitespace-nowrap font-bold text-slate-900">
                                Rp{{ number_format($donasi->nominal, 0, ',', '.') }}
                            </td>
                            <td class="px-4 py-4 whitespace-nowrap text-xs text-slate-500">
                                <div class="truncate max-w-[160px]" title="{{ $donasi->email ?? '-' }}">
                                    {{ $donasi->is_anonim ? 'hamba.allah@rahasia.com' : ($donasi->email ?? '-') }}
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-4 py-16 text-center">
                                <div class="inline-flex items-center justify-center w-12 h-12 rounded-full bg-slate-100 text-slate-400 mb-3">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2-2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/></svg>
                                </div>
                                <h3 class="text-sm font-bold text-slate-800 mb-1">Tidak Ada Transaksi</h3>
                                <p class="text-xs text-slate-500">Sesuaikan filter atau kata kunci pencarian Anda.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($donasis->hasPages())
            <div class="px-4 py-3 border-t border-slate-200 bg-white">
                {{ $donasis->links() }}
            </div>
        @endif
    </div>
</div>
