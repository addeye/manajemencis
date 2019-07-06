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
    <li class="treeview {{active_check('bidanglayanan',true)}} {{active_check('jenislayanan',true)}} {{active_check('bidangusaha',true)}} {{active_check('provinces',true)}} {{active_check('regencies',true)}} {{active_check('districts',true)}} {{ active_check('standart-layanan',true) }}">
        <a href="#">
            <i class="fa fa-cube"></i> <span>Master Data</span>
                            <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                            </span>
        </a>
        <ul class="treeview-menu">
            <li class="{{active_check('bidanglayanan',true)}} {{active_check('jenislayanan',true)}} {{ active_check('bidangusaha',true) }} {{ active_check('standart-layanan',true) }}">
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
                    <li class="{{ active_check('standart-layanan',true) }}"><a href="{{ url('standart-layanan') }}"><i
                                    class="fa fa-circle-o"></i> Standart Layanan</a></li>
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

    <li class="treeview {{active_check('monev',true)}}">
        <a href="#">
            <i class="fa fa-user"></i> <span>Monev</span>
            <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu">
            <li class="{{active_check('monev/create')}}"><a href="{{ url('monev/create') }}"><i
                            class="fa fa-circle-o"></i> Add Monev</a></li>
            <li class="{{active_check('monev')}}"><a href="{{ url('monev') }}"><i
                            class="fa fa-circle-o"></i> View Monev</a></li>
        </ul>
    </li>

    <li class="treeview {{active_check('pengelola',true)}}">
        <a href="#">
            <i class="fa fa-user"></i> <span>Pengelola</span>
            <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu">
            <li class="{{active_check('pengelolah/create')}}"><a href="{{ url('pengelolah/create') }}"><i
                            class="fa fa-circle-o"></i> Add Pengelola</a></li>
            <li class="{{active_check('pengelolah')}}"><a href="{{ url('pengelolah') }}"><i
                            class="fa fa-circle-o"></i> View Pengelola</a></li>
        </ul>
    </li>

    <li class="treeview {{active_check('admin',true)}} {{active_check('proker-plut')}}">
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
            <li class="{{active_check('proker-plut')}}"><a href="{{ url('proker-plut') }}"><i
                            class="fa fa-circle-o"></i> Proker Plut</a></li>
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
    <li class="treeview {{active_check('database-koperasi',true)}} {{active_check('database-koperasi-laporan')}} {{active_check('database-umkm-laporan')}} {{active_check('database-umkm')}} {{active_check('sentra',true)}}">
        <a href="#">
            <i class="fa fa-cubes">
            </i>
            <span>
                Database
            </span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right">
                </i>
            </span>
        </a>
        <ul class="treeview-menu">
            <li class="treeview {{active_check('database-koperasi',true)}} {{active_check('database-koperasi-laporan')}}">
                <a href="#">
                    <i class="fa fa-circle-o">
                    </i>
                    <span>
                        Data Koperasi (7a)
                    </span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right">
                        </i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{active_check('database-koperasi',true)}}">
                        <a href="{{ url('database-koperasi') }}">
                            <i class="fa fa-circle-o">
                            </i>
                            View Koperasi
                        </a>
                    </li>
                    <li class="{{active_check('database-koperasi-laporan')}}">
                        <a href="{{ url('database-koperasi-laporan') }}">
                            <i class="fa fa-circle-o">
                            </i>
                            Report Koperasi
                        </a>
                    </li>
                </ul>
            </li>
            <li class="treeview {{active_check('database-umkm-laporan')}} {{active_check('database-umkm')}}">
                <a href="#">
                    <i class="fa fa-circle-o">
                    </i>
                    <span>
                        Data UMKM (7b)
                    </span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right">
                        </i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{active_check('database-umkm')}}">
                        <a href="{{url('database-umkm')}}">
                            <i class="fa fa-circle-o">
                            </i>
                            View UMKM
                        </a>
                    </li>
                    <li class="{{active_check('database-umkm-laporan')}}">
                        <a href="{{url('database-umkm-laporan')}}">
                            <i class="fa fa-circle-o">
                            </i>
                            Report UMKM
                        </a>
                    </li>
                </ul>
            </li>
            <li class="treeview {{active_check('sentra',true)}}">
                    <a href="#">
                        <i class="fa fa-circle-o"></i> <span>Sentra UMKM</span>
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
            <li class="treeview {{active_check('produk_unggulan',true)}} {{active_check('produk_unggulan/report/all')}}">
                <a href="#">
                    <i class="fa fa-circle-o">
                    </i>
                    <span>
                        Produk Unggulan
                    </span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right">
                        </i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{active_check('produk_unggulan/create')}}">
                        <a href="{{url('produk_unggulan/create')}}">
                            <i class="fa fa-circle-o">
                            </i>
                            Add Produk Unggulan
                        </a>
                    </li>
                    <li class="{{active_check('produk_unggulan')}}">
                        <a href="{{url('produk_unggulan')}}">
                            <i class="fa fa-circle-o">
                            </i>
                            View Produk Unggulan
                        </a>
                    </li>
                    <li class="{{active_check('produk_unggulan/report/all')}}">
                        <a href="{{url('produk_unggulan/report/all')}}">
                            <i class="fa fa-circle-o">
                            </i>
                            Report Produk Unggulan
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </li>
    <li class="treeview {{active_check('sasaran-program-koperasi',true)}} {{active_check('sasaran-program-umkm',true)}} {{active_check('program-kerja-pendampingan',true)}} {{ active_check('pelaksanaan-pendampingan-konsultan') }}">
        <a href="#">
            <i class="fa fa-compass">
            </i>
            <span>
                Pendampingan
            </span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right">
                </i>
            </span>
        </a>
        <ul class="treeview-menu">
            <li class="treeview {{active_check('sasaran-program-koperasi',true)}} {{active_check('sasaran-program-umkm',true)}} {{active_check('program-kerja-pendampingan',true)}}">
                <a href="#">
                    <i class="fa fa-circle-o">
                    </i>
                    <span>
                        Sasaran Program
                    </span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right">
                        </i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{active_check('sasaran-program-koperasi',true)}}">
                        <a href="{{ url('sasaran-program-koperasi') }}">
                            <i class="fa fa-circle-o">
                            </i>
                            Koperasi (7c)
                        </a>
                    </li>
                    <li class="{{active_check('sasaran-program-umkm',true)}}">
                        <a href="{{ url('sasaran-program-umkm') }}">
                            <i class="fa fa-circle-o">
                            </i>
                            UMKM (7d)
                        </a>
                    </li>
                </ul>
            </li>
            <li class="{{active_check('program-kerja-pendampingan',true)}}">
                <a href="{{ url('program-kerja-pendampingan') }}">
                    <i class="fa fa-circle-o">
                    </i>
                    Program Kerja (7e)
                </a>
            </li>
            <li class="{{ active_check('pelaksanaan-pendampingan-konsultan') }}">
                <a href="{{ url('pelaksanaan-pendampingan-konsultan') }}">
                    <i class="fa fa-circle-o">
                    </i>
                    Pelaksanaan Pendampingan (7f)
                </a>
            </li>
        </ul>
    </li>
    <li class="treeview {{active_check('kinerja-master',true)}} {{active_check('rekap-kinerja',true)}}">
        <a href="#">
            <i class="fa fa-users"></i> <span>Capaian IKU</span>
