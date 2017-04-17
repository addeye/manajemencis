<?php
/**
 * Created by PhpStorm.
 * User: deyelovi
 * Date: 17/04/2017
 * Time: 11:47
 */
?>
<html>
<head>
    <title></title>
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
<table width="100%" border="1" cellspacing="0" cellpadding="5">
    <tr>
      <th>No Registrasi</th>
      <td>{{ $data->no_registrasi }}</td>
    </tr>
    <tr>
        <th>Nama Lengkap</th>
        <td>{{ $data->nama_lengkap }}</td>
    </tr>
    <tr>
        <th>Jenis Kelamin</th>
        <td>{{ $data->jenis_kelamin=='P'?'Perempuan':'Laki-laki' }}</td>
    </tr>
    <tr>
        <th>Tanggal Lahir</th>
        <td>{{ $data->tanggal_lahir }}</td>
    </tr>
    <tr>
        <th>Email</th>
        <td>{{ $data->email }}</td>
    </tr>
    <tr>
        <th>Provinsi</th>
        <td>{{ $data->provinces->name }}</td>
    </tr>
    <tr>
        <th>Kabupaten</th>
        <td>{{ $data->regencies->name }}</td>
    </tr>
    <tr>
        <th>Alamat</th>
        <td>{{ $data->alamat }} {{ $data->kode_pos }}</td>
    </tr>
    <tr>
        <th>Pendidikan terakhir</th>
        <td>{{ $data->pendidikans->name }}</td>
    </tr>
    <tr>
        <th>Nama sekolah/perguruan tinggi terakhir</th>
        <td>{{ $data->perguruan_terakhir }}</td>
    </tr>
    <tr>
        <th>Jurusan/prodi</th>
        <td>{{ $data->jurusan }}</td>
    </tr>
    <tr>
        <th>Kompetensi/bidang keahlian pendampingan</th>
        <td>{{ $data->bidang_keahlian }}</td>
    </tr>
    <tr>
        <th>Pengalaman</th>
        <td>{{ $data->pengalaman }}</td>
    </tr>
    <tr>
        <th>Sertifikat</th>
        <td>{{ $data->sertifikat }}</td>
    </tr>
    <tr>
        <th>Asosiasi</th>
        <td>{{ $data->asosiasi }}</td>
    </tr>
    <tr>
        <th>Lembaga</th>
        <td>{{ $data->lembagas->plut_name }}</td>
    </tr>
    <tr>
        <th>Bidang Layanan</th>
        <td>{{ $data->bidang_layanans->name }}</td>
    </tr>
</table>
<table width="100%" border="1" cellspacing="0" cellpadding="5">
    <tr>
        <td><img src="{{ url('images/'.$data->pas_photo) }}" class="img-responsive" alt="Responsive image"></td>
        <td><img src="{{ url('lampiran/'.$data->scan_ktp) }}" class="img-responsive" alt="Responsive image"></td>
        <td><img src="{{ url('lampiran/'.$data->ijazah) }}" class="img-responsive" alt="Responsive image"></td>
        <td><img src="{{ url('lampiran/'.$data->sertifikat_1) }}" class="img-responsive" alt="Responsive image"></td>
    </tr>
    <tr>
        <td>Pas Photo</td>
        <td>Scan KTP</td>
        <td>Ijazah</td>
        <td>Sertifikat</td>
    </tr>
</table>
</body>
</html>
