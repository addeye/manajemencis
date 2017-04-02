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
					@if(Auth::user()->role_id ==1)
					<div class="pull-right">
						<a class="btn btn-primary" href="{{ url('bidangusaha/create') }}">
							<i class="fa fa-plus"></i> Tambah Data
						</a>
					</div>
					@endif
				</div>
				<!-- / box Header -->
				<div class="box-body">
						<table id="example" class="table table-bordered table-striped">
						<thead>
							<tr>
								<th class="col-xs-1">No</th>
								<th class="col-xs-1">Urutan</th>
								<th>Nama Bidang Usaha</th>
								@if(Auth::user()->role_id ==1)
								<th>Aksi</th>
								@endif
								
							</tr>
						</thead>
						<tbody>
							@foreach($bidangusaha as $row)
							<tr>
								
								<td>{{$row->id}}</td>
								<td>{{$row->urutan}}</td>
								<td>{{$row->name}}</td>
								@if(Auth::user()->role_id ==1)
								<td>
                                	<a href="{{ url('bidangusaha/'.$row->id) }}" class="btn btn-success btn-xs" data-toggle="tooltip" data-placement="left" title="Edit Data {{$row->name}}">
										<i class="glyphicon glyphicon-edit"></i>
									</a>
                                	<a href="{{ url('bidangusaha/'.$row->id.'/delete') }}" onclick="return ConfirmDelete()" class="btn btn-danger btn-xs" data-toggle="tooltip" data-placement="left" title="Hapus Data {{$row->name}}">
										<i class="glyphicon glyphicon-trash"></i>
									</a>
								</td>
								@endif
							</tr>
							 @endforeach
						</tbody>

					</table>
				</div>


			</div>
		</div>
	</div>
@endsection