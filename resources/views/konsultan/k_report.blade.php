<?php
/**
 * Created by Sublime
 * User: Dio Putra
 * Date: 29/01/2017
 * Time: 23:54
 */

?>

@extends('layouts.master')

@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.2.4/css/buttons.bootstrap.min.css">
@endsection

@section('content')

    <div class="row">
        <div class="col-xs-12">
            @include('layouts.alert')
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">{{$title}}</h3>
                </div>
                <!-- / box Header -->
                <div class="box-body table-responsive">
                    <table id="example" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th class="col-xs-1">ID</th>
                            <th>No Registrasi</th>
                            <th>Nama Lengkap</th>
                            <th>Jenis Kelamin</th>
                            <th>Provinsi</th>
                            <th>Kabupaten/Kota</th>
                            <th>Alamat</th>
                            <th>Kode Pos</th>
                            <th>Tanggal Lahir</th>
                            <th>Telepon</th>
                            <th>Email</th>
                            <th>Pendidikan Terakhir</th>
                            <th>Jurusan</th>
                            <th>Bidang Keahlian</th>
                            <th>Pengalaman</th>
                            <th>Sertifikat</th>
                            <th>Asosiasi</th>
                            <th>Lembaga</th>
                            <th>Bidang Layanan</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($konsultan as $row)
                            <tr>
                                <td>{{$row->id}}</td>
                                <td>{{$row->no_registrasi}}</td>
                                <td>{{$row->nama_lengkap}}</td>
                                <td>{{$row->jenis_kelamin}}</td>
                                <td>{{$row->provinces->name}}</td>
                                <td>{{$row->regencies->name}}</td>
                                <td>{{$row->alamat}}</td>
                                <td>{{$row->kode_pos}}</td>
                                <td>{{$row->tanggal_lahir}}</td>
                                <td>{{$row->telepon}}</td>
                                <td>{{$row->email}}</td>
                                <td>{{$row->pendidikans->name}}</td>
                                <td>{{$row->jurusan}}</td>
                                <td>{{$row->bidang_keahlian}}</td>
                                <td>{{$row->pengalaman}}</td>
                                <td>{{$row->sertifikat}}</td>
                                <td>{{$row->asosiasi}}</td>
                                <td>{{$row->lembagas->name}}</td>
                                <td>{{$row->bidang_layanans->name}}</td>
                            </tr>
                        @endforeach
                        </tbody>

                    </table>
                </div>


            </div>
        </div>
    </div>
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