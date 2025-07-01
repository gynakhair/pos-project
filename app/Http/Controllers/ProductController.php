<?php

namespace App\Http\Controllers;
use App\Models\Product;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
    $products = \App\Models\Product::all();
    return view('produk.index', compact('products'));
    }

    public function create()
    {
        return view('produk.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'barcode' => 'required|string|unique:products',
            'stok' => 'required|integer|min:0',
            'harga' => 'required|numeric|min:0',
        ]);

        \App\Models\Product::create([
            'nama' => $request->nama,
            'barcode' => $request->barcode,
            'stok' => $request->stok,
            'harga' => $request->harga,
        ]);

        return redirect()->route('produk.index')->with('success', 'Produk berhasil ditambahkan!');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

        public function edit($id)
    {
        $product = \App\Models\Product::findOrFail($id);
        return view('produk.edit', compact('product'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'barcode' => 'required|string|unique:products,barcode,' . $id,
            'stok' => 'required|integer|min:0',
            'harga' => 'required|numeric|min:0',
        ]);

        $product = \App\Models\Product::findOrFail($id);
        $product->update([
            'nama' => $request->nama,
            'barcode' => $request->barcode,
            'stok' => $request->stok,
            'harga' => $request->harga,
        ]);

        return redirect()->route('produk.index')->with('success', 'Produk berhasil diupdate!');
    }

    public function destroy($id)
    {
        $product = \App\Models\Product::findOrFail($id);
        $product->delete();

        return redirect()->route('produk.index')->with('success', 'Produk berhasil dihapus!');
    }

    public function tambahStok(Request $request, $id)
    {
        $request->validate([
            'tambah' => 'required|integer|min:1'
        ]);

        $produk = Product::findOrFail($id);
        $produk->stok += $request->tambah;
        $produk->save();

        return back()->with('success', 'Stok berhasil ditambahkan.');
    }


}
