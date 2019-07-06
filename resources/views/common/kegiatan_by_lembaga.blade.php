<?php
/**
 * Created by PhpStorm.
 * User: deyelovi
 * Date: 16/03/2017
 * Time: 11:19
 */
?>
@extends('layouts.beranda.master')

@section('content')
    <div class="row">
        @include('layouts.alert')
        <div class="box box-default">
            <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-list"></i> {{$title}}</h3>
                <div class="box-tools pull-right">
                    <div class="has-feedback">
                        <input type="text" id="search" class="form-control input-sm" placeholder="Search...">
                        <span class="glyphicon glyphicon-search form-control-feedback"></span>
                    </div>
                </div>
                <br>
                <a href="{{url('kegiatan')}}" class="btn btn-warning btn-xs"><i class="fa fa-reply"></i> Kembali</a>
                <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body scroll">
                @foreach($data as $row)
                    <div style="margin-bottom: 5px;" class="col-md-12 box-footer box-comments contact-name">
                        <div class="box-comment">
                            <div class="comment-text">
                                <span class="username"> {{date('d-m-Y',strtotime($row->tanggal_mulai))}} - {{date('d-m-Y',strtotime($row->tanggal_selesai))}}</span>
                                <p>{{$row->detail_proker->jenis_kegiatan}}</p>
                                <p><i class="fa fa-map-marker"></i> Lokasi {{$row->lokasi_kegiatan}}</p>
                            </div>
                            <!-- /.comment-text -->
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
