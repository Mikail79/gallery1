<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{

    public function loginIndex() {
        return view("Auth.login");
    }

    public function registerIndex() {
        return view("Auth.register");
    }

    public function register(Request $request) {
        $userRequest = $request->validate([
            'name'=>'required',
            'username'=>'required',
            'email'=>'required',
            'alamat'=>'required',
            'password'=>'required'
        ],[
            'name.required' => 'Nama harus diisi',
            'username.required' => 'Username harus diisi',
            'email.required'=>'Email harus diisi',
            'alamat.required' => 'Alamat harus diisi',
            'password.required'=>'Password harus diisi'
        ]);

        User::create([
            'name'=> $request->name,
            'username'=> $request->username,
            'alamat'=> $request->alamat,
            'email'=> $request->email,
            'password' => bcrypt($request->password)
        ]);
        return redirect()->route('login')->with('success','Berhasil Register');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Cek apakah pengguna diblokir
        $user = User::where('email', $request->email)->first();
        if ($user && $user->is_blocked) {
            // Arahkan pengguna ke tampilan blocked jika akunnya diblokir
            return view('auth.blocked');
        }

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect('/')->with('success', 'Login sukses');
        }

        throw ValidationException::withMessages([
            'email' => __('auth.failed'),
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/')->with('success','Berhasil Logout');
    }
}
