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
					<h3 class="box-title">{{$title}} {{date('Y')}}</h3>
				</div>
				<!-- / box Header -->
				<div class="col-md-12">
					<form  class="form-inline" method="get">
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
					<div>Showing {{($data->currentpage()-1)*$data->perpage()+1}} to {{$data->currentpage()*$data->perpage()}}
                                    of  {{$data->total()}} entries
                                    </div>
						<table class="table table-bordered table-striped">
						<thead>
							<tr>
								<th class="col-xs-1">No</th>
								<th>Konsultan</th>
								<th>Kegiatan</th>
								<th>Tujuan</th>
								<th>Sasaran</th>
								<th>Jumlah Sasaran</th>
								<th>Indikator</th>
								<th>Output</th>
								<th>Jadwal</th>
								<th>Mitra</th>
							</tr>
						</thead>
						<tbody>
						<?php $no = ($data->currentpage() - 1) * $data->perpage() + 1;?>
							@foreach($data as $row)
							<tr>
								<td>{{$no++}}</td>
								<td>{{$row->konsultans->nama_lengkap}}</td>
								<td>{{$row->jenis_kegiatan}}</td>
								<td>{{$row->tujuan}}</td>
								<td>{{$row->sasaran}}</td>
								<td>{{$row->jml_penerima}}</td>
								<td>{{$row->indikator}}</td>
								<td>{{$row->ket_output}}</td>
								<td>{{$row->jadwal_pelaksana}}</td>
								<td>{{$row->mitra_kerja}}</td>
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