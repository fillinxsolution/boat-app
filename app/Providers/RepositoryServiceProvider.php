<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Interfaces\{PermissionRepositoryInterface,
    PortfolioRepositoryInterface,
    RoleRepositoryInterface,
    ServiceCategoryRepositoryInterface,
    ServiceRepositoryInterface,
    SupplierRepositoryInterface,
    UserRepositoryInterface};

use App\Repositories\{PermissionRepository,
    PortfolioRepository,
    RoleRepository,
    ServiceCategoryRepository,
    ServiceRepository,
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
        $this->app->bind(ServiceRepositoryInterface::class, ServiceRepository::class);
        $this->app->bind(PortfolioRepositoryInterface::class, PortfolioRepository::class);

    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
