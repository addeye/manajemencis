<div class="form-group">
    <label>Kabupaten/Kota</label>
    <select onchange="regencies(this.value)" class="form-control select2" name="regency_id" required>
        <option value="">Pilih Kabupaten/Kota</option>
        @foreach($regencies as $row)
            <option value="{{ $row->id }}">{{ $row->name }}</option>
        @endforeach
    </select>
</div>
<script>
    $(".select2").select2();
</script>