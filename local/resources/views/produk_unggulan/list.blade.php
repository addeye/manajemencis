<?php
/**
 * Created by PhpStorm.
 * User: deyelovi
 * Date: 31/03/2017
 * Time: 15:27
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
                            <a class="btn btn-primary" href="{{ url('produk_unggulan/create') }}">
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
                            <th>Nama</th>
                            <th>Merek</th>
                            <th>Bidang Usaha</th>
                            <th>Aksi</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $no=1; ?>
                        @foreach($produk as $row)
                            <tr>
                                <td>{{$no++}}</td>
                                <td>{{$row->nama_produk}}</td>
                                <td>{{$row->merek}}</td>
                                <td>{{$row->bidang_usaha}}</td>
                                <td>
                                    <a href="{{ url('bidanglayanan/'.$row->id) }}" class="btn btn-success btn-xs" data-toggle="tooltip" data-placement="left" title="Edit Data {{$row->name}}">
                                        <i class="glyphicon glyphicon-edit"></i>
                                    </a>
                                    <a href="{{ url('bidanglayanan/'.$row->id.'/delete') }}" onclick="return ConfirmDelete()" class="btn btn-danger btn-xs" data-toggle="tooltip" data-placement="left" title="Hapus Data {{$row->name}}">
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
