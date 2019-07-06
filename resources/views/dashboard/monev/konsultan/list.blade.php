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
                </div>
                <!-- / box Header -->
                <div class="box-body table-responsive">
                    <div class="well">
                        <form class="form-inline">
                            <div class="form-group">
                                <input type="text" name="search" class="form-control" placeholder="Cari berdasarkan nama" value="{{Request::input('search')}}">
                            </div>
                            <div class="form-group">
                                <select name="lembaga_id" class="form-control select2">
                                    <option value="">Pilih Lembaga</option>
                                    @foreach ($lembaga as $row)
                                    <option value="{{$row->id}}" {{Request::input('lembaga_id')==$row->id?'selected':''}} >{{$row->plut_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
                            <a href="{{url('profil/konsultan-export?search='.Request::input('search').'&lembaga_id='.Request::input('lembaga_id'))}}" class="btn btn-success"><i class="fa fa-file-excel-o"></i> Unduh File</a>
                        </form>
                    </div>
                    <table class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>No Registrasi</th>
                            <th>Status</th>
                            <th>Nama Lengkap</th>
                            <th>ID Lembaga</th>
                            <th>Lembaga</th>
                            <th>Bidang Layanan</th>
                            <th>Jenis Kelamin</th>
                            <th>Telepon</th>
                            <th>Email</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($konsultan as $row)
                            <tr>
                                <td>{{$row->no_registrasi}}</td>
                                <td>{{$row->user->status}}</td>
                                <td>{{$row->nama_lengkap}}</td>
                                <td>{{$row->lembagas?$row->lembagas->id_lembaga:'-'}}</td>
                                <td>{{$row->lembagas?$row->lembagas->plut_name:'-'}}</td>
                                <td>{{$row->bidang_layanans->name}}</td>
                                <td>{{$row->jenis_kelamin}}</td>
                                <td>{{$row->telepon}}</td>
                                <td>{{$row->email}}</td>
                                <td>
                                    <a href="{{ url('profil/konsultan/'.$row->id) }}"
                                        class="btn btn-success btn-xs"><i class="glyphicon glyphicon-list"></i></a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{$konsultan->appends($_GET)->links()}}
                </div>
            </div>
        </div>
    </div>
@endsection