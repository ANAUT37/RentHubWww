<?php

namespace App\Http\Controllers;

use App\Models\Anuncio;
use Illuminate\Http\Request;
use App\Models\Favourite;
use Illuminate\Support\Facades\Auth;

class FavouriteController extends Controller
{
    public function favs(Request $request)
    {
        $listUserFavs = Favourite::getUserFav(Auth::user()->id);
        $listFavedAnuncios = [];
        if(count($listUserFavs) > 0){
            foreach($listUserFavs as $fav){
                $model = Anuncio::where('id', $fav->anuncio_id)->first();
                if($model){
                    array_push($listFavedAnuncios, $model);
                }
            }
        }
        return view('Search.favs', [
            'listFavedAnuncios' => $listFavedAnuncios,
            'listUserFavs' => $listUserFavs
        ]);
    }
    
    public function get($user_id)
    {
        $data = Favourite::getUserFav($user_id);
        return response()->json($data);
    }

    public static function getUserFav($user_id){
        $faved=Favourite::getUserFav($user_id);
        $favedAnunciosData=[];
        foreach($faved as $item){
            array_push($favedAnunciosData,Anuncio::getById($item->anuncio_id));
        }

        return $favedAnunciosData;
    }

    public static function isAnuncioFav($anuncio_id)
    {
        $data = Favourite::isAnuncioFav($anuncio_id, Auth::user()->id);
        return $data;
    }
    public static function toggleFav(Request $request, $anuncio_id)
    {
        $user_id = Auth::user()->id;
        $isFaved = $request->input('isFaved');
        $existingFav = Favourite::where('user_id', $user_id)
            ->where('anuncio_id', $anuncio_id)
            ->first();

        if ($isFaved == 1) {
            if (!$existingFav) {
                $favourite = new Favourite();
                $favourite->user_id = $user_id;
                $favourite->anuncio_id = $anuncio_id;
                $favourite->save();
            }
        } else {
            if ($existingFav) {
                $existingFav->delete();
            }
        }
        return response()->json(['success' => true]);
    }
}
