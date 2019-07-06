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
            @include('layouts.alert')
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">{{$title}}</h3>

                    <div class="pull-right">
                        <a class="btn btn-primary" href="{{ url('cislembaga/create') }}">
                            <i class="fa fa-plus"></i> Tambah Data
                        </a>
                    </div>
                </div>
                <!-- / box Header -->
                <div class="box-body table-responsive">
                    <table id="example" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th class="col-xs-1">No</th>
                            <th class="col-xs-1">ID Lembaga</th>
                            <th>Nama</th>
                            <th>Bentuk Kelembagaan</th>
                            <th>Alamat</th>
                            <th>Telepon</th>
                            <th>Email</th>
                            <th>Whatsapp</th>
                            <th>Type</th>
                            <th>Action</th>

                        </tr>
                        </thead>
                        <tbody>
                        <?php $no=1; ?>
                        @foreach($data as $row)
                            <tr>
                                <td>{{$no++}}</td>
                                <td>{{$row->id_lembaga}}</td>
                                <td>{{$row->plut_name}}</td>
                                <td>{{$row->plut_bentuk_kelembagaan}}</td>
                                <td>{{$row->plut_alamat}}</td>
                                <td>{{$row->plut_telp}}</td>
                                <td>{{$row->plut_email}}</td>
                                <td>{{$row->plut_whatsapp}}</td>
                                <td>{{$row->type}}</td>
                                <td>
                                    <a href="{{ url('cislembaga/'.$row->id.'/detail') }}" class="btn btn-info btn-xs" data-toggle="tooltip" data-placement="left" title="Edit Data {{$row->plut_name}}">
                                        <i class="glyphicon glyphicon-eye-open"></i>
                                    </a>
                                    <a href="{{ url('cislembaga/'.$row->id) }}" class="btn btn-success btn-xs"><i
                                                class="glyphicon glyphicon-edit"></i></a>
                                    <a href="{{ url('cislembaga/'.$row->id.'/delete') }}"
                                       onclick="return ConfirmDelete()" class="btn btn-danger btn-xs" data-toggle="tooltip" data-placement="left" title="Hapus Data {{$row->plut_name}}">
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