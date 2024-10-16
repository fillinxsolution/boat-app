<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\BaseController;
use App\Interfaces\SupplierRepositoryInterface;
use App\Interfaces\UserRepositoryInterface;
use App\Traits\UploadTrait;
use Illuminate\Http\Request;

class SupplierController extends BaseController
{
    use UploadTrait;

    public function __construct(
        private SupplierRepositoryInterface $supplierRepository,
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
            $supplier = $this->supplierRepository->list($id);
        } catch (\Throwable $th) {
            return $this->sendException([$th->getMessage()]);
        }
        return $this->sendResponse($supplier, 'Data Get SuccessFully', 200);
    }


    public function store(Request $request)
    {
        try {
            $request->validate([
                'company_name' => 'required',
                'director_name' => 'required',
                'supplier_email' => 'required',
                'address' => 'required',
                'vat_number' => 'required',
                'liability_insurance' => 'mimes:pdf|max:2048',
                'company_registry' => 'mimes:pdf|max:2048',
            ]);

            $data = $request->except(['banner_image', 'liability_insurance', 'company_registry']);
            if ($request->hasFile('banner_image')) {
                $data['image'] = $this->uploadFile($request->file('banner_image'), 'users/bannerImage');
            }
            if ($request->hasFile('liability_insurance')) {
                $data['liability_insurance'] = $this->uploadDocuments($request->file('liability_insurance'), 'supplier/documents/liability');
            }

            if ($request->hasFile('company_registry')) {
                $data['company_registry'] = $this->uploadDocuments($request->file('company_registry'), 'supplier/documents/companyRegistry');
            }
            $data['user_id'] = auth()->user()->id;
            $this->supplierRepository->storeOrUpdate($data);
        } catch (\Throwable $th) {
            return $this->sendException($th->getMessage());
        }
        return $this->sendResponse(null, 'Supplier Documents Upload SuccessFully', 200);
    }


    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'company_name' => 'required',
                'director_name' => 'required',
                'address' => 'required',
                'vat_number' => 'required',
                'liability_insurance' => 'mimes:pdf|max:2048',
                'company_registry' => 'mimes:pdf|max:2048',
            ]);

            $data = $request->except(['banner_image', 'liability_insurance', 'company_registry']);
            if ($request->hasFile('banner_image')) {
                $data['banner_image'] = $this->uploadFile($request->file('banner_image'), 'users/bannerImages');
            }
            if ($request->hasFile('liability_insurance')) {
                $data['liability_insurance'] = $this->uploadDocuments($request->file('liability_insurance'), 'supplier/documents/liability');
            }

            if ($request->hasFile('company_registry')) {
                $data['company_registry'] = $this->uploadDocuments($request->file('company_registry'), 'supplier/documents/companyRegistry');
            }
            $data['user_id'] = auth()->user()->id;
            $this->supplierRepository->storeOrUpdate($data, $id);
        } catch (\Throwable $th) {
            return $this->sendException($th->getMessage());
        }
        return $this->sendResponse($data, 'Supplier Documents Update SuccessFully', 200);
    }


    public function companyProfile($id)
    {
        try {
            $supplier = $this->supplierRepository->list($id);
            $supplier = $supplier->supplier->load('user', 'services', 'services.supplier.user', 'services.images', 'portfolio', 'portfolio.images');

        } catch (\Throwable $th) {
            return $this->sendException([$th->getMessage()]);
        }
        return $this->sendResponse($supplier, 'Data Get SuccessFully', 200);
    }

    public function supplierImageUpdate(Request $request)
    {

        try {
            $result = [];
            if ($request->supplier_id) {
                if ($request->hasFile('banner_image')) {
                    $data['banner_image'] = $this->uploadFile($request->file('banner_image'), 'users/bannerImages');
                }
                $result['supplier'] = $this->supplierRepository->storeOrUpdate($data, $request->supplier_id);
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
        return $this->sendResponse($result, 'Supplier Image Update SuccessFully', 200);


    }


}
