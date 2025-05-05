<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use Illuminate\Http\Request;

class GenreController extends Controller
{
    public function index(Request $request)
    {
        $query = Genre::query();

        if ($request->has('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $genres = $query->latest()->paginate(10);

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

        Genre::create($validated);

        return redirect()->route('genres.index')->with('success', 'Genre added successfully');
    }

    public function show(Genre $genre) // Using Route Model Binding
    {
        $genre->load('contents');
        return view('genres.show', compact('genre'));
    }

    public function edit(Genre $genre) // Fix: Genre model instead of ID
    {
        return view('genres.edit', compact('genre'));
    }

    public function update(Request $request, Genre $genre) // Fix: Passing Genre model
    {
        $validated = $request->validate([
            'name' => 'required|unique:genres|max:255',
        ]);

        $genre->update($validated);

        return redirect()->route('genres.index')->with('success', 'Genre updated successfully');
    }

    public function destroy(Genre $genre) // Fix: Pass model instead of ID
    {
        $genre->delete();

        return redirect()->route('genres.index')->with('success', 'Genre deleted successfully');
    }
}
