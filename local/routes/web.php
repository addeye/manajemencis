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

Route::get('/', 'AuthController@beranda')->middleware('guest');
Route::get('/login', 'AuthController@login');
Route::post('/dologin', 'AuthController@dologin');
Route::get('/logout', 'AuthController@logout');
Route::get('kontak','KontakController@tampil');

/*For Common*/
Route::group(['prefix' => 'common'], function () {
    Route::get('regencies/{provinces_id}', 'CommonController@getRegencies');
    Route::get('districts/{regencies_id}', 'CommonController@getDistricts');
    Route::get('villages/{districts_id}', 'CommonController@getVillages');
    Route::get('detail/proker/{id}', 'CommonController@getDetailProker');
    Route::get('detail/kegiatan/{id}', 'CommonController@getDetailKegiatan');
    Route::get('proses_output/{jenis_layanan_id}', 'CommonController@getProsesOutput');
});

Route::get('konsultasi','KonsultasiController@add');
Route::post('konsultasi','KonsultasiController@doAdd');

Route::group(['middleware' => ['auth']], function () {

    Route::get('/home', 'HomeController@index');
    Route::get('/profile', 'HomeController@profile');
    Route::put('/profile/{id}/update', 'HomeController@doProfile');

    Route::group(['middleware' => ['superadmin']], function () {
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
            Route::get('/report/all', 'LembagaController@getAllColumn');
        });

        /**
         * for CIS Lembaga
         */
        Route::group(['prefix' => 'cislembaga'], function () {
            Route::get('/', 'CisLembagaController@getAll');
            Route::get('/create', 'CisLembagaController@addData');
            Route::post('/', 'CisLembagaController@doAddData');
            Route::get('/{id}', 'CisLembagaController@editData');
            Route::put('/{id}/update', 'CisLembagaController@doEditData');
            Route::get('/{id}/delete', 'CisLembagaController@deleteData');
            Route::get('/{id}/detail', 'CisLembagaController@detailData');
            Route::get('/report/all', 'CisLembagaController@getAllColumn');
        });

        /**
         * for Cis FIleManager
         */
        Route::group(['prefix' => 'cisfile'], function () {
//            Route::get('/', 'CisFilemanageraController@getAll');
//            Route::get('/create', 'CisFilemanageraController@addData');
            Route::post('/', 'CisFilemanagerController@doAddData');
//            Route::get('/{id}', 'CisFilemanagerController@editData');
//            Route::put('/{id}/update', 'CisFilemanagerController@doEditData');
            Route::get('/{id}/delete', 'CisFilemanagerController@deleteData');
//            Route::get('/{id}/detail', 'CisFilemanageraController@detailData');
//            Route::get('/report/all', 'CisFilemanageraController@getAllColumn');
        });

        /**
         * for Sentra Binaan
         */
        Route::group(['prefix' => 'sentra_binaan'], function () {
//            Route::get('/', 'CisFilemanageraController@getAll');
//            Route::get('/create', 'CisFilemanageraController@addData');
            Route::post('/', 'SentraBinaanController@doAddData');
            Route::get('/{id}', 'SentraBinaanController@editData');
            Route::put('/{id}/update', 'SentraBinaanController@doEditData');
            Route::get('/{id}/delete', 'SentraBinaanController@deleteData');
//            Route::get('/{id}/detail', 'CisFilemanageraController@detailData');
//            Route::get('/report/all', 'CisFilemanageraController@getAllColumn');
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
            Route::get('/{id}/proker', 'KonsultanController@prokerData');
            Route::get('/proker/{id}/detail', 'KonsultanController@detailProker');
            Route::post('semua/delete', 'KonsultanController@deleteAllData');
        });

        /**
         * For Admin Lembaga
         */
        Route::group(['prefix' => 'admin'], function () {
            Route::get('/', 'AdminLembagaController@getAll');
            Route::get('/create', 'AdminLembagaController@addData');
            Route::post('/', 'AdminLembagaController@doAddData');
            Route::get('/{id}', 'AdminLembagaController@editData');
            Route::put('/{id}/update', 'AdminLembagaController@doEditData');
            Route::get('/{id}/delete', 'AdminLembagaController@deleteData');
        });
        /**
         * For Sentra KUMKM
         */
        Route::group(['prefix' => 'sentra'], function () {
            Route::get('/', 'SentraKumkmController@getAll');
            Route::get('/create', 'SentraKumkmController@addData');
            Route::post('/', 'SentraKumkmController@doAddData');
            Route::get('/{id}', 'SentraKumkmController@editData');
            Route::put('/{id}/update', 'SentraKumkmController@doEditData');
            Route::get('/{id}/delete', 'SentraKumkmController@deleteData');
            Route::get('/report/all', 'SentraKumkmController@getAllColumn');
        });

        //banner
        Route::get('sbanner','BannerController@index');
        Route::get('sbanner/add','BannerController@add');
        Route::post('sbanner','BannerController@doAdd');
        Route::get('sbanner/{id}/edit','BannerController@edit');
        Route::put('sbanner/{id}/edit','BannerController@doEdit');
        Route::get('sbanner/{id}/delete','BannerController@destroy');

        Route::get('set_kontak','KontakController@index');
        Route::post('set_kontak','KontakController@doEdit');

        Route::get('pengumuman','PengumumanController@index');
        Route::get('pengumuman/add','PengumumanController@add');
        Route::post('pengumuman','PengumumanController@doAdd');
        Route::get('pengumuman/{id}','PengumumanController@edit');
        Route::put('pengumuman/{id}','PengumumanController@doEdit');
        Route::get('pengumuman/{id}/delete','PengumumanController@destroy');

        Route::get('listkonsultan','KonsultasiController@index');
    });

    Route::group(['namespace' => 'Konsultan', ['middleware' => ['konsultan']]], function ()
    {

        Route::get('k/lembaga', 'LembagaController@getLembaga');
        Route::get('k/lembaga/detail', 'LembagaController@detailData');
        Route::put('k/lembaga/{id}/update', 'LembagaController@doEditData');
        Route::get('bio/konsultan', 'BiodataController@index');
        Route::get('bio/konsultan/edit', 'BiodataController@editData');
        Route::put('bio/konsultan/{id}/update', 'BiodataController@doEditData');

        /**
         * for Sentra Binaan
         */
        Route::group(['prefix' => 'sentra_binaan'], function () {
            Route::post('k/', 'SentraBinaanController@doAddData');
            Route::get('k/{id}', 'SentraBinaanController@editData');
            Route::put('k/{id}/update', 'SentraBinaanController@doEditData');
            Route::get('k/{id}/delete', 'SentraBinaanController@deleteData');
        });

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

        Route::get('importKegiatan','ImportController@importExcelKegiatan');
        Route::get('downloadKegiatan','ImportController@downloadExcelKegiatan');
        Route::post('importKegiatan','ImportController@doImportKegiatan');
    });

    //for admin
    Route::group(['namespace' => 'Admin', 'prefix' => 'adm', 'middleware' => ['admin']], function () {
        /**
         * for lembaga
         */
        Route::group(['prefix' => 'lembaga'], function () {
            Route::get('/profil', 'LembagaController@profile');
            Route::get('/profil/edit', 'LembagaController@editProfile');
            Route::put('profil/{id}/update', 'LembagaController@doUpdate');
            Route::get('export/word/{id}','LembagaController@exportWord');
        });

        Route::group(['prefix' => 'sentra_binaan'], function () {
//            Route::get('/', 'CisFilemanageraController@getAll');
//            Route::get('/create', 'CisFilemanageraController@addData');
            Route::post('/', 'SentraBinaanController@doAddData');
            Route::get('/{id}', 'SentraBinaanController@editData');
            Route::put('/{id}/update', 'SentraBinaanController@doEditData');
            Route::get('/{id}/delete', 'SentraBinaanController@deleteData');
//            Route::get('/{id}/detail', 'CisFilemanageraController@detailData');
//            Route::get('/report/all', 'CisFilemanageraController@getAllColumn');
        });

        /**
         * for Cis FIleManager
         */
        Route::group(['prefix' => 'cisfile'], function () {
//            Route::get('/', 'CisFilemanageraController@getAll');
//            Route::get('/create', 'CisFilemanageraController@addData');
            Route::post('/', 'CisFilemanagerController@doAddData');
//            Route::get('/{id}', 'CisFilemanagerController@editData');
//            Route::put('/{id}/update', 'CisFilemanagerController@doEditData');
            Route::get('/{id}/delete', 'CisFilemanagerController@deleteData');
//            Route::get('/{id}/detail', 'CisFilemanageraController@detailData');
//            Route::get('/report/all', 'CisFilemanageraController@getAllColumn');
        });

        /**
         * For Sentra KUMKM
         */
        Route::group(['prefix' => 'sentra'], function () {
            Route::get('/', 'SentraKumkmController@getAll');
            Route::get('/create', 'SentraKumkmController@addData');
            Route::post('/', 'SentraKumkmController@doAddData');
            Route::get('/{id}', 'SentraKumkmController@editData');
            Route::put('/{id}/update', 'SentraKumkmController@doEditData');
            Route::get('/{id}/delete', 'SentraKumkmController@deleteData');
            Route::get('/report/all', 'SentraKumkmController@getAllColumn');
        });

        Route::group(['prefix' => 'konsultan'], function () {
            Route::get('/', 'KonsultanController@getAll');
            Route::get('/report', 'KonsultanController@getAllReport');
            Route::get('/create', 'KonsultanController@addData');
            Route::post('/', 'KonsultanController@doAddData');
            Route::get('/{id}', 'KonsultanController@editData');
            Route::put('/{id}/update', 'KonsultanController@doEditData');
            Route::get('/{id}/delete', 'KonsultanController@deleteData');
            Route::get('/{id}/detail', 'KonsultanController@detailData');
            Route::get('/{id}/proker', 'KonsultanController@prokerData');
            Route::get('/proker/{id}/detail', 'KonsultanController@detailProker');
        });
    });

});
Auth::routes();
//Route::get('testword',function(){
//    // Creating the new document...
//    $phpWord = new \PhpOffice\PhpWord\PhpWord();
//
//    /* Note: any element you append to a document must reside inside of a Section. */
//
//    // Adding an empty Section to the document...
//    $section = $phpWord->addSection();
//
//// Adding Text element to the Section having font styled by default...
//    $section->addText(
//        htmlspecialchars(
//            '"Learn from yesterday, live for today, hope for tomorrow. '
//            . 'The important thing is not to stop questioning." '
//            . '(Albert Einstein)'
//        )
//    );
//
//// Saving the document as HTML file...
//    $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord);
//    $objWriter->save('document/helloWorld.docx');
//    return response()->download('document/helloWorld.docx');
//});


