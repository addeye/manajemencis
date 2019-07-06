@extends('layouts.master')

@section('content')
	<div class="row">
		<div class="col-xs-12">
			@include('layouts.alert')
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">Laporan Konsultan Pendamping PLUT KUMKM</h3>
				</div>
				<!-- / box Header -->
				<div class="box-body table-responsive">
					<form class="form-inline" style="padding-bottom: 10px;">
						<div class="form-group">
							<select id="periode-laporan" onchange="selectLap(this.value)" class="form-control" name="tahun">
                                <option value="">Pilih Periode Laporan</option>
                                <option value="bulanan">Bulanan</option>
                                <option value="triwulan">Triwulan</option>
                                <option value="tahunan">Tahunan</option>
							</select>
						</div>
                    </form>
                <div class="content-pelaksanaan"></div>
                <div class="show-pelaksanaan"></div>
			</div>
		</div>
	</div>
@endsection

@section('script')
<script>
    var _urlbulanan = "{{url('admin/laporan-pelaksanaan-bulanan-final')}}";
    var _urltriwulan = "{{url('admin/laporan-pelaksanaan-triwulan-final')}}";
    var _urltahunan = "{{url('admin/laporan-pelaksanaan-tahunan-final')}}";
    var _urlshowbulanan = "{{url('admin/laporan-pelaksanaan-bulanan-show')}}";
    var _urlshowtriwulan = "{{url('admin/laporan-pelaksanaan-triwulan-show')}}";
    var _urlshowtahunan = "{{url('admin/laporan-pelaksanaan-tahunan-show')}}";
    var konsultanselect = "{{url('form-select-konsultan-by-lembaga')}}";
    var konsultanId = $('#conten-konsultan').val();
	var lembagaId = "{{Auth::user()->lembaga_id}}";
	var bulan = $('#bulan').val();
    var trw = $('#triwulan').val();
	var tahun = $('#tahun').val();
    var textselect ='';

    function selectLap(val)
    {
        if(val == 'bulanan')
        {
            bulanan();
        }else if(val == 'triwulan')
        {
            triwulan();
        }else if(val == 'tahunan')
        {
            tahunan();
        }
        $('.show-pelaksanaan').html('');
        showSelectKonsultan()
    }

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

    function bulanan()
    {
        $('.content-pelaksanaan').html('');
        $.ajax({
			url: _urlbulanan,
			type: 'GET',
			success: function (response) {
				// console.log(response);
				$('.content-pelaksanaan').html(response);
                $(".select2").select2();
			}
		});
    }

    function triwulan()
    {
        $('.content-pelaksanaan').html('');
        $.ajax({
			url: _urltriwulan,
			type: 'GET',
			success: function (response) {
				// console.log(response);
				$('.content-pelaksanaan').html(response);
                $(".select2").select2();
			}
		});
    }

    function tahunan()
    {
        $('.content-pelaksanaan').html('');
        $.ajax({
			url: _urltahunan,
			type: 'GET',
			success: function (response) {
				// console.log(response);
				$('.content-pelaksanaan').html(response);
                $(".select2").select2();
			}
		});
    }

    function showBulanan()
    {
        var konsultanId = $('#conten-konsultan').val();
        var lembagaId = $('#lembaga_id').val();
        var bulan = $('#bulan').val();
        var tahun = $('#tahun').val();
        $('.show-pelaksanaan').html('');
        $.ajax({
			url: _urlshowbulanan,
			type: 'POST',
			data: {
				"tahun" : tahun,
                "bulan" : bulan,
				"lembaga_id" : lembagaId,
				"konsultan_id" : konsultanId,
				'_token': $('meta[name="csrf-token"]').attr('content')
			},
			success: function (response) {
				// console.log(response);
				$('.show-pelaksanaan').html(response);
			}
		});
    }

    function showTriwulan()
    {
        var konsultanId = $('#conten-konsultan').val();
        var lembagaId = $('#lembaga_id').val();
        var trw = $('#triwulan').val();
        var tahun = $('#tahun').val();
        $('.show-pelaksanaan').html('');
        $.ajax({
			url: _urlshowtriwulan,
			type: 'POST',
			data: {
				"tahun" : tahun,
                "triwulan" : trw,
				"lembaga_id" : lembagaId,
				"konsultan_id" : konsultanId,
				'_token': $('meta[name="csrf-token"]').attr('content')
			},
			success: function (response) {
				// console.log(response);
				$('.show-pelaksanaan').html(response);
			}
		});
    }

    function showTahunan()
    {
        var konsultanId = $('#conten-konsultan').val();
        var lembagaId = $('#lembaga_id').val();
        var tahun = $('#tahun').val();
        $('.show-pelaksanaan').html('');
        $.ajax({
			url: _urlshowtahunan,
			type: 'POST',
			data: {
				"tahun" : tahun,
				"lembaga_id" : lembagaId,
				"konsultan_id" : konsultanId,
				'_token': $('meta[name="csrf-token"]').attr('content')
			},
			success: function (response) {
				// console.log(response);
				$('.show-pelaksanaan').html(response);
			}
		});
    }
</script>
@endsection
