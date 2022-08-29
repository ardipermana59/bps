<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="{{ asset('assets/bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('assets/bower_components/font-awesome/css/fontawesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/bower_components/font-awesome/css/solid.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{ asset('assets/bower_components/Ionicons/css/ionicons.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('assets/dist/css/AdminLTE.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/dist/css/skins/skin-blue.min.css') }}">
    <!-- Google Font -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <style>
        .main-header .sidebar-toggle:before{
            content: '';
        }
        .swal2-popup {
            font-size: 1.6rem !important;
        }
        .invalid-feedback {
            color: red !important;
        }
        .box {
            overflow: auto;
        }
    </style>
    <!-- Styles -->
    @stack('style')
</head>

<body class="hold-transition skin-blue sidebar-mini">
    <div id="app" class="wrapper">

        <!-- Main Header -->
        <header class="main-header">

            <!-- Logo -->
            <a href="{{ route('dashboard') }}" class="logo">
                <!-- mini logo for sidebar mini 50x50 pixels -->
                <span class="logo-mini"><img src="{{ asset('assets/img/bps.png') }}"></span>
                <!-- logo for regular state and mobile devices -->
                <span class="logo-lg"><img src="{{ asset('assets/img/bps.png') }}"><b>{{ config('app.name') }}</b></span>
            </a>

            <!-- Header Navbar -->
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                    <i class="fa-solid fa-bars"></i>
                </a>
                <!-- Navbar Right Menu -->
                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">

                        <!-- User Account Menu -->
                        <li class="dropdown user user-menu">
                            <!-- Menu Toggle Button -->
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <!-- The user image in the navbar-->
                                <img src="{{ asset('assets/dist/img/user (2).png') }}" class="user-image"
                                    alt="User Image">
                                <!-- hidden-xs hides the username on small devices so only the image appears. -->
                                <span class="hidden-xs">{{ auth()->user()->name }}</span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- The user image in the menu -->
                                <li class="user-header">
                                    <img src="{{ asset('assets/dist/img/user (2).png') }}" class="img-circle"
                                        alt="User Image">
                                    <p>
                                            {{ auth()->user()->name }}
                                    </p>
                                </li>
                                <!-- Menu Footer-->
                                <li class="user-footer">
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                        class="d-none">
                                        @csrf
                                        <button type="submit" class="btn btn-default btn-block">Sign Out</button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <!-- Left side column. contains the logo and sidebar -->

        @include('layouts.partials.sidebar')

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                    @stack('title', 'Page Header')
                </h1>
                <ol class="breadcrumb">
                    <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                    <li class="active">@stack('breadcrumb', 'Here')</li>
                </ol>
            </section>

            <!-- Main content -->
            <section class="content container-fluid">

                @yield('content')

            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <!-- Main Footer -->
        <footer class="main-footer">
            <!-- Default to the left -->
            <strong>Copyright &copy; 2022 <a href="{{ route('dashboard') }}">Universitas Mandiri Fakultas
                    Teknik</a>.</strong> All rights reserved.
        </footer>

        <!-- Add the sidebar's background. This div must be placed
  immediately after the control sidebar -->
        <div class="control-sidebar-bg"></div>
    </div>
    <!-- ./wrapper -->
    <!-- jQuery 3 -->
    <script src="{{ asset('assets/bower_components/jquery/dist/jquery.min.js') }}"></script>
    <!-- Bootstrap 3.3.7 -->
    <script src="{{ asset('assets/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('assets/dist/js/adminlte.min.js') }}"></script>
    <script src="{{ asset('assets/sweetalert/sweetalert2.js') }}"></script>
    @if (session()->has('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: '{!! session()->get('success') !!}',
            })
        </script>
    @elseif (session()->has('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Gagal',
                text: '{!! session()->get('error') !!}',
            })
        </script>
    @endif
    @stack('scripts')

    <script>
<<<<<<< HEAD
=======

        
        const ambil_kegiatan = document.querySelector('.ambil_kegiatan');
        const ambil_penilai  = document.querySelector('.ambil_penilai');
>>>>>>> b0ba0ead89f38dc2e6c790a0867345eecf1a471e
        // Jquery
        // var option = $('option:selected', this).attr('npenilai');

        // DOM Biasa
        // var option   = document.querySelector('option:checked');
        // var getNilai = option.getAttribute('npenilai');
        // console.log(getNilai);

        // DOM ALL
        // var option = document.querySelectorAll('option.getnilai:checked');
        //     option.forEach(item => {
        //         console.log(item);
        // })
<<<<<<< HEAD

        const judul_halaman  = document.querySelector('.judul_halaman');

        // Ambil Nama Penilai Otomatis Dari Nama Kegiatan Di Menu Upload Kegiatan
        if(judul_halaman.innerText == 'Upload Kegiatan') {
            const ambil_kegiatan = document.querySelector('.ambil_kegiatan');
            const ambil_penilai  = document.querySelector('.ambil_penilai');    
            ambil_kegiatan.addEventListener('change', function(e) {
                var option = $('option:selected', this).attr('npenilai');
                ambil_penilai.value = option;
            });    
        } else if(judul_halaman.innerText == 'Upload Nilai') {
            const ambil_kegiatans          = document.querySelector('.ambil_kegiatans');
            const ambil_kegiatan_id_nilai  = document.querySelector('.ambil_kegiatan_id_nilai');    
            const ambil_Pegawai  = document.querySelector('.ambil_Pegawai');    
            ambil_kegiatans.addEventListener('change', function() {
                var option1 = $('option:selected', this).attr('nambilkegiatanid');
                var option2 = $('option:selected', this).attr('nambilfullname');
                ambil_kegiatan_id_nilai.value = option1;    
                ambil_Pegawai.value = option2;   
            })            
        }


        
        

=======
            
        ambil_kegiatan.addEventListener('change', function(e) {
            var option = $('option:selected', this).attr('npenilai');
            ambil_penilai.value = option;
        })
>>>>>>> b0ba0ead89f38dc2e6c790a0867345eecf1a471e
    </script>
</body>

</html>
