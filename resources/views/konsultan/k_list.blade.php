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
						<a class="btn btn-info" href="{{ url('konsultan/report') }}">Report</a>
						<a class="btn btn-success" href="{{ url('konsultan/create') }}">Tambah Data</a>
					</div>
				</div>
				<!-- / box Header -->
				<div class="box-body table-responsive">
						<table class="table table-bordered table-striped datatables-class">
						<thead>
							<tr>
								<th class="col-xs-1">ID</th>
								<th>No Registrasi</th>
								<th>Nama Lengkap</th>
								<th>Jenis Kelamin</th>
								<th>Telepon</th>
								<th>Email</th>
								<th>Program Kerja</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							@foreach($konsultan as $row)
							<tr>
								<td>{{$row->id}}</td>
								<td>{{$row->no_registrasi}}</td>
								<td>{{$row->nama_lengkap}}</td>
								<td>{{$row->jenis_kelamin}}</td>
								<td>{{$row->telepon}}</td>
								<td>{{$row->email}}</td>
								<td>
									<a href="{{ url('konsultan/'.$row->id.'/proker') }}" class="btn btn-info btn-xs"><i class="glyphicon glyphicon-list-alt"></i> Proker</a>
								</td>
								<td>
									<a href="{{ url('konsultan/'.$row->id.'/detail') }}" class="btn btn-success btn-xs"><i class="glyphicon glyphicon-list"></i></a>
                                	<a href="{{ url('konsultan/'.$row->id) }}" class="btn btn-success btn-xs"><i class="glyphicon glyphicon-edit"></i></a>
                                	<a href="{{ url('konsultan/'.$row->id.'/delete') }}" onclick="return ConfirmDelete()" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i></a>
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