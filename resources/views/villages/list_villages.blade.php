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
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">{{ $title }}</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table class="table table-bordered table-striped datatables-class">
                        <thead>
                        <tr>
                            <th class="col-xs-1">Kode</th>
                            <th class="col-xs-3">Kecamatan</th>
                            <th>Kelurahan</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($villages as $row)
                        <tr>
                            <td>{{ $row->id }}</td>
                            <td>{{ $row->districts->name }}</td>
                            <td>{{ $row->name }}</td>
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