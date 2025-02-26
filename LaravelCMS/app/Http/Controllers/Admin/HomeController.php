<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    public function __construct() {
        $this->middleware('auth');
    }
    public function index() {
        return view('admin.home');
    }
}
