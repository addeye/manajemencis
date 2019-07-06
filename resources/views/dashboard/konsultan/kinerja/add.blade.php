<?php
/**
 * Created by PhpStorm.
 * User: deyelovi
 * Date: 06/03/2017
 * Time: 14:44
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
                    <div class="form-inline">
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
    <input type="hidden" name="url" value="{{url('get-standart-konsultan')}}">
@endsection

@section('script')
<script type="text/javascript">

    showData();

    $('select[name=tahun]').change(function(){
        showData();
    });

    function showData() {
        url = $('input[name=url]').val();
        lembaga_id = $('select[name=cis_lembaga_id]').val();
        tahun = $('select[name=tahun]').val()

        $.ajax({
            url : url+'/'+tahun,
            method : 'GET',
            typeData : 'html'
        })
        .done(function(msg){
            $('#form-kinerja').html(msg);
        });
    }
</script>
@endsection