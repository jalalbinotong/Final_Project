<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccountSettingsController extends Controller
{
    public function index()
    {
        $user = Auth::user()->id;
        $siswa = Siswa::where('user_id', $user)->first();
        return view('siswa.pages.account-settings', compact('siswa'));
    }

    public function update(Request $request)
    {
        $user = Auth::user()->id;
        $siswa = Siswa::where('user_id', $user)->first();

        $request->validate([
            'email' => 'required|string|email',
            'phone' => 'nullable|string|max:15',
            'pas_foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2000',
        ]);

        $siswa->email = $request->email;
        $siswa->phone = $request->phone;
        if ($request->hasFile('pas_foto')) {
            if ($siswa->pas_foto) {
                // Hapus gambar lama
                $imagePath = public_path($siswa->pas_foto);
                if (file_exists($imagePath))
                    unlink($imagePath);
            }
            // Upload gambar baru
            $file = $request->file('pas_foto');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move('storage/images', $fileName);
            $siswa->pas_foto = '/storage/images/' . $fileName;
        }
        $siswa->save();

        if ($siswa) {
            return redirect()->route('account.settings')->with('success', 'Profil berhasil diperbarui.');
        } else {
            return redirect()->route('account.settings')->with('error', 'Profil gagal diperbarui.');
        }
    }
}
