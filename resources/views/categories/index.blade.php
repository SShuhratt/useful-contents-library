@extends('layout')

@section('content')
    <div class="container py-5">
        <div class="card shadow-sm">
            <div class="card-body">
                <h2 class="card-title mb-4">Categories List</h2>
                <a href="{{ route('categories.create') }}" class="btn btn-primary mb-3">Create Category</a>
                <ul class="list-group">
                    @foreach ($categories as $category)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <a href="{{ route('categories.show', $category->id) }}">{{ $category->name }}</a>
                            <div>
                                <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('categories.destroy', $category->id) }}" method="POST" style="display:inline;">
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

