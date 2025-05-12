<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use Illuminate\Http\Request;
use App\Services\GenreService;

class GenreController extends Controller
{
    protected GenreService $genreService;

    public function __construct(GenreService $genreService)
    {
        $this->genreService = $genreService;
    }

    public function index(Request $request)
    {
        $genres = $this->genreService->getGenres($request->search);
        return view('genres.index', compact('genres'));
    }

    public function create()
    {
        return view('genres.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|unique:genres|max:255',
        ]);

        $this->genreService->createGenre($validated);

        return redirect()->route('genres.index')->with('success', 'Genre added successfully');
    }

    public function show(Genre $genre)
    {
        $genre->load('contents');
        return view('genres.show', compact('genre'));
    }

    public function edit(Genre $genre)
    {
        return view('genres.edit', compact('genre'));
    }

    public function update(Request $request, Genre $genre)
    {
        $validated = $request->validate([
            'name' => 'required|unique:genres,name,' . $genre->id . '|max:255',
        ]);

        $this->genreService->updateGenre($genre, $validated);

        return redirect()->route('genres.index')->with('success', 'Genre updated successfully');
    }

    public function destroy(Genre $genre)
    {
        $this->genreService->deleteGenre($genre);
        return redirect()->route('genres.index')->with('success', 'Genre deleted successfully');
    }
}
