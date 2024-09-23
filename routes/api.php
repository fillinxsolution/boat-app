<?php

use App\Http\Controllers\API\Auth\AuthController;
use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\SupplierController;
use App\Http\Controllers\API\ServiceController;
use App\Http\Controllers\API\PortfolioController;
use App\Http\Controllers\API\HomeController;
use App\Http\Controllers\API\BlogController;
use App\Http\Controllers\API\TestimonialController;
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



/* ------------------------- Categories  Routes ------------------------ */

Route::apiResource('categories', CategoryController::class);
Route::get('sub-categories/{id}', [CategoryController::class,'subCategory']);
Route::get('category/is-popular', [CategoryController::class,'isPopular']);

/* ------------------------- Home Page  Routes ------------------------ */

Route::get('home', [HomeController::class,'index']);


/* ------------------------- Blogs  Routes ------------------------ */

Route::apiResource('blogs', BlogController::class);
Route::get('blog/is-popular', [BlogController::class,'isPopular']);


/* ------------------------- Testimonials  Routes ------------------------ */

Route::apiResource('testimonials', TestimonialController::class);
Route::get('testimonial/is-popular', [TestimonialController::class,'isPopular']);


Route::middleware('auth:sanctum')->group(function () {

    /* ------------------------- users Routes ------------------------ */

    Route::apiResource('users', UserController::class);

    /* ------------------------- Supplier Routes ------------------------ */

    Route::apiResource('suppliers', SupplierController::class);

    /* ------------------------- service  Routes ------------------------ */

    Route::apiResource('services', ServiceController::class);
    Route::get('service/active', [ServiceController::class,'activeList']);
    Route::post('service/changeStatus/{id}', [ServiceController::class,'changeStatus']);

    /* ------------------------- Portfolio Routes ------------------------ */

    Route::apiResource('portfolio', PortfolioController::class);
    Route::get('portfolio/active', [PortfolioController::class,'activeList']);
    Route::post('portfolio/changeStatus/{id}', [PortfolioController::class,'changeStatus']);



});

