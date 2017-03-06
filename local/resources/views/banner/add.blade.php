<?php
/**
 * Created by PhpStorm.
 * User: deyelovi
 * Date: 06/03/2017
 * Time: 14:44
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
                    <form method="post" action="{{ url('sbanner') }}" class="form-horizontal" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Keterangan</label>
                            <div class="col-sm-5">
                                <textarea name="keterangan" class="form-control" required></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Gambar</label>
                            <div class="col-sm-5">
                                <input type="file" name="image" required>
                                <p class="text-danger">{{ $errors->first('image') }}</p>
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
