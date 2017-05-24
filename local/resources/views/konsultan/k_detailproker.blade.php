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
                    <table class="table table-bordered table-striped datatables-class">
                        <thead>
                        <tr>
                            <th class="col-xs-1">ID</th>
                            <th>Nama Kegiatan</th>
                            <th>Jenis Layanan</th>
                            <th>Output/Ket</th>
                            <th>Jumlah Penerima</th>
                            <th>Anggaran</th>
                            <th>Jadwal Pelaksana</th>
                            <th>Mitra Kerja</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($data as $row)
                            <tr>
                                <td>{{$row->id}}</td>
                                <td>{{$row->jenis_kegiatan}}</td>
                                <td>{{$row->jenis_layanans->name}}</td>
                                <td>{{$row->output}} / {{$row->ket_output}}</td>
                                <td>{{$row->jml_penerima}}</td>
                                <td>{{$row->anggaran}}</td>
                                <td>{{$row->jadwal_pelaksana}}</td>
                                <td>{{$row->mitra_kerja}}</td>
                            </tr>
                        @endforeach
                        </tbody>

                    </table>
                </div>


            </div>
        </div>
    </div>
@endsection