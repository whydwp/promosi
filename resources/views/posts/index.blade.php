@extends('layout.master-template')

@section('content')
<div class="main-content">
    <div class="breadcrumb">
        <h1>Datatables Posts Management</h1>
    </div>
    @if(session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('success') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif
    <div class="separator-breadcrumb border-top"></div>
    <!-- end of row-->
    <div class="row mb-4">
        <div class="col-md-12 mb-4">
            <div class="card text-left">
              <div class="card-body">
    <h4 class="card-title mb-3"></h4>
    <div class="footer-bottom border-top float-right">
        @if(auth()->user()->role == 'admin')
        <div class="mb-3">
            <p><a class="btn btn-primary btn-icon m-1" href="{{ route('posts.create') }}">+ add Post</a></p>
            <p>
        </div>
        @endif
        <span class="flex-grow-1"></span></p>
    </div>
    <p>
    <div class="table-responsive" style="overflow-x: auto;">
        <table class="display table table-striped table-bordered" id="zero_configuration_table" style="width:100%">
            <thead>
                <tr>
            <th style="width: 50px">Title</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Nama Cabang</th>
                    <th>Regional</th>
                    <th>Status</th>
                    <th>Link</th>
                    @if(auth()->user()->role == 'admin')
                    <th>Actions</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @foreach ($posts as $post)
                <tr>
                    <td>{{ $post->title }}</td>
                    <td>{{ \Carbon\Carbon::parse($post->start_date)->isoFormat('D  MMMM  YYYY') }}</td>
                    <td>{{ \Carbon\Carbon::parse($post->end_date)->isoFormat('D  MMMM  YYYY') }}</td>
                    <td>{{ $post->branch }}</td>
                    <td>{{ $post->regional }}</td>

                    <td>
                        @if ($post->status === 'Published')
                            <span class="badge bg-success text-white py-1 px-2">{{ $post->status }}</span>
                        @elseif ($post->status === 'Expired')
                            <span class="badge bg-danger text-white py-1 px-2">{{ $post->status }}</span>
                        @else
                            {{ $post->status }}
                        @endif
                    </td>
                    <td>
                        @if ($post->status === 'Expired')
                            <span class="text-muted">Link unavailable</span>
                        @else
                            <a href="{{ $post->branch }}" target="_blank">{{ $post->branch }}</a>
                        @endif
                    </td>

                    @if(auth()->user()->role == 'admin')
                    <td>
                        <a class="btn btn-sm btn-primary" href="{{ route('posts.show', $post->id) }}" data-toggle="tooltip" title="Show">
                            <i class="nav-icon i-Eye font-weight-bold"></i>
                        </a>
                        <a class="btn btn-sm btn-success" href="{{ route('posts.edit', $post->id) }}" data-toggle="tooltip" title="Edit">
                            <i class="nav-icon i-Pen-2 font-weight-bold"></i>
                        </a>

                        <a onclick="confirmDelete({{ $post->id }})" class="btn btn-sm btn-danger mr-2" style="cursor: pointer;" data-toggle="tooltip" title="Delete">
                            <i class="nav-icon i-Close-Window font-weight-bold" style="color: white;"></i>
                        </a>
                    </td>
                    @endif
                </tr>
                @endforeach
            </tbody>
        </table>
        <div id="paginationLinks">
            {{ $posts->links() }}
        </div>
    </div>
</div>

            </div>
        </div>

    </div>
    <div class="flex-grow-1"></div>
    <!-- fotter end -->
</div>


    <div class="modal fade" id="deleteConfirmationModal" tabindex="-1" role="dialog" aria-labelledby="deleteConfirmationModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteConfirmationModalLabel">Confirm Deletion</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this post?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <form id="deleteForm" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Script to handle deletion confirmation -->
    <script>
        function confirmDelete(postId) {
            $('#deleteForm').attr('action', '{{ route("posts.destroy", ":id") }}'.replace(':id', postId));
            $('#deleteConfirmationModal').modal('show');
        }

        // Add event listener to the form submission
        $('#deleteForm').submit(function() {
            $('#deleteConfirmationModal').modal('hide'); // Hide the modal when the form is submitted
        });
    </script>
@endsection
