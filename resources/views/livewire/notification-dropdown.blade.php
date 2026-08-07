<div class="relative" x-data="{ notifOpen: false }" wire:poll.10s>
    <!-- Bell Button -->
    <button @click="notifOpen = !notifOpen" @click.outside="notifOpen = false"
            class="relative p-2 text-slate-600 hover:text-slate-900 hover:bg-slate-100 rounded-xl transition-colors focus:outline-none">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
        </svg>

        @if($unreadCount > 0)
            <span class="absolute top-1.5 right-1.5 inline-flex items-center justify-center px-1.5 py-0.5 text-[10px] font-bold leading-none text-white bg-sky-600 rounded-full shadow-sm">
                {{ $unreadCount > 9 ? '9+' : $unreadCount }}
            </span>
        @endif
    </button>

    <!-- Dropdown Panel -->
    <div x-show="notifOpen"
         x-transition:enter="transition ease-out duration-100"
         x-transition:enter-start="transform opacity-0 scale-95"
         x-transition:enter-end="transform opacity-100 scale-100"
         x-transition:leave="transition ease-in duration-75"
         x-transition:leave-start="transform opacity-100 scale-100"
         x-transition:leave-end="transform opacity-0 scale-95"
         class="absolute right-0 mt-2 w-80 sm:w-96 bg-white rounded-2xl shadow-xl border border-slate-200/80 overflow-hidden z-50"
         style="display: none;">

        <!-- Header -->
        <div class="px-4 py-3 bg-slate-50 border-b border-slate-200 flex items-center justify-between">
            <div class="flex items-center gap-2">
                <span class="font-bold text-slate-800 text-sm">Notifikasi</span>
                @if($unreadCount > 0)
                    <span class="px-2 py-0.5 rounded-full text-xs font-semibold bg-sky-100 text-sky-700">
                        {{ $unreadCount }} Baru
                    </span>
                @endif
            </div>
            @if($unreadCount > 0)
                <button wire:click="markAllAsRead"
                        class="text-xs font-semibold text-sky-600 hover:text-sky-700 transition-colors">
                    Tandai Semua Dibaca
                </button>
            @endif
        </div>

        <!-- List -->
        <div class="divide-y divide-slate-100 max-h-80 overflow-y-auto">
            @forelse($notifications as $notif)
                <div wire:click="markAsRead({{ $notif->id }})"
                     class="px-4 py-3 hover:bg-slate-50 cursor-pointer transition-colors flex items-start gap-3 {{ !$notif->is_read ? 'bg-sky-50/40' : '' }}">
                    <div class="w-8 h-8 rounded-full flex-shrink-0 flex items-center justify-center {{ $notif->type === 'danger' ? 'bg-red-100 text-red-600' : ($notif->type === 'success' ? 'bg-emerald-100 text-emerald-600' : 'bg-primary-100 text-primary-600') }}">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-xs font-bold text-slate-800 truncate">{{ $notif->title }}</p>
                        <p class="text-xs text-slate-600 mt-0.5 line-clamp-2">{{ $notif->message }}</p>
                        <span class="text-[10px] text-slate-400 mt-1 block">{{ $notif->created_at->diffForHumans() }}</span>
                    </div>
                    @if(!$notif->is_read)
                        <span class="w-2 h-2 rounded-full bg-sky-600 self-center flex-shrink-0"></span>
                    @endif
                </div>
            @empty
                <div class="py-8 text-center text-slate-400">
                    <svg class="w-10 h-10 mx-auto text-slate-300 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                    </svg>
                    <p class="text-xs font-medium">Belum ada notifikasi baru</p>
                </div>
            @endforelse
        </div>

    </div>
</div>
