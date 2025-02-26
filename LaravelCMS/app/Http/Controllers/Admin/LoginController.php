<?php

namespace App\Http\Controllers\Admin\Auth;

use Illuminate\Auth\Authenticatable;
use Illuminate\Routing\Controller as BaseController;


class LoginController extends BaseController
{
    //
    use Authenticatable;
    protected $redirectTo = '/painel';
    public function __construct() {
        $this->middleware('guest')->except('logout');
    }
    public function index() {
        return view('admin.login');
    }
}
