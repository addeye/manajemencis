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
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">{{$title}}</h3>
                </div>
                <!-- / box Header -->
                <div class="box-body">
                    <form method="post" action="{{ url('adm/sentra/'.$data->id.'/update') }}" class="form-horizontal">
                        <input type="hidden" name="_method" value="PUT">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">ID Sentra</label>
                            <div class="col-sm-5">
                                <input type="text" name="id_sentra" value="{{$data->id_sentra}}" class="form-control" placeholder="ID Sentra.." required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Nama Sentra</label>
                            <div class="col-sm-5">
                                <input type="text" name="name" class="form-control" value="{{$data->name}}" placeholder="Nama Sentra.." required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Lembaga</label>
                            <div class="col-sm-5">
                                <select name="id_lembaga" class="form-control" required>
                                    <option value="">Pilih Lembaga</option>
                                    @foreach($lembagas as $row)
                                        <option value="{{$row->id}}" {{$data->id_lembaga==$row->id?'selected':''}}>{{$row->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Provinsi</label>
                            <div class="col-sm-5">
                                <select id="provinces_id" name="provinces_id" class="form-control" required>
                                    <option value="">Pilih Provinsi</option>
                                    @foreach($provinces as $row)
                                        <option value="{{$row->id}}" {{$data->provinces_id==$row->id?'selected':''}}>{{$row->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div id="ajaxRegencies">
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label">Kabupaten/Kota</label>
                                <div class="col-md-5">
                                    <select onchange="regencies(this.value)" class="form-control select2" name="regency_id" required>
                                        <option value="">Pilih Kabupaten/Kota</option>
                                        @foreach($regencies as $row)
                                            <option value="{{ $row->id }}" {{$row->id==$data->regency_id?'selected':''}}>{{ $row->id }} {{ $row->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div id="ajaxDistics">
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label">Kecamatan</label>
                                <div class="col-md-5">
                                    <select onchange="districts(this.value)" class="form-control select2" name="district_id" required>
                                        <option value="">Pilih Kecamatan</option>
                                        @foreach($districts as $row)
                                            <option value="{{ $row->id }}" {{$row->id==$data->district_id?'selected':''}} >{{ $row->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div id="ajaxVillages">
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label">Kelurahan</label>
                                <div class="col-md-5">
                                    <select class="form-control select2" name="village_id" required>
                                        <option value="">Pilih Kelurahan</option>
                                        @foreach($villages as $row)
                                            <option value="{{ $row->id }}" {{$row->id==$data->village_id?'selected':''}}>{{ $row->id }} {{ $row->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Alamat</label>
                            <div class="col-sm-5">
                                <textarea class="form-control" name="alamat" rows="4" placeholder="Alamat Sentra">{{$data->alamat}}</textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Tahun Berdiri</label>
                            <div class="col-sm-2">
                                <input type="text" class="form-control" value="{{$data->tahun_berdiri}}" name="tahun_berdiri">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Bidang Usaha</label>
                            <div class="col-sm-5">
                                <select name="bidang_usaha_id" class="form-control" required>
                                    <option value="">Pilih Bidang Usaha</option>
                                    @foreach($bidangusaha as $row)
                                        <option value="{{$row->id}}" {{$data->bidang_usaha_id==$row->id?'selected':''}} >{{$row->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Total UMKM</label>
                            <div class="col-sm-1">
                                <input type="number" class="form-control" name="total_umkm" value="{{$data->total_umkm}}" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Total Pegawai</label>
                            <div class="col-sm-1">
                                <input type="number" class="form-control" name="total_pegawai" value="{{$data->total_pegawai}}" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Omset / Bulan</label>
                            <div class="col-sm-4">
                                <input type="number" class="form-control" name="omset_bulan" value="{{$data->omset_bulan}}" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Teknologi</label>
                            <div class="col-sm-3">
                                <select name="teknologi" class="form-control" required>
                                    <option value="">Pilih Teknologi</option>
                                    <option value="Tradisional" {{$data->teknologi=='Tradisional'?'selected':''}}>Tradisional</option>
                                    <option value="Sederhana" {{$data->teknologi=='Sederhana'?'selected':''}}>Sederhana</option>
                                    <option value="Modern" {{$data->teknologi=='Modern'?'selected':''}}>Modern</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Asal Bahan Baku</label>
                            <div class="col-sm-3">
                                <select name="bahan_baku" class="form-control" required>
                                    <option value="">Pilih Teknologi</option>
                                    <option value="Lokal" {{$data->bahan_baku=='Lokal'?'selected':''}}>Lokal</option>
                                    <option value="Ekspor" {{$data->bahan_baku=='Ekspor'?'selected':''}}>Ekspor</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Pemasaran</label>
                            <div class="col-sm-3">
                                <select name="pemasaran" class="form-control" required>
                                    <option value="">Pilih Pemasaran</option>
                                    <option value="Lokal" {{$data->pemasaran=='Lokal'?'selected':''}}>Lokal</option>
                                    <option value="Ekspor" {{$data->pemasaran=='Ekspor'?'selected':''}}>Ekspor</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Kemitraan</label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" name="kemitraan" value="{{$data->kemitraan}}" placeholder="Kemitraan dengan.." required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Ketua Sentra</label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" name="nama_ketua" value="{{$data->nama_ketua}}" placeholder="Nama ketua.." required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label"></label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" name="notelp_ketua" value="{{$data->notelp_ketua}}" placeholder="No Telp ketua.." required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label"></label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" name="email_ketua" value="{{$data->email_ketua}}" placeholder="Email ketua.." required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Kontak Person</label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" name="name_cp" value="{{$data->name_cp}}" placeholder="Nama Kontak Person.." required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label"></label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" name="no_cp" value="{{$data->no_cp}}" placeholder="No Telp.." required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label"></label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" name="email_cp" value="{{$data->email_cp}}" placeholder="Email Kontak Person.." required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Pembina Sentra</label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" name="pembina_kementrian" value="{{$data->pembina_kementrian}}" placeholder="Kementrian / Lembaga.." required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label"></label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" name="pembina_bidang" value="{{$data->pembina_bidang}}" placeholder="Bidang.." required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label"></label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" name="pembina_tenaga_pendamping" value="{{$data->pembina_tenaga_pendamping}}" placeholder="Tenaga Pendamping.." required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Permasalahan Sentra</label>
                            <div class="col-sm-5">
                                <textarea class="form-control" name="masalah_kelembagaan" rows="4" placeholder="Permasalahan Kelembagaan..." required>{{$data->masalah_kelembagaan}}</textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label"></label>
                            <div class="col-sm-5">
                                <textarea class="form-control" name="masalah_sdm" rows="4" placeholder="Permasalahan SDM..." required>{{$data->masalah_sdm}}</textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label"></label>
                            <div class="col-sm-5">
                                <textarea class="form-control" name="masalah_produksi" rows="4" placeholder="Permasalahan Produksi..." required>{{$data->masalah_produksi}}</textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label"></label>
                            <div class="col-sm-5">
                                <textarea class="form-control" name="masalah_pembiayaan" rows="4" placeholder="Permasalahan Pembiayaan..." required>{{$data->masalah_pembiayaan}}</textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label"></label>
                            <div class="col-sm-5">
                                <textarea class="form-control" name="masalah_pemasaran" rows="4" placeholder="Permasalahan Pemasaran..." required>{{$data->masalah_pemasaran}}</textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-default">Update</button>
                                <button type="button" onclick="history.go(-1);" class="btn btn-default">Kembali</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection