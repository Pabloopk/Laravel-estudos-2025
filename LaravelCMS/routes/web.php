<?php

use Illuminate\Support\Facades\Route;


Route::get('/', 'App\Http\Controllers\Site\HomeController@index');

Route::prefix('painel')-> group(function()
{
    Route::get('/', 'App\Http\Controllers\Admin\HomeController@index')->name('admin');
});

