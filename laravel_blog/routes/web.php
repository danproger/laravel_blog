<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});

Route::get('/blog', 'BlogController@index');
Route::get('/blog/about', 'BlogController@about');

Route::resource('articles', 'ArticlesController');

Auth::routes();

Route::get('/user', 'UserController@index');

Route::post('articles/{id}/comment', 'ArticlesController@comment');
Route::get('articles/{id}/delete_comment', 'ArticlesController@delete_comment');
