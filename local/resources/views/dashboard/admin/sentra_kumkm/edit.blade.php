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
                    <form method="post" action="{{ url('admin/'.$data->id.'/update') }}" class="form-horizontal">
                        <input type="hidden" name="_method" value="PUT">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Nama Lengkap</label>
                            <div class="col-sm-5">
                                <input type="text" name="nama_lengkap" class="form-control" value="{{$data->nama_lengkap}}" placeholder="Nama lengkap anda.." required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">No Telp</label>
                            <div class="col-sm-5">
                                <input type="text" name="no_telp" class="form-control" value="{{ $data->no_telp }}" placeholder="No Telepon anda.." required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
                            <div class="col-sm-5">
                                <input type="text" name="email" class="form-control" value="{{$data->email}}" placeholder="Email anda.." required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Lembaga</label>
                            <div class="col-sm-5">
                                <select name="lembaga_id" class="form-control" required>
                                    <option value="">Pilih Lembaga</option>
                                    @foreach($lembaga as $row)
                                        <option value="{{$row->id}}" {{$data->lembaga_id==$row->id?'selected':''}} >{{$row->name}}</option>
                                    @endforeach
                                </select>
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