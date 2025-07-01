<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin');
    }

    function admin()
    {
        return view('admin');
    }

    function kasir()
    {
        return view('admin.kasir');
    }

    public function laporan()
    {
    $transaksis = \App\Models\Transaksi::with('details.produk')->orderBy('tanggal', 'desc')->get();
    return view('admin.laporan', compact('transaksis'));
    }


    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
