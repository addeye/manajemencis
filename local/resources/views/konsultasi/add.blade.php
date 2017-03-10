<?php
/**
 * Created by PhpStorm.
 * User: deyelovi
 * Date: 09/03/2017
 * Time: 16:16
 */
?>

@extends('layouts.beranda.master')

@section('content')
    <div class="box box-warning">
        <div class="box-header with-border">
            <h3 class="box-title">Form Konsultasi</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <form role="form" method="post" action="#">
                <!-- text input -->
                <div class="form-group">
                    <label>Nama lengkap sesuai KTP *</label>
                    <input type="text" class="form-control" name="nama" placeholder="Nama lengkap.." value="{{old('nama')}}">
                </div>
                <div class="form-group">
                    <label>Email *</label>
                    <input type="text" class="form-control" name="email" placeholder="Email anda.." value="{{old('email')}}">
                </div>
                <div class="form-group">
                    <label>No Hp *</label>
                    <input type="text" class="form-control" placeholder="No Hp anda..">
                </div>
                <!-- textarea -->
                <div class="form-group">
                    <label>Alamat</label>
                    <textarea class="form-control" rows="3" placeholder="Alamat anda ..."></textarea>
                </div>
                <div class="form-group">
                    <label>Bidang Usaha</label>
                    <input type="text" class="form-control" placeholder="Bidang usaha anda..">
                </div>
                <div class="form-group">
                    <label>Nama Usaha</label>
                    <input type="text" class="form-control" placeholder="Nama Usaha..">
                </div>
                <div class="form-group">
                    <label>Bidang Layanan</label>
                    <select class="form-control" name="bidang_layanan_id">
                        @foreach($bidanglayanan as $row)
                            <option value="{{$row->id}}">{{$row->name}}</option>
                            @endforeach
                    </select>
                </div>
                {!! app('captcha')->display() !!}
                <div class="box-footer">
                    <a href="{{url('/')}}" class="btn btn-default">Kembali</a>
                    <button type="submit" class="btn btn-info pull-right"><i class="fa fa-save"></i> Kirim</button>
                </div>
            </form>
        </div>
        <!-- /.box-body -->
    </div>
    @endsection