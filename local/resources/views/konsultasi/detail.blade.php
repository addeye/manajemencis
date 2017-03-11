<?php
/**
 * Created by PhpStorm.
 * User: deyelovi
 * Date: 11/03/2017
 * Time: 16:43
 */
?>
@extends('layouts.master')

@section('content')
    <div class="row">
        <div class="col-md-12">
            @include('layouts.alert')
            <!-- Box Comment -->
            <div class="box box-widget">
                <div class="box-header with-border">
                    <div class="user-block">
                        <span class=""><a href="#"><span class="fa fa-user fa-3x"></span> {{$data->nama}}</a></span>
                        <br>
                        <span class="">Dibuat - {{$data->dibuat}}</span>
                    </div>
                    <!-- /.user-block -->
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <!-- post text -->
                    <p>Email : {{$data->email}}</p>

                    <p>No Telp : {{$data->telp}}</p>

                    <p>Produk : {{$data->produk}}</p>

                    <p>Alamat : {{$data->alamat}}</p>

                    <p>Permasalahan Bisnis : </p>

                    <p><b>{{$data->permasalahan_bisnis}}</b></p>
                </div>
                <!-- /.box-body -->
                @if($data->lembaga_id)
                    <div class="box-footer box-comments">
                        <div class="box-comment">
                            <!-- User image -->
                            <img class="img-circle img-sm" src="{{url('images/'.$data->user->path)}}" alt="User Image">

                            <div class="comment-text">
                      <span class="username">
                        {{$data->user->name}}
                          <span class="text-muted pull-right">{{$data->diupdate}}</span>
                      </span><!-- /.username -->
                                {{$data->respon}}
                            </div>
                            <!-- /.comment-text -->
                        </div>
                        <!-- /.box-comment -->
                    </div>
                    @endif
                            <!-- /.box-footer -->
                    <div class="box-footer">
                        @if(!$data->lembaga_id)
                        <form action="{{url('konsultasi/'.$data->id)}}" method="post">
                            <input type="hidden" name="_method" value="PUT">
                            {{ csrf_field() }}
                            <img class="img-responsive img-circle img-sm" src="{{url('images/'.$user->path)}}" alt="Alt Text">
                            <div class="img-push">
                                <div class="input-group {{$errors->has('respon')?'has-error':''}}">
                                    <input type="text" name="respon" placeholder="Ketik respon anda disini..." class="form-control">
                                      <span class="input-group-btn">
                                        <button type="submit" class="btn btn-primary btn-flat">Kirim</button>
                                      </span>
                                </div>
                                <span class="help-block">{{$errors->first('respon')}}</span>
                            </div>
                        </form>
                            @endif
                    </div>
                    <!-- /.box-footer -->
            </div>
            <!-- /.box -->
        </div>
    </div>
@endsection
