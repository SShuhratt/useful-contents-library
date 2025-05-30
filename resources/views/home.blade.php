@extends('layout')

@section('title', 'Home')

@section('content')
    <div class="container py-5">
        @foreach($categories as $category)
            <h2 class="mb-3">{{ $category->name }}</h2>

            {{-- Content Slider for Each Category --}}
            <div id="carousel{{ $category->id }}" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    @foreach($categoryContents[$category->id] as $index => $content)
                        <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $content->title }}</h5>
                                    <p class="card-text">{{ Str::limit($content->description, 100) }}</p>
                                    <a href="{{ route('contents.show', $content->id) }}" class="btn btn-primary">Open</a>

                                    <x-like-button :content="$content" />
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- Slider Controls --}}
                <button class="carousel-control-prev" type="button" data-bs-target="#carousel{{ $category->id }}" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon"></span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carousel{{ $category->id }}" data-bs-slide="next">
                    <span class="carousel-control-next-icon"></span>
                </button>
            </div>

            {{-- "More Contents" Link --}}
            <div class="text-end mt-3">
                <a href="{{ route('categories.show', $category->id) }}" class="btn btn-secondary">More Contents</a>
            </div>

            <hr>
        @endforeach
    </div>
@endsection
