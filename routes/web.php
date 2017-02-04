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

Route::get('/', 'AuthController@login');
Route::get('/login', 'AuthController@login');
Route::post('/dologin', 'AuthController@dologin');
Route::get('/logout', 'AuthController@logout');

Route::group(['middleware' => ['auth']], function () {
    Route::get('/home', 'HomeController@index');
    Route::get('/profile', 'HomeController@profile');
    Route::put('/profile/{id}/update', 'HomeController@doProfile');
    /*For Provinsi*/
    Route::get('/provinces', 'ProvincesController@getAll');
    Route::get('/provinces/create', 'ProvincesController@addData');
    Route::post('/provinces', 'ProvincesController@doAddData');
    Route::get('/provinces/{id}', 'ProvincesController@editData');
    Route::put('/provinces/{id}/update', 'ProvincesController@doEditData');
    Route::get('/provinces/{id}/delete', 'ProvincesController@deleteData');
    Route::get('/provinces/{id}/regencies', 'ProvincesController@getRegenciesByProvinces');

    /*For Kabupaten Kota*/
    Route::get('/regencies', 'RegenciesController@getAll');
    Route::get('/regencies/create', 'RegenciesController@addData');
    Route::post('/regencies', 'RegenciesController@doAddData');
    Route::get('/regencies/{id}', 'RegenciesController@editData');
    Route::put('/regencies/{id}/update', 'RegenciesController@doEditData');
    Route::get('/regencies/{id}/delete', 'RegenciesController@deleteData');
    Route::get('/regencies/{id}/districts', 'RegenciesController@getDistrictsByRegencies');

    /*For Kecamatan*/
    Route::get('/districts', 'DistrictsController@getAll');
    Route::get('/districts/create', 'DistrictsController@addData');
    Route::post('/districts', 'DistrictsController@doAddData');
    Route::get('/districts/{id}', 'DistrictsController@editData');
    Route::put('/districts/{id}/update', 'DistrictsController@doEditData');
    Route::get('/districts/{id}/delete', 'DistrictsController@deleteData');
    Route::get('/districts/{id}/villages', 'DistrictsController@getVillagesByDistricts');

    /*For Kelurahan*/
    Route::get('/districts/villages/create/{id}', 'VillagesController@addData');
    Route::post('/districts/villages', 'VillagesController@doAddData');
    Route::get('/districts/villages/{id}', 'VillagesController@editData');
    Route::put('/districts/villages/{id}/update', 'VillagesController@doEditData');
    Route::get('/districts/villages/{id}/delete', 'VillagesController@deleteData');

    /*For Bidang Layanan */
    Route::get('/bidanglayanan', 'BidangLayananController@getAll');
    Route::get('/bidanglayanan/create', 'BidangLayananController@addData');
    Route::post('/bidanglayanan', 'BidangLayananController@doAddData');
    Route::get('/bidanglayanan/{id}', 'BidangLayananController@editData');
    Route::put('/bidanglayanan/{id}/update', 'BidangLayananController@doEditData');
    Route::get('/bidanglayanan/{id}/delete', 'BidangLayananController@deleteData');

    /* Jenis Layanan */
    Route::get('/jenislayanan', 'JenisLayananController@getAll');
    Route::get('/jenislayanan/create', 'JenisLayananController@addData');
    Route::post('/jenislayanan', 'JenisLayananController@doAddData');
    Route::get('/jenislayanan/{id}', 'JenisLayananController@editData');
    Route::put('/jenislayanan/{id}/update', 'JenisLayananController@doEditData');
    Route::get('/jenislayanan/{id}/delete', 'JenisLayananController@deleteData');


    /* View Bidang Usaha*/
    Route::get('/bidangusaha', 'BidangUsahaController@getAll');
    Route::get('/bidangusaha/create', 'BidangUsahaController@addData');
    Route::post('/bidangusaha', 'BidangUsahaController@doAddData');
    Route::get('/bidangusaha/{id}', 'BidangUsahaController@editData');
    Route::put('/bidangusaha/{id}/update', 'BidangUsahaController@doEditData');
    Route::get('/bidangusaha/{id}/delete', 'BidangUsahaController@deleteData');

    /*For Common*/
    Route::group(['prefix' => 'common'], function () {
        Route::get('regencies/{provinces_id}', 'CommonController@getRegencies');
        Route::get('districts/{regencies_id}', 'CommonController@getDistricts');
        Route::get('villages/{districts_id}', 'CommonController@getVillages');
    });

    /**
     * for lembaga
     */
    Route::group(['prefix' => 'lembaga'], function () {
        Route::get('/', 'LembagaController@getAll');
        Route::get('/create', 'LembagaController@addData');
        Route::post('/', 'LembagaController@doAddData');
        Route::get('/{id}', 'LembagaController@editData');
        Route::put('/{id}/update', 'LembagaController@doEditData');
        Route::get('/{id}/delete', 'LembagaController@deleteData');
        Route::get('/{id}/detail', 'LembagaController@detailData');
    });

    /**
     * For user
     */
    Route::group(['prefix' => 'u'], function () {
        Route::get('/', 'UserController@getAll');
        Route::get('/create', 'UserController@addData');
        Route::post('/', 'UserController@doAddData');
        Route::get('/{id}', 'UserController@editData');
        Route::put('/{id}/update', 'UserController@doEditData');
        Route::get('/{id}/delete', 'UserController@deleteData');
    });

    /**
     * For Tingkat
     */
    Route::group(['prefix' => 'tingkat'], function () {
        Route::get('/', 'TingkatsController@getAll');
        Route::get('/create', 'TingkatsController@addData');
        Route::post('/', 'TingkatsController@doAddData');
        Route::get('/{id}', 'TingkatsController@editData');
        Route::put('/{id}/update', 'TingkatsController@doEditData');
        Route::get('/{id}/delete', 'TingkatsController@deleteData');
    });

    /**
     * For Role
     */
    Route::group(['prefix' => 'roles'], function () {
        Route::get('/', 'RolesController@getAll');
        Route::get('/create', 'RolesController@addData');
        Route::post('/', 'RolesController@doAddData');
        Route::get('/{id}', 'RolesController@editData');
        Route::put('/{id}/update', 'RolesController@doEditData');
        Route::get('/{id}/delete', 'RolesController@deleteData');
    });

    /**
     * For Konsultan
     */
    Route::group(['prefix' => 'konsultan'], function () {
        Route::get('/', 'KonsultanController@getAll');
        Route::get('/report', 'KonsultanController@getAllReport');
        Route::get('/create', 'KonsultanController@addData');
        Route::post('/', 'KonsultanController@doAddData');
        Route::get('/{id}', 'KonsultanController@editData');
        Route::put('/{id}/update', 'KonsultanController@doEditData');
        Route::get('/{id}/delete', 'KonsultanController@deleteData');
        Route::get('/{id}/detail', 'KonsultanController@detailData');
    });

    Route::group(['namespace' => 'Konsultan',['middleware' => 'konsultan']], function () {

        Route::get('k/lembaga','LembagaController@getLembaga');
        Route::get('k/lembaga/detail','LembagaController@detailData');
        Route::put('k/lembaga/{id}/update', 'LembagaController@doEditData');
        Route::get('bio/konsultan','BiodataController@index');
        Route::get('bio/konsultan/edit','BiodataController@editData');
        Route::put('bio/konsultan/{id}/update','BiodataController@doEditData');

        Route::group(['prefix' => 'k/proker'], function () {
            Route::get('/', 'ProkerKonsultanController@getAll');
            Route::get('/create', 'ProkerKonsultanController@addData');
            Route::post('/', 'ProkerKonsultanController@doAddData');
            Route::get('/{id}', 'ProkerKonsultanController@editData');
            Route::put('/{id}/update', 'ProkerKonsultanController@doEditData');
            Route::get('/{id}/delete', 'ProkerKonsultanController@deleteData');
        });

        Route::group(['prefix' => 'k/dproker'], function () {
            Route::get('/{idproker}', 'DetailsProkerController@getAll');
            Route::get('/create/{idproker}', 'DetailsProkerController@addData');
            Route::post('/', 'DetailsProkerController@doAddData');
            Route::get('/{id}/edit', 'DetailsProkerController@editData');
            Route::put('/{id}/update', 'DetailsProkerController@doEditData');
            Route::get('/{id}/delete', 'DetailsProkerController@deleteData');
        });

        Route::group(['prefix' => 'k/kegiatan'], function () {
            Route::get('/', 'KegiatanKonsultanController@getAll');
            Route::get('/create', 'KegiatanKonsultanController@addData');
            Route::post('/', 'KegiatanKonsultanController@doAddData');
            Route::get('/{id}', 'KegiatanKonsultanController@editData');
            Route::put('/{id}/update', 'KegiatanKonsultanController@doEditData');
            Route::get('/{id}/delete', 'KegiatanKonsultanController@deleteData');
        });
    });
});