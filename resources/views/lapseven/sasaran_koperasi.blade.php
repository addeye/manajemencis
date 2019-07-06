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
								<option value="2020" {{Request::get('tahun')=='2020'?'selected':''}}>2020</option>
								<option value="2019" {{Request::get('tahun')=='2019'?'selected':''}}>2019</option>
								<option value="2018" {{Request::get('tahun')=='2018'?'selected':''}}>2018</option>
								<option value="2017" {{Request::get('tahun')=='2017'?'selected':''}}>2017</option>
							</select>
						</div>
						<div class="form-group">
							<select class="form-control select2" name="lembaga_id">
								<option value="">Pilih Lembaga</option>
								@foreach ($lembaga as $row)
									<option value="{{$row->id}}" {{Request::get('lembaga_id')==$row->id?'selected':''}}>{{$row->plut_name}}</option>
								@endforeach
							</select>
						</div>
						<button class="btn btn-success"><i class="fa fa-search"></i> Cari</button>
                    </form>
                    @if (Request::get('tahun') && Request::get('lembaga_id'))
                <div class="table-responsive">
                    <p><a target="_blank" href="{{url('laporan-pendampingan-sasaran-koperasi-print?tahun='.Request::get('tahun').'&lembaga_id='.Request::get('lembaga_id'))}}" class="btn btn-danger"><i class="fa fa-print"></i> Print</a></p>
                    <h4>DATA KOPERASI SASARAN PROGRAM PENDAMPINGAN TAHUN {{Request::get('tahun')}}</h4>
                    <h4>{{$title}}</h4>
                    <h4>KEADAAN : 31 Desember {{Request::get('tahun')-1}}</h4>
						<table class="table table-bordered table-striped">
							<thead>
							<tr>
								<th rowspan="2">No</th>
								<th rowspan="2">Nama Koperasi</th>
								<th rowspan="2">Alamat</th>
								<th rowspan="2">Nomor dan <br> Tanggal <br> Badan Hukum</th>
								<th rowspan="2">Jenis Koperasi</th>
                                <th rowspan="2">Tanggal<br>RAT<br>Tahun<br>Buku<br>{{Request::get('tahun')-1}}</th>
								<th rowspan="2">Anggota<br>(orang)</th>
								<th rowspan="2">Karyawan<br>(orang)</th>
								<th rowspan="2">Asset<br>(Rp.)</th>
								<th colspan="2">Permodalan (Rp.)</th>
								<th rowspan="2">Volume<br>Usaha (Rp.)</th>
								<th rowspan="2">Sisa Hasil<br>Usaha<br>(Rp.)</th>
								<th rowspan="2">Kegiatan Usaha</th>
							</tr>
							<tr>
								<th>Modal Sendiri</th>
								<th>Modal Luar</th>
							</tr>
							</thead>
							<tbody>
                                @foreach ($basekoperasi as $key=>$row)
                                <tr>
                                    <td>{{$key+1}}</td>
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
                </div>
                @endif
			</div>
		</div>
	</div>
@endsection
