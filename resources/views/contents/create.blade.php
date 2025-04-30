@extends('layout')

@section('content')
    <div class="container py-5">
        <div class="card shadow-sm">
            <div class="card-body">
                <h2 class="card-title mb-4">Create New Content</h2>

                <form action="{{ route('contents.store') }}" method="POST">
                    @csrf

                    {{-- Title Field --}}
                    <div class="mb-3">
                        <label for="title" class="form-label">Title:</label>
                        <input type="text" name="title" id="title" class="form-control" required>
                    </div>

                    {{-- Description Field --}}
                    <div class="mb-3">
                        <label for="description" class="form-label">Description:</label>
                        <textarea name="description" id="description" class="form-control"></textarea>
                    </div>

                    {{-- URL Field --}}
                    <div class="mb-3">
                        <label for="url" class="form-label">URL:</label>
                        <input type="url" name="url" id="url" class="form-control">
                    </div>

                    {{-- Category Field --}}
                    <div class="mb-3">
                        <label for="category_id" class="form-label">Category:</label>
                        <select name="category_id" id="category_id" class="form-select">
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Action Buttons --}}
                    <div class="d-flex justify-content-between">
                        <button type="submit" class="btn btn-success">Create</button>
                        <a href="{{ route('contents.index') }}" class="btn btn-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
