<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Kecamatan</label>
    <div class="col-md-5">
        <select onchange="districts(this.value)" class="form-control" name="district_id" required>
            <option value="">Pilih Kecamatan</option>
            @foreach($districts as $row)
                <option value="{{ $row->id }}">{{ $row->name }}</option>
            @endforeach
        </select>
    </div>
</div>