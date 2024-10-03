<?php

namespace App\Repositories;

use App\Interfaces\PlanRepositoryInterface;
use App\Models\Plan;
use App\Traits\S3UploadTrait;
use Illuminate\Database\Eloquent\Collection;


class PlanRepository implements PlanRepositoryInterface
{
    /**
     * All Plans list.
     */
    public function list(): Collection
    {
        return Plan::latest()->get();
    }

    /**
     * Active Plans list.
     */
    public function activeList(): Collection
    {
        return Plan::where('status',1)->latest()->get();
    }

    /**
     * Create or update plan.
     */
    public function storeOrUpdate(array $data, $id = null): Plan
    {
        $plan = Plan::updateOrCreate(
            ['id' => $id],
            $data
        );
        return $plan;
    }

    /**
     * Find plan by id.
     */
    public function findById($id): Plan
    {
        return Plan::find($id);
    }

    /**
     * Delete plan by id.
     */
    public function destroyById($id): bool
    {
        return $this->findById($id)->delete();
    }
}
