@extends('layouts.master')

@section('content')
	<div class="row">
		<div class="col-xs-12">
			@include('layouts.alert')
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">Kartu Pelaksanaan Pendampingan Koperasi Dan UMK</h3>
					<div class="pull-right">
						<a class="btn btn-primary" href="{{ url('pelaksanaan-pendampingan/create') }}">
							<i class="fa fa-plus"></i> Tambah Data
						</a>
					</div>
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
							<input type="text" class="form-control" placeholder="Ketik Nama Koperasi / UMKM" name="nama_kumkm" value="{{$nama_kumkm}}">
						</div>
						<button class="btn btn-success"><i class="fa fa-search"></i> Cari</button>
						<a href="{{ url('pelaksanaan-pendampingan') }}" class="btn btn-warning"><i class="fa fa-refresh"></i></a>
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
										<td>
											@if ($row->lock=='No')
												<form class="lockform" action="{{ url('pelaksanaan-pendampingan-lock/'.$row->id) }}" method="POST">
			                                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
			                                        <button type="submit" class="btn btn-primary btn-xs"><i class="fa fa-lock"></i></button>
			                                    </form>
												<form class="delete" action="{{ url('pelaksanaan-pendampingan/'.$row->id) }}" method="POST">
			                                        <input type="hidden" name="_method" value="DELETE">
			                                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
			                                        <button type="submit" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></button>
			                                    </form>
			                                    <a href="{{ url('pelaksanaan-pendampingan/'.$row->id.'/edit') }}" class="btn btn-xs btn-success"><i class="fa fa-pencil"></i></a>
			                                    @else
			                                    <button type="button" class="btn btn-xs btn-primary disabled">Lock</button>
											@endif
										</td>
										<td>{{$no++}}</td>
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
