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
                'name'        => 'mitra',
                'label'       => 'Mitra',
                'description' => 'Mitra',
            ],
            [
                'name'        => 'admin',
                'label'       => 'Admin',
                'description' => 'Admin',
            ],
            [
                'name'        => 'operator',
                'label'       => 'Operator',
                'description' => 'Operator',
            ],
            [
                'name'        => 'supir',
                'label'       => 'Sopir',
                'description' => 'Sopir',
            ],
            [
                'name'        => 'masyarakat',
                'label'       => 'Masyarakat',
                'description' => 'Masyarakat',
            ],
        ];

        foreach ($roles as $role) {
            Role::updateOrCreate(['name' => $role['name']], $role);
        }
    }
}
