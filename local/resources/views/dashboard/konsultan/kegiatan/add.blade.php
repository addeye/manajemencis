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
                    <form method="post" action="{{ url('k/kegiatan') }}" class="form-horizontal" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group {{ $errors->has('tanggal_mulai') ? ' has-error' : '' }} {{ $errors->has('tanggal_selesai') ? ' has-error' : '' }}">
                            <label for="inputEmail3" class="col-sm-2 control-label">Tanggal Mulai/Selesai</label>
                            <div class="col-sm-3">
                                <div class="input-group date">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" name="tanggal_mulai" class="form-control pull-right datepicker-realformat" value="{{old('tanggal_mulai')}}">
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
                                    <input type="text" name="tanggal_selesai" value="{{old('tanggal_selesai')}}" class="form-control pull-right datepicker-realformat">
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
                                        <option value="{{$row->id}}" @if (old("bidang_layanan_id")){{ (in_array($row->id, old("bidang_layanan_id")) ? "selected":"") }}@endif >{{$row->name}}</option>
                                    @endforeach
                                </select>
                                <p>Dropdown, bisa lebih dari satu Bidang Layanan</p>
                                <span class="help-block">
                                      <strong>{{ $errors->first('bidang_layanan_id') }}</strong>
                                </span>
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('judul_kegiatan') ? ' has-error' : '' }}">
                            <label for="inputEmail3" class="col-sm-2 control-label">Judul Kegiatan</label>
                            <div class="col-sm-5">
                                <input type="text" name="judul_kegiatan" value="{{old('judul_kegiatan')}}" class="form-control" placeholder="Judul kegiatan.." required>
                                <span class="help-block">
                                      <strong>{{ $errors->first('judul_kegiatan') }}</strong>
                                </span>
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('bidang_usaha_id') ? ' has-error' : '' }}">
                            <label for="inputEmail3" class="col-sm-2 control-label">Bidang Usaha</label>
                            <div class="col-sm-5">
                                <select class="form-control" name="bidang_usaha_id" required>
                                    <option value="">Pilih</option>
                                    @foreach($bidang_usaha as $row)
                                        <option value="{{$row->id}}" {{old('bidang_usaha_id')==$row->id?'selected':''}} >{{$row->name}}</option>
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
                                <input type="text" name="lokasi_kegiatan"  value="{{old('lokasi_kegiatan')}}" class="form-control" placeholder="Lokasi kegiatan.." required>
                                <span class="help-block">
                                      <strong>{{ $errors->first('lokasi_kegiatan') }}</strong>
                                </span>
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('jumlah_peserta') ? ' has-error' : '' }}">
                            <label for="inputEmail3" class="col-sm-2 control-label">Jumlah Penerima Manfaat</label>
                            <div class="col-sm-2">
                                <input type="number" name="jumlah_peserta" value="{{old('jumlah_peserta')}}" class="form-control" placeholder="Jumlah.." required>
                                <span class="help-block">
                                      <strong>{{ $errors->first('jumlah_peserta') }}</strong>
                                </span>
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('output') ? ' has-error' : '' }} {{ $errors->has('ket_output') ? ' has-error' : '' }}">
                            <label for="inputEmail3" class="col-sm-2 control-label">Output</label>
                            <div class="col-sm-2">
                                <input type="number" name="output" value="{{old('output')}}" class="form-control" placeholder="Jumlah.." required>
                                <span class="help-block">
                                      <strong>{{ $errors->first('output') }}</strong>
                                </span>
                            </div>
                            <div class="col-sm-4">
                                <input type="text" name="ket_output" value="{{old('ket_output')}}" class="form-control" placeholder="Keterangan Output.." required>
                                <span class="help-block">
                                      <strong>{{ $errors->first('ket_output') }}</strong>
                                </span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Sumber Daya</label>
                            <div class="col-sm-5">
                                <input type="text" name="sumber_daya" value="{{old('sumber_daya')}}" class="form-control" placeholder="Semua sumber daya yang mendukung terlaksana kegiatan.." required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Mitra Kerja</label>
                            <div class="col-sm-5">
                                <textarea class="form-control" name="mitra_kegiatan" rows="4" placeholder="Mitra Kerja.." required>{{old('mitra_kegiatan')}}</textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Rencana Tindak Lanjut</label>
                            <div class="col-sm-5">
                                <textarea class="form-control" name="rencana_tindak_lanjut" rows="4" placeholder="Hal-hal yang dilakukan setelah kegiatan.." required>{{old('rencana_tindak_lanjut')}}</textarea>
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
@endsection

@section('script')
<script type="text/javascript">
    $('#detail_proker_id').change(function(){
        var url = '{{url('detail-proker/')}}';
        var id = this.value;
        // alert(id);
        $.get(url+'/'+id, function(response){
            console.log(response);
           $('input[name=judul_kegiatan]').val(response.jenis_kegiatan);
           $('input[name=jumlah_peserta]').val(response.jml_penerima);
           $('input[name=ket_output]').val(response.ket_output);
           $('textarea[name=mitra_kegiatan]').val(response.mitra_kerja);
        });
    });
</script>
@endsection