<?php
/**
 * Created by PhpStorm.
 * User: deyelovi
 * Date: 06/03/2017
 * Time: 14:44
 */
?>

@extends('layouts.master')

@section('css')

@endsection

@section('content')

    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">{{$title}}</h3>
                </div>
                <!-- / box Header -->
                <div class="box-body">
                    <div class="form-inline">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <div class="col-sm-5">
                                <select class="form-control" name="cis_lembaga_id" required>
                                    <option value="">Pilih Lembaga</option>
                                    @foreach($lembaga as $row)
                                    <option value="{{$row->id}}">{{$row->plut_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-5">
                                <select name="tahun" class="form-control">
                                    <option value="">Tahun</option>
                                    @for($thn=2015; $thn<=2020; $thn++)
                                    <option value="{{$thn}}" {{date('Y')==$thn?'selected':''}}>{{$thn}}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                    <hr>
                    <div class="table-responsive">
                        <div id="form-kinerja"></div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <input type="hidden" name="url" value="{{url('get-list-standart')}}">
@endsection

@section('script')
<script type="text/javascript">

    $('select[name=cis_lembaga_id]').change(function(){
        showData();
    });

    $('select[name=tahun]').change(function(){
        showData();
    });

    function showData() {
        url = $('input[name=url]').val();
        lembaga_id = $('select[name=cis_lembaga_id]').val();
        tahun = $('select[name=tahun]').val()

        $.ajax({
            url : url+'/'+lembaga_id+'/'+tahun,
            method : 'GET',
            typeData : 'html'
        })
        .done(function(msg){
            $('#form-kinerja').html(msg);
        });
    }
</script>
@endsection
