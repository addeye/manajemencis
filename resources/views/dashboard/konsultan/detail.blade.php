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
                        <a href="{{ url('bio/konsultan/edit') }}" class="btn btn-xs btn-primary"><i class="fa  fa-edit"></i> Edit</a>
                    </div>
                </div>
                <!-- / box Header -->
                <div class="box-body">
                    <dl class="dl-horizontal">
                        <dt>No Registrasi</dt>
                        <dd>{{ $data->no_registrasi }}</dd>
                        <dt>Nama Lengkap</dt>
                        <dd>{{ $data->nama_lengkap }}</dd>
                        <dt>Email</dt>
                        <dd>{{ $data->email }}</dd>
                        <dt>Provinsi</dt>
                        <dd>{{ $data->provinces->name }}</dd>
                        <dt>Kabupaten</dt>
                        <dd>{{ $data->regencies->name }}</dd>
                        <dt>Alamat</dt>
                        <dd>{{ $data->alamat }} {{ $data->kode_pos }}</dd>
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
                        <dt>Ijazah</dt>
                        <dd><img src="{{ url('lampiran/'.$data->ijazah) }}" class="img-responsive" alt="Responsive image"></dd>
                        <dt>Sertifikat 1</dt>
                        <dd><img src="{{ url('lampiran/'.$data->sertifikat_1) }}" class="img-responsive" alt="Responsive image"></dd>
                        <dt>Sertifikat 2</dt>
                        <dd><img src="{{ url('lampiran/'.$data->sertifikat_2) }}" class="img-responsive" alt="Responsive image"></dd>
                    </dl>
                </div>
            </div>
        </div>
    </div>
@endsection