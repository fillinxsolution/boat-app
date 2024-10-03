<?php

use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\StaffController;
use App\Http\Controllers\Admin\ServiceCategoryController;
use App\Http\Controllers\Admin\SupplierController;
use App\Http\Controllers\Admin\CaptainController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\PlanController;
use Illuminate\Support\Facades\Route;



/**
 * Profile Routes.
 */
Route::controller(ProfileController::class)->group(function () {
    Route::get('/profile', 'edit')->name('profile.edit');
    Route::patch('/profile', 'update')->name('profile.update');
    // Route::delete('/profile', 'destroy')->name('profile.destroy');
});

/**
 * Permissions Routes.
 */
Route::prefix('permissions')->as('permissions.')->group(function () {
    /* ------------------------- Staff Permission Routes ------------------------ */
    Route::resource('staff', PermissionController::class)->except(['show', 'delete']);
});

/**
 * Roles Routes.
 */
Route::prefix('roles')->as('roles.')->group(function () {
    /* ------------------------- Staff Roles Routes ------------------------ */
    Route::get('/staff/list', [RoleController::class, 'list'])->name('staff.list');
    Route::resource('staff', RoleController::class);
});

/**
 * Catalog Routes.
 */
Route::prefix('catalog')->as('catalog.')->group(function () {
    /* -------------------------  Category Routes ------------------------ */
    Route::patch('category/change/{id}', 'ServiceCategoryController@change')->name('category.change');
    Route::get('category/list', 'ServiceCategoryController@list')->name('category.list');
    Route::resource('category', ServiceCategoryController::class);

});

/**
 * Users Routes.
 */
Route::prefix('users')->as('users.')->group(function () {

    /* ------------------------- Supplier Routes ------------------------ */


    Route::resource('suppliers', SupplierController::class);

    Route::controller(SupplierController::class)->prefix('suppliers')->as('suppliers.')->group(function () {
        Route::post('suppliers/change/{id}', 'change')->name('change');
        Route::patch('suppliers/changeStatus/{id}', 'changeStatus')->name('changeStatus');
        Route::get('suppliers/list', 'list')->name('list');
        Route::get('/{id}/info', 'info')->name('info');
        Route::get('/{id}/services', 'services')->name('services');
    });

    /* ------------------------- Captains  Routes ------------------------ */

    Route::patch('captains/change/{id}', 'CaptainController@change')->name('captains.change');
    Route::get('captains/list', 'CaptainController@list')->name('captains.list');
    Route::resource('captains', CaptainController::class);


    /* ------------------------- Admin  Routes ------------------------ */

    Route::patch('staff/change/{id}', 'StaffController@change')->name('staff.change');
    Route::get('staff/list', 'StaffController@list')->name('staff.list');
    Route::resource('staff', StaffController::class);

});

/**
 * Settings Routes.
 */
Route::prefix('settings')->as('settings.')->group(function () {
    Route::controller(SettingController::class)->group(function () {
        Route::post('store',    'store')->name('store');
        Route::get('admin',     'admin')->name('admin');
    });
});

/**
 * Services Routes.
 */
  Route::resource('services', ServiceController::class);


/**
 * Plan Routes.
 */
Route::patch('plans/change/{id}', 'PlanController@change')->name('plans.change');
Route::get('plans/list', 'PlanController@list')->name('plans.list');
Route::resource('plans', PlanController::class)->except('show');


/**
 * Pages Routes.
 */
Route::prefix('pages')->as('pages.')->group(function () {
    /* -------------------------  Blogs Routes ------------------------ */
    Route::patch('blogs/change/{id}', 'BlogController@change')->name('blogs.change');
    Route::get('blogs/list', 'BlogController@list')->name('blogs.list');
    Route::resource('blogs', BlogController::class);

    /* -------------------------  Testimonials Routes ------------------------ */

    Route::patch('testimonials/change/{id}', 'TestimonialController@change')->name('testimonials.change');
    Route::get('testimonials/list', 'TestimonialController@list')->name('testimonials.list');
    Route::resource('testimonials', TestimonialController::class);
});
