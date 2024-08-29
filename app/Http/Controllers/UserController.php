<?php

namespace App\Http\Controllers;

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
        return $this->sendResponse([$result,'Data Get SuccessFully'],200);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        try {
            $request->validate([
                'name' => 'required',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|same:confirm_password',
                'confirm_password' => 'required|same:password',
                'roles' => 'required'
            ]);

            $data = $request->only(['name', 'password', 'email']);
//            $data['image'] = $request->hasFile('image') ? $this->uploadFile($request->file('image'), 'users') : 'https://tapday.s3.ap-south-1.amazonaws.com/v2/users/VC2ycVtfHccmAcZzU9dEExh7Lu0VOa8y2mH1Jn4t.svg';
            $roles = array_map('intval', $request->roles);
            $this->userRepository->storeOrUpdate($data, $roles);
        } catch (\Throwable $th) {
            return $this->sendException($th->getMessage());
        }
        return $this->sendResponse([null,'User Created SuccessFully'],200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $request->validate([
                'name' => 'required',
                'email' => 'required|email|unique:users,email,' . $id,
                'roles' => 'required'
            ]);

            $data = $request->only(['name', 'email']);
//            if ($request->hasFile('image')) {
//                $data['image'] = $this->uploadFile($request->file('image'), 'users');
//            }
            $roles = array_map('intval', $request->roles);
            $this->userRepository->storeOrUpdate($data, $roles, $id);
        } catch (\Throwable $th) {
            return $this->sendException($th->getMessage());
        }
        return $this->sendResponse([null,'User Updated SuccessFully'],200);
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
        return $this->sendResponse([null,'User Deleted SuccessFully'],200);
    }
}
