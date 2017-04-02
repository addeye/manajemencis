<?php
/**
 * Created by PhpStorm.
 * User: deyelovi
 * Date: 13/03/2017
 * Time: 13:19
 */
?>
@extends('layouts.master')

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
            <div class="box box-success">
                <div class="box-header">
                    <i class="fa fa-info-circle"></i>
                    <h3 class="box-title">Info Terbaru</h3>
                    <div class="box-tools pull-right">
                        <div class="has-feedback">
                            <input type="text" id="search" class="form-control input-sm" placeholder="Search...">
                            <span class="glyphicon glyphicon-search form-control-feedback"></span>
                        </div>
                    </div>
                </div>
                <div class="box-body chat scroll" id="chat-box">
                    @foreach($pengumuman as $row)
                            <!-- chat item -->
                    <div class="item contact-name">
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