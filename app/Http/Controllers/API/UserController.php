<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\BaseController;
use App\Interfaces\RoleRepositoryInterface;
use App\Interfaces\UserRepositoryInterface;
use App\Traits\UploadTrait;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserController extends BaseController
{
    use UploadTrait;

    public function __construct(
        private UserRepositoryInterface $userRepository,
        private RoleRepositoryInterface $roleRepository,
    )
    {
//        $this->middleware('permission:users-list', ['only' => ['index', 'show']]);
//        $this->middleware('permission:users-create', ['only' => ['create', 'store']]);
//        $this->middleware('permission:users-edit', ['only' => ['edit', 'update']]);
//        $this->middleware('permission:users-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View|JsonResponse
    {
        try {
            $users = $this->userRepository->list();
            $roles = $this->roleRepository->list();
            $result = [
                'roles' => $roles,
                'users' => $users,
            ];
        } catch (\Throwable $th) {
            return $this->sendException([$th->getMessage()]);
        }
        return $this->sendResponse($result,'Data Get SuccessFully',200);

    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $id = auth()->user()->id;
            $request->validate([
                'name' => 'required',
                'email' => 'required|email|unique:users,email,' . $id,
                'roles' => 'required'
            ]);

            $data = $request->only(['name', 'email']);
//            if ($request->hasFile('image')) {
//                $data['image'] = $this->uploadFile($request->file('image'), 'users');
//            }
            $this->userRepository->updateApiUser($data, $id);
        } catch (\Throwable $th) {
            return $this->sendException($th->getMessage());
        }
        return $this->sendResponse(null,'User Updated SuccessFully',200);
    }



    /**
     * show the specified resource from storage.
     */
    public function show($id)
    {
        try {
            $user = $this->userRepository->findById($id);
        } catch (\Throwable $th) {
            return $this->sendException($th->getMessage());
        }
        return $this->sendResponse($user,'User Deleted SuccessFully',200);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $user = $this->userRepository->findById($id);
            if ($user->id == 1 || auth()->user()->id == $user->id) {
                return redirect()->back()->with('warning', 'You cannot delete this staff.');
            }
            $user->delete();
        } catch (\Throwable $th) {
            return $this->sendException($th->getMessage());
        }
        return $this->sendResponse(null,'User Deleted SuccessFully',200);
    }
}
