@extends('layout.master-template')


@section('content')
<div class="main-content">
    <div class="breadcrumb">
        <h1>Form User</h1>
        <ul>
            <li><a href="{{ route('users.index') }}">Form</a></li>
            <li>User Management</li>
        </ul>
    </div>
    <div class="separator-breadcrumb border-top"></div>
    <div class="row">
        <div class="col-md-6">
            <div class="card mb-5">
                <div class="card-body">
                    <form action="{{ route('users.store') }}" method="POST">
                        @csrf
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label" for="name">Nama User</label>
                            <div class="col-sm-10">
                                <input class="form-control" id="name" name="name" type="text" placeholder="Nama User" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label" for="email">Email</label>
                            <div class="col-sm-10">
                                <input class="form-control" id="email" name="email" type="text" placeholder="Email" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label" for="username">Username</label>
                            <div class="col-sm-10">
                                <input class="form-control" id="username" name="username" type="text" placeholder="Username" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label" for="password">Password</label>
                            <div class="col-sm-10">
                                <input class="form-control" id="password" name="password" type="password" placeholder="Password" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label" for="role">Role</label>
                            <div class="col-sm-10">
                                <select class="form-control" id="role" name="role">
                                    <option value="admin">Admin</option>
                                    <option value="user">User</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-10">
                                <button class="btn btn-primary" type="submit">Create User</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- end of main-content -->
    <!-- Footer Start -->
    <div class="flex-grow-1"></div>
    <!-- footer end -->
</div>



@endsection
