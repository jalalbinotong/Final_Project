<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class siswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $user = Auth::user()->id;
        $siswa = Siswa::latest()->paginate(5);
        return view('admin.pages.data_siswa', compact('user', 'siswa'));
    }

    public function searching(Request $request)
    {
        // fitur search
        $query = Siswa::orderBy('created_at', 'desc');

        if (request()->has('search')) {
            # code...
            $search = $request->get('search');
            $query->where('name', 'like', '%' . request()->get('search') . '%');
        }

        $siswa = $query->paginate(5);
        return view('admin.pages.data_siswa', compact('siswa'));
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
            'NIS' => 'required|integer|unique:siswas',
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:siswas',
            'address' => 'required|string|max:255',
            'gender' => 'required|in:male,female',
            'agama' => 'required|string|max:255',
            'phone' => 'required|string|max:255'
        ]);

        if ($validator->fails()) {
            return redirect()->route('data-siswa.index')
                ->withErrors($validator)
                ->withInput();
        }

        $siswa = Siswa::create([
            'user_id' => null,
            'NIS' => $request->NIS,
            'name' => $request->name,
            'email' => $request->email,
            'address' => $request->address,
            'gender' => $request->gender,
            'agama' => $request->agama,
            'phone' => $request->phone,
            'pas_foto' => null,
        ]);

        if ($siswa) {
            return redirect()->route('data-siswa.index')
                ->with('success', 'Data siswa berhasil ditambahkan.');
        } else {
            return redirect()->route('data-siswa.index')
                ->with('error', 'Failed to create user');
        }
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
        $siswa = Siswa::find($id);
        return response()->json($siswa);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'NIS' => 'required|numeric',
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'address' => 'required|string|max:255',
            'agama' => 'required|string|max:255',
            'gender' => 'required|string|in:male,female',
            'phone' => 'required|string|max:255',
        ]);
    
        $siswa = Siswa::find($id);
        $siswa->NIS = $request->NIS;
        $siswa->name = $request->name;
        $siswa->email = $request->email;
        $siswa->address = $request->address;
        $siswa->agama = $request->agama;
        $siswa->gender = $request->gender;
        $siswa->phone = $request->phone;
        $siswa->save();
    
        return response()->json(['success' => 'Data siswa berhasil diperbarui']);

        // Siswa::where('id', $request->id)
        //     ->update($validator);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $siswa = Siswa::find($id);

        if ($siswa) {
            $siswa->delete();
            return response()->json(['success' => 'Data siswa berhasil dihapus.']);
        } else {
            return response()->json(['error' => 'Data siswa tidak ditemukan.'], 404);
        }
    }
}
