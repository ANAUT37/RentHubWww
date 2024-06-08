<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Suscription extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'plan_id',
        'start_date',
        'end_date',
        'status',
        'subscription_type',
        'renewal_date',
        'payment_method',
        'transaction_id',
        'cancellation_date',
        'trial_end_date',
        'notes',
        'payment_method_id',
        'customer_id',
        'customer_email'
    ];

    protected $table = "suscriptions";


    public static function getUserData($user_id)
    {
        $data = Suscription::where('user_id', $user_id)->first();
        return $data;
    }

    public static function setPremium()
    {   


    }

    public static function getSuscriptionPaymentCard($card_id)
    {   

        $card=null;
        if($card_id!=null){
            $data = CreditCard::where('id', $card_id)->first();

            $card = new CreditCard();
            $card->full_name = CreditCard::decryptValue($data->full_name);
            $card->number = CreditCard::decryptValue($data->number);
            $card->expiration_month = CreditCard::decryptValue($data->expiration_month);
            $card->expiration_year = CreditCard::decryptValue($data->expiration_year);
            $card->cvv = CreditCard::decryptValue($data->cvv);
            
        }


        return $card;
    }
}
