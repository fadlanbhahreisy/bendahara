<?php

namespace App\Http\Controllers\autentikasi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AutentikasiController extends Controller
{
    public function indexlogin()
    {
        return view('autentikasi.login');
    }
    public function login(Request $request)
    {
        // $data = User::where('email', $request->email)->firstOrFail();
        // if ($data) {
        //     if (Hash::check($request->password, $data->password)) {
        //         session(['login' => $data]);
        //         //dd(session('login')->name);
        //         return redirect('/dashboard');
        //     }
        // }
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect('/dashboard');
        }
        return redirect('/')->with('message', 'email atau password salah');
    }
    public function logout(Request $request)
    {
        //$request->session()->flush();
        Auth::logout();
        return redirect('/');
    }
}
