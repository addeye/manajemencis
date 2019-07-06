<?php
/**
 * Created by Sublime
 * User: Dio Putra
 * Date: 29/01/2017
 * Time: 23:54
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
				<div class="box-body">
                    <form class="form-inline" style="padding-bottom: 10px;">
                        <div class="form-group">
                        <input type="text" name="search" class="form-control" placeholder="Cari nama sentra" value="{{Request::input('search')}}">
                        </div>
                        <div class="form-group">
                            <select class="form-control select2" name="lembaga_id">
                                <option value="">Semua Lembaga</option>
                                @foreach ($lembaga as $row)
                                    <option value="{{$row->id}}" {{Request::input('lembaga_id')==$row->id?'selected':''}}>{{$row->plut_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <button class="btn btn-success"><i class="fa fa-search"></i> Cari</button>
                    </form>
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th><i class="fa fa-gear"></i></th>
                                <th class="col-xs-1">No</th>
                                <th>Sentra ID</th>
                                <th>Lembaga</th>
                                <th>Nama</th>
                                <th>Tahun Beridiri</th>
                                <th>UMKM</th>
                                <th>Pegawai</th>
                                <th>Omset/bln</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php $no=1; ?>
                            @foreach($data as $row)
                            <tr>
                                <td>
                                <a target="_blank" href="{{url('database/sentra/'.$row->id)}}" class="btn btn-info btn-xs"><i class="fa fa-eye"></i></a>
                                </td>
                                <td>{{$no++}}</td>
                                <td>{{$row->id_sentra}}</td>
                                <td>{{$row->lembagas->plut_name}}</td>
                                <td>{{$row->name}}</td>
                                <td>{{$row->tahun_berdiri}}</td>
                                <td>{{$row->total_umkm}}</td>
                                <td>{{$row->total_pegawai}}</td>
                                <td>{{$row->omset_bulan}}</td>
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