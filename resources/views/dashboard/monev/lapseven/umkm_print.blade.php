<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>DATA USAHA MIKRO DAN KECIL DI KABUPATEN/KOTA {{$lembaga_c->regencies->name}}</title>
    <style>
        table{
            font-size: 12px;
        }
    </style>
</head>
<body>
    <div align="center">
            <h4>DATA USAHA MIKRO DAN KECIL {{$title}}</h4>
            <h4>KEADAAN : 31 Desember {{Request::get('tahun')-1}}</h4>
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
                                <td>{{$row->nama_usaha}}</td>
                                <td>{{$row->alamat}}</td>
                                <td>{{$row->tgl_mulai_usaha}}</td>
                                <td>{{$row->bidangusaha?$row->bidangusaha->name:''}}</td>
                                <td>{{$row->badan_usaha}}</td>
                                <td>{{isset($row->kumkm_detail[0])?$row->kumkm_detail[0]->jml_tenaga_kerja:''}}</td>
                                <td>{{isset($row->kumkm_detail[0])?number_format($row->kumkm_detail[0]->modal_sendiri):''}}</td>
                                <td>{{isset($row->kumkm_detail[0])?number_format($row->kumkm_detail[0]->modal_hutang):''}}</td>
                                <td>{{isset($row->kumkm_detail[0])?number_format($row->kumkm_detail[0]->asset):''}}</td>
                                <td>{{isset($row->kumkm_detail[0])?number_format($row->kumkm_detail[0]->omset):''}}</td>
                                <td>{{isset($row->kumkm_detail[0])?$row->kumkm_detail[0]->kegiatan_usaha:''}}</td>
                            </tr>
                        @endforeach
                    </tbody>
            </table>
    </div>
</body>
</html>