<?php

namespace App\Repositories;

use App\Interfaces\ServiceRepositoryInterface;
use App\Models\Service;
use Illuminate\Database\Eloquent\Collection;


class ServiceRepository implements ServiceRepositoryInterface
{

    /**
     *  list.
     */
    public function list($id):Collection
    {
        $supplier =  Service::with(['images','faqs'])->where('supplier_id',$id)->get();
        return $supplier;
    }

    /**
     * Active list.
     */
    public function activeList($id):Collection
    {
        $supplier =  Service::with(['images','faqs'])->where('supplier_id',$id)->where('status','Active')->get();
        return $supplier;
    }

    /**
     * Create & save Service.
     */
    public function storeOrUpdate(array $data, $id = null): Service
    {
        $supplier = Service::updateOrCreate(
            ['id' => $id],
            $data
        );
        return $supplier;
    }

    /**
     * Find Service by id.
     */
    public function findById($id): Service
    {
        return Service::find($id);
    }
    /**
     * Delete Service by id.
     */
    public function destroyById($id): bool
    {
        return $this->findById($id)->delete();
    }
}
