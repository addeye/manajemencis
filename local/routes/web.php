<?php

use App\Kegiatan_konsultan;
use App\Kumkm;
use App\Proker_konsultan;
use App\KumkmDetail;
use App\KoperasiDetail;
use Illuminate\Support\Facades\Artisan;

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
Route::get('kontak', 'KontakController@tampil');

/*For Common*/
Route::group(['prefix' => 'common'], function () {
    Route::get('regencies/{provinces_id}', 'CommonController@getRegencies');
    Route::get('districts/{regencies_id}', 'CommonController@getDistricts');
    Route::get('villages/{districts_id}', 'CommonController@getVillages');
    Route::get('detail/proker/{id}', 'CommonController@getDetailProker');
    Route::get('detail/kegiatan/{id}', 'CommonController@getDetailKegiatan');
    Route::get('proses_output/{jenis_layanan_id}', 'CommonController@getProsesOutput');
});

Route::group(['prefix' => 'common'], function () {
    Route::get('ff/regencies/{provinces_id}', 'CommonController@getFfRegencies');
    Route::get('ff/districts/{regencies_id}', 'CommonController@getFfDistricts');
    Route::get('ff/villages/{districts_id}', 'CommonController@getFfVillages');
});

Route::get('sentra_umkm', 'CommonController@getSentra');
Route::get('produk_unggulan', 'CommonController@getProduk');
Route::get('kegiatan', 'CommonController@getKegiatan');
Route::get('kegiatan/{id}', 'CommonController@getKegiatanByLembaga');
Route::get('penerima', 'CommonController@getPenerima');
Route::get('info-konsultan', 'CommonController@getKonsultans');
Route::get('info-plut', 'CommonController@getPlut');

Route::get('konsultasi', 'KonsultasiController@add');
Route::post('konsultasi', 'KonsultasiController@doAdd');

Route::get('informasi', 'InformasiPasarController@index');
Route::get('informasi/tambah/{opsi}', 'InformasiPasarController@add');
Route::post('informasi', 'InformasiPasarController@doAdd');
Route::get('informasi/{id}/edit', 'InformasiPasarController@edit');
Route::put('informasi/{id}', 'InformasiPasarController@doEdit');
Route::delete('informasi/{id}', ['uses' => 'InformasiPasarController@destroy', 'as' => 'Informasi.delete']);
Route::get('informasi/{id}/detail', 'InformasiPasarController@detail');

Route::get('info', 'CommonController@getInfo');
Route::get('informasipasar', 'CommonController@getInformasiPasar');

Route::post('comment', 'CommentPasarController@doAdd');

