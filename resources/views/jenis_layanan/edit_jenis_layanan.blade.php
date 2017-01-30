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
                    <form method="post" action="{{ url('bidanglayanan/'.$data->id.'/update') }}" class="form-horizontal">
                        <input type="hidden" name="_method" value="PUT">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Nama Bidang Layanan</label>
                            <div class="col-sm-5">
                                <select name="bidang_layanan_id" class="form-control" required>
                                    <option value="">Pilih Bidang Layanan</option>
                                    @foreach($bidang as $row)
                                        <option value="{{ $row->id }}" {{ $data->bidang_layanan_id==$row->id?'selected':'' }} >{{ $row->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Nama Jenis Layanan</label>
                            <div class="col-sm-5">
                                <input type="text" name="name" class="form-control" placeholder="Nama Bidang Layanan.." value="{{ $data->name }}" required>
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
@endsection