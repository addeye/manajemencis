<?php
/**
 * Created by PhpStorm.
 * User: deyelovi
 * Date: 27/01/2017
 * Time: 23:29
 */
?>
@extends('layouts.master')

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">{{ $title }}</h3>
                    @if(Auth::user()->role_id ==1)
                    <div class="pull-right">
                        <a class="btn btn-primary" href="{{ url('districts/create') }}">Tambah Data</a>
                    </div>
                    @endif
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="example" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th class="col-xs-1">Kode</th>
                            <th class="col-xs-3">Kabupaten/Kota</th>
                            <th>Kecamatan</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($districts as $row)
                        <tr>
                            <td>{{ $row->id }}</td>
                            <td>{{ $row->regencies->name }}</td>
                            <td>{{ $row->name }}</td>
                            <td>
                                <a href="{{ url('districts/'.$row->id.'/villages') }}" class="btn btn-info btn-xs"><i class="glyphicon glyphicon-list"></i> Kelurahan</a>
                                @if(Auth::user()->role_id ==1)
                                <a href="{{ url('districts/'.$row->id) }}" class="btn btn-success btn-xs"><i class="glyphicon glyphicon-edit"></i></a>
                                <a href="{{ url('districts/'.$row->id.'/delete') }}" onclick="return ConfirmDelete()" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i></a>
                                @endif
                            </td>
                        </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->
    </div>
@endsection