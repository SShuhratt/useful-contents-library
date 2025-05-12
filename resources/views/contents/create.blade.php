@extends('layout')

@section('title', 'Create New Content')

@section('content')
    <div class="container py-5">
        <h1 class="mb-3">Add New Content</h1>

{{--        <form action="{{ route('contents.store') }}" method="POST">--}}
        <form action="/contents" method="POST">
            @csrf

            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control" id="title" name="title" required>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description" required></textarea>
            </div>

            <div class="mb-3">
                <label for="url" class="form-label">External Link (Optional)</label>
                <input type="url" class="form-control" id="url" name="url">
            </div>

            <div class="mb-3">
                <label for="category_id" class="form-label">Category</label>
                <select class="form-select" id="category_id" name="category_id" required>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="genres" class="form-label">Genres</label>
                <select class="form-select" id="genres" name="genres[]" multiple>
                    @foreach($genres as $genre)
                        <option value="{{ $genre->id }}">{{ $genre->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="authors" class="form-label">Authors</label>
                <select class="form-select" id="authors" name="authors[]" multiple>
                    @foreach($authors as $author)
                        <option value="{{ $author->id }}">{{ $author->name }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Create Content</button>
        </form>
    </div>
@endsection
