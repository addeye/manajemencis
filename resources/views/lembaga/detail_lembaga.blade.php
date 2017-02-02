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
        <div class="col-xs-6">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">{{$title}} {{ $data->name }}</h3>
                    <div class="pull-right">
                        <a href="{{ url('lembaga') }}" class="btn btn-xs btn-warning"><i class="fa fa-mail-reply-all"></i> Kembali</a>
                    </div>
                </div>
                <!-- / box Header -->
                <div class="box-body">
                    <dl class="dl-horizontal">
                        <dt>ID Lembaga</dt>
                        <dd>{{ $data->idlembaga }}</dd>
                        <dt>Status</dt>
                        <dd>{{ $data->tingkats->name }}</dd>
                        <dt>Provinsi</dt>
                        <dd>{{ $data->provinces->name }}</dd>
                        <dt>Kabupaten</dt>
                        <dd>{{ $data->regencies->name }}</dd>
                        <dt>Alamat</dt>
                        <dd>{{ $data->alamat }} {{ $data->kode_pos }}</dd>
                        <hr>
                        <dt>Bentuk Lembaga</dt>
                        <dd>{{ $data->bentuk_lembaga }}</dd>
                        <dt>SKPD Penanggungjawab</dt>
                        <dd>{{ $data->SKPD }}</dd>
                        <dt>Tahun Berdiri</dt>
                        <dd>{{ $data->tahun_berdiri }}</dd>
                        <dt>Telepon</dt>
                        <dd>{{ $data->telepon }}</dd>
                        <dt>Email</dt>
                        <dd>{{ $data->email }}</dd>
                    </dl>
                </div>
            </div>
        </div>
        <div class="col-xs-6">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Data Pemimpin</h3>
                </div>
                <!-- / box Header -->
                <div class="box-body">
                    <dl class="dl-horizontal">
                        <dt>Nama</dt>
                        <dd>{{ $data->nama_pimpinan }}</dd>
                        <dt>Telepon</dt>
                        <dd>{{ $data->telepon_pimpinan }}</dd>
                        <dt>Email</dt>
                        <dd>{{ $data->email_pimpinan }}</dd>
                    </dl>
                </div>
                <hr>
                <div class="box-header">
                    <h3 class="box-title">Data Admin</h3>
                </div>
                <!-- / box Header -->
                <div class="box-body">
                    <dl class="dl-horizontal">
                        <dt>Nama</dt>
                        <dd>{{ $data->nama_admin }}</dd>
                        <dt>Telepon</dt>
                        <dd>{{ $data->telepon_admin }}</dd>
                        <dt>Email</dt>
                        <dd>{{ $data->email_admin }}</dd>
                    </dl>
                </div>
                <hr>
                <div class="box-header">
                    <h3 class="box-title">Data Staf Galery</h3>
                </div>
                <!-- / box Header -->
                <div class="box-body">
                    <dl class="dl-horizontal">
                        <dt>Nama</dt>
                        <dd>{{ $data->nama_staffgalery }}</dd>
                        <dt>Telepon</dt>
                        <dd>{{ $data->telepon_staffgalery }}</dd>
                        <dt>Email</dt>
                        <dd>{{ $data->email_staffgalery }}</dd>
                    </dl>
                </div>
                <hr>
                <div class="box-header">
                    <h3 class="box-title">Data Staf Teknis</h3>
                </div>
                <!-- / box Header -->
                <div class="box-body">
                    <dl class="dl-horizontal">
                        <dt>Nama</dt>
                        <dd>{{ $data->nama_staffteknis }}</dd>
                        <dt>Telepon</dt>
                        <dd>{{ $data->telepon_staffteknis }}</dd>
                        <dt>Email</dt>
                        <dd>{{ $data->email_staffteknis }}</dd>
                    </dl>
                </div>
            </div>
        </div>
    </div>
@endsection