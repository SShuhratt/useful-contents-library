{{-- resources/views/home2.blade.php --}}
@extends('layouts.app')

@section('content')
    @include('components.header2')

    <div class="container mx-auto px-4 py-6">

        {{-- Upcoming Event Carousel --}}
        <div
            x-data="{
                active: 0,
                slides: [
                    'Upcoming Event: Book Launch by Author A',
                    'Book Signing Event with Author B',
                    'Live Q&A Session by Author C'
                ],
                next() { this.active = (this.active + 1) % this.slides.length },
                prev() { this.active = (this.active - 1 + this.slides.length) % this.slides.length }
            }"
            class="bg-gray-100 p-6 rounded-lg shadow mb-8 text-center relative overflow-hidden"
        >
            <h2
                class="text-xl font-semibold mb-2"
                x-text="slides[active]"
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 translate-y-2"
                x-transition:enter-end="opacity-100 translate-y-0"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100 translate-y-0"
                x-transition:leave-end="opacity-0 translate-y-2"
            ></h2>

            <button class="bg-white border border-gray-400 px-4 py-2 rounded">Set Reminder</button>

            <button @click="prev"
                    class="absolute left-2 top-1/2 transform -translate-y-1/2 px-3 py-1 bg-white border rounded-full">‹
            </button>
            <button @click="next"
                    class="absolute right-2 top-1/2 transform -translate-y-1/2 px-3 py-1 bg-white border rounded-full">›
            </button>
        </div>

        {{-- Videos Section --}}
        <section class="mb-10">
            <h3 class="text-2xl font-bold mb-4">Videos</h3>
            <div class="flex gap-2 mb-4">
                <select class="border rounded p-2">
                    <option>Category</option>
                </select>
                <select class="border rounded p-2">
                    <option>Tags</option>
                </select>
                <select class="border rounded p-2">
                    <option>Date</option>
                </select>
                <select class="border rounded p-2">
                    <option>Sort by</option>
                    <option>Newest</option>
                </select>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4">
                @for ($i = 0; $i < 4; $i++)
                    <div class="bg-gray-100 p-4 rounded shadow">
                        <div class="h-32 bg-gray-300 rounded mb-2"></div>
                        <div class="h-4 bg-gray-400 rounded w-3/4 mb-1"></div>
                        <div class="h-4 bg-gray-400 rounded w-1/2 mb-2"></div>
                        <div class="text-right text-gray-500">&#9825;</div>
                    </div>
                @endfor
            </div>
        </section>

        {{-- Podcasts Section --}}
        <section class="mb-10">
            <h3 class="text-2xl font-bold mb-4">Podcasts</h3>
            <div x-data="{ activeVideo: null }" class="bg-gray-100 p-6 rounded-lg shadow mb-8">
                <h2 class="text-xl font-semibold mb-4 text-center">🎧 Latest Podcast</h2>

                <div class="bg-white rounded shadow p-4 text-center max-w-md mx-auto">
                    <img
                        src="https://img.youtube.com/vi/KFZjl1gofXs/0.jpg"
                        alt="Kubernetes Podcast"
                        class="w-full cursor-pointer rounded mb-2"
                        @click="activeVideo = 'https://www.youtube.com/embed/KFZjl1gofXs'"
                    >
                    <h3 class="font-semibold">Kubernetes Podcast</h3>
                </div>

                {{-- Embedded Video Player --}}
                <div
                    x-show="activeVideo"
                    x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 scale-90"
                    x-transition:enter-end="opacity-100 scale-100"
                    x-transition:leave="transition ease-in duration-200"
                    x-transition:leave-start="opacity-100 scale-100"
                    x-transition:leave-end="opacity-0 scale-90"
                    class="mt-6 text-center"
                >
                    <iframe
                        x-bind:src="activeVideo"
                        class="w-full md:w-3/4 h-64 mx-auto rounded"
                        frameborder="0"
                        allow="autoplay; encrypted-media"
                        allowfullscreen
                    ></iframe>
                    <button
                        @click="activeVideo = null"
                        class="mt-4 px-4 py-2 bg-red-500 text-white rounded"
                    >Close Player
                    </button>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4">
                @for ($i = 0; $i < 4; $i++)
                    <div class="bg-gray-100 p-4 rounded shadow">
                        <div class="h-32 bg-gray-300 rounded mb-2"></div>
                        <div class="h-4 bg-gray-400 rounded w-3/4 mb-1"></div>
                        <div class="h-4 bg-gray-400 rounded w-1/2 mb-2"></div>
                        <div class="text-right text-gray-500">&#9825;</div>
                    </div>
                @endfor
            </div>
        </section>

        {{-- Books Section --}}
        <section class="mb-10">
            <h3 class="text-2xl font-bold mb-4">Books</h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4">
                @for ($i = 0; $i < 4; $i++)
                    <div class="bg-gray-100 p-4 rounded shadow">
                        <div class="h-4 bg-gray-400 rounded w-3/4 mb-1"></div>
                        <div class="h-4 bg-gray-400 rounded w-1/2 mb-4"></div>
                        <button class="bg-white border border-gray-400 px-4 py-2 rounded">View</button>
                    </div>
                @endfor
            </div>
        </section>

    </div>

    @include('components.footer')
@endsection
