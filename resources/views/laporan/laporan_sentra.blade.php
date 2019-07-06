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
                    <form class="form-inline" action="{{url('laporan-sentra/excel')}}" method="get">
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
                </div>
                <!-- / box Header -->
                <div class="box-body table-responsive">
                    <table id="example" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th class="col-xs-1">No</th>
                            <th>Lembaga</th>
                            <th>ID Sentra</th>                            
                            <th>Nama Sentra</th> 
                            <th>Alamat</th> 
                            <th>Provinsi</th> 
                            <th>Kab/Kota</th> 
                            <th>Kecamatan</th> 
                            <th>Kelurahan</th> 
                            <th>Tahun Berdiri</th>
                            <th>Bidang Usaha</th>
                            <th>Total KUMKM</th>
                            <th>Total Pegawai</th>
                            <th>Omset PerBulan</th>
                            <th>Teknologi</th>
                            <th>Bahan Baku</th>
                            <th>Pemasaran</th>
                            <th>Kemitraan</th>
                            <th>Nama Ketua</th>
                            <th>Telp Ketua</th>
                            <th>Email Ketua</th>
                            <th>Nama CP</th>
                            <th>Telp CP</th>
                            <th>Email CP</th>
                            <th>Pembina Kementrian</th>
                            <th>Pembina Bidang</th>
                            <th>Pembina Tenaga Pendamping</th>
                            <th>Masalah Kelembagaan</th>
                            <th>Masalah SDM</th>
                            <th>Masalah Produksi</th>
                            <th>Masalah Pembiayaan</th>
                            <th>Masalah Pemasaran</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $no=1; ?>
                        @foreach($sentra as $row)
                            <tr>
                                <td>{{$no++}}</td>
                                <td>{{$row->plut_name}}</td>
                                <td>{{$row->id_sentra}}</td>
                                <td>{{$row->name}}</td>
                                <td>{{$row->alamat}}</td>
                                <td>{{$row->provinsi}}</td>
                                <td>{{$row->kab_kota}}</td>
                                <td>{{$row->kecamatan}}</td>
                                <td>{{$row->kelurahan}}</td>
                                <td>{{$row->tahun_berdiri}}</td>
                                <td>{{$row->bidang_usaha}}</td>
                                <td>{{$row->total_umkm}}</td>
                                <td>{{$row->total_pegawai}}</td>
                                <td>{{$row->omset_bulan}}</td>
                                <td>{{$row->teknologi}}</td>
                                <td>{{$row->bahan_baku}}</td>
                                <td>{{$row->pemasaran}}</td>
                                <td>{{$row->kemitraan}}</td>
                                <td>{{$row->nama_ketua}}</td>
                                <td>{{$row->notelp_ketua}}</td>
                                <td>{{$row->email_ketua}}</td>
                                <td>{{$row->name_cp}}</td>
                                <td>{{$row->no_cp}}</td>
                                <td>{{$row->email_cp}}</td>
                                <td>{{$row->pembina_kementrian}}</td>
                                <td>{{$row->pembina_bidang}}</td>
                                <td>{{$row->pembina_tenaga_pendamping}}</td>
                                <td>{{$row->masalah_kelembagaan}}</td>
                                <td>{{$row->masalah_sdm}}</td>
                                <td>{{$row->masalah_produksi}}</td>
                                <td>{{$row->masalah_pembiayaan}}</td>
                                <td>{{$row->masalah_pemasaran}}</td>                                
                        @endforeach
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
