<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Messages\InboxController;
use App\Http\Livewire\Chat\Index;

Route::middleware('auth')->group(function () {
    Route::get('/messages/{display_id}', [InboxController::class, 'chat']);
    Route::post('/messages/request/new', [InboxController::class, 'createRequest']);
    Route::get('/messages/request/{request_id}', [InboxController::class, 'chatRequest']);
    Route::get('/messages/request/{request_id}/accept', [InboxController::class, 'chatRequestAccept']);
    Route::get('/messages/request/{request_id}/decline', [InboxController::class, 'chatRequestDecline']);
    Route::get('/messages/request', [InboxController::class, 'request']);
    Route::get('/messages', [InboxController::class, 'index']);

    Route::get('/chat',Index::class)->name('chat.index');
});