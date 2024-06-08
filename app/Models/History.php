<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    use HasFactory;

    protected $fillable=[
        'id',
        'user_id',
        'address',
        'category',
        'created_at',
        'updated_at'
    ];

    protected $table = 'history';

    public static function getUserHistory($userId){
        $data = History::where('user_id', $userId)
                        ->orderBy('created_at', 'desc') // Ordenar por created_at de forma descendente
                        ->get();
        return $data;
    }    
    public static function saveSearch($address, $category, $userId) {
        $existingSearch = History::where('address', $address)
                                    ->where('user_id', $userId)
                                    ->where('category',$category)
                                    ->first();
        if (!$existingSearch) {
            $newSearch = new History();
            $newSearch->address = $address;
            $newSearch->category = $category;
            $newSearch->user_id = $userId;
            $newSearch->save();
        }
    }
    
}
