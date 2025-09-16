<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('auth')->group(function () {

Route::post('/signup',[AuthController::class, 'signup']); //->middleware('guest');

Route::post('/signin', [AuthController::class, 'signup']);

Route::post('/validate', [AuthController::class, 'validate'])->middleware('auth:sanctum');
});

//rotas publicas
Route::get('/posts', [PostController::class, 'getPosts']);
Route::get('/posts/{slug}', [PostController::class, 'getPost']);
//posts relacionados

Route::get('/posts/{slug}/related', [PostController::class, 'getRelatedPosts']);

//rotas privadas

Route::prefix('admin')->middleware('auth:sanctum')->group(function () {
    Route::get('/posts', [AdminController::class, 'getPosts']);
    Route::get('/posts/{slug}', [AdminController::class, 'getPost']);
    Route::delete('/posts/{slug}', [AdminController::class, 'deletePost']);
    Route::post('/posts', [AdminController::class, 'createPost']);
    Route::put('/posts/{slug}', [AdminController::class, 'updatePost']);

});
