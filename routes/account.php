<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Account\ProfileController;
use App\Http\Controllers\Account\AccountOptionsController;
use App\Http\Controllers\Auth\PasswordController;


Route::middleware('auth')->group(function () {
    Route::get('/account', [ProfileController::class, 'index'])->name('profile.index');
    Route::get('/account/info', [AccountOptionsController::class, 'info'])->name('account.info');
    Route::get('/account/payments', [AccountOptionsController::class, 'payments'])->name('account.payments');
    Route::get('/account/history', [AccountOptionsController::class, 'history'])->name('account.history');
    Route::get('/account/paymethods', [AccountOptionsController::class, 'paymethods'])->name('account.paymethods');
    Route::get('/account/payout', [AccountOptionsController::class, 'payout'])->name('account.payout');
    Route::get('/account/security', [AccountOptionsController::class, 'security'])->name('account.security');
    Route::post('/account/security/reset', [PasswordController::class, 'update'])->name('account.reset-password');
    /*
    Route::get('/account/notifications', [AccountOptionsController::class, 'index'])->name('profile.index');
    Route::get('/account/plan', [AccountOptionsController::class, 'index'])->name('profile.index');
    Route::get('/account/posts', [AccountOptionsController::class, 'index'])->name('profile.index');
    */
    Route::get('/account/edit', [AccountOptionsController::class, 'edit'])->name('profile.edit');
    Route::patch('/account', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/account', [ProfileController::class, 'destroy'])->name('profile.destroy');
});