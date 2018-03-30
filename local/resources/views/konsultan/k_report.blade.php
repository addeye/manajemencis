<?php
/**
 * Created by Sublime
 * User: Dio Putra
 * Date: 29/01/2017
 * Time: 23:54
 */

?>

@extends('layouts.master')

@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.2.4/css/buttons.bootstrap.min.css">
@endsection

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
                            @if(Auth::user()->role_id!=3)
                            <th class="col-xs-1">Print</th>
                            @endif
                            <th>No Registrasi</th>
                            <th>Status</th>
                            <th>Nama Lengkap</th>
                            <th>Jenis Kelamin</th>
                            <th>Provinsi</th>
                            <th>Kabupaten/Kota</th>
                            <th>Alamat</th>
                            <th>Kode Pos</th>
                            <th>Tanggal Lahir</th>
                            <th>Telepon</th>
                            <th>Email</th>
                            <th>Pendidikan Terakhir</th>
                            <th>Jurusan</th>
                            <th>Bidang Keahlian</th>
                            <th>Pengalaman</th>
                            <th>Sertifikat</th>
                            <th>Asosiasi</th>
                            <th>Lembaga</th>
                            <th>ID Lembaga</th>
                            <th>Bidang Layanan</th>
                            <th>Jumlah Kegiaatan</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $no = 1;?>
                        @foreach($konsultan as $row)
                            <tr>
                                <td>{{$no++}}</td>
                                @if(Auth::user()->role_id!=3)
                                <td><button id="{{$row->user_id}}" type="button" class="btn btn-xs btn-info printbio">Print</button></td>
                                @endif
                                <td>{{$row->no_registrasi}}</td>
                                <td>{{$row->user->status}}</td>
                                <td>{{$row->nama_lengkap}}</td>
                                <td>{{$row->jenis_kelamin}}</td>
                                <td>{{$row->provinces->name}}</td>
                                <td>{{$row->regencies->name}}</td>
                                <td>{{$row->alamat}}</td>
                                <td>{{$row->kode_pos}}</td>
                                <td>{{$row->tanggal_lahir}}</td>
                                <td>{{$row->telepon}}</td>
                                <td>{{$row->email}}</td>
                                <td>{{$row->pendidikans->name}}</td>
                                <td>{{$row->jurusan}}</td>
                                <td>{{$row->bidang_keahlian}}</td>
                                <td>{{$row->pengalaman}}</td>
                                <td>{{$row->sertifikat}}</td>
                                <td>{{$row->asosiasi}}</td>
                                <td>{{$row->lembagas?$row->lembagas->plut_name:''}}</td>
                                <td>{{$row->lembagas?$row->lembagas->id_lembaga:''}}</td>
                                <td>{{$row->bidang_layanans->name}}</td>
                                <td></td>
                            </tr>
                        @endforeach
                        </tbody>

                    </table>
                </div>


            </div>
        </div>
    </div>
    <input type="hidden" id="urlcetak" value="{{ url('bio/konsultan/print') }}">
@endsection

@section('script')
    <script>
        $('.printbio').click(function(){
            var urlcetak = $("#urlcetak").val();

            var fullurl = urlcetak+'/'+this.id;
            console.log(fullurl);

            $("<iframe>")                             // create a new iframe element
                    .hide()                               // make it invisible
                    .attr("src", fullurl) // point the iframe to the page you want to print
                    .appendTo("body");                    // add iframe to the DOM to cause it to load the page
        });
    </script>
@endsection