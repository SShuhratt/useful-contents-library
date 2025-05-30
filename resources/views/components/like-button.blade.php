@props(['content'])

@php
    $user = auth()->user();
    $hasLiked = $user ? $content->likes->contains('user_id', $user->id) : false;
    $likesCount = $content->likes_count ?? $content->likes->count();
@endphp

@if($user)
    <form action="{{ route('contents.toggleLike', $content->id) }}" method="POST" style="display:inline;">
        @csrf
        <button type="submit" class="btn btn-sm {{ $hasLiked ? 'btn-danger' : 'btn-outline-primary' }}">
            {{ $hasLiked ? 'Unlike' : 'Like' }} ({{ $likesCount }})
        </button>
    </form>
@else
    <button
        type="button"
        class="btn btn-sm btn-outline-secondary like-btn-disabled"
        disabled
        title="You should login to like this content."
    >
        Like ({{ $likesCount }})
    </button>
@endif
