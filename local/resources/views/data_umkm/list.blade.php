@extends('layouts.master')

@section('content')
	<div class="row">
		<div class="col-xs-12">
			@include('layouts.alert')
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">Data UMKM</h3>
				</div>
				<!-- / box Header -->
				<div class="box-body table-responsive">
					<form class="form-inline" style="padding-bottom: 10px;">
						<div class="form-group">
							<select class="form-control" name="tahun">
								<option value="">Pilih Tahun</option>
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
						<button class="btn btn-success"><i class="fa fa-search"></i> Cari</button>
					</form>
					<div class="">
                                    <div>Showing {{($data->currentpage()-1)*$data->perpage()+1}} to {{$data->currentpage()*$data->perpage()}}
                                    of  {{$data->total()}} entries
                                    </div>
                        <form id="formcheck" method="post" action="{{ url('database-umkm-delete') }}" onsubmit="return confirm('Apakah anda yakin ? ')">
                       		{{ csrf_field() }}
                       		<div class="form-group">
                       			<div id="inputselect"></div>
                       			<button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i> Hapus</button>
                       		</div>
                       	</form>
						<table class="table table-bordered table-striped">
							<thead>
							<tr>
								<th rowspan="2"><button type="button" class="btn btn-default btn-xs disabled"><i class="fa fa-gear"></i></button></th>
                                <th rowspan="2"><input id="checkAll" type="checkbox"></th>
								<th rowspan="2">No</th>
								<th rowspan="2">Nama UMKM</th>
								<th rowspan="2">Alamat</th>
								<th rowspan="2">Tahun<br>Mulai Usaha</th>
								<th rowspan="2">Jenis Usaha</th>
								<th rowspan="2">Legalitas</th>
								<th rowspan="2">Tenaga<br>Kerja(orang)</th>
								<th colspan="2">Permodalan</th>
								<th rowspan="2">Asset</th>
								<th rowspan="2">Omset</th>
								<th rowspan="2">Kegiatan Usaha</th>
							</tr>
							<tr>
								<th>Modal Sendiri</th>
								<th>Modal Luar</th>
							</tr>
							</thead>
							<tbody>
								<?php $no = ($data->currentpage() - 1) * $data->perpage() + 1;?>
								@foreach ($data as $row)
									<tr>
										<td>
											<a href="{{ url('database-umkm/'.$row->id) }}" class="btn btn-info btn-xs"><i class="fa fa-eye"></i></a>
											<a class="btn btn-danger btn-xs" onclick="event.preventDefault(); ConfirmDelete({{$row->id}});" href="javascript:void(0)" role="menuitem" data-toggle="tooltip" data-original-title="Delete"><i class="fa fa-trash" aria-hidden="true"></i></a>
											<form id="delete-form-{{$row->id}}" action="{{ url('database-umkm/'.$row->id) }}" method="POST" style="display: none;">
												{{ csrf_field() }}
						                        <input type="hidden" name="_method" value="DELETE">
						                    </form>
										</td>
										<td align="center"><input id="checksub" type="checkbox" name="umkm_id[]" class="checkUser" value="{{$row->id}}"></td>
										<td>{{$no++}}</td>
										<td>{{$row->nama_usaha}}</td>
										<td>{{$row->alamat}}</td>
										<td>{{$row->tgl_mulai_usaha}}</td>
										<td>{{$row->bidangusaha?$row->bidangusaha->name:''}}</td>
										<td>{{$row->badan_usaha}}</td>
										<td>{{isset($row->kumkm_detail[0])?$row->kumkm_detail[0]->jml_tenaga_kerja:''}}</td>
										<td>{{isset($row->kumkm_detail[0])?number_format($row->kumkm_detail[0]->modal_sendiri):''}}</td>
										<td>{{isset($row->kumkm_detail[0])?number_format($row->kumkm_detail[0]->modal_hutang):''}}</td>
										<td>{{isset($row->kumkm_detail[0])?number_format($row->kumkm_detail[0]->asset):''}}</td>
										<td>{{isset($row->kumkm_detail[0])?number_format($row->kumkm_detail[0]->omset):''}}</td>
										<td>{{isset($row->kumkm_detail[0])?$row->kumkm_detail[0]->kegiatan_usaha:''}}</td>
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

        $("#checkAll").change(function() {
            if(this.checked) {
                $('.checkUser').prop('checked',true);
                $('.checkUser').each(function(){
                	$('#inputselect').append('<input id="umkm'+this.value+'" type="hidden" name="umkm_id[]" value="'+this.value+'"/>');
                });
            }
            else
            {
              $('.checkUser').prop('checked',false);
              $('#inputselect').html('');
            }
        });

        $(".checkUser").change(function() {
            if(this.checked) {
                $('#inputselect').append('<input id="umkm'+this.value+'" type="hidden" name="umkm_id[]" value="'+this.value+'"/>');
            }
            else
            {
              $('#umkm'+this.value).remove();
            }
        });
    });
</script>

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

