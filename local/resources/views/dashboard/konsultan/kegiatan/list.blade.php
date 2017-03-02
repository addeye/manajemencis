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
								<th class="col-xs-1">No</th>
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
						<?php $no=1; ?>
							@foreach($data as $row)
							<tr>
								<td>{{$no++}}</td>
								<td>{{date('d-m-Y', strtotime($row->tanggal_mulai))}}</td>
								<td>{{date('d-m-Y',strtotime($row->tanggal_selesai))}}</td>
								<td>{{$row->detail_proker?$row->detail_proker->jenis_kegiatan:''}}</td>
								<td>{{$row->detail_proker->jenis_layanans->name}}</td>
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