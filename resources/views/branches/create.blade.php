@extends('layout.master-template')

@section('content')
   <div class="container">
        <!-- Create Branch Form -->
        <form action="{{ route('branches.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="branch_name">Nama Cabang</label>
                <input type="text" class="form-control" id="branch_name" name="branch_name" placeholder="Enter cabang name">
            </div>
            <div class="form-group">
                <label for="region_id">Region</label>
                <select class="form-control" id="region_id" name="region_id">
                    @foreach ($regions->unique('id') as $region)
                        <option value="{{ $region->id }}">{{ $region->name }}</option>
                    @endforeach
                </select>

            </div>
            <button type="submit" class="btn btn-primary">Create</button>
        </form>
    </div>
@endsection
