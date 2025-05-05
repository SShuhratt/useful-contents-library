@extends('layout')

@section('content')
    <div class="container py-5">
        <div class="card shadow-sm">
            <div class="card-body">
                <h2 class="card-title mb-4">{{ $genre->name }}</h2>

                @if ($genre->contents && $genre->contents->count() > 0)
                    <h4 class="mb-3">Contents in this Genre:</h4>
                    <ul class="list-group">
                        @foreach ($genre->contents as $content)
                            <li class="list-group-item">
                                <a href="{{ route('contents.show', $content->id) }}">{{ $content->title }}</a>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p class="text-muted">No contents available for this genre.</p>
                @endif


                <div class="mt-4">
                    <a href="{{ route('genres.index') }}" class="btn btn-secondary">Back to Categories</a>
                    @if(auth()->user() && auth()->user()->isAdmin())
                        <a href="{{ route('genres.edit', $genre->id) }}" class="btn btn-warning">Edit Category</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