<span class="pull-right-container">
<i class="fa fa-angle-left pull-right"></i>
</span>
        </a>
        <ul class="treeview-menu">
            <li class="{{active_check('kinerja-master/create')}}"><a href="{{ url('kinerja-master/create') }}"><i
                            class="fa fa-circle-o"></i> Add/Edit Kinerja</a></li>
            <li class="{{active_check('kinerja-master')}}"><a href="{{ url('kinerja-master') }}"><i
                            class="fa fa-circle-o"></i> View Kinerja</a></li>
            <li class="{{active_check('rekap-kinerja')}}"><a href="{{ url('rekap-kinerja') }}"><i
                            class="fa fa-circle-o"></i> Rekap Kinerja</a></li>
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
    <li class="treeview {{active_check('laporan-pelaksanaan-final')}} {{active_check('laporan-pelaksanaan-pendampingan')}} {{active_check('laporan-program-pendampingan')}} {{active_check('laporan-pendampingan-sasaran-umkm')}} {{active_check('laporan-pendampingan-sasaran-koperasi')}} {{active_check('laporan-pendampingan-koperasi')}} {{active_check('laporan-pendampingan-umkm')}} {{active_check('laporan-produk')}} {{active_check('laporan-sentra')}} {{active_check('laporan-kegiatan')}} {{active_check('laporan-program')}} {{active_check('laporan-kinerja')}} {{active_check('laporan-proker-plut')}} {{active_check('progres-data')}}">
        <a href="#">
            <i class="fa fa-list"></i> <span>Laporan</span>
            <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu">
            <li class="{{active_check('laporan-produk')}}"><a href="{{url('laporan-produk')}}"><i class="fa fa-circle-o"></i> Produk Unggulan</a></li>
            <li class="{{active_check('laporan-sentra')}}"><a href="{{url('laporan-sentra')}}"><i class="fa fa-circle-o"></i> Sentra UMKM</a></li>
            <li class="{{active_check('laporan-kegiatan')}}"><a href="{{url('laporan-kegiatan')}}"><i class="fa fa-circle-o"></i> Kegiatan Konsultan</a></li>
            <li class="{{active_check('laporan-program')}}"><a href="{{url('laporan-program')}}"><i class="fa fa-circle-o"></i> Program Kerja</a></li>
            <li class="{{active_check('laporan-proker-plut')}}"><a href="{{url('laporan-proker-plut')}}"><i class="fa fa-circle-o"></i> Program Kerja PLUT</a></li>
            <li class="{{active_check('laporan-kinerja')}}"><a href="{{url('laporan-kinerja')}}"><i class="fa fa-circle-o"></i> Kinerja</a></li>
            <li class="{{active_check('progres-data')}}">
                <a href="{{url('progres-data')}}">
                    <i class="fa fa-circle-o">
                    </i>
                    Progres Data
                </a>
            </li>
            <li>
                <a href="{{ url('progres-pendampingan') }}"><i class="fa fa-circle-o">
                    </i> Progres Pendampingan</a>
            </li>
            <li class="treeview {{active_check('laporan-pelaksanaan-final')}} {{active_check('laporan-pelaksanaan-pendampingan')}} {{active_check('laporan-program-pendampingan')}} {{active_check('laporan-pendampingan-sasaran-umkm')}} {{active_check('laporan-pendampingan-sasaran-koperasi')}} {{active_check('laporan-pendampingan-koperasi')}} {{active_check('laporan-pendampingan-umkm')}}">
                <a href="{{ url('progres-pendampingan') }}">
                    <i class="fa fa-circle-o"></i>  Laporan 7a-7g
                    <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{active_check('laporan-pendampingan-koperasi')}}"><a href="{{url('laporan-pendampingan-koperasi')}}"><i class="fa fa-circle-o"></i> Laporan 7a</a></li>
                    <li class="{{active_check('laporan-pendampingan-umkm')}}"><a href="{{url('laporan-pendampingan-umkm')}}"><i class="fa fa-circle-o"></i> Laporan 7b</a></li>
                    <li class="{{active_check('laporan-pendampingan-sasaran-koperasi')}}"><a href="{{url('laporan-pendampingan-sasaran-koperasi')}}"><i class="fa fa-circle-o"></i> Laporan 7c</a></li>
                    <li class="{{active_check('laporan-pendampingan-sasaran-umkm')}}"><a href="{{url('laporan-pendampingan-sasaran-umkm')}}"><i class="fa fa-circle-o"></i> Laporan 7d</a></li>
                    <li class="{{active_check('laporan-program-pendampingan')}}"><a href="{{url('laporan-program-pendampingan')}}"><i class="fa fa-circle-o"></i> Laporan 7e</a></li>
                    <li class="{{active_check('laporan-pelaksanaan-pendampingan')}}"><a href="{{url('laporan-pelaksanaan-pendampingan')}}"><i class="fa fa-circle-o"></i> Laporan 7f</a></li>
                    <li class="{{active_check('laporan-pelaksanaan-final')}}"><a href="{{url('laporan-pelaksanaan-final')}}"><i class="fa fa-circle-o"></i> Laporan 7g</a></li>
                </ul>
            </li>
            <li class="{{active_check('laporan-kumkm-perbidang')}}"><a href="{{url('laporan-kumkm-perbidang')}}"><i class="fa fa-circle-o"></i>laporan kumkm perbidang</a></li>
        </ul>
    </li>
    <li class="{{active_check('pengumuman',true)}}"><a href="{{url('pengumuman')}}"><i
                    class="fa fa-info-circle"></i> <span>Pengumuman</span></a></li>

    <li class="treeview {{active_check('activity-user',true)}} {{active_check('last-login',true)}}">
        <a href="#">
            <i class="fa fa-user"></i> <span>Log Activity</span>
            <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu">
            <li class="{{active_check('activity-user',true)}}"><a href="{{url('activity-user')}}">
            <i class="fa fa-circle-o"></i> User Activity</a></li>
            <li class="{{active_check('last-login',true)}}"><a href="{{url('last-login')}}">
            <i class="fa fa-circle-o"></i> Login Terakhir</a></li>
        </ul>
    </li>


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
