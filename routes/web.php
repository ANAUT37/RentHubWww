<?php

use App\Http\Controllers\Messages\InboxController;
use App\Http\Controllers\Search\ResultController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('Home.index');
});
Route::get('/search/{category}/{location}', [ResultController::class, 'index']);



/*
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
*/
require __DIR__.'/anuncio.php';
require __DIR__.'/messages.php';
require __DIR__.'/auth.php';
require __DIR__.'/account.php';
