<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Interfaces\{CaptainRepositoryInterface,
    PermissionRepositoryInterface,
    PlanRepositoryInterface,
    PortfolioRepositoryInterface,
    RoleRepositoryInterface,
    ServiceCategoryRepositoryInterface,
    ServiceRepositoryInterface,
    SupplierRepositoryInterface,
    BlogRepositoryInterface,
    TestimonialRepositoryInterface,
    AboutRepositoryInterface,
    UserRepositoryInterface};

use App\Repositories\{CaptainRepository,
    PermissionRepository,
    PlanRepository,
    PortfolioRepository,
    RoleRepository,
    ServiceCategoryRepository,
    ServiceRepository,
    SupplierRepository,
    BlogRepository,
    TestimonialRepository,
    AboutRepository,
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
        $this->app->bind(BlogRepositoryInterface::class, BlogRepository::class);
        $this->app->bind(TestimonialRepositoryInterface::class, TestimonialRepository::class);
        $this->app->bind(PlanRepositoryInterface::class, PlanRepository::class);
        $this->app->bind(AboutRepositoryInterface::class, AboutRepository::class);
        $this->app->bind(CaptainRepositoryInterface::class, CaptainRepository::class);

    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
