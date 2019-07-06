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
                </div>
                <!-- / box Header -->
                <div class="box-body table-responsive">
                    <table id="example" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th class="col-xs-1">No</th>
                            <th>Nama Produk</th>
                            <th>Merek</th>
                            <th>Legalitas</th>
                            <th>Bidang Usaha</th>
                            <th>Satuan</th>
                            <th>Kapasitas/Bulan</th>
                            <th>Omset/Bulan</th>
                            <th>Pemilik</th>
                            <th>Perusahaan</th>
                            <th>Alamat</th>
                            <th>Provinsi</th>
                            <th>Kabupaten/Kota</th>
                            <th>Telp</th>
                            <th>Email</th>
                            <th>Sentra</th>
                            <th>Nama Sentra</th>
                            <th>Lembaga</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $no=1; ?>
                        @foreach($produk as $row)
                            <tr>
                                <td>{{$no++}}</td>
                                <td>{{$row->nama_produk}}</td>
                                <td>{{$row->merek}}</td>
                                <td>{{$row->legalitas}}</td>
                                <td>{{$row->bidangUsaha->name}}</td>
                                <td>{{$row->satuan}}</td>
                                <td>{{$row->kapasitas_perbulan}}</td>
                                <td>{{$row->omset_perbulan}}</td>
                                <td>{{$row->nama_pemilik}}</td>
                                <td>{{$row->nama_perusahaan}}</td>
                                <td>{{$row->alamat}}</td>
                                <td>{{$row->provinces->name}}</td>
                                <td>{{$row->regencies->name}}</td>
                                <td>{{$row->telp}}</td>
                                <td>{{$row->email}}</td>
                                <td>{{$row->sentra?'Ya':'Tidak'}}</td>
                                <td>{{$row->sentra_kumkm?$row->sentra_kumkm->name:'-'}}</td>
                                <td>{{$row->lembaga?$row->lembaga->plut_name:'-'}}</td>
                            </tr>
                        @endforeach
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
