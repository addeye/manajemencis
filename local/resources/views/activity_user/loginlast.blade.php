@extends('layouts.master')

@section('content')

	<div class="row">
		<div class="col-xs-12">
			@include('layouts.alert')
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">Login User</h3>
				</div>
				<!-- / box Header -->
				<div class="box-body">
                    <div class="row">
                        <div class="col-md-12">
                            <h4>Pencarian</h4>
                            <form class="form-inline">
                                <div class="form-group">
                                    <select name="role" class="form-control">
                                        <option value="">Pilih jenis akun</option>
                                        @foreach($role as $row)
                                            <option value="{{$row->id}}" {{Request('role')==$row->id?'selected':''}} >{{$row->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <select name="lembaga" class="form-control">
                                        <option value="">Pilih lembaga</option>
                                        @foreach($lembaga as $row)
                                            <option value="{{$row->id}}">{{$row->plut_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <select name="bidang" class="form-control">
                                        <option value="">Pilih bidang</option>
                                        @foreach($bidang as $row)
                                            <option value="{{$row->id}}">{{$row->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary">Cari</button>
                                <a class="btn btn-success" href="{{url('export-last-login?role='.Request('role').'&lembaga='.Request('lembaga').'&bidang='.Request('bidang'))}}">Export</a>
                            </form>
                        </div>
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Nama</th>
                                        <th>Lembaga</th>
                                        <th>Jenis Akun</th>
                                        <th>Bidang</th>
                                        <th>Login Terakhir</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($data as $key=>$row)
                                    <tr>
                                        <td>{{$row->name}}</td>
                                        <td>
                                            @if($row->role_id==2)
                                                {{$row->adminlembagas->lembagas->plut_name}}
                                            @elseif($row->role_id==3)
                                                {{$row->konsultans->lembagas->plut_name}}
                                            @endif
                                        </td>
                                        <td>
                                            {{$row->roles->name}}
                                        </td>
                                        <td>
                                            @if($row->role_id==3)
                                                {{$row->konsultans->bidang_layanans->name}}
                                            @endif
                                        </td>
                                        <td>
                                            {{$row->log->last()->created_at->format('d-m-Y H:i:s')}}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                                </table>
                            </div>
                            <div class="paging">
                                {{$data->links()}}
                            </div>
                        </div>
                    </div>
				</div>


			</div>
		</div>
	</div>
@endsection