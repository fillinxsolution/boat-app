<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\BaseController;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class AuthController extends BaseController
{
    public function register(Request $request)
    {
        try {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
        ]);


        $user->assignRole($request->role);

        $token = $user->createToken('auth_token')->plainTextToken;

        return $this->sendResponse($token, 'Your account has been created successfully.');
        } catch (\Throwable $th) {
            return $this->sendException($th->getMessage());
        }
    }

    public function login(Request $request)
    {
        try {
            if (!Auth::attempt($request->only('email', 'password'))) {
                return response()->json([
                    'message' => 'Invalid login details'
                ], 401);
            }

            $user = User::where('email', $request->email)->firstOrFail();

            $token = $user->createToken('auth_token')->plainTextToken;

            $data['access_token'] = $token;
            $data['token_type'] = 'Bearer';
            $data['user'] = $user;

            return $this->sendResponse($data, 'Login Successfully');
        } catch (QueryException $e) {
            Log::error('Database error: ' . $e->getMessage());
            return $this->sendError(null, [$e->getMessage()], 500);
        } catch (\Exception $e) {
            Log::error('Error: ' . $e->getMessage());
            return $this->sendError(null, [$e->getMessage()], 500);
        }

    }

    public function logout(Request $request)
    {
        auth()->user()->tokens()->delete();
        return $this->sendResponse(null, 'Logged Out.');
    }
}
