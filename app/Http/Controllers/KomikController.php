<?php

namespace App\Http\Controllers;

use App\Http\Resources\KomikDetailResource;
use App\Http\Resources\KomikResource;
use App\Models\Komik;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class KomikController extends Controller
{
    public function index()
    {
        $comics = Komik::all();

        // return response()->json(['data' => $comics]);
        return KomikResource::collection($comics); // Kalau return lebih dari 1
    }

    public function show($id)
    {
        $comic = Komik::with(['genre:id,code,name', 'status'])->find($id); // Untuk genre itu data yang hanya ingin di ambil dan status semua data yang ada pada tabel itu

        return new KomikDetailResource($comic); // Kalau return hanya 1
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'last_episode' => 'required|numeric',
            'id_genre' => 'required|numeric',
            'id_status' => 'required|numeric',
        ]);

        $pictureName = null;
        if ($request->picture) {
            $pictureName = $this->generateRandomString();
            $extension = $request->picture->extension();

            Storage::putFileAs('picture', $request->picture, $pictureName . '.' . $extension); // ('nama folder yang akan jadi tujuan simpan', 'filenya', 'nama file')
        }

        $komik = Komik::create([
            'name' => $request->name,
            'slug' => str_replace(' ', '-', strtolower($request->name)),
            'picture' => $pictureName ? $pictureName . '.' . $extension : null,
            'last_episode' => $request->last_episode,
            'id_status' => $request->id_status,
            'id_genre' => $request->id_genre,
        ]);

        return new KomikDetailResource($komik->loadMissing(['genre:id,code,name', 'status'])); // loadMissing di gunakan untuk mengambil data terakhir atau 1 data
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'last_episode' => 'required|numeric',
            'id_genre' => 'required|numeric',
            'id_status' => 'required|numeric',
        ]);

        $komik = Komik::find($id);

        $komik->update([
            'name' => $request->name,
            'slug' => str_replace(' ', '-', strtolower($request->name)),
            'picture' => $request->picture,
            'last_episode' => $request->last_episode,
            'id_status' => $request->id_status,
            'id_genre' => $request->id_genre,
        ]);

        return new KomikDetailResource($komik->loadMissing(['genre:id,code,name', 'status'])); // loadMissing di gunakan untuk mengambil data terakhir atau 1 data
    }

    public function destroy($id)
    {
        $komik = Komik::find($id);
        $komik->delete();

        return response()->json(['message' => 'Deleted Data']);
    }

    function generateRandomString($length = 30)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';

        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[random_int(0, $charactersLength - 1)];
        }

        return $randomString;
    }
}
