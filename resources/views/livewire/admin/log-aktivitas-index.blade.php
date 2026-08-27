<div>
    <!-- Header -->
    <div class="mb-8 flex flex-col lg:flex-row lg:items-end lg:justify-between gap-6">
        <div class="flex-1">
            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[11px] font-bold bg-slate-100 text-slate-500 uppercase tracking-wider mb-2.5">
                Keamanan & Jejak Audit
            </span>
            <h1 class="text-2xl sm:text-[28px] font-bold text-slate-900 tracking-tight leading-tight">
                Log Aktivitas Sistem
            </h1>
            <p class="text-slate-500 text-[14px] mt-1.5 font-medium max-w-2xl">
                Catatan seluruh tindakan pengguna, penugasan armada, dan perubahan sistem.
            </p>
        </div>

        <div class="flex items-center gap-3">
            <input type="text" wire:model.live.debounce.300ms="search"
                   placeholder="Cari aktivitas, deskripsi, atau IP..."
                   class="px-4 py-2.5 rounded-xl border border-slate-300 bg-white text-sm font-medium focus:border-sky-500 focus:ring-2 focus:ring-sky-200 shadow-xs">

            @if(auth()->user()->isAdmin())
                <button type="button" wire:click="clearOldLogs"
                        wire:confirm="Yakin ingin membersihkan seluruh riwayat log aktivitas sistem dari database?"
                        class="px-4 py-2.5 rounded-xl bg-red-50 hover:bg-red-100 text-red-600 font-bold text-xs transition-colors border border-red-200">
                    Bersihkan Semua Log
                </button>
            @endif
        </div>
    </div>

    <!-- Table Logs -->
    <div class="bg-white rounded-3xl border border-slate-200/80 shadow-xs overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-200 text-[11px] font-bold text-slate-500 uppercase tracking-wider">
                        <th class="py-3 px-6 whitespace-nowrap">Waktu Kejadian</th>
                        <th class="py-3 px-6 whitespace-nowrap">Pengguna</th>
                        <th class="py-3 px-6 whitespace-nowrap">Aksi / Kegiatan</th>
                        <th class="py-3 px-6 whitespace-nowrap">Deskripsi Lengkap</th>
                        <th class="py-3 px-6 whitespace-nowrap">Alamat IP</th>
                        <th class="py-3 px-6 whitespace-nowrap text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-sm">
                    @forelse($logs as $log)
                        <tr class="hover:bg-slate-50/50 transition-colors">
                            <td class="py-4 px-6 text-xs text-slate-500 font-semibold whitespace-nowrap">
                                {{ $log->created_at->format('d/m/Y H:i:s') }}
                            </td>
                            <td class="py-4 px-6">
                                <span class="font-bold text-slate-800 block">{{ $log->user?->name ?? 'System / Anonymous' }}</span>
                                <span class="text-xs text-slate-400">{{ $log->user?->role_label ?? '-' }}</span>
                            </td>
                            <td class="py-4 px-6 font-extrabold text-slate-800 text-xs">
                                <span class="px-2.5 py-1 rounded-lg bg-slate-100 text-slate-700">
                                    {{ $log->action }}
                                </span>
                            </td>
                            <td class="py-4 px-6 text-xs text-slate-600 max-w-md">
                                {{ $log->description }}
                            </td>
                            <td class="py-4 px-6 font-mono text-xs text-slate-500">
                                {{ $log->ip_address ?: '-' }}
                            </td>
                            <td class="py-3 px-6 text-right whitespace-nowrap">
                                <div class="flex items-center justify-end">
                                    <button type="button" wire:click="deleteLog({{ $log->id }})"
                                            wire:confirm="Yakin ingin menghapus catatan log ini?"
                                            title="Hapus Log"
                                            class="w-8 h-8 rounded-lg bg-white text-slate-600 hover:text-rose-600 hover:bg-rose-50 border border-slate-200 transition-all flex items-center justify-center shadow-xs">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                        </svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="py-12 text-center text-slate-400">
                                <p class="text-sm font-semibold">Tidak ditemukan riwayat log aktivitas</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="px-6 py-4 border-t border-slate-100">
            {{ $logs->links() }}
        </div>
    </div>
</div>
