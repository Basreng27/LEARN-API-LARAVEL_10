<?php

namespace App\Http\Controllers;

use App\Http\Resources\AccountResource;
use App\Http\Resources\GenreResource;
use App\Models\Genre;
use Illuminate\Http\Request;

class GenreController extends Controller
{
    public function index()
    {
        $genres = Genre::all();

        return GenreResource::collection($genres);
    }

    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required',
            'name' => 'required',
        ]);

        $genre = Genre::create([
            'code' => $request->code,
            'name' => $request->name,
        ]);

        return new GenreResource($genre);
    }

    public function show($id)
    {
        $genre = Genre::find($id);

        return new GenreResource($genre);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'code' => 'required',
            'name' => 'required',
        ]);

        $genre = Genre::find($id);
        $genre->update([
            'code' => $request->code,
            'name' => $request->name,
        ]);

        return new GenreResource($genre);
    }

    public function destroy($id)
    {
        $genre = Genre::find($id);
        $genre->delete();

        return response()->json(['message' => 'Deleted Data  Witth Code = ' . $genre->code]);
    }
}
