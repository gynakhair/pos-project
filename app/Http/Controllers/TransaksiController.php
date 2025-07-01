<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Transaksi;
use App\Models\TransaksiDetail;
use Carbon\Carbon;

class TransaksiController extends Controller
{
    public function create()
    {
    $products = \App\Models\Product::all();
    return view('transaksi.create', compact('products'));
    }


    public function riwayat()
    {
        $transaksis = \App\Models\Transaksi::with('details.produk')->orderBy('tanggal', 'desc')->get();
        return view('transaksi.riwayat', compact('transaksis'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'produk_id.*' => 'required|exists:products,id',
            'qty.*' => 'required|integer|min:1',
        ]);

        $total = 0;

        // Cek stok terlebih dahulu
        foreach ($request->produk_id as $id) {
            $product = Product::find($id);
            $qty = $request->qty[$id]; // ambil qty berdasarkan ID produk

            if ($product->stok < $qty) {
                return redirect()->back()->withErrors("Stok tidak cukup untuk produk: {$product->nama}");
            }

            $total += $product->harga * $qty;
        }

        // Simpan transaksi
        $transaksi = Transaksi::create([
            'tanggal' => Carbon::now(),
            'total' => $total
        ]);

        // Simpan detail dan kurangi stok
        foreach ($request->produk_id as $id) {
        $product = Product::find($id);
            $qty = $request->qty[$id];

            if ($product->stok < $qty) {
                return back()->with('error', 'Stok untuk ' . $product->nama . ' tidak mencukupi.');
            }

            $product->stok -= $qty;
            $product->save();

        }


        return redirect('/admin/kasir')->with([
            'success' => 'Transaksi berhasil!',
            'total' => $total
        ]);
    }
      
}
