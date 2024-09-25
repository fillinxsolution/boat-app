<?php

namespace App\Repositories;

use App\Interfaces\ServiceRepositoryInterface;
use App\Models\Service;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;


class ServiceRepository implements ServiceRepositoryInterface
{

    /**
     *  list.
     */
    public function list($id):Collection
    {
        $services =  Service::with(['images','faqs'])->where('supplier_id',$id)->get();
        return $services;
    }

    /**
     * Active list.
     */
    public function activeList($id):Collection
    {
        $services =  Service::with(['images','faqs'])->where('supplier_id',$id)->where('status','Active')->get();
        return $services;
    }

    /**
     * Active list.
     */
    public function serviceByCategory($id):Collection
    {
        $services =  Service::with(['images'])->where('category_id',$id)->where('status','Active')->get();
        return $services;
    }

    /**
     * Active list.
     */
    public function serviceByCategoryFilter($id): LengthAwarePaginator
    {
            $services =  Service::with(['images'])->where('category_id',$id)->where('status','Active')->paginate(24);
            return $services;
    }

    /**
     * Active list.
     */
    public function limitServices()
    {
            $services =  Service::with(['images'])->where('status','Active')->limit(8);
            return $services;
    }



    /**
     * Create & save Service.
     */
    public function storeOrUpdate(array $data, $id = null): Service
    {
        $service = Service::updateOrCreate(
            ['id' => $id],
            $data
        );
        return $service;
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
