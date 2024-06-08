<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SuscriptionController;
use App\Models\Suscription;

Route::middleware('auth')->group(function () {
    Route::post('/suscription/premium/', [SuscriptionController::class, 'createSuscription']);
    Route::get('/suscription/renovate/{suscription_id}', [SuscriptionController::class, 'renovateSuscription']);
    Route::get('/suscription/renovate/{action}/{suscription_id}', [SuscriptionController::class, 'toggleSuscription']);
    Route::get('/suscription/renovate/automatic/{suscription_id}/{action}', [SuscriptionController::class, 'changeAutomaticPayment']);
});
Route::get('/suscription/needed',[SuscriptionController::class, 'needed']);

