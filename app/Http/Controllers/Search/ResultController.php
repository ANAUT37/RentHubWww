<?php

namespace App\Http\Controllers\Search;

use App\Http\Controllers\Controller;
use App\Http\Controllers\FollowedSearchController;
use App\Models\Anuncio;
use App\Models\FollowedSearch;
use App\Models\Inmueble;
use App\Models\History;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ResultController extends Controller
{
   public function index($category, $location, Request $request)
   {
      $isFollowed=0;
      if(Auth::check()){
         $isFollowed=FollowedSearchController::isSearchFollowed(Auth::user()->id,$category,$location);
      }
      return view('Search.index',[
         'category'=>$category,
         'location'=>$location,
         'isFollowed'=>$isFollowed
      ]);
   }
   public function perform($category, $longitude, $latitude, $distance,$price="none-none",$creation="none")
   {
      $inmuebles = Inmueble::getSearchInmuebles($category, $longitude, $latitude, $distance);
      $anuncios=[];
      if(count($inmuebles)>0){
         foreach($inmuebles as $inmueble){
            $anuncio=Anuncio::getByInmuebleId($inmueble->id,$price,$creation);
            if($anuncio!=null){
               array_push($anuncios,$anuncio);
            }
         }
      }
      return response()->json($anuncios);                     
   }
   public function recent(Request $request)
   {
      $historyList = History::getUserHistory(Auth::user()->id);
      $followedList = FollowedSearch::getUserFollowed(Auth::user()->id);
      return view('Search.recent',
      [
         'historyList'=>$historyList,
         'followedList'=>$followedList,
      ]);
   }

}
