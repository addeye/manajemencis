<?php
/**
 * Created by PhpStorm.
 * User: deyelovi
 * Date: 25/03/2017
 * Time: 15:31
 */
?>
<html>
<head>
    <title>Pemberitahuan Konsultasi</title>
</head>
<body>
<h3>Silhkan Direspon</h3>
<p>Nama : {{$data->nama}}</p>
<p>Email : {{$data->email}}</p>
<p>Telp : {{$data->telp}}</p>
<p>Alamat : {{$data->alamat}}</p>
<p>Produk : {{$data->produk}}</p>
<p>Permasalahan Bisni : {{$data->permasalahan_bisnis}}</p>
<p><a href="{{url('konsultasi/'.$data->id.'/detail')}}">Lihat konsultasi disini</a></p>
<hr>
Terimakasih atas kerjasamanya
<br>
#CISnasional
</body>
</html>
