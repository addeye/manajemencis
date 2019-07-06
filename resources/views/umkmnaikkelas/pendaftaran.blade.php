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
                    <h3 class="box-title">Pendaftaran {{date('Y')}}</h3>
                </div>
                <!-- / box Header -->
                <div class="box-body table-responsive">
                    <form class="form-inline">
                        <div class="form-group">
                            <input type="text" name="nama" class="form-control" placeholder="Nama Usaha / Pemilik" value="{{$nama}}">
                        </div>
                        <button type="submit" class="btn btn-success"><i class="fa fa-search"></i></button>
                    </form>
                    <br>
                    <form class="form-inline">
                        <button type="button" class="btn btn-primary"><i class="fa fa-plus"></i> Semua</button>
                        <div class="pull-right">
                            <a href="{{ url('list-umkm') }}" class="btn btn-warning"><i class="fa fa-list"></i> UMKM Terftar</a>
                        </div>
                    </form>

                    <div>Showing {{($data->currentpage()-1)*$data->perpage()+1}} to {{$data->currentpage()*$data->perpage()}}
                        of  {{$data->total()}} entries
                    </div>
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th><input id="checkAll" type="checkbox"></th>
                                <th>No</th>
                                <th>Nama Usaha</th>
                                <th>Nama Pemilik</th>
                                <th>Telp</th>
                                <th>Act</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = ($data->currentpage() - 1) * $data->perpage() + 1;?>
                            @foreach ($data as $row)
                            <tr>
                                <td align="center"><input type="checkbox" class="checkUser"></td>
                                <td>{{$no++}}</td>
                                <td>{{$row->nama_usaha}}</td>
                                <td>{{$row->nama_pemilik}}</td>
                                <td>{{$row->telp}}</td>
                                <td align="center">
                                    <form class="delete" action="{{ url('pendaftaran-umkm-one/'.$row->id) }}" method="POST">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                    <button type="submit" class="btn btn-success"><i class="fa fa-plus"></i></button>
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

        $("#checkAll").change(function() {
            if(this.checked) {
                $('.checkUser').prop('checked',true);
            }
            else
            {
              $('.checkUser').prop('checked',false);
            }
        });

        $(".delete").on("submit", function(){
            return confirm("Do you want to delete this item?");
        });
    });
</script>
@endsection
