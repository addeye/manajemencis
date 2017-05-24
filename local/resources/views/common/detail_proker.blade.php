<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Pilih Kegiatan</label>
    <div class="col-sm-5">
        <select onchange="detailKegiatan(this.value)" class="form-control" name="detail_proker_id">
            <option value="0">Pilih</option>
            @foreach($detail as $row)
                <option value="{{$row->id}}">{{$row->jenis_kegiatan}}</option>
            @endforeach
        </select>
        <p class="text-danger">* Tidak wajib dipilih jika tidak ada dalam Program kerja</p>
    </div>
</div>