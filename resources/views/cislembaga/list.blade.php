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
            @include('layouts.alert')
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">{{$title}}</h3>

                    <div class="pull-right">
                        <a class="btn btn-primary" href="{{ url('cislembaga/create') }}">Tambah Data</a>
                    </div>
                </div>
                <!-- / box Header -->
                <div class="box-body table-responsive">
                    <table id="example" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th class="col-xs-1">ID</th>
                            <th class="col-xs-1">ID Lembaga</th>
                            <th>Nama</th>
                            <th>Bentuk Kelembagaan</th>
                            <th>Alamat</th>
                            <th>Telepon</th>
                            <th>Email</th>
                            <th>Whatsapp</th>
                            <th>Action</th>

                        </tr>
                        </thead>
                        <tbody>
                        @foreach($data as $row)
                            <tr>

                                <td>{{$row->id}}</td>
                                <td>{{$row->id_lembaga}}</td>
                                <td>{{$row->plut_name}}</td>
                                <td>{{$row->plut_bentuk_kelembagaan}}</td>
                                <td>{{$row->plut_alamat}}</td>
                                <td>{{$row->plut_telp}}</td>
                                <td>{{$row->plut_email}}</td>
                                <td>{{$row->plut_whatsapp}}</td>
                                <td>
                                    <a href="{{ url('cislembaga/'.$row->id.'/detail') }}" class="btn btn-info btn-xs"><i
                                                class="glyphicon glyphicon-eye-open"></i></a>
                                    <a href="{{ url('cislembaga/'.$row->id) }}" class="btn btn-success btn-xs"><i
                                                class="glyphicon glyphicon-edit"></i></a>
                                    <a href="{{ url('cislembaga/'.$row->id.'/delete') }}"
                                       onclick="return ConfirmDelete()" class="btn btn-danger btn-xs"><i
                                                class="glyphicon glyphicon-trash"></i></a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>

                    </table>
                </div>


            </div>
        </div>
    </div>
@endsection

@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.2.4/css/buttons.bootstrap.min.css">
@endsection

@section('script')
    <script src="https://cdn.datatables.net/buttons/1.2.4/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
    <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
    <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.colVis.min.js"></script>
    <script>
        $(document).ready(function () {
            var table = $('#example').DataTable({
                lengthChange: false,
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
                        collectionLayout: 'fixed two-column'
                    }
                ],
            });

            table.buttons().container()
                    .appendTo('#example_wrapper .col-sm-6:eq(0)');
        });
    </script>
@endsection