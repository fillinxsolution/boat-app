<?php

namespace App\Repositories;

use App\Interfaces\CategoryRepositoryInterface;
use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Collection as SupportCollection;

class CategoryRepository implements CategoryRepositoryInterface
{
    /**
     * Category for web guard.
     */
    public function list(): Collection
    {
        return Category::latest()->get();
    }

    /**
     * Category for web guard.
     */
    public function subList(): Collection
    {
        return Category::latest()->where('parent_id','!=' , null)->get();
    }

    /**
     * Category permission.
     */
    public function storeOrUpdate(array $data, $id = null): Category
    {
        $category = Category::updateOrCreate(
            ['id' => $id],
            $data
        );

        return  $category;
    }

    /**
     * Find Category by id.
     */
    public function findById($id): Category
    {
        return Category::find($id);
    }

    /**
     * Delete Category by id.
     */
    public function destroyById($id): bool
    {
        return $this->findById($id)->delete();
    }
}
