<?php

namespace App\Repositories;

use App\Interfaces\AboutRepositoryInterface;
use App\Models\About;
use Illuminate\Database\Eloquent\Collection;


class AboutRepository implements AboutRepositoryInterface
{
    /**
     * All Plans list.
     */
    public function list(): Collection
    {
        return About::latest()->get();
    }


    /**
     * Create or update plan.
     */
    public function storeOrUpdate(array $data, $id = null): About
    {
        $plan = About::updateOrCreate(
            ['id' => $id],
            $data
        );
        return $plan;
    }

    /**
     * Find plan by id.
     */
    public function findById($id): About
    {
        return About::find($id);
    }

    /**
     * Delete plan by id.
     */
    public function destroyById($id): bool
    {
        return $this->findById($id)->delete();
    }
}
