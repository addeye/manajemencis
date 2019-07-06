@extends('layouts.master')

@section('content')
	<div class="row">
		<div class="col-xs-12">
			@include('layouts.alert')
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">Kartu Pelaksanaan Pendampingan Koperasi dan UMK TAHUN 2018</h3>
				</div>
				<!-- / box Header -->
				<div class="box-body table-responsive">
					<form class="form-inline" style="padding-bottom: 10px;">
						<div class="form-group">
							<select id="tahun" class="form-control" name="tahun">
								<option value="">Pilih Tahun</option>
								<option value="2020" {{Request::get('tahun')=='2020'?'selected':''}}>2020</option>
								<option value="2019" {{Request::get('tahun')=='2019'?'selected':''}}>2019</option>
								<option value="2018" {{Request::get('tahun')=='2018'?'selected':''}}>2018</option>
								<option value="2017" {{Request::get('tahun')=='2017'?'selected':''}}>2017</option>
							</select>
						</div>
						<div class="form-group" id="konsultan-select">
							<select name="konsultan_id" onchange="showKumkm(this.value)" id="conten-konsultan" class="form-control select2">
								<option value="">Pilih Konsultan</option>
							</select>
						</div>
						<div class="form-group" id="kumkm-select">
							<select name="kumkm_id" id="conten-kumkm" class="form-control select2">
								<option value="">Pilih Koperasi/UMKM</option>
							</select>
						</div>
                    	<button type="button" class="btn btn-success" onclick="showResult()"><i class="fa fa-search"></i> Cari</button>
                    </form>
                    <div class="content-pelaksanaan"></div>
			</div>
		</div>
	</div>
@endsection

@section('script')
<script>
	var konsultanselect = "{{url('form-select-konsultan-by-lembaga')}}";
	var kumkmselect = "{{url('form-select-kumkm-by-konsultan')}}";
	var contentPelaksanaan = "{{url('kons/content-pelaksanaan-pendampingan')}}";
	var konsultanId = $('#conten-konsultan').val();
	var kumkmId = $('#conten-kumkm').val();
	var lembagaId = "{{Auth::user()->lembaga_id}}";
	var tahun = $('#tahun').val();
	var textselect ='';

	showSelectKonsultan();

	function showSelectKonsultan()
	{
		$('#conten-konsultan').html('<option value="">Pilih Konsultan</option>');
		$.ajax({
            url: konsultanselect+'/'+lembagaId,
            type: "GET",
            success: function (response) {
				console.log(response.data)
                $.each( response.data.konsultan, function( key, value ) {
                    if(konsultanId==value.id)
                    {
                        textselect = 'selected';
                    }
                    $('#conten-konsultan')
                            .append($("<option "+textselect+" ></option>")
                            .attr("value",value.id)
                            .text(value.nama_lengkap));
                    textselect = '';
                });
            }
        });
	}

	function showKumkm(konsultan_id)
	{
		$('#conten-kumkm').html('<option value="">Pilih Koperasi/UMKM</option>');
		$.ajax({
            url: kumkmselect+'/'+konsultan_id,
            type: "GET",
            success: function (response) {
				console.log(response.data)
                $.each( response.data.kumkm, function( key, value ) {
                    if(kumkmId==value.kumkm_id)
                    {
                        textselect = 'selected';
                    }
                    $('#conten-kumkm')
                            .append($("<option "+textselect+" ></option>")
                            .attr("value",value.sasaran_id)
                            .text(value.nama_kumkm));
                    textselect = '';
                });
            }
        });
	}

	function showResult()
	{
		konsultanId = $('#conten-konsultan').val();
		kumkmSasaranId = $('#conten-kumkm').val();
		lembagaId = $('#lembagaId').val();
		tahun = $('#tahun').val();

		$.ajax({
			url: contentPelaksanaan,
			type: 'POST',
			data: {
				"tahun" : tahun,
				"lembaga_id" : lembagaId,
				"konsultan_id" : konsultanId,
				"kumkm_sasaran_id" : kumkmSasaranId,
				'_token': $('meta[name="csrf-token"]').attr('content')
			},
			success: function (response) {
				// console.log(response);
				$('.content-pelaksanaan').html(response);
			}
		});
	}
</script>
@endsection
