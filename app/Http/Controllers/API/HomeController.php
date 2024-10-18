<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\BaseController;
use App\Models\Blog;
use App\Models\Category;
use App\Models\Service;
use App\Models\Testimonial;

class HomeController extends BaseController
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $result = [
                'categories' => Category::where('parent_id', '=', null)->where('status', 1)->get(),
                'services' => Service::with(['images'])->where('status', 'Active')->get(),
                'testimonials' => Testimonial::where('status', 'Active')->get(),
                'blogs' => Blog::where('status', 'Active')->get(),
                'videoLink' => '/images/settings'. adminSettings('home_video_link')
            ];

        } catch (\Throwable $th) {
            return $this->sendException([$th->getMessage()]);
        }
        return $this->sendResponse($result, 'Data Get SuccessFully', 200);
    }
}
