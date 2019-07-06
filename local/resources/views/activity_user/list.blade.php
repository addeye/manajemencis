@extends('layouts.master')

@section('content')

	<div class="row">
		<div class="col-xs-12">
			@include('layouts.alert')
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">Activity User</h3>
				</div>
				<!-- / box Header -->
				<div class="box-body">
					<table id="example" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Lembaga</th>
                            <th>Jenis Akun</th>
                            <th>Bidang</th>
                            <th>Info</th>
                            <th>Waktu</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($data as $key=>$row)
                        <tr>
                            <td>{{$row->user->name}}</td>
                            <td>
                                @if($row->user->role_id==2)
                                    {{$row->user->adminlembagas->lembagas->plut_name}}
                                @elseif($row->user->role_id==3)
                                    {{$row->user->konsultans->lembagas->plut_name}}
                                @elseif($row->user->role_id==4)
                                    -
                                @else
                                    -
                                @endif
                            </td>
                            <td>
                                {{$row->user->roles->name}}
                            </td>
                            <td>
                                @if($row->user->role_id==3)
                                    {{$row->user->konsultans->bidang_layanans->name}}
                                @endif
                            </td>
                            <th>{{$row->info}}</th>
                            <td>
                                {{$row->created_at->format('d-m-Y H:i:s')}}
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