<div wire:poll.3s class="flex flex-col h-full bg-white rounded-2xl border border-slate-200 overflow-hidden shadow-sm">
    <!-- Header -->
    <div class="px-4 py-3 border-b border-slate-100 bg-slate-50 flex items-center justify-between">
        <div class="flex items-center gap-2">
            <span class="w-2.5 h-2.5 rounded-full bg-emerald-500 animate-pulse"></span>
            <h3 class="font-bold text-slate-800 text-sm">Live Chat Darurat</h3>
        </div>
    </div>

    <!-- Message Area -->
    <div class="flex-1 p-4 overflow-y-auto space-y-3 bg-slate-50/50 min-h-[250px] max-h-[400px] flex flex-col" id="chat-container">
        @forelse($messages as $msg)
            @if($msg->sender_id === auth()->id())
                <!-- My Message -->
                <div class="flex justify-end">
                    <div class="bg-primary-600 text-white px-4 py-2 rounded-2xl rounded-tr-sm max-w-[85%] shadow-sm">
                        <p class="text-sm">{{ $msg->message }}</p>
                        <span class="text-[10px] text-primary-200 block mt-1 text-right">{{ $msg->created_at->format('H:i') }}</span>
                    </div>
                </div>
            @else
                <!-- Other Message -->
                <div class="flex justify-start">
                    <div class="bg-white border border-slate-200 text-slate-700 px-4 py-2 rounded-2xl rounded-tl-sm max-w-[85%] shadow-sm">
                        <p class="text-[10px] font-bold text-slate-400 mb-0.5">{{ $msg->sender->name ?? 'Sistem' }}</p>
                        <p class="text-sm">{{ $msg->message }}</p>
                        <span class="text-[10px] text-slate-400 block mt-1">{{ $msg->created_at->format('H:i') }}</span>
                    </div>
                </div>
            @endif
        @empty
            <div class="flex-1 flex flex-col items-center justify-center text-slate-400 opacity-70">
                <svg class="w-10 h-10 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
                <p class="text-xs font-medium">Belum ada pesan. Silakan mulai percakapan.</p>
            </div>
        @endforelse
    </div>

    <!-- Input Area -->
    <div class="p-3 border-t border-slate-100 bg-white">
        <form wire:submit="sendMessage" class="flex items-center gap-2">
            <input type="text" wire:model="messageBody" 
                   class="flex-1 bg-slate-100 border-transparent focus:bg-white focus:border-primary-500 focus:ring-2 focus:ring-primary-200 rounded-xl text-sm px-4 py-2.5 transition-all"
                   placeholder="Ketik pesan di sini..." required>
            <button type="submit" 
                    class="p-2.5 rounded-xl bg-primary-600 hover:bg-primary-700 text-white shadow-md transition-all active:scale-95 disabled:opacity-50"
                    wire:loading.attr="disabled" wire:target="sendMessage">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/></svg>
            </button>
        </form>
    </div>
    
    <script>
        document.addEventListener('livewire:initialized', () => {
            Livewire.hook('morph.updated', ({ el, component }) => {
                const container = document.getElementById('chat-container');
                if(container) container.scrollTop = container.scrollHeight;
            });
        });
    </script>
</div>
