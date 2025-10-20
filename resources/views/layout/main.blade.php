<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Operator</title>
    <link rel="icon" href="{{ asset('img/logo.png') }}" type="image/x-icon">

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/fontawesome-free/css/all.min.css')}}">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('adminlte/dist/css/adminlte.min.css')}}">

    <link rel="stylesheet" href="{{ asset('style/style.css')}}">
</head>

<body class="hold-transition sidebar-mini sidebar-fixed">
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4 d-flex flex-column justify-content-between position-fixed">
            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="{{asset('img/AdminLTELogo.png')}}" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block">Admin</a>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <li class="nav-item">
                            <a href="/dashboard" class="nav-link">
                                <i class="nav-icon fas fa-table"></i>
                                <p>
                                    List Antrean
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/listOperator" class="nav-link">
                                <i class="nav-icon fas fa-table"></i>
                                <p>
                                    List Operator
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/pengajuanSidang" class="nav-link">
                                <i class="nav-icon fas fa-table"></i>
                                <p>
                                    Pengajuan Sidang
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/tambahPerkara" class="nav-link">
                                <i class="nav-icon fas fa-table"></i>
                                <p>
                                    Tambah Perkara
                                </p>
                            </a>
                        </li>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <div class="px-2 py-4">
                <a href="{{ route('actionLogout') }}" class="btn btn-danger col-12">Log out</a>
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->

        @yield('content')

        <!-- /.content-wrapper -->

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <script src="{{asset('adminlte/plugins/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

    <script src="{{asset('adminlte/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>

    <script src="{{asset('adminlte/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('adminlte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
    <script src="{{asset('adminlte/plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('adminlte/plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
    <script src="{{asset('adminlte/plugins/jszip/jszip.min.js')}}"></script>
    <script src="{{asset('adminlte/plugins/pdfmake/pdfmake.min.js')}}"></script>
    <script src="{{asset('adminlte/plugins/pdfmake/vfs_fonts.js')}}"></script>
    <script src="{{asset('adminlte/plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
    <script src="{{asset('adminlte/plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
    <script src="{{asset('adminlte/plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>

    <script src="{{asset('adminlte/dist/js/adminlte.min.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- AdminLTE for demo purposes -->
    <!-- Page specific script -->
    @stack('script')
</body>

</html>