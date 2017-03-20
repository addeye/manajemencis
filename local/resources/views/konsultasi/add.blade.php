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
            @include('layouts.alert')
            <form role="form" method="post" action="{{url('konsultasi')}}">
                {{ csrf_field() }}
                <!-- text input -->
                <div class="form-group {{$errors->has('nama')?'has-error':''}}">
                    <label>Nama lengkap sesuai KTP *</label>
                    <input type="text" class="form-control" name="nama" placeholder="Nama lengkap.." value="{{old('nama')}}">
                    <span class="help-block">{{$errors->first('nama')}}</span>
                </div>
                <div class="form-group {{$errors->has('email')?'has-error':''}}">
                    <label>Email *</label>
                    <input type="text" class="form-control" name="email" placeholder="Email anda.." value="{{old('email')}}">
                    <span class="help-block">{{$errors->first('email')}}</span>
                </div>
                <div class="form-group {{$errors->has('telp')?'has-error':''}}">
                    <label>No Telp/Hp *</label>
                    <input type="text" class="form-control" name="telp" placeholder="No Hp anda.." value="{{old('telp')}}">
                    <span class="help-block">{{$errors->first('telp')}}</span>
                </div>
                <!-- textarea -->
                <div class="form-group">
                    <label>Alamat</label>
                    <textarea class="form-control" rows="3" name="alamat" placeholder="Alamat lengkapi dengan Provinsi Kabupaten/kota..">{{old('')}}</textarea>
                </div>
                <div class="form-group">
                    <label>Produk</label>
                    <input type="text" class="form-control" name="produk" placeholder="Apa produk anda.." value="{{old('produk')}}">
                </div>
                <div class="form-group {{$errors->has('permasalahan_bisnis')?'has-error':''}}">
                    <label>Permasalahan Bisnis *</label>
                    <textarea class="form-control" rows="4" name="permasalahan_bisnis" placeholder="Uraikan permasalahan bisnis yang anda alami..">{{old('permasalahan_bisnis')}}</textarea>
                    <span class="help-block">{{$errors->first('permasalahan_bisnis')}}</span>
                </div>
                {{--{!! app('captcha')->display() !!}--}}
                <div class="box-footer">
                    <a href="{{url('/')}}" class="btn btn-default">Kembali</a>
                    <button type="submit" class="btn btn-info pull-right"><i class="fa fa-save"></i> Kirim</button>
                </div>
            </form>
        </div>
        <!-- /.box-body -->
    </div>
    @endsection