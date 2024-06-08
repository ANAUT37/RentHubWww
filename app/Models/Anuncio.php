<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anuncio extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'display_id',
        'user_id',
        'inmueble_id',
        'title',
        'description',
        'price',
        'visibility',
        'created_at',
        'updated_at'
    ];

    protected $table = 'anuncios';

    public static function getById($id){
        $data = Anuncio::where('id', $id)->first();
        return $data;
    }

    public static function getByDisplayId($display_id)
    {
        $data = Anuncio::where('display_id', $display_id)->first();
        return $data;
    }
    public static function getUserAnuncios($user_id)
    {
        $data = Anuncio::where('user_id', $user_id)->get();
        return $data;
    }
    public static function getByInmuebleId($inmueble_id, $price, $creation){
        // Descomponer el valor de $price
        $priceValues = explode('-', $price);
        $minPrice = $priceValues[0];
        $maxPrice = $priceValues[1];
    
        // Obtener la fecha límite basada en la opción de creación seleccionada
        switch ($creation) {
            case 'week':
                $creationDateLimit = now()->subDays(7);
                break;
            case 'month':
                $creationDateLimit = now()->subMonths(1);
                break;
            case 'year':
                $creationDateLimit = now()->subYears(1);
                break;
            case 'none':
            default:
                $creationDateLimit = null;
                break;
        }
    
        // Construir la consulta para obtener los anuncios
        $query = Anuncio::where('inmueble_id', $inmueble_id);
    
        // Aplicar filtro de precio si se proporciona
        if ($price != 'none-none') {
            $query->whereBetween('precio', [$minPrice, $maxPrice]);
        }
    
        // Aplicar filtro de fecha de creación si se proporciona
        if ($creationDateLimit) {
            $query->where('created_at', '>=', $creationDateLimit);
        }
    
        // Obtener los datos filtrados
        $data = $query->get();
    
        return $data;
    }
    
}
