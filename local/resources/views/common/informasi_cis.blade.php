<?php
/**
 * Created by PhpStorm.
 * User: deyelovi
 * Date: 30/03/2017
 * Time: 12:56
 */
?>
@extends('layouts.beranda.master')

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
        <div class="col-md-12">
            <!-- Chat box -->
            <div class="box box-info">
                <div class="box-header">
                    <i class="fa fa-globe"></i>
                    <h3 class="box-title">Daftar PLUT <small>({{count($lembaga)}})</small></h3>
                    <div class="box-tools pull-right">
                        <div class="has-feedback">
                            <input type="text" id="search" class="form-control input-sm" placeholder="Search...">
                            <span class="glyphicon glyphicon-search form-control-feedback"></span>
                        </div>
                    </div>
                </div>
                <div class="box-body chat scroll" id="chat-box">
                    @foreach($lembaga as $data)
                        <div class="col-md-12 box-footer box-comments contact-name">
                            <div class="box-comment">
                                <!-- User image -->
                                <img class="img-circle img-sm" src="{{ url('images/'.$data->photo_gedung) }}" alt="User Image">
                                <div class="comment-text">
                              <span class="username"> {{$data->plut_name}} - No Telp. {{$data->plut_telp}}
                                  <span class="text-muted pull-right">Konsultan {{count($data->konsultan)}}</span>
                              </span><!-- /.username -->
                                    <span style="font-weight: bold">{{$data->mulai_operasional}}</span>
                                    <p>{{$data->plut_alamat}}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <!-- /.chat -->
            </div>
            <!-- /.box (chat box) -->
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
