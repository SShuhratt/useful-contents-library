<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use Illuminate\Http\Request;

class GenreController extends Controller
{
    public function index()
    {
        $genres = Genre::all();
        return view('genres', ['genres' => $genres]);
    }
    public function create(){

    }
    public function store(Request $request){
        $genre = new Genre;
    }
    public function show($id){
        $content = Content::find($id);
        $genres = Genre::all(); // Or fetch genres related to the content
        return view('content', ['content' => $content, 'genres' => $genres]);
    }
    public function edit($id){

    }
    public function update(Request $request, $id){

    }
    public function destroy($id){

    }

}
