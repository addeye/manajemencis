<?php
/**
 * Created by PhpStorm.
 * User: deyelovi
 * Date: 13/03/2017
 * Time: 15:01
 */
?>
@extends('layouts.beranda.master')

@section('content')
    <div class="box box-warning">
        <div class="box-header with-border">
            <h3 class="box-title">{{$title}}</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            @include('layouts.alert')
            <form role="form" method="post" action="{{url('informasi')}}">
                <input type="hidden" name="jenis" value="{{$opsi}}">
                {{ csrf_field() }}
                        <!-- text input -->
                <div class="form-group {{$errors->has('nama_lengkap')?'has-error':''}}">
                    <label>Nama lengkap sesuai KTP *</label>
                    <input type="text" class="form-control" name="nama_lengkap" placeholder="Nama lengkap.." value="{{old('nama_lengkap')}}">
                    <span class="help-block">{{$errors->first('nama_lengkap')}}</span>
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
                    <label>Lembaga/Perusahaan</label>
                    <input type="text" class="form-control" name="perusahaan" placeholder="Perusahaan anda.." value="{{old('perusahaan')}}">
                    <span class="help-block">{{$errors->first('perusahaan')}}</span>
                </div>
                <div class="form-group">
                    <label>Nama Produk</label>
                    <input type="text" class="form-control" name="nama_produk" placeholder="Nama Produk anda.." value="{{old('nama_produk')}}">
                    <span class="help-block">{{$errors->first('nama_produk')}}</span>
                </div>
                <div class="form-group">
                    <label>Jumlah Produk</label>
                    <input type="text" class="form-control" name="jumlah_produk" placeholder="Jumlah Produk anda.." value="{{old('jumlah_produk')}}">
                    <span class="help-block">{{$errors->first('jumlah_produk')}}</span>
                </div>
                <div class="form-group">
                    <label>Satuan Produk</label>
                    <input type="text" class="form-control" name="satuan_produk" placeholder="Satuan Produk anda.." value="{{old('satuan_produk')}}">
                    <span class="help-block">{{$errors->first('satuan_produk')}}</span>
                </div>
                <div class="form-group">
                    <label>Harga Produk</label>
                    <input type="text" class="form-control" name="harga_produk" placeholder="Harga Produk anda.." value="{{old('harga_produk')}}">
                    <span class="help-block">{{$errors->first('harga_produk')}}</span>
                </div>
                <div class="form-group">
                    <label>Spesifikasi</label>
                    <textarea class="form-control" rows="4" name="spesifikasi" placeholder="Spesifikasi Produk anda..">{{old('spesifikasi')}}</textarea>
                    <span class="help-block">{{$errors->first('spesifikasi')}}</span>
                </div>
                <div class="form-group {{$errors->has('keterangan')?'has-error':''}}">
                    <label>Keterangan</label>
                    <textarea class="form-control" rows="4" name="keterangan" placeholder="Keterangan yang tampil di sini ..">{{old('keterangan')}}</textarea>
                    <span class="help-block">{{$errors->first('keterangan')}}</span>
                </div>
                <div class="form-group">
                    <label>Web/Social Media</label>
                    <input type="text" class="form-control" name="link" placeholder="Web/Social Media anda.." value="{{old('link')}}">
                    <span class="help-block">{{$errors->first('link')}}</span>
                </div>
                {{--{!! app('captcha')->display() !!}--}}
                <div class="box-footer">
                    <a href="{{url('informasi')}}" class="btn btn-default">Kembali</a>
                    <button type="submit" class="btn btn-info pull-right"><i class="fa fa-save"></i> Kirim</button>
                </div>
            </form>
        </div>
        <!-- /.box-body -->
    </div>
@endsection
