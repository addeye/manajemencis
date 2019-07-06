<?php
/**
 * Created by Sublime
 * User: Dio Putra
 * Date: 29/01/2017
 * Time: 23:54
 */

?>

@extends('layouts.master')

@section('content')

	<div class="row">
		<div class="col-xs-12">
			@include('layouts.alert')
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">{{$title}}</h3>
				</div>
				<!-- / box Header -->
				<div class="box-body table-responsive">
						<table id="example" class="table table-bordered table-striped">
						<thead>
							<tr>
								<th class="col-xs-1">No</th>
								<th>Tahun</th>
								<th>Kegiatan</th>
								<th>Tujuan</th>
								<th>Sasaran</th>
								<th>Jumlah Sasaran</th>
								<th>Indikator</th>
								<th>Output</th>
								<th>Anggaran</th>
								<th>Lock</th>
							</tr>
						</thead>
						<tbody>
						<?php $no = 1;?>
							@foreach($data as $row)
							<tr>
								<td>{{$no++}}</td>
								<td>{{$row->tahun_kegiatan}}</td>
								<td>{{$row->program}}</td>
								<td>{{$row->tujuan}}</td>
								<td>{{$row->sasaran}}</td>
								<td>{{$row->jumlah_sasaran}}</td>
								<td>{{$row->indikator}}</td>
								<td>{{$row->output}}</td>
								<td>
									<ul>
									@foreach ($row->proker_anggaran as $angg)
										<li>{{$angg->anggaran->nama}}</li>
									@endforeach
									</ul>
								</td>
								<td class="text-center">
									<strong>{{$row->status_lock}}</strong>
								</td>
							</tr>
							 @endforeach
						</tbody>

					</table>
				</div>


			</div>
		</div>
	</div>
@endsection

@section('script')
<script>

      function ConfirmDelete(id)
      {
      	var result = confirm("Apa anda yakin?");
		if (result) {
		    document.getElementById('delete-form-'+id).submit();
		}
      }

  </script>
@endsection