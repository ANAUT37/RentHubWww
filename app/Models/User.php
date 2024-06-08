<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

   /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */ 
    protected $fillable = [
        'id',
        'display_id',
        'email',
        'password',
        'type',
        'phone',
        'phone_code',
        'second_mail',
        'country_code',
        'profile_pic_url',
        'profile_banner_url',
        'last_login',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    public static function getDataByDisplayId($displayId){
        $data = User::where('display_id', $displayId)->first();
        return $data;
    }
    public static function getDataById($id){
        $data = User::where('id', $id)->first();
        return $data;
    }
    public static function getTypedData($type,$id){
        if($type===0){
            $data=Particular::getParticularData($id);
            return $data;
        }else{
            return null;
        }   
    }
    public static function getDisplayId($userId){
        $displayId = User::where('id', $userId)->value('display_id');
        return $displayId;
    }
    public static function getIdByEmail($email){
        $id = User::where('email', $email)->value('id');
        return $id;
    }
    public static function getProfilePic($userPic){
        if(empty($userPic)){
            return 'https://media.renthub.es/img/profile/default.jpg';
        }
        
        //$url = "https://media.renthub.es/v1/profile/661c4a8d2b5c2";

        $url = "https://media.renthub.es/v1/profile/{$userPic}";
        try{
        // Enviar la solicitud GET a la URL
        $response = file_get_contents($url);
    
        // Si la respuesta es nula o vacía, devuelve la URL predeterminada
        if (!$response) {
            return 'https://media.renthub.es/img/profile/default.jpg';
        }
    
        // Intenta decodificar la respuesta JSON
        $responseData = json_decode($response, true);
    
        // Si no se puede decodificar o falta la URL en la respuesta, devuelve la URL predeterminada
        if (!isset($responseData) || !isset($responseData['ruta'])) {
            return 'https://media.renthub.es/img/profile/default.jpg';
        }
        }catch(Exception $e){
            return 'https://media.renthub.es/img/profile/default.jpg';
        }

    
        // Devuelve la URL obtenida de la respuesta
        return 'https://media.renthub.es/' . $responseData['ruta'];
    }
    
     
    public function sessions()
    {
        return $this->hasMany(Session::class);
    }
}
