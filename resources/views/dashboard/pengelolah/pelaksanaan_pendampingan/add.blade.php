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
                    <h3 class="box-title">Tambah Pelaksanaan Pendampingan</h3>
                </div>
                <!-- / box Header -->
                <div class="box-body">
                    <form method="post" action="{{ url('pelaksanaan-pendampingan') }}" class="form-horizontal">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Tahun</label>
                            <div class="col-sm-2">
                            <select name="tahun" class="form-control" disabled="true">
                                <option value="{{date('Y')}}">{{date('Y')}}</option>
                            </select>
                            </div>
                        </div>
                        <div class="form-group {{$errors->has('program_kerja_id')?'has-error':''}}">
                            <label class="col-sm-2 control-label">Program Kerja</label>
                            <div class="col-sm-5">
                            <select name="program_kerja_id" class="form-control select2">
                                <option value="">PROKER - KUMKM</option>
                                @forelse ($program_kerja as $row)
                                    <option value="{{$row->id}}" {{old('program_kerja_id')==$row->id?'selected':''}}>{{$row->proker_pendampingan}} - {{$row->sasaran_program->nama_kumkm}}</option>
                                @empty
                                    <option value="">Tidak Ada Program Kerja Telah Di LOCK</option>
                                @endforelse
                            </select>
                            <span class="help-block">{{$errors->first('program_kerja_id')}}</span>
                            </div>
                            <div class="col-sm-5">
                                <span class="help-block text-green"><i class="fa fa-info-circle"></i> Program Kerja akan tampil jika telah di LOCK</span>
                            </div>
                        </div>
                        <div class="form-group {{$errors->has('tanggal')?'has-error':''}}">
                            <label class="col-sm-2 control-label">Tanggal Pelaksanaan</label>
                            <div class="col-sm-5">
                                <input type="text" name="tanggal" class="form-control" placeholder="Tanggal Pelaksanaan Pendampingan" value="{{old('tanggal')?old('tanggal'):date('d-m-Y')}}" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask>
                                <span class="help-block">{{$errors->first('tanggal')}}</span>
                            </div>
                            <div class="col-sm-5">
                                <span class="help-block text-green"><i class="fa fa-info-circle"></i> Tanggal Pelaksanaan Pendampingan</span>
                            </div>
                        </div>
                        <div class="form-group {{$errors->has('materi')?'has-error':''}}">
                            <label class="col-sm-2 control-label">Materi Pendampingan</label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" name="materi" placeholder="Materi Pendampingan" value="{{old('materi')}}">
                                <span class="help-block">{{$errors->first('materi')}}</span>
                            </div>
                            <div class="col-sm-5">
                                <span class="help-block text-green"><i class="fa fa-info-circle"></i> Materi Pendampinga (Max 255 Karakter)</span>
                            </div>
                        </div>
                        <div class="form-group {{$errors->has('tindak_lanjut')?'has-error':''}}">
                            <label class="col-sm-2 control-label">Skema Tindakan Lebih Lanjut</label>
                            <div class="col-sm-5">
                                <textarea name="tindak_lanjut" placeholder="Tindakan Lebih Lanjut" class="form-control">{{old('tindak_lanjut')}}</textarea>
                                <span class="help-block">{{$errors->first('tindak_lanjut')}}</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-default">Simpan</button>
                                <a href="{{ url('pelaksanaan-pendampingan') }}" class="btn btn-default">Kembali</a>
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
