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
                    <div class="pull-right">
                        <a href="{{ url('lembaga/create') }}">Tambah Data</a>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table class="table table-bordered table-striped datatables-class">
                        <thead>
                        <tr>
                            <th class="col-xs-1">ID</th>
                            <th>Nama</th>
                            <th>Kabupaten/Kota</th>
                            <th>Provinsi</th>
                            <th>Status</th>
                            <th>Tahun</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($lembaga as $row)
                        <tr>
                            <td>{{ $row->idlembaga }}</td>
                            <td>{{ $row->name }}</td>
                            <td>{{ $row->regencies->name }}</td>
                            <td>{{ $row->provinces->name }}</td>
                            <td>{{ $row->tingkats->name }}</td>
                            <td>{{ $row->tahun_berdiri }}</td>
                            <td>
                                <a href="{{ url('lembaga/'.$row->id.'/detail') }}" class="btn btn-info btn-xs"><i class="glyphicon glyphicon-list"></i></a>
                                <a href="{{ url('lembaga/'.$row->id) }}" class="btn btn-success btn-xs"><i class="glyphicon glyphicon-edit"></i></a>
                                <a href="{{ url('lembaga/'.$row->id.'/delete') }}" onclick="return ConfirmDelete()" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i></a>
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