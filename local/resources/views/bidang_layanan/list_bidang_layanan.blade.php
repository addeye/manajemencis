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
						<a class="btn btn-primary" href="{{ url('bidanglayanan/create') }}">Tambah Data</a>
					</div>
				</div>
				<!-- / box Header -->
				<div class="box-body">
						<table id="example" class="table table-bordered table-striped">
						<thead>
							<tr>
								<th class="col-xs-1">Kode</th>
								<th>Name</th>
								<th>Aksi</th>
								
							</tr>
						</thead>
						<tbody>
							@foreach($bidanglayanan as $row)
							<tr>
								
								<td>{{$row->id}}</td>
								<td>{{$row->name}}</td>
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

@section('css')
	<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.2.4/css/buttons.bootstrap.min.css">
@endsection

@section('script')
	<script>
		$(document).ready(function() {
			var table = $('#example').DataTable( {
				"paging": true,
				"lengthChange": true,
				"searching": true,
				"ordering": false,
				"bSortable": true,
				"info": true,
				"autoWidth": false,
				buttons: [
					{
						extend: 'pdf',
						exportOptions: {
							columns: ':visible'
						}
					},
					{
						extend: 'excel',
						exportOptions: {
							columns: ':visible'
						}
					},
					{
						extend: 'print',
						exportOptions: {
							columns: ':visible'
						}
					},
					{
						extend: 'colvis',
						collectionLayout: 'fixed two-column',
						text: 'Filter Kolom'
					}
				],
			} );

			table.buttons().container()
					.appendTo( '#example_wrapper .col-sm-6:eq(0)' );
		} );
	</script>
@endsection