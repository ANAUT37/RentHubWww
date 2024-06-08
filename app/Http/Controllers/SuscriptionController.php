<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Http\Controllers\TransactionController;

use App\Models\Suscription;
use Illuminate\Support\Facades\Auth;

class SuscriptionController extends Controller
{


    public function handleCancelledSubscriptionStates(){
        //CAMBIA A BASIC A TODOS LOS USUARIOS QUE HAN DESACTIVADO LA SUSCRIPCION Y HA LLEGADO SU END DATE
        $today = Carbon::today();

        Suscription::query()
            ->whereNotNull('cancellation_date')
            ->where('status','inactive')
            ->whereDate('end_date', $today)
            ->update(['subscription_type' => 'particular_basic']); // Aplicar la actualización a los registros filtrados
    }

    public function handleAutomaticRenovationSuscriptionStates(){
        $today = Carbon::today();
    
        // Recuperar las suscripciones que cumplen con los criterios
        $suscriptions = Suscription::query()
            ->where('subscription_type','particular_premium')
            ->where('status','active')
            ->whereDate('renewal_date', $today)
            ->where('plan_id', 1)
            ->get();
    
        // Iterar sobre las suscripciones y enviar los datos de cada usuario al otro método
        foreach ($suscriptions as $suscription) {
            $controller = new TransactionController();
            $controller->automaticCharge($suscription->payment_method_id,990,$suscription->customer_id);

            $suscription->renewal_date=$suscription->renewal_date->addMonth();
            $suscription->save();
        }
    }

    public function createSuscription(Request $request)
    {

        $userId = Auth::id();
        $suscription = Suscription::getUserData($userId);
        $suscription->start_date = now();
        $suscription->end_date = now()->addMonth();
        $suscription->status = 'active';
        $suscription->subscription_type = 'particular_premium';
        $suscription->renewal_date = null;
        $suscription->payment_method = 'card';
        $suscription->payment_method_id=$request->paymentMethodId;
        $suscription->save();

        return response()->json(['message' => $suscription], 200);
    }



    public function changeAutomaticPayment(Request $request, $suscription_id, $action)
    {
        $suscription = Suscription::findOrFail($suscription_id);
        if ($action == 'cancel') {
            $suscription->plan_id = 0;
        } else if ($action == 'activate') {
            $suscription->plan_id = 1;
            $suscription->renewal_date=$suscription->end_date;
        }
        $suscription->save();

        return redirect()->back();
    }

    public function toggleSuscription(Request $request, $action, $suscription_id)
    {
        // Obtener la suscripción por ID
        $suscription = Suscription::findOrFail($suscription_id);

        // Verificar la acción y actualizar los campos según corresponda
        if ($action == 'cancel') {
            $suscription->status = "inactive";
            $suscription->cancellation_date = now();
        } elseif ($action == 'activate') {
            $suscription->status = "active";
            $suscription->cancellation_date = null;
        }

        // Guardar los cambios en la base de datos
        $suscription->save();

        // Redirigir de vuelta a la página anterior
        return redirect()->back();
    }

    public function needed(Request $request)
    {

        return view('Account.suscriptionNeeded', [
            'user' => $request->user(),
        ]);
    }
}
