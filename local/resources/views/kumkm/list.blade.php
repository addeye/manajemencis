<?php
/**
 * Created by PhpStorm.
 * User: deyelovi
 * Date: 18/03/2017
 * Time: 22:37
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
                    @if(Auth::user()->role_id != 1)
                    <div class="pull-right">
                        <a class="btn btn-primary" href="{{ url('kumkm/create') }}">
                            <i class="fa fa-plus"></i> Tambah Data
                        </a>
                    </div>
                    @endif
                </div>
                <!-- / box Header -->
                <div class="box-body table-responsive">
                    <table id="example" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th class="col-xs-1">No</th>
                            <th class="col-xs-2">ID KUMKM</th>
                            <th>Nama Usaha</th>
                            <th>Telp</th>
                            <th>Email</th>
                            <th>Detail</th>
                            <th>Aksi</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $no=1; ?>
                        @foreach($kumkm as $row)
                            <tr>
                                <td>{{$no++}}</td>
                                <td>{{$row->id_kumkm}}</td>
                                <td>{{$row->nama_usaha}}</td>
                                <td>{{$row->telp}}</td>
                                <td>{{$row->email}}</td>
                                <td>
                                    <a href="{{url('kumkm/'.$row->id.'/show')}}" class="btn btn-info btn-xs">Info</a>
                                </td>
                                <td>
                                    <a href="{{ url('kumkm/'.$row->id) }}" class="btn btn-success btn-xs" data-toggle="tooltip" data-placement="left" title="Form 1 {{$row->name}}">Form 1</a>
                                    <a href="{{url('kumkm/detail/'.$row->id)}}" class="btn btn-success btn-xs" data-toggle="tooltip" data-placement="left" title="Form 2 {{$row->name}}">Form 2</a>
                                    <a href="{{ url('kumkm/'.$row->id.'/delete') }}" onclick="return ConfirmDelete()" class="btn btn-danger btn-xs" data-toggle="tooltip" data-placement="left" title="Hapus Data {{$row->name}}">
                                        <i class="glyphicon glyphicon-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
