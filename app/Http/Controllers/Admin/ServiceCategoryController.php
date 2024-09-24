<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Interfaces\ServiceCategoryRepositoryInterface;
use App\Models\Category;
use App\Traits\UploadTrait;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ServiceCategoryController extends BaseController
{
       use UploadTrait;
    public function __construct(
        private ServiceCategoryRepositoryInterface $serviceCategoryRepository,
    ) {
        $this->middleware('permission:serviceCategory-list', ['only' => ['index', 'show']]);
        $this->middleware('permission:serviceCategory-create', ['only' => ['store']]);
        $this->middleware('permission:serviceCategory-edit', ['only' => ['edit', 'update','change']]);
        $this->middleware('permission:serviceCategory-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pages.catalog.services-category.index');
    }

    /**
     * Display a listing of the resource.
     */
    public function list(): JsonResponse
    {
        $data = $this->serviceCategoryRepository->list();
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                return view('pages.catalog.services-category.actions', compact('row'));
            })->editColumn('status', function ($row) {
                return view('pages.catalog.services-category.status', compact('row'));
            })
            ->rawColumns(['action', 'status'])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $parentCategories = $this->serviceCategoryRepository->activeCategory();

        return view('pages.catalog.services-category.create',compact('parentCategories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        try {
            $request->validate([
                'name' => 'required|string|unique:categories,name',
                'image' => 'required|image|mimes:jpg,jpeg,png,gif|max:2048',
                'short_description' => 'required',
                'status' => 'required',
            ]);

            $data = $request->except('image');
            $data['image'] = $request->hasFile('image') ? $this->uploadFile($request->file('image'), 'categories') : 'https://png.pngtree.com/element_our/20200610/ourmid/pngtree-character-default-avatar-image_2237203.jpg';
            $this->serviceCategoryRepository->storeOrUpdate($data);
        } catch (\Throwable $th) {
            return $this->redirectError($th->getMessage());
        }
        return $this->redirectSuccess(route('catalog.category.index'), 'Category created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): RedirectResponse|View
    {
            $category = $this->serviceCategoryRepository->findById($id);
            $categories = $this->serviceCategoryRepository->activeList();
            return view('pages.catalog.services-category.edit', compact('category','categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): RedirectResponse
    {
        try {
            $request->validate([
                'name' => 'required|string|unique:categories,name,' . $id,
                'short_description' => 'required',
                'status' => 'required'
            ]);

            $data = $request->except('image');
            if ($request->hasFile('image')) {
                $data['image'] = $this->uploadFile($request->file('image'), 'categories');
            }
            $this->serviceCategoryRepository->storeOrUpdate($data, $id);
        } catch (\Throwable $th) {
            return $this->redirectError($th->getMessage());
        }
        return $this->redirectSuccess(route('catalog.category.index'), 'Category updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): RedirectResponse
    {
        try {
            $this->serviceCategoryRepository->destroyById($id);
        } catch (\Throwable $th) {
            return $this->redirectError($th->getMessage());
        }
        return  $this->redirectSuccess(route('catalog.category.index'), 'Category deleted successfully');
    }

    public function change(Request $request, string $id)
    {
        try {
            $data = [];
            if ($request->field == 'status') {
                $data['status'] = $request->boolean('status'); // Use boolean to handle checkbox
            }
            $this->serviceCategoryRepository->storeOrUpdate($data, $id);
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors(['msg' => $th->getMessage()]);
        }
        return $this->redirectSuccess(route('catalog.category.index'), 'Category changed successfully.');
    }
}
