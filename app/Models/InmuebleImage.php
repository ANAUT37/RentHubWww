<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InmuebleImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'url_image',
        'label',
        'file_type',
        'size',
        'inmueble_id',
        'created_at',
        'updated_at'
    ];

    protected $table = 'inmueble_images';

    public static function getImageFromUrl($id)
    {
        if (empty($id)) {
            return 'https://media.renthub.es/img/profile/default.jpg';
        }

        $url = "https://media.renthub.es/v1/anuncio/{$id}";

        $response = file_get_contents($url);

        if (!$response) {
            return 'https://media.renthub.es/img/profile/default.jpg';
        }

        $responseData = json_decode($response, true);
        if (!isset($responseData) || !isset($responseData['ruta'])) {
            return 'https://media.renthub.es/img/profile/default.jpg';
        }
        return 'https://media.renthub.es/' . $responseData['ruta'];
    }

    public static function saveImage($imageContent, $id) {
        $tempFile = tempnam(sys_get_temp_dir(), 'image');
        file_put_contents($tempFile, $imageContent);
    
        $url = 'https://media.renthub.es/v1/anuncio/'.$id.'/upload';
    
        $curl = curl_init($url);
    
        $postFields = array(
            'archivo' => curl_file_create($tempFile, 'image/jpeg', 'image.jpg')
        );
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $postFields);
        
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        
        $response = curl_exec($curl);
        
        if ($response === false) {
            $error_message = curl_error($curl);
        }
        
        curl_close($curl);
        
        unlink($tempFile);
        
        return $response;
    }


    
    
    
}
