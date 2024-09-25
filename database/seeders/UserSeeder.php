<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user1 = User::create([
            'name'          => 'Super Admin',
            'email'         => 'superadmin@gmail.com',
            'password'      => '123456789',
            'is_admin'      => 1,
        ]);
        $role1 = Role::where('name','Super Admin')->where('guard_name','web')->first();

        $user1->assignRole($role1);

        $user2 = User::create([
            'name'          => 'Admin',
            'email'         => 'admin@gmail.com',
            'password'      => '123456789',
            'is_admin'      => 1,
        ]);
        $role2 = Role::where('name','Admin')->where('guard_name','web')->first();

        $user2->assignRole($role2);

    }
}
