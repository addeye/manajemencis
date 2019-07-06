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
                    <form class="form-inline" style="padding-bottom: 10px;">
                        <div class="form-group">
                        <input type="text" name="search" class="form-control" placeholder="Cari nama produk" value="{{Request::input('search')}}">
                        </div>
                        <button class="btn btn-success"><i class="fa fa-search"></i> Cari</button>
                    </form>
                    <div>Showing {{($data->currentpage()-1)*$data->perpage()+1}} to {{$data->currentpage()*$data->perpage()}}
                    of  {{$data->total()}} entries
                    </div>
                    <table class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Produk</th>
                            <th>Merek</th>
                            <th>Bidang Usaha</th>
                            <th>Hrg/Satuan</th>
                            <th>Kapasitas/bln</th>
                            <th>Omset/bln</th>
                            <th>Perusahaan</th>
                            <th>Pemilik</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $no=1; ?>
                        @foreach($data as $row)
                            <tr>
                                <td>{{$no++}}</td>
                                <td>{{$row->nama_produk}}</td>
                                <td>{{$row->merek}}</td>
                                <td>{{$row->bidangUsaha->name}}</td>
                                <td>{{$row->satuan}}</td>
                                <td>{{number_format($row->kapasitas_perbulan)}}</td>
                                <td>{{number_format($row->omset_perbulan)}}</td>
                                <td>{{$row->nama_perusahaan}}</td>
                                <td>{{$row->nama_pemilik}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="text-right">
                        {{$data->appends($_GET)->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
