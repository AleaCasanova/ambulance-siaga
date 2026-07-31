<?php

namespace App\Livewire;

use App\Models\Notifikasi;
use Livewire\Component;

class NotificationDropdown extends Component
{
    public function markAsRead($id)
    {
        $notif = Notifikasi::where('id', $id)
            ->where('user_id', auth()->id())
            ->first();

        if ($notif) {
            $notif->update([
                'is_read' => true,
                'read_at' => now(),
            ]);

            if ($notif->url) {
                return redirect()->to($notif->url);
            }
        }
    }

    public function markAllAsRead()
    {
        Notifikasi::where('user_id', auth()->id())
            ->where('is_read', false)
            ->update([
                'is_read' => true,
                'read_at' => now(),
            ]);
    }

    public function render()
    {
        $unreadCount = Notifikasi::where('user_id', auth()->id())
            ->where('is_read', false)
            ->count();

        $notifications = Notifikasi::where('user_id', auth()->id())
            ->orderBy('created_at', 'desc')
            ->take(6)
            ->get();

        return view('livewire.notification-dropdown', [
            'unreadCount' => $unreadCount,
            'notifications' => $notifications,
        ]);
    }
}
