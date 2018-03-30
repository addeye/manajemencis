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
        <td><input type="text" name="sasaran[]" {{$row->sasaran==''?'':'readonly'}} value="{{$row->sasaran}}"></td>
        <td><input type="text" name="target[]" {{$row->target==''?'':'readonly'}} value="{{$row->target}}"></td>
        <td><input type="text" name="triwulan1[]" {{$row->triwulan1==''?'':'readonly'}} value="{{$row->triwulan1}}"></td>
        <td><input type="text" name="triwulan2[]" {{$row->triwulan2==''?'':'readonly'}} value="{{$row->triwulan2}}"></td>
        <td><input type="text" name="triwulan3[]" {{$row->triwulan3==''?'':'readonly'}} value="{{$row->triwulan3}}"></td>
        <td><input type="text" name="triwulan4[]" {{$row->triwulan4==''?'':'readonly'}} value="{{$row->triwulan4}}"></td>
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