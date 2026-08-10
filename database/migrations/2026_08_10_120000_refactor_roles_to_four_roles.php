<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Refactor role system:
     * - Rename 'dispatcher' → 'operator'
     * - Rename 'superadmin' → 'admin'  (gabungkan dengan admin_operasional)
     * - Delete 'admin_operasional' (user-nya dipindah ke 'admin')
     *
     * 4 role final: admin, operator, supir, masyarakat
     */
    public function up(): void
    {
        // 1. Rename 'dispatcher' → 'operator'
        DB::table('roles')
            ->where('name', 'dispatcher')
            ->update([
                'name'        => 'operator',
                'label'       => 'Operator',
                'description' => 'Menerima order masyarakat, menugaskan supir & ambulans, monitoring perjalanan',
            ]);

        // 2. Rename 'superadmin' → 'admin'
        DB::table('roles')
            ->where('name', 'superadmin')
            ->update([
                'name'        => 'admin',
                'label'       => 'Admin',
                'description' => 'Akses penuh ke seluruh sistem: manajemen pengguna, armada, laporan, dan konfigurasi',
            ]);

        // 3. Dapatkan ID role 'admin' (yang baru saja di-rename dari superadmin)
        $adminRoleId = DB::table('roles')->where('name', 'admin')->value('id');

        // 4. Pindahkan semua user 'admin_operasional' → ke role 'admin'
        $adminOperasionalRole = DB::table('roles')->where('name', 'admin_operasional')->first();
        if ($adminOperasionalRole && $adminRoleId) {
            DB::table('users')
                ->where('role_id', $adminOperasionalRole->id)
                ->update(['role_id' => $adminRoleId]);

            // 5. Hapus role 'admin_operasional' (sudah tidak digunakan)
            DB::table('roles')->where('name', 'admin_operasional')->delete();
        }
    }

    public function down(): void
    {
        // Rollback: kembalikan ke kondisi semula

        // 1. Rename 'operator' → 'dispatcher'
        DB::table('roles')
            ->where('name', 'operator')
            ->update([
                'name'        => 'dispatcher',
                'label'       => 'Dispatcher',
                'description' => 'Menerima order masyarakat, menugaskan supir & ambulans, monitoring perjalanan',
            ]);

        // 2. Re-create 'admin_operasional'
        $adminOpId = DB::table('roles')->insertGetId([
            'name'        => 'admin_operasional',
            'label'       => 'Admin Operasional',
            'description' => 'Mengelola armada ambulans, supir, rumah sakit, dan laporan',
            'created_at'  => now(),
            'updated_at'  => now(),
        ]);

        // 3. Rename 'admin' → 'superadmin'
        DB::table('roles')
            ->where('name', 'admin')
            ->update([
                'name'        => 'superadmin',
                'label'       => 'Super Admin',
                'description' => 'Akses penuh ke seluruh konfigurasi sistem dan manajemen pengguna',
            ]);
    }
};
