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
				<div class="col-md-12">
					<form  class="form-inline" method="get">
						<div class="form-group">
							<label for="">Tahun</label>
							<select class="form-control" onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value);">
								<option value="">Tahun...</option>
								<option value="/k/proker?tahun=2018" {{Request::input('tahun')=='2018'?'selected':''}}>2018</option>
								<option value="/k/proker?tahun=2019" {{Request::input('tahun')=='2019'?'selected':''}}>2019</option>
							</select>
						</div>
						<div class="form-group">
							<label for="">Proker Plut</label>
							<select class="form-control" name="proker_id">
								<option value="">Pilih Proker</option>
								@foreach ($proker as $p)
									<option value="{{$p->id}}" {{$proker_id==$p->id?'selected':''}}>{{$p->program}} ({{$p->tahun_kegiatan}})</option>
								@endforeach
							</select>
						</div>
						<button class="btn btn-info"><i class="fa fa-search"></i> Cari</button>
					</form>
				</div>
				<div class="box-body table-responsive">
						<table class="table table-bordered table-striped">
						<thead>
							<tr>
								<th class="col-xs-1">No</th>
								<th>Kegiatan</th>
								<th>Tujuan</th>
								<th>Sasaran</th>
								<th>Jumlah Sasaran</th>
								<th>Indikator</th>
								<th>Output</th>
								<th>Jadwal</th>
								<th>Mitra</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
						<?php $no = 1;?>
							@foreach($data as $row)
							<tr>
								<td>{{$no++}}</td>
								<td>{{$row->jenis_kegiatan}}</td>
								<td>{{$row->tujuan}}</td>
								<td>{{$row->sasaran}}</td>
								<td>{{$row->jml_penerima}}</td>
								<td>{{$row->indikator}}</td>
								<td>{{$row->ket_output}}</td>
								<td>{{$row->jadwal_pelaksana}}</td>
								<td>{{$row->mitra_kerja}}</td>
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
				<div class="text-center">
                {{$data->appends($_GET)->links()}}
            </div>

			</div>
		</div>
	</div>
@endsection