<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response;



class SecurePin extends Model
{
    use HasFactory;

        /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'pin',
    ];
        /**
     * El nombre de la tabla asociada con el modelo.
     *
     * @var string
     */
    protected $table = 'user_secure_pin';

    public function setPinAttribute($value)
    {
        $this->attributes['pin'] = bcrypt($value);
    }

    public static function encryptPin($value){
        return bcrypt($value);
    }
    public static function isPinActivated($user_id){
        return SecurePin::where('user_id', $user_id)->exists();
    }
    public static function checkPin($value){
        $encPin=SecurePin::encryptPin($value);
        $userPin=SecurePin::where('user_id', Auth::user()->id)->value('pin');
        if($encPin===$userPin){
            return true;
        }else{
            return false;
        }
    }
    public static function activatePinCookie(){
        $cookie = cookie('secure_pin', true, 60);
        return response()->cookie($cookie);
    }

}
