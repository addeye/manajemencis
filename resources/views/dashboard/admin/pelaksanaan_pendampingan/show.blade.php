@extends('layouts.master')

@section('css')
<style type="text/css">
	table caption {
		font-size: 20px;
	}
</style>
@endsection

@section('content')
	<div class="row">
		<div class="col-xs-12">
			@include('layouts.alert')
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">UMKM</h3>
					<div class="pull-right">
						<a href="{{ url('data-kumkm') }}" class="btn btn-warning btn-xs" data-toggle="tooltip" data-original-title="Kembali"><i class="fa fa-reply"></i></a>
						<a class="btn btn-success btn-xs" href="{{ url('data-kumkm/'.$data->id.'/edit') }}">
							<i class="fa fa-pencil"></i> Edit
						</a>
						<a class="btn btn-danger btn-xs" onclick="event.preventDefault(); ConfirmDelete({{$data->id}});" href="javascript:void(0)" role="menuitem" data-toggle="tooltip" data-original-title="Delete"><i class="fa fa-trash" aria-hidden="true"></i> Hapus</a>
						<form id="delete-form-{{$data->id}}" action="{{ url('data-kumkm/'.$data->id) }}" method="POST" style="display: none;">{{ csrf_field() }}
	                        <input type="hidden" name="_method" value="DELETE">
	                    </form>
					</div>
				</div>
				<!-- / box Header -->
				<div class="box-body">
					<table class="table">
						<caption>Data UMKM</caption>
						<tr>
							<th>ID UMKM</th>
							<td>{{$data->id_kumkm}}</td>
						</tr>
						<tr>
							<th>Nama UMKM</th>
							<td>{{$data->nama_usaha}}</td>
						</tr>
						<tr>
							<th>Alamat</th>
							<td>{{$data->alamat}}</td>
						</tr>
						<tr>
							<th>Tahun Mulai Usaha</th>
							<td>{{$data->tgl_mulai_usaha}}</td>
						</tr>
						<tr>
							<th>Jenis Usaha</th>
							<td>{{$data->bidangusaha?$data->bidangusaha->name:''}}</td>
						</tr>
						<tr>
							<th>Badan Usaha</th>
							<td>{{$data->badan_usaha}}</td>
						</tr>
					</table>
					<div class="table-responsive">
						<table class="table table-bordered">
						<caption>Detail <a class="btn btn-primary btn-xs" href="{{ url('data-kumkm-detail-add/'.$data->id) }}"><i class="fa fa-plus"></i> Tambah</a></caption>
						<tr>
							<th rowspan="2">Keadaan</th>
							<th rowspan="2">Tenaga<br>Kerja(orang)</th>
							<th colspan="2">Permodalan</th>
							<th rowspan="2">Asset</th>
							<th rowspan="2">Omset</th>
							<th rowspan="2">Kegiatan Usaha</th>
							<th rowspan="2">Act</th>
						</tr>
						<tr>
							<th>Sendiri</th>
							<th>Hutang</th>
						</tr>

						@foreach ($data->kumkm_detail as $row)
							<tr>
								<td>{{date('d-m-Y',strtotime($row->tanggal_keadaan))}}</td>
								<td>{{$row->jml_tenaga_kerja}}</td>
								<td>{{number_format($row->modal_sendiri)}}</td>
								<td>{{number_format($row->modal_hutang)}}</td>
								<td>{{number_format($row->asset)}}</td>
								<td>{{number_format($row->omset)}}</td>
								<td>{{$row->kegiatan_usaha}}</td>
								<td>
									<a href="{{ url('data-kumkm-detail-edit/'.$data->id.'/'.$row->id) }}" class="btn btn-success btn-xs"><i class="fa fa-pencil"></i></a>

									<a class="btn btn-danger btn-xs" onclick="event.preventDefault(); ConfirmDeleteDetail({{$row->id}});" href="javascript:void(0)" role="menuitem" data-toggle="tooltip" data-original-title="Delete"><i class="fa fa-trash" aria-hidden="true"></i></a>
				                    <form id="deletedetail-form-{{$row->id}}" action="{{ url('data-kumkm-detail-del/'.$row->id) }}" method="POST" style="display: none;">{{ csrf_field() }}
				                        <input type="hidden" name="_method" value="DELETE">
				                    </form>
								</td>
							</tr>
						@endforeach
					</table>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection

@section('script')
<script>

      function ConfirmDelete(id)
      {
      	var result = confirm("Apa kamu yakin data akan dihapus?");
		if (result) {
		    document.getElementById('delete-form-'+id).submit();
		}
      }

      function ConfirmDeleteDetail(id)
      {
      	var result = confirm("Apa kamu yakin data akan dihapus?");
		if (result) {
		    document.getElementById('deletedetail-form-'+id).submit();
		}
      }

  </script>
@endsection
