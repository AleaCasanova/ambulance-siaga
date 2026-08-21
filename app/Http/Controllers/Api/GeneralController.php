<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Notifikasi;
use App\Models\SettingAplikasi;
use Illuminate\Http\Request;

class GeneralController extends Controller
{
    /**
     * Get Application General Settings & Emergency Info
     */
    public function getAppConfig()
    {
        return response()->json([
            'success' => true,
            'data' => [
                'app_name' => SettingAplikasi::getVal('nama_aplikasi', 'Ambulans Siaga'),
                'instansi' => SettingAplikasi::getVal('nama_instansi', 'Ambulans Siaga - Jaringan Tanggap Darurat'),
                'hotline_1' => SettingAplikasi::getVal('telepon_darurat', '0812-3456-7890'),
                'hotline_2' => '112',
                'whatsapp_darurat' => '6281234567890',
                'email' => SettingAplikasi::getVal('email_kontak', 'info@ambulansiaga.org'),
                'alamat_kantor' => SettingAplikasi::getVal('alamat_kantor', 'Jl. Tentara Pelajar No. 45, Cilacap'),
                'default_lat' => (float) SettingAplikasi::getVal('default_lat', -7.7188),
                'default_lng' => (float) SettingAplikasi::getVal('default_lng', 109.0159),
            ]
        ]);
    }

    /**
     * Get Notifications for logged in user
     */
    public function getNotifications(Request $request)
    {
        $user = $request->user();

        $notifications = Notifikasi::where('user_id', $user->id)
            ->latest()
            ->take(30)
            ->get();

        $unreadCount = Notifikasi::where('user_id', $user->id)
            ->where('is_read', false)
            ->count();

        return response()->json([
            'success' => true,
            'data' => [
                'unread_count' => $unreadCount,
                'notifications' => $notifications->map(function ($n) {
                    return [
                        'id' => $n->id,
                        'title' => $n->title,
                        'message' => $n->message,
                        'type' => $n->type,
                        'is_read' => (bool) $n->is_read,
                        'created_at' => $n->created_at?->diffForHumans() ?? '',
                        'created_at_raw' => $n->created_at?->toIso8601String(),
                    ];
                })
            ]
        ]);
    }

    /**
     * Mark single or all notifications as read
     */
    public function markAsRead(Request $request, $id = null)
    {
        $user = $request->user();

        if ($id && $id !== 'all') {
            Notifikasi::where('user_id', $user->id)->where('id', $id)->update(['is_read' => true]);
        } else {
            Notifikasi::where('user_id', $user->id)->update(['is_read' => true]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Notifikasi ditandai telah dibaca.'
        ]);
    }
}
