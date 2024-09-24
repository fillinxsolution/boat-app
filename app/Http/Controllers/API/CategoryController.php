<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\BaseController;
use App\Interfaces\BlogRepositoryInterface;
use App\Interfaces\ServiceCategoryRepositoryInterface;
use App\Interfaces\ServiceRepositoryInterface;
use App\Models\Category;
use App\Traits\UploadTrait;
use Illuminate\Http\Request;

class CategoryController extends BaseController
{
    use UploadTrait;

    public function __construct(
        private ServiceCategoryRepositoryInterface $serviceCategoryRepository,
        private BlogRepositoryInterface $blogRepository,
        private ServiceRepositoryInterface $serviceRepository,

    )
    {

    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $categories = $this->serviceCategoryRepository->activeList();
        } catch (\Throwable $th) {
            return $this->sendException([$th->getMessage()]);
        }
        return $this->sendResponse($categories, 'Data Get SuccessFully', 200);
    }


    /**
     * Display a listing of the resource.
     */
    public function isPopular()
    {

        try {
            $categories = $this->serviceCategoryRepository->isPopular();
        } catch (\Throwable $th) {
            return $this->sendException([$th->getMessage()]);
        }
        return $this->sendResponse($categories, 'Data Get SuccessFully', 200);
    }

    /**
     * Display a listing of the resource.
     */
    public function subCategory($id)
    {
        try {
            $category = $this->serviceCategoryRepository->nestedCategory($id);
            $blogs =  $this->blogRepository->activeList();
            $services =  $this->serviceRepository->serviceByCategory($id);
            $result = [
                'category' => $category,
                'blogs' =>  $blogs,
                'services' =>  $services,
            ];
        } catch (\Throwable $th) {
            return $this->sendException([$th->getMessage()]);
        }
        return $this->sendResponse($result, 'Data Get SuccessFully', 200);
    }
}
