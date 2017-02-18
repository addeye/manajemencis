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
                    <form method="post" action="{{ url('k/kegiatan/'.$data->id.'/update') }}" class="form-horizontal">
                        <input type="hidden" name="_method" value="PUT">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Tanggal Mulai</label>
                            <div class="col-sm-3">
                                <input type="date" name="tanggal_mulai" class="form-control" placeholder="Tanggal mulai.." value="{{ $data->tanggal_mulai }}" required>
                            </div>
                            <div class="col-sm-3">
                                <input type="date" name="tanggal_selesai" class="form-control" placeholder="Tanggal selesai.." value="{{ $data->tanggal_selesai }}" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Program Kerja</label>
                            <div class="col-sm-5">
                                <select class="form-control" id="proker_id" name="proker_id" required>
                                    <option value="">Pilih</option>
                                    @foreach($proker as $row)
                                        <option value="{{$row->id}}" {{$data->proker_id==$row->id?'selected':''}} >{{$row->tahun_kegiatan}} {{ $row->program }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div id="ajaxDetailProker"></div>
                        <div class="form-group">
                            <div class="col-sm-2"></div>
                            <div class="col-sm-10">
                                <div id="ajaxDetailKegiatanProker">
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Jenis Kegiatan :</label>
                                        <div class="col-sm-10">
                                            <p class="form-control-static">{{$dproker->jenis_kegiatan}}</p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Indikator Kinerja Utama :</label>
                                        <div class="col-sm-10">
                                            <p class="form-control-static">{{$dproker->jenis_layanans->name}}</p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Target Output:</label>
                                        <div class="col-sm-10">
                                            <p class="form-control-static">{{$dproker->output}} - {{$dproker->ket_output}}</p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Jumlah Penerima:</label>
                                        <div class="col-sm-10">
                                            <p class="form-control-static">{{$dproker->jml_penerima}}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Bidang Usaha</label>
                            <div class="col-sm-5">
                                <select class="form-control" name="bidang_usaha_id" required>
                                    <option value="">Pilih</option>
                                    @foreach($bidang_usaha as $row)
                                        <option value="{{$row->id}}" {{$data->bidang_usaha_id==$row->id?'selected':''}}>{{$row->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Lokasi Kegiatan</label>
                            <div class="col-sm-5">
                                <input type="text" name="lokasi_kegiatan" class="form-control" placeholder="Lokasi kegiatan.." value="{{ $data->lokasi_kegiatan }}" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Jumlah Peserta</label>
                            <div class="col-sm-2">
                                <input type="text" name="jumlah_peserta" class="form-control" placeholder="Jumlah.." value="{{ $data->jumlah_peserta }}" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Output</label>
                            <div class="col-sm-2">
                                <input type="text" name="output" class="form-control" placeholder="Jumlah.." value="{{ $data->output }}" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Sumber Daya</label>
                            <div class="col-sm-5">
                                <input type="text" name="sumber_daya" class="form-control" placeholder="Sumber daya.." value="{{ $data->sumber_daya }}" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Mitra Kegiatan</label>
                            <div class="col-sm-5">
                                <input type="text" name="sumber_daya" class="form-control" placeholder="Sumber daya.." value="{{ $data->mitra_kegiatan }}" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Mitra Kegiatan</label>
                            <div class="col-sm-5">
                                <textarea class="form-control" name="rencana_tindak_lanjut">{{$data->rencana_tindak_lanjut}}</textarea>
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
    <input type="hidden" id="urldetailproker" value="{{ url('common/detail/proker') }}">
    <input type="hidden" id="urldetaildproker" value="{{ url('common/detail/kegiatan') }}">
@endsection

@section('script')
    <script>
        urldetail = $('#urldetailproker').val();
        $('#proker_id').change(function(){
            $.ajax({
                url: urldetail+'/'+this.value,
                type : 'GET',
                cache : false,
                dataType : 'html'
            })
                    .success(function(response){
                        $('#ajaxDetailProker').html(response);
                    })
        });

        function detailKegiatan(id)
        {
            urldetailkegiatan = $('#urldetaildproker').val();
            $.ajax({
                url : urldetailkegiatan+'/'+id,
                type : 'GET',
                cache : false,
                dataType : 'html'
            })
                    .success(function(response){
                        $('#ajaxDetailKegiatanProker').html(response);
                    });
        }
    </script>
@endsection