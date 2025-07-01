<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Transaksi;
use App\Models\TransaksiDetail;
use Illuminate\Http\Request;
use Carbon\Carbon;

class TransaksiController extends Controller
{
    public function create()
    {
        $products = Product::all();
        return view('transaksi.create', compact('products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'produk_id.*' => 'required|exists:products,id',
            'qty.*' => 'required|integer|min:1',
        ]);

        $total = 0;

        foreach ($request->produk_id as $id) {
            $product = Product::find($id);
            $qty = $request->qty[$id];

            if ($product->stok < $qty) {
                return back()->withErrors("Stok tidak cukup untuk: {$product->nama}");
            }

            $total += $product->harga * $qty;
        }

        $transaksi = Transaksi::create([
            'tanggal' => Carbon::now(),
            'total' => $total,
        ]);

        foreach ($request->produk_id as $id) {
            $product = Product::find($id);
            $qty = $request->qty[$id];

            $product->stok -= $qty;
            $product->save();

            TransaksiDetail::create([
                'transaksi_id' => $transaksi->id,
                'produk_id' => $id,
                'qty' => $qty,
                'harga' => $product->harga
            ]);

        }

        return redirect()->route('transaksi.create')->with('success', 'Transaksi berhasil! Total: Rp ' . number_format($total, 0, ',', '.') . '. Terima kasih.');
    }

    public function riwayat()
    {
        $transaksis = Transaksi::with('details.produk')->orderBy('tanggal', 'desc')->get();
        return view('transaksi.riwayat', compact('transaksis'));
    }
}
