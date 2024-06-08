<?php

use App\Http\Controllers\SecurePinController;
use App\Http\Controllers\TransactionController;
use App\Models\Suscription;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::get('/cobrarme', function () {

    $suscriptionData=Suscription::getUserData(Auth::user()->id);

    $controller = new TransactionController();
    echo $controller->automaticCharge($suscriptionData->payment_method_id,1990,Auth::user()->email);

})->middleware('auth');

Route::middleware('auth')->group(function () {
    Route::post('/transaction/bank/create-client-secret',[TransactionController::class, 'createPaymentIntent']);
    Route::get('/transaction/bank',[TransactionController::class, 'bankIndex']);
    Route::post('/transaction/bank/pay',[TransactionController::class, 'transferToBankAccount']);
});
Route::post('/transaction/account/checkout/save',[TransactionController::class, 'saveToken']);
Route::post('/transaction/account/checkout/{type}',[TransactionController::class, 'planPayment']);
