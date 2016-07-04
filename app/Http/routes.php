<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

//Route::resource('user', 'UserController');
//Route::resource('user', 'UserController',['only' => ['index', 'store', 'update', 'destroy', 'show']]);

//Versionando una API - Version 1
Route::group(['prefix' => 'v1'], function () {
    Route::resource('user', 'UserController',
                    ['only' => ['index', 'store', 'update', 'destroy', 'show']]);
});

//Versionando una API - Version 2 - lista de nombres de usuarios
Route::group(['prefix' => 'v2'], function () {
    Route::resource('user', 'UserController',
                    ['only' => ['index', 'store', 'update', 'destroy', 'show']]);
    Route::get('users/names', 'UserController@names');
});
