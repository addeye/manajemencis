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
							<input type="text" class="form-control" placeholder="Ketik Nama Koperasi" name="byname" value="{{$byname}}">
						</div>
						<button class="btn btn-success"><i class="fa fa-search"></i> Cari</button>
						<a href="{{ url('data-kumkm-export?byname='.$byname) }}" class="btn btn-info"><i class="fa fa-file-excel-o"></i></a>
					</form>
						<table class="table table-bordered table-striped">
							<thead>
							<tr>
								<th rowspan="2">No</th>
								<th rowspan="2">Nama UMKM</th>
								<th rowspan="2">Alamat</th>
								<th rowspan="2">Tahun<br>Mulai Usaha</th>
								<th rowspan="2">Jenis Usaha</th>
								<th rowspan="2">Legalitas</th>
								<th rowspan="2">Tanggal Keadaan</th>
								<th rowspan="2">Tenaga<br>Kerja(orang)</th>
								<th colspan="2">Permodalan</th>
								<th rowspan="2">Asset</th>
								<th rowspan="2">Omset</th>
								<th rowspan="2">Kegiatan Usaha</th>
							</tr>
							<tr>
								<th>Modal Sendiri</th>
								<th>Modal Hutang</th>
							</tr>
							</thead>
							<tbody>
								<?php $no = ($data->currentpage() - 1) * $data->perpage() + 1;?>
								@foreach ($data as $row)
									<tr>
										<td>{{$no++}}</td>
										<td>{{$row->nama_usaha}}</td>
										<td>{{$row->alamat}}</td>
										<td>{{$row->tgl_mulai_usaha}}</td>
										<td>{{$row->bidangusaha?$row->bidangusaha->name:''}}</td>
										<td>{{$row->badan_usaha}}</td>
										<td>{!! isset($row->kumkm_detail[0])?'<b>'.date('d-m-Y',strtotime($row->kumkm_detail[0]->tanggal_keadaan)).'</b>':'' !!}</td>

										<td align="right">{{isset($row->kumkm_detail[0])?number_format($row->kumkm_detail[0]->jml_tenaga_kerja):''}}</td>

										<td align="right">{{isset($row->kumkm_detail[0])?number_format($row->kumkm_detail[0]->modal_sendiri):''}}</td>

										<td align="right">{{isset($row->kumkm_detail[0])?number_format($row->kumkm_detail[0]->modal_hutang):''}}</td>

										<td align="right">{{isset($row->kumkm_detail[0])?number_format($row->kumkm_detail[0]->asset):''}}</td>

										<td align="right">{{isset($row->kumkm_detail[0])?number_format($row->kumkm_detail[0]->omset):''}}</td>

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
