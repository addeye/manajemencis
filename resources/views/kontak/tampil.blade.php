<?php
/**
 * Created by PhpStorm.
 * User: deyelovi
 * Date: 07/03/2017
 * Time: 13:10
 */
?>

@extends('layouts.beranda.master')

@section('content')
    <div class="box box-default">
        <div class="box-header with-border">
            <h3 class="box-title">Kontak</h3>
        </div>
        <div class="box-body">
            <p>{{$data->identitas}}</p>
            <p><i class="glyphicon glyphicon-map-marker"></i> {{$data->alamat}}</p>
            <p><a target="_blank" href="http://{{$data->website}}"><i class="glyphicon glyphicon-globe"></i> {{$data->website}}</a></p>
            <p><i class="glyphicon glyphicon-send"></i> {{$data->email}}</p>
        </div>
        <div class="box-footer">
            <a href="{{url('/')}}" class="btn btn-default">Kembali</a>
        </div>
        <!-- /.box-body -->
    </div>
@endsection

