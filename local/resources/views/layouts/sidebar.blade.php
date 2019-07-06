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
            @include('layouts.menu.superadmin')
        @elseif(Auth::user()->role_id==3)
            @include('layouts.menu.konsultan')
        @elseif(Auth::user()->role_id==2)
            @include('layouts.menu.admin')
        @elseif(Auth::user()->role_id==5)
            @include('layouts.menu.pengelolah')
        @elseif(Auth::user()->role_id==6)
            @include('layouts.menu.monev')
        @endif
                    <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>
