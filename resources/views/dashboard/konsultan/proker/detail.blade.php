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
					<small>{{$title}}</small>
					<h3 class="box-title">{{ $data->tahun_kegiatan }} {{ $data->program }}</h3>
					<div class="pull-right">
						<a href="{{ url('bidanglayanan/create') }}">Tambah Data</a>
					</div>
				</div>
				<!-- / box Header -->
				<div class="box-body">
						<table class="table table-bordered table-striped datatables-class">
						<thead>
							<tr>
								<th class="col-xs-1">ID</th>
								<th>Jenis Kegiatan</th>
								<th>Tujuan</th>
								<th>IKU</th>
								<th>Output/Ket</th>
								<th>Penerima</th>
								<th>Anggaran</th>
								<th>Jadwal Pelaksana</th>
								<th>Mitra Kerja</th>
							</tr>
						</thead>
						<tbody>
							@foreach($data->details_proker as $row)
							<tr>
								
								<td>{{$row->id}}</td>
								<td>{{$row->jenis_kegiatan}}</td>
								<td>{{$row->tujuan}}</td>
								<td>{{$row->jenis_layanans->name}}</td>
								<td>{{$row->output}} / {{$row->ket_output}}</td>
								<td>{{$row->jml_penerima}}</td>
								<td>{{$row->anggaran}}</td>
								<td>{{$row->jadwal_pelaksana}}</td>
								<td>{{$row->mitra_kerja}}</td>
								<td>
                                	<a href="{{ url('bidanglayanan/'.$row->id) }}" class="btn btn-success btn-xs"><i class="glyphicon glyphicon-edit"></i></a>
                                	<a href="{{ url('bidanglayanan/'.$row->id.'/delete') }}" onclick="return ConfirmDelete()" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i></a>
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