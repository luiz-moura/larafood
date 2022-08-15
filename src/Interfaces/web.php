<?php

use Illuminate\Support\Facades\Route;
use Interfaces\Http\Permissions\Controllers\PermissionController;
use Interfaces\Http\Plans\Controllers\PlanController;
use Interfaces\Http\Plans\Controllers\PlanDetailController;
use Interfaces\Http\Profiles\Controllers\ProfileController;

Route::prefix('admin')->group(function () {
    Route::get('/', [PlanController::class, 'index'])->name('admin.index');

    Route::prefix('plans')->group(function () {
        Route::controller(PlanDetailController::class)->group(function () {
            Route::get('{url}/details', 'index')->name('plan_details.index');
            Route::get('{url}/details/create', 'create')->name('plan_details.create');
            Route::post('{url}/details', 'store')->name('plan_details.store');

            Route::get('{url}/details/{id}/edit', 'edit')->name('plan_details.edit');
            Route::delete('{url}/details/{id}', 'destroy')->name('plan_details.destroy');
            Route::get('{url}/details/{id}', 'show')->name('plan_details.show');
            Route::put('{url}/details/{id}', 'update')->name('plan_details.update');
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

    Route::get('profiles/search', [ProfileController::class, 'search'])->name('profiles.search');
    Route::resource('profiles', ProfileController::class);

    Route::get('permissions/search', [PermissionController::class, 'search'])->name('permissions.search');
    Route::resource('permissions', PermissionController::class);
});
