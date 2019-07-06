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
            @include('layouts.alert')
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Edit Program Kerja Pendampingan</h3>
                    <div class="pull-right">
                        <a class="btn btn-info" href="{{ url('program-kerja') }}">
                            <i class="fa fa-list"></i> Program Kerja
                        </a>
                    </div>
                </div>
                <!-- / box Header -->
                <div class="box-body">
                    <form method="post" action="{{ url('program-kerja/'.$data->id) }}" class="form-horizontal">
                        <input type="hidden" name="_method" value="PUT">
                        {{ csrf_field() }}
                        <div class="form-group {{$errors->has('sasaran_program_id')?'has-error':''}}">
                            <label class="col-sm-2 control-label">Koperasi / UMKM</label>
                            <div class="col-sm-5">
                                <select name="sasaran_program_id" class="form-control select2">
                                <option value="">Pilih KUMKM</option>
                                @foreach($sasaran_program as $row)
                                    <option value="{{$row->id}}" {{$data->sasaran_program_id==$row->id?'selected':''}}>{{$row->ukmtable->nama_kumkm}}</option>
                                @endforeach
                            </select>
                            <span class="help-block">{{$errors->first('sasaran_program_id')}}</span>
                            </div>
                            <div class="col-sm-5">
                                <span class="help-block">Pilih Koperasi / UMKM Yang Telah terdaftar dan Locked</span>
                            </div>
                        </div>
                        <div class="form-group {{$errors->has('bidang_layanan_id')?'has-error':''}}">
                            <label class="col-sm-2 control-label">Bidang Layanan</label>
                            <div class="col-sm-5">
                                <select name="bidang_layanan_id" class="form-control select2">
                                <option value="">Pilih Bidang</option>
                                @foreach($bidang_layanan as $row)
                                    <option value="{{$row->id}}" {{$data->bidang_layanan_id==$row->id?'selected':''}}>{{$row->name}}</option>
                                @endforeach
                            </select>
                            <span class="help-block">{{$errors->first('bidang_layanan_id')}}</span>
                            </div>
                            <div class="col-sm-5">
                                <span class="help-block">Pilih Bidang Layanan Permasalahan</span>
                            </div>
                        </div>
                        <div class="form-group {{$errors->has('permasalahan')?'has-error':''}}">
                            <label class="col-sm-2 control-label">Identifikasi Permasalahan</label>
                            <div class="col-sm-5">
                                <textarea class="form-control" name="permasalahan" placeholder="Permasalahan...">{{$data->permasalahan}}</textarea>
                                <span class="help-block">{{$errors->first('permasalahan')}}</span>
                            </div>
                            <div class="col-sm-5">
                                <span class="help-block">Identifikasi Permasalahan Berdasarkan bidang layanan</span>
                            </div>
                        </div>
                        <div class="form-group {{$errors->has('proker_pendampingan')?'has-error':''}}">
                            <label class="col-sm-2 control-label">Proker Pendampingan</label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" name="proker_pendampingan" placeholder="Program Kerja Pendampingan {{date('Y')}}" value="{{$data->proker_pendampingan}}">
                                <span class="help-block">{{$errors->first('alamat')}}</span>
                            </div>
                            <div class="col-sm-5">
                                <span class="help-block">Program Kerja Pendampingan Max 255 Karakter</span>
                            </div>
                        </div>
                        <div class="form-group {{$errors->has('target_capaian')?'has-error':''}}">
                            <label class="col-sm-2 control-label">Target Capaian</label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" name="target_capaian" placeholder="Target Capaian.." value="{{$data->target_capaian}}">
                                <span class="help-block">{{$errors->first('target_capaian')}}</span>
                            </div>
                            <div class="col-sm-5">
                                <span class="help-block">Target Capaian Max 255 Karakter</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-default">Simpan</button>
                                <a href="{{ url('program-kerja') }}" class="btn btn-default">Kembali</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
<!-- InputMask -->
<script src="{{url('admin-lte/plugins/input-mask/jquery.inputmask.js')}}"></script>
<script src="{{url('admin-lte/plugins/input-mask/jquery.inputmask.date.extensions.js')}}"></script>
<script src="{{url('admin-lte/plugins/input-mask/jquery.inputmask.extensions.js')}}"></script>
<script type="text/javascript">
    $('#proker_id').change(function(){
        var url = '{{url('proker_id/')}}';
        var id = this.value;
        // alert(id);
        $.get(url+'/'+id, function(response){
            console.log(response);
           $('input[name=kegiatan]').val(response.program);
           $('textarea[name=tujuan]').val(response.tujuan);
           $('textarea[name=sasaran]').val(response.sasaran);
           $('input[name=jumlah_sasaran]').val(response.jumlah_sasaran);
           $('input[name=indikator]').val(response.indikator);
           $('textarea[name=output]').val(response.output);
        });
    });
</script>
@endsection