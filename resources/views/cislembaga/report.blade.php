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
                            <th>Website</th>
                            <th>Facebook</th>

                            <th>SKDP</th>
                            <th>Alamat SKPD</th>
                            <th>Telepon SKPD</th>
                            <th>Email SKPD</th>
                            <th>Whatsapp SKPD</th>

                            <th>Tahun Perolehan</th>
                            <th>Mulai Operasional</th>
                            <th>Tanggal Peresmian</th>
                            <th>Diresmikan Oleh</th>
                            <th>Hibah Tahun</th>

                            <th>Bersinergi dengan pihak</th>
                            <th>Produk Unggulan Daerah</th>
                            <th>Sudah Branding dan Masuk Pasar Lokal/Nasional/Ekspor</th>
                            <th>Produk lain yang potensial</th>
                            <th>Jumlah UMKM ecommarce</th>

                            <th>Jumlah Produk Online</th>
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
                                <td>{{$row->plut_website}}</td>
                                <td>{{$row->plut_facebook}}</td>

                                <td>{{$row->skpd_name}}</td>
                                <td>{{$row->skpd_alamat}}</td>
                                <td>{{$row->skpd_telp}}</td>
                                <td>{{$row->skpd_email}}</td>
                                <td>{{$row->skpd_whatsapp}}</td>

                                <td>{{$row->tahun_perolehan}}</td>
                                <td>{{date('d-m-Y',strtotime($row->mulai_operasional))}}</td>
                                <td>{{date('d-m-Y',strtotime($row->tgl_peresmian))}}</td>
                                <td>{{$row->diresmikan_oleh}}</td>
                                <td>{{$row->hibah_tahun}}</td>

                                <td>{{$row->ket_bersinergi}}</td>
                                <td>{{$row->produk_unggulan}}</td>
                                <td>{{$row->pemasaran}}</td>
                                <td>{{$row->produk_potensial}}</td>
                                <td>{{$row->jml_umkm_ecommarce}}</td>

                                <td>{{$row->jml_produk_online}}</td>
                            </tr>
                        @endforeach
                        </tbody>

                    </table>
                </div>


            </div>
        </div>
    </div>
@endsection