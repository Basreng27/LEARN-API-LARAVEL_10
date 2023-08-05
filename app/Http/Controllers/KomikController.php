<?php

namespace App\Http\Controllers;

use App\Models\Komik;
use Illuminate\Http\Request;

class KomikController extends Controller
{
    public function index()
    {
        $komik = Komik::all();

        return response()->json($komik);
    }
}
