<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Interfaces\TestimonialRepositoryInterface;
use Illuminate\Http\Request;

class TestimonialController extends BaseController
{
    public function __construct(
        private TestimonialRepositoryInterface $testimonialRepository,

    )
    {

    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $testimonials = $this->testimonialRepository->activeList();
        } catch (\Throwable $th) {
            return $this->sendException([$th->getMessage()]);
        }
        return $this->sendResponse($testimonials, 'Data Get SuccessFully', 200);
    }

    /**
     * Display a listing of the resource.
     */
    public function isPopular()
    {

        try {
            $testimonials = $this->testimonialRepository->isPopular();
        } catch (\Throwable $th) {
            return $this->sendException([$th->getMessage()]);
        }
        return $this->sendResponse($testimonials, 'Data Get SuccessFully', 200);
    }

    /**
     * Display a listing of the resource.
     */
    public function show($id)
    {

        try {
            $testimonial = $this->testimonialRepository->findById($id);
        } catch (\Throwable $th) {
            return $this->sendException([$th->getMessage()]);
        }
        return $this->sendResponse($testimonial, 'Data Get SuccessFully', 200);
    }
}
