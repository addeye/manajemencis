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
    Route::get('/provinces/create','ProvincesController@addData');
    Route::post('/provinces','ProvincesController@doAddData');
    Route::get('/provinces/{id}','ProvincesController@editData');
    Route::put('/provinces/{id}/update','ProvincesController@doEditData');
    Route::get('/provinces/{id}/delete','ProvincesController@deleteData');

    /*For Kabupaten Kota*/
    Route::get('/regencies','RegenciesController@getAll');
    Route::get('/regencies/create','RegenciesController@addData');
    Route::post('/regencies','RegenciesController@doAddData');
    Route::get('/regencies/{id}','RegenciesController@editData');
    Route::put('/regencies/{id}/update','RegenciesController@doEditData');
    Route::get('/regencies/{id}/delete','RegenciesController@deleteData');

    /*For Kecamatan*/
    Route::get('/districts','DistrictsController@getAll');

    /*For Kelurahan*/
    Route::get('/villages','VillagesController@getAll');

    /*For Bidang Layanan */ 
    Route::get('/bidanglayanan','BidangLayananController@getAll');
    Route::get('/bidanglayanan/create','BidangLayananController@addData');
    Route::post('/bidanglayanan','BidangLayananController@doAddData');
    Route::get('/bidanglayanan/{id}','BidangLayananController@editData');
    Route::put('/bidanglayanan/{id}/update','BidangLayananController@doEditData');
    Route::get('/bidanglayanan/{id}/delete','BidangLayananController@deleteData');

    /* Jenis Layanan */
    Route::get('/jenislayanan','JenisLayananController@getAll');
    Route::get('/jenislayanan/create','JenisLayananController@addData');
    Route::post('/jenislayanan','JenisLayananController@doAddData');
    Route::get('/jenislayanan/{id}','JenisLayananController@editData');
    Route::put('/jenislayanan/{id}/update','JenisLayananController@doEditData');


    /* View Bidang Usaha*/
    Route::get('/bidangusaha','BidangUsahaController@getAll');

});