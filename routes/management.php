<?php

use App\Http\Controllers\DocsController;
use App\Http\Controllers\Management\ManagementController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::get('/management', [ManagementController::class, 'index'])->name('management.index');
    Route::get('/management/contract', [ManagementController::class, 'contracts'])->name('management.contracts');
    Route::get('/docs', [DocsController::class, 'index'])->name('docs.index');
});