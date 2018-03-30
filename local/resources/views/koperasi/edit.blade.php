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
                    <h3 class="box-title">Edit Koperasi</h3>
                </div>
                <!-- / box Header -->
                <div class="box-body">
                    <form method="post" action="{{ url('koperasi/'.$data->id) }}" class="form-horizontal">
                        <input type="hidden" name="_method" value="PUT">
                        {{ csrf_field() }}
                        <div class="form-group {{$errors->has('nama_koperasi')?'has-error':''}}">
                            <label class="col-sm-2 control-label">Nama Koperasi</label>
                            <div class="col-sm-5">
                                <input type="text" name="nama_koperasi" class="form-control" placeholder="Isi dengan nama Koperasi" value="{{$data->nama_koperasi}}">
                                <span class="help-block">{{$errors->first('nama_koperasi')}}</span>
                            </div>
                        </div>
                        <div class="form-group {{$errors->has('alamat')?'has-error':''}}">
                            <label class="col-sm-2 control-label">Alamat</label>
                            <div class="col-sm-5">
                                <textarea name="alamat" placeholder="Alamat koperasi" class="form-control">{{$data->alamat}}</textarea>
                                <span class="help-block">{{$errors->first('alamat')}}</span>
                            </div>
                            <div class="col-sm-5">
                                <span class="help-block">Alamat Koperasi lengkap.</span>
                            </div>
                        </div>
                        <div class="form-group {{$errors->has('nomor_badan_hukum')?'has-error':''}}">
                            <label class="col-sm-2 control-label">Nomor Badan Hukum</label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" name="nomor_badan_hukum" placeholder="Nomor Badan Hukum " value="{{$data->nomor_badan_hukum}}">
                                <span class="help-block">{{$errors->first('nomor_badan_hukum')}}</span>
                            </div>
                            <div class="col-sm-5">
                                <span class="help-block">Nomor Badan Hukum Koperasi</span>
                            </div>
                        </div>
                        <div class="form-group {{$errors->has('tgl_badan_hukum')?'has-error':''}}">
                            <label class="col-sm-2 control-label">Tanggal Badan Hukum</label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" name="tgl_badan_hukum" placeholder="tanggal DD-MM-YYYY.." value="{{date('d-m-Y',strtotime($data->tgl_badan_hukum))}}" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask>
                                <span class="help-block">{{$errors->first('tgl_badan_hukum')}}</span>
                            </div>
                            <div class="col-sm-5">
                                <span class="help-block">Masukkan tanggal sesuai format DD-MM-YYYY</span>
                            </div>
                        </div>
                        <div class="form-group {{$errors->has('jenis_koperasi')?'has-error':''}}">
                            <label class="col-sm-2 control-label">Jenis Koperasi</label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" name="jenis_koperasi" placeholder="Jenis Koperasi" value="{{$data->jenis_koperasi}}">
                                <span class="help-block">{{$errors->first('jenis_koperasi')}}</span>
                            </div>
                            <div class="col-sm-5">
                                <span class="help-block">Jenis Koperasi</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-default">Simpan</button>
                                <a href="{{ url('koperasi/'.$data->id) }}" class="btn btn-default">Kembali</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
<script src="{{url('admin-lte/plugins/input-mask/jquery.inputmask.js')}}"></script>
<script src="{{url('admin-lte/plugins/input-mask/jquery.inputmask.date.extensions.js')}}"></script>
<script src="{{url('admin-lte/plugins/input-mask/jquery.inputmask.extensions.js')}}"></script>
@endsection
