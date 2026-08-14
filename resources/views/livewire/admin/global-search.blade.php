<div class="hidden md:flex relative group z-50" x-data="{ searchOpen: false }">
    <!-- Search Input -->
    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
        <svg class="h-4 w-4 text-slate-400 group-focus-within:text-sky-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
        </svg>
    </div>
    
    <input type="text" 
           wire:model.live.debounce.300ms="query"
           @focus="searchOpen = true"
           @click.outside="searchOpen = false"
           @keydown.escape="searchOpen = false"
           placeholder="Cari data (Ctrl+K)..." 
           class="pl-9 pr-4 py-2 w-48 lg:w-64 border border-slate-200 rounded-lg text-sm bg-slate-50 focus:bg-white focus:ring-1 focus:ring-sky-500 focus:border-sky-500 transition-all outline-none"
           id="globalSearchInput">

    <!-- Loading Indicator -->
    <div wire:loading wire:target="query" class="absolute right-3 top-2.5">
        <svg class="animate-spin h-4 w-4 text-slate-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
        </svg>
    </div>

    <!-- Dropdown Results -->
    <div x-show="searchOpen && $wire.query && $wire.query.length >= 2" 
         x-transition:enter="transition ease-out duration-100"
         x-transition:enter-start="transform opacity-0 scale-95"
         x-transition:enter-end="transform opacity-100 scale-100"
         x-transition:leave="transition ease-in duration-75"
         x-transition:leave-start="transform opacity-100 scale-100"
         x-transition:leave-end="transform opacity-0 scale-95"
         class="absolute top-full left-0 mt-2 w-[400px] bg-white rounded-xl shadow-xl border border-slate-200 overflow-hidden"
         style="display: none;">
        
        <div class="max-h-[400px] overflow-y-auto custom-scrollbar">
            @if(strlen($query) >= 2)
                @if(empty($results))
                    <div class="p-4 text-center text-sm text-slate-500">
                        Tidak ada data yang cocok dengan "<span class="font-bold">{{ $query }}</span>"
                    </div>
                @else
                    @foreach($results as $group => $items)
                        <div class="px-3 py-2 bg-slate-50 border-y border-slate-100 first:border-t-0">
                            <span class="text-[10px] font-bold text-slate-500 uppercase tracking-wider">{{ $group }}</span>
                        </div>
                        <ul class="py-1">
                            @foreach($items as $item)
                                <li>
                                    @if($group === 'Pemesanan / Layanan')
                                        <a href="{{ auth()->user()->isAdmin() ? route('admin.orders.index') : route('operator.orders.index') }}" class="block px-4 py-2.5 hover:bg-sky-50 transition-colors">
                                            <div class="flex items-center justify-between">
                                                <span class="text-sm font-bold text-slate-800">{{ $item->kode_order }}</span>
                                                <span class="text-[10px] px-2 py-0.5 rounded-full bg-slate-100 text-slate-600 font-semibold">{{ $item->status_label ?? $item->status }}</span>
                                            </div>
                                            <span class="block text-xs text-slate-500 mt-0.5">Pasien: {{ $item->user->name ?? 'Unknown' }}</span>
                                        </a>
                                    @elseif($group === 'Armada Ambulans')
                                        <a href="{{ route('admin.ambulans.index') }}" class="block px-4 py-2.5 hover:bg-sky-50 transition-colors">
                                            <span class="block text-sm font-bold text-slate-800">{{ $item->plat_nomor }}</span>
                                            <span class="block text-xs text-slate-500 mt-0.5">Kode: {{ $item->kode_ambulans }}</span>
                                        </a>
                                    @elseif($group === 'Pengguna & Supir')
                                        <a href="{{ route('admin.users.index') }}" class="block px-4 py-2.5 hover:bg-sky-50 transition-colors">
                                            <div class="flex items-center justify-between">
                                                <div>
                                                    <span class="block text-sm font-bold text-slate-800">{{ $item->name }}</span>
                                                    <span class="block text-xs text-slate-500">{{ $item->email }}</span>
                                                </div>
                                                <span class="text-[10px] px-2 py-0.5 rounded-full bg-slate-100 text-slate-600 font-semibold">{{ $item->role_label }}</span>
                                            </div>
                                        </a>
                                    @elseif($group === 'Rumah Sakit Mitra')
                                        <a href="{{ route('admin.rumahsakit.index') }}" class="block px-4 py-2.5 hover:bg-sky-50 transition-colors">
                                            <span class="block text-sm font-bold text-slate-800">{{ $item->nama }}</span>
                                            <span class="block text-xs text-slate-500 mt-0.5 truncate">{{ $item->alamat }}</span>
                                        </a>
                                    @elseif($group === 'Transaksi Donasi')
                                        <a href="{{ route('admin.donasi.index') }}" class="block px-4 py-2.5 hover:bg-sky-50 transition-colors">
                                            <div class="flex items-center justify-between">
                                                <span class="block text-sm font-bold text-slate-800">{{ $item->nama ?: 'Hamba Allah' }}</span>
                                                <span class="text-xs font-bold text-emerald-600">Rp {{ number_format($item->nominal, 0, ',', '.') }}</span>
                                            </div>
                                        </a>
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                    @endforeach
                @endif
            @endif
        </div>
    </div>
</div>

<!-- Global Keyboard Shortcut -->
<script>
    document.addEventListener('keydown', function(e) {
        if ((e.ctrlKey || e.metaKey) && e.key === 'k') {
            e.preventDefault();
            document.getElementById('globalSearchInput').focus();
        }
    });
</script>
