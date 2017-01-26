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

Route::get('/','AuthController@login');
Route::get('/login','AuthController@login');
Route::post('/dologin','AuthController@dologin');
Route::get('/logout','AuthController@logout');

Route::group(['middleware'=>['auth']],function()
{
    Route::get('/home','HomeController@index');
    Route::get('/profile','HomeController@profile');
});