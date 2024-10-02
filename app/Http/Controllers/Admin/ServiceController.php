<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Interfaces\ServiceRepositoryInterface;
use Illuminate\Http\Request;

class ServiceController extends BaseController
{

    public function __construct(
        private ServiceRepositoryInterface $serviceRepository,
    )
    {
//        $this->middleware('permission:services-list', ['only' => ['index', 'show']]);
//        $this->middleware('permission:services-create', ['only' => ['store']]);
//        $this->middleware('permission:services-edit', ['only' => ['edit', 'update', 'change']]);
//        $this->middleware('permission:services-delete', ['only' => ['destroy']]);
    }


    public function show($id)
    {
        $service = $this->serviceRepository->findById($id);
        return view('pages.services.show', compact('service'));
    }

}
