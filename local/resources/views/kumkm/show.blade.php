<?php
/**
 * Created by PhpStorm.
 * User: deyelovi
 * Date: 27/03/2017
 * Time: 12:49
 */
?>
@extends('layouts.master')

@section('content')

    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">{{$title}}</h3>
                </div>
                <!-- / box Header -->
                <div class="box-body">
                    <form method="post" action="{{ url('kumkm/'.$data->id.'/update') }}" class="" enctype="multipart/form-data">
                        <input type="hidden" name="_method" value="PUT">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-md-6">
                                <div class="box box-solid">
                                    <div class="box-header with-border">
                                        <i class="fa fa-home"></i>
                                        <h3 class="box-title">Profil</h3>
                                    </div>
                                    <!-- /.box-header -->
                                    <div class="box-body">
                                        <dl>
                                            <dt>Nama Usaha</dt>
                                            <dd>{{$data->nama_usaha}}</dd>
                                            <dt>ID KUMKM</dt>
                                            <dd>{{$data->id_kumkm}}</dd>
                                            <dt>Nama Pemilik</dt>
                                            <dd>{{$data->nama_pemilik}}</dd>
                                            <dt>No Telepon</dt>
                                            <dd>{{$data->telp}}</dd>
                                            <dt>No KTP</dt>
                                            <dd>{{$data->no_ktp}}</dd>
                                            <dt>NPWP</dt>
                                            <dd>{{$data->npwp}}</dd>
                                            <dt>Email</dt>
                                            <dd>{{$data->email}}</dd>
                                            <dt>Badan Usaha</dt>
                                            <dd>{{$data->badan_usaha}}</dd>
                                            <dt>No Pengesahan Badan Usaha</dt>
                                            <dd>{{$data->ket_badan_usaha}}</dd>
                                            <dt>Tanggal Mulai Usaha</dt>
                                            <dd>{{$data->tgl_mulai_usaha}}</dd>
                                            <dt>Bidang Usaha</dt>
                                            <dd>{{$data->bidang_usaha}}</dd>
                                            <dt>Skala Usaha</dt>
                                            <dd>{{$data->skala_usaha}}</dd>
                                            <dt>Usaha Utama</dt>
                                            <dd>{{$data->usaha_utama}}</dd>
                                            <dt>Hasil Produk</dt>
                                            <dd>{{$data->hasil_produk}}</dd>
                                            <dt>Sentra</dt>
                                            <dd>{{$data->sentra}}</dd>
                                            <dt>Sentra ID</dt>
                                            <dd>{{$data->sentra_id}}</dd>
                                            <dt>Tenaga Kerja Tetap</dt>
                                            <dd>{{$data->tk_tetap}}</dd>
                                            <dt>Tenaga Kerja Tidak Tetap</dt>
                                            <dd>{{$data->tk_tidak_tetap}}</dd>
                                            <dt>Alamat</dt>
                                            <dd>{{$data->alamat}}</dd>
                                            <dt>Provinsi</dt>
                                            <dd>{{$data->provinces_id}}</dd>
                                            <dt>Kabupaten/Kota</dt>
                                            <dd>{{$data->regency_id}}</dd>
                                            <dt>Kecamatan</dt>
                                            <dd>{{$data->district_id}}</dd>
                                            <dt>Kelurahan</dt>
                                            <dd>{{$data->village_id}}</dd>
                                        </dl>
                                    </div>
                                    <!-- /.box-body -->
                                </div>

                                <div class="box box-solid">
                                    <div class="box-header with-border">
                                        <i class="fa fa-shopping-cart"></i>
                                        <h3 class="box-title">JENIS PRODUK</h3>
                                    </div>
                                    <!-- /.box-header -->
                                    <div class="box-body">
                                        <dl>
                                            <label>Produk 1</label>
                                            <dt>Nama Produk</dt>
                                            <dd>{{$data->p1_nama_produk}}</dd>
                                            <dt>Deskripsi</dt>
                                            <dd>{{$data->p1_deskripsi}}</dd>
                                            <dt>Harga</dt>
                                            <dd>{{$data->p1_harga}}</dd>
                                            <dt>Foto Produk</dt>
                                            <dd>{{$data->p1_foto_produk}}</dd>
                                            <hr>
                                            <label>Produk 2</label>
                                            <dt>Nama Produk</dt>
                                            <dd>{{$data->p2_nama_produk}}</dd>
                                            <dt>Deskripsi</dt>
                                            <dd>{{$data->p2_deskripsi}}</dd>
                                            <dt>Harga</dt>
                                            <dd>{{$data->p2_harga}}</dd>
                                            <dt>Foto Produk</dt>
                                            <dd>{{$data->p2_foto_produk}}</dd>
                                            <hr>
                                            <label>Produk 3</label>
                                            <dt>Nama Produk</dt>
                                            <dd>{{$data->p3_nama_produk}}</dd>
                                            <dt>Deskripsi</dt>
                                            <dd>{{$data->p3_deskripsi}}</dd>
                                            <dt>Harga</dt>
                                            <dd>{{$data->p3_harga}}</dd>
                                            <dt>Foto Produk</dt>
                                            <dd>{{$data->p3_foto}}</dd>
                                            <dt>PERIZINAN/STANDAR PRODUK (SERTIFIKASI HALAL, PIRT, BPOM, SNI, ISO)</dt>
                                            <dd>{{$data->izin_produk}}</dd>
                                            <label>PERIZINAN USAHA</label>
                                            <dt>IUMK</dt>
                                            <dd>{{$data->izin_usaha_iumk}}</dd>
                                            <dt>SIUI</dt>
                                            <dd>{{$data->izin_usaha_siui}}</dd>
                                            <dt>SIUP</dt>
                                            <dd>{{$data->izin_usaha_siup}}</dd>
                                            <dt>LEGALITAS LOKASI USAHA</dt>
                                            <dd>{{$data->legalitas_lokasi}}</dd>
                                            <dt>JANGKAUAN PEMASARAN (LOKAL PROVINSI,NASIONAL, EKSPOR)</dt>
                                            <dd>{{$data->jangkauan_pasar?$data->jangkauan_pasar:'-'}}</dd>
                                        </dl>
                                    </div>
                                    <!-- /.box-body -->
                                </div>
                                <!-- /.box -->
                            </div>
                            <!-- ./col -->
                            <div class="col-md-6">
                                <div class="box box-solid">
                                    <div class="box-header with-border">
                                        <i class="fa fa-money"></i>
                                        <h3 class="box-title">Keuangan</h3>
                                    </div>
                                    <!-- /.box-header -->
                                    <div class="box-body">
                                        <dl>
                                            <label>HARTA/ASET</label>
                                            <dt>KAS TUNAI + KAS BANK</dt>
                                            <dd>{{$data->kas_tunai}}</dd>
                                            <dt>PERSEDIAAN (BAHAN BKAU + PRODUK)</dt>
                                            <dd>{{$data->persediaan}}</dd>
                                            <dt>HARGA TETAP (TANAH, BANGUNAN, MESIN, dan KENDARAAN)</dt>
                                            <dd>{{$data->harga_tetap}}</dd>
                                            <hr>
                                            <label>KEWAJIBAN / PINJAMAN</label>
                                            <dt>BANK</dt>
                                            <dd>{{$data->kw_bank}}</dd>
                                            <dt>KOPERASI</dt>
                                            <dd>{{$data->kw_koperasi}}</dd>
                                            <dt>LAINNYA</dt>
                                            <dd>{{$data->kw_lainnya}}</dd>
                                            <hr>
                                            <label>KEPEMILIKAN TANAH</label>
                                            <dt>SERTIFIKAT (SHM)</dt>
                                            <dd>{{$data->kp_sertifikat}}</dd>
                                            <dt>TIDAK SHM</dt>
                                            <dd>{{$data->kp_tidak_sertifikat}}</dd>
                                            <hr>
                                            <label>OMSET / PENDAPATAN PENJUALAN DALAM 1 TAHUN</label>
                                            <dt>1 TAHUN YANG LALU</dt>
                                            <dd>{{$data->om_1thn_lalu}}</dd>
                                            <dt>2 TAHUN YANG LALU</dt>
                                            <dd>{{$data->om_2thn_lalu}}</dd>
                                            <hr>
                                            <label>LABA / KEUNTUNGAN DALAM 1 TAHUN</label>
                                            <dt>1 TAHUN YANG LALU</dt>
                                            <dd>{{$data->lb_1thn_lalu}}</dd>
                                            <dt>2 TAHUN YANG LALU</dt>
                                            <dd>{{$data->lb_2thn_lalu}}</dd>
                                            <dt>MEMBUAT LAPORAN KEUANGAN SECARA REGULER</dt>
                                            <dd>{{$data->laporan_regular?'Iya':'Tidak'}}</dd>
                                        </dl>
                                    </div>
                                    <!-- /.box-body -->
                                </div>
                                <div class="box box-solid">
                                    <div class="box-header with-border">
                                        <i class="fa fa-users"></i>
                                        <h3 class="box-title">PENDAMPINGAN</h3>
                                    </div>
                                    <!-- /.box-header -->
                                    <div class="box-body">
                                        <dl>
                                            <dt>PENDAMPINGAN YANG PERNAH DITERIMA</dt>
                                            <dd>{{$data->terima_pendampingan}}</dd>
                                            <hr>
                                            <label>PERMASALAHAN YANG DIHADAPI SAAT INI</label>
                                            <dt>KELEMBAGAAN USAHA</dt>
                                            <dd>{{$data->masalah_lembaga}}</dd>
                                            <dt>SDM</dt>
                                            <dd>{{$data->masalah_sdm}}</dd>
                                            <dt>PRODUKSI</dt>
                                            <dd>{{$data->masalah_produksi}}</dd>
                                            <dt>PEMBIAYAAN</dt>
                                            <dd>{{$data->masalah_pembiayaan}}</dd>
                                            <dt>PEMASARAN</dt>
                                            <dd>{{$data->masalah_pemasaran}}</dd>
                                            <dt>LAINNYA</dt>
                                            <dd>{{$data->masalah_lainnya}}</dd>
                                        </dl>
                                    </div>
                                    <!-- /.box-body -->
                                </div>
                                <!-- /.box -->
                            </div>
                            <!-- ./col -->
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
