<table id="example" class="table table-bordered table-striped">
    <thead>
    <tr>
        <th class="col-xs-1">No</th>
        <th>IKU Layanan</th>
        <th>Target</th>
        <th>Jan-Mar</th>
        <th>Apr-Jun</th>
        <th>Jul-Sept</th>
        <th>Okt-Des</th>
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
            <td align="right">{{$row->target!=''?number_format($row->target):0}}</td>
            <td align="right">{{$row->triwulan1!=''?number_format($row->triwulan1):0}}</td>
            <td align="right">{{$row->triwulan2!=''?number_format($row->triwulan2):0}}</td>
            <td align="right">{{$row->triwulan3!=''?number_format($row->triwulan3):0}}</td>
            <td align="right">{{$row->triwulan4!=''?number_format($row->triwulan4):0}}</td>
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