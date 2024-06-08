<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;
use App\Models\Inmueble;
use App\Models\InmuebleImage;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class InmuebleController extends Controller
{

    public function index(Request $request, $display_id){
        $inmuebleData=Inmueble::getByDisplayId($display_id);
        $inmuebleAttributes=Categoria::getInmuebleCaracteristicas($inmuebleData->id);
        $inmuebleImages = InmuebleImage::where('inmueble_id', $inmuebleData->id)->get();
        $owner=User::getDataById($inmuebleData->user_id);

        return view('Anuncio.inmueble_index', [
            'inmuebleData' => $inmuebleData,
            'inmuebleAttributes'=>$inmuebleAttributes,
            'listOfImages'=>$inmuebleImages,
            'owner'=>$owner
        ]);
    }

   public static function getUserInmuebles(){
        $data=Inmueble::where('user_id',Auth::user()->id)->get();
        return $data;
   }
   public static function getInmuebleImages($inmueble_id){
      $data = InmuebleImage::where('inmueble_id',$inmueble_id)->get();
      return $data;
   }
   public function getData(Request $request, $inmueble_id)
   {
       $inmueble = Inmueble::find($inmueble_id);
       $inmuebleImages = InmuebleImage::where('inmueble_id', $inmueble_id)->get();
       $inmuebleImagesUrls=[];
       $inmuebleAttributes=Categoria::getInmuebleCaracteristicas($inmueble_id);
       foreach($inmuebleImages as $imagen){
            $url=InmuebleImage::getImageFromUrl($imagen->url_image);
            array_push($inmuebleImagesUrls,$url);
       }
   
       if (!$inmueble) {
           return response()->json(['error' => 'Inmueble no encontrado'], 404);
       }
   
       return response()->json([
           'inmueble' => $inmueble,
           'inmuebleImagesUrls' => $inmuebleImagesUrls,
           'inmuebleAttributes'=>$inmuebleAttributes
       ]);
   }
   
   
}
