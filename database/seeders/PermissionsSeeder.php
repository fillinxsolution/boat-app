<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('permissions')->insert([
            /* ------------------------------- Admin Roles ------------------------------ */
            [
                'name' => 'roles-list',
                'display_name' => 'Admin Role List',
                'guard_name' => 'web',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'roles-create',
                'display_name' => 'Admin Role Create',
                'guard_name' => 'web',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'roles-view',
                'display_name' => 'Admin Role View',
                'guard_name' => 'web',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'roles-edit',
                'display_name' => 'Admin Role Edit',
                'guard_name' => 'web',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'roles-delete',
                'display_name' => 'Admin Role Delete',
                'guard_name' => 'web',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],


            /* ---------------------------- Admin Permissions --------------------------- */
            [
                'name' => 'permissions-list',
                'display_name' => 'Admin Permission List',
                'guard_name' => 'web',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'permissions-edit',
                'display_name' => 'Admin Permission Edit',
                'guard_name' => 'web',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],

            /* ------------------------------ Dashboard ----------------------------- */
            [
                'name' => 'dashboard-view',
                'display_name' => 'Dashboard View',
                'guard_name' => 'web',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],

            /* ---------------------------------- Users Staff --------------------------------- */
            [
                'name' => 'users-list',
                'display_name' => 'User List',
                'guard_name' => 'web',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'users-view',
                'display_name' => 'User View',
                'guard_name' => 'web',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'users-create',
                'display_name' => 'User Create',
                'guard_name' => 'web',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'users-edit',
                'display_name' => 'User Edit',
                'guard_name' => 'web',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'users-delete',
                'display_name' => 'User Delete',
                'guard_name' => 'web',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'users-profile',
                'display_name' => 'User Profile',
                'guard_name' => 'web',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],


            /* ---------------------------------- AdminSetting --------------------------------- */
            [
                'name' => 'adminSettings-list',
                'display_name' => 'adminSettings List',
                'guard_name' => 'web',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'adminSettings-create',
                'display_name' => 'adminSettings Create',
                'guard_name' => 'web',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'adminSettings-edit',
                'display_name' => 'adminSettings Edit',
                'guard_name' => 'web',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'adminSettings-delete',
                'display_name' => 'adminSettings Delete',
                'guard_name' => 'web',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],

            /* ---------------------------------- Service Category --------------------------------- */
            [
                'name' => 'serviceCategory-list',
                'display_name' => 'serviceCategory List',
                'guard_name' => 'web',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'serviceCategory-create',
                'display_name' => 'serviceCategory Create',
                'guard_name' => 'web',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'serviceCategory-edit',
                'display_name' => 'serviceCategory Edit',
                'guard_name' => 'web',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'serviceCategory-delete',
                'display_name' => 'serviceCategory Delete',
                'guard_name' => 'web',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],

            /* ---------------------------------- Supplier Permission --------------------------------- */
            [
                'name' => 'suppliers-list',
                'display_name' => 'suppliers List',
                'guard_name' => 'web',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'suppliers-create',
                'display_name' => 'suppliers Create',
                'guard_name' => 'web',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'suppliers-edit',
                'display_name' => 'suppliers Edit',
                'guard_name' => 'web',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'suppliers-delete',
                'display_name' => 'suppliers Delete',
                'guard_name' => 'web',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],

            [
                'name' => 'supplier-view',
                'display_name' => 'supplier view',
                'guard_name' => 'web',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],


            /* ---------------------------------- Captains Permission --------------------------------- */
            [
                'name' => 'captains-list',
                'display_name' => 'captains List',
                'guard_name' => 'web',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'captains-create',
                'display_name' => 'captains Create',
                'guard_name' => 'web',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'captains-edit',
                'display_name' => 'captains Edit',
                'guard_name' => 'web',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'captains-delete',
                'display_name' => 'captains Delete',
                'guard_name' => 'web',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],


        ]);
    }
}

