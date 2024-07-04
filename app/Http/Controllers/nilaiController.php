<?php

namespace App\Http\Controllers;

use App\Models\Angkatan;
use App\Models\Guru;
use App\Models\Mapel;
use App\Models\Nilai;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class nilaiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $user = Auth::user()->id;
        $nilai = Nilai::latest()->paginate(5);
        $angkatan = Angkatan::all();
        $siswa = Siswa::all();
        $mapel = Mapel::all();
        return view('admin.pages.data_nilai', compact('nilai', 'angkatan', 'siswa', 'mapel'));
    }

    public function searching(Request $request)
    {
        // fitur search
        $angkatan = Angkatan::all();
        $mapel = Mapel::all();
        $siswa = Siswa::all();
        $query = Nilai::with(['siswa', 'mapel', 'angkatan'])->orderBy('created_at', 'desc');

        if (request()->has('search')) {
            # code...
            $search = $request->get('search');
            $query->whereHas('siswa', function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%');
            });
        }

        $nilai = $query->get();

        return view('admin.pages.data_nilai', compact('nilai', 'angkatan', 'mapel', 'siswa', 'search'));
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
            'mapel_id' => 'required|exists:mapels,id',
            'siswa_id' => 'required|exists:siswas,id',
            'angkatan_id' => 'required|exists:angkatans,id',
            'tugas1' => 'required|numeric',
            'tugas2' => 'required|numeric',
            'tugas3' => 'required|numeric',
            'ujian' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return redirect()->route('data-nilai.index')
                ->withErrors($validator)
                ->withInput();
        }

        Nilai::create([
            'mapel_id' => $request->mapel_id,
            'siswa_id' => $request->siswa_id,
            'angkatan_id' => $request->angkatan_id,
            'tugas1' => $request->tugas1,
            'tugas2' => $request->tugas2,
            'tugas3' => $request->tugas3,
            'ujian' => $request->ujian,
        ]);

        return response()->json(['success' => 'Data nilai berhasil ditambahkan']);
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
        $nilai = Nilai::find($id);
        return response()->json($nilai);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $request->validate([
            'siswa_id' => 'required|exists:siswas,id',
            'mapel_id' => 'required|exists:mapels,id',
            'angkatan_id' => 'required|exists:angkatans,id',
            'tugas1' => 'required|numeric',
            'tugas2' => 'required|numeric',
            'tugas3' => 'required|numeric',
            'ujian' => 'required|numeric',
        ]);
    
        $nilai = Nilai::find($id);
        $nilai->siswa_id = $request->siswa_id;
        $nilai->mapel_id = $request->mapel_id;
        $nilai->angkatan_id = $request->angkatan_id;
        $nilai->tugas1 = $request->tugas1;
        $nilai->tugas2 = $request->tugas2;
        $nilai->tugas3 = $request->tugas3;
        $nilai->ujian = $request->ujian;
        $nilai->save();
    
        return response()->json(['success' => 'Data nilai berhasil diperbarui']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $nilai = Nilai::find($id);

        if ($nilai) {
            $nilai->delete();
            return response()->json(['success' => 'Data nilai berhasil dihapus.']);
        } else {
            return response()->json(['error' => 'Data nilai tidak ditemukan.'], 404);
        }
    }
}
