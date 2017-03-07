<?php
/**
 * Created by PhpStorm.
 * User: deyelovi
 * Date: 07/03/2017
 * Time: 12:39
 */
?>
@extends('layouts.master')

@section('content')

    <div class="row">
        <div class="col-xs-12">
            @include('layouts.alert')
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">{{$title}}</h3>
                </div>
                <!-- / box Header -->
                <div class="box-body">
                    <form method="post" action="{{ url('set_kontak') }}" class="form-horizontal">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Identitas</label>
                            <div class="col-sm-5">
                                <textarea class="form-control" name="identitas" rows="3">{{$data->identitas}}</textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Alamat</label>
                            <div class="col-sm-5">
                                <textarea class="form-control" name="alamat" rows="3">{{$data->alamat}}</textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
                            <div class="col-sm-5">
                                <input type="text" name="email" class="form-control" value="{{$data->email}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Website</label>
                            <div class="col-sm-5">
                                <input type="text" name="website" class="form-control" value="{{$data->website}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-default">
                                    <i class="fa fa-save"></i> Update
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
