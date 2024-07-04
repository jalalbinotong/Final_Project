<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Mapel;
use Illuminate\Http\Request;

class MapelController extends Controller
{
    public function index()
    {
        $mapels = Mapel::all();
        $guru = Guru::all();

        return view('siswa.pages.mapel', compact('mapels', 'guru'));
    }

    public function show($id)
    {
        $mapel = Mapel::with('guru')->findOrFail($id);

        return response()->json([
            'mapel' => $mapel,
            'guru' => $mapel->guru
        ]);
    }
}
