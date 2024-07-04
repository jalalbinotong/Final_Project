<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    /**
     * Menampilkan formulir login.
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Memproses login pengguna.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|string|min:3|max:15',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->route('login')
                ->withErrors($validator)
                ->withInput();
        }

        if (Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
            $request->session()->regenerate();
            $user = User::where('id', Auth::user()->id)->first();
            // $user = User::find(Auth::user()->id);
            // if ($user->hasRole('superadmin')){
            //     return redirect()->route('admin_table');
            // } else {
            //     return redirect()->route('product');
            // }
            // $user = Auth::user()->id;
            // $user_id = User::where('id', $user)->first();

            if ($user->hasRole('admin')) {
                return redirect()->route('admin');
                // return view('admin.pages.dashboard', ['user' => $user]);
            } else {
                return redirect('/');
                // return view('account-settings', ['user' => $user]);
            }
            // return redirect()->route('data-siswa.index');
        } else {
            return redirect()->route('login')
                ->with('error', 'Login failed email or password is incorrect');
        }
        // $credentials = $this->validateLogin($request);

        // if (Auth::once($credentials)) {
        //     $request->session()->regenerate();
        //     return redirect()->intended('/');
        // }

        // return back()->withErrors([
        //     'email' => __('validation.invalid_credentials'),
        // ]);
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->route('login');
    }

    // /**
    //  * Validasi data login.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @return array
    //  */
    // protected function validateLogin(Request $request)
    // {
    //     return $request->validate([
    //         'email' => ['required', 'email'],
    //         'password' => ['required'],
    //     ]);
    // }
}
