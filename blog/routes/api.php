<?php

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/auth/signup', function (Request $request) {
}); //->middleware('guest');

Route::post('/auth/signin', function (Request $request){
});


Route::post('/auth/validate', function (Request $request) {

})->middleware('auth:sanctum');
