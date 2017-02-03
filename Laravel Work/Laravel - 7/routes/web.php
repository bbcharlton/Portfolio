<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'UserController@create');

Route::post('/users', 'UserController@store');

Route::resource('posts', 'PostController', ['except' => ['destroy']]);

Route::get('/posts/{id}/destroy', 'PostController@destroy');

Route::post('/comments', 'CommentController@store');