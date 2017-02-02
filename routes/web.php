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
    Route::get('/provinces/{id}/regencies','ProvincesController@getRegenciesByProvinces');

    /*For Kabupaten Kota*/
    Route::get('/regencies','RegenciesController@getAll');
    Route::get('/regencies/create','RegenciesController@addData');
    Route::post('/regencies','RegenciesController@doAddData');
    Route::get('/regencies/{id}','RegenciesController@editData');
    Route::put('/regencies/{id}/update','RegenciesController@doEditData');
    Route::get('/regencies/{id}/delete','RegenciesController@deleteData');
    Route::get('/regencies/{id}/districts','RegenciesController@getDistrictsByRegencies');

    /*For Kecamatan*/
    Route::get('/districts','DistrictsController@getAll');
    Route::get('/districts/create','DistrictsController@addData');
    Route::post('/districts','DistrictsController@doAddData');
    Route::get('/districts/{id}','DistrictsController@editData');
    Route::put('/districts/{id}/update','DistrictsController@doEditData');
    Route::get('/districts/{id}/delete','DistrictsController@deleteData');
    Route::get('/districts/{id}/villages','DistrictsController@getVillagesByDistricts');

    /*For Kelurahan*/
    Route::get('/districts/villages/create/{id}','VillagesController@addData');
    Route::post('/districts/villages','VillagesController@doAddData');
    Route::get('/districts/villages/{id}','VillagesController@editData');
    Route::put('/districts/villages/{id}/update','VillagesController@doEditData');
    Route::get('/districts/villages/{id}/delete','VillagesController@deleteData');

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
    Route::get('/bidangusaha/create','BidangUsahaController@addData');
    Route::post('/bidangusaha','BidangUsahaController@doAddData');
    Route::get('/bidangusaha/{id}','BidangUsahaController@editData');
    Route::put('/bidangusaha/{id}/update','BidangUsahaController@doEditData');
    Route::get('/bidangusaha/{id}/delete','BidangUsahaController@deleteData');

    /*For Common*/
    Route::group(['prefix' => 'common'], function () {
        Route::get('regencies/{provinces_id}','CommonController@getRegencies');
        Route::get('districts/{regencies_id}','CommonController@getDistricts');
        Route::get('villages/{districts_id}','CommonController@getVillages');
    });

    Route::group(['prefix' => 'lembaga'], function () {
        Route::get('/','LembagaController@getAll');
        Route::get('/create','LembagaController@addData');
        Route::post('/','LembagaController@doAddData');
        Route::get('/{id}','LembagaController@editData');
        Route::put('/{id}/update','LembagaController@doEditData');
        Route::get('/{id}/delete','LembagaController@deleteData');
        Route::get('/{id}/detail','LembagaController@detailData');
    });
});