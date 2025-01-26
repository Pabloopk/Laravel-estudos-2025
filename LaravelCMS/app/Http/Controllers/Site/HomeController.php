<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //Fazendo os controladores

    public function index()
    {
        return view('site.home');
    }
}
