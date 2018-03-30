@extends('layouts.master')

@section('content')
	<div class="row">
		<div class="col-xs-12">
			@include('layouts.alert')
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">Kartu Program Kerja PLUT KUMKM</h3>
				</div>
				<!-- / box Header -->
				<div class="box-body table-responsive">
					<form class="form-inline" style="padding-bottom: 10px;">
						<div class="form-group">
							<select class="form-control select2" name="sasaran_program_id">
								<option value="">Pilih Koperasi / UMKM </option>
								@foreach ($sasaran_program as $row)
									<option value="{{$row->id}}" {{$row->id==$sasaran_program_id?'selected':''}}>{{$row->ukmtable->nama_kumkm}}</option>
								@endforeach
							</select>
						</div>
						<button class="btn btn-success"><i class="fa fa-search"></i> Cari</button>
						<a href="{{ url('adm/program-kerja-laporan') }}" class="btn btn-warning"><i class="fa fa-refresh"></i></a>
						<a href="{{ url('adm/program-kerja-export?sasaran_program_id='.$sasaran_program_id) }}" class="btn btn-info"><i class="fa fa-file-excel-o"></i></a>
					</form>
					<div class="">
		                <div>Showing {{($data->currentpage()-1)*$data->perpage()+1}} to {{$data->currentpage()*$data->perpage()}}
		                of  {{$data->total()}} entries
		                </div>

		                <table class="table table-bordered table-striped">
							<thead>
							<tr>
								<th>No</th>
								<th>KUMKM</th>
								<th>Identifikasi Permasalahan <br> (Per Bidang Layanan)</th>
								<th>Program Kerja Pendampingan Tahun <br>{{date('Y')}}</th>
								<th>Target Capaian</th>
								<th>Konsultasi Pendamping Penanggung Jawab</th>
							</tr>
							</thead>
							<tbody>
								<?php $no = ($data->currentpage() - 1) * $data->perpage() + 1;?>
								@foreach ($data as $row)
									<tr>
										<td>{{$no++}}</td>
										<td>{{$row->sasaran_program->ukmtable->nama_kumkm}}</td>
										<td>{{$row->permasalahan}}</td>
										<td>{{$row->proker_pendampingan}}</td>
										<td>{{$row->target_capaian}}</td>
										<td>{{$row->bidang_layanan->name}}</td>
									</tr>
								@endforeach
							</tbody>
					</table>

						<div class="text-right">
		                    {{$data->appends($_GET)->links()}}
		                </div>
				</div>


			</div>
		</div>
	</div>
@endsection