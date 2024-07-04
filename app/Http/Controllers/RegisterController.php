<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Siswa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        if(Siswa::where('NIS', $request->username)->first()) {
            $validator = Validator::make($request->all(), [
                'username' => 'required|string|min:3|max:15',
                'password' => 'required|string|min:3|max:8|confirmed',
                // 'role' => 'required|in:admin,siswa'
            ]);
    
            if ($validator->fails()) {
                return redirect()->route('register')
                    ->withErrors($validator)
                    ->withInput();
            }
            
            $user = User::create([
                'username' => $request->username,
                'password' => Hash::make($request->password),
            ]);
    
            $user->assignRole('siswa');
    
            if ($user->hasRole('siswa')) {
                Siswa::where('NIS', $request->username)
                    ->update(['user_id' => $user->id]);
            }
    
            if ($user) {
                return redirect()->route('login')
                    ->with('success', 'Berhasil Membuat Akun, Ayo Login!');
            } else {
                return redirect()->route('register')
                    ->with('error', 'Failed to create user');
            }
            // return redirect()->route('login');
        } else {
            return redirect()->route('register')
                ->with('error', 'NIS anda tidak ada'); 
        }
    
        // return redirect()->route('login');
    }
}
