<?php
/**
 * Created by PhpStorm.
 * User: deyelovi
 * Date: 18/03/2017
 * Time: 22:49
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
                    <form method="post" action="{{ url('kumkm/'.$data->id.'/update') }}" class="">
                        <input type="hidden" name="_method" value="PUT">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group {{$errors->has('id_kumkm')?'has-error':''}}">
                                    <label>ID KUMKM</label>
                                    <input type="text" name="id_kumkm" class="form-control" placeholder="ID KUMKM ..." value="{{$data->id_kumkm}}">
                                    <span class="help-block">{{$errors->first('id_kumkm')}}</span>
                                </div>
                                <div class="form-group {{$errors->has('nama_usaha')?'has-error':''}}">
                                    <label>Nama USAHA</label>
                                    <input type="text" name="nama_usaha" class="form-control" placeholder="Nama usaha..." value="{{$data->nama_usaha}}">
                                    <span class="help-block">{{$errors->first('nama_usaha')}}</span>
                                </div>
                            </div>
                            <!-- /.col -->
                            <div class="col-md-6">
                                <div class="form-group {{$errors->has('email')?'has-error':''}}">
                                    <label>Email</label>
                                    <input type="text" name="email" class="form-control" placeholder="Alamat email.." value="{{$data->email}}">
                                    <span class="help-block">{{$errors->first('email')}}</span>
                                </div>
                                <!-- /.form-group -->
                                <div class="form-group {{$errors->has('telp')?'has-error':''}}">
                                    <label>No Telp</label>
                                    <input type="text" name="telp" class="form-control" placeholder="No telp .." value="{{$data->telp}}">
                                    <span class="help-block">{{$errors->first('telp')}}</span>
                                </div>
                                <!-- /.form-group -->
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-default">
                                        <i class="fa fa-save"></i> Simpan
                                    </button>
                                    <a href="{{url('kumkm')}}" class="btn btn-default">
                                        <i class="fa fa-reply"></i> Kembali
                                    </a>
                                </div>
                                <div class="form-group">
                                    <label>*Password Default : 1234</label>
                                </div>
                            </div>
                            <!-- /.col -->
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

