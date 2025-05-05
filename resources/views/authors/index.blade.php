@extends('layout')

@section('content')
    <div class="container py-5">
        <div class="card shadow-sm">
            <div class="card-body">
                <h2 class="card-title mb-4">Authors List</h2>
                {{-- 🔹 Added Search Form --}}
                <form method="GET" action="{{ route('authors.index') }}" class="mb-3">
                    <input type="text" name="search" placeholder="Search authors..." class="form-control" value="{{ request()->search }}">
                    <button type="submit" class="btn btn-primary mt-2">Search</button>
                </form>

                <a href="{{ route('authors.create') }}" class="btn btn-primary mb-3">Create Author</a>

                <ul class="list-group">
                    @foreach ($authors as $author)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <a href="{{ route('authors.show', $author->id) }}">{{ $author->name }}</a>
                            <div>
                                @if(auth()->user() && auth()->user()->isAdmin())
                                    <a href="{{ route('authors.edit', $author->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                    <form action="{{ route('authors.destroy', $author->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?');">Delete</button>
                                    </form>
                                @endif
                            </div>
                        </li>
                    @endforeach
                </ul>

                <div class="mt-4 flex justify-center space-x-2">
                    {!! $authors->links('pagination::bootstrap-5') !!}
                </div>

            </div>
        </div>
    </div>
@endsection
