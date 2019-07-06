<?php
/**
 * Created by PhpStorm.
 * User: deyelovi
 * Date: 21/01/2017
 * Time: 7:30
 */
?>
        <!-- Main Header -->
<header class="main-header">

    <!-- Logo -->
    <a href="#" class="logo"><b>Manajemen CIS</b></a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>
        <span class="title-navbar">
            @if (Auth::user()->role_id==3)
                {{Auth::user()->konsultans->lembagas->plut_name}}
            @elseif(Auth::user()->role_id==2)
                {{Auth::user()->adminlembagas->lembagas->plut_name}}
            @endif
        </span>
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <!-- User Account Menu -->
                <li class="dropdown user user-menu">
                    <!-- Menu Toggle Button -->
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <!-- The user image in the navbar-->
                        <img src="{{ url('images/'.Auth::user()->path) }}" class="user-image" alt="User Image"/>
                        <!-- hidden-xs hides the username on small devices so only the image appears. -->
                        <span class="hidden-xs">{{ Auth::user()->name }}</span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- The user image in the menu -->
                        <li class="user-header">
                            <img src="{{ url('images/'.Auth::user()->path) }}" class="img-circle" alt="User Image" />
                            <p>
                                {{ Auth::user()->name }}
                                <small>{{ Auth::user()->roles->name }} </small>
                            </p>
                        </li>
                        @if (Auth::user()->konsultans)
                            <li class="user-body">
                            <div class="row">
                              <div class="col-xs-1 text-center">
                                <a href="#"></a>
                              </div>
                              <div class="col-xs-10 text-center">
                                <a href="{{ url('bio/konsultan') }}"><i class="fa fa-user"></i> BIODATA KONSULTAN</a>
                              </div>
                              <div class="col-xs-1 text-center">
                                <a href="#"></a>
                              </div>
                            </div>
                            <!-- /.row -->
                          </li>
                        @endif

                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="{{ url('profile') }}" class="btn btn-default btn-flat">Profile</a>
                            </div>
                            <div class="pull-right">
                                <a href="{{ url('/logout') }}" class="btn btn-default btn-flat">Sign out</a>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>
