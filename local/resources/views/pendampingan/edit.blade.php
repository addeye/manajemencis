<?php
/**
 * Created by PhpStorm.
 * User: deyelovi
 * Date: 09/04/2017
 * Time: 18:45
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
                    <form method="post" action="{{ url('pendampingan/'.$data->id) }}" class="form-horizontal">
                        <input type="hidden" name="_method" value="PUT">
                        {{ csrf_field() }}
                        <div class="form-group {{$errors->has('kumkm_id')?'has-error':''}}">
                            <label for="inputEmail3" class="col-sm-2 control-label">KUMKM</label>
                            <div class="col-sm-5">
                                <select name="kumkm_id" class="form-control select2">
                                    <option value="">Pilih KUMKM</option>
                                    @foreach($kumkm as $row)
                                        <option value="{{$row->id}}" {{$data->kumkm_id==$row->id?'selected':''}}>{{$row->nama_usaha}}</option>
                                    @endforeach
                                </select>
                                <span class="help-block">{{$errors->first('kumkm_id')}}</span>
                            </div>
                        </div>
                        <div id="ajaxDetailUmkm"></div>
                        <div class="form-group {{$errors->has('tanggal_pendampingan')?'has-error':''}}">
                            <label for="inputEmail3" class="col-sm-2 control-label">Tanggal Pendampingan</label>
                            <div class="col-sm-3">
                                <div class="input-group date">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" name="tanggal_pendampingan" class="form-control pull-right datepicker" value="{{$data->tanggal_pendampingan}}" readonly>
                                </div>
                                <span class="help-block">{{$errors->first('tanggal_pendampingan')}}</span>
                            </div>
                        </div>
                        <div class="form-group {{$errors->has('permasalahan')?'has-error':''}}">
                            <label for="inputEmail3" class="col-sm-2 control-label">Permasalahan</label>
                            <div class="col-sm-5">
                                <textarea name="permasalahan" class="form-control" rows="3" placeholder="Permasalahan">{{$data->permasalahan}}</textarea>
                                <span class="help-block">{{$errors->first('permasalahan')}}</span>
                            </div>
                        </div>
                        <div class="form-group {{$errors->has('saran_tindakan')?'has-error':''}}">
                            <label for="inputEmail3" class="col-sm-2 control-label">Saran / Tindakan</label>
                            <div class="col-sm-5">
                                <textarea name="saran_tindakan" class="form-control" rows="3" placeholder="Saran / tindakan..">{{$data->saran_tindakan}}</textarea>
                                <span class="help-block">{{$errors->first('saran_tindakan')}}</span>
                            </div>
                        </div>
                        <div class="form-group {{$errors->has('tindak_lanjut')?'has-error':''}}">
                            <label for="inputEmail3" class="col-sm-2 control-label">Tindak Lanjut</label>
                            <div class="col-sm-5">
                                <textarea name="tindak_lanjut" class="form-control" rows="3" placeholder="Tindak lanjut..">{{$data->tindak_lanjut}}</textarea>
                                <span class="help-block">{{$errors->first('tindak_lanjut')}}</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-default">
                                    <i class="fa fa-save"></i> Simpan
                                </button>
                                <button type="button" onclick="history.go(-1);" class="btn btn-default">
                                    <i class="fa fa-reply"></i> Kembali
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
