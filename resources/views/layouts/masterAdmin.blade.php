<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    @yield('meta')
    <title>@yield('title')</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <base href="{{ asset('') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="adminlte/plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="adminlte/dist/css/adminlte.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="adminlte/plugins/daterangepicker/daterangepicker.css">
    @yield('css')
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <li class=" nav-item "><a class="nav-link" href="#">Home</a></li>
            </ul>

        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="{{ route('admin.home') }}" class="brand-link">
                <img src="adminlte/dist/img/AdminLTELogo.png" alt="AdminLTE Logo"
                    class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">Admin</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="adminlte/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <h4 class="d-block text-white ml-2">{{ $nameAdmin }}</h4>
                    </div>
                </div>
                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                        <li class="nav-header nav-item " style="font-size: 18px; "><i
                                class="fas fa-tachometer-alt mr-2"></i>Dashboard</li>
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link ">
                                <i class="fas fa-database mr-2"></i></i>
                                <p>
                                    QL Sản Phẩm
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('admin.category.list') }}" class="nav-link ">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>QL Danh mục</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.product.list') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>QL Sản Phẩm</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.brand.list') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>QL Thương Hiệu</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item has-treeview">
                            <a href="" class="nav-link ">
                                <i class="fas fa-edit mr-2"></i>
                                <p>
                                    QL Đơn Hàng
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('admin.order.list') }}" class="nav-link ">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Đơn hàng</p>
                                    </a>
                                </li>
                                {{-- <li class="nav-item">
                                    <a href="pages/charts/inline.html" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>BV Sản Phẩm</p>
                                    </a>
                                </li> --}}
                            </ul>
                        </li>
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link ">
                                <i class="fas fa-database mr-2"></i></i>
                                <p>
                                    QL Info User
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('admin.user.list') }}" class="nav-link ">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>QL User</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.permission.list') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>QL Quyền (Permissions)</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.role.list') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>QL Vai Trò (Roles)</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item ">
                            <a href="{{ route('admin.comment.list') }}" class="nav-link ">
                                <i class="fas fa-comments mr-2"></i>
                                <p>
                                    QL Comments <span class="badge badge-danger mess"></span>
                                </p>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a href="{{ route('admin.contact.list') }}" class="nav-link ">
                                <i class="fas fa-file-contract mr-2"></i>
                                <p>
                                    QL Liên Hệ
                                </p>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a href="{{ route('admin.slider.list') }}" class="nav-link ">
                                <i class="fas fa-photo-video mr-2"></i>
                                <p>
                                    QL Sliders
                                </p>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a href="{{ route('admin.blog.list') }}" class="nav-link ">
                                <i class="fab fa-blogger mr-2"></i>
                                <p>
                                    QL Blog 
                                </p>
                            </a>
                        </li>
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link ">
                                <i class="fas fa-users-cog mr-2"></i>
                                <p>
                                    QL Accout
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="#" class="nav-link ">
                                        <i class="fas fa-sign-out-alt mr-2 nav-icon"></i>
                                        <p>
                                            QL Profile
                                        </p>
                                    </a>
                                </li>
                                <li class="nav-item ">
                                    <a href="{{ route('admin.logout') }}" class="nav-link ">
                                        <i class="fas fa-sign-out-alt mr-2 nav-icon"></i>
                                        <p>
                                            LogOut
                                        </p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->

        <div class="content-wrapper">
            <!-- Main content -->
            @yield('main')
        </div>
        <!-- /.content-wrapper -->

        <footer class="main-footer">
            <strong>Copyright &copy; 2014-2019 <a href="http://adminlte.io">AdminLTE.io</a>.</strong>
            All rights reserved.
            <div class="float-right d-none d-sm-inline-block">
                <b>Version</b> 3.0.5
            </div>
        </footer>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="adminlte/plugins/jquery/jquery.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="adminlte/plugins/jquery-ui/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)

    </script>
    <!-- Bootstrap 4 -->
    <script src="adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- AdminLTE App -->
    <script src="adminlte/dist/js/adminlte.js"></script>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    @yield('js')
    <script>
        $(function(){
            setInterval(function(){
                $.ajax({
                    type:"get",
                    url:"{{ route('admin.comment.showMess') }}",
                    success: function(res){
                        if(res.count == 0 ){
                            $('.mess').html("");
                        }else{
                            $('.mess').html(res.count);
                        }
                        
                    },
                    error: function(er){
                        $('.mess').html('error');
                    }
                });
            }, 6000);
        })
    </script>
</body>

</html>
