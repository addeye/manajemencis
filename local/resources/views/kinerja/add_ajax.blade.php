<form method="post" action="{{ url('kinerja-master') }}">
{{ csrf_field() }}
<input type="hidden" name="cis_lembaga_id" value="{{$lembaga_id}}">
<input type="hidden" name="tahun" value="{{$tahun}}">
<table class="table table-bordered table-striped">
    <tr>
        <th class="col-xs-1">No</th>
        <th>Standar_Layanan</th>
        <th>Sasaran</th>
        <th>Target</th>
        <th>Jan-Mar</th>
        <th>Apr-Jun</th>
        <th>Jul-Sept</th>
        <th>Okt-Des</th>
    </tr>
    <?php $no = 1;?>
    @foreach($kinerja as $row)
    <tr>
        <input type="hidden" name="standart_layanan_id[]" value="{{$row->id}}">
        <input type="hidden" name="kinerja_id[]" value="{{$row->kinerja_id}}">
        <td>{{$no++}}</td>
        <td>{{$row->nama}}</td>
        <td><input type="text" name="sasaran[]" value="{{$row->sasaran}}"></td>
        <td><input type="text" name="target[]" value="{{$row->target}}"></td>
        <td><input type="text" name="triwulan1[]" value="{{$row->triwulan1}}"></td>
        <td><input type="text" name="triwulan2[]" value="{{$row->triwulan2}}"></td>
        <td><input type="text" name="triwulan3[]" value="{{$row->triwulan3}}"></td>
        <td><input type="text" name="triwulan4[]" value="{{$row->triwulan4}}"></td>
    </tr>
    @endforeach
</table>
<div class="form-group">
<button type="submit" class="btn btn-default">
        <i class="fa fa-save"></i> Simpan
    </button>
    <button type="button" onclick="history.go(-1);" class="btn btn-default">
        <i class="fa fa-reply"></i> Kembali
    </button>
</div>
</form>