<?php

namespace App\Http\Controllers;

use App\Http\Resources\KomikDetailResource;
use App\Http\Resources\KomikResource;
use App\Models\Komik;
use Illuminate\Http\Request;

class KomikController extends Controller
{
    public function index()
    {
        $comics = Komik::all();

        // return response()->json(['data' => $comics]);
        return KomikResource::collection($comics); // Kalau return lebih dari 1
    }

    public function detail($id)
    {
        $comic = Komik::with(['genre:id,code,name', 'status'])->find($id); // Untuk genre itu data yang hanya ingin di ambil dan status semua data yang ada pada tabel itu

        return new KomikDetailResource($comic); // Kalau return hanya 1
    }
}
