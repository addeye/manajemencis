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
                                <input type="text" name="nama_produk" class="form-control" placeholder="Nama produk.." value="{{old('nama_produk')}}">
                            </div>
                            <span class="help-block">{{$errors->first('nama_produk')}}</span>
                        </div>

                        <div class="form-group {{$errors->has('merek')?'has-error':''}}">
                            <label for="inputEmail3" class="col-sm-2 control-label">Merek</label>
                            <div class="col-sm-5">
                                <input type="text" name="merek" class="form-control" placeholder="Merek.." value="{{old('merek')}}">
                            </div>
                            <span class="help-block">{{$errors->first('merek')}}</span>
                        </div>

                        <div class="form-group {{$errors->has('legalitas')?'has-error':''}}">
                            <label for="inputEmail3" class="col-sm-2 control-label">Legalitas</label>
                            <div class="col-sm-5">
                                <input type="text" name="legalitas" class="form-control" placeholder="Legalitas.." value="{{old('legalitas')}}">
                            </div>
                            <span class="help-block">{{$errors->first('legalitas')}}</span>
                        </div>

                        <div class="form-group {{$errors->has('bidang_usaha')?'has-error':''}}">
                            <label for="inputEmail3" class="col-sm-2 control-label">Bidang Usaha</label>
                            <div class="col-sm-5">
                                <select name="bidang_usaha" class="form-control">
                                    <option value="">Pilih bidang usaha</option>
                                    @foreach($bidang_usaha as $bidang)
                                        <option value="{{$bidang->id}}" {{old('bidang_usaha')==$bidang->id?'selected':''}}>{{$bidang->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <span class="help-block">{{$errors->first('bidang_usaha')}}</span>
                        </div>

                        <div class="form-group {{$errors->has('satuan')?'has-error':''}}">
                            <label for="inputEmail3" class="col-sm-2 control-label">Satuan</label>
                            <div class="col-sm-2">
                                <input type="text" name="satuan" class="form-control" placeholder="Satuan.." value="{{old('satuan')}}">
                            </div>
                            <span class="help-block">{{$errors->first('satuan')}}</span>
                        </div>

                        <div class="form-group {{$errors->has('kapasitas_perbulan')?'has-error':''}}">
                            <label for="inputEmail3" class="col-sm-2 control-label">Kapasitas Per Bulan</label>
                            <div class="col-sm-2">
                                <input type="text" name="kapasitas_perbulan" class="form-control" placeholder="Kapasitas /bulan.." value="{{old('kapasitas_perbulan')}}">
                            </div>
                            <span class="help-block">{{$errors->first('kapasitas_perbulan')}}</span>
                        </div>

                        <div class="form-group {{$errors->has('omset_perbulan')?'has-error':''}}">
                            <label for="inputEmail3" class="col-sm-2 control-label">Omset Per Bulan</label>
                            <div class="col-sm-2">
                                <input type="text" name="omset_perbulan" class="form-control" placeholder="Omset /bulan.." value="{{old('omset_perbulan')}}">
                            </div>
                            <span class="help-block">{{$errors->first('omset_perbulan')}}</span>
                        </div>

                        <div class="form-group {{$errors->has('nama_pemilik')?'has-error':''}}">
                            <label for="inputEmail3" class="col-sm-2 control-label">Nama Pemilik</label>
                            <div class="col-sm-5">
                                <input type="text" name="nama_pemilik" class="form-control" placeholder="Nama pemilik.." value="{{old('nama_pemilik')}}">
                            </div>
                            <span class="help-block">{{$errors->first('nama_pemilik')}}</span>
                        </div>

                        <div class="form-group {{$errors->has('nama_perusahaan')?'has-error':''}}">
                            <label for="inputEmail3" class="col-sm-2 control-label">Nama Perusahaan</label>
                            <div class="col-sm-5">
                                <input type="text" name="nama_perusahaan" class="form-control" placeholder="Nama perusahaan.." value="{{old('nama_perusahaan')}}">
                            </div>
                            <span class="help-block">{{$errors->first('nama_perusahaan')}}</span>
                        </div>

                        <div class="form-group {{$errors->has('provinces_id')?'has-error':''}}">
                            <label for="inputEmail3" class="col-sm-2 control-label">Provinsi</label>
                            <div class="col-sm-5">
                                <select id="provinces" name="provinces_id" class="form-control select2">
                                    <option value="">Pilih provinsi</option>
                                    @foreach($provinces as $prov)
                                        <option value="{{$prov->id}}">{{$prov->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <span class="help-block">{{$errors->first('provinces_id')}}</span>
                        </div>

                        <div id="ajaxRegencies">
                            <div class="form-group {{$errors->has('regency_id')?'has-error':''}}">
                                <label for="inputEmail3" class="col-sm-2 control-label">Kabupaten/Kota</label>
                                <div class="col-sm-5">
                                    <select name="regency_id" class="form-control select2">
                                        <option value="">Pilih kabupaten kota</option>
                                    </select>
                                </div>
                                <span class="help-block">{{$errors->first('regency_id')}}</span>
                            </div>
                        </div>

                        <div class="form-group {{$errors->has('alamat')?'has-error':''}}">
                            <label for="inputEmail3" class="col-sm-2 control-label">Alamat</label>
                            <div class="col-sm-5">
                                <textarea rows="4" class="form-control" name="alamat" placeholder="Alamat..">{{old('alamat')}}</textarea>
                            </div>
                            <span class="help-block">{{$errors->first('alamat')}}</span>
                        </div>

                        <div class="form-group {{$errors->has('telp')?'has-error':''}}">
                            <label for="inputEmail3" class="col-sm-2 control-label">No Telp</label>
                            <div class="col-sm-3">
                                <input type="text" name="telp" class="form-control" placeholder="No telp.." value="{{old('telp')}}">
                            </div>
                            <span class="help-block">{{$errors->first('telp')}}</span>
                        </div>

                        <div class="form-group {{$errors->has('email')?'has-error':''}}">
                            <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
                            <div class="col-sm-3">
                                <input type="text" name="email" class="form-control" placeholder="Email.." value="{{old('email')}}">
                            </div>
                            <span class="help-block">{{$errors->first('email')}}</span>
                        </div>

                        {{--@if(Auth::user()->role_id==1)--}}
                            {{--<div class="form-group {{$errors->has('lembaga_id')?'has-error':''}}">--}}
                                {{--<label for="inputEmail3" class="col-sm-2 control-label">Lembaga</label>--}}
                                {{--<div class="col-sm-5">--}}
                                    {{--<select name="lembaga_id" class="form-control select2">--}}
                                        {{--<option value="">Pilih Lembaga</option>--}}
                                        {{--@foreach($lembaga as $row)--}}
                                            {{--<option value="{{$row->id}}" {{old('lembaga_id')==$row->id?'selected':''}}>{{$row->name}}</option>--}}
                                        {{--@endforeach--}}
                                    {{--</select>--}}
                                {{--</div>--}}
                                {{--<span class="help-block">{{$errors->first('lembaga_id')}}</span>--}}
                            {{--</div>--}}
                        {{--@endif--}}

                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Sentra</label>
                            <label class="radio-inline">
                                <input type="radio" name="sentra" class="minimal" value="1" {{old('sentra')=='1'?'checked':''}}> Sentra
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="sentra" class="minimal" value="0" {{old('sentra')=='0'?'checked':''}}> Tidak Sentra
                            </label>
                            <span class="help-block">{{$errors->first('sentra')}}</span>
                        </div>

                        <div id="ajaxSentra">
                            <div class="form-group {{$errors->has('sentra_id')?'has-error':''}}">
                                <label for="inputEmail3" class="col-sm-2 control-label">Daftar Sentra</label>
                                <div class="col-sm-5">
                                    <select name="sentra_id" class="form-control select2">
                                        <option value="">Pilih Sentra</option>
                                        @foreach($sentra as $row)
                                            <option value="{{$row->id}}" {{old('sentra_id')==$row->id?'selected':''}}>{{$row->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <span class="help-block">{{$errors->first('sentra_id')}}</span>
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
    <input type="hidden" id="urlregencies" value="{{ url('common/regencies') }}">
@endsection

@section('script')
    <script>
        urlregencies = $('#urlregencies').val();
        $('#provinces').change(function(){
            $.ajax({
                url: urlregencies+'/'+this.value,
                type : 'GET',
                cache : false,
                dataType : 'html'
            })
                    .success(function(response){
                        $('#ajaxRegencies').html(response);
                        $(".select2").select2();
                    })
        });
    </script>
@endsection
