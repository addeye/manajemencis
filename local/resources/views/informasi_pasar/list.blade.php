<?php
/**
 * Created by PhpStorm.
 * User: deyelovi
 * Date: 13/03/2017
 * Time: 13:19
 */
?>
@extends('layouts.beranda.master')

@section('content')
    <div class="row">
        @include('layouts.alert')
        <div class="box box-default">
            <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-globe"></i> {{$title}}</h3>

                <div class="box-tools pull-right">
                    <div class="has-feedback">
                        <input type="text" id="search" class="form-control input-sm" placeholder="Search...">
                        <span class="glyphicon glyphicon-search form-control-feedback"></span>
                    </div>
                </div>
                <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body scroll">
                <div class="mailbox-controls with-border text-center">
                    <div class="btn-group">
                        <a href="{{url('informasi/tambah/permintaan')}}" class="btn btn-default btn-sm" data-toggle="Permintaan Pasar" data-container="body"
                                title="" data-original-title="Delete">
                            <i class="fa fa-plus"></i> Permintaan
                        </a>
                        <a href="{{url('informasi/tambah/penawaran')}}" class="btn btn-default btn-sm" data-toggle="Penawaran Pasar" data-container="body"
                                title="" data-original-title="Delete">
                            <i class="fa fa-plus"></i> Penawaran
                        </a>
                    </div>
                </div>
                @foreach($informasi as $data)
                    <div class="col-md-12 box-footer box-comments">
                        <div class="box-comment contact-name">
                            <!-- User image -->
                            <img class="img-circle img-sm" src="{{url('images/market.png')}}" alt="User Image">
                            <div class="comment-text">
                              <span class="username"> {{$data->nama_lengkap}}
                                  <span class="text-muted pull-right">{{$data->dibuat}}</span>
                              </span><!-- /.username -->
                                <span style="font-weight: bold">{{$data->nama_produk}}</span>
                                <small class="label pull-right bg-green">{{$data->jenis}}</small>
                                <p>{{$data->keterangan}}</p>
                            </div>
                            <!-- /.comment-text -->
                            <span class="pull-right text-muted">{{count($data->comment)}} Comment <a href="{{url('informasi/'.$data->id.'/detail')}}">Selengkapnya..</a></span>
                        </div>
                    </div>
                @endforeach
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->

    </div>
@endsection

@section('script')
    <script>
        $(function () {
            $('.scroll').slimScroll({
                height: '500px'
            });

            $('#search').keyup(function(){
                $('.contact-name').hide();
                var txt = this.value;
                $('.contact-name').each(function(){
                    if($(this).text().toUpperCase().indexOf(txt.toUpperCase()) != -1){
                        $(this).show();
                    }
                });
            });
        });
    </script>
@endsection