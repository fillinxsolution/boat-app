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
//        $this->middleware('permission:users-list', ['only' => ['index', 'show']]);
//        $this->middleware('permission:users-create', ['only' => ['create', 'store']]);
//        $this->middleware('permission:users-edit', ['only' => ['edit', 'update']]);
//        $this->middleware('permission:users-delete', ['only' => ['destroy']]);
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
        return $this->sendResponse([$categories, 'Data Get SuccessFully'], 200);
    }


    /**
     * Display a listing of the resource.
     */
    public function subCategory()
    {

        try {
            $subcategories = $this->serviceCategoryRepository->activeList();
        } catch (\Throwable $th) {
            return $this->sendException([$th->getMessage()]);
        }
        return $this->sendResponse([$subcategories, 'Data Get SuccessFully'], 200);
    }


}
