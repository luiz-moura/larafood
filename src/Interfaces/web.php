<?php

use Illuminate\Support\Facades\Route;
use Interfaces\Http\Categories\Controllers\CategoryController;
use Interfaces\Http\Permissions\Controllers\PermissionController;
use Interfaces\Http\PlanDetails\Controllers\PlanDetailController;
use Interfaces\Http\Plans\Controllers\PlanController;
use Interfaces\Http\Plans\Controllers\PlanProfileController;
use Interfaces\Http\Products\Controllers\ProductCategoryController;
use Interfaces\Http\Products\Controllers\ProductController;
use Interfaces\Http\Profiles\Controllers\PermissionProfileController;
use Interfaces\Http\Profiles\Controllers\ProfileController;
use Interfaces\Http\Profiles\Controllers\ProfilePermissionController;
use Interfaces\Http\Profiles\Controllers\ProfilePlanController;
use Interfaces\Http\Site\Controllers\SiteController;
use Interfaces\Http\Tables\Controllers\TableController;
use Interfaces\Http\Users\Controllers\UserController;

Route::prefix('admin')->middleware('auth')->group(function () {
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
            Route::get('create', 'create')->name('plans.create');
            Route::get('search', 'search')->name('plans.search');
            Route::get('{url}', 'show')->name('plans.show');
            Route::delete('{url}', 'destroy')->name('plans.destroy');
            Route::get('{url}/edit', 'edit')->name('plans.edit');
            Route::put('{url}', 'update')->name('plans.update');
        });

        Route::controller(PlanProfileController::class)->group(function () {
            Route::get('{url}/profiles', 'index')->name('plans.profiles');
            Route::get('{url}/profiles/search', 'search')->name('plans.profiles.search');
            Route::get('{url}/profiles/available', 'available')->name('plans.profiles.available');
            Route::get('{url}/profiles/available/search', 'searchAvailable')->name('plans.profiles.search-available');

            Route::post('{url}/profiles', 'attachProfiles')->name('plans.profiles.attach');
            Route::delete('{url}/profiles/{profileId}', 'detachProfile')->name('plans.profiles.detach');
        });
    });

    Route::resource('profiles', ProfileController::class);
    Route::prefix('profiles')->group(function () {
        Route::get('{id}/plans', [ProfilePlanController::class, 'index'])->name('profiles.plans');
        Route::get('{id}/permissions', [PermissionProfileController::class, 'index'])->name('profiles.permissions');
        Route::get('{id}/permissions/search', [PermissionProfileController::class, 'search'])->name('profiles.permissions.search');
        Route::get('{id}/permissions/available', [PermissionProfileController::class, 'available'])->name('profiles.permissions.available');
        Route::get('{id}/permissions/available/search', [PermissionProfileController::class, 'searchAvailable'])->name('profiles.permissions.search-available');
        Route::post('{id}/permissions', [PermissionProfileController::class, 'attachPermissions'])->name('profiles.permissions.attach');
        Route::get('{id}/permissions/{permissionId}', [PermissionProfileController::class, 'detachPermission'])->name('profiles.permissions.detach');

        Route::get('search', [ProfileController::class, 'search'])->name('profiles.search');
    });

    Route::resource('permissions', PermissionController::class);
    Route::prefix('permissions')->group(function () {
        Route::get('{id}/profiles', [ProfilePermissionController::class, 'index'])->name('permissions.profiles.index');
        Route::get('search', [PermissionController::class, 'search'])->name('permissions.search');
    });

    Route::resource('users', UserController::class);
    Route::prefix('users')->group(function () {
        Route::get('users/search', [UserController::class, 'search'])->name('users.search');
    });

    Route::resource('categories', CategoryController::class);
    Route::prefix('categories')->group(function () {
        Route::get('categories/search', [CategoryController::class, 'search'])->name('categories.search');
    });

    Route::prefix('products')->group(function () {
        Route::get('search', [ProductController::class, 'search'])->name('products.search');

        Route::controller(ProductCategoryController::class)->group(function () {
            Route::get('{id}/categories', 'index')->name('products.categories');
            Route::get('{id}/categories/search', 'search')->name('products.categories.search');
            Route::get('{id}/categories/available', 'available')->name('products.categories.available');
            Route::post('{id}/categories', 'attachCategories')->name('products.categories.attach');
            Route::delete('{id}/categories/{categoryId}', 'detachCategory')->name('products.categories.detach');
        });
    });
    Route::resource('products', ProductController::class);

    Route::get('tables/search', [TableController::class, 'search'])->name('tables.search');
    Route::resource('tables', TableController::class);
});

Route::controller(SiteController::class)->group(function () {
    Route::get('/', 'index')->name('site.home');
    Route::get('plan/{url}', 'choosePlan')->name('site.choose_plan');
});

require __DIR__.'/auth.php';
