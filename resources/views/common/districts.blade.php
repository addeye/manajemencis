<div class="form-group">
    <select class="form-control" name="regencies_id">
        <option value="">Pilih Kecamatan</option>
        @foreach($ditricts as $row)
            <option value="{{ $row->id }}">{{ $row->name }}</option>
        @endforeach
    </select>
</div>