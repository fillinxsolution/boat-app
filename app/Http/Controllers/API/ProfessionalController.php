<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\BaseController;
use App\Interfaces\BlogRepositoryInterface;
use App\Interfaces\ServiceRepositoryInterface;


class ProfessionalController extends BaseController
{

    public function __construct(
        private ServiceRepositoryInterface $serviceRepository,
        private BlogRepositoryInterface $blogRepository,

    )
    {

    }
    public function index(){
        try {
            $services =  $this->serviceRepository->servicesList();
            $blogs =  $this->blogRepository->activeList();
            $popularServices =  $this->serviceRepository->limitServices();
            $result = [
                'services' =>  $services,
                'blogs' =>  $blogs,
                'popularServices' =>  $popularServices,
            ];
        } catch (\Throwable $th) {
            return $this->sendException([$th->getMessage()]);
        }
        return $this->sendResponse($result, 'Data Get SuccessFully', 200);
    }

}
