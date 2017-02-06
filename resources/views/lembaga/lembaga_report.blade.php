<?php
/**
 * Created by PhpStorm.
 * User: deyelovi
 * Date: 27/01/2017
 * Time: 23:29
 */
?>
@extends('layouts.master')

@section('content')
    <div class="row">
        <div class="col-xs-12">
            @include('layouts.alert')
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">{{ $title }}</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive">
                    <table id="example" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th class="col-xs-1">ID</th>
                            <th>Nama Lembaga</th>
                            <th>Status</th>
                            <th>Kabupaten/Kota</th>
                            <th>Provinsi</th>
                            <th>Alamat</th>
                            <th>Kode Pos</th>
                            <th>Bentuk Lembaga</th>
                            <th>SKPD Penangung Jawab</th>
                            <th>Tahun Berdiri</th>
                            <th>Telepon</th>
                            <th>Email</th>
                            <th>Nama Pimpinan</th>
                            <th>Telepon Pimpinan</th>
                            <th>Email Pimpinan</th>
                            <th>Nama Admin</th>
                            <th>Telepon Admin</th>
                            <th>Email Admin</th>
                            <th>Nama Staf Galery</th>
                            <th>Telepon Staf Galery</th>
                            <th>Email Staf Galery</th>
                            <th>Nama Staf Dukungan Teknis</th>
                            <th>Telepon Staf Dukungan Teknis</th>
                            <th>Email Staf Dukungan Teknis</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($lembaga as $row)
                            <tr>
                                <td>{{ $row->idlembaga }}</td>
                                <td>{{ $row->name }}</td>
                                <td>{{ $row->tingkats->name }}</td>
                                <td>{{ $row->regencies->name }}</td>
                                <td>{{ $row->provinces->name }}</td>
                                <td>{{ $row->alamat }}</td>
                                <td>{{ $row->kode_pos }}</td>
                                <td>{{ $row->bentuk_lembaga }}</td>
                                <td>{{ $row->SKPD }}</td>
                                <td>{{ $row->tahun_berdiri }}</td>
                                <td>{{ $row->telepon }}</td>
                                <td>{{ $row->email }}</td>
                                <td>{{ $row->nama_pimpinan }}</td>
                                <td>{{ $row->telepon_pimpinan }}</td>
                                <td>{{ $row->email_pimpinan }}</td>
                                <td>{{ $row->nama_admin }}</td>
                                <td>{{ $row->telepon_admin }}</td>
                                <td>{{ $row->email_admin }}</td>
                                <td>{{ $row->nama_staffgalery }}</td>
                                <td>{{ $row->telepon_staffgalery }}</td>
                                <td>{{ $row->email_staffgalery }}</td>
                                <td>{{ $row->nama_staffteknis }}</td>
                                <td>{{ $row->telepon_staffteknis }}</td>
                                <td>{{ $row->email_staffteknis }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->
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
        $(document).ready(function() {
            var table = $('#example').DataTable( {
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
            } );

            table.buttons().container()
                    .appendTo( '#example_wrapper .col-sm-6:eq(0)' );
        } );
    </script>
@endsection