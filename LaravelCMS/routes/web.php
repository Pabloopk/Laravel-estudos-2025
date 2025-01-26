<?php

use Illuminate\Support\Facades\Route;

Route::get('/', action: 'Site\HomeController@index');


Route::prefix('painel')->group(function () {
    Route::get('/', 'Admin\HomeController@index');
});

