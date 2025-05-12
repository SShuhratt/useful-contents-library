<?php

namespace App\Services;

use App\Models\Category;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class CategoryService
{
    public function getCategories(?string $search = null): LengthAwarePaginator
    {
        $query = Category::query();

        if ($search) {
            $query->where('name', 'like', '%' . $search . '%');
        }

        return $query->latest()->paginate(10);
    }

    public function createCategory(array $data): Category
    {
        return Category::create($data);
    }

    public function updateCategory(Category $category, array $data): bool
    {
        return $category->update($data);
    }

    public function deleteCategory(Category $category): bool
    {
        return $category->delete();
    }
}

