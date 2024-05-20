<!-- edit.blade.php -->
@extends('layout.master-template')

@section('content')
   <div class="main-content">
    <div class="breadcrumb">
        <h1>Form Nama Cabang</h1>
        <ul>
            <li><a href="{{ route('users.index') }}">Form</a></li>
            <li>Nama Cabang Management</li>
        </ul>
    </div>
    <div class="separator-breadcrumb border-top"></div>
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-5">
                <div class="card-header">
                    Edit Cabang
                </div>
                <div class="card-body">
                    <!-- Success and Error Alerts -->
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    <!-- Edit Branch Form -->
                    <form action="{{ route('branches.update', $branch->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="branch_name">Cabang Name</label>
                            <input type="text" class="form-control" id="branch_name" name="branch_name" value="{{ $branch->name }}">
                        </div>
                        <div class="form-group">
                            <label for="region_id">Region</label>
                            <select class="form-control" id="region_id" name="region_id">
                                @foreach ($regions->groupBy('title') as $regionGroup)
                                    @foreach ($regionGroup as $region)
                                        <option value="{{ $region->id }}" {{ $branch->region_id == $region->id ? 'selected' : '' }}>{{ $region->title }}</option>
                                        @break
                                    @endforeach
                                @endforeach
                            </select>
                        </div>
                        <div style="display: flex; justify-content: space-between;margin:auto">
                            <a href="{{ route('branches.index') }}" class="btn btn-secondary mb-4 ml-3">Back</a>
                            <button type="submit" class="btn btn-primary mr-3" style="height: 40px">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
