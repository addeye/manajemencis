<?php
/**
 * Created by PhpStorm.
 * User: deyelovi
 * Date: 18/04/2017
 * Time: 10:22
 */
?>
<html>
<head>
    <title>Cetak Data KUMKM</title>
    <style>
        th {
            text-align: left;
        }
        img {
            width:150px;
            height: auto;
        }
    </style>
</head>
<body onload="window.print()">
<h2>Profil</h2>
<table width="100%" border="1" cellpadding="5" cellspacing="0">
    <tr>
        <th>Nama Usaha</th>
        <td> {{$data->nama_usaha}}</td>
        <th>ID KUMKM</th>
        <td> {{$data->id_kumkm}}</td>
    </tr>
    <tr>
        <th>Nama Pemilik</th>
        <td> {{$data->nama_pemilik}}</td>
        <th>No KTP</th>
        <td> {{$data->no_ktp}}</td>
    </tr>
    <tr>
        <th>NPWP</th>
        <td> {{$data->npwp}}</td>
        <th>Email</th>
        <td> {{$data->email}}</td>
    </tr>
    <tr>
        <th>No Telp</th>
        <td> {{$data->telp}}</td>
        <th>Badan Usaha</th>
        <td> {{$data->badan_usaha}}</td>
    </tr>
    <tr>
        <th>No Badan Usaha</th>
        <td> {{$data->ket_badan_usaha}}</td>
        <th>Tahun Mulai</th>
        <td> {{$data->tgl_mulai_usaha}}</td>
    </tr>
    <tr>
        <th>Bidang Usaha</th>
        <td> {{$data->bidangusaha?$data->bidangusaha->name:'-'}}</td>
        <th>Skala Usaha</th>
        <td> {{$data->skala_usaha}}</td>
    </tr>
    <tr>
        <th>Usaha Utama</th>
        <td> {{$data->usaha_utama}}</td>
        <th>Hasil Produk</th>
        <td> {{$data->hasil_produk}}</td>
    </tr>
    <tr>
        <th>Sentra</th>
        <td> {{$data->sentra}}</td>
        <th>Sentra ID</th>
        <td> {{$data->sentra_id}}</td>
    </tr>
    <tr>
        <th>Tenaga Kerja Tetap</th>
        <td> {{$data->tk_tetap}}</td>
        <th>Tenaga Kerja Tidak Tetap</th>
        <td> {{$data->tk_tidak_tetap}}</td>
    </tr>
    <tr>
        <th>Alamat</th>
        <td> {{$data->alamat}}, {{$data->villages->name}}, {{$data->districts->name}}, {{$data->regencies->name}}</td>
        <th>Provinsi</th>
        <td> {{$data->provinces->name}}</td>
    </tr>
</table>
<h2>Keuangan</h2>
<table width="100%" border="1" cellpadding="5" cellspacing="0">
    <tr>
        <th>Kas Tunai + Kas Bank</th>
        <td> {{$data->kas_tunai}}</td>
        <th>Persediaan (Bahan Baku + Produk)</th>
        <td> {{$data->persediaan}}</td>
    </tr>
    <tr>
        <th>Harga Tetap (Tanah, Bangunan, Mesin, dan Kendaraan)</th>
        <td> {{$data->harga_tetap}}</td>
        <th>Pinjaman Bank</th>
        <td> {{$data->kw_bank}}</td>
    </tr>
    <tr>
        <th>Pinjaman Koperasi</th>
        <td> {{$data->kw_koperasi}}</td>
        <th>Pinjaman Lainnya</th>
        <td> {{$data->kw_lainnya}}</td>
    </tr>
    <tr>
        <th>Kepemilikan tanah SHM</th>
        <td> {{$data->kp_sertifikat}}</td>
        <th>Tidak SHM</th>
        <td> {{$data->kp_tidak_sertifikat}}</td>
    </tr>
    <tr>
        <th>Omset 1 thn lalu</th>
        <td> {{$data->om_1thn_lalu}}</td>
        <th>Omset 2 thn lalu</th>
        <td> {{$data->om_2thn_lalu}}</td>
    </tr>
    <tr>
        <th>Laba 1 thn lalu</th>
        <td> {{$data->lb_1thn_lalu}}</td>
        <th>Laba 2 thn lalu</th>
        <td> {{$data->lb_2thn_lalu}}</td>
    </tr>
</table>
<h2>Pendampingan</h2>
<table width="100%" border="1" cellpadding="5" cellspacing="0">
    <tr>
        <th>Pendampingan yang pernah diterima</th>
        <td> {{$data->terima_pendampingan}}</td>
    </tr>
    <tr>
        <th colspan="2">Permasalahan yang dihadapi saat ini</th>
    </tr>
    <tr>
        <th>Kelembagaan Usaha</th>
        <td> {{$data->masalah_lembaga}}</td>
    </tr>
    <tr>
        <th>SDM</th>
        <td> {{$data->masalah_sdm}}</td>
    </tr>
    <tr>
        <th>Produksi</th>
        <td> {{$data->masalah_produksi}}</td>
    </tr>
    <tr>
        <th>Pembiayaan</th>
        <td> {{$data->masalah_pembiayaan}}</td>
    </tr>
    <tr>
        <th>Pemasaran</th>
        <td> {{$data->masalah_pemasaran}}</td>
    </tr>
    <tr>
        <th>Lainnya</th>
        <td> {{$data->masalah_lainnya}}</td>
    </tr>
</table>
</body>
</html>
