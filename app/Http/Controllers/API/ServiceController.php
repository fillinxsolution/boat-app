<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Interfaces\ServiceRepositoryInterface;
use App\Models\ServiceFaq;
use App\Models\ServiceImage;
use App\Models\ServiceTag;
use App\Traits\UploadTrait;
use Illuminate\Http\Request;

class ServiceController extends BaseController
{
    use UploadTrait;

    public function __construct(
        private ServiceRepositoryInterface $serviceRepository,

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
            $services = $this->serviceRepository->list($id);
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
            $services = $this->serviceRepository->activeList($id);
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
                'name' => 'required',
                'description' => 'required',
                'supplier_id' => 'required',
                'faqs' => 'required|array',
                'tags' => 'required|array',
                'images' => 'required|array',
                'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            $data = $request->except(['images','faqs']);
            $service = $this->serviceRepository->storeOrUpdate($data);
            foreach ($request->images as $image) {
                $serviceImage = new ServiceImage();
                $serviceImage->service_id = $service->id;
                $url = $this->uploadFile($image, 'service/images');
                $serviceImage->image = $url;
                $serviceImage->save();
            }
            foreach ($request->faqs as $faq) {
                $serviceFaq = new ServiceFaq();
                $serviceFaq->service_id = $service->id;
                $serviceFaq->question = $faq['question'];
                $serviceFaq->answers = $faq['answers'];
                $serviceFaq->save();
            }
            foreach ($request->tags as $tag) {
                $serviceTag = new ServiceTag();
                $serviceTag->service_id = $service->id;
                $serviceTag->tags = $tag;
                $serviceTag->save();
            }
        } catch (\Throwable $th) {
            return $this->sendException($th->getMessage());
        }
        return $this->sendResponse($service,'Service Created SuccessFully',200);
    }


    public function changeStatus(Request $request,$id)
    {
        try {
            $data = $request->status;
            $this->serviceRepository->storeOrUpdate($data, $id);
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors(['msg' => $th->getMessage()]);
        }
    }


    public function update(Request $request,$id)
    {
        try {
            $request->validate([
                'category_id' => 'required',
                'name' => 'required',
                'description' => 'required',
                'supplier_id' => 'required',
                'faqs' => 'required|array',
                 'images' => 'nullable|array',
                 'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);
            $data = $request->except(['images', 'faqs']);
            $service = $this->serviceRepository->storeOrUpdate($data, $id);

            // Update or upload new images (if images are provided)
            if ($request->has('images')) {
                foreach ($request->images as $image) {
                    $service->images()->delete();
                    $serviceImage = new ServiceImage();
                    $serviceImage->service_id = $service->id;
                    $url = $this->uploadFile($image, 'service/images');
                    $serviceImage->image = $url;
                    $serviceImage->save();
                }
            }
            // Update or create new FAQs
            if ($request->has('faqs')) {
                $service->faqs()->delete(); // Assuming relationship: service -> faqs
                foreach ($request->faqs as $faq) {
                    $serviceFaq = new ServiceFaq();
                    $serviceFaq->service_id = $service->id;
                    $serviceFaq->question = $faq['question'];
                    $serviceFaq->answers = $faq['answers'];
                    $serviceFaq->save();
                }
            }
        } catch (\Throwable $th) {
            return $this->sendException($th->getMessage());
        }
        return $this->sendResponse($service, 'Service Updated Successfully', 200);

    }

}
