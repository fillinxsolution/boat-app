<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Interfaces\AboutRepositoryInterface;
use App\Interfaces\BlogRepositoryInterface;
use App\Interfaces\TestimonialRepositoryInterface;

class AboutUsController extends BaseController
{
    public function __construct(
        private AboutRepositoryInterface $aboutRepository,
        private TestimonialRepositoryInterface $testimonialRepository,
        private BlogRepositoryInterface $blogRepository,

    ){}
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $data['aboutUs'] = $this->aboutRepository->list();
            $data['testimonials'] = $this->testimonialRepository->activeList();
            $data['blogs'] = $this->blogRepository->activeList();
        } catch (\Throwable $th) {
            return $this->sendException([$th->getMessage()]);
        }
        return $this->sendResponse($data, 'Data Get SuccessFully', 200);
    }
}
