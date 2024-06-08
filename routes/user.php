<?php

use App\Http\Controllers\Account\ProfileController;

use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {

});

Route::get('/user/{display_id}',[ProfileController::class, 'show']);