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
                </div>
                <!-- / box Header -->
                <div class="box-body">
                    <form method="post" action="{{ url('k/kegiatan/'.$data->id.'/update') }}" class="form-horizontal" enctype="multipart/form-data">
                        <input type="hidden" name="_method" value="PUT">
                        {{ csrf_field() }}
                        <div class="form-group {{ $errors->has('tanggal_mulai') ? ' has-error' : '' }} {{ $errors->has('tanggal_selesai') ? ' has-error' : '' }}">
                            <label for="inputEmail3" class="col-sm-2 control-label">Tanggal Mulai/Selesai</label>
                            <div class="col-sm-3">
                                <div class="input-group date">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" name="tanggal_mulai" class="form-control pull-right datepicker-realformat" value="{{date('d-m-Y',strtotime($data->tanggal_mulai))}}">
                                    <span class="help-block">
                                      <strong>{{ $errors->first('tanggal_mulai') }}</strong>
                                    </span>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="input-group date">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" name="tanggal_selesai" value="{{date('d-m-Y',strtotime($data->tanggal_selesai))}}" class="form-control pull-right datepicker-realformat">
                                    <span class="help-block">
                                      <strong>{{ $errors->first('tanggal_selesai') }}</strong>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('bidang_layanan_id') ? ' has-error' : '' }}">
                            <label for="inputEmail3" class="col-sm-2 control-label">Bidang Layanan</label>
                            <div class="col-sm-5">
                                <select name="bidang_layanan_id[]" class="form-control select2" multiple="true" required>
                                    <option value="">Pilih Bidang Layanan</option>
                                    @foreach ($bidang_layanan as $row)
                                        <option value="{{$row->id}}" {{in_array($row->id,$data->kegiatan_konsultan_bidang->pluck('bidang_layanan_id')->toArray())?'selected':''}}>{{$row->name}}</option>
                                    @endforeach
                                </select>
                                <span class="help-block">
                                      <strong>{{ $errors->first('bidang_layanan_id') }}</strong>
                                </span>
                            </div>
                            <div class="col-sm-5">
                                <p>Bidang layananan yang terlibat</p>
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('judul_kegiatan') ? ' has-error' : '' }}">
                            <label for="inputEmail3" class="col-sm-2 control-label">Judul Kegiatan</label>
                            <div class="col-sm-5">
                                <input type="text" name="judul_kegiatan" class="form-control" placeholder="Judul kegiatan.." value="{{ $data->judul_kegiatan }}" required>
                            </div>
                            <span class="help-block">
                                      <strong>{{ $errors->first('judul_kegiatan') }}</strong>
                                </span>
                        </div>
                        <div class="form-group {{ $errors->has('bidang_usaha_id') ? ' has-error' : '' }}">
                            <label for="inputEmail3" class="col-sm-2 control-label">Bidang Usaha</label>
                            <div class="col-sm-5">
                                <select class="form-control" name="bidang_usaha_id" required>
                                    <option value="">Pilih</option>
                                    @foreach($bidang_usaha as $row)
                                        <option value="{{$row->id}}" {{$data->bidang_usaha_id==$row->id?'selected':''}}>{{$row->name}}</option>
                                    @endforeach
                                </select>
                                <span class="help-block">
                                      <strong>{{ $errors->first('bidang_usaha_id') }}</strong>
                                </span>
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('lokasi_kegiatan') ? ' has-error' : '' }}">
                            <label for="inputEmail3" class="col-sm-2 control-label">Lokasi Kegiatan</label>
                            <div class="col-sm-5">
                                <input type="text" name="lokasi_kegiatan" class="form-control" placeholder="Lokasi kegiatan.." value="{{ $data->lokasi_kegiatan }}" required>
                                <span class="help-block">
                                      <strong>{{ $errors->first('lokasi_kegiatan') }}</strong>
                                </span>
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('jumlah_peserta') ? ' has-error' : '' }}">
                            <label for="inputEmail3" class="col-sm-2 control-label">Jumlah Penerima Manfaat</label>
                            <div class="col-sm-2">
                                <input type="number" name="jumlah_peserta" class="form-control" placeholder="Jumlah.." value="{{ $data->jumlah_peserta }}" required>
                                <span class="help-block">
                                      <strong>{{ $errors->first('jumlah_peserta') }}</strong>
                                </span>
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('output') ? ' has-error' : '' }} {{ $errors->has('ket_output') ? ' has-error' : '' }}">
                            <label for="inputEmail3" class="col-sm-2 control-label">Output</label>
                            <div class="col-sm-2">
                                <input type="number" name="output" class="form-control" placeholder="Jumlah.." value="{{ $data->output }}" required>
                                <span class="help-block">
                                      <strong>{{ $errors->first('output') }}</strong>
                                </span>
                            </div>
                            <div class="col-sm-4">
                                <input type="text" name="ket_output" class="form-control" placeholder="Keterangan Output.." value="{{ $data->ket_output }}" required>
                                <span class="help-block">
                                      <strong>{{ $errors->first('ket_output') }}</strong>
                                </span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Sumber Daya</label>
                            <div class="col-sm-5">
                                <input type="text" name="sumber_daya" class="form-control" value="{{$data->sumber_daya}}" placeholder="Semua sumber daya yang mendukung terlaksana kegiatan.." required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Mitra Kerja</label>
                            <div class="col-sm-5">
                                <textarea class="form-control" name="mitra_kegiatan" rows="4" placeholder="Mitra Kerja.." required>{{$data->mitra_kegiatan}}</textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Rencana Tindak Lanjut</label>
                            <div class="col-sm-5">
                                <textarea class="form-control" name="rencana_tindak_lanjut" rows="4" placeholder="Hal-hal yang dilakukan setelah kegiatan.." required>{{$data->rencana_tindak_lanjut}}</textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Unggah Gambar</label>
                            <div class="col-sm-3">
                                <input type="file" name="image">
                                <p>Ukuran File Gambar Max 1 MB </p>
                                <p class="text-danger">{{ $errors->first('image') }}</p>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Gambar</label>
                            <div class="col-sm-3">
                                <img src="{{ asset('kegiatan/'.$data->image) }}" style="width: 200px;">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-default">Simpan</button>
                                <a href="{{ url('k/kegiatan') }}" class="btn btn-default">Kembali</a>
                            </div>
                        </div>
                    </form>
                </div>
                <div id="loading" class="overlay" style="display: none;">
                    <i class="fa fa-refresh fa-spin"></i>
                </div>
            </div>
        </div>
    </div>
    <input type="hidden" id="urldetailproker" value="{{ url('common/detail/proker') }}">
    <input type="hidden" id="urldetaildproker" value="{{ url('common/detail/kegiatan') }}">
@endsection

@section('script')
    <script>
        urldetail = $('#urldetailproker').val();
        $('#proker_id').change(function(){
            $.ajax({
                beforeSend:function(){
                    $("#loading").show();
                },
                url: urldetail+'/'+this.value,
                type : 'GET',
                cache : false,
                dataType : 'html'
            })
                    .success(function(response){
                        $('#ajaxDetailProker').html(response);
                        $("#loading").hide();
                    })
        });

        function detailKegiatan(id)
        {
            urldetailkegiatan = $('#urldetaildproker').val();
            $.ajax({
                beforeSend:function(){
                    $("#loading").show();
                },
                url : urldetailkegiatan+'/'+id,
                type : 'GET',
                cache : false,
                dataType : 'html'
            })
                    .success(function(response){
                        $('#ajaxDetailKegiatanProker').html(response);
                        $("#loading").hide();
                    });
        }
    </script>
@endsection