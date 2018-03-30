<?php
/**
 * Created by PhpStorm.
 * User: deyelovi
 * Date: 29/03/2017
 * Time: 11:22
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

    <li class="treeview {{active_check('k/proker',true)}} {{active_check('proker-plut-konsultan',true)}}">
        <a href="#">
            <i class="fa fa-cube">
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
            <li class="{{active_check('k/lembaga',true)}}">
                <a href="{{ url('k/lembaga/detail') }}">
                    <i class="fa fa-circle-o">
                    </i>
                    Profil Lembaga
                </a>
            </li>
            <li class="{{active_check('proker-plut-konsultan',true)}}">
                <a href="{{ url('proker-plut-konsultan') }}">
                    <i class="fa fa-circle-o">
                    </i>
                    Proker CIS
                </a>
            </li>
            <li class="{{active_check('k/proker',true)}}">
                <a href="{{ url('k/proker') }}">
                    <i class="fa fa-circle-o">
                    </i>
                    Proker Konsultan
                </a>
            </li>
        </ul>
    </li>

    <li class="treeview {{active_check('sentra_kumkm',true)}} {{active_check('koperasi',true)}} {{active_check('kumkm',true)}} {{active_check('koperasi-report')}} {{active_check('data-kumkm',true)}} {{active_check('data-kumkm-detail-add',true)}} {{active_check('data-kumkm-report')}} {{active_check('koperasi-detail-edit',true)}} ">
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
            <li class="treeview {{active_check('koperasi',true)}} {{active_check('koperasi-report')}} {{active_check('koperasi-detail-edit',true)}}">
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
                    <li class="{{active_check('koperasi/create')}}">
                        <a href="{{ url('koperasi/create') }}">
                            <i class="fa fa-circle-o">
                            </i>
                            Add Koperasi
                        </a>
                    </li>
                    <li class="{{active_check('koperasi')}}">
                        <a href="{{ url('koperasi') }}">
                            <i class="fa fa-circle-o">
                            </i>
                            View Koperasi
                        </a>
                    </li>
                    {{-- <li class="{{active_check('koperasi-report')}}">
                        <a href="{{ url('koperasi-report') }}">
                            <i class="fa fa-circle-o">
                            </i>
                            Report Koperasi
                        </a>
                    </li> --}}
                </ul>
            </li>
            <li class="treeview {{active_check('data-kumkm',true)}} {{active_check('data-kumkm-detail-add',true)}} {{active_check('data-kumkm-report')}}">
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
                    <li class="{{active_check('data-kumkm/create')}}">
                        <a href="{{url('data-kumkm/create')}}">
                            <i class="fa fa-circle-o">
                            </i>
                            Add UMKM
                        </a>
                    </li>
                    <li class="{{active_check('data-kumkm')}}">
                        <a href="{{url('data-kumkm')}}">
                            <i class="fa fa-circle-o">
                            </i>
                            View UMKM
                        </a>
                    </li>
                    {{-- <li class="{{active_check('data-kumkm-report')}}">
                        <a href="{{url('data-kumkm-report')}}">
                            <i class="fa fa-circle-o">
                            </i>
                            Report UMKM
                        </a>
                    </li> --}}
                </ul>
            </li>
            <li class="treeview {{active_check('sentra_kumkm',true)}}">
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
                    <li class="{{active_check('sentra_kumkm/create')}}">
                        <a href="{{url('sentra_kumkm/create')}}">
                            <i class="fa fa-circle-o">
                            </i>
                            Add Sentra
                        </a>
                    </li>
                    <li class="{{active_check('sentra_kumkm')}}">
                        <a href="{{url('sentra_kumkm')}}">
                            <i class="fa fa-circle-o">
                            </i>
                            View Sentra
                        </a>
                    </li>
                    <li class="{{active_check('sentra_kumkm/report/all')}}">
                        <a href="{{url('sentra_kumkm/report/all')}}">
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
    <li class="treeview {{active_check('sasaran-koperasi',true)}} {{active_check('sasaran-kumkm',true)}} {{active_check('program-kerja',true)}} {{active_check('pelaksanaan-pendampingan',true)}}">
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
            <li class="treeview {{active_check('sasaran-koperasi',true)}} {{active_check('sasaran-kumkm',true)}}">
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
                    <li class="{{active_check('sasaran-koperasi',true)}}">
                        <a href="{{ url('sasaran-koperasi') }}">
                            <i class="fa fa-circle-o">
                            </i>
                            Koperasi
                        </a>
                    </li>
                    <li class="{{active_check('sasaran-kumkm',true)}}">
                        <a href="{{ url('sasaran-kumkm') }}">
                            <i class="fa fa-circle-o">
                            </i>
                            UMKM
                        </a>
                    </li>
                </ul>
            </li>
            <li class="{{active_check('program-kerja',true)}}">
                <a href="{{ url('program-kerja') }}">
                    <i class="fa fa-circle-o">
                    </i>
                    Program Kerja
                </a>
            </li>
            <li class="{{active_check('pelaksanaan-pendampingan',true)}}">
                <a href="{{ url('pelaksanaan-pendampingan') }}">
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
    {{-- <li class="treeview {{active_check('list-umkm',true)}} {{active_check('pendaftaran-umkm',true)}} {{active_check('umkm-naik',true)}} {{active_check('penilaian-umkm',true)}}">
        <a href="#">
            <i class="fa fa-briefcase">
            </i>
            <span>
                UMKM Naik Kelas
            </span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right">
                </i>
            </span>
        </a>
        <ul class="treeview-menu">
            <li class="{{active_check('list-umkm',true)}} {{active_check('pendaftaran-umkm',true)}}">
                <a href="javascript:void">
                    <i class="fa fa-circle-o">
                    </i>
                    Pendaftaran
                </a>
            </li>
            <li class="{{active_check('list-umkm',true)}} {{active_check('pendaftaran-umkm',true)}}">
                <a href="javascript:void">
                    <i class="fa fa-circle-o">
                    </i>
                    Diagnosis
                </a>
            </li>
            <li class="{{active_check('umkm-naik',true)}}">
                <a href="javascript:void">
                    <i class="fa fa-circle-o">
                    </i>
                    Proses Pendampingan
                </a>
            </li>
            <li class="{{active_check('penilaian-umkm',true)}}">
                <a href="javascript:void">
                    <i class="fa fa-circle-o">
                    </i>
                    Pengukuran
                </a>
            </li>
        </ul>
    </li> --}}
    <li class="treeview {{active_check('k/kegiatan')}} {{active_check('k/kegiatan/create')}}">
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
                <a href="{{url('k/kegiatan/create')}}">
                    <i class="fa fa-circle-o">
                    </i>
                    Add Kegiatan
                </a>
            </li>
            <li class="{{active_check('k/kegiatan')}}">
                <a href="{{url('k/kegiatan')}}">
                    <i class="fa fa-circle-o">
                    </i>
                    View Kegiatan
                </a>
            </li>
            {{-- <li class="{{active_check('k/kegiatan/report/all')}}">
                <a href="{{url('k/kegiatan/report/all')}}">
                    <i class="fa fa-circle-o">
                    </i>
                    Report Kegiatan
                </a>
            </li> --}}
        </ul>
        </li>
    {{-- <li class="treeview {{active_check('kinerja-konsultan',true)}}">
        <a href="#">
            <i class="fa fa-users">
            </i>
            <span>
                Kinerja CIS
            </span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right">
                </i>
            </span>
        </a>
        <ul class="treeview-menu">
            <li class="{{active_check('kinerja-konsultan/create')}}">
                <a href="{{ url('kinerja-konsultan/create') }}">
                    <i class="fa fa-circle-o">
                    </i>
                    Add Kinerja
                </a>
            </li>
            <li class="{{active_check('kinerja-konsultan')}}">
                <a href="{{ url('kinerja-konsultan') }}">
                    <i class="fa fa-circle-o">
                    </i>
                    View Kinerja
                </a>
            </li>
        </ul>
    </li> --}}
    <li class="treeview {{active_check('laporan-sentra-umkm')}} {{active_check('laporan-data-umkm')}} {{active_check('laporan-produk-umkm')}} {{active_check('laporan-kinerjacis')}} {{active_check('laporan-prokerkonsultan')}} {{active_check('laporan-kegiatankonsultan')}} {{active_check('koperasi-laporan')}} {{active_check('data-kumkm-laporan')}} {{active_check('sasaran-koperasi-laporan')}} {{active_check('sasaran-kumkm-laporan')}} {{active_check('program-kerja-laporan')}} {{active_check('k/kegiatan/report/all')}} {{active_check('pelaksanaan-pendampingan-laporan')}} {{active_check('pelaksanaan-pendampingan-laporan-bulanan')}}">
        <a href="#">
            <i class="fa fa-list">
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
            <li class="treeview {{active_check('koperasi-laporan')}} {{active_check('data-kumkm-laporan')}}">
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
                    <li class="{{active_check('koperasi-laporan')}}">
                        <a href="{{url('koperasi-laporan')}}">
                            <i class="fa fa-circle-o">
                            </i>
                            Data Koperasi
                        </a>
                    </li>
                    <li class="{{active_check('data-kumkm-laporan')}}">
                        <a href="{{url('data-kumkm-laporan')}}">
                            <i class="fa fa-circle-o">
                            </i>
                            Data UMKM
                        </a>
                    </li>
                    <li class="{{active_check('laporan-sentra-umkm')}}">
                        <a href="{{url('laporan-sentra-umkm')}}">
                            <i class="fa fa-circle-o">
                            </i>
                            Sentra UMKM
                        </a>
                    </li>
                    <li class="{{active_check('laporan-produk-umkm')}}">
                        <a href="{{url('laporan-produk-umkm')}}">
                            <i class="fa fa-circle-o">
                            </i>
                            Produk UMKM
                        </a>
                    </li>
                </ul>
            </li>
            <li class="treeview {{active_check('sasaran-koperasi-laporan')}} {{active_check('sasaran-kumkm-laporan')}} {{active_check('program-kerja-laporan')}} {{active_check('pelaksanaan-pendampingan-laporan')}} {{active_check('pelaksanaan-pendampingan-laporan-bulanan')}}">
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
                    <li class="treeview {{active_check('sasaran-koperasi-laporan')}} {{active_check('sasaran-kumkm-laporan')}} {{active_check('program-kerja-laporan')}}">
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
                            <li class="{{active_check('sasaran-koperasi-laporan')}}">
                                <a href="{{ url('sasaran-koperasi-laporan') }}">
                                    <i class="fa fa-circle-o">
                                    </i>
                                    Koperasi
                                </a>
                            </li>
                            <li class="{{active_check('sasaran-kumkm-laporan')}}">
                                <a href="{{ url('sasaran-kumkm-laporan') }}">
                                    <i class="fa fa-circle-o">
                                    </i>
                                    UMKM
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="{{active_check('program-kerja-laporan')}}">
                        <a href="{{ url('program-kerja-laporan') }}">
                            <i class="fa fa-circle-o">
                            </i>
                            Program Kerja
                        </a>
                    </li>
                    <li class="{{active_check('pelaksanaan-pendampingan-laporan')}}">
                        <a href="{{ url('pelaksanaan-pendampingan-laporan') }}">
                            <i class="fa fa-circle-o">
                            </i>
                            Pelaksanaan Pendampingan
                        </a>
                    </li>
                    <li class="{{active_check('pelaksanaan-pendampingan-laporan-bulanan')}}">
                        <a href="{{ url('pelaksanaan-pendampingan-laporan-bulanan') }}">
                            <i class="fa fa-circle-o">
                            </i>
                            Laporan Bulanan
                        </a>
                    </li>
                    <li class="">
                        <a href="javascript:void">
                            <i class="fa fa-circle-o">
                            </i>
                            Laporan Triwulan
                        </a>
                    </li>
                    <li class="">
                        <a href="javascript:void">
                            <i class="fa fa-circle-o">
                            </i>
                            Laporan Tahunan
                        </a>
                    </li>
                </ul>
            </li>
            <li class="{{active_check('k/kegiatan/report/all')}}"">
                <a href="{{url('k/kegiatan/report/all')}}">
                    <i class="fa fa-circle-o">
                    </i>
                    Kegiatan Konsultan
                </a>
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