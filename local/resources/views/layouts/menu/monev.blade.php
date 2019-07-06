<?php
/**
 * Created by PhpStorm.
 * User: deyelovi
 * Date: 29/03/2017
 * Time: 11:23
 */
?>
<ul class="sidebar-menu">
    <li class="header">HEADER</li>
    <!-- Optionally, you can add icons to the links -->
    <li class="{{ Active::check('home') }}"><a href="{{ url('home') }}"><i class="fa fa-dashboard"></i>
            <span>Dashboard</span></a></li>
    <li class="treeview {{active_check('profil/lembaga',true)}} {{active_check('profil/pengelola',true)}} {{active_check('profil/konsultan',true)}} {{active_check('profil/admin',true)}}">
        <a href="#">
            <i class="fa fa-user"></i> <span>Profil</span>
            <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu">
            <li class="{{active_check('profil/lembaga',true)}}"><a href="{{url('profil/lembaga')}}"><i class="fa fa-circle-o"></i> Lembaga</a></li>
            <li class="{{active_check('profil/pengelola',true)}}"><a href="{{url('profil/pengelola')}}"><i class="fa fa-circle-o"></i> Pengelola</a></li>
            <li class="{{active_check('profil/konsultan',true)}}"><a href="{{url('profil/konsultan')}}"><i class="fa fa-circle-o"></i> Konsultan</a></li>
            <li class="{{active_check('profil/admin',true)}}"><a href="{{url('profil/admin')}}"><i class="fa fa-circle-o"></i> Admin</a></li>
        </ul>
    </li>
    <li class="treeview {{active_check('data-pendampingan/laporan-pelaksanaan-final',true)}} {{active_check('data-pendampingan/sasaran/koperasi',true)}} {{active_check('data-pendampingan/sasaran/umkm',true)}} {{active_check('data-pendampingan/program-kerja',true)}} {{active_check('data-pendampingan/pelaksanaan',true)}}">
        <a href="#">
            <i class="fa fa-users"></i> <span>Pendampingan</span>
            <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu">
                <li class="{{active_check('database/koperasi',true)}}"><a href="{{url('database/koperasi')}}"><i class="fa fa-circle-o"></i> Koperasi 7a</a></li>
                <li class="{{active_check('database/umkm',true)}}"><a href="{{url('database/umkm')}}"><i class="fa fa-circle-o"></i> UMKM 7b</a></li>
            <li class="treeview {{active_check('data-pendampingan/sasaran/koperasi',true)}} {{active_check('data-pendampingan/sasaran/umkm',true)}}">
                <a href="#">
                    <i class="fa fa-circle-o"></i> <span>Sasaran Program 7c & 7d</span>
                    <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{active_check('data-pendampingan/sasaran/koperasi',true)}}"><a href="{{url('data-pendampingan/sasaran/koperasi')}}"><i class="fa fa-circle-o"></i> Koperasi 7c</a></li>
                    <li class="{{active_check('data-pendampingan/sasaran/umkm',true)}}"><a href="{{url('data-pendampingan/sasaran/umkm')}}"><i class="fa fa-circle-o"></i> UMKM 7d</a></li>
                </ul>
            </li>
            <li class="{{active_check('data-pendampingan/program-kerja',true)}}"><a href="{{url('data-pendampingan/program-kerja')}}"><i class="fa fa-circle-o"></i> Prog. Pendampingan 7e</a></li>
            <li class="{{active_check('data-pendampingan/pelaksanaan',true)}}"><a href="{{url('data-pendampingan/pelaksanaan')}}"><i class="fa fa-circle-o"></i> Pel. Pendampingan 7f</a></li>
            <li class="{{active_check('data-pendampingan/laporan-pelaksanaan-final',true)}}"><a href="{{url('data-pendampingan/laporan-pelaksanaan-final')}}"><i class="fa fa-circle-o"></i> Lap. Per Konsultan 7g</a></li>
        </ul>
    </li>
    <li class="treeview {{active_check('laporan-monev/laporan-kumkm-perbidang')}} {{active_check('laporan-monev/progress',true)}} {{active_check('laporan-monev/porgress-iku',true)}} {{active_check('laporan-monev/porgress-iku-plut',true)}} {{active_check('laporan-monev/rekap-program-per-bidang',true)}}">
        <a href="#">
            <i class="fa fa-file"></i> <span>Laporan</span>
            <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu">
            <li class="{{active_check('laporan-monev/progress',true)}}"><a href="{{url('laporan-monev/progress')}}"><i class="fa fa-circle-o"></i> Progress Pendampingan</a></li>
            <li class="{{active_check('laporan-monev/rekap-program-per-bidang',true)}}"><a href="{{url('laporan-monev/rekap-program-per-bidang')}}"><i class="fa fa-circle-o"></i> Rekap Program Per Bidang</a></li>
            <li class="{{active_check('laporan-monev/rekap-pelaksanaan-program-per-bidang',true)}}"><a href="{{url('laporan-monev/rekap-pelaksanaan-program-per-bidang')}}"><i class="fa fa-circle-o"></i> Rekap Pelaksanaan Per Bidang</a></li>
        <li class="{{active_check('laporan-monev/laporan-kumkm-perbidang')}}"><a href="{{url('laporan-monev/laporan-kumkm-perbidang')}}"><i class="fa fa-circle-o"></i> Komparasi</a></li>
            <li class="{{active_check('laporan-monev/porgress-iku',true)}}"><a href="{{url('laporan-monev/porgress-iku')}}"><i class="fa fa-circle-o"></i> Rekap Capaian IKU</a></li>
            <li class="{{active_check('laporan-monev/porgress-iku-plut',true)}}"><a href="{{url('laporan-monev/porgress-iku-plut')}}"><i class="fa fa-circle-o"></i> Progress Capaian IKU per Plut</a></li>
        </ul>
    </li>
    <li class="{{active_check('info',true)}}"><a href="{{ url('info') }}">
        <i class="fa fa-info-circle"></i><span>Info Terkini</span></a>
    </li>
</ul>
