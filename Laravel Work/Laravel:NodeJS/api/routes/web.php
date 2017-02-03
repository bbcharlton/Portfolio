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

//================================
//	Lists CRUD
//================================

Route::get('/lists', 'ListController@index');

Route::post('/lists', 'ListController@store');

Route::resource('/lists', 'ListController');


//================================
//	Items CRUD
//================================

Route::get('/items', 'ItemController@index');

Route::post('/items', 'ItemController@store');

Route::post('/edit/items/{id}', 'ItemController@update');

Route::resource('items', 'ItemController', ['except' => ['destroy']]);

Route::get('/items/{id}/destroy', 'ItemController@destroy');