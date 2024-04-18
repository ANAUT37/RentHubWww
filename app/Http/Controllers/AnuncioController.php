<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AnuncioController extends Controller
{
    public function new(){
        return view('Anuncio.new');
    }
    public function index(Request $request){
        return view('Anuncio.index', [
            'user' => $request->user(),
            'anuncio_id'=>$request->anuncio_id
        ]);
    }
}
