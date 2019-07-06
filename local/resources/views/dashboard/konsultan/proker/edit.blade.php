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
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">{{$title}}</h3>
                </div>
                <!-- / box Header -->
                <div class="box-body">
                    <form method="post" action="{{ url('k/proker/'.$data->id.'/update') }}" class="form-horizontal">
                        <input type="hidden" name="_method" value="PUT">
                        {{ csrf_field() }}
                        <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Proker Plut {{date('Y')}}</label>
                            <div class="col-sm-5">
                                <select class="form-control" name="proker_id" id="proker_id">
                                    <option value="">Pilih Proker Plut</option>
                                    @foreach ($proker as $p)
                                        <option value="{{$p->id}}" {{$data->proker_id==$p->id?'selected':''}}>{{$p->program}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group {{$errors->has('kegiatan')?'has-error':''}}">
                            <label class="col-sm-2 control-label">Nama Kegiatan</label>
                            <div class="col-sm-5">
                                <input type="text" name="kegiatan" class="form-control" placeholder="deskripsikan dengan jelas singkat nama kegiatan" value="{{$data->jenis_kegiatan}}">
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
                                <textarea name="sasaran" placeholder="Sasaran kepada.." class="form-control">{{$data->sasaran}}</textarea>
                                <span class="help-block">{{$errors->first('sasaran')}}</span>
                            </div>
                            <div class="col-sm-5">
                                <span class="help-block">Sasaran: koperasi dan UMKM yang menjadi sasaran kegiatan. Misal : UMKM makanan minuman</span>
                            </div>
                        </div>
                        <div class="form-group {{$errors->has('jumlah_sasaran')?'has-error':''}}">
                            <label class="col-sm-2 control-label">Jumlah Sasaran</label>
                            <div class="col-sm-5">
                                <input type="number" class="form-control" name="jumlah_sasaran" placeholder="Jumlah sasaran" value="{{$data->jml_penerima}}">
                                <span class="help-block">{{$errors->first('jumlah_sasaran')}}</span>
                            </div>
                            <div class="col-sm-5">
                                <span class="help-block">Sasaran: koperasi dan UMKM yang menjadi sasaran kegiatan. Misal : UMKM makanan minuman</span>
                            </div>
                        </div>
                        <div class="form-group {{$errors->has('indikator')?'has-error':''}}">
                            <label class="col-sm-2 control-label">Indikator Kinerja</label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" name="indikator" placeholder="indikator kinerja.." value="{{$data->indikator}}" readonly="">
                                <span class="help-block">{{$errors->first('indikator')}}</span>
                            </div>
                            <div class="col-sm-5">
                                <span class="help-block">Indikator Kinerja: deskripsikan dengan singkat, jelas, dan terukur</span>
                            </div>
                        </div>
                        <div class="form-group {{$errors->has('output')?'has-error':''}}">
                            <label class="col-sm-2 control-label">Output</label>
                            <div class="col-sm-5">
                                <textarea name="output" placeholder="Output.." class="form-control">{{$data->ket_output}}</textarea>
                                <span class="help-block">{{$errors->first('output')}}</span>
                            </div>
                            <div class="col-sm-5">
                                <span class="help-block">Output: keluaran dari pelaksanaan kegiatan</span>
                            </div>
                        </div>
                        <div class="form-group {{$errors->has('jadwal_pelaksana')?'has-error':''}}">
                            <label for="inputEmail3" class="col-sm-2 control-label">Jadwal Pelaksana</label>
                            <div class="col-sm-5">
                                <select class="form-control select2" name="jadwal_pelaksana[]" multiple="multiple" data-placeholder="Pilih Jadwal Pelaksana" style="width: 100%;">
                                    <option value="">Pilih Minggu Ke</option>
                                    @for($i=1; $i<=56; $i++)
                                        <option value="{{ 'Minggu Ke-'.$i }}" {{in_array('Minggu Ke-'.$i,$data->jadwal)?'selected':''}} >{{ 'Minggu Ke-'.$i }}</option>
                                    @endfor
                                </select>
                                <span class="help-block">{{$errors->first('jadwal_pelaksana')}}</span>
                            </div>
                            <div class="col-sm-5">
                                <span class="help-block">Jadwal: Minggu Ke-1, Minggu Ke-2, dst</span>
                            </div>
                        </div>
                        <div class="form-group {{$errors->has('mitra_kerja')?'has-error':''}}">
                            <label for="inputEmail3" class="col-sm-2 control-label">Mitra Kerja</label>
                            <div class="col-sm-5">
                                <textarea rows="4" class="form-control" name="mitra_kerja" placeholder="">{{$data->mitra_kerja}}</textarea>
                                <span class="help-block">{{$errors->first('mitra_kerja')}}</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-default">Simpan</button>
                                <a href="{{ url('k/proker/') }}" class="btn btn-default">Kembali</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection