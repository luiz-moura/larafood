<?php

namespace Application\Providers;

use Domains\ACL\Permissions\Contracts\PermissionRepository as PermissionRepositoryContract;
use Domains\ACL\Profiles\Contracts\ProfileRepository as RepositoriesProfileContract;
use Domains\Plans\Contracts\PlanDetailRepository as PlanDetailRepositoryContract;
use Domains\Plans\Contracts\PlanRepository as PlanRepositoryContract;
use Illuminate\Support\ServiceProvider;
use Infrastructure\Persistence\Eloquent\Repositories\PermissionRepository;
use Infrastructure\Persistence\Eloquent\Repositories\PlanDetailRepository;
use Infrastructure\Persistence\Eloquent\Repositories\PlanRepository;
use Infrastructure\Persistence\Eloquent\Repositories\ProfileRepository;

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
