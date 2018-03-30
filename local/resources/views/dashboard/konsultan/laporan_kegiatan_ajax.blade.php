<table id="example" class="table table-bordered table-striped">
    <thead>
    <tr>
        <th class="col-xs-1">No</th>
        <th>Judul Kegiatan</th>
        <th>Bidang Usaha</th>
        <th>Lokasi</th>
        <th>Tanggal Mulai</th>
        <th>Tanggal Selesai</th>
        <th>Peserta</th>
        <th>Output</th>
        <th>Keterangan Output</th>
        <th>Sumberdaya</th>
        <th>Mitra Kegiatan</th>
        <th>Rencana Tindak Lanjut</th>
    </tr>
    </thead>
    <tbody>
    <?php $no = 1;?>
    @foreach($kegiatan as $row)
        <tr>
            <td>{{$no++}}</td>
            <td>{{$row->judul_kegiatan}}</td>
            <td>{{$row->bidang_usahas->name}}</td>
            <td>{{$row->lokasi_kegiatan}}</td>
            <td>{{$row->tanggal_mulai}}</td>
            <td>{{$row->tanggal_selesai}}</td>
            <td>{{$row->jumlah_peserta}}</td>
            <td>{{$row->output}}</td>
            <td>{{$row->ket_output}}</td>
            <td>{{$row->sumber_daya}}</td>
            <td>{{$row->mitra_kegiatan}}</td>
            <td>{{$row->rencana_tindak_lanjut}}</td>
        </tr>
    @endforeach
    </tbody>
</table>