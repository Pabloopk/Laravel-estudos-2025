<?php

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('auth/signup', function (Request $request) {
    // Handle user registration logic here
    // For example, validate the request and create a new user
   // return response()->json(['message' => 'User registered successfully'], 201);
   $request->validate([
         'name' => 'required|string|max:255',
         'email' => 'required|string|email|max:255|unique:users',
         'password' => 'required|string|min:8|confirmed',
    ]);
   $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
    ]);

    $returnData= [];
    $returnData['user'] = $user
    $returnData['token'] = $user->createToken('auth_token')->plainTextToken;
}); //->middleware('guest');
