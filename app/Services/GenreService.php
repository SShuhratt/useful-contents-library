<?php

namespace App\Services;

use App\Models\Genre;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class GenreService
{
    public function getGenres(?string $search = null): LengthAwarePaginator
    {
        $query = Genre::query();

        if ($search) {
            $query->where('name', 'like', '%' . $search . '%');
        }

        return $query->latest()->paginate(10);
    }

    public function createGenre(array $data): Genre
    {
        return Genre::create($data);
    }

    public function updateGenre(Genre $genre, array $data): bool
    {
        return $genre->update($data);
    }

    public function deleteGenre(Genre $genre): bool
    {
        return $genre->delete();
    }
}
