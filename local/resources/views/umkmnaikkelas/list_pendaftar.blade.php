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
            @include('layouts.alert')
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">UMKM Naik Kelas</h3>
                    <div class="pull-right">
                    <a href="javascript:void()" class="btn btn-primary">Excel</a>
                    <a href="javascript:void()" class="btn btn-primary">Print</a>
                    </div>
                </div>
                <!-- / box Header -->
                <div class="box-body table-responsive">
                    <form class="form-inline">
                        <div class="form-group">
                            <select class="form-control" name="tahun" disabled>
                                <option>Tahun</option>
                                <option>2017</option>
                                <option>2018</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-info">Lihat</button>
                        <div class="pull-right">
                            <a href="{{ url('pendaftaran-umkm') }}" class="btn btn-success"><i class="fa fa-plus"></i> Pendaftaran</a>
                        </div>
                    </form>

                    <div>Showing {{($data->currentpage()-1)*$data->perpage()+1}} to {{$data->currentpage()*$data->perpage()}}
                        of  {{$data->total()}} entries
                    </div>
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th><input type="checkbox"></th>
                                <th>No</th>
                                <th>Nama Usaha</th>
                                <th>Nama Pemilik</th>
                                <th>Telp</th>
                                <th>Del</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = ($data->currentpage() - 1) * $data->perpage() + 1;?>
                            @foreach ($data as $row)
                            <tr>
                                <td align="center"><input type="checkbox"></td>
                                <td>{{$no++}}</td>
                                <td>{{$row->kumkm->nama_usaha}}</td>
                                <td>{{$row->kumkm->nama_pemilik}}</td>
                                <td>{{$row->kumkm->telp}}</td>
                                <td align="center">
                                    <form class="delete" action="{{ url('pendaftaran-umkm/'.$row->id) }}" method="POST">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                        <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="text-center">
                {{$data->appends($_GET)->links()}}
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

        $(".delete").on("submit", function(){
            return confirm("Do you want to delete this item?");
        });
    });
</script>
@endsection
