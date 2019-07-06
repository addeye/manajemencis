<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>DATA USAHA MIKRO DAN KECIL SASARAN PROGRAM PENDAMPINGAN {{Request::get('tahun')}}<br>{{$title}}<br>KEADAAN : 31 Desember {{Request::get('tahun')-1}}</title>
    <style>
        table{
            font-size: 12px;
        }
    </style>
</head>
<body>
    <div align="center">
            <h4>DATA USAHA MIKRO DAN KECIL SASARAN PROGRAM PENDAMPINGAN {{Request::get('tahun')}}<br>{{$title}}<br>KEADAAN : 31 Desember {{Request::get('tahun')-1}}</h4>
        <table width="100%" border="1" cellpadding="5" cellspacing="0">
            <thead>
                <tr>
                    <th rowspan="2">No</th>
                    <th rowspan="2">Nama UMKM</th>
                    <th rowspan="2">Alamat</th>
                    <th rowspan="2">Tahun<br>Mulai Usaha</th>
                    <th rowspan="2">Jenis Usaha</th>
                    <th rowspan="2">Legalitas</th>
                    <th rowspan="2">Tenaga<br>Kerja(orang)</th>
                    <th colspan="2">Permodalan</th>
                    <th rowspan="2">Asset</th>
                    <th rowspan="2">Omset</th>
                    <th rowspan="2">Kegiatan Usaha</th>
                </tr>
                <tr>
                    <th>Modal Sendiri</th>
                    <th>Modal Luar</th>
                </tr>
                </thead>
                <tbody>
                    @foreach ($baseumkm as $key=>$row)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$row->ukmtable->nama_usaha}}</td>
                            <td>{{$row->ukmtable->alamat}}</td>
                            <td>{{$row->ukmtable->tgl_mulai_usaha}}</td>
                            <td>{{$row->ukmtable->bidangusaha?$row->ukmtable->bidangusaha->name:''}}</td>
                            <td>{{$row->ukmtable->badan_usaha}}</td>
                            <td>{{isset($row->ukmtable->kumkm_detail[0])?$row->ukmtable->kumkm_detail[0]->jml_tenaga_kerja:''}}</td>
                            <td>{{isset($row->ukmtable->kumkm_detail[0])?number_format($row->ukmtable->kumkm_detail[0]->modal_sendiri):''}}</td>
                            <td>{{isset($row->ukmtable->kumkm_detail[0])?number_format($row->ukmtable->kumkm_detail[0]->modal_hutang):''}}</td>
                            <td>{{isset($row->ukmtable->kumkm_detail[0])?number_format($row->ukmtable->kumkm_detail[0]->asset):''}}</td>
                            <td>{{isset($row->ukmtable->kumkm_detail[0])?number_format($row->ukmtable->kumkm_detail[0]->omset):''}}</td>
                            <td>{{isset($row->ukmtable->kumkm_detail[0])?$row->ukmtable->kumkm_detail[0]->kegiatan_usaha:''}}</td>
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