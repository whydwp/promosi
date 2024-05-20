@extends('layout.master-template')

@section('content')
<div class="main-content">
    <div class="breadcrumb">
        <h1>Post Management</h1>
        <ul>
            <li><a href="href">Form</a></li>
            <li>Post Management</li>
        </ul>
    </div>
    <div class="separator-breadcrumb border-top"></div>
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-5">
                <div class="card-body">
                   <!-- Display validation errors if any -->
@if ($errors->any())
    <div class="alert alert-danger" role="alert">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<!-- Display success message if any -->
@if (session('success'))
    <div class="alert alert-success" role="alert">
        {{ session('success') }}
    </div>
@endif

<form action="{{ route('posts.update', $post->id) }}" method="POST" enctype="multipart/form-data" id="postForm">
    @csrf
    @method('PUT')
    <!-- Title input with validation -->
    <div class="form-group row">
        <label class="col-sm-2 col-form-label" for="title">Title</label>
        <div class="col-sm-10">
            <input type="text" class="form-control @error('title') is-invalid @enderror" name="title"
                id="title" value="{{ old('title', $post->title) }}">
            @error('title')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
    <div class="form-group row">
        <label class="col-sm-2 col-form-label" for="start_date">Start Date</label>
        <div class="col-sm-10">
            <input type="date" class="form-control @error('start_date') is-invalid @enderror"
                name="start_date" id="start_date" value="{{ old('start_date', $post->start_date) }}">
            @error('start_date')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
    <div class="form-group row">
        <label class="col-sm-2 col-form-label" for="end_date">End Date</label>
        <div class="col-sm-10">
            <input type="date" class="form-control @error('end_date') is-invalid @enderror"
                name="end_date" id="end_date" value="{{ old('end_date', $post->end_date) }}">
            @error('end_date')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
    <div class="form-group row">
        <label class="col-sm-2 col-form-label" for="regional">Regional</label>
        <div class="col-sm-10">
            <select class="form-control @error('regional') is-invalid @enderror" name="regional"
            id="name_regions">
            @foreach ($branches->unique('name_regions') as $branch)
                <option value="{{ $branch->name_regions }}"
                    {{ old('regional', $post->regional) == $branch->name_regions ? 'selected' : '' }}>
                    {{ $branch->name_regions }}
                </option>
            @endforeach
        </select>

        @error('name_regions')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
        </div>

    </div>
    <div class="form-group row">
        <label class="col-sm-2 col-form-label" for="branch">Branch</label>
        <div class="col-sm-10">
            <select class="form-control @error('branch') is-invalid @enderror" name="branch"
            id="branch">
            @foreach ($branches as $branchOption)
                <option value="{{ $branchOption->name }}"
                    {{ old('branch', $post->branch) == $branchOption->name ? 'selected' : '' }}>
                    {{ $branchOption->name }}
                </option>
            @endforeach
        </select>
        @error('branch')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
        </div>

    </div>
    <div class="form-group row">
        <label class="col-sm-2 col-form-label" for="image">Upload Attachment</label>
        <div class="col-sm-10">
            <div id="imagePreview" class="sortable-list dropzone"
            style="display: flex; flex-direction: row; flex-wrap: nowrap; overflow-x: auto;">
            @php
            $images = json_decode($post->image);
        @endphp
        @if (is_array($images))
            @foreach ($images as $index => $image)
                <div class="image-container" data-priority="{{ $index }}"
                    style="position: relative; display: inline-block; margin-right: 10px;">
                    <img src="https://webpromosi.miegacoan.co.id/public/images/{{ $image }}" alt="Post Image"
                        class="img-thumbnail img-fluid" style="max-width: 200px;">
                    <button type="button" class="btn btn-sm btn-danger delete-image"
                        style="position: absolute; top: 0; right: 0;"
                        onclick="removeImage(this)">
                        <i class="fas fa-times"></i> <!-- Use appropriate icon class here -->
                    </button>
                    <input type="hidden" name="image_priority[]" value="{{ $index }}">
                </div>
            @endforeach
        @endif
        </div>
        <input type="file" class="form-control-file @error('image') is-invalid @enderror mt-2"
            name="image[]" id="image" multiple accept="image/*" onchange="validateImageResolution(this)">
             <small class="text-muted">Resolution must be 1441 x 801 pixels.</small>
        @error('image')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
        </div>

    </div>
    <div style="display: flex; justify-content: space-between;">
        <a href="{{ route('posts.index') }}" class="btn btn-secondary">Back</a>
        <button type="submit" class="btn btn-primary mt-2">Submit</button>
    </div>
