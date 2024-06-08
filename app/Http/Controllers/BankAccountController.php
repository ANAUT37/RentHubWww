<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\BankAccount;

class BankAccountController extends Controller
{
    public function saveBankAccount(Request $request)
    {
        $model = new BankAccount();
        $model->user_id=Auth::user()->id;
        $model->holder_name=BankAccount::encryptValue($request->input('accountHolderName'));
        $model->number=BankAccount::encryptValue($request->input('accountNumber'));
        $model->type=BankAccount::encryptValue($request->input('accountType'));
        $model->bank_name=BankAccount::encryptValue($request->input('bankName'));
        $model->bank_code=BankAccount::encryptValue($request->input('bankCode'));
        $model->iban=BankAccount::encryptValue($request->input('iban'));
        $model->branch_address=BankAccount::encryptValue($request->input('branchAddress'));
        $model->holder_address=BankAccount::encryptValue($request->input('accountHolderAddress'));
        $model->save();

        return redirect()->back()->with('success', 'La cuenta bancaria se ha guardado correctamente.');
    }
}
