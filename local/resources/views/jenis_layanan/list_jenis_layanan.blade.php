<?php

/**
 * Created by Sublime
 * User: Dio Putra
 * Date: 29/01/2017
 * Time: 01:32
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
						<a class="btn btn-primary" href="{{ url('jenislayanan/create') }}">
							<i class="fa fa-plus"></i> Tambah Data
						</a>
					</div>
				</div>

				<!-- / box Header -->
				<div class="box-body">
						<table id="example" class="table table-bordered table-striped">
						<thead>
							<tr>
								<th class="col-xs-1">No</th>
								<th>Nama Bidang Layanan</th>
								<th>Nama IKU</th>
								<th>Ket</th>
								<th>Aksi</th>
								
							</tr>
						</thead>

						<tbody>
						<?php $no=1; ?>
							@foreach($jenislayanan as $row)
							<tr>
								
								<td>{{$no++}}</td>
								<td>{{$row->bidang_layanan->name}}</td>
								<td>{{$row->name}}</td>
								<td>{{$row->proses_or_output}}</td>
								<td>
									<a href="{{ url('jenislayanan/'.$row->id) }}" class="btn btn-success btn-xs"><i class="glyphicon glyphicon-edit"></i></a>
									<a href="{{ url('jenislayanan/'.$row->id.'/delete') }}" onclick="return ConfirmDelete()" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i></a>
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