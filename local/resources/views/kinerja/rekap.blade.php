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
                </div>
                <!-- / box Header -->
                <div class="box-body">
                <form action="" class="form-inline">
                    <div class="form-group">
                        <div class="col-sm-5">
                            <select name="tahun" class="form-control">
                                <option value="">Pilih Tahun Rekap</option>
                                @for($thn=2015; $thn<=2020; $thn++)
                                <option value="{{$thn}}" {{date('Y')==$thn?'selected':''}}>{{$thn}}</option>
                                @endfor
                            </select>
                        </div>
                    </div>
                </form>
                <hr>
                    <div class="table-responsive">
                        <div id="idrekaptable"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <input type="hidden" name="url" value="{{url('rekap-kinerja-ajax')}}">
@endsection

@section('script')
<script type="text/javascript">
    showRekap();
    $('select[name=tahun]').change(function(){
        showRekap();
    });

    function showRekap() {
        url = $('input[name=url]').val();
        tahun = $('select[name=tahun]').val()

        $.ajax({
            url : url+'/'+tahun,
            method : 'GET',
            typeData : 'html'
        })
        .done(function(msg){
            $('#idrekaptable').html(msg);
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


