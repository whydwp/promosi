@include('layouts.session')
@include('layouts.main')

<head>
    <title>ESS | Employee Self Service</title>
    @include('layouts.title-meta')
    @include('layouts.head-css')
</head>

<body class="authentication-bg position-relative">
    @include('layouts.background')

    <div class="account-pages pt-2 pt-sm-5 pb-4 pb-sm-5 position-relative">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xxl-4 col-lg-5">
                    @yield('content-login')
                    <!-- end card -->
                    <!-- end row -->
                </div> <!-- end col -->
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </div>
    <!-- end page -->

    <footer class="footer footer-alt fw-medium">
        <span class="bg-body">
            <script>
                document.write(new Date().getFullYear())
            </script> © Pesta Pora Abadi - miegacoan.co.id
        </span>
    </footer>
    {{-- @include('layouts.footer-scripts') --}}

    <!-- App js -->
    <script src="{{ asset('assets/js/app.min.js') }}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</body>

</html>
