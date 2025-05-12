<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Services\CategoryService;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;

class CategoryController extends Controller
{
    protected CategoryService $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function index(Request $request)
    {
        $categories = $this->categoryService->getCategories($request->search);
        return view('categories.index', compact('categories'));
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(StoreCategoryRequest $request)
    {
        $category = $this->categoryService->createCategory($request->validated());

        return request()->expectsJson()
            ? response()->json(['message' => 'Category created successfully', 'category' => $category], 201)
            : redirect()->route('categories.index')->with('success', 'Category created successfully.');
    }

    public function show(Category $category)
    {
        return request()->expectsJson()
            ? response()->json($category)
            : view('categories.show', compact('category'));
    }

    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $this->categoryService->updateCategory($category, $request->validated());

        return request()->expectsJson()
            ? response()->json(['message' => 'Category updated successfully', 'category' => $category])
            : redirect()->route('categories.index')->with('success', 'Category updated successfully.');
    }

    public function destroy(Category $category)
    {
        $this->categoryService->deleteCategory($category);

        return request()->expectsJson()
            ? response()->json(['message' => 'Category deleted successfully'])
            : redirect()->route('categories.index')->with('success', 'Category deleted successfully.');
    }
}
