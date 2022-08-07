<?php

namespace Application\Providers;

use Domains\Plans\Contracts\PlanDetailRepository as PlanDetailRepositoryContract;
use Domains\Plans\Contracts\PlanRepository as PlanRepositoryContract;
use Illuminate\Support\ServiceProvider;
use Infrastructure\Persistence\Eloquent\Repositories\PlanDetailRepository;
use Infrastructure\Persistence\Eloquent\Repositories\PlanRepository;

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
