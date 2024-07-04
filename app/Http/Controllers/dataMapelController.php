<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Mapel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class dataMapelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $user = Auth::user()->id;
        $mapel = Mapel::latest()->paginate(5);
        $guru = Guru::all();
        return view('admin.pages.data_mapel', compact('user', 'mapel', 'guru'));
    }

    public function searching(Request $request)
    {
        // fitur search
        $guru = Guru::all();
        $query = Mapel::orderBy('created_at', 'desc');

        if (request()->has('search')) {
            # code...
            $search = $request->get('search');
            $query->where('name', 'like', '%' . request()->get('search') . '%');
        }

        $mapel = $query->paginate(5);
        return view('admin.pages.data_mapel', compact('mapel', 'guru'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'guru_id' => 'required|exists:gurus,id',
            'name' => 'required|string|max:100',
            'desc' => 'required|string|min:3|max:2000',
            'image' => 'nullable|file|image|mimes:jpeg,png,jpg|max:2000',
        ]);

        $file = $request->file('image');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $file->move('storage/images', $fileName);

        Mapel::create([
            'guru_id' => $request->guru_id,
            'name' => $request->name,
            'desc' => $request->desc,
            'image' => '/storage/images/' . $fileName
        ]);

        return response()->json(['success' => 'Data mapel berhasil ditambahkan']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $mapel = Mapel::find($id);
        return response()->json($mapel);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $request->validate([
            'guru_id' => 'required|exists:gurus,id',
            'name' => 'required|string|max:100',
            'desc' => 'required|string|min:3|max:2000',
            'image' => 'nullable|image|file|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $mapel = Mapel::find($id);
        $mapel->guru_id = $request->guru_id;
        $mapel->name = $request->name;
        $mapel->desc = $request->desc;
        if ($request->hasFile('image')) {
            // Hapus gambar lama
            $imagePath = public_path($mapel->image);
            if (file_exists($imagePath))
                unlink($imagePath);
    
            // Upload gambar baru
            $file = $request->file('image');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move('storage/images', $fileName);
            $mapel->image = '/storage/images/' . $fileName;
        }
        $mapel->save();
    
        return response()->json(['success' => 'Data mapel berhasil diperbarui']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $mapel = Mapel::find($id);
        $mapel->delete();
        if ($mapel) {
            $imagePath = public_path($mapel->image);
            if (file_exists($imagePath))
                unlink($imagePath);
            
            return response()->json(['success' => 'Data mapel berhasil dihapus']);
        }
        return response()->json(['error' => 'Data mapel tidak ditemukan'], 404);
    }
}
