<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Interfaces\Http\Api\Authentication\Controllers\AuthenticatedTokenController;
use Interfaces\Http\Api\Authentication\Controllers\RegisteredClientController;
use Interfaces\Http\Api\Authentication\Resources\ClientResource;
use Interfaces\Http\Api\Category\Controllers\CategoryController;
use Interfaces\Http\Api\Order\Controllers\OrderController;
use Interfaces\Http\Api\Product\Controllers\ProductController;
use Interfaces\Http\Api\Table\Controllers\TableController;
use Interfaces\Http\Api\Tenant\Controllers\TenantController;

Route::post('auth', [AuthenticatedTokenController::class, 'store']);
Route::post('client', [RegisteredClientController::class, 'store']);

Route::prefix('v1')->group(function () {
    Route::prefix('tenants')->group(function () {
        Route::controller(OrderController::class)->group(function () {
            Route::post('{companyToken}/orders', 'store')->whereUuid('companyToken');
            Route::get('{companyToken}/orders/{identify}', 'show')->whereUuid('companyToken');
        });
        Route::controller(TenantController::class)->group(function () {
            Route::get('/', 'index');
            Route::get('{companyToken}', 'show')->whereUuid('companyToken');
        });
        Route::controller(CategoryController::class)->group(function () {
            Route::get('{companyToken}/categories', 'index')->whereUuid('companyToken');
            Route::get('{companyToken}/categories/{identify}', 'show')->whereUuid(['companyToken', 'identify']);
        });
        Route::controller(TableController::class)->group(function () {
            Route::get('{companyToken}/tables', 'index')->whereUuid('companyToken');
            Route::get('{companyToken}/tables/{identify}', 'show')->whereUuid(['companyToken', 'identify']);
        });
        Route::controller(ProductController::class)->group(function () {
            Route::get('{companyToken}/products', 'index')->whereUuid('companyToken');
            Route::get('{companyToken}/products/{identify}', 'show')->whereUuid(['companyToken', 'identify']);
        });
    });

    Route::middleware('auth:sanctum')->group(function () {
        Route::controller(OrderController::class)->group(function () {
            Route::get('/auth/tenants/{companyToken}/my-orders', 'index')->whereUuid('companyToken');
            Route::post('/auth/tenants/{companyToken}/orders', 'store')->whereUuid('companyToken');
        });
    });
});

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/me', function (Request $request) {
        return new ClientResource($request->user());
    });

    Route::get('/logout', function (Request $request) {
        $request->user()->tokens()->delete();

        return response()->noContent();
    });
});
