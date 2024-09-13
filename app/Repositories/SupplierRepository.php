<?php

namespace App\Repositories;

use App\Interfaces\SupplierRepositoryInterface;
use App\Models\Supplier;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;


class SupplierRepository implements SupplierRepositoryInterface
{

    /**
     * Login User list.
     */
    public function list($id)
    {
        $supplier =  User::with('supplier')->find($id);
        return $supplier;
    }

    /**
     * Create & save supplier.
     */
    public function storeOrUpdate(array $data, $id = null): Supplier
    {
        $supplier = Supplier::updateOrCreate(
            ['id' => $id],
            $data
        );
        return $supplier;
    }

    /**
     * Find Supplier by id.
     */
    public function findById($id): Supplier
    {
        return Supplier::find($id);
    }
    /**
     * Delete Supplier by id.
     */
    public function destroyById($id): bool
    {
        return $this->findById($id)->delete();
    }
}
