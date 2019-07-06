<?php
/**
 * Created by PhpStorm.
 * User: deyelovi
 * Date: 15/03/2017
 * Time: 12:25
 */
?>
@extends('layouts.master')

@section('content')
    <div class="row">
        <div class="col-md-12">
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
                    <!-- /.box-tools -->
                </div>
                <!-- /.box-header -->
                <div class="box-body scroll">
                    @foreach($sentra as $data)
                        <div class="col-md-12 box-footer box-comments contact-name">
                            <div class="box-comment">
                                <div class="comment-text">
                              <span class="username"> {{$data->name}}
                              </span><!-- /.username -->
                                    <small class="label pull-right bg-green">{{$data->lembagas->plut_name}}</small>
                                    <p>Provinsi {{$data->provinces->name}} - Kabupaten/Kota {{$data->districts->name}} - Kecamatan {{$data->regencies->name}} - Kelurahan {{$data->villages->name}}</p>
                                    <p>{{$data->alamat}}</p>
                                    <p>{{$data->nama_ketua}} ({{$data->notelp_ketua}})</p>
                                </div>
                                <!-- /.comment-text -->
                            </div>
                        </div>
                    @endforeach
                </div>
                <!-- /.box-body -->
            </div>
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
