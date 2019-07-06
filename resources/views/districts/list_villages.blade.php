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
            @include('layouts.alert')
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">{{ $title }}</h3>
                    @if(Auth::user()->role_id ==1)
                    <div class="pull-right">
                        <a class="btn btn-primary" href="{{ url('districts/villages/create/'.$district_id) }}">Tambah Data</a>
                    </div>
                    @endif
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="example" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>Kode</th>
                            <th class="col-xs-3">Kecamatan</th>
                            <th>Kelurahan</th>
                            @if(Auth::user()->role_id ==1)
                            <th>Action</th>
                            @endif
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($villages as $row)
                        <tr>
                            <td>{{ $row->id }}</td>
                            <td>{{ $row->districts->name }}</td>
                            <td>{{ $row->name }}</td>
                            @if(Auth::user()->role_id ==1)
                            <td>
                                <a href="{{ url('/districts/villages/'.$row->id) }}" class="btn btn-success btn-xs"><i class="glyphicon glyphicon-edit"></i></a>
                                <a href="{{ url('districts/'.$row->id.'/delete') }}" onclick="return ConfirmDelete()" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i></a>
                            </td>
                            @endif
                        </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
            <div class="text-center">
                <a href="{{ url('districts') }}" class="btn btn-warning btn-lg">Kembali</a>
            </div>
        </div>
        <!-- /.col -->
    </div>
@endsection