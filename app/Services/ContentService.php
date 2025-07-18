<?php

namespace App\Services;

use App\Models\Content;
use App\Models\Category;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class ContentService
{
    public function getContents(?string $search = null)
    {
        $query = Content::query()
            ->with(['likes'])
            ->withCount(['likes'])
            ->latest();

        if ($search) {
            $query->where('title', 'like', '%' . $search . '%');
        }

        return $query->paginate(9);
    }


    public function createContent(array $data, bool $useFakeData = false): Content
    {
        if ($useFakeData) {
            return Content::create([
                'title'       => ucfirst(fake()->words(rand(3, 7), true)),
                'description' => fake()->realText(100),
                'url'         => fake()->url,
                'category_id' => Category::inRandomOrder()->value('id'),
            ]);
        }

        return Content::create($data);
    }

    public function updateContent(Content $content, array $data): bool
    {
        return $content->update($data);
    }

    public function deleteContent(Content $content): bool
    {
        return $content->delete();
    }
}
