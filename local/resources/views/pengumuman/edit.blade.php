<?php
/**
 * Created by PhpStorm.
 * User: deyelovi
 * Date: 08/03/2017
 * Time: 16:18
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
                    <form method="post" action="{{ url('pengumuman/'.$data->id) }}" class="form-horizontal">
                        <input type="hidden" name="_method" value="PUT">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Judul</label>
                            <div class="col-sm-5">
                                <input type="text" name="judul" class="form-control" placeholder="Judul pengumuman.." value="{{$data->judul}}" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Keterangan</label>
                            <div class="col-sm-5">
                                <textarea class="form-control" name="keterangan" placeholder="Keterangan..." required>{{$data->keterangan}}</textarea>
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
