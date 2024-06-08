<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Models\Suscription;
use Illuminate\Http\Request;
use App\Models\CreditCard;
use Illuminate\Support\Facades\Auth;

class AccountOptionsController extends Controller
{
    public function info(Request $request)
    {
        return view('Account.info', [
            'user' => $request->user(),
        ]);
    }
    public function payments(Request $request)
    {
        return view('Account.payments', [
            'user' => $request->user(),
        ]);
    }
    public function history(Request $request)
    {
        return view('Account.history', [
            'user' => $request->user(),
        ]);
    }
    public function paymethods(Request $request)
    {
        return view('Account.history', [
            'user' => $request->user(),
        ]);
    }
    public function payout(Request $request)
    {
        return view('Account.history', [
            'user' => $request->user(),
        ]);
    }

    public function security(Request $request)
    {
        return view('Account.security', [
            'user' => $request->user(),
        ]);
    }
    public function plan(Request $request)
    {
        $userSuscriptionData=Suscription::getUserData(Auth::user()->id);
        $dataWallet = Suscription::getSuscriptionPaymentCard($userSuscriptionData->credit_card_id);

        return view('Account.plan', [
            'user' => $request->user(),
            'userSuscriptionData'=>$userSuscriptionData,
            'dataWallet'=>$dataWallet
        ]);
    }
}
