<?php
/**
 * Created by PhpStorm.
 * User: deyelovi
 * Date: 06/03/2017
 * Time: 14:44
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
                    <form method="post" action="{{ url('kinerja-master/'.$data->id) }}" class="form-horizontal" enctype="multipart/form-data">
                        <input type="hidden" name="_method" value="PUT">
                        {{ csrf_field() }}
                        {{-- <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Lembaga</label>
                            <div class="col-sm-5">
                                <select class="form-control" name="cis_lembaga_id" required>
                                    <option value="">Pilih Lembaga</option>
                                    @foreach($lembaga as $row)
                                    <option value="{{$row->id}}" {{$data->cis_lembaga_id==$row->id?'selected':''}} >{{$row->plut_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div> --}}
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Bidang Layanan</label>
                            <div class="col-sm-5">
                                <select class="form-control" name="bidang_layanan_id" required>
                                    <option value="">Pilih Bidang</option>
                                    @foreach($bidanglayanan as $row)
                                    <option value="{{$row->id}}" {{$data->standart_layanan->bidang_layanan->id==$row->id?'selected':''}}>{{$row->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Standart Layanan</label>
                            <div class="col-sm-5">
                                <select id="standart_layanan" class="form-control" name="standart_layanan_id" required>
                                    <option value="">Pilih Standart Layanan</option>
                                    @foreach($standart_layanan as $row)
                                    <option value="{{$row->id}}" {{$row->id==$data->standart_layanan_id?'selected':''}}>{{$row->nama}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Sasaran</label>
                            <div class="col-sm-5">
                                <input type="text" name="sasaran" class="form-control" placeholder="[Text]" value="{{$data->sasaran}}" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Target</label>
                            <div class="col-sm-5">
                                <input type="text" name="target" class="form-control" placeholder="[angka]" value="{{$data->target}}" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Tahun</label>
                            <div class="col-sm-5">
                                <select name="tahun" class="form-control">
                                    <option value="">Tahun</option>
                                    @for($thn=2015; $thn<=2020; $thn++)
                                    <option value="{{$thn}}" {{$data->tahun==$thn?'selected':''}}>{{$thn}}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Jan-Mar</label>
                            <div class="col-sm-5">
                                <input type="text" name="triwulan1" class="form-control" placeholder="[angka]" value="{{$data->triwulan1}}" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Apr-Jun</label>
                            <div class="col-sm-5">
                                <input type="text" name="triwulan2" class="form-control" placeholder="[angka]" value="{{$data->triwulan2}}" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Jul-Sept</label>
                            <div class="col-sm-5">
                                <input type="text" name="triwulan3" class="form-control" placeholder="[angka]" value="{{$data->triwulan3}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Okt-Des</label>
                            <div class="col-sm-5">
                                <input type="text" name="triwulan4" class="form-control" placeholder="[angka]" value="{{$data->triwulan4}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-default">
                                    <i class="fa fa-save"></i> Update
                                </button>
                                <button type="button" onclick="history.go(-1);" class="btn btn-default">
                                    <i class="fa fa-reply"></i> Kembali
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
