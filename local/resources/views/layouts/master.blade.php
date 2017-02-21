<?php
/**
 * Created by PhpStorm.
 * User: deyelovi
 * Date: 21/01/2017
 * Time: 7:32
 */
?>
        <!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
<head>
    <meta charset="UTF-8">
    <title>{{ "MANAJEMEN CIS" }} {{ $head_title or '' }}</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.2 -->
    <link href="{{ url("admin-lte/bootstrap/css/bootstrap.min.css") }}" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons -->
    <link href="http://code.ionicframework.com/ionicons/2.0.0/css/ionicons.min.css" rel="stylesheet" type="text/css" />
    <!-- DataTables -->
    <link href="{{ url("admin-lte/plugins/datatables/dataTables.bootstrap.css") }}" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="{{ url("admin-lte/dist/css/AdminLTE.min.css")}}" rel="stylesheet" type="text/css" />
    <link rel="icon" href="{{url('cis-ico.png')}}" sizes="32x32" />
    <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
          page. However, you can choose any other skin. Make sure you
          apply the skin class to the body tag so the changes take effect.
    -->
    <link href="{{ url("admin-lte/dist/css/skins/skin-blue.min.css")}}" rel="stylesheet" type="text/css" />
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ url('admin-lte/plugins/select2/select2.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2-bootstrap-theme/0.1.0-beta.6/select2-bootstrap.css">

    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.2.4/css/buttons.bootstrap.min.css">
    @yield('css')

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
</head>
<body class="skin-blue">
<div class="wrapper">

    <!-- Header -->
    @include('layouts.header')

            <!-- Sidebar -->
    @include('layouts.sidebar')

            <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                {{ $page_title or null }}
                <small>{{ $page_description or null }}</small>
            </h1>
            <!-- You can dynamically generate breadcrumbs here -->
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
                <li class="active">Here</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <!-- Your Page Content Here -->
            @yield('content')
        </section><!-- /.content -->
    </div><!-- /.content-wrapper -->

    <!-- Footer -->
    @include('layouts.footer')

</div><!-- ./wrapper -->

<!-- REQUIRED JS SCRIPTS -->

<!-- jQuery 2.1.3 -->
<script src="{{ asset ("admin-lte/plugins/jQuery/jquery-2.2.3.min.js") }}"></script>
<!-- Bootstrap 3.3.2 JS -->
<script src="{{ asset ("admin-lte/bootstrap/js/bootstrap.min.js") }}" type="text/javascript"></script>
<!-- AdminLTE App -->
<script src="{{ asset ("admin-lte/dist/js/app.min.js") }}" type="text/javascript"></script>

<!-- DataTables -->
<script src="{{ url("admin-lte/plugins/datatables/jquery.dataTables.min.js") }}"></script>
<script src="{{ url("admin-lte/plugins/datatables/dataTables.bootstrap.min.js") }}"></script>

<!-- InputMask -->
<script src="{{ url('admin-lte/plugins/input-mask/jquery.inputmask.js') }}"></script>
<script src="{{ url('admin-lte/plugins/input-mask/jquery.inputmask.date.extensions.js') }}"></script>
<script src="{{ url('admin-lte/plugins/input-mask/jquery.inputmask.js') }}"></script>

<!-- Select2 -->
<script src="{{ url('admin-lte/plugins/select2/select2.full.min.js') }}"></script>

<!-- Optionally, you can add Slimscroll and FastClick plugins.
      Both of these plugins are recommended to enhance the
      user experience -->
<script>
    $(function () {

        //Datemask dd/mm/yyyy
        $(".datemaskyear").inputmask("9999", {"placeholder": "yyyy"});

        $(".select2").select2({
            theme: "bootstrap"
        });

        $("[data-mask]").inputmask();
        $(".datemaskyear").inputmask("9999", {"placeholder": "yyyy"});
        $('.datatables-class').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": true,
            "ordering": false,
            "bSortable": true,
            "info": true,
            "autoWidth": false
        });
    });

    function ConfirmDelete()
    {
        var x = confirm("Are you sure you want to delete?");
        if (x)
            return true;
        else
            return false;
    }
</script>


<script src="https://cdn.datatables.net/buttons/1.2.4/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
<script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
<script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.colVis.min.js"></script>
<script>
    $(document).ready(function() {


        var table = $('#example').DataTable( {
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": false,
            "bSortable": true,
            "info": true,
            "autoWidth": false,
            buttons: [
                {
                    extend: 'pdf',
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                {
                    extend: 'excel',
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                {
                    extend: 'print',
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                {
                    extend: 'colvis',
                    collectionLayout: 'fixed two-column',
                    text: 'Filter Kolom'
                }
            ],
        } );

        table.buttons().container()
                .appendTo( '#example_wrapper .col-sm-6:eq(0)' );


        $('#example-fill tfoot th').each( function () {
            var title = $(this).text();
            $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
        } );

        var table_fill = $('#example-fill').DataTable( {
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": false,
            "bSortable": true,
            "info": true,
            "autoWidth": false,
//            stateSave: true,
            buttons: [
                {
                    extend: 'pdf',
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                {
                    extend: 'excel',
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                {
                    extend: 'print',
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                {
                    extend: 'colvis',
                    collectionLayout: 'fixed two-column',
                    text: 'Filter Kolom'
                }
            ],
        } );

        var allPages = table_fill.cells( ).nodes( );

        $('#selectAll').click(function () {
            if ($(this).hasClass('allChecked')) {
                $(allPages).find('input[type="checkbox"]').prop('checked', false);
            } else {
                $(allPages).find('input[type="checkbox"]').prop('checked', true);
            }
            $(this).toggleClass('allChecked');
        })

        table_fill.buttons().container()
                .appendTo( '#example_wrapper .col-sm-6:eq(0)' );

        // Apply the search
        table_fill.columns().every( function () {
            var that = this;

            $( 'input', this.footer() ).on( 'keyup change', function () {
                if ( that.search() !== this.value ) {
                    that
                            .search( this.value )
                            .draw();
                }
            } );
        } );

    } );
</script>

@yield('script')
</body>
</html>
