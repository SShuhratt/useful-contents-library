@extends('layout')

@section('content')
    <div class="container py-5">
        <div class="card shadow-sm">
            <div class="card-body">
                <h2 class="card-title mb-4">Genres List</h2>
                <a href="{{ route('genres.create') }}" class="btn btn-primary mb-3">Create Genre</a>
                <ul class="list-group">
                    @foreach ($genres as $genre)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <a href="{{ route('genres.show', $genre->id) }}">{{ $genre->name }}</a>
                            <div>
                                @if(auth()->user() && auth()->user()->isAdmin())
                                    <a href="{{ route('genres.edit', $genre->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                    <form action="{{ route('genres.destroy', $genre->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?');">Delete</button>
                                    </form>
                                @endif
                                <a href="{{ route('genres.edit', $genre->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('genres.destroy', $genre->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?');">Delete</button>
                                </form>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endsection

