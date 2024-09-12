<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Interfaces\ServiceRepositoryInterface;
use App\Traits\UploadTrait;
use Illuminate\Http\Request;

class ServiceController extends Controller
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
    public function index()
    {

        try {
            $id = auth()->user()->id;
            $services = $this->serviceRepository->list($id);
        } catch (\Throwable $th) {
            return $this->sendException([$th->getMessage()]);
        }
        return $this->sendResponse($services, 'Data Get SuccessFully', 200);
    }


    public function store(Request $request)
    {

    }


    public function update(Request $request,$id)
    {

    }

}
