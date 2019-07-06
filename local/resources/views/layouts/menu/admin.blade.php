<?php
/**
 * Created by PhpStorm.
 * User: deyelovi
 * Date: 29/03/2017
 * Time: 11:13
 */
?>
<ul class="sidebar-menu">
    <li class="header">
        HEADER
    </li>
    <!-- Optionally, you can add icons to the links -->
    <li class="{{ Active::check('home') }}">
        <a href="{{ url('home') }}">
            <i class="fa fa-dashboard">
            </i>
            <span>
                Dashboard
            </span>
        </a>
    </li>
    <li class="treeview {{active_check('bidanglayanan',true)}} {{active_check('jenislayanan',true)}} {{active_check('bidangusaha',true)}} {{active_check('provinces',true)}} {{active_check('regencies',true)}} {{active_check('districts',true)}}">
        <a href="#">
            <i class="fa fa-cube">
            </i>
            <span>
                Master Data
            </span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right">
                </i>
            </span>
        </a>
        <ul class="treeview-menu">
            <li class="{{active_check('bidanglayanan',true)}} {{active_check('jenislayanan',true)}} {{ active_check('bidangusaha',true) }}">
                <a href="#">
                    <i class="fa fa-circle-o">
                    </i>
                    Bidang
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right">
                        </i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ active_check('bidanglayanan',true) }}">
                        <a href="{{url('bidanglayanan')}}">
                            <i class="fa fa-circle-o">
                            </i>
                            Bidang Layanan
                        </a>
                    </li>
                    <li class="{{ active_check('jenislayanan',true) }}">
                        <a href="{{url('jenislayanan')}}">
                            <i class="fa fa-circle-o">
                            </i>
                            IKU Layanan
                        </a>
                    </li>
                    <li class="{{ active_check('bidangusaha',true) }}">
                        <a href="{{ url('bidangusaha') }}">
                            <i class="fa fa-circle-o">
                            </i>
                            Bidang Usaha
                        </a>
                    </li>
                </ul>
            </li>
            <li class="{{active_check('provinces',true)}} {{active_check('regencies',true)}} {{active_check('districts',true)}}">
                <a href="#">
                    <i class="fa fa-circle-o">
                    </i>
                    Wilayah
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right">
                        </i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{active_check('provinces',true)}}">
                        <a href="{{ url('provinces') }}">
                            <i class="fa fa-circle-o">
                            </i>
                            Provinsi
                        </a>
                    </li>
                    <li class="{{active_check('regencies',true)}}">
                        <a href="{{ url('regencies') }}">
                            <i class="fa fa-circle-o">
                            </i>
                            Kabupaten/Kota
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </li>
    <li class="treeview {{active_check('adm/lembaga/profil',true)}} {{active_check('adm/proker-plut',true)}} {{active_check('adm/proker-konsultan-view')}}">
        <a href="#">
            <i class="fa fa-home">
            </i>
            <span>
                Lembaga
            </span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right">
                </i>
            </span>
        </a>
        <ul class="treeview-menu">
            <li class="{{active_check('adm/lembaga/profil')}}">
                <a href="{{url('adm/lembaga/profil')}}">
                    <i class="fa fa-circle-o">
                    </i>
                    Profil Lembaga
                </a>
            </li>
            <li class="treeview {{active_check('adm/proker-plut',true)}}">
                <a href="#">
                    <i class="fa fa-circle-o">
                    </i>
                    <span>
                        Proker CIS
                    </span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right">
                        </i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{active_check('adm/proker-plut/create')}}">
                        <a href="{{url('adm/proker-plut/create')}}">
                            <i class="fa fa-circle-o">
                            </i>
                            Add Proker
                        </a>
                    </li>
                    <li class="{{active_check('adm/proker-plut')}}">
                        <a href="{{url('adm/proker-plut')}}">
                            <i class="fa fa-circle-o">
                            </i>
                            View Proker
                        </a>
                    </li>
                    <li class="{{active_check('adm/proker-plut/report/all')}}">
                        <a href="{{url('adm/proker-plut/report/all')}}">
                            <i class="fa fa-circle-o">
                            </i>
                            Report Proker
                        </a>
                    </li>
                </ul>
            </li>
            <li class="{{active_check('adm/proker-konsultan-view')}}">
                <a href="{{ url('adm/proker-konsultan-view') }}">
                    <i class="fa fa-circle-o">
                    </i>
                    Proker Konsultan
                </a>
            </li>
        </ul>
    </li>
    <li class="treeview {{active_check('kumkm',true)}} {{active_check('adm/sentra',true)}} {{active_check('produk_unggulan',true)}} {{active_check('produk_unggulan/report/all')}} {{active_check('adm/koperasi',true)}} {{active_check('adm/koperasi-report')}} {{active_check('adm/data-kumkm',true)}} {{active_check('adm/data-kumkm-report')}}">
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
            <li class="treeview {{active_check('adm/koperasi',true)}} {{active_check('adm/koperasi-report')}}">
                <a href="#">
                    <i class="fa fa-circle-o">
                    </i>
                    <span>
                        Data Koperasi
                    </span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right">
                        </i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{active_check('adm/koperasi/create')}}">
                        <a href="{{ url('adm/koperasi/create') }}">
                            <i class="fa fa-circle-o">
                            </i>
                            Add Koperasi
                        </a>
                    </li>
                    <li class="{{active_check('adm/koperasi')}}">
                        <a href="{{ url('adm/koperasi') }}">
                            <i class="fa fa-circle-o">
                            </i>
                            View Koperasi
                        </a>
                    </li>
                    {{-- <li class="{{active_check('adm/koperasi-report')}}">
                        <a href="{{ url('adm/koperasi-report') }}">
                            <i class="fa fa-circle-o">
                            </i>
                            Report Koperasi
                        </a>
                    </li> --}}
                </ul>
            </li>
            <li class="treeview {{active_check('adm/data-kumkm',true)}} {{active_check('adm/data-kumkm-report')}}">
                <a href="#">
                    <i class="fa fa-circle-o">
                    </i>
                    <span>
                        Data UMKM
                    </span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right">
                        </i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{active_check('adm/data-kumkm/create')}}">
                        <a href="{{url('adm/data-kumkm/create')}}">
                            <i class="fa fa-circle-o">
                            </i>
                            Add UMKM
                        </a>
                    </li>
                    <li class="{{active_check('adm/data-kumkm')}}">
                        <a href="{{url('adm/data-kumkm')}}">
                            <i class="fa fa-circle-o">
                            </i>
                            View UMKM
                        </a>
                    </li>
                    <li class="{{active_check('adm/data-kumkm-report')}}">
                        <a href="{{url('adm/data-kumkm-report')}}">
                            <i class="fa fa-circle-o">
                            </i>
                            Report UMKM
                        </a>
                    </li>
                </ul>
            </li>
            <li class="treeview {{active_check('adm/sentra',true)}}">
                <a href="#">
                    <i class="fa fa-circle-o">
                    </i>
                    <span>
                        Sentra UMKM
                    </span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right">
                        </i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{active_check('adm/sentra/create')}}">
                        <a href="{{url('adm/sentra/create')}}">
                            <i class="fa fa-circle-o">
                            </i>
                            Add Sentra
                        </a>
                    </li>
                    <li class="{{active_check('adm/sentra')}}">
                        <a href="{{url('adm/sentra')}}">
                            <i class="fa fa-circle-o">
                            </i>
                            View Sentra
                        </a>
                    </li>
                    <li class="{{active_check('adm/sentra/report/all')}}">
                        <a href="{{url('adm/sentra/report/all')}}">
                            <i class="fa fa-circle-o">
                            </i>
                            Report Sentra
                        </a>
                    </li>
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
    <li class="treeview {{active_check('adm/sasaran-koperasi',true)}} {{active_check('adm/sasaran-kumkm',true)}} {{active_check('adm/program-kerja',true)}} {{active_check('adm/pelaksanaan-pendampingan',true)}}">
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
            <li class="treeview {{active_check('adm/sasaran-koperasi',true)}} {{active_check('adm/sasaran-kumkm',true)}}">
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
                    <li class="{{active_check('adm/sasaran-koperasi',true)}}">
                        <a href="{{ url('adm/sasaran-koperasi') }}">
                            <i class="fa fa-circle-o">
                            </i>
                            Koperasi
                        </a>
                    </li>
                    <li class="{{active_check('adm/sasaran-kumkm',true)}}">
                        <a href="{{ url('adm/sasaran-kumkm') }}">
                            <i class="fa fa-circle-o">
                            </i>
                            UMKM
                        </a>
                    </li>
                </ul>
            </li>
            <li class="{{active_check('adm/program-kerja',true)}}">
                <a href="{{ url('adm/program-kerja') }}">
                    <i class="fa fa-circle-o">
                    </i>
                    Program Kerja
                </a>
            </li>
            <li class="{{active_check('adm/pelaksanaan-pendampingan',true)}}">
                <a href="{{ url('adm/pelaksanaan-pendampingan') }}">
                    <i class="fa fa-circle-o">
                    </i>
                    Pelaksanaan Pendampingan
                </a>
            </li>
            {{-- <li class="">
                <a href="javascript:void">
                    <i class="fa fa-circle-o">
                    </i>
                    Penilaian
                </a>
            </li> --}}
        </ul>
    </li>
    <li class="treeview {{active_check('k/kegiatan',true)}}">
        <a href="#">
            <i class="fa fa-bookmark">
            </i>
            <span>
                Kegiatan Konsultan
            </span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right">
                </i>
            </span>
        </a>
        <ul class="treeview-menu">
            <li class="{{active_check('k/kegiatan/create')}}">
                <a href="{{url('adm/k/kegiatan/create')}}">
                    <i class="fa fa-circle-o">
                    </i>
                    Add Kegiatan
                </a>
            </li>
            <li class="{{active_check('k/kegiatan')}}">
                <a href="{{url('adm/k/kegiatan')}}">
                    <i class="fa fa-circle-o">
                    </i>
                    View Kegiatan
                </a>
            </li>
            <li class="{{active_check('k/kegiatan/report/all')}}">
                <a href="{{url('adm/k/kegiatan/report/all')}}">
                    <i class="fa fa-circle-o">
                    </i>
                    Report Kegiatan
                </a>
            </li>
        </ul>
        </li>
    <li class="treeview {{active_check('kinerja-admin',true)}}">
        <a href="#">
            <i class="fa fa-users">
            </i>
            <span>
                Capaian IKU
            </span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right">
                </i>
            </span>
        </a>
        <ul class="treeview-menu">
            <li class="{{active_check('adm/kinerja/create')}}">
                <a href="{{ url('adm/kinerja/create') }}">
                    <i class="fa fa-circle-o">
                    </i>
                    Add Capaian IKU
                </a>
            </li>
            <li class="{{active_check('adm/kinerja')}}">
                <a href="{{ url('adm/kinerja') }}">
                    <i class="fa fa-circle-o">
                    </i>
                    View Capaian IKU
                </a>
            </li>
        </ul>
    </li>
    <li class="treeview {{active_check('adm/laporan-pelaksanaan-final')}} {{active_check('adm/laporan-pelaksanaan-pendampingan')}} {{active_check('adm/laporan-program-pendampingan')}} {{active_check('adm/laporan-pendampingan-sasaran-umkm')}} {{active_check('adm/laporan-pendampingan-sasaran-koperasi')}} {{active_check('adm/laporan-pendampingan-koperasi')}} {{active_check('adm/laporan-pendampingan-umkm')}} {{active_check('adm/koperasi-laporan')}} {{active_check('adm/data-kumkm-laporan')}} {{active_check('adm/sasaran-koperasi-laporan')}} {{active_check('adm/sasaran-kumkm-laporan')}} {{active_check('adm/program-kerja-laporan')}} {{active_check('adm/pelaksanaan-pendampingan-laporan')}} {{active_check('adm/pelaksanaan-pendampingan-laporan-bulanan')}} {{active_check('adm/pelaksanaan-pendampingan-laporan-triwulan')}} {{active_check('adm/pelaksanaan-pendampingan-laporan-tahunan')}}">
        <a href="#">
            <i class="fa fa-file">
            </i>
            <span>
                Laporan
            </span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right">
                </i>
            </span>
        </a>
        <ul class="treeview-menu">
            <li class="treeview {{active_check('adm/koperasi-laporan')}} {{active_check('adm/data-kumkm-laporan')}}">
                <a href="#">
                    <i class="fa fa-circle-o">
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
                    <li class="{{active_check('adm/koperasi-laporan')}}">
                        <a href="{{ url('adm/koperasi-laporan') }}">
                            <i class="fa fa-circle-o">
                            </i>
                            Data Koperasi
                        </a>
                    </li>
                    <li class="{{active_check('adm/data-kumkm-laporan')}}">
                        <a href="{{ url('adm/data-kumkm-laporan') }}">
                            <i class="fa fa-circle-o">
                            </i>
                            Data UMKM
                        </a>
                    </li>
                    {{-- <li class="">
                        <a href="">
                            <i class="fa fa-circle-o">
                            </i>
                            Sentra UMKM
                        </a>
                    </li>
                    <li class="">
                        <a href="">
                            <i class="fa fa-circle-o">
                            </i>
                            Produk Unggulan
                        </a>
                    </li> --}}
                </ul>
            </li>
            <li class="treeview {{active_check('adm/sasaran-kumkm-laporan')}} {{active_check('adm/sasaran-koperasi-laporan')}} {{active_check('adm/program-kerja-laporan')}} {{active_check('adm/pelaksanaan-pendampingan-laporan')}} {{active_check('adm/pelaksanaan-pendampingan-laporan-bulanan')}} {{active_check('adm/pelaksanaan-pendampingan-laporan-triwulan')}} {{active_check('adm/pelaksanaan-pendampingan-laporan-tahunan')}}">
                <a href="#">
                    <i class="fa fa-circle-o">
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
                    <li class="treeview {{active_check('adm/sasaran-koperasi-laporan')}} {{active_check('adm/sasaran-kumkm-laporan')}}">
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
                            <li class="{{active_check('adm/sasaran-koperasi-laporan')}}">
                                <a href="{{ url('adm/sasaran-koperasi-laporan') }}">
                                    <i class="fa fa-circle-o">
                                    </i>
                                    Koperasi
                                </a>
                            </li>
                            <li class="{{active_check('adm/sasaran-kumkm-laporan')}}">
                                <a href="{{ url('adm/sasaran-kumkm-laporan') }}">
                                    <i class="fa fa-circle-o">
                                    </i>
                                    UMKM
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="{{active_check('adm/program-kerja-laporan')}}">
                        <a href="{{ url('adm/program-kerja-laporan') }}">
                            <i class="fa fa-circle-o">
                            </i>
                            Program Kerja
                        </a>
                    </li>
                    <li class="{{active_check('adm/pelaksanaan-pendampingan-laporan')}}">
                        <a href="{{ url('adm/pelaksanaan-pendampingan-laporan') }}">
                            <i class="fa fa-circle-o">
                            </i>
                            Pelaksanaan Pendampingan
                        </a>
                    </li>
                    <li class="{{active_check('adm/pelaksanaan-pendampingan-laporan-bulanan')}}">
                        <a href="{{ url('adm/pelaksanaan-pendampingan-laporan-bulanan') }}">
                            <i class="fa fa-circle-o">
                            </i>
                            Laporan Bulanan
                        </a>
                    </li>
                    <li class="{{active_check('adm/pelaksanaan-pendampingan-laporan-triwulan')}}">
                        <a href="{{ url('adm/pelaksanaan-pendampingan-laporan-triwulan') }}">
                            <i class="fa fa-circle-o">
                            </i>
                            Laporan Triwulan
                        </a>
                    </li>
                    <li class="{{active_check('adm/pelaksanaan-pendampingan-laporan-tahunan')}}">
                        <a href="{{ url('adm/pelaksanaan-pendampingan-laporan-tahunan') }}">
                            <i class="fa fa-circle-o">
                            </i>
                            Laporan Tahunan
                        </a>
                    </li>
                </ul>
            </li>
            <li class="{{active_check('report/konsultan')}}">
                <a href="{{url('report/konsultan')}}">
                    <i class="fa fa-circle-o">
                    </i>
                    Data Konsultan
                </a>
            </li>
            <li class="{{active_check('report/lembaga')}}">
                <a href="{{url('report/lembaga')}}">
                    <i class="fa fa-circle-o">
                    </i>
                    Data Lembaga
                </a>
            </li>
            <li class="{{active_check('adm/proker-konsultan')}}">
                <a href="{{url('adm/proker-konsultan')}}">
                    <i class="fa fa-circle-o">
                    </i>
                    Proker Konsultan
                </a>
            </li>
            <li class="{{active_check('adm/kegiatan-konsultan')}}">
                <a href="{{url('adm/kegiatan-konsultan')}}">
                    <i class="fa fa-circle-o">
                    </i>
                    Kegiatan Konsultan
                </a>
            </li>
            <li class="treeview {{active_check('adm/laporan-pelaksanaan-final')}} {{active_check('adm/laporan-pelaksanaan-pendampingan')}} {{active_check('adm/laporan-program-pendampingan')}} {{active_check('adm/laporan-pendampingan-sasaran-umkm')}} {{active_check('adm/laporan-pendampingan-sasaran-koperasi')}} {{active_check('adm/laporan-pendampingan-koperasi')}} {{active_check('adm/laporan-pendampingan-umkm')}}">
                <a href="{{ url('progres-pendampingan') }}">
                    <i class="fa fa-circle-o"></i>  Laporan 7a-7g
                    <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{active_check('adm/laporan-pendampingan-koperasi')}}"><a href="{{url('adm/laporan-pendampingan-koperasi')}}"><i class="fa fa-circle-o"></i> Laporan 7a</a></li>
                    <li class="{{active_check('adm/laporan-pendampingan-umkm')}}"><a href="{{url('adm/laporan-pendampingan-umkm')}}"><i class="fa fa-circle-o"></i> Laporan 7b</a></li>
                    <li class="{{active_check('adm/laporan-pendampingan-sasaran-koperasi')}}"><a href="{{url('adm/laporan-pendampingan-sasaran-koperasi')}}"><i class="fa fa-circle-o"></i> Laporan 7c</a></li>
                    <li class="{{active_check('adm/laporan-pendampingan-sasaran-umkm')}}"><a href="{{url('adm/laporan-pendampingan-sasaran-umkm')}}"><i class="fa fa-circle-o"></i> Laporan 7d</a></li>
                    <li class="{{active_check('adm/laporan-program-pendampingan')}}"><a href="{{url('adm/laporan-program-pendampingan')}}"><i class="fa fa-circle-o"></i> Laporan 7e</a></li>
                    <li class="{{active_check('adm/laporan-pelaksanaan-pendampingan')}}"><a href="{{url('adm/laporan-pelaksanaan-pendampingan')}}"><i class="fa fa-circle-o"></i> Laporan 7f</a></li>
                    <li class="{{active_check('adm/laporan-pelaksanaan-final')}}"><a href="{{url('adm/laporan-pelaksanaan-final')}}"><i class="fa fa-circle-o"></i> Laporan 7g</a></li>
                </ul>
            </li>
        </ul>
    </li>
    <li class="{{active_check('info')}}">
        <a href="{{url('info')}}">
            <i class="fa fa-info">
            </i>
            <span>
                Info Terkini
            </span>
        </a>
    </li>
</ul>
