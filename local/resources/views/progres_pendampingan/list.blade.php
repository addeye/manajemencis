@extends('layouts.master')

@section('content')
	<div class="row">
		<div class="col-xs-12">
			@include('layouts.alert')
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">Progres Pendampingan</h3>
				</div>
				<!-- / box Header -->
				<div class="box-body table-responsive">
					<form class="form-inline" style="padding-bottom: 10px;">
						<div class="form-group">
							<input type="text" name="start" class="form-control" value="{{$start}}" placeholder="Tanggal Dari" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask>
						</div>
						<div class="form-group">
							<input type="text" name="end" class="form-control" value="{{$end}}" placeholder="Tanggal Sampai" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask>
						</div>
						<button class="btn btn-success"><i class="fa fa-search"></i> Cari</button>
						<a href="{{ url('/progres-pendampingan') }}" class="btn btn-warning"><i class="fa fa-refresh"></i></a>
						<a href="{{ url('progres-pendampingan-export?start='.$start.'&end='.$end) }}" class="btn btn-info"><i class="fa fa-file-excel-o"></i></a>
					</form>
					<div class="">
		                <table class="table table-bordered table-striped">
							<thead>
							<tr>
								<th>No</th>
								<th>Lembaga</th>
								<th>Form 7a</th>
								<th>Form 7b</th>
								<th>Form 7c</th>
								<th>Form 7d</th>
								<th>Form 7e</th>
								<th>Form 7f</th>
							</tr>
							</thead>
							<tbody>
								<?php $no = 1;?>
								@foreach ($data as $row)
									<tr>
										<td>{{$no++}}</td>
										<td>{{$row->plut_name}}</td>
										<td align="right">{{number_format($row->koperasi_count)}}</td>
										<td align="right">{{number_format($row->kumkm_count)}}</td>
										<td align="right">{{number_format($row->sasaran_program_koperasi_count)}}</td>
										<td align="right">{{number_format($row->sasaran_program_umkm_count)}}</td>
										<td align="right">{{number_format($row->program_kerja_count)}}</td>
										<td align="right">{{number_format($row->pelaksanaan_pendampingan_count)}}</td>
									</tr>
								@endforeach
								<tr>
									<td></td>
									<th align="center">TOTAL</th>
									<td align="right">{{number_format($koperasi_count)}}</td>
									<td align="right">{{number_format($umkm_count)}}</td>
									<td align="right">{{number_format($sasaran_koperasi_count)}}</td>
									<td align="right">{{number_format($sasaran_umkm_count)}}</td>
									<td align="right">{{number_format($program_kerja_count)}}</td>
									<td align="right">{{number_format($pelaksanaan_count)}}</td>
								</tr>
							</tbody>
					</table>
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
            return confirm("Apakah kamu yakin Status Lock Diganti?");
        });
    });
</script>
@endsection
