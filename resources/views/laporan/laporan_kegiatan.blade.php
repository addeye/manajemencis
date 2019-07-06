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
            <div class="box">
                <div class="box-body">
                    <form class="form-inline" action="{{url('laporan-kegiatan/excel')}}" method="get">
                        <div class="form-group">
                            <select name="lembaga" class="form-control">
                                <option value="semua">Pilih Semua Lembaga</option>
                                @foreach($lembaga as $row)
                                    <option value="{{$row->id}}">{{$row->plut_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <button class="btn btn-info">Download Excel</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-xs-12">
            @include('layouts.alert')
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">{{$title}}</h3>
                    <h3>Total : {{$kegiatan->total()}}</h3>
                </div>
                <!-- / box Header -->
                <div class="box-body table-responsive">
                    <form class="form-inline">
                        <div class="form-group">
                        <input type="text" class="form-control datepicker-realformat" name="tanggal_mulai" placeholder="Tanggal Mulai" value="{{$tanggal_mulai}}">
                        </div>
                        <div class="form-group">
                        <input type="text" class="form-control datepicker-realformat" name="tanggal_selesai" placeholder="Tanggal Selesai" value="{{$tanggal_selesai}}">
                        </div>
                        <button class="btn btn-danger">Cari</button>
                    </form>
                    <table class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th class="col-xs-1">No</th>
                            <th>Lembaga</th>
                            <th>Nama Konsultan</th>
                            <th>Bidang Pendampingan</th>
                            <th>Tanggal Pelaporan</th>
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
                        </tr>
                        </thead>
                        <tbody>
                        <?php $no = 1;?>
                        @foreach($kegiatan as $row)
                            <tr>
                                <td>{{$no++}}</td>
                                <td>{{$row->plut_name}}</td>
                                <td>{{$row->nama_lengkap}}</td>
                                <td>{{$row->bidang_layanan}}</td>
                                <td>{{date('d-m-Y',strtotime($row->created_at))}}</td>
                                <td>{{date('d-m-Y',strtotime($row->tanggal_mulai))}}</td>
                                <td>{{date('d-m-Y',strtotime($row->tanggal_selesai))}}</td>
                                <td>{{$row->judul_kegiatan}}</td>
                                <td>{{$row->name}}</td>
                                <td>{{$row->lokasi_kegiatan}}</td>
                                <td>{{$row->jumlah_peserta}}</td>
                                <td>{{$row->output}}</td>
                                <td>{{$row->ket_output}}</td>
                                <td>{{$row->sumber_daya}}</td>
                                <td>{{$row->mitra_kegiatan}}</td>
                                <td>{{$row->rencana_tindak_lanjut}}</td>
                            </tr>
                        @endforeach
                        </tbody>

                    </table>
                    {{ $kegiatan->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
