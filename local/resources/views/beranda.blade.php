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
                <div class="info-box">
                    <span class="info-box-icon bg-aqua"><i class="fa fa-bank"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Seputar Plut</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
            </a>
            <!-- /.info-box -->
        </div>
        <div class="col-md-3 col-sm-6 col-xs-6">
            <a href="{{url('kontak')}}">
                <div class="info-box">
                    <span class="info-box-icon bg-green"><i class="fa fa-phone-square"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Kontak</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
            </a>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-6">
            <a href="#">
                <div class="info-box">
                    <span class="info-box-icon bg-yellow"><i class="fa fa-users"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Konsultasi</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
            </a>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-6">
            <a href="#">
                <div class="info-box">
                    <span class="info-box-icon bg-red"><i class="fa fa-globe"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Informasi Pasar</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
            </a>
            <!-- /.info-box -->
        </div>
        <div class="col-xs-12">
            <!-- Chat box -->
            <div class="box box-success">
                <div class="box-header">
                    <i class="fa fa-info-circle"></i>
                    <h3 class="box-title">Pengumuman</h3>
                </div>
                <div class="box-body chat scroll" id="chat-box">
                    @for($a=1; $a<=10; $a++)
                    <!-- chat item -->
                    <div class="item">
                        <img src="{{url('admin-lte/dist/img/user4-128x128.jpg')}}" alt="user image" class="online">
                        <p class="message">
                            <a href="#" class="name">
                                <small class="text-muted pull-right"><i class="fa fa-clock-o"></i> 2:15</small>
                                Admin CIS PLUT-KUMKM
                            </a>
                            I would like to meet you to discuss the latest news about
                            the arrival of the new theme. They say it is going to be one the
                            best themes on the market
                        </p>
                        <!-- /.attachment -->
                    </div>
                    <!-- /.item -->
                    @endfor
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