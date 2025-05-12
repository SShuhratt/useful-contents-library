<?php

namespace App\Services;

use App\Models\Author;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class AuthorService
{
    public function getAuthors(?string $search = null): LengthAwarePaginator
    {
        $query = Author::query();

        if ($search) {
            $query->where('name', 'like', '%' . $search . '%');
        }

        return $query->latest()->paginate(10);
    }

    public function createAuthor(array $data): Author
    {
        return Author::create($data);
    }

    public function updateAuthor(Author $author, array $data): bool
    {
        return $author->update($data);
    }

    public function deleteAuthor(Author $author): bool
    {
        return $author->delete();
    }
}
