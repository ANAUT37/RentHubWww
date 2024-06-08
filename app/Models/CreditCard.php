<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;

class CreditCard extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'user_id',
        'number',
        'expiration_month',
        'expiration_year',
        'cvv',
        'full_name',
        'last_used',
        'created_at',
        'updated_at',
    ];

    protected $table = 'credit_cards';

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
    public static function getUserWalletData($user_id){
        $data = CreditCard::where('user_id', $user_id)->get();
        
        foreach ($data as $card) {
            $card->full_name = CreditCard::decryptValue($card->full_name);
            $card->number = CreditCard::decryptValue($card->number);
            $card->expiration_month = CreditCard::decryptValue($card->expiration_month);
            $card->expiration_year = CreditCard::decryptValue($card->expiration_year);
            $card->cvv = CreditCard::decryptValue($card->cvv);
        }
    
        return $data;
    }
    
}
