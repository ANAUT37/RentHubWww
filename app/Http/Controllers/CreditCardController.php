<?php

namespace App\Http\Controllers;

use App\Models\BankAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\CreditCard;

class CreditCardController extends Controller
{
    public function wallet(Request $request)
    {
        $action = $request->query('action', null);
        $item = $request->query('item', null);
        $bankAccountData = BankAccount::getUserWalletData(Auth::user()->id);
    
        return view('Account.wallet', [
            'user' => $request->user(),
            'bankAccountData' => $bankAccountData,
            'action' => $action,
            'item' => $item
        ]);
    }
    
    public function saveCreditCard(Request $request)
    {
        $model = new CreditCard();
        $model->user_id = Auth::user()->id;
        $model->full_name = CreditCard::encryptValue($request->input('nombre-titular'));
        $fullNumber = $request->input('cardNumer1') .
            $request->input('cardNumer2') .
            $request->input('cardNumer3') .
            $request->input('cardNumer4');
        $model->number = CreditCard::encryptValue($fullNumber);
        $model->expiration_month = CreditCard::encryptValue($request->input('expirationMonth'));
        $model->expiration_year = CreditCard::encryptValue($request->input('expirationYear'));
        $model->cvv = CreditCard::encryptValue($request->input('cvv'));
        $model->save();

        return redirect()->back()->with('success', 'La tarjeta se ha guardado correctamente.');
    }
}
