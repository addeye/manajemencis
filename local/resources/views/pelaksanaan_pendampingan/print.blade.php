<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Kartu Pelaksanaan Pendampingan Koperasi Dan UMK</title>
</head>
<body>
    <h1>Kartu Pelaksanaan Pendampingan Koperasi Dan UMK</h1>
    <table class="table" border="1" cellspacing="0" cellpadding="5">
        <thead>
        <tr>
            <th rowspan="2">No</th>
            <th rowspan="2">Lembaga</th>
            <th rowspan="2">Nama KUMKM</th>
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
            <?php $no = 1;?>
            @foreach ($data as $row)
                <tr>
                    <td>{{$no++}}</td>
                    <td>{{$row->lembaga->plut_name}}</td>
                    <td>{{$row->nama_kumkm}}</td>
                    <td>{{$row->program_kerja->permasalahan}}</td>
                    <td>{{$row->program_kerja->proker_pendampingan}}</td>
                    <td>{{date('d/m/Y',strtotime($row->tanggal))}}</td>
                    <td>{{$row->materi}}</td>
                    <td>{{$row->tindak_lanjut}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>