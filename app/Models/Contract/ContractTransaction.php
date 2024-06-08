<?php

namespace App\Models\Contract;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContractTransaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'contract_id',
        'user_id',
        'receiver_id',
        'start_period',
        'end_period',
        'transaction_id',
        'amount',
        'currency',
        'payment_method_id',
        'payment_status',
        'description',
        'billing_details',
        'customer_email',
        'metadata',
    ];
    
}
