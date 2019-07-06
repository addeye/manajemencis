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
					<h3 class="box-title">KOPERASI</h3>
					<div class="pull-right">
						<a href="{{ url('database-koperasi') }}" class="btn btn-warning btn-xs" data-toggle="tooltip" data-original-title="Kembali"><i class="fa fa-reply"></i></a>
						{{-- <a class="btn btn-success btn-xs" href="{{ url('koperasi/'.$data->id.'/edit') }}">
							<i class="fa fa-pencil"></i> Edit
						</a>
						<a class="btn btn-danger btn-xs" onclick="event.preventDefault(); ConfirmDelete({{$data->id}});" href="javascript:void(0)" role="menuitem" data-toggle="tooltip" data-original-title="Delete"><i class="fa fa-trash" aria-hidden="true"></i> Hapus</a>
						<form id="delete-form-{{$data->id}}" action="{{ url('koperasi/'.$data->id) }}" method="POST" style="display: none;">{{ csrf_field() }}
	                        <input type="hidden" name="_method" value="DELETE">
	                    </form> --}}
					</div>
				</div>
				<!-- / box Header -->
				<div class="box-body">
					<table class="table">
						<caption>Data Koperasi</caption>
						<tr>
							<th>ID Koperasi</th>
							<td>{{$data->id_koperasi}}</td>
						</tr>
						<tr>
							<th>Nama Koperasi</th>
							<td>{{$data->nama_koperasi}}</td>
						</tr>
						<tr>
							<th>Alamat</th>
							<td>{{$data->alamat}}</td>
						</tr>
						<tr>
							<th>Nomor Badan Hukum</th>
							<td>{{$data->nomor_badan_hukum}}</td>
						</tr>
						<tr>
							<th>Tanggal Badan Hukum</th>
							<td>{{date('d-m-Y',strtotime($data->tgl_badan_hukum))}}</td>
						</tr>
						<tr>
							<th>Jenis Koperasi</th>
							<td>{{$data->jenis_koperasi}}</td>
						</tr>
					</table>
					<div class="table-responsive">
						<table class="table table-bordered">
						<caption>Detail
							{{-- <a class="btn btn-primary btn-xs" href="{{ url('koperasi-detail-add/'.$data->id) }}"><i class="fa fa-plus"></i> Tambah</a> --}}
						</caption>
						<tr>
							<th rowspan="2">Keadaan</th>
							<th rowspan="2">Tanggal<br>RAT<br>Tahun Buku</th>
							<th colspan="2">Jumlah</th>
							<th rowspan="2">Asset</th>
							<th colspan="2">Modal</th>
							<th rowspan="2">Volume Usaha</th>
							<th rowspan="2">Sisa Hasil</th>
							<th rowspan="2">Kegiatan Usaha</th>
							{{-- <th rowspan="2">Act</th> --}}
						</tr>
						<tr>
							<th>Anggota</th>
							<th>Karyawan</th>
							<th>Sendiri</th>
							<th>Luar</th>
						</tr>

						@foreach ($data->koperasi_detail as $row)
							<tr>
								<td>{{date('d-m-Y',strtotime($row->tanggal_keadaan))}}</td>
								<td>{{date('d-m-Y',strtotime($row->tgl_rat_tahun_buku))}}</td>
								<td>{{$row->jml_anggota}}</td>
								<td>{{$row->jml_karyawan}}</td>
								<td>{{number_format($row->jml_asset)}}</td>
								<td>{{number_format($row->jml_modal_sendiri)}}</td>
								<td>{{number_format($row->jml_modal_luar)}}</td>
								<td>{{number_format($row->volume_usaha)}}</td>
								<td>{{number_format($row->sisa_hasil)}}</td>
								<td>{{$row->kegiatan_usaha}}</td>
								{{-- <td>
									<a href="{{ url('koperasi-detail-edit/'.$data->id.'/'.$row->id) }}" class="btn btn-success btn-xs"><i class="fa fa-pencil"></i></a>

									<a class="btn btn-danger btn-xs" onclick="event.preventDefault(); ConfirmDeleteDetail({{$row->id}});" href="javascript:void(0)" role="menuitem" data-toggle="tooltip" data-original-title="Delete"><i class="fa fa-trash" aria-hidden="true"></i></a>
				                    <form id="deletedetail-form-{{$row->id}}" action="{{ url('koperasi-detail-del/'.$row->id) }}" method="POST" style="display: none;">{{ csrf_field() }}
				                        <input type="hidden" name="_method" value="DELETE">
				                    </form>
								</td> --}}
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
