<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favourite extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'user_id',
        'anuncio_id',
        'created_at',
        'updated_at'
    ];

    protected $table = 'favourite';

    public static function getUserFav($userId)
    {
        $data = Favourite::where('user_id', $userId)
            ->orderBy('created_at', 'desc') 
            ->get();
        return $data;
    }
    public static function saveFav($anuncio_id, $userId)
    {
        $model = new Favourite();
        $model->user_id = $userId;
        $model->anuncio_id = $anuncio_id;
        $model->save();
    }
    public static function isAnuncioFav($anuncio_id, $userId){
        $data = Favourite::where('user_id', $userId)
                         ->where('anuncio_id', $anuncio_id)
                         ->first();
        return $data ? 1 : 0;
    }
    
}
