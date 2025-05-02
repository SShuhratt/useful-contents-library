<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContentRequest;
use App\Models\Content;
use Illuminate\Http\Request;

class ContentApiController extends Controller
{
    public function index()
    {
        return response()->json(Content::all());
    }

    public function store(ContentRequest $request)
    {
        $content = Content::create($request->validated());
        return response()->json($content, 201);
    }

    public function show(Content $content)
    {
        return response()->json($content->load('authors', 'genres'));
    }

    public function update(ContentRequest $request, Content $content)
    {
        $content->update($request->validated());
        return response()->json(['message' => 'Content updated successfully', 'content' => $content]);
    }

    public function destroy(Content $content)
    {
        $content->delete();
        return response()->json(['message' => 'Content deleted successfully']);
    }
}

