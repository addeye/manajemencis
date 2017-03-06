<?php
/**
 * Created by PhpStorm.
 * User: deyelovi
 * Date: 21/01/2017
 * Time: 7:31
 */
?>
        <!-- Left side column. contains the sidebar -->
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ url('images/'.Auth::user()->path) }}" class="img-circle"
                     alt="User Image"/>
            </div>
            <div class="pull-left info">
                <p>{{ Auth::user()->name }}</p>
                <!-- Status -->
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <!-- Sidebar Menu -->
        @if(Auth::user()->role_id==1)
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
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-briefcase"></i> <span>Manajemen UMKM</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="pages/examples/invoice.html"><i class="fa fa-circle-o"></i> Input Data</a></li>
                        <li><a href="pages/examples/profile.html"><i class="fa fa-circle-o"></i> Pendampingan</a></li>
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
                <li class=""><a href=""><i class="fa fa-dashboard"></i> <span>Digitalisasi UMKM</span></a></li>
                <li class=""><a href=""><i class="fa fa-dashboard"></i> <span>Produk Unggulan</span></a></li>
                <li class="treeview {{active_check('roles',true)}} {{active_check('u',true)}} {{active_check('tingkat',true)}}">
                    <a href="#">
                        <i class="fa fa-cog"></i> <span>Setting</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                    </a>
                    <ul class="treeview-menu">
                        <li class="{{active_check('sbanner',true)}}"><a href="{{ url('sbanner') }}"><i
                                        class="fa fa-circle-o"></i> Banner</a></li>
                        <li class="{{active_check('tingkat',true)}}"><a href="{{ url('tingkat') }}"><i
                                        class="fa fa-circle-o"></i> Tingkat</a></li>
                        <li class="{{active_check('roles',true)}}"><a href="{{ url('roles') }}"><i
                                        class="fa fa-circle-o"></i> Roles</a></li>
                        <li class="{{active_check('u',true)}}"><a href="{{ url('u') }}"><i class="fa fa-circle-o"></i>
                                Users</a></li>
                    </ul>
                </li>
            </ul>
        @endif

        @if(Auth::user()->role_id==3)
            {{--For Konsultan--}}
            <ul class="sidebar-menu">
                <li class="header">HEADER</li>
                <!-- Optionally, you can add icons to the links -->
                <li class="{{ Active::check('home') }}"><a href="{{ url('home') }}"><i class="fa fa-dashboard"></i>
                        <span>Dashboard</span></a></li>
                <li class="{{ Active::check('bio/konsultan',true) }}"><a href="{{ url('bio/konsultan') }}"><i
                                class="fa fa-dashboard"></i> <span>Biodata</span></a></li>
                <li class="{{active_check('k/lembaga',true)}}"><a href="{{ url('k/lembaga/detail') }}"><i
                                class="fa fa-home"></i> View Lembaga</a></li>
                <li class="{{active_check('k/proker',true)}} {{active_check('k/dproker',true)}}"><a href="{{ url('k/proker') }}"><i class="fa fa-home"></i>
                        Program Kerja</a></li>
                <li class="{{active_check('k/kegiatan',true)}}"><a href="{{ url('k/kegiatan') }}"><i
                                class="fa fa-home"></i> Kegiatan</a></li>
            </ul>
        @endif

        @if(Auth::user()->role_id==2)
            {{--For admin--}}
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
                        <li class="{{active_check('adm/sentra/report/all')}}"><a href="{{url('adm/sentra/report/all')}}"><i
                                        class="fa fa-circle-o"></i> Report Sentra</a></li>
                    </ul>
                </li>
                <li class="treeview {{active_check('lembaga',true)}}">
                    <a href="#">
                        <i class="fa fa-home"></i> <span>Data UMKM</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                    </a>
                    <ul class="treeview-menu">
                        <li class="{{active_check('lembaga/create')}}"><a href="#"><i
                                        class="fa fa-circle-o"></i> Add UMKM</a></li>
                        <li class="{{active_check('lembaga')}}"><a href="#"><i
                                        class="fa fa-circle-o"></i> View UMKM</a></li>
                        <li class="{{active_check('lembaga/report/all')}}"><a href="#"><i
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

            </ul>
            @endif
                    <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>
