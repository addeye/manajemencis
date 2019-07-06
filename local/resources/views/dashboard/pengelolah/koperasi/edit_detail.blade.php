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
                    <h3 class="box-title">Edit Detail Koperasi <b>{{$data->koperasi->nama_koperasi}}</b></h3>
                    <div class="pull-right">
                        <a class="btn btn-warning btn-xs" href="{{ url('adm/koperasi/'.$data->id) }}">
                            <i class="fa fa-reply"></i> Kembali
                        </a>
                    </div>
                </div>
                <!-- / box Header -->
                <div class="box-body">
                    <form method="post" action="{{ url('adm/koperasi-detail/'.$data->koperasi_id.'/'.$data->id) }}" class="form-horizontal">
                        <input type="hidden" name="_method" value="PUT">
                        {{ csrf_field() }}
                        <input type="hidden" name="koperasi_id" value="{{$data->id}}">
                        <div class="form-group {{$errors->has('tanggal_keadaan')?'has-error':''}}">
                            <label class="col-sm-2 control-label">Tanggal Keadaan</label>
                            <div class="col-sm-5">
                                <input type="text" name="tanggal_keadaan" class="form-control" placeholder="Tanggal Status Keadaan" value="{{$data->tanggal_keadaan?date('d-m-Y',strtotime($data->tanggal_keadaan)):date('d-m-Y')}}" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask>
                                <span class="help-block">{{$errors->first('tanggal_keadaan')}}</span>
                            </div>
                            <div class="col-sm-5">
                                <span class="help-block">Tanggal Status Keadaan Koperasi Terakhir</span>
                            </div>
                        </div>
                        <div class="form-group {{$errors->has('tgl_rat_tahun_buku')?'has-error':''}}">
                            <label class="col-sm-2 control-label">Tanggal RAT</label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" name="tgl_rat_tahun_buku" placeholder="Tanggal Format DD-MM-YYYY" value="{{$data->tgl_rat_tahun_buku?date('d-m-Y',strtotime($data->tgl_rat_tahun_buku)):'00-00-0000'}}" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask>
                                <span class="help-block">{{$errors->first('tgl_rat_tahun_buku')}}</span>
                            </div>
                            <div class="col-sm-5">
                                <span class="help-block">Tanggal RAT Tahun Buku {{date('Y')}}</span>
                            </div>
                        </div>

                        <div class="form-group {{$errors->has('jml_anggota')?'has-error':''}}">
                            <label class="col-sm-2 control-label">Jumlah Anggota</label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" name="jml_anggota" placeholder="Jumlah Anggota" value="{{$data->jml_anggota}}">
                                <span class="help-block">{{$errors->first('jml_anggota')}}</span>
                            </div>
                            <div class="col-sm-5">
                                <span class="help-block">Jumlah Anggota yang bergabung (format angka)</span>
                            </div>
                        </div>

                        <div class="form-group {{$errors->has('jml_karyawan')?'has-error':''}}">
                            <label class="col-sm-2 control-label">Jumlah Karyawan</label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" name="jml_karyawan" placeholder="Jumlah Karyawan" value="{{$data->jml_karyawan}}">
                                <span class="help-block">{{$errors->first('jml_karyawan')}}</span>
                            </div>
                            <div class="col-sm-5">
                                <span class="help-block">Jumlah Karyawan yang dimiliki (format angka)</span>
                            </div>
                        </div>

                        <div class="form-group {{$errors->has('jml_asset')?'has-error':''}}">
                            <label class="col-sm-2 control-label">Jumlah Asset</label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" name="jml_asset" placeholder="Jumlah Asset" value="{{$data->jml_asset}}">
                                <span class="help-block">{{$errors->first('jml_asset')}}</span>
                            </div>
                            <div class="col-sm-5">
                                <span class="help-block">Jumlah Asset yang dimiliki (format angka)</span>
                            </div>
                        </div>

                        <div class="form-group {{$errors->has('jml_modal_sendiri')?'has-error':''}}">
                            <label class="col-sm-2 control-label">Jumlah Modal Sendiri</label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" name="jml_modal_sendiri" placeholder="Jumlah Modal Sendiri" value="{{$data->jml_modal_sendiri}}">
                                <span class="help-block">{{$errors->first('jml_modal_sendiri')}}</span>
                            </div>
                            <div class="col-sm-5">
                                <span class="help-block">Jumlah Modal Sendiri yang dimiliki (format angka)</span>
                            </div>
                        </div>

                        <div class="form-group {{$errors->has('jml_modal_luar')?'has-error':''}}">
                            <label class="col-sm-2 control-label">Jumlah Modal Luar</label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" name="jml_modal_luar" placeholder="Jumlah Modal Luar" value="{{$data->jml_modal_luar}}">
                                <span class="help-block">{{$errors->first('jml_modal_luar')}}</span>
                            </div>
                            <div class="col-sm-5">
                                <span class="help-block">Jumlah Modal Dari Luar yang dimiliki (format angka)</span>
                            </div>
                        </div>

                        <div class="form-group {{$errors->has('volume_usaha')?'has-error':''}}">
                            <label class="col-sm-2 control-label">Omset</label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" name="volume_usaha" placeholder="Jumlah Volume Usaha" value="{{$data->volume_usaha}}">
                                <span class="help-block">{{$errors->first('volume_usaha')}}</span>
                            </div>
                            <div class="col-sm-5">
                                <span class="help-block">Omset sekarang (format angka)</span>
                            </div>
                        </div>

                        <div class="form-group {{$errors->has('sisa_hasil')?'has-error':''}}">
                            <label class="col-sm-2 control-label">Sisa Hasil Usaha</label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" name="sisa_hasil" placeholder="Jumlah Sisa Hasil Usaha" value="{{$data->sisa_hasil}}">
                                <span class="help-block">{{$errors->first('sisa_hasil')}}</span>
                            </div>
                            <div class="col-sm-5">
                                <span class="help-block">Sisa Hasil Usaha sekarang (format angka)</span>
                            </div>
                        </div>


                        <div class="form-group {{$errors->has('kegiatan_usaha')?'has-error':''}}">
                            <label class="col-sm-2 control-label">Kegiatan Usaha</label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" name="kegiatan_usaha" placeholder="Kegiatan Usaha Koperasi" value="{{$data->kegiatan_usaha}}">
                                <span class="help-block">{{$errors->first('kegiatan_usaha')}}</span>
                            </div>
                            <div class="col-sm-5">
                                <span class="help-block">Sebutkan Prioritas Kegiatan Usaha Koperasi</span>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-default">Simpan</button>
                                <a href="{{ url('adm/koperasi/'.$data->koperasi_id) }}" class="btn btn-default">Kembali</a>
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
