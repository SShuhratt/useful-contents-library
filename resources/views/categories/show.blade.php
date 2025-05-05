@extends('layout')

@section('content')
    <div class="container py-5">
        <div class="card shadow-sm">
            <div class="card-body">
                <h2 class="card-title mb-4">{{ $category->name }}</h2>

                <h4 class="mb-3">Contents in this Category:</h4>
                <ul class="list-group">
                    @foreach ($category->contents as $content)
                        <li class="list-group-item">
                            <a href="{{ route('contents.show', $content->id) }}">{{ $content->title }}</a>
                        </li>
                    @endforeach
                </ul>

                <div class="mt-4">
                    <a href="{{ route('categories.index') }}" class="btn btn-secondary">Back to Categories</a>
                    @if(auth()->user() && auth()->user()->isAdmin())
                        <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-warning">Edit Category</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
