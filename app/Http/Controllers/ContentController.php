<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContentRequest;
use App\Models\Author;
use App\Models\Category;
use App\Models\Genre;
use App\Models\Content;
use Illuminate\Http\Request;
use App\Services\ContentService;

class ContentController extends Controller
{
    protected ContentService $contentService;

    public function __construct(ContentService $contentService)
    {
        $this->contentService = $contentService;
    }

    public function index(Request $request)
    {
        $contents = $this->contentService->getContents($request->search);
        return view('contents.index', compact('contents'));
    }

    public function create()
    {
        $categories = Category::all();
        $authors = Author::all();
        $genres = Genre::all();

        return view('contents.create', compact('categories', 'authors', 'genres'));
    }

    public function store(ContentRequest $request)
    {
        $useFakeData = env('USE_FAKE_DATA', false);
        $this->contentService->createContent($request->validated(), $useFakeData);

        if ($useFakeData) {
            return response()->json(['status' => 'fake data created']);
        }

        return redirect()->route('contents.index')->with('success', 'Content created successfully!');
    }

    public function show(Content $content)
    {
        $content->load('authors', 'genres');
        return view('contents.show', ['content' => $content]);
    }

    public function edit(Content $content)
    {
        $categories = Category::all();
        $authors = Author::all();
        $genres = Genre::all();
        return view('contents.edit', compact('content', 'categories', 'authors', 'genres'));
    }

    public function update(ContentRequest $request, Content $content)
    {
        $this->contentService->updateContent($content, $request->validated());
        return redirect()->route('contents.index')->with('success', 'Content updated successfully');
    }

    public function destroy(Content $content)
    {
        $this->contentService->deleteContent($content);
        return redirect()->route('contents.index')->with('success', 'Content deleted successfully');
    }
}
