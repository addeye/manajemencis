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
                <h3 class="box-title">Data Pengelolah</h3>
				</div>
				<!-- / box Header -->
				<div class="box-body">
						<table id="example" class="table table-bordered table-striped">
						<thead>
							<tr>
								<th class="col-xs-1">No</th>
								<th>Nama</th>
								<th>Lembaga</th>
								<th>No Telp</th>
								<th>Email</th>
							</tr>
						</thead>
						<tbody>
						<?php $no=1; ?>
							@foreach($data as $row)
							<tr>
								<td>{{$no++}}</td>
								<td>{{$row->name}}</td>
								<td>{{$row->lembagas?$row->lembagas->plut_name:''}}</td>
								<td>{{$row->telp}}</td>
								<td>{{$row->email}}</td>
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
	var x = confirm("Apakah anda yakin?");
  if (x)
  	document.getElementById('delete-form-'+id).submit();
  else
    return false;
}
</script>
@endsection