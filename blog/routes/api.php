<?php

use App\Http\Controllers\AuthController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('auth')->group(function () {

Route::post('/signup',[AuthController::class, 'signup']); //->middleware('guest');

Route::post('/signin', [AuthController::class, 'signup']);

Route::post('/validate', [AuthController::class, 'validate'])->middleware('auth:sanctum');
});
