<?php

namespace App\Repositories;

use App\Interfaces\CaptainRepositoryInterface;
use App\Models\Captain;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;


class CaptainRepository implements CaptainRepositoryInterface
{

    /**
     * Login User list.
     */
    public function list($id)
    {
        $captain = User::with('captain')->find($id);
        return $captain;
    }

    /**
     * Login User list.
     */
    public function lists()
    {
        $perPage = request()->get('per_page', 10);
        $captain = User::whereHas('captain', function($query) {
            $query->where('status', 'Approved');
        })
            ->with('captain')
            ->where('is_active', 'Active')
            ->where('is_admin', 0)
            ->inRandomOrder()
            ->paginate($perPage);

        return $captain;
    }


    /**
     *  list.
     */
    public function webList(): Collection
    {
        $captains = User::has('captain')->with('captain')->where('is_admin', 0)->get();
        return $captains;
    }

    /**
     * Create & save supplier.
     */
    public function storeOrUpdate(array $data, $id = null): Captain
    {
        $captain = Captain::updateOrCreate(
            ['id' => $id],
            $data
        );
        return $captain;
    }

    /**
     * Single supplier details.
     */

    public function captainDetail($id)
    {
        return User::with('captain')->find($id);
    }

    /**
     * Find Supplier by id.
     */
    public function findById($id): Captain
    {
        return Captain::find($id);
    }

    /**
     * Delete Supplier by id.
     */
    public function destroyById($id): bool
    {
        return $this->findById($id)->delete();
    }
}
