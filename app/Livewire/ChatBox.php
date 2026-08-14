<?php

namespace App\Livewire;

use App\Models\Message;
use App\Models\Pemesanan;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ChatBox extends Component
{
    public $pemesananId;
    public $messageBody = '';

    public function mount($pemesananId)
    {
        $this->pemesananId = $pemesananId;
    }

    public function sendMessage()
    {
        $this->validate([
            'messageBody' => 'required|string|max:1000'
        ]);

        $order = Pemesanan::find($this->pemesananId);
        if (!$order) return;

        $user = Auth::user();
        
        // Determine receiver
        $receiverId = null;
        if ($user->isSupir()) {
            // If sender is supir, receiver is pemesan
            $receiverId = $order->user_id;
        } elseif ($user->id === $order->user_id) {
            // If sender is pemesan, receiver is supir
            $receiverId = $order->supir ? $order->supir->user_id : null;
        }

        Message::create([
            'pemesanan_id' => $this->pemesananId,
            'sender_id' => $user->id,
            'receiver_id' => $receiverId,
            'message' => $this->messageBody,
        ]);

        $this->messageBody = '';
    }

    public function render()
    {
        $messages = Message::with('sender')
            ->where('pemesanan_id', $this->pemesananId)
            ->orderBy('created_at', 'asc')
            ->get();

        return view('livewire.chat-box', [
            'messages' => $messages,
        ]);
    }
}
