<?php

use App\Http\Controllers\AnuncioController;
use Illuminate\Support\Facades\Route;



Route::middleware('auth')->group(function () {
    Route::get('/anuncio/new', [AnuncioController::class, 'new'])
    ->name('anuncio.new');
    /*
    Route::get('/account/notifications', [AccountOptionsController::class, 'index'])->name('profile.index');
    Route::get('/account/plan', [AccountOptionsController::class, 'index'])->name('profile.index');
    Route::get('/account/posts', [AccountOptionsController::class, 'index'])->name('profile.index');
    */

});
    Route::get('/anuncio/{anuncio_id}', [AnuncioController::class, 'index'])
        ->name('anuncio.index');