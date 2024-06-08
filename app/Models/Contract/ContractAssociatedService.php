<?php

namespace App\Models\Contract;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContractAssociatedService extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'contract_id',
        'type',
        'provider_name',
        'description',
        'service_cost',
        'start_ensurence_date',
        'end_ensurence_date',
        'service_frequency',
        'contact_information',
    ];
    
}
