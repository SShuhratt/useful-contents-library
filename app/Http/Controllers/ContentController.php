<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContentRequest;
use App\Models\Author;
use App\Models\Category;
use App\Models\Genre;
use App\Models\Content;
use Illuminate\Http\Request;
use Faker\Factory as Faker;

class ContentController extends Controller
{
    public function index(Request $request)
    {
        $query = Content::query();

        if ($request->has('search')) {
            $query->where('title', 'like', '%' . $request->search . '%')
                ->orWhere('description', 'like', '%' . $request->search . '%');
        }

        $contents = $query->latest()->paginate(10);

        return view('contents.index', compact('contents'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        $authors = Author::all();
        $genres = Genre::all();

        return view('contents.create', compact('categories', 'authors', 'genres'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(ContentRequest $request)
    {
        $useFakeData = env('USE_FAKE_DATA', false); // Add USE_FAKE_DATA=true in .env for testing

        $content = Content::query()->create([
            'title'       => $useFakeData ? ucfirst(fake()->words(rand(3, 7), true)) : ucfirst($request->input('title')),
            'description' => $useFakeData ? fake()->realText(100) : $request->input('description'),
            'url'         => $useFakeData ? fake()->url : $request->input('url'),
            'category_id' => $useFakeData
                ? Category::query()->inRandomOrder()->value('id')
                : $request->input('category_id'),
        ]);

        return $useFakeData ? $content : redirect()->route('contents.index')->with('success', 'Content created successfully!');
    }

    public function show(Content $content)
    {
        $content->load('authors', 'genres');
        return view('contents.show', ['content' => $content]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Content $content)
    {
        return view('contents.edit', compact('content'));
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(ContentRequest $request, Content $content)
    {
        $content->update($request->validated());
        return redirect()->route('contents.index')->with('success', 'Content updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Content $content)
    {
        $content->delete();
        return redirect()->route('contents.index')->with('success', 'Content deleted successfully');
    }
}
