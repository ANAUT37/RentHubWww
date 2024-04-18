<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Messages\InboxController;



Route::middleware('auth')->group(function () {
    Route::get('/messages/{display_id}', [InboxController::class, 'chat']);
    Route::get('/messages/request/{request_id}', [InboxController::class, 'chatRequest']);
    Route::get('/messages/request/{request_id}/accept', [InboxController::class, 'chatRequestAccept']);
    Route::get('/messages/request/{request_id}/decline', [InboxController::class, 'chatRequestDecline']);
    Route::get('/messages/request', [InboxController::class, 'request']);
    Route::get('/messages', [InboxController::class, 'index']);


});