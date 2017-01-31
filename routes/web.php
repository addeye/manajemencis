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