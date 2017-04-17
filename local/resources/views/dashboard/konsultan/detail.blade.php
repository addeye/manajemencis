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
        @include('layouts.alert')
        <div class="col-md-6">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">{{$title}} {{ $data->name }}</h3>
                    <div class="pull-right">
                        <a href="javascript:void(0)" onclick="loadOtherPage()" class="btn btn-info" data-toggle="tooltip" data-placement="left" title="Print Biodata"><i
                                    class="fa fa-print"></i></a>
                        <a href="{{ url('bio/konsultan/edit') }}" class="btn btn-success"><i class="fa  fa-edit"></i> Edit</a>
                    </div>
                </div>
                <!-- / box Header -->
                <div class="box-body">
                    <dl class="dl-horizontal">
                        <dt>No Registrasi</dt>
                        <dd>{{ $data->no_registrasi }}</dd>
                        <dt>Nama Lengkap</dt>
                        <dd>{{ $data->nama_lengkap }}</dd>
                        <dt>Jenis Kelamin</dt>
                        <dd>{{ $data->jenis_kelamin=='P'?'Perempuan':'Laki-laki' }}</dd>
                        <dt>Tanggal Lahir</dt>
                        <dd>{{ $data->tanggal_lahir }}</dd>
                        <dt>Email</dt>
                        <dd>{{ $data->email }}</dd>
                        <dt>Provinsi</dt>
                        <dd>{{ $data->provinces->name }}</dd>
                        <dt>Kabupaten</dt>
                        <dd>{{ $data->regencies->name }}</dd>
                        <dt>Alamat</dt>
                        <dd>{{ $data->alamat }} {{ $data->kode_pos }}</dd>
                        <hr>
                        <dt>Pendidikan terakhir</dt>
                        <dd>{{ $data->pendidikans->name }}</dd>
                        <dt>Nama sekolah/perguruan tinggi terakhir</dt>
                        <dd>{{ $data->perguruan_terakhir }}</dd>
                        <dt>Jurusan/prodi</dt>
                        <dd>{{ $data->jurusan }}</dd>

                        <dt>Kompetensi/bidang keahlian pendampingan</dt>
                        <dd>{{ $data->bidang_keahlian }}</dd>

                        <dt>Pengalaman</dt>
                        <dd>{{ $data->pengalaman }}</dd>
                        <dt>Sertifikat</dt>
                        <dd>{{ $data->sertifikat }}</dd>
                        <dt>Asosiasi</dt>
                        <dd>{{ $data->asosiasi }}</dd>
                        <dt>Lembaga</dt>
                        <dd>{{ $data->lembagas->plut_name }}</dd>
                        <dt>Bidang Layanan</dt>
                        <dd>{{ $data->bidang_layanans->name }}</dd>
                    </dl>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Data Berkas</h3>
                </div>
                <!-- / box Header -->
                <div class="box-body">
                    <dl class="dl-horizontal">
                        <dt>Pas Photo</dt>
                        <dd><img src="{{ url('images/'.$data->pas_photo) }}" class="img-responsive" alt="Responsive image"></dd>
                        <dt>Scan KTP</dt>
                        <dd><img src="{{ url('lampiran/'.$data->scan_ktp) }}" class="img-responsive" alt="Responsive image"></dd>
                        <dt>Ijazah</dt>
                        <dd><img src="{{ url('lampiran/'.$data->ijazah) }}" class="img-responsive" alt="Responsive image"></dd>
                        <dt>Sertifikat 1</dt>
                        <dd><img src="{{ url('lampiran/'.$data->sertifikat_1) }}" class="img-responsive" alt="Responsive image"></dd>
                    </dl>
                </div>
            </div>
        </div>
    </div>
    <input id="urlcetak" value="{{ url('bio/konsultan/print') }}">
@endsection

@section('script')
    <script>
        function loadOtherPage() {
            var urlcetak = $("#urlcetak").val();

            var fullurl = urlcetak;

            $("<iframe>")                             // create a new iframe element
                    .hide()                               // make it invisible
                    .attr("src", fullurl) // point the iframe to the page you want to print
                    .appendTo("body");                    // add iframe to the DOM to cause it to load the page
        }
    </script>
@endsection