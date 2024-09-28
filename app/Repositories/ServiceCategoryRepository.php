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
     * All  category list.
     */
    public function parentCategory(): Collection
    {
        return Category::with(['children'])->where('parent_id','=',null)->latest()->get();
    }

     /**
     * Active  category list.
     */
    public function activeList(): Collection
    {
        return Category::where('parent_id','=',null)->where('status', 1)->get();
    }

    /**
     * Active category list.
     */
    public function activeCategory(): Collection
    {
        return Category::where('status', 1)->get();
    }

    /**
     * Popular  category list.
     */
    public function isPopular(): Collection
    {
        return Category::where('is_popular','Yes')->where('status', 1)->get();
    }

    /**
     * Create & save  Category.
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
     * Find   by id.
     */
    public function findById($id): Category
    {
        return Category::find($id);
    }

    /**
     * Find   by id.
     */
    public function nestedCategory($id): Category
    {
        return  Category::with(['children','children.children'])->findOrFail($id);
    }


    /**
     * Find  category by id.
     */
    public function subCategory($id)
    {

        $cat =  Category::where('parent_id',$id)->where('status', 1)->where('is_popular','=','Yes')->get();
        return $cat;
    }

    /**
     * Delete  category by id.
     */
    public function destroyById($id): bool
    {
        return $this->findById($id)->delete();
    }
}
