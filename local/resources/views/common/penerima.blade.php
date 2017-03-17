<?php
/**
 * Created by PhpStorm.
 * User: deyelovi
 * Date: 15/03/2017
 * Time: 15:07
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
                <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body scroll">
                @foreach($data as $row)
                    <div style="margin-bottom: 5px;" class="col-md-12 box-footer box-comments contact-name">
                        <div class="box-comment">
                            <div class="comment-text">
                              <span style="font-weight: bold" class="username">Tahun {{$row->the_year}} - <span style="font-size: 23px;">{{$row->count}} UMKM Penerima Manfaat</span></span>
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

