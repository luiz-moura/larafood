<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Interfaces\Http\Api\Authentication\Controllers\AuthenticatedTokenController;
use Interfaces\Http\Api\Authentication\Controllers\RegisteredClientController;
use Interfaces\Http\Api\Authentication\Middlewares\VerifyCompanyTokenMiddleware;
use Interfaces\Http\Api\Authentication\Resources\ClientResource;
use Interfaces\Http\Api\Category\Controllers\CategoryController;
use Interfaces\Http\Api\Order\Controllers\MyOrderController;
use Interfaces\Http\Api\Order\Controllers\OrderController;
use Interfaces\Http\Api\OrderEvaluation\Controllers\OrderEvaluationController;
use Interfaces\Http\Api\Product\Controllers\ProductController;
use Interfaces\Http\Api\Table\Controllers\TableController;
use Interfaces\Http\Api\Tenant\Controllers\TenantController;

Route::prefix('v1')->group(function () {
    Route::controller(TenantController::class)->group(function () {
        Route::get('tenants', 'index');
        Route::get('tenants/{companyToken}', 'show');
    });

    Route::middleware(VerifyCompanyTokenMiddleware::class)->group(function () {
        Route::controller(OrderController::class)->group(function () {
            Route::post('orders', 'store');
            Route::get('orders/{identify}', 'show');
        });
        Route::controller(CategoryController::class)->group(function () {
            Route::get('categories', 'index');
            Route::get('categories/{identify}', 'show')->whereUuid(['identify']);
        });
        Route::controller(TableController::class)->group(function () {
            Route::get('tables', 'index');
            Route::get('tables/{identify}', 'show')->whereUuid(['identify']);
        });
        Route::controller(ProductController::class)->group(function () {
            Route::get('products', 'index');
            Route::get('products/{identify}', 'show')->whereUuid(['identify']);
        });

        Route::middleware('auth:sanctum')->group(function () {
            Route::controller(MyOrderController::class)->group(function () {
                Route::get('my-orders', 'index');
                Route::post('my-orders', 'store');
            });
            Route::controller(OrderEvaluationController::class)->group(function () {
                Route::post('orders/{identify}/evaluations', 'store');
            });
        });
    });
});

Route::prefix('auth')->group(function () {
    Route::post('authenticate', [AuthenticatedTokenController::class, 'store']);
    Route::post('register', [RegisteredClientController::class, 'store']);

    Route::middleware('auth:sanctum')->group(function () {
        Route::get('logout', [AuthenticatedTokenController::class, 'destroy']);
        Route::get('me', function (Request $request) {
            return ClientResource::make($request->user());
        });
    });
});
