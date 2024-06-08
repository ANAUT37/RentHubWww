<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Anuncio;
use App\Models\Inmueble;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class ManagementController extends Controller
{
    public function index(Request $request)
    {
        return view('Management.index', [
            'user' => $request->user(),
        ]);
    }
    public function anuncios(Request $request)
    {   

        $userAnunciosList=Anuncio::getUserAnuncios(Auth::user()->id);

        return view('Management.anuncios', [
            'user' => $request->user(),
            'userAnunciosList'=>$userAnunciosList
        ]);
    }
}
