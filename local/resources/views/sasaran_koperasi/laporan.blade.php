@extends('layouts.master')

@section('content')
	<div class="row">
		<div class="col-xs-12">
			@include('layouts.alert')
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">Sasaran Program Pendampingan Koperasi</h3>
				</div>
				<!-- / box Header -->
				<div class="box-body table-responsive">
					<form class="form-inline" style="padding-bottom: 10px;">
						<div class="form-group">
							<select class="form-control" name="tahun">
								<option value="">Pilih Tahun</option>
								<option value="2018" {{$tahun=='2018'?'selected':''}}>2018</option>
								<option value="2017" {{$tahun=='2017'?'selected':''}}>2017</option>
							</select>
						</div>
						<button class="btn btn-success"><i class="fa fa-search"></i> Cari</button>
						<a href="{{ url('sasaran-koperasi-export?tahun='.$tahun) }}" class="btn btn-info"><i class="fa fa-file-excel-o"></i></a>
					</form>
					<div class="">
                                    <div>Showing {{($data->currentpage()-1)*$data->perpage()+1}} to {{$data->currentpage()*$data->perpage()}}
                                    of  {{$data->total()}} entries
                                    </div>
						<table class="table table-bordered table-striped">
							<thead>
							<tr>
								<th rowspan="2">No</th>
								<th rowspan="2">Lembaga</th>
								<th rowspan="2">Nama Koperasi</th>
								<th rowspan="2">Alamat</th>
								<th rowspan="2">Nomor dan Tanggal Badan Hukum</th>
								<th rowspan="2">Jenis Koperasi</th>
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
										<td>{{$no++}}</td>
										<td>{{$row->ukmtable->lembaga->plut_name}}</td>
										<td>{{$row->ukmtable->nama_koperasi}}</td>
										<td>{{$row->ukmtable->alamat}}</td>
										<td>{{$row->ukmtable->nomor_badan_hukum}} & {{date('d-m-Y',strtotime($row->ukmtable->tgl_badan_hukum))}}</td>
										<td>{{$row->ukmtable->jenis_koperasi}}</td>
										<td>{{isset($row->ukmtable->koperasi_detail[0])?date('d-m-Y',strtotime($row->ukmtable->koperasi_detail[0]->tgl_rat_tahun_buku)):''}}</td>
										<td>{{isset($row->ukmtable->koperasi_detail[0])?$row->ukmtable->koperasi_detail[0]->jml_anggota:''}}</td>
										<td>{{isset($row->ukmtable->koperasi_detail[0])?$row->ukmtable->koperasi_detail[0]->jml_karyawan:''}}</td>
										<td>{{isset($row->ukmtable->koperasi_detail[0])?number_format($row->ukmtable->koperasi_detail[0]->jml_asset):''}}</td>
										<td>{{isset($row->ukmtable->koperasi_detail[0])?number_format($row->ukmtable->koperasi_detail[0]->jml_modal_sendiri):''}}</td>
										<td>{{isset($row->ukmtable->koperasi_detail[0])?number_format($row->ukmtable->koperasi_detail[0]->jml_modal_luar):''}}</td>
										<td>{{isset($row->ukmtable->koperasi_detail[0])?number_format($row->ukmtable->koperasi_detail[0]->valume_usaha):''}}</td>
										<td>{{isset($row->ukmtable->koperasi_detail[0])?number_format($row->ukmtable->koperasi_detail[0]->sisa_hasil):''}}</td>
										<td>{{isset($row->ukmtable->koperasi_detail[0])?$row->ukmtable->koperasi_detail[0]->kegiatan_usaha:''}}</td>
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

@section('script')
<script src="{{url('js/jquery.printPage.js')}}"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $('.btn-print').printPage();

        $(".delete").on("submit", function(){
            return confirm("Apakah kamu yakin dengan data ini?");
        });

        $(".lockform").on("submit", function(){
            return confirm("Apakah kamu yakin Lock data ini?");
        });
    });
</script>
@endsection
