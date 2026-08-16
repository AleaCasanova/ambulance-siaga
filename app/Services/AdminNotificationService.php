<?php

namespace App\Services;

use App\Mail\AdminNewUserRegisteredMail;
use App\Models\Notifikasi;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class AdminNotificationService
{
    /**
     * Dapatkan semua pengguna yang memiliki role admin / superadmin.
     */
    public static function getAdmins()
    {
        return User::whereHas('role', function ($q) {
            $q->whereIn('name', ['admin', 'superadmin']);
        })->get();
    }

    /**
     * Kirim notifikasi saat supir/pengemudi baru mendaftar.
     */
    public static function notifyNewSupirRegistered(User $user, array $details = []): void
    {
        $admins = self::getAdmins();
        $sim = $details['nomor_sim'] ?? ($user->supir?->nomor_sim ?: '-');
        $plat = $details['plat_nomor'] ?? ($user->supir?->plat_nomor ?: '-');

        foreach ($admins as $admin) {
            Notifikasi::create([
                'user_id' => $admin->id,
                'title'   => 'Pendaftaran Driver Baru',
                'message' => "Driver '{$user->name}' ({$user->email}) mendaftar (SIM: {$sim}, Plat: {$plat}). Menunggu verifikasi admin.",
                'type'    => 'warning',
                'url'     => route('admin.users.index'),
                'is_read' => false,
            ]);

            // Kirim email notifikasi ke admin
            if ($admin->email) {
                try {
                    Mail::to($admin->email)->send(new AdminNewUserRegisteredMail(
                        $user,
                        'Driver Ambulans',
                        [
                            'Nomor SIM' => $sim,
                            'Plat Nomor' => $plat,
                        ]
                    ));
                } catch (\Exception $e) {
                    Log::warning("Gagal mengirim email notifikasi driver baru ke admin {$admin->email}: " . $e->getMessage());
                }
            }
        }

        AuditLogService::log(
            'REGISTER_DRIVER',
            'Auth',
            "Pengemudi baru mendaftar: {$user->name} ({$user->email}), SIM: {$sim}, Plat: {$plat}",
            $user->id
        );
    }

    /**
     * Kirim notifikasi saat mitra armada/lembaga baru mendaftar.
     */
    public static function notifyNewMitraRegistered(User $user, array $details = []): void
    {
        $admins = self::getAdmins();
        $lembaga = $details['nama_lembaga'] ?? ($user->supir?->nama_lembaga ?: 'Mitra Lembaga');

        foreach ($admins as $admin) {
            Notifikasi::create([
                'user_id' => $admin->id,
                'title'   => 'Pendaftaran Mitra Baru',
                'message' => "Mitra '{$lembaga}' (PJ: {$user->name}, {$user->email}) mendaftar. Menunggu verifikasi admin.",
                'type'    => 'warning',
                'url'     => route('admin.users.index'),
                'is_read' => false,
            ]);

            // Kirim email notifikasi ke admin
            if ($admin->email) {
                try {
                    Mail::to($admin->email)->send(new AdminNewUserRegisteredMail(
                        $user,
                        'Mitra Lembaga Armada',
                        [
                            'Nama Lembaga' => $lembaga,
                            'Penanggung Jawab' => $user->name,
                        ]
                    ));
                } catch (\Exception $e) {
                    Log::warning("Gagal mengirim email notifikasi mitra baru ke admin {$admin->email}: " . $e->getMessage());
                }
            }
        }

        AuditLogService::log(
            'REGISTER_MITRA',
            'Auth',
            "Mitra armada baru mendaftar: {$lembaga} (PJ: {$user->name}, {$user->email})",
            $user->id
        );
    }

    /**
     * Kirim notifikasi ke Admin saat pengguna supir/mitra selesai verifikasi OTP.
     */
    public static function notifyOtpCompleted(User $user): void
    {
        $admins = self::getAdmins();
        $roleName = $user->role_label;

        foreach ($admins as $admin) {
            Notifikasi::create([
                'user_id' => $admin->id,
                'title'   => "{$roleName} Terverifikasi OTP (Siap Diaktifkan)",
                'message' => "Akun {$roleName} '{$user->name}' ({$user->email}) telah memverifikasi kode OTP dan siap untuk diverifikasi/diaktifkan.",
                'type'    => 'info',
                'url'     => route('admin.users.index'),
                'is_read' => false,
            ]);
        }

        AuditLogService::log(
            'VERIFY_OTP_SUCCESS',
            'Auth',
            "Akun {$roleName} {$user->name} ({$user->email}) berhasil verifikasi OTP dan menunggu persetujuan admin.",
            $user->id
        );
    }

    /**
     * Kirim notifikasi ke akun Supir/Mitra saat Admin telah mengaktifkan akunnya.
     */
    public static function notifyAccountActivated(User $user, ?int $adminId = null): void
    {
        Notifikasi::create([
            'user_id' => $user->id,
            'title'   => 'Akun Anda Telah Diaktifkan!',
            'message' => 'Selamat! Akun Anda telah diverifikasi dan diaktifkan oleh Administrator. Anda sekarang dapat login dan bertugas.',
            'type'    => 'success',
            'url'     => route('dashboard'),
            'is_read' => false,
        ]);

        AuditLogService::log(
            'ACTIVATE_USER',
            'Manajemen Pengguna',
            "Admin mengaktifkan akun: {$user->name} ({$user->email}) - Role: {$user->role_label}",
            $adminId ?? auth()->id()
        );
    }
}
