<?php

namespace Application\Providers;

use Application\Events\TenantCreated;
use Application\Listeners\AddRoleTenant;
use Application\Observers\CategoryObserver;
use Application\Observers\PlanObserver;
use Application\Observers\ProductObserver;
use Application\Observers\TenantObserver;
use Application\Observers\UserObserver;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
use Infrastructure\Persistence\Eloquent\Models\Category;
use Infrastructure\Persistence\Eloquent\Models\Plan;
use Infrastructure\Persistence\Eloquent\Models\Product;
use Infrastructure\Persistence\Eloquent\Models\Tenant;
use Infrastructure\Persistence\Eloquent\Models\User;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        TenantCreated::class => [
            AddRoleTenant::class,
        ],
    ];

    protected $observers = [
        User::class => [UserObserver::class],
        Plan::class => [PlanObserver::class],
        Tenant::class => [TenantObserver::class],
        Category::class => [CategoryObserver::class],
        Product::class => [ProductObserver::class],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     *
     * @return bool
     */
    public function shouldDiscoverEvents()
    {
        return false;
    }
}
