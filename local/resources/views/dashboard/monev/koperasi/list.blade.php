@extends('layouts.master')

@section('content')
	<div class="row">
		<div class="col-xs-12">
			@include('layouts.alert')
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">Koperasi</h3>
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
						<button class="btn btn-success"><i class="fa fa-search"></i> Cari</button>
					</form>
					<div class="">
                        <div>Showing {{($data->currentpage()-1)*$data->perpage()+1}} to {{$data->currentpage()*$data->perpage()}}
                        of  {{$data->total()}} entries
                        </div>

						<table class="table table-bordered table-striped">
							<thead>
							<tr>
								<th rowspan="2"><button type="button" class="btn btn-default btn-xs disabled"><i class="fa fa-gear"></i></button></th>
								<th rowspan="2">No</th>
								<th rowspan="2">Nama Koperasi</th>
								<th rowspan="2">Alamat</th>
								<th rowspan="2">Nomor dan Tanggal Badan Hukum</th>
								<th rowspan="2">Jenis Koperasi</th>
								<th rowspan="2">Tanggal RAT Tahun Buku</th>
								<th rowspan="2">Anggota</th>
								<th rowspan="2">Karyawan</th>
								<th rowspan="2">Asset</th>
								<th colspan="2">Permodalan</th>
								<th rowspan="2">Volume Usaha</th>
								<th rowspan="2">Sisa Hasil Usaha</th>
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
											<a href="{{ url('database/koperasi/'.$row->id) }}" class="btn btn-info btn-xs"><i class="fa fa-eye"></i></a>
										</td>
										<td>{{$no++}}</td>
										<td>{{$row->nama_koperasi}}</td>
										<td>{{$row->alamat}}</td>
										<td>{{$row->nomor_badan_hukum}} / {{date('d-m-Y',strtotime($row->tgl_badan_hukum))}}</td>
										<td>{{$row->jenis_koperasi}}</td>
										<td>{{isset($row->koperasi_detail[0])?date('d-m-Y',strtotime($row->koperasi_detail[0]->tgl_rat_tahun_buku)):''}}</td>
										<td>{{isset($row->koperasi_detail[0])?$row->koperasi_detail[0]->jml_anggota:''}}</td>
										<td>{{isset($row->koperasi_detail[0])?$row->koperasi_detail[0]->jml_karyawan:''}}</td>
										<td>{{isset($row->koperasi_detail[0])?number_format($row->koperasi_detail[0]->jml_asset):''}}</td>
										<td>{{isset($row->koperasi_detail[0])?number_format($row->koperasi_detail[0]->jml_modal_sendiri):''}}</td>
										<td>{{isset($row->koperasi_detail[0])?number_format($row->koperasi_detail[0]->jml_modal_luar):''}}</td>
										<td>{{isset($row->koperasi_detail[0])?number_format($row->koperasi_detail[0]->volume_usaha):''}}</td>
										<td>{{isset($row->koperasi_detail[0])?number_format($row->koperasi_detail[0]->sisa_hasil):''}}</td>
										<td>{{isset($row->koperasi_detail[0])?$row->koperasi_detail[0]->kegiatan_usaha:''}}</td>
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
                	$('#inputselect').append('<input id="kop'+this.value+'" type="hidden" name="koperasi_id[]" value="'+this.value+'"/>');
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
                $('#inputselect').append('<input id="kop'+this.value+'" type="hidden" name="koperasi_id[]" value="'+this.value+'"/>');
            }
            else
            {
              $('#kop'+this.value).remove();
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
