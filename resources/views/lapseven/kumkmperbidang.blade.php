@extends('layouts.master')

@section('content')
	<div class="row">
		<div class="col-xs-12">
			@include('layouts.alert')
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">KUMKM Per Bidang</h3>
				</div>
				<!-- / box Header -->
				<div class="box-body table-responsive">
                    <form class="form-inline" style="padding-bottom: 10px;">
                        <div class="form-group">
                            <select name="lembaga_id" class="form-control select2">
                                <option value="">Pilih</option>
                                @foreach($lembaga as $row)
                                    <option value="{{$row->id}}" {{Request::input('lembaga_id')==$row->id?'selected':''}}>{{$row->plut_name}}</option>
                                @endforeach
                            </select>
                        </div>
						<div class="form-group">
							<input type="text" name="start" class="form-control" value="{{Request::input('start')}}" placeholder="Tanggal Dari" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask>
						</div>
						<div class="form-group">
							<input type="text" name="end" class="form-control" value="{{Request::input('end')}}" placeholder="Tanggal Sampai" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask>
						</div>
						<button type="submit" class="btn btn-success"><i class="fa fa-search"></i> Cari</button>
						<a href="{{ url('laporan-kumkm-perbidang') }}" class="btn btn-warning"><i class="fa fa-refresh"></i></a>
						<a href="{{ url('laporan-kumkm-perbidang-export?start='.Request::input('start').'&end='.Request::input('end')) }}" class="btn btn-info"><i class="fa fa-file-excel-o"></i></a>
					</form>
					<div class="">
		                <table class="table table-bordered table-striped">
							<thead>
							<tr>
								<th rowspan="2">No</th>
                                <th rowspan="2">Kumkm</th>
                                <th colspan="2">Kelembagaan</th>
                                <th colspan="2">SDM</th>
                                <th colspan="2">Produksi</th>
                                <th colspan="2">Pembiayaan</th>
                                <th colspan="2">Pemasaran</th>
                                <th colspan="2">IT</th>
                                <th colspan="2">Kerjasama</th>
                                <th colspan="2">Total</th>
                            </tr>
                            <tr>
                                <th>7E</th>
                                <th>7F</th>
                                <th>7E</th>
                                <th>7F</th>
                                <th>7E</th>
                                <th>7F</th>
                                <th>7E</th>
                                <th>7F</th>
                                <th>7E</th>
                                <th>7F</th>
                                <th>7E</th>
                                <th>7F</th>
                                <th>7E</th>
                                <th>7F</th>
                                <th>7E</th>
                                <th>7F</th>
                            </tr>
							</thead>
							<tbody>
                                @foreach ($data as $key=>$row)
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>{{$row->ukmtable->nama_kumkm}}</td>
                                    <td>{{$row->program_kerja->where('bidang_layanan_id',1)->count()}}</td>
                                    <td>{{$row->pelaksanaan(1)->count()}}</td>
                                    <td>{{$row->program_kerja->where('bidang_layanan_id',2)->count()}}</td>
                                    <td>{{$row->pelaksanaan(2)->count()}}</td>
                                    <td>{{$row->program_kerja->where('bidang_layanan_id',3)->count()}}</td>
                                    <td>{{$row->pelaksanaan(3)->count()}}</td>
                                    <td>{{$row->program_kerja->where('bidang_layanan_id',4)->count()}}</td>
                                    <td>{{$row->pelaksanaan(4)->count()}}</td>
                                    <td>{{$row->program_kerja->where('bidang_layanan_id',5)->count()}}</td>
                                    <td>{{$row->pelaksanaan(5)->count()}}</td>
                                    <td>{{$row->program_kerja->where('bidang_layanan_id',6)->count()}}</td>
                                    <td>{{$row->pelaksanaan(6)->count()}}</td>
                                    <td>{{$row->program_kerja->where('bidang_layanan_id',7)->count()}}</td>
                                    <td>{{$row->pelaksanaan(7)->count()}}</td>
                                    <td>{{$row->program_kerja->count()}}</td>
                                    <td>{{$row->pelaksanaanAll()->count()}}</td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                @endforeach
							</tbody>
					</table>
				</div>


			</div>
		</div>
	</div>
@endsection
