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
					<div class="pull-right">
						<a class="btn btn-primary" href="{{ url('pengelolah/create') }}">
							<i class="fa fa-plus"></i> Tambah Data
						</a>
					</div>
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
								<th>Aksi</th>
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
								<td>
                                	<a href="{{ url('pengelolah/'.$row->id.'/edit') }}" class="btn btn-success btn-xs" data-toggle="tooltip" data-placement="left" title="Edit Data {{$row->nama_lengkap}}">
										<i class="glyphicon glyphicon-edit"></i>
									</a>
                                	<a class="btn btn-danger btn-xs" onclick="event.preventDefault(); ConfirmDelete({{$row->id}});" href="javascript:void(0)" role="menuitem" data-toggle="tooltip" data-original-title="Delete"><i class="fa fa-trash" aria-hidden="true"></i></a>
									<form id="delete-form-{{$row->id}}" action="{{url('pengelolah/'.$row->id)}}" method="POST" style="display: none;">
										{{ csrf_field() }}
										<input type="hidden" name="_method" value="DELETE">
									</form>
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
	var x = confirm("Apakah anda yakin?");
  if (x)
  	document.getElementById('delete-form-'+id).submit();
  else
    return false;
}
</script>
@endsection