<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Interfaces\AboutRepositoryInterface;
use App\Traits\UploadTrait;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Yajra\DataTables\Facades\DataTables;

class AboutController extends BaseController
{
    use UploadTrait;

    public function __construct(
        private AboutRepositoryInterface $aboutRepository,
    ) {
        $this->middleware('permission:about-us-list', ['only' => ['index', 'show']]);
        $this->middleware('permission:about-us-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:about-us-edit', ['only' => ['edit', 'update', 'popular']]);
        $this->middleware('permission:about-us-delete', ['only' => ['destroy']]);
    }


    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $about = $this->aboutRepository->list();
        return view('pages.about.index',compact('about'));
    }

    /**
     * Staff List
     */
    public function list(): JsonResponse
    {
        $data = $this->aboutRepository->list();
        return DataTables::of($data)
            ->addIndexColumn()
            ->editColumn('background_image', function ($row) {
                $image =   "<img src='{$row->background_image}'  height='50'>";
                return $image;
            })
            ->addColumn('action', function ($row) {
                return view('pages.about.actions.actions', compact('row'));
            })
            ->rawColumns(['action', 'background_image'])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return view('pages.about.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'title' => 'required',
                'for_supplier' => 'required',
                'for_captains' => 'required',
                'our_aim' => 'required',
            ]);

            $data = $request->except(['background_image']);
            $data['background_image'] = $request->hasFile('background_image') ? $this->uploadFile($request->file('background_image'), 'aboutUs') : null;

            $this->aboutRepository->storeOrUpdate($data);
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors(['msg' => $th->getMessage()]);
        }
        return $this->redirectSuccess(route('pages.about-us.index'), 'About Us created successfully.');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $about = $this->aboutRepository->findById($id);
        return view('pages.about.edit', compact('about'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $request->validate([
                'title' => 'required',
                'for_supplier' => 'required',
                'for_captains' => 'required',
                'our_aim' => 'required',
            ]);

            $data = $request->except(['background_image']);

            if ($request->hasFile('background_image')) {
                $data['background_image'] =  $this->uploadFile($request->file('background_image'), 'aboutUs');
            }

            $this->aboutRepository->storeOrUpdate($data, $id);
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors(['msg' => $th->getMessage()]);
        }
        return $this->redirectSuccess(route('pages.about-us.index'), 'About Us Updated successfully.');
    }

//    /**
//     * Remove the specified resource from storage.
//     */
//    public function destroy(string $id)
//    {
//        try {
//            $about = $this->aboutRepository->findById($id);
//            $about->delete();
//        } catch (\Throwable $th) {
//            return $this->redirectError($th->getMessage());
//        }
//        return  $this->redirectSuccess(route('pages.about-us.index'), 'About deleted successfully');
//    }


}
