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
                    <form method="post" action="{{ url('k/kegiatan') }}" class="form-horizontal">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Tanggal Mulai/Selesai</label>
                            <div class="col-sm-3">
                                <div class="input-group date">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" name="tanggal_mulai" class="form-control pull-right datepicker">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="input-group date">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" name="tanggal_selesai" class="form-control pull-right datepicker">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Program Kerja</label>
                            <div class="col-sm-5">
                                <select class="form-control" id="proker_id" name="proker_id" required>
                                    <option value="">Pilih</option>
                                    @foreach($proker as $row)
                                        <option value="{{$row->id}}">{{$row->tahun_kegiatan}} {{ $row->program }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div id="ajaxDetailProker"></div>
                        <div class="form-group">
                            <div class="col-sm-2"></div>
                            <div class="col-sm-10">
                                <div id="ajaxDetailKegiatanProker"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Bidang Usaha</label>
                            <div class="col-sm-5">
                                <select class="form-control" name="bidang_usaha_id" required>
                                    <option value="">Pilih</option>
                                    @foreach($bidang_usaha as $row)
                                        <option value="{{$row->id}}">{{$row->name}}</option>
                                        @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Lokasi Kegiatan</label>
                            <div class="col-sm-5">
                                <input type="text" name="lokasi_kegiatan" class="form-control" placeholder="Lokasi kegiatan.." required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Jumlah Penerima Manfaat</label>
                            <div class="col-sm-2">
                                <input type="number" name="jumlah_peserta" class="form-control" placeholder="Jumlah.." required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Output</label>
                            <div class="col-sm-2">
                                <input type="number" name="output" class="form-control" placeholder="Jumlah.." required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Sumber Daya</label>
                            <div class="col-sm-5">
                                <input type="text" name="sumber_daya" class="form-control" placeholder="Sumber daya.." required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Mitra Kerja</label>
                            <div class="col-sm-5">
                                <textarea class="form-control" name="mitra_kegiatan" rows="4" placeholder="Mitra Kerja.." required></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Rencana Tindak Lanjut</label>
                            <div class="col-sm-5">
                                <textarea class="form-control" name="rencana_tindak_lanjut" rows="4" placeholder="Rencana Tindak Lanjut" required></textarea>
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
                <div id="loading" class="overlay" style="display: none;">
                    <i class="fa fa-refresh fa-spin"></i>
                </div>
            </div>
        </div>
    </div>
    <input type="hidden" id="urldetailproker" value="{{ url('common/detail/proker') }}">
    <input type="hidden" id="urldetaildproker" value="{{ url('common/detail/kegiatan') }}">
@endsection

@section('script')
    <script>
        urldetail = $('#urldetailproker').val();
        $('#proker_id').change(function(){
            $.ajax({
                beforeSend:function(){
                    $("#loading").show();
                },
                url: urldetail+'/'+this.value,
                type : 'GET',
                cache : false,
                dataType : 'html'
            })
                    .success(function(response){
                        $('#ajaxDetailProker').html(response);
                        $("#loading").hide();
                    })
        });

        function detailKegiatan(id)
        {
            urldetailkegiatan = $('#urldetaildproker').val();
            $.ajax({
                beforeSend:function(){
                    $("#loading").show();
                },
                url : urldetailkegiatan+'/'+id,
                type : 'GET',
                cache : false,
                dataType : 'html'
            })
                    .success(function(response){
                        $('#ajaxDetailKegiatanProker').html(response);
                        $("#loading").hide();
                    });
        }
    </script>
    @endsection