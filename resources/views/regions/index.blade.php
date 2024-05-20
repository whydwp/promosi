@extends('layout.master-template')

@section('content')
    <div class="main-content">
        <div class="breadcrumb">
            <h1>Datatables Regional</h1>
        </div>
        <div class="separator-breadcrumb border-top"></div>
        <!-- end of row-->
        <div class="row mb-4">
            <div class="col-md-12 mb-4">
                <div class="card text-left">
                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                        <div class="mb-3">
                            <form action="{{ route('regions.store') }}" method="POST" class="row">
                                @csrf
                                <div class="form-group col-md-6">
                                    <label for="title">Regional Name:</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="title" name="title"
                                            placeholder="Enter regional name">
                                        <div class="input-group-append">
                                            <button type="submit" class="btn btn-primary">+ Add Regional</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <h4 class="card-title mb-3"></h4>

                        <p>
                        <div class="table-responsive">
                            <table class="display table table-striped table-bordered" id="zero_configuration_table"
                                style="width:100%">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nama Regional</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($regionals->unique('title') as $regional)
                                        <tr>
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td>{{ $regional->title }}</td>
                                            <td>
                                                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                                                    data-target="#editModal{{ $regional->id }}">
                                                    <i class="nav-icon i-Pen-2 font-weight-bold"></i>
                                                </button>

                                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                                    data-target="#deleteModal{{ $regional->id }}">
                                                    <i class="nav-icon i-Close-Window font-weight-bold"
                                                        style="color: white;"></i>
                                                </button>

                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nama Regional</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="editModal{{ $regional->id }}" tabindex="-1" role="dialog"
                aria-labelledby="editModalLabel{{ $regional->id }}" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editModalLabel{{ $regional->id }}">Edit Regional</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="{{ route('regions.update', $regional->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="title">Regional Name</label>
                                    <input type="text" class="form-control" id="title" name="title"
                                        value="{{ $regional->title }}">
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Update data</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="deleteModal{{ $regional->id }}" tabindex="-1" role="dialog"
                aria-labelledby="deleteModalLabel{{ $regional->id }}" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="deleteModalLabel{{ $regional->id }}">Delete Regional</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            Are you sure you want to delete the regional "{{ $regional->title }}"?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <form action="{{ route('regions.destroy', $regional->id) }}" method="POST"
                                class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
            <!-- end of col-->
            <!-- end of col-->
            <!-- end of col-->
            <!-- end of col-->
            <!-- end of col-->
            <!-- end of col-->
            <!-- end of col-->
            <!-- end of col-->
            <!-- end of col-->
            <!-- end of col-->
            <!-- end of col-->
            <!-- end of col-->
        </div>
        <!-- end of row-->
        <!-- end of main-content -->
        <!-- Footer Start -->
        <div class="flex-grow-1"></div>
        <!-- fotter end -->
    </div>
@endsection
