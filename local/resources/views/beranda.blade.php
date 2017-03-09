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

@section('content')
    <div class="row">
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-aqua">
                <div class="inner">
                    <h3>{{$jml_sentra}}</h3>
                    <p>Sentra UMKM</p>
                </div>
                <div class="icon">
                    <i class="ion ion-bag"></i>
                </div>
                <a href="#" class="small-box-footer">Total Sentra UMKM <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-green">
                <div class="inner">
                    <h3>{{0}}</h3>
                    <p>Produk Unggulan</p>
                </div>
                <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                </div>
                <a href="#" class="small-box-footer">Total Produk<i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-yellow">
                <div class="inner">
                    <h3>{{$jml_kegiatan}}</h3>

                    <p>Jumlah Kegiatan</p>
                </div>
                <div class="icon">
                    <i class="ion ion-pie-graph"></i>
                </div>
                <a href="#" class="small-box-footer">Total Kegiatan <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-red">
                <div class="inner">
                    <h3>{{$jml_penerima}}</h3>
                    <p>Penerima Manfaat</p>
                </div>
                <div class="icon">
                    <i class="ion ion-person-add"></i>
                </div>
                <a href="#" class="small-box-footer">Penerima Manfaat <i class="fa fa-arrow-circle-right"></i></a>
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
            <a href="{{url('konsultasi')}}">
                <div class="text-center">
                    <i class="fa fa-users fa-5x"></i>
                    <div class="caption">
                        <h4>Konsultasi</h4>
                    </div>
                </div>
            </a>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-6">
            <a href="#">
                <div class="text-center">
                    <i class="fa fa-globe fa-5x"></i>
                    <div class="caption">
                        <h4>Informasi Pasar</h4>
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
                    <h3 class="box-title">Info Terbaru</h3>
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
                            {{$row->keterangan}}
                        </p>
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