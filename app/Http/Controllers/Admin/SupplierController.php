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
     * Display the specified resource.
     */
    public function show(Request $request, string $id): RedirectResponse | View
    {
        $supplier = $this->supplierRepository->supplierDetail($id);
        return view('pages.users.suppliers.show', compact('supplier'));
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id): RedirectResponse
    {
        try {
            $this->supplierRepository->destroyById($id);
        } catch (\Throwable $th) {
            return $this->redirectError($th->getMessage());
        }
        return  $this->redirectSuccess(route('users.suppliers.index'), 'Supplier deleted successfully');
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
        return $this->redirectSuccess(route('users.suppliers.show', $id), 'Supplier Status Changed successfully.');
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

    public function changeStatus(Request $request, string $id){
        try {
            $data = [];
            if ($request->field == 'supplier_status') {
                $data['supplier_status'] = $request->boolean('supplier_status'); // Use boolean to handle checkbox
            }
            $this->supplierRepository->storeOrUpdate($data, $id);
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors(['msg' => $th->getMessage()]);
        }
        return $this->redirectSuccess(route('users.suppliers.index'), 'Supplier Status changed successfully.');
    }

}
