<?php

namespace Application\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Infrastructure\Persistence\Eloquent\Models\Permission;
use Infrastructure\Persistence\Eloquent\Models\User;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        if ($this->app->runningInConsole() && !$this->app->runningUnitTests()) {
            return;
        }

        $permissions = Permission::all()
            ->map(fn ($permission) => mb_strtolower($permission->name))
            ->unique();

        $permissions->each(function ($permission) {
            Gate::define($permission, function (User $user) use ($permission) {
                return $user->hasPermission($permission);
            });
        });

        Gate::before(function (User $user) {
            if ($user->isAdmin()) {
                return true;
            }
        });
    }
}
