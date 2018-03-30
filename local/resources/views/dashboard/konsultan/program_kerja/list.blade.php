@extends('layouts.master')

@section('content')
	<div class="row">
		<div class="col-xs-12">
			@include('layouts.alert')
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">Kartu Program Kerja PLUT KUMKM</h3>
					<div class="pull-right">
						<a class="btn btn-primary" href="{{ url('program-kerja/create') }}">
							<i class="fa fa-plus"></i> Tambah Data
						</a>
					</div>
				</div>
				<!-- / box Header -->
				<div class="box-body table-responsive">
					<form class="form-inline" style="padding-bottom: 10px;">
						<div class="form-group">
							<select class="form-control select2" name="sasaran_program_id">
								<option value="">Pilih Koperasi / UMKM </option>
								@foreach ($sasaran_program as $row)
									<option value="{{$row->id}}" {{$row->id==$sasaran_program_id?'selected':''}}>{{$row->ukmtable->nama_kumkm}}</option>
								@endforeach
							</select>
						</div>
						<button class="btn btn-success"><i class="fa fa-search"></i> Cari</button>
						<a href="{{ url('program-kerja') }}" class="btn btn-info"><i class="fa fa-refresh"></i></a>
					</form>
					<div class="">
		                <div>Showing {{($data->currentpage()-1)*$data->perpage()+1}} to {{$data->currentpage()*$data->perpage()}}
		                of  {{$data->total()}} entries
		                </div>

		                <table class="table table-bordered table-striped">
							<thead>
							<tr>
								<th></th>
								<th>No</th>
								<th>KUMKM</th>
								<th>Identifikasi Permasalahan <br> (Per Bidang Layanan)</th>
								<th>Program Kerja Pendampingan Tahun <br>{{date('Y')}}</th>
								<th>Target Capaian</th>
								<th>Konsultan Pendamping Penanggung Jawab</th>
							</tr>
							</thead>
							<tbody>
								<?php $no = ($data->currentpage() - 1) * $data->perpage() + 1;?>
								@foreach ($data as $row)
									<tr>
										<td>
											@if ($row->lock=='No')
												<form class="lockform" action="{{ url('program-kerja-lock/'.$row->id) }}" method="POST">
			                                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
			                                        <button type="submit" class="btn btn-primary btn-xs"><i class="fa fa-lock"></i></button>
			                                    </form>
												<form class="delete" action="{{ url('program-kerja/'.$row->id) }}" method="POST">
			                                        <input type="hidden" name="_method" value="DELETE">
			                                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
			                                        <button type="submit" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></button>
			                                    </form>
			                                    <a href="{{ url('program-kerja/'.$row->id.'/edit') }}" class="btn btn-xs btn-success"><i class="fa fa-pencil"></i></a>
			                                    @else
			                                    <button type="button" class="btn btn-xs btn-primary disabled">Lock</button>
											@endif
										</td>
										<td>{{$no++}}</td>
										<td>{{$row->sasaran_program->ukmtable->nama_kumkm}}</td>
										<td>{{$row->permasalahan}}</td>
										<td>{{$row->proker_pendampingan}}</td>
										<td>{{$row->target_capaian}}</td>
										<td>{{$row->bidang_layanan->name}}</td>
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
