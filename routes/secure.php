<?php

use App\Http\Controllers\SecurePinController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::post('/account/secure/save', [SecurePinController::class, 'save']);
    Route::get('/account/secure', [SecurePinController::class, 'index']);
});