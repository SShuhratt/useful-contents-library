@extends('layout') {{-- Matches other views using layout.blade.php --}}

@section('title', 'Admin Dashboard')

@section('content')
    <div class="container mx-auto mt-6">
        <h1 class="text-center text-3xl font-bold">Admin Dashboard</h1>

        <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-3 gap-6 mt-6">
            {{-- Categories Section --}}
            <div class="p-6 bg-white shadow rounded-lg">
                <h2 class="text-lg font-semibold">Manage Categories</h2>
                <p class="text-sm text-gray-600">View, edit, or delete categories.</p>
                <a href="{{ route('categories.index') }}" class="btn btn-primary mt-3">Go to Categories</a>
            </div>

            {{-- Contents Section --}}
            <div class="p-6 bg-white shadow rounded-lg">
                <h2 class="text-lg font-semibold">Manage Contents</h2>
                <p class="text-sm text-gray-600">Create and edit content items.</p>
                <a href="{{ route('contents.index') }}" class="btn btn-primary mt-3">Go to Contents</a>
            </div>

            {{-- Authors Section --}}
            <div class="p-6 bg-white shadow rounded-lg">
                <h2 class="text-lg font-semibold">Manage Authors</h2>
                <p class="text-sm text-gray-600">Add or remove authors.</p>
                <a href="{{ route('authors.index') }}" class="btn btn-primary mt-3">Go to Authors</a>
            </div>

            {{-- Genres Section --}}
            <div class="p-6 bg-white shadow rounded-lg">
                <h2 class="text-lg font-semibold">Manage Genres</h2>
                <p class="text-sm text-gray-600">Update genre classifications.</p>
                <a href="{{ route('genres.index') }}" class="btn btn-primary mt-3">Go to Genres</a>
            </div>

            {{-- Manage Users --}}
            <div class="p-6 bg-white shadow rounded-lg">
                <h2 class="text-lg font-semibold">Manage Users</h2>
                <p class="text-sm text-gray-600">Promote, demote, and delete users (Admins cannot be deleted).</p>
                <a href="{{ route('admin.users.index') }}" class="btn btn-primary mt-3">Go to Users</a>
            </div>
        </div>
    </div>
@endsection
