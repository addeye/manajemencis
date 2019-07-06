<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>DATA KOPERASI SASARAN PROGRAM PENDAMPINGAN TAHUN {{Request::get('tahun')}}<br>{{$title}}<br>KEADAAN : 31 Desember {{Request::get('tahun')-1}}</title>
    <style>
        table{
            font-size: 12px;
        }
    </style>
</head>
<body>
    <div align="center">
        <h4>DATA KOPERASI SASARAN PROGRAM PENDAMPINGAN TAHUN {{Request::get('tahun')}}<br>{{$title}}<br>KEADAAN : 31 Desember {{Request::get('tahun')-1}}</h4>
        <table width="100%" border="1" cellpadding="5" cellspacing="0">
            <thead>
            <tr>
                <th rowspan="2">No</th>
                <th rowspan="2">Nama Koperasi</th>
                <th rowspan="2">Alamat</th>
                <th rowspan="2">Nomor dan <br> Tanggal <br> Badan Hukum</th>
                <th rowspan="2">Jenis Koperasi</th>
                <th rowspan="2">Tanggal<br>RAT<br>Tahun<br>Buku<br>{{Request::get('tahun')-1}}</th>
                <th rowspan="2">Anggota<br>(orang)</th>
                <th rowspan="2">Karyawan<br>(orang)</th>
                <th rowspan="2">Asset<br>(Rp.)</th>
                <th colspan="2">Permodalan (Rp.)</th>
                <th rowspan="2">Volume<br>Usaha (Rp.)</th>
                <th rowspan="2">Sisa Hasil<br>Usaha<br>(Rp.)</th>
                <th rowspan="2">Kegiatan Usaha</th>
            </tr>
            <tr>
                <th>Modal Sendiri</th>
                <th>Modal Luar</th>
            </tr>
            </thead>
            <tbody>
                @foreach ($basekoperasi as $key=>$row)
                <tr>
                    <td>{{$key+1}}</td>
                    <td>{{$row->ukmtable->nama_koperasi}}</td>
                    <td>{{$row->ukmtable->alamat}}</td>
                    <td>{{$row->ukmtable->nomor_badan_hukum}} & {{date('d-m-Y',strtotime($row->ukmtable->tgl_badan_hukum))}}</td>
                    <td>{{$row->ukmtable->jenis_koperasi}}</td>
                    <td>{{isset($row->ukmtable->koperasi_detail[0])?date('d-m-Y',strtotime($row->ukmtable->koperasi_detail[0]->tgl_rat_tahun_buku)):''}}</td>
                    <td>{{isset($row->ukmtable->koperasi_detail[0])?$row->ukmtable->koperasi_detail[0]->jml_anggota:''}}</td>
                    <td>{{isset($row->ukmtable->koperasi_detail[0])?$row->ukmtable->koperasi_detail[0]->jml_karyawan:''}}</td>
                    <td>{{isset($row->ukmtable->koperasi_detail[0])?number_format($row->ukmtable->koperasi_detail[0]->jml_asset):''}}</td>
                    <td>{{isset($row->ukmtable->koperasi_detail[0])?number_format($row->ukmtable->koperasi_detail[0]->jml_modal_sendiri):''}}</td>
                    <td>{{isset($row->ukmtable->koperasi_detail[0])?number_format($row->ukmtable->koperasi_detail[0]->jml_modal_luar):''}}</td>
                    <td>{{isset($row->ukmtable->koperasi_detail[0])?number_format($row->ukmtable->koperasi_detail[0]->valume_usaha):''}}</td>
                    <td>{{isset($row->ukmtable->koperasi_detail[0])?number_format($row->ukmtable->koperasi_detail[0]->sisa_hasil):''}}</td>
                    <td>{{isset($row->ukmtable->koperasi_detail[0])?$row->ukmtable->koperasi_detail[0]->kegiatan_usaha:''}}</td>
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