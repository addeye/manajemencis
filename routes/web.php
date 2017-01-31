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
    /*For Provinsi*/
    Route::get('/provinces','ProvincesController@getAll');
    Route::get('/provinces/{province_id}','ProvincesController@getRegenciesByProvinces');

    /*For Kabupaten Kota*/
    Route::get('/regencies','RegenciesController@getAll');

    /*For Kecamatan*/
    Route::get('/districts','DistrictsController@getAll');

    /*For Kelurahan*/
    Route::get('/villages','VillagesController@getAll');

    /*For Bidang Layanan */ 
    Route::get('/bidanglayanan','BidangLayananController@getAll');

    /* Jenis Layanan */ 
    Route::get('/jenislayanan','JenisLayananController@getAll');

    /* View Bidang Usaha*/
    Route::get('/bidangusaha','BidangUsahaController@getAll');

});