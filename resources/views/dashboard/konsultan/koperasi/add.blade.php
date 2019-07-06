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
                    <h3 class="box-title">Tambah Koperasi</h3>
                </div>
                <!-- / box Header -->
                <div class="box-body">
                    <form method="post" action="{{ url('koperasi') }}" class="form-horizontal">
                        {{ csrf_field() }}
                        <div class="form-group {{$errors->has('tanggal_keadaan')?'has-error':''}}">
                            <label class="col-sm-2 control-label">Tanggal Keadaan</label>
                            <div class="col-sm-5">
                                <div class="input-group">
                                  <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                  </div>
                                  <input type="text" name="tanggal_keadaan" class="form-control" placeholder="Tanggal Status Keadaan" value="{{old('tanggal_keadaan')?old('tanggal_keadaan'):date('d-m-Y')}}" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask>
                                </div>
                                <span class="help-block">{{$errors->first('tanggal_keadaan')}}</span>
                            </div>
                            <div class="col-sm-5">
                                <span class="help-block">Tanggal data terbaru koperasi</span>
                            </div>
                        </div>
                        <div class="form-group {{$errors->has('nama_koperasi')?'has-error':''}}">
                            <label class="col-sm-2 control-label">Nama Koperasi</label>
                            <div class="col-sm-5">
                                <input type="text" name="nama_koperasi" class="form-control" placeholder="Isi dengan nama Koperasi" value="{{old('nama_koperasi')}}">
                                <span class="help-block">{{$errors->first('nama_koperasi')}}</span>
                            </div>
                        </div>
                        <div class="form-group {{$errors->has('regency_id')?'has-error':''}}">
                            <label class="col-sm-2 control-label">Kabupaten Kota</label>
                            <div class="col-sm-5">
                                <select name="regency_id" class="form-control select2">
                                <option value="">Pilih Kabupaten Kota</option>
                                @foreach($regencies as $row)
                                    <option value="{{$row->id}}" {{old('regency_id')==$row->id?'selected':''}}>{{$row->name}}</option>
                                @endforeach
                            </select>
                            <span class="help-block">{{$errors->first('regency_id')}}</span>
                            </div>
                            <div class="col-sm-5">
                                <span class="help-block">Pilih kabupaten kota lokasi koperasi</span>
                            </div>
                        </div>
                        <div class="form-group {{$errors->has('alamat')?'has-error':''}}">
                            <label class="col-sm-2 control-label">Alamat</label>
                            <div class="col-sm-5">
                                <textarea name="alamat" placeholder="Alamat koperasi" class="form-control">{{old('alamat')}}</textarea>
                                <span class="help-block">{{$errors->first('alamat')}}</span>
                            </div>
                            <div class="col-sm-5">
                                <span class="help-block">Alamat lengkap koperasi</span>
                            </div>
                        </div>
                        <div class="form-group {{$errors->has('nomor_badan_hukum')?'has-error':''}}">
                            <label class="col-sm-2 control-label">Nomor Badan Hukum</label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" name="nomor_badan_hukum" placeholder="Nomor Badan Hukum " value="{{old('nomor_badan_hukum')}}">
                                <span class="help-block">{{$errors->first('nomor_badan_hukum')}}</span>
                            </div>
                        </div>
                        <div class="form-group {{$errors->has('tgl_badan_hukum')?'has-error':''}}">
                            <label class="col-sm-2 control-label">Tanggal Badan Hukum</label>
                            <div class="col-sm-5">
                                <div class="input-group">
                                  <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                  </div>
                                <input type="text" class="form-control" name="tgl_badan_hukum" placeholder="tanggal DD-MM-YYYY.." value="{{old('tgl_badan_hukum')}}" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask>
                                </div>
                                <span class="help-block">{{$errors->first('tgl_badan_hukum')}}</span>
                            </div>
                        </div>
                        <div class="form-group {{$errors->has('jenis_koperasi')?'has-error':''}}">
                            <label class="col-sm-2 control-label">Jenis Koperasi</label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" name="jenis_koperasi" placeholder="Jenis Koperasi" value="{{old('jenis_koperasi')}}">
                                <span class="help-block">{{$errors->first('jenis_koperasi')}}</span>
                            </div>
                            <div class="col-sm-5">
                                <span class="help-block">Jenis Koperasi</span>
                            </div>
                        </div>

                        <div class="form-group {{$errors->has('tgl_rat_tahun_buku')?'has-error':''}}">
                            <label class="col-sm-2 control-label">Tanggal RAT</label>
                            <div class="col-sm-5">
                                <div class="input-group">
                                  <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                  </div>
                                <input type="text" class="form-control" name="tgl_rat_tahun_buku" placeholder="Tanggal Format DD-MM-YYYY" value="{{old('tgl_rat_tahun_buku')}}" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask>
                                </div>
                                <span class="help-block">{{$errors->first('tgl_rat_tahun_buku')}}</span>
                            </div>
                            <div class="col-sm-5">
                                <span class="help-block">Tanggal RAT Terkahir</span>
                            </div>
                        </div>

                        <div class="form-group {{$errors->has('jml_anggota')?'has-error':''}}">
                            <label class="col-sm-2 control-label">Jumlah Anggota</label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" name="jml_anggota" placeholder="Jumlah Anggota" value="{{old('jml_anggota')}}">
                                <span class="help-block">{{$errors->first('jml_anggota')}}</span>
                            </div>
                            <div class="col-sm-5">
                                <span class="help-block">Jumlah Anggota yang bergabung (format angka)</span>
                            </div>
                        </div>

                        <div class="form-group {{$errors->has('jml_karyawan')?'has-error':''}}">
                            <label class="col-sm-2 control-label">Jumlah Karyawan</label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" name="jml_karyawan" placeholder="Jumlah Karyawan" value="{{old('jml_karyawan')}}">
                                <span class="help-block">{{$errors->first('jml_karyawan')}}</span>
                            </div>
                            <div class="col-sm-5">
                                <span class="help-block">Jumlah Karyawan yang dimiliki (format angka)</span>
                            </div>
                        </div>

                        <div class="form-group {{$errors->has('jml_asset')?'has-error':''}}">
                            <label class="col-sm-2 control-label">Jumlah Asset</label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" name="jml_asset" placeholder="Jumlah Asset" value="{{old('jml_asset')}}">
                                <span class="help-block">{{$errors->first('jml_asset')}}</span>
                            </div>
                            <div class="col-sm-5">
                                <span class="help-block">Jumlah Asset yang dimiliki (format angka)</span>
                            </div>
                        </div>

                        <div class="form-group {{$errors->has('jml_modal_sendiri')?'has-error':''}}">
                            <label class="col-sm-2 control-label">Jumlah Modal Sendiri</label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" name="jml_modal_sendiri" placeholder="Jumlah Modal Sendiri" value="{{old('jml_modal_sendiri')}}">
                                <span class="help-block">{{$errors->first('jml_modal_sendiri')}}</span>
                            </div>
                            <div class="col-sm-5">
                                <span class="help-block">Jumlah Modal Sendiri yang dimiliki (format angka)</span>
                            </div>
                        </div>

                        <div class="form-group {{$errors->has('jml_modal_luar')?'has-error':''}}">
                            <label class="col-sm-2 control-label">Jumlah Modal Luar</label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" name="jml_modal_luar" placeholder="Jumlah Modal Luar" value="{{old('jml_modal_luar')}}">
                                <span class="help-block">{{$errors->first('jml_modal_luar')}}</span>
                            </div>
                            <div class="col-sm-5">
                                <span class="help-block">Jumlah Modal Dari Luar yang dimiliki (format angka)</span>
                            </div>
                        </div>

                        <div class="form-group {{$errors->has('volume_usaha')?'has-error':''}}">
                            <label class="col-sm-2 control-label">Omset</label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" name="volume_usaha" placeholder="Jumlah Volume Usaha" value="{{old('volume_usaha')}}">
                                <span class="help-block">{{$errors->first('volume_usaha')}}</span>
                            </div>
                            <div class="col-sm-5">
                                <span class="help-block">Omset sekarang (format angka)</span>
                            </div>
                        </div>

                        <div class="form-group {{$errors->has('sisa_hasil')?'has-error':''}}">
                            <label class="col-sm-2 control-label">Sisa Hasil Usaha</label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" name="sisa_hasil" placeholder="Jumlah Sisa Hasil Usaha" value="{{old('sisa_hasil')}}">
                                <span class="help-block">{{$errors->first('sisa_hasil')}}</span>
                            </div>
                            <div class="col-sm-5">
                                <span class="help-block">Sisa Hasil Usaha sekarang (format angka)</span>
                            </div>
                        </div>


                        <div class="form-group {{$errors->has('kegiatan_usaha')?'has-error':''}}">
                            <label class="col-sm-2 control-label">Kegiatan Usaha</label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" name="kegiatan_usaha" placeholder="Kegiatan Usaha Koperasi" value="{{old('kegiatan_usaha')}}">
                                <span class="help-block">{{$errors->first('kegiatan_usaha')}}</span>
                            </div>
                            <div class="col-sm-5">
                                <span class="help-block">Sebutkan Prioritas Kegiatan Usaha Koperasi (Max 255 Karakter)</span>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-default">Simpan</button>
                                <a href="{{ url('koperasi') }}" class="btn btn-default">Kembali</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
<!-- InputMask -->
<script src="{{url('admin-lte/plugins/input-mask/jquery.inputmask.js')}}"></script>
<script src="{{url('admin-lte/plugins/input-mask/jquery.inputmask.date.extensions.js')}}"></script>
<script src="{{url('admin-lte/plugins/input-mask/jquery.inputmask.extensions.js')}}"></script>
<script type="text/javascript">
    $('#proker_id').change(function(){
        var url = '{{url('proker_id/')}}';
        var id = this.value;
        // alert(id);
        $.get(url+'/'+id, function(response){
            console.log(response);
           $('input[name=kegiatan]').val(response.program);
           $('textarea[name=tujuan]').val(response.tujuan);
           $('textarea[name=sasaran]').val(response.sasaran);
           $('input[name=jumlah_sasaran]').val(response.jumlah_sasaran);
           $('input[name=indikator]').val(response.indikator);
           $('textarea[name=output]').val(response.output);
        });
    });
</script>
@endsection