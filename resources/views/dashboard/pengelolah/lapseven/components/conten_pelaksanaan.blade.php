<div class="table-responsive">
    <p><a target="_blank" href="{{url('manager/laporan-pelaksanaan-pendampingan-print?tahun='.Request::get('tahun').'&konsultan_id='.Request::get('konsultan_id').'&kumkm_sasaran_id='.Request::get('kumkm_sasaran_id'))}}" class="btn btn-danger"><i class="fa fa-print"></i> Print</a></p>
    <h4>KARTU PELAKSANAAN PENDAMPINGAN KOPERASI DAN UMKM {{$tahun}}</h4>
    <h4>{{$title}}</h4>
    <p>NAMA KONSULTAN PENDAMPING : {{$konsultan->nama_lengkap}}</p>
    <p>NAMA KOPERASI DAN UMKM : {{$sasaran->ukmtable->nama_kumkm}}</p>
    <table class="table table-bordered table-striped">
        <thead>
        <tr>
            <th rowspan="2">No</th>
            <th rowspan="2">Identifikasi Permsalahan<br>(Per Bidang Layanan)</th>
            <th rowspan="2">Program Kerja Pendampingan</th>
            <th colspan="2">Pelaksanaan Pendampingan</th>
            <th rowspan="2">Skema Tindakan Lebih Lanjut</th>
        </tr>
        <tr>
            <th>Tgl/Bln/Thn</th>
            <th>Materi Pendampingan</th>
        </tr>
        </thead>
        <tbody>
            @foreach ($data as $key=>$row)
                <tr>
                    <td>{{$key+1}}</td>
                    <td>{{$row->program_kerja->permasalahan}}</td>
                    <td>{{$row->program_kerja->proker_pendampingan}}</td>
                    <td>{{date('d/m/Y',strtotime($row->tanggal))}}</td>
                    <td>{{$row->materi}}</td>
                    <td>{{$row->tindak_lanjut}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>