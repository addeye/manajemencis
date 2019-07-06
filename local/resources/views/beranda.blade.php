<?php
/**
 * Created by PhpStorm.
 * User: deyelovi
 * Date: 02/03/2017
 * Time: 10:20
 */
?>
@extends('layouts.beranda.master')

@section('banner')
    @include('banner',['banner'=>$banner])
    @endsection

@section('css')
    <style>
        /*Info*/
        .item .info {
            margin-left: 55px;
        }
    </style>
    @endsection

@section('content')
    <div class="row">
        <div class="col-lg-2 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-aqua">
                <div class="inner">
                    <h3>{{$jml_koperasi}}</h3>
                    <p>Data Koperasi</p>
                </div>
                <div class="icon">
                    <i class="ion ion-bag"></i>
                </div>
                {{-- <a href="{{url('sentra_umkm')}}" class="small-box-footer">Detil UMKM <i class="fa fa-arrow-circle-right"></i></a> --}}
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-2 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-green">
                <div class="inner">
                    <h3>{{$jml_kumkm}}</h3>
                    <p>Data UMKM</p>
                </div>
                <div class="icon">
                    <i class="ion ion-cube"></i>
                </div>
                {{-- <a href="#" class="small-box-footer">Detil Produk <i class="fa fa-arrow-circle-right"></i></a> --}}
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-2 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-yellow">
                <div class="inner">
                    <h3>{{$koperasi_dampingan}}</h3>

                    <p>Koperasi Dampingan</p>
                </div>
                <div class="icon">
                    <i class="ion ion-person-add"></i>
                </div>
                {{-- <a href="{{url('kegiatan')}}" class="small-box-footer">Detil Kegiatan <i class="fa fa-arrow-circle-right"></i></a> --}}
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-2 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-red">
                <div class="inner">
                    <h3>{{$umkm_dampingan}}</h3>
                    <p>UMKM Dampingan</p>
                </div>
                <div class="icon">
                    <i class="ion ion-person-add"></i>
                </div>
                {{-- <a href="{{url('penerima')}}" class="small-box-footer">Detil Penerima <i class="fa fa-arrow-circle-right"></i></a> --}}
            </div>
        </div>
        <div class="col-lg-2 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-purple">
                <div class="inner">
                    <h3>{{$program}}</h3>
                    <p>Rencana Aksi</p>
                </div>
                <div class="icon">
                    <i class="ion ion-home"></i>
                </div>
                {{-- <a href="{{url('penerima')}}" class="small-box-footer">Detil Penerima <i class="fa fa-arrow-circle-right"></i></a> --}}
            </div>
        </div>
        <div class="col-lg-2 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-blue">
                <div class="inner">
                    <h3>{{$pelaksanaan}}</h3>
                    <p>Pelaksanaan</p>
                </div>
                <div class="icon">
                    <i class="ion ion-bookmark"></i>
                </div>
                {{-- <a href="{{url('penerima')}}" class="small-box-footer">Detil Penerima <i class="fa fa-arrow-circle-right"></i></a> --}}
            </div>
        </div>
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="box box-success">
                <div class="box-header">
                    <h3 class="box-title"><i class="fa fa-bookmark"></i> Pendampingan</h3>
                </div>
                <div class="box-body">
                    <div class="no-padding">
                      <ul class="nav nav-stacked">
                        @foreach ($bidanglayanan as $row)
                        <li><a href="javascript:void">{{$row->name}} <span class="pull-right badge bg-blue">0</span></a></li>
                        @endforeach
                      </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-md-3 col-sm-6 col-xs-6">
            <a target="_blank" href="http://cis-nasional.id/">
                <div class="text-center">
                    <i class="fa fa-bank fa-5x"></i>
                    <div class="caption">
                        <h4>Seputar PLUT</h4>
                    </div>
                </div>
            </a>
            <!-- /.info-box -->
        </div>
        <div class="col-md-3 col-sm-6 col-xs-6">
            <a href="{{url('kontak')}}">
                <div class="text-center">
                    <i class="fa fa-phone-square fa-5x"></i>
                    <div class="caption">
                        <h4>Kontak</h4>
                    </div>
                </div>
            </a>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-6">
            <a href="{{ url('info-konsultan') }}">
                <div class="text-center">
                    <i class="fa fa-users fa-5x"></i>
                    <div class="caption">
                        <h4>Konsultan</h4>
                    </div>
                </div>
            </a>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-6">
            <a href="{{ url('info-plut') }}">
                <div class="text-center">
                    <i class="fa fa-globe fa-5x"></i>
                    <div class="caption">
                        <h4>Daftar Plut</h4>
                    </div>
                </div>
            </a>
            <!-- /.info-box -->
        </div>
        <div class="col-xs-12">
            <!-- Chat box -->
            <div class="box box-success">
                <div class="box-header">
                    <i class="fa fa-info-circle"></i>
                    <h3 class="box-title">Info Terkini</h3>
                </div>
                <div class="box-body chat scroll" id="chat-box">
                    @foreach($pengumuman as $row)
                    <!-- chat item -->
                    <div class="item">
                        <img src="{{url('images/'.$row->user->path)}}" alt="user image" class="online">
                        <p class="message">
                            <a href="#" class="name">
                                <small class="text-muted pull-right"><i class="fa fa-clock-o"></i> {{$row->dibuat}}</small>
                                {{$row->user->name}} - {{$row->judul}}
                            </a>
                        </p>
                        <div class="info">{!! $row->keterangan !!}</div>
                        <!-- /.attachment -->
                    </div>
                    <!-- /.item -->
                    @endforeach
                </div>
                <!-- /.chat -->
            </div>
            <!-- /.box (chat box) -->
        </div>
    </div>
    @endsection

@section('script')
    <script>
        $(function(){
            $('.scroll').slimScroll({
                height: '250px'
            });

            $('#myCarousel').addClass('active');
        });
    </script>
    @endsection