<?php
/**
 * Created by PhpStorm.
 * User: deyelovi
 * Date: 29/03/2017
 * Time: 11:13
 */
?>
<ul class="sidebar-menu">
    <li class="header">HEADER</li>
    <!-- Optionally, you can add icons to the links -->
    <li class="{{ Active::check('home') }}"><a href="{{ url('home') }}"><i class="fa fa-dashboard"></i>
            <span>Dashboard</span></a></li>
    <li class="{{ Active::check('adm/lembaga/profil',true) }}"><a
                href="{{ url('adm/lembaga/profil') }}"><i
                    class="fa fa-dashboard"></i> <span>Profil Lembaga</span></a></li>
    <li class="treeview {{active_check('adm/sentra',true)}}">
        <a href="#">
            <i class="fa fa-home"></i> <span>Sentra UMKM</span>
            <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu">
            <li class="{{active_check('adm/sentra/create')}}"><a href="{{url('adm/sentra/create')}}"><i
                            class="fa fa-circle-o"></i> Add Sentra</a></li>
            <li class="{{active_check('adm/sentra')}}"><a href="{{url('adm/sentra')}}"><i
                            class="fa fa-circle-o"></i> View Sentra</a></li>
            <li class="{{active_check('adm/sentra/report/all')}}"><a
                        href="{{url('adm/sentra/report/all')}}"><i
                            class="fa fa-circle-o"></i> Report Sentra</a></li>
        </ul>
    </li>
    <li class="treeview {{active_check('kumkm',true)}}">
        <a href="#">
            <i class="fa fa-home"></i> <span>Data UMKM</span>
<span class="pull-right-container">
<i class="fa fa-angle-left pull-right"></i>
</span>
        </a>
        <ul class="treeview-menu">
            <li class="{{active_check('kumkm/create')}}"><a href="{{url('kumkm/create')}}"><i
                            class="fa fa-circle-o"></i> Add UMKM</a></li>
            <li class="{{active_check('kumkm')}}"><a href="{{url('kumkm')}}"><i
                            class="fa fa-circle-o"></i> View UMKM</a></li>
            <li class="{{active_check('kumkm/report/all')}}"><a href="{{url('kumkm/report/all')}}"><i
                            class="fa fa-circle-o"></i> Report UMKM</a></li>
        </ul>
    </li>
    <li class="treeview {{active_check('lembaga',true)}}">
        <a href="#">
            <i class="fa fa-home"></i> <span>Layanan Konsultasi</span>
<span class="pull-right-container">
<i class="fa fa-angle-left pull-right"></i>
</span>
        </a>
        <ul class="treeview-menu">
            <li class="{{active_check('lembaga/create')}}"><a href="#"><i
                            class="fa fa-circle-o"></i> Pendaftaran Baru</a></li>
            <li class="{{active_check('lembaga')}}"><a href="#"><i
                            class="fa fa-circle-o"></i> Daftar Pendaftar</a></li>
            <li class="{{active_check('lembaga/report/all')}}"><a href="#"><i
                            class="fa fa-circle-o"></i> Report Pendaftar</a></li>
        </ul>
    </li>
    <li class="treeview {{active_check('lembaga',true)}}">
        <a href="#">
            <i class="fa fa-file"></i> <span>Laporan</span>
<span class="pull-right-container">
<i class="fa fa-angle-left pull-right"></i>
</span>
        </a>
        <ul class="treeview-menu">
            <li class="{{active_check('lembaga/create')}}"><a href="#"><i
                            class="fa fa-circle-o"></i> Kegiatan Konsultan</a></li>
            <li class="{{active_check('lembaga')}}"><a href="#"><i
                            class="fa fa-circle-o"></i> Profil Konsultan</a></li>
            <li class="{{active_check('lembaga/report/all')}}"><a href="#"><i
                            class="fa fa-circle-o"></i> Proker Konsultan</a></li>
        </ul>
    </li>
    <li class="treeview {{active_check('bidanglayanan',true)}} {{active_check('jenislayanan',true)}} {{active_check('bidangusaha',true)}} {{active_check('provinces',true)}} {{active_check('regencies',true)}} {{active_check('districts',true)}}">
        <a href="#">
            <i class="fa fa-cube"></i> <span>Master Data</span>
                            <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                            </span>
        </a>
        <ul class="treeview-menu">
            <li class="{{active_check('bidanglayanan',true)}} {{active_check('jenislayanan',true)}} {{ active_check('bidangusaha',true) }}">
                <a href="#"><i class="fa fa-circle-o"></i> Bidang
                                <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                                </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ active_check('bidanglayanan',true) }}"><a href="{{url('bidanglayanan')}}"><i
                                    class="fa fa-circle-o"></i> Bidang Layanan</a></li>
                    <li class="{{ active_check('jenislayanan',true) }}"><a href="{{url('jenislayanan')}}"><i
                                    class="fa fa-circle-o"></i> IKU Layanan</a></li>
                    <li class="{{ active_check('bidangusaha',true) }}"><a href="{{ url('bidangusaha') }}"><i
                                    class="fa fa-circle-o"></i> Bidang Usaha</a></li>
                </ul>
            </li>
            <li class="{{active_check('provinces',true)}} {{active_check('regencies',true)}} {{active_check('districts',true)}}">
                <a href="#"><i class="fa fa-circle-o"></i> Wilayah
                                <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                                </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{active_check('provinces',true)}}"><a href="{{ url('provinces') }}"><i
                                    class="fa fa-circle-o"></i> Provinsi</a></li>
                    <li class="{{active_check('regencies',true)}}"><a href="{{ url('regencies') }}"><i
                                    class="fa fa-circle-o"></i> Kabupaten/Kota</a></li>
                    {{--<li class="{{active_check('districts',true)}}"><a href="{{ url('districts') }}"><i class="fa fa-circle-o"></i> Kecamatan</a></li>--}}
                </ul>
            </li>
        </ul>
    </li>
    <li class="{{active_check('report/konsultan')}}"><a href="{{url('report/konsultan')}}"><i class="fa fa-users"></i> <span>Report Konsultan</span></a></li>
    <li class="{{active_check('report/lembaga')}}"><a href="{{url('report/lembaga')}}"><i class="fa fa-home"></i> <span>Report Lembaga</span></a></li>
    <li class=""><a href="javascript:void(0)"><i class="fa fa-compass"></i> <span>Pendampingan UMKM</span></a></li>
    <li class=""><a href="javascript:void(0)"><i class="fa fa-shopping-cart"></i> <span>Produk Unggulan</span></a></li>
    <li class="{{active_check('konsultasi/all')}}"><a href="{{url('konsultasi/all')}}"><i class="fa fa-comment-o"></i> <span>Konsultasi Online</span></a></li>
    <li class="{{active_check('informasipasar')}}"><a href="{{url('informasipasar')}}"><i class="fa fa-info-circle"></i> <span>Informasi pasar</span></a></li>
    <li class="{{active_check('info')}}"><a href="{{url('info')}}"><i class="fa fa-info"></i> <span>Info Terkini</span></a></li>
</ul>
