<?php
/**
 * Created by PhpStorm.
 * User: deyelovi
 * Date: 31/03/2017
 * Time: 15:27
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
                <div class="box-body table-responsive">
                    <table id="example" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th class="col-xs-1">No</th>
                            <th>Nama Lengkap</th>
                            <th>Lembaga</th>
                            <th>No Telp</th>
                            <th>Email</th>                            
                        </tr>
                        </thead>
                        <tbody>
                        <?php $no=1; ?>
                        @foreach($admin as $row)
                            <tr>
                                <td>{{$no++}}</td>
                                <td>{{$row->nama_lengkap}}</td>
                                <td>{{$row->lembagas->plut_name}}</td>
                                <td>{{$row->no_telp}}</td>
                                <td>{{$row->email}}</td>
                            </tr>
                        @endforeach
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
