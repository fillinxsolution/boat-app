<?php

use App\Http\Controllers\API\Auth\AuthController;
use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\SupplierController;
use App\Http\Controllers\API\ServiceController;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);
Route::post('/social-login', [AuthController::class, 'socialLogin']);

Route::apiResource('categories', CategoryController::class);
Route::get('sub-categories/{id}', [CategoryController::class,'subCategory']);
Route::get('category/is-popular', [CategoryController::class,'isPopular']);


Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('users', UserController::class);
    Route::apiResource('suppliers', SupplierController::class);
    Route::apiResource('services', ServiceController::class);
    Route::get('service/active', [ServiceController::class,'activeList']);
    Route::post('service/changeStatus/{id}', [ServiceController::class,'changeStatus']);
});

