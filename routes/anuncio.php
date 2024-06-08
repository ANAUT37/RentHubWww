<?php

use App\Http\Controllers\AnuncioController;
use App\Http\Controllers\FavouriteController;
use App\Http\Controllers\InmuebleController;
use App\Http\Controllers\ViewController;
use Illuminate\Support\Facades\Route;


Route::get('/inmueble/{inmueble_id}/get', [InmuebleController::class, 'getData']);
Route::post('/anuncio/stats/save', [ViewController::class, 'save']);
Route::get('/anuncio/{anuncio_id}', [AnuncioController::class, 'index'])
    ->name('anuncio.index');


Route::middleware('auth')->group(function () {

    Route::post('/anuncio/new/save', [AnuncioController::class, 'save']);
    Route::get('/anuncio/new', [AnuncioController::class, 'newAnuncio']);
    Route::get('/anuncio/new/categories', [AnuncioController::class, 'categories']);
    Route::get('/anuncio/edit/{anuncio_id}', [AnuncioController::class, 'edit']);
    Route::get('/anuncio/stats/{anuncio_id}', [AnuncioController::class, 'statsIndex']);
    Route::get('/anuncio/stats/{anuncio_id}/{action}/{period}', [ViewController::class, 'getUniqueVisits']);
    Route::post('/anuncio/fav/{anuncio_id}', [FavouriteController::class, 'toggleFav']);



    /*
    Route::get('/account/notifications', [AccountOptionsController::class, 'index'])->name('profile.index');
    Route::get('/account/plan', [AccountOptionsController::class, 'index'])->name('profile.index');
    Route::get('/account/posts', [AccountOptionsController::class, 'index'])->name('profile.index');
    */
});

