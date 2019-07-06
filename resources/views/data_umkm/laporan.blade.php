@extends('layouts.master')

@section('content')
	<div class="row">
		<div class="col-xs-12">
			@include('layouts.alert')
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">UMKM</h3>
				</div>
				<!-- / box Header -->
				<div class="box-body table-responsive">
					<form class="form-inline" style="padding-bottom: 10px;">
						<div class="form-group">
							<select class="form-control" name="tahun">
								<option value="">Pilih Tahun</option>
								<option value="2020" {{$tahun=='2020'?'selected':''}}>2020</option>
								<option value="2019" {{$tahun=='2019'?'selected':''}}>2019</option>
								<option value="2018" {{$tahun=='2018'?'selected':''}}>2018</option>
								<option value="2017" {{$tahun=='2017'?'selected':''}}>2017</option>
							</select>
						</div>
						<div class="form-group">
							<select class="form-control select2" name="lembaga_id">
								<option value="">Pilih Lembaga</option>
								@foreach ($lembaga as $row)
									<option value="{{$row->id}}" {{$lembaga_id==$row->id?'selected':''}}>{{$row->plut_name}}</option>
								@endforeach
							</select>
						</div>
						<button class="btn btn-success"><i class="fa fa-search"></i> Cari</button>
						<a href="{{ url('database-umkm-export?tahun='.$tahun.'&lembaga_id='.$lembaga_id) }}" class="btn btn-info"><i class="fa fa-file-excel-o"></i></a>
					</form>
						<table class="table table-bordered table-striped">
							<thead>
							<tr>
								<th rowspan="2">No</th>
								<th rowspan="2">Lembaga</th>
								<th rowspan="2">Nama UMKM</th>
								<th rowspan="2">Alamat</th>
								<th rowspan="2">Tahun<br>Mulai Usaha</th>
								<th rowspan="2">Jenis Usaha</th>
								<th rowspan="2">Legalitas</th>
								<th rowspan="2">Tenaga<br>Kerja(orang)</th>
								<th colspan="2">Permodalan</th>
								<th rowspan="2">Asset</th>
								<th rowspan="2">Omset</th>
								<th rowspan="2">Kegiatan Usaha</th>
							</tr>
							<tr>
								<th>Modal Sendiri</th>
								<th>Modal Luar</th>
							</tr>
							</thead>
							<tbody>
								<?php $no = ($data->currentpage() - 1) * $data->perpage() + 1;?>
								@foreach ($data as $row)
									<tr>
										<td>{{$no++}}</td>
										<td>{{$row->lembaga->plut_name}}</td>
										<td>{{$row->nama_usaha}}</td>
										<td>{{$row->alamat}}</td>
										<td>{{$row->tgl_mulai_usaha}}</td>
										<td>{{$row->bidangusaha?$row->bidangusaha->name:''}}</td>
										<td>{{$row->badan_usaha}}</td>
										<td>{{isset($row->kumkm_detail[0])?$row->kumkm_detail[0]->jml_tenaga_kerja:''}}</td>
										<td>{{isset($row->kumkm_detail[0])?number_format($row->kumkm_detail[0]->modal_sendiri):''}}</td>
										<td>{{isset($row->kumkm_detail[0])?number_format($row->kumkm_detail[0]->modal_hutang):''}}</td>
										<td>{{isset($row->kumkm_detail[0])?number_format($row->kumkm_detail[0]->asset):''}}</td>
										<td>{{isset($row->kumkm_detail[0])?number_format($row->kumkm_detail[0]->omset):''}}</td>
										<td>{{isset($row->kumkm_detail[0])?$row->kumkm_detail[0]->kegiatan_usaha:''}}</td>
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
