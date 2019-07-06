<table id="example" class="table table-bordered table-striped">
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