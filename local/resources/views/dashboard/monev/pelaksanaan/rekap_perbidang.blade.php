@extends('layouts.master')

@section('content')
	<div class="row">
		<div class="col-xs-12">
			@include('layouts.alert')
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">Rekap Pelaksanaan Program Per Bidang</h3>
				</div>
				<!-- / box Header -->
				<div class="box-body table-responsive">
					{{-- <form class="form-inline" style="padding-bottom: 10px;">
						<div class="form-group">
							<select class="form-control select2" name="lembaga_id">
								<option value="">Pilih Lembaga</option>
								@foreach ($lembaga as $row)
									<option value="{{$row->id}}" {{$lembaga_id==$row->id?'selected':''}}>{{$row->plut_name}}</option>
								@endforeach
							</select>
						</div>
						<button class="btn btn-success"><i class="fa fa-search"></i> Cari</button>
						<a href="{{ url('laporan-monev/rekap-program-per-bidang') }}" class="btn btn-warning"><i class="fa fa-refresh"></i></a>
						<a href="{{ url('laporan-monev/rekap-program-per-bidang-export?lembaga_id='.$lembaga_id) }}" class="btn btn-info"><i class="fa fa-file-excel-o"></i></a>
					</form> --}}
					<div class="table-responsive">
		                <table id="example" class="table table-bordered table-striped">
							<thead>
							<tr>
								<th>No</th>
								<th>Lembaga</th>
								<th>Total Program</th>
								<th>Kelembagaan</th>
								<th>SDM</th>
								<th>Produksi</th>
								<th>Pembiayaan</th>
								<th>Pemasaran</th>
								<th>IT</th>
								<th>Kerjasama</th>
							</tr>
							</thead>
							<tbody>
                                @foreach ($data as $key=>$row)
                                    <tr>
                                        <td>{{$key+1}}</td>
                                        <td>{{$row->plut_name}}</td>
                                        <td>{{$row->pelaksanaan_pendampingan->count()}}</td>
                                        @foreach ($bidang_layanan as $bd)
                                        <td>{{$row->pelaksanaan_pendampingan->filter(function ($item) use($bd){
											return $item->konsultans->bidang_layanan_id==$bd->id;
										})->count()}}</td>
                                        @endforeach
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
<script src="{{url('js/jquery.printPage.js')}}"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $('.btn-print').printPage();

        $(".delete").on("submit", function(){
            return confirm("Apakah kamu yakin dengan data ini?");
        });

        $(".lockform").on("submit", function(){
            return confirm("Apakah kamu yakin Status Lock Diganti?");
        });

		$("#checkAll").change(function() {
            if(this.checked) {
                $('.checkProgram').prop('checked',true);
                $('.checkProgram').each(function(){
                	$('.inputselectlock').append('<input id="proglock'+this.value+'" type="hidden" name="program_id_to_lock[]" value="'+this.value+'"/>');
                	$('.inputselectunlock').append('<input id="progunlock'+this.value+'" type="hidden" name="program_id_to_unlock[]" value="'+this.value+'"/>');
                });
            }
            else
            {
              $('.checkProgram').prop('checked',false);
              $('.inputselectlock').html('');
              $('.inputselectunlock').html('');
            }
        });

        $(".checkProgram").change(function() {
            if(this.checked) {
                $('.inputselectlock').append('<input id="proglock'+this.value+'" type="hidden" name="program_id_to_lock[]" value="'+this.value+'"/>');
                $('.inputselectunlock').append('<input id="progunlock'+this.value+'" type="hidden" name="program_id_to_unlock[]" value="'+this.value+'"/>');
            }
            else
            {
              $('#proglock'+this.value).remove();
              $('#progunlock'+this.value).remove();
            }
        });
    });
</script>
@endsection
