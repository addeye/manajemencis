<?php
/**
 * Created by PhpStorm.
 * User: deyelovi
 * Date: 31/03/2017
 * Time: 16:15
 */
?>
@extends('layouts.master')

@section('content')

    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">{{$title}}</h3>
                </div>
                <!-- / box Header -->
                <div class="box-body">
                    <form method="post" action="{{ url('produk_unggulan') }}" class="form-horizontal">
                        {{ csrf_field() }}
                        <div class="form-group {{$errors->has('nama_produk')?'has-error':''}}">
                            <label for="inputEmail3" class="col-sm-2 control-label">Nama Produk</label>
                            <div class="col-sm-5">
                                <input type="text" name="nama_produk" class="form-control">
                            </div>
                            <span class="help-block">{{$errors->first('nama_produk')}}</span>
                        </div>
                        <div class="form-group {{$errors->has('merek')?'has-error':''}}">
                            <label for="inputEmail3" class="col-sm-2 control-label">Merek</label>
                            <div class="col-sm-5">
                                <input type="text" name="merek" class="form-control">
                            </div>
                        </div>
                        <div class="form-group {{$errors->has('merek')?'has-error':''}}">
                            <label for="inputEmail3" class="col-sm-2 control-label">Bidang Usaha</label>
                            <div class="col-sm-5">
                                <select name="bidang_usaha" class="form-control">
                                    <option value="">Pilih bidang usaha</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group {{$errors->has('merek')?'has-error':''}}">
                            <label for="inputEmail3" class="col-sm-2 control-label">Satuan</label>
                            <div class="col-sm-5">
                                <input type="text" name="satuan" class="form-control">
                            </div>
                        </div>
                        <div class="form-group {{$errors->has('merek')?'has-error':''}}">
                            <label for="inputEmail3" class="col-sm-2 control-label">Kapasitas Per Bulan</label>
                            <div class="col-sm-5">
                                <input type="text" name="kapasitas_perbulan" class="form-control">
                            </div>
                        </div>
                        <div class="form-group {{$errors->has('merek')?'has-error':''}}">
                            <label for="inputEmail3" class="col-sm-2 control-label">Omset Per Bulan</label>
                            <div class="col-sm-5">
                                <input type="text" name="omset_perbulan" class="form-control">
                            </div>
                        </div>
                        <div class="form-group {{$errors->has('merek')?'has-error':''}}">
                            <label for="inputEmail3" class="col-sm-2 control-label">Nama Pemilik</label>
                            <div class="col-sm-5">
                                <input type="text" name="nama_pemilik" class="form-control">
                            </div>
                        </div>
                        <div class="form-group {{$errors->has('merek')?'has-error':''}}">
                            <label for="inputEmail3" class="col-sm-2 control-label">Nama Perusahaan</label>
                            <div class="col-sm-5">
                                <input type="text" name="nama_pemilik" class="form-control">
                            </div>
                        </div>
                        <div class="form-group {{$errors->has('merek')?'has-error':''}}">
                            <label for="inputEmail3" class="col-sm-2 control-label">Provinsi</label>
                            <div class="col-sm-5">
                                <select name="provinces_id" class="form-control">
                                    <option value="">Pilih provinsi</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Kabupaten/Kota</label>
                            <div class="col-sm-5">
                                <select name="regency_id" class="form-control">
                                    <option value="">Pilih kabupaten kota</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">No Telp</label>
                            <div class="col-sm-5">
                                <input type="text" name="telp" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
                            <div class="col-sm-5">
                                <input type="text" name="email" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Sentra</label>
                            <label class="radio-inline">
                                <input type="radio" name="sentra" class="minimal" value="1"> Sentra
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="sentra" class="minimal" value="0" checked> Tidak Sentra
                            </label>
                            <span class="help-block">{{$errors->first('sentra')}}</span>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-default">Simpan</button>
                                <button type="button" onclick="history.go(-1);" class="btn btn-default">Kembali</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
