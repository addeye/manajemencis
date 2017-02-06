<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Pilih Kegiatan</label>
    <div class="col-sm-5">
        <select class="form-control" name="detail_proker_id" required>
            <option value="">Pilih</option>
            @foreach($detail as $row)
                <option value="{{$row->id}}">{{$row->jenis_kegiatan}}</option>
            @endforeach
        </select>
    </div>
</div>