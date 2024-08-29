<?php

namespace App\Interfaces;

interface RoleRepositoryInterface
{
    public function list();

    public function storeOrUpdate(string $name, array $permissions, int $id = null, $guard = 'web');

    public function storeOrUpdateShop($name, $pages, $id = null);

    public function findById(int $id);
}
