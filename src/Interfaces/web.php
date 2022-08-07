<?php

use Illuminate\Support\Facades\Route;
use Interfaces\Http\Plans\Controllers\PlanController;
use Interfaces\Http\Plans\Controllers\PlanDetailController;

Route::prefix('admin')->group(function () {
    Route::get('/', [PlanController::class, 'index'])->name('admin.index');

    Route::prefix('plan')->group(function () {
        Route::controller(PlanDetailController::class)->group(function () {
            Route::get('{url}/details/{id}/edit', 'edit')->name('plan.details.edit');
            Route::delete('{url}/details/{id}', 'destroy')->name('plan.details.destroy');
            Route::get('{url}/details/{id}', 'show')->name('plan.details.show');
            Route::put('{url}/details/{id}', 'update')->name('plan.details.update');
            Route::get('{url}/details', 'index')->name('plan.details.index');
            Route::get('{url}/details', 'index')->name('plan.details.index');
            Route::get('{url}/details/create', 'create')->name('plan.details.create');
            Route::post('{url}/details', 'store')->name('plan.details.store');
        });

        Route::controller(PlanController::class)->group(function () {
            Route::get('/', 'index')->name('plans.index');
            Route::post('/', 'store')->name('plans.store');
            Route::get('/create', 'create')->name('plans.create');
            Route::get('/search', 'search')->name('plans.search');
            Route::get('/{url}', 'show')->name('plans.show');
            Route::delete('/{url}', 'destroy')->name('plans.destroy');
            Route::get('/{url}/edit', 'edit')->name('plans.edit');
            Route::put('/{url}', 'update')->name('plans.update');
        });
    });
});
