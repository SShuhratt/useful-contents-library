@extends('layout')

@section('title', $content->title)

@section('content')
    <div class="container py-5">
        <h1 class="mb-3">{{ $content->title }}</h1>

        <p class="text-muted mb-4">{{ $content->description }}</p>

        <div class="mb-4">
            <a href="{{ $content->url }}" class="btn btn-primary">Visit Book Website</a>
        </div>

        <div class="mb-3">
            <h5 class="mb-2">Author(s)</h5>
            @if($content->authors->isNotEmpty())
                @foreach($content->authors as $author)
                    <span class="badge bg-primary">{{ $author->name }}</span>
                @endforeach
            @else
                <p class="text-muted">No authors listed.</p>
            @endif
        </div>

        <div class="mb-3">
            <h5 class="mb-2">Category</h5>
            <span class="badge bg-secondary">{{ $content->category->name }}</span>
        </div>

        <div class="mb-3">
            <h5 class="mb-2">Genres</h5>
            @if($content->genres->isNotEmpty())
                @foreach($content->genres as $genre)
                    <span class="badge bg-success">{{ $genre->name }}</span>
                @endforeach
            @else
                <p class="text-muted">No genres listed.</p>
            @endif
        </div>

        <!-- 👍 Like/Unlike Section -->
        <div class="mb-4">
            @auth
                <form action="{{ route('contents.like', $content->id) }}" method="POST">
                    @csrf
                    <button type="submit"
                            class="btn {{ $content->likes->contains('user_id', auth()->id()) ? 'btn-danger' : 'btn-outline-danger' }}">
                        {{ $content->likes->contains('user_id', auth()->id()) ? 'Unlike' : 'Like' }}
                    </button>
                    <span class="ms-2 text-muted">{{ $content->likes->count() }} {{ Str::plural('Like', $content->likes->count()) }}</span>
                </form>
            @else
                <p class="text-muted">Log in to like this content.</p>
            @endauth
        </div>

        @if(auth()->check() && auth()->user()->isAdmin())
            <div class="mt-4">
                <a href="{{ route('contents.edit', $content->id) }}" class="btn btn-warning">Edit</a>
                <form action="{{ route('contents.destroy', $content->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this?')">
                        Delete
                    </button>
                </form>
            </div>
        @endif
    </div>
@endsection
