<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class guruController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $user = Auth::user()->id;
        $guru = Guru::latest()->paginate(5);
        return view('admin.pages.data_guru', compact('user', 'guru'));
    }

    public function searching(Request $request)
    {
        // fitur search
        $query = Guru::orderBy('created_at', 'desc');

        if (request()->has('search')) {
            # code...
            $search = $request->get('search');
            $query->where('name', 'like', '%' . request()->get('search') . '%');
        }

        $guru = $query->paginate(5);
        return view('admin.pages.data_guru', compact('guru'));
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
            'NIP' => 'required|integer|unique:gurus',
            'name' => 'required|string|max:100',
            'email' => 'required|string|email|max:255',
            'address' => 'required|string|max:255',
            'gender' => 'required|in:male,female',
            'phone' => 'required|string|max:20'
        ]);

        if ($validator->fails()) {
            return redirect()->route('data-guru.index')
                ->withErrors($validator)
                ->withInput();
        }

        $guru = Guru::create([
            'user_id' => null,
            'NIP' => $request->NIP,
            'name' => $request->name,
            'email' => $request->email,
            'address' => $request->address,
            'gender' => $request->gender,
            'phone' => $request->phone,
        ]);

        if ($guru) {
            return redirect()->route('data-guru.index')
                ->with('success', 'Data guru berhasil ditambahkan.');
        } else {
            return redirect()->route('data-guru.index')
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
        $guru = Guru::find($id);
        return response()->json($guru);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $request->validate([
            'NIP' => 'required|numeric',
            'name' => 'required|string|max:100',
            'email' => 'required|string|email|max:255',
            'address' => 'required|string|max:255',
            'gender' => 'required|string|in:male,female',
            'phone' => 'nullable|string|max:20',
        ]);
    
        $guru = Guru::find($id);
        $guru->NIP = $request->NIP;
        $guru->name = $request->name;
        $guru->email = $request->email;
        $guru->address = $request->address;
        $guru->gender = $request->gender;
        $guru->phone = $request->phone;
        $guru->save();
    
        return response()->json(['success' => 'Data guru berhasil diperbarui']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $guru = Guru::find($id);
        $user = Auth::user();

        if (!$guru) {
            return response()->json(['error' => 'Data guru tidak ditemukan.'], 404);
        }

        if ($guru->id_user == $user->id) {
            return response()->json(['error' => 'Anda tidak bisa menghapus data anda sendiri!'], 403);
        }

        $guru->delete();
        return response()->json(['success' => 'Data guru berhasil dihapus.']);
    }
}
