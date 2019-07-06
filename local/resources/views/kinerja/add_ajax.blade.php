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
        <td><input type="text" name="jan[]" value="{{$row->jan}}"></td>
        <td><input type="text" name="feb[]" value="{{$row->feb}}"></td>
        <td><input type="text" name="mar[]" value="{{$row->mar}}"></td>
        <td><input type="text" name="apr[]" value="{{$row->apr}}"></td>
        <td><input type="text" name="mei[]" value="{{$row->mei}}"></td>
        <td><input type="text" name="jun[]" value="{{$row->jun}}"></td>
        <td><input type="text" name="jul[]" value="{{$row->jul}}"></td>
        <td><input type="text" name="agu[]" value="{{$row->agu}}"></td>
        <td><input type="text" name="sept[]" value="{{$row->sept}}"></td>
        <td><input type="text" name="okt[]" value="{{$row->okt}}"></td>
        <td><input type="text" name="nov[]" value="{{$row->nov}}"></td>
        <td><input type="text" name="des[]" value="{{$row->des}}"></td>
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