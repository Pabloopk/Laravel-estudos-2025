<?php

use App\Http\Controllers\AuthController;
// Importa o controlador `AuthController`, responsável por lidar com registro, login e logout de usuários.

use App\Http\Controllers\PostController;
// Importa o controlador `PostController`, responsável pelas operações CRUD (Create, Read, Update, Delete) para posts.

use Illuminate\Http\Request;
// Importa a classe `Request`, usada para manipular requisições HTTP.

use Illuminate\Support\Facades\Route;
// Importa a classe `Route`, usada para definir as rotas da aplicação.

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
// Define uma rota GET para `/user` que retorna os dados do usuário autenticado.
// Essa rota utiliza o middleware `auth:sanctum` para garantir que apenas usuários autenticados tenham acesso.

Route::apiResource('posts', PostController::class);
// Define rotas RESTful para o recurso `posts` (index, show, store, update, destroy).
// As rotas são vinculadas ao `PostController`, que gerencia as operações no modelo `Post`.

Route::post('/register', [AuthController::class, 'register']);
// Define uma rota POST para `/register` que chama o método `register` no `AuthController`.
// Essa rota é usada para registrar novos usuários.

Route::post('/login', [AuthController::class, 'login']);
// Define uma rota POST para `/login` que chama o método `login` no `AuthController`.
// Essa rota é usada para autenticar usuários e gerar tokens.

Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
// Define uma rota POST para `/logout` que chama o método `logout` no `AuthController`.
// Essa rota utiliza o middleware `auth:sanctum` para garantir que apenas usuários autenticados possam realizar o logout.
