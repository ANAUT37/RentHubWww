<?php

namespace App\Models;

use App\Mail\onTransactionComplete;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Mail;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'user_id',
        'amount',
        'currency',
        'payment_method_id',
        'payment_status',
        'description',
        'billing_details',
        'customer_email',
        'save_card',
        'metadata',
    ];

    protected $table = 'transactions';

    public static function encryptValue($value){
        try {
            return Crypt::encrypt($value);
        } catch (DecryptException $e) {
            return null;
        }
    }

    public static function decryptValue($value){
         try {
            return Crypt::decrypt($value);
        } catch (DecryptException $e) {
            return 'error';
        }
    }
    public static function create(Transaction $transaction){
        $name=Particular::getParticularName($transaction->user_id);

        Mail::to($transaction->customer_email)->send(new onTransactionComplete($name, $transaction));
    }
}
