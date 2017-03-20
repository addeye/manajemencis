<div class="form-group">
    <label>Kecamatan</label>
    <select onchange="districts(this.value)" class="form-control select2" name="district_id" required>
        <option value="">Pilih Kecamatan</option>
        @foreach($districts as $row)
            <option value="{{ $row->id }}">{{ $row->name }}</option>
        @endforeach
    </select>
</div>

<script>
    $(".select2").select2();
</script>