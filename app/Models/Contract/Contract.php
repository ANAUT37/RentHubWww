<?php

namespace App\Models\Contract;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Contract\ContractParticipant;

class Contract extends Model
{
    use HasFactory;

    protected $table="contracts";

    protected $fillable = [
        'id',
        'display_id',
        'category',
        'display_name',
        'chat_id',
        'bank_account_id',
        'document_id',
        'inmueble_id',
        'start_date',
        'end_date',
        'price',
        'bail',
        'rules',
        'payment_frequency',
    ];

    public static function getByDisplayId($display_id){
        $data=Contract::where('display_id',$display_id)->first();
        return $data;
    }

    public static function getUserContracts($user_id) {
        $userContracts = ContractParticipant::where('user_id', $user_id)->get();
        $contractIds = $userContracts->pluck('contract_id');  // Obtiene una colección de los contract_id
    
        $contracts = Contract::whereIn('id', $contractIds)->get();  // Obtiene todos los contratos en una sola consulta
    
        return $contracts;
    }

    public static function getById($id){
        $data=Contract::where('id',$id)->first();
        return $data;
    }
    public static function getInactiveContracts($user_id){
        $userContracts = ContractParticipant::where('user_id', $user_id)->get();
        $contractIds = $userContracts->pluck('contract_id');  // Obtiene una colección de los contract_id
    
        $contracts = Contract::whereIn('id', $contractIds)->where('status',0)->get();  // Obtiene todos los contratos en una sola consulta

        return $contracts;
    }
    
    
}
