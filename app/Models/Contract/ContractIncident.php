<?php

namespace App\Models\Contract;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContractIncident extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'contract_id',
        'type',
        'description',
        'reported_at',
        'reported_by',
        'status',
    ];

    public static function getTypeText($key)
    {
        $typeToText = [
            "maintenance_issue" => "Problema de Mantenimiento",
            "repair_request" => "Solicitud de Reparación",
            "noise_complaint" => "Queja por Ruido",
            "neighbor_dispute" => "Disputa con Vecino",
            "damage_report" => "Reporte de Daño",
            "utility_issue" => "Problema de Servicios Públicos",
            "security_concern" => "Preocupación por Seguridad",
            "pest_infestation" => "Infestación de Plagas",
            "lease_violation" => "Violación de Contrato",
            "other" => "Otro",
        ];

        return $typeToText[$key];
    }

    public static function getAllByContractId($contract_id)
    {
        $data = ContractIncident::where('contract_id', $contract_id)->get();
        return $data;
    }
}
