<?php
/**
 * Created by PhpStorm.
 * User: deyelovi
 * Date: 29/03/2017
 * Time: 11:22
 */
?>
<ul class="sidebar-menu">
    <li class="header">HEADER</li>
    <!-- Optionally, you can add icons to the links -->
    <li class="{{ Active::check('home') }}"><a href="{{ url('home') }}"><i class="fa fa-dashboard"></i>
            <span>Dashboard</span></a></li>
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
    <li class="{{active_check('k/lembaga',true)}}"><a href="{{ url('k/lembaga/detail') }}"><i
                    class="fa fa-home"></i> Lembaga</a></li>
    <li class="{{ Active::check('bio/konsultan',true) }}"><a href="{{ url('bio/konsultan') }}"><i
                    class="fa fa-dashboard"></i> <span>Biodata</span></a></li>
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
    <li class=""><a href="javascript:void(0)"><i class="fa fa-shopping-cart"></i> <span>Produk Unggulan</span></a></li>
    <li class="{{active_check('k/proker',true)}} {{active_check('k/dproker',true)}}"><a
                href="{{ url('k/proker') }}"><i class="fa fa-home"></i>
            Program Kerja</a></li>
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
    <li class=""><a href="javascript:void(0)"><i class="fa fa-compass"></i> <span>Pendampingan UMKM</span></a></li>
    <li class="treeview {{active_check('k/kegiatan',true)}}">
        <a href="#">
            <i class="fa fa-home"></i> <span>Pelaporan Kegiatan</span>
                <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
                </span>
        </a>
        <ul class="treeview-menu">
            <li class="{{active_check('k/kegiatan/create')}}"><a href="{{url('k/kegiatan/create')}}"><i
                            class="fa fa-circle-o"></i> Add Kegiatan</a></li>
            <li class="{{active_check('k/kegiatan')}}"><a href="{{url('k/kegiatan')}}"><i
                            class="fa fa-circle-o"></i> View Kegiatan</a></li>
            <li class="{{active_check('k/kegiatan/report/all')}}"><a href="{{url('k/kegiatan/report/all')}}"><i
                            class="fa fa-circle-o"></i> Report Kegiatan</a></li>
        </ul>
    </li>
    <li class="{{active_check('konsultasi/all')}}"><a href="{{url('konsultasi/all')}}"><i class="fa fa-comment-o"></i> <span>Konsultasi Online</span></a></li>
    <li class="{{active_check('informasipasar')}}"><a href="{{url('informasipasar')}}"><i class="fa fa-info-circle"></i> <span>Informasi pasar</span></a></li>
    <li class="{{active_check('info')}}"><a href="{{url('info')}}"><i class="fa fa-info"></i> <span>Info Terkini</span></a></li>
</ul>