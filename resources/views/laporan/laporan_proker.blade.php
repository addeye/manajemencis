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
            <div class="box">
                <div class="box-body">
                    <form class="form-inline" action="{{url('laporan-program/excel')}}" method="get">
                        <div class="form-group">
                            <select name="lembaga" class="form-control">
                                <option value="semua">Pilih Semua Lembaga</option>
                                @foreach($lembaga as $row)
                                    <option value="{{$row->id}}">{{$row->plut_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <button class="btn btn-info">Download Excel</button>
                    </form>
                </div>
            </div>
        </div>
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
                            <th>Lembaga</th>
                            <th>Konsultan</th>
                            <th>Tahun</th>
                            <th>Program</th>
                            <th>Tujuan</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $no = 1;?>
                        @foreach($proker as $row)
                            <tr>
                                <td>{{$no++}}</td>
                                <td>{{$row->plut_name}}</td>
                                <td>{{$row->nama_lengkap}}</td>
                                <td>{{$row->tahun_kegiatan}}</td>
                                <td>{{$row->program}}</td>
                                <td>{{$row->tujuan}}</td>
                        @endforeach
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
