<div class="form-group">
    <label>Kelurahan</label>
    <select class="form-control select2" name="village_id" required>
        <option value="">Pilih Kelurahan</option>
        @foreach($villages as $row)
            <option value="{{ $row->id }}">{{ $row->name }}</option>
        @endforeach
    </select>
</div>

<script>
    $(".select2").select2();
</script>