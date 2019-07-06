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
        <div class="col-xs-6">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">{{$title}} {{ $data->name }}</h3>
                    <div class="pull-right">
                        <a href="{{ url('konsultan') }}" class="btn btn-xs btn-primary"><i class="fa  fa-reply"></i> Back</a>
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
                        <dd>{{ $data->lembagas?$data->lembagas->plut_name:'-' }}</dd>
                        <dt>Bidang Layanan</dt>
                        <dd>{{ $data->bidang_layanans->name }}</dd>
                    </dl>
                </div>
            </div>
        </div>
        <div class="col-xs-6">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Data Berkas</h3>
                </div>
                <!-- / box Header -->
                <div class="box-body">
                    <dl class="dl-horizontal">
                        <dt>Pas Photo</dt>
                        <dd><img class="thumbnail img-responsive" src="{{ url('images/'.$data->pas_photo) }}"></dd>
                        <dt>Ijazah</dt>
                        <dd><img class="thumbnail img-responsive" src="{{ url('lampiran/'.$data->ijazah) }}"></dd>
                        <dt>Scan KTP</dt>
                        <dd><img class="thumbnail img-responsive" src="{{ url('/lampiran'.$data->scan_ktp) }}"></dd>
                        <dt>Sertifikat</dt>
                        <dd><img class="thumbnail img-responsive" src="{{ url('lampiran'.$data->sertifikat_1) }}"></dd>
                    </dl>
                </div>
            </div>
        </div>
    </div>
@endsection