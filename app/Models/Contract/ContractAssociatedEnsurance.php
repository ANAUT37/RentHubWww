<?php

namespace App\Models\Contract;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContractAssociatedEnsurance extends Model
{
    use HasFactory;

    protected $table = 'contract_associated_insurances';

    protected $fillable = [
        'id',
        'contract_id',
        'type',
        'company_name',
        'policy_number',
        'start_ensurence_date',
        'end_ensurence_date',
        'description',
        'insured_amount',
        'insurance_cost',
        'contact_information',
    ];

    public static function getContractEnsurances($contract_id){
        $data=ContractAssociatedEnsurance::where('contract_id',$contract_id)->get();
        return $data;
    }
    
}
