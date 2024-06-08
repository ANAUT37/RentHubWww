<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Doc;

class DocParticipant extends Model
{
    use HasFactory;

    protected $fillable=[
        'id',
        'display_id',
        'user_id',
        'title',
        'content',
        'created_at',
        'updated_at',
    ];

        /**
     * El nombre de la tabla asociada con el modelo.
     *
     * @var string
    */
    protected $table = 'document_participants'; 

    public static function getUserDocs($userId)
    {
        $results = DocParticipant::where('user_id', $userId)->get();
        
        return $results;
    }
    public static function getDocParticipants($documentId){
        $results = DocParticipant::where('document_id', $documentId)->get();
        return $results;
    }

    public static function isUserAbled($documentId, $userId)
    {
        $document = DocParticipant::where('document_id', $documentId)
                       ->where('user_id', $userId)
                       ->first();
        
        if ($document && $document->owner === 1) {
            return 2;//ES EL PROPIETARIO DEL DOCUMENTO, PUEDE EDITAR, PUEDE VER
        }else if($document && $document->editable===1&&$document->owner === 0){
            return 3;//NO ES PROPIETARIO, PUEDE EDITAR, PUEDE VER
        }else if($document && $document->editable===0&&$document->owner === 0){
            return 4;//NO ES PROPIETARIO, NO PUEDE EDITAR, PUEDE VER
        }else {
            return 0;//NO ESTA AUTORIZADO PARA VER EL DOCUMENTO
        }
    }
    public static function formatDocRole($owner, $editable){
        if($owner===1){
            return 'Propietario';
        }else if($owner===0&&$editable===1){
            return 'Editor';
        }else{
            return 'Lector';
        }
    }
    public static function deleteParticipant($user_id,$documentId){
        
    }
}
