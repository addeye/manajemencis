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
                    <form class="form-inline" action="{{url('laporan-kinerja/excel')}}" method="get">
                        <div class="form-group">
                            <select name="lembaga" class="form-control">
                                <option value="semua">Pilih Semua Lembaga</option>
                                @foreach($lembaga as $row)
                                    <option value="{{$row->id}}">{{$row->plut_name}}</option>
                                @endforeach
                            </select>
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
                        <button type="submit" class="btn btn-info">Download Excel</button>
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
                            <th>Bidang</th>
                            <th>Layanan</th>
                            <th>Sasaran</th>
                            <th>Target</th>
                            <th>Tahun</th>
                            <th>Jan-Mar</th>
                            <th>Apr-Jun</th>
                            <th>Jul-Sept</th>
                            <th>Okt-Des</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $no = 1;?>
                        @foreach($kinerja as $row)
                            <tr>
                                <td>{{$no++}}</td>
                                <td>{{$row->lembaga}}</td>
                                <td>{{$row->bidang_layanan}}</td>
                                <td>{{$row->standart_layanan}}</td>
                                <td>{{$row->sasaran}}</td>
                                <td>{{$row->target}}</td>
                                <td>{{$row->tahun}}</td>
                                <td>{{$row->triwulan1}}</td>
                                <td>{{$row->triwulan2}}</td>
                                <td>{{$row->triwulan3}}</td>
                                <td>{{$row->triwulan4}}</td>
                        @endforeach
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
