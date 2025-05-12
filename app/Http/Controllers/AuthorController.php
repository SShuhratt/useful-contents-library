<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;
use App\Services\AuthorService;

class AuthorController extends Controller
{
    protected AuthorService $authorService;

    public function __construct(AuthorService $authorService)
    {
        $this->authorService = $authorService;
    }

    public function index(Request $request)
    {
        $authors = $this->authorService->getAuthors($request->search);
        return view('authors.index', compact('authors'));
    }

    public function create()
    {
        return view('authors.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'url'  => ['nullable', 'url'],
        ]);

        $this->authorService->createAuthor($validated);
        return redirect()->route('authors.index');
    }

    public function show(Author $author)
    {
        return view('authors.show', compact('author'));
    }

    public function edit(Author $author)
    {
        return view('authors.edit', compact('author'));
    }

    public function update(Request $request, Author $author)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'url' => 'nullable|url',
        ]);

        $this->authorService->updateAuthor($author, $validated);
        return redirect()->route('authors.index')->with('success', 'Author updated successfully.');
    }

    public function destroy(Author $author)
    {
        $this->authorService->deleteAuthor($author);
        return redirect()->route('authors.index')->with('success','Author deleted successfully');
    }
}
