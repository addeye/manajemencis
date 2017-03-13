<?php
/**
 * Created by PhpStorm.
 * User: deyelovi
 * Date: 14/03/2017
 * Time: 2:37
 */
?>

@extends('layouts.beranda.master')

@section('content')
    <div class="row">
        <div class="col-md-12">
            @include('layouts.alert')
                    <!-- Box Comment -->
            <div class="box box-widget">
                <div class="box-header with-border">
                    <div class="user-block">
                        <img class="img-circle" src="{{url('images/default.png')}}" alt="User Image">
                        <span class="username"><a href="#">{{$data->nama_lengkap}}</a></span>
                        <span class="description">{{$data->dibuat}}</span>
                    </div>
                    <!-- /.user-block -->
                    <div class="box-tools">
                        <a href="{{url('informasi')}}" class="btn btn-box-tool" data-toggle="tooltip" title="" data-original-title="Kembali">
                            <i class="fa fa-circle-o"></i> Kembali</a>
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <!-- post text -->
                    <h3 style="text-transform: uppercase">{{$data->jenis}}</h3>
                    {{$data->keterangan}}
                    <hr>
                    <p>Email : {{$data->email}}</p>
                    <p>No Telp : {{$data->telp}}</p>
                    <p>Perusahaan : {{$data->perusahaan}}</p>
                    <p>Nama Produk : {{$data->nama_produk}}</p>
                    <p>Jumlah Produk / satuan : {{$data->jumlah_produk}} / {{$data->satuan_produk}}</p>
                    <p>Harga Produk : Rp. {{number_format($data->harga_produk),'2','.',','}}</p>
                    <p>Spesifikasi : {{$data->spesifikasi}}</p>
                </div>
                <!-- /.box-body -->
                @if(count($data->comment))
                    <div class="box-footer box-comments">
                        @foreach($data->comment as $row)
                        <div class="box-comment">
                            <!-- User image -->
                            <img class="img-circle img-sm" src="{{url('images/default.png')}}" alt="User Image">

                            <div class="comment-text">
                      <span class="username">
                        {{$row->nama}} - {{$row->email}}
                          <span class="text-muted pull-right">{{$data->dibuat}}</span>
                      </span><!-- /.username -->
                                {{$row->komentar}}
                            </div>
                            <!-- /.comment-text -->
                        </div>
                        <!-- /.box-comment -->
                            @endforeach
                    </div>
                    @endif
                            <!-- /.box-footer -->
                    <div class="box-footer">
                        @if(!$data->lembaga_id)
                            <form >
                                <input type="hidden" name="_method" value="PUT">
                                {{ csrf_field() }}
                                <img class="img-responsive img-circle img-sm" src="{{url('images/default.png')}}" alt="Alt Text">
                                <div class="img-push">
                                    <div class="input-group {{$errors->has('respon')?'has-error':''}}">
                                        <input type="text" name="komentar" placeholder="Ketik komentar anda disini..." class="form-control">
                                      <span class="input-group-btn">
                                        <button type="submit" class="btn btn-primary btn-flat">Kirim</button>
                                      </span>
                                    </div>
                                    <span class="help-block">{{$errors->first('respon')}}</span>
                                </div>
                            </form>
                        @endif
                    </div>
                    <!-- /.box-footer -->
            </div>
            <!-- /.box -->
        </div>
    </div>
@endsection


