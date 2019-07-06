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
                    <h3 class="box-title">Edit UMKM</h3>
                </div>
                <!-- / box Header -->
                <div class="box-body">
                    <form method="post" action="{{ url('data-kumkm/'.$data->id) }}" class="form-horizontal">
                        <input type="hidden" name="_method" value="PUT">
                        {{ csrf_field() }}
                        <div class="form-group {{$errors->has('nama_usaha')?'has-error':''}}">
                            <label class="col-sm-2 control-label">Nama Usaha</label>
                            <div class="col-sm-5">
                                <input type="text" name="nama_usaha" class="form-control" placeholder="Isi dengan nama UMKM" value="{{$data->nama_usaha}}">
                                <span class="help-block">{{$errors->first('nama_usaha')}}</span>
                            </div>
                        </div>
                        <div class="form-group {{$errors->has('regency_id')?'has-error':''}}">
                            <label class="col-sm-2 control-label">Kabupaten Kota</label>
                            <div class="col-sm-5">
                                <select name="regency_id" class="form-control select2">
                                <option value="">Pilih Kabupaten Kota</option>
                                @foreach($regencies as $row)
                                    <option value="{{$row->id}}" {{$data->regency_id==$row->id?'selected':''}}>{{$row->name}}</option>
                                @endforeach
                            </select>
                            <span class="help-block">{{$errors->first('regency_id')}}</span>
                            </div>
                            <div class="col-sm-5">
                                <span class="help-block">Pilih Kabupaten Kota Alamat.</span>
                            </div>
                        </div>
                        <div class="form-group {{$errors->has('alamat')?'has-error':''}}">
                            <label class="col-sm-2 control-label">Alamat</label>
                            <div class="col-sm-5">
                                <textarea name="alamat" placeholder="Alamat UMKM" class="form-control">{{$data->alamat}}</textarea>
                                <span class="help-block">{{$errors->first('alamat')}}</span>
                            </div>
                            <div class="col-sm-5">
                                <span class="help-block">Alamat UMKM lengkap.</span>
                            </div>
                        </div>
                        <div class="form-group {{$errors->has('tahun_mulai_usaha')?'has-error':''}}">
                            <label class="col-sm-2 control-label">Tahun Mulai Usaha</label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" name="tahun_mulai_usaha" placeholder="YYYY.." value="{{$data->tgl_mulai_usaha}}">
                                <span class="help-block">{{$errors->first('tahun_mulai_usaha')}}</span>
                            </div>
                            <div class="col-sm-5">
                                <span class="help-block">Masukkan Tahun mulai usaha sesuai format YYYY</span>
                            </div>
                        </div>
                        <div class="form-group {{$errors->has('bidang_usaha')?'has-error':''}}">
                            <label class="col-sm-2 control-label">Bidang Usaha</label>
                            <div class="col-sm-5">
                            <select name="bidang_usaha" class="form-control">
                                <option value="">Pilih Bidang Usaha</option>
                                @foreach($bidang_usaha as $row)
                                    <option value="{{$row->id}}" {{$data->bidang_usaha==$row->id?'selected':''}}>{{$row->name}}</option>
                                @endforeach
                            </select>
                            <span class="help-block">{{$errors->first('bidang_usaha')}}</span>
                            </div>
                            <div class="col-sm-5">
                                <span class="help-block">Bidang usaha UMKM</span>
                            </div>
                        </div>

                        <div class="form-group {{$errors->has('badan_usaha')?'has-error':''}}">
                            <label class="col-sm-2 control-label">Legalitas/Perizinan</label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" name="badan_usaha" placeholder="Badan usaha" value="{{$data->badan_usaha}}">
                                <span class="help-block">{{$errors->first('badan_usaha')}}</span>
                            </div>
                            <div class="col-sm-5">
                                <span class="help-block">Legalitas dan Perizinan yang dimiliki</span>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-default">Simpan</button>
                                <a href="{{ url('data-kumkm/'.$data->id) }}" class="btn btn-default">Kembali</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
