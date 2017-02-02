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
                <img src="{{ asset("../bower_components/admin-lte/dist/img/user2-160x160.jpg") }}" class="img-circle"
                     alt="User Image"/>
            </div>
            <div class="pull-left info">
                <p>{{ Auth::user()->name }}</p>
                <!-- Status -->
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            <li class="header">HEADER</li>
            <!-- Optionally, you can add icons to the links -->
            <li class="{{ Active::check('home') }}"><a href="{{ url('home') }}"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
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
                            <li class="{{ active_check('bidanglayanan',true) }}"><a href="{{url('bidanglayanan')}}"><i class="fa fa-circle-o"></i> Bidang Layanan</a></li>
                            <li class="{{ active_check('jenislayanan',true) }}"><a href="{{url('jenislayanan')}}"><i class="fa fa-circle-o"></i> IKU Layanan</a></li>
                            <li class="{{ active_check('bidangusaha',true) }}"><a href="{{ url('bidangusaha') }}"><i class="fa fa-circle-o"></i> Bidang Usaha</a></li>
                        </ul>
                    </li>
                    <li class="{{active_check('provinces',true)}} {{active_check('regencies',true)}} {{active_check('districts',true)}}">
                        <a href="#"><i class="fa fa-circle-o"></i> Wilayah
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
                        </a>
                        <ul class="treeview-menu">
                            <li class="{{active_check('provinces',true)}}"><a href="{{ url('provinces') }}"><i class="fa fa-circle-o"></i> Provinsi</a></li>
                            <li class="{{active_check('regencies',true)}}"><a href="{{ url('regencies') }}"><i class="fa fa-circle-o"></i> Kabupaten/Kota</a></li>
                            {{--<li class="{{active_check('districts',true)}}"><a href="{{ url('districts') }}"><i class="fa fa-circle-o"></i> Kecamatan</a></li>--}}
                        </ul>
                    </li>
                </ul>
            </li>

            <li class="treeview {{active_check('lembaga',true)}}">
                <a href="#">
                    <i class="fa fa-home"></i> <span>Lembaga</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{active_check('lembaga/create')}}"><a href="{{ url('lembaga/create') }}"><i class="fa fa-circle-o"></i> Add Lembaga</a></li>
                    <li class="{{active_check('lembaga')}}"><a href="{{ url('lembaga') }}"><i class="fa fa-circle-o"></i> View Lembaga</a></li>
                </ul>
            </li>

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-users"></i> <span>Konsultan</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="pages/examples/invoice.html"><i class="fa fa-circle-o"></i> Add Konsultan</a></li>
                    <li><a href="pages/examples/profile.html"><i class="fa fa-circle-o"></i> View Konsultan</a></li>
                </ul>
            </li>

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-university"></i> <span>Sentra KUMKM</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="pages/examples/invoice.html"><i class="fa fa-circle-o"></i> Add Sentra</a></li>
                    <li><a href="pages/examples/profile.html"><i class="fa fa-circle-o"></i> View Sentra</a></li>
                </ul>
            </li>

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-briefcase"></i> <span>Master KUMKM</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="pages/examples/invoice.html"><i class="fa fa-circle-o"></i> Add KUMKM</a></li>
                    <li><a href="pages/examples/profile.html"><i class="fa fa-circle-o"></i> View KUMKM</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-cog"></i> <span>Setting</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="pages/examples/invoice.html"><i class="fa fa-circle-o"></i> Tingkat</a></li>
                    <li><a href="pages/examples/profile.html"><i class="fa fa-circle-o"></i> Roles</a></li>
                    <li><a href="pages/examples/profile.html"><i class="fa fa-circle-o"></i> Users</a></li>
                </ul>
            </li>
        </ul>
        <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>
