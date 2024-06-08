<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\History;
use Illuminate\Support\Facades\Auth;

class HistoryController extends Controller
{
    public function save(Request $request){
        $data = $request->all();
        History::saveSearch($data['address'], $data['category'], Auth::user()->id);
        
    }
    public function get($user_id){
        $data = History::getUserHistory($user_id);
        return response()->json($data);
    }
    public static function getUserHistory($user_id){
        $data = History::getUserHistory($user_id);
        return $data;
    }

    public static function getAnunciosFromHistory($user_id){
        $userHistory = History::getUserHistory($user_id);


    }
}