Route::group(['middleware' => ['auth']], function () {
    Route::get('/home', 'HomeController@index');
    Route::get('/profile', 'HomeController@profile');
    Route::put('/profile/{id}/update', 'HomeController@doProfile');

    Route::get('konsultasi/{id}/detail', 'KonsultasiController@detail');
    Route::put('konsultasi/{id}', 'KonsultasiController@doEdit');

    Route::get('konsultasi/all', 'CommonController@getKonsultasi');

    Route::get('produk_unggulan', 'ProdukUnggulanController@getAll');
    Route::get('produk_unggulan/create', 'ProdukUnggulanController@add');
    Route::post('produk_unggulan', 'ProdukUnggulanController@doAdd');
    Route::get('produk_unggulan/{id}', 'ProdukUnggulanController@edit');
    Route::put('produk_unggulan/{id}', 'ProdukUnggulanController@doEdit');
    Route::get('produk_unggulan/{id}/delete', 'ProdukUnggulanController@delete');
    Route::get('produk_unggulan/report/all', 'ProdukUnggulanController@getAllReport');

    Route::get('pendampingan', 'PendampinganController@getAll');
    Route::get('pendampingan/create', 'PendampinganController@add');
    Route::post('pendampingan', 'PendampinganController@doAdd');
    Route::get('pendampingan/{id}', 'PendampinganController@edit');
    Route::put('pendampingan/{id}', 'PendampinganController@doEdit');
    Route::delete('pendampingan/{id}/delete', 'PendampinganController@delete');
    Route::get('pendampingan/report/all', 'PendampinganController@getAllReport');

    /*for see data*/
    Route::get('/provinces', 'ProvincesController@getAll');
    Route::get('/provinces/{id}/regencies', 'ProvincesController@getRegenciesByProvinces');
    Route::get('/regencies', 'RegenciesController@getAll');
    Route::get('/regencies/{id}/districts', 'RegenciesController@getDistrictsByRegencies');
    Route::get('/districts/{id}/villages', 'DistrictsController@getVillagesByDistricts');
    Route::get('/districts', 'DistrictsController@getAll');
    Route::get('/bidangusaha', 'BidangUsahaController@getAll');
    Route::get('/bidanglayanan', 'BidangLayananController@getAll');
    Route::get('/jenislayanan', 'JenisLayananController@getAll');
    Route::get('/report/konsultan', 'KonsultanController@getByCis');
    Route::get('/report/lembaga', 'CisLembagaController@getAllColumn');

    Route::get('form-select-konsultan-by-lembaga/{lembaga_id}', 'KonsultanController@getKonsultanSelectByLembaga');
    Route::get('form-select-kumkm-by-konsultan/{konsultan_id}', 'PelaksanaanPendampinganController@getKumkmByKonsultan');

    Route::group(['namespace' => 'Monev', ['middleware' => ['monev']]], function () {
        Route::group(['prefix' => 'profil'], function () {
            Route::get('lembaga', 'LembagaController@getAll');
            Route::get('lembaga/{id}/detail', 'LembagaController@detail');
            Route::get('lembaga/report/all', 'LembagaController@getAllColumn');

            Route::get('pengelola', 'PengelolaController@all');

            Route::get('konsultan', 'KonsultanController@all');
            Route::get('konsultan/{id}', 'KonsultanController@detail');
            Route::get('konsultan-export', 'KonsultanController@export');

            Route::get('admin', 'AdminController@all');
        });

        Route::group(['prefix' => 'database'], function () {
            Route::get('koperasi', 'KoperasiController@all');
            Route::get('koperasi/{id}', 'KoperasiController@detail');

            Route::get('umkm', 'UmkmController@all');
            Route::get('umkm/{id}', 'UmkmController@detail');

            Route::get('sentra', 'SentraController@all');
            Route::get('sentra/{id}', 'SentraController@detail');

            Route::get('produk', 'ProdukController@all');
            Route::get('produk/{id}', 'ProdukController@detail');
        });

        Route::group(['prefix' => 'data-pendampingan'], function () {
            Route::get('sasaran/koperasi', 'SasaranKoperasiController@all');
            Route::get('sasaran/koperasi-export', 'SasaranKoperasiController@export');

            Route::get('sasaran/umkm', 'SasaranUmkmController@all');
            Route::get('sasaran/umkm-export', 'SasaranUmkmController@export');

            Route::get('program-kerja', 'ProgramController@all');
            Route::get('program-kerja-export', 'ProgramController@export');

            Route::get('pelaksanaan', 'PelaksanaanController@all');

            Route::get('laporan-pelaksanaan-pendampingan', 'LapsevenController@pelaksanaan');
            Route::post('content-pelaksanaan-pendampingan', 'LapsevenController@getContentPelaksanaan');
            Route::get('laporan-pelaksanaan-pendampingan-print', 'LapsevenController@pelaksanaanPrint');

            Route::get('laporan-pelaksanaan-final', 'LapsevenController@pelaksanaanFinal');

            Route::get('laporan-pelaksanaan-bulanan-final', 'LapsevenController@pelaksanaanBulanan');
            Route::post('laporan-pelaksanaan-bulanan-show', 'LapsevenController@pelaksanaanBulananShow');
            Route::get('laporan-pelaksanaan-bulanan-print', 'LapsevenController@pelaksanaanBulananPrint');

            Route::get('laporan-pelaksanaan-triwulan-final', 'LapsevenController@pelaksanaanTriwulan');
            Route::post('laporan-pelaksanaan-triwulan-show', 'LapsevenController@pelaksanaanTriwulanShow');
            Route::get('laporan-pelaksanaan-triwulan-print', 'LapsevenController@pelaksanaanTriwulanPrint');

            Route::get('laporan-pelaksanaan-tahunan-final', 'LapsevenController@pelaksanaanTahunan');
            Route::post('laporan-pelaksanaan-tahunan-show', 'LapsevenController@pelaksanaanTahunanShow');
            Route::get('laporan-pelaksanaan-tahunan-print', 'LapsevenController@pelaksanaanTahunanPrint');


        });

        Route::group(['prefix' => 'laporan-monev'], function () {
            Route::get('progress', 'ProgresPendampinganController@all');
            Route::get('progress/export', 'ProgresPendampinganController@export');

            Route::get('porgress-iku', 'KinerjaController@all');
            Route::get('porgress-iku-plut', 'KinerjaController@listPerPlut');

            Route::get('rekap-program-per-bidang', 'ProgramController@rekapPerBidang');
            Route::get('rekap-pelaksanaan-program-per-bidang', 'PelaksanaanController@rekapPelaksanaanPerBidang');

            Route::get('laporan-kumkm-perbidang', 'LapsevenController@kumkmPerBidang');
        });
    });

    Route::group(['middleware' => ['superadmin']], function () {
        Route::get('progres-pendampingan', 'ProgresPendampinganController@getlist');
        Route::get('progres-pendampingan-export', 'ProgresPendampinganController@export');

        Route::resource('activity-user', 'ActivityUserController');
        Route::get('last-login', 'ActivityUserController@loginLast');
        Route::get('export-last-login', 'ActivityUserController@loginLastExport');

        Route::resource('monev', 'MonevController');
        Route::resource('pengelolah', 'PengelolahController');

        Route::resource('database-koperasi', 'KoperasiController');
        Route::get('database-koperasi-laporan', 'KoperasiController@laporan');
        Route::get('database-koperasi-export', 'KoperasiController@export');
        Route::post('database-koperasi-delete', 'KoperasiController@hapus');

        Route::resource('database-umkm', 'DataUmkmController');
        Route::get('database-umkm-laporan', 'DataUmkmController@laporan');
        Route::get('database-umkm-export', 'DataUmkmController@export');
        Route::post('database-umkm-delete', 'DataUmkmController@hapus');

        Route::get('proker-plut', 'AdminLembagaController@prokerPlut');
        Route::get('proker-plut-status/{id}/{status}', 'AdminLembagaController@statusProkerPlut');

        Route::get('sasaran-program-koperasi', 'SasaranProgramKoperasiController@getList');
        Route::put('sasaran-program-koperasi-lock/{id}', 'SasaranProgramKoperasiController@lock');
        Route::get('sasaran-program-koperasi-export', 'SasaranProgramKoperasiController@export');
        Route::post('sasaran-koperasi-pendampingan-lock', 'SasaranProgramKoperasiController@multipleLock');
        Route::post('sasaran-koperasi-pendampingan-unlock', 'SasaranProgramKoperasiController@multipleUnlock');

        Route::get('sasaran-program-umkm', 'SasaranProgramUmkmController@getList');
        Route::put('sasaran-program-umkm-lock/{id}', 'SasaranProgramUmkmController@lock');
        Route::get('sasaran-program-umkm-export', 'SasaranProgramUmkmController@export');
        Route::post('sasaran-umkm-pendampingan-lock', 'SasaranProgramUmkmController@multipleLock');
        Route::post('sasaran-umkm-pendampingan-unlock', 'SasaranProgramUmkmController@multipleUnlock');

        Route::get('program-kerja-pendampingan', 'ProgramKerjaController@getList');
        Route::get('program-kerja-pendampingan-export', 'ProgramKerjaController@export');
        Route::put('program-kerja-pendampingan-lock/{id}', 'ProgramKerjaController@lock');
        Route::post('program-kerja-pendampingan-lock', 'ProgramKerjaController@multipleLock');
        Route::post('program-kerja-pendampingan-unlock', 'ProgramKerjaController@multipleUnlock');

        Route::get('pelaksanaan-pendampingan-konsultan', 'PelaksanaanPendampinganController@getList');
        Route::get('pelaksanaan-pendampingan-konsultan-export', 'PelaksanaanPendampinganController@export');
        Route::get('pelaksanaan-pendampingan-konsultan-print', 'PelaksanaanPendampinganController@print');
        Route::put('pelaksanaan-pendampingan-konsultan-lock/{id}', 'PelaksanaanPendampinganController@lock');
        Route::post('pelaksanaan-pendampingan-lock', 'PelaksanaanPendampinganController@multipleLock');
        Route::post('pelaksanaan-pendampingan-unlock', 'PelaksanaanPendampinganController@multipleUnlock');

        //Laporan 7a-7g
        Route::get('laporan-pendampingan-koperasi', 'LapsevenController@koperasi');
        Route::get('laporan-pendampingan-koperasi-print', 'LapsevenController@koperasiPrint');
        Route::get('laporan-pendampingan-umkm', 'LapsevenController@umkm');
        Route::get('laporan-pendampingan-umkm-print', 'LapsevenController@umkmPrint');

        Route::get('laporan-pendampingan-sasaran-koperasi', 'LapsevenController@sasaranKoperasi');
        Route::get('laporan-pendampingan-sasaran-koperasi-print', 'LapsevenController@sasaranKoperasiPrint');

        Route::get('laporan-pendampingan-sasaran-umkm', 'LapsevenController@sasaranUmkm');
        Route::get('laporan-pendampingan-sasaran-umkm-print', 'LapsevenController@sasaranUmkmPrint');

        Route::get('laporan-program-pendampingan', 'LapsevenController@programKerja');
        Route::get('laporan-program-pendampingan-print', 'LapsevenController@programKerjaPrint');

        Route::get('laporan-pelaksanaan-pendampingan', 'LapsevenController@pelaksanaan');
        Route::post('content-pelaksanaan-pendampingan', 'LapsevenController@getContentPelaksanaan');
        Route::get('laporan-pelaksanaan-pendampingan-print', 'LapsevenController@pelaksanaanPrint');

        Route::get('laporan-pelaksanaan-final', 'LapsevenController@pelaksanaanFinal');

        Route::get('laporan-pelaksanaan-bulanan-final', 'LapsevenController@pelaksanaanBulanan');
        Route::post('laporan-pelaksanaan-bulanan-show', 'LapsevenController@pelaksanaanBulananShow');
        Route::get('laporan-pelaksanaan-bulanan-print', 'LapsevenController@pelaksanaanBulananPrint');

        Route::get('laporan-pelaksanaan-triwulan-final', 'LapsevenController@pelaksanaanTriwulan');
        Route::post('laporan-pelaksanaan-triwulan-show', 'LapsevenController@pelaksanaanTriwulanShow');
        Route::get('laporan-pelaksanaan-triwulan-print', 'LapsevenController@pelaksanaanTriwulanPrint');

        Route::get('laporan-pelaksanaan-tahunan-final', 'LapsevenController@pelaksanaanTahunan');
        Route::post('laporan-pelaksanaan-tahunan-show', 'LapsevenController@pelaksanaanTahunanShow');
        Route::get('laporan-pelaksanaan-tahunan-print', 'LapsevenController@pelaksanaanTahunanPrint');

        Route::get('laporan-kumkm-perbidang', 'LapsevenController@kumkmPerBidang');
        /*Laporan*/
        Route::get('laporan-kegiatan', 'LaporanController@getKegiatanKonsultan');
        Route::get('laporan-kegiatan/excel', 'LaporanController@getKegiatanKonsultanExcel');
        Route::get('laporan-admin', 'LaporanController@getAdminLembaga');
        Route::get('laporan-admin/excel', 'LaporanController@getAdminLembagaExcel');
        Route::get('laporan-produk', 'LaporanController@getProduk');
        Route::get('laporan-produk/excel', 'LaporanController@getProdukExcel');
        Route::get('laporan-program', 'LaporanController@getProgramKerja');
        Route::get('laporan-program/excel', 'LaporanController@getProgramKerjaExcel');
        Route::get('laporan-sentra', 'LaporanController@getSentra');
        Route::get('laporan-sentra/excel', 'LaporanController@getSentraExcel');
        Route::get('laporan-kinerja', 'LaporanController@getKinerja');
        Route::get('laporan-kinerja/excel', 'LaporanController@getKinerjaExcel');
        Route::get('laporan-proker-plut', 'LaporanController@getProkerPlut');
        Route::get('laporan-proker-plut/excel', 'LaporanController@getProkerPlutExcel');

        Route::get('progres-data', 'LaporanController@progresData');
        Route::get('progres-data/excel', 'LaporanController@progresExcel');
        Route::get('progres-data/print', 'LaporanController@progresPrint');

        /*Standart Layanan*/
        Route::resource('standart-layanan', 'StandartLayananController');

        /*Kinerja*/
        Route::resource('kinerja-master', 'KinerjaMasterController');
        Route::get('rekap-kinerja', 'KinerjaMasterController@getRekapForm');
        Route::get('rekap-kinerja-ajax/{tahun}', 'KinerjaMasterController@getRekap');
        Route::get('get-standart-layanan/{id}', 'KinerjaMasterController@getStandartLayanan');
        Route::get('get-list-standart/{lembaga_id}/{tahun}', 'KinerjaMasterController@getListStandartLayanan');
        Route::get('get-list-percis/{lembaga_id}/{tahun}', 'KinerjaMasterController@getListPerCis');

        /*For Provinsi*/
        Route::get('/provinces/create', 'ProvincesController@addData');
        Route::post('/provinces', 'ProvincesController@doAddData');
        Route::get('/provinces/{id}', 'ProvincesController@editData');
        Route::put('/provinces/{id}/update', 'ProvincesController@doEditData');
        Route::get('/provinces/{id}/delete', 'ProvincesController@deleteData');

        /*For Kabupaten Kota*/
        Route::get('/regencies/create', 'RegenciesController@addData');
        Route::post('/regencies', 'RegenciesController@doAddData');
        Route::get('/regencies/{id}', 'RegenciesController@editData');
        Route::put('/regencies/{id}/update', 'RegenciesController@doEditData');
        Route::get('/regencies/{id}/delete', 'RegenciesController@deleteData');

        /*For Kecamatan*/
        Route::get('/districts/create', 'DistrictsController@addData');
        Route::post('/districts', 'DistrictsController@doAddData');
        Route::get('/districts/{id}', 'DistrictsController@editData');
        Route::put('/districts/{id}/update', 'DistrictsController@doEditData');
        Route::get('/districts/{id}/delete', 'DistrictsController@deleteData');

        /*For Kelurahan*/
        Route::get('/districts/villages/create/{id}', 'VillagesController@addData');
        Route::post('/districts/villages', 'VillagesController@doAddData');
        Route::get('/districts/villages/{id}', 'VillagesController@editData');
        Route::put('/districts/villages/{id}/update', 'VillagesController@doEditData');
        Route::get('/districts/villages/{id}/delete', 'VillagesController@deleteData');

        /*For Bidang Layanan */
        Route::get('/bidanglayanan/create', 'BidangLayananController@addData');
        Route::post('/bidanglayanan', 'BidangLayananController@doAddData');
        Route::get('/bidanglayanan/{id}', 'BidangLayananController@editData');
        Route::put('/bidanglayanan/{id}/update', 'BidangLayananController@doEditData');
        Route::get('/bidanglayanan/{id}/delete', 'BidangLayananController@deleteData');

        /* Jenis Layanan */
        Route::get('/jenislayanan/create', 'JenisLayananController@addData');
        Route::post('/jenislayanan', 'JenisLayananController@doAddData');
        Route::get('/jenislayanan/{id}', 'JenisLayananController@editData');
        Route::put('/jenislayanan/{id}/update', 'JenisLayananController@doEditData');
        Route::get('/jenislayanan/{id}/delete', 'JenisLayananController@deleteData');

        /* View Bidang Usaha*/
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
        Route::get('sbanner', 'BannerController@index');
        Route::get('sbanner/add', 'BannerController@add');
        Route::post('sbanner', 'BannerController@doAdd');
        Route::get('sbanner/{id}/edit', 'BannerController@edit');
        Route::put('sbanner/{id}/edit', 'BannerController@doEdit');
        Route::get('sbanner/{id}/delete', 'BannerController@destroy');

        Route::get('set_kontak', 'KontakController@index');
        Route::post('set_kontak', 'KontakController@doEdit');

        Route::get('pengumuman', 'PengumumanController@index');
        Route::get('pengumuman/add', 'PengumumanController@add');
        Route::post('pengumuman', 'PengumumanController@doAdd');
        Route::get('pengumuman/{id}', 'PengumumanController@edit');
        Route::put('pengumuman/{id}', 'PengumumanController@doEdit');
        Route::get('pengumuman/{id}/delete', 'PengumumanController@destroy');

        Route::get('listkonsultan', 'KonsultasiController@index');
    });

    Route::group(['namespace' => 'Konsultan', ['middleware' => ['konsultan']]], function () {
        Route::group(['prefix' => 'kons'], function () {
            Route::get('laporan-pendampingan-koperasi', 'LapsevenController@koperasi');
            Route::get('laporan-pendampingan-koperasi-print', 'LapsevenController@koperasiPrint');
            Route::get('laporan-pendampingan-umkm', 'LapsevenController@umkm');
            Route::get('laporan-pendampingan-umkm-print', 'LapsevenController@umkmPrint');

            Route::get('laporan-pendampingan-sasaran-koperasi', 'LapsevenController@sasaranKoperasi');
            Route::get('laporan-pendampingan-sasaran-koperasi-print', 'LapsevenController@sasaranKoperasiPrint');

            Route::get('laporan-pendampingan-sasaran-umkm', 'LapsevenController@sasaranUmkm');
            Route::get('laporan-pendampingan-sasaran-umkm-print', 'LapsevenController@sasaranUmkmPrint');

            Route::get('laporan-program-pendampingan', 'LapsevenController@programKerja');
            Route::get('laporan-program-pendampingan-print', 'LapsevenController@programKerjaPrint');

            Route::get('laporan-pelaksanaan-pendampingan', 'LapsevenController@pelaksanaan');
            Route::post('content-pelaksanaan-pendampingan', 'LapsevenController@getContentPelaksanaan');
            Route::get('laporan-pelaksanaan-pendampingan-print', 'LapsevenController@pelaksanaanPrint');

            Route::get('laporan-pelaksanaan-final', 'LapsevenController@pelaksanaanFinal');

            Route::get('laporan-pelaksanaan-bulanan-final', 'LapsevenController@pelaksanaanBulanan');
            Route::post('laporan-pelaksanaan-bulanan-show', 'LapsevenController@pelaksanaanBulananShow');
            Route::get('laporan-pelaksanaan-bulanan-print', 'LapsevenController@pelaksanaanBulananPrint');

            Route::get('laporan-pelaksanaan-triwulan-final', 'LapsevenController@pelaksanaanTriwulan');
            Route::post('laporan-pelaksanaan-triwulan-show', 'LapsevenController@pelaksanaanTriwulanShow');
            Route::get('laporan-pelaksanaan-triwulan-print', 'LapsevenController@pelaksanaanTriwulanPrint');

            Route::get('laporan-pelaksanaan-tahunan-final', 'LapsevenController@pelaksanaanTahunan');
            Route::post('laporan-pelaksanaan-tahunan-show', 'LapsevenController@pelaksanaanTahunanShow');
            Route::get('laporan-pelaksanaan-tahunan-print', 'LapsevenController@pelaksanaanTahunanPrint');
        });

        Route::get('laporan-sentra-umkm', 'LaporanController@sentraumkm');
        Route::get('laporan-data-umkm', 'LaporanController@dataumkm');
        Route::get('laporan-produk-umkm', 'LaporanController@produkumkm');
        Route::get('laporan-kinerjacis', 'LaporanController@kinerjacis');
        Route::get('laporan-prokerkonsultan', 'LaporanController@prokerkonsultan');
        Route::get('laporan-kegiatankonsultan', 'LaporanController@kegiatankonsultan');

        Route::get('k/lembaga', 'LembagaController@getLembaga');
        Route::get('k/lembaga/detail', 'LembagaController@detailData');
        Route::put('k/lembaga/{id}/update', 'LembagaController@doEditData');
        Route::get('k/lembaga/export/word/{id}', 'LembagaController@exportWord');
        Route::get('k/lembaga/{id}/print', 'LembagaController@printLembaga');

        Route::get('bio/konsultan', 'BiodataController@index');
        Route::get('bio/konsultan/edit', 'BiodataController@editData');
        Route::get('bio/konsultan/print/{id?}', 'BiodataController@printData');
        Route::put('bio/konsultan/{id}/update', 'BiodataController@doEditData');

        /*Kinerja*/
        Route::resource('kinerja-konsultan', 'KinerjaKonsultanController');
        Route::get('get-standart-layanan/{id}', 'KinerjaKonsultanController@getStandartLayanan');
        Route::get('get-standart-konsultan/{tahun}', 'KinerjaKonsultanController@getListStandartLayanan');
        Route::get('get-list-kinerja/{tahun}', 'KinerjaKonsultanController@getListKinerja');

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
        Route::get('proker_id/{id}', 'ProkerKonsultanController@getProkerById');
        Route::get('proker-plut-konsultan', 'ProkerKonsultanController@prokerCis');

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
            Route::get('report/all', 'KegiatanKonsultanController@report');
        });

        Route::get('detail-proker/{id}', 'KegiatanKonsultanController@getDetailProkerById');

        Route::get('importKegiatan', 'ImportController@importExcelKegiatan');
        Route::get('downloadKegiatan', 'ImportController@downloadExcelKegiatan');
        Route::post('importKegiatan', 'ImportController@doImportKegiatan');

        Route::get('get-kegiatan-konsultan', 'KegiatanKonsultanController@getKegiatanKonsultan');

        /**
         * For Sentra KUMKM
         */
        Route::group(['prefix' => 'sentra_kumkm'], function () {
            Route::get('/', 'SentraKumkmController@getAll');
            Route::get('/create', 'SentraKumkmController@addData');
            Route::post('/', 'SentraKumkmController@doAddData');
            Route::get('/{id}', 'SentraKumkmController@editData');
            Route::put('/{id}/update', 'SentraKumkmController@doEditData');
            Route::get('/{id}/delete', 'SentraKumkmController@deleteData');
            Route::get('/report/all', 'SentraKumkmController@getAllColumn');
        });

        Route::resource('umkm-naik', 'UmkmNaikKelasController');
        Route::get('list-umkm', 'UmkmNaikKelasController@listUmkm');
        Route::get('pendaftaran-umkm', 'UmkmNaikKelasController@pendaftaranUmkm');
        Route::post('pendaftaran-umkm', 'UmkmNaikKelasController@doPendaftaranUmkm');
        Route::post('pendaftaran-umkm-one/{id}', 'UmkmNaikKelasController@doOnePendaftaranUmkm');
        Route::delete('pendaftaran-umkm/{id}', 'UmkmNaikKelasController@deletePendaftaranUmkm');

        Route::get('penilaian-umkm', 'UmkmNaikKelasController@penilaian');
        Route::post('penilaian-umkm', 'UmkmNaikKelasController@doPenilaian');

        Route::resource('koperasi', 'KoperasiController');
        Route::get('koperasi-detail-add/{koperasi_id}', 'KoperasiController@addDetail');
        Route::post('koperasi-detail-add', 'KoperasiController@doAddDetail');
        Route::get('koperasi-detail-edit/{koperasi_id}/{id}', 'KoperasiController@editDetail');
        Route::put('koperasi-detail/{koperasi_id}/{id}', 'KoperasiController@doEditDetail');
        Route::delete('koperasi-detail-del/{id}', 'KoperasiController@delDetail');
        Route::get('koperasi-report', 'KoperasiController@report');
        Route::get('koperasi-laporan', 'KoperasiController@laporan');
        Route::get('koperasi-export', 'KoperasiController@export');

        Route::resource('data-kumkm', 'KumkmController');
        Route::get('data-kumkm-detail-add/{koperasi_id}', 'KumkmController@addDetail');
        Route::post('data-kumkm-add-detail', 'KumkmController@doAddDetail');
        Route::get('data-kumkm-detail-edit/{koperasi_id}/{id}', 'KumkmController@editDetail');
        Route::put('data-kumkm-detail/{koperasi_id}/{id}', 'KumkmController@doEditDetail');
        Route::delete('data-kumkm-detail-del/{id}', 'KumkmController@delDetail');
        Route::get('data-kumkm-report', 'KumkmController@report');
        Route::get('data-kumkm-laporan', 'KumkmController@laporan');
        Route::get('data-kumkm-export', 'KumkmController@export');

        Route::resource('sasaran-koperasi', 'SasaranProgramKoperasiController');
        Route::get('sasaran-koperasi-daftar/{id}', 'SasaranProgramKoperasiController@daftar');
        Route::post('sasaran-koperasi-lock/{id}', 'SasaranProgramKoperasiController@lock');
        Route::get('sasaran-koperasi-laporan', 'SasaranProgramKoperasiController@laporan');
        Route::get('sasaran-koperasi-export', 'SasaranProgramKoperasiController@export');

        Route::resource('sasaran-kumkm', 'SasaranProgramUmkmController');
        Route::get('sasaran-kumkm-daftar/{id}', 'SasaranProgramUmkmController@daftar');
        Route::post('sasaran-kumkm-lock/{id}', 'SasaranProgramUmkmController@lock');
        Route::get('sasaran-kumkm-laporan', 'SasaranProgramUmkmController@laporan');
        Route::get('sasaran-kumkm-export', 'SasaranProgramUmkmController@export');

        Route::resource('program-kerja', 'ProgramKerjaController');
        Route::post('program-kerja-lock/{id}', 'ProgramKerjaController@lock');
        Route::get('program-kerja-laporan', 'ProgramKerjaController@laporan');
        Route::get('program-kerja-export', 'ProgramKerjaController@export');

        Route::resource('pelaksanaan-pendampingan', 'PelaksanaanPendampinganController');
        Route::post('pelaksanaan-pendampingan-lock/{id}', 'PelaksanaanPendampinganController@lock');
        Route::get('pelaksanaan-pendampingan-laporan', 'PelaksanaanPendampinganController@laporan');
        Route::get('pelaksanaan-pendampingan-export', 'PelaksanaanPendampinganController@export');

        Route::get('pelaksanaan-pendampingan-laporan-bulanan', 'PelaksanaanPendampinganController@laporanBulanan');
        Route::get('pelaksanaan-pendampingan-laporan-bulanan-export', 'PelaksanaanPendampinganController@laporanBulananExport');

        Route::get('pelaksanaan-pendampingan-laporan-triwulan', 'PelaksanaanPendampinganController@laporanTriwulan');
        Route::get('pelaksanaan-pendampingan-laporan-triwulan-export', 'PelaksanaanPendampinganController@laporanTriwulanExport');

        Route::get('pelaksanaan-pendampingan-laporan-tahunan', 'PelaksanaanPendampinganController@laporanTahunan');

        Route::get('pelaksanaan-pendampingan-laporan-tahunan-export', 'PelaksanaanPendampinganController@laporanTahunanExport');
    });

    Route::group(['namespace' => 'Pengelolah', 'prefix' => 'manager', 'middleware' => ['pengelolah']], function () {
        Route::get('laporan-pendampingan-koperasi', 'LapsevenController@koperasi');
        Route::get('laporan-pendampingan-koperasi-print', 'LapsevenController@koperasiPrint');
        Route::get('laporan-pendampingan-umkm', 'LapsevenController@umkm');
        Route::get('laporan-pendampingan-umkm-print', 'LapsevenController@umkmPrint');

        Route::get('laporan-pendampingan-sasaran-koperasi', 'LapsevenController@sasaranKoperasi');
        Route::get('laporan-pendampingan-sasaran-koperasi-print', 'LapsevenController@sasaranKoperasiPrint');

        Route::get('laporan-pendampingan-sasaran-umkm', 'LapsevenController@sasaranUmkm');
        Route::get('laporan-pendampingan-sasaran-umkm-print', 'LapsevenController@sasaranUmkmPrint');

        Route::get('laporan-program-pendampingan', 'LapsevenController@programKerja');
        Route::get('laporan-program-pendampingan-print', 'LapsevenController@programKerjaPrint');

        Route::get('laporan-pelaksanaan-pendampingan', 'LapsevenController@pelaksanaan');
        Route::post('content-pelaksanaan-pendampingan', 'LapsevenController@getContentPelaksanaan');
        Route::get('laporan-pelaksanaan-pendampingan-print', 'LapsevenController@pelaksanaanPrint');

        Route::get('laporan-pelaksanaan-final', 'LapsevenController@pelaksanaanFinal');

        Route::get('laporan-pelaksanaan-bulanan-final', 'LapsevenController@pelaksanaanBulanan');
        Route::post('laporan-pelaksanaan-bulanan-show', 'LapsevenController@pelaksanaanBulananShow');
        Route::get('laporan-pelaksanaan-bulanan-print', 'LapsevenController@pelaksanaanBulananPrint');

        Route::get('laporan-pelaksanaan-triwulan-final', 'LapsevenController@pelaksanaanTriwulan');
        Route::post('laporan-pelaksanaan-triwulan-show', 'LapsevenController@pelaksanaanTriwulanShow');
        Route::get('laporan-pelaksanaan-triwulan-print', 'LapsevenController@pelaksanaanTriwulanPrint');

        Route::get('laporan-pelaksanaan-tahunan-final', 'LapsevenController@pelaksanaanTahunan');
        Route::post('laporan-pelaksanaan-tahunan-show', 'LapsevenController@pelaksanaanTahunanShow');
        Route::get('laporan-pelaksanaan-tahunan-print', 'LapsevenController@pelaksanaanTahunanPrint');

        Route::group(['prefix' => 'lembaga'], function () {
            Route::get('/profil', 'LembagaController@profile');
            Route::get('/profil/edit', 'LembagaController@editProfile');
            Route::put('profil/{id}/update', 'LembagaController@doUpdate');
            Route::get('export/word/{id}', 'LembagaController@exportWord');
        });

        Route::resource('proker-plut', 'ProkerPlutController');
        Route::get('proker-plut/report/all', 'ProkerPlutController@report');
        Route::get('proker-plut-lock/{id}', 'ProkerPlutController@doLock');

        Route::get('koperasi-laporan', 'KoperasiController@laporan');
        Route::get('koperasi-export', 'KoperasiController@export');

        Route::get('data-kumkm-laporan', 'KumkmController@laporan');
        Route::get('data-kumkm-export', 'KumkmController@export');

        Route::get('sasaran-koperasi-laporan', 'SasaranProgramKoperasiController@laporan');
        Route::get('sasaran-koperasi-export', 'SasaranProgramKoperasiController@export');

        Route::get('sasaran-kumkm-laporan', 'SasaranProgramUmkmController@laporan');
        Route::get('sasaran-kumkm-export', 'SasaranProgramUmkmController@export');

        Route::get('program-kerja-laporan', 'ProgramKerjaController@laporan');
        Route::get('program-kerja-export', 'ProgramKerjaController@export');

        Route::get('pelaksanaan-pendampingan-laporan', 'PelaksanaanPendampinganController@laporan');
        Route::get('pelaksanaan-pendampingan-export', 'PelaksanaanPendampinganController@export');

        Route::resource('kinerja', 'KinerjaController');
        Route::get('kinerja-list-ajax/{tahun}', 'KinerjaController@getListKinerja');
        Route::get('get-standart-konsultan/{tahun}', 'KinerjaController@getListStandartLayanan');

        Route::group(['prefix' => 'k/kegiatan'], function () {
            Route::get('/', 'KegiatanKonsultanController@getAll');
            Route::get('/create', 'KegiatanKonsultanController@addData');
            Route::post('/', 'KegiatanKonsultanController@doAddData');
            Route::get('/{id}', 'KegiatanKonsultanController@editData');
            Route::put('/{id}/update', 'KegiatanKonsultanController@doEditData');
            Route::get('/{id}/delete', 'KegiatanKonsultanController@deleteData');
            Route::get('report/all', 'KegiatanKonsultanController@report');
        });
    });

    //for admin
    Route::group(['namespace' => 'Admin', 'prefix' => 'adm', 'middleware' => ['admin']], function () {
        Route::get('laporan-pendampingan-koperasi', 'LapsevenController@koperasi');
        Route::get('laporan-pendampingan-koperasi-print', 'LapsevenController@koperasiPrint');
        Route::get('laporan-pendampingan-umkm', 'LapsevenController@umkm');
        Route::get('laporan-pendampingan-umkm-print', 'LapsevenController@umkmPrint');

        Route::get('laporan-pendampingan-sasaran-koperasi', 'LapsevenController@sasaranKoperasi');
        Route::get('laporan-pendampingan-sasaran-koperasi-print', 'LapsevenController@sasaranKoperasiPrint');

        Route::get('laporan-pendampingan-sasaran-umkm', 'LapsevenController@sasaranUmkm');
        Route::get('laporan-pendampingan-sasaran-umkm-print', 'LapsevenController@sasaranUmkmPrint');

        Route::get('laporan-program-pendampingan', 'LapsevenController@programKerja');
        Route::get('laporan-program-pendampingan-print', 'LapsevenController@programKerjaPrint');

        Route::get('laporan-pelaksanaan-pendampingan', 'LapsevenController@pelaksanaan');
        Route::post('content-pelaksanaan-pendampingan', 'LapsevenController@getContentPelaksanaan');
        Route::get('laporan-pelaksanaan-pendampingan-print', 'LapsevenController@pelaksanaanPrint');

        Route::get('laporan-pelaksanaan-final', 'LapsevenController@pelaksanaanFinal');

        Route::get('laporan-pelaksanaan-bulanan-final', 'LapsevenController@pelaksanaanBulanan');
        Route::post('laporan-pelaksanaan-bulanan-show', 'LapsevenController@pelaksanaanBulananShow');
        Route::get('laporan-pelaksanaan-bulanan-print', 'LapsevenController@pelaksanaanBulananPrint');

        Route::get('laporan-pelaksanaan-triwulan-final', 'LapsevenController@pelaksanaanTriwulan');
        Route::post('laporan-pelaksanaan-triwulan-show', 'LapsevenController@pelaksanaanTriwulanShow');
        Route::get('laporan-pelaksanaan-triwulan-print', 'LapsevenController@pelaksanaanTriwulanPrint');

        Route::get('laporan-pelaksanaan-tahunan-final', 'LapsevenController@pelaksanaanTahunan');
        Route::post('laporan-pelaksanaan-tahunan-show', 'LapsevenController@pelaksanaanTahunanShow');
        Route::get('laporan-pelaksanaan-tahunan-print', 'LapsevenController@pelaksanaanTahunanPrint');

        Route::resource('pelaksanaan-pendampingan', 'PelaksanaanPendampinganController');
        Route::get('pelaksanaan-pendampingan-laporan', 'PelaksanaanPendampinganController@laporan');
        Route::get('pelaksanaan-pendampingan-export', 'PelaksanaanPendampinganController@export');

        Route::get('pelaksanaan-pendampingan-laporan-bulanan', 'PelaksanaanPendampinganController@laporanBulanan');
        Route::get('pelaksanaan-pendampingan-laporan-bulanan-export', 'PelaksanaanPendampinganController@laporanBulananExport');

        Route::get('pelaksanaan-pendampingan-laporan-triwulan', 'PelaksanaanPendampinganController@laporanTriwulan');
        Route::get('pelaksanaan-pendampingan-laporan-triwulan-export', 'PelaksanaanPendampinganController@laporanTriwulanExport');

        Route::get('pelaksanaan-pendampingan-laporan-tahunan', 'PelaksanaanPendampinganController@laporanTahunan');

        Route::get('pelaksanaan-pendampingan-laporan-tahunan-export', 'PelaksanaanPendampinganController@laporanTahunanExport');

        Route::resource('program-kerja', 'ProgramKerjaController');
        Route::get('program-kerja-laporan', 'ProgramKerjaController@laporan');
        Route::get('program-kerja-export', 'ProgramKerjaController@export');

        Route::resource('sasaran-koperasi', 'SasaranProgramKoperasiController');
        Route::get('sasaran-koperasi-laporan', 'SasaranProgramKoperasiController@laporan');
        Route::get('sasaran-koperasi-export', 'SasaranProgramKoperasiController@export');

        Route::resource('sasaran-kumkm', 'SasaranProgramUmkmController');
        Route::get('sasaran-kumkm-laporan', 'SasaranProgramUmkmController@laporan');
        Route::get('sasaran-kumkm-export', 'SasaranProgramUmkmController@export');

        Route::resource('koperasi', 'KoperasiController');
        Route::get('koperasi-detail-add/{koperasi_id}', 'KoperasiController@addDetail');
        Route::post('koperasi-detail-add', 'KoperasiController@doAddDetail');
        Route::get('koperasi-detail-edit/{koperasi_id}/{id}', 'KoperasiController@editDetail');
        Route::put('koperasi-detail/{koperasi_id}/{id}', 'KoperasiController@doEditDetail');
        Route::delete('koperasi-detail-del/{id}', 'KoperasiController@delDetail');
        Route::get('koperasi-report', 'KoperasiController@report');
        Route::get('koperasi-laporan', 'KoperasiController@laporan');
        Route::get('koperasi-export', 'KoperasiController@export');

        Route::resource('data-kumkm', 'KumkmController');
        Route::get('data-kumkm-detail-add/{koperasi_id}', 'KumkmController@addDetail');
        Route::post('data-kumkm-add-detail', 'KumkmController@doAddDetail');
        Route::get('data-kumkm-detail-edit/{koperasi_id}/{id}', 'KumkmController@editDetail');
        Route::put('data-kumkm-detail/{koperasi_id}/{id}', 'KumkmController@doEditDetail');
        Route::delete('data-kumkm-detail-del/{id}', 'KumkmController@delDetail');
        Route::get('data-kumkm-report', 'KumkmController@report');
        Route::get('data-kumkm-laporan', 'KumkmController@laporan');
        Route::get('data-kumkm-export', 'KumkmController@export');

        Route::resource('proker-plut', 'ProkerPlutController');
        Route::get('proker-plut/report/all', 'ProkerPlutController@report');
        Route::get('proker-plut-lock/{id}', 'ProkerPlutController@doLock');

        Route::get('kinerja-admin', 'KinerjaKonsultanController@index');
        Route::get('get-list-kinerja/{tahun}', 'KinerjaKonsultanController@getListKinerja');

        Route::get('kegiatan-konsultan', 'KegiatanKonsultanController@index');
        Route::get('get-kegiatan-konsultan', 'KegiatanKonsultanController@getKegiatanKonsultan');

        Route::group(['prefix' => 'k/kegiatan'], function () {
            Route::get('/', 'KegiatanKonsultanController@getAll');
            Route::get('/create', 'KegiatanKonsultanController@addData');
            Route::post('/', 'KegiatanKonsultanController@doAddData');
            Route::get('/{id}', 'KegiatanKonsultanController@editData');
            Route::put('/{id}/update', 'KegiatanKonsultanController@doEditData');
            Route::get('/{id}/delete', 'KegiatanKonsultanController@deleteData');
            Route::get('report/all', 'KegiatanKonsultanController@report');
        });

        Route::get('proker-konsultan', 'ProkerKonsultanController@index');
        Route::get('get-proker-konsultan', 'ProkerKonsultanController@getProkerKonsultan');

        Route::get('proker-konsultan-view', 'ProkerKonsultanController@view');

        Route::resource('kinerja', 'KinerjaAdminController');
        Route::get('kinerja-list-ajax/{tahun}', 'KinerjaAdminController@getListKinerja');
        Route::get('get-standart-konsultan/{tahun}', 'KinerjaAdminController@getListStandartLayanan');

        /**
         * for lembaga
         */
        Route::group(['prefix' => 'lembaga'], function () {
            Route::get('/profil', 'LembagaController@profile');
            Route::get('/profil/edit', 'LembagaController@editProfile');
            Route::put('profil/{id}/update', 'LembagaController@doUpdate');
            Route::get('export/word/{id}', 'LembagaController@exportWord');
        });

        Route::group(['prefix' => 'sentra_binaan'], function () {
            Route::post('/', 'SentraBinaanController@doAddData');
            Route::get('/{id}', 'SentraBinaanController@editData');
            Route::put('/{id}/update', 'SentraBinaanController@doEditData');
            Route::get('/{id}/delete', 'SentraBinaanController@deleteData');
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

    Route::group(['prefix' => 'kumkm'], function () {
        Route::get('/', 'KumkmController@index');
        Route::get('/create', 'KumkmController@add');
        Route::post('/', 'KumkmController@doAdd');
        Route::get('/{id}', 'KumkmController@edit');
        Route::put('/{id}/update', 'KumkmController@doEdit');
        Route::get('/{id}/delete', 'KumkmController@delete');
        Route::get('/detail/{id}', 'KumkmController@detail');
        Route::put('/detail/{id}', 'KumkmController@doDetail');
        Route::get('report/all', 'KumkmController@report');
        Route::get('/{id}/show', 'KumkmController@show');
        Route::get('{id}/print', 'KumkmController@printData');
        Route::get('import/data', 'KumkmController@import');
        Route::post('import/data', 'KumkmController@doImport');
        Route::get('export/donwload/{type}', 'KumkmController@download');
    });
});
Auth::routes();

Route::get('migrationproker', function () {
    $proker = Proker_konsultan::all();
    $jml = 0;
    foreach ($proker as $key => $value) {
        $data = $value;
        $data->bidang_layanan_id = $value->konsultan->bidang_layanan_id;
        $data->save();
        $jml++;
    }
    return $jml;
});

Route::get('migrationkegiatan', function () {
    $kegiatan = Kegiatan_konsultan::all();
    $jml = 0;
    foreach ($kegiatan as $key => $value) {
        $data = $value;
        if ($value->konsultan) {
            $data->bidang_layanan_id = $value->konsultan->bidang_layanan_id;
            $data->save();
            $jml++;
        }
    }
    return $jml;
});

Route::get('migrationumkm', function () {
    $data = Kumkm::paginate();
    return $data;
});

Route::get('changedatekumkm', function () {
    $umkm = KumkmDetail::all();
    $jml = 1;
    foreach ($umkm as $row) {
        $u = $row;
        $u->tanggal_keadaan = '2017-12-31';
        $u->save();
        if ($u) {
            $jml++;
        }
    }
    return $jml;
});

Route::get('changedatekoperasi', function () {
    $kop = KoperasiDetail::all();
    $jml = 1;
    foreach ($kop as $row) {
        $u = $row;
        $u->tanggal_keadaan = '2017-12-31';
        $u->save();
        if ($u) {
            $jml++;
        }
    }
    return $jml;
});

Route::get('pleasedown',function(){
    Artisan::call('down');
});
