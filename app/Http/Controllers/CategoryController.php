<?php

namespace App\Http\Controllers;

use App\Interfaces\CategoryRepositoryInterface;
use App\Traits\UploadTrait;
use Illuminate\Http\Request;

class CategoryController extends BaseController
{
    use UploadTrait;

    public function __construct(
        private CategoryRepositoryInterface $categoryRepository,

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
            $categories = $this->categoryRepository->list();
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
            $subcategories = $this->categoryRepository->subList();
        } catch (\Throwable $th) {
            return $this->sendException([$th->getMessage()]);
        }
        return $this->sendResponse([$subcategories, 'Data Get SuccessFully'], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|unique:categories,name',
                'image' => 'required|image|mimes:jpg,jpeg,png,gif|max:2048',
                'short_description' => 'required',
            ]);

            $data = $request->except('image');
            $data['image'] = $request->hasFile('image') ? $this->uploadFile($request->file('image'), 'categories') : 'https://tapday.s3.ap-south-1.amazonaws.com/v2/users/VC2ycVtfHccmAcZzU9dEExh7Lu0VOa8y2mH1Jn4t.svg';
            $this->categoryRepository->storeOrUpdate($data);
        } catch (\Throwable $th) {
            return $this->sendException($th->getMessage());
        }
        return $this->sendResponse([null, 'Category Created SuccessFully'], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $request->validate([
                'name' => 'required|string|unique:categories,name,' . $id,
                'image' => 'required|image|mimes:jpg,jpeg,png,gif|max:2048',
                'short_description' => 'required',
            ]);

            $data = $request->except('image');
            if ($request->hasFile('image')) {
                $data['image'] = $this->uploadFile($request->file('image'), 'categories');
            }
            $this->categoryRepository->storeOrUpdate($data, $id);
        } catch (\Throwable $th) {
            return $this->sendException($th->getMessage());
        }
        return $this->sendResponse([null, 'Category Updated SuccessFully'], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $category = $this->categoryRepository->findById($id);
            $category->delete();
        } catch (\Throwable $th) {
            return $this->sendException($th->getMessage());
        }
        return $this->sendResponse([null, 'Category Deleted SuccessFully'], 200);
    }
}
