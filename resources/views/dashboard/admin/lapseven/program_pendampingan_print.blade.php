<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>KARTU PROGRAM KERJA PLUT KUMKM {{$title}}<br>PER INDIVIDU KOPERASI DAN UMKM SELAMA {{Request::get('tahun')}}</title>
    <style>
        table{
            font-size: 12px;
        }
    </style>
</head>
<body>
    <div align="center">
        <h4>KARTU PROGRAM KERJA PLUT KUMKM {{$title}}<br>PER INDIVIDU KOPERASI DAN UMKM SELAMA {{Request::get('tahun')}}</h4>
        <table align="left">
            <tr>
                <td>NAMA KOPERASI DAN UMKM : {{$kumkm->ukmtable->nama_kumkm}}</td>
            </tr>
        </table>
        <table width="100%" border="1" cellpadding="5" cellspacing="0">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Identifikasi Permasalahan <br> (Per Bidang Layanan)</th>
                    <th>Program Kerja Pendampingan Tahun <br>{{date('Y')}}</th>
                    <th>Target Capaian</th>
                    <th>Konsultan Pendamping Penanggung Jawab</th>
                </tr>
                </thead>
                <tbody>
                    @foreach ($data as $key=>$row)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$row->permasalahan}}</td>
                            <td>{{$row->proker_pendampingan}}</td>
                            <td>{{$row->target_capaian}}</td>
                            <td>{{$row->bidang_layanan->name}}</td>
                        </tr>
                    @endforeach
                </tbody>
        </table>
        <h4>{{$lembaga_c->regencies->name}}, {{$tanggal_print}}</h4>
        <h4>KONSULTAN PENDAMPING</h4>
        <table width="100%" style="font-size:16px;" border="0" cellpadding="5" cellspacing="0">
            <tr align="center" valign="bottom" >
                <td>Bidang<br>Kelembagaan</td>
                <td>Bidang SDM</td>
                <td>Bidang Produksi</td>
                <td>Bidang<br>Pembiayaan</td>
                <td>Bidang<br>Pemasaran</td>
                <td>Bidan Pengem-<br>bangan Teknolo-<br>gi Informasi</td>
                <td>Bidang Pengem-<br>bangan Jaringan<br>Kerjasama</td>
            </tr>
        <table
    </div>
</body>
</html>