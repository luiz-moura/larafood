<?php

namespace Application\Providers;

use Domains\ACL\Permissions\Contracts\PermissionRepository as PermissionRepositoryContract;
use Domains\ACL\Profiles\Contracts\ProfileRepository as RepositoriesProfileContract;
use Domains\ACL\Users\Repositories\UserRepository as UserRepositoryContract;
use Domains\Categories\Repositories\CategoryRepository as CategoryRepositoryContract;
use Domains\Plans\Contracts\PlanDetailRepository as PlanDetailRepositoryContract;
use Domains\Plans\Contracts\PlanRepository as PlanRepositoryContract;
use Domains\Products\Repositories\ProductRepository as ProductRepositoryContract;
use Domains\Tenants\Contracts\TenantRepository as TenantRepositoryContract;
use Illuminate\Support\ServiceProvider;
use Infrastructure\Persistence\Eloquent\Repositories\CategoryRepository;
use Infrastructure\Persistence\Eloquent\Repositories\PermissionRepository;
use Infrastructure\Persistence\Eloquent\Repositories\PlanDetailRepository;
use Infrastructure\Persistence\Eloquent\Repositories\PlanRepository;
use Infrastructure\Persistence\Eloquent\Repositories\ProductRepository;
use Infrastructure\Persistence\Eloquent\Repositories\ProfileRepository;
use Infrastructure\Persistence\Eloquent\Repositories\TenantRepository;
use Infrastructure\Persistence\Eloquent\Repositories\UserRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(PlanRepositoryContract::class, PlanRepository::class);
        $this->app->bind(PlanDetailRepositoryContract::class, PlanDetailRepository::class);
        $this->app->bind(RepositoriesProfileContract::class, ProfileRepository::class);
        $this->app->bind(PermissionRepositoryContract::class, PermissionRepository::class);
        $this->app->bind(TenantRepositoryContract::class, TenantRepository::class);
        $this->app->bind(UserRepositoryContract::class, UserRepository::class);
        $this->app->bind(CategoryRepositoryContract::class, CategoryRepository::class);
        $this->app->bind(ProductRepositoryContract::class, ProductRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
    }
}
