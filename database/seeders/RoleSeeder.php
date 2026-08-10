<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        $roles = [
            [
                'name'        => 'admin',
                'label'       => 'Admin',
                'description' => 'Akses penuh ke seluruh sistem: manajemen pengguna, armada, laporan, dan konfigurasi',
            ],
            [
                'name'        => 'operator',
                'label'       => 'Operator',
                'description' => 'Menerima order masyarakat, menugaskan supir & ambulans, monitoring perjalanan',
            ],
            [
                'name'        => 'supir',
                'label'       => 'Supir Ambulans',
                'description' => 'Menerima tugas dari operator, navigasi medis, update status & GPS',
            ],
            [
                'name'        => 'masyarakat',
                'label'       => 'Masyarakat',
                'description' => 'Memesan ambulans darurat, tracking posisi secara realtime, memberi ulasan',
            ],
        ];

        foreach ($roles as $role) {
            Role::updateOrCreate(['name' => $role['name']], $role);
        }
    }
}
