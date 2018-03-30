<table id="example" class="table table-bordered table-striped">
<thead>
<tr>
    <th class="col-xs-1">No</th>
    <th align="left">Standart layanan</th>
    <th align="left">Target</th>
    <th align="left">Jan-Mar</th>
    <th align="left">Apr-Jun</th>
    <th align="left">Jul-Sept</th>
    <th align="left">Okt-Des</th>
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
        <td align="right">{{number_format($row->triwulan1)}}</td>
        <td align="right">{{number_format($row->triwulan2)}}</td>
        <td align="right">{{number_format($row->triwulan3)}}</td>
        <td align="right">{{number_format($row->triwulan4)}}</td>
        <td align="right">{{number_format($row->total)}}</td>
        <td align="right">{{round($row->percent,2)}}%</td>
    </tr>
@endforeach
</tbody>
</table>