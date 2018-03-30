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
                    <h3 class="box-title">Tambah Detail UMKM</h3>
                </div>
                <!-- / box Header -->
                <div class="box-body">
                    <form method="post" action="{{ url('data-kumkm-add-detail') }}" class="form-horizontal">
                        {{ csrf_field() }}
                        <input type="hidden" name="kumkm_id" value="{{$data->id}}">
                        <div class="form-group {{$errors->has('tanggal_keadaan')?'has-error':''}}">
                            <label class="col-sm-2 control-label">Tanggal Keadaan</label>
                            <div class="col-sm-5">
                                <input type="text" name="tanggal_keadaan" class="form-control" placeholder="Tanggal Status Keadaan" value="{{old('tanggal_keadaan')?old('tanggal_keadaan'):date('d-m-Y')}}" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask>
                                <span class="help-block">{{$errors->first('tanggal_keadaan')}}</span>
                            </div>
                            <div class="col-sm-5">
                                <span class="help-block">Tanggal Status Keadaan UMKM Terakhir</span>
                            </div>
                        </div>

                        <div class="form-group {{$errors->has('jml_tenaga_kerja')?'has-error':''}}">
                            <label class="col-sm-2 control-label">Jumlah Tenaga Kerja</label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" name="jml_tenaga_kerja" placeholder="Jumlah Tenaga Kerja" value="{{old('jml_tenaga_kerja')}}">
                                <span class="help-block">{{$errors->first('jml_tenaga_kerja')}}</span>
                            </div>
                            <div class="col-sm-5">
                                <span class="help-block">Jumlah Tenaga Kerja (format angka)</span>
                            </div>
                        </div>

                        <div class="form-group {{$errors->has('modal_sendiri')?'has-error':''}}">
                            <label class="col-sm-2 control-label">Jumlah Modal Sendiri</label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" name="modal_sendiri" placeholder="Jumlah Modal Sendiri" value="{{old('modal_sendiri')}}">
                                <span class="help-block">{{$errors->first('modal_sendiri')}}</span>
                            </div>
                            <div class="col-sm-5">
                                <span class="help-block">Jumlah Modal Sendiri yang dimiliki (format angka)</span>
                            </div>
                        </div>

                        <div class="form-group {{$errors->has('modal_hutang')?'has-error':''}}">
                            <label class="col-sm-2 control-label">Jumlah Modal Hutang</label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" name="modal_hutang" placeholder="Jumlah Modal Hutang" value="{{old('modal_hutang')}}">
                                <span class="help-block">{{$errors->first('modal_hutang')}}</span>
                            </div>
                            <div class="col-sm-5">
                                <span class="help-block">Jumlah Modal Hutang yang dimiliki (format angka)</span>
                            </div>
                        </div>

                        <div class="form-group {{$errors->has('asset')?'has-error':''}}">
                            <label class="col-sm-2 control-label">Jumlah Asset</label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" name="asset" placeholder="Jumlah Asset" value="{{old('asset')}}">
                                <span class="help-block">{{$errors->first('asset')}}</span>
                            </div>
                            <div class="col-sm-5">
                                <span class="help-block">Jumlah Asset yang dimiliki (format angka)</span>
                            </div>
                        </div>

                        <div class="form-group {{$errors->has('omset')?'has-error':''}}">
                            <label class="col-sm-2 control-label">Jumlah Omset</label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" name="omset" placeholder="Jumlah Omset" value="{{old('omset')}}">
                                <span class="help-block">{{$errors->first('omset')}}</span>
                            </div>
                            <div class="col-sm-5">
                                <span class="help-block">Jumlah Omset (format angka)</span>
                            </div>
                        </div>

                        <div class="form-group {{$errors->has('kegiatan_usaha')?'has-error':''}}">
                            <label class="col-sm-2 control-label">Kegiatan Usaha</label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" name="kegiatan_usaha" placeholder="Kegiatan Usaha UMKM" value="{{old('kegiatan_usaha')}}">
                                <span class="help-block">{{$errors->first('kegiatan_usaha')}}</span>
                            </div>
                            <div class="col-sm-5">
                                <span class="help-block">Sebutkan Prioritas Kegiatan Usaha UMKM (Max 255 Karakter)</span>
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

@section('script')
<script src="{{url('admin-lte/plugins/input-mask/jquery.inputmask.js')}}"></script>
<script src="{{url('admin-lte/plugins/input-mask/jquery.inputmask.date.extensions.js')}}"></script>
<script src="{{url('admin-lte/plugins/input-mask/jquery.inputmask.extensions.js')}}"></script>
@endsection

