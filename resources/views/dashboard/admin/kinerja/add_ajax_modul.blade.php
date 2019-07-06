<form method="post" action="{{ url('adm/kinerja') }}">
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
        <td><input type="text" name="sasaran[]" {{$row->sasaran==''?'':'readonly'}} value="{{$row->sasaran}}"></td>
        <td><input type="text" name="target[]" {{$row->target==''?'':'readonly'}} value="{{$row->target}}"></td>
        <td><input type="text" name="jan[]" {{$row->jan==''?'':'readonly'}} value="{{$row->jan}}"></td>
        <td><input type="text" name="feb[]" {{$row->feb==''?'':'readonly'}} value="{{$row->feb}}"></td>
        <td><input type="text" name="mar[]" {{$row->mar==''?'':'readonly'}} value="{{$row->mar}}"></td>
        <td><input type="text" name="apr[]" {{$row->apr==''?'':'readonly'}} value="{{$row->apr}}"></td>
        <td><input type="text" name="mei[]" {{$row->mei==''?'':'readonly'}} value="{{$row->mei}}"></td>
        <td><input type="text" name="jun[]" {{$row->jun==''?'':'readonly'}} value="{{$row->jun}}"></td>
        <td><input type="text" name="jul[]" {{$row->jul==''?'':'readonly'}} value="{{$row->jul}}"></td>
        <td><input type="text" name="agu[]" {{$row->agu==''?'':'readonly'}} value="{{$row->agu}}"></td>
        <td><input type="text" name="sept[]" {{$row->sept==''?'':'readonly'}} value="{{$row->sept}}"></td>
        <td><input type="text" name="okt[]" {{$row->okt==''?'':'readonly'}} value="{{$row->okt}}"></td>
        <td><input type="text" name="nov[]" {{$row->nov==''?'':'readonly'}} value="{{$row->nov}}"></td>
        <td><input type="text" name="des[]" {{$row->des==''?'':'readonly'}} value="{{$row->des}}"></td>
    </tr>
    @endforeach
    <tr>
        <th colspan="2">KETERANGAN</th>
        <td colspan="6"><textarea name="kinerja_keterangan" row="6" cols="100" class="form-control">{{$keterangan_kinerja?$keterangan_kinerja->keterangan:''}}</textarea></td>
    </tr>
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