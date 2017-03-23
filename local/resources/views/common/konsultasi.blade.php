<?php
/**
 * Created by PhpStorm.
 * User: deyelovi
 * Date: 23/03/2017
 * Time: 11:39
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
                    @foreach($konsultasi as $row)
                            <!-- chat item -->
                    <div class="item contact-name">
                        <span class="fa fa-user fa-3x"></span>
                        <p class="message">
                            <a href="{{url('konsultasi/'.$row->id.'/detail')}}" class="name">
                                <small class="text-muted pull-right"><i class="fa fa-clock-o"></i> {{$row->dibuat}}</small>
                                {{$row->nama}} - {{$row->email}}
                            </a>
                            {!! $row->permasalahan_bisnis !!}
                        </p>
                        <p style="font-weight: bold">{{$row->alamat}}</p>
                        <small class="pull-right">
                            Respon : {{$row->lembaga_id?$row->lembaga->plut_name:'Belum ada'}}
                            <br>{{$row->user?$row->user->name:''}}
                        </small>
                        <!-- /.attachment -->
                    </div>
                    <!-- /.item -->
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

