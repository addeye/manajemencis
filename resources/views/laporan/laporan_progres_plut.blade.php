<?php
/**
 * Created by PhpStorm.
 * User: deyelovi
 * Date: 31/03/2017
 * Time: 15:27
 */
?>
@extends('layouts.master')

@section('css')
<style type="text/css">
    tr th {
        text-align: center;
    }
</style>
@endsection

@section('content')

    <div class="row">
    <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="title">Progres Data PLUT</h3>
                </div>
                <div class="box-body">
                    <form class="form-inline">
                        <select name="tahun" class="form-control">
                            <option value="">Pilih Tahun</option>
                            <option value="2017" {{'2017'==$tahun?'selected':''}}>2017</option>
                            <option value="2018" {{'2018'==$tahun?'selected':''}}>2018</option>
                        </select>
                        <button type="submit" class="btn btn-danger"><i class="fa fa-search"></i> Cari</button>
                        <a href="{{ url('progres-data/excel?tahun='.$tahun) }}" class="btn btn-success"><i class="fa fa-file-excel-o"></i> Excel</a>
                     <a href="{{ url('progres-data/print?tahun='.$tahun) }}" class="btn btn-success btn-print"><i class="fa fa-print"></i> Print</a>
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
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th rowspan="2">No</th>
                                <th rowspan="2">Nama PLUT</th>
                                <th colspan="3">Jumlah</th>
                                <th colspan="7">Laporan Per Bidang</th>
                                <th>Total</th>
                            </tr>
                            <tr>
                                <th>KUMKM</th>
                                <th>Sentra KUMKM</th>
                                <th>Produk Unggulan</th>
                                <th>Kelembagaan</th>
                                <th>SDM</th>
                                <th>Produksi</th>
                                <th>Pembiayaan</th>
                                <th>Pemasaran</th>
                                <th>IT</th>
                                <th>Kerjasama</th>
                                <th>Laporan Kegiatan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;?>
                            @foreach ($data as $row)
                                <tr>
                                    <td>{{$no++}}</td>
                                    <td>{{$row->plut_name}}</td>
                                    <td>{{$row->kumkm_count}}</td>
                                    <td>{{$row->sentra_kumkm_count}}</td>
                                    <td>{{$row->produk_unggulan_count}}</td>
                                    <td>{{$row->kegiatan_by_kelembagaan_count}}</td>
                                    <td>{{$row->kegiatan_by_sdm_count}}</td>
                                    <td>{{$row->kegiatan_by_produksi_count}}</td>
                                    <td>{{$row->kegiatan_by_pembiayaan_count}}</td>
                                    <td>{{$row->kegiatan_by_pemasaran_count}}</td>
                                    <td>{{$row->kegiatan_by_it_count}}</td>
                                    <td>{{$row->kegiatan_by_kerjasama_count}}</td>
                                    <td>{{$row->total_kegiatan_count}}</td>
                                </tr>
                            @endforeach
                        </tbody>

                    </table>
                    <div class="text-center">

            </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
<script src="{{url('js/jquery.printPage.js')}}"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $('.btn-print').printPage();
    });
</script>
@endsection
