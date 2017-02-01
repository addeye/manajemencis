<div class="form-group">
    <select class="form-control" name="regencies_id">
        <option value="">Pilih Kelurahan</option>
        @foreach($villages as $row)
            <option value="{{ $row->id }}">{{ $row->name }}</option>
        @endforeach
    </select>
</div>