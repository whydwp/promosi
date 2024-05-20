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
            <div class="card">
                <div class="card-body">
                    <h1 class="m-0 font-weight-bold text-primary">{{ $post->title }}</h1>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <th>Start Date</th>
                                    <td>{{ \Carbon\Carbon::parse($post->start_date)->isoFormat('D  MMMM  YYYY') }}</td>
                                </tr>
                                <tr>
                                    <th>End Date</th>
                                    <td>{{ \Carbon\Carbon::parse($post->end_date)->isoFormat('D  MMMM  YYYY') }}</td>
                                </tr>
                                <tr>
                                    <th>Nama Cabang</th>
                                    <td>{{ $post->branch }}</td>
                                </tr>
                                <tr>
                                    <th>Regional</th>
                                    <td>{{ $post->regional }}</td>
                                </tr>
                                <tr>
                                    <th>Link</th>
                                    <td>
                                        @if ($post->status === 'Expired')
                                        <span class="text-muted">Link unavailable</span>
                                        @else
                                        <a href="https://webpromosi.miegacoan.co.id/{{ $post->branch }}" target="_blank">https://webpromosi.miegacoan.co.id/{{ $post->branch }}</a>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Status</th>
                                    <td>
                                        @if ($post->status === 'Published')
                                        <span class="badge bg-success text-white py-1 px-2">{{ $post->status }}</span>
                                        @elseif ($post->status === 'Expired')
                                        <span class="badge bg-danger text-white py-1 px-2">{{ $post->status }}</span>
                                        @else
                                        {{ $post->status }}
                                        @endif
                                    </td>
                                </tr>
                               <tr>
    <th>Image</th>
    <td>
        <div class="image-container d-flex flex-wrap">
            @php
            $images = json_decode($post->image);
            @endphp
            @foreach ($images as $image)
            <div class="col-md-4 mb-3">
                <img src="https://webpromosi.miegacoan.co.id/public/images/{{ $image }}" class="img-fluid" alt="Image">
            </div>
            @endforeach
        </div>
    </td>
</tr>

                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('posts.index') }}" class="btn btn-secondary">Back</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
