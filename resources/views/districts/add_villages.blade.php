<?php
/**
 * Created by Sublime
 * User: Dio Putra
 * Date: 29/01/2017
 * Time: 23:54
 */

?>

@extends('layouts.master')

@section('content')

    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">{{$title}}</h3>
                </div>
                <!-- / box Header -->
                <div class="box-body">
                    <form method="post" action="{{ url('/districts/villages') }}" class="form-horizontal">
                        {{ csrf_field() }}
                        <input type="hidden" name="district_id" value="{{ $district->id }}">
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Kecamatan</label>
                            <div class="col-sm-5">
                                <input type="text" name="id" class="form-control" value="{{ $district->id }} {{ $district->name }}" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">ID</label>
                            <div class="col-sm-5">
                                <input type="text" name="id" class="form-control" placeholder="ID Kelurahan.." required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Nama Kelurahan</label>
                            <div class="col-sm-5">
                                <input type="text" name="name" class="form-control" placeholder="Nama Kelurahan.." required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-default">Simpan</button>
                                <button type="button" onclick="history.go(-1);" class="btn btn-default">Kembali</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <input type="hidden" id="urlregencies" value="{{ url('common/regencies') }}">
@endsection

@section('script')
    <script>
        urlregencies = $('#urlregencies').val();
        $('#provinces').change(function(){
            $.ajax({
                url: urlregencies+'/'+this.value,
                type : 'GET',
                cache : false,
                dataType : 'html'
            })
                    .success(function(response){
                        $('#ajaxRegencies').html(response);
                    })
        });
    </script>
    @endsection