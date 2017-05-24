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
                    <form method="post" action="{{ url('k/dproker') }}" class="form-horizontal">
                        {{ csrf_field() }}
                        <input type="hidden" name="proker_id" value="{{ $proker->id }}">
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Nama Kegiatan</label>
                            <div class="col-sm-5">
                                <input type="text" name="jenis_kegiatan" class="form-control" placeholder="Nama kegiatan.." required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">IKU</label>
                            <div class="col-sm-5">
                                <select id="jenis_layanan_id" name="jenis_layanan_id" class="form-control">
                                    <option value="">Pilih IKU</option>
                                    @foreach($jenis_layanan as $row)
                                        <option value="{{$row->id}}">{{ $row->name }}</option>
                                        @endforeach
                                </select>
                            </div>
                        </div>
                        <div id="ajaxFormProsesOutput"></div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Jumlah Penerima Manfaat</label>
                            <div class="col-sm-2">
                                <input type="number" name="jml_penerima" class="form-control" placeholder="Jumlah penerima.." required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Jumlah Anggaran</label>
                            <div class="col-sm-2">
                                <input type="number" name="anggaran" class="form-control" placeholder="Anggaran.." required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Jadwal Pelaksana</label>
                            <div class="col-sm-5">
                                <select class="form-control select2" name="jadwal_pelaksana[]" multiple="multiple" data-placeholder="Pilih Jadwal Pelaksana" style="width: 100%;">
                                    <option value="">Pilih Minggu Ke</option>
                                    @for($i=1; $i<=56; $i++)
                                        <option value="{{ 'Minggu Ke-'.$i }}">{{ 'Minggu Ke-'.$i }}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Mitra Kerja</label>
                            <div class="col-sm-5">
                                {{--<input type="text" name="mitra_kerja" class="form-control" placeholder="Mitra Kerja.." required>--}}
                                <textarea rows="4" class="form-control" name="mitra_kerja" placeholder=""></textarea>
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
    <input type="hidden" id="url" value="{{url('common/proses_output')}}">
@endsection

@section('script')
    <script>
        $('#jenis_layanan_id').change(function(){
            var id = this.value;
            var url = $('#url').val();
            $.ajax({
                beforeSend:function(){
                    $("#loading").show();
                },
                url : url+'/'+id,
                type : 'GET',
                cache : false
            })
                    .success(function(response){
                        $('#ajaxFormProsesOutput').html(response);
                        $("#loading").hide();
                    });
        });
    </script>
    @endsection