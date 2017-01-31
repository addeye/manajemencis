<?php

/**
 * Created by Sublime
 * User: Dio Putra
 * Date: 29/01/2017
 * Time: 23:54
 */

?>

@extends('layouts.master');
@section('content');
	<div class="row">
		<div class="col-xs-12">
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">{{$title}}</h3>
				</div>

				<!-- / box Header -->
				<div class="box-body">
						<table class="table table-bordered table-striped datatables-class">
						<thead>
							<tr>
								<th class="col-xs-1">Kode</th>
								<th>Name</th>
								<th>Action</th>
								
							</tr>
						</thead>

						<tbody>
							@foreach($bidangusaha as $row)
							<tr>
								
								<td>{{$row->id}}</td>
								<td>{{$row->name}}</td>
								<td>
                                	<a href="#" class="btn btn-success btn-xs"><i class="glyphicon glyphicon-edit"></i></a>
                                	<a href="#" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i></a>
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