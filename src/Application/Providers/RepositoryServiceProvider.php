<?php

namespace Application\Providers;

use Domains\ACL\Clients\Contracts\ClientRepository as ClientRepositoryContract;
use Domains\ACL\Permissions\Contracts\PermissionRepository as PermissionRepositoryContract;
use Domains\ACL\Profiles\Contracts\ProfileRepository as RepositoriesProfileContract;
use Domains\ACL\Roles\Contracts\RoleRepository as RoleRepositoryContract;
use Domains\ACL\Users\Contracts\UserRepository as UserRepositoryContract;
use Domains\Categories\Contracts\CategoryRepository as CategoryRepositoryContract;
use Domains\Evaluations\Contracts\EvaluationRepository as EvaluationRepositoryContract;
use Domains\Orders\Contracts\OrderRepository as OrderRepositoryContract;
use Domains\Plans\Contracts\PlanDetailRepository as PlanDetailRepositoryContract;
use Domains\Plans\Contracts\PlanRepository as PlanRepositoryContract;
use Domains\Products\Repositories\ProductRepository as ProductRepositoryContract;
use Domains\Tables\Contracts\TableRepository as TableRepositoryContract;
use Domains\Tenants\Contracts\TenantRepository as TenantRepositoryContract;
use Illuminate\Support\ServiceProvider;
use Infrastructure\Persistence\Eloquent\Repositories\CategoryRepository;
use Infrastructure\Persistence\Eloquent\Repositories\ClientRepository;
use Infrastructure\Persistence\Eloquent\Repositories\OrderEvaluationRepository;
use Infrastructure\Persistence\Eloquent\Repositories\OrderRepository;
use Infrastructure\Persistence\Eloquent\Repositories\PermissionRepository;
use Infrastructure\Persistence\Eloquent\Repositories\PlanDetailRepository;
use Infrastructure\Persistence\Eloquent\Repositories\PlanRepository;
use Infrastructure\Persistence\Eloquent\Repositories\ProductRepository;
use Infrastructure\Persistence\Eloquent\Repositories\ProfileRepository;
use Infrastructure\Persistence\Eloquent\Repositories\RoleRepository;
use Infrastructure\Persistence\Eloquent\Repositories\TableRepository;
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
        $this->app->bind(TableRepositoryContract::class, TableRepository::class);
        $this->app->bind(RoleRepositoryContract::class, RoleRepository::class);
        $this->app->bind(ClientRepositoryContract::class, ClientRepository::class);
        $this->app->bind(OrderRepositoryContract::class, OrderRepository::class);
        $this->app->bind(EvaluationRepositoryContract::class, OrderEvaluationRepository::class);
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
