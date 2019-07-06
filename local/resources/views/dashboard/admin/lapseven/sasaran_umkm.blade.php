@extends('layouts.master')

@section('content')
	<div class="row">
		<div class="col-xs-12">
			@include('layouts.alert')
			<div class="box">
				<div class="box-header">
                        <h3 class="box-title">Sasaran Program Pendampingan UMKM</h3>
				</div>
				<!-- / box Header -->
				<div class="box-body table-responsive">
					<form class="form-inline" style="padding-bottom: 10px;">
						<div class="form-group">
							<select class="form-control" name="tahun">
								<option value="">Pilih Tahun</option>
								<option value="2020" {{Request::get('tahun')=='2020'?'selected':''}}>2020</option>
								<option value="2019" {{Request::get('tahun')=='2019'?'selected':''}}>2019</option>
								<option value="2018" {{Request::get('tahun')=='2018'?'selected':''}}>2018</option>
								<option value="2017" {{Request::get('tahun')=='2017'?'selected':''}}>2017</option>
							</select>
						</div>
						<button class="btn btn-success"><i class="fa fa-search"></i> Cari</button>
                    </form>
                    @if (Request::get('tahun'))
                <div class="table-responsive">
                    <p><a target="_blank" href="{{url('adm/laporan-pendampingan-sasaran-umkm-print?tahun='.Request::get('tahun'))}}" class="btn btn-danger"><i class="fa fa-print"></i> Print</a></p>
                <h4>DATA USAHA MIKRO DAN KECIL SASARAN PROGRAM PENDAMPINGAN {{Request::get('tahun')}}</h4>
                <h4>{{$title}}</h4>
                    <h4>KEADAAN : 31 Desember {{Request::get('tahun')-1}}</h4>
					<table class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th rowspan="2">No</th>
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
                            @foreach ($baseumkm as $key=>$row)
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>{{$row->ukmtable->nama_usaha}}</td>
                                    <td>{{$row->ukmtable->alamat}}</td>
                                    <td>{{$row->ukmtable->tgl_mulai_usaha}}</td>
                                    <td>{{$row->ukmtable->bidangusaha?$row->ukmtable->bidangusaha->name:''}}</td>
                                    <td>{{$row->ukmtable->badan_usaha}}</td>
                                    <td>{{isset($row->ukmtable->kumkm_detail[0])?$row->ukmtable->kumkm_detail[0]->jml_tenaga_kerja:''}}</td>
                                    <td>{{isset($row->ukmtable->kumkm_detail[0])?number_format($row->ukmtable->kumkm_detail[0]->modal_sendiri):''}}</td>
                                    <td>{{isset($row->ukmtable->kumkm_detail[0])?number_format($row->ukmtable->kumkm_detail[0]->modal_hutang):''}}</td>
                                    <td>{{isset($row->ukmtable->kumkm_detail[0])?number_format($row->ukmtable->kumkm_detail[0]->asset):''}}</td>
                                    <td>{{isset($row->ukmtable->kumkm_detail[0])?number_format($row->ukmtable->kumkm_detail[0]->omset):''}}</td>
                                    <td>{{isset($row->ukmtable->kumkm_detail[0])?$row->ukmtable->kumkm_detail[0]->kegiatan_usaha:''}}</td>
                                </tr>
                            @endforeach
                        </tbody>
					</table>
                </div>
                @endif
			</div>
		</div>
	</div>
@endsection