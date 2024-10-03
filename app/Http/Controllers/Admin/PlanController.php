<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Interfaces\PlanRepositoryInterface;
use App\Traits\UploadTrait;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Yajra\DataTables\Facades\DataTables;

class PlanController extends BaseController
{
    use UploadTrait;

    public function __construct(
        private PlanRepositoryInterface $planRepository,
    ) {
//        $this->middleware('permission:plans-list', ['only' => ['index', 'show']]);
//        $this->middleware('permission:plans-create', ['only' => ['create', 'store']]);
//        $this->middleware('permission:plans-edit', ['only' => ['edit', 'update', 'popular']]);
//        $this->middleware('permission:plans-delete', ['only' => ['destroy']]);
    }


    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('pages.plan.index');
    }

    /**
     * Staff List
     */
    public function list(): JsonResponse
    {
        $data = $this->planRepository->list();
        return DataTables::of($data)
            ->addIndexColumn()
            ->editColumn('image', function ($row) {
                $image =   "<img src='{$row->image}'  height='50'>";
                return $image;
            })
            ->editColumn('status', function ($row) {
                return view('pages.plan.actions.status', compact('row'));
            })
            ->addColumn('action', function ($row) {
                return view('pages.plan.actions.actions', compact('row'));
            })
            ->addColumn('is_popular', function ($row) {
                return view('pages.plan.actions.popular', compact('row'));
            })
            ->addColumn('default', function ($row) {
                return view('pages.plan.actions.default', compact('row'));
            })
            ->rawColumns(['action', 'image', 'status', 'is_popular', 'default'])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return view('pages.plan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'title' => 'required|unique:plans',
                'monthly_charges' => 'required',
                'status' => 'required',
            ]);

            $data = $request->only(['title', 'monthly_charges', 'status', 'annual_charges', 'description', 'bullets']);
            $data['is_popular'] = $request->boolean('is_popular'); // Use boolean to handle checkbox
            $data['image'] = $request->hasFile('image') ? $this->uploadFile($request->file('image'), 'plans') : null;

            $this->planRepository->storeOrUpdate($data);
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors(['msg' => $th->getMessage()]);
        }
        return $this->redirectSuccess(route('plans.index'), 'Plan created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $plan = $this->planRepository->findById($id);
        return view('content.plan.show', compact('plan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $plan = $this->planRepository->findById($id);
        return view('pages.plan.edit', compact('plan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $request->validate([
                'title' => 'required',
                'monthly_charges' => 'required',
                'status' => 'required',
            ]);

            $data = $request->only(['title', 'monthly_charges', 'status', 'annual_charges', 'description', 'bullets']);
            $data['is_popular'] = $request->boolean('is_popular'); // Use boolean to handle checkbox
            if ($request->hasFile('image')) {
                $data['image']  = $this->uploadFile($request->file('image'), 'plans');
            }

            $this->planRepository->storeOrUpdate($data, $id);
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors(['msg' => $th->getMessage()]);
        }
        return $this->redirectSuccess(route('plans.index'), 'Plan created successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $plan = $this->planRepository->findById($id);
            if ($plan->default) {
                return redirect()->back()->with('warning', 'You cannot delete this plan.');
            }
            $plan->delete();
        } catch (\Throwable $th) {
            return $this->redirectError($th->getMessage());
        }
        return  $this->redirectSuccess(route('plans.index'), 'Plan deleted successfully');
    }

    public function change(Request $request, string $id)
    {
        try {
            $data = [];
            if ($request->field == 'status') {
                $data['status'] = $request->boolean('status'); // Use boolean to handle checkbox
            }
            if ($request->field == 'is_popular') {
                $data['is_popular'] = $request->boolean('is_popular'); // Use boolean to handle checkbox
            }
            if ($request->field == 'default') {
                $data['default'] = $request->boolean('default'); // Use boolean to handle checkbox
            }

            $this->planRepository->storeOrUpdate($data, $id);
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors(['msg' => $th->getMessage()]);
        }
        return $this->redirectSuccess(route('plans.index'), 'Plan status changed successfully.');
    }
}
