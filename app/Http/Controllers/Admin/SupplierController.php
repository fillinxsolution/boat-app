<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Interfaces\ServiceRepositoryInterface;
use App\Interfaces\SupplierRepositoryInterface;
use App\Models\Supplier;
use App\Traits\ActionsTrait;
use App\Traits\UploadTrait;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class SupplierController extends BaseController
{
     use UploadTrait , ActionsTrait;
    public function __construct(
        private SupplierRepositoryInterface $supplierRepository,
        private ServiceRepositoryInterface $serviceRepository,
    ) {
//        $this->middleware('permission:supplier-list', ['only' => ['index', 'show']]);
//        $this->middleware('permission:supplier-create', ['only' => ['store']]);
//        $this->middleware('permission:supplier-edit', ['only' => ['edit', 'update','change']]);
//        $this->middleware('permission:supplier-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pages.users.suppliers.index');
    }

    /**
     * Display a listing of the resource.
     */
    public function list(): JsonResponse
    {
        $data = $this->supplierRepository->webList();
        return DataTables::of($data)
            ->addIndexColumn()
            ->editColumn('name', function ($row) {
                $link = route('users.suppliers.show', $row->id);
//                if (auth()->user()->can('supplier-view')) {
                    $url =  "<a href='{$link}'>{$row->name}</a>";
//                } else {
//                    $url =  "<p>{$row->name}</p>";
//                }
                return $url;
            })
            ->addColumn('action', function ($row) {
                return view('pages.users.suppliers.actions', compact('row'));
            })->editColumn('status', function ($row) {
                return view('pages.users.suppliers.status', compact('row'));
            })
            ->rawColumns(['action', 'status','name'])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {


        return view('pages.users.suppliers.create');
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
            $this->supplierRepository->storeOrUpdate($data);
        } catch (\Throwable $th) {
            return $this->redirectError($th->getMessage());
        }
        return $this->redirectSuccess(route('catalog.category.index'), 'Category created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, string $id): RedirectResponse | View
    {
        $supplier = $this->supplierRepository->supplierDetail($id);
        return view('pages.users.suppliers.show', compact('supplier', ));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): RedirectResponse|View
    {
        $category = $this->supplierRepository->findById($id);
        $categories = $this->supplierRepository->activeList();
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
            $this->supplierRepository->storeOrUpdate($data, $id);
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
            $this->supplierRepository->destroyById($id);
        } catch (\Throwable $th) {
            return $this->redirectError($th->getMessage());
        }
        return  $this->redirectSuccess(route('catalog.category.index'), 'Category deleted successfully');
    }

    public function change(Request $request, string $id)
    {
        try {
            $supplierId = Supplier::where('user_id',$id)->first();
            $data  = $request->only(['status','reason']);
            $this->supplierRepository->storeOrUpdate($data, $supplierId->id);
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors(['msg' => $th->getMessage()]);
        }
        return $this->redirectSuccess(route('users.suppliers.documents', $id), 'Supplier Status Changed successfully.');
    }

    /**
     * Show services.
     */
    public function services(Request $request, string $id)
    {
        try {
            $supplier = $this->supplierRepository->list($id);

            $services = $this->serviceRepository->list($supplier->supplier->id);
            if ($request->ajax()) {

                return DataTables::of($services)
                    ->addIndexColumn()
                    ->editColumn('status', function ($row) {
                        return $this->statusBadge($row->status);
                    })
                    ->rawColumns(['status'])
                    ->make(true);
            }
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors(['msg' => $th->getMessage()]);
        }
        return view('pages.users.suppliers.show', compact('supplier', 'services'));
    }
    /**
     * Show documents.
     */

    public function documents($id)
    {
        try {
            $supplier = $this->supplierRepository->list($id);
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors(['msg' => $th->getMessage()]);
        }
        return view('pages.users.suppliers.show', compact('supplier'));
    }



}
