@extends('layouts.master')

@section('content')
	<div class="row">
		<div class="col-xs-12">
			@include('layouts.alert')
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">Laporan Triwulan Kartu Pelaksanaan Pendampingan Koperasi Dan UMK</h3>
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
							<select class="form-control" name="triwulan">
								<option value="">Pilih Triwulan</option>
								<option value="1" {{$triwulan==1?'selected':''}}>Triwulan 1 (Jan-Mar)</option>
								<option value="2" {{$triwulan==2?'selected':''}}>Triwulan 2 (Apr-Jun)</option>
								<option value="3" {{$triwulan==3?'selected':''}}>Triwulan 3 (Jul-Sept)</option>
								<option value="4" {{$triwulan==4?'selected':''}}>Triwulan 4 (Okt-Des)</option>
							</select>
						</div>

						<button type="submit" class="btn btn-success"><i class="fa fa-search"></i> Cari</button>
						<a href="{{ url('adm/pelaksanaan-pendampingan-laporan-triwulan') }}" class="btn btn-warning"><i class="fa fa-refresh"></i></a>
						<a href="{{ url('adm/pelaksanaan-pendampingan-laporan-triwulan-export?triwulan='.$triwulan.'&tahun='.$tahun) }}" class="btn btn-info"><i class="fa fa-file-excel-o"></i></a>
					</form>
						<div class="">
                                    <div>Showing {{($data->currentpage()-1)*$data->perpage()+1}} to {{$data->currentpage()*$data->perpage()}}
                                    of  {{$data->total()}} entries
                                    </div>
						<table class="table table-bordered table-striped">
							<thead>
							<tr>
								<th rowspan="2">No</th>
								<th rowspan="2">Konsultan</th>
								<th rowspan="2">Nama KUMKM</th>
								<th rowspan="2">Identifikasi Permsalahan<br>(Per Bidang Layanan)</th>
								<th rowspan="2">Program Kerja Pendampingan</th>
								<th colspan="2">Pelaksanaan Pendampingan</th>
								<th rowspan="2">Skema Tindakan Lebih Lanjut</th>
							</tr>
							<tr>
								<th>Tgl/Bln/Thn</th>
								<th>Materi Pendampingan</th>
							</tr>
							</thead>
							<tbody>
								<?php $no = ($data->currentpage() - 1) * $data->perpage() + 1;?>
								@foreach ($data as $row)
									<tr>
										<td>{{$no++}}</td>
										<td>{{$row->konsultans->nama_lengkap}}</td>
										<td>{{$row->nama_kumkm}}</td>
										<td>{{$row->program_kerja->permasalahan}}</td>
										<td>{{$row->program_kerja->proker_pendampingan}}</td>
										<td>{{date('d/m/Y',strtotime($row->tanggal))}}</td>
										<td>{{$row->materi}}</td>
										<td>{{$row->tindak_lanjut}}</td>
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
	</div>
@endsection
