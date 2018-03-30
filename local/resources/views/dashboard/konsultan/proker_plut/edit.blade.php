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
					<h3 class="box-title">{{$title}}</h3>
					<div class="pull-right">
						<a class="btn btn-primary" href="{{ url('adm/proker-plut') }}">
							<i class="fa fa-list"></i> Lihat Data
						</a>
					</div>
				</div>
				<!-- / box Header -->
				<div class="box-body">
					<form action="{{ url('adm/proker-plut/'.$data->id) }}" method="post" class="form-horizontal">
						<input type="hidden" name="_method" value="PUT">
                        {{ csrf_field() }}
						<div class="form-group {{$errors->has('tahun')?'has-error':''}}">
                            <label class="col-sm-2 control-label">Tahun</label>
                            <div class="col-sm-2">
                                <input type="text" name="tahun" class="form-control" readonly="true" value="{{$data->tahun_kegiatan}}">
                                <span class="help-block">{{$errors->first('tahun')}}</span>
                            </div>
                        </div>
                        <div class="form-group {{$errors->has('kegiatan')?'has-error':''}}">
                            <label class="col-sm-2 control-label">Nama Kegiatan</label>
                            <div class="col-sm-5">
                                <input type="text" name="kegiatan" class="form-control" placeholder="deskripsikan dengan jelas singkat nama kegiatan" value="{{$data->program}}">
                                <span class="help-block">{{$errors->first('kegiatan')}}</span>
                            </div>
                        </div>
                        <div class="form-group {{$errors->has('tujuan')?'has-error':''}}">
                            <label class="col-sm-2 control-label">Tujuan</label>
                            <div class="col-sm-5">
                                <textarea name="tujuan" placeholder="Tujuan dari program kerja" class="form-control">{{$data->tujuan}}</textarea>
                                <span class="help-block">{{$errors->first('tujuan')}}</span>
                            </div>
                            <div class="col-sm-5">
                            	<span class="help-block">Tujuan dari program kerja</span>
                            </div>
                        </div>
                        <div class="form-group {{$errors->has('sasaran')?'has-error':''}}">
                            <label class="col-sm-2 control-label">Sasaran</label>
                            <div class="col-sm-5">
                                <textarea name="sasaran" placeholder="Sasaran.." class="form-control">{{$data->sasaran}}</textarea>
                                <span class="help-block">{{$errors->first('sasaran')}}</span>
                            </div>
                            <div class="col-sm-5">
                            	<span class="help-block">Sasaran: koperasi dan UMKM yang menjadi sasaran kegiatan. Misal : UMKM makanan minuman</span>
                            </div>
                        </div>
                        <div class="form-group {{$errors->has('jumlah_sasaran')?'has-error':''}}">
                            <label class="col-sm-2 control-label">Jumlah Sasaran</label>
                            <div class="col-sm-5">
                                <input type="number" class="form-control" name="jumlah_sasaran" value="{{$data->jumlah_sasaran}}">
                                <span class="help-block">{{$errors->first('jumlah_sasaran')}}</span>
                            </div>
                            <div class="col-sm-5">
                                <span class="help-block">Sasaran: koperasi dan UMKM yang menjadi sasaran kegiatan. Misal : UMKM makanan minuman</span>
                            </div>
                        </div>
                        <div class="form-group {{$errors->has('indikator')?'has-error':''}}">
                            <label class="col-sm-2 control-label">Indikator Kinerja</label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" name="indikator" placeholder="indikator kinerja.." value="{{$data->indikator}}">
                                <span class="help-block">{{$errors->first('indikator')}}</span>
                            </div>
                            <div class="col-sm-5">
                            	<span class="help-block">Indikator Kinerja: deskripsikan dengan singkat, jelas, dan terukur</span>
                            </div>
                        </div>
                        <div class="form-group {{$errors->has('output')?'has-error':''}}">
                            <label class="col-sm-2 control-label">Output</label>
                            <div class="col-sm-5">
                                <textarea name="output" placeholder="Output.." class="form-control">{{$data->output}}</textarea>
                                <span class="help-block">{{$errors->first('output')}}</span>
                            </div>
                            <div class="col-sm-5">
                            	<span class="help-block">Output: keluaran dari pelaksanaan kegiatan</span>
                            </div>
                        </div>
                        <div class="form-group {{$errors->has('anggaran[]')?'has-error':''}}">
                            <label class="col-sm-2 control-label">Sumber Anggaran</label>
                            <div class="col-sm-5">
                                <select class="form-control select2" name="anggaran[]" multiple="multiple">
                                	<option value=''>Pilih</option>
                                	@foreach ($anggaran as $row)
                                		<option value="{{$row->id}}" {{in_array($row->id,$data->proker_anggaran->pluck('anggaran_id')->toArray())?'selected':''}}>{{$row->nama}}</option>
                                	@endforeach
                                </select>
                                <span class="help-block">{{$errors->first('anggaran[]')}}</span>
                            </div>
                            <div class="col-sm-5">
                            	<span class="help-block">Sumber Anggaran: 1. APBN, 2. APBD PROVINSI, 3. APBD KABUPATEN, 4 . KEMITRAAN, atau gabungan dari beberapa sumber tersebut</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-success">Update</button>
                                <a href="{{ url('adm/proker-plut') }}" class="btn btn-warning">Kembali</a>
                            </div>
                        </div>
					</form>
				</div>


			</div>
		</div>
	</div>
@endsection