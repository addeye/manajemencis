<?php
/**
 * Created by PhpStorm.
 * User: deyelovi
 * Date: 02/03/2017
 * Time: 10:20
 */
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Manajamen CIS | Log in</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.4 -->
    <link href="{{url('admin-lte/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons -->
    <link href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="{{url('admin-lte/dist/css/AdminLTE.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link href="{{url('admin-lte/dist/css/skins/_all-skins.min.css')}}" rel="stylesheet" type="text/css" />
    <style>
        .carousel-inner>.item>a>img, .carousel-inner>.item>img {
            line-height: 1;
            width: 100%;
        }

        .navbar-brand {
            float: left;
            height: 50px;
            padding: 5px 16px;
            font-size: 18px;
            line-height: 20px;
        }

        img.img-logo {
            width: 40px;
        }
        .title-logo{
            float: right;
            padding-top: 10px;
            padding-left: 10px;
            font-weight: bold;
        }

        @media (min-width: 1349px) {
            .carousel-inner>.item>a>img, .carousel-inner>.item>img {
                line-height: 1;
                width: 100%;
                height: 502px;
            }
        }
    </style>
    @yield('css')
    <link rel="icon" href="{{url('cis-ico.png')}}" sizes="32x32" />

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
<body class="skin-blue layout-top-nav">
<div class="wrapper">
    <header class="main-header">
        <nav class="navbar navbar-static-top">
            <div class="container">
                <div class="navbar-header">
                    <a href="{{url('/')}}" class="navbar-brand">
                        <div style="float: left"><img class="img-logo" src="{{url('cis-logo.png')}}"></div>
                        <div class="title-logo">PLUT-KUMKM</div>
                    </a>
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
                        <i class="fa fa-bars"></i>
                    </button>
                </div>
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="navbar-collapse">
                    <ul class="nav navbar-nav pull-right">
                        @if(Auth::user())
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
                            @else
                        <li class=""><a href="#"><span class="glyphicon glyphicon-pencil"></span> SIGN UP</a></li>
                        <li class=""><a href="{{url('login')}}"><span class="glyphicon glyphicon-log-in"></span> LOGIN</a></li>
                            @endif
                    </ul>
                </div><!-- /.navbar-collapse -->
            </div><!-- /.container-fluid -->
        </nav>
    </header>
    <!-- Full Width Column -->
    <div class="content-wrapper">
        @yield('banner')
        <div class="container">
            <!-- Content Header (Page header) -->
            <!-- Main content -->
            <section class="content">
                @yield('content')
            </section><!-- /.content -->
        </div><!-- /.container -->
    </div><!-- /.content-wrapper -->
    <footer class="main-footer">
        <div class="container">
            <div class="pull-right hidden-xs">
                <b>Version</b> 1.0.0
            </div>
            <strong>Copyright &copy; 2017 <a href="http://peacbromo.co.id/">PEACBromo</a>.</strong> All rights reserved.
        </div><!-- /.container -->
    </footer>
</div><!-- ./wrapper -->

<!-- jQuery 2.2.3 -->
<script src="{{ url("admin-lte/plugins/jQuery/jquery-2.2.3.min.js") }}"></script>
<!-- Bootstrap 3.3.2 JS -->
<script src="{{url('admin-lte/bootstrap/js/bootstrap.min.js')}}" type="text/javascript"></script>
<!-- SlimScroll -->
<script src="{{url('admin-lte/plugins/slimScroll/jquery.slimscroll.min.js')}}" type="text/javascript"></script>
<!-- FastClick -->
<script src='{{url('admin-lte/plugins/fastclick/fastclick.min.js')}}'></script>
<!-- AdminLTE App -->
<script src="{{url('admin-lte/dist/js/app.min.js')}}" type="text/javascript"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{url('admin-lte/dist/js/demo.js')}}" type="text/javascript"></script>
@yield('script')
</body>
</html>

