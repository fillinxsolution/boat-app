<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\BaseController;
use App\Interfaces\CaptainRepositoryInterface;
use App\Interfaces\UserRepositoryInterface;
use App\Traits\UploadTrait;
use Illuminate\Http\Request;

class CaptainController extends BaseController
{
    use UploadTrait;

    public function __construct(
        private CaptainRepositoryInterface $captainRepository,
        private UserRepositoryInterface $userRepository,
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
            $captain = $this->captainRepository->list($id);
        } catch (\Throwable $th) {
            return $this->sendException([$th->getMessage()]);
        }
        return $this->sendResponse($captain, 'Data Get SuccessFully', 200);
    }


    public function store(Request $request)
    {
        try {
            $request->validate([
                'company_name' => 'required',
                'captain_email' => 'required',
                'director_name' => 'required',
                'address' => 'required',
                'vat_number' => 'required',
                'boat_registration_papers' => 'mimes:pdf|max:2048',
                'insurance' => 'mimes:pdf|max:2048',
            ]);

            $data = $request->except(['banner_image', 'boat_registration_papers', 'insurance']);
            if ($request->hasFile('banner_image')) {
                $data['image'] = $this->uploadFile($request->file('banner_image'), 'users/bannerImage');
            }
            if ($request->hasFile('boat_registration_papers')) {
                $data['boat_registration_papers'] = $this->uploadDocuments($request->file('boat_registration_papers'), 'captains/documents/boatRegistration');
            }

            if ($request->hasFile('insurance')) {
                $data['insurance'] = $this->uploadDocuments($request->file('insurance'), 'captains/documents/insurance');
            }
            $data['user_id'] = auth()->user()->id;
            $this->captainRepository->storeOrUpdate($data);
        } catch (\Throwable $th) {
            return $this->sendException($th->getMessage());
        }
        return $this->sendResponse(null, 'Captain Documents Upload SuccessFully', 200);
    }


    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'company_name' => 'required',
                'director_name' => 'required',
                'address' => 'required',
                'vat_number' => 'required',
                'boat_registration_papers' => 'mimes:pdf|max:2048',
                'insurance' => 'mimes:pdf|max:2048',
            ]);

            $data = $request->except(['banner_image', 'boat_registration_papers', 'insurance']);
            if ($request->hasFile('banner_image')) {
                $data['banner_image'] = $this->uploadFile($request->file('banner_image'), 'users/bannerImages');
            }
            if ($request->hasFile('boat_registration_papers')) {
                $data['boat_registration_papers'] = $this->uploadDocuments($request->file('boat_registration_papers'), 'captains/documents/boatRegistration');
            }

            if ($request->hasFile('insurance')) {
                $data['insurance'] = $this->uploadDocuments($request->file('insurance'), 'captains/documents/insurance');
            }
            $data['user_id'] = auth()->user()->id;
            $this->captainRepository->storeOrUpdate($data, $id);
        } catch (\Throwable $th) {
            return $this->sendException($th->getMessage());
        }
        return $this->sendResponse($data, 'Captain Documents Update SuccessFully', 200);
    }


    public function companyProfile($id)
    {
        try {
            $captain = $this->captainRepository->list($id);
//            $captain = $captain->captain->load('user', 'services', 'services.supplier.user', 'services.images', 'portfolio', 'portfolio.images');

        } catch (\Throwable $th) {
            return $this->sendException([$th->getMessage()]);
        }
        return $this->sendResponse($captain, 'Data Get SuccessFully', 200);
    }

    public function captainImageUpdate(Request $request)
    {

        try {
            $result = [];
            if ($request->captain_id) {
                if ($request->hasFile('banner_image')) {
                    $data['banner_image'] = $this->uploadFile($request->file('banner_image'), 'users/bannerImages');
                }
                $result['supplier'] = $this->captainRepository->storeOrUpdate($data, $request->captain_id);
            }
            if ($request->user_id) {
                if ($request->hasFile('image')) {
                    $data['image'] = $this->uploadFile($request->file('image'), 'users/staff');
                }
                $result['user'] = $this->userRepository->updateApiUser($data, $request->user_id);
            }

        } catch (\Throwable $th) {
            return $this->sendException([$th->getMessage()]);
        }
        return $this->sendResponse($result, 'Captain Image Update SuccessFully', 200);


    }


}
