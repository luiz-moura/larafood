<?php

namespace Application\Providers;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Factory::guessFactoryNamesUsing(function (string $modelName) {
            return 'Database\\Factories\\'.class_basename($modelName).'Factory';
        });

        Paginator::useBootstrapFour();

        $this->app->register(\L5Swagger\L5SwaggerServiceProvider::class);
    }
}
