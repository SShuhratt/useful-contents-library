@extends('layout')

@section('title', 'Contents List')

@section('content')
    <div class="container py-5">
        <div class="card shadow-sm">
            <div class="card-body">
                <h2 class="card-title mb-4">Contents List</h2>

                <form method="GET" action="{{ route('contents.index') }}" class="mb-3">
                    <input type="text" name="search" placeholder="Search contents..." class="form-control" value="{{ request()->search }}">
                    <button type="submit" class="btn btn-primary mt-2">Search</button>
                </form>

                @if(auth()->check() && auth()->user()->isAdmin())
                    <a href="{{ route('contents.create') }}" class="btn btn-success mb-3">+ Add New Content</a>
                @endif

                <div class="container">
                    <div class="row">
                        @foreach($contents as $content)
                            <div class="col-md-4 mb-3">
                                <div class="card shadow-sm">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $content->title }}</h5>
                                        <p class="card-text">{{ Str::limit($content->description, 100) }}</p>
                                        <a href="{{ route('contents.show', ['content' => $content->id]) }}" class="btn btn-primary">Open</a>

                                        <x-like-button :content="$content" />

                                        @if(auth()->user() && auth()->user()->isAdmin())
                                            <a href="{{ route('contents.edit', ['content' => $content->id]) }}" class="btn btn-warning mt-2">Edit</a>
                                            <form action="{{ route('contents.destroy', ['content' => $content->id]) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger mt-2" onclick="return confirm('Are you sure you want to delete this?')">
                                                    Delete
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="mt-4 flex justify-center space-x-2">
                    {!! $contents->links('pagination::bootstrap-5') !!}
                </div>
            </div>
        </div>
    </div>
@endsection
