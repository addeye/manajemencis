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
        @endif

        @if(Auth::user()->role_id==3)
            {{--For Konsultan--}}
                @include('layouts.menu.konsultan')
        @endif

        @if(Auth::user()->role_id==2)
            {{--For admin--}}
            @include('layouts.menu.admin')
            @endif
                    <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>
