<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Mapel;
use App\Models\Nilai;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class adminController extends Controller
{
    public function index()
    {
        $user = Auth::user()->id;
        $guru = Guru::where('id_user', $user)->first();

        $jmlMapel = Mapel::count();
        $jmlGuru = Guru::count();
        $jmlSiswa = Siswa::count();
        return view('admin.pages.dashboard', compact('guru', 'jmlSiswa', 'jmlGuru', 'jmlMapel'));
    }
}
