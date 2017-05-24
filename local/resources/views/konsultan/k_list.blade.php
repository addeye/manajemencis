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
                        <button type="button" id="hapusSemua" class="btn btn-danger">
                            <i class="fa fa-trash-o"></i> Hapus
                        </button>
                        <a class="btn btn-info" href="{{ url('konsultan/report') }}">
                            <i class="fa fa-book"></i> Report
                        </a>
                        <a class="btn btn-success" href="{{ url('konsultan/create') }}">
                            <i class="fa fa-plus"></i> Tambah Data
                        </a>
                    </div>
                </div>
                <!-- / box Header -->
                <div class="box-body table-responsive">
                    <form id="formTable">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <table id="example-fill" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th class="text-center">
                                    <button type="button" id="selectAll" class="btn btn-xs btn-default">Semua</button>
                                </th>
                                <th>No Registrasi</th>
                                <th>Nama Lengkap</th>
                                <th>ID Lembaga</th>
                                <th>Lembaga</th>
                                <th>Bidang Layanan</th>
                                <th>Jenis Kelamin</th>
                                <th>Telepon</th>
                                <th>Email</th>
                                <th>Program Kerja</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th></th>
                                <th>No Registrasi</th>
                                <th>Nama Lengkap</th>
                                <th>ID Lembaga</th>
                                <th>Lembaga</th>
                                <th>Bidang Layanan</th>
                                <th>Jenis Kelamin</th>
                                <th>Telepon</th>
                                <th>Email</th>
                                <th>Program Kerja</th>
                                <th>Action</th>
                            </tr>
                            </tfoot>
                            <tbody>
                            @foreach($konsultan as $row)
                                <tr>
                                    <td><input name="idkonsultan[]" type="checkbox" value="{{$row->id}}"></td>
                                    <td>{{$row->no_registrasi}}</td>
                                    <td>{{$row->nama_lengkap}}</td>
                                    <td>{{$row->lembagas?$row->lembagas->id_lembaga:'-'}}</td>
                                    <td>{{$row->lembagas?$row->lembagas->plut_name:'-'}}</td>
                                    <td>{{$row->bidang_layanans->name}}</td>
                                    <td>{{$row->jenis_kelamin}}</td>
                                    <td>{{$row->telepon}}</td>
                                    <td>{{$row->email}}</td>
                                    <td>
                                        <a href="{{ url('konsultan/'.$row->id.'/proker') }}"
                                           class="btn btn-info btn-xs"><i class="glyphicon glyphicon-list-alt"></i>
                                            Proker</a>
                                    </td>
                                    <td>
                                        <a href="{{ url('konsultan/'.$row->id.'/detail') }}"
                                           class="btn btn-success btn-xs"><i class="glyphicon glyphicon-list"></i></a>
                                        <a href="{{ url('konsultan/'.$row->id) }}" class="btn btn-success btn-xs"><i
                                                    class="glyphicon glyphicon-edit"></i></a>
                                        <a href="{{ url('konsultan/'.$row->id.'/delete') }}"
                                           onclick="return ConfirmDelete()" class="btn btn-danger btn-xs"><i
                                                    class="glyphicon glyphicon-trash"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>

                        </table>
                    </form>
                </div>


            </div>
        </div>
    </div>
    <input type="hidden" id="urlHapusSemua" value="{{url('konsultan/semua/delete')}}">
@endsection

@section('script')
    <script>
        $('#hapusSemua').click(function () {
            var url = $('#urlHapusSemua').val();
            var data = $('#formTable').serializeArray();
            var result = confirm("Apakah anda yakin menghapusnya?");
            if (result) {
                $.ajax({
                    url: url,
                    type: 'POST',
                    data: data,
                    cache: false,
                })
                        .success(function() {
                            console.log('deye');
                            location.reload();
                        });
            }
        });
    </script>
@endsection