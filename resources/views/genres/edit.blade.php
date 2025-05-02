@extends('layout')

@section('content')
    <div class="container py-5">
        <div class="card shadow-sm">
            <div class="card-body">
                <h2 class="card-title mb-4">Edit Genre</h2>

                <form action="{{ route('genres.update', $genre->id) }}" method="POST">
                    @csrf
                    @method('PUT') <!-- Ensures Laravel recognizes this as an update request -->

                    <div class="mb-3">
                        <label for="name" class="form-label">Genre Name:</label>
                        <input type="text" name="name" id="name" class="form-control"
                               value="{{ old('name', $genre->name) }}" required>
                    </div>

                    <div class="d-flex justify-content-between">
                        <button type="submit" class="btn btn-success">Update</button>
                        <a href="{{ route('genres.index') }}" class="btn btn-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
