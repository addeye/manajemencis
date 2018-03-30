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
								<th>Tahun Kegiatan</th>
								<th>Program</th>
								<th>Tujuan</th>
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
							</tr>
							 @endforeach
						</tbody>

					</table>
				</div>


			</div>
		</div>
	</div>
@endsection