<?php

use Illuminate\Support\Facades\Route;
use Interfaces\Http\Authentication\Controllers\AuthenticatedSessionController;
use Interfaces\Http\Authentication\Controllers\ConfirmablePasswordController;
use Interfaces\Http\Authentication\Controllers\EmailVerificationNotificationController;
use Interfaces\Http\Authentication\Controllers\EmailVerificationPromptController;
use Interfaces\Http\Authentication\Controllers\NewPasswordController;
use Interfaces\Http\Authentication\Controllers\PasswordResetLinkController;
use Interfaces\Http\Authentication\Controllers\RegisteredUserController;
use Interfaces\Http\Authentication\Controllers\VerifyEmailController;

Route::middleware('guest')->group(function () {
    Route::prefix('register')->controller(RegisteredUserController::class)->group(function () {
        Route::get('/', 'create')->name('register');
        Route::post('/', 'store');
    });

    Route::prefix('login')->controller(AuthenticatedSessionController::class)->group(function () {
        Route::get('/', 'create')->name('login');
        Route::post('/', 'store');
    });

    Route::prefix('forgot-password')->controller(PasswordResetLinkController::class)->group(function () {
        Route::get('/', 'create')->name('password.request');
        Route::post('/', 'store')->name('password.email');
    });

    Route::prefix('reset-password')->controller(NewPasswordController::class)->group(function () {
        Route::get('{token}', 'create')->name('password.reset');
        Route::post('/', 'store')->name('password.update');
    });
});

Route::middleware('auth')->group(function () {
    Route::get('verify-email', [EmailVerificationPromptController::class, '__invoke'])
        ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', [VerifyEmailController::class, '__invoke'])
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
        ->middleware('throttle:6,1')
        ->name('verification.send');

    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
        ->name('password.confirm');

    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::any('logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');
});
