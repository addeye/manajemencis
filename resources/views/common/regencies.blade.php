<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Kabupaten/Kota</label>
    <div class="col-md-5">
        <select class="form-control" name="regency_id">
            <option value="">Pilih Kabupaten/Kota</option>
            @foreach($regencies as $row)
                <option value="{{ $row->id }}">{{ $row->id }} {{ $row->name }}</option>
            @endforeach
        </select>
    </div>
</div>