@extends('layouts.master')

@section('content')
	<div class="row">
		<div class="col-xs-12">
			@include('layouts.alert')
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">Kartu Pelaksanaan Pendampingan Koperasi Dan UMK</h3>
					{{-- <div class="pull-right">
						<a class="btn btn-primary" href="{{ url('pelaksanaan-pendampingan/create') }}">
							<i class="fa fa-plus"></i> Tambah Data
						</a>
					</div> --}}
				</div>
				<!-- / box Header -->
				<div class="box-body table-responsive">
					<form class="form-inline" style="padding-bottom: 10px;">
						<div class="form-group">
							<select class="form-control" name="tahun">
								<option value="">Pilih Tahun</option>
								<option value="2020" {{$tahun=='2020'?'selected':''}}>2020</option>
								<option value="2019" {{$tahun=='2019'?'selected':''}}>2019</option>
								<option value="2018" {{$tahun=='2018'?'selected':''}}>2018</option>
								<option value="2017" {{$tahun=='2017'?'selected':''}}>2017</option>
							</select>
						</div>
						<div class="form-group">
							<select class="form-control select2" name="lembaga_id">
								<option value="">Pilih Lembaga</option>
								@foreach ($lembaga as $row)
									<option value="{{$row->id}}" {{$lembaga_id==$row->id?'selected':''}}>{{$row->plut_name}}</option>
								@endforeach
							</select>
						</div>
						<div class="form-group">
							<input type="text" class="form-control" placeholder="Ketik Nama Koperasi / UMKM" name="nama_kumkm" value="{{$nama_kumkm}}">
						</div>
						<div class="form-group">
						<input type="text" class="form-control datepicker-realformat" name="tanggal_mulai" placeholder="Tanggal Mulai" value="{{$tanggal_mulai}}" readonly>
						</div>
						<div class="form-group">
						<input type="text" class="form-control datepicker-realformat" name="tanggal_selesai" placeholder="Tanggal Selesai" value="{{$tanggal_selesai}}" readonly>
						</div>
						<button class="btn btn-success"><i class="fa fa-search"></i> Cari</button>
						<a href="{{url('pelaksanaan-pendampingan-konsultan-export?tahun='.$tahun.'&lembaga_id='.$lembaga_id.'&nama_kumkm='.$nama_kumkm.'&tanggal_mulai='.$tanggal_mulai.'&tanggal_selesai='.$tanggal_selesai)}}" class="btn btn-primary {{$lembaga_id?'':'hidden'}}"><i class="fa fa-download"></i> Unduh</a>
						<a target="_blank" href="{{url('pelaksanaan-pendampingan-konsultan-print?tahun='.$tahun.'&lembaga_id='.$lembaga_id.'&nama_kumkm='.$nama_kumkm.'&tanggal_mulai='.$tanggal_mulai.'&tanggal_selesai='.$tanggal_selesai)}}" class="btn btn-primary {{$lembaga_id?'':'hidden'}}"><i class="fa fa-download"></i> Print</a>
						<a href="{{ url('pelaksanaan-pendampingan-konsultan') }}" class="btn btn-warning"><i class="fa fa-refresh"></i></a>
					</form>
					<div class="col-md-2 row">
						<form id="formchecklock" method="post" action="{{ url('pelaksanaan-pendampingan-lock') }}" onsubmit="return confirm('Apakah anda yakin ? ')">
							{{ csrf_field() }}
							<div class="form-group">
								<div class="inputselectlock"></div>
								<button type="submit" class="btn btn-danger col-xs-12"><i class="fa fa-lock"></i> Lock</button>
							</div>
						</form>
					</div>
					<div class="col-md-2 row">
						<form id="formcheckunlock" method="post" action="{{ url('pelaksanaan-pendampingan-unlock') }}" onsubmit="return confirm('Apakah anda yakin ? ')">
							{{ csrf_field() }}
							<div class="form-group">
								<div class="inputselectunlock"></div>
								<button type="submit" class="btn btn-info col-xs-12"><i class="fa fa-unlock"></i> UnLock</button>
							</div>
						</form>
					</div>
					<div class="">
						<div>Showing {{($data->currentpage()-1)*$data->perpage()+1}} to {{$data->currentpage()*$data->perpage()}}
						of  {{$data->total()}} entries
						</div>
						<table class="table table-bordered table-striped">
							<thead>
							<tr>
								<th rowspan="2"><button type="button" class="btn btn-default btn-xs disabled"><i class="fa fa-gear"></i></button></th>
								<th rowspan="2"><input id="checkAll" type="checkbox"></th>
								<th rowspan="2">No</th>
								<th rowspan="2">Lembaga</th>
								<th rowspan="2">Nama KUMKM</th>
								<th rowspan="2">Identifikasi Permsalahan<br>(Per Bidang Layanan)</th>
								<th rowspan="2">Program Kerja Pendampingan</th>
								<th colspan="2">Pelaksanaan Pendampingan</th>
								<th rowspan="2">Skema Tindakan Lebih Lanjut</th>
							</tr>
							<tr>
								<th>Tgl/Bln/Thn</th>
								<th>Materi Pendampingan</th>
							</tr>
							</thead>
							<tbody>
								<?php $no = ($data->currentpage() - 1) * $data->perpage() + 1;?>
								@foreach ($data as $row)
									<tr>
										<td>
											<form class="lockform" action="{{ url('pelaksanaan-pendampingan-konsultan-lock/'.$row->id) }}" method="POST">
													<input type="hidden" name="_method" value="PUT">
			                                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
			                                        <input type="hidden" name="lock" value="{{$row->lock}}">
			                                        <button type="submit" class="btn {{$row->lock=='Yes'?'btn-danger':'btn-info'}} btn-xs" data-toggle="tooltip" data-placement="left" title="{{$row->lock}}">
			                                        	<i class="fa {{$row->lock=='Yes'?'fa-lock':'fa-unlock'}}"></i>
			                                        </button>
			                                    </form>
										</td>
										<td align="center"><input id="checksub" type="checkbox" name="pelaksanaan_id[]" class="checkPelaksanaan" value="{{$row->id}}"></td>
										<td>{{$no++}}</td>
										<td>{{$row->lembaga->plut_name}}</td>
										<td>{{$row->nama_kumkm}}</td>
										<td>{{$row->program_kerja->permasalahan}}</td>
										<td>{{$row->program_kerja->proker_pendampingan}}</td>
										<td>{{date('d/m/Y',strtotime($row->tanggal))}}</td>
										<td>{{$row->materi}}</td>
										<td>{{$row->tindak_lanjut}}</td>
									</tr>
								@endforeach
							</tbody>
						</table>
					<div class="text-right">
                        {{$data->appends($_GET)->links()}}
                    </div>
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
            return confirm("Apakah kamu yakin Lock data ini?");
        });

		$("#checkAll").change(function() {
            if(this.checked) {
                $('.checkPelaksanaan').prop('checked',true);
                $('.checkPelaksanaan').each(function(){
                	$('.inputselectlock').append('<input id="pellock'+this.value+'" type="hidden" name="pel_id_to_lock[]" value="'+this.value+'"/>');
                	$('.inputselectunlock').append('<input id="pelunlock'+this.value+'" type="hidden" name="pel_id_to_unlock[]" value="'+this.value+'"/>');
                });
            }
            else
            {
              $('.checkPelaksanaan').prop('checked',false);
              $('.inputselectlock').html('');
              $('.inputselectunlock').html('');
            }
        });

        $(".checkPelaksanaan").change(function() {
            if(this.checked) {
                $('.inputselectlock').append('<input id="pellock'+this.value+'" type="hidden" name="pelaksanaan_id_to_lock[]" value="'+this.value+'"/>');
                $('.inputselectunlock').append('<input id="pelunlock'+this.value+'" type="hidden" name="pelaksanaan_id_to_unlock[]" value="'+this.value+'"/>');
            }
            else
            {
              $('#pellock'+this.value).remove();
              $('#pelunlock'+this.value).remove();
            }
        });
    });
</script>
@endsection
