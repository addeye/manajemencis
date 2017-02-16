<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Kelurahan</label>
    <div class="col-md-5">
        <select class="form-control select2" name="village_id" required>
            <option value="">Pilih Kelurahan</option>
            @foreach($villages as $row)
                <option value="{{ $row->id }}">{{ $row->id }} {{ $row->name }}</option>
            @endforeach
        </select>
    </div>
</div>

<script>
    $(".select2").select2({
        theme: "bootstrap"
    });
</script>