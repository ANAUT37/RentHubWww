<?php

namespace App\Http\Controllers;

use App\Events\MessageSent; // Importa la clase de evento
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Disparar el evento cuando sea necesario
        event(new MessageSent('Este es un mensaje de prueba'));

        return view('Home.index');
    }
}
