<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Interfaces\Http\Api\Authentication\Controllers\AuthenticatedTokenController;
use Interfaces\Http\Api\Authentication\Controllers\RegisteredClientController;
use Interfaces\Http\Api\Authentication\Resources\ClientResource;

Route::post('auth', [AuthenticatedTokenController::class, 'store']);
Route::post('client', [RegisteredClientController::class, 'store']);

Route::prefix('v1')->group(function () {
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
