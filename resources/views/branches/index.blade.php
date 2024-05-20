<!-- index.blade.php -->
@extends('layout.master-template')

@section('content')
<div class="main-content">
    <div class="breadcrumb">
        <h1>Datatables Cabang</h1>
    </div>
    <div class="separator-breadcrumb border-top"></div>
    <!-- end of row-->
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
    <div class="row mb-4">
        <div class="col-md-12 mb-4">
            <div class="card text-left">
                <div class="card-body">
                <form action="{{ route('branches.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="branch_name" class="form-label">Cabang Name</label>
            <input type="text" class="form-control" id="branch_name" name="branch_name"
                placeholder="Enter cabang name">
        </div>
        <div class="mb-3">
            <label for="region_id" class="form-label">Region</label>
            <select class="form-control" id="region_id" name="region_id">
                <option value="1">Jabar 1</option>
                <option value="16">Jatim 1</option>
                <option value="17">Jabar 2</option>
                <option value="38">Jateng</option>
                <option value="41">SCM</option>
                <option value="46">Jatim 1</option>
                <option value="48">HO</option>
                <option value="50">DKI</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Create Cabang</button>
    </form>

    <hr>
                    <h4 class="card-title mb-3"></h4>
                    <div class="footer-bottom border-top float-right">
                        <p><a class="btn btn-primary btn-icon m-1" href="cabang-from.php">+ add Cabang</a></p>
                        <p>
                          <span class="flex-grow-1"></span></p>
                    </div>
                    <p>
                  <div class="table-responsive">
                        <table class="display table table-striped table-bordered" id="zero_configuration_table" style="width:100%">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nama Cabang</th>
                                    <th>Nama Regional</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                @foreach ($branches as $branch)
                    <tr>
                        <td>{{ $branches->firstItem() + $loop->index }}</td>
                        <td>{{ $branch->name }}</td>
                        <td>{{ $branch->region->title }}</td>
                        <td>
                            <!-- Edit Button -->
                                                                  <a class="btn btn-sm btn-success mr-2" href="{{ route('branches.edit', $branch->id) }}" data-toggle="tooltip" title="Edit">
    <i class="nav-icon i-Pen-2 font-weight-bold"></i>
    </a>
                         
                            <!-- Delete Button -->
                            
                            <button type="button" class="btn btn-sm btn-danger"  data-toggle="modal"
                                data-target="#deleteModal{{ $branch->id }}">
                                <i class="nav-icon i-Close-Window font-weight-bold" style="color: white;"></i>
                            </button>
                            <!-- Delete Modal -->
                            <div class="modal fade" id="deleteModal{{ $branch->id }}" tabindex="-1"
                                role="dialog" aria-labelledby="deleteModalLabel{{ $branch->id }}"
                                aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="deleteModalLabel{{ $branch->id }}">
                                                Delete Branch</h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            Are you sure you want to delete the branch "{{ $branch->name }}"?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Close</button>
                                            <form action="{{ route('branches.destroy', $branch->id) }}"
                                                method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
                            <tfoot>
                                <tr>
                                    <th>ID</th>
                                    <th>Nama Cabang</th>
                                    <th>Nama Regional</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                        </table>
                        <div id="paginationLinks">
            {{ $branches->links() }}
        </div>
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
        <!-- end of col-->
        <!-- end of col-->
    </div>
    <!-- end of row-->
    <!-- end of main-content -->
    <!-- Footer Start -->
    <div class="flex-grow-1"></div>
    <!-- fotter end -->
</div>
    <!-- Initialize Bootstrap toasts -->
    <script>
        $(document).ready(function() {
            $('.toast').toast('show');
        });
    </script>
@endsection
