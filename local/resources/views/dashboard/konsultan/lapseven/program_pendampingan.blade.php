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
							<select class="form-control" name="tahun">
								<option value="">Pilih Tahun</option>
								<option value="2020" {{Request::get('tahun')=='2020'?'selected':''}}>2020</option>
								<option value="2019" {{Request::get('tahun')=='2019'?'selected':''}}>2019</option>
								<option value="2018" {{Request::get('tahun')=='2018'?'selected':''}}>2018</option>
								<option value="2017" {{Request::get('tahun')=='2017'?'selected':''}}>2017</option>
							</select>
						</div>
                        <div class="form-group">
							<select class="form-control select2" name="sasaran_program_id">
								<option value="">Pilih Koperasi / UMKM </option>
								@foreach ($sasaran_program as $row)
									<option value="{{$row->id}}" {{$row->id==Request::get('sasaran_program_id')?'selected':''}}>{{$row->ukmtable->nama_kumkm}}</option>
								@endforeach
							</select>
						</div>
                    <button type="submit" class="btn btn-success"><i class="fa fa-search"></i> {{!is_null(Request::get('lembaga_id'))?'Lanjutkan':'Cari'}}</button>
                    </form>
                    @if (Request::get('tahun') && Request::get('sasaran_program_id'))
                <div class="table-responsive">
                    <p><a target="_blank" href="{{url('kons/laporan-program-pendampingan-print?tahun='.Request::get('tahun').'&sasaran_program_id='.Request::get('sasaran_program_id'))}}" class="btn btn-danger"><i class="fa fa-print"></i> Print</a></p>
                			<h4>KARTU PROGRAM KERJA PLUT KUMKM {{$title}}</h4>
                    <h4>PER INDIVIDU KOPERASI DAN UMKM SELAMA {{Request::get('tahun')}}</h4>
						<p>NAMA KOPERASI DAN UMKM : {{$kumkm->ukmtable->nama_kumkm}}</p>
                    <table class="table table-bordered table-striped">
							<thead>
							<tr>
								<th>No</th>
								<th>Identifikasi Permasalahan <br> (Per Bidang Layanan)</th>
								<th>Program Kerja Pendampingan Tahun <br>{{date('Y')}}</th>
								<th>Target Capaian</th>
								<th>Konsultan Pendamping Penanggung Jawab</th>
							</tr>
							</thead>
							<tbody>
								@foreach ($data as $key=>$row)
									<tr>
										<td>{{$key+1}}</td>
										<td>{{$row->permasalahan}}</td>
										<td>{{$row->proker_pendampingan}}</td>
										<td>{{$row->target_capaian}}</td>
										<td>{{$row->bidang_layanan->name}}</td>
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
