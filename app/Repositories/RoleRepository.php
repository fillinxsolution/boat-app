<?php

namespace App\Repositories;

use App\Interfaces\RoleRepositoryInterface;
use App\Models\Role;
use Illuminate\Database\Eloquent\Collection;

class RoleRepository implements RoleRepositoryInterface
{
    /**
     * Roles List.
     */
    public function list(): Collection
    {
        return Role::get();
    }

    /**
     * Store or Update role.
     */
    public function storeOrUpdate($name, $permissions, $id = null, $guard = 'web')
    {
        $role = Role::updateOrCreate(
            ['id' => $id],
            ['name' => $name, 'guard_name' => $guard]
        );
        $role->syncPermissions($permissions);
        return $role;
    }

    /**
     * Store or Update role for shop.
     */
    public function storeOrUpdateShop($name, $pages, $id = null)
    {
        $role = Role::updateOrCreate(
            ['id' => $id],
            ['name' => $name, 'guard_name' => 'api']
        );
        $rolePages = $role->pages()->sync($pages);
        if (count($rolePages['detached']) > 0) {
            $configIds = $role->configurations()->whereIn('page_id', $rolePages['detached'])->get()->pluck('id');
            $role->configurations()->detach($configIds);
            $permissionIds = $role->permissions()->whereIn('page_id', $rolePages['detached'])->get()->pluck('id');
            $role->permissions()->detach($permissionIds);
        }
        return $role;
    }

    /**
     * FInd role by id.
     */
    public function findById($id)
    {
        return Role::with('pages.configs.configRoles')->find($id);
    }
}
