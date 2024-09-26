<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Interfaces\BlogRepositoryInterface;
use App\Interfaces\ServiceCategoryRepositoryInterface;
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
        private ServiceCategoryRepositoryInterface $serviceCategoryRepository,
        private BlogRepositoryInterface $blogRepository,


    )
    {

    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
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

            $data = $request->except(['images', 'faqs']);
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
        return $this->sendResponse($service, 'Service Created SuccessFully', 200);
    }


    public function changeStatus(Request $request, $id)
    {
        try {
            $data = $request->status;
            $this->serviceRepository->storeOrUpdate($data, $id);
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors(['msg' => $th->getMessage()]);
        }
    }


    public function update(Request $request, $id)
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
                if ($request->has('tags')) {
                    $service->tags()->delete();
                    foreach ($request->tags as $tag) {
                        $serviceTag = new ServiceTag();
                        $serviceTag->service_id = $service->id;
                        $serviceTag->tags = $tag;
                        $serviceTag->save();
                    }
                }
            }
        } catch (\Throwable $th) {
            return $this->sendException($th->getMessage());
        }
        return $this->sendResponse($service, 'Service Updated Successfully', 200);

    }

    public function uploadImage(Request $request)
    {
        try {
            $request->validate([
                'service_id' => 'required',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);
            $serviceImage = new ServiceImage();
            $serviceImage->service_id = $request->service_id;
            $url = $this->uploadFile($request->image, 'service/images');
            $serviceImage->image = $url;
            $serviceImage->save();
        } catch (\Throwable $th) {
            return $this->sendException($th->getMessage());
        }
        return $this->sendResponse($serviceImage, 'Image Upload SuccessFully', 200);
    }

    public function deleteImage($id)
    {
        try {
               $serviceImage = ServiceImage::find($id);
               if ($serviceImage){
                   $serviceImage->delete();
               }else{
                   return $this->sendResponse(null, 'Image Not Found', 404);
               }

        } catch (\Throwable $th) {
            return $this->sendException($th->getMessage());
        }
        return $this->sendResponse(null, 'Image Delete SuccessFully', 200);
    }


    public function serviceCategory($id){
        try {
            $category = $this->serviceCategoryRepository->findById($id);
            $blogs =  $this->blogRepository->activeList();
            $services =  $this->serviceRepository->serviceByCategoryFilter($id);
            $popularServices =  $this->serviceRepository->limitServices();
            $result = [
                'category' => $category,
                'blogs' =>  $blogs,
                'services' =>  $services->load('supplier.user'),
                'popularServices' =>  $popularServices->load('supplier.user'),
            ];
        } catch (\Throwable $th) {
            return $this->sendException([$th->getMessage()]);
        }
        return $this->sendResponse($result, 'Data Get SuccessFully', 200);
    }


}
