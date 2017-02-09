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
						<table id="example" class="table table-bordered table-striped">
						<thead>
							<tr>
								<th class="col-xs-1">ID</th>
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
							@foreach($data as $row)
							<tr>
								<td>{{$row->id}}</td>
								<td>{{$row->id_sentra}}</td>
								<td>{{$row->lembagas->name}}</td>
								<td>{{$row->name}}</td>
								<td>{{$row->tahun_berdiri}}</td>
								<td>{{$row->total_umkm}}</td>
								<td>{{$row->total_pegawai}}</td>
								<td>{{$row->omset_bulan}}</td>
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
	<script src="https://cdn.datatables.net/buttons/1.2.4/js/dataTables.buttons.min.js"></script>
	<script src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.bootstrap.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
	<script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
	<script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
	<script src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.html5.min.js"></script>
	<script src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.print.min.js"></script>
	<script src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.colVis.min.js"></script>
	<script>
		$(document).ready(function() {
			var table = $('#example').DataTable( {
				lengthChange: false,
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
						collectionLayout: 'fixed two-column'
					}
				],
			} );

			table.buttons().container()
					.appendTo( '#example_wrapper .col-sm-6:eq(0)' );
		} );
	</script>
@endsection