</form>
                </div>
            </div>
        </div>
    </div>
    <!-- end of main-content -->
    <!-- Footer Start -->
    <div class="flex-grow-1"></div>
    <!-- fotter end -->
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.14.0/Sortable.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    function fetchBranches() {
        var selectedValue = $('#name_regions').val();

        $.ajax({
            url: '{{ route('getBranchesByRegion') }}',
            type: 'GET',
            data: {
                nameRegionsId: selectedValue
            },
            success: function(data) {
                $('#branch').empty(); // Clear existing options
                $.each(data, function(key, value) {
                    $('#branch').append('<option value="' + value.name + '">' +
                        value.name + '</option>'); // Add new options
                });
            },
            error: function(xhr) {
                // Handle errors
            }
        });
    }
    $('#name_regions').change(function() {
        fetchBranches(); // Call the fetchBranches function whenever the value changes
    });
    fetchBranches();
</script>

<script>
    // Function to remove image
    function removeImage(element) {
        element.parentNode.remove();
    }

    document.getElementById('image').addEventListener('change', function() {
        var previewContainer = document.getElementById('imagePreview');
        var files = this.files;

        for (var i = 0; i < files.length; i++) {
            var file = files[i];

            if (file.type.match('image.*')) {
                var reader = new FileReader();

                reader.onload = function(event) {
                    var wrapper = document.createElement('div');
                    var image = new Image();
                    var deleteButton = document.createElement('button');

                    wrapper.classList.add('image-wrapper');
                    wrapper.style.position = 'relative';

                    image.src = event.target.result;
                    image.style.width = '100px';
                    image.style.objectFit = 'cover';
                    image.style.height = '100px';

                    deleteButton.type = 'button';
                    deleteButton.classList.add('btn', 'btn-sm', 'btn-danger', 'delete-image');
                    deleteButton.style.position = 'absolute';
                    deleteButton.style.top = '0';
                    deleteButton.style.right = '0';
                    deleteButton.innerHTML = '<i class="fas fa-times"></i>';

                    // Add event listener for delete button
                    deleteButton.onclick = function() {
                        wrapper.remove(); // Remove the image wrapper when delete button is clicked
                    };

                    wrapper.appendChild(image);
                    wrapper.appendChild(deleteButton);

                    previewContainer.appendChild(wrapper);
                };

                reader.readAsDataURL(file);
            }
        }
    });
    // Function to validate image resolution
    function validateImageResolution(input) {
        var files = input.files;

        for (var i = 0; i < files.length; i++) {
            var file = files[i];

            if (file.type.match('image.*')) {
                var reader = new FileReader();

                reader.onload = function(event) {
                    var image = new Image();

                    image.onload = function() {
                        if (this.width !== 1441 || this.height !== 801) {
                            alert('Please upload images with resolution 1441 x 801 pixels.');
                            input.value = ''; 
                            var previewContainer = document.getElementById('imagePreview');
                            previewContainer.innerHTML = ''; // Clear displayed images
                        }
                    };

                    image.src = event.target.result;
                };

                reader.readAsDataURL(file);
            }
        }
    }

    // Function to save sorted images via AJAX
    function saveSortedImages() {
        var previewContainer = document.getElementById('imagePreview');
        var images = Array.from(previewContainer.children);
        var imageOrder = images.map(function(wrapper) {
            return wrapper.firstChild.src;
        });

        $.ajax({
            url: '{{ route('saveSortedImages') }}',
            type: 'POST',
            data: {
                image_order: imageOrder
            },
            success: function(response) {
                // Handle success response
                console.log('Success: ' + response.message);
                // Optionally, perform any additional actions after successful update
                // For example, display a success message to the user
                alert('Image order saved successfully!');
            },
            error: function(xhr) {
                // Handle error response
                console.error('Error: ' + xhr.responseText);
                // Optionally, display an error message to the user
                alert('Error saving image order. Please try again later.');
            }
        });
    }
</script>

@endsection
