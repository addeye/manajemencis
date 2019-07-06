<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>LAPORAN TAHUNAN</title>
    <style>
        table{
            font-size: 12px;
        }
    </style>
</head>
<body>
    <div align="center">
        <h4>LAPORAN TAHUNAN<br>KONSULTAN PENDAMPING PLUT KUMKM<br>{{$title}}</h4>
        <table align="left">
            <tr>
                <td>NAMA KONSULTAN PENDAMPING : {{$konsultan->nama_lengkap}}</td>
            </tr>
        </table>
        <table width="100%" border="1" cellpadding="5" cellspacing="0">
            <thead>
                <tr>
                    <th rowspan="2">No</th>
                    <th rowspan="2">Nama Koperasi dan UMK</th>
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
        <br>
        <table width="100%">
            <tr>
                <td width="50%"></td>
                <td width="20%"></td>
                <td align="center" width="30%">
                    {{title_case($lembaga->regencies->name)}}, {{$tanggal_print}}<br>
                    KONSULTAN PENDAMPING BIDANG<br>
                    ................................
                    <br>
                    <br>
                    <br>
                    ({{$konsultan->nama_lengkap}})
                    <br>
                    Nama Konsultan Pendamping
                </td>
            </tr>
        </table>
    </div>
</body>
</html>