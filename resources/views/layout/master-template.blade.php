<!DOCTYPE html>
<html lang="en" dir="">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Dashboard Promosi | Mie Gacoan<</title>
    <link href="https://fonts.googleapis.com/css?family=Nunito:300,400,400i,600,700,800,900" rel="stylesheet" />
    <link href="{{ asset('dist-assets/css/themes/lite-purple.min.css')}}" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link href="{{ asset('dist-assets/css/plugins/perfect-scrollbar.min.css')}}" rel="stylesheet" />
    <link href="{{ asset('dist-assets/css/plugins/datatables.min.css')}}" rel="stylesheet"  />
	<link rel="stylesheet" type="text/css" href="{{ asset('dist-assets/css/feather-icon.css')}}">
	<link rel="stylesheet" type="text/css" href="{{ asset('dist-assets/css/icofont.css')}}">
</head>

<body class="text-left">
    <div class="app-admin-wrap layout-sidebar-compact sidebar-dark-purple sidenav-open clearfix">
        @include('layouts.right-sidebar')
        @include('layouts.top-sidebar')

        <!--=============== Left side End ================-->
        <div class="main-content-wrap d-flex flex-column">

			<!-- ============ Body content start ============= -->
            @yield('content')
        </div>
    </div><!-- ============ Search UI Start ============= -->

    <script src="{{ asset('dist-assets/js/plugins/jquery-3.3.1.min.js')}}"></script>
    <script src="{{ asset('dist-assets/js/plugins/bootstrap.bundle.min.js')}}"></script>
    <script src="{{ asset('dist-assets/js/plugins/perfect-scrollbar.min.js')}}"></script>
    <script src="{{ asset('dist-assets/js/scripts/script.min.js')}}"></script>
    <script src="{{ asset('dist-assets/js/scripts/sidebar.compact.script.min.js')}}"></script>
    <script src="{{ asset('dist-assets/js/scripts/customizer.script.min.js')}}"></script>
    <script src="{{ asset('dist-assets/js/plugins/datatables.min.js')}}"></script>
    <script src="{{ asset('dist-assets/js/scripts/datatables.script.min.js')}}"></script>
	<script src="{{ asset('dist-assets/js/icons/feather-icon/feather.min.js')}}"></script>
    <script src="{{ asset('dist-assets/js/icons/feather-icon/feather-icon.js')}}"></script>
</body>

</html>
