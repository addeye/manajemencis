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
            @include('layouts.alert')
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">{{$title}}</h3>
                    <div class="pull-right">
                        <a class="btn btn-primary" href="{{ url('adm/kinerja/create') }}">
                            <i class="fa fa-plus"></i> Tambah Data
                        </a>
                    </div>
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
                        <div id="table-kinerja"></div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <input type="hidden" name="url" value="{{url('adm/kinerja-list-ajax')}}">
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
            $('#table-kinerja').html(msg);
            tableGenerate();
        });
    }

    function tableGenerate() {
        var table = $('#example').DataTable( {
            "paging": false,
            "lengthChange": true,
            "searching": false,
            "ordering": false,
            "bSortable": false,
            "info": false,
            "autoWidth": false,
            buttons: [
                {
                    extend: 'pdf',
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                {
                    extend: 'excel',
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                {
                    extend: 'print',
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                {
                    extend: 'colvis',
                    collectionLayout: 'fixed two-column',
                    text: 'Filter Kolom'
                }
            ],
        } );

        table.buttons().container()
                .appendTo( '#example_wrapper .col-sm-6:eq(0)' );

    }
</script>
@endsection