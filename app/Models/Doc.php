<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doc extends Model
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
    protected $table = 'documents'; 

    public static function getAll($userId)
    {
        $results = Doc::where('user_id', $userId)->get();
        
        return $results;
    }
    public static function getById($display_id){
        $results = Doc::where('display_id', $display_id)->first();

        return $results;
    }
    public static function deleteByDisplayId($display_id)
    {
        $document = Doc::where('display_id', $display_id)->first();

        if ($document) {
            $document->delete();
        }
    }
    public static function getIdByDisplayId($display_id)
    {
        $document = Doc::where('display_id', $display_id)->first();
        
        return $document->id;
    }
    public static function saveTextContent($displayId,$content){
        Doc::where('display_id', $displayId)
        ->update(['content' => $content]);
    }
    
}
