<?php

namespace App\Http\Controllers\Search;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ResultController extends Controller
{
    public function index($category, $location, Request $request){
        return view('Search.index',  compact('category', 'location'));
     }
}
