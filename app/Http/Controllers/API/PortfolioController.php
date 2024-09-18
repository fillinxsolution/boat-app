<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\BaseController;
use App\Interfaces\PortfolioRepositoryInterface;
use App\Models\PortfolioImage;
use App\Traits\UploadTrait;
use Illuminate\Http\Request;

class PortfolioController extends BaseController
{
    use UploadTrait;

    public function __construct(
        private PortfolioRepositoryInterface $portfolioRepository,

    )
    {

    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request  $request)
    {

        try {
            $request->validate([
                'supplier_id' => 'required',
            ]);
            $id = $request->supplier_id;
            $services = $this->portfolioRepository->list($id);
        } catch (\Throwable $th) {
            return $this->sendException([$th->getMessage()]);
        }
        return $this->sendResponse($services, 'Data Get SuccessFully', 200);
    }

    /**
     * Display a listing of the resource.
     */
    public function activeList(Request $request)
    {

        try {
            $request->validate([
                'supplier_id' => 'required',
            ]);
            $id = $request->supplier_id;
            $services = $this->portfolioRepository->activeList($id);
        } catch (\Throwable $th) {
            return $this->sendException([$th->getMessage()]);
        }
        return $this->sendResponse($services, 'Data Get SuccessFully', 200);
    }


    public function store(Request $request)
    {

        try {
            $request->validate([
                'category_id' => 'required',
                'supplier_id' => 'required',
                'title' => 'required',
                'description' => 'required',
                'yacht_name' => 'required',
                'location' => 'required',
                'images' => 'required|array',
                'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            $data = $request->except(['images']);
            $portfolio = $this->portfolioRepository->storeOrUpdate($data);
            foreach ($request->images as $image) {
                $portfolioImage = new PortfolioImage();
                $portfolioImage->portfolio_id = $portfolio->id;
                $url = $this->uploadFile($image, 'portfolio/images');
                $portfolioImage->image = $url;
                $portfolioImage->save();
            }
        } catch (\Throwable $th) {
            return $this->sendException($th->getMessage());
        }
        return $this->sendResponse($portfolio,'Portfolio Created SuccessFully',200);
    }


    public function changeStatus(Request $request,$id)
    {
        try {
            $data = $request->status;
            $this->portfolioRepository->storeOrUpdate($data, $id);
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors(['msg' => $th->getMessage()]);
        }
    }


    public function update(Request $request,$id)
    {
        try {
            $request->validate([
                'category_id' => 'required',
                'title' => 'required',
                'description' => 'required',
                'yacht_name' => 'required',
                'location' => 'required',
                'images' => 'nullable|array',
                'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);
            $data = $request->except(['images']);
            $portfolio = $this->portfolioRepository->storeOrUpdate($data, $id);
            // Update or upload new images (if images are provided)
            if ($request->has('images')) {
                foreach ($request->images as $image) {
                    $portfolio->images()->delete();
                    $portfolioImage = new PortfolioImage();
                    $portfolioImage->portfolio_id = $portfolio->id;
                    $url = $this->uploadFile($image, 'portfolio/images');
                    $portfolioImage->image = $url;
                    $portfolioImage->save();
                }
            }
        } catch (\Throwable $th) {
            return $this->sendException($th->getMessage());
        }
        return $this->sendResponse($portfolio, 'Portfolio Updated Successfully', 200);

    }

}
