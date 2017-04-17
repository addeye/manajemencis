<?php
/**
 * Created by PhpStorm.
 * User: deyelovi
 * Date: 13/04/2017
 * Time: 12:45
 */
?>
<html>
<head>
    <title></title>
    <style>
        th {
            text-align: left;
        }
    </style>
</head>
<body onload="window.print()">
<table width="100%" border="0" cellpadding="5" cellspacing="0">
    <tr>
        <td align="center" colspan="2">
            <img width="50%" src="{{url('images/'.$lembaga->photo_gedung)}}">
        </td>
    </tr>
    <tr>
        <th>ID Lembaga</th>
        <td>{{$lembaga->id_lembaga}}</td>
    </tr>
    <tr>
        <th>SKPD Penanggungjawab</th>
        <td>{{$lembaga->skpd_name}}</td>
    </tr>
    <tr>
        <th>Alamat</th>
        <td>{{$lembaga->skpd_alamat}}</td>
    </tr>
    <tr>
        <th>Telepon</th>
        <td>{{$lembaga->skpd_telp}}</td>
    </tr>
    <tr>
        <th>E-mail</th>
        <td>{{$lembaga->skpd_email}}</td>
    </tr>
    <tr>
        <th>Whatsapp</th>
        <td>{{$lembaga->skpd_whatsapp}}</td>
    </tr>
    <tr>
        <th>Nama PLUT-KUMKM</th>
        <td>{{$lembaga->plut_name}}</td>
    </tr>
    <tr>
        <th>Bentuk Kelembagaan</th>
        <td>{{$lembaga->plut_bentuk_kelembagaan}}</td>
    </tr>
    <tr>
        <th>Alamat</th>
        <td>{{$lembaga->plut_alamat}}</td>
    </tr>
    <tr>
        <th>Telp</th>
        <td>{{$lembaga->plut_telp}}</td>
    </tr>
    <tr>
        <th>Email</th>
        <td>{{$lembaga->plut_email}}</td>
    </tr>
    <tr>
        <th>Whatsapp</th>
        <td>{{$lembaga->plut_whatsapp}}</td>
    </tr>
    <tr>
        <th>Website</th>
        <td>{{$lembaga->plut_website}}</td>
    </tr>
    <tr>
        <th>Tahun Perolehan</th>
        <td>{{$lembaga->tahun_perolehan}}</td>
    </tr>
    <tr>
        <th>Mulai Operasional</th>
        <td>{{$lembaga->mulai_operasional}}</td>
    </tr>
    <tr>
        <th>Tanggal Peresmian</th>
        <td>{{$lembaga->tgl_peresmian}}</td>
    </tr>
    <tr>
        <th>Diresmikan Oleh</th>
        <td>{{$lembaga->diresmikan_oleh}}</td>
    </tr>
    <tr>
        <th>Hibah Tahun</th>
        <td>{{$lembaga->hibah_tahun}}</td>
    </tr>
    <tr>
        <th>Telah bersinergi dengan pihak</th>
        <td>{{$lembaga->ket_bersinergi}}</td>
    </tr>
    <tr>
        <th>Produk Unggulan Daerah</th>
        <td>{{$lembaga->produk_unggulan}}</td>
    </tr>
    <tr>
        <th>Yang sudah branding dan masuk pasar Lokal/Nasional/Ekspor</th>
        <td>{{$lembaga->pemasaran}}</td>
    </tr>
    <tr>
        <th>Produk lain yang potensial</th>
        <td>{{$lembaga->produk_potensial}}</td>
    </tr>
    <tr>
        <th>Jumlah UMKM yang telah memanfaatkan e-commarce</th>
        <td>{{$lembaga->jml_umkm_ecommarce}}</td>
    </tr>
    <tr>
        <th>Jumlah produk yang di pasarkan secara on-line</th>
        <td>{{$lembaga->jml_produk_online}}</td>
    </tr>
</table>
<hr>
<table width="100%" border="1" cellpadding="5" cellspacing="0">
    <tr>
        <td>Nama Sentra</td>
        <td>Jumlah UMKM</td>
        <td>Bidang Usaha</td>
        <td>Wilayah Pemasaran</td>
    </tr>
    @foreach($lembaga->sentra_kumkm as $row)
        <tr>
            <td>{{$row->name}}</td>
            <td>{{$row->total_kumkm}}</td>
            <td>{{$row->bidang_usahas->name}}</td>
            <td>{{$row->pemasaran}}</td>
        </tr>
    @endforeach
</table>
<hr>
<table width="100%" border="1" cellpadding="5" cellspacing="0">
    <tr>
        <td>Tipe</td>
        <td>Photo</td>
    </tr>
    @foreach($lembaga->cis_filemanager as $row)
    <tr>
        <td>{{$row->tipe}}</td>
        <td><img width="30%" src="{{url('image/'.$row->photo)}}"></td>
    </tr>
    @endforeach
</table>
</body>
</html>
