<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Encryption\DecryptException;

class BankAccount extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'user_id',
        'holder_name',
        'number',
        'type',
        'bank_name',
        'bank_code',
        'iban',
        'branch_address',
        'holder_address',
        'last_used',
        'created_at',
        'updated_at',
    ];

    protected $table = 'bank_account';

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
        $data = BankAccount::where('user_id', $user_id)->get();
        
        foreach ($data as $card) {
            $card->holder_name = BankAccount::decryptValue($card->holder_name);
            $card->number = BankAccount::decryptValue($card->number);
            $card->type = BankAccount::decryptValue($card->type);
            $card->bank_name = BankAccount::decryptValue($card->bank_name);
            $card->bank_code = BankAccount::decryptValue($card->bank_code);
            $card->iban = BankAccount::decryptValue($card->iban);
            $card->branch_address = BankAccount::decryptValue($card->branch_address);
            $card->holder_address = BankAccount::decryptValue($card->holder_address);

        }
    
        return $data;
    }
}
