<?php

namespace App\Http\Controllers;

use App\Models\Angkatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class angkatanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $user = Auth::user()->id;
        $angkatan = Angkatan::paginate(5);
        return view('admin.pages.data_angkatan', compact('user', 'angkatan'));
    }

    public function searching(Request $request)
    {
        // fitur search
        $query = Angkatan::orderBy('created_at', 'desc');

        if (request()->has('search')) {
            # code...
            $search = $request->get('search');
            $query->where('class', 'like', '%' . request()->get('search') . '%');
        }

        $angkatan = $query->paginate(5);
        return view('admin.pages.data_angkatan', compact('angkatan'));
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
        $validator = Validator::make($request->all(), [
            'class' => 'required|in:1,2,3',
            'semester' => 'required|string|max:20'
        ]);

        if ($validator->fails()) {
            return redirect()->route('data-angkatan.index')
                ->withErrors($validator)
                ->withInput();
        }

        Angkatan::create([
            'class' => $request->class,
            'semester' => $request->semester,
        ]);

        return response()->json(['success' => 'Data angkatan berhasil ditambahkan']);
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
        $angkatan = Angkatan::find($id);
        return response()->json($angkatan);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $request->validate([
            'class' => 'required|string|in:1,2,3',
            'semester' => 'nullable|string|max:20',
        ]);
    
        $angkatan = Angkatan::find($id);
        $angkatan->class = $request->class;
        $angkatan->semester = $request->semester;
        $angkatan->save();
    
        return response()->json(['success' => 'Data angkatan berhasil diperbarui']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $angkatan = Angkatan::find($id);

        if ($angkatan) {
            $angkatan->delete();
            return response()->json(['success' => 'Data angkatan berhasil dihapus.']);
        } else {
            return response()->json(['error' => 'Data angkatan tidak ditemukan.'], 404);
        }
    }
}
