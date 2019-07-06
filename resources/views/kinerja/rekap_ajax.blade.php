<table id="example" class="table table-bordered table-striped">
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