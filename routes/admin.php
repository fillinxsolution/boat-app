<?php

use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\StaffController;
use App\Http\Controllers\Admin\ServiceCategoryController;
use App\Http\Controllers\Admin\SupplierController;
use App\Http\Controllers\Admin\CaptainController;
use Illuminate\Support\Facades\Route;



/**
 * Staff Routes.
 */
Route::resource('/staff', StaffController::class)->except('show');

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

    /* ------------------------- Supplier Roles Routes ------------------------ */

    Route::patch('suppliers/change/{id}', 'SupplierController@change')->name('suppliers.change');
    Route::get('suppliers/list', 'SupplierController@list')->name('suppliers.list');
    Route::resource('suppliers', SupplierController::class);

    /* ------------------------- Captains Category Routes ------------------------ */

    Route::patch('captains/change/{id}', 'CaptainController@change')->name('captains.change');
    Route::get('captains/list', 'CaptainController@list')->name('captains.list');
    Route::resource('captains', CaptainController::class);

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
