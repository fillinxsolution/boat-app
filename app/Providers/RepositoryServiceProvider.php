<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Interfaces\{PermissionRepositoryInterface,
    RoleRepositoryInterface,
    ServiceCategoryRepositoryInterface,
    SupplierRepositoryInterface,
    UserRepositoryInterface};

use App\Repositories\{PermissionRepository,
    RoleRepository,
    ServiceCategoryRepository,
    SupplierRepository,
    UserRepository};

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(PermissionRepositoryInterface::class, PermissionRepository::class);
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(RoleRepositoryInterface::class, RoleRepository::class);
        $this->app->bind(ServiceCategoryRepositoryInterface::class, ServiceCategoryRepository::class);
        $this->app->bind(SupplierRepositoryInterface::class, SupplierRepository::class);

    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
