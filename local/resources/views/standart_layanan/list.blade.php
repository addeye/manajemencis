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
            @include('layouts.alert')
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">{{$title}}</h3>
                    <div class="pull-right">
                        <a class="btn btn-primary" href="{{ url('standart-layanan/create') }}">
                            <i class="fa fa-plus"></i> Tambah Data
                        </a>
                    </div>
                </div>
                <!-- / box Header -->
                <div class="box-body">
                    <table id="example" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th class="col-xs-1">No</th>
                            <th>Bidang</th>
                            <th>Standart Layanan</th>
                            <th>Aksi</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $no=1; ?>
                        @foreach($data as $row)
                            <tr>
                                <td>{{$no++}}</td>
                                <td>{{$row->bidang_layanan->name}}</td>
                                <td>{{$row->nama}}</td>
                                <td>
                                    <a href="{{ url('standart-layanan/'.$row->id.'/edit') }}" class="btn btn-success btn-xs" data-toggle="tooltip" data-placement="left" title="Edit Data {{$row->name}}">
                                        <i class="glyphicon glyphicon-edit"></i>
                                    </a>                                    
                                    <a href="{{ route('standart-layanan.destroy', $row->id) }}" data-method="delete" class="btn btn-danger btn-xs jquery-postback">
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
