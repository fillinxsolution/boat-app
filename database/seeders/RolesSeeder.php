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
            'guard_name' => 'api'
        ]);
        $permissions = Permission::where('guard_name', 'api')->get();
        $role1->syncPermissions($permissions);
    }
}
