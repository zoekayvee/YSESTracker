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

Route::get('/', 'HomeController@index'); 
Route::get('/profile', 'ProfileController@showMyCommittee');
Route::get('/oah', 'OAHController@showOAH');
Route::get('/heads', 'HeadsController@showHeads');

Route::get('users', 'UserController@get');
Route::get('users/create', 'UserController@create');
Route::post('users', 'UserController@register');