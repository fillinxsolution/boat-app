<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Interfaces\PlanRepositoryInterface;
use Illuminate\Http\Request;

class PlanController extends BaseController
{


    public function __construct(
        private PlanRepositoryInterface $planRepository,

    )
    {

    }
    public function index(){
        try {
            $plans =  $this->planRepository->activeList();
        } catch (\Throwable $th) {
            return $this->sendException([$th->getMessage()]);
        }
        return $this->sendResponse($plans, 'Data Get SuccessFully', 200);
    }

}
