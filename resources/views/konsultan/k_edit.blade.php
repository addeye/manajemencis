<?php
/**
 * Created by Sublime
 * User: Dio Putra
 * Date: 29/01/2017
 * Time: 23:54
 */

?>

@extends('layouts.master')

@section('css')
        <!-- iCheck for checkboxes and radio inputs -->
<link rel="stylesheet" href="{{ url('admin-lte/plugins/iCheck/all.css') }}">
<!-- Select2 -->
<link rel="stylesheet" href="{{ url('admin-lte/plugins/select2/select2.min.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2-bootstrap-theme/0.1.0-beta.6/select2-bootstrap.css">

@endsection

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">{{$title}}</h3>
                </div>
                <!-- / box Header -->
                <div class="box-body">
                    <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#tab_1" data-toggle="tab">Edit</a></li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tab_1">
                                <form method="post" action="{{ url('konsultan/'.$data->id.'/update') }}" class="form-horizontal">
                                    <input type="hidden" name="user_id" value="{{ $data->user_id }}">
                                    <input type="hidden" name="_method" value="PUT">
                                    {{ csrf_field() }}
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-2 control-label">No Registrasi*</label>
                                        <div class="col-sm-5">
                                            <input type="text" name="no_registrasi" class="form-control" placeholder="Nomor Registrasi.." value="{{ $data->no_registrasi }}" required>
                                            <p class="text-danger">{{ $errors->first('nama_lengkap') }}</p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-2 control-label">Nama Lengkap*</label>
                                        <div class="col-sm-5">
                                            <input type="text" name="nama_lengkap" class="form-control" placeholder="Nama Lengkap.." value="{{ $data->nama_lengkap }}" required>
                                            <p class="text-danger">{{ $errors->first('nama_lengkap') }}</p>
                                        </div>
                                    </div>
                                    <!-- radio -->
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-2 control-label">Jenis Kelamin*</label>
                                        <div class="col-sm-5">
                                            <label>
                                                <input type="radio" name="jenis_kelamin" value="L" class="minimal" {{ $data->jenis_kelamin=='L'?'checked':'' }}>
                                                Laki - laki
                                            </label>
                                            &nbsp;
                                            &nbsp;
                                            <label>
                                                <input type="radio" value="P" name="jenis_kelamin" class="minimal" {{ $data->jenis_kelamin=='P'?'checked':'' }}>
                                                Perempuan
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-2 control-label">Provinsi*</label>
                                        <div class="col-sm-5">
                                            <select name="provinces_id" id="provinces" class="form-control select2" required>
                                                <option value="">Pilih Provinsi</option>
                                                @foreach($provinces as $row)
                                                    <option value="{{ $row->id }}" {{$data->provinces_id==$row->id?'selected':''}} >{{ $row->id }} {{ $row->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div id="ajaxRegencies">
                                        <div class="form-group">
                                            <label for="inputEmail3" class="col-sm-2 control-label">Kabupaten/Kota</label>
                                            <div class="col-md-5">
                                                <select class="form-control" name="regency_id">
                                                    <option value="">Pilih Kabupaten/Kota</option>
                                                    @foreach($regencies as $row)
                                                        <option value="{{ $row->id }}" {{$data->regency_id==$row->id?'selected':''}}>{{ $row->id }} {{ $row->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-2 control-label">Alamat</label>
                                        <div class="col-sm-5">
                                            <textarea class="form-control" name="alamat" rows="4">{{ $data->alamat }}</textarea>
                                            <p class="text-danger">{{ $errors->first('alamat') }}</p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-2 control-label">Kode Pos</label>
                                        <div class="col-sm-3">
                                            <input type="text" name="kode_pos" class="form-control" placeholder="Kode Pos.." value="{{ $data->kode_pos }}" required>
                                            <p class="text-danger">{{ $errors->first('kode_pos') }}</p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-2 control-label">Tempat/Tanggal Lahir</label>
                                        <div class="col-sm-3">
                                            <select name="tempat_lahir" class="form-control select2" style="width: 100%;">
                                                <option value="">Pilih Kota</option>
                                                @foreach($regencies as $row)
                                                    <option value="{{ $row->name }}" {{ $data->tempat_lahir==$row->name?'selected':'' }}>{{$row->name}}</option>
                                                @endforeach
                                            </select>
                                            <p class="text-danger">{{ $errors->first('tempat_lahir') }}</p>
                                        </div>
                                        <div class="col-sm-3">
                                            <input type="text" id="datemask" name="tanggal_lahir" value="{{ date('d/m/Y', strtotime($data->tanggal_lahir)) }}" class="form-control" placeholder="Tanggal Lahir..">
                                            <p class="text-danger">{{ $errors->first('tangal_lahir') }}</p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-2 control-label">Telepon</label>
                                        <div class="col-sm-3">
                                            <input type="number" name="telepon" class="form-control" placeholder="Telepon.." value="{{ $data->telepon }}" required>
                                            <p class="text-danger">{{ $errors->first('email') }}</p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
                                        <div class="col-sm-3">
                                            <input type="email" name="email" class="form-control" placeholder="Email Address.." value="{{ $data->email }}" required>
                                            <p class="text-danger">{{ $errors->first('email') }}</p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-2 control-label">Pendidikan</label>
                                        <div class="col-sm-3">
                                            <select class="form-control" name="pendidikan_id">
                                                <option value="">Pendidikan Terakhir</option>
                                                @foreach($pendidikan as $row)
                                                    <option value="{{ $row->id }}" {{$data->pendidikan_id==$row->id?'selected':''}} >{{ $row->name }}</option>
                                                @endforeach
                                            </select>
                                            <p class="text-danger">{{ $errors->first('email') }}</p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-2 control-label">Perguruan Tinggi Terakhir</label>
                                        <div class="col-sm-5">
                                            <input type="text" name="perguruan_terakhir" class="form-control" placeholder="Nama sekolah/perguruan tinggi terakhir.." value="{{$data->perguruan_terakhir}}" required>
                                            <p class="text-danger">{{ $errors->first('perguruan_terakhir') }}</p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-2 control-label">Jurusan</label>
                                        <div class="col-sm-3">
                                            <input type="text" name="jurusan" class="form-control" placeholder="Jurusan.." value="{{ $data->jurusan }}" required>
                                            <p class="text-danger">{{ $errors->first('jurusan') }}</p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-2 control-label">Bidang Keahlian</label>
                                        <div class="col-sm-5">
                                            <input type="text" name="bidang_keahlian" class="form-control" placeholder="Kompetensi/Bidang Keahlian Pendampingan.." value="{{$data->bidang_keahlian}}" required>
                                            <p class="text-danger">{{ $errors->first('<i class="fa fa-exclamation-circle"></i> bidang_keahlian') }}</p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-2 control-label">Pengalaman Pendampingan KUMKM</label>
                                        <div class="col-sm-5">
                                            <textarea class="form-control" name="pengalaman" placeholder="Pengalaman Dalam Pendampingan KUMKM" rows="4">{{$data->pengalaman}}</textarea>
                                            <p class="text-danger">{{ $errors->first('<i class="fa fa-exclamation-circle"></i> pengalaman') }}</p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-2 control-label">Sertifikat</label>
                                        <div class="col-sm-5">
                                            <input type="text" name="sertifikat" class="form-control" placeholder="Sertifikat yang dimiliki terkait dengan pendampingan KUMKM.." value="{{$data->pengalaman}}" required>
                                            <p class="text-danger"> {{ $errors->first('sertifikat') }}</p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-2 control-label">Asosiasi</label>
                                        <div class="col-sm-5">
                                            <input type="text" name="asosiasi" class="form-control" placeholder="Asosiasi pendampingan KUMKM yang diikuti.." value="{{ $data->asosiasi }}" required>
                                            <p class="text-danger">{{ $errors->first('sertifikat') }}</p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-2 control-label">Lembaga</label>
                                        <div class="col-sm-5">
                                            <select name="lembaga_id" class="form-control select2">
                                                <option value="">Pilih Lembaga</option>
                                                @foreach($lembaga as $row)
                                                    <option value="{{ $row->id }}" {{ $data->lembaga_id==$row->id?'selected':'' }}>{{ $row->name }}</option>
                                                @endforeach
                                            </select>
                                            <p class="text-danger">{{ $errors->first('lembaga_id') }}</p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-2 control-label">Bidang Layanan</label>
                                        <div class="col-sm-5">
                                            <select name="bidang_layanan_id" class="form-control">
                                                <option value="">Pilih Bidang Layanan</option>
                                                @foreach($bidanglayanan as $row)
                                                    <option value="{{ $row->id }}" {{$data->bidang_layanan_id==$row->id?'selected':''}} >{{ $row->name }}</option>
                                                @endforeach
                                            </select>
                                            <p class="text-danger">{{ $errors->first('lembaga_id') }}</p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-offset-2 col-sm-10">
                                            <button type="submit" class="btn btn-default">Simpan</button>
                                            <a href="{{ url('konsultan') }}" class="btn btn-default">Kembali</a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- /.tab-content -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <input type="hidden" id="urlregencies" value="{{ url('common/regencies') }}">
    @endsection

    @section('script')
            <!-- iCheck 1.0.1 -->
    <script src="{{ url('admin-lte/plugins/iCheck/icheck.min.js') }}"></script>
    <!-- Select2 -->
    <script src="{{ url('admin-lte/plugins/select2/select2.full.min.js') }}"></script>
    <!-- InputMask -->
    <script src="{{ url('admin-lte/plugins/input-mask/jquery.inputmask.js') }}"></script>
    <script src="{{ url('admin-lte/plugins/input-mask/jquery.inputmask.date.extensions.js') }}"></script>
    <script src="{{ url('admin-lte/plugins/input-mask/jquery.inputmask.extensions.js') }}"></script>

    <script>
        $(function(){
            //Initialize Select2 Elements
            $(".select2").select2({
                theme: "bootstrap"
            });

            //Datemask dd/mm/yyyy
            $("#datemask").inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/yyyy"});

            //iCheck for checkbox and radio inputs
            $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
                checkboxClass: 'icheckbox_minimal-blue',
                radioClass: 'iradio_minimal-blue'
            });
            //Red color scheme for iCheck
            $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
                checkboxClass: 'icheckbox_minimal-red',
                radioClass: 'iradio_minimal-red'
            });
            //Flat red color scheme for iCheck
            $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
                checkboxClass: 'icheckbox_flat-green',
                radioClass: 'iradio_flat-green'
            });

        });
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
                    })
        });
    </script>
@endsection