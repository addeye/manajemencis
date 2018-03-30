@extends('layouts.master')

@section('content')
	<div class="row">
		<div class="col-xs-12">
			@include('layouts.alert')
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">Koperasi</h3>
					<div class="pull-right">
						<a class="btn btn-primary" href="{{ url('koperasi/create') }}">
							<i class="fa fa-plus"></i> Tambah Data
						</a>
					</div>
				</div>
				<!-- / box Header -->
				<div class="box-body table-responsive">
					<form class="form-inline" style="padding-bottom: 10px;">
						<div class="form-group">
							<input type="text" class="form-control" placeholder="Ketik Nama Koperasi" name="byname" value="{{$byname}}">
						</div>
						<button class="btn btn-success"><i class="fa fa-search"></i> Cari</button>
					</form>
					<div class="">
                                    <div>Showing {{($data->currentpage()-1)*$data->perpage()+1}} to {{$data->currentpage()*$data->perpage()}}
                                    of  {{$data->total()}} entries
                                    </div>
						<table class="table table-bordered table-striped">
							<thead>
							<tr>
								<th rowspan="2"></th>
								<th rowspan="2">No</th>
								<th rowspan="2">Nama Koperasi</th>
								<th rowspan="2">Alamat</th>
								<th rowspan="2">Nomor dan Tanggal Badan Hukum</th>
								<th rowspan="2">Jenis Koperasi</th>
								<th rowspan="2">Tanggal Keadaan</th>
								<th rowspan="2">Tanggal RAT Tahun Buku</th>
								<th rowspan="2">Anggota</th>
								<th rowspan="2">Karyawan</th>
								<th rowspan="2">Asset</th>
								<th colspan="2">Permodalan</th>
								<th rowspan="2">Volume Usaha</th>
								<th rowspan="2">Sisa Hasil Usaha</th>
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
										<td><a href="{{ url('koperasi/'.$row->id) }}" class="btn btn-info btn-xs"><i class="fa fa-eye"></i></a></td>
										<td>{{$no++}}</td>
										<td>{{$row->nama_koperasi}}</td>
										<td>{{$row->alamat}}</td>
										<td>{{$row->nomor_badan_hukum}} / {{date('d-m-Y',strtotime($row->tgl_badan_hukum))}}</td>
										<td>{{$row->jenis_koperasi}}</td>
										<td>{!! isset($row->koperasi_detail[0])?'<b>'.date('d-m-Y',strtotime($row->koperasi_detail[0]->tanggal_keadaan)).'</b>':'' !!}</td>
										<td>{{isset($row->koperasi_detail[0])?date('d-m-Y',strtotime($row->koperasi_detail[0]->tgl_rat_tahun_buku)):''}}</td>
										<td align="right">{{isset($row->koperasi_detail[0])?number_format($row->koperasi_detail[0]->jml_anggota):''}}</td>
										<td align="right">{{isset($row->koperasi_detail[0])?number_format($row->koperasi_detail[0]->jml_karyawan):''}}</td>
										<td align="right">{{isset($row->koperasi_detail[0])?number_format($row->koperasi_detail[0]->jml_asset):''}}</td>
										<td align="right">{{isset($row->koperasi_detail[0])?number_format($row->koperasi_detail[0]->jml_modal_sendiri):''}}</td>
										<td align="right">{{isset($row->koperasi_detail[0])?number_format($row->koperasi_detail[0]->jml_modal_luar):''}}</td>
										<td align="right">{{isset($row->koperasi_detail[0])?number_format($row->koperasi_detail[0]->volume_usaha):''}}</td>
										<td align="right">{{isset($row->koperasi_detail[0])?number_format($row->koperasi_detail[0]->sisa_hasil):''}}</td>
										<td>{{isset($row->koperasi_detail[0])?$row->koperasi_detail[0]->kegiatan_usaha:''}}</td>
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
