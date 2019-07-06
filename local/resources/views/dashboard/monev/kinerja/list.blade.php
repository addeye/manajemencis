@extends('layouts.master')

@section('content')
	<div class="row">
		<div class="col-xs-12">
			@include('layouts.alert')
			<div class="box">
				<div class="box-header">
                    <h3 class="box-title">Progres Kinerja Nasional {{Request::input('tahun')}}</h3>
				</div>
				<!-- / box Header -->
				<div class="box-body table-responsive">
                    <form class="form-inline">
                        <div class="form-group">
                            <select name="tahun" class="form-control" onchange="location = this.value;">
                                <option value="">Pilih Tahun Rekap</option>
                                @for($thn=2015; $thn<=2020; $thn++)
                                <option value="{{url('laporan-monev/porgress-iku?tahun='.$thn)}}" {{Request::input('tahun')?Request::input('tahun')==$thn?'selected':'':''}}>{{$thn}}</option>
                                @endfor
                            </select>
                        </div>
                    </form>
                    @if (Request::input('tahun'))
                    <table class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th class="col-xs-1">No</th>
                            <th align="left">Standart layanan</th>
                            <th align="left">Target</th>
                            <th align="left">Jan</th>
                            <th align="left">Feb</th>
                            <th align="left">Mar</th>
                            <th align="left">Apr</th>
                            <th align="left">Mei</th>
                            <th align="left">Jun</th>
                            <th align="left">Jul</th>
                            <th align="left">Agust</th>
                            <th align="left">Sept</th>
                            <th align="left">Okt</th>
                            <th align="left">Nov</th>
                            <th align="left">Des</th>
                            <th align="left">Total</th>
                            <th align="left">Persentase</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $no = 1;?>
                        @foreach($kinerja as $row)
                            <tr>
                                <td>{{$no++}}</td>
                                <td>{{$row->nama}}</td>
                                <td align="right">{{number_format($row->target)}}</td>
                                <td align="right">{{$row->jan!=''?number_format(floatval($row->jan)):0}}</td>
                                    <td align="right">{{$row->feb!=''?number_format(floatval($row->feb)):0}}</td>
                                    <td align="right">{{$row->mar!=''?number_format(floatval($row->mar)):0}}</td>
                                    <td align="right">{{$row->apr!=''?number_format(floatval($row->apr)):0}}</td>
                                    <td align="right">{{$row->mei!=''?number_format(floatval($row->mei)):0}}</td>
                                    <td align="right">{{$row->jun!=''?number_format(floatval($row->jun)):0}}</td>
                                    <td align="right">{{$row->jul!=''?number_format(floatval($row->jul)):0}}</td>
                                    <td align="right">{{$row->agu!=''?number_format(floatval($row->agu)):0}}</td>
                                    <td align="right">{{$row->sept!=''?number_format(floatval($row->sept)):0}}</td>
                                    <td align="right">{{$row->okt!=''?number_format(floatval($row->okt)):0}}</td>
                                    <td align="right">{{$row->nov!=''?number_format(floatval($row->nov)):0}}</td>
                                    <td align="right">{{$row->des!=''?number_format(floatval($row->des)):0}}</td>
                                <td align="right">{{number_format($row->total)}}</td>
                                <td align="right">{{round($row->percent,2)}}%</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    @endif
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
    });
</script>
@endsection
