<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Content;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $categoryContents = [];

        // Retrieve 5 contents for each category
        foreach ($categories as $category) {
            $categoryContents[$category->id] = Content::where('category_id', $category->id)
                ->latest()
                ->take(5)
                ->get();
        }

        return view('home', compact('categories', 'categoryContents'));
    }
}
