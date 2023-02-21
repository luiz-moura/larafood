<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Interfaces\Http\Api\Authentication\Controllers\AuthenticatedTokenController;
use Interfaces\Http\Api\Authentication\Controllers\RegisteredClientController;
use Interfaces\Http\Api\Authentication\Resources\ClientResource;
use Interfaces\Http\Api\Category\Controllers\CategoryController;
use Interfaces\Http\Api\Product\Controllers\ProductController;
use Interfaces\Http\Api\Table\Controllers\TableController;
use Interfaces\Http\Api\Tenant\Controllers\TenantController;

Route::post('auth', [AuthenticatedTokenController::class, 'store']);
Route::post('client', [RegisteredClientController::class, 'store']);

Route::prefix('v1')->group(function () {
    Route::prefix('tenants')->group(function () {
        Route::controller(TenantController::class)->group(function () {
            Route::get('/', 'index');
            Route::get('{uuid}', 'show');
        });
        Route::controller(CategoryController::class)->group(function () {
            Route::get('{uuid}/categories', 'index');
            Route::get('{uuid}/categories/{identify}', 'show');
        });
        Route::controller(TableController::class)->group(function () {
            Route::get('{uuid}/tables', 'index');
            Route::get('{uuid}/tables/{identify}', 'show');
        });
        Route::controller(ProductController::class)->group(function () {
            Route::get('{uuid}/products', 'index');
            Route::get('{uuid}/products/{identify}', 'show');
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
