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
						<a class="btn btn-primary" href="{{ url('k/proker/create') }}">
							<i class="fa fa-plus"></i> Tambah Data
						</a>
					</div>
				</div>
				<!-- / box Header -->
				<div class="box-body table-responsive">
						<table id="example" class="table table-bordered table-striped">
						<thead>
							<tr>
								<th class="col-xs-1">No</th>
								<th>Tahun Kegiatan</th>
								<th>Program</th>
								<th>Tujuan</th>
								<th>Detail</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
						<?php $no=1;?>
							@foreach($data as $row)
							<tr>
								<td>{{$no++}}</td>
								<td>{{$row->tahun_kegiatan}}</td>
								<td>{{$row->program}}</td>
								<td>{{$row->tujuan}}</td>
								<td>
									<a href="{{ url('k/dproker/'.$row->id) }}" class="btn btn-info btn-xs" data-toggle="tooltip" data-placement="left" title="Detail Kegiatan Proker">
										Detail
									</a>
								</td>
								<td>
                                	<a href="{{ url('k/proker/'.$row->id) }}" class="btn btn-success btn-xs" data-toggle="tooltip" data-placement="left" title="Edit Data">
										<i class="glyphicon glyphicon-edit"></i>
									</a>
                                	<a href="{{ url('k/proker/'.$row->id.'/delete') }}" onclick="return ConfirmDelete()" class="btn btn-danger btn-xs" data-toggle="tooltip" data-placement="left" title="Hapus Data">
										<i class="glyphicon glyphicon-trash"></i>
									</a>
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