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
use Interfaces\Http\Roles\Controllers\RoleController;
use Interfaces\Http\Roles\Controllers\RolePermissionController;
use Interfaces\Http\Site\Controllers\SiteController;
use Interfaces\Http\Tables\Controllers\TableController;
use Interfaces\Http\Tenant\Controllers\TenantController;
use Interfaces\Http\Users\Controllers\RoleUserController;
use Interfaces\Http\Users\Controllers\UserController;
use Spatie\Health\Http\Controllers\HealthCheckResultsController;

Route::get('health', HealthCheckResultsController::class);

Route::prefix('admin')->middleware('auth')->group(function () {
    Route::get('/', [PlanController::class, 'index'])->name('admin.index');

    Route::middleware('can:plans')->group(function () {
        Route::prefix('plans')->group(function () {
            // TODO: change to use nested resource
            Route::controller(PlanDetailController::class)->group(function () {
                Route::get('{url}/details', 'index')->name('plan_details.index');
                Route::get('{url}/details/create', 'create')->name('plan_details.create');
                Route::post('{url}/details', 'store')->name('plan_details.store');
                Route::get('{url}/details/{id}', 'show')->name('plan_details.show');
                Route::get('{url}/details/{id}/edit', 'edit')->name('plan_details.edit');
                Route::put('{url}/details/{id}', 'update')->name('plan_details.update');
                Route::delete('{url}/details/{id}', 'destroy')->name('plan_details.destroy');
            });

            Route::controller(PlanProfileController::class)->group(function () {
                Route::get('{url}/profiles', 'index')->name('plans.profiles');
                Route::get('{url}/profiles/available', 'available')->name('plans.profiles.available');
                Route::get('{url}/profiles/available/search', 'searchAvailable')->name('plans.profiles.search-available');
                Route::post('{url}/profiles', 'attachProfiles')->name('plans.profiles.attach');
                Route::delete('{url}/profiles/{profileId}', 'detachProfile')->name('plans.profiles.detach');
            });

            Route::get('search', [PlanController::class, 'search'])->name('plans.search');
        });

        Route::resource('plans', PlanController::class)->parameter('id', 'url');
    });

    Route::middleware('can:profiles')->group(function () {
        Route::prefix('profiles')->group(function () {
            Route::get('{id}/plans', [ProfilePlanController::class, 'index'])->name('profiles.plans');
            Route::controller(PermissionProfileController::class)->group(function () {
                Route::get('{id}/permissions', 'index')->name('profiles.permissions');
                Route::get('{id}/permissions/available', 'available')->name('profiles.permissions.available');
                Route::get('{id}/permissions/available/search', 'searchAvailable')->name('profiles.permissions.search-available');
                Route::post('{id}/permissions', 'attachPermissions')->name('profiles.permissions.attach');
                Route::get('{id}/permissions/{permissionId}', 'detachPermission')->name('profiles.permissions.detach');
            });
            Route::get('search', [ProfileController::class, 'search'])->name('profiles.search');
        });

        Route::resource('profiles', ProfileController::class);
    });

    Route::middleware('can:permissions')->group(function () {
        Route::prefix('permissions')->group(function () {
            Route::get('{id}/profiles', [ProfilePermissionController::class, 'index'])->name('permissions.profiles.index');
            Route::get('search', [PermissionController::class, 'search'])->name('permissions.search');
        });

        Route::resource('permissions', PermissionController::class);
    });

    Route::middleware('can:users')->group(function () {
        Route::prefix('users')->controller(RoleUserController::class)->group(function () {
            Route::get('{id}/roles', 'index')->name('users.roles');
            Route::get('{id}/roles/available', 'available')->name('users.roles.available');
            Route::get('{id}/roles/available/search', 'searchAvailable')->name('users.roles.search');
            Route::post('{id}/roles', 'attachRoles')->name('users.roles.attach');
            Route::get('{id}/roles/{roleId}', 'detachRole')->name('users.roles.detach');
        });

        Route::get('users/search', [UserController::class, 'search'])->name('users.search');
        Route::resource('users', UserController::class);
    });

    Route::middleware('can:categories')->group(function () {
        Route::get('categories/search', [CategoryController::class, 'search'])->name('categories.search');
        Route::resource('categories', CategoryController::class);
    });

    Route::middleware('can:products')->group(function () {
        Route::prefix('products')->group(function () {
            Route::controller(ProductCategoryController::class)->group(function () {
                Route::get('{id}/categories', 'index')->name('products.categories');
                Route::get('{id}/categories/search', 'searchAvailable')->name('products.categories.search');
                Route::get('{id}/categories/available', 'available')->name('products.categories.available');
                Route::post('{id}/categories', 'attachCategories')->name('products.categories.attach');
                Route::delete('{id}/categories/{categoryId}', 'detachCategory')->name('products.categories.detach');
            });

            Route::get('search', [ProductController::class, 'search'])->name('products.search');
        });

        Route::resource('products', ProductController::class);
    });

    Route::middleware('can:tenants')->group(function () {
        Route::get('tenants/search', [TenantController::class, 'search'])->name('tenants.search');
        Route::resource('tenants', TenantController::class)->except('destroy');
    });

    Route::middleware('can:tables')->group(function () {
        Route::get('tables/search', [TableController::class, 'search'])->name('tables.search');
        Route::resource('tables', TableController::class);
    });

    Route::middleware('can:roles')->group(function () {
        Route::prefix('roles')->controller(RolePermissionController::class)->group(function () {
            Route::get('{id}/permissions', 'index')->name('roles.permissions');
            Route::get('{id}/permissions/available', 'available')->name('roles.permissions.available');
            Route::get('{id}/permissions/available/search', 'searchAvailable')->name('roles.permissions.search');
            Route::post('{id}/permissions', 'attachPermissions')->name('roles.permissions.attach');
            Route::get('{id}/permissions/{permissionId}', 'detachPermission')->name('roles.permissions.detach');
        });

        Route::get('roles/search', [RoleController::class, 'search'])->name('roles.search');
        Route::resource('roles', RoleController::class);
    });
});

Route::controller(SiteController::class)->group(function () {
    Route::get('/', 'index')->name('site.home');
    Route::get('plan/{url}', 'choosePlan')->name('site.choose_plan');
});

require __DIR__.'/auth.php';
