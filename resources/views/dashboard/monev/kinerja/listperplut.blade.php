@extends('layouts.master')

@section('content')
	<div class="row">
		<div class="col-xs-12">
			@include('layouts.alert')
			<div class="box">
				<div class="box-header">
                <h3 class="box-title">Progres Capaian IKU {{Request::input('tahun')}}</h3>
				</div>
				<!-- / box Header -->
				<div class="box-body table-responsive">
                    <form class="form-inline">
                        <div class="form-group">
                            <select name="tahun" class="form-control">
                                <option value="">Pilih Tahun Rekap</option>
                                @for($thn=2015; $thn<=2020; $thn++)
                                <option value="{{$thn}}" {{Request::input('tahun')?Request::input('tahun')==$thn?'selected':'':''}}>{{$thn}}</option>
                                @endfor
                            </select>
                        </div>
                        <div class="form-group">
                            <select name="lembaga_id" class="form-control select2">
                                <option value="">Pilih Lembaga</option>
                                @foreach ($lembaga as $row)
                                <option value="{{$row->id}}" {{Request::input('lembaga_id')==$row->id?'selected':''}} >{{$row->plut_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
                    </form>
                    @if (Request::input('tahun') && Request::input('lembaga_id'))
                    <table id="" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th class="col-xs-1">No</th>
                            <th>Layanan</th>
                            <th>Target</th>
                            <th>Jan</th>
                            <th>Feb</th>
                            <th>Mar</th>
                            <th>Apr</th>
                            <th>Mei</th>
                            <th>Jun</th>
                            <th>Jul</th>
                            <th>Agust</th>
                            <th>Sept</th>
                            <th>Okt</th>
                            <th>Nov</th>
                            <th>Des</th>
                            <th>Total</th>
                            <th>Persentase</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $no = 1;?>
                        @foreach($kinerja as $row)
                            <tr>
                                <td>{{$no++}}</td>
                                <td>{{$row->nama}}</td>
                                <td align="right">{{$row->target!=''?number_format(floatval($row->target)):0}}</td>
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
                        <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>Rata-rata</td>
                                <td align="right">{{round($rata_percent,2)}}%</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>Keterangan</td>
                                <td>{{$predikat}}</td>
                            </tr>
                        </tbody>
                    </table>
                    <hr>
                    <h3>KETERANGAN</h3>
                    <div>
                    @if ($keterangan_kinerja)
                        <p>{{$keterangan_kinerja->keterangan}}</p>
                    @endif
                    </div>
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
