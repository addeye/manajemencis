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
                        <a class="btn btn-primary" href="{{ url('pendampingan/create') }}">
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
                            <th>Tanggal</th>
                            <th>KUMKM</th>
                            <th>Pemilik</th>
                            <th>Alamat</th>
                            <th>Usaha Utama</th>
                            <th>Lembaga</th>
                            <th>Permasalahan</th>
                            <th>Saran</th>
                            <th>Tindak Lanjut</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $no=1; ?>
                        @foreach($pendampingan as $row)
                            <tr>
                                <td>{{$no++}}</td>
                                <td>{{$row->tanggal_pendampingan}}</td>
                                <td>{{$row->kumkm->nama_usaha}}</td>
                                <td>{{$row->kumkm->nama_pemilik}}</td>
                                <td>{{$row->kumkm->alamat}}</td>
                                <td>{{$row->kumkm->usaha_utama}}</td>
                                <td>{{$row->kumkm->lembaga->plut_name}}</td>
                                <td>{{$row->permasalahan}}</td>
                                <td>{{$row->saran_tindakan}}</td>
                                <td>{{$row->tindak_lanjut}}</td>
                            </tr>
                        @endforeach
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection