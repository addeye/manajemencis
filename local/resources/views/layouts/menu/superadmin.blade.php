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

    <li class="treeview {{active_check('cislembaga',true)}}">
        <a href="#">
            <i class="fa fa-home"></i> <span>Lembaga</span>
<span class="pull-right-container">
<i class="fa fa-angle-left pull-right"></i>
</span>
        </a>
        <ul class="treeview-menu">
            <li class="{{active_check('cislembaga/create')}}"><a href="{{ url('cislembaga/create') }}"><i
                            class="fa fa-circle-o"></i> Add Lembaga</a></li>
            <li class="{{active_check('cislembaga')}}"><a href="{{ url('cislembaga') }}"><i
                            class="fa fa-circle-o"></i> View Lembaga</a></li>
            <li class="{{active_check('cislembaga/report/all')}}"><a
                        href="{{ url('cislembaga/report/all') }}"><i
                            class="fa fa-circle-o"></i> Report Lembaga</a></li>
        </ul>
    </li>

    <li class="treeview {{active_check('admin',true)}}">
        <a href="#">
            <i class="fa fa-home"></i> <span>Admin</span>
<span class="pull-right-container">
<i class="fa fa-angle-left pull-right"></i>
</span>
        </a>
        <ul class="treeview-menu">
            <li class="{{active_check('admin/create')}}"><a href="{{ url('admin/create') }}"><i
                            class="fa fa-circle-o"></i> Add Admin</a></li>
            <li class="{{active_check('admin')}}"><a href="{{ url('admin') }}"><i
                            class="fa fa-circle-o"></i> View Admin</a></li>
        </ul>
    </li>

    <li class="treeview {{active_check('konsultan',true)}}">
        <a href="#">
            <i class="fa fa-users"></i> <span>Konsultan</span>
<span class="pull-right-container">
<i class="fa fa-angle-left pull-right"></i>
</span>
        </a>
        <ul class="treeview-menu">
            <li class="{{active_check('konsultan/create')}}"><a href="{{ url('konsultan/create') }}"><i
                            class="fa fa-circle-o"></i> Add Konsultan</a></li>
            <li class="{{active_check('konsultan')}}"><a href="{{ url('konsultan') }}"><i
                            class="fa fa-circle-o"></i> View Konsultan</a></li>
            <li class="{{active_check('konsultan/report')}}"><a href="{{ url('konsultan/report') }}"><i
                            class="fa fa-circle-o"></i> Report Konsultan</a></li>
        </ul>
    </li>
    <li class="treeview {{active_check('kumkm',true)}}">
        <a href="#">
            <i class="fa fa-briefcase"></i> <span>Manajemen UMKM</span>
<span class="pull-right-container">
<i class="fa fa-angle-left pull-right"></i>
</span>
        </a>
        <ul class="treeview-menu">
            <li class="{{active_check('kumkm')}}"><a href="{{url('kumkm')}}"><i class="fa fa-circle-o"></i>
                    View UMKM</a></li>
            <li><a href="#"><i class="fa fa-circle-o"></i> Pendampingan UMKM</a></li>
        </ul>
    </li>
    <li class="treeview {{active_check('sentra',true)}}">
        <a href="#">
            <i class="fa fa-university"></i> <span>Sentra UMKM</span>
<span class="pull-right-container">
<i class="fa fa-angle-left pull-right"></i>
</span>
        </a>
        <ul class="treeview-menu">
            <li class="{{active_check('sentra/create')}}"><a href="{{ url('sentra/create') }}"><i
                            class="fa fa-circle-o"></i> Add Sentra</a></li>
            <li class="{{active_check('sentra')}}"><a href="{{ url('sentra') }}"><i
                            class="fa fa-circle-o"></i> View Sentra</a></li>
            <li class="{{active_check('sentra/report/all')}}"><a href="{{ url('sentra/report/all') }}"><i
                            class="fa fa-circle-o"></i> Report Sentra</a></li>
        </ul>
    </li>
    <li class=""><a href="#"><i class="fa fa-dashboard"></i> <span>Produk Unggulan</span></a></li>
    <li class="{{active_check('pengumuman',true)}}"><a href="{{url('pengumuman')}}"><i
                    class="fa fa-info-circle"></i> <span>Pengumuman</span></a></li>
    <li class="treeview {{active_check('roles',true)}} {{active_check('u',true)}} {{active_check('set_kontak',true)}} {{active_check('sbanner',true)}} {{active_check('tingkat',true)}}">
        <a href="#">
            <i class="fa fa-cog"></i> <span>Setting</span>
<span class="pull-right-container">
<i class="fa fa-angle-left pull-right"></i>
</span>
        </a>
        <ul class="treeview-menu">
            <li class="{{active_check('sbanner',true)}}"><a href="{{ url('sbanner') }}"><i
                            class="fa fa-circle-o"></i> Banner</a></li>
            <li class="{{active_check('set_kontak',true)}}"><a href="{{ url('set_kontak') }}"><i
                            class="fa fa-circle-o"></i> Kontak</a></li>
            <li class="{{active_check('tingkat',true)}}"><a href="{{ url('tingkat') }}"><i
                            class="fa fa-circle-o"></i> Tingkat</a></li>
            <li class="{{active_check('roles',true)}}"><a href="{{ url('roles') }}"><i
                            class="fa fa-circle-o"></i> Roles</a></li>
            <li class="{{active_check('u',true)}}"><a href="{{ url('u') }}"><i class="fa fa-circle-o"></i>
                    Users</a></li>
        </ul>
    </li>
</ul>
