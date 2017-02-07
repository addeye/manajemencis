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
				<div class="box-body table-responsive">
						<table class="table table-bordered table-striped datatables-class">
						<thead>
							<tr>
								<th class="col-xs-1">ID</th>
								<th>Tahun Kegiatan</th>
								<th>Nama Program</th>
								<th>Tujuan</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							@foreach($data as $row)
							<tr>
								<td>{{$row->id}}</td>
								<td>{{$row->tahun_kegiatan}}</td>
								<td>{{$row->program}}</td>
								<td>{{$row->tujuan}}</td>
								<td>
									<a href="{{ url('konsultan/proker/'.$row->id.'/detail') }}" class="btn btn-success btn-xs"><i class="glyphicon glyphicon-list"></i></a>
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