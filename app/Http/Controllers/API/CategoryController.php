<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\BaseController;
use App\Interfaces\ServiceCategoryRepositoryInterface;
use App\Traits\UploadTrait;
use Illuminate\Http\Request;

class CategoryController extends BaseController
{
    use UploadTrait;

    public function __construct(
        private ServiceCategoryRepositoryInterface $serviceCategoryRepository,

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
            $subcategories = $this->serviceCategoryRepository->subCategory($id);
        } catch (\Throwable $th) {
            return $this->sendException([$th->getMessage()]);
        }
        return $this->sendResponse($subcategories, 'Data Get SuccessFully', 200);
    }
}
