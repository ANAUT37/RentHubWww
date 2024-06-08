<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inmueble extends Model
{
    use HasFactory;

    
    protected $fillable=[
        'id',
        'display_id',
        'latitude',
        'longitude',
        'address',
        'category',
        'user_id',
        'created_at',
        'updated_at'
    ];

    protected $table = 'inmuebles';

    public static function getById($id){
        $data = Inmueble::where('id',$id)->first();
        return $data;
    }
    public static function getByDisplayId($display_id){
        $data = Inmueble::where('display_id',$display_id)->first();
        return $data;
    }
    public static function getSearchInmuebles($category, $longitude, $latitude, $distance){
        $inmuebles = Inmueble::whereBetween('longitude', [($longitude - $distance), ($longitude + $distance)])
        ->whereBetween('latitude', [($latitude - $distance), ($latitude + $distance)])
        ->where('category',$category)
        ->get();        
        return $inmuebles;
    }
}
