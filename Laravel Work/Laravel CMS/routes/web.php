<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', 'HomeController@index');

Auth::routes();

Route::get('/home', 'HomeController@index');

Route::get('/profile/{firstname}.{lastname}/{id}', 'ProfileController@index');

Route::post('/profile/status/create', 'ProfileController@createStatus');

Route::get('/profile/status/delete/{id}', 'ProfileController@deleteStatus');

Route::get('/profile/edit/{id}', 'ProfileController@editProfile');

Route::post('/profile/edit/{id}', 'ProfileController@postEditProfile');



Route::get('/posts', 'PostController@index');

Route::get('/post/{id}', 'HomeController@getPost');

Route::get('/posts/create', 'PostController@createPost');

Route::post('/posts/add', 'PostController@addPost');

Route::get('/posts/delete/{id}', 'PostController@deletePost');

Route::get('/posts/edit/{id}', 'PostController@editPost');

Route::post('/posts/edit/{id}', 'PostController@postEditPost');



Route::get('/admin', 'AdminController@index');

Route::get('/admin/user/create', 'AdminController@createUser');

Route::post('/admin/user/add', 'AdminController@addUser');

Route::get('/admin/user/delete/{id}', 'AdminController@deleteUser');

Route::get('/admin/user/edit/{id}', 'AdminController@editUser');

Route::post('/admin/user/edit/{id}', 'AdminController@postEditUser');
