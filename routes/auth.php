<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController as Asc;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('signup', [RegisteredUserController::class, 'create'])
        ->name('signup');

    Route::get('signup/particular', [RegisteredUserController::class, 'particular'])
        ->name('signup');

    Route::post('signup/particular', [RegisteredUserController::class, 'storeParticular']);

    Route::post('signup', [RegisteredUserController::class, 'store']);

    Route::get('login', [Asc::class, 'create'])
        ->name('login');

    Route::post('login', [Asc::class, 'store']);

    Route::get('login/forgotten', [PasswordResetLinkController::class, 'create'])
        ->name('password.request');

    Route::post('login/forgotten', [PasswordResetLinkController::class, 'store'])
        ->name('password.email');

    Route::get('login/reset/{token}', [NewPasswordController::class, 'create'])
        ->name('password.reset');

    Route::post('login/reset/', [NewPasswordController::class, 'store'])
        ->name('password.store');

    Route::get('login/needed',[Asc::class,'needed']);
});

Route::middleware('auth')->group(function () {
    Route::get('verify-email', EmailVerificationPromptController::class)
        ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
        ->middleware('throttle:6,1')
        ->name('verification.send');

    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
        ->name('password.confirm');

    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::put('password', [PasswordController::class, 'update'])->name('password.update');

    Route::post('logout', [Asc::class, 'destroy'])
        ->name('logout');
});
