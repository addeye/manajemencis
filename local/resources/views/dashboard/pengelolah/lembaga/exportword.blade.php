<?php
/**
 * Created by PhpStorm.
 * User: deyelovi
 * Date: 22/02/2017
 * Time: 16:40
 */
?>

<html>
<head>
    <meta charset="utf-8">
    <title>Export Word</title>
    <style>
        table th {
            vertical-align: top;
        }
        table th {
            text-align: left;
        }
    </style>
</head>
<body>
<div style="text-align: center">
    <h2>Profil CIS PLUT-UMKM</h2>
    <h3>{{$data->plut_name}}</h3>
</div>
<div style="text-align: left">
    <table width="100%" border="0" cellspacing="0" cellpadding="5">
        <tr>
            <th>1.</th>
            <th>SKPD Penanggungjawab</th>
            <th>:</th>
            <td>{{$data->skpd_name}}</td>
        </tr>
        <tr>
            <th></th>
            <th>Alamat</th>
            <th>:</th>
            <td>{{$data->skpd_alamat}}</td>
        </tr>
        <tr>
            <th></th>
            <th>Telepon</th>
            <th>:</th>
            <td>{{$data->skpd_telp}}</td>
        </tr>
        <tr>
            <th></th>
            <th>E-Mail</th>
            <th>:</th>
            <td>{{$data->skpd_email}}</td>
        </tr>
        <tr>
            <th></th>
            <th>Whatsapp</th>
            <th>:</th>
            <td>{{$data->skpd_whatsapp}}</td>
        </tr>
        <tr>
            <th>2.</th>
            <th>Nama PLUT-KUMKM</th>
            <th>:</th>
            <td>{{$data->plut_name}}</td>
        </tr>
        <tr>
            <th></th>
            <th>Bentuk Kelembagaan</th>
            <th>:</th>
            <td>{{$data->plut_bentuk_kelembagaan}}</td>
        </tr>
        <tr>
            <th></th>
            <th>Provinsi</th>
            <th>:</th>
            <td>{{$data->provinces->name}}</td>
        </tr>
        <tr>
            <th></th>
            <th>Kabupaten/Kota</th>
            <th>:</th>
            <td>{{$data->regencies->name}}</td>
        </tr>
        <tr>
            <th></th>
            <th>Alamat</th>
            <th>:</th>
            <td>{{$data->plut_alamat}}</td>
        </tr>
        <tr>
            <th></th>
            <th>Telepon</th>
            <th>:</th>
            <td>{{$data->plut_telp}}</td>
        </tr>
        <tr>
            <th></th>
            <th>E-Mail</th>
            <th>:</th>
            <td>{{$data->plut_email}}</td>
        </tr>
        <tr>
            <th></th>
            <th>Whatsapp</th>
            <th>:</th>
            <td>{{$data->plut_whatsapp}}</td>
        </tr>
        <tr>
            <th></th>
            <th>Website</th>
            <th>:</th>
            <td>{{$data->plut_website}}</td>
        </tr>
        <tr>
            <th></th>
            <th>Facebook</th>
            <th>:</th>
            <td>{{$data->plut_facebook}}</td>
        </tr>
        <tr>
            <th>3.</th>
            <th>Tahun Perolehan</th>
            <th>:</th>
            <td>{{$data->tahun_perolehan}}</td>
        </tr>
        <tr>
            <th></th>
            <th>Mulai Operasional</th>
            <th>:</th>
            <td>{{$data->mulai_operasional}}</td>
        </tr>
        <tr>
            <th></th>
            <th>Tanggal Peresmian</th>
            <th>:</th>
            <td>{{$data->tgl_peresmian}}</td>
        </tr>
        <tr>
            <th></th>
            <th>Diresmikan Oleh</th>
            <th>:</th>
            <td>{{$data->diresmikan_oleh}}</td>
        </tr>
        <tr>
            <th></th>
            <th>Hibah Tahun</th>
            <th>:</th>
            <td>{{$data->hibah_tahun}}</td>
        </tr>
        <tr>
            <th>4</th>
            <th>Telah bersinergi dengan pihak</th>
            <th>:</th>
            <td>{{$data->ket_bersinergi}}</td>
        </tr>
        <tr>
            <th>5</th>
            <th>Sentra Binaan Yang Terlibat</th>
            <th>:</th>
            <td>
                @foreach($data->sentra_binaan as $row)
                <ul>
                    <li>Nama Sentra : {{$row->nama_sentra}}</li>
                    <li>Jumlah UMKM : {{$row->jml_ukmk_sentra}}</li>
                    <li>Produk/Bidang Usaha : {{$row->bidang_usaha_sentra}}</li>
                    <li>Wilayah Pemasaran : {{$row->wilayah_pemasaran}}</li>
                </ul>
                    @endforeach
            </td>
        </tr>
        <tr>
            <th>6</th>
            <th>Produk Unggulan Daerah</th>
            <th>:</th>
            <td>{{$data->produk_unggulan}}</td>
        </tr>
        <tr>
            <th></th>
            <th>Yang sudah branding dan masuk pasar Lokal/Nasional/Ekspor</th>
            <th>:</th>
            <td>{{$data->pemasaran}}</td>
        </tr>
        <tr>
            <th></th>
            <th>Produk Lain Yang Potensial</th>
            <th>:</th>
            <td>{{$data->produk_potensial}}</td>
        </tr>
        <tr>
            <th></th>
            <th colspan="3">Digitalisasi UMKM</th>
        </tr>
        <tr>
            <th></th>
            <th>Jumlah UMKM yang telah memanfaatkan e-commarce</th>
            <th>:</th>
            <td>{{$data->jml_umkm_ecommarce}}</td>
        </tr>
        <tr>
            <th></th>
            <th>Jumlah produk yang di pasarkan secara on-line</th>
            <th>:</th>
            <td>{{$data->jml_produk_online}}</td>
        </tr>
    </table>
</div>
</body>
</html>
