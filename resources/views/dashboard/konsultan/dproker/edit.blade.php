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
                    <form method="post" action="{{ url('k/dproker/'.$data->id.'/update') }}" class="form-horizontal">
                        <input type="hidden" name="_method" value="PUT">
                        {{ csrf_field() }}
                        <input type="hidden" name="proker_id" value="{{$data->proker_id}}">
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Jenis Kegiatan</label>
                            <div class="col-sm-5">
                                <input type="text" name="jenis_kegiatan" class="form-control" value="{{ $data->jenis_kegiatan }}" placeholder="Jenis kegiatan.." required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Tujuan</label>
                            <div class="col-sm-5">
                                <input type="text" name="tujuan" class="form-control" value="{{$data->tujuan}}" placeholder="Tujuan .." required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">IKU</label>
                            <div class="col-sm-5">
                                <select name="jenis_layanan_id" class="form-control">
                                    <option value="">Pilih IKU</option>
                                    @foreach($jenis_layanan as $row)
                                        <option value="{{$row->id}}" {{$data->jenis_layanan_id==$row->id?'selected':''}} >{{ $row->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Outpt / Keterangan</label>
                            <div class="col-sm-2">
                                <input type="text" name="output" class="form-control" value="{{$data->output}}" placeholder="Output.." required>
                            </div>
                            <div class="col-sm-3">
                                <input type="text" name="ket_output" class="form-control" value="{{$data->ket_output}}" placeholder="Keterangan.." required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Jumlah Penerima</label>
                            <div class="col-sm-2">
                                <input type="text" name="jml_penerima" class="form-control" value="{{$data->jml_penerima}}" placeholder="Jumlah penerima.." required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Anggaran</label>
                            <div class="col-sm-2">
                                <input type="text" name="anggaran" class="form-control" value="{{$data->anggaran}}" placeholder="Anggaran.." required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Jadwal Pelaksana</label>
                            <div class="col-sm-2">
                                <input type="text" name="jadwal_pelaksana" class="form-control" value="{{$data->jadwal_pelaksana}}" placeholder="Jadwal Pelaksana.." required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Mitra Kerja</label>
                            <div class="col-sm-5">
                                <input type="text" name="mitra_kerja" class="form-control" value="{{$data->mitra_kerja}}" placeholder="Mitra Kerja.." required>
                            </div>
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