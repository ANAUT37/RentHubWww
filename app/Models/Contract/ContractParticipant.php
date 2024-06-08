<?php

namespace App\Models\Contract;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContractParticipant extends Model
{
    use HasFactory;

    protected $table = 'contract_participants';

    protected $fillable = [
        'id',
        'role',
        'user_id',
        'contract_id',
        'status',
        'credit_card_id',
    ];

    public static function getParticipantsById($contract_id){
        $data=ContractParticipant::where('contract_id',$contract_id)->get();
        return $data;
    }
    public static function isUserAllowedToSee($contract_id,$user_id){
        $data=ContractParticipant::where('contract_id',$contract_id)->where('user_id',$user_id)->get();
        if($data){
            return true;
        }else{
            return false;
        }
    }
    public static function getContractOnnwer($contract_id){
        $data=ContractParticipant::where('contract_id',$contract_id)->where('role','owner')->first();
        return $data;
    }
    
}
