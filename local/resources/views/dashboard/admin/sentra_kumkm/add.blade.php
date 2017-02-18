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
                    <form method="post" action="{{ url('adm/sentra') }}" class="form-horizontal">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">ID Sentra</label>
                            <div class="col-sm-5">
                                <input type="text" name="id_sentra" class="form-control" placeholder="ID Sentra.." required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Nama Sentra</label>
                            <div class="col-sm-5">
                                <input type="text" name="name" class="form-control" placeholder="Nama Sentra.." required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Kabupaten Kota</label>
                            <div class="col-sm-5">
                                <select onchange="regencies(this.value)" name="regency_id" class="form-control select2" required>
                                    <option value="">Pilih Kabupaten Kota</option>
                                    @foreach($regencies as $row)
                                        <option value="{{$row->id}}">{{$row->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div id="ajaxDistics"></div>
                        <div id="ajaxVillages"></div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Alamat</label>
                            <div class="col-sm-5">
                                <textarea class="form-control" name="alamat" rows="4" placeholder="Alamat Sentra"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Tahun Berdiri</label>
                            <div class="col-sm-2">
                                <input type="text" class="form-control datemaskyear" name="tahun_berdiri">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Bidang Usaha</label>
                            <div class="col-sm-5">
                                <select name="bidang_usaha_id" class="form-control" required>
                                    <option value="">Pilih Bidang Usaha</option>
                                    @foreach($bidangusaha as $row)
                                        <option value="{{$row->id}}">{{$row->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Total UMKM</label>
                            <div class="col-sm-1">
                                <input type="number" class="form-control" name="total_umkm" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Total Pegawai</label>
                            <div class="col-sm-1">
                                <input type="number" class="form-control" name="total_pegawai" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Omset / Bulan</label>
                            <div class="col-sm-4">
                                <input type="number" class="form-control" name="omset_bulan" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Teknologi</label>
                            <div class="col-sm-3">
                                <select name="teknologi" class="form-control" required>
                                    <option value="">Pilih Teknologi</option>
                                    <option value="Tradisional">Tradisional</option>
                                    <option value="Teknologi Tepat Guna">Teknologi Tepat Guna</option>
                                    <option value="Modern">Modern</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Asal Bahan Baku</label>
                            <div class="col-sm-3">
                                <select name="bahan_baku" class="form-control" required>
                                    <option value="">Pilih Teknologi</option>
                                    <option value="Lokal">Lokal</option>
                                    <option value="Ekspor">Impor</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Pemasaran</label>
                            <div class="col-sm-3">
                                <select name="pemasaran" class="form-control" required>
                                    <option value="">Pesamaran</option>
                                    <option value="Lokal">Lokal</option>
                                    <option value="Ekspor">Ekspor</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Kemitraan</label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" name="kemitraan" placeholder="Kemitraan dengan.." required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Ketua Sentra</label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" name="nama_ketua" placeholder="Nama ketua.." required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label"></label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" name="notelp_ketua" placeholder="No Telp ketua.." required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label"></label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" name="email_ketua" placeholder="Email ketua.." required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Kontak Person</label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" name="name_cp" placeholder="Nama Kontak Person.." required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label"></label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" name="no_cp" placeholder="No Telp.." required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label"></label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" name="email_cp" placeholder="Email Kontak Person.." required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Pembina Sentra</label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" name="pembina_kementrian" placeholder="Kementrian / Lembaga.." required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label"></label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" name="pembina_bidang" placeholder="Bidang.." required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label"></label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" name="pembina_tenaga_pendamping" placeholder="Tenaga Pendamping.." required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Permasalahan Sentra</label>
                            <div class="col-sm-5">
                                <textarea class="form-control" name="masalah_kelembagaan" rows="4" placeholder="Permasalahan Kelembagaan..." required></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label"></label>
                            <div class="col-sm-5">
                                <textarea class="form-control" name="masalah_sdm" rows="4" placeholder="Permasalahan SDM..." required></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label"></label>
                            <div class="col-sm-5">
                                <textarea class="form-control" name="masalah_produksi" rows="4" placeholder="Permasalahan Produksi..." required></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label"></label>
                            <div class="col-sm-5">
                                <textarea class="form-control" name="masalah_pembiayaan" rows="4" placeholder="Permasalahan Pembiayaan..." required></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label"></label>
                            <div class="col-sm-5">
                                <textarea class="form-control" name="masalah_pemasaran" rows="4" placeholder="Permasalahan Pemasaran..." required></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-default">Simpan</button>
                                <button type="button" onclick="history.go(-1);" class="btn btn-default">Kembali</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <input type="hidden" id="urlRegencies" value="{{url('common/regencies')}}">
    <input type="hidden" id="urlDisticts" value="{{ url('common/districts') }}">
    <input type="hidden" id="urlVillages" value="{{ url('common/villages') }}">
@endsection

@section('script')
    <script>
        var urlRegencies = $('#urlRegencies').val();
        var urlDisticts = $('#urlDisticts').val();
        var urlVillages = $('#urlVillages').val();
        $('#provinces_id').change(function(){
            $.ajax({
                url : urlRegencies+'/'+this.value,
                type : 'GET',
                cache : false
            })
                    .success(function(response){
                        $('#ajaxRegencies').html(response);
                    });
        });

        function regencies(id)
        {
            $.ajax({
                url : urlDisticts+'/'+id,
                type : 'GET',
                cache : false
            })
                    .success(function(response){
                        $('#ajaxDistics').html(response);
                    });
        }

        function districts(id)
        {
            $.ajax({
                url : urlVillages+'/'+id,
                type : 'GET',
                cache : false
            })
                    .success(function(response){
                        $('#ajaxVillages').html(response);
                    });
        }
    </script>
    @endsection