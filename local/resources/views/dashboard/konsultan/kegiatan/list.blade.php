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
						<a class="btn btn-primary" href="{{ url('k/kegiatan/create') }}">Tambah Data</a>
					</div>
				</div>
				<!-- / box Header -->
				<div class="box-body table-responsive">
						<table id="example" class="table table-bordered table-striped">
						<thead>
							<tr>
								<th class="col-xs-1">ID</th>
								<th>Tanggal Mulai</th>
								<th>Tanggal Selesai</th>
								<th>Nama Kegiatan</th>
								<th>IKU</th>
								<th>Bidang Usaha</th>
								<th>Lokasi Kegiatan</th>
								<th>Jumlah Peserta</th>
								<th>Output</th>
								<th>Sumber Daya</th>
								<th>Mitra Kegiatan</th>
								<th>Rencana Tindak Lanjut</th>
								<th>Action</th>
								
							</tr>
						</thead>
						<tbody>
							@foreach($data as $row)
							<tr>
								<td>{{$row->id}}</td>
								<td>{{$row->tanggal_mulai}}</td>
								<td>{{$row->tanggal_selesai}}</td>
								<td>{{$row->detail_proker->jenis_kegiatan}}</td>
								<td>{{$row->jenis_layanans->name}}</td>
								<td>{{$row->bidang_usahas->name}}</td>
								<td>{{$row->lokasi_kegiatan}}</td>
								<td>{{$row->jumlah_peserta}}</td>
								<td>{{$row->output}}</td>
								<td>{{$row->sumber_daya}}</td>
								<td>{{$row->mitra_kegiatan}}</td>
								<td>{{$row->rencana_tindak_lanjut}}</td>
								<td>
                                	<a href="{{ url('k/kegiatan/'.$row->id) }}" class="btn btn-success btn-xs"><i class="glyphicon glyphicon-edit"></i></a>
                                	<a href="{{ url('k/kegiatan/'.$row->id.'/delete') }}" onclick="return ConfirmDelete()" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i></a>
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