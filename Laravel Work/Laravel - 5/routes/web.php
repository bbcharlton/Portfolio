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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/lists/{id}', function () {
    return view('lists');
});

Route::get('/create', function () {
    return view('create');
});

Route::post('/create', function () {
    return redirect('/');
});