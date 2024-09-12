<?php

namespace App\Repositories;

use App\Interfaces\ServiceCategoryRepositoryInterface;
use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;


class ServiceCategoryRepository implements ServiceCategoryRepositoryInterface
{

    /**
     * All  category list.
     */
    public function list(): Collection
    {
        return Category::latest()->get();
    }

     /**
     * Active  category list.
     */
    public function activeList(): Collection
    {
        return Category::where('parent_id','=',null)->where('status', 1)->get();
    }

    /**
     * Popular  category list.
     */
    public function isPopular(): Collection
    {
        return Category::where('is_popular','Yes')->where('status', 1)->get();
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
     * Find integration category by id.
     */
    public function subCategory($id)
    {

        $cat =  Category::where('parent_id',$id)->where('status', 1)->get();
        return $cat;
    }

    /**
     * Delete integration category by id.
     */
    public function destroyById($id): bool
    {
        return $this->findById($id)->delete();
    }
}
