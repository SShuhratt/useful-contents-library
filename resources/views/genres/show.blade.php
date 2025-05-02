@extends('layout')

@section('content')
    <div class="container py-5">
        <div class="card shadow-sm">
            <div class="card-body">
                <h2 class="card-title mb-4">{{ $genre->name }}</h2>

                <h4 class="mb-3">Contents in this Genre:</h4>
                <ul class="list-group">
                    @foreach ($genre->contents as $content)
                        <li class="list-group-item">
                            <a href="{{ route('genres.show', $content->id) }}">{{ $content->title }}</a>
                        </li>
                    @endforeach
                </ul>

                <div class="mt-4">
                    <a href="{{ route('genres.index') }}" class="btn btn-secondary">Back to Categories</a>
                    <a href="{{ route('genres.edit', $genre->id) }}" class="btn btn-warning">Edit Category</a>
                </div>
            </div>
        </div>
    </div>
@endsection
