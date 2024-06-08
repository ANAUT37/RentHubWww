<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\PaymentIntent;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Stripe\Exception\ApiErrorException;
use Stripe\Stripe;
use Stripe\SetupIntent;
use Stripe\Customer;
use Illuminate\Support\Facades\Auth;


class TransactionController extends Controller
{

    public function saveToken(Request $request)
    {
        $stripe = new \Stripe\StripeClient(
            'rk_test_51OexU1FHiAmjSHlNWFpFQ9NUGDabRKwy1NTNCS7d9i7HNLdEMzLjBzNowoz84RHhi5RUYbZk96Y4o4lvzJsVoqWT00sLJoh7gF' // Tu clave secreta de Stripe
        );

        try {
            $paymentMethod = $stripe->paymentMethods->retrieve(
                $request->paymentMethodId,
                []
            );

            $cardToken = $paymentMethod->card->id;

            // Realiza la lógica de pago aquí utilizando $cardToken

            if ($cardToken === null) {
                $cardToken = 'ERROR';
            }



            return response()->json(['cardToken' => $paymentMethod]);
        } catch (ApiErrorException $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function automaticCharge($paymentMethodId, $amount, $customer_id)
    {
        Stripe::setApiKey('sk_test_51OexU1FHiAmjSHlNpyvzWHqTL8ORaRBlQDS1Hc6mGYZS2m0W9uwEjRQDC0cApymutskNXa0ho04wbr9v4RL1xIWK00nDUjAeBv');
    
        try {
            // Crear un Customer y asociar el PaymentMethod
            // Crear un PaymentIntent con el Customer asociado
            $intent = PaymentIntent::create([
                'amount' => $amount, // Monto en centavos
                'currency' => 'eur',
                'customer'=> $customer_id,
                'payment_method' => $paymentMethodId,
                'confirmation_method' => 'manual',
                'confirm' => true,
                'return_url' => 'http://renthub.es'
            ]);
    
            $intent->confirm();
    
            return $intent;
        } catch (ApiErrorException $e) {
            return $e->getMessage();
        }
    }

    
    public function planPayment(Request $request, $type)
    {
        $amount = 50;
        if (isset($type)) {
            if ($type === 'premium') {
                $amount = 990;
            } else if ($type === 'enterprise') {
                $amount = 2990;
            }
        }
    
        try {
            // Validar la solicitud
            $validator = Validator::make($request->all(), [
                'paymentMethodId' => 'required|string',
            ]);
    
            if ($validator->fails()) {
                return response()->json(['error' => $validator->errors()->first()], 400);
            }
    
            // Establecer la clave secreta de Stripe
            \Stripe\Stripe::setApiKey('sk_test_51OexU1FHiAmjSHlNpyvzWHqTL8ORaRBlQDS1Hc6mGYZS2m0W9uwEjRQDC0cApymutskNXa0ho04wbr9v4RL1xIWK00nDUjAeBv');
            
            // Crear un Customer en Stripe y asociarle el PaymentMethod
            $customer = Customer::create([
                'payment_method' => $request->input('paymentMethodId'),
                'email' => Auth::user()->email,
            ]);
    
            // Crear el intento de pago
            $paymentIntent = PaymentIntent::create([
                'amount' => $amount, // Monto en centavos
                'currency' => 'eur',
                'payment_method' => $request->input('paymentMethodId'),
                'customer' => $customer->id, // Asociar el PaymentMethod al Customer
                'confirmation_method' => 'manual',
                'confirm' => true,
                'return_url' => 'http://renthub.es'
            ]);
            
            return response()->json(['paymentIntent' => $paymentIntent]);
        } catch (ApiErrorException $e) {
            Log::error('Stripe Error: ' . $e->getMessage());
            return response()->json(['error' => 'Error al procesar el pago ' . $e->getMessage()], 500);
        } catch (\Exception $e) {
            Log::error('Error: ' . $e->getMessage());
            return response()->json(['error' => 'Ocurrió un error inesperado' . $e->getMessage()], 500);
        }
    }
    

    public function transferToBankAccount(Request $request)
    {

        try {
            $stripe = new \Stripe\StripeClient('sk_test_51OexU1FHiAmjSHlNpyvzWHqTL8ORaRBlQDS1Hc6mGYZS2m0W9uwEjRQDC0cApymutskNXa0ho04wbr9v4RL1xIWK00nDUjAeBv');

            $stripe->setupIntents->create([
                'customer' => '{{CUSTOMER_ID}}',
                'flow_directions' => ['outbound'],
                'payment_method_types' => ['us_bank_account'],
            ]);
        } catch (ApiErrorException $e) {
            Log::error('Stripe Error: ' . $e->getMessage());
            return response()->json(['error' => 'Error al procesar el pago ' . $e->getMessage()], 500);
        } catch (\Exception $e) {
            Log::error('Error: ' . $e->getMessage());
            return response()->json(['error' => 'Ocurrió un error inesperado' . $e->getMessage()], 500);
        }
    }

    public function bankIndex()
    {
        return view('Home.checkout');
    }

    public function createClientSecret()
    {
        Stripe::setApiKey('sk_test_51OexU1FHiAmjSHlNpyvzWHqTL8ORaRBlQDS1Hc6mGYZS2m0W9uwEjRQDC0cApymutskNXa0ho04wbr9v4RL1xIWK00nDUjAeBv');

        $setupIntent = SetupIntent::create([]);

        return response()->json(['client_secret' => $setupIntent->client_secret]);
    }
    public function createPaymentIntent()
    {
        Stripe::setApiKey('sk_test_51OexU1FHiAmjSHlNpyvzWHqTL8ORaRBlQDS1Hc6mGYZS2m0W9uwEjRQDC0cApymutskNXa0ho04wbr9v4RL1xIWK00nDUjAeBv');

        // Obtener el ID de la cuenta conectada del vendedor
        $sellerAccountId = 'ES0700120345030000067890'; // Reemplaza con el ID de cuenta de prueba de Stripe
        // Reemplaza esto con el ID real de la cuenta del vendedor

        // Crear un PaymentIntent
        $paymentIntent = PaymentIntent::create([
            'amount' => 1000, // Monto en centavos
            'currency' => 'eur',
            'payment_method_types' => ['sepa_debit'],

        ]);

        return response()->json(['client_secret' => $paymentIntent->client_secret]);
    }
}
