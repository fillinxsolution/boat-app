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
        $supplier = User::with('supplier')->find($id);
        return $supplier;
    }

    /**
     * Login User list.
     */
    public function lists()
    {
        $supplier = User::has('supplier')
            ->with('supplier')
            ->inRandomOrder()
            ->get();
        return $supplier;
    }


    /**
     *  list.
     */
    public function webList(): Collection
    {
        $suppliers = User::has('supplier')->with('supplier')->where('is_admin', 0)->get();
        return $suppliers;
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
     * Single supplier details.
     */

    public function supplierDetail($id)
    {
        return User::with('supplier')->find($id);
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
