<?php

use App\Http\Controllers\AnuncioController;
use App\Http\Controllers\FavouriteController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\Messages\InboxController;
use App\Http\Controllers\Search\ResultController;
use Illuminate\Support\Facades\Route;


use Stripe\PaymentIntent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Stripe\Exception\ApiErrorException;





Route::get('/', function () {
    if (Auth::check()) {
        $userHistory = HistoryController::getUserHistory(Auth::user()->id);
        $userSaved = FavouriteController::getUserFav(Auth::user()->id);
        return view('Home.index', [
            'userId' => Auth::user()->id,
            'userHistory' => $userHistory,
            'userSaved' => $userSaved
        ]);
    } else {
        return view('Home.index');
    }
})->name('home');

Route::get('/helloworld', function () {
    return view('Home.helloworld');
});

Route::post('/transaction', function (Request $request) {
    try {
        // Validar la solicitud
        $validator = Validator::make($request->all(), [
            'paymentMethodId' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->first()], 400);
        }

        // Establecer la clave secreta de Stripe
        //\Stripe\Stripe::setApiKey(config('services.stripe.secret'));
        \Stripe\Stripe::setApiKey('sk_test_51OexU1FHiAmjSHlNpyvzWHqTL8ORaRBlQDS1Hc6mGYZS2m0W9uwEjRQDC0cApymutskNXa0ho04wbr9v4RL1xIWK00nDUjAeBv');
        //\Stripe\Stripe::setApiKey('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');
        // Crear el intento de pago
        $paymentIntent = PaymentIntent::create([
            'amount' => 0, // Monto en centavos
            'currency' => 'eur',
            'payment_method' => $request->input('paymentMethodId'),
            'confirmation_method' => 'manual',
            'confirm' => true,
            'return_url' => 'https://www.google.es'
        ]);

        // Retornar el intento de pago
        return response()->json(['paymentIntent' => $paymentIntent]);
    } catch (ApiErrorException $e) {
        // Manejar errores de Stripe
        Log::error('Stripe Error: ' . $e->getMessage());
        return response()->json(['error' => 'Error al procesar el pago ' . $e->getMessage()], 500);
    } catch (\Exception $e) {
        // Manejar otros errores
        Log::error('Error: ' . $e->getMessage());
        return response()->json(['error' => 'Ocurrió un error inesperado' . $e->getMessage()], 500);
    }
});

Route::get('/checkout', function () {
    return view('Home.checkout');
});

Route::get('/anuncio/new', [AnuncioController::class, 'newAnuncio'])->middleware('auth');


/*
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
*/
require __DIR__ . '/suscription.php';
require __DIR__ . '/transaction.php';
require __DIR__ . '/anuncio.php';

require __DIR__ . '/search.php';
require __DIR__ . '/secure.php';
require __DIR__ . '/user.php';
require __DIR__ . '/management.php';
require __DIR__ . '/docs.php';
require __DIR__ . '/otp.php';
require __DIR__ . '/messages.php';
require __DIR__ . '/auth.php';
require __DIR__ . '/api.php';
require __DIR__ . '/account.php';
