<?php

namespace App\Models\Contract;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContractRequest extends Model
{
    use HasFactory;

    protected $table="contract_request";

    protected $fillable = [
        'id',
        'display_id',
        'sender_id',
        'receiver_id',
        'status',
        'contract_id',
        'created_at',
        'updated_at',
    ];

    public static function getByDisplayId($display_id){
        $data=ContractRequest::where('display_id',$display_id)->first();
        return $data;
    }
}
