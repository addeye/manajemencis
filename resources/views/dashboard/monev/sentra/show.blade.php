<?php
/**
 * Created by Sublime
 * User: Dio Putra
 * Date: 29/01/2017
 * Time: 23:54
 */

?>

@extends('layouts.master')

@section('content')

    <div class="row">
        <div class="col-xs-6">
            <div class="box box-info box-solid">
                <div class="box-header with-border">
                    <h3 class="box-title">Data Sentra</h3>
                </div>
                <!-- / box Header -->
                <div class="box-body">
                    <form method="post" action="{{ url('adm/sentra/'.$data->id.'/update') }}" class="form-horizontal">
                        <input type="hidden" name="_method" value="PUT">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-6 control-label">ID Sentra</label>
                            <div class="col-sm-6">
                                <p class="form-control-static">{{$data->id_sentra}}</p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-6 control-label">Nama Sentra</label>
                            <div class="col-sm-6">
                                <p class="form-control-static">{{$data->name}}</p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-6 control-label">Lembaga</label>
                            <div class="col-sm-6">
                                <p class="form-control-static">{{$data->lembagas->plut_name}}</p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-6 control-label">Provinsi</label>
                            <div class="col-sm-6">
                                <p class="form-control-static">{{$data->provinces->name}}</p>
                            </div>
                        </div>
                        <div id="ajaxRegencies">
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-6 control-label">Kabupaten/Kota</label>
                                <div class="col-md-6">
                                    <p class="form-control-static">{{$data->regencies->name}}</p>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-6 control-label">Kecamatan</label>
                            <div class="col-md-6">
                                <p class="form-control-static">{{$data->districts->name}}</p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-6 control-label">Kelurahan</label>
                            <div class="col-md-6">
                                <p class="form-control-static">{{$data->villages->name}}</p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-6 control-label">Alamat</label>
                            <div class="col-sm-6">
                                <p class="form-control-static">{{$data->alamat}}</p>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="box box-info box-solid">
                <div class="box-header with-border">
                    <h3 class="box-title">Data Anggota</h3>
                </div>
                <div class="box-body">
                    <div class="form-horizontal">
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-6 control-label">Ketua Sentra</label>
                            <div class="col-sm-6">
                                <p class="form-control-static"><i class="fa fa-user"></i> {{$data->nama_ketua}}</p>
                                <p class="form-control-static"><i class="fa fa-phone"></i> {{$data->notelp_ketua}}</p>
                                <p class="form-control-static"><i class="fa fa-envelope"></i> {{$data->email_ketua}}</p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-6 control-label">Kontak Person</label>
                            <div class="col-sm-6">
                                <p class="form-control-static"><i class="fa fa-user"></i> {{$data->name_cp}}</p>
                                <p class="form-control-static"><i class="fa fa-phone"></i> {{$data->no_cp}}</p>
                                <p class="form-control-static"><i class="fa fa-envelope"></i> {{$data->email_cp}}</p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-6 control-label">Pembina Sentra</label>
                            <div class="col-sm-6">
                                <p class="form-control-static">{{$data->pembina_kementrian}}</p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-6 control-label">Pembina Bidang</label>
                            <div class="col-sm-6">
                                <p class="form-control-static">{{$data->pembina_bidang}}</p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-6 control-label">Pembina Tenaga Pendamping</label>
                            <div class="col-sm-6">
                                <p class="form-control-static">{{$data->pembina_tenaga_pendamping}}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xs-6">
            <div class="box box-solid box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Profil Sentra</h3>
                </div>
                <div class="box-body">
                    <div class="form-horizontal">
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-6 control-label">Tahun Berdiri</label>
                            <div class="col-sm-6">
                                <p class="form-control-static">{{$data->tahun_berdiri}}</p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-6 control-label">Bidang Usaha</label>
                            <div class="col-sm-6">
                                <p class="form-control-static">{{$data->bidang_usahas->name}}</p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-6 control-label">Total UMKM</label>
                            <div class="col-sm-6">
                                <p class="form-control-static">{{number_format($data->total_umkm)}}</p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-6 control-label">Total Pegawai</label>
                            <div class="col-sm-6">
                                <p class="form-control-static">{{number_format($data->total_pegawai)}}</p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-6 control-label">Omset / Bulan</label>
                            <div class="col-sm-6">
                                <p class="form-control-static">{{number_format($data->omset_bulan)}}</p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-6 control-label">Teknologi</label>
                            <div class="col-sm-6">
                                <p class="form-control-static">{{$data->teknologi}}</p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-6 control-label">Asal Bahan Baku</label>
                            <div class="col-sm-6">
                                <p class="form-control-static">{{$data->bahan_baku}}</p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-6 control-label">Pemasaran</label>
                            <div class="col-sm-6">
                                <p class="form-control-static">{{$data->pemasaran}}</p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-6 control-label">Kemitraan</label>
                            <div class="col-sm-6">
                                <p class="form-control-static">{{$data->kemitraan}}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="box box-solid box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Permasalahan</h3>
                </div>
                <div class="box-body">
                    <div class="form-horizontal">
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-6 control-label">Kelembagaan</label>
                            <div class="col-sm-6">
                                <p class="form-control-static">{{$data->masalah_kelembagaan}}</p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-6 control-label">Bidang SDM</label>
                            <div class="col-sm-6">
                                <p class="form-control-static">{{$data->masalah_sdm}}</p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-6 control-label">Bidang Produksi</label>
                            <div class="col-sm-6">
                                <p class="form-control-static">{{$data->masalah_produksi}}</p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-6 control-label">Pembiayaan</label>
                            <div class="col-sm-6">
                                <p class="form-control-static">{{$data->masalah_pembiayaan}}</p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label"></label>
                            <div class="col-sm-5">
                                <p class="form-control-static">{{$data->masalah_pemasaran}}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection