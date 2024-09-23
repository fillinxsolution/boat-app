<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Interfaces\TestimonialRepositoryInterface;
use App\Traits\UploadTrait;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class TestimonialController extends BaseController
{
    use UploadTrait;
    public function __construct(
        private TestimonialRepositoryInterface $testimonialRepository,
    ) {
//        $this->middleware('permission:testimonials-list', ['only' => ['index', 'show']]);
//        $this->middleware('permission:testimonials-create', ['only' => ['store']]);
//        $this->middleware('permission:testimonials-edit', ['only' => ['edit', 'update','change']]);
//        $this->middleware('permission:testimonials-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pages.testimonials.index');
    }

    /**
     * Display a listing of the resource.
     */
    public function list(): JsonResponse
    {
        $data = $this->testimonialRepository->list();
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                return view('pages.testimonials.actions', compact('row'));
            })->editColumn('status', function ($row) {
                return view('pages.testimonials.status', compact('row'));
            })
            ->rawColumns(['action', 'status'])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('pages.testimonials.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        try {
            $request->validate([
                'name' => 'required',
                'image' => 'required|image|mimes:jpg,jpeg,png,gif|max:2048',
                'comment' => 'required',
                'status' => 'required',
            ]);

            $data = $request->except('image');
            $data['image'] = $request->hasFile('image') ? $this->uploadFile($request->file('image'), 'testimonials') : 'https://png.pngtree.com/element_our/20200610/ourmid/pngtree-character-default-avatar-image_2237203.jpg';
            $this->testimonialRepository->storeOrUpdate($data);
        } catch (\Throwable $th) {
            return $this->redirectError($th->getMessage());
        }
        return $this->redirectSuccess(route('pages.testimonials.index'), 'Testimonial created successfully.');
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
        $testimonial = $this->testimonialRepository->findById($id);
        return view('pages.testimonials.edit', compact('testimonial'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): RedirectResponse
    {
        try {
            $request->validate([
                'name' => 'required',
                'comment' => 'required',
                'status' => 'required'
            ]);

            $data = $request->except('image');
            if ($request->hasFile('image')) {
                $data['image'] = $this->uploadFile($request->file('image'), 'testimonials');
            }
            $this->testimonialRepository->storeOrUpdate($data, $id);
        } catch (\Throwable $th) {
            return $this->redirectError($th->getMessage());
        }
        return $this->redirectSuccess(route('pages.testimonials.index'), 'Testimonial updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): RedirectResponse
    {
        try {
            $this->testimonialRepository->destroyById($id);
        } catch (\Throwable $th) {
            return $this->redirectError($th->getMessage());
        }
        return  $this->redirectSuccess(route('pages.testimonials.index'), 'Testimonial deleted successfully');
    }

    public function change(Request $request, string $id)
    {
        try {
            $data = [];
            if ($request->field == 'status') {
                $data['status'] = $request->boolean('status'); // Use boolean to handle checkbox
            }
            $this->testimonialRepository->storeOrUpdate($data, $id);
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors(['msg' => $th->getMessage()]);
        }
        return $this->redirectSuccess(route('pages.testimonials.index'), 'Testimonial changed successfully.');
    }
}
