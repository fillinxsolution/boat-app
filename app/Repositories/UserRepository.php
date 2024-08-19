<?php

namespace App\Repositories;

use App\Interfaces\UserRepositoryInterface;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;


class UserRepository implements UserRepositoryInterface
{

    /**
     * User List.
     */
    public function list(): Collection
    {
        return User::latest()->get();
    }

    /**
     * Create or update user.
     */
    public function storeOrUpdate(array $data, array $roles, $id = null): User
    {
        $user = User::updateOrCreate(
            ['id' => $id],
            $data
        );
        if (count($roles) > 0) {
            $user->assignRole($roles);
        }
        return $user;
    }

    /**
     * Find user by id.
     */
    public function findById($id): User
    {
        return User::find($id);
    }

    /**
     * Delete user by id.
     */
    public function destroyById($id): bool
    {
        return $this->findById($id)->delete();
    }
}
