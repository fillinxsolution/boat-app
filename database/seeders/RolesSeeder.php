<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role1 = Role::create(['name' => 'Super Admin',
            'guard_name' => 'web'
        ]);
        $permissions = Permission::where('guard_name', 'web')->get();
        $role1->syncPermissions($permissions);

        $role2 = Role::create(['name' => 'Captain',
            'guard_name' => 'api'
        ]);
//        $role2->syncPermissions($permissions);

        $role3 = Role::create(['name' => 'Supplier',
            'guard_name' => 'api'
        ]);
//        $role3->syncPermissions($permissions);
    }
}
