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
					<div class="pull-right">
						<a class="btn btn-primary" href="{{ url('sentra/create') }}">Tambah Data</a>
					</div>
				</div>
				<!-- / box Header -->
				<div class="box-body">
						<table id="example" class="table table-bordered table-striped">
						<thead>
							<tr>
								<th class="col-xs-1">No</th>
								<th>Sentra ID</th>
								<th>Lembaga</th>
								<th>Nama</th>
								<th>Tahun Beridiri</th>
								<th>UMKM</th>
								<th>Pegawai</th>
								<th>Omset/bln</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
						<?php $no=1; ?>
							@foreach($data as $row)
							<tr>
								
								<td>{{$no++}}</td>
								<td>{{$row->id_sentra}}</td>
								<td>{{$row->lembagas->plut_name}}</td>
								<td>{{$row->name}}</td>
								<td>{{$row->tahun_berdiri}}</td>
								<td>{{$row->total_umkm}}</td>
								<td>{{$row->total_pegawai}}</td>
								<td>{{$row->omset_bulan}}</td>
								<td>
                                	<a href="{{ url('sentra/'.$row->id) }}" class="btn btn-success btn-xs"><i class="glyphicon glyphicon-edit"></i></a>
                                	<a href="{{ url('sentra/'.$row->id.'/delete') }}" onclick="return ConfirmDelete()" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i></a>
								</td>
							</tr>
							 @endforeach
						</tbody>

					</table>
				</div>


			</div>
		</div>
	</div>
@endsection