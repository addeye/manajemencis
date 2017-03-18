<?php
/**
 * Created by PhpStorm.
 * User: deyelovi
 * Date: 17/03/2017
 * Time: 14:24
 */
?>
<html>
<head>
    Konsultasi Online
</head>
<body>
<p>Nama : {{$user->name}}</p>
<p>Email : {{$user->email}}</p>
<hr>
<p>Respon : {{$konsultasi->respon}}</p>

<p>Silahkan balas ke email ( <a href="mailto:{{$user->email}}">{{$user->email}}</a> ) untuk konsultasi lebih lanjut dengan {{$user->name}}</p>

<h3>Terimakasih Sudah Berkunjung Di Manajamen CIS.</h3>

</body>
</html>
