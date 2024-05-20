@extends('layout.loginLayout')

@section('content-login')
<div class="card">
    <!-- Logo -->
    <div class="card-header py-4 text-center bg-primary">
        <a href="index.php">
            <span><img src="assets/images/logo.png" alt="logo" height="55"></span>
        </a>
    </div>

    <div class="card-body p-4">
        <div class="text-center w-75 m-auto">
            <h4 class="text-dark-50 text-center pb-0 fw-bold">Sign In</h4>
            <p class="text-muted mb-4">Enter your email address and password to access admin panel.</p>
        </div>

        <form method="post" action="{{ route('login') }}">
            @csrf

            <div class="mb-3">
                <label for="emailaddress" class="form-label">Email address</label>
                <input type="email" name="email" class="form-control" placeholder="Enter email" required>
            </div>

            <div class="mb-3">
                <a href="auth-recoverpw.php" class="text-muted float-end fs-12">Forgot your password?</a>
                <label for="password" class="form-label">Password</label>
                <div class="input-group input-group-merge">
                    <input type="password" name="password" class="form-control" placeholder="Enter password" required>
                    <div class="input-group-text" data-password="false">
                        <span class="password-eye"></span>
                    </div>
                </div>
            </div>

            <div class="mb-3 mb-3">
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="checkbox-signin" checked>
                    <label class="form-check-label" for="checkbox-signin">Remember me</label>
                </div>
            </div>

            <div class="mb-3 mb-0 text-center">
                <button class="btn btn-primary" type="submit"> Log In </button>
            </div>
        </form>
    </div> <!-- end card-body -->
</div>
    <script src="{{ asset('assets/js/app.min.js')}}"></script>
    <script src="{{ asset('assets/js/vendor.min.js')}}"></script>
@endsection
