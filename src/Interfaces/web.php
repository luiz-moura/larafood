<?php

use Illuminate\Support\Facades\Route;
use Interfaces\Http\Plans\Controllers\PlanController;

Route::get('admin/plans', [PlanController::class, 'index']);

Route::prefix('admin')->group(function () {
    Route::get('/', [PlanController::class, 'index'])->name('admin.index');

    Route::prefix('plan')->controller(PlanController::class)->group(function () {
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
