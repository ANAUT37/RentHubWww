<?php

use App\Http\Controllers\FollowedSearchController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\FavouriteController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Search\ResultController;



Route::middleware('auth')->group(function () {
    Route::get('/recent', [ResultController::class, 'recent']);
    Route::get('/favs', [FavouriteController::class, 'favs']);
    Route::post('/history/save', [HistoryController::class, 'save']);
    Route::get('/history/{user_id}', [HistoryController::class, 'get']);
    Route::post('/search/follow', [FollowedSearchController::class, 'toggleFollow']);
});
Route::get('/search/{category}/{longitude}/{latitude}/{distance}/{price?}/{creation?}', [ResultController::class, 'perform']);
Route::get('/search/{category}/{location}', [ResultController::class, 'index']);
