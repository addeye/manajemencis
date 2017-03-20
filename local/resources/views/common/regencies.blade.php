<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Kabupaten/Kota</label>
    <div class="col-md-5">
        <select onchange="regencies(this.value)" class="form-control select2" name="regency_id" required>
            <option value="">Pilih Kabupaten/Kota</option>
            @foreach($regencies as $row)
                <option value="{{ $row->id }}">{{ $row->name }}</option>
            @endforeach
        </select>
    </div>
</div>
<script>
    $(".select2").select2();
</script>