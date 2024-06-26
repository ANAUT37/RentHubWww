<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Particular extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'name',
        'surname',
        'plan',
        'birthdate',
        'genre',
        'verified',
        'description',
        'job',
        'lenguage',
        'location'  
    ];
        /**
     * El nombre de la tabla asociada con el modelo.
     *
     * @var string
     */
    protected $table = 'users_particular';

    public static function getParticularData($userId)
    {   
        $data=Particular::where('user_id', $userId)->first();
        return $data;;
    }

    public static function getParticularName($userId){
        $name = Particular::where('user_id', $userId)->value('name');
        return ucfirst($name);
    }
}
