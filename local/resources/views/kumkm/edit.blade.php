<?php
/**
 * Created by PhpStorm.
 * User: deyelovi
 * Date: 18/03/2017
 * Time: 22:49
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
                    <form method="post" action="{{ url('kumkm/'.$data->id.'/update') }}" class="">
                        <input type="hidden" name="_method" value="PUT">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group {{$errors->has('id_kumkm')?'has-error':''}}">
                                    <label>ID KUMKM</label>
                                    <input type="text" name="id_kumkm" class="form-control" placeholder="4 Digit ID CIS Lembaga & 6 Digit no urut ..." value="{{$data->id_kumkm}}">
                                    <span class="help-block">{{$errors->first('id_kumkm')}}</span>
                                </div>
                                <div class="form-group {{$errors->has('nama_usaha')?'has-error':''}}">
                                    <label>Nama USAHA</label>
                                    <input type="text" name="nama_usaha" class="form-control" placeholder="Nama usaha..." value="{{$data->nama_usaha}}">
                                    <span class="help-block">{{$errors->first('nama_usaha')}}</span>
                                </div>
                                <div class="form-group {{$errors->has('nama_pemilik')?'has-error':''}}">
                                    <label>Nama Pemilik</label>
                                    <input type="text" name="nama_pemilik" class="form-control" placeholder="Nama Pemilik..." value="{{$data->nama_pemilik}}">
                                    <span class="help-block">{{$errors->first('nama_pemilik')}}</span>
                                </div>
                                <div class="form-group {{$errors->has('no_ktp')?'has-error':''}}">
                                    <label>No KTP</label>
                                    <input type="text" name="no_ktp" class="form-control" placeholder="No KTP..." value="{{$data->no_ktp}}">
                                    <span class="help-block">{{$errors->first('no_ktp')}}</span>
                                </div>
                                <div class="form-group {{$errors->has('npwp')?'has-error':''}}">
                                    <label>NPWP</label>
                                    <input type="text" name="npwp" class="form-control" placeholder="NPWP..." value="{{$data->npwp}}">
                                    <span class="help-block">{{$errors->first('npwp')}}</span>
                                </div>
                                <div class="form-group {{$errors->has('badan_usaha')?'has-error':''}}">
                                    <label>Badan Usaha / Badan Hukum</label>
                                    <select class="form-control" name="badan_usaha">
                                        <option value="-" {{$data->badan_usaha=='-'?'selected':''}}>Pilih Badan Usaha/ Hukum</option>
                                        <option value="Perorangan" {{$data->badan_usaha=='Perorangan'?'selected':''}}>Perorangan</option>
                                        <option value="UD" {{$data->badan_usaha=='UD'?'selected':''}}>UD</option>
                                        <option value="CV" {{$data->badan_usaha=='CV'?'selected':''}}>CV</option>
                                        <option value="PT Koperasi" {{$data->badan_usaha=='PT Koperasi'?'selected':''}}>PT Koperasi</option>
                                        <option value="Yayasan" {{$data->badan_usaha=='Yayasan'?'selected':''}}>Yayasan</option>
                                        <option value="Lainnya" {{$data->badan_usaha=='Lainnya'?'selected':''}}>Lainnya</option>
                                    </select>
                                    <span class="help-block">{{$errors->first('ket_badan_usaha')}}</span>
                                </div>
                                <div class="form-group {{$errors->has('ket_badan_usaha')?'has-error':''}}">
                                    <label>Ket Badan Usaha / Badan Hukum</label>
                                    <input type="text" name="ket_badan_usaha" class="form-control" placeholder="Keterangan badan usaha..." value="{{$data->ket_badan_usaha}}">
                                    <span class="help-block">{{$errors->first('ket_badan_usaha')}}</span>
                                </div>
                                <div class="form-group {{$errors->has('tgl_mulai_usaha')?'has-error':''}}">
                                    <label>Tanggal Mulai Usaha</label>
                                    <div class="input-group date">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input type="text" name="tgl_mulai_usaha" class="form-control datepicker" placeholder="Tanggal mulai usaha..." value="{{$data->tgl_mulai_usaha}}" readonly>
                                    </div>
                                    <span class="help-block">{{$errors->first('tgl_mulai_usaha')}}</span>
                                </div>
                                <div class="form-group {{$errors->has('sektor_usaha')?'has-error':''}}">
                                    <label>Sektor Usaha</label>
                                    <input type="text" name="sektor_usaha" class="form-control" placeholder="Sektor Usaha..." value="{{$data->sektor_usaha}}">
                                    <span class="help-block">{{$errors->first('sektor_usaha')}}</span>
                                </div>
                                <div class="form-group {{$errors->has('skala_usaha')?'has-error':''}}">
                                    <label>Skala Usaha</label>
                                    <select class="form-control" name="skala_usaha">
                                        <option value="-" {{$data->skala_usaha=='-'?'selected':''}}>Pilih Skala Usaha</option>
                                        <option value="Mikro" {{$data->skala_usaha=='Mikro'?'selected':''}}>Mikro</option>
                                        <option value="Kecil" {{$data->skala_usaha=='Kecil'?'selected':''}}>Kecil</option>
                                        <option value="Menengah" {{$data->skala_usaha=='Menengah'?'selected':''}}>Menengah</option>
                                    </select>
                                    <span class="help-block">{{$errors->first('skala_usaha')}}</span>
                                </div>
                                <div class="form-group {{$errors->has('usaha_utama')?'has-error':''}}">
                                    <label>Usaha Utama/Pokok</label>
                                    <input type="text" name="usaha_utama" class="form-control" placeholder="Usaha utama..." value="{{$data->usaha_utama}}">
                                    <span class="help-block">{{$errors->first('usaha_utama')}}</span>
                                </div>
                                <div class="form-group {{$errors->has('hasil_produk')?'has-error':''}}">
                                    <label>Produk yang dihasilkan</label>
                                    <input type="text" name="hasil_produk" class="form-control" placeholder="Produk yang dihasilkan..." value="{{$data->hasil_produk}}">
                                    <span class="help-block">{{$errors->first('hasil_produk')}}</span>
                                </div>
                            </div>
                            <!-- /.col -->
                            <div class="col-md-6">
                                <div class="form-group {{$errors->has('sentra')?'has-error':''}}">
                                    <label class="radio-inline">
                                        <input type="radio" name="sentra" class="minimal" value="1" {{$data->sentra==1?'checked':''}}> Sentra
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="sentra" class="minimal" value="0" {{$data->sentra==0?'checked':''}}> Tidak Sentra
                                    </label>
                                    <span class="help-block">{{$errors->first('sentra')}}</span>
                                </div>
                                <div class="form-group {{$errors->has('sentra_id')?'has-error':''}}">
                                    <label>Sentra ID</label>
                                    <select name="sentra_id" class="form-control select2">
                                        <option value="0">Pilih Sentra</option>
                                        @foreach($sentra as $row)
                                            <option value="{{$row->id}}" {{$data->sentra_id==$row->id?'selected':''}}>{{$row->name}}</option>
                                        @endforeach
                                    </select>
                                    <span class="help-block">{{$errors->first('sentra_id')}}</span>
                                </div>
                                <div class="form-group {{$errors->has('tk_tetap')?'has-error':''}}">
                                    <label>Tenaga Kerja Tetap</label>
                                    <input type="text" name="tk_tetap" class="form-control" placeholder="Jumlah tenaga kerja tetap..." value="{{$data->tk_tetap}}">
                                    <span class="help-block">{{$errors->first('tk_tetap')}}</span>
                                </div>
                                <div class="form-group {{$errors->has('tk_tidak_tetap')?'has-error':''}}">
                                    <label>Tenaga Kerja Tidak Tetap</label>
                                    <input type="text" name="tk_tidak_tetap" class="form-control" placeholder="Jumlah tenaga kerja tidak tetap..." value="{{$data->tk_tetap}}">
                                    <span class="help-block">{{$errors->first('tk_tetap')}}</span>
                                </div>
                                <div class="form-group {{$errors->has('email')?'has-error':''}}">
                                    <label>Email</label>
                                    <input type="text" name="email" class="form-control" placeholder="Alamat email.." value="{{$data->email}}" readonly>
                                    <span class="help-block">{{$errors->first('email')}}</span>
                                </div>
                                <!-- /.form-group -->
                                <div class="form-group {{$errors->has('telp')?'has-error':''}}">
                                    <label>No Telp</label>
                                    <input type="text" name="telp" class="form-control" placeholder="No telp .." value="{{$data->telp}}">
                                    <span class="help-block">{{$errors->first('telp')}}</span>
                                </div>
                                <div class="form-group {{$errors->has('alamat')?'has-error':''}}">
                                    <label>Alamat</label>
                                    <textarea rows="4" class="form-control" name="alamat" placeholder="Alamat usaha">{{$data->alamat}}</textarea>
                                    <span class="help-block">{{$errors->first('alamat')}}</span>
                                </div>
                                <div class="form-group {{$errors->has('provinces_id')?'has-error':''}}">
                                    <label>Provinsi</label>
                                    <select id="provinces_id" name="provinces_id" class="form-control select2">
                                        <option value="">Pilih Provinsi</option>
                                        @foreach($provinces as $row)
                                            <option value="{{$row->id}}" {{$data->provinces_id==$row->id?'selected':''}}>{{$row->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div id="ajaxRegencies">
                                    <div class="form-group {{$errors->has('regency_id')?'has-error':''}}">
                                        <label>Kabupaten Kota</label>
                                        <select onchange="regencies(this.value)" name="regency_id" class="form-control select2">
                                            <option value="">Pilih Kabupaten Kota</option>
                                            @foreach($regencies as $row)
                                                <option value="{{$row->id}}" {{$data->regency_id==$row->id?'selected':''}}>{{$row->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div id="ajaxDistics">
                                    <div class="form-group {{$errors->has('district_id')?'has-error':''}}">
                                        <label>Kecamatan</label>
                                        <select onchange="districts(this.value)" class="form-control select2" name="district_id">
                                            <option value="">Pilih Kecamatan</option>
                                            @foreach($districts as $row)
                                                <option value="{{$row->id}}" {{$data->district_id==$row->id?'selected':''}}>{{$row->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div id="ajaxVillages">
                                    <div class="form-group {{$errors->has('village_id')?'has-error':''}}">
                                        <label>Kelurahan</label>
                                        <select class="form-control select2" name="village_id">
                                            <option value="">Pilih Kelurahan</option>
                                            @foreach($villages as $row)
                                                <option value="{{$row->id}}" {{$data->village_id==$row->id?'selected':''}}>{{$row->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <!-- /.form-group -->
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-default">
                                        <i class="fa fa-save"></i> Update
                                    </button>
                                    <a href="{{url('kumkm')}}" class="btn btn-default">
                                        <i class="fa fa-reply"></i> Kembali
                                    </a>
                                </div>
                            </div>
                            <!-- /.col -->
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

