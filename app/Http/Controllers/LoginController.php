<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    function index()
    {
        echo view('login');
    }

   public function login(Request $request)
{
    $credentials = $request->only('email', 'password');

    if (Auth::attempt($credentials)) {
        $user = Auth::user();

        if ($user->role === 'admin') {
            return redirect('/admin/admin');
        } elseif ($user->role === 'kasir') {
            return redirect('/admin/kasir');
        } else {
            Auth::logout();
            return redirect('/')->withErrors(['error' => 'Role tidak dikenal.']);
        }
    }

    return back()->withErrors([
        'email' => 'Email atau password salah!',
    ]);
}

}
