<?php

namespace App\Repositories;

use App\Interfaces\ServiceCategoryRepositoryInterface;
use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;


class ServiceCategoryRepository implements ServiceCategoryRepositoryInterface
{

    /**
     * All integration category list.
     */
    public function list(): Collection
    {
        return Category::latest()->get();
    }

     /**
     * Active integration category list.
     */
    public function activeList(): Collection
    {
        return Category::where('status', 1)->get();
    }

    /**
     * Create & save Integration Category.
     */
    public function storeOrUpdate(array $data, $id = null): Category
    {
        $cat = Category::updateOrCreate(
            ['id' => $id],
            $data
        );
        return $cat;
    }

    /**
     * Find integration category by id.
     */
    public function findById($id): Category
    {
        return Category::find($id);
    }

    /**
     * Delete integration category by id.
     */
    public function destroyById($id): bool
    {
        return $this->findById($id)->delete();
    }
}
