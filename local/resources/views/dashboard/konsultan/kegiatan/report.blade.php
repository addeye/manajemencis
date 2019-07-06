<?php
/**
 * Created by PhpStorm.
 * User: deyelovi
 * Date: 02/04/2017
 * Time: 23:50
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
                    <div class="row">
                        <div class="col-md-12 row">
                        <form method="get" class="">
                            <div class="form-group">
                            <div class="col-md-3"><input type="text" class="form-control datepicker-realformat" name="tanggal_mulai" placeholder="Tanggal Mulai" value="{{$tanggal_mulai}}"></div>
                            </div>
                            <div class="form-group">
                            <div class="col-md-3"><input type="text" name="tanggal_selesai" class="form-control datepicker-realformat" placeholder="Tanggal Selesai" value="{{$tanggal_selesai}}"></div>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-danger"><i class="fa fa-search"></i> Cari</button>
                            </div>
                        </form>
                    </div>
                    <div style="padding-top: 10px;" class="col-md-12">
                        <table id="example" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th class="col-xs-1">No</th>
                            <th>Konsultan</th>
                            <th>Tanggal Mulai</th>
                            <th>Tanggal Selesai</th>
                            <th>Nama Kegiatan</th>
                            <th>Bidang Usaha</th>
                            <th>Lokasi Kegiatan</th>
                            <th>Jumlah Peserta</th>
                            <th>Output</th>
                            <th>Keterangan</th>
                            <th>Sumber Daya</th>
                            <th>Mitra Kegiatan</th>
                            <th>Rencana Tindak Lanjut</th>
                            <th>Bidang Layanan</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $no = 1;?>
                        @foreach($data as $row)
                            <tr>
                                <td>{{$no++}}</td>
                                <td>{{$row->konsultan->nama_lengkap}}</td>
                                <td>{{date('d-m-Y', strtotime($row->tanggal_mulai))}}</td>
                                <td>{{date('d-m-Y',strtotime($row->tanggal_selesai))}}</td>
                                <td>{{$row->judul_kegiatan}}</td>
                                <td>{{$row->bidang_usahas->name}}</td>
                                <td>{{$row->lokasi_kegiatan}}</td>
                                <td>{{$row->jumlah_peserta}}</td>
                                <td>{{$row->output}}</td>
                                <td>{{$row->ket_output}}</td>
                                <td>{{$row->sumber_daya}}</td>
                                <td>{{$row->mitra_kegiatan}}</td>
                                <td>{{$row->rencana_tindak_lanjut}}</td>
                                <td>
                                    <ul>
                                        @foreach ($row->kegiatan_konsultan_bidang as $kbd)
                                            <li>{{$kbd->bidang_layanan->name}}</li>
                                        @endforeach
                                    </ul>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>

                    </table>
                    </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
@endsection
